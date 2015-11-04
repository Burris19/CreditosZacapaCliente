<?php

namespace App\Repositories\Branch;

use App\Repositories\Base\BaseRepo;
use Illuminate\Database\Eloquent\Model;

class BranchRepo extends BaseRepo
{
    public function getModel()
    {
        return new Branch();
    }
}
