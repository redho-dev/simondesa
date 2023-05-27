@extends('templates.desa.main')

@section('content')
<div class="clearfix"></div>
<div class="row justify-content-center mt-2 mb-4">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Data Penatausahaan Pendapatan</h5>
        <div class="x_panel">

            <div class="x_title">

                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formPenataanPendapatan" method="get">
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
                        <a class="nav-link {{ $jenis=='pengajuan' ? 'active' : '' }}"
                            href="?jenis=pengajuan&tahun={{ $tahun }}" role="tab">+ Dokumen Pengajuan & Penerimaan
                            <span class="fa fa-check-circle ml-1 {{ $pengajuan > 0 ? '' : 'd-none' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{ $jenis=='cek_pengajuan' ? 'active' : '' }}"
                            href="?jenis=cek_pengajuan&tahun={{ $tahun }}" role="tab">Cek Dokumen
                            Pengajuan & Penerimaan

                        </a>
                    </li>
                    <li class=" nav-item ">
                        <a class="nav-link {{ $jenis=='buku_pembantu_bank' ? 'active' : '' }}"
                            href="?jenis=buku_pembantu_bank&tahun={{ $tahun }}" role="tab">+ Buku
                            Pembantu Bank
                            <span class="fa fa-check-circle ml-1 {{ $bukuBank > 0 ? '' : 'd-none' }}"></span>
                        </a>
                    </li>

                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        @if($jenis=='pengajuan')
                        @include('adminDesa.akunPendapatan.pengajuan_tambah')
                        @elseif($jenis=='buku_pembantu_bank')
                        @include('adminDesa.akunPendapatan.bukuBank_tambah')
                        @endif
                    </div>

                </div>
                <br><br><br>
            </div>
        </div>
    </div>
    <br>
    <br>
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