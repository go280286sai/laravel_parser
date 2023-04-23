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
                            <th>ID</th>
                            <th>{{__('admin.name')}}</th>
                            <th>{{__('admin.contact_info')}}</th>
                            <th>{{__('admin.action')}}</th>
                            <th>{{__('admin.options')}}</th>
                            <th>{{__('admin.comments')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$client->last_name.' '.$client->first_name.' '.$client->surname}}
                                </td>
                                <td><strong>{{__('admin.email')}}:</strong> {{$client->email}}
                                    <br><strong>{{__('admin.gender')}}:</strong> {{$client->gender->name??'none'}}
                                    <br><strong>{{__('admin.birthday')}}:</strong> {{$client->birthday??'none' }}
                                    <br><strong>{{__('admin.phone_number')}}:</strong> {{$client->phone??'none'}}
                                    <br><strong>{{__('admin.create_date')}}
                                        :</strong> {{date_format($client->created_at, 'd-m-Y')}}
                                </td>
                                <td>
                                    <form action="{{env('APP_URL').'/user/client/'.$client->id.'/edit'}}"
                                          method="get">
                                        @csrf
                                        <button class="btn" title="{{__('admin.edit')}}"><i class="fa fa-bars"></i>
                                        </button>
                                    </form>
                                    <form action="{{env('APP_URL').'/user/client/'.$client->id}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{$client->id}}">
                                        <button onclick="return confirm('Удалить клиента?')" class="btn"
                                                title="{{__('admin.delete')}}"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{env('APP_URL').'/user/createMessageClient'}}"
                                          method="post">
                                        <input type="hidden" name="email" value="{{$client->id}}">
                                        @csrf
                                        <button class="btn" title="{{__('admin.send_message')}}"><i
                                                class="fa fa-mail-forward"></i></button>
                                    </form>
                                    <form action="{{env('APP_URL').'/user/client_comment'}}" method="post">
                                        <input type="hidden" name="id" value="{{$client->id}}">
                                        <input type="hidden" name="comment" value="{!! $client->comment??'' !!}">
                                        @csrf
                                        <button class="btn" title="{{__('admin.add_comment')}}"><i
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
