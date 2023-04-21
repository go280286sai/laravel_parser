@extends('admin.layout.layouts')
@section('style')

@endsection

@section('text')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{__('admin.edit_user')}}
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <form action="{{env('APP_URL').'/user/users/'.$user->id}}" method="post">
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
                            <label for="exampleInputEmail1">Имя</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder=""
                                   value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{__('admin.birthday')}}</label>
                            <label for="birthday"></label><input type="date" class="form-control" id="birthday" name="birthday"
                                                                 placeholder="{{__('admin.birthday')}}" value="{{$user->birthday}}">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{__('admin.phone_number')}}</label>
                                <input type="" class="form-control" id="phone" name="phone"
                                       placeholder="{{__('admin.phone_number')}}" value="{{$user->phone}}">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{__('admin.gender')}}</label>
                                <div class="form-control">
                                    <input class="form-check-input" type="radio" name="gender_id" id="flexRadioDefault1"
                                           value="1" {{($user->gender_id=='1')?'checked':''}}>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        {{__('admin.gender_male')}}
                                    </label>
                                </div>
                                <div class="form-control">
                                    <input class="form-check-input" type="radio" name="gender_id" id="flexRadioDefault2"
                                           value="2"
                                        {{($user->gender_id=='2')?'checked':''}}>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        {{__('admin.gender_female')}}
                                    </label>
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">{{__('admin.about')}}</label>
                            <label for=""></label><textarea name="description" id="" cols="30" rows="10" class="form-control">{{$user->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{__('admin.password')}}</label>
                            <input type="password" class="form-control" id="exampleInputEmail1" name="password"
                                   placeholder="{{__('admin.password')}}">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-default" onclick="window.history.back()">{{__('admin.back')}}</button>
                    <button class="btn btn-warning pull-right">{{__('admin.edit')}}</button>
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
