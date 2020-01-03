<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unidad;

class UnidadesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:inventario.read')->only('index');
        $this->middleware('permission:inventario.edit')->only(['store','update','destroy']);
    }

    public function index()
    {
        return view('unidades.index');
    }

    public function getUnidades()
    {
        return Unidad::orderBy('id','DESC')->get();
    }

    public function store(Request $request)
    {
        $unidad = Unidad::create($request->all());
        $unidad->save();

        return $unidad;
    }

    public function update(Request $request, $id)
    {
        $unidad = Unidad::find($id);
        $unidad->fill($request->all());
        $unidad->update();

        return $unidad;
    }

    public function destroy($id)
    {
        $unidad = Unidad::find($id);
        $unidad->delete();

        return "Elemento eliminado.";
    }
}
