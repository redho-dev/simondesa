@extends('templates.desa.main')

@section('content')

<div class="clearfix"></div>
<div class="row justify-content-center mt-2">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Buku Inventaris Aset Desa</h5>
        <div class="x_panel">
            <div class="x_title">
                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formInventaris" method="get">
                        @csrf
                        <div class="form-group mx-sm-3 mb-2">
                            <h6>Masukkan tahun data :</h6>
                            <input type="text" name="tahun" class="form-control ml-3" placeholder="{{ $tahun }}"
                                data-inputmask="'mask': '9999'" style="font-size: .85rem">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mb-2">Cek Data</button>
                    </form>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm ml-auto d-none" data-toggle="modal"
                        data-target="#copyDataAll">
                        Copy Data Inventaris Aset
                    </button>

                </div>
                <!-- Modal -->
                <div class="modal fade" id="copyDataAll" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-light" id="staticBackdropLabel">Copy Seluruh Data Aset</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(session()->has('timpaAll'))
                                <div class="alert bg-danger text-white">Sudah ada data Aset tahun {{
                                    session('timpaAll') }}
                                </div>
                                <form action="/adminDesa/copyDaset" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tahuncopy">Tetap Copy dan timpa Data Aset Tahun {{
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
                            <form action="/adminDesa/copyDaset" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="tahuncopy">Copy Seluruh Data Aset Tahun {{ $tahun }} ke Tahun
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
                    <a class="nav-link active" href="" role="tab">Buku Inventaris Aset Desa
                        <span class="fa fa-check-circle ml-1 {{ $jumset > 0 ? '' : 'd-none' }}"></span>
                    </a>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane active show " id="aset" role="tabpanel" aria-labelledby="aset-tab">
                    <div class="mt-3">
                        <small class="text-info"><i>
                                Catatan : <br>
                                - Berikut Adalah Buku Inventaris Aset Desa yang merupakan kompilasi dari Data KIB yang
                                anda input dalam Simondes Tahun {{ $tahun }} <br>

                                - Silahkan anda print Buku Inventaris Aset Desa dibawah ini, ditandatangani dan dicap
                                kemudian upload dokumen pdf nya melalui menu upload</i>
                        </small>

                    </div>
                    <hr>
                    <h4 class="text-center text-dark mt-4">BUKU INVENTARIS ASET DESA <br> PEMERINTAH DESA {{
                        strtoupper($infos->asal->asal) }} <br>TAHUN {{ $tahun }}</h4>
                    <div class="form-row">
                        <p>Kode Lokasi Desa : {{ $infos->asal->kd_desa }}</p>
                        <form action="/adminDesa/cetakInventaris" method="post" class="ml-auto" target="_blank">
                            @csrf
                            <input type="hidden" name="asal_id" value=" {{ $infos->asal_id }}">
                            <input type="hidden" name="tahun" value=" {{ $tahun }}">

                            <button class="btn btn-info btn-sm">Cetak <i class="fa fa-print"></i></button>

                        </form>
                    </div>
                    <table class="table table-bordered">
                        <thead class="table-secondary">
                            <tr>
                                <th rowspan="2" style="vertical-align: middle
                                " class="text-center">NUP</th>
                                <th rowspan="2" style="vertical-align: middle
                                " class="text-center">Jenis/Nama Barang</th>
                                <th rowspan="2" style="vertical-align: middle
                                " class="text-center">Kode Barang</th>
                                <th rowspan="2" style="vertical-align: middle
                                " class="text-center">Identitas Barang</th>
                                <th colspan="3" style="vertical-align: middle
                                " class="text-center">Asal-usul Barang</th>
                                <th rowspan="2" style="vertical-align: middle
                                " class="text-center">Tahun Perolehan</th>
                                <th class="text-center" rowspan="2" style="vertical-align: middle
                                " class="text-center">Nilai Perolehan <br>(Rp)</th>
                                <th rowspan="2" style="vertical-align: middle
                                " class="text-center">Ket</th>
                            </tr>
                            <tr>

                                <td class="text-center">APB Desa</td>
                                <td class="text-center">Perolehan Lain yg Sah</td>
                                <td class="text-center">Kekayan Asli Desa</td>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($asets as $aset)
                            @php
                            if ($aset->jenis == 'tanah') {
                            $identitas = $aset->lokasi. "- LT: $aset->luas_merk M2";

                            }elseif($aset->jenis == 'gedung'){
                            $identitas = $aset->lokasi. "- LB: $aset->luas_merk M2";
                            }elseif($aset->jenis == 'jalan'){
                            $identitas = $aset->luas_merk . "- P: $aset->panjang M, L: $aset->lebar M";
                            }else{
                            $identitas = $aset->luas_merk;
                            }
                            @endphp
                            <tr>
                                <td>{{ $aset->nup }}</td>
                                <td>{{ $aset->nama_barang }}</td>
                                <td>{{ $aset->kode_barang }}</td>
                                <td>{{ $identitas }}</td>
                                <td class="text-center">
                                    <i class="fa fa-check {{ $aset->asal_usul == 'APB Desa' ? '' : 'd-none' }}"></i>
                                </td>
                                <td class="text-center">
                                    <i
                                        class="fa fa-check {{ $aset->asal_usul == 'Perolehan Lain yang Sah' ? '' : 'd-none' }}"></i>
                                </td>
                                <td class="text-center">
                                    <i
                                        class="fa fa-check {{ $aset->asal_usul == 'Aset Asli Desa' ? '' : 'd-none' }}"></i>
                                </td>
                                <td class="text-center">{{ $aset->tahun_perolehan }}</td>
                                <td class="text-right">
                                    <span class="nilai angka">{{ $aset->nilai_perolehan }}</span>
                                </td>
                                <td>{{ $aset->keterangan }}</td>
                            </tr>
                            @endforeach
                            <tr class="table-info">
                                <td colspan="8" class="text-right">TOTAL NILAI PEROLEHAN ASET </td>
                                <td class="total text-right"></td>
                                <td></td>
                            </tr>
                        </tbody>

                    </table>


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
@push('script')
<script src="/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<script>
    $('.angka').mask('000.000.000.000.000', {reverse: true});

    var jumnilai = $('.nilai').length;
    var total = 0;
    for(let i=0; i<jumnilai; i++){
        var nilai = $('.nilai').eq(i).html();
            nilai = nilai.replaceAll('.', '');
            nilai = Number(nilai);
        total += nilai;
        
    }
    $('.total').html(total);
    $('.total').mask('000.000.000.000.000', {reverse: true});
</script>

@if(session()->has('timpaAll'))
<script>
    $('#copyDataAll').modal('show');

</script>
@endif

@endpush