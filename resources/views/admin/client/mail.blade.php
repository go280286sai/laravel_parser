@extends('admin.layout.layouts')

@section('style')

@endsection

@section('text')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Отправить сообщение
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <form action="{{env('APP_URL').'/user/sendMessageClient'}}" method="post">
                    <div class="box-header with-border">
                        @include('admin.errors')
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Кому</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$user['email']}}" name="email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Тема</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="title">
                            </div>
                            <div class="form-group">
                                @csrf
                                <label for="exampleInputEmail1">Текст сообщения</label>
                                <textarea id="" cols="30" rows="10" class="form-control"
                                          name="content">{{old('content')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button class="btn btn-default" onclick="window.history.back()">Назад</button>
                        <input type="submit" class="btn btn-success pull-right" name="submit" value="Отправить">
                    </div>
                </form>       <!-- /.box-footer-->
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
