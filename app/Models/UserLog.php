<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'timestamp', 
        'ip_address', 
        'status_ingreso', 
        'status_salida'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
