@extends('admin._base.home.layout')
@section('header')
    <h1>
        Transacciones
        <small>listado</small>
    </h1>
    <ol class="breadcrumb" style="">
        <a href="#modal-create" class="btn btn-block btn-primary btn-sm create" data-toggle="modal">Realizar Pago</a>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Listado de pagos</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Codigo</th>
                            <th>Monto</th>
                            <th>Estado</th>
                            <th>Cliente</th>
                            <th>Moneda</th>
                            <th>Fecha</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as  $key => $value)
                            <tr>
                                <td>{{ $key + 1   }}</td>
                                <td>{{ $value->code }} </td>
                                <td>{{ $value->monto }} </td>
                                <td>{{ $value->estado }} </td>
                                <td>{{ $value['credito']['cliente']['codigo'] }}</td>
                                <td>{{ $value['moneda']['descripcion'] }}</td>
                                <td>{{ $value->created_at }} </td>
                                <td><a href="#" data-url = "clientes" data-id = "{{ $value->id }}"  class="btn btn-info glyphicon glyphicon-th-list edit"></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('admin.pagos.create',compact('monedas'))
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
