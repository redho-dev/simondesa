<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>


<div class="top-bar bg-dark">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <a href="#" class="text-white"><span class="mr-2  icon-envelope-open-o"></span> <span
                        class="d-none d-md-inline-block text-white">simondeslu@gmail.com</span></a>
                <span class="mx-md-2 d-inline-block"></span>
                <a href="#" class="text-white"><span class="mr-2  icon-whatsapp"></span> <span
                        class="d-none d-md-inline-block">0812-7886-1007</span></a>


                <div class="float-right">

                    <a href="#" class="text-white"><span class="mr-2  icon-twitter"></span> <span
                            class="d-none d-md-inline-block">Twitter</span></a>
                    <span class="mx-md-2 d-inline-block"></span>
                    <a href="#" class="text-white"><span class="mr-2  icon-facebook"></span> <span
                            class="d-none d-md-inline-block">Facebook</span></a>

                </div>

            </div>

        </div>

    </div>
</div>
<style>
    #login:hover {
        background-color: aquamarine;
    }
</style>
<header class="site-navbar js-sticky-header site-navbar-target" role="banner" style="background-color:beige">

    <div class="container-xl">
        <div class="row align-items-center position-relative">


            <div class="site-logo">
                <a href="index.html" class="text-dark"><span class="text-warning" style="font-size: 2rem;">SIMONDes</a>
            </div>

            <div class="col-12">
                <nav class="site-navigation text-right ml-auto " role="navigation">

                    <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
                        <li><a href="/" class="nav-link"><i class="fa fa-home mr-2 d-none d-xl-inline"></i>Beranda</a>
                        </li>
                        <li class="has-children">
                            <a href="#about-section" class="nav-link"><i
                                    class="fa fa-book mr-2 d-none d-xl-inline"></i>Profil</a>
                            <ul class="dropdown arrow-top">
                                <li><a href="#team-section" class="nav-link">Profil Inspektorat</a></li>
                                <li><a href="#pricing-section" class="nav-link">Profil Desa</a></li>

                            </ul>
                        </li>


                        <li class="has-children">
                            <a href="#about-section" class="nav-link"><i
                                    class="fa fa-list-alt mr-2 d-none d-xl-inline"></i>Regulasi
                                Desa</a>
                            <ul class="dropdown arrow-top">
                                <li><a href="#team-section" class="nav-link">UU Desa</a></li>
                                <li><a href="#pricing-section" class="nav-link">Pengelolaan Keuangan Desa</a></li>
                                <li><a href="#faq-section" class="nav-link">Penataan Aset</a></li>
                                <li><a href="#faq-section" class="nav-link">BUMDes</a></li>
                                <li><a href="#faq-section" class="nav-link">Administrasi Pemerintahan</a></li>
                                <li><a href="#faq-section" class="nav-link">Perangkat Desa</a></li>
                                <li class="has-children">
                                    <a href="#">More Links</a>
                                    <ul class="dropdown">
                                        <li><a href="#">Menu One</a></li>
                                        <li><a href="#">Menu Two</a></li>
                                        <li><a href="#">Menu Three</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="has-children">
                            <a href="#about-section" class="nav-link"><i
                                    class="fa fa-file mr-2 d-none d-xl-inline"></i>Data dan
                                Informasi</a>
                            <ul class="dropdown arrow-top">
                                <li><a href="#team-section" class="nav-link">RPJMDes</a></li>
                                <li><a href="#pricing-section" class="nav-link">Publikasi APBDes</a></li>
                                <li><a href="#faq-section" class="nav-link">Perangkat Desa</a></li>
                                <li><a href="#faq-section" class="nav-link">Peta Desa</a></li>
                                <li><a href="#faq-section" class="nav-link">Aset Desa</a></li>
                                <li class="has-children">
                                    <a href="#">Monografi</a>
                                    <ul class="dropdown">
                                        <li><a href="#">Jumlah Penduduk</a></li>
                                        <li><a href="#">Sarpras</a></li>
                                        <li><a href="#">Penduduk Miskin</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="has-children">
                            <a href="#about-section" class="nav-link"><i
                                    class="fa fa-line-chart mr-2 d-none d-xl-inline"></i>Akuntabilitas</a>
                            <ul class="dropdown arrow-top">
                                <li><a href="#team-section" class="nav-link">Progress input data</a></li>
                                <li><a href="#pricing-section" class="nav-link">Capaian akuntabilitas</a></li>
                            </ul>
                        </li>

                        @if(session()->has('loggedAdminDesa'))
                        <li class="has-children">
                            <a href="#about-section" class="nav-link active"><i
                                    class="fa fa-user mr-2 "></i>admin_desa</a>
                            <ul class="dropdown arrow-top">
                                <li><a href="/adminDesa" class="nav-link">dashboard</a></li>
                                <li><a href="/logoutDesa" class="nav-link">logout</a></li>
                            </ul>
                        </li>
                        @else
                        <li>
                            <a href="/login" class="nav-link" style="font-size: 1.1rem">
                                <span class="badge badge-warning p-2" id="login">
                                    <i class="fa fa-sign-in mr-2"></i>Login
                                </span>
                            </a>
                        </li>
                        @endif


                    </ul>


                </nav>


            </div>

            <div class="toggle-button d-inline-block d-lg-none"><a href="#"
                    class="site-menu-toggle py-5 js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

        </div>
    </div>

</header>