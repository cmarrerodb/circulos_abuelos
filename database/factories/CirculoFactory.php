<?php

namespace Database\Factories;
use App\Models\Circulo;
use App\Models\User;
use App\Models\CneEstado;
use App\Models\CneMunicipio;
use App\Models\CneParroquia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Circulo>
 */
class CirculoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Circulo::class;
    public function definition(): array
    {
        return [
            'estado_id' => CneEstado::inRandomOrder()->first()->estado_id,
            'municipio_id' => CneMunicipio::inRandomOrder()->first()->municipio_id,
            'parroquia_id' => CneParroquia::inRandomOrder()->first()->parroquia_id,
            'circulo' => $this->faker->word,
            'created_at' => now(),
            'updated_at' => null,
            'deleted_at' => null,
            'user_id' => User::inRandomOrder()->first()->id,            
        ];
    }
}
