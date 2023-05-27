@extends('templates.desa.main')

@section('content')
<div class="row justify-content-center mt-2  mb-4">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Data Akuntabilitas Administrasi Umum</h5>
        <div class="x_panel">

            <div class="x_title">

                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formAkunadum" method="get">
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
                        Administrasi Umum)</span></div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" role="tab">Administrasi Umum

                        </a>
                    </li>

                </ul>

                <div class=" tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <form action="/adminDesa/tambahAkunadum" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                            <input type="hidden" name="tahun" value="{{ $tahun }}">

                            <div class="row akunwil">
                                <div class="col-md-8">
                                    <p class="alert alert-success">Form Input Data Administrasi Umum Tahun {{ $tahun }}
                                    </p>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="bg-info">
                                                <th width="5%">No</th>
                                                <th width="50%">Nama Data</th>
                                                <th width="45%">Upload Data/Dokumen</th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <th>1</th>
                                            <th>
                                                Buku Surat Masuk / Keluar
                                                <input type="hidden" name="nama_data[]" value="surat">
                                            </th>
                                            <th>
                                                <div class="custom-file">
                                                    <input type="file" name="upload_surat" class="custom-file-input"
                                                        id="upload_surat">
                                                    <label class="custom-file-label text-muted upload_surat"
                                                        for="upload_surat" style="font-size: .8rem">Choose
                                                        file PDF
                                                        (max-size: 5 MB)</label>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>2</th>
                                            <th>
                                                Daftar Hadir Perangkat Semester 1 <br>
                                                <small><i>- Rekap Kehadiran Per-Bulan (Januari s.d Juni)</i></small>
                                                <input type="hidden" name="nama_data[]" value="daftar_hadir">
                                            </th>
                                            <th>
                                                <div class="custom-file">
                                                    <input type="file" name="upload_daftar_hadir"
                                                        class="custom-file-input" id="upload_daftar_hadir">
                                                    <label class="custom-file-label text-muted upload_daftar_hadir"
                                                        for="upload_daftar_hadir" style="font-size: .8rem">Choose
                                                        file PDF
                                                        (max-size: 5 MB)</label>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>3</th>
                                            <th>
                                                Daftar Hadir Perangkat Semester 2 <br>
                                                <small><i>- Rekap Kehadiran Per-Bulan (Juli s.d Desember)</i></small>
                                                <input type="hidden" name="nama_data[]" value="daftar_hadir2">
                                            </th>
                                            <th>
                                                <div class="custom-file">
                                                    <input type="file" name="upload_daftar_hadir2"
                                                        class="custom-file-input" id="upload_daftar_hadir2">
                                                    <label class="custom-file-label text-muted upload_daftar_hadir2"
                                                        for="upload_daftar_hadir2" style="font-size: .8rem">Choose
                                                        file PDF
                                                        (max-size: 5 MB)</label>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>4</th>
                                            <th>
                                                Buku Register Peraturan Desa, Peraturan
                                                Kepala Desa & Surat Keputusan
                                                <input type="hidden" name="nama_data[]" value="buku_register">
                                            </th>
                                            <th>

                                                <div class="custom-file">
                                                    <input type="file" name="upload_buku_register"
                                                        class="custom-file-input" id="upload_buku_register">
                                                    <label class="custom-file-label text-muted upload_buku_register"
                                                        for="upload_buku_register" style="font-size: .8rem">Choose
                                                        file PDF
                                                        (max-size: 2 MB)</label>
                                                </div>

                                            </th>
                                        </tr>
                                        <tr>
                                            <th>5</th>
                                            <th>
                                                Buku Rekap Kependudukan
                                                <input type="hidden" name="nama_data[]" value="rekap_penduduk">
                                            </th>
                                            <th>

                                                <div class="custom-file">
                                                    <input type="file" name="upload_rekap_penduduk"
                                                        class="custom-file-input" id="upload_rekap_penduduk">
                                                    <label class="custom-file-label text-muted upload_rekap_penduduk"
                                                        for="upload_rekap_penduduk" style="font-size: .8rem">Choose
                                                        file PDF
                                                        (max-size: 5 MB)</label>
                                                </div>

                                            </th>
                                        </tr>
                                    </table>
                                    <p class="text-primary">Catatan : <br>
                                        - Silahkan Upload dokumen yang ada terlebih dahulu, dokumen lain dapat
                                        disusulkan kemudian melalui form update</p>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group row justify-content-center">
                                <div class="col-md-5 col-sm-5">
                                    <button type="button" class="btn btn-primary">Cancel</button>
                                    <button type="reset" class="btn btn-primary">Reset</button>
                                    <button type="submit" class="btn btn-success">Kirim Data</button>
                                </div>
                            </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bs-custom-file-input/1.1.1/bs-custom-file-input.min.js"
    integrity="sha512-LGq7YhCBCj/oBzHKu2XcPdDdYj6rA0G6KV0tCuCImTOeZOV/2iPOqEe5aSSnwviaxcm750Z8AQcAk9rouKtVSg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    bsCustomFileInput.init();
</script>
<script src="/js/adum.js"></script>
@endpush