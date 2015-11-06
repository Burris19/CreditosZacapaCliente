<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Transaccion\TransaccionRepo;
class PagosController extends CRUDController
{
    protected $module = 'pagos';

    protected $transaccionRepo = null;

    protected $rules = [

    ];

    public function __construct(TransaccionRepo $transaccionRepo)
    {
        $this->repo = $transaccionRepo;
    }

    public function index()
    {
        $data = $this->repo->getWithRelations();
        return view($this->root . '/' . $this->module  .'/list',compact('data'));

    }
}
