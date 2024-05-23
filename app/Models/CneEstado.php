<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
