<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepo;

class UserController extends CRUDController
{
    protected $module='users';

    function __construct(UserRepo $userRepo)
    {
      $this->repo=$userRepo;
    }

}
