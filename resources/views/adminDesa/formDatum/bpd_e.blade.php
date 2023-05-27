@extends('templates.desa.main')
@section('css')
<style>
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
        <h5 class="alert alert-info">Form Update Data BPD</h5>
        <div class="x_panel">

            <div class="x_title">

                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formBPD" method="get">
                        @csrf
                        <div class="form-group mx-sm-3 mb-2">
                            <h6>Masukkan tahun data :</h6>
                            <input type="text" name="tahun" class="form-control ml-3" placeholder="{{ $tahun }}"
                                data-inputmask="'mask': '9999'" style="font-size: .85rem">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mb-2">Cek Data</button>
                    </form>

                    <button type="button" class="btn btn-primary ml-auto btn-sm" data-toggle="modal"
                        data-target="#copyDataBpdAll">
                        Copy Seluruh Data BPD
                    </button>

                </div>
                <!-- Modal -->
                <div class="modal fade" id="copyDataBpdAll" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-light" id="staticBackdropLabel">Copy Data BPD</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(session()->has('timpaBpd'))
                                <div class="alert bg-danger text-white">Sudah ada data BPD tahun {{
                                    session('timpaBpd') }}
                                </div>
                                <form action="/adminDesa/copyDatumBpdAll" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tahuncopy">Tetap Copy dan timpa Seluruh Data BPD Tahun {{
                                            $tahun }} ke
                                            Tahun {{ session('timpaBpd') }}
                                            :</label>
                                        <input type="hidden" name="tahuncopy" value="{{ session('timpaBpd') }}">
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
                            <form action="/adminDesa/copyDatumBpdAll" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="tahuncopy">Copy Seluruh Data BPD Tahun {{ $tahun }} ke Tahun
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
            <div>Tahun Data : {{ $tahun }}</div>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">

            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ $jabatan=='ketua_bpd' ? 'active' : '' }}"
                        href="?jabatan=ketua_bpd&tahun={{ $tahun }}" role="tab" aria-selected="true">Ketua_BPD<span
                            class='fa fa-check-circle ml-1 {{ $ketua==0 ? ' d-none' : '' }}'></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jabatan=='wakil_ketua_bpd' ? 'active' : '' }}"
                        href="?jabatan=wakil_ketua_bpd&tahun={{ $tahun }}" role="tab"
                        aria-selected="true">Wakil_Ketua_BPD<span class='fa fa-check-circle ml-1 {{ $wakil==0 ? '
                            d-none' : '' }}'></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jabatan=='sekretaris_bpd' ? 'active' : '' }}"
                        href="?jabatan=sekretaris_bpd&tahun={{ $tahun }}" role="tab"
                        aria-selected="true">Sekretaris_BPD<span class='fa fa-check-circle ml-1 {{ $sekretaris==0 ? '
                            d-none' : '' }}'></span></a>
                </li>
                <?php $i=1; ?>
                @foreach($bpds as $bpd)
                <li class="nav-item">
                    <a class="nav-link {{ $jabatan=='anggota_bpd_'.$i ? 'active' : '' }}"
                        href="?jabatan=anggota_bpd_{{ $i }}&tahun={{ $tahun }}" role="tab"
                        aria-selected="true">Anggota_{{
                        $i }} <span class='fa fa-check-circle ml-1 {{ $bpd == 0 ? "d-none" : "" }}'></span></a>
                </li>
                <?php $i++; ?>
                @endforeach
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form action="/adminDesa/updateDatumBpd" method="post" enctype="multipart/form-data"
                        class="form-horizontal form-label-left">
                        @csrf

                        <div class="form-group row ">
                            <label class="control-label col-md-2 col-sm-2 ">Jabatan</label>
                            <div class="col-md-5 col-sm-5 ">
                                <input type="text" name="jabatan" class="form-control" value="{{ $jabatan }}"
                                    style="font-size: .85rem" readonly>
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <input type="hidden" name="asal_id" value="{{ $data->asal_id }}">
                                <input type="hidden" name="tahun" value="{{ $tahun }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2 col-sm-2 ">Status Jabatan</label>
                            <div class="col-md-5 col-sm-5 ">
                                <select class="form-control" style="font-size: .85rem" name="status_jab" required>
                                    <option value="definitif" {{ $data->status_jab == 'definitif' ? 'selected' :
                                        ''}}>Definitif</option>
                                    <option value="pj" {{ $data->status_jab == 'pj' ? 'selected' : ''}} >
                                        Penjabat (Pj)
                                    </option>
                                    <option value="plt" {{ $data->status_jab == 'plt' ? 'selected' : ''}}>Pelaksana
                                        Tugas</option>
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
                                    value="{{ old('nama',$data->nama ) }}" required>
                            </div>
                            @error('nama')
                            <div><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2 col-sm-2 ">Tempat Lahir </label>
                            <div class="col-md-5 col-sm-5 ">
                                <input type="text" class="form-control " name="tempat_lahir" style="font-size: .85rem"
                                    value="{{ old('tempat_lahir', $data->tempat_lahir) }}" required>
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
                                    value="{{ old('tgl_lahir', $data->tgl_lahir) }}" required>
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
                                    <input type="radio" name="jenkel" value="L" {{ $data->jenkel == 'L' ? 'checked'
                                    : '' }} />
                                    Laki-laki
                                    <input type="radio" class="ml-3" name="jenkel" value="P" {{ $data->jenkel == 'P'
                                    ? 'checked'
                                    : '' }} />
                                    Perempuan

                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2 col-sm-2 ">Agama </label>
                            <div class="col-md-3 col-sm-3">
                                <input type="text" class="form-control" name="agama"
                                    value="{{ old('agama', $data->agama) }}" style="font-size: .85rem">
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <input type="text" class="form-control" name="hp" value="{{ old('hp', $data->hp) }}"
                                    style="font-size: .85rem">
                                <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>

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
                                        value="{{ old('nomor_sk', $data->nomor_sk) }}" style="font-size: .85rem"
                                        required></span>

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
                                        style="font-size: .85rem; border-radius: 0;"
                                        value="{{ old('sejak', $data->sejak) }}" required>s.d<input type="text"
                                        data-inputmask="'mask': '9999'" name="sampai" class="form-control mx-2"
                                        placeholder="tahun berakhir" style="font-size: .85rem; border-radius: 0;"
                                        value="{{ old('sampai', $data->sampai) }}"></span>

                            </div>
                            @error('sejak')
                            <div><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2 col-sm-2 ">Upload SK Jabatan </label>
                            <div class="col-md-1 col-sm-1 ">
                                <a href="{{ asset('storage/'.$data->file_sk) }}" target="_blank">
                                    <img src="/img/logo-pdf.webp" width="100%"></a>
                            </div>

                            <div class="col-md-4 col-sm-4 ">
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" name="file_sk" class="custom-file-input" id="file_sk"
                                            aria-describedby="inputGroupFileAddon01">
                                        <input type="hidden" name="oldSk" value="{{ $data->file_sk }}">
                                        <label class="custom-file-label text-muted file_sk" for="file_sk">
                                            ganti file PDF (max: 1Mb)
                                        </label>
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
                                    <option value="">Pilih</option>
                                    <option value="SD/Sederajat" {{ $data->pendidikan == 'SD/Sederajat' ? 'selected'
                                        : '' }}>SD/Sederajat</option>
                                    <option value="SMP/Sederajat" {{ $data->pendidikan == 'SMP/Sederajat' ?
                                        'selected'
                                        : '' }}>SMP/Sederajat</option>
                                    <option value="SMA/Sederajat" {{ $data->pendidikan == 'SMA/Sederajat' ?
                                        'selected'
                                        : '' }}>SMA/Sederajat</option>
                                    <option value="Diploma" {{ $data->pendidikan == 'Diploma' ? 'selected'
                                        : '' }}>Diploma</option>
                                    <option value="Sarjana/S1" {{ $data->pendidikan == 'Sarjana/S1' ? 'selected'
                                        : '' }}>Sarjana/S1</option>
                                    <option value="Magister/S2" {{ $data->pendidikan == 'Magister/S2' ? 'selected'
                                        : '' }}>Magister/S2</option>
                                    <option value="Doktoral/S3" {{ $data->pendidikan == 'Doktoral/S3' ? 'selected'
                                        : '' }}>Doktoral/S3</option>

                                </select>
                            </div>
                            @error('pendidikan')
                            <div><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2 col-sm-2 ">Upload Ijazah Terakhir </label>
                            <div class="col-md-1 col-sm-1 ">
                                <a href="{{ asset('storage/'.$data->file_ijazah) }}" target="_blank">
                                    <img src="/img/logo-pdf.webp" width="100%" title="Klik untuk lihat file ijazah"></a>
                            </div>
                            <div class="col-md-4 col-sm-4 ">
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" name="file_ijazah" class="custom-file-input" id="file_ijazah"
                                            aria-describedby="inputGroupFileAddon01">
                                        <input type="hidden" name="oldIjazah" value="{{ $data->file_ijazah }}">
                                        <label class="custom-file-label text-muted file_ijazah" for="file_ijazah">ganti
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
                                                class='fa fa-file'></span> Ganti foto (image)</a>
                                    </label>
                                    <input type="file" name="foto_perangkat" id="foto_perangkat" style="display: none">
                                    <input type="hidden" name="oldImage" value="{{ $data->foto_image }}">
                                </p>
                                <div class="foto_p">
                                    @if($data->foto_perangkat)

                                    <img src="{{ asset('storage/'.$data->foto_perangkat) }}"
                                        class="gb_perangkat img-fluid" width="150">
                                    @else
                                    <p class="nfile">no_image</p>
                                    <img src="/img/no_image.png" class="gb_perangkat" width="150">
                                    @endif
                                </div>
                            </div>

                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-5 col-sm-5  offset-md-2">
                                <a href="/adminDesa/formPerangkat" class="btn btn-info">Cancel</a>

                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#copyData">
                                    Copy Data
                                </button>
                                <button type=" submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>

                    </form>


                    <!-- Modal -->
                    <div class="modal fade" id="copyData" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                    <h5 class="modal-title" id="staticBackdropLabel">From Salin Data Perangkat</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @if(session()->has('timpa'))
                                    <div class="alert bg-danger text-white">Sudah ada data {{ $jabatan. ' tahun
                                        '.session('timpa') }}
                                    </div>
                                    <form action="/adminDesa/copyDatumBpd" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="tahuncopy" style="font-size: 1rem">Apakah anda yakin timpa data
                                                {{ $jabatan }}
                                                dengan yang baru
                                                ?
                                            </label>
                                            <input type="hidden" class="form-control" id="tahuncopy" name="tahuncopy"
                                                value="{{ session('timpa') }}">
                                            <input type="hidden" name="id" value="{{ $data->id }}">
                                            <input type="hidden" name="asal_id" value="{{ $data->asal_id }}">
                                            <input type="hidden" name="jabatan" value="{{ $jabatan }}">
                                            <input type="hidden" name="tahunasal" value="{{ $tahun }}">
                                            <input type="hidden" name="timpadata" value="true">

                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Timpa Data</button>
                                </div>
                                </form>
                                @else

                                <form action="/adminDesa/copyDatumBpd" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tahuncopy" style="font-size: 1rem">Copy Seluruh Data {{ $jabatan }}
                                            ke Tahun
                                            :</label>
                                        <select class="form-control" id="tahuncopy" name="tahuncopy" required>
                                            <option value="">== pilih tahun ==</option>
                                            <option>{{ $tahun+1 }}</option>
                                            <option>{{ $tahun+2 }}</option>
                                            <option>{{ $tahun+3 }}</option>

                                        </select>
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <input type="hidden" name="asal_id" value="{{ $data->asal_id }}">
                                        <input type="hidden" name="jabatan" value="{{ $jabatan }}">
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
            </div>
            <br><br><br>
        </div>
    </div>
</div>
<br>


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

@if(session()->has('fail'))
<script>
    Swal.fire({
    icon: 'error',
    title: '{{ session("fail") }}',
    showConfirmButton: true
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

@if(session()->has('timpaBpd'))
<script>
    $('#copyDataBpdAll').modal('show');

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