@extends('base_modal.modal')

@section('modal-title')
    Elimnar Branch
@stop

@section('modal-id')
    "modal-delete"
@stop

@section('modal-body')
    <div class="response" class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong></strong>
    </div>
    {!! Form::open(['url' => 'branches','id'=>'form-delete','method' => 'DELETE','class'=>'form-horizontal', 'data-url' => 'branches', 'data-id' => $data->id ]) !!}
        <h3>¿Desea eliminar el registro?</h3>
    {!! Form::close() !!}

@stop

@section('modal-footer')
    <button id="btn-delete" type="button" class="btn btn-effect-ripple btn-primary">Guardar</button>
    <button type="button" class="btn btn-effect-ripple btn-danger" data-dismiss="modal">Cancelar</button>
@stop
