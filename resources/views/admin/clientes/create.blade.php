@extends('base_modal.modal')

@section('modal-title')
    Crear Cliente
@stop

@section('modal-id')
    "modal-create"
@stop

@section('modal-body')
    <div class="response" class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong></strong>
    </div>
    {!! Form::open(['url' => 'clientes','id'=>'form-create','method' => 'POST','class'=>'form-horizontal', 'data-url' => 'clientes' ]) !!}
        <div class="box-body">
            <div class="panel panel-warning">
              <div class="panel-heading">
                <h3 class="panel-title">Datos Del Cliente</h3>
              </div>
              <div class="panel-body">
                <div class="form-group">
                    <label for="nombre" class="col-sm-2 control-label">Codigo</label>
                    <div class="col-sm-4">
                        {!! Form::text('codigo',null,['class' => 'form-control', 'placeholder' => 'Codigo del Cliente', 'required']) !!}
                    </div>

                    <label for="area" class="col-sm-2 control-label">DPI</label>
                    <div class="col-sm-4">
                        {!! Form::number('dpi',null,['class' => 'form-control', 'placeholder' => 'DPI del Cliente', 'required']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="fecha" class="col-sm-2 control-label">NIT</label>
                    <div class="col-sm-4">
                        {!! Form::number('nit',null,['class' => 'form-control', 'placeholder' => 'NIT del Cliente', 'required']) !!}
                    </div>
                    <label for="fecha" class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-4">
                        {!! Form::text('nombre',null,['class' => 'form-control', 'placeholder' => 'Nombre del Cliente', 'required']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="fecha" class="col-sm-2 control-label">Apellidos</label>
                    <div class="col-sm-4">
                        {!! Form::text('apellido',null,['class' => 'form-control', 'placeholder' => 'Apellido del Cliente', 'required']) !!}
                    </div>
                    <label for="fecha" class="col-sm-2 control-label">Direccion</label>
                    <div class="col-sm-4">
                        {!! Form::text('direccion',null,['class' => 'form-control', 'placeholder' => 'Direccion del Cliente', 'required']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="fecha" class="col-sm-2 control-label">Telefono</label>
                    <div class="col-sm-4">
                        {!! Form::number('telefono',null,['class' => 'form-control', 'placeholder' => 'Telefono Del Cliente', 'required']) !!}
                    </div>
                    <label for="fecha" class="col-sm-2 control-label">Nacimiento</label>
                    <div class="col-sm-4">
                        {!! Form::date('fechaNacimiento',\Carbon\Carbon::now(),['class' => 'form-control']) !!}
                    </div>
                </div>
                <button type="submit" class="hide">kkk</button>
              </div>
            </div>
          </div>

        <div class="box-body">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Datos de La cuenta</h3>
            </div>
            <div class="panel-body">
              <div class="form-group">
                  <label for="fecha" class="col-sm-2 control-label">Cantidad</label>
                  <div class="col-sm-4">
                      {!! Form::number('catidad',null,['class' => 'form-control monthlyFee share', 'placeholder' => 'Cantidad credito', 'required']) !!}
                  </div>
                  <label for="fecha" class="col-sm-2 control-label">Interes</label>
                  <div class="col-sm-4">
                      {!! Form::number('interes',null,['class' => 'form-control monthlyFee interest', 'placeholder' => 'Interes', 'required']) !!}
                  </div>
              </div>

              <div class="form-group">
                  <label for="fecha" class="col-sm-2 control-label"># Cuotas</label>
                  <div class="col-sm-4">
                      {!! Form::number('noCuotas',null,['class' => 'form-control monthlyFee no_share', 'placeholder' => 'No de cuotas', 'required']) !!}
                  </div>
                  <label for="fecha" class="col-sm-2 control-label">Cuota Mensual</label>
                  <div class="col-sm-4">
                      {!! Form::number('cuota',null,['class' => 'form-control shareFinal', 'placeholder' => 'Cuota Mensual', 'required', 'readonly'=>"readonly"  ]) !!}
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
