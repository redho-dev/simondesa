@extends('layouts.main')
@section('css')
<!-- Material Icons -->
<link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
<!-- CSS Files -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
<link id="pagestyle" href="/assets/css/material-kit.css?v=3.0.4" rel="stylesheet" />

<link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@endsection
@section('content')
@foreach($asals as $asal)
<div role="main" class="main">
    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-self-center p-static order-2 text-center">
                    <h6 class="text-dark font-weight-bold text-8">Pemerintah Desa {{ $asal->asal }}</h6>
                    <span class="sub-title text-dark">Angaran Pendapatan dan Belanja Desa (APBDES) Tahun {{ $tahun }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 align-self-center p-static order-2 text-center pt-5">
                    @forelse($perangkats as $prg)
                        @if($prg->jabatan == 'Kepala Desa')
                            <div class="thumb-info-side-image-wrapper">
                                <img src="/storage/{{ $prg->foto_perangkat }}" class="img-fluid" alt="{{ $prg->jabatan }}" style="width: 150px;">
                            </div> 
                            <h6 class="text-dark font-weight-bold text-5">{{ $prg->nama }}</h6>
                            <span class="sub-title text-dark">Kepala Desa</span>
                        @else                        
                            <div class="thumb-info-side-image-wrapper">
                                <img src="/storage/image/no_image.png" class="img-fluid" alt="" style="width: 150px;">
                            </div> 
                            <h6 class="text-dark font-weight-bold text-5"></h6>
                            <span class="sub-title text-dark">Kepala Desa</span>
                        @endif
                    @empty
                        <div class="thumb-info-side-image-wrapper">
                            <img src="/storage/image/no_image.png" class="img-fluid" alt="" style="width: 150px;">
                        </div> 
                        <h6 class="text-dark font-weight-bold text-5"></h6>
                        <span class="sub-title text-dark">Kepala Desa</span>
                    @endforelse
                </div>
                <div class="col-md-6 align-self-center p-static order-2 text-center pt-5">
                    @forelse($perangkats as $prg)
                        @if($prg->jabatan == 'Sekretaris Desa')
                            <div class="thumb-info-side-image-wrapper">
                                <img src="/storage/{{ $prg->foto_perangkat }}" class="img-fluid" alt="{{ $prg->jabatan }}" style="width: 150px;">
                            </div> 
                            <h6 class="text-dark font-weight-bold text-5">{{ $prg->nama }}</h6>
                            <span class="sub-title text-dark">Sekretaris Desa</span>
                        @else                        
                        <div class="thumb-info-side-image-wrapper">
                            <img src="/storage/image/no_image.png" class="img-fluid" alt="" style="width: 150px;">
                        </div> 
                        <h6 class="text-dark font-weight-bold text-5"></h6>
                        <span class="sub-title text-dark">Sekretaris Desa</span>
                        @endif
                    @empty
                        <div class="thumb-info-side-image-wrapper">
                            <img src="/storage/image/no_image.png" class="img-fluid" alt="" style="width: 150px;">
                        </div> 
                        <h6 class="text-dark font-weight-bold text-5"></h6>
                        <span class="sub-title text-dark">Sekretaris Desa</span>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

        <div class="row mb-12 pb-3">
            <div style="padding: 1%" class="col-md-6 mb-5 appear-animation center" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="600">
                <div class="card card-border card-border-top" style="background-image: linear-gradient(to right top, #071427, #112741, #1a3b5d, #22517a, #286899);">
                    <div class="card-body">
                        <h4 class="text-light card-title mb-1 text-4 font-weight-bold text-center"><u>APBDes Murni</u></h4>
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <table class="table table-borderless table-sm table-responsive text-light ">
                                        <tbody>
                                            <tr>
                                                <td style="width: 80%">1. Pendapatan</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px" class="text-2">a. Pendapatan Asli Desa</td>
                                                <td>Rp</td>
                                                <td style="text-align: right" class="text-2">100.000.000</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px" class="text-2">b. Pendapatan Transfer</td>
                                                <td>Rp</td>
                                                <td style="text-align: right" class="text-2">100.000.000</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px" class="text-2">c. Lain-lain Pendapatan Yang Sah</td>
                                                <td>Rp</td>
                                                <td style="text-align: right" class="text-2">100.000.000</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px"><b>Jumlah Pendapatan</b></td>
                                                <td>Rp</td>
                                                <td style="text-align: right"><b>100.000.000</b></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%">2. Belanja</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px" class="text-2">a. Bidang Penyelenggaraan Pemerintahan Desa</td>
                                                <td>Rp</td>
                                                <td style="text-align: right" class="text-2">100.000.000</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px" class="text-2">b. Bidang Pelaksanaan Pembangunan Desa</td>
                                                <td>Rp</td>
                                                <td style="text-align: right" class="text-2">100.000.000</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px" class="text-2">c. Bidang Pembinaan Kemasyarakatan Desa</td>
                                                <td>Rp</td>
                                                <td style="text-align: right" class="text-2">100.000.000</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px" class="text-2">d. Bidang Pemberdayaan Masyarakat Desa</td>
                                                <td>Rp</td>
                                                <td style="text-align: right" class="text-2">100.000.000</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px" class="text-2">e. Bidang Penanggulangan Bencana, Keadaan Darurat dan Mendesak Desa</td>
                                                <td>Rp</td>
                                                <td style="text-align: right" class="text-2">100.000.000</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px"><b>Jumlah Belanja</b></td>
                                                <td>Rp</td>
                                                <td style="text-align: right"><b>100.000.000</b></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%">3. Pembiayaan</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px" class="text-2">a. Penerimaan Pembiayaan</td>
                                                <td>Rp</td>
                                                <td style="text-align: right" class="text-2">100.000.000</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px" class="text-2">b. Pengeluaran Pembiayaan</td>
                                                <td>Rp</td>
                                                <td style="text-align: right" class="text-2">100.000.000</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px"><b>Selisih Pembiayaan (a-b)</b></td>
                                                <td>Rp</td>
                                                <td style="text-align: right"><b>100.000.000</b></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px"><b>Sisa Lebih/Kurang Perhitungan Anggaran</b></td>
                                                <td>Rp</td>
                                                <td style="text-align: right"><b>100.000.000</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="padding: 1%" class="col-md-6 mb-5 appear-animation center" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="600">
                <div class="card card-border card-border-top text-white" style="background-image: linear-gradient(to right top, #071427, #261d3d, #4f1f47, #781f42, #952c2f);">
                    <div class="card-body">
                        <h4 class="card-title mb-1 text-4 font-weight-bold text-center text-light "><u>APBDes Perubahan</u></h4>
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <table class="table table-borderless table-sm table-responsive text-light ">
                                        <tbody>
                                            <tr>
                                                <td style="width: 80%">1. Pendapatan</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px" class="text-2">a. Pendapatan Asli Desa</td>
                                                <td>Rp</td>
                                                <td style="text-align: right" class="text-2">100.000.000</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px" class="text-2">b. Pendapatan Transfer</td>
                                                <td>Rp</td>
                                                <td style="text-align: right" class="text-2">100.000.000</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px" class="text-2">c. Lain-lain Pendapatan Yang Sah</td>
                                                <td>Rp</td>
                                                <td style="text-align: right" class="text-2">100.000.000</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px"><b>Jumlah Pendapatan</b></td>
                                                <td>Rp</td>
                                                <td style="text-align: right"><b>100.000.000</b></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%">2. Belanja</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px" class="text-2">a. Bidang Penyelenggaraan Pemerintahan Desa</td>
                                                <td>Rp</td>
                                                <td style="text-align: right" class="text-2">100.000.000</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px" class="text-2">b. Bidang Pelaksanaan Pembangunan Desa</td>
                                                <td>Rp</td>
                                                <td style="text-align: right" class="text-2">100.000.000</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px" class="text-2">c. Bidang Pembinaan Kemasyarakatan Desa</td>
                                                <td>Rp</td>
                                                <td style="text-align: right" class="text-2">100.000.000</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px" class="text-2">d. Bidang Pemberdayaan Masyarakat Desa</td>
                                                <td>Rp</td>
                                                <td style="text-align: right" class="text-2">100.000.000</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px" class="text-2">e. Bidang Penanggulangan Bencana, Keadaan Darurat dan Mendesak Desa</td>
                                                <td>Rp</td>
                                                <td style="text-align: right" class="text-2">100.000.000</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px"><b>Jumlah Belanja</b></td>
                                                <td>Rp</td>
                                                <td style="text-align: right"><b>100.000.000</b></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%">3. Pembiayaan</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px" class="text-2">a. Penerimaan Pembiayaan</td>
                                                <td>Rp</td>
                                                <td style="text-align: right" class="text-2">100.000.000</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px" class="text-2">b. Pengeluaran Pembiayaan</td>
                                                <td>Rp</td>
                                                <td style="text-align: right" class="text-2">100.000.000</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px"><b>Selisih Pembiayaan (a-b)</b></td>
                                                <td>Rp</td>
                                                <td style="text-align: right"><b>100.000.000</b></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 80%; padding-left: 30px"><b>Sisa Lebih/Kurang Perhitungan Anggaran</b></td>
                                                <td>Rp</td>
                                                <td style="text-align: right"><b>100.000.000</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    

</div>
@endforeach
@endsection

@push('script')

<script>
    .card{
     border:none;
     width:400px; 
     border-radius:12px;
     color:#fff;
     background-image: linear-gradient(to right top, #280537, #56034c, #890058, #bc005b, #eb1254);
 }
</script>

@endpush