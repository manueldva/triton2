<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProveedorController extends Controller
{


    public function index(Request $request)
    {
        $query = $request->input('descripcion');
        $segment = 'proveedores_c';

        $proveedores = Proveedor::when($query, function ($query, $search) {
            return $query->where('nombre', 'like', "%$search%");
        })->where('empresa_id', Auth::user()->empresa->id)->paginate(5);

        return view('proveedores.index', compact('proveedores','segment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $segment = 'proveedores_c';
        return view('proveedores.create', compact('segment'));
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'nombre' => 'required|max:250',
           
        ]);

        $existe = Proveedor::where('nombre', $request->input('nombre'))
        ->where('empresa_id', Auth::user()->empresa->id)
        ->first();

        if ($existe) {
            return back()->with('danger', 'No se puede crear esta Proveedor. Ya existe en la base de datos.');
        }
       
        $activo = $request->has('activo') ? 1: 0;
    
        $proveedor = Proveedor::create(array_merge($request->all(), ['activo' => $activo, 'empresa_id' => Auth::user()->empresa->id]));
 
        //return redirect()->route('proveedores')->with('success', 'Proveedor añadido con éxito');
        return redirect()->route('proveedores.edit', $proveedor->id)->with('success', 'Proveedor añadido con éxito');

    }
  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        $segment = 'categorias_c';
  
        return view('categorias.show', compact('categoria','segment'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $proveedor = Proveedor::findOrFail($id);

        $segment = 'cproveedores_c';
  
        return view('proveedores.edit', compact('proveedor','segment'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            'nombre' => 'required|max:250',
        ]);

        $existe = Proveedor::where('nombre', $request->input('nombre'))
        ->where('empresa_id', Auth::user()->empresa->id)
        ->where('id','<>',$id)
        ->first();

        if ($existe) {
            return back()->with('danger', 'No se puede modificar este Proveedor. Ya existe en la base de datos.');
        }
       


        $activo = $request->has('activo') ? 1: 0;

        $proveedor = Proveedor::findOrFail($id);
        
        //$Categoria->update($request->all());
        $proveedor->update(array_merge($request->all(), ['activo' => $activo]));
  
        //return redirect()->route('proveedores')->with('success', 'Proveedor editado con éxito');
        return redirect()->route('proveedores.edit', $proveedor->id)->with('success', 'Proveedor editado con éxito');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        /*if(Subcategoria::where('categoria_id', $id)->first()) {
            return back()->with('danger', 'No se puede eliminar esta Categoria. Tiene usuarios asociados.');
        }*/
        
        $proveedor = Proveedor::findOrFail($id);
  
        $proveedor->delete();
  
        return redirect()->route('proveedores')->with('success', 'Proveedor eliminado con éxito');
    }
}
