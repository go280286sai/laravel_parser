@extends('admin.layout.layouts')

@section('style')
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/plugins/datatables/dataTables.bootstrap.css'}}">
@endsection
@section('text')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                {{__('messages.olx_apartment')}}
            </h1>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body" id="apartment">
                    <div class="form-group">
                        <form action="{{env('APP_URL')}}/user/url_edit" id="{{$olx->title}}">
                            <div class="mb-3">
                                <p v-if="status" class="status_info">{{__('messages.data_update')}}</p>
                                <label for="olx_apartment" class="form-label">URL</label>
                                <input type="text" name="url" value="{{$olx->url}}" class="form-control"
                                       aria-describedby="emailHelp" id="url_olx">
                                <input type="hidden" name="id" value="{{$olx->id}}">
                                @csrf
                            </div>
                            <input type="button" v-on:click="updateInfo('{{$olx->title}}')" class="btn btn-success"
                                   value="Save URL">
                        </form>
                    </div>
                    <div class="form-group">
                        <table>
                            <tr>
                                <td>
                                    <button v-on:click="send_check"
                                            class="mr-3 bg-orange-600 hover:bg-orange-300 text-white btn">{{__('messages.delete')}}</button>
                                </td>
                                <td class="tbl_btn">
                                    <button onclick="document.location.reload();"
                                            class="mr-3 bg-orange-600 hover:bg-orange-300 text-white btn">{{__('messages.update_list')}}</button>
                                </td>
                                <td>
                                    <button v-on:click="getApartment" v-bind:disabled="update_status"
                                            class="mr-3 bg-orange-600 hover:bg-orange-300 text-white btn">{{__('messages.start_update')}}</button>
                                </td>
                                <td>
                                    <button v-on:click="cleanDb"
                                            class="mr-3 bg-orange-600 hover:bg-orange-300 text-white btn">{{__('messages.clean_db')}}</button>
                                </td>
                                <td><a href="{{env('APP_URL')}}/user/olx_apartment_delete_index">
                                        <button
                                            class="mr-3 bg-orange-600 hover:bg-orange-300 text-white btn">{{__('messages.delete_list')}}</button>
                                    </a></td>
                                <td>
                                        <button v-on:click="getNewPrice('{{$data}}')"
                                            class="mr-3 bg-orange-600 hover:bg-orange-300 text-white btn">{{__('messages.get_new_price')}}</button>

                                </td>
                                <td>
                                    <form action="{{env('APP_URL')}}/user/saveJson" method="post">
                                        @csrf
                                        <button
                                            class="mr-3 mt-6 bg-orange-600 hover:bg-orange-300 text-white btn">{{__('messages.save_as')}}</button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr class="bg-orange-400">
                            <th scope="col">
                            </th>
                            <th scope="col">Title</th>
                            <th scope="col">Rooms</th>
                            <th scope="col">Floor</th>
                            <th scope="col">Etajnost</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Corr_price</th>
                            <th scope="col">Type</th>
                            <th scope="col">Location</th>
                            <th scope="col">Time</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($apartments as $apartment)
                            <tr>
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}">
                                    <div class="form-check">
                                        <input v-model="check_items" name="check_items"
                                               class="form-check rounded text-danger" type="checkbox"
                                               value="{{$apartment->id}}" id="flexCheckDefault">
                                    </div>
                                </td>
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}"> {{$apartment->title}}</td>
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}"> {{$apartment->rooms}}</td>
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}">{{$apartment->floor}} </td>
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}">{{$apartment->etajnost}} </td>
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}">
                                    <a href="{{$apartment->url}}"
                                       title="{{$apartment->description}}"
                                       target="_blank">{{\Illuminate\Support\Str::substr($apartment->description, 0, 150)}}
                                    </a>
                                </td>
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}">{{$apartment->price}} </td>
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}">{{$apartment->real_price}} </td>
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}">{{$apartment->type}} </td>
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}"> {{$apartment->location}}</td>
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}">{{\Illuminate\Support\Carbon::createFromFormat('Y-m-d', $apartment->date)->format('d-m-Y')}} </td>
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}">{{$apartment->comment}} </td>
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}">
                                    @if($apartment->status==0)
                                        <script>
                                            getStatus({{$apartment->id}})
                                            function getStatus(text)
                                            {
                                                console.log(text)
                                                setTimeout(() => {
                                                    axios.post('/user/set_status', {
                                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                                        'id': text
                                                    }).then(() => {
                                                        console.log('status ok')
                                                    }).catch((err) => {
                                                        console.log(err.message);
                                                    })
                                                }, 300000)
                                            }
                                        </script>
                                    @endif
                                    <form action="{{env('APP_URL')}}/user/olx_apartment_comment"
                                          method="get">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$apartment->id}}">
                                        <button class="btn" title="{{__('messages.comment_add')}}"><i
                                                class="fa fa-bars"></i>
                                        </button>
                                    </form>
                                    <form action="{{env('APP_URL')}}/user/olx_apartment_delete" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$apartment->id}}">
                                        <button onclick="return confirm('{{__('messages.are_you_sure')}}')" class="btn"
                                                title="{{__('messages.delete')}}"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
<script src="https://unpkg.com/vue@next"></script>
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