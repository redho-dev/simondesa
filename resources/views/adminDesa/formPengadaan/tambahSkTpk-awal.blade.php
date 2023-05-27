@extends('templates.desa.main')

@section('content')
<div class="clearfix"></div>
<div class="row justify-content-center mt-2 mb-4">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update RKP Desa</h5>
        <div class="x_panel">

            <div class="x_title">

                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formDokren" method="get">
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
                        <a class="nav-link active" role="tab">SK Tim Pelaksana Kegiatan
                            <span class="fa fa-check-circle ml-1"></span>
                        </a>
                    </li>

                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <div class="row mt-2">
                            <div class="col-md-6 alert alert-info">
                                <span class="">Silahkan Upload SK Tim Pelaksana Kegiatan (TPK) Tahun {{
                                    $tahun }}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <form action="/adminDesa/tambahTPK" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value=" {{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value=" {{ $tahun }}">

                                    <table class="table table-bordered">
                                        <tr>
                                            <th>
                                                <input type="hidden" name="nama_data" value="sk_tpk">
                                                SK Tim Pelaksana Kegiatan
                                            </th>
                                            <th>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="custom-file py-0">
                                                            <input type="file" name="sk_tpk" class="custom-file-input"
                                                                id="sk_tpk" required>
                                                            <label class="custom-file-label text-muted sk_tpk"
                                                                for="sk_tpk">Choose
                                                                file PDF
                                                                (max-size: 1MB)</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </th>

                                        </tr>
                                        <tr>
                                            <th colspan="2" class="text-right">
                                                <button type="submit" class="btn btn-primary">Kirim Data</button>
                                            </th>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <br><br><br>
            </div>
        </div>
    </div>
    <br>
    <br>
    @endsection
    @push('script')
    <script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script>
        bsCustomFileInput.init();

        $("#sk_tpk").change(function(event) {

        getURL(this);
        });

        function getURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = $("#sk_tpk").val();
            
            filename = filename.substring(filename.lastIndexOf('\\') + 1);
            var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
            if (cekgb == 'pdf' || cekgb == 'PDF') {
                if(input.files[0]['size'] > 1024000){
                    alert('ukuran file tidak boleh > 1 Mb !');
                    $('#sk_tpk').val("");
                    $('.sk_tpk').html("Choose file PDF (max-size: 1MB)");
                }else{
                    
                }
                
            }else {
                alert ("file harus berjenis 'pdf' ");
                $('#sk_tpk').val("");
                $('.sk_tpk').html("Choose file PDF (max-size: 1MB)");
                
            }
            
            
        }

        }
    </script>

    @endpush