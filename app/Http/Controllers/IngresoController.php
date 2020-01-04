<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingreso;
use App\Empresa;
use DB;

class IngresoController extends Controller
{
    public function index(){
        $ingresos = DB::table('ingresos AS i')
                    ->join('users AS u','u.id','=','i.user_id')
                    ->select('i.*','u.name')->get();
        $empresa = Empresa::find(1);
        return view('ingresos.index',compact('ingresos','empresa'));
    }

    public function store(Request $request){
        $datos[0] = auth()->user()->name;
        $ingreso = Ingreso::create([
            'monto' => $request->monto,
            'descripcion' => $request->descripcion,
            'user_id' => auth()->user()->id
        ]);
        $datos[1] = $ingreso;
        $empresa = Empresa::find(1);
        $empresa->ingresos += $ingreso->monto;
        $empresa->caja_extra += $ingreso->monto;
        $empresa->update();
        $datos[2] = $empresa;

        return $datos;
    }

    public function update(Request $request, $id){
        $ingreso = Ingreso::find($id);
        $empresa = Empresa::find(1);
        $empresa->ingresos -= $ingreso->monto;
        $empresa->caja_extra -= $ingreso->monto;
        $empresa->update();
        $ingreso->fill([
            'monto' => $request->monto,
            'descripcion' => $request->descripcion
        ])->update();
        $empresa->ingresos += $ingreso->monto;
        $empresa->caja_extra += $ingreso->monto;
        $empresa->update();
        return $empresa;
    }

    public function destroy($id){
        $ingreso = Ingreso::find($id);
        $empresa = Empresa::find(1);
        $empresa->ingresos -= $ingreso->monto;
        $empresa->caja_extra -= $ingreso->monto;
        $empresa->update();
        $ingreso->delete();
        return $empresa;
    }
}
