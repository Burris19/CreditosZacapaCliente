<?php

namespace App\Repositories\Clientes;

use App\Repositories\Base\BaseRepo;
use Illuminate\Database\Eloquent\Model;

class ClienteRepo extends BaseRepo
{
    public function getModel()
    {
        return new Cliente();
    }
}
