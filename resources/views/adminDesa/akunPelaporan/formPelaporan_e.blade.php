@extends('templates.desa.main')

@section('content')
<div class="row justify-content-center mt-2  mb-4">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Data Akuntabilitas Pelaporan</h5>
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
                <div>Tahun Data : {{ $tahun }} &emsp; &emsp; <span class="text-info"></span></div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" role="tab">Pelaporan

                        </a>
                    </li>

                </ul>

                <div class=" tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <form action="/adminDesa/updateAkunpelaporan" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                            <input type="hidden" name="tahun" value="{{ $tahun }}">

                            <div class="row akunwil">
                                <div class="col-md-8">
                                    <p class="alert alert-success">Form Update Data Pelaporan
                                    </p>
                                    <style>
                                        label {
                                            overflow: hidden;
                                        }
                                    </style>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="bg-info">
                                                <th width="5%" style="vertical-align: middle">No</th>
                                                <th width="40%" style="vertical-align: middle">Nama Data</th>
                                                <th width="15%" class="text-center" style="vertical-align: middle">File
                                                    Data <br>(klik utk lihat)</th>
                                                <th width="40%" style="vertical-align: middle" class="text-center">Ganti
                                                    Data/Dokumen</th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <th>1</th>
                                            <th>
                                                Laporan Realisasi APB Desa TA {{ $tahun }} Semester-1
                                                <input type="hidden" name="nama_data[]" value="lra_semester1">
                                            </th>
                                            <th class="text-center">
                                                @if($data[0]->file_data)
                                                <input type="hidden" name="old_0" value="{{ $data[0]->file_data }}">
                                                <a href="{{ asset('storage/'.$data[0]->file_data) }}" target="_blank">
                                                    <img src="/img/logo-pdf.jpg" width="50px"><br>
                                                </a>
                                                @else
                                                <span class="text-danger">(kosong)</span>
                                                @endif

                                            </th>
                                            <th>
                                                <div class="custom-file">
                                                    <input type="file" name="lra_semester1" class="custom-file-input"
                                                        id="lra_semester1">
                                                    <label class="custom-file-label text-muted lra_semester1"
                                                        for="lra_semester1" style="font-size: .8rem">Choose
                                                        file PDF
                                                        (max-size: 5 MB)</label>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>2</th>
                                            <th>
                                                Surat Penyampaian Laporan Realisasi APB Desa TA {{ $tahun }} Semester-1
                                                Kepada Camat
                                                <input type="hidden" name="nama_data[]" value="surat_lra">
                                            </th>
                                            <th class="text-center">
                                                @if($data[1]->file_data)
                                                <input type="hidden" name="old_1" value="{{ $data[1]->file_data }}">
                                                <a href="{{ asset('storage/'.$data[1]->file_data) }}" target="_blank">
                                                    <img src="/img/logo-pdf.jpg" width="50px"><br>
                                                </a>
                                                @else
                                                <span class="text-danger">(kosong)</span>
                                                @endif

                                            </th>
                                            <th>
                                                <div class="custom-file">
                                                    <input type="file" name="surat_lra" class="custom-file-input"
                                                        id="surat_lra">
                                                    <label class="custom-file-label text-muted surat_lra"
                                                        for="surat_lra" style="font-size: .8rem">Choose
                                                        file PDF
                                                        (max-size: 1 MB)</label>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>3</th>
                                            <th>
                                                Dokumen Laporan Keterangan Penyelenggaraan Pemerintahan Desa (LKPD)
                                                Tahun {{
                                                $tahun-1 }}
                                                <input type="hidden" name="nama_data[]" value="lkpd">
                                            </th>
                                            <th class="text-center">
                                                @if($data[2]->file_data)
                                                <input type="hidden" name="old_2" value="{{ $data[2]->file_data }}">
                                                <a href="{{ asset('storage/'.$data[2]->file_data) }}" target="_blank">
                                                    <img src="/img/logo-pdf.jpg" width="50px"><br>
                                                </a>
                                                @else
                                                <span class="text-danger">(kosong)</span>
                                                @endif

                                            </th>
                                            <th>
                                                <div class="custom-file">
                                                    <input type="file" name="lkpd" class="custom-file-input" id="lkpd">
                                                    <label class="custom-file-label text-muted lkpd" for="lkpd"
                                                        style="font-size: .8rem">Choose
                                                        file PDF
                                                        (max-size: 10 MB)</label>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>4</th>
                                            <th>
                                                Surat Penyampaian LKPD Tahun {{ $tahun-1 }} kepada BPD
                                                <input type="hidden" name="nama_data[]" value="surat_lkpd">
                                            </th>
                                            <th class="text-center">
                                                @if($data[3]->file_data)
                                                <input type="hidden" name="old_3" value="{{ $data[3]->file_data }}">
                                                <a href="{{ asset('storage/'.$data[3]->file_data) }}" target="_blank">
                                                    <img src="/img/logo-pdf.jpg" width="50px"><br>
                                                </a>
                                                @else
                                                <span class="text-danger">(kosong)</span>
                                                @endif

                                            </th>
                                            <th>

                                                <div class="custom-file">
                                                    <input type="file" name="surat_lkpd" class="custom-file-input"
                                                        id="surat_lkpd">
                                                    <label class="custom-file-label text-muted surat_lkpd"
                                                        for="surat_lkpd" style="font-size: .8rem">Choose
                                                        file PDF
                                                        (max-size: 1 MB)</label>
                                                </div>

                                            </th>
                                        </tr>
                                        <tr>
                                            <th>5</th>
                                            <th>
                                                Peraturan Desa tentang Pertanggungjawaban APB Desa TA {{ $tahun-1 }}
                                                <input type="hidden" name="nama_data[]"
                                                    value="perdes_pertanggungjawaban">
                                            </th>
                                            <th class="text-center">
                                                @if($data[4]->file_data)
                                                <input type="hidden" name="old_4" value="{{ $data[4]->file_data }}">
                                                <a href="{{ asset('storage/'.$data[4]->file_data) }}" target="_blank">
                                                    <img src="/img/logo-pdf.jpg" width="50px"><br>
                                                </a>
                                                @else
                                                <span class="text-danger">(kosong)</span>
                                                @endif

                                            </th>
                                            <th>

                                                <div class="custom-file">
                                                    <input type="file" name="perdes_pertanggungjawaban"
                                                        class="custom-file-input" id="perdes_pertanggungjawaban">
                                                    <label
                                                        class="custom-file-label text-muted perdes_pertanggungjawaban"
                                                        for="perdes_pertanggungjawaban" style="font-size: .8rem">Choose
                                                        file PDF
                                                        (max-size: 5 MB)</label>
                                                </div>

                                            </th>
                                        </tr>
                                        <tr>
                                            <th>6</th>
                                            <th>
                                                Dokumen Laporan Penyelenggaraan Pemerintahan Desa (LPPD) Tahun {{
                                                $tahun-1 }}
                                                <input type="hidden" name="nama_data[]" value="dok_lppd">
                                            </th>
                                            <th class="text-center">
                                                @if($data[5]->file_data)
                                                <input type="hidden" name="old_5" value="{{ $data[5]->file_data }}">
                                                <a href="{{ asset('storage/'.$data[5]->file_data) }}" target="_blank">
                                                    <img src="/img/logo-pdf.jpg" width="50px"><br>
                                                </a>
                                                @else
                                                <span class="text-danger">(kosong)</span>
                                                @endif

                                            </th>
                                            <th>

                                                <div class="custom-file">
                                                    <input type="file" name="dok_lppd" class="custom-file-input"
                                                        id="dok_lppd">
                                                    <label class="custom-file-label text-muted dok_lppd" for="dok_lppd"
                                                        style="font-size: .8rem">Choose
                                                        file PDF
                                                        (max-size: 10 MB)</label>
                                                </div>

                                            </th>
                                        </tr>
                                        <tr>
                                            <th>7</th>
                                            <th>
                                                Surat Penyampaian LPPD Tahun {{ $tahun-1 }} kepada Camat
                                                <input type="hidden" name="nama_data[]" value="surat_lppd">
                                            </th>
                                            <th class="text-center">
                                                @if($data[6]->file_data)
                                                <input type="hidden" name="old_6" value="{{ $data[6]->file_data }}">
                                                <a href="{{ asset('storage/'.$data[6]->file_data) }}" target="_blank">
                                                    <img src="/img/logo-pdf.jpg" width="50px"><br>
                                                </a>
                                                @else
                                                <span class="text-danger">(kosong)</span>
                                                @endif

                                            </th>
                                            <th>

                                                <div class="custom-file">
                                                    <input type="file" name="surat_lppd" class="custom-file-input"
                                                        id="surat_lppd">
                                                    <label class="custom-file-label text-muted surat_lppd"
                                                        for="surat_lppd" style="font-size: .8rem">Choose
                                                        file PDF
                                                        (max-size: 1 MB)</label>
                                                </div>

                                            </th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group row justify-content-center">
                                <div class="col-md-5 col-sm-5">
                                    <button type="button" class="btn btn-primary">Cancel</button>
                                    <button type="reset" class="btn btn-primary">Reset</button>
                                    <button type="submit" class="btn btn-success">Update</button>
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

@endsection
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bs-custom-file-input/1.1.1/bs-custom-file-input.min.js"
    integrity="sha512-LGq7YhCBCj/oBzHKu2XcPdDdYj6rA0G6KV0tCuCImTOeZOV/2iPOqEe5aSSnwviaxcm750Z8AQcAk9rouKtVSg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    bsCustomFileInput.init();
</script>
<script src="/js/pelaporan.js"></script>
@endpush