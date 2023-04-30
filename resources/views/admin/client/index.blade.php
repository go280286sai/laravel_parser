@extends('admin.layout.layouts')

@section('style')
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/plugins/datatables/dataTables.bootstrap.css'}}">
@endsection

@section('text')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Список клиентов
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{env('APP_URL').'/user/client/create'}}" class="btn btn-success">Добавить клиента</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Имя</th>
                            <th>Клиент</th>
                            <th>Действие</th>
                            <th>Опции</th>
                            <th>Комментарий</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$client->last_name.' '.$client->first_name.' '.$client->surname}}
                                </td>
                                <td><strong>Почта:</strong> {{$client->email}}
                                    <br><strong>Пол:</strong> {{$client->gender->name??'none'}}
                                    <br><strong>Дата рождения:</strong> {{$client->birthday??'none' }}
                                    <br><strong>Номер телефона:</strong> {{$client->phone??'none'}}
                                    <br><strong>Дата регистрации:</strong> {{date_format($client->created_at, 'd-m-Y')}}
                                </td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>
                                                <form action="{{env('APP_URL').'/user/add_buy/'.$client->id.'/1'}}"
                                                      method="get">
                                                    <button class="btn" title="Купить"><i class="fa fa-dollar"></i>
                                                    </button>
                                                </form>
                                                <form action="{{env('APP_URL').'/user/add_sell/'.$client->id.'/2'}}"
                                                      method="get">
                                                    <button class="btn" title="Продать"><i class="fa fa-money"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{env('APP_URL').'/user/client/'.$client->id.'/edit'}}"
                                                      method="get">
                                                    @csrf
                                                    <button class="btn" title="Редактировать"><i class="fa fa-bars"></i>
                                                    </button>
                                                </form>
                                                <form action="{{env('APP_URL').'/user/client/'.$client->id}}"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{$client->id}}">
                                                    <button onclick="return confirm('Удалить клиента?')" class="btn"
                                                            title="Удалить"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <form action="{{env('APP_URL').'/user/createMessageClient/'.$client->id}}"
                                          method="get">
                                        @csrf
                                        <button class="btn" title="Отправить сообщение"><i
                                                class="fa fa-mail-forward"></i></button>
                                    </form>
                                    <form action="{{env('APP_URL').'/user/client_comment/'.$client->id}}" method="get">
                                        <button class="btn" title="Добавить комментарий"><i
                                                class="fa fa-comment"></i></button>
                                    </form>
                                </td>
                                <td>{!! $client->comment??'' !!}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
    <script src="{{env('APP_URL').'/assets/plugins/datatables/jquery.dataTables.min.js'}}"></script>
    <script src="{{env('APP_URL').'/assets/plugins/datatables/dataTables.bootstrap.min.js'}}"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
        });
    </script>
@endsection
