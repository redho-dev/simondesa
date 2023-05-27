<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/jpg" href="/img/logo.png">
    <title>Simondes|S-admin</title>

    <!-- Bootstrap -->
    <link href="/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- jQuery custom content scroller -->
    <link href="/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet" />


    @yield('css')


    <!-- Custom Theme Style -->
    <link href="/build/css/custom.min.css" rel="stylesheet">



</head>

<body class="nav-md footer_fixed">

    <div id="preloaders" class="preloader"></div>

    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title " style="border: 0;">
                        <a href="index.html" class="site_title"><img src="/img/logo.png" width='30px' alt="">
                            <span>&ensp;Simondes</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="/img/admin.png" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>tess</h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    @include('templates.sidebar')
                    @include('templates.footer')

                </div>
            </div>

            @include('templates.topbar')

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <span class="float-right"> {{ now()->translatedFormat('l, d-F-Y, h:i:s') }}</span>
                    @yield('content')
                </div>
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    <a href="https://bkpsdm.lampungutarakab.go.id">By : BKPSDM Kab.Lampung
                        Utara</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <!-- jQuery -->
    <script src="/vendors/jquery/dist/jquery.js"></script>

    <!-- Bootstrap -->
    <script src="/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery custom content scroller -->
    <script src="/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="/build/js/custom.js"></script>

    @stack('script')




</body>

</html>