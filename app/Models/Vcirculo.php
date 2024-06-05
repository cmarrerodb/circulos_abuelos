<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Vcirculo extends Model
{
    protected $table = 'vcirculos';
    protected $fillable = [
        'estado_id',
        'estado',
        'municipio_id',
        'municipio',
        'parroquia_id',
        'parroquia',
        'comunidad',
        'circulo',
        'usuario_id',
        'usuario',
        'created_at'

    ];
    public function estado()
    {
        return $this->belongsTo(CneMunicipio::class, 'estado_id');
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

