<?php

namespace App\Repositories\Cajero;
use App\Repositories\Base\BaseRepo;
use Illuminate\Database\Eloquent\Model;

class CajeroRepo extends BaseRepo
{
    public function getModel()
    {
      return new Cajero();
    }
}
