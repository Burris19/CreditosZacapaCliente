<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Cajero\CajeroRepo;
use App\Repositories\Sucursales\SucursalRepo;
use App\Repositories\User\UserRepo;


class CajeroController extends CRUDController
{
    protected $rules=[
        'code'=>'required|unique:cajeros',
        'nombre'=>'required',
        'direccion'=>'required',
        'fecha'=>'required',
        'idSucursal'=>'required',
        'idUsuario'=>'required',

    ];

    protected $rulesUsuario=[
        'name'=>'required',
        'email'=>'required|unique:users',
        'password'=>'required',
    ];

    protected $module='cajeros';
    protected $sucursalRepo=null;
    protected $userRepo=null;

    public  function __construct(CajeroRepo $cajeroRepo,
                                 SucursalRepo  $sucursalRepo,
                                 UserRepo $userRepo)
    {
        $this->repo=$cajeroRepo;
        $this->sucursalRepo=$sucursalRepo;
        $this->userRepo=$userRepo;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $dataUsers['type']='cajero';
        $dataUsers['name']=$data['nombre'];
        $dataUsers['email']=$data['email'];
        $dataUsers['password']=$data['password'];
        $validator= \Validator::make($dataUsers,$this->rulesUsuario);////Primero Verifico las Reglas del Usuario
        $success=true;
        $messsage="Registro Guardado Exitosamente";

        if($validator->passes())
        {
            $User=$this->userRepo->create($dataUsers);
            $data['idUsuario']=$User->id;
            $validator= \Validator::make($data,$this->rules);//// Verifico las Reglas del Cajero
            if($validator->passes())
            {
                $this->repo->create($data);
                return compact('success','message');
            }else{
                $success=false;
                $message = $validator->messages();
                return compact('success','message');
            }
        }else{
            $success=false;
            $message = $validator->messages();
            return compact('success','message','record','data');
        }
    }

    public function index()
    {
        $data=$this->repo->getWithRelations();
        $sucursal = $this->sucursalRepo->lists('nombre','id');
        return view($this->root . '/' . $this->module  .'/list',compact('data','sucursal'));
    }


}
