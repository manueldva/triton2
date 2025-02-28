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
}
