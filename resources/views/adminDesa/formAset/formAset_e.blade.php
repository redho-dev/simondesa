@extends('templates.desa.main')

@section('content')
<?php
if($jenis == 'tanah'){
    $a = "Nama Barang (penggunaan)";
    $merek = "Luas (M<sup>2</sup>)";
    $c = "Nomor Alas Hak";
    $ketjenis = "Tanah";
}elseif($jenis =='peralatan'){
    $a = "Nama Barang";
    $merek = "Merk /Type";
    $c = "Kondisi Barang";
    $ketjenis = "Peralatan dan Mesin";
}
elseif($jenis =='gedung'){
    $a = "Nama Barang (penggunaan)";
    $merek = "Luas Bangunan (M<sup>2</sup>)";
    $c = "Type Bangunan";
    $ketjenis = "Gedung dan Bangunan";

}elseif($jenis =='konstruksi'){
    $a = "Nama Barang";
    $merek = "Type/Bahan Konstruksi";
    $c = "ukuran";
    $ketjenis = "Konstruksi dalam Pengerjaan";

}elseif($jenis =='jalan'){
    $a = "Nama atau Jenis Jalan/Irigasi/Jaringan ";
    $merek = "Type";
    $c = "Ukuran";
    $ketjenis = "Jalan, Irigasi dan Jaringan";
}elseif($jenis =='lainnya'){
    $a = "Nama Barang";
    $merek = "Merk/Type";
    $c = "Ukuran";
    $ketjenis = "Aset Tetap Lainnya";
}else{
    $a = "Nama Barang";
    $merek = "Merk/Type";
    $c = "Ukuran";
    $ketjenis = "Aset Tetap Lainnya";
}

?>
<div class="clearfix"></div>
<div class="row justify-content-center mt-2">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Kartu Inventaris Barang (KIB)</h5>
        <div class="x_panel">
            <div class="x_title">
                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formKIB" method="get">
                        @csrf
                        <div class="form-group mx-sm-3 mb-2">
                            <h6>Masukkan tahun data :</h6>
                            <input type="text" name="tahun" class="form-control ml-3" placeholder="{{ $tahun }}"
                                data-inputmask="'mask': '9999'" style="font-size: .85rem">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mb-2">Cek Data</button>
                    </form>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm ml-auto" data-toggle="modal"
                        data-target="#copyDataAll">
                        Copy Seluruh Data KIB
                    </button>

                </div>
                <!-- Modal -->
                <div class="modal fade" id="copyDataAll" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-light" id="staticBackdropLabel">Copy Seluruh Data KIB</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(session()->has('timpaAll'))
                                <div class="alert bg-danger text-white">Sudah ada data Aset tahun {{
                                    session('timpaAll') }}
                                </div>
                                <form action="/adminDesa/copyAsetAll" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tahuncopy">Tetap Copy dan timpa Data Aset Tahun {{
                                            $tahun }} ke
                                            Tahun {{ session('timpaAll') }}
                                            :</label>
                                        <input type="hidden" name="tahuncopy" value="{{ session('timpaAll') }}">
                                        <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                        <input type="hidden" name="tahunasal" value="{{ $tahun }}">
                                        <input type="hidden" name="timpadata" value="oke">
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Copy Data</button>
                            </div>
                            </form>
                            @else
                            <form action="/adminDesa/copyAsetAll" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="tahuncopy">Copy Seluruh Data Aset Tahun {{ $tahun }} ke Tahun
                                        :</label>
                                    <select class="form-control" id="tahuncopy" name="tahuncopy" required>
                                        <option value="">== pilih tahun ==</option>
                                        <option>{{ $tahun+1 }}</option>
                                        <option>{{ $tahun+2 }}</option>
                                        <option>{{ $tahun+3 }}</option>


                                    </select>
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahunasal" value="{{ $tahun }}">
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Copy Data</button>
                        </div>
                        </form>
                        @endif

                    </div>
                </div>
            </div>
            <hr>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                            class="fa fa-wrench"></i></a>

                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="text-dark">Tahun Data : {{ $tahun }}

            </div>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='tanah' ? 'active' : '' }}" href="?jenis=tanah&tahun={{ $tahun }}"
                        role="tab">Tanah
                        <span class="fa fa-check-circle ml-1 {{ $tanah==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='peralatan' ? 'active' : '' }}"
                        href="?jenis=peralatan&tahun={{ $tahun }}" role="tab">Perlatan dan Mesin
                        <span class="fa fa-check-circle ml-1 {{ $peralatan==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='gedung' ? 'active' : '' }}" href="?jenis=gedung&tahun={{ $tahun }}"
                        role="tab">Gedung dan Bangunan
                        <span class="fa fa-check-circle ml-1 {{ $gedung==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='jalan' ? 'active' : '' }}" href="?jenis=jalan&tahun={{ $tahun }}"
                        role="tab">Jalan,
                        Irigasi dan Jaringan
                        <span class="fa fa-check-circle ml-1 {{ $jalan==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='konstruksi' ? 'active' : '' }}"
                        href="?jenis=konstruksi&tahun={{ $tahun }}" role="tab">Konstruksi dalam Pengerjaan
                        <span class="fa fa-check-circle ml-1 {{ $konstruksi==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='lainnya' ? 'active' : '' }}" href="?jenis=lainnya&tahun={{ $tahun }}"
                        role="tab">Aset Tetap Lainnya
                        <span class="fa fa-check-circle ml-1 {{ $lainnya==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane active show " id="aset" role="tabpanel" aria-labelledby="aset-tab">

                    <h4 class="mt-3 text-center text-primary">KARTU INVENTARIS BARANG (KIB) <br> {{
                        strtoupper($ketjenis) }}</h4>
                    <p class="text-center">Kondisi Pencatatan Aset sampai dengan {{ now()->translatedFormat('l,
                        d-F-Y, h:i:s') }}</p>
                    <div class="form-aset">
                        <hr>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#staticBackdrop">
                            + Data Aset
                        </button>
                        <form action="/adminDesa/cetakAset" method="post" class="float-right" target="_blank">
                            @csrf
                            <input type="hidden" name="asal_id" value=" {{ $infos->asal_id }}">
                            <input type="hidden" name="tahun" value=" {{ $tahun }}">
                            <input type="hidden" name="jenis" value=" {{ $jenis }}">

                            <button class="btn btn-info btn-sm">Cetak <i class="fa fa-print"></i></button>

                        </form>


                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info">
                                        <h5 class="modal-title text-dark" id="staticBackdropLabel">Form Tambah
                                            Data
                                            {{ $ketjenis }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <form action="/adminDesa/tambahAset" method="post">
                                            @csrf
                                            <input type="hidden" name="asal_id" value=" {{ $infos->asal_id }}">
                                            <input type="hidden" name="tahun" value=" {{ $tahun }}">
                                            <input type="hidden" name="jenis" value=" {{ $jenis }}">

                                            <div class="form-group {{ $jenis=='jalan' ? '' : 'd-none' }}">
                                                <label for="kategori">Kategori</label>
                                                <select id="kategori" class="form-control" name="kategori"
                                                    style="font-size : .8rem">

                                                    <option value="Jalan">Jalan Desa</option>
                                                    <option value="Irigasi">Irigasi</option>
                                                    <option value="Jembatan/jaringan">Jembatan/jaringan
                                                    </option>


                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="nama_barang">{{ $a }}</label>
                                                <input type="text" class="form-control" id="nama_barang"
                                                    name="nama_barang" style="font-size : .8rem" autofocus required>

                                            </div>

                                            <div
                                                class="form-group {{ $jenis == 'tanah' || $jenis=='jalan' || $jenis == 'gedung' ? '' : 'd-none' }}">
                                                <label for="lokasi">Letak / lokasi</label>
                                                <input type="text" class="form-control" id="lokasi" name="lokasi"
                                                    style="font-size : .8rem">
                                            </div>

                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="kode_barang">Kode Barang</label>
                                                        <input type="text" class="form-control" id="kode_barang"
                                                            name="kode_barang" style="font-size : .8rem">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="nup">NUP</label>
                                                        <input type="number" class="form-control" id="nup" name="nup"
                                                            style="font-size : .8rem">

                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="luas_merk">{!! $merek !!}</label>
                                                        <input type="text" class="form-control" id="luas_merk"
                                                            name="luas_merk" style="font-size : .8rem">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="tahun_perolehan">Tahun Perolehan</label>
                                                        <input type="text" class="form-control" id="tahun_perolehan"
                                                            style="font-size : .8rem" name="tahun_perolehan">
                                                    </div>
                                                </div>

                                                <div class="col   {{ $jenis != 'tanah' ? 'd-none' : '' }}">
                                                    <div class="form-group">
                                                        <label for="alas_hak">Alas Hak</label>
                                                        <select id="alas_hak" class="form-control" name="alas_hak"
                                                            style="font-size : .8rem">

                                                            <option value="sertifikat">sertifikat</option>
                                                            <option value="akta hibah">akta hibah</option>
                                                            <option value="keterangan hibah">keterangan hibah
                                                            </option>
                                                            <option value="lainnya">lainnya</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col {{ $jenis == 'tanah' ? 'd-none' : '' }}">
                                                    <div class="form-group">
                                                        <label for="kondisi_barang">Kondisi</label>
                                                        <select id="kondisi_barang" name="kondisi_barang"
                                                            class="form-control" style="font-size : .8rem">

                                                            <option value="Baik">Baik</option>
                                                            <option value="Rusak Ringan">Rusak Ringan</option>
                                                            <option value="Rusak Berat">Rusak Berat
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col {{ $jenis == 'peralatan' || $jenis=='jalan' ? 'd-none' : '' }}">
                                                    <div class="form-group">
                                                        <label for="nomor_kepemilikan">{{ $c }}</label>
                                                        <input type="text" class="form-control" id="nomor_kepemilikan"
                                                            name="nomor_kepemilikan" style="font-size : .8rem">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-row {{ $jenis == 'jalan' ? '' : 'd-none' }} mt-2">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="panjang">Panjang (Meter)</label>
                                                        <input type="text" class="form-control" id="panjang"
                                                            name="panjang" style="font-size : .8rem">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="lebar">Lebar (Meter)</label>
                                                        <input type="text" class="form-control" id="lebar" name="lebar"
                                                            style="font-size : .8rem">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">

                                                    <div class="form-group">
                                                        <label for="asal_usul">Asal Usul Barang</label>
                                                        <select id="asal_usul" name="asal_usul" class="form-control"
                                                            style="font-size : .8rem">

                                                            <option value="APB Desa">APB Desa</option>
                                                            <option value="Perolehan Lain yang Sah">Perolehan Lain yang
                                                                Sah
                                                            </option>
                                                            <option value="Aset Asli Desa">Aset/Kekayaan Asli Desa
                                                            </option>
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="nilai_perolehan">Nilai Perolehan
                                                            (Rp)</label>
                                                        <input type="text" class="form-control angka"
                                                            id="nilai_perolehan" name="nilai_perolehan"
                                                            style="font-size : .8rem">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label for="keterangan">Keterangan</label>
                                                <input type="text" class="form-control" id="keterangan"
                                                    name="keterangan" style="font-size: .8rem">
                                            </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Kirim Data</button>
                                    </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr style="background-color: rgb(244, 246, 249)">
                                    <th style="vertical-align : middle">No</th>
                                    <th style="vertical-align : middle">{{ $a }}</th>
                                    <th class="{{ $jenis=='tanah' || $jenis=='gedung' ? '' : 'd-none' }}"
                                        style="vertical-align : middle">
                                        Alamat/Lokasi
                                    </th>
                                    <th style="vertical-align : middle">Kode Barang</th>
                                    <th style="vertical-align : middle">NUP</th>
                                    <th style="vertical-align : middle" class="text-center">Tahun <br>Perolehan</th>
                                    <th style="vertical-align : middle">{!! $merek !!}</th>
                                    <th class="{{ $jenis=='tanah' ? '' : 'd-none' }}" style="vertical-align : middle">
                                        Alas Hak</th>
                                    <th class="{{ $jenis=='peralatan' || $jenis=='jalan' ? 'd-none' : '' }} text-center"
                                        style="vertical-align : middle">{{ $c }}</th>
                                    <th class="{{ $jenis=='jalan' ? '' : 'd-none' }}" style="vertical-align : middle">P
                                        (m)</th>
                                    <th class="{{ $jenis=='jalan' ? '' : 'd-none' }}" style="vertical-align : middle">L
                                        (m)</th>
                                    <th class="{{ $jenis=='tanah' ? 'd-none' : '' }}" style="vertical-align : middle">
                                        Kondisi</th>
                                    <th class="text-center">Nilai Perolehan <br>(Rp)</th>
                                    <th style="vertical-align : middle">Keterangan</th>
                                    <th class="text-center" style="vertical-align : middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                    <td class="text-center" style="vertical-align: middle;">{{ $loop->iteration }}</td>
                                    <td style="vertical-align: middle;">{{ $data->nama_barang }}</td>
                                    <td class="{{ $jenis=='tanah' || $jenis=='gedung' ? '' : 'd-none' }} text-center"
                                        style="vertical-align: middle;">
                                        {{ $data->lokasi }}</td>
                                    <td style="vertical-align: middle;">{{ $data->kode_barang }}</td>
                                    <td class="text-center" style="vertical-align: middle;">{{ $data->nup }}</td>
                                    <td class="text-center" style="vertical-align: middle;">{{ $data->tahun_perolehan }}
                                    </td>
                                    <td class="text-center" style="vertical-align: middle;">{{ $data->luas_merk }}</td>
                                    <td class="{{ $jenis=='tanah' ? '' : 'd-none' }} text-center"
                                        style="vertical-align: middle;">{{ $data->alas_hak }}
                                    </td>
                                    <td class="{{ $jenis=='peralatan' || $jenis=='jalan' ? 'd-none' : '' }} text-center"
                                        style="vertical-align: middle;">
                                        {{
                                        $data->nomor_kepemilikan }}</td>
                                    <td class="{{ $jenis=='jalan' ? '' : 'd-none' }} text-center"
                                        style="vertical-align : middle">{{
                                        $data->panjang }}</td>
                                    <td class="{{ $jenis=='jalan' ? '' : 'd-none' }} text-center"
                                        style="vertical-align : middle">{{
                                        $data->lebar }}</td>
                                    <td class="{{ $jenis=='tanah' ? 'd-none' : '' }} text-center"
                                        style="vertical-align: middle;">{{
                                        $data->kondisi_barang
                                        }}</td>
                                    <td style="vertical-align: middle;">
                                        <span class="angka text-right">{{ $data->nilai_perolehan }}</span>
                                    </td>
                                    <td style="vertical-align: middle;">{{ $data->keterangan }}</td>
                                    <td style="font-size: 1rem; vertical-align: middle; "
                                        class="text-center d-flex justify-content-center">
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit_{{ $data->id }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <form action="/adminDesa/hapusAset" method="post" id="formHapus">
                                            @csrf
                                            <input type="hidden" name="idhapus" value="{{ $data->id }}">
                                            <button type="submit" class="btn btn-danger btn-sm hapusAset"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                    <!-- Modal -->
                                    <div class="modal fade" id="edit_{{ $data->id }}" data-backdrop="static"
                                        data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-info">
                                                    <h5 class="modal-title text-dark" id="staticBackdropLabel">
                                                        Form
                                                        Tambah Data
                                                        {{ $ketjenis }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <form action="/adminDesa/editAset" method="post">
                                                        @csrf
                                                        <input type="hidden" name="asal_id"
                                                            value=" {{ $infos->asal_id }}">
                                                        <input type="hidden" name="tahun" value=" {{ $tahun }}">
                                                        <input type="hidden" name="jenis" value=" {{ $jenis }}">
                                                        <input type="hidden" name="id" value="{{ $data->id }}">

                                                        <div class="form-group {{ $jenis=='jalan' ? '' : 'd-none' }}">
                                                            <label for="kategori">Kategori</label>
                                                            <select id="kategori" class="form-control" name="kategori"
                                                                style="font-size : .8rem">

                                                                <option value="Jalan" {{ strpos($data->nama_barang,
                                                                    'Jalan') ? 'selected' :
                                                                    '' }}>Jalan Desa
                                                                </option>
                                                                <option value="Irigasi" {{ strpos($data->nama_barang,
                                                                    'irigasi') ? 'selected' :
                                                                    '' }}>Irigasi</option>
                                                                <option value="Jembatan/jaringan" {{ strpos($data->
                                                                    nama_barang,
                                                                    'jembatan') ? 'selected' :
                                                                    '' }}>Jembatan/jaringan
                                                                </option>


                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nama_barang">{{ $a }}</label>
                                                            <input type="text" class="form-control" id="nama_barang"
                                                                name="nama_barang" style="font-size : .8rem" autofocus
                                                                required value="{{ $data->nama_barang }}">

                                                        </div>

                                                        <div
                                                            class="form-group {{ $jenis == 'tanah' || $jenis=='jalan' || $jenis=='gedung' ? '' : 'd-none' }}">
                                                            <label for="lokasi">Letak / lokasi</label>
                                                            <input type="text" class="form-control" id="lokasi"
                                                                name="lokasi" style="font-size : .8rem"
                                                                value="{{ $data->lokasi }}">
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="kode_barang">Kode Barang</label>
                                                                    <input type="text" class="form-control"
                                                                        id="kode_barang" name="kode_barang"
                                                                        style="font-size : .8rem"
                                                                        value="{{ $data->kode_barang }}">
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="nup">NUP</label>
                                                                    <input type="number" class="form-control" id="nup"
                                                                        name="nup" style="font-size : .8rem"
                                                                        value="{{ $data->nup }}">


                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="luas_merk">{!! $merek
                                                                        !!}</label>
                                                                    <input type="text" class="form-control"
                                                                        id="luas_merk" name="luas_merk"
                                                                        style="font-size : .8rem"
                                                                        value="{{ $data->luas_merk }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="tahun_perolehan">Tahun
                                                                        Perolehan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="tahun_perolehan" style="font-size : .8rem"
                                                                        name="tahun_perolehan"
                                                                        value="{{ $data->tahun_perolehan }}">
                                                                </div>
                                                            </div>

                                                            <div class="col   {{ $jenis != 'tanah' ? 'd-none' : '' }}">
                                                                <div class="form-group">
                                                                    <label for="alas_hak">Alas Hak</label>
                                                                    <select id="alas_hak" class="form-control"
                                                                        name="alas_hak" style="font-size : .8rem">
                                                                        <option value="sertifikat" {{ $data->
                                                                            alas_hak == 'sertifikat' ?
                                                                            'selected' :
                                                                            '' }}>sertifikat
                                                                        </option>
                                                                        <option value="akta hibah" {{ $data->
                                                                            alas_hak == 'akta hibah' ?
                                                                            'selected' :
                                                                            '' }}>akta hibah
                                                                        </option>
                                                                        <option value="keterangan hibah" {{ $data->
                                                                            alas_hak == 'keterangan hibah' ?
                                                                            'selected' :
                                                                            '' }}>keterangan
                                                                            hibah
                                                                        </option>
                                                                        <option value="lainnya" {{ $data->
                                                                            alas_hak == 'lainnya' ? 'selected' :
                                                                            '' }}>lainnya</option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col {{ $jenis == 'tanah' ? 'd-none' : '' }}">
                                                                <div class="form-group">
                                                                    <label for="kondisi_barang">Kondisi</label>
                                                                    <select id="kondisi_barang" name="kondisi_barang"
                                                                        class="form-control" style="font-size : .8rem">
                                                                        <option value="Baik" {{ $data->
                                                                            kondisi_barang == 'Baik' ?
                                                                            'selected' :
                                                                            '' }}>Baik</option>
                                                                        <option value="Rusak Ringan" {{ $data->
                                                                            kondisi_barang == 'Rusak Ringan' ?
                                                                            'selected' :
                                                                            '' }}>Rusak Ringan
                                                                        </option>
                                                                        <option value="Rusak Berat" {{ $data->
                                                                            kondisi_barang == 'Rusak Berat' ?
                                                                            'selected' :
                                                                            '' }}>Rusak Berat
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col {{ $jenis == 'peralatan' ? 'd-none' : 'd-none' }}">
                                                                <div class="form-group">
                                                                    <label for="nomor_kepemilikan">{{ $c
                                                                        }}</label>
                                                                    <input type="text" class="form-control"
                                                                        id="nomor_kepemilikan" name="nomor_kepemilikan"
                                                                        style="font-size : .8rem"
                                                                        value="{{ $data->nomor_kepemilikan }}">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="form-row {{ $jenis == 'jalan' ? '' : 'd-none' }}">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="panjang">Panjang (Meter)</label>
                                                                    <input type="text" class="form-control" id="panjang"
                                                                        name="panjang" style="font-size : .8rem"
                                                                        value="{{ $data->panjang }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="lebar">Lebar (Meter)</label>
                                                                    <input type="text" class="form-control" id="lebar"
                                                                        name="lebar" style="font-size : .8rem"
                                                                        value="{{ $data->lebar }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col">

                                                                <div class="form-group">
                                                                    <label for="asal_usul">Asal Usul Barang</label>
                                                                    <select id="asal_usul" name="asal_usul"
                                                                        class="form-control" style="font-size : .8rem">

                                                                        <option value="APB Desa" {{ $data->asal_usul ==
                                                                            'APB Desa' ? 'selected' : '' }}>APB Desa
                                                                        </option>
                                                                        <option value="Perolehan Lain yang Sah" {{
                                                                            $data->asal_usul ==
                                                                            'Perolehan Lain yang Sah' ? 'selected' : ''
                                                                            }}>
                                                                            Perolehan Lain yang
                                                                            Sah
                                                                        </option>
                                                                        <option value="Aset Asli Desa" {{ $data->
                                                                            asal_usul ==
                                                                            'Aset Asli Desa' ? 'selected' : ''
                                                                            }} >Aset/Kekayaan
                                                                            Asli Desa
                                                                        </option>
                                                                    </select>
                                                                </div>

                                                            </div>

                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="nilai_perolehan">Nilai Perolehan
                                                                        (Rp)</label>
                                                                    <input type="text" class="form-control angka"
                                                                        id="nilai_perolehan" name="nilai_perolehan"
                                                                        style="font-size : .8rem"
                                                                        value="{{ $data->nilai_perolehan }}">
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="form-group">
                                                            <label for="keterangan">Keterangan</label>
                                                            <input type="text" class="form-control" id="keterangan"
                                                                name="keterangan" value="{{ $data->keterangan }}"
                                                                style="font-size: .8rem">
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Kirim
                                                        Data</button>
                                                </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>


                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="keterangan">
                        <small>Keterangan : <br>
                            - NUP : diisi dengan Nomor Urut Pendaftaran Barang sesuai Buku Inventaris <br>
                            - Kode Barang: diisi sesuai dengan kodefikasinya <br>
                            <a href="{{ asset('storage/regulasi/pedoman-umum-kodefikasi-aset-desa-oleh-kemendagri.pdf') }}"
                                class="text-primary" target="_blank">- Klik untuk lihat Pedoman Kodefikasi Barang oleh
                                Kemendagri</a></small>
                    </div>

                </div>
                <br><br><br><br>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<script>
    $('.angka').mask('000.000.000.000.000', {reverse: true});

    $('.hapusAset').on('click', function(e){
        e.preventDefault();
        var tanya = confirm('yakin Hapus?');
        var form = $(this).parents('form');
        if(tanya){
            form.submit();
        }
    })
</script>

@if(session()->has('timpaAll'))
<script>
    $('#copyDataAll').modal('show');

</script>
@endif

@endpush