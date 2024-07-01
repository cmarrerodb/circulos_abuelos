<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CneParroquia extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'cne_parroquias';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'estado_id',
        'municipio_id',
        'parroquia_id',
        'parroquia',
    ];

    public function estado()
    {
        return $this->belongsTo(CneMunicipio::class, 'estado_id');
    }

    public function municipio()
    {
        return $this->belongsTo(CneMunicipio::class, 'municipio_id');
    }
    protected static function booted()
    {
        static::addGlobalScope('excluirId', function (Builder $builder) {
            $builder->where('id', '<>', 99999);
        });
    }     
}
