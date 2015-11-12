<?php

namespace App\Repositories\ClienteHost;

use App\Repositories\Base\BaseRepo;
use Illuminate\Database\Eloquent\Model;

class ClienteHostRepo extends BaseRepo
{
    public function getModel()
    {
        return new ClienteHost();
    }
}
