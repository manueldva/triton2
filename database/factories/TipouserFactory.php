<?php

namespace Database\Factories;
use App\Models\Tipouser;
use App\Models\Empresa; // Importa el modelo Empresa


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categoria>
 */
class TipouserFactory extends Factory
{
    protected $model = Tipouser::class;

    public function definition(): array
    {
       return [
            'descripcion' => $this->faker->word,
            'activo' => $this->faker->boolean,
            'empresa_id' => Empresa::inRandomOrder()->first()->id, // Obtiene un ID de empresa aleatorio
        ];
    }
}
