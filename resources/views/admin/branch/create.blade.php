@extends('base_modal.modal')

@section('modal-title')
    Crear Branch
@stop

@section('modal-id')
    "modal-create"
@stop

@section('modal-body')
    <div class="response" class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong></strong>
    </div>
    {!! Form::open(['url' => 'branches','id'=>'form-create','method' => 'POST','class'=>'form-horizontal', 'data-url' => 'branches' ]) !!}
        <div class="box-body">
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                    {!! Form::text('nombre',null,['class' => 'form-control', 'placeholder' => 'Nombre del branch', 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="area" class="col-sm-2 control-label">Area</label>
                <div class="col-sm-10">
                    {!! Form::text('area',null,['class' => 'form-control', 'placeholder' => 'Area o region a la que pertenece', 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="fecha" class="col-sm-2 control-label">Fecha</label>
                <div class="col-sm-10">
                    {!! Form::date('fecha', \Carbon\Carbon::now() ,['class' => 'form-control', 'placeholder' => 'Con esta fecha iniciara el brach', 'required']) !!}
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