<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Branch\BranchRepo;


class BranchController extends CRUDController
{
    protected $rules = [
        'nombre' => 'required',
        'area'   => 'required',
        'fecha'  => 'required|date'
    ];

    protected $module = 'branch';

    protected $repo = null;

    function __construct(BranchRepo $branchRepo)
    {
        $this->repo = $branchRepo;
    }


    public function store(Request $request)
    {

        $data =$request->all();
        $data['idHost'] = 1;
        $validator = \Validator::make($data, $this->rules);
        $success = true;
        $message = "Registro guardado exitosamente";
        $record = null;
        if ($validator->passes())
        {
            $record = $this->repo->create($data);
            return compact('success','message','record','data');
        }
        else
        {
            $success=false;
            $message = $validator->messages();
            return compact('success','message','record','data');
        }
    }

}
