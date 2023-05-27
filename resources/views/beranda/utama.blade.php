@extends('layouts.main')
@section('content')

<div role="main" class="main">
    <div class="owl-carousel-wrapper position-relative" style="height: 600px">
        <div class="owl-carousel-loader">
            <div class="bounce-loader">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>
        <div class="owl-carousel dots-inside dots-horizontal-center show-dots-hover nav-inside nav-inside-plus nav-dark nav-md nav-font-size-md show-nav-hover mb-0"
            data-plugin-options="{'responsive': {'0': {'items': 1}, '479': {'items': 1}, '768': {'items': 1}, '979': {'items': 1}, '1199': {'items': 1}}, 'loop': false, 'autoHeight': false, 'margin': 0, 'dots': true, 'dotsVerticalOffset': '-75px', 'nav': true, 'animateIn': 'fadeIn', 'animateOut': 'fadeOut', 'mouseDrag': false, 'touchDrag': false, 'pullDrag': false, 'autoplay': true, 'autoplayTimeout': 9000, 'autoplayHoverPause': true, 'rewind': true}">

            <!-- Carousel Slide 3 -->
            <div class="position-relative overlay overlay-color-dark overlay-show overlay-op-5"
                data-dynamic-height="['500px','500px','500px','450px','400px']"
                style="background-image: url(/img/background-slide1.jpg); background-size: cover; background-position: center; height: 600px;">
                <div class="container position-relative z-index-3 h-100">
                    <div class="row justify-content-center align-items-center h-100">
                        <div class="col-lg-6">
                            <div class="d-flex flex-column align-items-center">
                                <div class="row mb-12">
                                    <div class="col-md-12 p-2">
                                        <img src="storage/image/lampura.png" style="width: 100%; height:auto">
                                    </div>
                                </div>
                                <h3 class="position-relative text-color-light text-4 line-height-5 font-weight-medium px-4 mb-2 appear-animation"
                                    data-appear-animation="fadeInDownShorter"
                                    data-plugin-options="{'minWindowWidth': 0}">
                                    <span class="position-absolute right-100pct top-50pct transform3dy-n50 opacity-10">
                                        <img src="/assets/home/img/slides/slide-title-border.png"
                                            class="w-auto appear-animation" data-appear-animation="fadeInLeftShorter"
                                            data-appear-animation-delay="250"
                                            data-plugin-options="{'minWindowWidth': 0}" alt="" />
                                    </span>
                                    <p class="text-4 text-color-light font-weight-dark text-center mt-3">PEMERINTAH
                                        KABUPATEN LAMPUNG UTARA</p>
                                    <span class="position-absolute left-100pct top-50pct transform3dy-n50 opacity-10">
                                        <img src="/assets/home/img/slides/slide-title-border.png"
                                            class="w-auto appear-animation" data-appear-animation="fadeInRightShorter"
                                            data-appear-animation-delay="250"
                                            data-plugin-options="{'minWindowWidth': 0}" alt="" />
                                    </span>
                                </h3>
                                <h3 style="font-size: 5vw;" class="text-color-light font-weight-extra-bold mb-3"
                                    data-plugin-animated-letters
                                    data-plugin-options="{'startDelay': 1000, 'minWindowWidth': 0, 'animationSpeed': 300, 'animationName': 'fadeInRightShorterOpacity', 'letterClass': 'd-inline-block'}">
                                    SIMONDES</h3>
                                <p class="text-4 text-color-light font-weight-dark text-center mb-0"
                                    data-plugin-animated-letters
                                    data-plugin-options="{'startDelay': 2000, 'minWindowWidth': 0}">Sistem Informasi
                                    Monitoring & Evaluasi Desa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <section
        class="section bg-color-grey-scale-1 section-height-3 section-no-border section-center mb-0 appear-animation"
        data-appear-animation="fadeIn">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 appear-animation" data-appear-animation="fadeInUpShorter"
                    data-appear-animation-delay="200">
                    <div class="owl-carousel owl-theme nav-bottom rounded-nav mb-0"
                        data-plugin-options="{'items': 1, 'loop': false, 'autoHeight': true}">
                        <div>
                            <div class="col">
                                <div
                                    class="testimonial testimonial-style-2 testimonial-with-quotes testimonial-quotes-dark mb-0">
                                    <div class="post-image text-center" style="margin:15px">
                                        <img src="/img/Erwinsyah.jpeg" class="rounded-circle"
                                            style="margin: auto; min-height: 250px; max-height: 300px; max-width: 250px;">
                                    </div>
                                    <blockquote>
                                        <p class="text-color-dark line-height-5" style="font-size: .8 rem">
                                            Simondes merupakan sistem informasi pengawasan Keuangan Desa yang meliputi
                                            perencanaan, pelaksanaan, dan pelaporan pengelolaan Keuangan Desa secara
                                            daring melalui jaringan internet, dalam rangka mewujudkan pemerintahan desa
                                            yang bersih, transparan dan akuntabel</p>
                                    </blockquote>
                                    <div class="testimonial-author">
                                        <p><strong class="opacity-9 font-weight-extra-bold text-2">-Inspektur Kabupaten
                                                Lampung Utara</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="row justify-content-center mt-4">
        <div class="lightbox"
            data-plugin-options="{'delegate': 'a', 'type': 'image', 'gallery': {'enabled': true}, 'mainClass': 'mfp-with-zoom', 'zoom': {'enabled': true, 'duration': 300}}">
            <div class="owl-carousel owl-theme stage-margin"
                data-plugin-options="{'items': 4, 'margin': 10, 'nav': true, 'dots': false, 'stagePadding': 40, 'autoplay': true, 'autoplayTimeout': 3000}">

                @foreach ($galeris as $galeri)
                <div>
                    <a class="img-thumbnail img-thumbnail-no-borders img-thumbnail-hover-icon"
                        href="storage/galeris/{{ $galeri->image }}">
                        <img class="img-fluid" src="storage/galeris/{{ $galeri->image }}"
                            alt="{{ $galeri->description }}">
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>


    <div id="examples">

        <section class="section border-0 p-relative">
            <div class="particles-wrapper z-index-1">
                <div id="particles-1"></div>
            </div>
            <div class="container">

                <div class="row text-center pt-3">
                    <div class="col-md-10 mx-md-auto">
                        <h1 class="word-rotator slide text-8 mb-3 appear-animation"
                            data-appear-animation="fadeInUpShorter">
                            <span style="font-weight: bold;">SIMONDES</span> memberikan
                            <span class="word-rotator-words bg-primary">
                                <b class="is-visible">Kemudahan</b>
                                <b>Kenyamanan</b>
                                <b>Keamanan</b>
                            </span>
                            <span> dalam pelaporan Akuntabilitas Pemerintahan Desa</span>
                        </h1>
                    </div>
                </div>

            </div>
        </section>

    </div>


    <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">
        <div class="home-concept mt-5">
            <div class="container">
                <div class="row text-center">
                    <span class="sun"></span>
                    <span class="cloud"></span>
                    <div class="col-lg-2 ms-lg-auto">
                        <div class="process-image">
                            <img src="storage/image/pelaporan.jpg" alt="" />
                            <strong>Pelaporan</strong>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="process-image process-image-on-middle">
                            <img src="storage/image/monitoring.png" alt="" />
                            <strong>Monitoring</strong>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="process-image">
                            <img src="storage/image/penilaian.jpg" alt="" />
                            <strong>Penilaian</strong>
                        </div>
                    </div>
                    <div class="col-lg-4 ms-lg-auto">
                        <div class="project-image">
                            <div id="fcSlideshow" class="fc-slideshow">
                                <ul class="fc-slides">
                                    <li><a href="#"><img class="img-fluid" src="storage/image/akuntabilitas-1.jpg"
                                                alt="" /></a></li>
                                    <li><a href="#"><img class="img-fluid" src="storage/image/akuntabilitas-2.jpg"
                                                alt="" /></a></li>
                                    <li><a href="#"><img class="img-fluid" src="storage/image/akuntabilitas-3.jpg"
                                                alt="" /></a></li>
                                </ul>
                            </div>
                            <strong class="our-work">Akuntabilitas</strong>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="row text-center pt-2">
        <div class="col">
            <h2 class="word-rotator slide font-weight-bold text-8 mb-5">
                <span>Jenis Pengawasan</span>
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="tabs tabs-bottom tabs-center tabs-simple">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <div
                            class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
                            <div class="featured-box featured-box-no-borders featured-box-box-shadow">
                                <a class="nav-link active" href="#tabsNavigationSimpleIcons1" data-bs-toggle="tab"
                                    class="text-decoration-none">
                                    <span class="box-content px-1 py-4 text-center d-block">
                                        <span class="text-primary text-8 position-relative top-3 mt-3"><i
                                                class="fas fa-building-columns"></i></span>
                                        <span class="elements-list-shadow-icon text-default"><i
                                                class="fas fa-building-columns"></i></span>
                                        <span
                                            class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark">Pemerintahan
                                            Desa</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div
                            class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
                            <div class="featured-box featured-box-no-borders featured-box-box-shadow">
                                <a class="nav-link" href="#tabsNavigationSimpleIcons2" data-bs-toggle="tab"
                                    class="text-decoration-none">
                                    <span class="box-content px-1 py-4 text-center d-block">
                                        <span class="text-primary text-8 position-relative top-3 mt-3"><i
                                                class="fas fa-money-bill-transfer"></i></span>
                                        <span class="elements-list-shadow-icon text-default"><i
                                                class="fas fa-money-bill-transfer"></i></span>
                                        <span
                                            class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark">Keuangan
                                            Desa</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div
                            class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
                            <div class="featured-box featured-box-no-borders featured-box-box-shadow">
                                <a class="nav-link" href="#tabsNavigationSimpleIcons3" data-bs-toggle="tab"
                                    class="text-decoration-none">
                                    <span class="box-content px-1 py-4 text-center d-block">
                                        <span class="text-primary text-8 position-relative top-3 mt-3"><i
                                                class="fas fa-shopping-basket"></i></span>
                                        <span class="elements-list-shadow-icon text-default"><i
                                                class="fas fa-shopping-basket"></i></span>
                                        <span
                                            class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark">Pengelolaan
                                            BUMDes</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tabsNavigationSimpleIcons1">
                        <div class="container py-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <blockquote class="blockquote-primary with-borders">
                                        <h4><i class="fas fa-edit text-primary"></i> Data Monografi</h4>
                                        <footer>Himpunan data yang dilaksanakan oleh pemerintah desa yang tersusun
                                            secara sistematis, lengkap, akurat, dan terpadu dalam penyelenggaraan
                                            pemerintahan</footer>
                                    </blockquote>
                                </div>
                                <div class="col-md-4">
                                    <blockquote class="blockquote-primary with-borders">
                                        <h4><i class="fas fa-edit text-primary"></i> Kewilayahan</h4>
                                        <footer>Wilayah administratif Pemerintahan Desa meliputi Peraturan Pembentukan
                                            Desa, Batas Desa dan Peta Desa</footer>
                                    </blockquote>
                                </div>
                                <div class="col-md-4">
                                    <blockquote class="blockquote-primary with-borders">
                                        <h4><i class="fas fa-edit text-primary"></i> Kelembagaan</h4>
                                        <footer>Wadah untuk mengemban tugas dan fungsi Pemerintahan Desa</footer>
                                    </blockquote>
                                </div>
                            </div>

                            <div class="row pt-4">
                                <div class="col-md-2">
                                    &nbsp;
                                </div>
                                <div class="col-md-4">
                                    <blockquote class="blockquote-primary with-borders">
                                        <h4><i class="fas fa-edit text-primary"></i> Dokumen Perencanaan</h4>
                                        <footer>Dokumen - dokumen Rencana Kerja dan Pembangunan Pemerintahan Desa
                                        </footer>
                                    </blockquote>
                                </div>
                                <div class="col-md-4">
                                    <blockquote class="blockquote-primary with-borders">
                                        <h4><i class="fas fa-edit text-primary"></i> Administrasi Umum</h4>
                                        <footer>Pencatatan data dan informasi mengenai kegiatan Pemerintahan Desa
                                        </footer>
                                    </blockquote>
                                </div>
                                <div class="col-md-2">
                                    &nbsp;
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tabsNavigationSimpleIcons2">
                        <div class="container py-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <blockquote class="blockquote-primary with-borders">
                                        <h4><i class="fas fa-edit text-primary"></i> Penatausahaan Pendapatan</h4>
                                        <footer>Proses pencatatan yang dilakukan oleh Bendahara Desa terhadap seluruh
                                            transaksi penerimaan pendapatan desa yang meliputi pendapatan asli desa,
                                            transfer, dan pendapatan lain-lain</footer>
                                    </blockquote>
                                </div>
                                <div class="col-md-4">
                                    <blockquote class="blockquote-primary with-borders">
                                        <h4><i class="fas fa-edit text-primary"></i> Penatausahaan Belanja</h4>
                                        <footer>Proses pencatatan yang dilakukan bendahara desa, yang melakukan
                                            pencatatan terhadap seluruh transaksi baik penerimaan maupun pengeluaran
                                        </footer>
                                    </blockquote>
                                </div>
                                <div class="col-md-4">
                                    <blockquote class="blockquote-primary with-borders">
                                        <h4><i class="fas fa-edit text-primary"></i> Pengadaan Barang dan Jasa</h4>
                                        <footer>Kegiatan untuk memperoleh barang/jasa oleh pemerintah desa baik
                                            dilakukan melalui swakelola dan atau penyedia barang dan jasa</footer>
                                    </blockquote>
                                </div>
                            </div>

                            <div class="row pt-4">
                                <div class="col-md-2">
                                    &nbsp;
                                </div>
                                <div class="col-md-4">
                                    <blockquote class="blockquote-primary with-borders">
                                        <h4><i class="fas fa-edit text-primary"></i> Kepatuhan Pajak</h4>
                                        <footer> Pemungutan dan Penyetoran pajak meliputi pengeluaran kas desa atas
                                            beban belanja pegawai, barang/jasa, dan modal</footer>
                                    </blockquote>
                                </div>
                                <div class="col-md-4">
                                    <blockquote class="blockquote-primary with-borders">
                                        <h4><i class="fas fa-edit text-primary"></i> Penataan Aset Desa</h4>
                                        <footer>Barang milik Desa yang berasal dari kekayaan asli desa, dibeli atau
                                            diperoleh atas beban Anggaran Pendapatan dan Belanja Desa atau perolehan hak
                                            lainnya yang sah</footer>
                                    </blockquote>
                                </div>
                                <div class="col-md-2">
                                    &nbsp;
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tabsNavigationSimpleIcons3">
                        <div class="container py-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <blockquote class="blockquote-primary with-borders">
                                        <h4><i class="fas fa-edit text-primary"></i> Badan Usaha BUMDes</h4>
                                    </blockquote>
                                </div>
                                <div class="col-md-4">
                                    <blockquote class="blockquote-primary with-borders">
                                        <h4><i class="fas fa-edit text-primary"></i> PerDes BUMDes & AD/ART</h4>
                                    </blockquote>
                                </div>
                                <div class="col-md-4">
                                    <blockquote class="blockquote-primary with-borders">
                                        <h4><i class="fas fa-edit text-primary"></i> Penyertaan Modal</h4>
                                    </blockquote>
                                </div>
                                <div class="col-md-4">
                                    <blockquote class="blockquote-primary with-borders">
                                        <h4><i class="fas fa-edit text-primary"></i> SK Kepengurusan</h4>
                                    </blockquote>
                                </div>
                                <div class="col-md-4">
                                    <blockquote class="blockquote-primary with-borders">
                                        <h4><i class="fas fa-edit text-primary"></i> Proposal Pengajuan Modal</h4>
                                    </blockquote>
                                </div>
                                <div class="col-md-4">
                                    <blockquote class="blockquote-primary with-borders">
                                        <h4><i class="fas fa-edit text-primary"></i> Laporan Keuangan BUMDes</h4>
                                    </blockquote>
                                </div>

                            </div>

                            <div class="row pt-2">
                                <div class="col-md-2">
                                    &nbsp;
                                </div>
                                <div class="col-md-2">
                                    &nbsp;
                                </div>
                                <div class="col-md-4">
                                    <blockquote class="blockquote-primary with-borders">
                                        <h4><i class="fas fa-edit text-primary"></i> Kontribusi PADes</h4>
                                    </blockquote>
                                </div>
                                <div class="col-md-2">
                                    &nbsp;
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col mb-4">
            <hr class="my-0">
        </div>
    </div>

    <div class="row text-center pt-2 pb-5">
        <div class="col">
            <h2 class="word-rotator slide font-weight-bold text-8">Berita</h2>
            <a href="#" style="text-decoration: none;"><span class="sub-title text-info">Selengkapnya <i
                        class="fas fa-arrow-right"></i></span></a>
        </div>
    </div>

    <div class="container py-2">
        <div class="row">
            <div class="col-md-12">
                <div class="blog-posts">
                    <div class="row">
                        {{-- @foreach ($blogs as $blog)

                        <div class="col-md-4 col-lg-3">
                            <article class="post post-medium border-0 pb-0 mb-5">
                                <div class="post-image">
                                    <a href="/view/{{ $blog->id }}">
                                        <img src="storage/blogs/{{ $blog->image }}"
                                            class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0"
                                            style="width: auto; max-height: 200px; display: block; margin-left: auto; margin-right: auto;" />
                                    </a>
                                </div>

                                <div class="post-content">

                                    <h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2"><a
                                            href="/view/{{ $blog->id }}">{{ $blog->title }}</a></h2>
                                    <p>{!! Str::limit($blog->content, 100) !!}</p>

                                    <div class="post-meta">
                                        <span><i class="far fa-user"></i> Oleh <a href="#">Admin</a> </span>
                                        <span><i class="far fa-calendar"></i>{{ $blog->created_at }}</span>
                                        <span class="d-block mt-2"><a href="/view/{{ $blog->id }}"
                                                class="btn btn-xs btn-light text-1 text-uppercase">Selengkapnya</a></span>
                                    </div>

                                </div>
                            </article>
                        </div>
                        @endforeach --}}

                        <div class="col-md-4 col-lg-3">
                            <article class="post post-medium border-0 pb-0 mb-5">
                                <div class="post-image">
                                    <div class="ratio ratio-16x9">
                                        <iframe width="560" height="315" src="https://www.youtube.com/embed/MrYFrd9xnUI"
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen></iframe>
                                    </div>
                                </div>

                                <div class="post-content">
                                    <h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2"><a
                                            href="https://www.youtube.com/watch?v=MrYFrd9xnUI">TALANG JALI DAN WONOMARTO
                                            DIPERIKSA INSPEKTORAT</a></h2>
                                    <div class="post-meta">
                                        <span><i class="far fa-user"></i> Oleh <a href="#">Admin</a> </span>
                                        <span class="d-block mt-2"><a href="https://www.youtube.com/watch?v=MrYFrd9xnUI"
                                                class="btn btn-xs btn-light text-1 text-uppercase">Selengkapnya</a></span>
                                    </div>
                                </div>
                            </article>
                        </div>

                        <div class="col-md-4 col-lg-3">
                            <article class="post post-medium border-0 pb-0 mb-5">
                                <div class="post-image">
                                    <div class="ratio ratio-16x9">
                                        <iframe width="560" height="315" src="https://www.youtube.com/embed/6q7gfglbzsE"
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen></iframe>
                                    </div>
                                </div>

                                <div class="post-content">
                                    <h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2"><a
                                            href="https://www.youtube.com/watch?v=6q7gfglbzsE">INSPEKTORAT LAKUKAN
                                            BINWAS</a></h2>
                                    <div class="post-meta">
                                        <span><i class="far fa-user"></i> Oleh <a href="#">Admin</a> </span>
                                        <span class="d-block mt-2"><a href="https://www.youtube.com/watch?v=6q7gfglbzsE"
                                                class="btn btn-xs btn-light text-1 text-uppercase">Selengkapnya</a></span>
                                    </div>
                                </div>
                            </article>
                        </div>

                        <div class="col-md-4 col-lg-3">
                            <article class="post post-medium border-0 pb-0 mb-5">
                                <div class="post-image">
                                    <div class="ratio ratio-16x9">
                                        <iframe width="560" height="315" src="https://www.youtube.com/embed/YYMQWr_s90E"
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen></iframe>
                                    </div>
                                </div>

                                <div class="post-content">
                                    <h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2"><a
                                            href="https://www.youtube.com/watch?v=YYMQWr_s90E">INSPEKTORAT PERIKSA
                                            PEKERJAAN AKHIR DESA PAMPANG TANGGUK DAN RATU JAYA</a></h2>
                                    <div class="post-meta">
                                        <span><i class="far fa-user"></i> Oleh <a href="#">Admin</a> </span>
                                        <span class="d-block mt-2"><a href="https://www.youtube.com/watch?v=YYMQWr_s90E"
                                                class="btn btn-xs btn-light text-1 text-uppercase">Selengkapnya</a></span>
                                    </div>
                                </div>
                            </article>
                        </div>

                        <div class="col-md-4 col-lg-3">
                            <article class="post post-medium border-0 pb-0 mb-5">
                                <div class="post-image">
                                    <div class="ratio ratio-16x9">
                                        <iframe width="560" height="315" src="https://www.youtube.com/embed/oi5hnjMti3M"
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen></iframe>
                                    </div>
                                </div>

                                <div class="post-content">
                                    <h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2"><a
                                            href="https://www.youtube.com/watch?v=oi5hnjMti3M">INSPEKTORAT DENGAN
                                            REGULASI BINWAS DESA</a></h2>
                                    <div class="post-meta">
                                        <span><i class="far fa-user"></i> Oleh <a href="#">Admin</a> </span>
                                        <span class="d-block mt-2"><a href="https://www.youtube.com/watch?v=oi5hnjMti3M"
                                                class="btn btn-xs btn-light text-1 text-uppercase">Selengkapnya</a></span>
                                    </div>
                                </div>
                            </article>
                        </div>


                    </div>

                </div>
            </div>

        </div>
    </div>

    <div id="examples" class="container py-0">
        <section class="row mt-5 pb-4">
            <div class="col">
                <div class="row text-center pt-4 pb-5">
                    <div class="col">
                        <h2 class="word-rotator slide font-weight-bold text-8 mb-2">Pengumuman</h2>
                        <a href="/allpengumuman" style="text-decoration: none;"><span
                                class="sub-title text-info">Selengkapnya <i class="fas fa-arrow-right"></i></span></a>
                    </div>
                </div>
                <div class="owl-carousel owl-theme show-nav-title top-border mb-0"
                    data-plugin-options="{'responsive': {'0': {'items': 1}, '479': {'items': 1}, '768': {'items': 2}, '979': {'items': 3}, '1199': {'items': 3}}, 'items': 3, 'margin': 10, 'loop': false, 'nav': true, 'dots': false}">
                    @foreach ($pengumumans as $pengumuman)
                    <div>
                        <div class="recent-posts">
                            <article class="post">
                                <div class="post-date">
                                    <span class="day">{{ substr ($pengumuman->created_at, 8, -8) }}</span>
                                    <?php 
                                            $bulan = substr ($pengumuman->created_at, 5, -12);
                                            if ($bulan == '01') {
                                                $bulans = 'JAN';
                                            } elseif ($bulan == '02') {
                                                $bulans = 'FEB';
                                            } elseif ($bulan == '03') {
                                                $bulans = 'MAR';
                                            } elseif ($bulan == '04') {
                                                $bulans = 'APR';
                                            } elseif ($bulan == '05') {
                                                $bulans = 'MEI';
                                            } elseif ($bulan == '06') {
                                                $bulans = 'JUN';
                                            } elseif ($bulan == '07') {
                                                $bulans = 'JUL';
                                            } elseif ($bulan == '08') {
                                                $bulans = 'AGS';
                                            } elseif ($bulan == '09') {
                                                $bulans = 'SEP';
                                            } elseif ($bulan == '10') {
                                                $bulans = 'OKT';
                                            } elseif ($bulan == '11') {
                                                $bulans = 'NOV';
                                            } else {
                                                $bulans = 'DES';
                                            }
                                            ?>
                                    {{-- @if

                                    @endif --}}
                                    <span class="month bg-danger">{{ $bulans }}</span>
                                </div>
                                <h4><a href="/viewpengumuman/{{ $pengumuman->id }}" class="text-decoration-none">{{
                                        $pengumuman->title }}</a></h4>
                                {!! Str::limit($pengumuman->content, 100) !!}<a
                                    href="/viewpengumuman/{{ $pengumuman->id }}"
                                    class="read-more font-weight-bold text-2">Selengkapnya..<i
                                        class="fas fa-chevron-right text-1 ms-1"></i></a>
                            </article>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
    </div>

    <div id="examples">
        <section class="section border-0 p-relative bg-color-primary">

            <div class="row text-center pt-4 pb-5">
                <div class="col">
                    <h2 class="word-rotator slide font-weight-bold text-8 mb-2 text-white">Capaian Akuntabilitas Desa
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="ps-3 pe-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-box table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th style="text-align: center">Nama Desa</th>
                                                <th style="text-align: center">Kecamatan</th>
                                                <th colspan="2" style="text-align: center" width="100px">Nilai Aspek
                                                    Penyelenggaraan Pemdes</th>
                                                <th style="text-align: center" width="100px">Nilai Aspek Pengelolaan
                                                    BUMDes</th>
                                                <th style="text-align: center">Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total = 0; ?>
                                            @foreach ($desas as $ds)
                                            <tr>
                                                <td style="width:5%; text-align: center;">{{ $loop->iteration }}</td>
                                                <td style="text-align: left;">{{ $ds->asal }}</td>
                                                <td style="text-align: left;">{{ $ds->kecamatan }}</td>
                                                @foreach($aspeks as $as)
                                                <?php $pemdes = $as->rekap_nilai_aspek->where('asal_id', $ds->id)->where('tahun',
                                                        $tahun)->where('aspek_id', $as->id)->pluck('skor')->first(); ?>
                                                @endforeach
                                                @foreach($aspekeu as $ask)
                                                <?php $keudes = $ask->rekap_nilai_aspek->where('asal_id', $ds->id)->where('tahun',
                                                        $tahun)->where('aspek_id', $ask->id)->pluck('skor')->first(); ?>
                                                @endforeach
                                                <?php 
                                                
                                                    $nilai = $pemdes+$keudes;
                                                    $total += $nilai;
                                                    ?>
                                                <td style="text-align: center;">{{ $nilai }} </td>
                                                <td width="5%;" style="text-align: center;">
                                                    @if($nilai <= 30) <span><i class="fa-solid fa-circle"
                                                            style="color: red;"></i></span>
                                                        @elseif ($nilai >=31 && $nilai <= 55) <span><i
                                                                class="fa-solid fa-circle"
                                                                style="color: orange;"></i></span>
                                                            @elseif ($nilai >=56 && $nilai <= 75) <span><i
                                                                    class="fa-solid fa-circle"
                                                                    style="color: yellow;"></i></span>
                                                                @elseif ($nilai >=76 && $nilai <= 90) <span><i
                                                                        class="fa-solid fa-circle"
                                                                        style="color: #27a844"></i></span>
                                                                    @else
                                                                    <span><i class="fa-solid fa-circle"
                                                                            style="color: #0088cc;"></i></span>
                                                                    @endif
                                                </td>
                                                <td style="text-align: center;">-</td>
                                                <td class="text-center"><a class="btn btn-primary btn-sm"
                                                        href="/viewnilai/{{ $ds->id }}">Lihat</a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <?php $tot = $total/23200 * 100 ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-5 mt-5 mb-5">

                    <div class="row mt-5">
                        <div class="col-md-4">

                            <div class="circular-bar">
                                <div class="circular-bar-chart" data-percent="{{ $tot }}"
                                    data-plugin-options="{'lineWidth': 17, 'barColor': '#eed202'}">
                                    <strong style="color: white;">Aspek PemDes</strong>
                                    <label style="color: white;" class="text-5 font-weight-bold">{{ number_format($tot,
                                        2, '.', ','); }}</label>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-7 ps-4 pe-4">
                            <h5 style="color: white;">Total Rata-rata Skor Aspek Penyelenggaraan Pemdes</h5>
                            <span style="color: white;">Nilai rata-rata skor Aspek Penyelenggaraan Pemdes dari seluruh
                                Desa di Lingkungan Pemerintah Kabupaten Lampung Utara</span>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col mb-4">
                            <hr class="my-4" style="color: white; border-width:5px;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">

                            <div class="circular-bar">
                                <div class="circular-bar-chart" data-percent="75"
                                    data-plugin-options="{'lineWidth': 17, 'barColor': '#42ba96'}">
                                    <strong style="color: white;">Aspek BUMDes</strong>
                                    <label style="color: white;" class="text-5 font-weight-bold">75</label>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-7 ps-4 pe-4">
                            <h5 style="color: white;">Total Rata-rata Skor Aspek Pengelolaan BUMDes</h5>
                            <span style="color: white;">Nilai rata-rata skor Aspek Pengelolaan BUMDes dari seluruh Desa
                                di Lingkungan Pemerintah Kabupaten Lampung Utara</span>
                        </div>

                    </div>


                </div>


            </div>


            <div class="row mt-3 ps-3 pe-3">
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <span class="badge badge-sm"
                                        style="display: block; height:100%; background-color:red;">&nbsp;</span>
                                </div>
                                <div class="col-md-10">
                                    <span class="text-4 font-weight-bold">0-30</span><br>
                                    <span>Sangat Rendah</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <span class="badge badge-sm"
                                        style="display: block; height:100%; background-color:orange;">&nbsp;</span>
                                </div>
                                <div class="col-md-10">
                                    <span class="text-4 font-weight-bold">31-55</span><br>
                                    <span>Rendah</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <span class="badge badge-sm"
                                        style="display: block; height:100%; background-color:yellow;">&nbsp;</span>
                                </div>
                                <div class="col-md-10">
                                    <span class="text-4 font-weight-bold">56-75</span><br>
                                    <span>Cukup</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <span class="badge badge-success badge-sm"
                                        style="display: block; height:100%;">&nbsp;</span>
                                </div>
                                <div class="col-md-10">
                                    <span class="text-4 font-weight-bold">76-90</span><br>
                                    <span>Tinggi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <span class="badge badge-primary badge-sm"
                                        style="display: block; height:100%;">&nbsp;</span>
                                </div>
                                <div class="col-md-10">
                                    <span class="text-4 font-weight-bold">91-100</span><br>
                                    <span>Sangat Tinggi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>


    <div class="container">
        <div class="row mt-5 pb-4">
            <div class="col">
                <h4>Peraturan - Peraturan</h4>
                <div class="owl-carousel owl-theme show-nav-title top-border mb-0"
                    data-plugin-options="{'responsive': {'0': {'items': 1}, '479': {'items': 1}, '768': {'items': 2}, '979': {'items': 3}, '1199': {'items': 3}}, 'items': 3, 'margin': 10, 'loop': false, 'nav': true, 'dots': false}">
                    @foreach ($peraturans as $peraturan)
                    <div>
                        <div class="recent-posts">
                            <article class="post">
                                <div class="post-date">
                                    <span class="day">{{ $peraturan->nomor }}</span>
                                    <span class="month">{{ $peraturan->tahun }}</span>
                                </div>
                                <h4><a href="/viewperaturan/{{ $peraturan->id }}" class="text-decoration-none">{{
                                        $peraturan->title }}</a></h4>
                                {!! Str::limit($peraturan->content, 100) !!}<a
                                    href="/viewperaturan/{{ $peraturan->id }}"
                                    class="read-more font-weight-bold text-2">read more <i
                                        class="fas fa-chevron-right text-1 ms-1"></i></a>
                            </article>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col mb-4 pt-5">
            <hr class="my-0">
        </div>
    </div>

    <div class="container container-xl-custom">
        <div class="row text-center">
            <div class="owl-carousel owl-theme carousel-all-active-item"
                data-plugin-options='{"items": 7, "autoplay": true, "autoplayTimeout": 3000, "dots": false}'>
                <div>
                    <a href="https://lampungutarakab.go.id/"><img class="img-fluid" src="storage/image/lampungutara.png"
                            style="height: 40px; width: 130px;"></a>
                </div>
                <div>
                    <a href="https://inspektorat.lampungutarakab.go.id/"><img class="img-fluid"
                            src="storage/image/inspektorat.png" style="height: 40px; width: 130px;"></a>
                </div>
                <div>
                    <a href="https://www.kpk.go.id/id/"><img class="img-fluid" src="storage/image/logo-kpk.png"
                            style="height: 40px; width: auto;"></a>
                </div>
                <div>
                    <a
                        href="https://lampungutarakab.sipd.kemendagri.go.id/daerah?P9kmZHtOncgI7E87NvZcG8lgjuCMpV/tQETGOa/op3aWypO@ZMP/8yVUBuN6DGLOmNkZ6NUKRzzUUUiVvnO9pb/OXvCTwMvYbiXd60GBwz3r9KyfLiU5AGfKS/piCZJf"><img
                            class="img-fluid" src="storage/image/sipd-lampura.png"
                            style="height: 50px; width: auto;"></a>
                </div>
                <div>
                    <a href="https://lampung.bpk.go.id/"><img class="img-fluid" src="storage/image/bpk-ri.png"
                            style="height: 50px; width: auto;"></a>
                </div>
                <div>
                    <a href="http://www.bpkp.go.id/lampung.bpkp"><img class="img-fluid" src="storage/image/bpkp.png"
                            style="height: 50px; width: auto;"></a>
                </div>
                <div>
                    <a href="http://www.lapor.go.id/"><img class="img-fluid" src="storage/image/spanlapor.png"
                            style="height: 50px; width: auto;"></a>
                </div>
                <div>
                    <a href="https://jaga.id/"><img class="img-fluid" src="storage/image/logo-jaga.png"
                            style="height: 70px; width: auto;"></a>
                </div>
                <div>
                    <a href="https://www.kemendagri.go.id/"><img class="img-fluid" src="storage/image/kemendagri.png"
                            style="height: 50px; width: auto;"></a>
                </div>
                <div>
                    <a href="https://elhkpn.kpk.go.id/"><img class="img-fluid" src="storage/image/elhkpn.png"
                            style="height: 50px; width: auto;"></a>
                </div>

            </div>
        </div>
    </div>

</div>
</div>
</div>



@endsection