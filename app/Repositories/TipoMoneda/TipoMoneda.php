<?php

namespace App\Repositories\TipoMoneda;

use Illuminate\Database\Eloquent\Model;

class TipoMoneda extends Model
{
    protected $table = 'tipoMoneda';

    protected $fillable = [
        'descripcion',
        'cantidad'
    ];
}
