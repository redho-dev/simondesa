@extends('templates.desa.main')

@section('content')

<div class="clearfix"></div>
<div class="row justify-content-center mt-2">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Data Pendirian BUM Desa</h5>
        <div class="x_panel">
            <div class="x_title">
                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/pendirianBumdes" method="get">
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
                        Copy Data Bendahara barang
                    </button>

                </div>
                <!-- Modal -->
                <div class="modal fade" id="copyDataAll" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-light" id="staticBackdropLabel">Copy Seluruh Data Bendahara
                                    barang
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(session()->has('timpaAll'))
                                <div class="alert bg-danger text-white">Sudah ada data Bendahara barang tahun {{
                                    session('timpaAll') }}
                                </div>
                                <form action="/adminDesa/copyBenbar" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tahuncopy">Tetap Copy dan timpa Data Bendahara barang Tahun {{
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
                            <form action="/adminDesa/copyBenbar" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="tahuncopy">Copy Seluruh Data Bendahara barang Tahun {{ $tahun }} ke
                                        Tahun
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
                    <a class="nav-link active" href="" role="tab">Pendirian BUM Desa
                        <span class="fa fa-check-circle ml-1 d-none"></span>
                    </a>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane active show " id="aset" role="tabpanel" aria-labelledby="aset-tab">
                    <div class="form-row">
                        <div class="col-md-8">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Data</th>
                                    <th>Isi Data</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Nama BUM Desa</td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>Nomor Perdes Pembentukan BUM Desa</td>
                                    <td><input type="text" class="form-control" style="font-size: .85rem"></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Tanggal Penetapan Perdes Pembentukan BUM Desa</td>
                                    <td><input type="date" class="form-control" style="font-size: .85rem"></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Dokumen Perdes Pembentukan BUM Desa</td>
                                    <td>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="custom-file ">

                                                    <input type="file" name="perdes_bumdes" class="custom-file-input"
                                                        id="perdes_bumdes">
                                                    <label class="custom-file-label text-muted perdes_bumdes"
                                                        for="perdes_bumdes" style="font-size: .85rem">Choose
                                                        file PDF
                                                        (max-size: 1MB)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Apakah BUM Desa telah terdaftar di Kemenkum HAM (berbadan hukum)</td>
                                    <td>
                                        <select name="" class="form-control" style="font-size: .85rem">
                                            <option value="">--pilih--</option>
                                            <option value="sudah">sudah</option>
                                            <option value="belum">belum</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Surat Keterangan Terdaftar Kemenkum HAM (print out)</td>
                                    <td>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="custom-file ">

                                                    <input type="file" name="sk_kemenkum" class="custom-file-input"
                                                        id="sk_kemenkum">
                                                    <label class="custom-file-label text-muted sk_kemenkum"
                                                        for="sk_kemenkum" style="font-size: .85rem">Choose
                                                        file PDF
                                                        (max-size: 1MB)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>

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