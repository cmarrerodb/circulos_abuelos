<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Circulo extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'circulos';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'estado_id',
        'municipio_id',
        'parroquia_id',
        'circulo',
    ];
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