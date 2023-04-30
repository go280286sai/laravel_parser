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
                <div class="box-footer">
                    <input type="button" onclick="getPredict('{{$doc->client->email}}')"
                           class="btn btn-success pull-left"
                           value="Подобрать варианты">
                </div>
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
    <script>function getPredict(email) {
            let rooms = $('#rooms').val();
            let etajnost = $('#etajnost').val();
            let price = $('#price').val();
            let location = $('#location').val();
            let object = {'rooms': rooms, 'etajnost': etajnost, 'price': price, 'location': location};
            axios.post('http://192.168.0.107:8000/getPredict', JSON.stringify(object)).then(df => {
                axios.post('/user/getApartment', {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'text': df.data
                }).then(data => {
                    let text = `<form action="/user/getApartment" method="post">
@csrf`;
                    text += `<table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr class="bg-orange-400">
                            <th scope="col">Название</th>
                            <th scope="col">Комнаты</th>
                            <th scope="col">Этаж</th>
                            <th scope="col">Этажность</th>
                            <th scope="col">Описание</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Расположение</th>
                        </tr>
                        </thead>
                        <tbody>`;
                    let list = '';
                    for (let index in data.data[0]) {
                        list += data.data[0][index].id + ',';
                        text +=
                            `<tr>
                            <td class="bg-orange-200"><a href="${data.data[0][index].url}" target="_blank">${data.data[0][index].title}</a></td>
                            <td class="bg-orange-200">${data.data[0][index].rooms}</td>
                            <td class="bg-orange-200">${data.data[0][index].floor}</td>
                            <td class="bg-orange-200">${data.data[0][index].etajnost}</td>
                            <td class="bg-orange-200">${data.data[0][index].description}</td>
                            <td class="bg-orange-200">${data.data[0][index].price}</td>
                            <td class="bg-orange-200">${data.data[0][index].location}</td>
                            </tr>`
                        ;
                    }


                    text += `</tbody>
                    </table>`;
                    text += `<input type="hidden" name="data" value="${list}">
<input type="hidden" name="email" value="${email}">
<br> <input class="btn btn-danger" type="submit" value="Отправить на почту">
</form>`;
                    $('#body').html(text);
                })
            }).catch(err => {
                console.log(err.messages)
            })
        }
    </script>
@endsection
