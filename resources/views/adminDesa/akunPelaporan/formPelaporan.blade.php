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
                        @include('adminDesa.akunPelaporan.pelaporanTambah ')
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
<script>
    $('.file_laporan').on('change', function(){
        
        var label = $(this).siblings('label');
        var text = label.attr('maks');
        var dafile = $(this).val();
        getURL(this, dafile, text);
    })

                        function getURL(input, dafile, text) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                var filename = dafile;
                                
                                filename = filename.substring(filename.lastIndexOf('\\') + 1);
                                var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                                if (cekgb == 'pdf' || cekgb == 'PDF') {
                                    if(input.files[0]['size'] > 5120000){
                                        alert('ukuran file tidak boleh > '+text+' MB !');
                                        $('.file_laporan').val("");
                                        $('.labfile').html("Choose file PDF (max-size: "+text+" MB)");
                                    }else{
                                        
                                    }
                                    
                                }else {
                                    alert ("file harus berjenis 'pdf' ");
                                    $('.file_laporan').val("");
                                    $('.labfile').html("Choose file PDF (max-size: "+text+" MB)");
                                    
                                }
                                
                                
                            }
                    
                        }
</script>
@endpush