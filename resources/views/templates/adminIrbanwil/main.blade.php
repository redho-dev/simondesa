<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/jpg" href="/img/logo.png">
    <title>Simondes | Admin_Irbanwil</title>

    <!-- Bootstrap -->
    <link href="/vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- jQuery custom content scroller -->
    <link href="/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet" />

    <!-- sweetalert -->
    <script src="/package/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="/package/dist/sweetalert2.min.css">
    <!-- jQuery -->
    <script src="/vendors/jquery/dist/jquery.js"></script>


    <style>
        .preloader {
            position: absolute;
            top: 40%;
            left: 50%;
            z-index: 999;
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
                        <a href="index.html" class="site_title">
                            <img src="/img/logo.png" width='30px' alt="">
                            <span>&ensp;Simondes</a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <a href="/adminIrbanwil/cekProfil/{{ $infos->id }}">
                                <img src="/foto_pegawai/{{ $infos->foto }}" alt="..."
                                    class="img-circle profile_img"></a>
                        </div>
                        <div class="profile_info">
                            <span>{{ $infos->obrik }}</span>
                            <p style="font-size: .7rem; color:whitesmoke ">
                                {{ $infos->name }}
                            </p>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    @include('templates.adminIrbanwil.sidebar')
                    @include('templates.adminIrbanwil.footer')

                </div>
            </div>

            @include('templates.adminIrbanwil.topbar')

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


    <script>
        $(document).ready(function(){
        $(".preloader").fadeOut();
       
         });

    </script>

    <!-- Bootstrap -->
    <script src="/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery custom content scroller -->
    <script src="/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- Datatables -->
    <link href="/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    @stack('script')
    <!-- Custom Theme Scripts -->
    <script src="/build/js/custom.js"></script>

    <!-- Datatables -->
    <script src="/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script>
        $("input[type='number']").attr('max', '100')
        var status = $('#status_lhp').html();
            status = status.trim();
            if(status == 'close'){
                var tabel = $('#tabelPenilaian');
                tabel.find('input').attr('readonly', 'readonly');
                tabel.find('button').hide();
                $("button[type='submit']").hide();
                $("input[type='number']").attr('readonly', 'readonly');
                $("input").attr('readonly', 'readonly');
                $("#tahun").removeAttr('readonly');
               
            }
    </script>



</body>

</html>