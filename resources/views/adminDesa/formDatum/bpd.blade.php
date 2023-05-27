@extends('templates.desa.main')
@section('css')
<style>
    #tabaktif {
        background-color: aqua;
        color: black;
    }
</style>
@endsection
@section('content')
<div class="clearfix"></div>
<div class="row justify-content-center mt-2">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Data BPD</h5>
        <div class="x_panel">

            <div class="x_title">

                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formBPD" method="get">
                        @csrf
                        <div class="form-group mx-sm-3 mb-2">
                            <h6>Masukkan tahun data :</h6>
                            <input type="text" name="tahun" class="form-control ml-3" placeholder="{{ $tahun }}"
                                data-inputmask="'mask': '9999'" style="font-size: .85rem">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mb-2">Cek Data</button>
                    </form>

                    <button type="button" class="btn btn-primary ml-auto btn-sm" data-toggle="modal"
                        data-target="#copyDataBpdAll">
                        Copy Seluruh Data BPD
                    </button>

                </div>
                <!-- Modal -->
                <div class="modal fade" id="copyDataBpdAll" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-light" id="staticBackdropLabel">Copy Data BPD</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(session()->has('timpaBpd'))
                                <div class="alert bg-danger text-white">Sudah ada data BPD tahun {{
                                    session('timpaBpd') }}
                                </div>
                                <form action="/adminDesa/copyDatumBpdAll" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tahuncopy">Tetap Copy dan timpa Seluruh Data BPD Tahun {{
                                            $tahun }} ke
                                            Tahun {{ session('timpaBpd') }}
                                            :</label>
                                        <input type="hidden" name="tahuncopy" value="{{ session('timpaBpd') }}">
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
                            <form action="/adminDesa/copyDatumBpdAll" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="tahuncopy">Copy Seluruh Data BPD Tahun {{ $tahun }} ke Tahun
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
            <div>Tahun Data : {{ $tahun }}</div>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">

            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" href="?jabatan=ketua_bpd&tahun={{ $tahun }}" role="tab"
                        aria-selected="true">Ketua_BPD<span class='fa fa-check-circle ml-1 {{ $ketua==0 ? ' d-none' : ''
                            }}'></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?jabatan=wakil_ketua_bpd&tahun={{ $tahun }}" role="tab"
                        aria-selected="true">Wakil_Ketua_BPD<span class='fa fa-check-circle ml-1 {{ $wakil==0 ? '
                            d-none' : '' }}'></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?jabatan=sekretaris_bpd&tahun={{ $tahun }}" role="tab"
                        aria-selected="true">Sekretaris_BPD<span class='fa fa-check-circle ml-1 {{ $sekretaris==0 ? '
                            d-none' : '' }}'></span></a>
                </li>
                <?php $i=1; ?>
                @foreach($bpds as $bpd)
                <li class="nav-item">
                    <a class="nav-link" href="?jabatan=anggota_bpd_{{ $i }}&tahun={{ $tahun }}" role="tab"
                        aria-selected="true">Anggota_{{
                        $i }} <span class='fa fa-check-circle ml-1 {{ $bpd == 0 ? "d-none" : "" }}'></span></a>
                </li>
                <?php $i++; ?>
                @endforeach
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h4 class="text-center">Pilih Tab Untuk Lihat/Input/Update Data</h4>
                </div>

            </div>
            <br><br><br>
        </div>
    </div>
</div>
<br>
<br>

</div>
@if(session()->has('success'))
<script>
    Swal.fire({
    icon: 'success',
    title: '{{ session("success") }}',
    showConfirmButton: false,
    timer: 1500
})
</script>
@endif

@endsection
@push('script')
<!-- jquery.inputmask -->
<script src="/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
@if(session()->has('timpaBpd'))
<script>
    $('#copyDataBpdAll').modal('show');

</script>
@endif
<script>
    $("#file_sk").change(function(event) {

        getURL(this);
    });

function getURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var filename = $("#file_sk").val();
        
        filename = filename.substring(filename.lastIndexOf('\\') + 1);
        var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
        if (cekgb == 'pdf' || cekgb == 'PDF') {
            if(input.files[0]['size'] > 1024){
                alert('ukuran file tidak boleh > 1 Mb !');
                $('#file_sk').val("");
            }else{
                $('#nmfile_sk').html('');
                $('#nmfile_sk').html(filename);
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('#file_sk').val("");
            
        }
        
        
    }

}

// upload foto perangkat
$("#foto_perangkat").change(function(event) {
    getURL(this);
});


function getURL(input) {
if (input.files && input.files[0]) {
    var reader = new FileReader();
    var filename = $("#foto_perangkat").val();
    filename = filename.substring(filename.lastIndexOf('\\') + 1);
    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    if (cekgb == 'jpg' || cekgb == 'JPG' || cekgb == 'png' || cekgb == 'jpeg' || cekgb == 'jfif') {
        
        $('.foto_p').show();
        $('.nfile').html(filename);

        reader.onload = function(e) {
            debugger;
            $('.gb_perangkat').attr('src', e.target.result);
            $('.gb_perangkat').hide();
            $('.gb_perangkat').fadeIn(500);

                }
    reader.readAsDataURL(input.files[0]);


    }else {
        alert ("file harus berjenis 'jpg' , 'jpeg', 'png', atau 'jfif'");
        $('#foto_perangkat').val("");
        // $('#gb_perangkat').attr('src', '../img/foto_pegawai/no_image.png');

        
    }
    
    // reader.readAsDataURL(input.files[0]);
}


    

}

</script>
@endpush