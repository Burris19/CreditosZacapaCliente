<?php

namespace App\Repositories\Cajero;

use Illuminate\Database\Eloquent\Model;

class Cajero extends Model
{
    protected $table = 'cajeros';

    protected $fillable = [
        'code',
        'nombre',
        'direccion',
        'fecha',
        'idSucursal',
        'idUsuario'
    ];

    public $relations = [
        'sucursal',
        'users'
    ];

    public function sucursal()
    {
        return $this->hasOne('App\Repositories\Sucursales\Sucursales', 'id','idSucursal');
    }

    public function users()
    {
        return $this->hasOne('App\Repositories\User\User', 'id','idUsuario');
    }


}
