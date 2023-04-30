@extends('admin.layout.layouts')

@section('style')
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/plugins/datatables/dataTables.bootstrap.css'}}">
@endsection
@section('text')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Недвижимость
            </h1>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body" id="apartment">
                    <div class="form-group">
                        <form action="{{env('APP_URL')}}/user/url_edit" id="{{$olx->title}}">
                            <div class="mb-3">
                                <p v-if="status" class="status_info">Обновлено</p>
                                <label for="olx_apartment" class="form-label">URL</label>
                                <input type="text" name="url" value="{{$olx->url}}" class="form-control"
                                       aria-describedby="emailHelp" id="url_olx">
                                <input type="hidden" name="id" value="{{$olx->id}}">
                                @csrf
                            </div>
                            <input type="button" v-on:click="updateInfo('{{$olx->title}}')" class="btn btn-success"
                                   value="Сохранить URL">
                        </form>
                    </div>
                    <div class="form-group">
                        <table>
                            <tr>
                                <td>
                                    <button v-on:click="getApartment" v-bind:disabled="update_status"
                                            class="mr-3 bg-orange-600 hover:bg-orange-300 text-white btn">Запустить
                                        обновление
                                    </button>
                                </td>
                                <td>
                                    <button v-on:click="getNewPrice('{{$token}}')"
                                            class="mr-3 bg-orange-600 hover:bg-orange-300 text-white btn"
                                            v-bind:disabled="update_status_sync">Выполнить синхронизацию
                                    </button>
                                </td>
                                <td><a href="{{env('APP_URL')}}/user/olx_apartment_delete_index">
                                        <button
                                            class="mr-3 bg-orange-600 hover:bg-orange-300 text-white btn">Список
                                            удаленных
                                        </button>
                                    </a></td>
                                @if(\Illuminate\Support\Facades\Auth::user()->is_admin==1)
                                    <td>
                                        <form action="{{env('APP_URL')}}/user/saveJson" method="post">
                                            @csrf
                                            <button
                                                class="mr-3 mt-6 bg-orange-600 hover:bg-orange-300 text-white btn"
                                                v-on:click="saveList">Сохранить как
                                            </button>
                                        </form>
                                    </td>
                                @endif
                                <td><a href="{{env('APP_URL')}}/user/report">
                                        <button
                                            class="mr-3 bg-orange-600 hover:bg-orange-300 text-white btn">Просмотреть
                                            отчет
                                        </button>
                                    </a></td>
                                @if(\Illuminate\Support\Facades\Auth::user()->is_admin==1)
                                    <td>
                                        <button v-on:click="cleanDb"
                                                class="mr-3 bg-orange-600 hover:bg-orange-300 text-white btn">Удалить все данные</button>
                                    </td>
                                @endif
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td><a href="{{env('APP_URL')}}/user/create_apartment">
                                        <button
                                            class="mr-3 bg-orange-600 hover:bg-orange-300 text-white btn">Создать
                                            объявление
                                        </button>
                                    </a></td>
                                <td>
                                    <button v-on:click="send_check"
                                            class="mr-3 bg-orange-600 hover:bg-orange-300 text-white btn">Удалить из
                                        базы
                                    </button>
                                </td>
                                <td>
                                    <button v-on:click="add_favorite"
                                            class="mr-3 bg-orange-600 hover:bg-orange-300 text-white btn">Добавить в
                                        избранное
                                    </button>
                                </td>
                                <td>
                                    <button v-on:click="remove_favorite"
                                            class="mr-3 bg-orange-600 hover:bg-orange-300 text-white btn">Удалить из
                                        избранного
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>Среднее отклонение прогноза: <b>{{\App\Models\Setting::getMAE()}}грн.</b> или
                        <b>{{round(\App\Models\Setting::getMAE()/$rate->dollar,2)}}$</b></div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr class="bg-orange-400">
                            <th scope="col">
                            </th>
                            <th scope="col">Заголовок</th>
                            <th scope="col">Комнаты</th>
                            <th scope="col">Этаж</th>
                            <th scope="col">Этажность</th>
                            <th scope="col">Описание</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Прогноз</th>
                            <th scope="col">Тип</th>
                            <th scope="col">Расположение</th>
                            <th scope="col">Время</th>
                            <th scope="col">Комментарий</th>
                            <th scope="col">Действие</th>
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
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}"> {{$apartment->title}}
                                    @if($apartment->favorites==1)
                                        <span class="inline-block fa fa-star" title="В избранном"></span>
                                    @endif
                                </td>
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}"> {{$apartment->rooms}}</td>
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}">{{$apartment->floor}} </td>
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}">{{$apartment->etajnost}} </td>
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}">
                                    <a href="{{$apartment->url}}"
                                       title="{{$apartment->description}}"
                                       target="_blank">{{\Illuminate\Support\Str::substr($apartment->description, 0, 150)}}
                                    </a>
                                </td>
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}">
                                    {{$apartment->price.'грн.'}}
                                    {{round($apartment->price/$rate->dollar, 2).'$'}}
                                </td>
                                <td class="{{$apartment->real_price>$apartment->price?"bg-red-200":"bg-green-200"}}">
                                    {{($apartment->real_price-$apartment->price).'грн.'}}
                                    {{round(($apartment->real_price-$apartment->price)/$rate->dollar, 2).'$'}}
                                    @if($apartment->location_index==1)
                                        <span class="inline-block fa fa-money" title="Выгодное предложение"></span>
                                    @endif
                                </td>
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}">{{$apartment->type}} </td>
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}"> {{$apartment->location}}</td>
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}">{{\Illuminate\Support\Carbon::createFromFormat('Y-m-d', $apartment->date)->format('d-m-Y')}} </td>
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}">{{$apartment->comment}} </td>
                                <td class="{{$apartment->status==0?"bg-orange-200":''}}">
                                    @if($apartment->status==0)
                                        <input type="hidden" name="" id="apartmentStatus" value="{{$apartment->id}}">
                                    @endif
                                    <form action="{{env('APP_URL').'/user/view/'.$apartment->id}}" method="get">
                                        <button class="btn"
                                                title="Редактировать"><i class="fa fa-edit"></i></button>
                                    </form>
                                    <form action="{{env('APP_URL').'/user/olx_apartment_comment/'.$apartment->id}}"
                                          method="get">
                                        <button class="btn" title="{{__('messages.comment_add')}}"><i
                                                class="fa fa-bars"></i>
                                        </button>
                                    </form>
                                    <form action="{{env('APP_URL')}}/user/olx_apartment_delete" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$apartment->id}}">
                                        <button onclick="return confirm('Вы уверенны')" class="btn"
                                                title="Удалить"><i class="fa fa-trash"></i></button>
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
    <script>
        const getStatusText = document.querySelectorAll('#apartmentStatus');
        for (let i in getStatusText) {
            getStatus(getStatusText[i].value)
        }
        function getStatus(text) {
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

@endsection
