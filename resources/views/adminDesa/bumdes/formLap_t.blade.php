@extends('templates.desa.main')

@section('content')
<div class="clearfix"></div>
<div class="row justify-content-center mt-2">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Data Laporan Keuangan BUM Desa</h5>
        <div class="x_panel">
            <div class="x_title">
                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/bumdesLapkeu" method="get">
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
                        Copy Seluruh Data Lapkeu BUM Desa
                    </button>

                </div>
                <!-- Modal -->
                <div class="modal fade" id="copyDataAll" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-light" id="staticBackdropLabel">Copy Data Laporan Keuangan
                                    BUM Desa
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(session()->has('timpaAll'))
                                <div class="alert bg-danger text-white">Sudah ada data Laporan Keuangan BUM Desa tahun
                                    {{
                                    session('timpaAll') }}
                                </div>
                                <form action="/adminDesa/copyLapkeubumdes" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tahuncopy">Tetap Copy dan timpa Data Laporan Keuangan BUM Desa Tahun
                                            {{
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
                            <form action="/adminDesa/copyLapkeubumdes" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="tahuncopy">Copy Seluruh Data Laporan Keuangan BUM Desa Tahun {{ $tahun
                                        }} ke
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
                    <a class="nav-link {{ $jenis=='dasar_keuangan' ? 'active' : '' }}"
                        href="?jenis=dasar_keuangan&tahun={{ $tahun }}" role="tab">Data Dasar Keuangan
                        <span class="fa fa-check-circle ml-1 {{ $dasar==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='proposal' ? 'active' : '' }}"
                        href="?jenis=proposal&tahun={{ $tahun }}" role="tab">Proposal Pengajuan Modal
                        <span class="fa fa-check-circle ml-1 {{ $proposal==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='laporan' ? 'active' : '' }}" href="?jenis=laporan&tahun={{ $tahun }}"
                        role="tab">Laporan Keuangan
                        <span class="fa fa-check-circle ml-1 {{ $laporan==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane active show " id="dalap" role="tabpanel" aria-labelledby="dalap-tab">
                    @if($jenis=='dasar_keuangan')
                    @include('adminDesa.bumdes.dasarbumdesTambah')
                    @elseif($jenis=='laporan')
                    @include('adminDesa.bumdes.lapkeuTambah')
                    @elseif($jenis=='proposal')
                    @include('adminDesa.bumdes.proposalTambah')
                    @endif
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
<script src="/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<script>
    bsCustomFileInput.init();
    $('.angka').mask('000.000.000.000.000', {reverse: true});

    $("#lapkeu").change(function(event) {
        getURL2(this);
    });

    function getURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = $("#lapkeu").val();

            filename = filename.substring(filename.lastIndexOf('\\') + 1);
            var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
        if (cekgb == 'pdf' || cekgb == 'PDF' ) {
            if(input.files[0]['size'] > 2048000){
                alert(input.files[0]['size']);
                alert('ukuran file tidak boleh > 2 MB !');
                $('#lapkeu').val("");
                $('.lapkeu').html("file pdf (max-size: 2MB)");
            }else{

            }

        }else {
            alert ("file harus berjenis pdf ");
            $('#lapkeu').val("");
            $('.lapkeu').html("file pdf (max-size: 2MB)");

        }


        }

    }

    $("#catatan_rekening").change(function(event) {
        getURL2(this);
    });

    function getURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = $("#catatan_rekening").val();

            filename = filename.substring(filename.lastIndexOf('\\') + 1);
            var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
        if (cekgb == 'pdf' || cekgb == 'PDF' ) {
            if(input.files[0]['size'] > 2048000){
                alert(input.files[0]['size']);
                alert('ukuran file tidak boleh > 2 MB !');
                $('#catatan_rekening').val("");
                $('.catatan_rekening').html("file pdf (max-size: 2MB)");
            }else{

            }

        }else {
            alert ("file harus berjenis pdf ");
            $('#catatan_rekening').val("");
            $('.catatan_rekening').html("file pdf (max-size: 2MB)");

        }


        }

    }


    $("#foto_rekening").change(function(event) {
        getURL3(this);
    });

    function getURL3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = $("#foto_rekening").val();

            filename = filename.substring(filename.lastIndexOf('\\') + 1);
            var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
        if (cekgb == 'jpg' || cekgb == 'JPG' || cekgb == 'JPEG' || cekgb == 'jpeg' || cekgb == 'PNG' || cekgb == 'png') {
            if(input.files[0]['size'] > 1024000){
                alert(input.files[0]['size']);
                alert('ukuran file tidak boleh > 1 MB !');
                $('#foto_rekening').val("");
                $('.foto_rekening').html("file Image (max-size: 1MB)");
            }else{

            }

        }else {
            alert ("file harus berjenis jpg/jpeg/png ");
            $('#foto_rekening').val("");
            $('.foto_rekening').html("file Image (max-size: 1MB)");

        }


        }

    }


    $("#proposal").change(function(event) {
        getURLProp(this);
    });

    function getURLProp(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = $("#proposal").val();

            filename = filename.substring(filename.lastIndexOf('\\') + 1);
            var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
        if (cekgb == 'pdf' || cekgb == 'PDF' ) {
            if(input.files[0]['size'] > 5120000){
                alert(input.files[0]['size']);
                alert('ukuran file tidak boleh > 5 MB !');
                $('#proposal').val("");
                $('.proposal').html("file pdf (max-size: 5MB)");
            }else{

            }

        }else {
            alert ("file harus berjenis pdf ");
            $('#proposal').val("");
            $('.proposal').html("file pdf (max-size: 5MB)");

        }


        }

    }




</script>

@if(session()->has('timpaAll'))
<script>
    $('#copyDataAll').modal('show');

</script>
@endif


@endpush