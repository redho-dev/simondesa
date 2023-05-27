@extends('templates.desa.main')

@section('content')
<div class="clearfix"></div>
<div class="row justify-content-center mt-2 ">
    <div class="col-md-12 col-sm-12  mb-5">
        <h5 class="alert alert-info">Form Update Data RPJMDes</h5>
        <div class="x_panel">
            <div class="x_title">
                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formRpjmd" method="get">
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
                        Copy Seluruh Data RPJMDes
                    </button>

                </div>
                <!-- Modal -->
                <div class="modal fade" id="copyDataAll" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-light" id="staticBackdropLabel">Copy Data RPJMDes</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(session()->has('timpaAll'))
                                <div class="alert bg-danger text-white">Sudah ada data RPJMDes tahun {{
                                    session('timpaAll') }}
                                </div>
                                <form action="/adminDesa/copyRpjmdesAll" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tahuncopy">Tetap Copy dan timpa Data RPJMDes Tahun {{
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
                            <form action="/adminDesa/copyRpjmdesAll" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="tahuncopy">Copy Seluruh Data RPJMDes Tahun {{ $tahun }} ke Tahun
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
            <div class="text-dark">Tahun Data : {{ $tahun }} &emsp;&emsp; <span class="text-info">(Silahkan Update Data
                    RPJMDes Jika Ada Perubahan)</span>

            </div>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='dokumen' ? 'active' : '' }}" href="?jenis=dokumen&tahun={{ $tahun }}"
                        role="tab">Dokumen_RPJMD
                        <span class="fa fa-check-circle ml-1 {{ $dokumen==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='visi_misi' ? 'active' : '' }}"
                        href="?jenis=visi_misi&tahun={{ $tahun }}" role="tab">Visi-Misi
                        <span class="fa fa-check-circle ml-1 {{ $visimisi==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='potensi' ? 'active' : '' }}" href="?jenis=potensi&tahun={{ $tahun }}"
                        role="tab">Potensi Desa
                        <span class="fa fa-check-circle ml-1 {{ $potensi==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane active show " id="dokumen_RPJMD" role="tabpanel"
                    aria-labelledby="dokumen_RPJMD-tab">
                    @if($jenis=='dokumen')
                    @include('adminDesa.formDokren.dokumen_edit')
                    @elseif($jenis=='visi_misi')
                    @include('adminDesa.formDokren.visimisi_edit')
                    @elseif($jenis=='potensi')
                    @include('adminDesa.formDokren.potensi_edit')
                    @endif

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
<!-- jquery.inputmask -->
<script src="/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    bsCustomFileInput.init();

    $("#dokumen_rpjmd").change(function(event) {

getURL(this);
});

function getURL(input) {
if (input.files && input.files[0]) {
var reader = new FileReader();
var filename = $("#dokumen_rpjmd").val();

filename = filename.substring(filename.lastIndexOf('\\') + 1);
var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
if (cekgb == 'pdf' || cekgb == 'PDF') {
if(input.files[0]['size'] > 30720000){
    alert('ukuran file tidak boleh > 30 MB !');
    $('#dokumen_rpjmd').val("");
    $('.dokumen_rpjmd').html("Choose file PDF (max-size: 30MB)");
}else{
    
}

}else {
alert ("file harus berjenis 'PDF' ");
$('#dokumen_rpjmd').val("");
$('.dokumen_rpjmd').html("Choose file PDF (max-size: 30MB)");

}


}

}
</script>
<!-- bootstrap-progressbar -->
@if(session()->has('timpa'))
<script>
    $('#copyData').modal('show');

</script>
@endif
@if(session()->has('timpaAll'))
<script>
    $('#copyDataAll').modal('show');

</script>
@endif


@endpush