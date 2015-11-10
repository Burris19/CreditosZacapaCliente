<?php

namespace App\Repositories\MovimientoLeer;

use Illuminate\Database\Eloquent\Model;

class Movimientos extends Model
{
    protected $table = 'movimientoLeer';

    protected $fillable = [
      'id',
      'idBranch',
      'idCliente',
      'idCredito',
      'saldo',
      'idCuota',
      'idTransaccion',
      'estado'
    ];

}
