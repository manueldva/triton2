<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipoproducto;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TipoproductoController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('descripcion');
        $segment = 'tipoproductos_c';

        $tipoproductos = Tipoproducto::when($query, function ($query, $search) {
            return $query->where('descripcion', 'like', "%$search%");
        })->where('empresa_id', Auth::user()->empresa->id)->paginate(5);

        return view('tipoproductos.index', compact('tipoproductos','segment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $segment = 'tipoproductos_c';
        return view('tipoproductos.create', compact('segment'));
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'descripcion' => 'required|max:250',
           
        ]);

        $existe = Tipoproducto::where('descripcion', $request->input('descripcion'))
        ->where('empresa_id', Auth::user()->empresa->id)
        ->first();

        if ($existe) {
            return back()->with('danger', 'No se puede crear esta tipo de producto. Ya existe en la base de datos.')->withInput();
        }
       

        $activo = $request->has('activo') ? 1: 0;
    
        //Tipoproducto::create(array_merge($request->all(), ['activo' => $activo, 'empresa_id' => Auth::user()->empresa->id]));

        $tipoproducto = Tipoproducto::create(array_merge($request->all(), [
            'activo' => $activo,
            'empresa_id' => Auth::user()->empresa->id
        ]));
           
 
        //return redirect()->route('Tipoproductos')->with('success', 'Tipoproducto añadida con éxito');
        return redirect()->route('tipoproductos.edit', $tipoproducto->id)->with('success', 'tipo de producto añadida con éxito');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Tipoproducto = Tipoproducto::findOrFail($id);
        $segment = 'tipoproductos_c';
  
        return view('tipoproductos.show', compact('tipoproducto','segment'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tipoproducto = Tipoproducto::findOrFail($id);

        $segment = 'tipoproductos_c';
  
        return view('tipoproductos.edit', compact('tipoproducto','segment'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            'descripcion' => 'required|max:250',
        ]);

        $existe = Tipoproducto::where('descripcion', $request->input('descripcion'))
        ->where('empresa_id', Auth::user()->empresa->id)
        ->where('id','<>',$id)
        ->first();

        if ($existe) {
            return back()->with('danger', 'No se puede modificar esta tipo de producto. Ya existe en la base de datos.');
        }
       

        $activo = $request->has('activo') ? 1: 0;

        $tipoproducto = Tipoproducto::findOrFail($id);
        
        //$Tipoproducto->update($request->all());
        $tipoproducto->update(array_merge($request->all(), ['activo' => $activo]));
  
        //return redirect()->route('Tipoproductos')->with('success', 'Tipoproducto editada con éxito');
        return redirect()->route('tipoproductos.edit', $tipoproducto->id)->with('success', 'tipo de producto editada con éxito');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        /*
        if(SubTipoproducto::where('Tipoproducto_id', $id)->first()) {
            return back()->with('danger', 'No se puede eliminar esta Tipoproducto. Tiene registros asociados.');
        }
        */
        
        $tipoproducto = Tipoproducto::findOrFail($id);
  
        $tipoproducto->delete();
  
        return redirect()->route('tipoproductos')->with('success', 'tipo de producto eliminada con éxito');
    }
}
