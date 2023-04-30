@extends('admin.layout.layouts')

@section('style')

@endsection

@section('text')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Сообщение пользователю
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <form action="{{env('APP_URL').'/user/sendMessage'}}" method="post">
                    <div class="box-header with-border">
                        @include('admin.errors')
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Кому</label>
                                <input type="text" disabled="disabled" class="form-control" id="email"
                                       value="{{$user['email']}}">
                                <input type="hidden" value="{{$user['email']}}" name="email">
                            </div>
                            <div class="form-group">
                                <label for="title">Тема</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{old('title')}}">
                            </div>
                            <div class="form-group">
                                @csrf
                                <label for="content">Текст сообщения</label>
                                <textarea id="content" cols="30" rows="10" class="form-control"
                                          name="content">{{old('content')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="form-group">
                            <a href="{{env('APP_URL').'/user/users'}}" class="btn btn-danger">Назад</a>
                        </div>
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
