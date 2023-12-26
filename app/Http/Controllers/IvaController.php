<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iva;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class IvaController extends Controller
{
   /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        $query = $request->input('descripcion');
        $segment = 'ivas_c';

        $ivas = Iva::when($query, function ($query, $search) {
            return $query->where('descripcion', 'like', "%$search%");
        })->where('empresa_id', Auth::user()->empresa->id)->paginate(5);

        return view('ivas.index', compact('ivas','segment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $segment = 'ivas_c';
        return view('ivas.create', compact('segment'));
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'descripcion' => 'required|max:150',
            'porcentaje' => 'required',
           
        ]);

        $existe = Iva::where('descripcion', $request->input('descripcion'))
        ->where('empresa_id', Auth::user()->empresa->id)
        ->first();

        if ($existe) {
            return back()->with('danger', 'No se puede crear este registro. Ya existe en la base de datos.')->withInput();
        }
       

        $activo = $request->has('activo') ? 1: 0;
    
        //Categoria::create(array_merge($request->all(), ['activo' => $activo, 'empresa_id' => Auth::user()->empresa->id]));

        $iva = Iva::create(array_merge($request->all(), [
            'activo' => $activo,
            'empresa_id' => Auth::user()->empresa->id
        ]));
           
 
        //return redirect()->route('categorias')->with('success', 'Categoria añadida con éxito');
        return redirect()->route('ivas.edit', $iva->id)->with('success', 'IVA añadido con éxito');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $iva = Iva::findOrFail($id);
        $segment = 'ivas_c';
  
        return view('ivas.show', compact('iva','segment'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $iva = Iva::findOrFail($id);

        $segment = 'ivas_c';
  
        return view('ivas.edit', compact('iva','segment'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            'descripcion' => 'required|max:150',
            'porcentaje' => 'required',
        ]);

        $existe = Iva::where('descripcion', $request->input('descripcion'))
        ->where('empresa_id', Auth::user()->empresa->id)
        ->where('id','<>',$id)
        ->first();

        if ($existe) {
            return back()->with('danger', 'No se puede modificar este registro. Ya existe en la base de datos.');
        }
       

        $activo = $request->has('activo') ? 1: 0;

        $iva = Iva::findOrFail($id);
        
        //$Categoria->update($request->all());
        $iva->update(array_merge($request->all(), ['activo' => $activo]));
  
        //return redirect()->route('categorias')->with('success', 'Categoria editada con éxito');
        return redirect()->route('ivas.edit', $iva->id)->with('success', 'IVA editado con éxito');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        /*
        if(Subcategoria::where('categoria_id', $id)->first()) {
            return back()->with('danger', 'No se puede eliminar esta Categoria. Tiene registros asociados.');
        }
        */
        
        $iva = Iva::findOrFail($id);
  
        $iva->delete();
  
        return redirect()->route('ivas')->with('success', 'Iva eliminado con éxito');
    }
}
