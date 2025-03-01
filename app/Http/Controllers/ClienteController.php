<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Tipocontacto;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('nombre');
        $segment = 'clientes';

        $tipocontactos = Tipocontacto::where('activo', 1)->where('empresa_id', Auth::user()->empresa->id)->pluck('descripcion', 'id');

        $clientes = Cliente::when($query, function ($query, $search) {
            return $query->where('nombre', 'like', "%$search%");
        })->where('empresa_id', Auth::user()->empresa->id)->paginate(5);

        $clientes->appends(['nombre' => request('nombre')]);

        return view('clientes.index', compact('clientes','segment','tipocontactos'));
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

        $existe = Cliente::where('nombre', $request->input('nombre'))
        ->where('empresa_id', Auth::user()->empresa->id)
        ->first();

        if ($existe) {
            return back()->with('danger', 'No se puede crear este cliente. Ya existe en la base de datos.')->withInput();
        }
       

        $activo = $request->has('activo') ? 1: 0;
    
        $cliente = Cliente::create(array_merge($request->all(), [
            'activo' => $activo,
            'empresa_id' => Auth::user()->empresa->id
        ]));
           
 
        return back()->with('success', 'Cliente añadida con éxito');
    }


    public function update(Request $request, string $id)
    {
        $existe = Cliente::where('nombre', $request->input('nombre'))
        ->where('empresa_id', Auth::user()->empresa->id)
        ->where('id','<>',$id)
        ->first();

        if ($existe) {
            return back()->with('danger', 'No se puede modificar este cliente. Ya existe en la base de datos.');
        }
       

        $activo = $request->has('activo') ? 1: 0;

        $cliente = Cliente::findOrFail($id);
        
        //$Categoria->update($request->all());
        $cliente->update(array_merge($request->all(), ['activo' => $activo]));
  
        return back()->with('success', 'Cliente editado con éxito');

    }


    public function destroy(string $id)
    {
        //dd($id);
       /* if(Subcategoria::where('categoria_id', $id)->first()) {
            return back()->with('danger', 'No se puede eliminar esta Categoria. Tiene registros asociados.');
        }*/
        
        $cliente = Cliente::findOrFail($id);
  
        $cliente->delete();
  
        return redirect()->route('clientes')->with('success', 'Cliente eliminado con éxito');
    }

}
