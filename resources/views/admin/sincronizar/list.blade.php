@extends('admin._base.home.layout')
@section('header')
    <h1>
        Sincronizacion
        <small>listado</small>
    </h1>
@endsection

@section('content')
    <div class="response" class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong></strong>
    </div>

    <div class="box-body">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Tipo de Sincronizacion</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="fecha" class="col-sm-2 control-label">Leer datos del Servidor</label>
                    <div class="col-sm-4">
                        <button class="btn btn-primary" id="btn-leer" data-id="{{ $idSucursal }}">Iniciar lectura</button>
                    </div>
                    <label for="fecha" class="col-sm-2 control-label">Enviar Datos al Servidor</label>
                    <div class="col-sm-4">
                        <button class="btn btn-danger" id="btn-enviar" data-id="{{ $idCajero }}">Iniciar envio</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('other-scripts')
    {!! Html::script('plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('plugins/datatables/dataTables.bootstrap.min.js') !!}
    {!! Html::style('plugins/datatables/dataTables.bootstrap.css') !!}
    {!! Html::script('js/crudAdmin.js') !!}
    <script>
        $(function () {
            $("#example1").DataTable();
        });
    </script>

@endsection
