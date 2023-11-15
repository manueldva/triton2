<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        DB::table('empresas')->insert([
            'descripcion' => 'Administración General',
            'direccion' => 'S/D',
            'admin' => true,
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

    }
}
