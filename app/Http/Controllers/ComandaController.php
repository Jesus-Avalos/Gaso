<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mesa;
use App\CLiente;
use App\Categoria;
use App\Producto;
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
    public function show($id){
        $mesa = Mesa::find($id);
        if ($mesa->status == 0) {
            $venta = Venta::where([['mesa_id','=',$id],['status','=','Pendiente']])->get();
            $venta = $venta[0];
        }else{
            $venta = new Venta;
                $venta->subtotal = 0;
                $venta->descuento = 0;
                $venta->total = 0;
                $venta->tipo = 'Comanda';
                $venta->status = 'Pendiente';
                $venta->user_id = auth()->user()->id;
                $venta->mesa_id = $id;
                $venta->cliente_id = 1;
            $venta->save();
        }

        $clientes = Cliente::all();

        if ($mesa->status == 1) {
            $mesa->status = 0;
            $mesa->update();
        }

        return view('comandas.create',compact('mesa','venta','clientes'));
    }

    public function saveData(Request $request, $id){
        $venta = Venta::find($id);
            $venta->subtotal = $request->subtotal;
            $venta->descuento = $request->descuento;
            $venta->total = $request->total;
        $venta->update();
        return 'Exito';
    }

    public function updateCliente(Request $request, $id){
        $venta = Venta::find($id);
            $venta->cliente_id = $request->cliente_id;
        $venta->update();
    }

    public function cancelarVenta($id){
        $venta = Venta::find($id);
        $url = 'pedido';
        if ($venta->tipo == 'Comanda') {
            $url = 'mesas';
            $mesa = Mesa::find($venta->mesa_id);
                $mesa->status = 1;
            $mesa->update();
        }
        $venta->delete();
        return redirect($url);
    }

    public function storeDetail(Request $request){
        $venta = Venta::find($request->venta_id);
        $producto = Producto::find($request->producto_id);
        $productoDetail = DB::table('inventario as i')
                            ->join('detalle_productos as dp','dp.ingrediente_id','=','i.id')
                            ->where([['dp.producto_id','=',$request->producto_id],['i.status','=','Activo']])
                            ->select('i.id','dp.porciones')->get();

        $ings = [];

        foreach ($productoDetail as $value) {
            array_push($ings,intval($value->id));
        }
        
        $dv = new DetalleVenta;
            $dv->venta_id = $venta->id;
            $dv->producto_id = $producto->id;
            $dv->cantidad = 1;
            $dv->precio_total = $producto->precio_venta;
            $dv->ingredientes = json_encode($ings);
        $dv->save();

        $this->mutarInventario($dv->id,'disminuir');
        $newobj = array(
            "id" => $dv->id,
            "producto_id" => $dv->producto_id,
            "name" => $producto->name,
            "cantidad" => $dv->cantidad,
            "precio_venta" => $dv->precio_total,
            "options" => $this->optionsSelected($dv->id),
            "opSelected" => $ings
        );            
        
        return $newobj;
    }

    public function updateCantidad(Request $request, $id){
        $this->mutarInventario($id,'aumentar');
        $detail = DetalleVenta::find($id);
            $detail->cantidad = $request->cantidad;
            $detail->precio_total = $request->precio_total;
        $detail->update();
        $this->mutarInventario($id,'disminuir');
    }

    public function updateIngs(Request $request, $id){
        $this->mutarInventario($id,'aumentar');
        $detail = DetalleVenta::find($id);
            $detail->ingredientes = json_encode($request->ingSelected);
        $detail->update();
        $this->mutarInventario($id,'disminuir');
        $array = array(
            "options" => $this->optionsSelected($id),
            "opSelected" => $request->ingSelected
        );
        return $array;
    }

    public function deleteDetail($id){
        $this->mutarInventario($id,'aumentar');
        DB::select('DELETE FROM detalle_ventas WHERE id = ' . $id);
    }

    public function mutarInventario($id,$tipo){
        $detail = DetalleVenta::find($id);
        $ings = json_decode($detail->ingredientes);

        foreach ($ings as $value) {
            $detailProd = DetalleProducto::where([['producto_id','=',$detail->producto_id],['ingrediente_id','=',$value]])->get();
            $ing = Inventario::find($value);
                if($tipo == 'aumentar'){$ing->porciones += $detailProd[0]->porciones * $detail->cantidad;}
                else{$ing->porciones -= $detailProd[0]->porciones * $detail->cantidad;}
                $ing->cantidad = $ing->porciones / $ing->por_unidad;
            $ing->update();
        }
    }

    public function optionsSelected($id){
        $detail = DetalleVenta::find($id);
        $arrayProd = DB::table('inventario AS i')
                        ->leftJoin('detalle_productos AS dp','dp.ingrediente_id','=','i.id')
                        ->where([['dp.producto_id','=',$detail->producto_id],['i.status','=','Activo']])
                        ->pluck('nombre','i.id');
        $string = '';
        foreach ($arrayProd as $key => $value) {
            $string .= '<option value="'.$key.'" selected>'.$value.'</option>';
        }

        return $string;
    }
}
