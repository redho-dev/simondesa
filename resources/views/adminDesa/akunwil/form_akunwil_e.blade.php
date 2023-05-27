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
                    <button type="button" class="btn btn-primary ml-auto btn-sm" data-toggle="modal"
                        data-target="#copyAkunwil">
                        Copy Data Kewilayahan
                    </button>

                </div>
                <!-- Modal -->
                <div class="modal fade" id="copyAkunwil" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h6 class="modal-title text-light" id="staticBackdropLabel">Copy Data
                                    Kewilayahan</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(session()->has('timpaAll'))
                                <div class="alert bg-danger text-white">Sudah ada data kewilayahan tahun
                                    {{
                                    session('timpaAll') }}
                                </div>
                                <form action="/adminDesa/copyAkunwil" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tahuncopy">Tetap Copy dan timpa Seluruh Data Kewilayahan Tahun {{
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
                            <form action="/adminDesa/copyAkunwil" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="tahuncopy">Copy Seluruh Data Akuntabilitas Kewilayahan Tahun {{ $tahun
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
                    Kewilayahan)</span></div>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#" role="tab">Kewilayahan
                        <span class="fa fa-check-circle ml-1"></span>
                    </a>
                </li>

            </ul>

            <div class=" tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form action="/adminDesa/updateAkunwil" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                        <input type="hidden" name="tahun" value="{{ $tahun }}">

                        <div class="row akunwil">
                            <div class="col-md-8">
                                <table class="table table-bordered">
                                    <thead class="bg-info">
                                        <tr>
                                            <th width="5%" style="vertical-align: middle">No</th>
                                            <th width="40%" style="vertical-align: middle">Nama Data</th>
                                            <th class="text-center" width="15%" style="vertical-align: middle">Isi Data
                                                <br> <small>(klik untuk
                                                    lihat)</small>
                                            </th>
                                            <th class="text-center" width="40%" style="vertical-align: middle">
                                                Ganti/Upload File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>1</th>
                                            <th>
                                                Dasar Hukum Pembentukan Desa
                                                <input type="hidden" name="nama_data[]" value="dasar_hukum">
                                            </th>
                                            <th width="20%" class="text-center" style="vertical-align: middle">
                                                @if($dataAkun[0]->file_data)
                                                <input type="hidden" name="old_0" value="{{ $dataAkun[0]->file_data }}">
                                                <a href="{{ asset('storage/'.$dataAkun[0]->file_data) }}"
                                                    target="_blank">
                                                    <img src="/img/logo-pdf.jpg" width="50px"><br>

                                                </a>
                                                @else
                                                <span class="text-danger">(kosong)</span>
                                                @endif
                                            </th>
                                            <th>
                                                <div class="form-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="upload_dasar_hukum"
                                                            class="custom-file-input" id="upload_dasar_hukum">
                                                        <label class="custom-file-label text-muted upload_dasar_hukum"
                                                            for="upload_dasar_hukum" style="font-size: .75rem">Choose
                                                            file PDF
                                                            (max-size: 1MB)</label>
                                                    </div>

                                                </div>

                                            </th>

                                        </tr>

                                        <tr>
                                            <th>2</th>
                                            <th>
                                                Pilar Batas Utara
                                                <input type="hidden" name="nama_data[]" value="patok_batas_utara">
                                            </th>
                                            <th class="text-center" style="vertical-align: middle">
                                                @if($dataAkun[1]->file_data)
                                                <input type="hidden" name="old_1" value="{{ $dataAkun[1]->file_data }}">
                                                <a href="{{ asset('storage/'.$dataAkun[1]->file_data) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('storage/'.$dataAkun[1]->file_data) }}"
                                                        width="50px" height="50px"><br>
                                                </a>
                                                @else
                                                <span class="text-danger">(kosong)</span>
                                                @endif
                                            </th>
                                            <th>
                                                <div class="form-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="upload_batas_utara"
                                                            class="custom-file-input" id="upload_batas_utara">
                                                        <label class="custom-file-label text-muted upload_batas_utara"
                                                            for="upload_batas_utara" style="font-size: .75rem">Choose
                                                            file Image
                                                            (max-size: 1MB)</label>
                                                    </div>

                                                </div>

                                            </th>

                                        </tr>
                                        <tr>
                                            <th>3</th>
                                            <th>
                                                Pilar Batas Selatan
                                                <input type="hidden" name="nama_data[]" value="patok_batas_selatan">
                                            </th>
                                            <th class="text-center" style="vertical-align: middle">
                                                @if($dataAkun[2]->file_data)
                                                <input type="hidden" name="old_2" value="{{ $dataAkun[2]->file_data }}">
                                                <a href="{{ asset('storage/'.$dataAkun[2]->file_data) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('storage/'.$dataAkun[2]->file_data) }}"
                                                        width="50px" height="50px"><br>

                                                </a>
                                                @else
                                                <span class="text-danger">(kosong)</span>
                                                @endif
                                            </th>
                                            <th>
                                                <div class="form-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="upload_batas_selatan"
                                                            class="custom-file-input" id="upload_batas_selatan">
                                                        <label class="custom-file-label text-muted upload_batas_selatan"
                                                            for="upload_batas_selatan" style="font-size: .75rem">Choose
                                                            file Image
                                                            (max-size: 1MB)</label>
                                                    </div>

                                                </div>

                                            </th>

                                        </tr>
                                        <tr>
                                            <th>4</th>
                                            <th>
                                                Pilar Batas Barat
                                                <input type="hidden" name="nama_data[]" value="patok_batas_barat">
                                            </th>
                                            <th class="text-center" style="vertical-align: middle">
                                                @if($dataAkun[3]->file_data)
                                                <input type="hidden" name="old_3" value="{{ $dataAkun[3]->file_data }}">
                                                <a href="{{ asset('storage/'.$dataAkun[3]->file_data) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('storage/'.$dataAkun[3]->file_data) }}"
                                                        width="50px" height="50px"><br>

                                                </a>
                                                @else
                                                <span class="text-danger">(kosong)</span>
                                                @endif
                                            </th>
                                            <th>
                                                <div class="form-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="upload_batas_barat"
                                                            class="custom-file-input" id="upload_batas_barat">
                                                        <label class="custom-file-label text-muted upload_batas_barat"
                                                            for="upload_batas_barat" style="font-size: .75rem">Choose
                                                            file Image
                                                            (max-size: 1MB)</label>
                                                    </div>
                                                </div>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th>5</th>
                                            <th>
                                                Pilar Batas Timur
                                                <input type="hidden" name="nama_data[]" value="patok_batas_timur">
                                            </th>
                                            <th class="text-center" style="vertical-align: middle">
                                                @if($dataAkun[4]->file_data)
                                                <input type="hidden" name="old_4" value="{{ $dataAkun[4]->file_data }}">
                                                <a href="{{ asset('storage/'.$dataAkun[4]->file_data) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('storage/'.$dataAkun[4]->file_data) }}"
                                                        width="50px" height="50px"><br>
                                                </a>
                                                @else
                                                <span class="text-danger">(kosong)</span>
                                                @endif
                                            </th>
                                            <th>
                                                <div class="form-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="upload_batas_timur"
                                                            class="custom-file-input" id="upload_batas_timur">
                                                        <label class="custom-file-label text-muted upload_batas_timur"
                                                            for="upload_batas_timur" style="font-size: .75rem">Choose
                                                            file Image
                                                            (max-size: 1MB)</label>
                                                    </div>

                                                </div>

                                            </th>

                                        </tr>

                                        <tr>
                                            <th>6</th>
                                            <th colspan="2" class="text-center" style="vertical-align: middle">
                                                @if($dataAkun[5]->file_data)
                                                <input type="hidden" name="old_5" value="{{ $dataAkun[5]->file_data }}">
                                                <div>Peta/Sket Desa {{ $infos->asal->asal }}</div>
                                                <a href="{{ asset('storage/'.$dataAkun[5]->file_data) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('storage/'.$dataAkun[5]->file_data) }}" alt=""
                                                        width="300px"><br>
                                                    <small>(klik untuk lihat)</small>

                                                </a>
                                                @else
                                                <span class="text-danger">(kosong)</span>
                                                @endif
                                            </th>
                                            <th>
                                                <div class="form-group">
                                                    <label for="upload_peta_batas" style="font-size: .75rem">Ganti Peta
                                                        Batas/Sket/Gambar/Denah
                                                        Desa</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="upload_peta_batas"
                                                            class="custom-file-input" id="upload_peta_batas">
                                                        <label class="custom-file-label text-muted upload_peta_batas"
                                                            for="upload_peta_batas" style="font-size: .75rem">Choose
                                                            file Image
                                                            (max-size: 5MB)</label>
                                                    </div>
                                            </th>

                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3">
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
                                            </th>
                                            <th class="text-center">
                                                <button type="submit" class="btn btn-primary mt-4">Update Data</button>
                                            </th>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                        </div>
                        <div class="ln_solid"></div>

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
   showConfirmButton: false,
   timer: 1000
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
   showConfirmButton: false,
   timer: 1000
})
</script>

@endif

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



@endsection
@push('script')

<script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    bsCustomFileInput.init();
</script>
<script src="/js/akunwil.js"></script>

@if(session()->has('timpaAll'))
<script>
    $('#copyAkunwil').modal('show');

</script>
@endif

@endpush