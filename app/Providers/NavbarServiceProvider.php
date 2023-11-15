<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Empresa; // Importa el modelo Empresa

class NavbarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer('layouts.navbar', function ($view) {
            $empresas = Empresa::where('activo', 1)->pluck('descripcion', 'id');
            $view->with('empresas', $empresas);
        });
    }
}
