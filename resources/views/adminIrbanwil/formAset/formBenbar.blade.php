@extends('templates.desa.main')

@section('content')

<div class="clearfix"></div>
<div class="row justify-content-center mt-2">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Pengurus/Bendahara Barang Desa</h5>
        <div class="x_panel">
            <div class="x_title">
                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formBenbar" method="get">
                        @csrf
                        <div class="form-group mx-sm-3 mb-2">
                            <h6>Masukkan tahun data :</h6>
                            <input type="text" name="tahun" class="form-control ml-3" placeholder="{{ $tahun }}"
                                data-inputmask="'mask': '9999'" style="font-size: .85rem">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mb-2">Cek Data</button>
                    </form>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm ml-auto  d-none" data-toggle="modal"
                        data-target="#copyDataAll">
                        Copy Data Holder
                    </button>

                </div>
                <!-- Modal -->
                <div class="modal fade" id="copyDataAll" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-light" id="staticBackdropLabel">Copy Seluruh Data Holder
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(session()->has('timpaAll'))
                                <div class="alert bg-danger text-white">Sudah ada data Holder tahun {{
                                    session('timpaAll') }}
                                </div>
                                <form action="/adminDesa/copyHolderAll" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tahuncopy">Tetap Copy dan timpa Data Holder Tahun {{
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
                            <form action="/adminDesa/copyHolderAll" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="tahuncopy">Copy Seluruh Data Holder Tahun {{ $tahun }} ke Tahun
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
                    <a class="nav-link active" href="" role="tab">Pengurus/Bendahara Barang
                        <span class="fa fa-check-circle ml-1 {{ $benbar==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane active show " id="aset" role="tabpanel" aria-labelledby="aset-tab">
                    <div class="row my-4">
                        <div class="col-md-6 alert alert-info">
                            <span class="">Silahkan Input Data Pengurus/Bendahara Barang Desa Tahun {{
                                $tahun }}</span>
                        </div>
                    </div>

                    <form action="/adminDesa/tambahBenbar" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="asal_id" value=" {{ $infos->asal_id }}">
                        <input type="hidden" name="tahun" value=" {{ $tahun }}">

                        <div class="row">
                            <div class="col-md-3">
                                <p for="">Nama Pengurus/Bendahara Barang</p>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="nama" class="form-control" style="font-size: .85rem" autofocus>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <p>SK Pengurus/Bendahara Barang</p>
                            </div>
                            <div class="col-md-3 mt-2">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="custom-file py-0">
                                            <input type="file" name="sk_benbar" class="custom-file-input" id="sk_benbar"
                                                required>
                                            <label class="custom-file-label text-muted sk_benbar" for="sk_benbar">Choose
                                                file PDF
                                                (max-size: 1MB)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary mt-4">Kirim Data</button>
                            </div>
                        </div>
                    </form>

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

<script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    bsCustomFileInput.init();
</script>

@if(session()->has('timpaAll'))
<script>
    $('#copyDataAll').modal('show');

</script>
@endif

<script>
    $("#sk_benbar").change(function(event) {

        getURL2(this);
        });

    function getURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var filename = $("#sk_benbar").val();
                
                filename = filename.substring(filename.lastIndexOf('\\') + 1);
                var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                if (cekgb == 'pdf' || cekgb == 'PDF' ) {
                    if(input.files[0]['size'] > 1024000){
                        alert('ukuran file tidak boleh > 1 MB !');
                        $('#sk_benbar').val("");
                        $('.sk_benbar').html("Choose file PDF (max-size: 1MB)");
                    }else{

                    }
                    
                }else {
                    alert ("file harus berjenis PDF ");
                    $('#sk_benbar').val("");
                    $('.sk_benbar').html("Choose file PDF (max-size: 1MB)");
                    
                }
                
                
            }

    }

       
        


   

    

   
</script>

@endpush