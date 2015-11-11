<?php

namespace App\Repositories\Bitacora;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table = 'bitacora';

    protected $fillable = [
        'tipo',
        'idBranch',
        'id_cajero',
        'codigo_cliente',
        'dpi',
        'nit',
        'nombre',
        'apellido',
        'direccion',
        'telefono',
        'nacimiento',
        'codigo_credito',
        'saldo',
        'interes',
        'id_host',
        'id_cliente',
        'codigo_transaccion',
        'tipo_transaccion',
        'monto_transaccion',
        'descripcion_transaccion',
        'estado_transaccion',
        'id_credito',
        'id_tipo_moneda',
        'mensaje',
        'cantidad_credito',
        'interes_credito',
        'numero_cuotas_credito',
        'cuota_mensual_credito',
    ];
}
