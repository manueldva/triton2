<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /*public function index()
    {
        $segment = 'categorias_c';

        $categorias = Categoria::paginate(5);
  
        return view('categorias.index', compact('categorias','segment'));
    }*/
    

    public function index(Request $request)
    {
        $query = $request->input('descripcion');
        $segment = 'categorias_c';

        $categorias = Categoria::when($query, function ($query, $search) {
            return $query->where('descripcion', 'like', "%$search%");
        })->where('empresa_id', Auth::user()->empresa->id)->paginate(5);

        return view('categorias.index', compact('categorias','segment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $segment = 'categorias_c';
        return view('categorias.create', compact('segment'));
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'descripcion' => 'required|max:250',
           
        ]);

        $existe = Categoria::where('descripcion', $request->input('descripcion'))
        ->where('empresa_id', Auth::user()->empresa->id)
        ->first();

        if ($existe) {
            return back()->with('danger', 'No se puede crear esta Categoria. Ya existe en la base de datos.')->withInput();
        }
       

        $activo = $request->has('activo') ? 1: 0;
    
        //Categoria::create(array_merge($request->all(), ['activo' => $activo, 'empresa_id' => Auth::user()->empresa->id]));

        $categoria = Categoria::create(array_merge($request->all(), [
            'activo' => $activo,
            'empresa_id' => Auth::user()->empresa->id
        ]));
           
 
        return redirect()->route('categorias')->with('success', 'Categoria añadida con éxito');
        //return redirect()->route('categorias.edit', $categoria->id)->with('success', 'Categoria añadida con éxito');
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
        $categoria = Categoria::findOrFail($id);

        $segment = 'categorias_c';
  
        return view('categorias.edit', compact('categoria','segment'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            'descripcion' => 'required|max:250',
        ]);

        $existe = Categoria::where('descripcion', $request->input('descripcion'))
        ->where('empresa_id', Auth::user()->empresa->id)
        ->where('id','<>',$id)
        ->first();

        if ($existe) {
            return back()->with('danger', 'No se puede modificar esta Categoria. Ya existe en la base de datos.');
        }
       

        $activo = $request->has('activo') ? 1: 0;

        $categoria = Categoria::findOrFail($id);
        
        //$Categoria->update($request->all());
        $categoria->update(array_merge($request->all(), ['activo' => $activo]));
  
        return redirect()->route('categorias')->with('success', 'Categoria editada con éxito');
        //return redirect()->route('categorias.edit', $categoria->id)->with('success', 'Categoria editada con éxito');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //dd($id);
        if(Subcategoria::where('categoria_id', $id)->first()) {
            return back()->with('danger', 'No se puede eliminar esta Categoria. Tiene registros asociados.');
        }
        
        $categoria = Categoria::findOrFail($id);
  
        $categoria->delete();
  
        return redirect()->route('categorias')->with('success', 'Categoria eliminada con éxito');
    }

}
