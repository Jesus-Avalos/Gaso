<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Venta;
use App\Corte;
use App\Compra;
use App\Empresa;
use DB;

class CortesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:cortes.read')->only(['index','getCortes','showVentas','getVentasCortes','show']);
        $this->middleware('permission:cortes.edit')->only(['store']);
    }

    public function index()
    {
        $ingresos = Venta::where('status','=','Exitosa')->whereNull('corte_id')
                            ->select(DB::raw('SUM(total) as recuento'))->get();
        $egresos = Compra::where('status','=','Exitosa')->whereNull('corte_id')
                            ->select(DB::raw('SUM(total) as recuento'))->get();
        $recuento = $ingresos[0]->recuento - $egresos[0]->recuento;
        $numVentas = Venta::where('status','=','Exitosa')->whereNull('corte_id')
                                ->select(DB::raw('count(id) as count'))->get();

        return view('cortes.index',compact('recuento','numVentas'));
        // return $egresos[0];
    }

    public function store(Request $request)
    {
        $corte = new Corte;
        $corte->apertura = $request->apertura;
        $corte->recuento = $request->recuento;
        $corte->caja = $request->caja;
        $corte->descuadre = ($request->caja - $request->apertura) - $request->recuento;
        $corte->save();
        $empresa = Empresa::find(1);
        $empresa->caja_extra += $corte->caja - $corte->apertura;

        $ventas = Venta::where('status','=','Exitosa')->whereNull('corte_id')->orderBy('id','DESC')->get();
        $compras = Compra::where('status','=','Exitosa')->whereNull('corte_id')->orderBy('id','DESC')->get();

        if($corte->descuadre > 0){
            $empresa->caja_extra += $corte->descuadre;
        }else{
            $empresa->egresos += (-1 * $corte->descuadre);
        }
        $empresa->update();

        foreach ($ventas as $key => $value) {
            $venta = Venta::find($value->id);
            $venta->corte_id = $corte->id;
            $venta->update();
        }

        foreach ($compras as $key => $value) {
            $compra = Compra::find($value->id);
            $compra->corte_id = $corte->id;
            $compra->update();
        }

        return redirect('/cortes');
    }

    public function showVentas()
    {
        return view('cortes.ventas');
    }

    public function getVentasCortes()
    {
        return Venta::where('status','=','Exitosa')->whereNull('corte_id')->orderBy('id','DESC')->get();
    }

    public function getComprasCortes()
    {
        return Compra::where('status','=','Exitosa')
                    ->join('proovedores AS p','p.id','=','compras.proovedor_id')
                    ->whereNull('corte_id')
                    ->select('compras.*','p.nombre')
                    ->orderBy('id','DESC')
                    ->get();
    }

    public function getCortes ()
    {
        return Corte::orderBy('id','DESC')->get();
    }

    public function show($id)
    {
        $title = 'Detalle corte';
        $ventas = Venta::where('corte_id','=',$id)->orderBy('id','DESC')->get();
        return view('ventas.index', compact('ventas','title'));
    }
}
