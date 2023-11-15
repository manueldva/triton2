<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
  
class AuthController extends Controller
{
    public function register()
    {
        $empresas = Empresa::where('activo', 1)
        ->where('admin',0)
        ->get();
        return view('auth.register', compact('empresas'));
    }
  
    public function registerSave(Request $request)
    {
        
        $request->validate([
            'email'     => 'required|email|unique:users,email|max:255',
            'name'      => 'required|max:255',
            'password'  => 'required|max:255',
            'empresa_id'=> 'required',
        ]);
  
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'empresa_id' => $request->empresa_id,
            'password' => Hash::make($request->password),
            'activo' => false
        ]);
  
        return redirect()->route('login');
    }
  
    public function login()
    {
        return view('auth.login');
    }
  
    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();
  
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }

         // Obtén al usuario autenticado
        $user = Auth::user();

        // Verifica si el usuario está activo
        if (!$user->activo) {
            Auth::logout(); // Cerrar sesión si el usuario no está activo
            throw ValidationException::withMessages([
                'email' => 'Tu cuenta no está activa. Contacta al administrador.'
            ]);
        }
        
  
        $request->session()->regenerate();
  
        return redirect()->route('dashboard');
    }
  
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
  
        $request->session()->invalidate();
  
        return redirect('/');
    }
 
    public function profile()
    {
        return view('profile');
    }
}