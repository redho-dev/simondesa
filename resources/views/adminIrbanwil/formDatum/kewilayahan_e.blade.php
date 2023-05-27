@extends('templates.desa.main')
@section('css')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
<script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
@endsection
@section('content')
<div class="clearfix"></div>
<div class="row justify-content-center mt-2">
    <div class="col-md-12 col-sm-12 ">
        <h5 class="alert alert-info">Form Update Data Monografi</h5>
        <div class="x_panel">
            <div class="x_title">
                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formKewilayahan" method="get">
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
                        Copy Seluruh Data Umum
                    </button>

                </div>
                <!-- Modal -->
                <div class="modal fade" id="copyDataAll" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-light" id="staticBackdropLabel">Copy Data Umum</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(session()->has('timpaAll'))
                                <div class="alert bg-danger text-white">Sudah ada data umum tahun {{
                                    session('timpaAll') }}
                                </div>
                                <form action="/adminDesa/copyDatumAll" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tahuncopy">Tetap Copy dan timpa Seluruh Data Umum Tahun {{
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
                            <form action="/adminDesa/copyDatumAll" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="tahuncopy">Copy Seluruh Data Umum Tahun {{ $tahun }} ke Tahun
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
            <div>Tahun Data : {{ $tahun }}
                <span class="ml-4 text-info">(Form update data {{ $jenis }})</span>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='kewilayahan' ? 'active' : '' }}"
                        href="?jenis=kewilayahan&tahun={{ $tahun }}" role="tab">Kewilayahan
                        <span class="fa fa-check-circle ml-1 {{ $kewilayahan==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='kependudukan' ? 'active' : '' }}"
                        href="?jenis=kependudukan&tahun={{ $tahun }}" role="tab">Kependudukan
                        <span class="fa fa-check-circle ml-1 {{ $kependudukan==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='pekerjaan' ? 'active' : '' }}"
                        href="?jenis=pekerjaan&tahun={{ $tahun }}" role="tab">Pekerjaan
                        <span class="fa fa-check-circle ml-1 {{ $pekerjaan==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='sarpras' ? 'active' : '' }}" href="?jenis=sarpras&tahun={{ $tahun }}"
                        role="tab">Sarana-Prasarana
                        <span class="fa fa-check-circle ml-1 {{ $sarpras==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='kelembagaan' ? 'active' : '' }}"
                        href="?jenis=kelembagaan&tahun={{ $tahun }}" role="tab">Kelembagaan
                        <span class="fa fa-check-circle ml-1 {{ $kelembagaan==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='papan' ? 'active' : '' }}" href="?jenis=papan&tahun={{ $tahun }}"
                        role="tab">Papan Monografi
                        <span class="fa fa-check-circle ml-1 {{ $papan==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane active show " role="tabpanel" aria-labelledby="kewilayahan-tab">
                    {{-- form update --}}
                    @if($jenis=='kewilayahan')
                    @include('adminDesa.formDatum.form_updatewil')
                    @elseif($jenis=='kependudukan')
                    @include('adminDesa.formDatum.form_updatependuduk')
                    @elseif($jenis=='sarpras')
                    @include('adminDesa.formDatum.form_updatepras')
                    @elseif($jenis=='kelembagaan')
                    @include('adminDesa.formDatum.form_updateKelembagaan')
                    @elseif($jenis=='pekerjaan')
                    @include('adminDesa.formDatum.form_updatePekerjaan')
                    @elseif($jenis=='papan')
                    @include('adminDesa.formDatum.form_updatePapan')
                    @endif
                    {{-- end form update --}}

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
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script>
    bsCustomFileInput.init();

    $("#file_papan").change(function(event) {

getURL(this);
});

function getURL(input) {
if (input.files && input.files[0]) {
    var reader = new FileReader();
    var filename = $("#file_papan").val();
    
    filename = filename.substring(filename.lastIndexOf('\\') + 1);
    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    if (cekgb == 'png' || cekgb == 'PNG' || cekgb == 'jpg' || cekgb == 'JPG' || cekgb == 'jpeg' || cekgb == 'JPEG') {
        if(input.files[0]['size'] > 1024000){
            alert('ukuran file tidak boleh > 1 Mb !');
            $('#file_papan').val("");
            $('.file_papan').html("File Image (max: 1MB)");
        }else{
            
        }
        
    }else {
        alert ("file harus berjenis 'jpg, jpeg, png' ");
        $('#file_papan').val("");
        $('.file_papan').html("File Image (max: 1MB)");
        
    }
    
    
}

}
</script>

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
<script>
    $('.hapus').on('click',function(){
      var yes = confirm('apakah anda yakin');
      var id = $(this).attr('id_hapus');
      if(yes){
        $.get( "{{ url('/adminDesa/hapusDatumPapan') }}", { id_hapus: id})
            .done(function( data ) {
                if(data == 1){
                    document.location.reload();
                }else{
                    alert('gagal hapus!');
                }
            });
      }
    });
</script>
@endpush