<?php

namespace App\Repositories\MovimientoLeer;

use App\Repositories\Base\BaseRepo;
use Illuminate\Database\Eloquent\Model;


class MovimientosRepo extends BaseRepo
{
    public function getModel()
    {
        return new Movimientos();
    }
}
