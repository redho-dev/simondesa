@extends('templates.desa.main')

@section('content')
<div class="clearfix"></div>
<div class="row justify-content-center mt-2">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Kemandirian Tata Kelola</h5>
        <div class="x_panel">
            <div class="x_title">
                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formKemandirian" method="get">
                        @csrf
                        <div class="form-group mx-sm-3 mb-2">
                            <h6>Masukkan tahun data :</h6>
                            <input type="text" name="tahun" class="form-control ml-3" placeholder="{{ $tahun }}"
                                data-inputmask="'mask': '9999'" style="font-size: .85rem">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mb-2">Cek Data</button>
                    </form>

                    {{-- <button type="button" class="btn btn-primary ml-auto btn-sm" data-toggle="modal"
                        data-target="#copyDataAll">
                        Copy Seluruh Data Kemandirian Tata Kelola
                    </button> --}}

                </div>
                <!-- Modal -->
                <div class="modal fade" id="copyDataAll" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-light" id="staticBackdropLabel">Copy Data Kemandirian
                                    Tatakelola</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(session()->has('timpaAll'))
                                <div class="alert bg-danger text-white">Sudah ada data Kemandirian Tatakelola tahun {{
                                    session('timpaAll') }}
                                </div>
                                <form action="/adminDesa/copyKemandirianAll" method="post">
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
            <div class="text-dark">Tahun Data : {{ $tahun }}

            </div>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='pernyataan' ? 'active' : '' }}"
                        href="?jenis=pernyataan&tahun={{ $tahun }}" role="tab">Surat Pernyataan
                        <span class="fa fa-check-circle ml-1 {{ $pernyataan ? '' : 'd-none' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='sertifikat' ? 'active' : '' }}"
                        href="?jenis=sertifikat&tahun={{ $tahun }}" role="tab">Sertifikat Siskeudes
                        <span class="fa fa-check-circle ml-1 {{ $sertifikat ? '' : 'd-none' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='hasil' ? 'active' : '' }}" href="?jenis=hasil&tahun={{ $tahun }}"
                        role="tab">Hasil Pengujian
                        <span class="fa fa-check-circle ml-1 {{ $hasil ? '' : 'd-none' }}"></span>
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @if($jenis=='pernyataan')
                    @include('adminDesa.formKemandirian.pernyataan')
                    @elseif($jenis=='sertifikat')
                    @include('adminDesa.formKemandirian.sertifikat')
                    @elseif($jenis=='hasil')
                    @include('adminDesa.formKemandirian.hasil')
                    @endif
                </div>

            </div>
            <br><br><br>
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
<!-- jquery.inputmask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bs-custom-file-input/1.1.1/bs-custom-file-input.min.js"
    integrity="sha512-LGq7YhCBCj/oBzHKu2XcPdDdYj6rA0G6KV0tCuCImTOeZOV/2iPOqEe5aSSnwviaxcm750Z8AQcAk9rouKtVSg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    bsCustomFileInput.init();

    $('.pernyataan').on('change', function(e){
        e.preventDefault();
        var file = $(this).val();
        getURL2(this, file);

    })


    function getURL2(input, data) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var filename = data;
        filename = filename.substring(filename.lastIndexOf('\\') + 1);
        var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    
        if (cekgb == 'pdf' || cekgb == 'PDF') {
            if(input.files[0]['size'] > 1024000){
                alert('ukuran file tidak boleh > 1 Mb !');
                $('.pernyataan').val("");
                
                $('.label_pernyataan').html("File PDF (max-size: 1MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('.pernyataan').val("");
            $('.label_pernyataan').html("File PDF (max-size: 1MB)");
            
        }
               
        }

    }   

    $('.sertifikat').on('change', function(e){
        e.preventDefault();
        var file = $(this).val();
        getURL3(this, file);

    })


    function getURL3(input, data) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var filename = data;
        filename = filename.substring(filename.lastIndexOf('\\') + 1);
        var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    
        if (cekgb == 'pdf' || cekgb == 'PDF') {
            if(input.files[0]['size'] > 1024000){
                alert('ukuran file tidak boleh > 1 Mb !');
                $('.sertifikat').val("");
                
                $('.label_sertifikat').html("File PDF (max-size: 1MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('.sertifikat').val("");
            $('.label_sertifikat').html("File PDF (max-size: 1MB)");
            
        }
               
        }

    }  
</script>



@endpush