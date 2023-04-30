@extends('admin.layout.layouts')
@section('style')

@endsection

@section('text')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Редактировать клиента
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <form action="{{env('APP_URL').'/user/client/'.$client->id}}" method="post">
                @csrf
                @method('PUT')
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        @include('admin.errors')
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name">Фамилия</label>
                                <input type="text" name="last_name" class="form-control" id="last_name"
                                       value="{{$client->last_name}}">
                            </div>
                            <div class="form-group">
                                <label for="firs_name">Имя</label>
                                <input type="text" name="first_name" class="form-control" id="firs_name"
                                       value="{{$client->first_name}}">
                            </div>
                            <div class="form-group">
                                <label for="surname">Отчество</label>
                                <input type="text" name="surname" class="form-control" id="surname"
                                       value="{{$client->surname}}">
                            </div>
                            <div class="form-group">
                                <label for="birthday">День рождения</label>
                                <input type="date" class="form-control" id="birthday" name="birthday"
                                       value="{{$client->birthday}}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Номер телефона</label>
                                <input type="number" class="form-control" id="phone" name="phone"
                                       value="{{$client->phone}}">
                            </div>
                            <div class="form-group">
                                <label for="gender_id">Пол</label>
                                <div class="form-control">
                                    <input class="form-check-input" type="radio" name="gender_id" id="gender_id"
                                           value="1" {{($client->gender_id=='1')?'checked':''}}>
                                    <label class="form-check-label" for="gender_id">
                                        Мужской
                                    </label>
                                </div>
                                <div class="form-control">
                                    <input class="form-check-input" type="radio" name="gender_id" id="gender_id"
                                           value="2"
                                        {{($client->gender_id=='2')?'checked':''}}>
                                    <label class="form-check-label" for="gender_id">
                                        Женский
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Обо мне</label>
                                <textarea name="description" id="" cols="30" rows="10"
                                          class="form-control">{{$client->description}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="form-group">
                            <a href="{{env('APP_URL').'/user/client'}}" class="btn btn-danger">Назад</a>
                        </div>
                        <button class="btn btn-warning pull-right">Редактировать</button>
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
