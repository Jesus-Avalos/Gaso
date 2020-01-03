<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Caffeinated\Shinobi\Models\Role;
use App\Grupo;
use App\User;
use Hash;
use DB;
use Validator;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:avanzado.read')->only(['index']);
        $this->middleware('permission:avanzado.edit')->only(['store','create','edit','update']);
    }

    public function index()
    {
        $users = User::where('id','!=',1)->orderBy('id','DESC')->get();

        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));

        $filename = "default-user.png";

        if ($request->hasFile('imagen')) {

            $file = $request->file('imagen');
            $extension = $request->file('imagen')->getClientOriginalExtension();
            $filename = $request->get('name') . '.' . $extension;
            $file->storeAs('public/users',$filename);
        }            
        $user->url = $filename;

        $user->save();
        $user->roles()->sync($request->get('roles'));

        return redirect('user')->with('status', 'Usuario creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();

        return view('users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        if (Hash::check($request->password, Auth::user()->password)){
            $user = User::find($id);

            $user->name = $request->get('name');
            $user->email = $request->get('email');
            if ($request->hasFile('imagen')) {

                if (\Storage::exists('public/users/'.$user->url)) {
                    \Storage::delete('public/users/'.$user->url);
                }
    
                $file = $request->file('imagen');
                $extension = $request->file('imagen')->getClientOriginalExtension();
                $filename = $request->get('name') . '.' . $extension;
                $file->storeAs('public/users',$filename);
                $user->url = $filename;
            }
            
            $user->update();
            $user->roles()->sync($request->get('roles'));

            return redirect('user')->with('status', 'Actualizado con éxito');
        }
        else
        {
            return redirect('user/'.$id.'/edit')->with('message', 'Password Incorrecto');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('user')->with('message','Eliminado correctamente!');
    }
}
