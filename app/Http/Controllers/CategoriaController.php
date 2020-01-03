<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categoria;
use DB;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:productos.read')->only(['index','show']);
        $this->middleware('permission:productos.edit')->only(['edit','update','store','destroy']);
    }

    public function index()
    {
        return view('categoria.index',['categorias'=>Categoria::orderBy('id','DESC')->get()]);
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
        $filename = "default.jpg";

        if ($request->hasFile('imagen')) {

            $file = $request->file('imagen');
            $extension = $request->file('imagen')->getClientOriginalExtension();
            $filename = $request->get('name') . '.' . $extension;
            $file->storeAs('public/categorias',$filename);
        }

        $categoria = new Categoria;
        $categoria->name = $request->get('name');
        $categoria->url = $filename;
        $categoria->save();

        return redirect('categoria');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat = Categoria::find($id);
        $categorias = Categoria::pluck('name','id');
        $subcategorias = DB::table('categorias as c')
                            ->join('subcategorias as s','s.categoria_id','=','c.id')
                            ->where('c.id','=',$id)
                            ->select('s.*')
                            ->get();

        return view('categoria.show',compact('cat','categorias','subcategorias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categoria::find($id);
        return view('categoria.edit', compact('categoria'));
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
        $categoria = Categoria::find($id);

        if ($request->hasFile('imagen')) {

            if (\Storage::exists('public/categorias/'.$categoria->url)) {
                \Storage::delete('public/categorias/'.$categoria->url);
            }

            $file = $request->file('imagen');
            $extension = $request->file('imagen')->getClientOriginalExtension();
            $filename = $request->get('name') . '.' . $extension;
            $file->storeAs('public/categorias',$filename);
            $categoria->url = $filename;
        }

        $categoria->name = $request->get('name');
        $categoria->update();

        return redirect('categoria');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();

        if ($categoria->url != "default.jpg") {
            \Storage::delete('public/categorias/'.$categoria->url);
        }

        return redirect('/categoria');
    }
}
