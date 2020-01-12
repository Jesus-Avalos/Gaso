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
		$datos[0] = DB::select("SELECT * FROM productos AS p WHERE p.subcategoria_id =" . $id . " AND p.status = 'Activo'");
		$dato = Subcategoria::find($id);
		$datos[1] = $dato->categoria_id;

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