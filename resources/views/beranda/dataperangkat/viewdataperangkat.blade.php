@extends('layouts.main')
@section('css')
<!-- Material Icons -->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
<!-- CSS Files -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
<link id="pagestyle" href="/assets/css/material-kit.css?v=3.0.4" rel="stylesheet" />

@endsection
@section('content')
@foreach($desas as $desa)
<div role="main" class="main">

    <section class="section section-concept section-no-border section-dark section-angled section-angled-reverse pt-5 m-0 overlay overlay-color-grey overlay-show overlay-op-8" style="background-image: url(/img/background-slide1.jpg); background-size: cover; background-position: center; animation-duration: 750ms; animation-delay: 300ms; animation-fill-mode: forwards; min-height: 645px;">
        <div class="section-angled-layer-bottom section-angled-layer-increase-angle bg-light" style="padding: 8rem 0;"></div>
            <div class="container pt-lg-5 mt-5">
                <div class="row pt-3 pb-lg-0 pb-xl-0">
                    <div class="col-lg-6 pt-4 mb-5 mb-lg-0">
                        <h1 class="font-weight-bold text-10 text-xl-12 line-height-2 mb-3">Perangkat Desa <br>{{ $desa->asal }}</h1>
                        <p class="font-weight-light opacity-7 pb-2 mb-4">Terletak di Kecamatan {{ $desa->kecamatan }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-funnel position-relative border-0 pt-5 m-0">
        <div class="container pb-5 mb-5">
            <h2 class="fotn-weight-extra-bold mb-3 text-center">
                <span class="font-weight-bold text-5 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="600" data-appear-animation-duration="750">Data Perangkat Desa {{ $desa->asal }}</span>
            </h2>
            <p class="font-weight-bold text-8 text-center appear-animation pb-5" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="750">Tahun {{ $tahun }}</p>
            <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="850" data-appear-animation-duration="850">
                <div class="owl-carousel carousel-center-active-item-2 nav-style-4 mb-4 pb-3" data-plugin-options="{'items': 1, 'loop': true, 'nav': true, 'dots': false}">
                    @foreach($perangkats as $prg)
                    <div>
                        <div class="d-flex flex-column flex-md-row justify-content-between mb-4">
                            <div class="author">
                                <h4 class="text-5 mb-2">{{ $prg->nama }}</h4>
                                <span class="opacity-7">{{ $prg->jabatan }} ({{ $prg->status_jab }})</span>
                                <p class="mb-2">Nomor Surat Keputusan : {{ $prg->nomor_sk }}</p>
                                <p class="mb-2">Dokumen Surat Keputusan : <a class="btn btn-outline btn-success mb-2" target="_blank" rel="noopener" href="/storage/{{$prg->file_data}}"><i style="font-size: 20px" class="fa-sharp fa-solid fa-download"></i></a>
                                </p>
                            </div>
                            <div class="thumb-info-side-image-wrapper">
                                <img src="/storage/{{ $prg->foto_perangkat }}" class="img-fluid" alt="{{ $prg->jabatan }}" style="width: 150px;">
                            </div>                            
                        </div>
                    </div>	
                    @endforeach
                </div>
            </div>
        </div>
        <div class="section-funnel-layer-bottom">
            <div class="section-funnel-layer bg-light"></div>
            <div class="section-funnel-layer bg-light"></div>
        </div>
    </section>

 
    <section class="section section-funnel position-relative border-0 pt-5 m-0">
        <div class="container pb-2 mb-0">
            <h4 class="fotn-weight-extra-bold mb-3 text-center">
                <span class="font-weight-bold text-5 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="600" data-appear-animation-duration="750">Kepala Dusun & RT</span>
            </h4>
        </div>
    </section>
    <div class="owl-carousel owl-theme full-width" data-plugin-options="{'items': 5, 'loop': false, 'nav': true, 'dots': false}">
        @foreach($dusuns as $ds)
        <div>
            <a>
                <span class="thumb-info thumb-info-centered-info thumb-info-no-borders">
                    <span class="thumb-info-wrapper">
                        <img src="/storage/{{ $ds->foto_perangkat }}" class="img-fluid" alt="">
                        <span class="thumb-info-title">
                            <span class="thumb-info-inner">{{ $ds->nama }}</span>
                            <span class="thumb-info-type">{{ $ds->jabatan }}</span>
                        </span>
                        <span class="thumb-info-action">
                            <span class="thumb-info-action-icon"><i class="fas fa-plus"></i></span>
                        </span>
                    </span>
                </span>
            </a>
        </div>
        @endforeach
        @foreach($rts as $rt)
        <div>
            <a>
                <span class="thumb-info thumb-info-centered-info thumb-info-no-borders">
                    <span class="thumb-info-wrapper">
                        <img src="/storage/{{ $rt->foto_perangkat }}" class="img-fluid" alt="">
                        <span class="thumb-info-title">
                            <span class="thumb-info-inner">{{ $rt->nama }}</span>
                            <span class="thumb-info-type">{{ $rt->jabatan }}</span>
                        </span>
                        <span class="thumb-info-action">
                            <span class="thumb-info-action-icon"><i class="fas fa-plus"></i></span>
                        </span>
                    </span>
                </span>
            </a>
        </div>
        @endforeach
    </div>

    <section class="section section-funnel position-relative border-0 pt-5 m-0">
        <div class="container pb-2 mb-0">
            <h4 class="fotn-weight-extra-bold mb-3 text-center">
                <span class="font-weight-bold text-5 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="600" data-appear-animation-duration="750">BPD</span>
            </h4>
        </div>
    </section>  
    <div class="owl-carousel owl-theme full-width" data-plugin-options="{'items': 5, 'loop': false, 'nav': true, 'dots': false}">
        @foreach($bpds as $bpd)
        <div>
            <a>
                <span class="thumb-info thumb-info-centered-info thumb-info-no-borders">
                    <span class="thumb-info-wrapper">
                        @if($bpd->foto_perangkat)
                            <img src="/storage/{{ $bpd->foto_perangkat }}" class="img-fluid" alt="">
                        @else
                            <img src="/storage/image/no_image.png" class="img-fluid" alt="">
                        @endif
                        <span class="thumb-info-title">
                            <span class="thumb-info-inner">{{ $bpd->nama }}</span>
                            <span class="thumb-info-type">{{ $bpd->jabatan }}</span>
                        </span>
                        <span class="thumb-info-action">
                            <span class="thumb-info-action-icon"><i class="fas fa-plus"></i></span>
                        </span>
                    </span>
                </span>
            </a>
        </div>
        @endforeach
    </div>
    

    <hr class="solid my-5">
</div>
@endforeach
@endsection