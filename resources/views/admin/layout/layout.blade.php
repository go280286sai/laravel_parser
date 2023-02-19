<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{$title??''}}</title>
    <!-- BOOTSTRAP STYLES-->
    @vite('resources/css/app.css')
    <!-- GOOGLE FONTS-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
</head>
<body>
<div id="wrapper">
    <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">{{env('APP_NAME')}}</a>
        </div>
        <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
                {{Form::open(['url'=>'logout', 'method'=>'post'])}}
                @csrf
                {{Form::button('Logout', ['value'=>'Logout','name' => 'submit', 'type'=>'submit', 'class'=>'btn btn-danger square-btn-adjust'])}}
                {{Form::close()}}


</div>
    </nav>
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
