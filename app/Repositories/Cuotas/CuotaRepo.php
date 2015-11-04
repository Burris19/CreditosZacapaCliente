<?php
/**
 * Created by PhpStorm.
 * User: julian
 * Date: 31/10/15
 * Time: 11:13 AM
 */

namespace App\Repositories\Cuotas;


use App\Repositories\Base\BaseRepo;

class CuotaRepo extends BaseRepo
{
    public function getModel()
    {
        return new Cuotas();
    }
}