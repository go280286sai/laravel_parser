@extends('admin.layout.layouts')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/plugins/datatables/dataTables.bootstrap.css'}}">
@endsection

@section('text')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Услуги
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{env('APP_URL').'/user/service/create'}}"
                           class="btn btn-success">Добавить</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($services as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$item->service}}
                                </td>
                                <td>
                                    <form action="{{env('APP_URL').'/user/service/'.$item->id.'/edit/'}}" method="get">
                                        <button type="submit" title="Редактировать" class="btn"><i
                                                class="fa fa-bars"></i></button>
                                    </form>
                                    <form action="{{env('APP_URL').'/user/service/'.$item->id}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button title="Удалить" type="submit" class="btn"><i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js')
    <!-- DataTables -->
    <script src="{{env('APP_URL').'/assets/plugins/datatables/jquery.dataTables.min.js'}}"></script>
    <script src="{{env('APP_URL').'/assets/plugins/datatables/dataTables.bootstrap.min.js'}}"></script>
    <!-- page script -->
    <script>
        $(function () {
            $("#example1").DataTable();
        });
    </script>
@endsection
