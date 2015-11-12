<?php

namespace App\Repositories\ClienteHost;

use Illuminate\Database\Eloquent\Model;

class ClienteHost extends Model
{
    protected $table = 'clienteHost';

    protected $fillable = [
        'id_host',
        'id_cliente',
        'saldo',
        'interes',
        'id_credito',
        'id_transaccion',
        'tipo_transaccion',
    ];


    public $relations = [
        'details'
    ];


    public function details()
    {
        return $this->hasMany('App\Repositories\CuotasHost\CuotasHost', 'id_credito', 'id');
    }
}
