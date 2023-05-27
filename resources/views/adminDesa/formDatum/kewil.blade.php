@extends('templates.desa.main')

@section('content')

<div class="row mb-4 ">
    <div class="col-md-10">
        {{-- FORM INPUT DATA KEWILAYAHAN --}}
        <table class="table table-striped {{ count($kewilayahan)>0 ? 'd-none' : '' }}" style="font-size: .8rem">
            <thead>
                <tr class="table-info">
                    <td colspan="2">SILAHKAN INPUT DATA KEWILAYAHAN</td>
                </tr>
            </thead>
            <tbody>
                <form action="/adminDesa/tambahDatumWil" method="post">
                    @csrf
                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                    <input type="hidden" name="jenis" value="kewilayahan">

                    <tr>
                        <td>
                            <label for="dasar" class="col-form-label">1. Dasar Hukum Pembentukan
                                Desa</label>
                            <input type="hidden" name="nama_data[]" value="dasar_hukum">
                        </td>
                        <td>
                            <textarea class="form-control" name="isidata[]" id="dasar" rows="2" style="font-size: .9rem"
                                autofocus></textarea>

                        </td>

                    </tr>
                    <tr>
                        <td>
                            <label for="wilayah" class="col-form-label">2. Luas Wilayah</label>
                            <input type="hidden" name="nama_data[]" value="luas_wilayah">

                        </td>
                        <td class="d-flex"><input type="text" class="form-control" name="isidata[]" required>
                            <span class="input-group-text" id="wilayah" style="font-size: .9rem">Km2</span>
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
                            <textarea name="isidata[]" class="form-control" id="utara" rows="2" style="font-size: .9rem"
                                required>
                            </textarea>
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
                                style="font-size: .9rem" required></textarea>
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
                            <textarea name="isidata[]" class="form-control" id="barat" rows="2" style="font-size: .9rem"
                                required></textarea>
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
                        <td><textarea name="isidata[]" class="form-control" id="timur" rows="2" style="font-size: .9rem"
                                required></textarea>
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
                        <td class="d-flex"><input type="number" name="isidata[]" id="dusun" class="form-control"
                                style="font-size: .9rem" required>
                            <span class="input-group-text" style="font-size: .9rem">Dusun</span>
                            @error('isidata[6]')
                            <small class="text-danger">jumlah dusun harus diisi</small>
                            @enderror
                        </td>

                    </tr>
                    <tr>
                        <td>
                            8. Jumlah RT
                            <input type="hidden" name="nama_data[]" value="jumlah_rt">
                        </td>
                        <td class="d-flex">
                            <input type="number" name="isidata[]" class="form-control" style="font-size: .9rem"
                                required> <span class="input-group-text" style="font-size: .9rem">Rukun
                                Tetangga</span>
                            @error('isidata[7]')
                            <small class="text-danger">jumlah RT harus diisi</small>
                            @enderror
                        </td>

                    </tr>
                    <tr>
                        <td>
                            9. Jumlah Pimpinan dan Anggota BPD
                            <input type="hidden" name="nama_data[]" value="jumlah_bpd">
                        </td>
                        <td class="d-flex">
                            <input type="number" name="isidata[]" class="form-control" style="font-size: .9rem"
                                required>
                            <span class="input-group-text" style="font-size: .9rem">Orang</span>
                            @error('isidata[8]')
                            <small class="text-danger">jumlah anggota dprd harus diisi</small>
                            @enderror
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
{{-- FORM UPDATE DATA KEWILAYAHAN --}}
<table class="table table-striped {{ count($kewilayahan)>0 ? '' : 'd-none' }}" style="font-size: .8rem">
    <thead>
        <tr class="table-info">
            <td colspan="2">SILAHKAN UPDATE DATA KEWILAYAHAN TAHUN {{ $tahun }} JIKA ADA
                PERUBAHAN</td>
        </tr>
    </thead>
    <tbody>
        <form action="/adminDesa/updateDatumWil" method="post">
            @csrf
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
            <input type="hidden" name="jenis" value="kewilayahan">


            <tr>
                <td>
                    <label for="dasar" class="col-form-label">1. Dasar Hukum Pembentukan
                        Desa</label>
                    <input type="hidden" name="nama_data[]" value="dasar_hukum">
                </td>
                <td>
                    <textarea class="form-control" name="isidata[]" id="dasar" rows="2" style="font-size: .9rem"
                        autofocus>{{ $kewilayahan[0]->isidata }}</textarea>

                </td>

            </tr>
            <tr>
                <td>
                    <label for="wilayah" class="col-form-label">2. Luas Wilayah</label>
                    <input type="hidden" name="nama_data[]" value="luas_wilayah">

                </td>
                <td class="d-flex"><input type="text" class="form-control" name="isidata[]"
                        value="{{ old('isidata[1]', $kewilayahan[1]->isidata) }}" required>
                    <span class="input-group-text" id="wilayah" style="font-size: .9rem">Km2</span>

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
                    <textarea name="isidata[]" class="form-control" id="utara" rows="2" style="font-size: .9rem"
                        required>{{ old('isidata[2]', $kewilayahan[2]->isidata) }}
                    </textarea>

                </td>

            </tr>
            <tr>
                <td>
                    <label for="selatan" class="col-form-label">4. Sebelah Selatan
                        berbatasan dengan</label>
                    <input type="hidden" name="nama_data[]" value="batas_selatan">
                </td>
                <td>
                    <textarea name="isidata[]" class="form-control" id="selatan" rows="2" style="font-size: .9rem"
                        required>{{ old('isidata[3]', $kewilayahan[3]->isidata) }}</textarea>

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
                    <textarea name="isidata[]" class="form-control" id="barat" rows="2" style="font-size: .9rem"
                        required>{{ old('isidata[4]', $kewilayahan[4]->isidata) }}</textarea>


                </td>

            </tr>
            <tr>
                <td>
                    <label for="timur" class="col-form-label">6. Sebelah Timur
                        berbatasan
                        dengan</label>
                    <input type="hidden" name="nama_data[]" value="batas_timur">
                </td>
                <td><textarea name="isidata[]" class="form-control" id="timur" rows="2" style="font-size: .9rem"
                        required>{{ old('isidata[5]', $kewilayahan[5]->isidata) }}</textarea>


                </td>

            </tr>
            <tr>
                <td>
                    <label for="dusun" class="col-form-label">7. Jumlah Dusun</label>
                    <input type="hidden" name="nama_data[]" value="jumlah_dusun">
                </td>
                <td class="d-flex"><input type="number" name="isidata[]" id="dusun" class="form-control"
                        style="font-size: .9rem" value="{{ old('isidata[6]', $kewilayahan[6]->isidata) }}" required>
                    <span class="input-group-text" style="font-size: .9rem">Dusun</span>

                </td>

            </tr>
            <tr>
                <td>
                    8. Jumlah RT
                    <input type="hidden" name="nama_data[]" value="jumlah_rt">
                </td>
                <td class="d-flex">
                    <input type="number" name="isidata[]" class="form-control" style="font-size: .9rem"
                        value="{{ old('isidata[7]', $kewilayahan[7]->isidata) }}" required> <span
                        class="input-group-text" style="font-size: .9rem">Rukun
                        Tetangga</span>

                </td>

            </tr>
            <tr>
                <td>
                    9. Jumlah Pimpinan dan Anggota BPD
                    <input type="hidden" name="nama_data[]" value="jumlah_bpd">
                </td>
                <td class="d-flex">
                    <input type="number" name="isidata[]" class="form-control" style="font-size: .9rem"
                        value="{{ old('isidata[8]', $kewilayahan[8]->isidata) }}" required>
                    <span class="input-group-text" style="font-size: .9rem">Orang</span>

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
<div class="tab-pane fade show active" id="kependudukan" role="tabpanel" aria-labelledby="kependudukan-tab">
    {{-- Form Tambah Data Kependudukan --}}
    <form action="/adminDesa/tambahDatumDuk" method="post" class="{{ count($kependudukan)>0 ? 'd-none' : ''
    }}">
        @csrf
        <input type="hidden" name="tahun" value="{{ $tahun }}">
        <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
        <input type="hidden" name="jenis" value="kependudukan">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="6" class="bg-info">
                        Silah Isi Data Kependudukan Di bawah ini Dengan Data yang Terbaru dan Valid
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>1. Jumlah penduduk
                        <input type="hidden" name="nama_data[]" value="jumlah_penduduk">
                    </th>
                    <th class="p-0 g-0 ">
                        <input type="number" class="form-control py-0 mt-0 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" autofocus>
                    </th>
                    <th class="bg-light">Jiwa</th>
                    <th>2. Jumlah Kepala Keluarga
                        <input type="hidden" name="nama_data[]" value="jumlah_kk">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem">
                    </th>
                    <th class="bg-light">KK</th>
                </tr>
                <tr>
                    <th>3. Penduduk laki-laki
                        <input type="hidden" name="nama_data[]" value="jumlah_penduduk_l">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" autofocus>
                    </th>
                    <th class="bg-light">Orang</th>
                    <th>4. Penduduk Perempuan
                        <input type="hidden" name="nama_data[]" value="jumlah_penduduk_p">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem">
                    </th>
                    <th class="bg-light">Orang</th>
                </tr>
                <tr>
                    <th>5. Usia 0-15 tahun
                        <input type="hidden" name="nama_data[]" value="usia_0_15">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" autofocus>
                    </th>
                    <th class="bg-light">Orang</th>
                    <th>6. Usia 15-65 tahun
                        <input type="hidden" name="nama_data[]" value="usia_15_65">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem">
                    </th>
                    <th class="bg-light">Orang</th>
                </tr>
                <tr>
                    <th>6. Usia > 65 tahun
                        <input type="hidden" name="nama_data[]" value="usia_65_keatas">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" autofocus>
                    </th>
                    <th class="bg-light">Orang</th>
                    <th>7. Jumlah Penduduk Miskin
                        <input type="hidden" name="nama_data[]" value="penduduk_miskin">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem">
                    </th>
                    <th class="bg-light">Jiwa</th>
                </tr>
                <tr>
                    <th>8. Jumlah KK Miskin
                        <input type="hidden" name="nama_data[]" value="kk_miskin">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" autofocus>
                    </th>
                    <th class="bg-light">KK</th>
                    <th>9. Jumlah Penerima BLT DD
                        <input type="hidden" name="nama_data[]" value="penerima_blt_dd">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem">
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
<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
    xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.
    Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four
    loko farm-to-table craft beer twee. Qui photo
    booth letterpress, commodo enim craft beer mlkshk
</div>



<!-- Smart Wizard -->
<p class="text-center">Progress Input Data Umum SIMONDES Tahun {{ now()->format('Y') }}</p>
<div id="wizard" class="form_wizard wizard_horizontal">
    <ul class="wizard_steps">
        <li>
            <a href="#step-1">
                <span class="step_no">1</span>
                <span class="step_descr">
                    Step 1<br />
                    <small>Input Data Kewilayahan</small>
                </span>
            </a>
        </li>
        <li>
            <a href="#step-2">
                <span class="step_no">2</span>
                <span class="step_descr">
                    Step 2<br />
                    <small>Input Data Perangkat</small>
                </span>
            </a>
        </li>
        <li>
            <a href="#step-3">
                <span class="step_no">3</span>
                <span class="step_descr">
                    Step 3<br />
                    <small>Input Data Dokumen Perencanaan</small>
                </span>
            </a>
        </li>
        <li>
            <a href="#step-4">
                <span class="step_no">4</span>
                <span class="step_descr">
                    Step 4<br />
                    <small>Input Data APBDes Tahun {{ now()->format('Y') }}</small>
                </span>
            </a>
        </li>
        <li>
            <a href="#step-4">
                <span class="step_no">5</span>
                <span class="step_descr">
                    Step 5<br />
                    <small>Input Data Profil</small>
                </span>
            </a>
        </li>
    </ul>

</div>
<hr>
<!-- End SmartWizard Content -->

<div class="row justify-content-center mb-4 ">
    <div class="col-md-8">
        <table class="table table-striped " style="font-size: .9rem">
            <thead>
                <tr>
                    <th colspan="2" class="text-center bg-blue">FORM DATA KEWILAYAHAN</th>
                </tr>
            </thead>
            <tbody>
                <form action="/adminDesa/tambahDatumWil" method="post">
                    @csrf
                    <tr>
                        <td colspan="2">
                            A. ASAL-USUL DAN KEWILAYAHAN
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <label for="dasar" class="col-form-label">Dasar Hukum Pembentukan Desa</label>
                        </td>
                        <td>
                            <textarea class="form-control" name="dasar_hukum" id="dasar" rows="2"
                                style="font-size: .9rem" autofocus></textarea>
                        </td>

                    </tr>
                    <tr>
                        <td><label for="wilayah" class="col-form-label">Luas Wilayah</label></td>
                        <td class="d-flex"><input type="text" class="form-control" name="luas" required>
                            <span class="input-group-text" id="wilayah" style="font-size: .9rem">Km2</span>
                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">

                        </td>

                    </tr>
                    <tr>
                        <td><label for="utara" class="col-form-label">Sebelah Utara berbatasan dengan</label></td>
                        <td><textarea name="batas_utara" class="form-control" id="utara" rows="2"
                                style="font-size: .9rem" required></textarea></td>

                    </tr>
                    <tr>
                        <td><label for="selatan" class="col-form-label">Sebelah Selatan berbatasan dengan</label></td>
                        <td><textarea name="batas_selatan" class="form-control" id="selatan" rows="2"
                                style="font-size: .9rem" required></textarea></td>

                    </tr>
                    <tr>
                        <td><label for="barat" class="col-form-label">Sebelah Barat berbatasan dengan</label></td>
                        <td><textarea name="batas_barat" class="form-control" id="barat" rows="2"
                                style="font-size: .9rem" required></textarea></td>

                    </tr>
                    <tr>
                        <td><label for="timur" class="col-form-label">Sebelah Timur berbatasan dengan</label></td>
                        <td><textarea name="batas_timur" class="form-control" id="timur" rows="2"
                                style="font-size: .9rem" required></textarea></td>

                    </tr>
                    <tr>
                        <td><label for="dusun" class="col-form-label">Jumlah Dusun</label></td>
                        <td class="d-flex"><input type="number" name="jumlah_dusun" id="dusun" class="form-control"
                                style="font-size: .9rem" required>
                            <span class="input-group-text" style="font-size: .9rem">Dusun</span>
                        </td>

                    </tr>
                    <tr>
                        <td>Jumlah RT</td>
                        <td class="d-flex">
                            <input type="number" name="jumlah_rt" class="form-control" style="font-size: .9rem"
                                required> <span class="input-group-text" style="font-size: .9rem">Rukun
                                Tetangga</span>
                        </td>

                    </tr>
                    <tr>
                        <td>Jumlah Pimpinan dan Anggota BPD</td>
                        <td class="d-flex">
                            <input type="number" name="jumlah_bpd" class="form-control" style="font-size: .9rem"
                                required> <span class="input-group-text" style="font-size: .9rem">Orang</span>
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


@endsection