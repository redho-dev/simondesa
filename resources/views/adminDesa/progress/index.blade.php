@extends('templates.desa.main')
@section('css')
<style>
    .circle_percent {
        font-size: 1rem;
        width: 7vw;
        height: 7vw;
        position: relative;
        background: #dcd2d2;
        border-radius: 50%;
        overflow: hidden;
        display: inline-block;
        margin: 0px;
        left: 0%;
        right:
    }

    .circle_inner {
        position: absolute;
        left: -20px;
        top: 0;
        width: 10vw;
        height: 10vw;
        clip: rect(0 10vw 10vw 5vw);

    }

    .round_per {
        position: absolute;
        left: 0px;
        border-top-left-radius: 80px;
        border-bottom-left-radius: 80px;
        border-right: 0;
        top: -10px;
        width: 10vw;
        height: 10vw;
        background: blue;
        clip: rect(0 10vw 10vw 5vw);
        transform: rotate(180deg);
        transition: 2s;
    }

    .percent_more .circle_inner {
        clip: rect(0 5vw 10vw 0em);
    }

    .percent_more:after {
        position: absolute;
        left: 3.5vw;
        top: 0em;
        right: 0;
        bottom: 0;
        background: blue;
        content: '';
    }

    .circle_inbox {
        position: absolute;
        top: 20px;
        left: 20px;
        right: 20px;
        bottom: 20px;
        background: #fff;
        z-index: 3;
        border-radius: 50%;
    }

    .percent_text {
        position: absolute;
        font-size: 1rem;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        z-index: 3;
    }
</style>
@endsection
@section('content')
{{-- <div class="clearfix"></div>
<br>
<div class="row">
    <div class="col-md-3 ">
        <div class="card">
            <h6 class="py-1 text-center">Data Monografi</h6>
            <div class="circle_percent mt-0 " data-percent="0.5">
                <div class="circle_inner ">
                    <div class="round_per"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 ">
        <div class="card">
            <h6 class="py-1 text-center">Data Perangkat</h6>
            <div class="circle_percent mt-0" data-percent="25">
                <div class="circle_inner">
                    <div class="round_per"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 ">
        <div class="card">
            <h6 class="py-1 text-center">Data Kadus & RT</h6>
            <div class="circle_percent mt-0" data-percent="100">
                <div class="circle_inner">
                    <div class="round_per"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 ">
        <div class="card">
            <h6 class="py-1 text-center">Data BPD</h6>
            <div class="circle_percent mt-0" data-percent="77">
                <div class="circle_inner">
                    <div class="round_per"></div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="clearfix"></div>
<!-- page content -->
<div role="main">
    <div class="">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel" style="height:600px;">
                    <div class="x_title">
                        <h2>Progress Input Data Tahun {{ $tahun }}</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Settings 1</a>
                                    <a class="dropdown-item" href="#">Settings 2</a>
                                </div>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-info text-center">ASPEK PENYELENGGARAAN PEMERINTAHAN DESA</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="alert alert-secondary alert-danger" id="pemdes">
                                            <h4 class="text-center">Pemerintahan Desa &emsp;&emsp; {{ $dataPemerintahan
                                                }}%
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="alert alert-secondary" id="keudes">
                                            <h4 class="text-center">Pengelolaan Keuangan Desa &emsp;&emsp; {{
                                                $dataKeuangan
                                                }}%
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center" id="row-keudes" style="display: none;">
                            <div class="d-flex ">

                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Penatausahaan Pendapatan</p>
                                            <p style="font-size: 1rem">Bobot : 10%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0"
                                                        data-percent="{{ $dataPendapatan ?? 0 }}">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <a href="javascript:void(0);" class="btn btn-success btn-block"
                                                    role="button">Detail Progress</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->
                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Penatausahaan <br> Belanja</p>
                                            <p style="font-size: 1rem">Bobot : 20%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0"
                                                        data-percent="{{ $dataBelanja ?? 0 }}">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <a href="javascript:void(0);" class="btn btn-success btn-block"
                                                    role="button">Detail Progress</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->
                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Penatausahaan <br>Pembiayaan </p>
                                            <p style="font-size: 1rem">Bobot : 10%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0"
                                                        data-percent="{{ $dataPembiayaan ?? 0 }}">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <a href="javascript:void(0);" class="btn btn-success btn-block"
                                                    role="button">Detail Progress</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->
                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Kepatuhan <br>Pajak </p>
                                            <p style="font-size: 1rem">Bobot : 15%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0"
                                                        data-percent="{{ $dataPajak ?? 0 }}">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <a href="javascript:void(0);" class="btn btn-success btn-block"
                                                    role="button">Detail Progress</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->
                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Kemandirian <br>Tatakelola </p>
                                            <p style="font-size: 1rem">Bobot : 10%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0"
                                                        data-percent="{{ $dataKemandirian ?? 0 }}">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <a href="javascript:void(0);" class="btn btn-success btn-block"
                                                    role="button">Detail Progress</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->
                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Pengadaan<br>Barang & Jasa </p>
                                            <p style="font-size: 1rem">Bobot : 20%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0"
                                                        data-percent="{{ $dataBarjas ?? 0 }}">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <a href="javascript:void(0);" class="btn btn-success btn-block"
                                                    role="button">Detail Progress</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->
                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Penataan <br>Aset Desa </p>
                                            <p style="font-size: 1rem">Bobot : 15%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0"
                                                        data-percent="{{ $dataAset ?? 0 }}">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <a href="javascript:void(0);" class="btn btn-success btn-block"
                                                    role="button">Detail Progress</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->


                            </div>
                        </div>
                        {{-- Pemdes --}}
                        <div class="row justify-content-center" id="row-pemdes">
                            <div class="d-flex">

                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Data Umum / <br> Monografi</p>
                                            <p style="font-size: 1rem">Bobot : 15%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0"
                                                        data-percent="{{ $dataUmum ?? 0 }}">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <a href="javascript:void(0);" class="btn btn-success btn-block"
                                                    role="button">Detail Progress</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->
                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Kewilayahan </p><br>
                                            <p style="font-size: 1rem">Bobot : 20%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0"
                                                        data-percent="{{ $dataKewilayahan ?? 0 }}">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <a href="javascript:void(0);" class="btn btn-success btn-block"
                                                    role="button">Detail Progress</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->
                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Data <br>Kelembagaan</p>
                                            <p style="font-size: 1rem">Bobot : 15%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0"
                                                        data-percent="{{ $dataKelembagaan ?? 0 }}">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <a href="javascript:void(0);" class="btn btn-success btn-block"
                                                    role="button">Detail Progress</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->
                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Dokumen <br>Perencanaan</p>
                                            <p style="font-size: 1rem">Bobot : 20%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0"
                                                        data-percent="{{ $dataPerencanaan ?? 0 }}">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <a href="javascript:void(0);" class="btn btn-success btn-block"
                                                    role="button">Detail Progress</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->

                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Administrasi<br>Umum </p>
                                            <p style="font-size: 1rem">Bobot : 10%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0"
                                                        data-percent="{{ $dataAdum ?? 0 }}">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <a href="javascript:void(0);" class="btn btn-success btn-block"
                                                    role="button">Detail Progress</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->
                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Pelaporan /<br>Pertanggungjawaban </p>
                                            <p style="font-size: 1rem">Bobot : 20%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0"
                                                        data-percent="{{ $dataPelaporan ?? 0 }}">
                                                        <div class=" circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <a href="javascript:void(0);" class="btn btn-success btn-block"
                                                    role="button">Detail Progress</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->


                            </div>
                        </div>
                        <div class="row" id="row-bumdes" style="display: none;">
                            <div class="d-flex">

                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">BUMDES</p>
                                            <p style="font-size: 1rem">Bobot : 15%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0" data-percent="77">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <a href="javascript:void(0);" class="btn btn-success btn-block"
                                                    role="button">Detail Progress</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->
                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Penatausahaan <br> Belanja</p>
                                            <p style="font-size: 1rem">Bobot : 15%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0" data-percent="77">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <a href="javascript:void(0);" class="btn btn-success btn-block"
                                                    role="button">Detail Progress</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->
                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Penatausahaan <br>Pembiayaan </p>
                                            <p style="font-size: 1rem">Bobot : 15%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0" data-percent="77">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <a href="javascript:void(0);" class="btn btn-success btn-block"
                                                    role="button">Detail Progress</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->
                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Kepatuhan <br>Pajak </p>
                                            <p style="font-size: 1rem">Bobot : 15%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0" data-percent="77">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <a href="javascript:void(0);" class="btn btn-success btn-block"
                                                    role="button">Detail Progress</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->
                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Kemandirian <br>Tatakelola </p>
                                            <p style="font-size: 1rem">Bobot : 15%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0" data-percent="77">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <a href="javascript:void(0);" class="btn btn-success btn-block"
                                                    role="button">Detail Progress</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->
                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Pengadaan<br>Barang & Jasa </p>
                                            <p style="font-size: 1rem">Bobot : 15%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0" data-percent="77">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <a href="javascript:void(0);" class="btn btn-success btn-block"
                                                    role="button">Detail Progress</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->
                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Penataan <br>Aset Desa </p>
                                            <p style="font-size: 1rem">Bobot : 15%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0" data-percent="77">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <a href="javascript:void(0);" class="btn btn-success btn-block"
                                                    role="button">Detail Progress</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->


                            </div>
                        </div>
                        <br><br><br><br><br>

                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel" style="height:600px;">
                    <div class="x_title">
                        <h2>Progress Input Data Tahun {{ $tahun }}</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="card mb-2">
                            <div class="card-header">
                                <h4 class="text-info text-center">ASPEK PENGELOLAAN BUM DESA</h4>
                            </div>
                        </div>

                        <div class="row justify-content-center" id="row-bumdes">
                            <div class="d-flex">

                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Badan Hukum <br> BUM Desa</p>
                                            <p style="font-size: 1rem">Bobot : 30%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0"
                                                        data-percent="{{ $dataBankum>0 ? 100 : 0 }}">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->
                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Perdes Pembentukan <br> & AD/ART</p>
                                            <p style="font-size: 1rem">Bobot : 10%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0"
                                                        data-percent="{{ $dataBentuk>0 ? 100 : 0 }}">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->
                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Perdes Penyertaan<br>Modal </p>
                                            <p style="font-size: 1rem">Bobot : 10%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0"
                                                        data-percent="{{ $dataModal>0 ? 100 : 0 }}">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->
                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">SK <br>Kepengurusan</p>
                                            <p style="font-size: 1rem">Bobot : 10%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0"
                                                        data-percent="{{ $dataPengurus>0 ? 100 : 0 }}">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->
                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Proposal Pengajuan<br>Modal Usaha</p>
                                            <p style="font-size: 1rem">Bobot : 10%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0"
                                                        data-percent="{{ $dataPengajuan>0 ? 100 : 0 }}">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->

                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Laporan Keuangan<br>BUM Desa </p>
                                            <p style="font-size: 1rem">Bobot : 15%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0"
                                                        data-percent="{{ $dataLapkeu>0 ? 100 : 0}}">
                                                        <div class="circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->
                                <!-- price element -->
                                <div class="col p-1">
                                    <div class="pricing">
                                        <div class="title">
                                            <p style="font-size: 1rem">Kontribusi <br>PADes</p>
                                            <p style="font-size: 1rem">Bobot : 15%</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_footer text-center py-4">
                                                    <div class="circle_percent mt-0"
                                                        data-percent="{{ $dataPades>0 ? 100 : 0 }}">
                                                        <div class=" circle_inner">
                                                            <div class="round_per"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->


                            </div>
                        </div>

                        <br><br><br><br><br>

                    </div>
                </div>
            </div>
        </div>


    </div>


</div>
<!-- /page content -->



@endsection
@push('script')
<script>
    $(".circle_percent").each(function() {
    var $this = $(this),
		$dataV = $this.data("percent"),
		$dataDeg = $dataV * 3.6,
		$round = $this.find(".round_per");
	$round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)");	
	$this.append('<div class="circle_inbox"><span class="percent_text"></span></div>');
	$this.prop('Counter', 0).animate({Counter: $dataV},
	{
		duration: 2000, 
		easing: 'swing', 
		step: function (now) {
            $this.find(".percent_text").text(Math.ceil(now)+"%");
        }
    });
	if($dataV >= 51){
		$round.css("transform", "rotate(" + 360 + "deg)");
		setTimeout(function(){
			$this.addClass("percent_more");
		},1000);
		setTimeout(function(){
			$round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)");
		},1000);
	} 
});

$('#keudes').on('click', function(){
    $('#keudes').addClass('alert-danger');
    $('#pemdes').removeClass('alert-danger');
    $('#bumdes').removeClass('alert-danger');

$('#row-keudes').show();
$('#row-pemdes').hide();
$('#row-bumdes').hide();


})

$('#pemdes').on('click', function(){
    $('#keudes').removeClass('alert-danger');
    $('#pemdes').addClass('alert-danger');
    $('#bumdes').removeClass('alert-danger');
    
$('#row-keudes').hide();
$('#row-pemdes').show();
$('#row-bumdes').hide();


})

$('#bumdes').on('click', function(){
    $('#keudes').removeClass('alert-danger');
    $('#pemdes').removeClass('alert-danger');
    $('#bumdes').addClass('alert-danger');
    
$('#row-keudes').hide();
$('#row-pemdes').hide();
$('#row-bumdes').show();


})



</script>
@endpush