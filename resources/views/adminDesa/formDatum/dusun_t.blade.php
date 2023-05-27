@extends('templates.desa.main')
@section('css')
<style>
    .container {
        height: 150vh;
    }

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
        <h5 class="alert alert-info">Form Input Data Kepala Dusun / Ketua RT</h5>
        <div class="mb-2">
            <a class="btn btn-primary btn-sm" href="/adminDesa/formDusun">Kepala Dusun</a>
            <a class="btn btn-secondary btn-sm" href="/adminDesa/formRT">Ketua RT</a>
        </div>
        <div class="x_panel">
            <div class="x_title">
                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formDusun" method="get">
                        @csrf
                        <div class="form-group mx-sm-3 mb-2">
                            <h6>Masukkan tahun data :</h6>
                            <input type="text" name="tahun" class="form-control ml-3" placeholder="{{ $tahun }}"
                                data-inputmask="'mask': '9999'" style="font-size: .85rem">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mb-2">Cek Data</button>
                    </form>

                    <button type="button" class="btn btn-primary ml-auto btn-sm" data-toggle="modal"
                        data-target="#copyDataDusAll">
                        Copy Seluruh Data Kepala Dusun
                    </button>

                </div>
                <!-- Modal -->
                <div class="modal fade" id="copyDataDusAll" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-light" id="staticBackdropLabel">Copy Data Kepala Dusun
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(session()->has('timpaDus'))
                                <div class="alert bg-danger text-white">Sudah ada data kepala dusun tahun {{
                                    session('timpaDus') }}
                                </div>
                                <form action="/adminDesa/copyDatumDusAll" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tahuncopy">Copy dan timpa Seluruh Data kepala dusun Tahun
                                            {{
                                            $tahun }} ke
                                            Tahun {{ session('timpaDus') }}
                                            ?</label>
                                        <input type="hidden" name="tahuncopy" value="{{ session('timpaDus') }}">
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
                            <form action="/adminDesa/copyDatumDusAll" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="tahuncopy">Copy Seluruh Data Kepala Dusun Tahun {{ $tahun }} ke
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
            <div>Tahun Data : {{ $tahun }}
                <span class="ml-4 text-info">(Silahkan Input data {{ $jabatan }} dibawah ini selengkap mungkin)</span>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">

            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                <?php $i=1; ?>
                @foreach($kadusun as $kadus)
                <li class="nav-item">
                    <a class="nav-link" id="{{ $jabatan=='Kadus_'.$i ? 'tabaktif' : '' }}"
                        href="?jabatan=Kadus_{{ $i }}&tahun={{ $tahun }}" role="tab" aria-selected="true">Kadus_{{
                        $i }} <span class='fa fa-check-circle ml-1 {{ $kadus == 0 ? "d-none" : "" }}'></span></a>
                </li>
                <?php $i++; ?>
                @endforeach
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form action="/adminDesa/tambahDatumDus" method="post" enctype="multipart/form-data"
                        class="form-horizontal form-label-left">
                        @csrf

                        <div class="form-group row ">
                            <label class="control-label col-md-2 col-sm-2 ">Jabatan</label>
                            <div class="col-md-5 col-sm-5 ">
                                <input type="text" name="jabatan" class="form-control" value="{{ $jabatan }}"
                                    style="font-size: .85rem" readonly>
                                <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                <input type="hidden" name="tahun" value="{{ $tahun }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2 col-sm-2 ">Status Jabatan</label>
                            <div class="col-md-5 col-sm-5 ">
                                <select class="form-control" style="font-size: .85rem" name="status_jab" required>
                                    <option value="definitif">Definitif</option>
                                    <option value="pj">Penjabat (Pj)</option>
                                    <option value="plt">Pelaksana Tugas</option>
                                </select>
                            </div>
                            @error('status_jab')
                            <div><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2 col-sm-2 ">Nama </label>
                            <div class="col-md-5 col-sm-5 ">
                                <input type="text" class="form-control" name="nama" style="font-size: .85rem"
                                    value="{{ old('nama') }}" required>
                            </div>
                            @error('nama')
                            <div><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-2 col-sm-2 ">Tempat Lahir </label>
                            <div class="col-md-5 col-sm-5 ">
                                <input type="text" class="form-control " name="tempat_lahir" style="font-size: .85rem"
                                    value="{{ old('tempat_lahir') }}" required>
                            </div>
                            @error('tempat_lahir')
                            <div><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2 col-sm-2 ">Tanggal Lahir</label>

                            <div class="col-md-5 col-sm-5 col-xs-9">
                                <input type="text" name="tgl_lahir" class="form-control"
                                    data-inputmask="'mask': '99/99/9999'" style="font-size: .85rem; border-radius: 0;"
                                    value="{{ old('tgl_lahir') }}" required>
                                <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                            </div>
                            @error('tgl_lahir')
                            <div><small class="text-danger">{{ $message }}</small></div>
                            @enderror

                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2 col-sm-2 ">Jenis Kelamin</label>
                            <div class="col-md-5 col-sm-5 d-flex align-items-center">
                                <span>
                                    <input type="radio" name="jenkel" value="L" checked="" />
                                    Laki-laki
                                    <input type="radio" class="ml-3" name="jenkel" value="P" />
                                    Perempuan

                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2 col-sm-2 ">Agama </label>
                            <div class="col-md-5 col-sm-5">
                                <input type="text" class="form-control" name="agama" value="{{ old('agama') }}"
                                    style="font-size: .85rem">
                            </div>
                            @error('agama')
                            <div><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2 col-sm-2 ">SK Jabatan </label>
                            <div class="col-md-5 col-sm-5 ">
                                <span class="input-group-text" style="font-size: .85rem; border-radius: 0;">Nomor
                                    : <input type="text" class="form-control ml-2" name="nomor_sk"
                                        value="{{ old('nomor_sk') }}" style="font-size: .85rem" required></span>

                            </div>
                            @error('nomor_sk')
                            <div><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2 col-sm-2 ">Masa Berlaku SK Jabatan</label>
                            <div class="col-md-5 col-sm-5 ">
                                <span class="input-group-text" style="font-size: .85rem; border-radius: 0;">sejak
                                    : <input type="text" name="sejak" class="form-control mx-2"
                                        data-inputmask="'mask': '99/99/9999'"
                                        style="font-size: .85rem; border-radius: 0;" value="{{ old('sejak') }}"
                                        required>s.d<input type="text" name="sampai" class="form-control mx-2"
                                        data-inputmask="'mask': '9999'" placeholder="tahun berakhir"
                                        style="font-size: .85rem; border-radius: 0;" value="{{ old('sampai') }}"></span>

                            </div>
                            @error('sejak')
                            <div><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2 col-sm-2 ">Upload SK Jabatan </label>
                            <div class="col-md-5 col-sm-5 ">
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" name="file_sk" class="custom-file-input" id="file_sk"
                                            aria-describedby="inputGroupFileAddon01" required>
                                        <label class="custom-file-label text-muted file_sk" for="file_sk">Choose
                                            file PDF
                                            (max-size: 1MB)</label>
                                    </div>
                                </div>
                            </div>
                            @error('file_sk')
                            <div><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-2 col-sm-2 ">Pendidikan Terakhir</label>
                            <div class="col-md-5 col-sm-5 ">
                                <select class="form-control" style="font-size: .85rem" name="pendidikan" required>
                                    <option value="">== Pilih ==</option>
                                    <option value="SD/Sederajat">SD/Sederajat</option>
                                    <option value="SMP/Sederajat">SMP/Sederajat</option>
                                    <option value="SMA/Sederajat">SMA/Sederajat</option>
                                    <option value="Diploma">Diploma</option>
                                    <option value="Sarjana/S1">Sarjana/S1</option>
                                    <option value="Magister/S2">Magister/S2</option>
                                    <option value="Doktoral/S3">Doktoral/S3</option>

                                </select>
                            </div>
                            @error('pendidikan')
                            <div><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2 col-sm-2 ">Upload Ijazah Terakhir </label>
                            <div class="col-md-5 col-sm-5 ">
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" name="file_ijazah" class="custom-file-input" id="file_ijazah"
                                            aria-describedby="inputGroupFileAddon01" required>
                                        <label class="custom-file-label text-muted file_ijazah" for="file_ijazah">Choose
                                            file PDF
                                            (max-size: 1MB)</label>
                                    </div>
                                </div>
                            </div>
                            @error('file_ijazah')
                            <div><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2 col-sm-2 ">Upload Foto {{ $jabatan }}</label>
                            <div class="col-md-5 col-sm-5">
                                <p class="image_upload mb-0">
                                    <label for="foto_perangkat">
                                        <a class="btn btn-warning btn-sm" rel="nofollow"><span
                                                class='fa fa-file'></span> Sisipkan foto (image)</a>
                                    </label>
                                    <input type="file" name="foto_perangkat" id="foto_perangkat" style="display: none">
                                </p>
                                <div class="foto_p" style="display: none">
                                    <p class="nfile">nama file</p><img src="/img/logo.png" class="gb_perangkat"
                                        width="150">
                                </div>
                                @error('foto_perangkat')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-5 col-sm-5  offset-md-2">
                                <button type="button" class="btn btn-info">Cancel</button>
                                <button type="reset" class="btn btn-info">Reset</button>
                                <button type="submit" class="btn btn-primary">Kirim Data</button>
                            </div>
                        </div>

                    </form>
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
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script src="/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
@if(session()->has('timpa'))
<script>
    $('#copyData').modal('show');

</script>
@endif

@if(session()->has('timpaDus'))
<script>
    $('#copyDataDusAll').modal('show');

</script>
@endif
<script>
    bsCustomFileInput.init();
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
                if(input.files[0]['size'] > 1024000){
                    alert('ukuran file tidak boleh > 1 Mb !');
                    $('#file_sk').val("");
                    $('.file_sk').html("Choose file PDF (max: 1MB)");
                }else{
                    
                }
                
            }else {
                alert ("file harus berjenis 'pdf' ");
                $('#file_sk').val("");
                $('.file_sk').html("Choose file PDF (max: 1MB)");
                
            }
            
            
        }

    }

    $("#file_ijazah").change(function(event) {

        getURL3(this);
    });

    function getURL3(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var filename = $("#file_ijazah").val();
        
        filename = filename.substring(filename.lastIndexOf('\\') + 1);
        var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
        if (cekgb == 'pdf' || cekgb == 'PDF') {
            if(input.files[0]['size'] > 1024000){
                alert('ukuran file tidak boleh > 1 Mb !');
                $('#file_ijazah').val("");
                $('.file_ijazah').html("Choose file PDF (max: 1MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('#file_ijazah').val("");
            $('.file_ijazah').html("Choose file PDF (max: 1MB)");
            
        }
        
        
    }

    }

// upload foto perangkat
$("#foto_perangkat").change(function(event) {
    getURL2(this);
});


function getURL2(input) {
if (input.files && input.files[0]) {
    var reader = new FileReader();
    var filename = $("#foto_perangkat").val();
    filename = filename.substring(filename.lastIndexOf('\\') + 1);
    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    if (cekgb == 'jpg' || cekgb == 'JPG' || cekgb == 'png' || cekgb == 'jpeg' || cekgb == 'jfif') {
        if(input.files[0]['size'] > 1024000)
        {
            alert("file tidak diperkenankan > 1Mb");
            $('#foto_perangkat').val("");
        }else{

            $('.foto_p').show();
            $('.nfile').html(filename);

            reader.onload = function(e) {
                debugger;
                $('.gb_perangkat').attr('src', e.target.result);
                $('.gb_perangkat').hide();
                $('.gb_perangkat').fadeIn(500);

            }
             reader.readAsDataURL(input.files[0]);
        }



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