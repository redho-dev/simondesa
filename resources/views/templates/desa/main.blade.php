<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/jpg" href="/img/logo.png">
    <title>Simondes | Admin_Desa</title>

    <!-- Bootstrap -->
    <link href="/vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- jQuery custom content scroller -->
    <link href="/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet" />

    <!-- sweetalert -->
    <script src="/package/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="/package/dist/sweetalert2.min.css">
    <style>
        .preloader {
            position: absolute;
            top: 40%;
            left: 50%;
            z-index: 999;
        }

        label {
            overflow: hidden;
        }
    </style>
    @yield('css')


    <!-- Custom Theme Style -->

    <link href="/build/css/custom.css" rel="stylesheet">



</head>

<body class="nav-md footer_fixed">

    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title " style="border: 0;">
                        <a href="index.php" class="site_title"><img src="/img/logo.png" width='30px' alt="">
                            <span>&ensp;Simondes</a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="/img/admin.png" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            @if(session()->has('adminKeuDesa'))
                            <p>Admin Keuangan Desa</p>
                            @else
                            <p>Admin Desa</p>
                            @endif
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    @include('templates.desa.sidebar')
                    @include('templates.desa.footer')

                </div>
            </div>

            @include('templates.desa.topbar')

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <span class="float-right"> {{ now()->translatedFormat('l, d-F-Y, h:i:s') }}</span>
                    <div class="clearfix"></div>
                    <div class="preloader ">
                        <div class="loading">
                            <img src="/img/loading2.gif" width="200">
                            <p class="ml-4">........Harap Tunggu</p>
                        </div>
                    </div>

                    @yield('content')
                </div>
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    <a href="https://inspektorat.lampungutarakab.go.id">By : Inspektorat Kab.Lampung
                        Utara</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <!-- jQuery -->
    <script src="/vendors/jquery/dist/jquery.js"></script>
    <script>
        $(document).ready(function(){
        $(".preloader").fadeOut();
        })
    </script>
    <!-- Bootstrap -->
    <script src="/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery custom content scroller -->
    <script src="/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="/build/js/custom.js"></script>


    @stack('script')







</body>

</html>