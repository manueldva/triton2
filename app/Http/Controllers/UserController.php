<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Empresa;
use App\Models\Tipouser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('descripcion');
        $segment = 'users_s';

        //$users = User::where('empresa_id',Auth::user()->empresa->id)->paginate(5);

        $users = User::when($query, function ($query, $search) {
            return $query->where('name', 'like', "%$search%");
        })->where('empresa_id', Auth::user()->empresa->id)->paginate(5);

        $users->appends(['descripcion' => request('descripcion')]);
  
        return view('users.index', compact('users','segment'));
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $segment = 'users_s';
        $empresas = Empresa::where('activo', 1)->pluck('descripcion', 'id');
        $tipousers = Tipouser::where('activo', 1)->where('empresa_id', Auth::user()->empresa->id)->pluck('descripcion', 'id');
        //dd($empresas);
  
        return view('users.create', compact('segment','empresas','tipousers'));
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
            'photo' => 'image|nullable|max:1999'
        ]);


        $nombreArchivo = null;
        $nombreArchivoParaGuardar = null;
        if ($request->hasFile('photo')) {
            // Obtener el nombre original del archivo con su extensión
            $nombreConExtension = $request->file('photo')->getClientOriginalName();
            // Obtener solo el nombre del archivo sin la extensión
            $nombreArchivo = pathinfo($nombreConExtension, PATHINFO_FILENAME);
            // Obtener solo la extensión del archivo
            $extensionArchivo = $request->file('photo')->getClientOriginalExtension();
            // Concatenar el nombre del archivo con la extensión
            $nombreArchivoParaGuardar = $nombreArchivo . '.' . $extensionArchivo;
            // Guardar el archivo en el disco especificado y con el nombre proporcionado
            $request->file('photo')->storeAs('public/photos', $nombreArchivoParaGuardar);
        }

        $activo = $request->has('activo') ? 1 : 0;


        // Crear el usuario con todos los datos, incluyendo el nombre de la foto
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'empresa_id' => $request->empresa_id,
            'tipouser_id' => $request->tipouser_id,
            'password' => Hash::make($request->password),
            'activo' => $activo,
            'photo' => $nombreArchivoParaGuardar // Guardar solo el nombre del archivo
        ]);

        return redirect()->route('users')->with('success', 'Usuario añadido con éxito');
    }


  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $empresa = Empresa::findOrFail($id);
        $segment = 'users_s';
  
        return view('users.show', compact('empresa','segment'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $segment = 'users_s';
        
        $user = User::findOrFail($id);
        $empresas = Empresa::where('activo', 1)->pluck('descripcion', 'id');
        $tipousers = Tipouser::where('activo', 1)->where('empresa_id', Auth::user()->empresa->id)->pluck('descripcion', 'id');
  
        return view('users.edit', compact('empresas','tipousers', 'user','segment'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'email'     => 'required|email|max:255|unique:users,email,' . $id,
            'name'      => 'required|max:255',
            'empresa_id'=> 'required',
            'photo'     => 'image|nullable|max:1999',
        ]);

        $activo = $request->has('activo') ? 1 : 0;

        $updates = [
            'name' => $request->name,
            'email' => $request->email,
            'empresa_id' => $request->empresa_id,
            'tipouser_id' => $request->tipouser_id,
            'activo' => $activo,
        ];

        if ($request->has('password') && !empty($request->password)) {
            $updates['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
            // Eliminar la foto antigua si existe
            if ($user->photo && Storage::exists('public/photos/' . $user->photo)) {
                Storage::delete('public/photos/' . $user->photo);
            }

            // Guardar la nueva foto y actualizar el nombre del archivo
            $nombreConExtension = $request->file('photo')->getClientOriginalName();
            $nombreArchivo = pathinfo($nombreConExtension, PATHINFO_FILENAME);
            $extensionArchivo = $request->file('photo')->getClientOriginalExtension();
            $nombreArchivoParaGuardar = $nombreArchivo . '_' . time() . '.' . $extensionArchivo;
            $request->file('photo')->storeAs('public/photos', $nombreArchivoParaGuardar);
            $updates['photo'] = $nombreArchivoParaGuardar;
        } elseif (!$request->hasFile('photo') && $user->photo) {
            // Mantener la foto actual si no se sube una nueva
            $updates['photo'] = $user->photo;
        }

        $user->update($updates);

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
