@extends('admin._base.home.layout')
@section('header')
    <h1>
        Bitacora
        <small>listado</small>
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Bitacora</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Estado</th>
                            <th>Cliente</th>
                            <th>Tipo Transaccion</th>
                            <th>Monto</th>
                            <th>Mensaje</th>
                            <th>Fecha</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as  $key => $value)
                            <tr>
                                <td>{{ $key + 1   }}</td>
                                <td>{{ $value->tipo }} </td>
                                <td>{{ $value->nombre . ' ' . $value->apellido }} </td>
                                <td>{{ $value->tipo_transaccion }} </td>
                                <td>{{ $value->cantidad_credito }} </td>
                                <td>{{ $value->mensaje }} </td>
                                <td>{{ $value->created_at }} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
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
