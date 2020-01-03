<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grupo;
class CheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupos = Grupo::all();

        return view('checks.index',compact('grupos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = ['CreateUsers','ReadUsers','UpdateUsers','DeleteUsers'];
        $clientes = ['CreateClients','ReadClients','UpdateClients','DeleteClients'];
        $ventas = ['CreateSales','ReadSales','UpdateSales','DeleteSales'];
        
        return view('checks.create',compact('users','clientes','ventas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $grupo = new Grupo();
        $grupo->name = $request->get('name');
        $grupo->permisos = json_encode($request->get('permisos'));
        $grupo->save();

        return redirect('checkbox');
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
        $grupo = Grupo::find($id);
        $gruposSelected = json_decode($grupo->permisos);
        $users = ['CreateUsers','ReadUsers','UpdateUsers','DeleteUsers'];
        $clientes = ['CreateClients','ReadClients','UpdateClients','DeleteClients'];
        $ventas = ['CreateSales','ReadSales','UpdateSales','DeleteSales'];
        
        return view('checks.edit',compact('users','clientes','ventas','grupo','gruposSelected'));
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
        $grupo = Grupo::find($id);
        $grupo->name = $request->get('name');
        $grupo->permisos = json_encode($request->get('permisos'));
        $grupo->update();

        return redirect('checkbox');
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
