<?php

namespace App\Repositories\Host;

use App\Repositories\Base\BaseRepo;
use Illuminate\Database\Eloquent\Model;

class HostRepo extends BaseRepo
{
    public function getModel()
    {
        return new Host();
    }
}
