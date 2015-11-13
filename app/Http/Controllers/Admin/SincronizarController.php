<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Cajero\CajeroRepo;
use App\Repositories\Sucursales\SucursalRepo;
use App\Repositories\MovimientoLeer\MovimientosRepo;
use App\Repositories\Branch\BranchRepo;
use App\Repositories\Bitacora\BitacoraRepo;
use App\Repositories\Clientes\ClienteRepo;
use App\Repositories\Creditos\CreditoRepo;
use App\Repositories\Cuotas\CuotaRepo;
use App\Repositories\Transaccion\TransaccionRepo;
use App\Repositories\ClienteHost\ClienteHostRepo;
use App\Repositories\CuotasHost\CuotasHostRepo;

class SincronizarController extends Controller
{

    protected $repo = null;
    protected $cajeroRepo = null;
    protected $sucursalRepo = null;
    protected $branchRepo = null;
    protected $bitacoraRepo = null;
    protected $clienteRepo = null;
    protected $creditoRepo = null;
    protected $cuotaRepo = null;
    protected $transaccionRepo = null;
    protected $clienteHostRepo = null;
    protected $cuotasHostRepo = null;

    public function __construct(CajeroRepo $cajeroRepo,
                                MovimientosRepo $movimientosRepo,
                                SucursalRepo $sucursalRepo,
                                BranchRepo $branchRepo,
                                BitacoraRepo $bitacoraRepo,
                                ClienteRepo $clienteRepo,
                                CreditoRepo $creditoRepo,
                                CuotaRepo $cuotaRepo,
                                TransaccionRepo $transaccionRepo,
                                ClienteHostRepo $clienteHostRepo, CuotasHostRepo $cuotasHostRepo)
    {
        $this->cajeroRepo = $cajeroRepo;
        $this->repo = $movimientosRepo;
        $this->sucursalRepo = $sucursalRepo;
        $this->branchRepo = $branchRepo;
        $this->bitacoraRepo = $bitacoraRepo;
        $this->clienteRepo = $clienteRepo;
        $this->creditoRepo = $creditoRepo;
        $this->cuotaRepo = $cuotaRepo;
        $this->transaccionRepo = $transaccionRepo;
        $this->clienteHostRepo = $clienteHostRepo;
        $this->cuotasHostRepo = $cuotasHostRepo;
    }


    public function index()
    {
        $idUser = \Auth::user()->id;
        $cajero = $this->cajeroRepo->findByField('idUsuario', $idUser);
        $idCajero = $cajero->id;
        $idSucursal = $cajero->idSucursal;
        return view('admin/sincronizar/list',compact('idSucursal','idCajero'));
    }


    public function show($id)
    {
        $success = true;
        $message = "La actualizacion se realizo correctamente";
        $clients = $this->clienteHostRepo->findByField2('id_host',$id);
        $transacciones = $this->transaccionRepo->getAll();

        $transaccionHost = [];
        $cajeroTransaccion = [];


        foreach($transacciones as $key => $value)
        {
            $transaccionHost[$key] = $value->id;
        }

        foreach( $clients as $key => $value)
        {
            $cajeroTransaccion[$key] = $value->id_transaccion;
        }



        $prueba = 0;

        for($i = 0; $i < count($transaccionHost); $i++)
        {
            $contador = 0;
            if(count($cajeroTransaccion) != 0)
            {
                for($x = 0; $x < count($cajeroTransaccion); $x++)
                {
                    if($transaccionHost[$i] == $cajeroTransaccion[$x])
                    {
                        $contador++;
                    }
                }
            }


            if($contador == 0)
            {
                $transaccionData = $this->transaccionRepo->findOrFail($transaccionHost[$i]);
                $creditoData = $this->creditoRepo->findOrFail($transaccionData->idCredito);

                if($transaccionData->tipoTransaccion == 'credito')
                {

                    $datos['id_host'] = $id;
                    $datos['id_cliente'] = $creditoData->idCliente;
                    $datos[ 'saldo'] = $transaccionData->monto;
                    $datos['interes'] = $creditoData->interes;
                    $datos['id_credito'] = $transaccionData->idCredito;
                    $datos['id_transaccion'] = $transaccionData->id;
                    $datos['tipo_transaccion'] = $transaccionData->tipoTransaccion;
                    $registro = $this->clienteHostRepo->create($datos);
                    $cuota = $this->cuotaRepo->findByField('idCredito',$creditoData->id);
                    $fecha = new Carbon($cuota->fechaPago);

                    for( $i = 1; $i <= $creditoData->no_cuotas ; $i++)
                    {
                        $dataCuota['id_clienteHost'] = $registro->id;
                        $dataCuota['montoCuota'] = $cuota->montoCuota;
                        $dataCuota['fechaPago'] = $fecha->addMonth();
                        $dataCuota['estado'] = 'activa';
                        $dataCuota['balance'] = $cuota->montoCuota;
                        $this->cuotasHostRepo->create($dataCuota);
                    }

                }else{

                    $bitacoraBranch = $this->bitacoraRepo->findByField('idTransaccionMaster',$transaccionData->id);
                    $prueba = $bitacoraBranch['id_cuota_branch'];

                    $idCreditoBranch = $bitacoraBranch['id_credito_branch'];
                    $idCuotaBranch = $bitacoraBranch['id_cuota_branch'];


                    $creditoBranch = $this->clienteHostRepo->findOrFail($idCreditoBranch);
                    $creditoBranch['saldo'] = $creditoBranch['saldo'] - $transaccionData['monto'];
                    $creditoBranch->save();

                    $cuotaBranch = $this->cuotasHostRepo->findOrFail($idCuotaBranch);

                    $cuotaBranch = $this->cuotasHostRepo->findOrFail($idCuotaBranch);
                    $cuotaBranch['estado'] = 'Cancelada';
                    $cuotaBranch['balance'] = 00.00;
                    $cuotaBranch->save();


                }
            }

        }
        return compact('success','message');





    }


    public function enviarDatos($id)
    {
        $cajero = $this->cajeroRepo->findOrFail($id);
        $idCajero = $cajero->id;
        $fechaSistema = new Carbon();
        $sucursal = $this->sucursalRepo->findOrFail($cajero->idSucursal);
        $idBranch = $sucursal->idBranch;
        $branch = $this->branchRepo->findOrFail($idBranch);
        $fechaBranch = new Carbon($branch->fecha);

        $horario = $fechaBranch->diffInHours($fechaSistema,false);
        $message= "Los datos fueron registrados con exito en el servidor";
        $success= true;

        if($horario >=0 and $horario < 24 )
        {
            $bitacora = $this->bitacoraRepo->findByFieldAnd2('id_cajero',$idCajero,'tipo','pendiente');
            $contador = 0;
            foreach($bitacora as $key => $value)
            {
                if($value->tipo_transaccion == 'credito'){
                    //credito
                    $cliente['codigo'] = $value->codigo_cliente;
                    $cliente['dpi'] = $value->dpi;
                    $cliente['nit'] = $value->nit;
                    $cliente['nombre'] = $value->nombre;
                    $cliente['apellido'] = $value->apellido;
                    $cliente['direccion'] = $value->direccion;
                    $cliente['telefono'] = $value->telefono;
                    $cliente['fechaNacimiento'] = $value->nacimiento;
                    $cliente = $this->clienteRepo->create($cliente);

                    $credito['codigo'] = $value->codigo_credito;
                    $credito['saldo'] = ( $value['cuota_mensual_credito'] * $value['numero_cuotas_credito'] );
                    $credito['interes'] = $value->interes_credito;
                    $credito['is_host'] = false;
                    $credito['idCliente'] = $cliente->id;
                    $credito['no_cuotas'] = $value['numero_cuotas_credito'];

                    $credito = $this->creditoRepo->create($credito);
                    $fechaPago = Carbon::now();

                    for( $i =1; $i <= $value['numero_cuotas_credito'] ; $i++)
                    {
                        $dataCuota['idCredito'] = $credito->id;
                        $dataCuota['montoCuota'] = $value['cuota_mensual_credito'];
                        $dataCuota['fechaPago'] = $fechaPago->addMonth();
                        $dataCuota['estado'] = 'activa';
                        $dataCuota['balance'] = $value['cuota_mensual_credito'];
                        $this->cuotaRepo->create($dataCuota);
                    }

                    $transaccion['code'] = $value->codigo_credito;
                    $transaccion['tipoTransaccion'] = 'credito';
                    $transaccion['monto'] = $credito->saldo;
                    $transaccion['estado'] = 'registrado';
                    $transaccion['idCajero'] = $idCajero;
                    $transaccion['idCredito'] = $credito->id;
                    $transaccion['idTipoMoneda'] = 1;
                    $transaccionMaster = $this->transaccionRepo->create($transaccion);

                    $bitacoraData = $this->bitacoraRepo->findOrFail($value->id);
                    $bitacoraData['tipo'] = 'registrado';
                    $bitacoraData['idTransaccionMaster'] = $transaccionMaster->id;
                    $bitacoraData->save();
                    $contador++;

                }else{
                    //abono de deuda
                    //Registro la transaccion
                    $transaccion['code'] = 'tr' + time() ;
                    $transaccion['tipoTransaccion'] = 'debito';
                    $transaccion['monto'] = $value->cantidad_credito;
                    $transaccion['estado'] = 'registrado';
                    $transaccion['idCajero'] = $idCajero;
                    $transaccion['idCredito'] = $value->id_credito;
                    $transaccion['idTipoMoneda'] = $value->id_tipo_moneda;
                    $transaccionMaster = $this->transaccionRepo->create($transaccion);


                    //Cancelar la cuota
                    $cuota = $this->cuotaRepo->findOrFail($value->id_cuota);
                    $cuota['estado'] = 'Cancelada';
                    $cuota['balance'] = 00.00;
                    $cuota->save();


                    //Actualizar el credito

                    $credito = $this->creditoRepo->findOrFail($value->id_credito);
                    $credito['saldo'] = $credito['saldo'] - $value['monto_transaccion'];
                    $credito->save();


                    //Cancelar la bitacora
                    $bitacoraData = $this->bitacoraRepo->findOrFail($value->id);
                    $bitacoraData['tipo'] = 'registrado';
                    $bitacoraData['idTransaccionMaster'] = $transaccionMaster->id;
                    $bitacoraData->save();
                    $contador++;
                }
            }

            if($contador == 0 )
            {
                $message = "Ningun registro para enviar al servidor";
            }
        }
        else{
            $message = "El servidor rechazo la peticion, la fecha de su Branch no coincide con la del servidor";
            $success= false;
        }



        return compact('success','message');

    }
}
