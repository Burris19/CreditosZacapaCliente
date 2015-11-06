<?php

namespace App\Repositories\Transaccion;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $table = 'transacciones';

    protected $fillable = [
        'code',
        'tipoTransaccion',
        'monto',
        'descripcion',
        'tipoTransccion',
        'estado',
        'idCajero',
        'idCredito',
        'idTipoMoneda'
    ];

    public $relations = [
        'credito',
        'moneda'
    ];

    public function credito()
    {
        return $this->hasOne('App\Repositories\Creditos\Creditos','id','idCredito')->with('cliente');
    }

    public function moneda()
    {
        return $this->hasOne('App\Repositories\TipoMoneda\TipoMoneda','id','idTipoMoneda');
    }

}
