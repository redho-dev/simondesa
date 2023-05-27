@extends('templates.desa.main')

@section('content')
<div class="clearfix"></div>
<div class="row justify-content-center mt-2">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Data APBDes <span class="text-warning">Perubahan</span></h5>
        <div class="x_panel">
            <div class="x_title">

                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formApbdesP" method="get">
                        @csrf
                        <div class="form-group mx-sm-3 mb-2">
                            <h6>Masukkan tahun data :</h6>
                            <input type="text" name="tahun" class="form-control ml-3" placeholder="{{ $tahun }}"
                                data-inputmask="'mask': '9999'" style="font-size: .85rem">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mb-2">Cek Data</button>
                    </form>
                </div>
                <hr>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>

                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="text-dark">
                    Tahun Data : {{ $tahun }} &emsp;&emsp;&emsp; <span>APBDes Perubahan TA {{ $tahun }}</span>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='dokumen_P' ? 'active' : '' }}"
                            href="?jenis=dokumen_P&tahun={{ $tahun }}" role="tab">Kelengkapan Dokumen
                            <span class="fa fa-check-circle ml-1  {{ $dokumen ? '' : 'd-none'}}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='pendapatan_P' ? 'active' : '' }}"
                            href="?jenis=pendapatan_P&tahun={{ $tahun }}" role="tab">Pendapatan
                            <span class="fa fa-check-circle ml-1 {{ $apbdes_pendapatan ? '' : 'd-none'}} "></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='belanja_P' ? 'active' : '' }} "
                            href="?jenis=belanja_P&tahun={{ $tahun }}" role="tab">
                            Belanja
                            <span class="fa fa-check-circle ml-1 {{ $belanja ? '' : 'd-none' }} "></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='anggaran_kegiatan_P' ? 'active' : '' }} "
                            href="?jenis=anggaran_kegiatan_P&tahun={{ $tahun }}" role="tab"> Anggaran
                            Bidang/Sub/Kegiatan
                            <span class="fa fa-check-circle ml-1 {{ $apbdes_belanja ? '' : 'd-none'}} "></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link  {{ $jenis=='pembiayaan_P' ? 'active' : '' }} "
                            href="?jenis=pembiayaan_P&tahun={{ $tahun }}" role="tab">Pembiayaan
                            <span class="fa fa-check-circle ml-1 {{ $apbdes_pembiayaan ? '' : 'd-none'}} "></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{ $jenis=='cek_struktur_P' ? 'active' : '' }}"
                            href="?jenis=cek_struktur_P&tahun={{ $tahun }}" role="tab">Cek Struktur
                            APBDes_P
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane active show " id="kewilayahan" role="tabpanel"
                        aria-labelledby="kewilayahan-tab">
                        @if($jenis=='anggaran_kegiatan_P')
                        @include('adminDesa.formApbdesPerubahan.anggaran_kegiatan_tambah_P')
                        @elseif($jenis=='anggaran_bidangsub_P')
                        @include('adminDesa.formApbdesPerubahan.anggaran_bidangsub_tambah_P')
                        @elseif($jenis=='pendapatan_P')
                        @include('adminDesa.formApbdesPerubahan.anggaran_pendapatan_tambah_P')
                        @elseif($jenis=='pembiayaan_P')
                        @include('adminDesa.formApbdesPerubahan.anggaran_pembiayaan_tambah_P')
                        @elseif($jenis=='dokumen_P')
                        @include('adminDesa.formApbdesPerubahan.anggaran_dokumen_tambah_P')
                        @elseif($jenis=='belanja_P')
                        @include('adminDesa.formApbdesPerubahan.anggaran_belanja_tambah_P')
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
{{-- notifikasi --}}
@if(session()->has('success'))
<script>
    Swal.fire({
  position: 'center',
  icon: 'success',
  title: '{{ session("success") }}',
  showConfirmButton: false,
  timer: 1500
})
</script>

@endif

@if(session()->has('update'))
<script>
    Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: '{{ session("update") }}',
  showConfirmButton: false,
  timer: 1500
})
</script>

@endif

@endsection
@push('script')
<script src="/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script>
    bsCustomFileInput.init();
</script>
<!-- bootstrap-progressbar -->
@if(session()->has('timpa'))
<script>
    $('#copyData').modal('show');

</script>
@endif
@if(session()->has('timpaAll'))
<script>
    $('#copyDataAll').modal('show');

</script>
@endif


@endpush