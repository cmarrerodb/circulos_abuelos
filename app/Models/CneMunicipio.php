<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CneMunicipio extends Model
{
    use HasFactory,SoftDeletes;
        protected $table = 'cne_municipios';
        protected $primaryKey = 'id';
        public $timestamps = true;
    
        protected $fillable = [
            'estado_id',
            'municipio_id',
            'municipio',
        ];
    
        public function estado()
        {
            return $this->belongsTo(CneEstado::class, 'estado_id');
        }    
}
