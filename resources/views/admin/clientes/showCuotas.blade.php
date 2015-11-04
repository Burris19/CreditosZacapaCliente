@extends('base_modal.modal')

@section('modal-title')
    Detalle del Credito
@stop

@section('modal-id')
    "modal-edit"
@stop

@section('modal-body')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Saldo Actual = {{ $data->saldo }}  Tasa de Interes = {{ $data->interes }}%</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha de Pago</th>
                            <th>Monto</th>
                            <th>Estado</th>
                            <th>Fecha de cancelacion</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['details'] as  $key => $cuota)
                            <tr>
                                <td>{{ $key + 1   }}</td>
                                <td>{{ $cuota['fechaPago'] }} </td>
                                <td>{{ $cuota['montoCuota'] }} </td>
                                <td>{{ $cuota['estado'] }} </td>
                                <td>
                                    @if($cuota['estado'] == 'cancelada')
                                        {{ $cuota['updated_at'] }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop

@section('modal-footer')
    <button type="button" class="btn btn-effect-ripple btn-danger" data-dismiss="modal">Cancelar</button>
@stop
