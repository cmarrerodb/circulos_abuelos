<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VuserLog extends Model
{
    protected $table = 'vuser_logs';
    protected $fillable = [
        'email', 
        'name', 
        'fecha_hora', 
        'ip_address', 
        'status_ingreso', 
        'status_salida'
    ];

}
