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
        <div class="owl-carousel dots-inside dots-horizontal-center show-dots-hover nav-inside nav-inside-plus nav-dark nav-md nav-font-size-md show-nav-hover mb-0" data-plugin-options="{'responsive': {'0': {'items': 1}, '479': {'items': 1}, '768': {'items': 1}, '979': {'items': 1}, '1199': {'items': 1}}, 'loop': false, 'autoHeight': false, 'margin': 0, 'dots': true, 'dotsVerticalOffset': '-75px', 'nav': true, 'animateIn': 'fadeIn', 'animateOut': 'fadeOut', 'mouseDrag': false, 'touchDrag': false, 'pullDrag': false, 'autoplay': true, 'autoplayTimeout': 9000, 'autoplayHoverPause': true, 'rewind': true}">
                       
            <!-- Carousel Slide 3 -->
            <div class="position-relative overlay overlay-color-dark overlay-show overlay-op-5" data-dynamic-height="['500px','500px','500px','450px','400px']" style="background-image: url(/img/background-slide1.jpg); background-size: cover; background-position: center; height: 600px;">
                <div class="container position-relative z-index-3 h-100">
                    <div class="row justify-content-center align-items-center h-100">
                        <div class="col-lg-6">
                            <div class="d-flex flex-column align-items-center">
                                <div class="row mb-12">
                                    <div class="col-md-12 p-2">
                                      <img src="storage/image/lampura.png" style="width: 100%; height:auto">
                                    </div>
                                  </div>
                                <h3 class="position-relative text-color-light text-4 line-height-5 font-weight-medium px-4 mb-2 appear-animation" data-appear-animation="fadeInDownShorter" data-plugin-options="{'minWindowWidth': 0}">
                                    <span class="position-absolute right-100pct top-50pct transform3dy-n50 opacity-10">
                                        <img src="/assets/home/img/slides/slide-title-border.png" class="w-auto appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="250" data-plugin-options="{'minWindowWidth': 0}" alt="" />
                                    </span>
                                    <p class="text-4 text-color-light font-weight-dark text-center mt-3">PEMERINTAH KABUPATEN LAMPUNG UTARA</p>
                                    <span class="position-absolute left-100pct top-50pct transform3dy-n50 opacity-10">
                                        <img src="/assets/home/img/slides/slide-title-border.png" class="w-auto appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="250" data-plugin-options="{'minWindowWidth': 0}" alt="" />
                                    </span>
                                </h3>
                                <h3 style="font-size: 5vw;" class="text-color-light font-weight-extra-bold mb-3" data-plugin-animated-letters data-plugin-options="{'startDelay': 1000, 'minWindowWidth': 0, 'animationSpeed': 300, 'animationName': 'fadeInRightShorterOpacity', 'letterClass': 'd-inline-block'}">SIMONDES</h3>
                                <p class="text-4 text-color-light font-weight-dark text-center mb-0" data-plugin-animated-letters data-plugin-options="{'startDelay': 2000, 'minWindowWidth': 0}">Sistem Informasi Monitoring & Evaluasi Desa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            

        </div>
    </div>
    
    <section class="section bg-color-grey-scale-1 section-height-3 section-no-border section-center mb-0 appear-animation" data-appear-animation="fadeIn">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">
                    <div class="owl-carousel owl-theme nav-bottom rounded-nav mb-0" data-plugin-options="{'items': 1, 'loop': false, 'autoHeight': true}">
                        <div>
                            <div class="col">
                                <div class="testimonial testimonial-style-2 testimonial-with-quotes testimonial-quotes-dark mb-0">
                                    <div class="post-image text-center" style="margin:15px">
                                        <img src="storage/image/inspektur.png" class="rounded-circle" style="margin: auto; min-height: 250px; max-height: 300px; max-width: 250px;">
                                    </div>
                                    <blockquote>
                                        <p class="text-color-dark line-height-5" style="font-size: .8 rem">
                                        Simondes merupakan sistem informasi pengawasan Keuangan Desa yang meliputi perencanaan, pelaksanaan, dan pelaporan pengelolaan Keuangan Desa secara daring melalui jaringan internet, dalam rangka mewujudkan pemerintahan desa yang bersih, transparan dan akuntabel</p>
                                    </blockquote>
                                    <div class="testimonial-author">
                                        <p><strong class="opacity-9 font-weight-extra-bold text-2">-Inspektur Kabupaten Lampung Utara</strong></p>
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
    <div class="lightbox" data-plugin-options="{'delegate': 'a', 'type': 'image', 'gallery': {'enabled': true}, 'mainClass': 'mfp-with-zoom', 'zoom': {'enabled': true, 'duration': 300}}">
        <div class="owl-carousel owl-theme stage-margin" data-plugin-options="{'items': 4, 'margin': 10, 'loop': false, 'nav': true, 'dots': false, 'stagePadding': 40}">
            
            @foreach ($galeris as $galeri)
            <div>
                <a class="img-thumbnail img-thumbnail-no-borders img-thumbnail-hover-icon" href="storage/galeris/{{ $galeri->image }}">
                    <img class="img-fluid" src="storage/galeris/{{ $galeri->image }}" alt="{{ $galeri->description }}">
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
                        <h1 class="word-rotator slide text-8 mb-3 appear-animation" data-appear-animation="fadeInUpShorter">
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
                                    <li><a href="#"><img class="img-fluid" src="storage/image/akuntabilitas-1.jpg" alt="" /></a></li>
                                    <li><a href="#"><img class="img-fluid" src="storage/image/akuntabilitas-2.jpg" alt="" /></a></li>
                                    <li><a href="#"><img class="img-fluid" src="storage/image/akuntabilitas-3.jpg" alt="" /></a></li>
                                </ul>
                            </div>
                            <strong class="our-work">Akuntabilitas</strong>
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

        <div class="row text-center pt-2">
            <div class="col">
                <h2 class="word-rotator slide font-weight-bold text-8 mb-5">
                    <span>Berita</span>                    
                </h2>
            </div>
        </div>

        <div class="container py-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="blog-posts">
                        <div class="row">
                            @foreach ($blogs as $blog)
                                <div class="col-md-4 mb-4">
                                <div class="card card-border card-border-top bg-color-light mx-auto" style="margin: auto; min-height: 550px; max-height: 550px; max-width: 350px;">
                                    <article class="post post-medium border-0 pb-0 mb-5">
                                        <div class="post-image text-center" style="margin:15px;">
                                            <a href="/view/{{ $blog->id }}">
                                                <img class="img-fluid rounded" width src="storage/blogs/{{ $blog->image }}" style="margin: auto; min-height: 200px; max-height: 250px; max-width: 250px;">
                                            </a>
                                        </div>
                                        <div class="post-content" style="margin:15px;">                                                                                        
                                            <h2 class="font-weight-semibold text-4 line-height-6 mt-3 mb-2"><a href="/view/{{ $blog->id }}">{{ $blog->title }}</a></h2>
                                            <div class="post-meta">
                                                <span><i class="far fa-user"></i> Oleh <a href="#">Admin</a> </span>                                                
                                                <span><i class="far fa-calendar"></i>{{ Str::limit($blog->created_at, 10, '') }}</span>                                                
                                            </div>
                                            {!! Str::limit($blog->content, 100) !!}                                            
                                            <span class="d-block mt-2"><a href="/view/{{ $blog->id }}" class="btn btn-xs btn-light text-1 text-uppercase">Selengkapnya..</a></span>
                                        </div>
                                    </article>
                                </div>
                                </div>                                
                            @endforeach
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div id="examples" class="container py-0">        
            <section class="row mt-5 pb-4">
                <div class="col">
                    <div class="row text-center pt-4">
                        <div class="col">
                            <h2 class="word-rotator slide font-weight-bold text-8 mb-2">
                                <span>Pengumuman</span>
                                <br><br>
                            </h2>
                        </div>
                    </div>
                    <div class="owl-carousel owl-theme show-nav-title top-border mb-0" data-plugin-options="{'responsive': {'0': {'items': 1}, '479': {'items': 1}, '768': {'items': 2}, '979': {'items': 3}, '1199': {'items': 3}}, 'items': 3, 'margin': 10, 'loop': false, 'nav': true, 'dots': false}">
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
                                    <h4><a href="/viewpengumuman/{{ $pengumuman->id }}" class="text-decoration-none">{{ $pengumuman->title }}</a></h4>
                                    {!! Str::limit($pengumuman->content, 100) !!}<a href="/viewpengumuman/{{ $pengumuman->id }}" class="read-more font-weight-bold text-2">Selengkapnya..<i class="fas fa-chevron-right text-1 ms-1"></i></a>
                                </article>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>                                            
            </div>

            <div class="row">
                <div class="col mb-4">
                    <hr class="my-5">
                </div>
            </div>

            <div class="row">
            <div class="container">
                <div class="row text-center pt-0">
                    <div class="col-md-12">
                        <h2 class="word-rotator slide font-weight-bold text-8 mb-2">
                            <span>Capaian Akuntabilitas</span>
                            <br><br>
                        </h2>
                    </div>
                </div>
                <div class="row col-md-12">
                <div class="col-md-6 mb-4 mb-lg-0">
                    <h4>Pemerintahan Desa</h4>
                    <div class="accordion" id="accordion1">
                        <div class="accordion" id="accordionPrimary">
                            <div class="card card-default">
                                <div class="card-header bg-color-primary" id="collapsePrimaryHeadingOne">
                                    <h4 class="card-title m-0">
                                        <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#collapsePrimaryOne" aria-expanded="true" aria-controls="collapsePrimaryOne">
                                            Kewilayahan
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsePrimaryOne" class="collapse show" aria-labelledby="collapsePrimaryHeadingOne" data-bs-parent="#accordionPrimary">
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <div class="progress-bars mt-2">
                                                <div class="progress-label">
                                                    <span class="text-1">Dasar Hukum Pembentukan Desa</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-primary" data-appear-progress-animation="50%">
                                                        <span class="progress-bar-tooltip">50%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-label">
                                                    <span class="text-1">Peta Batas Desa</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-secondary" data-appear-progress-animation="70%" data-appear-animation-delay="300">
                                                        <span class="progress-bar-tooltip">70%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-label">
                                                    <span class="text-1">Patok Batas Desa</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-tertiary" data-appear-progress-animation="75%" data-appear-animation-delay="600">
                                                        <span class="progress-bar-tooltip">75%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-label">
                                                    <span class="text-1">Penyelesaian sengketa batas</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-quaternary" data-appear-progress-animation="40%" data-appear-animation-delay="900">
                                                        <span class="progress-bar-tooltip">40%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-default">
                                <div class="card-header bg-color-primary" id="collapsePrimaryHeadingTwo">
                                    <h4 class="card-title m-0">
                                        <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#collapsePrimaryTwo" aria-expanded="false" aria-controls="collapsePrimaryTwo">
                                            Kelembagaan
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsePrimaryTwo" class="collapse" aria-labelledby="collapsePrimaryHeadingTwo" data-bs-parent="#accordionPrimary">
                                    <div class="card-body">
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <div class="progress-bars mt-2">
                                                    <div class="progress-label">
                                                        <span class="text-1">Perdes SOTK</span>
                                                    </div>
                                                    <div class="progress mb-2">
                                                        <div class="progress-bar progress-bar-primary" data-appear-progress-animation="50%">
                                                            <span class="progress-bar-tooltip">50%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress-label">
                                                        <span class="text-1">SK Kades dan Perangkat Desa</span>
                                                    </div>
                                                    <div class="progress mb-2">
                                                        <div class="progress-bar progress-bar-secondary" data-appear-progress-animation="70%" data-appear-animation-delay="300">
                                                            <span class="progress-bar-tooltip">70%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress-label">
                                                        <span class="text-1">SK RT</span>
                                                    </div>
                                                    <div class="progress mb-2">
                                                        <div class="progress-bar progress-bar-tertiary" data-appear-progress-animation="75%" data-appear-animation-delay="600">
                                                            <span class="progress-bar-tooltip">75%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress-label">
                                                        <span class="text-1">SK LPM</span>
                                                    </div>
                                                    <div class="progress mb-2">
                                                        <div class="progress-bar progress-bar-quaternary" data-appear-progress-animation="40%" data-appear-animation-delay="900">
                                                            <span class="progress-bar-tooltip">40%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress-label">
                                                        <span class="text-1">SK Karang Taruna</span>
                                                    </div>
                                                    <div class="progress mb-2">
                                                        <div class="progress-bar progress-bar-primary" data-appear-progress-animation="50%">
                                                            <span class="progress-bar-tooltip">50%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress-label">
                                                        <span class="text-1">SK Linmas</span>
                                                    </div>
                                                    <div class="progress mb-2">
                                                        <div class="progress-bar progress-bar-secondary" data-appear-progress-animation="70%" data-appear-animation-delay="300">
                                                            <span class="progress-bar-tooltip">70%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress-label">
                                                        <span class="text-1">SK BPD</span>
                                                    </div>
                                                    <div class="progress mb-2">
                                                        <div class="progress-bar progress-bar-tertiary" data-appear-progress-animation="75%" data-appear-animation-delay="600">
                                                            <span class="progress-bar-tooltip">75%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress-label">
                                                        <span class="text-1">Keberadian dan Keberfungsian Kantor Desa</span>
                                                    </div>
                                                    <div class="progress mb-2">
                                                        <div class="progress-bar progress-bar-quaternary" data-appear-progress-animation="40%" data-appear-animation-delay="900">
                                                            <span class="progress-bar-tooltip">40%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress-label">
                                                        <span class="text-1">Sekretariat/Kantor BPD</span>
                                                    </div>
                                                    <div class="progress mb-2">
                                                        <div class="progress-bar progress-bar-primary" data-appear-progress-animation="50%">
                                                            <span class="progress-bar-tooltip">50%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress-label">
                                                        <span class="text-1">Sekretariat/Kantor LPM</span>
                                                    </div>
                                                    <div class="progress mb-2">
                                                        <div class="progress-bar progress-bar-secondary" data-appear-progress-animation="70%" data-appear-animation-delay="300">
                                                            <span class="progress-bar-tooltip">70%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-default">
                                <div class="card-header bg-color-primary" id="collapsePrimaryHeadingThree">
                                    <h4 class="card-title m-0">
                                        <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#dokperencanaan" aria-expanded="false" aria-controls="collapsePrimaryThree">
                                            Dokumen Perencanaan
                                        </a>
                                    </h4>
                                </div>
                                <div id="dokperencanaan" class="collapse" aria-labelledby="collapsePrimaryHeadingThree" data-bs-parent="#accordionPrimary">
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <div class="progress-bars mt-2">
                                                <div class="progress-label">
                                                    <span class="text-1">Perdes RPJMDes</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-primary" data-appear-progress-animation="50%">
                                                        <span class="progress-bar-tooltip">50%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-label">
                                                    <span class="text-1">BAC Musdes/Musdus</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-secondary" data-appear-progress-animation="70%" data-appear-animation-delay="300">
                                                        <span class="progress-bar-tooltip">70%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-label">
                                                    <span class="text-1">BAC Musrenbangdes</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-tertiary" data-appear-progress-animation="75%" data-appear-animation-delay="600">
                                                        <span class="progress-bar-tooltip">75%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-label">
                                                    <span class="text-1">SK Tim Penyusunan RKPDes</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-quaternary" data-appear-progress-animation="40%" data-appear-animation-delay="900">
                                                        <span class="progress-bar-tooltip">40%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-label">
                                                    <span class="text-1">Dokumen RKPDes</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-primary" data-appear-progress-animation="50%">
                                                        <span class="progress-bar-tooltip">50%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-label">
                                                    <span class="text-1">Kesesuaian RPJMDes dengan RKPDes</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-secondary" data-appear-progress-animation="70%" data-appear-animation-delay="300">
                                                        <span class="progress-bar-tooltip">70%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-label">
                                                    <span class="text-1">Dokumen RAPBDes</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-tertiary" data-appear-progress-animation="75%" data-appear-animation-delay="600">
                                                        <span class="progress-bar-tooltip">75%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-label">
                                                    <span class="text-1">BAC Pembahasan RAPBDes dengan BPD</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-quaternary" data-appear-progress-animation="40%" data-appear-animation-delay="900">
                                                        <span class="progress-bar-tooltip">40%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-label">
                                                    <span class="text-1">Hasil Evaluasi APBDes oleh Kecamatan</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-primary" data-appear-progress-animation="50%">
                                                        <span class="progress-bar-tooltip">50%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-label">
                                                    <span class="text-1">Dokumen APBDes Print Out Siskeudes</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-secondary" data-appear-progress-animation="70%" data-appear-animation-delay="300">
                                                        <span class="progress-bar-tooltip">70%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-label">
                                                    <span class="text-1">Desain Gambar dan RAB</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-primary" data-appear-progress-animation="50%">
                                                        <span class="progress-bar-tooltip">50%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-label">
                                                    <span class="text-1">Ketepatan Waktu Penetapan Perdes APBDes</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-secondary" data-appear-progress-animation="70%" data-appear-animation-delay="300">
                                                        <span class="progress-bar-tooltip">70%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-label">
                                                    <span class="text-1">Perkades tentang Penjabaran APBDes</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-tertiary" data-appear-progress-animation="75%" data-appear-animation-delay="600">
                                                        <span class="progress-bar-tooltip">75%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-default">
                                <div class="card-header bg-color-primary" id="collapsePrimaryHeadingThree">
                                    <h4 class="card-title m-0">
                                        <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#admumum" aria-expanded="false" aria-controls="collapsePrimaryThree">
                                            Administrasi Umum
                                        </a>
                                    </h4>
                                </div>
                                <div id="admumum" class="collapse" aria-labelledby="collapsePrimaryHeadingThree" data-bs-parent="#accordionPrimary">
                                    <div class="card-body">
                                        <div class="progress-bars mt-2">
                                            <div class="progress-label">
                                                <span class="text-1">Buku Surat Masuk/Keluar</span>
                                            </div>
                                            <div class="progress mb-2">
                                                <div class="progress-bar progress-bar-primary" data-appear-progress-animation="50%">
                                                    <span class="progress-bar-tooltip">50%</span>
                                                </div>
                                            </div>
                                            <div class="progress-label">
                                                <span class="text-1">Daftar Hadir Perangkat</span>
                                            </div>
                                            <div class="progress mb-2">
                                                <div class="progress-bar progress-bar-secondary" data-appear-progress-animation="70%" data-appear-animation-delay="300">
                                                    <span class="progress-bar-tooltip">70%</span>
                                                </div>
                                            </div>
                                            <div class="progress-label">
                                                <span class="text-1">Buku Register Perdes, Perkades, SK </span>
                                            </div>
                                            <div class="progress mb-2">
                                                <div class="progress-bar progress-bar-tertiary" data-appear-progress-animation="75%" data-appear-animation-delay="600">
                                                    <span class="progress-bar-tooltip">75%</span>
                                                </div>
                                            </div>
                                            <div class="progress-label">
                                                <span class="text-1">Buku Rekap Kependudukan</span>
                                            </div>
                                            <div class="progress mb-2">
                                                <div class="progress-bar progress-bar-quaternary" data-appear-progress-animation="40%" data-appear-animation-delay="900">
                                                    <span class="progress-bar-tooltip">40%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-default">
                                <div class="card-header bg-color-primary" id="collapsePrimaryHeadingThree">
                                    <h4 class="card-title m-0">
                                        <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#monografi" aria-expanded="false" aria-controls="collapsePrimaryThree">
                                            Data Monografi
                                        </a>
                                    </h4>
                                </div>
                                <div id="monografi" class="collapse" aria-labelledby="collapsePrimaryHeadingThree" data-bs-parent="#accordionPrimary">
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <div class="progress-bars mt-2">
                                                <div class="progress-label">
                                                    <span class="text-1">Jumlah Penduduk per kelompok usia</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-primary" data-appear-progress-animation="50%">
                                                        <span class="progress-bar-tooltip">50%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-label">
                                                    <span class="text-1">jumlah penduduk miskin</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-secondary" data-appear-progress-animation="70%" data-appear-animation-delay="300">
                                                        <span class="progress-bar-tooltip">70%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-label">
                                                    <span class="text-1">jumlah penduduk berdasarkan pekerjaan</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-tertiary" data-appear-progress-animation="75%" data-appear-animation-delay="600">
                                                        <span class="progress-bar-tooltip">75%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-label">
                                                    <span class="text-1">jumlah sarana ibadah</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-quaternary" data-appear-progress-animation="40%" data-appear-animation-delay="900">
                                                        <span class="progress-bar-tooltip">40%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-label">
                                                    <span class="text-1">jumlah sarana pendidikan</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-primary" data-appear-progress-animation="50%">
                                                        <span class="progress-bar-tooltip">50%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-label">
                                                    <span class="text-1">jumlah sarana kesehatan</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-secondary" data-appear-progress-animation="70%" data-appear-animation-delay="300">
                                                        <span class="progress-bar-tooltip">70%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-label">
                                                    <span class="text-1">jumlah umkm</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-tertiary" data-appear-progress-animation="75%" data-appear-animation-delay="600">
                                                        <span class="progress-bar-tooltip">75%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-label">
                                                    <span class="text-1">panjang jalan desa</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-quaternary" data-appear-progress-animation="40%" data-appear-animation-delay="900">
                                                        <span class="progress-bar-tooltip">40%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-label">
                                                    <span class="text-1">jumlah jembatan</span>
                                                </div>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-primary" data-appear-progress-animation="50%">
                                                        <span class="progress-bar-tooltip">50%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4 mb-lg-0">
                    <h4>Keuangan Desa</h4>
                    <div class="accordion" id="accordionTertiary">
                        <div class="card card-default">
                            <div class="card-header bg-color-tertiary" id="collapseTertiaryHeadingOne">
                                <h4 class="card-title m-0">
                                    <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#collapseTertiaryOne" aria-expanded="true" aria-controls="collapseTertiaryOne">
                                        Penataan Aset Desa
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTertiaryOne" class="collapse show" aria-labelledby="collapseTertiaryHeadingOne" data-bs-parent="#accordionTertiary">
                                <div class="card-body">
                                    <div class="progress-bars mt-2">
                                        <div class="progress-label">
                                            <span class="text-1">Buku Inventarisasi Aset Desa</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-primary" data-appear-progress-animation="50%">
                                                <span class="progress-bar-tooltip">50%</span>
                                            </div>
                                        </div>
                                        <div class="progress-label">
                                            <span class="text-1">Kartu Inventaris Barang</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-secondary" data-appear-progress-animation="70%" data-appear-animation-delay="300">
                                                <span class="progress-bar-tooltip">70%</span>
                                            </div>
                                        </div>
                                        <div class="progress-label">
                                            <span class="text-1">Kartu Inventaris Ruangan</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-tertiary" data-appear-progress-animation="75%" data-appear-animation-delay="600">
                                                <span class="progress-bar-tooltip">75%</span>
                                            </div>
                                        </div>
                                        <div class="progress-label">
                                            <span class="text-1">Surat Kuasa Pemegang Barang (Holder)</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-quaternary" data-appear-progress-animation="40%" data-appear-animation-delay="900">
                                                <span class="progress-bar-tooltip">40%</span>
                                            </div>
                                        </div>
                                        <div class="progress-label">
                                            <span class="text-1">Laporan Aset Tahunan</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-primary" data-appear-progress-animation="50%">
                                                <span class="progress-bar-tooltip">50%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-default">
                            <div class="card-header bg-color-tertiary" id="collapseTertiaryHeadingTwo">
                                <h4 class="card-title m-0">
                                    <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#collapseTertiaryTwo" aria-expanded="false" aria-controls="collapseTertiaryTwo">
                                        Penataan BUMDes
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTertiaryTwo" class="collapse" aria-labelledby="collapseTertiaryHeadingTwo" data-bs-parent="#accordionTertiary">
                                <div class="card-body">
                                    <div class="progress-bars mt-2">
                                        <div class="progress-label">
                                            <span class="text-1">Perdes Pembentukan BUMDes</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-primary" data-appear-progress-animation="50%">
                                                <span class="progress-bar-tooltip">50%</span>
                                            </div>
                                        </div>
                                        <div class="progress-label">
                                            <span class="text-1">Perdes Penyertaan Modal</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-secondary" data-appear-progress-animation="70%" data-appear-animation-delay="300">
                                                <span class="progress-bar-tooltip">70%</span>
                                            </div>
                                        </div>
                                        <div class="progress-label">
                                            <span class="text-1">SK Kepengurusan</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-tertiary" data-appear-progress-animation="75%" data-appear-animation-delay="600">
                                                <span class="progress-bar-tooltip">75%</span>
                                            </div>
                                        </div>
                                        <div class="progress-label">
                                            <span class="text-1">AD/ART BUMDes</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-quaternary" data-appear-progress-animation="40%" data-appear-animation-delay="900">
                                                <span class="progress-bar-tooltip">40%</span>
                                            </div>
                                        </div>
                                        <div class="progress-label">
                                            <span class="text-1">Proposal Pengajuan Modal</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-primary" data-appear-progress-animation="50%">
                                                <span class="progress-bar-tooltip">50%</span>
                                            </div>
                                        </div>
                                        <div class="progress-label">
                                            <span class="text-1">Laporan Keuangan BUMDes</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-secondary" data-appear-progress-animation="50%">
                                                <span class="progress-bar-tooltip">50%</span>
                                            </div>
                                        </div>
                                        <div class="progress-label">
                                            <span class="text-1">Kontribusi PADes</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-tertiary" data-appear-progress-animation="75%" data-appear-animation-delay="600">
                                                <span class="progress-bar-tooltip">75%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-default">
                            <div class="card-header bg-color-tertiary" id="collapseTertiaryHeadingThree">
                                <h4 class="card-title m-0">
                                    <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#barjas" aria-expanded="false" aria-controls="collapseTertiaryThree">
                                        Realisasi Belanja Modal (Pengadaan Barjas)
                                    </a>
                                </h4>
                            </div>
                            <div id="barjas" class="collapse" aria-labelledby="collapseTertiaryHeadingThree" data-bs-parent="#accordionTertiary">
                                <div class="card-body">
                                    <div class="progress-bars mt-2">
                                        <div class="progress-label">
                                            <span class="text-1">Standar Harga Barang</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-primary" data-appear-progress-animation="50%">
                                                <span class="progress-bar-tooltip">50%</span>
                                            </div>
                                        </div>
                                        <div class="progress-label">
                                            <span class="text-1">Asas kepatutan (jumlah dan jenis barang)</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-secondary" data-appear-progress-animation="70%" data-appear-animation-delay="300">
                                                <span class="progress-bar-tooltip">70%</span>
                                            </div>
                                        </div>
                                        <div class="progress-label">
                                            <span class="text-1">keseuaian barang dengan spec</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-tertiary" data-appear-progress-animation="75%" data-appear-animation-delay="600">
                                                <span class="progress-bar-tooltip">75%</span>
                                            </div>
                                        </div>
                                        <div class="progress-label">
                                            <span class="text-1">metode pengadaan</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-quaternary" data-appear-progress-animation="40%" data-appear-animation-delay="900">
                                                <span class="progress-bar-tooltip">40%</span>
                                            </div>
                                        </div>
                                        <div class="progress-label">
                                            <span class="text-1">validasi bukti belanja</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-primary" data-appear-progress-animation="50%">
                                                <span class="progress-bar-tooltip">50%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-default">
                            <div class="card-header bg-color-tertiary" id="collapseTertiaryHeadingThree">
                                <h4 class="card-title m-0">
                                    <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#fisik" aria-expanded="false" aria-controls="collapseTertiaryThree">
                                        Realisasi dan Administrasi Pembangunan Fisik
                                    </a>
                                </h4>
                            </div>
                            <div id="fisik" class="collapse" aria-labelledby="collapseTertiaryHeadingThree" data-bs-parent="#accordionTertiary">
                                <div class="card-body">
                                    <div class="progress-bars mt-2">
                                        <div class="progress-label">
                                            <span class="text-1">Laporan Realisasi dan Capaian Output DD Tahap I, II dan III</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-primary" data-appear-progress-animation="50%">
                                                <span class="progress-bar-tooltip">50%</span>
                                            </div>
                                        </div>
                                        <div class="progress-label">
                                            <span class="text-1">Foto progress pembangunan 0%, 50%, 100%</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-secondary" data-appear-progress-animation="70%" data-appear-animation-delay="300">
                                                <span class="progress-bar-tooltip">70%</span>
                                            </div>
                                        </div>
                                        <div class="progress-label">
                                            <span class="text-1">Hasil cek fisik lapangan (keseuaian dengan desain RAB Gambar)</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-tertiary" data-appear-progress-animation="75%" data-appear-animation-delay="600">
                                                <span class="progress-bar-tooltip">75%</span>
                                            </div>
                                        </div>
                                        <div class="progress-label">
                                            <span class="text-1">SK Pejabat Pelaksana Kegiatan</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-quaternary" data-appear-progress-animation="40%" data-appear-animation-delay="900">
                                                <span class="progress-bar-tooltip">40%</span>
                                            </div>
                                        </div>
                                        <div class="progress-label">
                                            <span class="text-1">BAC serah terima pembangunan</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-primary" data-appear-progress-animation="50%">
                                                <span class="progress-bar-tooltip">50%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-default">
                            <div class="card-header bg-color-tertiary" id="collapseTertiaryHeadingThree">
                                <h4 class="card-title m-0">
                                    <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#penatausahaan" aria-expanded="false" aria-controls="collapseTertiaryThree">
                                        Penatausahaan Belanja
                                    </a>
                                </h4>
                            </div>
                            <div id="penatausahaan" class="collapse" aria-labelledby="collapseTertiaryHeadingThree" data-bs-parent="#accordionTertiary">
                                <div class="card-body">
                                    <div class="progress-bars mt-2">
                                        <div class="progress-label">
                                            <span class="text-1">Laporan Realisasi APBDes Semester I dan II</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-primary" data-appear-progress-animation="50%">
                                                <span class="progress-bar-tooltip">50%</span>
                                            </div>
                                        </div>
                                        <div class="progress-label">
                                            <span class="text-1">Persentase (jumlah belanja- jumlah temuan)</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-secondary" data-appear-progress-animation="70%" data-appear-animation-delay="300">
                                                <span class="progress-bar-tooltip">70%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-default">
                            <div class="card-header bg-color-tertiary" id="collapseTertiaryHeadingThree">
                                <h4 class="card-title m-0">
                                    <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#pajak" aria-expanded="false" aria-controls="collapseTertiaryThree">
                                        Kepatuhan Pajak
                                    </a>
                                </h4>
                            </div>
                            <div id="pajak" class="collapse" aria-labelledby="collapseTertiaryHeadingThree" data-bs-parent="#accordionTertiary">
                                <div class="card-body">
                                    <div class="progress-bars mt-2">
                                        <div class="progress-label">
                                            <span class="text-1">Persentase Jumlah kewajiban pajak yang dibayarkan 2 tahun terakhir</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-primary" data-appear-progress-animation="50%">
                                                <span class="progress-bar-tooltip">50%</span>
                                            </div>
                                        </div>
                                        <div class="progress-label">
                                            <span class="text-1">Buku Pembantu Pajak</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-secondary" data-appear-progress-animation="70%" data-appear-animation-delay="300">
                                                <span class="progress-bar-tooltip">70%</span>
                                            </div>
                                        </div>
                                        <div class="progress-label">
                                            <span class="text-1">Pengarsipan Surat Setor Pajak</span>
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-tertiary" data-appear-progress-animation="75%" data-appear-animation-delay="600">
                                                <span class="progress-bar-tooltip">75%</span>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>                

            <hr class="solid my-5">
            
            <div class="row mt-5 pb-4">
                <div class="col">
                    <h4>Peraturan - Peraturan</h4>
                    <div class="owl-carousel owl-theme show-nav-title top-border mb-0" data-plugin-options="{'responsive': {'0': {'items': 1}, '479': {'items': 1}, '768': {'items': 2}, '979': {'items': 3}, '1199': {'items': 3}}, 'items': 3, 'margin': 10, 'loop': false, 'nav': true, 'dots': false}">
                        @foreach ($peraturans as $peraturan)
                        <div>
                            <div class="recent-posts">
                                <article class="post">
                                        <div class="post-date">
                                            <span class="day">{{ $peraturan->nomor }}</span>
                                            <span class="month">{{ $peraturan->tahun }}</span>
                                        </div>
                                        <h4><a href="/viewperaturan/{{ $peraturan->id }}" class="text-decoration-none">{{ $peraturan->title }}</a></h4>
                                        {!! Str::limit($peraturan->content, 100) !!}<a href="/viewperaturan/{{ $peraturan->id }}" class="read-more font-weight-bold text-2">read more <i class="fas fa-chevron-right text-1 ms-1"></i></a>
                                </article>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>    


    </div>
</div>



@endsection