@extends('admin.layout.layouts')

@section('style')
@endsection

@section('text')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                {{__('messages.delete_list')}}
            </h1>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="form-group">
                        <table>
                            <tr>
                                <td>
                                    <form action="{{env('APP_URL').'/user/olx_apartment_recovery_all'}}" method="get">
                                        <button title="{{__('messages.recovery_all')}}?"
                                                onclick="return confirm('{{__('messages.are_you_sure')}}')"
                                                class="mr-3 bg-orange-600 hover:bg-orange-300 text-white btn"><i>{{__('messages.recovery_all')}}</i></button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{env('APP_URL').'/user/olx_apartment_delete_all'}}" method="get">
                                        <button title="{{__('messages.delete_all')}}?"
                                                onclick="return confirm('{{__('messages.are_you_sure')}}')"
                                                class="mr-3 bg-orange-600 hover:bg-orange-300 text-white btn"><i>{{__('messages.delete_all')}}</i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Цена</th>
                            <th>Дата</th>
                            <th>Описание</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trash as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>
                                    <a href="{{$item->url}}" target="_blank">{{$item->title}}</a>
                                </td>
                                <td> {{$item->price}}</td>
                                <td>{{date_format($item->created_at, 'd-m-Y')}}
                                </td>
                                <td>
                                    {{\Illuminate\Support\Str::substr($item->description, 0, 200)}}
                                </td>
                                <td>
                                    <form action="{{env('APP_URL').'/user/olx_apartment_recovery_item/'.$item->id}}" method="get">
                                        <button title="{{__('messages.recovery')}}?"
                                                onclick="return confirm('{{__('messages.are_you_sure')}}')"
                                                class="btn"><i
                                                class="fa fa-bars"></i></button>
                                    </form>
                                    <form action="{{env('APP_URL').'/user/olx_apartment_delete_item/'.$item->id}}" method="post">
                                        <button title="{{__('messages.delete')}}?"
                                                onclick="return confirm('{{__('messages.are_you_sure')}}')"
                                                class="btn"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="box-footer">
                    <button class="btn btn-success" onclick="window.history.back()">Назад</button>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $("#example1").DataTable();
        });
    </script>
@endsection
