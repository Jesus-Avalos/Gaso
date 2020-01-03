<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gasto;
use App\Empresa;
use DB;

class GastoController extends Controller
{
    public function index(){
        $gastos = DB::table('gastos AS g')
                    ->join('users AS u','u.id','=','g.user_id')
                    ->select('g.*','u.name')->get();
        $empresa = Empresa::find(1);
        return view('gastos.index',compact('gastos','empresa'));
    }

    public function store(Request $request){
        $datos[0] = auth()->user()->name;
        $gasto = Gasto::create([
            'monto' => $request->monto,
            'descripcion' => $request->descripcion,
            'user_id' => auth()->user()->id
        ]);
        $datos[1] = $gasto;
        $empresa = Empresa::find(1);
        $empresa->egresos += $gasto->monto;
        $empresa->caja_extra -= $gasto->monto;
        $empresa->update();
        $datos[2] = $empresa;

        return $datos;
    }

    public function update(Request $request, $id){
        $gasto = Gasto::find($id);
        $empresa = Empresa::find(1);
        $empresa->egresos -= $gasto->monto;
        $empresa->caja_extra += $gasto->monto;
        $empresa->update();
        $gasto->fill([
            'monto' => $request->monto,
            'descripcion' => $request->descripcion
        ])->update();
        $empresa->egresos += $gasto->monto;
        $empresa->caja_extra -= $gasto->monto;
        $empresa->update();
        return 'Actualizado';
    }

    public function destroy($id){
        $gasto = Gasto::find($id);
        $empresa = Empresa::find(1);
        $empresa->egresos -= $gasto->monto;
        $empresa->caja_extra += $gasto->monto;
        $empresa->update();
        $gasto->delete();
        return 'Eliminado';
    }
}
