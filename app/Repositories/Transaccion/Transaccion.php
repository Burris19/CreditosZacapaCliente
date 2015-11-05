<?php

namespace App\Repositories\Transaccion;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $table = 'transacciones';

    protected $fillable = [
        'codigo',
        'idCajero',
        'idCredito',
        'idTipoMoneda',
        'tipoTransccion',
        'monto',
        'descripcion'
    ];
}
