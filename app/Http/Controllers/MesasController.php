<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mesa;

class MesasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:comandas.read')->only(['index','flimpiarMesa']);
        $this->middleware('permission:comandas.edit')->only(['store','create','edit','update','destroy']);
    }
    public function index()
    {
        $mesas = Mesa::where('status','!=','3')->get();
        return view('mesas.index', compact('mesas'));
    }

    public function indexMesas(){
        $mesas = Mesa::where('status','=','1')->get();
        return view('mesas.gestionar', compact('mesas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mesas.forms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mesa = Mesa::create($request->all());
        $mesa->save();

        return redirect('/mesas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($mesa)
    {
        $categorias = \App\Categoria::pluck('name','id');
        return view('comandas.create', compact('mesa','categorias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mesa = Mesa::find($id);
        return view('mesas.edit', compact('mesa'));
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
        $mesa = Mesa::find($id);
        $mesa->fill($request->all());
        $mesa->update();

        return 'Actualizado correctamente';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mesa = Mesa::find($id);
        $mesa->status = 3;
        $mesa->update();

        return 'Eliminado correctamente';
    }

    public function flimpiarMesa($id)
    {
        $mesa = Mesa::find($id);
        $mesa->status = 1;
        $mesa->update();

        return 0;
    }
}
