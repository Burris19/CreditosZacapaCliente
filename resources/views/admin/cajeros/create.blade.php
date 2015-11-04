@extends('base_modal.modal')

@section('modal-title')
    Crear Cajero
@stop

@section('modal-id')
    "modal-create"
@stop

@section('modal-body')
    <div class="response" class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong></strong>
    </div>
    {!! Form::open(['url' => 'cajeros','id'=>'form-create','method' => 'POST','class'=>'form-horizontal', 'data-url' => 'cajeros' ]) !!}
        <div class="box-body">
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Codigo</label>
                <div class="col-sm-10">
                    {!! Form::text('code',null,['class' => 'form-control', 'placeholder' => 'Codigo del Cajero', 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="direccion" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                    {!! Form::text('nombre',null,['class' => 'form-control', 'placeholder' => 'Nombre del Cajero', 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="telefono" class="col-sm-2 control-label">Direccion</label>
                <div class="col-sm-10">
                    {!! Form::text('direccion', null ,['class' => 'form-control', 'placeholder' => 'Direccion del Cajero', 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="telefono" class="col-sm-2 control-label">Fecha</label>
                <div class="col-sm-10">
                    {!! Form::date('fecha', \Carbon\Carbon::now() ,['class' => 'form-control', 'placeholder' => 'Con esta fecha iniciara el Cajro', 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="Branch" class="col-sm-2 control-label">Sucursal</label>
                <div class="col-sm-10">
                  {!! Form::select('idSucursal', $sucursal, null , ['placeholder' => 'Seleccione una Sucursal', 'class' => 'form-control']) !!}
                </div>
            </div>

            <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">Datos de Acceso</h3>
                </div>
                <div class="panel-body">
                  <div class="form-group">
                      <label for="telefono" class="col-sm-2 control-label">Usuario</label>
                      <div class="col-sm-10">
                          {!! Form::text('email', null ,['class' => 'form-control', 'placeholder' => 'Usuario De Acceso', 'required']) !!}
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="telefono" class="col-sm-2 control-label">Password</label>
                      <div class="col-sm-10">
                          {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password de Acceso', 'required']) !!}
                      </div>
                  </div>
                </div>
              </div>




            <button type="submit" class="hide"></button>
        </div>
    {!! Form::close() !!}

@stop

@section('modal-footer')
    <button id="btn-save" type="button" class="btn btn-effect-ripple btn-primary">Guardar</button>
    <button type="button" class="btn btn-effect-ripple btn-danger" data-dismiss="modal">Cancelar</button>
@stop
