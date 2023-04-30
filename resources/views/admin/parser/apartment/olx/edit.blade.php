@extends('admin.layout.layouts')

@section('style')
@endsection
@section('text')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Редактировать объявление
            </h1>
        </section>
        <section class="content">
            <div class="box" id="create_apartment">
                <form action="{{env('APP_URL').'/user/edit'}}" method="post">
                    <div class="box-header with-border">
                        @include('admin.errors')
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                @csrf
                                <label for="title">Название</label>
                                <input type="text" id="title" name="title" class="form-control" value="{{$apartment->title}}">
                                <label for="rooms">Количество комнат</label>
                                <input type="number" id="rooms" name="rooms" class="form-control" value="{{$apartment->rooms}}">
                                <label for="floor">Этаж</label>
                                <input type="number" id="floor" name="floor" class="form-control" value="{{$apartment->floor}}">
                                <label for="etajnost">Этажность</label>
                                <input type="number" id="etajnost" name="etajnost" class="form-control" value="{{$apartment->etajnost}}">
                                <label for="area">Площадь</label>
                                <input type="number" id="area" name="area" class="form-control" value="{{$apartment->area}}">
                                <label for="location">Расположение</label>
                                <br>
                                <select id="location" name="location" value="{{$apartment->location}}" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                    <option selected>{{$apartment->location}}</option>
                                    @foreach($loc as $item)
                                       {{$item}}
                                        <option value="{{$item}}">{{$item}}</option>
                                    @endforeach
                                </select>
                                <br>
                                <label for="location">Contact</label>
                                <br>
                                @if($contact!=null)
                                    <select id="url" name="url" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                        <option value="{{$contact->id}}" selected> {{$contact->last_name.' '.$contact->first_name.' '.$contact->surname}}</option>
                                        @foreach($contacts as $item)
                                            {{$item->last_name.' '.$item->first_name}}
                                            <option value="{{$item->id}}">{{$item->last_name.' '.$item->first_name.' '.$item->surname}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="text" name="url" class="form-control" value="{{$apartment->url}}">
                                @endif

                                <br>
                                <label for="price">Цена, грн.</label>
                                <input type="number" id="price" name="price" class="form-control" value="{{$apartment->price}}">
                                <input type="hidden" name="id" value="{{$apartment->id}}">
                                <br>
                                <label for="title">Описание</label>
                                <textarea id="description" cols="30" name="description" rows="10" class="form-control">{{$apartment->description}}</textarea>
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
    <script src="{{env('APP_URL').'/assets/plugins/datatables/jquery.dataTables.min.js'}}"></script>
    <script src="{{env('APP_URL').'/assets/plugins/datatables/dataTables.bootstrap.min.js'}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
            integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
            crossorigin="anonymous"></script>
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
