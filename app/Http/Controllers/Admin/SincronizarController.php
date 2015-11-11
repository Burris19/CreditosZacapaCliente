<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Cajero\CajeroRepo;
use App\Repositories\MovimientoLeer\MovimientosRepo;

class SincronizarController extends Controller
{

    protected $cajeroRepo = null;
    protected $repo = null;

    public function __construct(CajeroRepo $cajeroRepo,
                                MovimientosRepo $movimientosRepo)
    {
        $this->cajeroRepo = $cajeroRepo;
        $this->repo = $movimientosRepo;
    }


    public function index()
    {
        $idUser = \Auth::user()->id;
        $cajero = $this->cajeroRepo->findByField('idUsuario', $idUser);
        $idSucursal = $cajero->idSucursal;
        return view('admin/sincronizar/list',compact('idSucursal'));
    }


    public function show($id)
    {
        $data = $this->repo->findByField2('idBranch',$id);

        foreach( $data as $key => $value)
        {
            $data = $this->repo->findOrFail($value->id);
            $data['estado'] = 1;
            $data->save();
        }
        $success = true;
        $message = "La actualizacion de datos se realizo con exito";

        return compact('success','message');

    }

}
