<?php

namespace App\Repositories\Cuotas;

use Illuminate\Database\Eloquent\Model;

class Cuotas extends Model
{
    protected $table = 'cuotas';

    protected $fillable = [
        'idCredito',
        'montoCuota',
        'fechaPago',
        'estado',
        'balance'
    ];


}
