<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Venta;
use App\Cliente;
use App\Credito;

class CreditoController extends Controller
{
    public function index(){
		$ventas = DB::select("
			SELECT (v.total - SUM(c.total_pago)) AS deuda, v.*, SUM(c.total_pago) AS pagado, cl.nombre
			FROM ventas AS v
			LEFT OUTER JOIN credito AS c ON c.venta_id = v.id
			INNER JOIN clientes AS cl ON cl.id = v.cliente_id
			WHERE v.status = 'Credito'
			GROUP BY v.id
		");
		$title = "Ventas pendientes de pago";
		return view('creditos.index', compact('ventas','title'));
		// return $ventas;
	}

	public function show($id){
		$venta = Venta::find($id);
		$cliente = Cliente::find($venta->cliente_id);
		$abonos = Credito::where('venta_id','=',$venta->id)->orderBy('id','DESC')->get();
		$datos = DB::select("
			SELECT (v.total - SUM(c.total_pago)) AS deuda, SUM(c.total_pago) AS pagado, v.total
			FROM ventas AS v
			LEFT OUTER JOIN credito AS c ON c.venta_id = v.id
			WHERE v.status = 'Credito'
			AND v.id = ". $id ."
			GROUP BY v.id
		");

		return view('creditos.create',compact('venta','cliente','abonos','datos'));
	}

	public function store(Request $request){
		$credito = Credito::create($request->all())->save();
		$empresa = Empresa::find(1);
		$empresa->ingresos += $credito->total_pago;
		$empresa->update();
		$datos = DB::select("
			SELECT (v.total - SUM(c.total_pago)) AS deuda, SUM(c.total_pago) AS pagado, v.total
			FROM ventas AS v
			RIGHT JOIN credito AS c ON c.venta_id = v.id
			WHERE v.status = 'Credito'
			AND v.id = ". $request->venta_id ."
			GROUP BY v.id
		");

		if($datos[0]->pagado == $datos[0]->total){
			$venta = Venta::find($request->venta_id);
			$venta->status = 'Exitosa';
			$venta->update();
			return redirect('ventas');
		}else{
			return back()->with('status','Registrado correctamente');
		}

	}
}
