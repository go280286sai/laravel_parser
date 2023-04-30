@extends('admin.layout.layouts')

@section('style')

@endsection

@section('text')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Добавить клиента
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <form action="{{env('APP_URL').'/user/client'}}" method="post">
                @csrf
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        @include('admin.errors')
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name">Фамилия</label>
                                <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Фамилия"
                                       value="{{old('last_name')}}">
                            </div>
                            <div class="form-group">
                                <label for="firs_name">Имя</label>
                                <input type="text" name="first_name" class="form-control" id="firs_name" placeholder="Имя"
                                       value="{{old('first_name')}}">
                            </div>
                            <div class="form-group">
                                <label for="surname">Отчество</label>
                                <input type="text" name="surname" class="form-control" id="surname" placeholder="Отчество"
                                       value="{{old('surname')}}">
                            </div>
                            <div class="form-group">
                                <label for="birthday">День рождения</label>
                                <input type="date" class="form-control" id="birthday" name="birthday" placeholder="День рождения"
                                       value="{{old('birthday')}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" id="email" placeholder="Email"
                                       value="{{old('email')}}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Номер телефона</label>
                                <input type="number" class="form-control" id="phone" name="phone" placeholder="Номер телефона"
                                       value="{{old('phone')}}">
                            </div>
                            <div class="form-group">
                                <label for="gender_id">Пол</label>
                                <div class="form-control">
                                    <input class="form-check-input" type="radio" name="gender_id" id="gender_id"
                                           value="1">
                                    <label class="form-check-label" for="gender_id">
                                        Мужской
                                    </label>
                                </div>
                                <div class="form-control">
                                    <input class="form-check-input" type="radio" name="gender_id" id="gender_id"
                                           value="2">
                                    <label class="form-check-label" for="gender_id">
                                        Женский
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Обо мне</label>
                                <textarea name="description" id="" cols="30" rows="10"
                                          class="form-control">{{old('description')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="form-group">
                            <a href="{{env('APP_URL').'/user/client'}}" class="btn btn-danger">Назад</a>
                        </div>
                        <button class="btn btn-success pull-right">Добавить</button>
                    </div>
                    <!-- /.box-footer-->
                </div>
                <!-- /.box -->
            </form>
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
