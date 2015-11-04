@extends('admin._base.home.layout')
@section('header')
    <h1>
        Brach
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
                    <h3 class="box-title">Listado de brach</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Area</th>
                            <th>Fecha</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach($data as  $key => $branch)
                            <tr>
                                <td>{{ $key + 1   }}</td>
                                <td>{{ $branch->nombre }} </td>
                                <td>{{ $branch->area }} </td>
                                <td>{{ $branch->fecha }} </td>
                              <td><a href="#" data-url = "branches" data-id = "{{ $branch->id }}"  class="btn btn-info glyphicon glyphicon-pencil edit"></a></td>
                              <td><a href="#" data-url = "branches" data-id = "{{ $branch->id }}"  class="btn btn-danger glyphicon glyphicon-remove delete" ></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('admin.branch.create')
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
