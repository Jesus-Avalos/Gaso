<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Venta;
use App\Cliente;
use App\Mesa;
use App\Credito;
use DB;

class VentaController extends Controller
{
	public function __construct()
    {
        $this->middleware('permission:ventas.read')->only(['index','show']);
	}
	
    public function index()
    {
		$title = 'Listado ventas';
		$ventas = DB::table('ventas as v')
					->where([['v.status','!=','Pendiente'],['v.status','!=','Credito']])
					->join('mesas as m','m.id','=','v.mesa_id','left outer')
					->join('clientes as c','c.id','=','v.cliente_id')
					->select('v.*','c.nombre as cliente','m.name as mesa')
					->orderBy('created_at','DESC')
					->get();

    	return view('ventas.index', compact('ventas','title'));
	}
	
    public function exitosas()
    {
		$title = 'Listado ventas exitosas';
		$ventas = DB::table('ventas as v')
					->where('v.status','=','Exitosa')
					->join('mesas as m','m.id','=','v.mesa_id','left outer')
					->join('clientes as c','c.id','=','v.cliente_id')
					->select('v.*','c.nombre as cliente','m.name as mesa')
					->orderBy('created_at','DESC')
					->get();

    	return view('ventas.index', compact('ventas','title'));
	}
	
    public function canceladas()
    {
		$title = 'Listado ventas canceladas';
		$ventas = DB::table('ventas as v')
					->where('v.status','=','Cancelada')
					->join('mesas as m','m.id','=','v.mesa_id','left outer')
					->join('clientes as c','c.id','=','v.cliente_id')
					->select('v.*','c.nombre as cliente','m.name as mesa')
					->orderBy('created_at','DESC')
					->get();

    	return view('ventas.index', compact('ventas','title'));
	}
	
    public function pendientes()
    {
		$title = 'Listado ventas pendientes';
		$ventas = DB::table('ventas as v')
					->where('v.status','=','Pendiente')
					->join('mesas as m','m.id','=','v.mesa_id','left outer')
					->join('clientes as c','c.id','=','v.cliente_id')
					->select('v.*','c.nombre as cliente','m.name as mesa')
					->orderBy('created_at','DESC')
					->get();

    	return view('ventas.index', compact('ventas','title'));
	}
}
