<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('descripcion');
        $segment = 'empresas';

        //$empresas = Empresa::paginate(5);

         $empresas = Empresa::when($query, function ($query, $search) {
            return $query->where('descripcion', 'like', "%$search%");
        })->paginate(5);

        $empresas->appends(['descripcion' => request('descripcion')]);
  
        return view('empresas.index', compact('empresas','segment'));
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $segment = 'empresas';
        return view('empresas.create', compact('segment'));
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|unique:empresas,descripcion|max:150',
            'direccion' => 'required|max:250',
        ]);

        $activo = $request->has('activo') ? 1: 0;
        $admin = $request->has('admin') ? 1: 0;

        Empresa::create(array_merge($request->all(), ['activo' => $activo, 'admin' => $admin]));
 
        return redirect()->route('empresas')->with('success', 'Empresa añadida con éxito');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $empresa = Empresa::findOrFail($id);
        $segment = 'empresas';
  
        return view('empresas.show', compact('empresa','segment'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $empresa = Empresa::findOrFail($id);

        $segment = 'empresas';
  
        return view('empresas.edit', compact('empresa','segment'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            'descripcion' => 'required|max:150|unique:empresas,descripcion,' . $id,
            'direccion' => 'required|max:250',
        ]);

        $activo = $request->has('activo') ? 1: 0;
        $admin = $request->has('admin') ? 1: 0;

        
        $empresa = Empresa::findOrFail($id);
        
        //$empresa->update($request->all());
        if (Auth::user()->root != 1) {
            $empresa->update($request->all());
        } else {
            $empresa->update(array_merge($request->all(), ['activo' => $activo, 'admin' => $admin]));
        }

        if(Auth::user()->root !== 1 ) {
            return back()->with('success', 'Se realizaron las modificaciones.');
        }



        return redirect()->route('empresas')->with('success', 'Empresa editada con éxito');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        if(User::where('empresa_id', $id)->first()) {
            return back()->with('danger', 'No se puede eliminar esta empresa. Tiene usuarios asociados.');
        }

        $empresa = Empresa::findOrFail($id);
  
        $empresa->delete();
  
        return redirect()->route('empresas')->with('success', 'Empresa eliminada con éxito');
    }

}