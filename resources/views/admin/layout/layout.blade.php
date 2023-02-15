<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{$title??'Admin parse site'}}</title>
    @vite('resources/css/app.css')
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
</head>
<body>

<div id="wrapper">
    @include('admin.layout.main')
    @include('admin.layout.sidebar')
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                   @section('text')
                    @show
                </div>
            </div>
            <hr/>
        </div>
    </div>
</div>
@vite('resources/js/app.js')
</body>
</html>
