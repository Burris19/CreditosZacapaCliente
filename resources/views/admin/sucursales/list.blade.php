@extends('admin._base.home.layout')
@section('header')
    <h1>
        Sucursales
        <small>listado</small>
    </h1>
    <ol class="breadcrumb" style="">
        <a href="#modal-create" class="btn btn-block btn-primary btn-sm create" data-toggle="modal">Crear Registro</a>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Listado de Sucursales</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Branch</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as  $key => $sucursal)
                            <tr>
                                <td>{{ $key + 1   }}</td>
                                <td>{{ $sucursal->nombre }} </td>
                                <td>{{ $sucursal->direccion }} </td>
                                <td>{{ $sucursal->telefono }} </td>
                                <td>{{ $sucursal->branch->nombre }} </td>
                                <td><a href="#" data-url = "sucursales" data-id = "{{ $sucursal->id }}"  class="btn btn-info glyphicon glyphicon-th-list edit"></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('admin.sucursales.create',compact('branch'))
<div id="div-modal"></div>
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
