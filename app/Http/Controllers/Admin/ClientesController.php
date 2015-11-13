<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Clientes\ClienteRepo;
use App\Repositories\Creditos\CreditoRepo;
use App\Repositories\Cuotas\CuotaRepo;
use App\Repositories\TipoMoneda\TipoMonedaRepo;
use App\Repositories\Cajero\CajeroRepo;
use App\Repositories\MovimientoLeer\MovimientosRepo;
use App\Repositories\ClienteHost\ClienteHostRepo;
use App\Repositories\CuotasHost\CuotasHostRepo;
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
    protected $cajeroRepo = null;
    protected $movimientoRepo = null;
    protected $clienteHostRepo = null;
    protected $cuotasHostRepo = null;

    function __construct(ClienteRepo $clientesRepo,
                         CreditoRepo $creditRepo,
                         CuotaRepo $cuotaRepo,
                         TipoMonedaRepo $tipoMonedaRepo,
                         CajeroRepo $cajeroRepo,
                         MovimientosRepo $movimientosRepo,
                         ClienteHostRepo $clienteHostRepo,
                         CuotasHostRepo $cuotasHostRepo)
    {
        $this->repo = $clientesRepo;
        $this->creditRepo = $creditRepo;
        $this->cuotaRepo = $cuotaRepo;
        $this->tipoMonedaRepo = $tipoMonedaRepo;
        $this->cajeroRepo = $cajeroRepo;
        $this->movimientoRepo = $movimientosRepo;
        $this->clienteHostRepo = $clienteHostRepo;
        $this->cuotasHostRepo = $cuotasHostRepo;
    }

    public function index()
    {
        $idUser = \Auth::user()->id;
        $cajero = $this->cajeroRepo->findByField('idUsuario',$idUser);

        $clientes = $this->clienteHostRepo->findByField2('id_host',$cajero->id);

        $idClientes= [];
        foreach ($clientes as $key => $value)
        {
            $idClientes[$key] = $value->id_cliente;
        }

        $data = \DB::table('clientes')
            ->whereIn('id', $idClientes)->get();


        return view($this->root . '/' . $this->module  .'/list',compact('data'));

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
        $idUser = \Auth::user()->id;
        $cajero = $this->cajeroRepo->findByField('idUsuario',$idUser);

        $credito = $this->clienteHostRepo->findByFieldAnd3('id_cliente',$id,'id_host',$cajero->id);

        $data = $this->clienteHostRepo->findWithRelations($credito->id);

        return view($this->root . '/' . $this->module .'/showCuotas',compact('data'));

    }

    public function edit($codigo)
    {
        $client = $this->repo->findByField('codigo',$codigo);
        if($client)
        {
            $idUser = \Auth::user()->id;
            $cajero = $this->cajeroRepo->findByField('idUsuario',$idUser);
            $credit = $this->clienteHostRepo->findByFieldAnd3('id_cliente',$client->id,'id_host',$cajero->id);

            if($credit)
            {
                $creditMaster = $this->creditRepo->findByField('idCliente',$client->id);
                $shareMaster = $this->cuotaRepo->findByFieldAnd('idCredito',$creditMaster->id,'estado','Cancelada');

                $share = $this->cuotasHostRepo->findByFieldAnd('id_clienteHost',$credit->id,'estado','Cancelada');
                $success = true;
                return compact('success','client','share','credit','creditMaster','shareMaster');
            }else{
                $success = false;
                return compact('success');
            }

        }else{
            $success = false;
            return compact('success');
        }

    }


}
