<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    @vite('resources/css/app.css')
    <title>{{$title??env('APP_NAME')}}</title>
    <meta name="keywords" content="parser">
    <meta name="description" content="Наш сайт парсинга предназначен для извлечения и анализа данных из веб-страниц.
    С помощью нашего инструмента вы можете получать доступ к структурированным данным из различных источников,
    включая веб-сайты, социальные сети, новостные сайты, интернет-магазины и многое другое.">
    <meta name="author" content="Aleksander Storchak">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/css/bootstrap.min.css'}}">
    <!-- style css -->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/css/style_.css'}}">
    <!-- responsive-->
    <link rel="stylesheet" href="{{env('APP_URL').'/assets/css/responsive.css'}}">
    <!-- awesome fontfamily -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<!-- body -->
<body class="main-layout">
<!-- loader  -->
<div class="loader_bg">
    <div class="loader"><img src="{{env('APP_URL').'/assets/img/loading.gif'}}" /></div>
</div>
<!-- header -->
<header>
    <!-- header inner -->
    <div class="head-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <div class="logo">
                        <a href="/"><img src="{{env('APP_URL').'/assets/img/logo.png'}}"/></a>
                    </div>
                </div>
                <div class="col-sm-9">
                    <ul class="email text_align_right">
                        <li class="d_none"><i class="fa fa-phone" aria-hidden="true"></i><a
                                href="phone:+380938005512<">+380938005512</a></li>
                        <li class="d_none"><a href="mailto:admin@admin.ua"><i class="fa fa-envelope"
                                                          aria-hidden="true"></i>admin@admin.ua</a></li>
                        <li class="d_none"><a href="{{env('APP_URL').'/login'}}">Login <i class="fa fa-user" aria-hidden="true"></i></a></li>
                        <li class="d_none"><a href="{{env('APP_URL').'/register'}}">Register <i class="fa fa-user" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- end header -->
<!-- start slider section -->
<div class=" banner_main">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="bg_white">
                        <h1>Возможность индивидуальной разработки<span class="yello"> Парсинга под Ваши требования</span></h1>
                        <p>Я могу разработать код для считывания данных с любого сайта учитывая все требования заказчика.</p>
                        <p>Считывание данные проходит ассинхронно, за минимальное время ожидания. Код для считывания данных написан на js</p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="carousel-caption relative">
                        <div class="bg_white">
                            <h1>Обработка данных с помощью<span class="yello"> Искусственного интеллекта</span></h1>
                            <p>Создается отдельно сервер, который может обрабатывать большой поток данных, анализировать, искать закономерности,
                            делать прогнозы с максимальной точностью, создавать графическое отображение данных.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="carousel-caption relative">
                        <div class="bg_white">
                            <h1>Сохранение результатов <span class="yello">MySql, JSON</span></h1>
                            <p>Все результаты сохраняются в базе данных MySql, с возможностью выгрузке в JSON. В данном формате можно не только хранить результаты,
                            но также использовать в любой системе анализа</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<!-- end slider section -->
<!-- six_box-->
<div id="about" class="about top_layer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="titlepage">
                    <h2>Обо мне</h2>

                </div>
            </div>
            <div class=" col-sm-12">
                <div class="about_box">
                    <div class="row d_flex">
                        <div>
                            <div class="about_box_text mr-3">
                                <h3>Сторчак Александр</h3>
                                <p>Занимаюсь программированием на PHP, JavaScript, Python. Работаю на Laravel, Django, увлекаюсь анализом данных и
                                    искусственным интеллектом.</p>
                            </div>
                        </div>
                        <div>
                            <div class="ml-lg-5 about_box_img">
                                <img src="uploads/img/logo.jpg" width="70%" alt="#"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end six_box-->
<!-- building -->

<!-- end instant -->
<!-- footer -->
<footer>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <ul class="social_icon text_align_center">
                        <li><a href="https://www.facebook.com/go280286sai" target="_blank"><i class="fa fa-facebook-f"></i></a></li>
                        <li><a href="mailto:admin@admin.ua" target="_blank"><i class="fa fa-mail-reply"></i></a></li>
                        <li><a href="https://www.linkedin.com/in/go280286sai" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                        <li><a href="https://astorchak.blogspot.com/" target="_blank"><i class="fa fa-sticky-note" aria-hidden="true" title="Мой блог"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="reader">
                        <a href="/"><img src="{{env('APP_URL').'/assets/img/logo.png'}}"/></a>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="reader">
                        <h3>Услуги</h3>
                            <p>Одностроничники <br>
                            Обычные сайты <br>
                            Автомазация <br>
                            Внедрение искусственного интелекта</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="reader">
                        <h3>Мои работы</h3>
                        <p><a href="https://github.com/go280286sai" target="_blank"><i class="text-white">https://github.com/go280286sai</i></a></p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="reader">
                        <h3>Контакты</h3>
                        <p><a href="mailto:go280286sai@mail.com"><i class="text-white">go280286sai@mail.com</i></a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright text_align_center">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="{{env('APP_URL').'/assets/js/jquery.min.js'}}"></script>
<script src="{{env('APP_URL').'/assets/js/bootstrap.bundle.min.js'}}"></script>
<script src="{{env('APP_URL').'/assets/js/custom.js'}}"></script>
<script src="{{env('APP_URL').'/assets/js/jquery-3.0.0.min.js'}}"></script>
</body>
</html>
