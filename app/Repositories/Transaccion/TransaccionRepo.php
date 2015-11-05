<?php

namespace App\Repositories\Transaccion;

use App\Repositories\Base\BaseRepo;
use Illuminate\Database\Eloquent\Model;

class TransaccionRepo extends BaseRepo
{
    public function getModel()
    {
        return new Transaccion();
    }
}
