@extends('templates.desa.main')

@section('content')
<div class="clearfix"></div>
<div class="row justify-content-center mt-2 mb-4">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Data Penatausahaan Pajak</h5>
        <div class="x_panel">

            <div class="x_title">

                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formPenataanPajak" method="get">
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
                <div>Tahun Data : {{ $tahun }}</div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" href="?jenis=billing&tahun={{ $tahun }}" role="tab">Tanda Terima Setoran
                            Pajak
                            <span class="fa fa-check-circle ml-1 {{ $billing ? '' : 'd-none' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?jenis=buku&tahun={{ $tahun }}" role="tab">Buku Pembantu Pajak
                            <span class="fa fa-check-circle ml-1 {{ $buku ? '' : 'd-none' }}"></span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h4 class="mt-3 text-center">Klik Tab untuk lihat/tambah/update data</h4>
                    </div>
                </div>

                <br><br><br>
            </div>
        </div>
    </div>
</div>
<br>
<br>

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
<script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    bsCustomFileInput.init();

    $('.billing_pph').on('change', function(e){
        e.preventDefault();
        var file = $(this).val();
        getURL(this, file);

    })


    function getURL(input, data) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var filename = data;
        filename = filename.substring(filename.lastIndexOf('\\') + 1);
        var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    
        if (cekgb == 'pdf' || cekgb == 'PDF') {
            if(input.files[0]['size'] > 1024000){
                alert('ukuran file tidak boleh > 1 Mb !');
                $('.billing_pph').val("");
                
                $('.nama_file1').html("Choose file PDF (max-size: 1MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('.billing_pph').val("");
            $('.nama_file1').html("Choose PDF (max-size: 1MB)");
            
        }
               
        }

    }

    $('.billing_ppn').on('change', function(e){
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
                $('.billing_ppn').val("");
                
                $('.nama_file2').html("Choose file PDF (max-size: 1MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('.billing_ppn').val("");
            $('.nama_file2').html("Choose PDF (max-size: 1MB)");
            
        }
               
        }

    }
       
</script>


@endpush