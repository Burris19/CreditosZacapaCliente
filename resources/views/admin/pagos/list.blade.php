@extends('admin._base.home.layout')
@section('header')
    <h1>
        Realizar Pago
        <small>debitos</small>
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Registrar nuevo pago</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                        <div class="response" class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong></strong>
                        </div>
                        {!! Form::open(['url' => 'bitacora','id'=>'form-create','method' => 'POST','class'=>'form-horizontal', 'data-url' => 'bitacoraPagos' ]) !!}
                        <div class="box-body">
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Datos Del Credito</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="nombre" class="col-sm-2 control-label">Codigo</label>
                                        <div class="col-sm-4">
                                            {!! Form::text('codigo',null,['class' => 'form-control', 'id' => 'codigo']) !!}
                                        </div>

                                        <label for="area" class="col-sm-2 control-label">DPI</label>
                                        <div class="col-sm-4">
                                            {!! Form::number('dpi',null,['class' => 'form-control', 'readonly'=> "readonly", 'id' => 'dpi' ]) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="fecha" class="col-sm-2 control-label">Nombre</label>
                                        <div class="col-sm-4">
                                            {!! Form::text('nombre',null,['class' => 'form-control', 'readonly'=> "readonly", 'id' => 'nombre' ]) !!}
                                        </div>
                                        <label for="fecha" class="col-sm-2 control-label">Direccion</label>
                                        <div class="col-sm-4">
                                            {!! Form::text('direccion',null,['class' => 'form-control', 'readonly'=> "readonly", 'id' => 'direccion']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="fecha" class="col-sm-2 control-label">Monto Cuota</label>
                                        <div class="col-sm-4">
                                            {!! Form::text('monto',null,['class' => 'form-control', 'readonly'=> "readonly", 'id' => 'monto']) !!}
                                        </div>
                                        <label for="fecha" class="col-sm-2 control-label">Fecha Cuota</label>
                                        <div class="col-sm-4">
                                            {!! Form::text('fechaCuota',null,['class' => 'form-control', 'readonly'=> "readonly", 'id' => 'fechaCuota']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Forma de pago</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="nombre" class="col-sm-2 control-label">Tipo Moneda</label>
                                        <div class="col-sm-4">
                                            {!! Form::select('tipoMoneda', $monedas ,null,['class' => 'form-control' , 'id' => 'selectMoneda', 'disabled' => 'disabled'] ) !!}
                                        </div>

                                        <label for="area" class="col-sm-2 control-label">Cantidad</label>
                                        <div class="col-sm-4">
                                            {!! Form::number('montoMoneda',null,['class' => 'form-control', 'readonly'=> "readonly", 'id' => 'montoMoneda' ]) !!}
                                            <input type="hidden" id = "idCredito" name="idCredito">
                                            <input type="hidden" id = "idShare" name="idShare">
                                            <input type="hidden" id = "idCreditoBranch" name="idCreditoBranch">
                                            <input type="hidden" id = "idShareBranch" name="idShareBranch">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <button id="btn-save" type="button" class="btn btn-effect-ripple btn-primary">Guardar</button>

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
