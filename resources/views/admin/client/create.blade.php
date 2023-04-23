@extends('admin.layout.layouts')

@section('style')

@endsection

@section('text')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{__('admin.add_user')}}
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
              <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Фамилия" value="{{old('last_name')}}">
            </div>
              <div class="form-group">
              <label for="firs_name">Имя</label>
              <input type="text" name="first_name" class="form-control" id="firs_name" placeholder="Имя" value="{{old('first_name')}}">
            </div>
              <div class="form-group">
              <label for="surname">Отчество</label>
              <input type="text" name="surname" class="form-control" id="surname" placeholder="Отчество" value="{{old('surname')}}">
            </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">{{__('admin.birthday')}}</label>
                  <label for="birthday"></label><input type="date" class="form-control" id="birthday" name="birthday"
                                                       placeholder="{{__('admin.birthday')}}" value="{{old('birthday')}}">
              </div>
            <div class="form-group">
              <label for="exampleInputEmail1">{{__('admin.email')}}</label>
              <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="{{__('admin.email')}}" value="{{old('email')}}">
            </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">{{__('admin.phone_number')}}</label>
                  <input type="number" class="form-control" id="phone" name="phone"
                         placeholder="{{__('admin.phone_number')}}" value="{{old('phone')}}">
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">{{__('admin.gender')}}</label>
                  <div class="form-control">
                      <input class="form-check-input" type="radio" name="gender_id" id="flexRadioDefault1"
                             value="1">
                      <label class="form-check-label" for="flexRadioDefault1">
                          {{__('admin.gender_male')}}
                      </label>
                  </div>
                  <div class="form-control">
                      <input class="form-check-input" type="radio" name="gender_id" id="flexRadioDefault2"
                             value="2">
                      <label class="form-check-label" for="flexRadioDefault2">
                          {{__('admin.gender_female')}}
                      </label>
                  </div>
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1"> {{__('admin.about')}}</label>
                  <label for=""></label><textarea name="description" id="" cols="30" rows="10" class="form-control">{{old('description')}}</textarea>
              </div>
        </div>
      </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button class="btn btn-default" onclick="window.history.back()">{{__('admin.back')}}</button>
          <button class="btn btn-success pull-right">{{__('admin.add')}}</button>
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
