<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipouser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TipouserController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('descripcion');
        $segment = 'tipousers_s';

        $tipousers = Tipouser::when($query, function ($query, $search) {
            return $query->where('descripcion', 'like', "%$search%");
        })->where('empresa_id', Auth::user()->empresa->id)->paginate(5);

        $tipousers->appends(['descripcion' => request('descripcion')]);

        return view('tipousers.index', compact('tipousers','segment'));
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
        
        /*
        $request->validate([
            'descripcion' => 'required|max:250',
           
        ]);*/

        $existe = Tipouser::where('descripcion', $request->input('descripcion'))
        ->where('empresa_id', Auth::user()->empresa->id)
        ->first();

        if ($existe) {
            return back()->with('danger', 'No se puede crear este tipo de usuario. Ya existe en la base de datos.')->withInput();
        }
       

        $activo = $request->has('activo') ? 1: 0;
    
        //Categoria::create(array_merge($request->all(), ['activo' => $activo, 'empresa_id' => Auth::user()->empresa->id]));

        $tipouser = Tipouser::create(array_merge($request->all(), [
            'activo' => $activo,
            'empresa_id' => Auth::user()->empresa->id
        ]));
           
 
        return back()->with('success', 'Tipo de usuario añadido con éxito');
        //return redirect()->route('categorias')->with('success', 'Categoria añadida con éxito');
        //return redirect()->route('categorias.edit', $categoria->id)->with('success', 'Categoria añadida con éxito');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tipouser = Tipouser::findOrFail($id);
        $segment = 'categorias_c';
  
        return view('tipousers.show', compact('tipouser','segment'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tipouser = Tipouser::findOrFail($id);

        $segment = 'tipousers_c';
  
        return view('tipousers.edit', compact('tipouser','segment'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        /*$request->validate([
            'descripcion' => 'required|max:250',
        ]);*/

        $existe = Tipouser::where('descripcion', $request->input('descripcion'))
        ->where('empresa_id', Auth::user()->empresa->id)
        ->where('id','<>',$id)
        ->first();

        if ($existe) {
            return back()->with('danger', 'No se puede modificar este tipo de usuario. Ya existe en la base de datos.');
        }
       

        $activo = $request->has('activo') ? 1: 0;

        $tipouser = Tipouser::findOrFail($id);
        
        //$Categoria->update($request->all());
        $tipouser->update(array_merge($request->all(), ['activo' => $activo]));
  
        return back()->with('success', 'Tipo de usuario editado con éxito');
        //return redirect()->route('categorias')->with('success', 'Categoria editada con éxito');
        //return redirect()->route('categorias.edit', $categoria->id)->with('success', 'Categoria editada con éxito');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //dd($id);
        /*if(Subcategoria::where('categoria_id', $id)->first()) {
            return back()->with('danger', 'No se puede eliminar esta Categoria. Tiene registros asociados.');
        }*/
        
        $tipouser = Tipouser::findOrFail($id);
  
        $tipouser->delete();
  
        return redirect()->route('tipousers')->with('success', 'Tipo de usuario eliminado con éxito');
    }


     /**
     * Show the form for editing the specified resource.
     */
    public function permiso(string $id)
    {
        $tipouser = Tipouser::findOrFail($id);

        $segment = 'tipousers_s';
  
        return view('tipousers.permiso', compact('tipouser','segment'));
    }
}
