<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categoria;
use App\Subcategoria;

use DB;

class SubcategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:productos.read')->only('index');
        $this->middleware('permission:productos.edit')->only(['edit','update','store','destroy']);
    }

    public function index()
    {
        $categorias = Categoria::pluck('name','id');

        $subcategorias = DB::table('subcategorias')
                        ->join('categorias','categorias.id','=','subcategorias.categoria_id')
                        ->select('subcategorias.*','categorias.name AS categoria')
                        ->orderBy('subcategorias.id','DESC')
                        ->get()->toArray();

        return view('subcategoria.index', compact('categorias','subcategorias'));
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
        $sub = new Subcategoria;

        $sub->name = $request->get('name');

        $filename = "default.jpg";

        if ($request->hasFile('imagen')) {
          $file = $request->file('imagen');
          $extension = $file->getClientOriginalExtension();
          $filename = $request->get('name') . '.' . $extension;
          $file->storeAs('public/subcategorias/', $filename);
        }

        $sub->url = $filename;
        $sub->categoria_id = $request->get('categoria_id');
        $sub->save();

        return redirect()->back();
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
        $categorias = Categoria::pluck('name','id');
        $sub = Subcategoria::find($id);

        return view('subcategoria.edit',compact('sub','categorias'));
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
      $sub = Subcategoria::find($id);

      if ($request->hasFile('imagen')) {

          if (\Storage::exists('public/subcategorias/'.$sub->url)) {
              \Storage::delete('public/subcategorias/'.$sub->url);
          }

          $file = $request->file('imagen');
          $extension = $request->file('imagen')->getClientOriginalExtension();
          $filename = $request->get('name') . '.' . $extension;
          $file->storeAs('public/subcategorias',$filename);
          $sub->url = $filename;
      }

      $sub->name = $request->get('name');
      $sub->categoria_id = $request->get('categoria_id');
      $sub->update();

      return redirect('subcategoria');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub = Subcategoria::find($id);
        $sub->delete();

        if ($sub->url != "default.jpg") {
            \Storage::delete('public/subcategorias/'.$sub->url);
        }

        return redirect('subcategoria');
    }
}
