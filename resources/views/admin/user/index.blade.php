@extends('admin.layout.layouts')

@section('style')

@endsection

@section('text')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Список пользователей
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{env('APP_URL').'/user/users/create'}}" class="btn btn-success">Добавить
                            пользователя</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Пользователь</th>
                            <th>Контактная информация</th>
                            <th>Аватар</th>
                            <th>Действия</th>
                            <th>Опции</th>
                            <th>Комментарий</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}
                                    <br>
                                </td>
                                <td><strong>Почта:</strong> {{$user->email}}
                                    <br><strong>Пол:</strong> {{$user->gender->name??'none'}}
                                    <br><strong>День рождения:</strong> {{$user->birthday??'none' }}
                                    <br><strong>Номер телефона:</strong> {{$user->phone??'none'}}
                                    <br><strong>Дата регистрации:</strong> {{date_format($user->created_at, 'd-m-Y')}}
                                </td>
                                <td>
                                    <img src="{{$user->getAvatar()}}" alt="" class="img-responsive" width="150">
                                </td>
                                <td>
                                    <form action="{{env('APP_URL').'/user/users/'.$user->id.'/edit'}}"
                                          method="get">
                                        <button class="btn" title="Редактировать"><i class="fa fa-bars"></i>
                                        </button>
                                    </form>
                                    <form action="{{env('APP_URL').'/user/users/'.$user->id}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{$user->id}}">
                                        <button onclick="return confirm('Удалить пользователя?')" class="btn"
                                                title="Удалить"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{env('APP_URL').'/user/createMessage/'.$user->id}}"
                                          method="get">
                                        <button class="btn" title="Отправить сообщение пользователю"><i
                                                class="fa fa-mail-forward"></i></button>
                                    </form>
                                    <form action="{{env('APP_URL').'/user/comment/'.$user->id}}" method="get">
                                        <button class="btn" title="Добавить комментарий"><i
                                                class="fa fa-comment"></i></button>
                                    </form>
                                </td>
                                <td>{!! $user->comment??'' !!}</td>
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
    <!-- page script -->
    <script>
        $(function () {
            $("#example1").DataTable();
        });
    </script>
@endsection
