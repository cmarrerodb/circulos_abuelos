<?php

namespace Database\Seeders;
use App\Models\EstadoCivil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoCivilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EstadoCivil::create([
            "id"=> 1,
            "estado_civil"=> "SOLTERO",
        ]);
        EstadoCivil::create([
            "id"=> 2,
            "estado_civil"=> "CASADO",
        ]);
        EstadoCivil::create([
            "id"=> 3,
            "estado_civil"=> "VIUDO",
        ]);
        EstadoCivil::create([
            "id"=> 4,
            "estado_civil"=> "DIVORCIADO",
        ]);
        EstadoCivil::create([
            "id"=> 5,
            "estado_civil"=> "SOLTERA",
        ]);
        EstadoCivil::create([
            "id"=> 6,
            "estado_civil"=> "CASADA",
        ]);
        EstadoCivil::create([
            "id"=> 7,
            "estado_civil"=> "VIUDA",
        ]);
        EstadoCivil::create([
            "id"=> 8,
            "estado_civil"=> "DIVORCIADA",
        ]);
    }
}
