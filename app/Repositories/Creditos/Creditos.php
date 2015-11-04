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
    ];

    public $relations = [
        'details'
    ];

    public function details()
    {
        return $this->hasMany('App\Repositories\Cuotas\Cuotas', 'idCredito', 'id');
    }


}
