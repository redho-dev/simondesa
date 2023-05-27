@extends('templates.desa.main')

@section('content')
<div class="clearfix"></div>
<div class="row justify-content-center mt-2 mb-4">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Data Akuntabilitas Kewilayahan</h5>
        <div class="x_panel">

            <div class="x_title">

                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formAkunwil" method="get">
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
                <div>Tahun Data : {{ $tahun }} &emsp; &emsp; <span class="text-info">(Form Input Data Akuntabilitas
                        Kewilayahan)</span></div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" role="tab">Kewilayahan

                        </a>
                    </li>

                </ul>

                <div class=" tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <form action="/adminDesa/tambahAkunwil" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                            <input type="hidden" name="tahun" value="{{ $tahun }}">

                            <div class="row akunwil">
                                <div class="col-md-8">
                                    <table class="table table-bordered">
                                        <thead class="bg-info">
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="60%">Nama Data</th>
                                                <th width="35%" class="text-center">Upload Dokumen/Foto</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Dokumen Dasar Hukum Pembentukan Desa</td>
                                                <td>
                                                    <div class="custom-file">
                                                        <input type="hidden" name="nama_data[]" value="dasar_hukum">
                                                        <input type="file" name="upload_dasar_hukum"
                                                            class="custom-file-input" id="upload_dasar_hukum"
                                                            style="font-size: .8rem">
                                                        <label class="custom-file-label text-muted upload_dasar_hukum"
                                                            for="upload_dasar_hukum" style="font-size: .75rem">Choose
                                                            file PDF
                                                            (max-size: 1MB)</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Pilar Batas Desa (Utara)</td>
                                                <td>
                                                    <div class="custom-file">
                                                        <input type="hidden" name="nama_data[]"
                                                            value="patok_batas_utara">
                                                        <input type="file" name="upload_batas_utara"
                                                            class="custom-file-input" id="upload_batas_utara"
                                                            style="font-size: .8rem">
                                                        <label class="custom-file-label text-muted upload_batas_utara"
                                                            for="upload_batas_utara" style="font-size: .75rem">Choose
                                                            file Image
                                                            (max-size: 1MB)</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Pilar Batas Desa (Selatan)</td>
                                                <td>
                                                    <div class="custom-file">
                                                        <input type="hidden" name="nama_data[]"
                                                            value="patok_batas_selatan">
                                                        <input type="file" name="upload_batas_selatan"
                                                            class="custom-file-input" id="upload_batas_selatan"
                                                            style="font-size: .8rem">
                                                        <label class="custom-file-label text-muted upload_batas_selatan"
                                                            for="upload_batas_selatan" style="font-size: .75rem">Choose
                                                            file Image
                                                            (max-size: 1MB)</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Pilar Batas Desa (Barat)</td>
                                                <td>
                                                    <div class="custom-file">
                                                        <input type="hidden" name="nama_data[]"
                                                            value="patok_batas_barat">
                                                        <input type="file" name="upload_batas_barat"
                                                            class="custom-file-input" id="upload_batas_barat"
                                                            style="font-size: .8rem">
                                                        <label class="custom-file-label text-muted upload_batas_barat"
                                                            for="upload_batas_barat" style="font-size: .75rem">Choose
                                                            file Image
                                                            (max-size: 1MB)</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Pilar Batas Desa (Timur)</td>
                                                <td>
                                                    <div class="custom-file">
                                                        <input type="hidden" name="nama_data[]"
                                                            value="patok_batas_timur">
                                                        <input type="file" name="upload_batas_timur"
                                                            class="custom-file-input" id="upload_batas_timur"
                                                            style="font-size: .8rem">
                                                        <label class="custom-file-label text-muted upload_batas_timur"
                                                            for="upload_batas_timur" style="font-size: .75rem">Choose
                                                            file Image
                                                            (max-size: 1MB)</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Peta Batas Desa</td>
                                                <td>
                                                    <div class="custom-file">
                                                        <input type="hidden" name="nama_data[]" value="peta_batas">
                                                        <input type="file" name="upload_peta_batas"
                                                            class="custom-file-input" id="upload_peta_batas"
                                                            style="font-size: .8rem">
                                                        <label class="custom-file-label text-muted upload_peta_batas"
                                                            for="upload_peta_batas" style="font-size: .75rem">Choose
                                                            file Image
                                                            (max-size: 1MB)</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2">
                                                    <small>
                                                        Petunjuk Pengisian : <br>
                                                        1 : Silahkan upload dokumen (pdf) Peraturan Daerah atau
                                                        legalitas terbentuknya desa <br>
                                                        2-5 : Silahkan upload foto salah satu pilar batas utara,
                                                        selatan, timur dan barat <br>
                                                        6 : Silahkan upload foto peta batas desa yang berkoordinat
                                                        sesuai standar BIG, jika belum ada silahkan upload foto
                                                        sket/denah desa <br>
                                                        Regulasi Terkait : <br>
                                                        - <a href="">Permendagri No 45 Tahun 2016 tentang Pedoman
                                                            Penetapan dan Penegasan batas Desa</a> <br>
                                                        - <a href="">Peraturan BIG No.3 Tahun 2016 Tentang Spesifikasi
                                                            Teknis Penyajian Peta Desa</a>


                                                    </small>
                                                </td>
                                                <td class="text-center ">
                                                    <button type="submit" class="btn btn-primary mt-4">Kirim
                                                        Data</button>
                                                </td>
                                            </tr>
                                        </tfoot>





                                        {{-- <tr>
                                            <th width="60%">
                                                <div class="form-group">
                                                    <label for="dasarhukum">Dasar Hukum Pembentukan Desa </label>
                                                    <input type="text" class="form-control" id="dasarhukum"
                                                        value="{{ $dawil[0]->isidata }}" style="font-size: .85rem"
                                                        readonly>
                                                    <input type="hidden" name="nama_data[]" value="dasar_hukum">


                                                </div>

                                            </th>
                                            <th>
                                                <div class="form-group">
                                                    <label for="upload_dasar_hukum">Upload Dokumen Dasar Hukum (jika
                                                        ada)</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="upload_dasar_hukum"
                                                            class="custom-file-input" id="upload_dasar_hukum">
                                                        <label class="custom-file-label text-muted upload_dasar_hukum"
                                                            for="upload_dasar_hukum">Choose
                                                            file PDF
                                                            (max-size: 1MB)</label>
                                                    </div>

                                                </div>

                                            </th>

                                        </tr>

                                        <tr>

                                            <th>
                                                <div class="form-group">
                                                    <label for="batas_utara">Batas Utara</label>
                                                    <input type="text" class="form-control" id="batas_utara"
                                                        value="{{ $dawil[2]->isidata }}" style="font-size: .85rem"
                                                        readonly>
                                                    <input type="hidden" name="nama_data[]" value="patok_batas_utara">

                                                </div>

                                            </th>
                                            <th>
                                                <div class="form-group">
                                                    <label for="upload_batas_utara">Upload Salah Satu Foto Patok Batas
                                                        Utara
                                                        (jika
                                                        ada)</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="upload_batas_utara"
                                                            class="custom-file-input" id="upload_batas_utara">
                                                        <label class="custom-file-label text-muted upload_batas_utara"
                                                            for="upload_batas_utara">Choose
                                                            file Image
                                                            (max-size: 1MB)</label>
                                                    </div>

                                                </div>

                                            </th>

                                        </tr>
                                        <tr>

                                            <th>
                                                <div class="form-group">
                                                    <label for="batas_selatan">Batas Selatan</label>
                                                    <input type="text" class="form-control" id="batas_selatan"
                                                        value="{{ $dawil[3]->isidata }}" style="font-size: .85rem"
                                                        readonly>
                                                    <input type="hidden" name="nama_data[]" value="patok_batas_selatan">

                                                </div>

                                            </th>
                                            <th>
                                                <div class="form-group">
                                                    <label for="upload_batas_selatan">Upload Salah Satu Foto Patok Batas
                                                        Selatan
                                                        (jika
                                                        ada)</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="upload_batas_selatan"
                                                            class="custom-file-input" id="upload_batas_selatan">
                                                        <label class="custom-file-label text-muted upload_batas_selatan"
                                                            for="upload_batas_selatan">Choose
                                                            file Image
                                                            (max-size: 1MB)</label>
                                                    </div>

                                                </div>

                                            </th>

                                        </tr>
                                        <tr>

                                            <th>
                                                <div class="form-group">
                                                    <label for="batas_barat">Batas Barat</label>
                                                    <input type="text" class="form-control" id="batas_barat"
                                                        value="{{ $dawil[4]->isidata }}" style="font-size: .85rem"
                                                        readonly>
                                                    <input type="hidden" name="nama_data[]" value="patok_batas_barat">

                                                </div>

                                            </th>
                                            <th>
                                                <div class="form-group">
                                                    <label for="upload_batas_barat">Upload Salah Satu Foto Patok Batas
                                                        Barat
                                                        (jika
                                                        ada)</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="upload_batas_barat"
                                                            class="custom-file-input" id="upload_batas_barat">
                                                        <label class="custom-file-label text-muted upload_batas_barat"
                                                            for="upload_batas_barat">Choose
                                                            file Image
                                                            (max-size: 1MB)</label>
                                                    </div>

                                                </div>

                                            </th>

                                        </tr>
                                        <tr>

                                            <th>
                                                <div class="form-group">
                                                    <label for="batas_timur">Batas Timur</label>
                                                    <input type="text" class="form-control" id="batas_timur"
                                                        value="{{ $dawil[4]->isidata }}" style="font-size: .85rem"
                                                        readonly>
                                                    <input type="hidden" name="nama_data[]" value="patok_batas_timur">

                                                </div>

                                            </th>
                                            <th>
                                                <div class="form-group">
                                                    <label for="upload_batas_timur">Upload Salah Satu Foto Patok Batas
                                                        Timur
                                                        (jika
                                                        ada)</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="upload_batas_timur"
                                                            class="custom-file-input" id="upload_batas_timur">
                                                        <label class="custom-file-label text-muted upload_batas_timur"
                                                            for="upload_batas_timur">Choose
                                                            file Image
                                                            (max-size: 1MB)</label>
                                                    </div>

                                                </div>

                                            </th>

                                        </tr>
                                        <tr>
                                            <th>
                                                <input type="hidden" name="nama_data[]" value="peta_batas">

                                            </th>
                                            <th>
                                                <div class="form-group">
                                                    <label for="upload_peta_batas">Upload Peta Batas/Sket/Gambar/Denah
                                                        Desa</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="upload_peta_batas"
                                                            class="custom-file-input" id="upload_peta_batas">
                                                        <label class="custom-file-label text-muted upload_peta_batas"
                                                            for="upload_peta_batas">Choose
                                                            file Image
                                                            (max-size: 5MB)</label>
                                                    </div>
                                            </th>

                                        </tr> --}}


                                    </table>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            {{-- <div class="form-group row justify-content-center">
                                <div class="col-md-7 col-sm-7">
                                    <button type="button" class="btn btn-info">Cancel</button>
                                    <button type="reset" class="btn btn-info">Reset</button>
                                    <button type="submit" class="btn btn-primary">Kirim Data</button>
                                </div>
                            </div> --}}
                        </form>
                    </div>
                </div>

            </div>
            <br><br><br>
        </div>
    </div>
</div>
<br>
<br>
@endsection
@push('script')
<script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    bsCustomFileInput.init();
</script>
<script src="/js/akunwil.js"></script>
@endpush