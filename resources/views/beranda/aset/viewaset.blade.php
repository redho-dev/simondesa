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
<div role="main" class="main">
    <section class="section section-concept section-no-border section-dark section-angled section-angled-reverse pt-5 m-0 overlay overlay-color-grey overlay-show overlay-op-8" style="background-image: url(/storage/image/aset.png); background-size: cover; background-position: center; animation-duration: 750ms; animation-delay: 300ms; animation-fill-mode: forwards; min-height: 645px;">
        <div class="section-angled-layer-bottom section-angled-layer-increase-angle bg-light" style="padding: 8rem 0;"></div>
        <div class="container pt-lg-5 mt-5">
            <div class="row pt-3 pb-lg-0 pb-xl-0">
                <div class="col-lg-6 pt-4 mb-5 mb-lg-0">
                    @foreach($desas as $desa)    
                    <h1 class="font-weight-bold text-10 text-xl-12 line-height-2 mb-3">Penataan Aset Desa <br>{{ $desa->asal }} Tahun {{ $tahun }}</h1>
                    <p class="font-weight-light opacity-7 pb-2 mb-4">Kecamatan {{ $desa->kecamatan }}</p>
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    <section class="section section-no-border pb-0 m-0">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-4">
                    <h2 class="text-7 font-weight-semibold line-height-2 mb-2">Pengelolaan Aset Desa.</h2>
                    <p>Peraturan Menteri Dalam Negeri Nomor 1 Tahun 2016 Tentang Pengelolaan Aset Desa.</p>
                </div>
                <div class="col-sm-4 col-lg-auto icon-box text-center mb-4">
                    <i style="font-size: 50px" class="fa-solid fa-person-chalkboard pb-2"></i>
                    <h4><a class="text-decoration-none text-body font-weight-bold custom-font-size-2 line-height-3 mb-0">Penetapan Status<br>Penggunaan Aset Desa</a></h4>
                </div>
                <div class="col-sm-4 col-lg-auto icon-box text-center mb-4">
                    <i style="font-size: 50px" class="fa-solid fa-file-circle-xmark pb-2"></i>
                    <h4><a class="text-decoration-none text-body font-weight-bold custom-font-size-2 line-height-3 mb-0">Penghapusan<br>Aset Desa</a></h4>
                </div>
                <div class="col-sm-4 col-lg-auto icon-box text-center mb-4">
                    <i style="font-size: 50px" class="fa-solid fa-book-bookmark pb-2"></i>
                    <h4><a class="text-decoration-none text-body font-weight-bold custom-font-size-2 line-height-3 mb-0">Buku Inventaris<br>Aset Desa</a></h4>
                </div>
                <div class="col-sm-12">
                    <hr class="my-5">
                </div>
            </div>
        </div>    
    </section>
    
    <div id="examples" class="container py-2">
        <div class="row">
            <div class="col-lg-6">
                <div class="toggle toggle-primary" data-plugin-toggle>
                    <section class="toggle active">
                        <a class="toggle-title">Penetapan Status Penggunaan Aset Desa</a>
                        <div class="toggle-content">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th>Peraturan Kepala Desa</th>
                                        <th style="text-align: center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($penggunaan as $pg)
                                @if($pg->nama_data == 'daftar_status_penggunaan_aset_desa')
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pg->no_peraturan }}</td>
                                        <td style="text-align: center"><a class="btn btn-sm btn-primary" target="_blank" rel="noopener"  href="{{Storage::url($pg->file)}}">Lihat Dokumen</a></td>
                                    </tr>
                                @endif
                                @empty
                                    <td></td>
                                    <td style="text-align: center">Data tidak tersedia</td>
                                </tbody>
                                @endforelse
                            </table>
                        </div>
                    </section>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="toggle toggle-secondary" data-plugin-toggle>
                    <section class="toggle active">
                        <a class="toggle-title">Penghapusan Aset Desa</a>
                        <div class="toggle-content">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th>Peraturan Kepala Desa</th>
                                        <th style="text-align: center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($penggunaan as $pg)
                                @if($pg->nama_data == 'penghapusan_aset_desa')
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pg->no_peraturan }}</td>
                                        <td style="text-align: center"><a class="btn btn-sm btn-primary" target="_blank" rel="noopener"  href="{{Storage::url($pg->file)}}">Lihat Dokumen</a></td>
                                    </tr>
                                @endif
                                @empty
                                    <td></td>
                                    <td style="text-align: center">Data tidak tersedia</td>
                                </tbody>
                                @endforelse
                            </table>                        
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <hr class="solid my-5">
    <div class="row text-center pt-4">
        <div class="col">
            <h2 class="word-rotator slide font-weight-bold text-8 mb-2">
                <span>Buku Inventaris Aset Desa</span>
            </h2>
        </div>
    </div>

    <div class="container py-4">
        <div class="row">
            <div class="col-md-12">
            <div class="card card-border card-border-top bg-color-light">
            <div class="card-body">
                <div class="card-box table-responsive">
                    <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center">No</th>
                                <th style="text-align: center">Jenis Barang</th>
                                <th style="text-align: center; width: 10%">Kode Barang</th>
                                <th style="text-align: center">Identitas Barang</th>
                                <th style="text-align: center" colspan="3">Asal Usul Barang</th>
                                <th style="text-align: center; width: 10%">Tanggal Perolehan / Pembelian</th>
                                <th style="text-align: center">Keterangan</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th style="text-align: center; width: 5%">APBDesa</th>
                                <th style="text-align: center; width: 5%">Perolehan Lain Yang Sah</th>
                                <th style="text-align: center; width: 5%">Aset / Kekayaan Asli Desa</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kibas as $Akunasetkiba)
                            <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$Akunasetkiba->jenis}}</td>
                            <td>{{$Akunasetkiba->kd_barang}}</td>
                            <td>{{$Akunasetkiba->identitas}}</td>
                            <td style="text-align: center">
                                @if($Akunasetkiba->asal == 'APBDesa')
                                <i class="fa-solid fa-check"></i>
                                @endif
                            </td>
                            <td style="text-align: center">
                                @if($Akunasetkiba->asal == 'Perolehan Lain Yang Sah')
                                <i class="fa-solid fa-check"></i>
                                @endif
                            </td>
                            <td style="text-align: center">
                                @if($Akunasetkiba->asal == 'Aset / Kekayaan Asli Desa')
                                <i class="fa-solid fa-check"></i>
                                @endif
                            </td>
                            <td style="text-align: center">{{$Akunasetkiba->tahun_perolehan}}</td>
                            <td>{{$Akunasetkiba->ket}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div id="examples" class="container py-2">
        <div class="row">
            <div class="col-lg-6">
                <div class="toggle toggle-quaternary" data-plugin-toggle>
                    <section class="toggle active">
                        <a class="toggle-title">Kartu Inventaris Ruangan</a>
                        <div class="toggle-content">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th>Ruangan</th>
                                        <th style="text-align: center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($kirs as $kr)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kr->ruangan }}</td>
                                        <td style="text-align: center"><a class="btn btn-sm btn-primary" target="_blank" rel="noopener"  href="{{Storage::url($kr->file)}}">Lihat Dokumen</a></td>
                                    </tr>
                                @empty
                                    <td></td>
                                    <td style="text-align: center">Data tidak tersedia</td>
                                </tbody>
                                @endforelse
                            </table>
                        </div>
                    </section>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="toggle toggle-tertiary" data-plugin-toggle>
                    <section class="toggle active">
                        <a class="toggle-title">Surat Kuasa Pemegang Barang (Holder)</a>
                        <div class="toggle-content">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th>Nama Barang</th>
                                        <th>Nama Pemegang Barang</th>
                                        <th style="text-align: center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($holders as $hld)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $hld->nama_barang }}</td>
                                        <td>{{ $hld->nama }}</td>
                                        <td style="text-align: center"><a class="btn btn-sm btn-primary" target="_blank" rel="noopener"  href="{{Storage::url($hld->file)}}">Lihat Dokumen</a></td>
                                    </tr>
                                @empty
                                    <td></td>
                                    <td style="text-align: center">Data tidak tersedia</td>
                                </tbody>
                                @endforelse
                            </table>                        
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

</div>

    


@endsection