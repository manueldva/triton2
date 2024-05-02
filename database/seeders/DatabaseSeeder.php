<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Categoria;
use App\Models\Tipouser;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        DB::table('empresas')->insert([
            'descripcion' => 'Administración General',
            'direccion' => 'S/D',
            'admin' => true,
            'activo' => true,
        ]);

         DB::table('empresas')->insert([
            'descripcion' => 'La Cocina',
            'direccion' => 'S/D',
            'admin' => false,
            'activo' => true,
        ]);


        DB::table('users')->insert([
            'name' => 'David Avila',
            'email' => 'manudva22@gmail.com',
            'empresa_id' => 1,
            'password' => Hash::make('33456282'),
            'activo' => true,
            'root' => true,
        ]);

        DB::table('users')->insert([
            'name' => 'Santiago Gelve',
            'email' => 'santi@gmail.com',
            'empresa_id' => 2,
            'password' => Hash::make('33456282'),
            'activo' => true,
            'root' => false,
        ]);


        Categoria::factory(100)->create();
        Tipouser::factory(20)->create();
    }
}
