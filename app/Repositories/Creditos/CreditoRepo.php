<?php
/**
 * Created by PhpStorm.
 * User: julian
 * Date: 31/10/15
 * Time: 11:12 AM
 */

namespace App\Repositories\Creditos;


use App\Repositories\Base\BaseRepo;

class CreditoRepo extends BaseRepo
{
    public function getModel()
    {
        return new Creditos();
    }
}