@extends('templates.desa.main')

@section('content')
<div class="row justify-content-center mt-2 mb-4">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Data Akuntabilitas Kelembagaan</h5>
        <div class="x_panel">

            <div class="x_title">

                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formAkunkel" method="get">
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
                        Kelembagaan)</span></div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" role="tab">Kelembagaan

                        </a>
                    </li>

                </ul>

                <div class=" tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <form action="/adminDesa/tambahAkunkel" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                            <input type="hidden" name="tahun" value="{{ $tahun }}">

                            <div class="row akunwil">
                                <div class="col-md-9">
                                    <style>
                                        label {
                                            font-size: .75rem;
                                            overflow: hidden;
                                        }
                                    </style>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="bg-success">
                                                <th>No</th>
                                                <th>Nama Data</th>
                                                <th>Upload Dokumen / Foto</th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <td>1</td>
                                            <th>
                                                Peraturan Desa Tentang Struktur Organisasi dan
                                                Tatakerja (SOTK) Pemerintah Desa
                                                <input type="hidden" name="nama_data[]" value="sotk">
                                            </th>
                                            <th>
                                                <div class="custom-file">
                                                    <input type="file" name="upload_sotk" class="custom-file-input"
                                                        id="upload_sotk">
                                                    <label class="custom-file-label text-muted upload_sotk"
                                                        for="upload_sotk">Choose
                                                        file PDF
                                                        (max-size: 1MB)</label>
                                                </div>
                                            </th>
                                        </tr>

                                        <tr>
                                            <th>2</th>
                                            <th>
                                                SK Lembaga Pemberdayaan Masyarakat (LPM)
                                                <input type="hidden" name="nama_data[]" value="sklpm">
                                            </th>
                                            <th>
                                                <div class="custom-file">
                                                    <input type="file" name="upload_sklpm" class="custom-file-input"
                                                        id="upload_sklpm">
                                                    <label class="custom-file-label text-muted upload_sklpm"
                                                        for="upload_batas_utara">Choose
                                                        file PDF
                                                        (max-size: 1MB)</label>
                                                </div>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th>3</th>
                                            <th>
                                                SK Karang Taruna
                                                <input type="hidden" name="nama_data[]" value="sktaruna">
                                            </th>
                                            <th>
                                                <div class="custom-file">
                                                    <input type="file" name="upload_sktaruna" class="custom-file-input"
                                                        id="upload_sktaruna">
                                                    <label class="custom-file-label text-muted upload_sktaruna"
                                                        for="upload_sktaruna">Choose
                                                        file PDF
                                                        (max-size: 1MB)</label>
                                                </div>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th>4</th>
                                            <th>
                                                SK Perlindungan Masyarakat (Linmas)
                                                <input type="hidden" name="nama_data[]" value="sklinmas">
                                            </th>
                                            <th>
                                                <div class="custom-file">
                                                    <input type="file" name="upload_linmas" class="custom-file-input"
                                                        id="upload_linmas">
                                                    <label class="custom-file-label text-muted upload_linmas"
                                                        for="upload_linmas">Choose
                                                        file PDF
                                                        (max-size: 1MB)</label>
                                                </div>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th>5</th>
                                            <th>
                                                SK Kepengurusan PKK
                                                <input type="hidden" name="nama_data[]" value="skpkk">
                                            </th>
                                            <th>
                                                <div class="custom-file">
                                                    <input type="file" name="upload_pkk" class="custom-file-input"
                                                        id="upload_pkk">
                                                    <label class="custom-file-label text-muted upload_pkk"
                                                        for="upload_pkk">Choose
                                                        file PDF
                                                        (max-size: 1MB)</label>
                                                </div>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th>6</th>
                                            <th>
                                                Foto Kantor Desa
                                                <input type="hidden" name="nama_data[]" value="kantor_desa">
                                            </th>
                                            <th>
                                                <div class="custom-file">
                                                    <input type="file" name="upload_kantor_desa"
                                                        class="custom-file-input" id="upload_kantor_desa">
                                                    <label class="custom-file-label text-muted upload_kantor_desa"
                                                        for="upload_kantor_desa">Choose
                                                        file Image
                                                        (max-size: 1MB)</label>
                                                </div>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th>7</th>
                                            <th>
                                                Foto Papan Struktur Organisasi Pemerintah Desa
                                                <input type="hidden" name="nama_data[]" value="papan_struktur">

                                            </th>
                                            <th>
                                                <div class="custom-file">
                                                    <input type="file" name="upload_papan_struktur"
                                                        class="custom-file-input" id="upload_papan_struktur">
                                                    <label class="custom-file-label text-muted upload_papan_struktur"
                                                        for="upload_papan_struktur">Choose
                                                        file Image
                                                        (max-size: 1MB)</label>
                                                </div>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th>8</th>
                                            <th>
                                                Foto Kantor/Sekretariat BPD
                                                <input type="hidden" name="nama_data[]" value="kantor_bpd">
                                            </th>
                                            <th>
                                                <div class="custom-file">
                                                    <input type="file" name="upload_kantor_bpd"
                                                        class="custom-file-input" id="upload_kantor_bpd">
                                                    <label class="custom-file-label text-muted upload_kantor_bpd"
                                                        for="upload_kantor_bpd">Choose
                                                        file Image
                                                        (max-size: 1MB)</label>
                                                </div>
                                            </th>

                                        </tr>



                                    </table>
                                    <p class="text-primary">Catatan : <br>
                                        - Silahkan Upload dokumen/foto yang ada terlebih dahulu, dokumen lain dapat
                                        disusulkan kemudian melalui form update</p>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group row justify-content-end">
                                <div class="col-md-8">
                                    <button type=" button" class="btn btn-primary">Cancel</button>
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
<script src="/js/akunKel.js"></script>
@endpush