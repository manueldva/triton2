<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('descripcion');
        $segment = 'modules_s';

        $modules = Module::when($query, function ($query, $search) {
            return $query->where('descripcion', 'like', "%$search%");
        })->paginate(5);

        $modules->appends(['descripcion' => request('descripcion')]);

        return view('modules.index', compact('modules','segment'));
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

        $existe = Module::where('descripcion', $request->input('descripcion'))
        ->first();

        if ($existe) {
            return back()->with('danger', 'No se puede crear este Modulo. Ya existe en la base de datos.')->withInput();
        }
       

        $activo = $request->has('activo') ? 1: 0;
    
        //Categoria::create(array_merge($request->all(), ['activo' => $activo, 'empresa_id' => Auth::user()->empresa->id]));

        $module = Module::create(array_merge($request->all(), [
            'activo' => $activo
        ]));
           
 
        return back()->with('success', 'Modulo añadido con éxito');
        //return redirect()->route('categorias')->with('success', 'Categoria añadida con éxito');
        //return redirect()->route('categorias.edit', $categoria->id)->with('success', 'Categoria añadida con éxito');
    }
  
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        /*$request->validate([
            'descripcion' => 'required|max:250',
        ]);*/

        $existe = Module::where('descripcion', $request->input('descripcion'))
        ->where('id','<>',$id)
        ->first();

        if ($existe) {
            return back()->with('danger', 'No se puede modificar este tipo de usuario. Ya existe en la base de datos.');
        }
       

        $activo = $request->has('activo') ? 1: 0;

        $module = Module::findOrFail($id);
        
        $module->update(array_merge($request->all(), ['activo' => $activo]));
  
        return back()->with('success', 'Modulo editado con éxito');
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
        
        $module = Module::findOrFail($id);
  
        $module->delete();
  
        return redirect()->route('modules')->with('success', 'Modulo eliminado con éxito');
    }
}
