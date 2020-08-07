<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venta;
use App\DetalleVenta;
use App\DetalleTemp;
use App\Cliente;
use App\Inventario;
use App\Categoria;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:pedidos.read')->only('index');
        $this->middleware('permission:pedidos.edit')->only(['store','create']);
    }

    public function index(){
        $ventas = DB::table('ventas as v')
                        ->join('clientes as c','c.id','=','v.cliente_id')
                        ->join('users as u','u.id','=','v.user_id')
                        ->where([['v.tipo','=','Pedido'],['v.status','=','Pendiente']])
                        ->select('v.*','c.nombre','c.domicilio','c.referencia','c.telefono','u.name')
                        ->orderBy('v.id','DESC')
                        ->get();

        return view('pedido.index',compact('ventas'));
    }

    public function create(){
        $venta = new Venta;
            $venta->subtotal = 0;
            $venta->descuento = 0;
            $venta->total = 0;
            $venta->tipo = 'Pedido';
            $venta->status = 'Pendiente';
            $venta->user_id = auth()->user()->id;
            $venta->cliente_id = 1;
        $venta->save();

        // return view('pedido.create', compact('desechables'));
        return redirect()->route('pedido.show', [$venta->id]);
    }

    public function show($id)
    {
        $venta = Venta::find($id);
        $clientes = Cliente::all();

        return view('pedido.create',compact('venta','clientes'));
    }
}
