<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vparticipante extends Model
{
    protected $table = 'vparticipantes';
    protected $fillable = [
        'cedula',
        'telefono',
        'circulo_id',
        'circulo',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'fecha_nacimiento',
        'sexo_id',
        'sexo',
        'estado_civil_id',
        'estado_civil',
        'estado_id',
        'estado',
        'municipio_id',
        'municipio',
        'parroquia_id',
        'parroquia',
    ];
}
