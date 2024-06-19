<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CapitalizesAttributes;
class Participante extends Model
{
    use HasFactory,SoftDeletes, CapitalizesAttributes;
    protected $table = 'participantes';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'cedula',
        'circulo_id',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'fecha_nacimiento',
        'sexo',
        'estado_civil_id',
        'estado_id',
        'municipio_id',
        'parroquia_id',
        'user_id',
        'telefono',
    ];

    public function circulo()
    {
        return $this->belongsTo(Circulo::class, 'circulo_id');
    }

    public function estadoCivil()
    {
        return $this->belongsTo(EstadoCivil::class, 'estado_civil_id');
    }    
    public function estado()
    {
        return $this->belongsTo(CneEstado::class, 'estado_id');
    }    
    public function municipio()
    {
        return $this->belongsTo(CneMunicipio::class, 'municipio_id');
    }    
    public function parroquia()
    {
        return $this->belongsTo(CneParroquia::class, 'parroquia_id');
    }    
}
