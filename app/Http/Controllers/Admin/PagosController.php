<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Transaccion\TransaccionRepo;
use App\Repositories\TipoMoneda\TipoMonedaRepo;
use App\Repositories\Clientes\ClienteRepo;
use App\Repositories\Creditos\CreditoRepo;
use App\Repositories\Cajero\CajeroRepo;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Cuotas\CuotaRepo;
use Mockery\CountValidator\Exception;

class PagosController extends CRUDController
{
    protected $module = 'pagos';
    protected $transaccionRepo = null;
    protected $tipoMonedaRepo = null;
    protected $clienteRepo = null;
    protected $creditoRepo = null;
    protected $cajeroRepo = null;
    protected $cuotaRepo = null;

    protected $rules = [
        'idCajero' => 'required',
        'idCredito' => 'required',
        'idTipoMoneda' => 'required'
    ];

    public function __construct(TransaccionRepo $transaccionRepo,
                                TipoMonedaRepo $tipoMonedaRepo,
                                ClienteRepo $clienteRepo,
                                CreditoRepo $creditoRepo,
                                CajeroRepo $cajeroRepo,
                                CuotaRepo $cuotaRepo)
    {
        $this->repo = $transaccionRepo;
        $this->tipoMonedaRepo = $tipoMonedaRepo;
        $this->clienteRepo = $clienteRepo;
        $this->creditoRepo = $creditoRepo;
        $this->cajeroRepo = $cajeroRepo;
        $this->cuotaRepo = $cuotaRepo;
    }

    public function index()
    {
        $data = $this->repo->getWithRelations();
        $monedas = $this->tipoMonedaRepo->lists('descripcion','id');
        return view($this->root . '/' . $this->module  .'/list',compact('data','monedas'));

    }

    public function store(Request $request)
    {
        $data =  $request->all();
        $idUser = Auth::user()->id;
        $cajero = $this->cajeroRepo->findOrFail($idUser);
        $transaction['code'] = 'tr' + time() ;
        $transaction['tipoTransaccion'] = 'debito';
        $transaction['monto'] = $data['monto'];
        $transaction['descripcion'] = 'Pago de credito';
        $transaction['estado'] = 'pendiente';
        $transaction['idCajero'] = $cajero->id;
        $transaction['idCredito'] = $data['idCredito'];
        $transaction['idTipoMoneda'] = $data['tipoMoneda'];
        $validator = \Validator::make($transaction, $this->rules);
        $success = true;
        $message = "Registro guardado exitosamente";
        $record = null;
        if ($validator->passes())
        {
            $record = $this->repo->create($transaction);

            $cuota = $this->cuotaRepo->findOrFail($data['idShare']);
            $cuota['estado'] = 'Cancelada';
            $cuota['balance'] = 00.00;
            $cuota->save();

            $credito = $this->creditoRepo->findOrFail($data['idCredito']);
            $credito['saldo'] = $credito['saldo'] - $data['monto'];
            $credito->save();

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

