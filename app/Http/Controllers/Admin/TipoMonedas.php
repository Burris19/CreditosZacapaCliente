<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\TipoMoneda\TipoMonedaRepo;

class TipoMonedas extends Controller
{

    protected $repo = null;


    public function __construct(TipoMonedaRepo $tipoMonedaRepo){
        $this->repo = $tipoMonedaRepo;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->repo->findOrFail($id);
        return $data;
    }


}
