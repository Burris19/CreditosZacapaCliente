@extends('base_modal.modal')

@section('modal-title')
    Editar Branch
@stop

@section('modal-id')
    "modal-edit"
@stop

@section('modal-body')
    <div class="response" class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong></strong>
    </div>
    {!! Form::open(['url' => 'branches','id'=>'form-edit','method' => 'PUT','class'=>'form-horizontal', 'data-url' => 'branches' ]) !!}
    <div class="box-body">
        <div class="form-group">
            <label for="nombre" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
                {!! Form::text('nombre', $data->nombre ,['class' => 'form-control', 'placeholder' => 'Nombre del branch', 'required']) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </div>
        </div>
        <div class="form-group">
            <label for="area" class="col-sm-2 control-label">Area</label>
            <div class="col-sm-10">
                {!! Form::text('area',$data->area,['class' => 'form-control', 'placeholder' => 'Area o region a la que pertenece', 'required']) !!}
            </div>
        </div>
        <div class="form-group">
            <label for="fecha" class="col-sm-2 control-label">Fecha</label>
            <div class="col-sm-10">
                {!! Form::date('fecha', $data->fecha ,['class' => 'form-control', 'placeholder' => 'Con esta fecha iniciara el brach', 'required']) !!}
            </div>
        </div>
        <button type="submit" class="hide"></button>
    </div>
    {!! Form::close() !!}

@stop

@section('modal-footer')
    <button id="btn-edit" type="button" class="btn btn-effect-ripple btn-primary">Guardar</button>
    <button type="button" class="btn btn-effect-ripple btn-danger" data-dismiss="modal">Cancelar</button>
@stop
