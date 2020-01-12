<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grupo;
use App\Venta;
use App\Cliente;
use App\Producto;
use App\Inventario;
use App\Empresa;
use DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exitosas = Venta::where(DB::raw('DATE(created_at)'),'=',date('Y-m-d'))
                            ->where('status','=','Exitosa')->count();

        $canceladas = Venta::where(DB::raw('DATE(created_at)'),'=',date('Y-m-d'))
                            ->where('status','=','Cancelada')->count();

        $pendientes = Venta::where(DB::raw('DATE(created_at)'),'=',date('Y-m-d'))
                            ->where('status','=','Pendiente')->count();

        $ventasTurno = Venta::whereNull('corte_id')->count();
        $stockMinimo = Inventario::whereRaw('porciones <= stock_min')->where('status','=','Activo')->get();
        $stocks = existencia();
        // return $stocks;
        return view('home', compact('stocks','exitosas','canceladas','pendientes','ventasTurno','stockMinimo'));
    }

    
}

function existencia()
{
    $productos = Producto::select('name','id')->where('status','=','Activo')->get();
    $stock = [];
    foreach($productos as $producto)
    {
    $temp = [];
    $ingredientes = DB::table('inventario as i')
                        ->join('detalle_productos as dp','i.id','=','dp.ingrediente_id')
                        ->where([['dp.producto_id','=',$producto->id],['i.status','=','Activo']])
                        ->select('i.porciones','i.id','dp.porciones AS por')
                        ->get(); 
    foreach($ingredientes as $ing)
    {
        array_push($temp,intdiv($ing->porciones,$ing->por));
    }
    array_push($stock,min($temp));
    }
    $datos[0] = $productos;
    $datos[1] = $stock;

    return $datos;
}