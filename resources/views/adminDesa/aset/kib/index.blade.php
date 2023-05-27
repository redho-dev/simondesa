@extends('templates.desa.main')

@section('content')
<div class="row justify-content-center mt-2 mb-4">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Data Inventarisasi Aset</h5>
        <div class="x_panel">
            <div class="x_title">
                <div class="d-flex">
                    <form class="form-inline" action="/Akunasetkiba" method="get">
                        @csrf
                        <div class="form-group mx-sm-3 mb-2">
                            <h6>Masukkan tahun data :</h6>
                            <input type="text" name="tahun" class="form-control ml-3" placeholder="{{ $tahun }}"
                                data-inputmask="'mask': '9999'" style="font-size: .85rem">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mb-2">Cek Data</button>
                    </form>
                    <button type="button" class="btn btn-info ml-auto btn-sm" data-toggle="modal"
                        data-target="#copyAkunaset">
                        Copy Data Seluruh LHI
                    </button>
                </div>
                <hr>
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error !</strong> Harap periksa inputan dan file berupa pdf dengan maksimal yang ditentukan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
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
                <div>Tahun Data : {{ $tahun }} &emsp; &emsp; <span class="text-info">(Form Input Data Akuntabilitas
                        Kartu Inventaris Barang)</span></div>
                <div class="clearfix"></div>

                <br>
                <div class="x_content">
                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#kiba" role="tab"
                                aria-controls="kiba" aria-selected="true">TANAH</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#kibb" role="tab"
                                aria-controls="kibb" aria-selected="false">KENDARAAN BERMOTOR</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#kibc" role="tab"
                                aria-controls="kibc" aria-selected="false">PERALATAN & MESIN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#kibd" role="tab"
                                aria-controls="kibd" aria-selected="false">BANGUNAN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#kibe" role="tab"
                                aria-controls="kibe" aria-selected="false">JALAN IRIGASI & JARINGAN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#kibf" role="tab"
                                aria-controls="kibf" aria-selected="false">ASET TETAP LAINNYA</a>
                        </li>
                    </ul>

                    <div class="modal fade" id="modalMd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="modalMdTitle"></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="modalError"></div>
                                    <div id="modalMdContent"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" id="myTabContent">
                        <!-- view data kib a-->
                        <div class="tab-pane fade show active" id="kiba" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-tools">
                                            <button class="btn btn-primary btn-sm btn-flat" data-toggle="modal"
                                                data-target="#modal-add">Tambah Inventaris Tanah</button>
                                            @foreach($kibtanah as $tanah)
                                            <a class="btn btn-sm btn-info" target="_blank" rel="noopener"
                                                href="storage/{{ $tanah->file_data }}">Dokumen LHI</a>
                                            @endforeach
                                            <button type="button" class="btn btn-warning btn-sm mb-2"
                                                data-toggle="modal" data-target="#upload-lhi">Upload LHI</button>
                                            <a class="btn btn-sm btn-secondary float-right" target="_blank"
                                                href="Akunasetkiba/cetak/{{ $infos->asal_id }}/{{ $tahun }}/tanah">Cetak
                                                <i class="fa-sharp fa-solid fa-print"></i></a>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table
                                                class="table table-striped table-bordered table-hover dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Jenis Tanah</th>
                                                        <th>Kode Barang</th>
                                                        <th>NUP</th>
                                                        <th>Luas (m<sup>2</sup>)</th>
                                                        <th>Tanggal Perolehan</th>
                                                        <th>Alas Hak / Bukti Kepemilikan</th>
                                                        <th>Nilai Perolehan <br>(Rp)</th>
                                                        <th>Asal Usul Barang</th>
                                                        <th>Keterangan</th>
                                                        <th style="">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($Akunasetkibas as $Akunasetkiba)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{$Akunasetkiba->jenis}}</td>
                                                        <td>{{$Akunasetkiba->kd_barang}}</td>
                                                        <td>{{$Akunasetkiba->nup}}</td>
                                                        <td>{{$Akunasetkiba->identitas}}</td>
                                                        <td>{{$Akunasetkiba->tahun_perolehan}}</td>
                                                        <td>{{$Akunasetkiba->type_identitas}}</td>
                                                        <td>{{$Akunasetkiba->nilai_perolehan}}</td>
                                                        <td>{{$Akunasetkiba->asal}}</td>
                                                        <td>{{$Akunasetkiba->ket}}</td>
                                                        <td style="width: 10%">
                                                            <button type="button"
                                                                class="btn btn-xs btn-success edit float-left"
                                                                data-toggle="modal"
                                                                data-target="#modal-edit{{ $Akunasetkiba->id }}"><i
                                                                    class="fa fa-pencil"></i></button>
                                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                                action="{{ route('Akunasetkiba.destroy', $Akunasetkiba->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-xs btn-danger hapus"><i
                                                                        class="fa fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- view data kib b-->
                        <div class="tab-pane fade" id="kibb" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-tools">
                                            <button class="btn btn-primary btn-sm btn-flat" data-toggle="modal"
                                                data-target="#modal-addb">Tambah Inventaris Kendaraan Bermotor</button>
                                            @foreach($kibkendaraan as $kendaraan)
                                            <a class="btn btn-sm btn-info" target="_blank" rel="noopener"
                                                href="storage/{{ $kendaraan->file_data }}">Dokumen LHI</a>
                                            @endforeach
                                            <button type="button" class="btn btn-warning btn-sm mb-2"
                                                data-toggle="modal" data-target="#upload-lhib">Upload LHI</button>
                                            <a class="btn btn-sm btn-secondary float-right" target="_blank"
                                                href="Akunasetkiba/cetak/{{ $infos->id }}/{{ $tahun }}/kendaraan">Cetak
                                                <i class="fa-sharp fa-solid fa-print"></i></a>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table
                                                class="table table-striped table-bordered table-hover dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Barang</th>
                                                        <th>Kode Barang</th>
                                                        <th>NUP</th>
                                                        <th>Merk / Type</th>
                                                        <th>Tahun Perolehan</th>
                                                        <th>Nomor Identitas</th>
                                                        <th>Nilai Perolehan</th>
                                                        <th>Asal Usul Barang</th>
                                                        <th>Kondisi Barang</th>
                                                        <th>Keterangan</th>
                                                        <th style="">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($Akunasetkibbs as $Akunasetkibb)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{$Akunasetkibb->jenis}}</td>
                                                        <td>{{$Akunasetkibb->kd_barang}}</td>
                                                        <td>{{$Akunasetkibb->nup}}</td>
                                                        <td>{{$Akunasetkibb->identitas}}</td>
                                                        <td>{{$Akunasetkibb->tahun_perolehan}}</td>
                                                        <td>{{$Akunasetkibb->type_identitas}}</td>
                                                        <td>@rupiah($Akunasetkibb->nilai_perolehan)</td>
                                                        <td>{{$Akunasetkibb->asal}}</td>
                                                        <td>{{$Akunasetkibb->kondisi_barang}}</td>
                                                        <td>{{$Akunasetkibb->ket}}</td>
                                                        <td style="width: 10%">
                                                            <button type="button"
                                                                class="btn btn-xs btn-success edit float-left"
                                                                data-toggle="modal"
                                                                data-target="#modal-editb{{ $Akunasetkibb->id }}"><i
                                                                    class="fa fa-pencil"></i></button>
                                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                                action="{{ route('Akunasetkiba.destroy', $Akunasetkibb->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-xs btn-danger hapus"><i
                                                                        class="fa fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- view data kib c-->
                        <div class="tab-pane fade" id="kibc" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-tools">
                                            <button class="btn btn-primary btn-sm btn-flat" data-toggle="modal"
                                                data-target="#modal-addc">Tambah Inventaris Peralatan dan Mesin</button>
                                            @foreach($kibmesin as $mesin)
                                            <a class="btn btn-sm btn-info" target="_blank" rel="noopener"
                                                href="storage/{{ $mesin->file_data }}">Dokumen LHI</a>
                                            @endforeach
                                            <button type="button" class="btn btn-warning btn-sm mb-2"
                                                data-toggle="modal" data-target="#upload-lhic">Upload LHI</button>
                                            <a class="btn btn-sm btn-secondary float-right" target="_blank"
                                                href="Akunasetkiba/cetak/{{ $infos->id }}/{{ $tahun }}/mesin">Cetak <i
                                                    class="fa-sharp fa-solid fa-print"></i></a>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table
                                                class="table table-striped table-bordered table-hover dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Barang</th>
                                                        <th>Kode Barang</th>
                                                        <th>NUP</th>
                                                        <th>Merk / Type</th>
                                                        <th>Tahun Perolehan</th>
                                                        <th>Nomor Identitas</th>
                                                        <th>Nilai Perolehan</th>
                                                        <th>Asal Usul Barang</th>
                                                        <th>Kondisi Barang</th>
                                                        <th>Keterangan</th>
                                                        <th style="">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($Akunasetkibcs as $Akunasetkibc)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{$Akunasetkibc->jenis}}</td>
                                                        <td>{{$Akunasetkibc->kd_barang}}</td>
                                                        <td>{{$Akunasetkibc->nup}}</td>
                                                        <td>{{$Akunasetkibc->identitas}}</td>
                                                        <td>{{$Akunasetkibc->tahun_perolehan}}</td>
                                                        <td>{{$Akunasetkibc->type_identitas}}</td>
                                                        <td>@rupiah($Akunasetkibc->nilai_perolehan)</td>
                                                        <td>{{$Akunasetkibc->asal}}</td>
                                                        <td>{{$Akunasetkibc->kondisi_barang}}</td>
                                                        <td>{{$Akunasetkibc->ket}}</td>
                                                        <td style="width: 10%">
                                                            <button type="button"
                                                                class="btn btn-xs btn-success edit float-left"
                                                                data-toggle="modal"
                                                                data-target="#modal-editc{{ $Akunasetkibc->id }}"><i
                                                                    class="fa fa-pencil"></i></button>
                                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                                action="{{ route('Akunasetkiba.destroy', $Akunasetkibc->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-xs btn-danger hapus"><i
                                                                        class="fa fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- view data kib d-->
                        <div class="tab-pane fade" id="kibd" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-tools">
                                            <button class="btn btn-primary btn-sm btn-flat" data-toggle="modal"
                                                data-target="#modal-addd">Tambah Inventaris Bangunan</button>
                                            @foreach($kibbangunan as $bangunan)
                                            <a class="btn btn-sm btn-info" target="_blank" rel="noopener"
                                                href="storage/{{ $bangunan->file_data }}">Dokumen LHI</a>
                                            @endforeach
                                            <button type="button" class="btn btn-warning btn-sm mb-2"
                                                data-toggle="modal" data-target="#upload-lhid">Upload LHI</button>
                                            <a class="btn btn-sm btn-secondary float-right" target="_blank"
                                                href="Akunasetkiba/cetak/{{ $infos->id }}/{{ $tahun }}/bangunan">Cetak
                                                <i class="fa-sharp fa-solid fa-print"></i></a>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table
                                                class="table table-striped table-bordered table-hover dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Jenis Bangunan</th>
                                                        <th>Kode Barang</th>
                                                        <th>NUP</th>
                                                        <th>Luas (M2)</th>
                                                        <th>Tahun Perolehan</th>
                                                        <th>Type Bangunan</th>
                                                        <th>Nilai Perolehan</th>
                                                        <th>Asal Usul Barang</th>
                                                        <th>Keterangan</th>
                                                        <th style="">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($Akunasetkibds as $Akunasetkibd)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{$Akunasetkibd->jenis}}</td>
                                                        <td>{{$Akunasetkibd->kd_barang}}</td>
                                                        <td>{{$Akunasetkibd->nup}}</td>
                                                        <td>{{$Akunasetkibd->identitas}}</td>
                                                        <td>{{$Akunasetkibd->tahun_perolehan}}</td>
                                                        <td>{{$Akunasetkibd->type_identitas}}</td>
                                                        <td>@rupiah($Akunasetkibd->nilai_perolehan)</td>
                                                        <td>{{$Akunasetkibd->asal}}</td>
                                                        <td>{{$Akunasetkibd->ket}}</td>
                                                        <td style="width: 10%">
                                                            <button type="button"
                                                                class="btn btn-xs btn-success edit float-left"
                                                                data-toggle="modal"
                                                                data-target="#modal-editd{{ $Akunasetkibd->id }}"><i
                                                                    class="fa fa-pencil"></i></button>
                                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                                action="{{ route('Akunasetkiba.destroy', $Akunasetkibd->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-xs btn-danger hapus"><i
                                                                        class="fa fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- view data kib e-->
                        <div class="tab-pane fade" id="kibe" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-tools">
                                            <button class="btn btn-primary btn-sm btn-flat" data-toggle="modal"
                                                data-target="#modal-adde">Tambah Inventaris Jalan Irigasi &
                                                Jaringan</button>
                                            @foreach($kibjalan as $jalan)
                                            <a class="btn btn-sm btn-info" target="_blank" rel="noopener"
                                                href="storage/{{ $jalan->file_data }}">Dokumen LHI</a>
                                            @endforeach
                                            <button type="button" class="btn btn-warning btn-sm mb-2"
                                                data-toggle="modal" data-target="#upload-lhie">Upload LHI</button>
                                            <a class="btn btn-sm btn-secondary float-right" target="_blank"
                                                href="Akunasetkiba/cetak/{{ $infos->id }}/{{ $tahun }}/jalan">Cetak <i
                                                    class="fa-sharp fa-solid fa-print"></i></a>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table
                                                class="table table-striped table-bordered table-hover dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Jenis Jalan Irigasi & Jaringan</th>
                                                        <th>Kode Barang</th>
                                                        <th>NUP</th>
                                                        <th>Ukuran</th>
                                                        <th>Tahun Perolehan</th>
                                                        <th>Type</th>
                                                        <th>Nilai Perolehan</th>
                                                        <th>Asal Usul Barang</th>
                                                        <th>Keterangan</th>
                                                        <th style="">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($Akunasetkibes as $Akunasetkibe)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{$Akunasetkibe->jenis}}</td>
                                                        <td>{{$Akunasetkibe->kd_barang}}</td>
                                                        <td>{{$Akunasetkibe->nup}}</td>
                                                        <td>{{$Akunasetkibe->identitas}}</td>
                                                        <td>{{$Akunasetkibe->tahun_perolehan}}</td>
                                                        <td>{{$Akunasetkibe->type_identitas}}</td>
                                                        <td>@rupiah($Akunasetkibe->nilai_perolehan)</td>
                                                        <td>{{$Akunasetkibe->asal}}</td>
                                                        <td>{{$Akunasetkibe->ket}}</td>
                                                        <td style="width: 10%">
                                                            <button type="button"
                                                                class="btn btn-xs btn-success edit float-left"
                                                                data-toggle="modal"
                                                                data-target="#modal-edite{{ $Akunasetkibe->id }}"><i
                                                                    class="fa fa-pencil"></i></button>
                                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                                action="{{ route('Akunasetkiba.destroy', $Akunasetkibe->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-xs btn-danger hapus"><i
                                                                        class="fa fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- view data kib f-->
                        <div class="tab-pane fade" id="kibf" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-tools">
                                            <button class="btn btn-primary btn-sm btn-flat" data-toggle="modal"
                                                data-target="#modal-addf">Tambah Inventaris Aset Tetap Lainnya</button>
                                            @foreach($kiblainnya as $lain)
                                            <a class="btn btn-sm btn-info" target="_blank" rel="noopener"
                                                href="storage/{{ $lain->file_data }}">Dokumen LHI</a>
                                            @endforeach
                                            <button type="button" class="btn btn-warning btn-sm mb-2"
                                                data-toggle="modal" data-target="#upload-lhif">Upload LHI</button>
                                            <a class="btn btn-sm btn-secondary float-right" target="_blank"
                                                href="Akunasetkiba/cetak/{{ $infos->id }}/{{ $tahun }}/lainnya">Cetak <i
                                                    class="fa-sharp fa-solid fa-print"></i></a>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table
                                                class="table table-striped table-bordered table-hover dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Barang</th>
                                                        <th>Kode Barang</th>
                                                        <th>NUP</th>
                                                        <th>Tahun Perolehan</th>
                                                        <th>Type</th>
                                                        <th>Nilai Perolehan</th>
                                                        <th>Asal Usul</th>
                                                        <th>Keterangan</th>
                                                        <th style="">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($Akunasetkibfs as $Akunasetkibf)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{$Akunasetkibf->jenis}}</td>
                                                        <td>{{$Akunasetkibf->kd_barang}}</td>
                                                        <td>{{$Akunasetkibf->nup}}</td>
                                                        <td>{{$Akunasetkibf->tahun_perolehan}}</td>
                                                        <td>{{$Akunasetkibf->identitas}}</td>
                                                        <td>@rupiah($Akunasetkibf->nilai_perolehan)</td>
                                                        <td>{{$Akunasetkibf->asal}}</td>
                                                        <td>{{$Akunasetkibf->ket}}</td>
                                                        <td style="width: 10%">
                                                            <button type="button"
                                                                class="btn btn-xs btn-success edit float-left"
                                                                data-toggle="modal"
                                                                data-target="#modal-editf{{ $Akunasetkibf->id }}"><i
                                                                    class="fa fa-pencil"></i></button>
                                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                                action="{{ route('Akunasetkiba.destroy', $Akunasetkibf->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-xs btn-danger hapus"><i
                                                                        class="fa fa-trash"></i></button>
                                                            </form>
                                                        </td>
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


                    <!-- modal add data kib a-->
                    <div class="modal inmodal fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true"
                        wire:ignore.self>
                        <div class="modal-dialog modal-md">
                            <form name="frm_add" id="frm_add" class="form-horizontal"
                                action="{{ route('Akunasetkiba.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span
                                                class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Tambah Data</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                            <label class="font-weight-bold">Jenis Tanah</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('jenis_tanah') is-invalid @enderror"
                                                    id="jenis_tanah" name="jenis_tanah" value="{{ old('jenis_tanah') }}"
                                                    placeholder="Masukkan Jenis Tanah" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Kode Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('kd_barang') is-invalid @enderror"
                                                    name="kd_barang" value="{{ old('kd_barang') }}"
                                                    placeholder="Masukkan Kode Barang">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">NUP</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('nup') is-invalid @enderror" name="nup"
                                                    value="{{ old('nup') }}" placeholder="Masukkan NUP">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Luas</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('luas') is-invalid @enderror" name="luas"
                                                    value="{{ old('luas') }}" placeholder="Masukkan Luas" required>
                                                <span class="form-control-feedback right">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Tanggal Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input data-inputmask="'mask': '99/99/9999'" type="text"
                                                    class="form-control @error('tahun_perolehan') is-invalid @enderror"
                                                    data-inputmask="'mask': '9999'" name="tahun_perolehan"
                                                    value="{{ old('tahun_perolehan') }}"
                                                    placeholder="Masukkan Tahun Perolehan" required>
                                                <span class="fa fa-calendar form-control-feedback right"
                                                    aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Alas Hak/Bukti Kepemilikan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('bukti_kepemilikan') is-invalid @enderror"
                                                    name="bukti_kepemilikan" value="{{ old('bukti_kepemilikan') }}"
                                                    placeholder="Masukkan Alas Hak/Bukti Kepemilikan" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nilai Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input style="text-align: right" type="text"
                                                    class="angka form-control @error('nilai_perolehan') is-invalid @enderror"
                                                    name="nilai_perolehan" value="{{ old('nilai_perolehan') }}"
                                                    required>
                                                <span class="form-control-feedback left" aria-hidden="true">Rp </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Asal Usul Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <select class="form-control" style="font-size: .85rem" name="asal"
                                                    required>
                                                    <option value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Keterangan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <textarea type="text"
                                                    class="form-control @error('ket') is-invalid @enderror" name="ket"
                                                    value="{{ old('ket') }}"
                                                    placeholder="Masukkan Keterangan"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary" id="tambah">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- modal add data kib b-->
                    <div class="modal inmodal fade" id="modal-addb" tabindex="-1" role="dialog" aria-hidden="true"
                        wire:ignore.self>
                        <div class="modal-dialog modal-md">
                            <form name="frm_add" id="frm_add" class="form-horizontal" action="/Akunasetkiba/addkibb"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span
                                                class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Tambah Data</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                            <label class="font-weight-bold">Nama Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('nama_barang') is-invalid @enderror"
                                                    id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}"
                                                    placeholder="Masukkan Nama Barang" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Kode Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('kd_barang') is-invalid @enderror"
                                                    name="kd_barang" value="{{ old('kd_barang') }}"
                                                    placeholder="Masukkan Kode Barang">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">NUP</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('nup') is-invalid @enderror" name="nup"
                                                    value="{{ old('nup') }}" placeholder="Masukkan NUP">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Type</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('type') is-invalid @enderror" name="type"
                                                    value="{{ old('type') }}" placeholder="Masukkan Merk / Type"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Tanggal Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input data-inputmask="'mask': '99/99/9999'" type="text"
                                                    class="form-control @error('tahun_perolehan') is-invalid @enderror"
                                                    data-inputmask="'mask': '9999'" name="tahun_perolehan"
                                                    value="{{ old('tahun_perolehan') }}"
                                                    placeholder="Masukkan Tahun Perolehan" required>
                                                <span class="fa fa-calendar form-control-feedback right"
                                                    aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nomor Identitas</label>
                                            <input type="text"
                                                class="form-control @error('nomor_identitas') is-invalid @enderror"
                                                name="nomor_identitas" value="{{ old('nomor_identitas') }}"
                                                placeholder="Masukkan Nomor Identitas" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nilai Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input style="text-align: right" type="text"
                                                    class="angka form-control @error('nilai_perolehan') is-invalid @enderror"
                                                    name="nilai_perolehan" value="{{ old('nilai_perolehan') }}"
                                                    required>
                                                <span class="form-control-feedback left" aria-hidden="true">Rp </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Asal Usul Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <select class="form-control" style="font-size: .85rem" name="asal"
                                                    required>
                                                    <option value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Kondisi</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <select class="form-control @error('kondisi') is-invalid @enderror"
                                                    id="kondisi" name="kondisi" required>
                                                    <option value="" selected>== Kondisi Barang ==</option>
                                                    <option value="Baik"> BAIK </option>
                                                    <option value="Rusak Ringan"> RUSAK RINGAN </option>
                                                    <option value="Rusak Berat"> RUSAK BERAT </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Keterangan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <textarea type="text"
                                                    class="form-control @error('ket') is-invalid @enderror" name="ket"
                                                    value="{{ old('ket') }}"
                                                    placeholder="Masukkan Keterangan"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary" id="tambah">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- modal add data kib c-->
                    <div class="modal inmodal fade" id="modal-addc" tabindex="-1" role="dialog" aria-hidden="true"
                        wire:ignore.self>
                        <div class="modal-dialog modal-md">
                            <form name="frm_add" id="frm_add" class="form-horizontal" action="/Akunasetkiba/addkibc"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span
                                                class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Tambah Data</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                            <label class="font-weight-bold">Nama Barang</label>
                                            <input type="text"
                                                class="form-control @error('nama_barang') is-invalid @enderror"
                                                id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}"
                                                placeholder="Masukkan Nama Barang" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Kode Barang</label>
                                            <input type="text"
                                                class="form-control @error('kd_barang') is-invalid @enderror"
                                                name="kd_barang" value="{{ old('kd_barang') }}"
                                                placeholder="Masukkan Kode Barang">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">NUP</label>
                                            <input type="text" class="form-control @error('nup') is-invalid @enderror"
                                                name="nup" value="{{ old('nup') }}" placeholder="Masukkan NUP">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Type</label>
                                            <input type="text" class="form-control @error('type') is-invalid @enderror"
                                                name="type" value="{{ old('type') }}" placeholder="Masukkan Merk / Type"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Tanggal Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input data-inputmask="'mask': '99/99/9999'" type="text"
                                                    class="form-control @error('tahun_perolehan') is-invalid @enderror"
                                                    data-inputmask="'mask': '9999'" name="tahun_perolehan"
                                                    value="{{ old('tahun_perolehan') }}"
                                                    placeholder="Masukkan Tahun Perolehan" required>
                                                <span class="fa fa-calendar form-control-feedback right"
                                                    aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nomor Identitas</label>
                                            <input type="text"
                                                class="form-control @error('nomor_identitas') is-invalid @enderror"
                                                name="nomor_identitas" value="{{ old('nomor_identitas') }}"
                                                placeholder="Masukkan Nomor Identitas" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nilai Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input style="text-align: right" type="text"
                                                    class="angka form-control @error('nilai_perolehan') is-invalid @enderror"
                                                    name="nilai_perolehan" value="{{ old('nilai_perolehan') }}"
                                                    required>
                                                <span class="form-control-feedback left" aria-hidden="true">Rp </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Asal Usul Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <select class="form-control" style="font-size: .85rem" name="asal"
                                                    required>
                                                    <option value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Kondisi</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <select class="form-control @error('kondisi') is-invalid @enderror"
                                                    id="kondisi" name="kondisi" required>
                                                    <option value="" selected>== Kondisi Barang ==</option>
                                                    <option value="Baik"> BAIK </option>
                                                    <option value="Rusak Ringan"> RUSAK RINGAN </option>
                                                    <option value="Rusak Berat"> RUSAK BERAT </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Keterangan</label>
                                            <textarea type="text"
                                                class="form-control @error('ket') is-invalid @enderror" name="ket"
                                                value="{{ old('ket') }}" placeholder="Masukkan Keterangan"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary" id="tambah">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- modal add data kib d-->
                    <div class="modal inmodal fade" id="modal-addd" tabindex="-1" role="dialog" aria-hidden="true"
                        wire:ignore.self>
                        <div class="modal-dialog modal-md">
                            <form name="frm_add" id="frm_add" class="form-horizontal" action="/Akunasetkiba/addkibd"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span
                                                class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Tambah Data</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                            <label class="font-weight-bold">Jenis Bangunan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('jenis_bangunan') is-invalid @enderror"
                                                    id="jenis_bangunan" name="jenis_bangunan"
                                                    value="{{ old('jenis_bangunan') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Kode Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('kd_barang') is-invalid @enderror"
                                                    name="kd_barang" value="{{ old('kd_barang') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">NUP</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('nup') is-invalid @enderror" name="nup"
                                                    value="{{ old('nup') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Luas</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('luas') is-invalid @enderror" name="luas"
                                                    value="{{ old('luas') }}" required>
                                                <span class="form-control-feedback right">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Tanggal Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input data-inputmask="'mask': '99/99/9999'" type="text"
                                                    class="form-control @error('tahun_perolehan') is-invalid @enderror"
                                                    data-inputmask="'mask': '9999'" name="tahun_perolehan"
                                                    value="{{ old('tahun_perolehan') }}" required>
                                                <span class="fa fa-calendar form-control-feedback right"
                                                    aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Type Bangunan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('type') is-invalid @enderror" name="type"
                                                    value="{{ old('type') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nilai Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input style="text-align: right" type="text"
                                                    class="angka form-control @error('nilai_perolehan') is-invalid @enderror"
                                                    name="nilai_perolehan" value="{{ old('nilai_perolehan') }}"
                                                    required>
                                                <span class="form-control-feedback left" aria-hidden="true">Rp </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Asal Usul Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <select class="form-control" style="font-size: .85rem" name="asal"
                                                    required>
                                                    <option value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Keterangan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <textarea type="text"
                                                    class="form-control @error('ket') is-invalid @enderror" name="ket"
                                                    value="{{ old('ket') }}"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary" id="tambah">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- modal add data kib e-->
                    <div class="modal inmodal fade" id="modal-adde" tabindex="-1" role="dialog" aria-hidden="true"
                        wire:ignore.self>
                        <div class="modal-dialog modal-md">
                            <form name="frm_add" id="frm_add" class="form-horizontal" action="/Akunasetkiba/addkibe"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span
                                                class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Tambah Data</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                            <label class="font-weight-bold">Jenis Jalan Irigasi & Jaringan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('jenis_jalan') is-invalid @enderror"
                                                    id="jenis_jalan" name="jenis_jalan" value="{{ old('jenis_jalan') }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Kode Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('kd_barang') is-invalid @enderror"
                                                    name="kd_barang" value="{{ old('kd_barang') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">NUP</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('nup') is-invalid @enderror" name="nup"
                                                    value="{{ old('nup') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Ukuran</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('ukuran') is-invalid @enderror"
                                                    name="ukuran" value="{{ old('ukuran') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Tanggal Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input data-inputmask="'mask': '99/99/9999'" type="text"
                                                    class="form-control @error('tahun_perolehan') is-invalid @enderror"
                                                    data-inputmask="'mask': '9999'" name="tahun_perolehan"
                                                    value="{{ old('tahun_perolehan') }}" required>
                                                <span class="fa fa-calendar form-control-feedback right"
                                                    aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Type</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('type') is-invalid @enderror" name="type"
                                                    value="{{ old('type') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nilai Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input style="text-align: right" type="text"
                                                    class="angka form-control @error('nilai_perolehan') is-invalid @enderror"
                                                    name="nilai_perolehan" value="{{ old('nilai_perolehan') }}"
                                                    required>
                                                <span class="form-control-feedback left" aria-hidden="true">Rp </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Asal Usul Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <select class="form-control" style="font-size: .85rem" name="asal"
                                                    required>
                                                    <option value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Keterangan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <textarea type="text"
                                                    class="form-control @error('ket') is-invalid @enderror" name="ket"
                                                    value="{{ old('ket') }}"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary" id="tambah">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- modal add data kib f-->
                    <div class="modal inmodal fade" id="modal-addf" tabindex="-1" role="dialog" aria-hidden="true"
                        wire:ignore.self>
                        <div class="modal-dialog modal-md">
                            <form name="frm_add" id="frm_add" class="form-horizontal" action="/Akunasetkiba/addkibf"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span
                                                class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Tambah Data</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                            <label class="font-weight-bold">Nama Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('nama_barang') is-invalid @enderror"
                                                    id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Kode Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('kd_barang') is-invalid @enderror"
                                                    name="kd_barang" value="{{ old('kd_barang') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">NUP</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('nup') is-invalid @enderror" name="nup"
                                                    value="{{ old('nup') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Tanggal Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input data-inputmask="'mask': '99/99/9999'" type="text"
                                                    class="form-control @error('tahun_perolehan') is-invalid @enderror"
                                                    data-inputmask="'mask': '9999'" name="tahun_perolehan"
                                                    value="{{ old('tahun_perolehan') }}" required>
                                                <span class="fa fa-calendar form-control-feedback right"
                                                    aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Type</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('type') is-invalid @enderror" name="type"
                                                    value="{{ old('type') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nilai Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input style="text-align: right" type="text"
                                                    class="angka form-control @error('nilai_perolehan') is-invalid @enderror"
                                                    name="nilai_perolehan" value="{{ old('nilai_perolehan') }}"
                                                    required>
                                                <span class="form-control-feedback left" aria-hidden="true">Rp </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Asal Usul Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <select class="form-control" style="font-size: .85rem" name="asal"
                                                    required>
                                                    <option value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Keterangan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <textarea type="text"
                                                    class="form-control @error('ket') is-invalid @enderror" name="ket"
                                                    value="{{ old('ket') }}"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary" id="tambah">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- modal add upload-LHI Tanah-->
                    <div class="modal inmodal fade" id="upload-lhi" tabindex="-1" role="dialog" aria-hidden="true"
                        wire:ignore.self>
                        <div class="modal-dialog modal-md">
                            <form name="frm_add" id="frm_add" class="form-horizontal"
                                action="{{ route('Akunasetkib.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span
                                                class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Unggah Dokumen</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                            <input type="hidden" name="nama_data" value="lhi_tanah">
                                            <label class="font-weight-bold">Unggah LHI</label>
                                            <input type="file" class="form-control @error('file') is-invalid @enderror"
                                                id="file" name="file" value="{{ old('file') }}"
                                                placeholder="Unggah Dokumen LHI" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary" id="tambah">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- modal add upload-LHI Kendaraan Bermotor-->
                    <div class="modal inmodal fade" id="upload-lhib" tabindex="-1" role="dialog" aria-hidden="true"
                        wire:ignore.self>
                        <div class="modal-dialog modal-md">
                            <form name="frm_add" id="frm_add" class="form-horizontal"
                                action="{{ route('Akunasetkib.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span
                                                class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Unggah Dokumen</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                            <input type="hidden" name="nama_data" value="lhi_kendaraan">
                                            <label class="font-weight-bold">Unggah LHI</label>
                                            <input type="file" class="form-control @error('file') is-invalid @enderror"
                                                id="file" name="file" value="{{ old('file') }}"
                                                placeholder="Unggah Dokumen LHI" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary" id="tambah">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- modal add upload-LHI Peralatan dan Mesin-->
                    <div class="modal inmodal fade" id="upload-lhic" tabindex="-1" role="dialog" aria-hidden="true"
                        wire:ignore.self>
                        <div class="modal-dialog modal-md">
                            <form name="frm_add" id="frm_add" class="form-horizontal"
                                action="{{ route('Akunasetkib.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span
                                                class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Unggah Dokumen</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                            <input type="hidden" name="nama_data" value="lhi_mesin">
                                            <label class="font-weight-bold">Unggah LHI</label>
                                            <input type="file" class="form-control @error('file') is-invalid @enderror"
                                                id="file" name="file" value="{{ old('file') }}"
                                                placeholder="Unggah Dokumen LHI" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary" id="tambah">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- modal add upload-LHI Bangunan-->
                    <div class="modal inmodal fade" id="upload-lhid" tabindex="-1" role="dialog" aria-hidden="true"
                        wire:ignore.self>
                        <div class="modal-dialog modal-md">
                            <form name="frm_add" id="frm_add" class="form-horizontal"
                                action="{{ route('Akunasetkib.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span
                                                class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Unggah Dokumen</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                            <input type="hidden" name="nama_data" value="lhi_bangunan">
                                            <label class="font-weight-bold">Unggah LHI</label>
                                            <input type="file" class="form-control @error('file') is-invalid @enderror"
                                                id="file" name="file" value="{{ old('file') }}"
                                                placeholder="Unggah Dokumen LHI" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary" id="tambah">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- modal add upload-LHI Jalan Irigasi dan Jaringan-->
                    <div class="modal inmodal fade" id="upload-lhie" tabindex="-1" role="dialog" aria-hidden="true"
                        wire:ignore.self>
                        <div class="modal-dialog modal-md">
                            <form name="frm_add" id="frm_add" class="form-horizontal"
                                action="{{ route('Akunasetkib.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span
                                                class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Unggah Dokumen</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                            <input type="hidden" name="nama_data" value="lhi_jalan">
                                            <label class="font-weight-bold">Unggah LHI</label>
                                            <input type="file" class="form-control @error('file') is-invalid @enderror"
                                                id="file" name="file" value="{{ old('file') }}"
                                                placeholder="Unggah Dokumen LHI" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary" id="tambah">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- modal add upload-LHI Aset Tetap Lainnya-->
                    <div class="modal inmodal fade" id="upload-lhif" tabindex="-1" role="dialog" aria-hidden="true"
                        wire:ignore.self>
                        <div class="modal-dialog modal-md">
                            <form name="frm_add" id="frm_add" class="form-horizontal"
                                action="{{ route('Akunasetkib.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span
                                                class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Unggah Dokumen</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                            <input type="hidden" name="nama_data" value="lhi_lainnya">
                                            <label class="font-weight-bold">Unggah LHI</label>
                                            <input type="file" class="form-control @error('file') is-invalid @enderror"
                                                id="file" name="file" value="{{ old('file') }}"
                                                placeholder="Unggah Dokumen LHI" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary" id="tambah">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- modal edit data kib a-->
                    @foreach ($Akunasetkibas as $Akunasetkiba)
                    <div id="modal-edit{{ $Akunasetkiba->id }}" tabindex="-1" class="modal fade" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <form name="frm_add" id="frm_add" class="form-horizontal"
                                action="{{ route('Akunasetkiba.update', $Akunasetkiba->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span
                                                class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Edit Data</h4>
                                    </div>
                                    <div class="modal-body">
                                        @method('PUT')
                                        <div class="form-group">
                                            <label class="font-weight-bold">Jenis Tanah</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('jenis_tanah') is-invalid @enderror"
                                                    name="jenis_tanah" id="jenis_tanah"
                                                    value="{{ old('jenis_tanah', $Akunasetkiba->jenis) }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Kode Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('kd_barang') is-invalid @enderror"
                                                    name="kd_barang" id="kd_barang"
                                                    value="{{ old('kd_barang', $Akunasetkiba->kd_barang) }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">NUP</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('nup') is-invalid @enderror" name="nup"
                                                    id="nup" value="{{ old('nup', $Akunasetkiba->nup) }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Luas</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('luas') is-invalid @enderror" name="luas"
                                                    id="luas" value="{{ old('luas', $Akunasetkiba->identitas) }}"
                                                    required>
                                                <span class="form-control-feedback right">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Tanggal Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input data-inputmask="'mask': '99/99/9999'" type="text"
                                                    class="form-control @error('tahun_perolehan') is-invalid @enderror"
                                                    name="tahun_perolehan" value="{{ $Akunasetkiba->tahun_perolehan }}"
                                                    required>
                                                <span class="fa fa-calendar form-control-feedback right"
                                                    aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Alas Hak/Bukti Kepemilikan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('bukti_kepemilikan') is-invalid @enderror"
                                                    name="bukti_kepemilikan" id="bukti_kepemilikan"
                                                    value="{{ old('bukti_kepemilikan', $Akunasetkiba->type_identitas) }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nilai Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input style="text-align: right" type="text"
                                                    class="angka form-control @error('nilai_perolehan') is-invalid @enderror"
                                                    name="nilai_perolehan" value="{{ $Akunasetkiba->nilai_perolehan }}"
                                                    required>
                                                <span class="form-control-feedback left" aria-hidden="true">Rp </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Asal Usul Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <select class="form-control" style="font-size: .85rem" name="asal"
                                                    required>
                                                    @if($Akunasetkiba->asal == 'APBDesa')
                                                    <option value="">Pilih</option>
                                                    <option selected value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                    @elseif($Akunasetkiba->asal == 'Perolehan Lain Yang Sah')
                                                    <option value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option selected value="Perolehan Lain Yang Sah">Perolehan Lain Yang
                                                        Sah</option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                    @elseif($Akunasetkiba->asal == 'Aset / Kekayaan Asli Desa')
                                                    <option value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option selected value="Aset / Kekayaan Asli Desa">Aset / Kekayaan
                                                        Asli Desa</option>
                                                    @else
                                                    <option selected value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Keterangan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <textarea type="text" class="form-control" name="ket" id="ket"
                                                    value="{{ old('ket', $Akunasetkiba->ket) }}"
                                                    placeholder="Masukkan Keterangan">{{ old('ket', $Akunasetkiba->ket) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach

                    <!-- modal edit data kib b-->
                    @foreach ($Akunasetkibbs as $Akunasetkibb)
                    <div id="modal-editb{{ $Akunasetkibb->id }}" tabindex="-1" class="modal fade" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <form action="/Akunasetkiba/editkibb" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span
                                                class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Edit Datass</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" name="id" value="{{ $Akunasetkibb->id }}">
                                            <label class="font-weight-bold">Nama Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('nama_barang') is-invalid @enderror"
                                                    name="nama_barang" id="nama_barang"
                                                    value="{{ old('nama_barang', $Akunasetkibb->jenis) }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Kode Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('kd_barang') is-invalid @enderror"
                                                    name="kd_barang" id="kd_barang"
                                                    value="{{ old('kd_barang', $Akunasetkibb->kd_barang) }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">NUP</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('nup') is-invalid @enderror" name="nup"
                                                    id="nup" value="{{ old('nup', $Akunasetkibb->nup) }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Merk / Type</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('type') is-invalid @enderror" name="type"
                                                    id="type" value="{{ old('type', $Akunasetkibb->identitas) }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Tanggal Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input data-inputmask="'mask': '99/99/9999'" type="text"
                                                    class="form-control @error('tahun_perolehan') is-invalid @enderror"
                                                    name="tahun_perolehan" value="{{ $Akunasetkibb->tahun_perolehan }}"
                                                    required>
                                                <span class="fa fa-calendar form-control-feedback right"
                                                    aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nomor Identitas</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('nomor_identitas') is-invalid @enderror"
                                                    name="nomor_identitas" id="nomor_identitas"
                                                    value="{{ old('nomor_identitas', $Akunasetkibb->type_identitas) }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nilai Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input style="text-align: right" type="text"
                                                    class="angka form-control @error('nilai_perolehan') is-invalid @enderror"
                                                    name="nilai_perolehan" value="{{ $Akunasetkibb->nilai_perolehan }}"
                                                    required>
                                                <span class="form-control-feedback left" aria-hidden="true">Rp </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Asal Usul Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <select class="form-control" style="font-size: .85rem" name="asal"
                                                    required>
                                                    @if($Akunasetkibb->asal == 'APBDesa')
                                                    <option value="">Pilih</option>
                                                    <option selected value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                    @elseif($Akunasetkibb->asal == 'Perolehan Lain Yang Sah')
                                                    <option value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option selected value="Perolehan Lain Yang Sah">Perolehan Lain Yang
                                                        Sah</option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                    @elseif($Akunasetkibb->asal == 'Aset / Kekayaan Asli Desa')
                                                    <option value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option selected value="Aset / Kekayaan Asli Desa">Aset / Kekayaan
                                                        Asli Desa</option>
                                                    @else
                                                    <option selected value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Kondisi Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <select class="form-control @error('kondisi') is-invalid @enderror"
                                                    style="font-size: .85rem" id="kondisi" name="kondisi" required>
                                                    @if($Akunasetkibb->kondisi_barang == 'Baik')
                                                    <option value="Baik" selected>== BAIK ==</option>
                                                    <option value="Rusak Ringan">== RUSAK RINGAN ==</option>
                                                    <option value="Rusak Berat">== RUSAK BERAT ==</option>
                                                    @elseif ($Akunasetkibb->kondisi_barang == 'Rusak Ringan')
                                                    <option value="Baik">== BAIK ==</option>
                                                    <option value="Rusak Ringan" selected>== RUSAK RINGAN ==</option>
                                                    <option value="Rusak Berat">== RUSAK BERAT ==</option>
                                                    @else
                                                    <option value="Baik">== BAIK ==</option>
                                                    <option value="Rusak Ringan">== RUSAK RINGAN ==</option>
                                                    <option value="Rusak Berat" selected>== RUSAK BERAT ==</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Keterangan</label>
                                            <textarea type="text" class="form-control" name="ket" id="ket"
                                                value="{{ old('ket', $Akunasetkibb->ket) }}"
                                                placeholder="Masukkan Keterangan">{{ old('ket', $Akunasetkibb->ket) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach

                    <!-- modal edit data kib c-->
                    @foreach ($Akunasetkibcs as $Akunasetkibc)
                    <div id="modal-editc{{ $Akunasetkibc->id }}" tabindex="-1" class="modal fade" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <form name="frm_add" id="frm_add" class="form-horizontal" action="/Akunasetkiba/editkibc"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span
                                                class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Edit Data</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" name="id" value="{{ $Akunasetkibc->id }}">
                                            <label class="font-weight-bold">Nama Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('nama_barang') is-invalid @enderror"
                                                    name="nama_barang" id="nama_barang"
                                                    value="{{ old('nama_barang', $Akunasetkibc->jenis) }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Kode Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('kd_barang') is-invalid @enderror"
                                                    name="kd_barang" id="kd_barang"
                                                    value="{{ old('kd_barang', $Akunasetkibc->kd_barang) }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">NUP</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('nup') is-invalid @enderror" name="nup"
                                                    id="nup" value="{{ old('nup', $Akunasetkibc->nup) }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Merk / Type</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('type') is-invalid @enderror" name="type"
                                                    id="type" value="{{ old('type', $Akunasetkibc->identitas) }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Tanggal Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input data-inputmask="'mask': '99/99/9999'" type="text"
                                                    class="form-control @error('tahun_perolehan') is-invalid @enderror"
                                                    name="tahun_perolehan" value="{{ $Akunasetkibc->tahun_perolehan }}"
                                                    required>
                                                <span class="fa fa-calendar form-control-feedback right"
                                                    aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nomor Identitas</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('nomor_identitas') is-invalid @enderror"
                                                    name="nomor_identitas" id="nomor_identitas"
                                                    value="{{ old('nomor_identitas', $Akunasetkibc->type_identitas) }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nilai Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input style="text-align: right" type="text"
                                                    class="angka form-control @error('nilai_perolehan') is-invalid @enderror"
                                                    name="nilai_perolehan" value="{{ $Akunasetkibc->nilai_perolehan }}"
                                                    required>
                                                <span class="form-control-feedback left" aria-hidden="true">Rp </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Asal Usul Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <select class="form-control" style="font-size: .85rem" name="asal"
                                                    required>
                                                    @if($Akunasetkibc->asal == 'APBDesa')
                                                    <option value="">Pilih</option>
                                                    <option selected value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                    @elseif($Akunasetkibc->asal == 'Perolehan Lain Yang Sah')
                                                    <option value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option selected value="Perolehan Lain Yang Sah">Perolehan Lain Yang
                                                        Sah</option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                    @elseif($Akunasetkibc->asal == 'Aset / Kekayaan Asli Desa')
                                                    <option value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option selected value="Aset / Kekayaan Asli Desa">Aset / Kekayaan
                                                        Asli Desa</option>
                                                    @else
                                                    <option selected value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Kondisi Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <select class="form-control @error('kondisi') is-invalid @enderror"
                                                    style="font-size: .85rem" id="kondisi" name="kondisi" required>
                                                    @if($Akunasetkibc->kondisi_barang == 'Baik')
                                                    <option value="Baik" selected>== BAIK ==</option>
                                                    <option value="Rusak Ringan">== RUSAK RINGAN ==</option>
                                                    <option value="Rusak Berat">== RUSAK BERAT ==</option>
                                                    @elseif ($Akunasetkibc->kondisi_barang == 'Rusak Ringan')
                                                    <option value="Baik">== BAIK ==</option>
                                                    <option value="Rusak Ringan" selected>== RUSAK RINGAN ==</option>
                                                    <option value="Rusak Berat">== RUSAK BERAT ==</option>
                                                    @else
                                                    <option value="Baik">== BAIK ==</option>
                                                    <option value="Rusak Ringan">== RUSAK RINGAN ==</option>
                                                    <option value="Rusak Berat" selected>== RUSAK BERAT ==</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Keterangan</label>
                                            <textarea type="text" class="form-control" name="ket" id="ket"
                                                value="{{ old('ket', $Akunasetkibc->ket) }}"
                                                placeholder="Masukkan Keterangan">{{ old('ket', $Akunasetkibc->ket) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach

                    <!-- modal edit data kib d-->
                    @foreach ($Akunasetkibds as $Akunasetkibd)
                    <div id="modal-editd{{ $Akunasetkibd->id }}" tabindex="-1" class="modal fade" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <form name="frm_add" id="frm_add" class="form-horizontal" action="/Akunasetkiba/editkibd"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span
                                                class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Edit Data</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" name="id" value="{{ $Akunasetkibd->id }}">
                                            <label class="font-weight-bold">Jenis Bangunan</label>
                                            <input type="text"
                                                class="form-control @error('jenis_bangunan') is-invalid @enderror"
                                                name="jenis_bangunan" id="jenis_bangunan"
                                                value="{{ old('jenis_bangunan', $Akunasetkibd->jenis) }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Kode Barang</label>
                                            <input type="text"
                                                class="form-control @error('kd_barang') is-invalid @enderror"
                                                name="kd_barang" id="kd_barang"
                                                value="{{ old('kd_barang', $Akunasetkibd->kd_barang) }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">NUP</label>
                                            <input type="text" class="form-control @error('nup') is-invalid @enderror"
                                                name="nup" id="nup" value="{{ old('nup', $Akunasetkibd->nup) }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Luas</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('luas') is-invalid @enderror" name="luas"
                                                    id="luas" value="{{ old('luas', $Akunasetkibd->identitas) }}"
                                                    placeholder="Masukkan Luas Tanah" required>
                                                <span class="form-control-feedback right">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Tanggal Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input data-inputmask="'mask': '99/99/9999'" type="text"
                                                    class="form-control @error('tahun_perolehan') is-invalid @enderror"
                                                    name="tahun_perolehan" value="{{ $Akunasetkibd->tahun_perolehan }}"
                                                    placeholder="Masukkan Tahun Perolehan" required>
                                                <span class="fa fa-calendar form-control-feedback right"
                                                    aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Type Bangunan</label>
                                            <input type="text" class="form-control @error('type') is-invalid @enderror"
                                                name="type" id="type"
                                                value="{{ old('type', $Akunasetkibd->type_identitas) }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nilai Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input style="text-align: right" type="text"
                                                    class="angka form-control @error('nilai_perolehan') is-invalid @enderror"
                                                    name="nilai_perolehan" value="{{ $Akunasetkibd->nilai_perolehan }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Asal Usul Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <select class="form-control" style="font-size: .85rem" name="asal"
                                                    required>
                                                    @if($Akunasetkibd->asal == 'APBDesa')
                                                    <option value="">Pilih</option>
                                                    <option selected value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                    @elseif($Akunasetkibd->asal == 'Perolehan Lain Yang Sah')
                                                    <option value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option selected value="Perolehan Lain Yang Sah">Perolehan Lain Yang
                                                        Sah</option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                    @elseif($Akunasetkibd->asal == 'Aset / Kekayaan Asli Desa')
                                                    <option value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option selected value="Aset / Kekayaan Asli Desa">Aset / Kekayaan
                                                        Asli Desa</option>
                                                    @else
                                                    <option selected value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Keterangan</label>
                                            <textarea type="text" class="form-control" name="ket" id="ket"
                                                value="{{ old('ket', $Akunasetkibd->ket) }}"
                                                placeholder="Masukkan Keterangan">{{ old('ket', $Akunasetkibd->ket) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach

                    <!-- modal edit data kib e-->
                    @foreach ($Akunasetkibes as $Akunasetkibe)
                    <div id="modal-edite{{ $Akunasetkibe->id }}" tabindex="-1" class="modal fade" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <form name="frm_add" id="frm_add" class="form-horizontal" action="/Akunasetkiba/editkibe"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span
                                                class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Edit Data</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" name="id" value="{{ $Akunasetkibe->id }}">
                                            <label class="font-weight-bold">Jenis Jalan Irigasi & Jaringan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('jenis_jalan') is-invalid @enderror"
                                                    name="jenis_jalan" id="jenis_jalan"
                                                    value="{{ old('jenis_jalan', $Akunasetkibe->jenis) }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Kode Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('kd_barang') is-invalid @enderror"
                                                    name="kd_barang" id="kd_barang"
                                                    value="{{ old('kd_barang', $Akunasetkibe->kd_barang) }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">NUP</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('nup') is-invalid @enderror" name="nup"
                                                    id="nup" value="{{ old('nup', $Akunasetkibe->nup) }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Ukuran</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('ukuran') is-invalid @enderror"
                                                    name="ukuran" id="ukuran"
                                                    value="{{ old('ukuran', $Akunasetkibe->identitas) }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Tanggal Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input data-inputmask="'mask': '99/99/9999'" type="text"
                                                    class="form-control @error('tahun_perolehan') is-invalid @enderror"
                                                    name="tahun_perolehan" value="{{ $Akunasetkibe->tahun_perolehan }}"
                                                    placeholder="Masukkan Tahun Perolehan" required>
                                                <span class="fa fa-calendar form-control-feedback right"
                                                    aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Type</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('type') is-invalid @enderror" name="type"
                                                    id="type" value="{{ old('type', $Akunasetkibe->type_identitas) }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nilai Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input style="text-align: right" type="text"
                                                    class="angka form-control @error('nilai_perolehan') is-invalid @enderror"
                                                    name="nilai_perolehan" value="{{ $Akunasetkibe->nilai_perolehan }}"
                                                    required>
                                                <span class="form-control-feedback left" aria-hidden="true">Rp </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Asal Usul Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <select class="form-control" style="font-size: .85rem" name="asal"
                                                    required>
                                                    @if($Akunasetkibe->asal == 'APBDesa')
                                                    <option value="">Pilih</option>
                                                    <option selected value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                    @elseif($Akunasetkibe->asal == 'Perolehan Lain Yang Sah')
                                                    <option value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option selected value="Perolehan Lain Yang Sah">Perolehan Lain Yang
                                                        Sah</option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                    @elseif($Akunasetkibe->asal == 'Aset / Kekayaan Asli Desa')
                                                    <option value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option selected value="Aset / Kekayaan Asli Desa">Aset / Kekayaan
                                                        Asli Desa</option>
                                                    @else
                                                    <option selected value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Keterangan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <textarea type="text" class="form-control" name="ket" id="ket"
                                                    value="{{ old('ket', $Akunasetkibe->ket) }}">{{ old('ket', $Akunasetkibe->ket) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach

                    <!-- modal edit data kib f-->
                    @foreach ($Akunasetkibfs as $Akunasetkibf)
                    <div id="modal-editf{{ $Akunasetkibf->id }}" tabindex="-1" class="modal fade" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <form name="frm_add" id="frm_add" class="form-horizontal" action="/Akunasetkiba/editkibf"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span
                                                class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Edit Data</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input name="id" type="hidden" value="{{ $Akunasetkibf->id }}">
                                            <label class="font-weight-bold">Nama Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('nama_barang') is-invalid @enderror"
                                                    name="nama_barang" id="nama_barang"
                                                    value="{{ old('nama_barang', $Akunasetkibf->jenis) }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Kode Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('kd_barang') is-invalid @enderror"
                                                    name="kd_barang" id="kd_barang"
                                                    value="{{ old('kd_barang', $Akunasetkibf->kd_barang) }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">NUP</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input type="text"
                                                    class="form-control @error('nup') is-invalid @enderror" name="nup"
                                                    id="nup" value="{{ old('nup', $Akunasetkibf->nup) }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Tanggal Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input data-inputmask="'mask': '99/99/9999'" type="text"
                                                    class="form-control @error('tahun_perolehan') is-invalid @enderror"
                                                    name="tahun_perolehan" value="{{ $Akunasetkibf->tahun_perolehan }}"
                                                    required>
                                                <span class="fa fa-calendar form-control-feedback right"
                                                    aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Merk/Type</label>
                                            <input type="text" class="form-control @error('type') is-invalid @enderror"
                                                name="type" id="type"
                                                value="{{ old('type', $Akunasetkibf->identitas) }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nilai Perolehan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <input style="text-align: right" type="text"
                                                    class="angka form-control @error('nilai_perolehan') is-invalid @enderror"
                                                    name="nilai_perolehan" value="{{ $Akunasetkibf->nilai_perolehan }}"
                                                    required>
                                                <span class="form-control-feedback left" aria-hidden="true">Rp </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Asal Usul Barang</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <select class="form-control" style="font-size: .85rem" name="asal"
                                                    required>
                                                    @if($Akunasetkibf->asal == 'APBDesa')
                                                    <option value="">Pilih</option>
                                                    <option selected value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                    @elseif($Akunasetkibf->asal == 'Perolehan Lain Yang Sah')
                                                    <option value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option selected value="Perolehan Lain Yang Sah">Perolehan Lain Yang
                                                        Sah</option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                    @elseif($Akunasetkibf->asal == 'Aset / Kekayaan Asli Desa')
                                                    <option value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option selected value="Aset / Kekayaan Asli Desa">Aset / Kekayaan
                                                        Asli Desa</option>
                                                    @else
                                                    <option selected value="">Pilih</option>
                                                    <option value="APBDesa">APBDesa</option>
                                                    <option value="Perolehan Lain Yang Sah">Perolehan Lain Yang Sah
                                                    </option>
                                                    <option value="Aset / Kekayaan Asli Desa">Aset / Kekayaan Asli Desa
                                                    </option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Keterangan</label>
                                            <div class="col-md-12" style="padding-bottom: 10px">
                                                <textarea type="text" class="form-control" name="ket" id="ket"
                                                    value="{{ old('ket', $Akunasetkibf->ket) }}"
                                                    placeholder="Masukkan Keterangan">{{ old('ket', $Akunasetkibf->ket) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach

                    <!-- modal copy data kib a-->
                    <div class="modal fade" id="copyAkunaset" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h6 class="modal-title text-light" id="staticBackdropLabel">Copy Data Aset Desa</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @if(session()->has('timpaAll'))
                                    <div class="alert bg-danger text-white">Sudah ada data akuntabilitas kewilayahan
                                        tahun
                                        {{
                                        session('timpaAll') }}
                                    </div>
                                    <form action="/Akunasetkiba/copyAkunaset" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="tahuncopy">Tetap Copy dan timpa Seluruh Data Aset Tanah Tahun {{
                                                $tahun }} ke
                                                Tahun {{ session('timpaAll') }}
                                                :</label>
                                            <input type="hidden" name="tahuncopy" value="{{ session('timpaAll') }}">
                                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                            <input type="hidden" name="tahunasal" value="{{ $tahun }}">
                                            <input type="hidden" name="timpadata" value="oke">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Copy Data</button>
                                        </div>
                                    </form>
                                    @else
                                    <form action="/Akunasetkiba/copyAkunaset" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="tahuncopy">Copy Seluruh Data Aset Tahun {{ $tahun }} ke
                                                Tahun:</label>
                                            <select class="form-control" id="tahuncopy" name="tahuncopy" required>
                                                <option value="">== pilih tahun ==</option>
                                                <option>{{ $tahun+1 }}</option>
                                                <option>{{ $tahun+2 }}</option>
                                                <option>{{ $tahun+3 }}</option>
                                            </select>
                                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                            <input type="hidden" name="tahunasal" value="{{ $tahun }}">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Copy Data</button>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                @endsection





                @push('script')
                {{--
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
                    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
                    crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

                <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js">
                </script>
                <script src="/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
                <script>
                    $(document).ready(function() {
        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            $('#myTab a[href="' + activeTab + '"]').tab('show');
        }
    });
                </script>

                <script>
                    document.querySelectorAll('input[type-currency="IDR"]').forEach((element) => {
        element.addEventListener('keyup', function(e) {
        let cursorPostion = this.selectionStart;
          let value = parseInt(this.value.replace(/[^,\d]/g, ''));
          let originalLenght = this.value.length;
          if (isNaN(value)) {
            this.value = "";
          } else {    
            this.value = value.toLocaleString('id-ID', {
              currency: 'IDR',
              style: 'currency',
              minimumFractionDigits: 0
            });
            cursorPostion = this.value.length - originalLenght + cursorPostion;
            this.setSelectionRange(cursorPostion, cursorPostion);
          }
        });
      });
                </script>


                @if(session()->has('timpaAll'))
                <script>
                    $('#copyAkunaset').modal('show');
                </script>
                @endif

                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
                <script>
                    bsCustomFileInput.init();
    $('.jumlah').mask('000.000.000.000.000', {reverse: true});
    $('.angka').mask('000.000.000.000.000', {reverse: true});
                </script>

                @endpush