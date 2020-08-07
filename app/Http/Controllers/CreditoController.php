<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Venta;
use App\Cliente;
use App\Credito;
use App\Empresa;

class CreditoController extends Controller
{
    public function index(){
		$cargos = DB::select("
			SELECT CASE WHEN SUM(v.total) IS NULL THEN 0 ELSE SUM(v.total) END AS totalCargo, 
			cl.nombre, cl.id
			FROM clientes AS cl
			INNER JOIN ventas AS v ON v.cliente_id = cl.id AND v.tipoPago = 'Credito'
			GROUP BY cl.id
		");

		$abonos = DB::select("
			SELECT CASE WHEN SUM(c.total_pago) IS NULL THEN 0 ELSE SUM(c.total_pago) END AS totalAbono, 
			cl.nombre, cl.id
			FROM clientes AS cl
			INNER JOIN credito AS c ON c.cliente_id = cl.id
			GROUP BY cl.id
		");
		
							
		return view('creditos.index',compact('cargos','abonos'));
		// return $abonos;
		// return $cargos;
	}

	public function show($id){

		return view('creditos.create');
	}

	public function ventasCredito($id){
		$ventas = Venta::where([['tipoPago','=','Credito'],['cliente_id','=',$id]])->get();
		$abonos = Credito::where('cliente_id','=',$id)->get();
		$cliente = Cliente::find($id);

		$totalCargos = DB::select("
			SELECT CASE WHEN SUM(v.total) IS NULL THEN 0 ELSE SUM(v.total) END AS totalCargos
			FROM clientes AS cl
			INNER JOIN ventas AS v ON v.cliente_id = cl.id AND v.tipoPago = 'Credito'
			WHERE cl.id = ".$id."
		");

		$totalAbonos = DB::select("
			SELECT CASE WHEN SUM(c.total_pago) IS NULL THEN 0 ELSE SUM(c.total_pago) END AS totalAbonos
			FROM clientes AS cl
			LEFT OUTER JOIN credito AS c ON c.cliente_id = cl.id
			WHERE cl.id = ".$id."
		");
		return view('creditos.show',compact('ventas','abonos','cliente','totalAbonos','totalCargos'));
		// return $totales;
	}

	public function store(Request $request){
		$credito = Credito::create(['total_pago'=>$request->total_pago,'cliente_id'=>$request->cliente_id]);
		$empresa = Empresa::find(1);
			$empresa->ingresos += $credito->total_pago;
		$empresa->update();
		return back()->with('status','Registrado correctamente');
	}
}
