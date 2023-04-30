@extends('admin.layout.layouts')

@section('style')

@endsection

@section('text')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Редактировать услугу
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <form action="{{env('APP_URL').'/user/service/'.$service->id}}" method="post">
                    @method('PUT')
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Название</label>
                                <input type="text" class="form-control" id="title"
                                       name="title"
                                       value="{{$service->service}}">
                                @csrf
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="form-group">
                            <a href="{{env('APP_URL').'/user/service'}}" class="btn btn-danger">Назад</a>
                        </div>
                        <input type="submit" class="btn btn-warning pull-right" value="Редактировать">
                    </div>
                    <!-- /.box-footer-->
                </form>
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
    <script>
        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();
            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            });
            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
        });
    </script>
@endsection
