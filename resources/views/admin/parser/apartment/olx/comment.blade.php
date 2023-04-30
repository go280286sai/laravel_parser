@extends('admin.layout.layouts')

@section('style')
@endsection

@section('text')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Добавить комментарий
            </h1>
        </section>
        <section class="content">
            <div class="box">
                <form action="{{env('APP_URL').'/user/olx_apartment_comment'}}" method="post">
                    <div class="box-header with-border">
                        @include('admin.errors')
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                @csrf
                                <label for="title">Title</label>
                                <input type="text" id="title" value="{{$data->title}}" class="form-control"
                                       disabled="disabled">
                                <br>
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <textarea id="" cols="30" rows="10" class="form-control"
                                          name="comment">{!! $data->comment??'' !!}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="form-group">
                            <a href="{{env('APP_URL').'/user/apartment'}}" class="btn btn-danger">Назад</a>
                        </div>
                        <input type="submit" class="btn btn-success pull-right" name="submit"
                               value="Добавить">
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $(".select2").select2();
            $('#datepicker').datepicker({
                autoclose: true
            });
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
        });
    </script>
@endsection
