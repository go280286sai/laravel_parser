@extends('admin.layout.layouts')

@section('style')
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/plugins/datatables/dataTables.bootstrap.css'}}">
@endsection
@section('text')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Заявки на покупку недвижимости
            </h1>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="form-group">
                        <table>
                            <tr>
                                <td>
                                    <a class="btn btn-success" href="{{env('APP_URL').'/user/documents/create'}}">Создать
                                        заявку</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr class="bg-orange-400">
                            <th scope="col">№
                            </th>
                            <th scope="col">Клиент</th>
                            <th scope="col">Услуга</th>
                            <th scope="col">Комнаты</th>
                            <th scope="col">Этажность</th>
                            <th scope="col">Расположение</th>
                            <th scope="col">Цена, грн.</th>
                            <th scope="col">Дата</th>
                            <th scope="col">Комментарий</th>
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($docs as $doc)
                            <tr>
                                <td>{{$i++}}</td>
                                <td><a href="{{env('APP_URL').'/user/client/'.$doc->client->id}}"
                                       target="_blank">{{$doc->client->last_name.' '.$doc->client->first_name.' '.$doc->client->surname}}</a>
                                </td>
                                <td>{{$doc->service->service}}</td>
                                <td>{{$doc->rooms}}</td>
                                <td>{{$doc->etajnost}}</td>
                                <td>{{$doc->location}}</td>
                                <td>{{$doc->price}}</td>
                                <td>{{\Carbon\Carbon::make($doc->created_at)->format('d-m-Y')}}</td>
                                <td>{{$doc->comment}}</td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>
                                                <form action="{{env('APP_URL').'/user/documents/'.$doc->id.'/edit'}}"
                                                      method="get">
                                                    @csrf
                                                    <button class="btn"
                                                            title="Редактировать"><i class="fa fa-edit"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{env('APP_URL').'/user/document_comment/'.$doc->id}}"
                                                      method="get">
                                                    <button class="btn" title="Добавить комментарий"><i
                                                            class="fa fa-bars"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <form action="{{env('APP_URL').'/user/documents/'.$doc->id}}"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('{{__('messages.are_you_sure')}}')"
                                                            class="btn"
                                                            title="{{__('messages.delete')}}"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            </td>

                                            <td>
                                                <form action="{{env('APP_URL').'/user/documents/'.$doc->id}}"
                                                      method="get">
                                                    <button class="btn"
                                                            title="Просмотреть"><i
                                                            class="fa fa-bitcoin"></i></button>
                                                </form>
                                            </td>
                                        </tr>

                                    </table>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
            $("#example1").DataTable();
        });
    </script>
@endsection
