<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!--[if gte mso 9]>
    <xml>
    <o:OfficeDocumentSettings>
        <o:AllowPNG/>
        <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->

    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="format-detection" content="date=no"/>
    <meta name="format-detection" content="address=no"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="x-apple-disable-message-reformatting"/>
    <!--[if !mso]><!-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Fira+Mono:400,500,700|Ubuntu:400,400i,500,500i,700,700i"
          rel="stylesheet"/>
    <!--<![endif]-->
    <title>Текущее предложение</title>
    <!--[if gte mso 9]>
    <style type="text/css" media="all">
    sup {
        font-size: 100% !important;
    }
    </style>
    <![endif]-->


    <style type="text/css" media="screen">
        /* Linked Styles */
        body {
            padding: 0 !important;
            margin: 0 !important;
            display: block !important;
            min-width: 100% !important;
            width: 100% !important;
            background: #ffffff;
            -webkit-text-size-adjust: none
        }

        a {
            color: #000001;
            text-decoration: none
        }

        p {
            padding: 0 !important;
            margin: 0 !important
        }

        img {
            -ms-interpolation-mode: bicubic; /* Allow smoother rendering of resized image in Internet Explorer */
        }

        .mcnPreviewText {
            display: none !important;
        }

        /* Mobile styles */
        @media only screen and (max-device-width: 480px), only screen and (max-width: 480px) {
            .mobile-shell {
                width: 100% !important;
                min-width: 100% !important;
            }

            .m-center {
                text-align: center !important;
            }

            .text3,
            .text-footer,
            .text-header {
                text-align: center !important;
            }

            .center {
                margin: 0 auto !important;
            }

            .td {
                width: 100% !important;
                min-width: 100% !important;
            }

            .m-br-15 {
                height: 15px !important;
            }

            .p30-15 {
                padding: 30px 15px !important;
            }

            .p30-15-0 {
                padding: 30px 15px 0px 15px !important;
            }

            .p40 {
                padding-bottom: 30px !important;
            }

            .box,
            .footer,
            .p15 {
                padding: 15px !important;
            }

            .h2-white {
                font-size: 40px !important;
                line-height: 44px !important;
                text-align: center !important;
            }

            .h2 {
                font-size: 42px !important;
                line-height: 50px !important;
            }

            .m-td,
            .m-hide {
                display: none !important;
                width: 0 !important;
                height: 0 !important;
                font-size: 0 !important;
                line-height: 0 !important;
                min-height: 0 !important;
            }

            .m-block {
                display: block !important;
            }

            .container {
                padding: 0px !important;
            }

            .separator {
                padding-top: 30px !important;
            }

            .fluid-img img {
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
            }

            .column,
            .column-top,
            .column-dir,
            .column-empty,
            .column-empty2,
            .column-bottom,
            .column-dir-top,
            .column-dir-bottom {
                float: left !important;
                width: 100% !important;
                display: block !important;
            }

            .column-empty {
                padding-bottom: 10px !important;
            }

            .column-empty2 {
                padding-bottom: 30px !important;
            }

            .content-spacing {
                width: 15px !important;
            }
        }
    </style>
</head>
<body class="body"
      style="padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#ffffff; -webkit-text-size-adjust:none;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#2e57ae">
    <tr>
        <td align="center" valign="top" class="container" style="padding:50px 10px;">
            <!-- Container -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                <tr>
                    <td>

                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="col-sm-3">
                            <a href="/"><img src="{{env('APP_URL').'/assets/img/logo.png'}}"/></a>
                        </div>
                        <div class="text-center"><h2>Актуальные предложения на сегодня</h2>
                        </div>

                        <div class="container">
                            <table id="example1" class="table table-warning table-striped-columns">
                                <thead>
                                <tr class="table-dark">
                                    <th scope="col">Название</th>
                                    <th scope="col">Комнаты</th>
                                    <th scope="col">Этаж</th>
                                    <th scope="col">Этажность</th>
                                    <th scope="col">Описание</th>
                                    <th scope="col">Цена, грн.</th>
                                    <th scope="col">Расположение</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($objects as $object)
                                    <tr>
                                        <td class="bg-orange-200">{{$object->title}}</td>
                                        <td class="bg-orange-200">{{$object->rooms}}</td>
                                        <td class="bg-orange-200">{{$object->floor}}</td>
                                        <td class="bg-orange-200">{{$object->etajnost}}</td>
                                        <td class="bg-orange-200">{{$object->description}}</td>
                                        <td class="bg-orange-200">{{$object->price}}</td>
                                        <td class="bg-orange-200">{{$object->location}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Footer -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="footer" style="padding: 0px 30px 30px 30px;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td class="separator"
                                                style="border-bottom:4px solid #000000; font-size:0pt; line-height:0pt;"></td>
                                        </tr>
                                        <tr>
                                            <td class="pb40" style="padding-bottom:40px;"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-socials"
                                                style="color:#000000; font-family:'Fira Mono', Arial,sans-serif; font-size:16px; line-height:22px; text-align:center; text-transform:uppercase;">
{{--                                                follow us--}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 30px 0px 30px 0px;" align="center">
                                                <table class="center" border="0" cellspacing="0" cellpadding="0"
                                                       style="text-align:center;">
                                                    {{--                                                    <tr>--}}
                                                    {{--                                                        <td class="img" width="52" style="font-size:0pt; line-height:0pt; text-align:left;"><a href="#" target="_blank"><img src="images/t_free_ico_facebook.jpg" width="42" height="42" border="0" alt="" /></a></td>--}}
                                                    {{--                                                        <td class="img" width="52" style="font-size:0pt; line-height:0pt; text-align:left;"><a href="#" target="_blank"><img src="images/t_free_ico_twitter.jpg" width="42" height="42" border="0" alt="" /></a></td>--}}
                                                    {{--                                                        <td class="img" width="52" style="font-size:0pt; line-height:0pt; text-align:left;"><a href="#" target="_blank"><img src="images/t_free_ico_gplus.jpg" width="42" height="42" border="0" alt="" /></a></td>--}}
                                                    {{--                                                        <td class="img" width="42" style="font-size:0pt; line-height:0pt; text-align:left;"><a href="#" target="_blank"><img src="images/t_free_ico_instagram.jpg" width="42" height="42" border="0" alt="" /></a></td>--}}
                                                    {{--                                                    </tr>--}}
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <!-- END Footer -->
                    </td>
                </tr>
                                <tr>
                                    <td class="text-footer" style="padding-top: 30px; color:#9fadd4; font-family:'Fira Mono', Arial,sans-serif; font-size:12px; line-height:22px; text-align:center;">
                                        <p> <a href="phone:+380938005512<">+380938005512</a></p>
                                        <p><a href="mailto:admin@admin.ua">admin@admin.ua</a></p></td>
                                </tr>

            </table>
        </td>
    </tr>
</table>
<!-- END Container -->


</body>
</html>

