<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipocontacto;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TipocontactoController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('descripcion');
        $segment = 'tipocontactos_c';

        $tipocontactos = Tipocontacto::when($query, function ($query, $search) {
            return $query->where('descripcion', 'like', "%$search%");
        })->where('empresa_id', Auth::user()->empresa->id)->paginate(5);

        $tipocontactos->appends(['descripcion' => request('descripcion')]);

        return view('tipocontactos.index', compact('tipocontactos','segment'));
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

        $existe = Tipocontacto::where('descripcion', $request->input('descripcion'))
        ->where('empresa_id', Auth::user()->empresa->id)
        ->first();

        if ($existe) {
            return back()->with('danger', 'No se puede crear este tipo de contacto. Ya existe en la base de datos.')->withInput();
        }
       

        $activo = $request->has('activo') ? 1: 0;
    
        $tipocontacto = Tipocontacto::create(array_merge($request->all(), [
            'activo' => $activo,
            'empresa_id' => Auth::user()->empresa->id
        ]));
           
 
        return back()->with('success', 'Tipo de contacto añadida con éxito');
    }


    public function update(Request $request, string $id)
    {
        $existe = Tipocontacto::where('descripcion', $request->input('descripcion'))
        ->where('empresa_id', Auth::user()->empresa->id)
        ->where('id','<>',$id)
        ->first();

        if ($existe) {
            return back()->with('danger', 'No se puede modificar este tipo de contacto. Ya existe en la base de datos.');
        }
       

        $activo = $request->has('activo') ? 1: 0;

        $tipocontacto = Tipocontacto::findOrFail($id);
        
        //$Categoria->update($request->all());
        $tipocontacto->update(array_merge($request->all(), ['activo' => $activo]));
  
        return back()->with('success', 'Tipocontacto editado con éxito');

    }


    public function destroy(string $id)
    {
        //dd($id);
       /* if(Subcategoria::where('categoria_id', $id)->first()) {
            return back()->with('danger', 'No se puede eliminar esta Categoria. Tiene registros asociados.');
        }*/
        
        $tipocontacto = Tipocontacto::findOrFail($id);
  
        $tipocontacto->delete();
  
        return redirect()->route('tipocontactos')->with('success', 'Tipo de contacto eliminado con éxito');
    }

}
