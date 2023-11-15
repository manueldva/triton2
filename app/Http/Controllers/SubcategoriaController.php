<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SubcategoriaController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('descripcion');
        $segment = 'subcategorias_c';

        $subcategorias = Subcategoria::when($query, function ($query, $search) {
            return $query->where('descripcion', 'like', "%$search%");
        })->where('empresa_id', Auth::user()->empresa->id)->paginate(5);


        return view('subcategorias.index', compact('subcategorias','segment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $segment = 'subcategorias_c';

        $categorias = Categoria::where('activo', 1)->where('empresa_id', Auth::user()->empresa->id)->pluck('descripcion', 'id');

        return view('subcategorias.create', compact('segment','categorias'));
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'descripcion' => 'required|max:250',
            'categoria_id' => 'required',
           
        ]);

        $existe = Subcategoria::where('descripcion', $request->input('descripcion'))
        ->where('empresa_id', Auth::user()->empresa->id)
        ->where('categoria_id', $request->input('categoria_id'))
        ->first();

        if ($existe) {
            return back()->with('danger', 'No se puede crear esta Sub Categoria. Ya existe en la base de datos.');
        }
       

        $activo = $request->has('activo') ? 1: 0;
    
        Subcategoria::create(array_merge($request->all(), ['activo' => $activo, 'empresa_id' => Auth::user()->empresa->id]));
 
        return redirect()->route('subcategorias')->with('success', 'Sub Categoria añadida con éxito');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        $segment = 'subcategorias_c';
  
        return view('categorias.show', compact('categoria','segment'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subcategoria = Subcategoria::findOrFail($id);

        $categorias = Categoria::where('activo', 1)->where('empresa_id', Auth::user()->empresa->id)->pluck('descripcion', 'id');

        $segment = 'subcategorias_c';
  
        return view('subcategorias.edit', compact('subcategoria','categorias','segment'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            'descripcion' => 'required|max:250',
            'categoria_id' => 'required',
        ]);

        $existe = Subcategoria::where('descripcion', $request->input('descripcion'))
        ->where('empresa_id', Auth::user()->empresa->id)
        ->where('categoria_id', $request->input('categoria_id'))
        ->where('id','<>',$id)
        ->first();

        if ($existe) {
            return back()->with('danger', 'No se puede modificar esta Sub Categoria. Ya existe en la base de datos.');
        }
       


        $activo = $request->has('activo') ? 1: 0;

        $subcategoria = Subcategoria::findOrFail($id);
        
        //$Categoria->update($request->all());
        $subcategoria->update(array_merge($request->all(), ['activo' => $activo]));
  
        return redirect()->route('subcategorias')->with('success', 'Sub Categoria editada con éxito');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        /*if(User::where('categoria_id', $id)->first()) {
            return back()->with('danger', 'No se puede eliminar esta Categoria. Tiene usuarios asociados.');
        }
        */
        $subcategoria = Subcategoria::findOrFail($id);
  
        $subcategoria->delete();
  
        return redirect()->route('subcategorias')->with('success', 'Sub Categoria eliminada con éxito');
    }
}
