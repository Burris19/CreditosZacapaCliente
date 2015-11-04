@extends('base_modal.modal')

@section('modal-title')
    Crear Sucursal
@stop

@section('modal-id')
    "modal-create"
@stop

@section('modal-body')
    <div class="response" class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong></strong>
    </div>
    {!! Form::open(['url' => 'sucursales','id'=>'form-create','method' => 'POST','class'=>'form-horizontal', 'data-url' => 'sucursales' ]) !!}
        <div class="box-body">
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                    {!! Form::text('nombre',null,['class' => 'form-control', 'placeholder' => 'Nombre de la Sucursal', 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="direccion" class="col-sm-2 control-label">Direccion</label>
                <div class="col-sm-10">
                    {!! Form::text('direccion',null,['class' => 'form-control', 'placeholder' => 'Direccion Fisica', 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="telefono" class="col-sm-2 control-label">Telefono</label>
                <div class="col-sm-10">
                    {!! Form::number('telefono', null ,['class' => 'form-control', 'placeholder' => 'Telefono de la Sucursal', 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="Branch" class="col-sm-2 control-label">Branch</label>
                <div class="col-sm-10">
                  {!! Form::select('idBranch', $branch, null , ['placeholder' => 'Seleccione un branch', 'class' => 'form-control']) !!}
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
