<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $segment = 'users';

        $users = User::where('empresa_id',Auth::user()->empresa->id)->paginate(5);
  
        return view('users.index', compact('users','segment'));
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $segment = 'users';
        $empresas = Empresa::where('activo', 1)->pluck('descripcion', 'id');
        //dd($empresas);
  
        return view('users.create', compact('segment','empresas'));
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email'     => 'required|email|unique:users,email|max:255',
            'name'      => 'required|max:255',
            'password'  => 'required|max:255',
            'empresa_id'=> 'required',
        ]);

        $activo = $request->has('activo') ? 1: 0;
        //$admin = $request->has('admin') ? 1: 0;

        //User::create(array_merge($request->all(), ['activo' => $activo]));
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'empresa_id' => $request->empresa_id,
            'password' => Hash::make($request->password),
            'activo' => $activo
        ]);
 
        return redirect()->route('users')->with('success', 'Usuario añadido con éxito');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $empresa = Empresa::findOrFail($id);
        $segment = 'users';
  
        return view('users.show', compact('empresa','segment'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $segment = 'users';
        
        $user = User::findOrFail($id);
        $empresas = Empresa::where('activo', 1)->pluck('descripcion', 'id');
  
        return view('users.edit', compact('empresas', 'user','segment'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        

        $request->validate([
            'email'     => 'required|email|max:255|unique:users,email,' . $id,
            'name'      => 'required|max:255',
            'empresa_id'=> 'required',
        ]);

        $activo = $request->has('activo') ? 1: 0;

        $user = User::findOrFail($id);
        
        $updates = [
            'name' => $request->name,
            'email' => $request->email,
            'empresa_id' => $request->empresa_id,
            'activo' => $activo,
        ];
        
        if ($request->has('password') && !empty($request->password)) {
            $updates['password'] = Hash::make($request->password);
        }
        
        $user->update($updates);

        //$empresa->update($request->all());
  
        return redirect()->route('users')->with('success', 'Usuario editado con éxito');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        if(Auth::user()->id == $id) {
            return back()->with('danger', 'No puedes eliminar tu propio usuario.');
        }
        

        $user = User::findOrFail($id);
  
        $user->delete();
  
        return redirect()->route('users')->with('success', 'Usuario eliminado con éxito');
    }


    public function updateEmpresa(Request $request)
    {
        $user = Auth::user();
        $user->empresa_id = $request->allempresa_id;
        $user->save();

        return redirect()->back();
    }

}
