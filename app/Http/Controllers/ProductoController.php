<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductosRequest;

use App\Inventario;
use App\Categoria;
use App\Subcategoria;
use App\Producto;
use App\DetalleProducto;
use DB;

class ProductoController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function __construct()
	{
		$this->middleware('permission:productos.read')->only('index');
		$this->middleware('permission:productos.edit')->only(['store', 'create', 'edit', 'update', 'destroy']);
	}

	public function index()
	{
		// $productos = DB::table('productos as p')
		// 	->join('subcategorias as s', 's.id', '=', 'p.subcategoria_id')
		// 	->join('categorias as c', 'c.id', '=', 's.categoria_id')
		// 	->orderBy('subcategoria_id', 'ASC')
		// 	->select('p.*', 's.name as subcategoria', 'c.name as categoria')->get();

		$productos = DB::select("
			SELECT p.*, s.name AS subcategoria, c.name AS categoria
			FROM productos AS p
			LEFT OUTER JOIN subcategorias AS s ON s.id = p.subcategoria_id
			LEFT OUTER JOIN categorias AS c ON c.id = s.categoria_id
			WHERE p.status = 'Activo'
			ORDER BY p.subcategoria_id ASC
		");

		$stock = existencia();

		return view('producto.index', compact('productos', 'stock'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$ingredientes = DB::select('SELECT * FROM inventario WHERE tipo != "Material" AND status = "Activo"');
		$subcategorias = [];
		$categorias = Categoria::pluck('name', 'id');
		return view('producto.create', compact('ingredientes', 'categorias', 'subcategorias'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ProductosRequest $request)
	{
		try {
			DB::beginTransaction();

			$producto = Producto::create($request->all());
			$filename = "default.jpg";

			if ($request->hasFile('imagen')) {

				$file = $request->file('imagen');
				$extension = $request->file('imagen')->getClientOriginalExtension();
				$filename = $request->get('name') . '.' . $extension;
				$file->storeAs('public/productos',$filename);
			}
			$producto->url = $filename;
			$producto->save(); 

			$ingredientes_id = $request->get('ingredientes_id');
			$porciones = $request->get('porciones');
			$precio = $request->get('precio');
			$cont = 0;
			while ($cont < count($porciones)) {
				$detalle = new DetalleProducto;
				$detalle->ingrediente_id = $ingredientes_id[$cont];
				$detalle->producto_id = $producto->id;
				$detalle->porciones = $porciones[$cont];
				$detalle->precio = $precio[$cont];
				$detalle->save();
				$cont++;
			}

			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
		}

		return redirect('producto');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		// $producto = DB::table('productos AS p')
		// 	->join('subcategorias AS s', 's.id', '=', 'p.subcategoria_id')
		// 	->join('categorias AS c', 'c.id', '=', 's.categoria_id')
		// 	->where('p.id', '=', $id)
		// 	->select('p.name', 'p.codigo', 'p.subcategoria_id', 'p.descripcion', 'p.preparacion', 'p.precio_venta', 'p.tiempo_preparacion', 'p.precio_produccion', 'p.id', 's.categoria_id')
		// 	->get();

		$producto = DB::select('
			SELECT p.name, p.codigo, p.subcategoria_id, p.descripcion, p.preparacion, p.precio_venta, p.tiempo_preparacion, p.precio_produccion, p.id, s.categoria_id
			FROM productos AS p
			LEFT OUTER JOIN subcategorias AS s ON s.id = p.subcategoria_id
			LEFT OUTER JOIN categorias AS c ON c.id = s.categoria_id
			WHERE p.id = '.$id.'
		');

		$categoria = $producto[0]->categoria_id;
		$categorias = Categoria::pluck('name', 'id');
		$subcategorias = Subcategoria::where('categoria_id', '=', $categoria)->pluck('name', 'id');

		$ingredientesSelected = DB::table('detalle_productos')
			->join('inventario', 'inventario.id', '=', 'detalle_productos.ingrediente_id')
			->where([['detalle_productos.producto_id', '=', $id],['inventario.status','=','Activo']])
			->select('detalle_productos.porciones', 'detalle_productos.precio', 'inventario.id', 'inventario.nombre', 'inventario.precio_porcion')
			->get();

		$ingredientes = DB::select('SELECT * FROM inventario WHERE tipo != "Material" AND status = "Activo"');
		$producto = $producto[0];

		return view('producto.edit', compact('producto', 'categoria', 'subcategorias', 'ingredientes', 'ingredientesSelected', 'categorias'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(ProductosRequest $request, $id)
	{
		try {
			DB::beginTransaction();

			$deleteDetalle = DetalleProducto::where('producto_id', '=', $id);
			$deleteDetalle->delete();

			$producto = Producto::find($id);
			$producto->fill($request->all());
			if ($request->hasFile('imagen')) {

				if (\Storage::exists('public/productos/'.$producto->url)) {
					\Storage::delete('public/productos/'.$producto->url);
				}
	
				$file = $request->file('imagen');
				$extension = $request->file('imagen')->getClientOriginalExtension();
				$filename = $request->get('name') . '.' . $extension;
				$file->storeAs('public/productos',$filename);
				$producto->url = $filename;
			}
			$producto->update();

			$ingredientes_id = $request->get('ingredientes_id');
			$porciones = $request->get('porciones');
			$precio = $request->get('precio');
			$cont = 0;

			while ($cont < count($ingredientes_id)) {
				$detalle = new DetalleProducto;
				$detalle->ingrediente_id = $ingredientes_id[$cont];
				$detalle->producto_id = $producto->id;
				$detalle->porciones = $porciones[$cont];
				$detalle->precio = $precio[$cont];
				$detalle->save();
				$cont++;
			}

			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
		}

		return redirect('producto');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$producto = Producto::find($id);
		$producto->status = 'Inactivo';
		$producto->update();

		return redirect('producto');
	}
}

function existencia()
{
	$productos = Producto::select('name', 'id')->get();
	$stock = [];
	foreach ($productos as $producto) {
		$temp = [];
		$ingredientes = DB::table('inventario as i')
			->join('detalle_productos as dp', 'i.id', '=', 'dp.ingrediente_id')
			->join('productos as p', 'p.id', '=', 'dp.producto_id')
			->where('dp.producto_id', '=', $producto->id)
			->orderBy('p.subcategoria_id', 'ASC')
			->select('i.porciones', 'i.id', 'dp.porciones AS por')
			->get();
		foreach ($ingredientes as $ing) {
			array_push($temp, intdiv($ing->porciones, $ing->por));
		}
		array_push($stock, min($temp));
	}

	return $stock;
}
