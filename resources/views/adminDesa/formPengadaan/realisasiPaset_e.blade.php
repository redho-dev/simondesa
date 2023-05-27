@extends('templates.desa.main')

@section('content')
<div class="clearfix"></div>
<div class="row justify-content-center mt-2 mb-4">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Data Pengadaan Barang dan Jasa - Belanja Modal (Aset Barang)</h5>
        <div class="x_panel">

            <div class="x_title">

                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/realisasiPemb" method="get">
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
                        <a class="nav-link {{ $jenis=='survey' ? 'active' : '' }}"
                            href="?jenis=survey&tahun={{ $tahun }}" role="tab">Survey Harga
                            <span class="fa fa-check-circle ml-1 {{ $survey ? '' : 'd-none' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='realisasi' ? 'active' : '' }}"
                            href="?jenis=realisasi&tahun={{ $tahun }}" role="tab">Realisasi
                            Belanja Modal (Aset Barang)
                            <span class="fa fa-check-circle ml-1 {{ $realisasi ? '' : 'd-none' }}"></span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        @if($jenis=='realisasi')
                        @include('adminDesa.formPengadaan.formDatapaset')
                        @elseif($jenis=='survey')
                        @include('adminDesa.formPengadaan.formSurveypasetupdate')
                        @endif
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

    {{-- notifikasi --}}
    @if(session()->has('fail'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: '{{ session("fail") }}',
            showConfirmButton: true
            })
    </script>

    @endif

    @endsection
    @push('script')
    <script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script>
        bsCustomFileInput.init();
        $('.angka').mask('000.000.000.000.000', {reverse: true});
        $('.hapus').on('click', function(){
            var yakin =confirm('anda yakin hapus?');

            if(yakin){
                var idhap = $(this).attr('idhap');
                var tr = $(this).parents('tr');
                $.get("/adminDesa/hapusBelanjaAset", { idhapus : idhap}).done(function(hasil){
                    if(hasil=='berhasil'){
                        Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'berhasil hapus',
                        showConfirmButton: false,
                        timer: 1500
                        });
                        tr.remove();
                    }else{
                        Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: hasil,
                        showConfirmButton: true
                       
                        });
                    }
                })
            }
            
        })

        $(".bukti").change(function(event) {
            var nfile = $(this).val();
            getURLbukti(this, nfile);
        });

        function getURLbukti(input, nfile) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = nfile;
            filename = filename.substring(filename.lastIndexOf('\\') + 1);
            var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
            if (cekgb == 'pdf' || cekgb == 'PDF') {
                if(input.files[0]['size'] > 1024000){
                    alert('ukuran file tidak boleh > 1 MB !');
                    $('.bukti').val("");
                    $('.label_bukti').html("Choose file PDF (max-size: 1MB)");
                }else{
                    
                }
                
            }else {
                alert ("file harus berjenis 'pdf' ");
                $('.bukti').val("");
                $('.label_bukti').html("Choose file PDF (max-size: 1MB)");
                
           }                      
        }
        }


        
    </script>
    <script src="/js/pengadaan.js"></script>

    @endpush