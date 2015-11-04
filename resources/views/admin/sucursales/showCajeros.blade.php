@extends('base_modal.modal')

@section('modal-title')
    Cajeros asignados
@stop

@section('modal-id')
    "modal-edit"
@stop

@section('modal-body')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>codigo</th>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Fecha</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['cajero'] as  $key => $cajero)
                        <tr>
                            <td>{{ $key + 1   }}</td>
                            <td>{{ $cajero['code'] }} </td>
                            <td>{{ $cajero['nombre'] }} </td>
                            <td>{{ $cajero['direccion'] }} </td>
                            <td>{{ $cajero['fecha'] }} </td>
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

