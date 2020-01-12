<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mesa;
use App\CLiente;
use App\Categoria;
use App\Venta;
use App\Inventario;
use App\DetalleVenta;
use App\DetalleTemp;
use App\DetalleProducto;
use DB;

class ComandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:comandas.edit')->only(['edit','update','getVenta','getDVenta','store','show']);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $venta = new Venta;
            $venta->subtotal = $request->get('subtotal');
            $venta->descuento = $request->get('descuento');
            $venta->total = $request->get('total');
            $venta->tipo = $request->get('tipo');
            $venta->status = 'Pendiente';
            $venta->user_id = auth()->user()->id;
            $venta->mesa_id = $request->get('mesa');
            $opcion = $request->get('opcionCliente');
            $desechable = $request->get('desechable');

            if(isset($desechable)){
                $des = Inventario::find($desechable);
                $des->porciones--;
                $des->update();
            }

            if (isset($opcion)) {
                if ($opcion == 'si') {
                    $venta->cliente_id = $request->get('cliente_id');
                }else{
                    $cliente = Cliente::create($request->all());
                    $cliente->save();
                    $venta->cliente_id = $cliente->id;
                }
            }else{
                $venta->cliente_id = 1;
            }

            $venta->save();

            $item = $request->get('item');
            $producto_id = $request->get('producto_id');
            $cantidad = $request->get('cantidad');
            $ingredientes = $request->get('ingSelected');
            $precio = $request->get('precio_total');
            $mesa_id = $request->get('mesa');

            foreach ($item as $value) {
                $detalleV = new DetalleVenta;
                $detalleV->venta_id = $venta->id;
                $detalleV->producto_id = $producto_id[$value];
                $detalleV->cantidad = $cantidad[$value];
                $detalleV->precio_total = $precio[$value];
                $prodIng = $ingredientes[$value];

                foreach ($prodIng as $key) {
                    $porciones = DB::table('detalle_productos as dp')
                                        ->join('inventario as i','i.id','=','dp.ingrediente_id')
                                        ->where([['i.id', '=', $key],['dp.producto_id', '=', $producto_id[$value]],['i.status','=','Activo']])
                                        ->select('dp.porciones','i.id')
                                        ->get();

                    $inventario = Inventario::find($porciones[0]->id);

                    $inventario->porciones -= ($porciones[0]->porciones * $cantidad[$value]);
                    $inventario->cantidad = intval($inventario->porciones / $inventario->por_unidad);
                    $inventario->update();

                }

                $detalleV->ingredientes = json_encode($prodIng);
                $detalleV->save();
            }

            $mesa = Mesa::find($mesa_id);
            $mesa->status = 0;
            $mesa->update();

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect('mesas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mesa = Mesa::find($id);
        $desechables = Inventario::where('tipo','=','Desechable')->pluck('nombre','id');

        return view('comandas.create',compact('mesa','desechables'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venta = $this->getVenta($id);

        $detalleVenta = $this->getDVenta($venta[0]->id);

        $mesa = Mesa::find($id);
        $cliente = Cliente::find($venta[0]->cliente_id);
        $desechables = Inventario::where('tipo','=','Desechable')->pluck('nombre','id');

        return view('comandas.edit',compact('venta','mesa','detalleVenta','cliente','desechables'));
    }

    public function getComanda($id){
        $venta = $this->getVenta($id);

        $datos[0] = $venta;


        $detalleVenta = $this->getDVenta($venta[0]->id);

        $datos[1] = $detalleVenta;

        $mesa = Mesa::find($id);
        $categorias = Categoria::all();

        foreach ($detalleVenta as $value) {
            $arrayProd[] = DB::table('inventario AS i')->leftJoin('detalle_productos AS dp','dp.ingrediente_id','=','i.id')->where([['dp.producto_id','=',$value->producto_id],['i.status','=','Activo']])->pluck('nombre','i.id');
            $arrayTemp[] = DB::table('detalle_ventas AS dv')->where('dv.id','=',$value->id)->pluck('dv.ingredientes');
        }

        foreach ($arrayTemp as $value) {
            $arrayGroup[] = json_decode($value[0]);
            foreach ($arrayGroup as $value2) {
                $arraySelected[] = Inventario::where([['id','=','$value2'],['status','=','Activo']])->pluck('nombre','id');
            }
        }

        $datos[2] = $arrayProd;
        $datos[3] = $arrayGroup;

        return $datos;
    }

    function getVenta($id){
        return Venta::where('status','=','Pendiente')
                    ->where('mesa_id','=',$id)
                    ->get();
    }

    function getDVenta($id){
        return DB::table('detalle_ventas AS dv')->join('productos AS p','p.id','=','dv.producto_id')->where('dv.venta_id','=',$id)
                ->select('dv.*','p.name', 'p.subcategoria_id', 'p.precio_venta')->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $venta = Venta::find($id);
            $venta->subtotal = $request->get('subtotal');
            $venta->descuento = $request->get('descuento');
            $venta->total = $request->get('total');
            $opcion = $request->get('opcionCliente');
            $desechable = $request->get('desechable');
            if(isset($desechable)){
                $des = Inventario::find($desechable);
                $des->porciones--;
                $des->update();
            }
            $detsV = DB::table('detalle_ventas as dv')
                            ->where('dv.venta_id','=',$venta->id)
                            ->get();

            foreach ($detsV as $value) {
                foreach (json_decode($value->ingredientes) as $key) {
                    $porciones = DB::table('detalle_productos as dp')
                                        ->join('inventario as i','i.id','=','dp.ingrediente_id')
                                        ->where([['i.id', '=', $key],['dp.producto_id', '=', $value->producto_id],['i.status','=','Activo']])
                                        ->select('dp.porciones','i.id')
                                        ->get();
                    $inventario = Inventario::find($porciones[0]->id);
                    $inventario->porciones += ($porciones[0]->porciones * $value->cantidad);
                    $inventario->cantidad = intval($inventario->porciones / $inventario->por_unidad);
                    $inventario->update();

                }
            }
            DB::select('DELETE FROM detalle_ventas WHERE venta_id = ' . $id);
            if (isset($opcion)) {
                if ($opcion == 'si') {
                    $venta->cliente_id = $request->get('cliente_id');
                }else{
                    $cliente = Cliente::create($request->all());
                    $cliente->save();
                    $venta->cliente_id = $cliente->id;
                }
            }
            $venta->update();

            $item = $request->get('item');
            $producto_id = $request->get('producto_id');
            $cantidad = $request->get('cantidad');
            $ingredientes = $request->get('ingSelected');
            $precio = $request->get('precio_total');
            $mesa_id = $request->get('mesa');
            foreach ($item as $value) {
                $detalleV = new DetalleVenta;
                $detalleV->venta_id = $id;
                $detalleV->producto_id = $producto_id[$value];
                $detalleV->cantidad = $cantidad[$value];
                $detalleV->precio_total = $precio[$value];
                $prodIng = $ingredientes[$value];
                foreach ($prodIng as $key) {
                    $porciones = DB::table('detalle_productos as dp')
                                        ->join('inventario as i','i.id','=','dp.ingrediente_id')
                                        ->where([['i.id', '=', $key],['dp.producto_id', '=', $producto_id[$value]],['i.status','=','Activo']])
                                        ->select('dp.porciones','i.id')
                                        ->get();

                    $inventario = Inventario::find($porciones[0]->id);
                    $inventario->porciones -= ($porciones[0]->porciones * $cantidad[$value]);
                    $inventario->cantidad = intval($inventario->porciones / $inventario->por_unidad);
                    $inventario->update();

                }
                $detalleV->ingredientes = json_encode($prodIng);
                $detalleV->save();
            }
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
        return redirect('mesas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
