
@extends('admin._base.home.layout')
@section('header')
    <h1>
        Cajeros
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
                    <h3 class="box-title">Listado de Cajeros</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Fecha</th>
                            <th>Sucursal</th>
                            
                        </tr>
                        </thead>
                        <tbody>
                          @foreach($data as  $key => $cajero)
                            <tr>
                                <td>{{ $key + 1   }}</td>
                                <td>{{ $cajero->code }} </td>
                                <td>{{ $cajero->nombre }} </td>
                                <td>{{ $cajero->direccion }} </td>
                                <td>{{ $cajero->fecha }} </td>
                                <td>{{ $cajero->sucursal->nombre }} </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('admin.cajeros.create',compact('sucursal'))
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
