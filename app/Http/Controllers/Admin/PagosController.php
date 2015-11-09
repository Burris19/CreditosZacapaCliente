<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Transaccion\TransaccionRepo;
use App\Repositories\TipoMoneda\TipoMonedaRepo;
class PagosController extends CRUDController
{
    protected $module = 'pagos';

    protected $transaccionRepo = null;
    protected $tipoMonedaRepo = null;

    protected $rules = [

    ];

    public function __construct(TransaccionRepo $transaccionRepo,
                                TipoMonedaRepo $tipoMonedaRepo)
    {
        $this->repo = $transaccionRepo;
        $this->tipoMonedaRepo = $tipoMonedaRepo;
    }

    public function index()
    {
        $data = $this->repo->getWithRelations();
        $monedas = $this->tipoMonedaRepo->lists('descripcion','id');
        return view($this->root . '/' . $this->module  .'/list',compact('data','monedas'));

    }
}
