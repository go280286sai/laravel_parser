@extends('admin.layout.layouts')

@section('style')
@endsection

@section('text')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Добавить объявление
            </h1>
        </section>
        <section class="content">
            <div class="box">
                <form action="{{env('APP_URL').'/user/addCreate'}}" method="post">
                    <div class="box-header with-border">
                        @include('admin.errors')
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                @csrf
                                <label for="title">Название</label>
                                <input type="text" id="title" name="title" class="form-control" value="{{old('title')}}">
                                <label for="rooms">Количество комнат</label>
                                <input type="number" id="rooms" name="rooms" class="form-control" value="{{old('rooms')}}">
                                <label for="floor">Этаж</label>
                                <input type="number" id="floor" name="floor" class="form-control" value="{{old('floor')}}">
                                <label for="etajnost">Этажность</label>
                                <input type="number" id="etajnost" name="etajnost" class="form-control" value="{{old('etajnost')}}">
                                <label for="area">Площадь</label>
                                <input type="number" id="area" name="area" class="form-control" value="{{old('area')}}">
                                <label for="location">Расположение</label>
                                <br>
                                <select id="location" name="location" value="{{old('location')}}" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                    <option selected>{{old('location')??'Выбрать расположение'}}</option>
                                    @foreach($loc as $item)
                                       {{$item}}
                                        <option value="{{$item}}">{{$item}}</option>
                                    @endforeach
                                </select>
                                <br>
                                <label for="price">Цена, грн.</label>
                                <input type="number" id="price" name="price" class="form-control" value="{{old('price')}}">
                                <br>
                                <label for="title">Описание</label>
                                <textarea id="description" cols="30" name="description" rows="10" class="form-control">{{old('description')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">

                        <input type="submit" class="btn btn-success pull-right"
                               value="Send"><button class="mr-3 bg-orange-600 hover:bg-orange-300 text-white btn" onclick="window.history.back()">Back</button>
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
