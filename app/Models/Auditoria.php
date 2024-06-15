<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{

    protected $table = 'logged_actions';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'schema_name',
        'table_name',
        'relid',
        'session_user_name',
        'ci_usuario',
        'nombre_usuario',
        'action_tstamp_tx',
        'action_tstamp_stm',
        'action_tstamp_clk',
        'transaction_id',
        'application_name',
        'client_addr text',
        'client_port',
        'client_query',
        'action text',
        'row_data',
        'changed_fields',
        'statement_only',
    ];    
}
