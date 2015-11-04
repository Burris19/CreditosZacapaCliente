<?php

namespace App\Repositories\TipoMoneda;

use App\Repositories\Base\BaseRepo;
use Illuminate\Database\Eloquent\Model;

class TipoMonedaRepo extends BaseRepo
{
    public function getModel()
    {
        return new TipoMoneda();
    }
}
