<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Bitacora\BitacoraRepo;
use App\Repositories\Cajero\CajeroRepo;
use App\Repositories\Branch\BranchRepo;
use App\Repositories\Sucursales\SucursalRepo;

class BitacorasController extends Controller
{
    protected $repo = null;
    protected $cajeroRepo = null;
    protected $sucursalRepo = null;
    protected $branchRepo = null;


    public function __construct(BitacoraRepo $bitacoraRepo,
                                CajeroRepo $cajeroRepo,
                                BranchRepo $branchRepo,
                                SucursalRepo $sucursalRepo)
    {
        $this->repo = $bitacoraRepo;
        $this->cajeroRepo = $cajeroRepo;
        $this->sucursalRepo = $sucursalRepo;
        $this->branchRepo = $branchRepo;
    }


    public function index()
    {
        $idUser = \Auth::user()->id;
        $cajero = $this->cajeroRepo->findByField('idUsuario', $idUser);
        $data = $this->repo->findByField2('id_cajero',$cajero->id);
        return view('admin.bitacora.list', compact('data'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $idUser = \Auth::user()->id;
        $cajero = $this->cajeroRepo->findByField('idUsuario', $idUser);
        $idSucursal = $cajero->idSucursal;
        $sucursal = $this->sucursalRepo->findOrFail($idSucursal);

        $bitacora['tipo'] = 'pendiente';
        $bitacora['idBranch'] = $sucursal->idBranch;
        $bitacora['id_cajero'] = $cajero->id;

        $bitacora['codigo_cliente'] = $data['codigo'];
        $bitacora['codigo_credito'] = $data['codigo'];
        $bitacora['dpi'] = $data['dpi'];
        $bitacora['nit'] = $data['nit'];
        $bitacora['nombre'] = $data['nombre'];
        $bitacora['apellido'] = $data['apellido'];
        $bitacora['nacimiento'] = $data['fechaNacimiento'];
        $bitacora['direccion'] = $data['direccion'];
        $bitacora['telefono'] = $data['telefono'];

        $bitacora['tipo_transaccion'] = 'credito';
        $bitacora['cantidad_credito'] = $data['cantidad'];
        $bitacora['interes_credito'] = $data['interes'];
        $bitacora['numero_cuotas_credito'] = $data['noCuotas'];
        $bitacora['cuota_mensual_credito'] = $data['cuota'];
        $bitacora['mensaje'] = 'Se registro un cliente Nuevo';

        $success = true;
        $message = 'Credito Creado Exitosamente';
        if(! $this->repo->create($bitacora))
        {
            $success = false;
            $message = 'Error al crear credito';
        }

        return compact('success','message');
    }

    public function pagos(Request $request)
    {
        $data = $request->all();
        $idUser = \Auth::user()->id;
        $cajero = $this->cajeroRepo->findByField('idUsuario', $idUser);
        $idSucursal = $cajero->idSucursal;
        $sucursal = $this->sucursalRepo->findOrFail($idSucursal);

        $bitacora['tipo'] = 'pendiente';
        $bitacora['idBranch'] = $sucursal->idBranch;
        $bitacora['id_cajero'] = $cajero->id;
        $bitacora['codigo_cliente'] = $data['codigo'];
        $bitacora['nombre'] = $data['nombre'];
        $bitacora['id_tipo_moneda'] = $data['tipoMoneda'];
        $bitacora['id_credito'] = $data['idCredito'];
        $bitacora['id_cuota'] = $data['idShare'];
        $bitacora['cantidad_credito'] = $data['monto'];
        $bitacora['monto_transaccion'] = $data['monto'];
        $bitacora['tipo_transaccion'] = 'debito';
        $bitacora['mensaje'] = 'Se registro un nuevo pago';

        $success = true;
        $message = 'Pago Creado Exitosamente';
        if(! $this->repo->create($bitacora))
        {
            $success = false;
            $message = 'Error al crear credito';
        }
        return compact('success','message');
    }



}

