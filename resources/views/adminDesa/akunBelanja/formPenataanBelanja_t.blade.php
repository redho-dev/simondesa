@extends('templates.desa.main')

@section('content')
<div class="clearfix"></div>
<div class="row justify-content-center mt-2 mb-4">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Data Penatausahaan Belanja</h5>
        <div class="x_panel">
            <div class="x_title">
                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formPenataanBelanja" method="get">
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
                <div>Tahun Data : {{ $tahun }}</div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='spp' ? 'active' : ''}}" href="?jenis=spp&tahun={{ $tahun }}"
                            role="tab">+ SPP Kegiatan
                            <span class="fa fa-check-circle ml-1 {{ $spp ? '' : 'd-none' }}"></span>
                        </a>
                    </li>
                    <li class=" nav-item">
                        <a class="nav-link  {{ $jenis=='spp_kegiatan' ? 'active' : ''}}"
                            href="?jenis=spp_kegiatan&tahun={{ $tahun }}" role="tab">Edit Data SPP
                            per
                            Kegiatan

                        </a>
                    </li>
                    <li class=" nav-item">
                        <a class="nav-link  {{ $jenis=='tbpu' ? 'active' : ''}} " href="?jenis=tbpu&tahun={{ $tahun }}"
                            role="tab">+ Tanda Bukti
                            Pengeluaran Uang (TBPU)
                            <span class="fa fa-check-circle ml-1 {{ $bkp ? '' : 'd-none' }}"></span>
                        </a>
                    </li>

                    <li class=" nav-item">
                        <a class="nav-link  {{ $jenis=='cek_tbpu' ? 'active' : ''}}"
                            href="?jenis=cek_tbpu&tahun={{ $tahun }}" role="tab">Edit Data TBPU
                            per
                            Kegiatan
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ $jenis=='bku' ? 'active' : '' }}" href="?jenis=bku&tahun={{ $tahun }}"
                            role="tab">+ Pembukuan
                            <span class="fa fa-check-circle ml-1 {{ $bku ? '' : 'd-none' }}"></span>
                        </a>
                    </li>

                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        @if($jenis == 'spp')
                        @include('adminDesa.akunBelanja.sppTambah')
                        @elseif($jenis=='tbpu')
                        @include('adminDesa.akunBelanja.bkpTambah')
                        @elseif($jenis=='spp_kegiatan')
                        @include('adminDesa.akunBelanja.sppKegiatan')
                        @elseif($jenis=='cek_tbpu')
                        @include('adminDesa.akunBelanja.tbpuKegiatan')
                        @elseif($jenis=='bukti_belanja')
                        @include('adminDesa.akunBelanja.buktiBelanja')
                        @elseif($jenis=='bku')
                        @include('adminDesa.akunBelanja.bkuPanjar')
                        @endif
                    </div>

                </div>
                <br><br><br>
            </div>
        </div>
    </div>
    <br>
    <br>
    @if(session()->has('dok'))
    <script>
        Swal.fire({
        position: 'center',
        icon: 'error',
        title: '{{ session("dok") }}',
        showConfirmButton: true
       
        })
    </script>

    @endif

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

    @endsection
    @push('script')
    <script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script>
        bsCustomFileInput.init();
       
    </script>


    @endpush