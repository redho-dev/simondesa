@extends('templates.desa.main')
@section('css')
<!-- NProgress -->
<link href="/vendors/nprogress/nprogress.css" rel="stylesheet">
<!-- Dropzone.js -->
<link href="/vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="clearfix"></div>
<div class="row justify-content-center mt-2">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input Data Monografi</h5>
        <div class="x_panel">
            <div class="x_title">
                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formKewilayahan" method="get">
                        @csrf
                        <div class="form-group mx-sm-3 mb-2">
                            <h6>Masukkan tahun data :</h6>
                            <input type="text" name="tahun" class="form-control ml-3" placeholder="{{ $tahun }}"
                                data-inputmask="'mask': '9999'" style="font-size: .85rem">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mb-2">Cek Data</button>
                    </form>

                    <button type="button" class="btn btn-primary ml-auto btn-sm" data-toggle="modal"
                        data-target="#copyDataAll">
                        Copy Seluruh Data Umum
                    </button>

                </div>
                <!-- Modal -->
                <div class="modal fade" id="copyDataAll" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-light" id="staticBackdropLabel">Copy Data Umum</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(session()->has('timpaAll'))
                                <div class="alert bg-danger text-white">Sudah ada data umum tahun {{
                                    session('timpaAll') }}
                                </div>
                                <form action="/adminDesa/copyDatumAll" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tahuncopy">Tetap Copy dan timpa Seluruh Data Umum Tahun {{
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
                            <form action="/adminDesa/copyDatumAll" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="tahuncopy">Copy Seluruh Data Umum Tahun {{ $tahun }} ke Tahun
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
            <div>Tahun Data : {{ $tahun }}
                <span class="ml-4 text-info">(Form input data {{ $jenis }})</span>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='kewilayahan' ? 'active' : '' }}"
                        href="?jenis=kewilayahan&tahun={{ $tahun }}" role="tab">Wilayah
                        <span class="fa fa-check-circle ml-1 {{ $kewilayahan==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='kependudukan' ? 'active' : '' }}"
                        href="?jenis=kependudukan&tahun={{ $tahun }}" role="tab">Kependudukan
                        <span class="fa fa-check-circle ml-1 {{ $kependudukan==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='pekerjaan' ? 'active' : '' }}"
                        href="?jenis=pekerjaan&tahun={{ $tahun }}" role="tab">Pekerjaan
                        <span class="fa fa-check-circle ml-1 {{ $pekerjaan==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='sarpras' ? 'active' : '' }}" href="?jenis=sarpras&tahun={{ $tahun }}"
                        role="tab">Sarana-Prasarana
                        <span class="fa fa-check-circle ml-1 {{ $sarpras==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='kelembagaan' ? 'active' : '' }}"
                        href="?jenis=kelembagaan&tahun={{ $tahun }}" role="tab">Kelembagaan
                        <span class="fa fa-check-circle ml-1 {{ $kelembagaan==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='papan' ? 'active' : '' }}" href="?jenis=papan&tahun={{ $tahun }}"
                        role="tab">Papan Monografi
                        <span class="fa fa-check-circle ml-1 {{ $papan==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane active show " role="tabpanel" aria-labelledby="kewilayahan-tab">
                    <div class="row mb-4 {{ $jenis=='kewilayahan' ? '' : 'd-none' }}">
                        <div class="col-md-8">
                            {{-- FORM INPUT DATA KEWILAYAHAN --}}
                            <table class="table table-striped table-active" style="font-size: .8rem">
                                <thead>
                                    <tr class="bg-info">
                                        <td colspan="2">Silahkan Input Data Umum Wilayah</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="/adminDesa/tambahDatumWil" method="post">
                                        @csrf
                                        <input type="hidden" name="tahun" value="{{ $tahun }}">
                                        <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                        <input type="hidden" name="jenis" value="{{ $jenis }}">

                                        <tr>
                                            <td width="45%">
                                                <label for="dasar" class="col-form-label">1. Dasar Hukum Pembentukan
                                                    Desa</label>
                                                <input type="hidden" name="nama_data[]" value="dasar_hukum">
                                            </td>
                                            <td>
                                                <textarea class="form-control" name="isidata[]" id="dasar" rows="2"
                                                    style="font-size: .8rem" autofocus></textarea>
                                                <small class="text-secondary"><i>contoh : Perda Nomor xx Tahun xxxx
                                                        tentang
                                                        Pembentukan
                                                        Desa..</i></small>

                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="wilayah" class="col-form-label">2. Luas Wilayah</label>
                                                <input type="hidden" name="nama_data[]" value="luas_wilayah">

                                            </td>
                                            <td class="d-flex" width="40%"><input type="text" class="form-control"
                                                    name="isidata[]" required style="font-size: .8rem">
                                                <span class="input-group-text" id="wilayah"
                                                    style="font-size: .8rem">Ha</span>
                                                @error('isidata[1]')
                                                <small class="text-danger">luas wilayah harus diisi, max : 10
                                                    char</small>
                                                @enderror

                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="utara" class="col-form-label">3. Sebelah Utara
                                                    berbatasan
                                                    dengan</label>
                                                <input type="hidden" name="nama_data[]" value="batas_utara">
                                            </td>
                                            <td>
                                                <textarea name="isidata[]" class="form-control" id="utara" rows="2"
                                                    style="font-size: .8rem" required></textarea>
                                                @error('isidata[2]')
                                                <small class="text-danger">batas utara harus diisi</small>
                                                @enderror
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="selatan" class="col-form-label">4. Sebelah Selatan
                                                    berbatasan dengan</label>
                                                <input type="hidden" name="nama_data[]" value="batas_selatan">
                                            </td>
                                            <td>
                                                <textarea name="isidata[]" class="form-control" id="selatan" rows="2"
                                                    style="font-size: .8rem" required></textarea>
                                                @error('isidata[3]')
                                                <small class="text-danger">batas selatan harus diisi</small>
                                                @enderror
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="barat" class="col-form-label">5. Sebelah Barat
                                                    berbatasan
                                                    dengan</label>
                                                <input type="hidden" name="nama_data[]" value="batas_barat">

                                            </td>
                                            <td>
                                                <textarea name="isidata[]" class="form-control" id="barat" rows="2"
                                                    style="font-size: .8rem" required></textarea>
                                                @error('isidata[4]')
                                                <small class="text-danger">batas barat harus diisi</small>
                                                @enderror

                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="timur" class="col-form-label">6. Sebelah Timur
                                                    berbatasan
                                                    dengan</label>
                                                <input type="hidden" name="nama_data[]" value="batas_timur">
                                            </td>
                                            <td><textarea name="isidata[]" class="form-control" id="timur" rows="2"
                                                    style="font-size: .8rem" required></textarea>
                                                @error('isidata[5]')
                                                <small class="text-danger">batas timur harus diisi</small>
                                                @enderror

                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="dusun" class="col-form-label">7. Jumlah Dusun</label>
                                                <input type="hidden" name="nama_data[]" value="jumlah_dusun">
                                            </td>
                                            <td class="d-flex" width="60%"><input type="number" name="isidata[]"
                                                    id="dusun" class="form-control" style="font-size: .8rem" required>
                                                <span class="input-group-text" style="font-size: .8rem">Dusun</span>
                                                @error('isidata[6]')
                                                <small class="text-danger">jumlah dusun harus diisi</small>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="rt" class="col-form-label">8. Jumlah RT</label>
                                                <input type="hidden" name="nama_data[]" value="jumlah_rt">
                                            </td>
                                            <td class="d-flex" width="60%"><input type="number" name="isidata[]" id="rt"
                                                    class="form-control" style="font-size: .8rem" required>
                                                <span class="input-group-text" style="font-size: .8rem">RT</span>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="rt" class="col-form-label">9. Jarak Kantor Desa dari Kantor
                                                    Kecamatan</label>
                                                <input type="hidden" name="nama_data[]" value="jarak_kecamatan">
                                            </td>
                                            <td class="d-flex" width="60%"><input type="text" name="isidata[]"
                                                    class="form-control" style="font-size: .8rem">
                                                <span class="input-group-text" style="font-size: .8rem">Km</span>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="rt" class="col-form-label">10. Jarak Kantor Desa dari Kantor
                                                    Pemerintah Kabupaten</label>
                                                <input type="hidden" name="nama_data[]" value="jarak_pemda">
                                            </td>
                                            <td class="d-flex" width="60%"><input type="text" name="isidata[]"
                                                    class="form-control" style="font-size: .8rem">
                                                <span class="input-group-text" style="font-size: .8rem">Km</span>

                                            </td>
                                        </tr>


                                        <tr>
                                            <td colspan="2" align="center">
                                                <button class="btn btn-primary btn-sm">KIRIM DATA</button>
                                            </td>
                                        </tr>
                                    </form>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    {{-- akhir form tambah kewilayahan --}}

                    {{-- Form Tambah Data Kependudukan --}}
                    <div class="row mb-4 {{ $jenis=='kependudukan' ? '' : 'd-none' }}">
                        <div class="col-md-8">
                            <form action="/adminDesa/tambahDatumDuk" method="post">
                                @csrf
                                <input type="hidden" name="tahun" value="{{ $tahun }}">
                                <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                <input type="hidden" name="jenis" value="kependudukan">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="bg-info">
                                                Silahkan Isi Data Kependudukan Di bawah ini Dengan Data yang Terbaru dan
                                                Valid
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th width='60%'>1. Jumlah penduduk
                                                        <input type="hidden" name="nama_data[]" value="jumlah_penduduk">
                                                    </th>
                                                    <th class="p-0 g-0 ">
                                                        <input type="number"
                                                            class="form-control py-0 mt-0 px-2 border-0"
                                                            name="isidata[]" style="font-size: .85rem" autofocus>
                                                    </th>
                                                    <th class="bg-light">Jiwa</th>


                                                </tr>
                                                <tr>
                                                    <th>2. Penduduk laki-laki
                                                        <input type="hidden" name="nama_data[]"
                                                            value="jumlah_penduduk_l">
                                                    </th>
                                                    <th class="p-0">
                                                        <input type="number"
                                                            class="form-control py-0 pb-1 px-2 border-0"
                                                            name="isidata[]" style="font-size: .85rem" autofocus>
                                                    </th>
                                                    <th class="bg-light">Orang</th>


                                                </tr>
                                                <tr>
                                                    <th>3. Penduduk Perempuan
                                                        <input type="hidden" name="nama_data[]"
                                                            value="jumlah_penduduk_p">
                                                    </th>
                                                    <th class="p-0">
                                                        <input type="number"
                                                            class="form-control py-0 pb-1 px-2 border-0"
                                                            name="isidata[]" style="font-size: .85rem">
                                                    </th>
                                                    <th class="bg-light">Orang</th>

                                                </tr>
                                                <tr>
                                                    <th>4. Usia 0-15 tahun
                                                        <input type="hidden" name="nama_data[]" value="usia_0_15">
                                                    </th>
                                                    <th class="p-0">
                                                        <input type="number"
                                                            class="form-control py-0 pb-1 px-2 border-0"
                                                            name="isidata[]" style="font-size: .85rem" autofocus>
                                                    </th>
                                                    <th class="bg-light">Orang</th>


                                                </tr>
                                                <tr>
                                                    <th>5. Usia 15-65 tahun
                                                        <input type="hidden" name="nama_data[]" value="usia_15_65">
                                                    </th>
                                                    <th class="p-0">
                                                        <input type="number"
                                                            class="form-control py-0 pb-1 px-2 border-0"
                                                            name="isidata[]" style="font-size: .85rem">
                                                    </th>
                                                    <th class="bg-light">Orang</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th width='60%'>6. Usia > 65 tahun
                                                        <input type="hidden" name="nama_data[]" value="usia_65_keatas">
                                                    </th>
                                                    <th class="p-0">
                                                        <input type="number"
                                                            class="form-control py-0 pb-1 px-2 border-0"
                                                            name="isidata[]" style="font-size: .85rem" autofocus>
                                                    </th>
                                                    <th class="bg-light">Orang</th>


                                                </tr>
                                                <tr>
                                                    <th>7. Jumlah Kepala Keluarga
                                                        <input type="hidden" name="nama_data[]" value="jumlah_kk">
                                                    </th>
                                                    <th class="p-0">
                                                        <input type="number"
                                                            class="form-control py-0 pb-1 px-2 border-0"
                                                            name="isidata[]" style="font-size: .85rem">
                                                    </th>
                                                    <th class="bg-light">KK</th>
                                                </tr>
                                                <tr>
                                                    <th>8. Jumlah Penduduk Miskin
                                                        <input type="hidden" name="nama_data[]" value="penduduk_miskin">
                                                    </th>
                                                    <th class="p-0">
                                                        <input type="number"
                                                            class="form-control py-0 pb-1 px-2 border-0"
                                                            name="isidata[]" style="font-size: .85rem">
                                                    </th>
                                                    <th class="bg-light">Jiwa</th>

                                                </tr>
                                                <tr>
                                                    <th>9. Jumlah KK Miskin
                                                        <input type="hidden" name="nama_data[]" value="kk_miskin">
                                                    </th>
                                                    <th class="p-0">
                                                        <input type="number"
                                                            class="form-control py-0 pb-1 px-2 border-0"
                                                            name="isidata[]" style="font-size: .85rem" autofocus>
                                                    </th>
                                                    <th class="bg-light">KK</th>
                                                </tr>
                                                <tr>
                                                    <th>10. Jumlah Penerima Bansos
                                                        <input type="hidden" name="nama_data[]" value="penerima_bansos">
                                                    </th>
                                                    <th class="p-0">
                                                        <input type="number"
                                                            class="form-control py-0 pb-1 px-2 border-0"
                                                            name="isidata[]" style="font-size: .85rem">
                                                    </th>
                                                    <th class="bg-light">Orang</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <tfoot>
                                                <tr>
                                                    <th colspan="6" class="text-center">
                                                        <button type="submit" class="btn btn-primary">Kirim
                                                            Data</button>
                                                    </th>
                                                </tr>
                                            </tfoot>

                                        </table>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    {{-- Akhir form kependudukan --}}

                    {{-- Form Sarpras --}}
                    <div class="row {{ $jenis=='sarpras' ? '' : 'd-none' }}">
                        <div class="col-md-8">
                            <form action="/adminDesa/tambahDatumPras" method="post">
                                @csrf
                                <input type="hidden" name="tahun" value="{{ $tahun }}">
                                <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                <input type="hidden" name="jenis" value="{{ $jenis }}">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="bg-info">
                                                Silahkan Isi Data Jumlah Sarana-Prasarana dibawah ini
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="background-color: lightgrey">
                                            <th colspan="3">Sarpras Pendidikan</th>
                                            <th colspan="3">Sarpras Kesehatan</th>

                                        </tr>
                                        <tr>
                                            <th>1. TK/PAUD
                                                <input type="hidden" name="nama_data[]" value="tk">
                                            </th>
                                            <th class="p-0 g-0 ">
                                                <input type="number" class="form-control py-0 mt-0 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Unit</th>
                                            <th>1. Puskesmas
                                                <input type="hidden" name="nama_data[]" value="puskesmas">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem">
                                            </th>
                                            <th class="bg-light">Unit</th>
                                        </tr>
                                        <tr>
                                            <th>2. SD/MI
                                                <input type="hidden" name="nama_data[]" value="sd">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Unit</th>
                                            <th>2. Pustu
                                                <input type="hidden" name="nama_data[]" value="pustu">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem">
                                            </th>
                                            <th class="bg-light">Unit</th>
                                        </tr>
                                        <tr>
                                            <th>3. SMP/MTs
                                                <input type="hidden" name="nama_data[]" value="smp">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Unit</th>
                                            <th>3. Poskesdes
                                                <input type="hidden" name="nama_data[]" value="poskesdes">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem">
                                            </th>
                                            <th class="bg-light">Unit</th>
                                        </tr>
                                        <tr>
                                            <th>4. SMA/MA
                                                <input type="hidden" name="nama_data[]" value="sma">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Unit</th>
                                            <th>4. Posyandu
                                                <input type="hidden" name="nama_data[]" value="posyandu">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem">
                                            </th>
                                            <th class="bg-light">Unit</th>
                                        </tr>
                                        <tr>
                                            <th>5. Pondok Pesantren
                                                <input type="hidden" name="nama_data[]" value="ponpes">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Unit</th>
                                            <th>5. Polindes
                                                <input type="hidden" name="nama_data[]" value="polindes">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem">
                                            </th>
                                            <th class="bg-light">Unit</th>
                                        </tr>
                                        <tr style="background-color: lightgrey">
                                            <th colspan="3">Prasarana Ibadah</th>
                                            <th colspan="3">Prasarana Umum</th>
                                        </tr>
                                        <tr>
                                            <th>1. Mesjid
                                                <input type="hidden" name="nama_data[]" value="mesjid">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Buah</th>
                                            <th>1. Olahraga (gedung/lapangan)
                                                <input type="hidden" name="nama_data[]" value="olahraga">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem">
                                            </th>
                                            <th class="bg-light">Buah</th>
                                        </tr>
                                        <tr>
                                            <th>2. Mushola
                                                <input type="hidden" name="nama_data[]" value="mushola">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Buah</th>
                                            <th>2. Kesenian/Budaya
                                                <input type="hidden" name="nama_data[]" value="kesenian">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem">
                                            </th>
                                            <th class="bg-light">Buah</th>
                                        </tr>
                                        <tr>
                                            <th>3. Gereja
                                                <input type="hidden" name="nama_data[]" value="gereja">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Buah</th>
                                            <th>3. Balai Pertemuan
                                                <input type="hidden" name="nama_data[]" value="balai">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem">
                                            </th>
                                            <th class="bg-light">Buah</th>
                                        </tr>
                                        <tr>
                                            <th>4. Pura
                                                <input type="hidden" name="nama_data[]" value="pura">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Buah</th>
                                            <th>4. Sumur Desa
                                                <input type="hidden" name="nama_data[]" value="sumur">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem">
                                            </th>
                                            <th class="bg-light">Buah</th>
                                        </tr>
                                        <tr>
                                            <th>5. Vihara
                                                <input type="hidden" name="nama_data[]" value="vihara">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Buah</th>
                                            <th>5. Pasar Desa
                                                <input type="hidden" name="nama_data[]" value="pasar">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem">
                                            </th>
                                            <th class="bg-light">Buah</th>
                                        </tr>
                                        <tr>
                                            <th>6. Klenteng
                                                <input type="hidden" name="nama_data[]" value="klenteng">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Buah</th>
                                            <th>6. Lainnya
                                                <input type="hidden" name="nama_data[]" value="lainnya">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem">
                                            </th>
                                            <th class="bg-light">Buah</th>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="6" class="text-center">
                                                <button type="submit" class="btn btn-primary">Kirim Data</button>
                                            </th>
                                        </tr>
                                    </tfoot>

                                </table>
                            </form>
                        </div>
                    </div>
                    {{-- Akhir Form Sarpras --}}

                    {{-- Form Kelembagaan --}}
                    <div class="row {{ $jenis=='kelembagaan' ? '' : 'd-none' }}">
                        <div class="col-md-6">
                            <form action="/adminDesa/tambahDatumLembaga" method="post">
                                @csrf
                                <input type="hidden" name="tahun" value="{{ $tahun }}">
                                <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                <input type="hidden" name="jenis" value="{{ $jenis }}">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="3" class="bg-info">
                                                Silahkan Isi Data Kelembagaan Di bawah ini Dengan Data yang Terbaru dan
                                                Valid
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th width="60%">1. Pimpinan & anggota BPD
                                                <input type="hidden" name="nama_data[]" value="jumlah_bpd">
                                            </th>
                                            <th class="p-0 g-0 " width="30%">
                                                <input type="number"
                                                    class="form-control py-0 mt-0 px-2 border-0 text-center"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light" width="10%">Orang</th>

                                        </tr>
                                        <tr>
                                            <th width="60%">2. Pengurus & anggota LPM
                                                <input type="hidden" name="nama_data[]" value="jumlah_lpm">
                                            </th>
                                            <th class="p-0 g-0 " width="30%">
                                                <input type="number"
                                                    class="form-control py-0 mt-0 px-2 border-0 text-center"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light" width="10%">Orang</th>

                                        </tr>
                                        <tr>
                                            <th width="60%">3. Jumlah RT

                                            </th>
                                            <th class="p-0 g-0 " width="30%">
                                                <input type="number"
                                                    class="form-control py-0 mt-0 px-2 border-0 text-center"
                                                    style="font-size: .85rem" value="{{ $jumlah_rt }}" disabled>
                                            </th>
                                            <th class="bg-light" width="10%">Orang</th>

                                        </tr>
                                        <tr>
                                            <th>4. Pengurus & anggota PKK
                                                <input type="hidden" name="nama_data[]" value="jumlah_pkk">
                                            </th>
                                            <th class="p-0">
                                                <input type="number"
                                                    class="form-control py-0 pb-1 px-2 border-0 text-center"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Orang</th>

                                        </tr>
                                        <tr>
                                            <th>5. Pengurus & anggota Karang Taruna
                                                <input type="hidden" name="nama_data[]" value="jumlah_karang_taruna">
                                            </th>
                                            <th class="p-0">
                                                <input type="number"
                                                    class="form-control py-0 pb-1 px-2 border-0 text-center"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Orang</th>

                                        </tr>
                                        <tr>
                                            <th>6. Anggota Linmas
                                                <input type="hidden" name="nama_data[]" value="jumlah_linmas">
                                            </th>
                                            <th class="p-0">
                                                <input type="number"
                                                    class="form-control py-0 pb-1 px-2 border-0 text-center"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Orang</th>

                                        </tr>
                                        <tr>
                                            <th>7. Kader Posyandu
                                                <input type="hidden" name="nama_data[]" value="jumlah_kader">
                                            </th>
                                            <th class="p-0">
                                                <input type="number"
                                                    class="form-control py-0 pb-1 px-2 border-0 text-center"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Orang</th>

                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="6" class="text-center">
                                                <button type="submit" class="btn btn-primary">Kirim Data</button>
                                            </th>
                                        </tr>
                                    </tfoot>

                                </table>
                            </form>
                        </div>
                    </div>
                    {{-- End Form Kelembagaan --}}

                    {{-- Form Pekerjaan --}}
                    <div class="row {{ $jenis=='pekerjaan' ? '' : 'd-none' }}">
                        <div class="col-md-5">
                            <form action="/adminDesa/tambahDatumPekerjaan" method="post">
                                @csrf
                                <input type="hidden" name="tahun" value="{{ $tahun }}">
                                <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                <input type="hidden" name="jenis" value="{{ $jenis }}">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="3" class="bg-info">
                                                Silahkan Isi Data Pekerjaan / Mata Pencaharian Penduduk Tahun {{ $tahun
                                                }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th width="60%">1. TNI/POLRI
                                                <input type="hidden" name="nama_data[]" value="tni_polri">
                                            </th>
                                            <th class="p-0 g-0 " width="30%">
                                                <input type="number" class="form-control py-0 mt-0 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light" width="10%">Orang</th>

                                        </tr>
                                        <tr>
                                            <th width="60%">2. PNS/PPPK
                                                <input type="hidden" name="nama_data[]" value="pns">
                                            </th>
                                            <th class="p-0 g-0 " width="30%">
                                                <input type="number" class="form-control py-0 mt-0 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light" width="10%">Orang</th>

                                        </tr>
                                        <tr>
                                            <th>3. Karyawan/Pegawai Swasta
                                                <input type="hidden" name="nama_data[]" value="karyawan">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Orang</th>

                                        </tr>
                                        <tr>
                                            <th>4. Petani
                                                <input type="hidden" name="nama_data[]" value="petani">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Orang</th>

                                        </tr>
                                        <tr>
                                            <th>5. Buruh Tani
                                                <input type="hidden" name="nama_data[]" value="buruh_tani">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Orang</th>

                                        </tr>
                                        <tr>
                                            <th>6. Buruh Perusahaan
                                                <input type="hidden" name="nama_data[]" value="buruh_perusahaan">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Orang</th>

                                        </tr>
                                        <tr>
                                            <th>7. Pedagang/Jasa
                                                <input type="hidden" name="nama_data[]" value="pedagang">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Orang</th>

                                        </tr>
                                        <tr>
                                            <th>8. Peternak
                                                <input type="hidden" name="nama_data[]" value="peternak">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Orang</th>

                                        </tr>
                                        <tr>
                                            <th>9. Tukang / Kuli Bangunan
                                                <input type="hidden" name="nama_data[]" value="kuli">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Orang</th>

                                        </tr>
                                        <tr>
                                            <th>10. Lainnya
                                                <input type="hidden" name="nama_data[]" value="lainnya">
                                            </th>
                                            <th class="p-0">
                                                <input type="number" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Orang</th>

                                        </tr>
                                        <tr>
                                            <th>11. Tidak bekerja / Pengangguran
                                                <input type="hidden" name="nama_data[]" value="pengangguran">
                                            </th>
                                            <th class="p-0">
                                                <input type="text" class="form-control py-0 pb-1 px-2 border-0"
                                                    name="isidata[]" style="font-size: .85rem" autofocus>
                                            </th>
                                            <th class="bg-light">Orang</th>

                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="6" class="text-center">
                                                <button type="submit" class="btn btn-primary">Kirim Data</button>
                                            </th>
                                        </tr>
                                    </tfoot>

                                </table>
                            </form>
                        </div>
                    </div>
                    {{-- End Form Pekerjaan --}}

                    {{-- Form Papan Monografi --}}
                    <div class="row  {{ $jenis=='papan' ? '' : 'd-none' }}">
                        <div class="col-md-6 col-sm-12 mt-2">
                            <p class="alert bg-info text-dark">Silahkan Upload Foto Papan Monografi dengan Data Terbaru
                                Tahun {{ $tahun }}
                            </p>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah">Tambah
                                Foto</button>
                            <table class="table table-bordered">
                                <tr>
                                    <th>No</th>
                                    <th>Foto Papan Monografi</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="tambah" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Tambah Foto Papan
                                        Monografi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/tambahDatumPapan" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="jenis" value="{{ $jenis }}">
                                    <div class="modal-body">
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" name="papan_monografi" class="custom-file-input"
                                                    id="file_papan" aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label text-muted file_papan" for="file_papan">
                                                    File Image (max: 1MB)
                                                </label>
                                            </div>
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
                    {{-- End Form Papan Monografi --}}
                </div>

            </div>
        </div>
    </div>
</div>
</div>
@if(session()->has('kosong'))
<script>
    Swal.fire({
    position: 'center',
    icon: 'success',
    title: '{{ session("kosong") }}',
    showConfirmButton: true
})
</script>

@endif

{{-- notifikasi --}}
@if(session()->has('success'))
<script>
    Swal.fire({
    position: 'center',
    icon: 'success',
    title: '{{ session("success") }}',
    showConfirmButton: true
})
</script>

@endif

@if(session()->has('update'))
<script>
    Swal.fire({
  position: 'center',
  icon: 'success',
  title: '{{ session("update") }}',
  showConfirmButton: false,
  timer: 1500
})
</script>

@endif


@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script>
    bsCustomFileInput.init();

    $("#file_papan").change(function(event) {

getURL(this);
});

function getURL(input) {
if (input.files && input.files[0]) {
    var reader = new FileReader();
    var filename = $("#file_papan").val();
    
    filename = filename.substring(filename.lastIndexOf('\\') + 1);
    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    if (cekgb == 'png' || cekgb == 'PNG' || cekgb == 'jpg' || cekgb == 'JPG' || cekgb == 'jpeg' || cekgb == 'JPEG') {
        if(input.files[0]['size'] > 1024000){
            alert('ukuran file tidak boleh > 1 Mb !');
            $('#file_papan').val("");
            $('.file_papan').html("File Image (max: 1MB)");
        }else{
            
        }
        
    }else {
        alert ("file harus berjenis 'jpg, jpeg, png' ");
        $('#file_papan').val("");
        $('.file_papan').html("File Image (max: 1MB)");
        
    }
    
    
}

}
</script>

@endpush