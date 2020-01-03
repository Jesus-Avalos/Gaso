<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proovedor;
use App\Inventario;
use App\Compra;
use App\Empresa;
use App\DetalleCompra;
use DB;

class CompraController extends Controller
{
    public function index()
    {
        $compras = DB::table('compras as c')
                        ->join('proovedores as p','p.id','=','c.proovedor_id')
                        ->select('c.*','p.nombre')->get();
        return view('compras.index',compact('compras'));
        // return $compras;
    }

    public function exitosas(){
        $compras = DB::table('compras as c')
                        ->where('c.status','=','Exitosa')
                        ->join('proovedores as p','p.id','=','c.proovedor_id')
                        ->select('c.*','p.nombre')->get();
        return view('compras.index',compact('compras'));
    }

    public function canceladas(){
        $compras = DB::table('compras as c')
                        ->where('c.status','=','Cancelada')
                        ->join('proovedores as p','p.id','=','c.proovedor_id')
                        ->select('c.*','p.nombre')->get();
        return view('compras.index',compact('compras'));
    }

    public function create()
    {
        $proovedores = Proovedor::select('nombre','id')->get();
        $inventario = Inventario::select('nombre','id')->get();
        
        return view('compras.create',compact('proovedores','inventario'));
    }
    public function getIng($id)
    {
        $ing = Inventario::find($id);
        return $ing;
    }

    public function store(Request $request){
        try {
            DB::beginTransaction();
                $compra = new Compra;
                $compra->total = $request->total;
                $compra->status = 'Exitosa';
                $compra->user_id = auth()->user()->id;
                $empresa = Empresa::find(1);
                $empresa->egresos += $compra->total;
                $empresa->update();
                $proovedor = Proovedor::find($request->proovedor_id);
                $proovedor->compras()->save($compra);

                $cantidad = $request->get('cantidad');
                $ingredientes = $request->get('inventario_id');
                $subtotal = $request->get('subtotal');
                $precios = $request->get('precio_unidad');
                
                for ($i=0; $i < count($ingredientes); $i++) { 
                    $detalle = new DetalleCompra;
                    $detalle->compra_id = $compra->id;
                    $detalle->inventario_id = $ingredientes[$i];
                    $detalle->subtotal = $subtotal[$i];
                    $detalle->cantidad = $cantidad[$i];
                    $detalle->save();

                    $ing = Inventario::find($ingredientes[$i]);
                    $ing->precio_unidad = $precios[$i];
                    $porciones = doubleval($cantidad[$i]) * doubleval($ing->por_unidad);
                    $ing->porciones += $porciones;
                    $ing->cantidad = $ing->porciones / $ing->por_unidad;
                    $ing->update();
                }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect('compra')->with('status','Creada correctamente');
    }

    public function show($id)
    {
        try {
            DB::beginTransaction();
            $compra = DB::table('compras AS c')
                        ->join('users AS u','u.id','=','c.user_id')
                        ->where('c.id','=',$id)
                        ->select('c.*','u.name')->get();
            $compra = $compra[0];
            $proovedor = Proovedor::find($compra->proovedor_id);
            $articulos = DB::table('compra_inventario as ci')
                                ->join('inventario as i','i.id','=','ci.inventario_id')
                                ->where('ci.compra_id','=',$compra->id)
                                ->select('ci.*','i.nombre','i.precio_unidad')->get();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        
        return view('compras.show',compact('compra','proovedor','articulos'));
    }

    public function destroy($id){
        try {
            DB::beginTransaction();
                $detalle = DetalleCompra::where('compra_id','=',$id)->get();
                for ($i=0; $i < count($detalle); $i++) { 
                    $ing = Inventario::find($detalle[$i]->inventario_id);
                    $porciones = doubleval($detalle[$i]->cantidad) * doubleval($ing->por_unidad);
                    $ing->porciones -= $porciones;
                    $ing->cantidad = $ing->porciones / $ing->por_unidad;
                    $ing->update();
                }
                $compra = Compra::find($id);
                $empresa = Empresa::find(1);
                $empresa->egresos += $compra->total;
                $compra->status = 'Cancelada';
                $compra->update();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return redirect('compra')->with('status','Cancelada correctamente');
    }
}
