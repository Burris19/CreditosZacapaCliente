            @extends('base_modal.modal')

@section('modal-title')
    Registrar Transaccion
@stop

@section('modal-id')
    "modal-create"
@stop

@section('modal-body')
    <div class="response" class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong></strong>
    </div>
    {!! Form::open(['url' => 'pagos','id'=>'form-create','method' => 'POST','class'=>'form-horizontal', 'data-url' => 'pagos' ]) !!}
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
                        {!! Form::select('tipoMoneda', $monedas,null,['class' => 'form-control' , 'id' => 'selectMoneda', 'disabled' => 'disabled'] ) !!}
                    </div>

                    <label for="area" class="col-sm-2 control-label">Cantidad</label>
                    <div class="col-sm-4">
                        {!! Form::number('montoMoneda',null,['class' => 'form-control', 'readonly'=> "readonly", 'id' => 'montoMoneda' ]) !!}
                        <input type="text" id = "idCredito" name="idCredito">
                        <input type="text" id = "idShare" name="idShare">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

@stop

@section('modal-footer')
    <button id="btn-save" type="button" class="btn btn-effect-ripple btn-primary">Guardar</button>
    <button type="button" class="btn btn-effect-ripple btn-danger" data-dismiss="modal">Cancelar</button>
@stop

