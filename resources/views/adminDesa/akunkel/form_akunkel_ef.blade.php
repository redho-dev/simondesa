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
                    <button type="button" class="btn btn-primary ml-auto btn-sm" data-toggle="modal"
                        data-target="#copyAkunkel">
                        Copy Data Akuntabilitas Kelembagaan
                    </button>

                </div>
                <!-- Modal -->
                <div class="modal fade" id="copyAkunkel" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h6 class="modal-title text-light" id="staticBackdropLabel">Copy Data Akuntabilitas
                                    Kelembagaan</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(session()->has('timpaAll'))
                                <div class="alert bg-danger text-white">Sudah ada data akuntabilitas kelembagaan tahun
                                    {{
                                    session('timpaAll') }}
                                </div>
                                <form action="/adminDesa/copyAkunkel" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tahuncopy">Tetap Copy dan timpa Seluruh Data Akunkel Tahun {{
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
                            <form action="/adminDesa/copyAkunkel" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="tahuncopy">Copy Seluruh Data Akuntabilitas Kelembagaan Tahun {{ $tahun
                                        }} ke Tahun
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                            class="fa fa-wrench"></i></a>

                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div>Tahun Data : {{ $tahun }} &emsp;&emsp; <span class="text-info">(Form Update Data Akuntabilitas
                    Kelembagaan)</span></div>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#" role="tab">Kelembagaan
                        <span class="fa fa-check-circle ml-1"></span>
                    </a>
                </li>

            </ul>

            <div class=" tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form action="/adminDesa/updateAkunkel" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                        <input type="hidden" name="tahun" value="{{ $tahun }}">

                        <div class="row Akunkel">
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
                                            <th width="5%" style="vertical-align : middle">No</th>
                                            <th width="45%" style="vertical-align : middle">Nama Data</th>
                                            <th class="text-center" width="15%">File Data <br><small>(klik untuk
                                                    lihat)</small></th>
                                            <th width="35%" style="vertical-align : middle">Ganti Dokumen / Foto</th>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <th>1</th>
                                        <th>
                                            Peraturan Desa Tentang Struktur Organisasi dan
                                            Tatakerja (SOTK) Pemerintah Desa
                                            <input type="hidden" name="nama_data[]" value="sotk">
                                        </th>
                                        <th class="text-center">
                                            @if($dataAkun[0]->file_data)
                                            <input type="hidden" name="old_0" value="{{ $dataAkun[0]->file_data }}">
                                            <a href="{{ asset('storage/'.$dataAkun[0]->file_data) }}" target="_blank">
                                                <img src="/img/logo-pdf.jpg" width="50px"><br>
                                            </a>
                                            @else
                                            <span class="text-danger">(kosong)</span>
                                            @endif
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
                                        <th class="text-center">
                                            @if($dataAkun[1]->file_data)
                                            <input type="hidden" name="old_1" value="{{ $dataAkun[1]->file_data }}">
                                            <a href="{{ asset('storage/'.$dataAkun[1]->file_data) }}" target="_blank">
                                                <img src="/img/logo-pdf.jpg" width="50px"><br>
                                            </a>
                                            @else
                                            <span class="text-danger">(kosong)</span>
                                            @endif
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
                                        <th class="text-center">
                                            @if($dataAkun[2]->file_data)
                                            <input type="hidden" name="old_2" value="{{ $dataAkun[2]->file_data }}">
                                            <a href="{{ asset('storage/'.$dataAkun[2]->file_data) }}" target="_blank">
                                                <img src="/img/logo-pdf.jpg" width="50px"><br>
                                            </a>
                                            @else
                                            <span class="text-danger">(kosong)</span>
                                            @endif
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
                                        <th class="text-center">
                                            @if($dataAkun[3]->file_data)
                                            <input type="hidden" name="old_3" value="{{ $dataAkun[3]->file_data }}">
                                            <a href="{{ asset('storage/'.$dataAkun[3]->file_data) }}" target="_blank">
                                                <img src="/img/logo-pdf.jpg" width="50px"><br>
                                            </a>
                                            @else
                                            <span class="text-danger">(kosong)</span>
                                            @endif
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
                                        <th class="text-center">
                                            @if($dataAkun[4]->file_data)
                                            <input type="hidden" name="old_4" value="{{ $dataAkun[4]->file_data }}">
                                            <a href="{{ asset('storage/'.$dataAkun[4]->file_data) }}" target="_blank">
                                                <img src="/img/logo-pdf.jpg" width="50px"><br>
                                            </a>
                                            @else
                                            <span class="text-danger">(kosong)</span>
                                            @endif
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
                                        <th class="text-center">
                                            @if($dataAkun[5]->file_data)
                                            <input type="hidden" name="old_5" value="{{ $dataAkun[5]->file_data }}">
                                            <a href="{{ asset('storage/'.$dataAkun[5]->file_data) }}" target="_blank">
                                                <img src="{{ asset('storage/'.$dataAkun[5]->file_data) }}"
                                                    width="50px"><br>
                                            </a>
                                            @else
                                            <span class="text-danger">(kosong)</span>
                                            @endif
                                        </th>
                                        <th>
                                            <div class="custom-file">
                                                <input type="file" name="upload_kantor_desa" class="custom-file-input"
                                                    id="upload_kantor_desa">
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
                                        <th class="text-center">
                                            @if($dataAkun[6]->file_data)
                                            <input type="hidden" name="old_6" value="{{ $dataAkun[6]->file_data }}">
                                            <a href="{{ asset('storage/'.$dataAkun[6]->file_data) }}" target="_blank">
                                                <img src="{{ asset('storage/'.$dataAkun[6]->file_data) }}"
                                                    width="50px"><br>
                                            </a>
                                            @else
                                            <span class="text-danger">(kosong)</span>
                                            @endif
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
                                        <th class="text-center">
                                            @if($dataAkun[7]->file_data)
                                            <input type="hidden" name="old_7" value="{{ $dataAkun[7]->file_data }}">
                                            <a href="{{ asset('storage/'.$dataAkun[7]->file_data) }}" target="_blank">
                                                <img src="{{ asset('storage/'.$dataAkun[7]->file_data) }}"
                                                    width="50px"><br>
                                            </a>
                                            @else
                                            <span class="text-danger">(kosong)</span>
                                            @endif
                                        </th>
                                        <th>
                                            <div class="custom-file">
                                                <input type="file" name="upload_kantor_bpd" class="custom-file-input"
                                                    id="upload_kantor_bpd">
                                                <label class="custom-file-label text-muted upload_kantor_bpd"
                                                    for="upload_kantor_bpd">Choose
                                                    file Image
                                                    (max-size: 1MB)</label>
                                            </div>
                                        </th>

                                    </tr>
                                </table>
                                <p>Catatan : <br>
                                    - Silahkan Upload dokumen/foto yang ada terlebih dahulu, dokumen lain dapat
                                    disusulkan kemudian melalui form update</p>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="row justify-content-center">
                            <div class="form-group ">
                                <button type="button" class="btn btn-primary">Cancel</button>
                                <button type="reset" class="btn btn-primary">Reset</button>
                                <button type="submit" class="btn btn-success">Update Data</button>
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

{{-- notifikasi --}}
@if(session()->has('tambah'))
<script>
    Swal.fire({
   position: 'center',
   icon: 'success',
   title: '{{ session("tambah") }}',
   showConfirmButton: true
})
</script>

@endif
{{-- notifikasi --}}
@if(session()->has('update'))
<script>
    Swal.fire({
   position: 'center',
   icon: 'success',
   title: '{{ session("update") }}',
   showConfirmButton: true
})
</script>

@endif

@if(session()->has('success'))
<script>
    Swal.fire({
   position: 'center',
   icon: 'success',
   title: '{{ session("success") }}',
   showConfirmButton: false,
   timer : 1000
})
</script>

@endif



@endsection
@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bs-custom-file-input/1.1.1/bs-custom-file-input.min.js"
    integrity="sha512-LGq7YhCBCj/oBzHKu2XcPdDdYj6rA0G6KV0tCuCImTOeZOV/2iPOqEe5aSSnwviaxcm750Z8AQcAk9rouKtVSg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    bsCustomFileInput.init();
</script>
<script src="/js/Akunkel.js"></script>

@if(session()->has('timpaAll'))
<script>
    $('#copyAkunkel').modal('show');

</script>
@endif

@endpush