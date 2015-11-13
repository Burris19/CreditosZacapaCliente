<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Cajero\CajeroRepo;
use App\Repositories\Bitacora\BitacoraRepo;

class PdfController extends Controller
{

    protected $cajero = null;
    protected $repo = null;

    public function __construct(CajeroRepo $cajeroRepo,
                                BitacoraRepo $bitacoraRepo)
    {
        $this->cajero = $cajeroRepo;
        $this->repo = $bitacoraRepo;

    }

    public function transacciones (){
        $idUser = \Auth::user()->id;
        $cajero = $this->cajero->findByField('idUsuario', $idUser);
        $data = $this->repo->findByField2('id_cajero',$cajero->id);
        return \PDF::loadView('pdf.reporte', compact('data'))->download('reporte_transacciones.pdf');

    }

}
