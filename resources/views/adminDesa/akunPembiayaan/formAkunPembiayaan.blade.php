@extends('templates.desa.main')

@section('content')
<div class="clearfix"></div>
<div class="row justify-content-center mt-2 mb-4">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Data Penatausahaan Pembiayaan</h5>
        <div class="x_panel">

            <div class="x_title">

                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formPenataanPembiayaan" method="get">
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
                        <a class="nav-link {{ $jenis=='penerimaan' ? 'active' : '' }}"
                            href="?jenis=penerimaan&tahun={{ $tahun }}" role="tab">Penerimaan Pembiayaan
                            <span class="fa fa-check-circle ml-1 {{ count($penerimaan) ? '' : 'd-none' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='pengeluaran' ? 'active' : '' }}"
                            href="?jenis=pengeluaran&tahun={{ $tahun }}" role="tab">Pengeluaran
                            Pembiayaan
                            <span class="fa fa-check-circle ml-1 {{ count($pengeluaran) ? '' : 'd-none' }}"></span>
                        </a>
                    </li>

                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h4 class="text-center">Pilih Tab Untuk Lihat/Input/Update Data</h4>
                    </div>

                </div>
                <br><br><br>
            </div>
        </div>
    </div>
    <br>
    <br>
    {{-- notifikasi --}}
    @if(session()->has('fail'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: '{{ session("fail") }}',
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