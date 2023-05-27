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
    </section>
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
                    <strong data-to="89">0</strong>
                    <label>Sarana Pendidikan</label>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                <div class="counter text-dark appear-animation" data-appear-animation="bounceIn" data-appear-animation-delay="600">
                    <i class="fa-solid fa-mosque"></i>
                    <strong data-to="30">0</strong>
                    <label>Sarana Ibadah</label>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4 mb-sm-0">
                <div class="counter text-dark appear-animation" data-appear-animation="bounceIn" data-appear-animation-delay="900">
                    <i class="fa-solid fa-house-medical"></i>
                    <strong data-to="352">0</strong>
                    <label>Sarana Kesahatan</label>
                </div>
            </div>
            <div class="col-sm-8 col-lg-3 mb-4 mb-sm-0">
                <div class="counter text-dark appear-animation" data-appear-animation="bounceIn" data-appear-animation-delay="1200">
                    <i class="fa-sharp fa-solid fa-store"></i>
                    <strong data-to="178">0</strong>
                    <label>Jumlah UMKM</label>
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
                <h3 class="text-center" style="padding-bottom: 20px;"><u><strong>Jumlah Penduduk Per Kelompok Usia</strong></u></h3>
            <div class="col-md-6">
                <div class="call-to-action-content">
                    <h4>Laki - Laki</h4>
                    <p>Usia 0 - 6 Tahun <strong data-to="900" data-plugin-counter data-plugin-options="{'speed': 3500}">0</strong> Orang</p>
                    <p>Usia 7 - 12 Tahun <strong data-to="400" data-plugin-counter data-plugin-options="{'speed': 3500}">0</strong> Orang</p>
                    <p>Usia 13 - 18 Tahun <strong data-to="300" data-plugin-counter data-plugin-options="{'speed': 3500}">0</strong> Orang</p>
                    <p>Usia 19 - 25 Tahun <strong data-to="200" data-plugin-counter data-plugin-options="{'speed': 3500}">0</strong> Orang</p>
                    <p>Usia 26 - 40 Tahun <strong data-to="122" data-plugin-counter data-plugin-options="{'speed': 3500}">0</strong> Orang</p>
                    <p>Usia 41 - 55 Tahun <strong data-to="189" data-plugin-counter data-plugin-options="{'speed': 3500}">0</strong> Orang</p>
                    <p>Usia 56 - 65 Tahun <strong data-to="400" data-plugin-counter data-plugin-options="{'speed': 3500}">0</strong> Orang</p>
                    <p>Usia 66 - 75 Tahun <strong data-to="200" data-plugin-counter data-plugin-options="{'speed': 3500}">0</strong> Orang</p>
                    <p>Usia > 75 Tahun <strong data-to="100" data-plugin-counter data-plugin-options="{'speed': 3500}">0</strong> Orang</p> 
                    <p><b>Jumlah Laki - Laki <strong data-to="4500" data-plugin-counter data-plugin-options="{'speed': 3500}">0</strong> Orang</b></p>         
                </div>                                   
            </div>
            <div class="col-md-6">
                <div class="call-to-action-content">
                    <h4>Perempuan</h4>
                    <p>Usia 0 - 6 Tahun <strong data-to="200" data-plugin-counter data-plugin-options="{'speed': 3500}">0</strong> Orang</p>
                    <p>Usia 7 - 12 Tahun <strong data-to="123" data-plugin-counter data-plugin-options="{'speed': 3500}">0</strong> Orang</p>
                    <p>Usia 13 - 18 Tahun <strong data-to="345" data-plugin-counter data-plugin-options="{'speed': 3500}">0</strong> Orang</p>
                    <p>Usia 19 - 25 Tahun <strong data-to="2342" data-plugin-counter data-plugin-options="{'speed': 3500}">0</strong> Orang</p>
                    <p>Usia 26 - 40 Tahun <strong data-to="2346" data-plugin-counter data-plugin-options="{'speed': 3500}">0</strong> Orang</p>
                    <p>Usia 41 - 55 Tahun <strong data-to="23" data-plugin-counter data-plugin-options="{'speed': 3500}">0</strong> Orang</p>
                    <p>Usia 56 - 65 Tahun <strong data-to="2342" data-plugin-counter data-plugin-options="{'speed': 3500}">0</strong> Orang</p>
                    <p>Usia 66 - 75 Tahun <strong data-to="122" data-plugin-counter data-plugin-options="{'speed': 3500}">0</strong> Orang</p>
                    <p>Usia > 75 Tahun <strong data-to="142" data-plugin-counter data-plugin-options="{'speed': 3500}">0</strong> Orang</p>
                    <p><b>Jumlah Perempuan <strong data-to="4500" data-plugin-counter data-plugin-options="{'speed': 3500}">0</strong> Orang</b></p>                                            
                </div>
            </div>
            </div>
        </section>

        <section class="call-to-action call-to-action-primary mb-5">
            <div class="col-sm-9 col-lg-9">
                <div class="call-to-action-content">
                    <a class="lightbox" href="{{ Storage::url('image/Peta_Desa_Langkura.jpg') }}" data-plugin-options="{'type':'image'}">
                        <img class="img-fluid" src="{{ Storage::url('image/Peta_Desa_Langkura.jpg') }}" alt="Project Image">
                    </a>
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

                <h4>Pekerjaan/Mata Pencaharian</h4>

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
    <hr class="solid my-5">
</div>
@endforeach
@endsection