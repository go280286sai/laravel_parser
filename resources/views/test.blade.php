<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div id="text">{{$data}}</div>
{{--<div id="text">[@foreach($data as $item){"id":"{{$item->id}}","rooms":"{{$item->rooms}}","floor":"{{$item->floor}}", "etajnost":"{{$item->etajnost}}","price":"{{$item->price}}","date":"{{$item->date}}"},@endforeach]</div>--}}

</body>
</html>
<script src="{{env('APP_URL').'/assets/plugins/jQuery/jquery-2.2.3.min.js'}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    let text = {{$data}}
    console.log(text)
    axios.post('http://localhost:8000/olx_apartment',text).then((data) => {
        console.log(data)
    }).catch((err) => {
        console.log(err.message);
    })
</script>

