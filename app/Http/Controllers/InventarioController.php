<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\InventarioRequest;

use App\Inventario;
use App\Unidad;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:inventario.read')->only('index');
        $this->middleware('permission:inventario.edit')->only(['store','create','edit','update','destroy','reabastecer']);
    }

    public function index()
    {
        $articulos = Inventario::where('status','=','Activo')->orderBy('id','DESC')->get();

        return view('inventario.index',compact('articulos'));
    }

    public function reabastecer()
    {
        return view('inventario.reabastecer');
    }

    public function reabastecerStore(Request $request){
        $ingE = Inventario::find($request->get('ing'));
        $porciones = (intval($request->get('cantidad')) * intval($ingE->por_unidad));
        $ingE->porciones += $porciones;
        $ingE->cantidad += $request->get('cantidad');
        $ingE->update();

        return $ingE;
    }

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidades = Unidad::pluck('name','id');
        return view('inventario.create', compact('unidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InventarioRequest $request)
    {
        $articulo = new Inventario([
            'nombre'    => $request->nombre,
            'tipo'      => $request->tipo,
            'unidad'    => $request->unidad,
            'cantidad'  => $request->cantidad,
            'por_unidad'=> $request->por_unidad,
            'precio_unidad'=> $request->precio_unidad,
            'status'    => 'Activo',
            'stock_min' => $request->stock_min
        ]);

        $articulo->porciones = $articulo->cantidad * $articulo->por_unidad;
        $articulo->precio_porcion = $articulo->precio_unidad / $articulo->por_unidad;
        $articulo->save();

        return redirect('/inventario')->with('status','Registrado correctamente');
        // return $articulo;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articulo = Inventario::find($id);
        $unidades = Unidad::pluck('name','id');

        return view('inventario.edit', compact('articulo','unidades'));
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
        $articulo = Inventario::find($id);

        $articulo->fill([
            'nombre'    => $request->nombre,
            'tipo'      => $request->tipo,
            'unidad'    => $request->unidad,
            'cantidad'  => $request->cantidad,
            'por_unidad'=> $request->por_unidad,
            'precio_unidad'=> $request->precio_unidad,
            'status'    => 'Activo',
            'stock_min' => $request->stock_min
        ]);
            
        $articulo->porciones = $articulo->cantidad * $articulo->por_unidad;
        $articulo->precio_porcion = $articulo->precio_unidad / $articulo->por_unidad;
        $articulo->update();

        return redirect('/inventario')->with('status','Actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articulo = Inventario::find($id);

        $articulo->status = 'Inactivo';
        $articulo->update();

        return redirect('/inventario')->with('status','Eliminado correctamente');
    }
}
