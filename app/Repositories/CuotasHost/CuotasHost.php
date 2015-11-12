<?php

namespace App\Repositories\CuotasHost;

use Illuminate\Database\Eloquent\Model;

class CuotasHost extends Model
{
    protected $table = 'cuotasHost';

    protected $fillable = [
        'id_clienteHost',
        'montoCuota',
        'fechaPago',
        'estado',
        'balance',
        'id_host',
    ];



}
