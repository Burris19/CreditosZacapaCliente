<?php

namespace App\Repositories\Bitacora;

use App\Repositories\Base\BaseRepo;
use Illuminate\Database\Eloquent\Model;

class BitacoraRepo extends BaseRepo
{
    public function getModel()
    {
        return new Bitacora();
    }

}
