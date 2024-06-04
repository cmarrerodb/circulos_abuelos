<?php

namespace Database\Factories;

use App\Models\Participante;
use App\Models\User;
use App\Models\Circulo;
use App\Models\CneEstado;
use App\Models\CneMunicipio;
use App\Models\CneParroquia;
use App\Models\EstadoCivil;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipanteFactory extends Factory
{
    protected $model = Participante::class;

    public function definition()
    {
        $sexo = $this->faker->randomElement(['M', 'F']);
        $estadoCivilIds = $sexo == 'M' ? [1, 2, 3, 4] : [5, 6, 7, 8];
        $circulo = Circulo::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();
        $estado = CneEstado::inRandomOrder()->first();
        $municipio = CneMunicipio::where('estado_id', $estado->estado_id)->inRandomOrder()->first();
        $parroquia = CneParroquia::where('estado_id', $estado->estado_id)
                                  ->where('municipio_id', $municipio->municipio_id)
                                  ->inRandomOrder()->first();
        return [
            'cedula' => $this->faker->unique()->numberBetween(10000000, 99999999),
            'circulo_id' => $circulo->id,
            'primer_nombre' => $this->faker->firstName,
            'segundo_nombre' => $this->faker->firstName,
            'primer_apellido' => $this->faker->lastName,
            'segundo_apellido' => $this->faker->lastName,
            'fecha_nacimiento' => $this->faker->date,
            'sexo' => $sexo,
            'estado_civil_id' => $this->faker->randomElement($estadoCivilIds),
            'estado_id' => $estado->estado_id,
            'municipio_id' => $municipio->municipio_id,
            'parroquia_id' => $parroquia->parroquia_id,
            'created_at' => now(),
            'updated_at' => null,
            'deleted_at' => null,
            'user_id' => $user->id,
        ];

    }
}
