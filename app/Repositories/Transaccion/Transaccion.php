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
}
