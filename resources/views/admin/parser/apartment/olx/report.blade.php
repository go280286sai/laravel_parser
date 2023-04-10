@extends('admin.layout.layouts')
@section('style')
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/plugins/datatables/dataTables.bootstrap.css'}}">
@endsection
@section('text')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Отчет на {{\Carbon\Carbon::now()->format('d-m-Y')}}
            </h1>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body" id="apartment">
                    <div class="form-group">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr class="bg-orange-400">
                                <th scope="col">Комнаты</th>
                                <th scope="col">Этаж</th>
                                <th scope="col">Этажность</th>
                                <th scope="col">Расположение</th>
                                <th scope="col">Средняя цена, грн.</th>
                                <th scope="col">Средняя цена, $</th>
                                <th scope="col">Прогнозируемая средняя цена, $</th>
                                <th scope="col">Количество</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($group as $item)
                                <tr class="bg-orange-200">
                                    <th scope="row">{{$item->rooms}}</th>
                                    <td>{{$item->floor}}</td>
                                    <td>{{$item->etajnost}}</td>
                                    <td>{{$item->location}}</td>
                                    <td>{{$item->price}}грн.</td>
                                    <td>{{round($item->price/$rate[0]->dollar,2)}}$</td>
                                    <td><p class={{(round($item->real_price/$rate[0]->dollar,2)-round($item->price/$rate[0]->dollar,2))>0?"text-red-700":"text-blue-700"}}>{{round($item->real_price/$rate[0]->dollar,2)}}$  &ensp; &ensp; &ensp; &ensp;
                                            {{round($item->real_price/$rate[0]->dollar,2)-round($item->price/$rate[0]->dollar,2)}}$</p></td>
                                    <td>{{$item->count}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <img src="{{\App\Models\OlxApartment::getImage('matrix.png')}}" alt="">
                    <br>
                    <img src="{{\App\Models\OlxApartment::getImage('importance.png')}}" alt="">

                    <div class="box-footer">
                        <button class="mr-3 bg-orange-600 hover:bg-orange-300 text-white btn"
                                onclick="window.history.back()">Back
                        </button>
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
            $("#example1").DataTable();
        });
    </script>
@endsection
