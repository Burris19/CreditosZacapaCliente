<?php

namespace App\Repositories\Creditos;

use Illuminate\Database\Eloquent\Model;

class Creditos extends Model
{
    protected $table = 'creditos';

    protected $fillable = [
        'codigo',
        'saldo',
        'interes',
        'is_host',
        'idCliente',
        'no_cuotas',
    ];

    public $relations = [
        'details',
        'cliente'
    ];

    public function details()
    {
        return $this->hasMany('App\Repositories\Cuotas\Cuotas', 'idCredito', 'id');
    }

    public function cliente()
    {
        return $this->hasOne('App\Repositories\Clientes\Cliente','id','idCliente');
    }


}
