@extends('templates.desa.main')

@section('content')
<div class="clearfix"></div>
<div class="row justify-content-center mt-2">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Data Pendirian BUM Desa</h5>
        <div class="x_panel">
            <div class="x_title">
                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formBumdes" method="get">
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
                        Copy Seluruh Data Pendirian BUM Desa
                    </button>

                </div>
                <!-- Modal -->
                <div class="modal fade" id="copyDataAll" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-light" id="staticBackdropLabel">Copy Data Pendirian BUM Desa
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(session()->has('timpaAll'))
                                <div class="alert bg-danger text-white">Sudah ada data Pendirian BUM Desa tahun {{
                                    session('timpaAll') }}
                                </div>
                                <form action="/adminDesa/copyPendirian" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tahuncopy">Tetap Copy dan timpa Data Pendirian BUM Desa Tahun {{
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
                            <form action="/adminDesa/copyPendirian" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="tahuncopy">Copy Seluruh Data Pendirian BUM Desa Tahun {{ $tahun }} ke
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
                    <a class="nav-link {{ $jenis=='pendirian' ? 'active' : '' }}"
                        href="?jenis=pendirian&tahun={{ $tahun }}" role="tab">Pendirian
                        <span class="fa fa-check-circle ml-1 {{ $pendirian==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ $jenis=='kepengurusan' ? 'active' : '' }}"
                        href="?jenis=kepengurusan&tahun={{ $tahun }}" role="tab">Kepengurusan
                        <span class="fa fa-check-circle ml-1 {{ $kepengurusan==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>


            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane active show " id="dokumen_bumdes" role="tabpanel"
                    aria-labelledby="dokumen_bumdes-tab">
                    @if($jenis == 'pendirian')
                    @include('adminDesa.bumdes.pendirianEdit')
                    @elseif($jenis == 'kepengurusan')
                    @include('adminDesa.bumdes.pengurusEdit')
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

@if(session()->has('timpaAll'))
<script>
    $('#copyDataAll').modal('show');
</script>
@endif

@endsection
@push('script')
<script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script>
    bsCustomFileInput.init();
</script>
<script>
    $('#badanHukum').on('change', function(){
    var jawab = $(this).val();
    if(jawab=='sudah'){
        $('#skHukum').removeClass('d-none');
    }else{
        $('#skHukum').addClass('d-none');
    }
 })


    $('.hapRus').on('click', function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        var tanya = confirm('apakah anda yakin hapus?');
        if(tanya){
            document.location.href= href;
        }
    })





$("#perdes_bumdes").change(function(event) {
getURL(this);
});

function getURL(input) {
if (input.files && input.files[0]) {
var reader = new FileReader();
var filename = $("#perdes_bumdes").val();

filename = filename.substring(filename.lastIndexOf('\\') + 1);
var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
if (cekgb == 'pdf' || cekgb == 'PDF' ) {
if(input.files[0]['size'] > 1024000){
alert('ukuran file tidak boleh > 1 MB !');
$('#perdes_bumdes').val("");
$('.perdes_bumdes').html("Choose file PDF (max-size: 1MB)");
}else{

}

}else {
alert ("file harus berjenis PDF ");
$('#perdes_bumdes').val("");
$('.perdes_bumdes').html("Choose file PDF (max-size: 1MB)");

}


}

}

$("#sk_kemenkum").change(function(event) {
getURL2(this);
});

function getURL2(input) {
if (input.files && input.files[0]) {
var reader = new FileReader();
var filename = $("#sk_kemenkum").val();

filename = filename.substring(filename.lastIndexOf('\\') + 1);
var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
if (cekgb == 'pdf' || cekgb == 'PDF' ) {
if(input.files[0]['size'] > 1024000){
alert('ukuran file tidak boleh > 1 MB !');
$('#sk_kemenkum').val("");
$('.sk_kemenkum').html("Choose file PDF (max-size: 1MB)");
}else{

}

}else {
alert ("file harus berjenis PDF ");
$('#sk_kemenkum').val("");
$('.sk_kemenkum').html("Choose file PDF (max-size: 1MB)");

}


}

}
</script>




@endpush