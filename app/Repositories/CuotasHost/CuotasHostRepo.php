<?php

namespace App\Repositories\CuotasHost;

use App\Repositories\Base\BaseRepo;
use Illuminate\Database\Eloquent\Model;

class CuotasHostRepo extends BaseRepo
{
    public function getModel()
    {
        return new CuotasHost();
    }
}
