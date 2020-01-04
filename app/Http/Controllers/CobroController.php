<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Venta;
use App\Mesa;
use App\Credito;
use App\Empresa;
use DB;

class CobroController extends Controller
{
	public function __construct()
    {
        $this->middleware('permission:cobros.read')->only(['index','fgetVentas']);
        $this->middleware('permission:cobros.edit')->only('pagoVenta');
    }
    public function index()
    {
        return view('cobros.index');
    }

    public function fgetVentas(){
    	$ventas = DB:: select("
			SELECT v.*, c.nombre, c.id AS cId, m.name FROM ventas AS v
			LEFT OUTER JOIN mesas AS m ON m.id = v.mesa_id
			INNER JOIN clientes AS c ON c.id = v.cliente_id
			WHERE v.status = 'Pendiente'
		");
    	return $ventas;
	}

    public function pagoVenta(Request $request){
		try {
			DB::beginTransaction();
				$venta = Venta::find($request->id);
				$tipoPago = $request->tipoPago;
				if ($request->tipo == 'Comanda') {
					$mesa = Mesa::find($venta->mesa_id);
					$mesa->status = 2;
					$mesa->update();
				}
				if ($tipoPago == 'Credito') {
					$adelanto = $request->adelanto;
					if($adelanto > 0){
						$credito = Credito::create(['total_pago'=>$adelanto,'venta_id'=>$venta->id]);
						$empresa = Empresa::find(1);
						$empresa->ingresos += $credito->total_pago;
						$empresa->update();
					}
					$venta->status = ($adelanto == $venta->total) ? 'Exitosa' : 'Credito';
				}else{
					$venta->status = 'Exitosa';
					$empresa = Empresa::find(1);
					$empresa->ingresos += $venta->total;
					$empresa->update();
				}
				$venta->tipoPago = $tipoPago;
				$venta->update();
			DB::commit();
			return 'Operación realizada correctamente';
		} catch (Exception $e) {
			return 'Error';
			DB::rollback();
		}
    }
}
