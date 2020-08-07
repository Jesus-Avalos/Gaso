<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cliente;
use App\Producto;
use App\Empresa;
use App\User;
use App\Mesa;
use App\Venta;
use App\Inventario;
use App\Subcategoria;

use Hash;
use Validator;
use Auth;
use DB;

class UtilidadesController extends Controller
{
	public function __construct()
	{
		$this->middleware('permission:configuracion.edit')->only(['changePass', 'pass']);
		$this->middleware('permission:pedidos.edit')->only('pedidoConcretar');
		$this->middleware('permission:cancelar.edit')->only(['CancelarCPerdidas', 'CancelarSPerdidas']);
	}

	public function pedidoConcretar(Venta $venta)
	{
		$venta->update(["status" => "Exitosa"]);

		return back()->with('message', 'Operación realizada correctamente');
	}

	public function CancelarSPerdidas(Venta $venta)
	{
		$detsV = DB::table('detalle_ventas as dv')
			->where('dv.venta_id', '=', $venta->id)
			->get();

		if ($venta->mesa_id) {
			$mesa = Mesa::find($venta->mesa_id);
				$mesa->status = 2;
			$mesa->update();
		}

		foreach ($detsV as $value) {

			foreach (json_decode($value->ingredientes) as $key) {
				$porciones = DB::table('detalle_productos as dp')
					->join('inventario as i', 'i.id', '=', 'dp.ingrediente_id')
					->where([['i.id', '=', $key], ['dp.producto_id', '=', $value->producto_id],])
					->select('dp.porciones', 'i.id')
					->get();

				$inventario = Inventario::find($porciones[0]->id);

				$inventario->porciones += $porciones[0]->porciones;
				$inventario->cantidad = intval($inventario->porciones / $inventario->por_unidad);
				$inventario->update();
			}
		}
		$venta->update(["status" => "Cancelada", "total" => 0]);

		return redirect('venta');
	}

	public function CancelarCPerdidas(Venta $venta)
	{
		if ($venta->mesa_id) {
			$mesa = Mesa::find($venta->mesa_id);
				$mesa->status = 2;
			$mesa->update();
		}

		$empresa = new Empresa;
			$empresa->egreso += $venta->total;
		$empresa->update();

		$venta->update(["status" => "Cancelada"]);

		return redirect('venta');
	}

	public function clientesSelect()
	{
		$clientes = \App\Cliente::all();

		$cadena = '';

		foreach ($clientes as $cliente) {
			$cadena .= "<option value='" . $cliente->id . "' selected>" . $cliente->nombre . "</option>";
		}

		return $cadena;
	}

	public function getProducto($id)
	{
		$datos[0] = \App\Producto::find($id);

		$datos[1] = DB::table('inventario as i')
			->join('detalle_productos as dp', 'i.id', '=', 'dp.ingrediente_id')
			->where([['dp.producto_id', '=', $id],['i.status','=','Activo']])
			->select('i.*')
			->groupBy('i.id')
			->get()->toArray();

		$cadena = "";

		foreach ($datos[1] as $value) {
			$cadena .= "<option value='" . $value->id . "' selected>" . $value->nombre . "</option>";
		}

		$datos[2] = $datos[1];

		$datos[1] = $cadena;

		return $datos;
	}

	public function existencia()
	{
		$productos = Producto::select('name', 'id')->get();
		$stock = [];
		foreach ($productos as $producto) {
			$temp = [];
			$ingredientes = DB::table('inventario as i')
				->join('detalle_productos as dp', 'i.id', '=', 'dp.ingrediente_id')
				->where([['dp.producto_id', '=', $producto->id],['i.status','=','Activo']])
				->select('i.porciones', 'i.id', 'dp.porciones AS por')
				->get();
			foreach ($ingredientes as $ing) {
				array_push($temp, intdiv($ing->porciones, $ing->por));
			}
			array_push($stock, min($temp));
		}
		$datos['productos'] = $productos;
		$datos['stock'] = $stock;

		return $datos;
	}

	public function clienteNew(Request $request){
		$cliente = Cliente::create($request->all());
		$cliente->save();
		$venta = Venta::find($request->venta);
			$venta->cliente_id = $cliente->id;
		$venta->update();
		return $cliente->id;
	}

	public function getDetails($id){
		$venta = Venta::find($id);
		$detalle = DB::table('detalle_ventas AS dv')->join('productos AS p','p.id','=','dv.producto_id')->where('dv.venta_id','=',$id)
						->select('dv.*','p.name', 'p.subcategoria_id', 'p.precio_venta')->get();
		
		$arrayTemp = [];
		$arrayProd = [];
		foreach ($detalle as $value) {
			array_push($arrayProd,DB::table('inventario AS i')->leftJoin('detalle_productos AS dp','dp.ingrediente_id','=','i.id')->where([['dp.producto_id','=',$value->producto_id],['i.status','=','Activo']])->pluck('nombre','i.id'));
		}
		$arrayGroup = [];
		$options = [];
		for ($i=0; $i < count($detalle); $i++) { 
			$string = '';
			array_push($arrayGroup,json_decode($detalle[$i]->ingredientes));
			foreach ($arrayProd[$i] as $key => $value) {
				$string .= '<option value="'.$key.'">'.$value.'</option>';
			}
			array_push($options,$string);
		}
		$datos[0] = $venta;
		$datos[1] = $detalle;
		$datos[2] = $options;
		$datos[3] = $arrayGroup;

		return $datos;
	}

	public function getStockByIngs(Request $request){
		$porcionesI = Inventario::select('porciones','id')->get();
		foreach ($arrayStock as $key => $value) {
			$porcionesP = DB::table('inventario as i')
							->join('detalle_productos as dp','dp.ingrediente_id','=','i.id')
							->where([['dp.producto_id','=',$value->key],['i.status','=','Activo']])
							->select('dp.porciones','i.id')->get();
			foreach ($array as $value2) {
				if ($value->id == $value2->id) {
					$value->porciones -= $value2->porciones * $cant;
				break;
				}
			}
		}
		$porcionesP = DB::table('inventario as i')
					->join('detalle_productos as dp','dp.ingrediente_id','=','i.id')
					->where([['dp.producto_id','=',$id],['i.status','=','Activo']])
					->select('dp.porciones','i.id')->get();
		$temp = [];
		foreach ($porciones as $value) {
			foreach ($porcionesP as $value2) {
				if ($value->id == $value2->id) {
					array_push($temp,intdiv($value->porciones,$value2->porciones));
				}
			}
		}
		$stock = min($temp);
		return $stock;
	}

	public function getCantIngs($id,$cant){
		$porcionesP = DB::table('inventario as i')
					->join('detalle_productos as dp','dp.ingrediente_id','=','i.id')
					->where([['dp.producto_id','=',$id],['i.status','=','Activo']])
					->select('dp.porciones','i.id')->get();
		$porcionesI = Inventario::select('porciones','id')->get();
		foreach ($porcionesI as $value) {
			foreach ($porcionesP as $value2) {
				if ($value->id == $value2->id) {
					$value->porciones -= $value2->porciones * $cant;
				break;
				}
			}
		}
		return $porcionesI;
	}

	public function getStock($id)
	{
		$temp = [];
		$ings = DB::table('inventario as i')
			->join('detalle_productos as dp', 'i.id', '=', 'dp.ingrediente_id')
			->where([['dp.producto_id', '=', $id],['i.status','=','Activo']])
			->select('i.*', 'dp.porciones AS por')
			->get()->toArray();

		foreach ($ings as $ing) {
			array_push($temp,intdiv($ing->porciones, $ing->por));
		}
		$stock = min($temp);

		return $stock;
	}

	public function selectSub($id)
	{
		$datos = DB::select("
			SELECT p.*, s.categoria_id FROM productos AS p
			INNER JOIN subcategorias AS s ON s.id = p.subcategoria_id
			WHERE p.subcategoria_id =" . $id . " AND p.status = 'Activo'
		");

		return $datos;
	}

	public function selectCat($id)
	{
		return DB::table('subcategorias')
			->where('categoria_id', '=', $id)
			->orderBy('name', 'asc')
			->get();
	}

	public function subCats($id)
	{
		$subs = DB::table('subcategorias')
			->where('categoria_id', '=', $id)
			->get()->toArray();

		$cadena = "";
		foreach ($subs as $value) {
			$cadena .= "<option value='" . $value->id . "'>" . $value->name . "</option>";
		}

		return $cadena;
	}

	public function ingSelect($id)
	{
		$precio = DB::select('SELECT * FROM inventario WHERE status = "Activo" AND id=' . $id);
		return $precio[0]->precio_porcion;
	}

	public function pass($id)
	{
		$user = User::find($id);
		return view('users.pass', compact('user'));
	}

	public function changePass($id, Request $request)
	{
		$rules = [
			'mypassword' => 'required',
			'password' => 'required|confirmed|min:6|max:18',
		];

		$messages = [
			'mypassword.required' => 'El campo es requerido',
			'password.required' => 'El campo es requerido',
			'password.confirmed' => 'Los passwords no coinciden',
			'password.min' => 'El mínimo permitido son 6 caracteres',
			'password.max' => 'El máximo permitido son 18 caracteres',
		];

		$validator = Validator::make($request->all(), $rules, $messages);
		if ($validator->fails()) {
			return back()->withErrors($validator);
		} else {
			if (Hash::check($request->mypassword, Auth::user()->password)) {
				$user = new User;
				$user->where('email', '=', Auth::user()->email)
					->update(['password' => Hash::make($request->password)]);
				return redirect()->route('user.show', [$id])->with('status', 'Password actualizado con éxito');
			} else {
				return back()->with('status', 'Credenciales incorrectas');
			}
		}
	}
}