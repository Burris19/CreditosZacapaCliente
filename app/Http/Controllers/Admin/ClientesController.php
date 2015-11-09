<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Clientes\ClienteRepo;
use App\Repositories\Creditos\CreditoRepo;
use App\Repositories\Cuotas\CuotaRepo;
use App\Repositories\TipoMoneda\TipoMonedaRepo;
use Carbon\Carbon;


class ClientesController extends CRUDController
{
    protected $rules = [
        'codigo' => 'required|unique:clientes',
        'dpi' => 'required',
        'nit' => 'required',
        'nombre' => 'required',
        'apellido' => 'required',
        'fechaNacimiento' => 'required'
    ];

    protected $rulesCredito = [
        'codigo' => 'required|unique:creditos',
        'saldo' => 'required',
        'idCliente' => 'required'
    ];

    protected $module='clientes';
    protected $creditRepo = null;
    protected $cuotaRepo = null;
    protected $tipoMonedaRepo = null;

    function __construct(ClienteRepo $clientesRepo,
                         CreditoRepo $creditRepo,
                         CuotaRepo $cuotaRepo,
                         TipoMonedaRepo $tipoMonedaRepo)
    {
        $this->repo = $clientesRepo;
        $this->creditRepo = $creditRepo;
        $this->cuotaRepo = $cuotaRepo;
        $this->tipoMonedaRepo = $tipoMonedaRepo;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $dataCredit['codigo'] = $data['codigo'];
        $dataCredit['saldo'] = ( $data['cuota'] * $data['noCuotas'] );
        $dataCredit['interes'] = $data['interes'];
        $validator = \Validator::make($data,$this->rules);
        $fechaPago = Carbon::now();
        $success = true;
        $message = "Registro guardado exitosamente";
        if ($validator->passes())
        {
            $client = $this->repo->create($data);
            $dataCredit['idCliente'] = $client->id;
            $validator = \Validator::make($dataCredit,$this->rulesCredito);
            if ($validator->passes())
            {
                $credit = $this->creditoRepo->create($dataCredit);

                for( $i =1; $i <= $data['noCuotas'] ; $i++)
                {
                    $dataCuota['idCredito'] = $credit->id;
                    $dataCuota['montoCuota'] = $data['cuota'];
                    $dataCuota['fechaPago'] = $fechaPago->addMonth();
                    $dataCuota['estado'] = 'activa';
                    $dataCuota['balance'] = $data['cuota'];
                    $this->cuotaRepo->create($dataCuota);
                }

                return compact('success','message','record','data');

            }else{
                $success=false;
                $message = $validator->messages();
                return compact('success','message','record','data');
            }


        }else{
            $success=false;
            $message = $validator->messages();
            return compact('success','message','record','data');
       }


    }

    public function show(Request $request, $id)
    {
        $credit = $this->creditRepo->findByField('idCliente',$id);
        $data = $this->creditRepo->findWithRelations($credit->id);
        return view($this->root . '/' . $this->module .'/showCuotas',compact('data'));

    }

    public function edit($codigo)
    {
        $client = $this->repo->findByField('codigo',$codigo);

        if($client)
        {
            $credit = $this->creditRepo->findByField('idCliente',$client->id);
            $share = $this->cuotaRepo->findByFieldAnd('idCredito',$credit->id,'estado','Cancelada');
            $success = true;
            return compact('success','client','share','credit');
        }else{
            $success = false;
            return compact('success');
        }

    }


}
