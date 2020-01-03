<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proovedor;

class ProovedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proovedores = Proovedor::all();

        return view('proovedor.index',compact('proovedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proovedor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proovedor = Proovedor::create($request->all())->save();

        return redirect('proovedor')->with('status','Creado correctamente');
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
        $proovedor = Proovedor::find($id);

        return view('proovedor.edit',compact('proovedor'));
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
        $proovedor = Proovedor::find($id);
        $proovedor->fill($request->all());
        $proovedor->update();

        return redirect('proovedor')->with('status','Actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proovedor = Proovedor::where('id','=',$id)->delete();

        return redirect('proovedor')->with('status','Eliminado correctamente');
    }
}
