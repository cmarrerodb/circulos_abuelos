<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class CneEstado extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'cne_estados';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'estado_id',
        'estado',
    ];    
    protected static function booted()
    {
        static::addGlobalScope('excluirId', function (Builder $builder) {
            $builder->where('id', '<>', 99);
        });
    }    
}
