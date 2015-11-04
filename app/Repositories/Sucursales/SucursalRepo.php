<?php

namespace App\Repositories\Sucursales;

use App\Repositories\Base\BaseRepo;
use App\Repositories\Sucursales\Sucursales;
use Illuminate\Database\Eloquent\Model;

class SucursalRepo extends BaseRepo
{
    public function getModel()
    {
        return new Sucursales();
    }
}
