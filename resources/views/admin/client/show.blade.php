@extends('admin.layout.layouts')
@section('style')

@endsection

@section('text')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Данные пользователя
            </h1>
        </section>
        <section>
            <!-- Main content -->
            <div class="box">
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name">Фамилия</label>
                            <input disabled="disabled" type="text" name="last_name" class="form-control" id="last_name"
                                   value="{{$client->last_name}}">
                        </div>
                        <div class="form-group">
                            <label for="firs_name">Имя</label>
                            <input disabled="disabled" type="text" name="first_name" class="form-control" id="firs_name"
                                   value="{{$client->first_name}}">
                        </div>
                        <div class="form-group">
                            <label for="surname">Отчество</label>
                            <input disabled="disabled" type="text" name="surname" class="form-control" id="surname"
                                   value="{{$client->surname}}">
                        </div>
                        <div class="form-group">
                            <label for="birthday">День рождения</label>
                            <input disabled="disabled" type="date" class="form-control" id="birthday" name="birthday"
                                   value="{{$client->birthday}}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Номер телефона</label>
                            <input disabled="disabled" type="number" class="form-control" id="phone" name="phone"
                                   value="{{$client->phone}}">
                        </div>
                        <div class="form-group">
                            <label for="gender_id">Пол</label>
                            <div class="form-control">
                                <input disabled="disabled" class="form-check-input" type="radio" name="gender_id"
                                       id="flexRadioDefault1"
                                       value="1" {{($client->gender_id=='1')?'checked':''}}>
                                <label class="form-check-label" for="gender_id">
                                    Мужской
                                </label>
                            </div>
                            <div class="form-control">
                                <input disabled="disabled" class="form-check-input" type="radio" name="gender_id"
                                       id="gender_id"
                                       value="2"
                                    {{($client->gender_id=='2')?'checked':''}}>
                                <label class="form-check-label" for="gender_id">
                                    Женский
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Дополнительно</label>
                            <textarea disabled="disabled" name="description" id="" cols="30" rows="10"
                                      class="form-control">{{$client->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="comment">Комментарий</label>
                            <textarea disabled="disabled" name="comment" id="comment" cols="30" rows="10"
                                      class="form-control">{{$client->comment}}</textarea>
                        </div>
                        <form action="{{env('APP_URL').'/user/client_comment'}}" method="post">
                            <input type="hidden" name="id" value="{{$client->id}}">
                            <input type="hidden" name="comment" value="{!! $client->comment??'' !!}">
                            @csrf
                            <button class="btn btn-success" title="{{__('admin.add_comment')}}">Добавить комментарий
                            </button>
                        </form>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-warning pull-right" onclick="window.close()">Закрыть</button>
                </div>
                <!-- /.box-footer-->
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
