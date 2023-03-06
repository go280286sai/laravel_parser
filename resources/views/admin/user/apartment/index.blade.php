@extends('admin.layout.layouts')
@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/plugins/datatables/dataTables.bootstrap.css'}}">
@endsection
@section('text')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                {{__('admin.list_posts')}}
            </h1>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body" id="apartment">
                    <div class="form-group">
                        <form action="/user/url_edit" id="{{$olx->title}}">
                            <div class="mb-3">
                                <p v-if="status">Данные обновлены</p>
                                <label for="olx_apartment" class="form-label">Ссылка для мониторинга:</label>
                                <input type="text" name="url" value="{{$olx->url}}" class="form-control"
                                       aria-describedby="emailHelp" id="url_olx">
                                <input type="hidden" name="id" value="{{$olx->id}}">
                                @csrf
                            </div>
                            <input type="button" v-on:click="updateInfo('{{$olx->title}}')" class="btn btn-danger"
                                   value="Update">
                        </form>
                    </div>
                    <div class="form-group">
                        <button v-on:click="getApartmentFull" class="btn btn-danger">Загрузить список</button>
                        <button v-on:click="getApartmentFull" class="btn btn-default">Запустить обновление</button>
                    </div>
                    <div class="form-group">
                        <form action="/user/csv" method="post">
                            <input type="hidden" v-bind:value="csv" name="data">
                            @csrf
                            <button v-on:click="saveList" class="btn btn-default">Сохранить как</button>
                        </form>
                        <form action="{{env('APP_URL').'/user/cleanDb'}}" method="post" id="cleanDb">
                            <input type="hidden" name="target" value="olx_apartment">
                            @csrf
                            <button type="button" v-on:click="cleanDb">Очистить базу</button>
                        </form>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Rooms</th>
                            <th scope="col">Floor</th>
                            <th scope="col">Etajnost</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Type</th>
                            <th scope="col">Location</th>
                            <th scope="col">Time</th>
                            <th scope="col">Views</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($apartments as $apartment)
                            <tr>
                                <td> <a href="{{$apartment->url}}">{{$apartment->title}}</a></td>
                                <td> {{$apartment->rooms}}</td>
                                <td>{{$apartment->floor}} </td>
                                <td>{{$apartment->etajnost}} </td>
                                <td>{{$apartment->description}} </td>
                                <td>{{$apartment->price}} </td>
                                <td>{{$apartment->type}} </td>
                                <td> {{$apartment->location}}</td>
                                <td>{{$apartment->date}} </td>
                                <td>{{$apartment->views}} </td>
                                <td>{{$apartment->comment}} </td>
                                <td>{{$apartment->action}} </td>
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
    <script src="https://unpkg.com/vue@next"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{env('APP_URL').'/assets/parser/apartment/index.js'}}"></script>
    <script src="{{env('APP_URL').'/assets/parser/apartment/view.js'}}"></script>
    <script src="{{env('APP_URL').'/assets/parser/olx.js'}}"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
        });
    </script>
@endsection
