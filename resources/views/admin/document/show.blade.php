@extends('admin.layout.layouts')

@section('style')
@endsection
<script src="https://unpkg.com/vue@next"></script>
@section('text')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Просмотреть заявку
            </h1>
        </section>
        <section class="content">
            <div class="box" id="create_apartment">
                <form action="{{env('APP_URL').'/user/documents/'.$doc->id}}" method="post">
                    @method('PUT')
                    <div class="box-header with-border">
                        @include('admin.errors')
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                @csrf
                                <br>
                                <label class="form-label" for="client_id">Выбрать клиента</label>
                                <br>
                                <select disabled="disabled" id="client_id" name="client_id"
                                        class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                    <option value="{{$doc->client_id}}"
                                            selected>{{$doc->client->last_name.' '.$doc->client->first_name.' '.$doc->client->surname}}</option>
                                    @foreach($contacts as $item)
                                        {{$item->last_name.' '.$item->first_name.' '.$item->surname}}
                                        <option
                                            value="{{$item->id}}">{{$item->last_name.' '.$item->first_name.' '.$item->surname}}</option>
                                    @endforeach
                                </select>
                                <br>
                                <label class="form-label" for="service_id">Выбрать услугу</label>
                                <br>
                                <select disabled="disabled" id="service_id" name="service_id"
                                        class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                    <option value="{{$doc->service_id}}" selected>{{$doc->service->service}}</option>
                                    @foreach($service as $item)
                                        {{$item->service}}
                                        <option value="{{$item->id}}">{{$item->service}}</option>
                                    @endforeach
                                </select>
                                <br>
                                <label class="form-label" for="rooms">Количество комнат</label>
                                <input type="number" id="rooms" name="rooms" class="form-control"
                                       value="{{$doc->rooms}}">
                                <label for="etajnost">Этажность</label>
                                <input type="number" id="etajnost" name="etajnost" class="form-control"
                                       value="{{$doc->etajnost}}">
                                <label for="location">Расположение</label>
                                <br>
                                <select id="location" name="location" class="form-select form-select-lg mb-3"
                                        aria-label=".form-select-lg example">
                                    <option value="{{$doc->location}}" selected>{{$doc->location}}</option>
                                    @foreach($loc as $item)
                                        {{$item}}
                                        <option value="{{$item}}">{{$item}}</option>
                                    @endforeach
                                </select>
                                <br>
                                <label for="price">Цена, грн.</label>
                                <input type="number" id="price" name="price" class="form-control"
                                       value="{{$doc->price}}">
                                <br>
                                <label for="title">Комментарий</label>
                                <textarea disabled="disabled" id="comment" cols="30" name="comment" rows="10"
                                          class="form-control">{{$doc->comment}}</textarea>
                            </div>
                        </div>
                    </div>
                </form>
                <input type="hidden" id="getEmail" value="{{$doc->client->email}}" />
                <div id="body"></div>
                <div class="box-footer">
                    <div class="form-group">
                        <a href="{{env('APP_URL').'/user/documents'}}" class="btn btn-danger">Назад</a>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection

@section('js')
    @vite('resources/js/app.jsx');
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
