<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipomembresia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TipomembresiaController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('descripcion');
        $segment = 'tipomembresias_c';

        $tipomembresias = Tipomembresia::when($query, function ($query, $search) {
            return $query->where('descripcion', 'like', "%$search%");
        })->where('empresa_id', Auth::user()->empresa->id)->paginate(5);

        $tipomembresias->appends(['descripcion' => request('descripcion')]);

        return view('tipomembresias.index', compact('tipomembresias','segment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $segment = 'tipomembresias_c';
        return view('tipomembresias.create', compact('segment'));
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        /*
        $request->validate([
            'descripcion' => 'required|max:250',
           
        ]);*/

        $existe = Tipomembresia::where('descripcion', $request->input('descripcion'))
        ->where('empresa_id', Auth::user()->empresa->id)
        ->first();

        if ($existe) {
            return back()->with('danger', 'No se puede crear este tipo de membresia. Ya existe en la base de datos.')->withInput();
        }
       

        $activo = $request->has('activo') ? 1: 0;
    
        //Categoria::create(array_merge($request->all(), ['activo' => $activo, 'empresa_id' => Auth::user()->empresa->id]));

        $tipomembresia = Tipomembresia::create(array_merge($request->all(), [
            'activo' => $activo,
            'empresa_id' => Auth::user()->empresa->id
        ]));
           
 
        return back()->with('success', 'Tipo de membresia añadido con éxito');
        //return redirect()->route('categorias')->with('success', 'Categoria añadida con éxito');
        //return redirect()->route('categorias.edit', $categoria->id)->with('success', 'Categoria añadida con éxito');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tipomembresia = Tipomembresia::findOrFail($id);
        $segment = 'tipomembresias_c';
  
        return view('tipomembresias.show', compact('tipomembresia','segment'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tipomembresia = Tipomembresia::findOrFail($id);

        $segment = 'tipomembresias_c';
  
        return view('tipomembresias.edit', compact('tipomembresia','segment'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        /*$request->validate([
            'descripcion' => 'required|max:250',
        ]);*/

        $existe = Tipomembresia::where('descripcion', $request->input('descripcion'))
        ->where('empresa_id', Auth::user()->empresa->id)
        ->where('id','<>',$id)
        ->first();

        if ($existe) {
            return back()->with('danger', 'No se puede modificar este tipo de membresia. Ya existe en la base de datos.');
        }
       

        $activo = $request->has('activo') ? 1: 0;

        $tipomembresia = Tipomembresia::findOrFail($id);
        
        //$Categoria->update($request->all());
        $tipomembresia->update(array_merge($request->all(), ['activo' => $activo]));
  
        return back()->with('success', 'Tipo de membresia editado con éxito');
        //return redirect()->route('categorias')->with('success', 'Categoria editada con éxito');
        //return redirect()->route('categorias.edit', $categoria->id)->with('success', 'Categoria editada con éxito');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //dd($id);
        /*if(User::where('tipomembresia_id', $id)->first()) {
            return back()->with('danger', 'No se puede eliminar este tipo de membresia. Tiene registros asociados.');
        }*/
        
        $tipomembresia = Tipomembresia::findOrFail($id);
  
        $tipomembresia->delete();
  
        return redirect()->route('tipomembresias')->with('success', 'Tipo de membresia eliminado con éxito');
    }


     /**
     * Show the form for editing the specified resource.
     */
   
}
