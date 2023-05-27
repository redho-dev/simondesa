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
    <section class="section section-concept section-no-border section-dark section-angled section-angled-reverse pt-5 m-0" id="section-concept" style="background:linear-gradient(0deg, rgba(0, 0, 0, 0.7), rgba(73, 73, 73, 0.7)), url(/img/background-slide1.jpg); background-size: cover; background-position: center; animation-duration: 750ms; animation-delay: 300ms; animation-fill-mode: forwards; min-height: 645px;">
        <div class="section-angled-layer-bottom bg-light" style="padding: 8rem 0;"></div>
        <div class="container pt-5 mt-5">
            <div class="row align-items-center pt-3">
                <div class="col-lg-7 mb-5">                    
                    <h1 class="font-weight-bold text-12 line-height-2 mb-3">Profil Desa <br>{{ $desa->asal }} Tahun {{ $tahun }}</h1>
                    <p class="custom-font-size-1">Terletak di Kecamatan {{ $desa->kecamatan }} dengan luas wilayah
                        @foreach($datums as $dt)
                            @if($dt->nama_data == 'luas_wilayah')
                                {{$dt->isidata}} m <sup>2</sup>
                            @endif
                        @endforeach
                    </p>                   
                </div>
                <div class="col-lg-5 mb-5">
                    <div class="owl-carousel owl-theme nav-inside nav-style-1 nav-light" data-plugin-options="{'items': 1, 'margin': 10, 'loop': true, 'nav': true, 'dots': false, 'autoplay': true, 'autoplayTimeout': 3000, 'autoplayHoverPause': true}">
                        @foreach ($galeris as $ga)
                        <div>
                            <div class="img-thumbnail border-0 p-0 d-block">
                                <img class="img-fluid border-radius-0" src="/storage/galeris/{{ $ga->image }}" alt="adsa">
                            </div>
                        </div>
                        @endforeach                        
                    </div>
                </div>
                

                <div class="col-md-12 col-lg-6 col-xl-5 custom-header-bar position-relative py-4 pe-5 z-index-12">
                @foreach ($akunwils as $aw)    
                    @if($aw->nama_data == 'dasar_hukum')
                    <div class="d-flex align-items-center justify-content-center position-relative text-dark text-6">
                        <a style="color: white;" class="btn btn-outline btn-success mb-2" target="_blank" rel="noopener" href="/storage/{{$aw->file_data}}"><i style="font-size: 20px" class="fa-sharp fa-solid fa-download"></i></a>
                    </div>
                    <h4 class="position-relative text-center font-weight-bold text-5 line-height-2 mb-0" onclick="window.location.href='/storage/{{$aw->file_data}}'target='_blank'">Dasar Hukum Pembentukan Desa</h4>
                    <div class="position-relative text-center text-light text-4">
                    @foreach($datums as $dt)
                        @if($dt->nama_data == 'dasar_hukum')
                            <span style="font-style:italic;">{{$dt->isidata}}</span>
                        @endif
                    @endforeach
                    </div>                    
                    @endif
                @endforeach                
                </div>  
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row pb-4">
            <div class="col">
                <hr class="solid my-5">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="feature-box reverse">
                            <div class="feature-box-icon">
                                <i class="icon-arrow-up-circle icons"></i>
                            </div>
                            <div class="feature-box-info">
                                <h4 class="mb-2">Batas Utara</h4>
                                @foreach($datums as $dt)
                                    @if($dt->nama_data == 'batas_utara')
                                        <p class="mb-4">{{$dt->isidata}}</p>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="feature-box">
                            <div class="feature-box-icon">
                                <i class="icon-arrow-down-circle icons"></i>
                            </div>
                            <div class="feature-box-info">
                                <h4 class="mb-2">Batas Selatan</h4>
                                @foreach($datums as $dt)
                                    @if($dt->nama_data == 'batas_selatan')
                                        <p class="mb-4">{{$dt->isidata}}</p>
                                    @endif
                                @endforeach										</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="feature-box reverse">
                            <div class="feature-box-icon">
                                <i class="icon-arrow-left-circle icons"></i>
                            </div>
                            <div class="feature-box-info">
                                <h4 class="mb-2">Batas Barat</h4>
                                @foreach($datums as $dt)
                                    @if($dt->nama_data == 'batas_barat')
                                        <p class="mb-4">{{$dt->isidata}}</p>
                                    @endif
                                @endforeach										</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="feature-box">
                            <div class="feature-box-icon">
                                <i class="icon-arrow-right-circle icons"></i>
                            </div>
                            <div class="feature-box-info">
                                <h4 class="mb-2">Batas Timur</h4>
                                @foreach($datums as $dt)
                                    @if($dt->nama_data == 'batas_timur')
                                        <p class="mb-4">{{$dt->isidata}}</p>
                                    @endif
                                @endforeach										</div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
    


    <div class="container">
        <div class="row text-center pt-4">
            <div class="col">
                <h2 class="word-rotator slide font-weight-bold text-8 mb-0">
                    <span>Monografi</span>
                    <br><br>
                </h2>
            </div>
        </div>
        <hr class="solid my-5">
        <div class="row counters">
            <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                <div class="counter text-dark appear-animation" data-appear-animation="bounceIn" data-appear-animation-delay="300">
                    <i class="fa-solid fa-school-flag"></i>
                    <strong data-to="{{$jml_pdd}}">0</strong>
                    <label>Sarana Pendidikan</label>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                <div class="counter text-dark appear-animation" data-appear-animation="bounceIn" data-appear-animation-delay="600">
                    <i class="fa-solid fa-mosque"></i>
                    <strong data-to="{{$jml_ibd}}">0</strong>
                    <label>Sarana Ibadah</label>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4 mb-sm-0">
                <div class="counter text-dark appear-animation" data-appear-animation="bounceIn" data-appear-animation-delay="900">
                    <i class="fa-solid fa-house-medical"></i>
                    <strong data-to="{{$jml_ksh}}">0</strong>
                    <label>Sarana Kesahatan</label>
                </div>
            </div>
            <div class="col-sm-8 col-lg-3 mb-4 mb-sm-0">
                <div class="counter text-dark appear-animation" data-appear-animation="bounceIn" data-appear-animation-delay="1200">
                    <i class="fa-sharp fa-solid fa-users-line"></i>
                    <strong data-to="{{$jml_um}}">0</strong>
                    <label>Jumlah Prasarana Umum</label>
                </div>
            </div>
        </div>
        <br>
        <div class="row counters">
            <div class="col-md-4">
                <div class="counter text-dark appear-animation" data-appear-animation="bounceIn" data-appear-animation-delay="1200">
                    <i class="fa-solid fa-person-arrow-down-to-line"></i>
                    <strong data-to="178">0</strong>
                    <label>Jumlah Penduduk Miskin</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="counter text-dark appear-animation" data-appear-animation="bounceIn" data-appear-animation-delay="1200">
                    <i class="fa-sharp fa-solid fa-road"></i>
                    <strong data-to="29002" data-append="m">0</strong>
                    <label>Panjang Jalan Desa</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="counter text-dark appear-animation" data-appear-animation="bounceIn" data-appear-animation-delay="1200">
                    <i class="fa-sharp fa-solid fa-bridge"></i>
                    <strong data-to="12">0</strong>
                    <label>Jumlah Jemabatan</label>
                </div>
            </div>
        </div>
        <hr class="solid my-5">
        <section class="call-to-action with-borders mb-5">
            <div class="row col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <section class="card card-admin">
                            <header class="card-header">
                                <h2 class="card-title">Kependudukan</h2>
                                <p class="card-subtitle">Data Kependudukan Tahun {{ $tahun }}</p>
                            </header>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-6 col-lg-4">
                                        <label>Jumlah Penduduk</label>
                                        @foreach($datums as $dt)
                                            @if($dt->nama_data == 'jumlah_penduduk')
                                                <strong>{{$dt->isidata}}</strong> Jiwa
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="col-xs-6 col-lg-4">
                                        <label>Jumlah Kepela Keluarga</label>
                                        @foreach($datums as $dt)
                                            @if($dt->nama_data == 'jumlah_kk')
                                                <strong>{{$dt->isidata}}</strong> Jiwa
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="col-xs-6 col-lg-4">
                                        <label>Penduduk Laki - Laki</label>
                                        @foreach($datums as $dt)
                                            @if($dt->nama_data == 'jumlah_penduduk_l')
                                                <strong>{{$dt->isidata}}</strong> Jiwa
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="col-xs-6 col-lg-4">
                                        <label>Penduduk Perempuan</label>
                                        @foreach($datums as $dt)
                                            @if($dt->nama_data == 'jumlah_penduduk_p')
                                                <strong>{{$dt->isidata}}</strong> Jiwa
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="col-xs-6 col-lg-4">
                                        <label>Usia 0-15 tahun</label>
                                        @foreach($datums as $dt)
                                            @if($dt->nama_data == 'usia_0_15')
                                                <strong>{{$dt->isidata}}</strong> Jiwa
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="col-xs-6 col-lg-4">
                                        <label>Usia 15-65 tahun</label>
                                        @foreach($datums as $dt)
                                            @if($dt->nama_data == 'usia_15_65')
                                                <strong>{{$dt->isidata}}</strong> Jiwa
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="col-xs-6 col-lg-4">
                                        <label>Usia > 65 tahun</label>
                                        @foreach($datums as $dt)
                                            @if($dt->nama_data == 'usia_65_keatas')
                                                <strong>{{$dt->isidata}}</strong> Jiwa
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="col-xs-6 col-lg-4">
                                        <label>Jumlah Penduduk Miskin</label>
                                        @foreach($datums as $dt)
                                            @if($dt->nama_data == 'penduduk_miskin')
                                                <strong>{{$dt->isidata}}</strong> Jiwa
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="col-xs-6 col-lg-4">
                                        <label>Jumlah KK Miskin</label>
                                        @foreach($datums as $dt)
                                            @if($dt->nama_data == 'kk_miskin')
                                                <strong>{{$dt->isidata}}</strong> Jiwa
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="col-xs-6 col-lg-4">
                                        <label>Jumlah Penerima BLT DD</label>
                                        @foreach($datums as $dt)
                                            @if($dt->nama_data == 'penerima_blt_dd')
                                                <strong>{{$dt->isidata}}</strong> Jiwa
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </section>
                        <hr class="solid my-5">
                        <section class="card card-admin">
                            <header class="card-header">
                                <h2 class="card-title">Kelembagaan</h2>
                                <p class="card-subtitle">Data Kelembagaan Tahun {{ $tahun }}</p>
                            </header>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-6 col-lg-4">
                                        <label>Pimpinan/Anggota BPD</label>
                                        @foreach($datums as $dt)
                                            @if($dt->nama_data == 'jumlah_bpd')
                                                <strong>{{$dt->isidata}}</strong>
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="col-xs-6 col-lg-4">
                                        <label>Pengurus/Anggota LPM</label>
                                        @foreach($datums as $dt)
                                            @if($dt->nama_data == 'jumlah_lpm')
                                                <strong>{{$dt->isidata}}</strong>
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="col-xs-6 col-lg-4">
                                        <label>Pengurus/Anggota PKK</label>
                                        @foreach($datums as $dt)
                                            @if($dt->nama_data == 'jumlah_pkk')
                                                <strong>{{$dt->isidata}}</strong>
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="col-xs-6 col-lg-4">
                                        <label>Pengurus/Anggota Karang Taruna</label>
                                        @foreach($datums as $dt)
                                            @if($dt->nama_data == 'jumlah_karang_taruna')
                                                <strong>{{$dt->isidata}}</strong>
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="col-xs-6 col-lg-4">
                                        <label>Anggota Linmas</label>
                                        @foreach($datums as $dt)
                                            @if($dt->nama_data == 'jumlah_linmas')
                                                <strong>{{$dt->isidata}}</strong>
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="col-xs-6 col-lg-4">
                                        <label>Kader Posyandu</label>
                                        @foreach($datums as $dt)
                                            @if($dt->nama_data == 'jumlah_kader')
                                                <strong>{{$dt->isidata}}</strong> 
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
		    </div>
        </section>

        <section class="call-to-action call-to-action-primary mb-5">
            <div class="col-sm-9 col-lg-9">
                <div class="call-to-action-content">
                    @foreach($akunwils as $aw)
                        @if($aw->nama_data == 'peta_batas')
                            <a class="lightbox" href="/storage/{{ $aw->file_data }}" data-plugin-options="{'type':'image'}">
                                <img class="img-fluid" src="/storage/{{ $aw->file_data }}" alt="Project Image">
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-sm-3 col-lg-3">
                <div class="call-to-action-content">
                    <h3><strong>Peta Desa</strong></h3>
                    <p class="mb-0 opacity-7">Desa {{ $desa->asal }}</p>
                </div>
            </div>
        </section>

        <div class="row">
            <div class="col pb-3">

                <h4>Pekerjaan / Mata Pencaharian</h4>

                <table class="table">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th>Jenis Pekerjaan</th>
                            <th>Laki - Laki</th>
                            <th>Perempuan</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Buruh Tani</td>
                            <td>2000</td>
                            <td>2000</td>
                            <td>4000</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Pegawai Negeri Sipil</td>
                            <td>2000</td>
                            <td>2000</td>
                            <td>4000</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Pedagang barang kelontong</td>
                            <td>2000</td>
                            <td>2000</td>
                            <td>4000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    
    </div>

</div>
@endforeach
@endsection

@push('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush