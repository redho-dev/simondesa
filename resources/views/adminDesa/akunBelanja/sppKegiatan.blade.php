@php
if ($anggaran=='perubahan') {
$anggaran = 'anggaran_perubahan';
$status = 'Anggaran Perubahan';
}else{
$anggaran = 'anggaran_murni';
$status = 'Anggaran Murni';
}
@endphp
<p class="text-info mt-2">Silahkan Cek/Input/Update Dokumen SPP per Kegiatan</p>
<div class="row mt-4">

    <div class="col-md-6">
        <form id="formSPP" action="/adminDesa/formPenataanBelanja" method="get">
            {{-- <input type="hidden" id="asal_id" name="asal_id" value="{{ $infos->asal_id }}"> --}}
            <input type="hidden" id="tahun" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="jenis" value="spp_kegiatan">
            <select class="custom-select custom-select-sm" style="font-size: .8rem" id="pilihKegiatan" name="kegiatan"
                required>
                <option selected value="">Pilih Kegiatan</option>
                @foreach($apbdes_kegiatans as $keg)
                @if($keg->$anggaran)
                <option value="{{ $keg->id }}" {{ Request('kegiatan')==$keg->id ? 'selected' : '' }}>{{
                    $keg->kode_kegiatan." ".$keg->kegiatan->kegiatan }}</option>
                @endif
                @endforeach
            </select>
    </div>
    <div class="col-md-4">
        <button class="btn btn-sm btn-primary" id="carkeg" type="submit" style="font-size: .80rem">Cek SPP</button>
    </div>
    </form>
</div>
<hr>
<div id="dokumen_spp">
    @if(Request('kegiatan'))
    @php
    $apbdes_kegiatan = $apbdes_kegiatans->where('id', Request('kegiatan'));
    @endphp
    <div class="row">
        <div class="col-md-10">
            <table class="table table-bordered">
                <tr class="table-secondary">

                    <th>Kegiatan :</th>
                    <th colspan="5"> {{ $kegiatan_spp->kegiatan->kegiatan }}</th>


                </tr>
                <tr>
                    <th>Anggaran Kegiatan
                    </th>
                    <th>Rp. <input type="text" class="angka" id="anggKeg" value="{{ $kegiatan_spp->$anggaran }}"
                            disabled></th>
                    <th>Akumulasi SPP</th>
                    <th>Rp. <input type="text" id="SPPkeg" disabled> </th>
                    <th>Sisa Anggaran</th>
                    <th>Rp. <input type="text" id="sisA" disabled></th>
                </tr>
            </table>
        </div>
    </div>
    {{-- Awal --}}
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
        data-target="#tambahSPP{{ $kegiatan_spp->id }}">
        Tambah SPP
    </button>
    <!-- Modal -->
    <div class="modal fade" id="tambahSPP{{ $kegiatan_spp->id }}" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-dark" id="staticBackdropLabel">Form Tambah SPP
                        Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/adminDesa/tambahSPP" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                    <input type="hidden" name="kegiatan_id" value="{{ $kegiatan_spp->kegiatan_id }}">
                    <input type="hidden" name="apbdes_kegiatan_id" value="{{ $kegiatan_spp->id }}">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="kegiatan">Nama Kegiatan</label>
                            <input type="text" class="form-control" id="kegiatan"
                                value="{{ $kegiatan_spp->kegiatan->kegiatan }}" style="font-size: .75rem" readonly>
                        </div>
                        <div class="form-group  mb-3">
                            <label>Nomor SPP</label>
                            <input type="text" name="nomor" class="form-control" style="font-size: .85rem" required>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group  mb-3">
                                    <label>Jumlah dana yang diminta</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" style="font-size: .85rem">Rp.
                                            </div>
                                        </div>
                                        <input type="text" name="jumlah" class="form-control jumlah"
                                            id="inlineFormInputGroup" style="font-size: .85rem">
                                    </div>

                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group  mb-3">
                                    <label>Tanggal SPP</label>
                                    <input type="date" name="tanggal" class="form-control" style="font-size: .85rem"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group  mb-3 mt-2">
                            <label>Upload Dokumen SPP + Lampiran
                            </label>
                            <div class="custom-file">
                                <input type="file" name="file_spp" class="custom-file-input file_spp" id="customFile "
                                    required>
                                <label class="custom-file-label nama_file" for="customFile"
                                    style="font-size: .85rem">Choose file PDF max:
                                    2MB</label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">KIRIM DATA</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-10">
            <table class="table table-bordered">
                <tr style="background-color: azure">
                    <th style="vertical-align: middle">#</th>
                    <th style="vertical-align: middle">Nomor SPP</th>
                    <th style="vertical-align: middle">Tanggal</th>
                    <th style="vertical-align: middle">Jumlah Uang (Rp)</th>
                    <th class="text-center" style="vertical-align: middle">File_SPP
                        <br>(+Lampiran)
                    </th>
                    <th class="text-center" style="vertical-align: middle">Aksi</th>

                </tr>
                @foreach($apbdes_kegiatan as $keg)
                @foreach($keg->penataanbelanja_spp as $spp)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $spp->nomor }} </td>
                    <td>{{ $spp->tanggal }}</td>
                    <td class="jumlahSPP angka">{{ $spp->jumlah }}</td>
                    <td class="text-center">
                        <a href="{{ asset('storage/'.$spp->file_spp) }}" target="_blank"><img src="/img/logo-pdf.jpg"
                                width="35px"></a>
                    </td>

                    <td class="text-center">
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#editSPP{{ $spp->id }}" style="font-size: .75rem">
                                Edit
                            </button>
                            <form action="/adminDesa/hapusSPP/{{ $spp->id }}" method="post">
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit"
                                    onclick="return confirm('yakin hapus?');">hapus</button>
                            </form>
                        </div>
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="editSPP{{ $spp->id }}" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form
                                        Edit/Update SPP</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/updateSPP" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="id" value="{{ $spp->id }}">
                                    <input type="hidden" name="apbdes_kegiatan_id"
                                        value="{{ $spp->apbdes_kegiatan_id }}">


                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label for="kegiatan">Nama Kegiatan</label>
                                            <input type="text" class="form-control" id="kegiatan"
                                                style="font-size: .75rem" value="{{ $keg->kegiatan->kegiatan }}"
                                                readonly>
                                        </div>
                                        <div class="form-group  mb-3">
                                            <label>Nomor SPP</label>
                                            <input type="text" name="nomor" class="form-control"
                                                style="font-size: .85rem" value="{{ $spp->nomor }}" required>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group  mb-3">
                                                    <label>Jumlah Uang Diminta</label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="font-size: .85rem">Rp.
                                                            </div>
                                                        </div>
                                                        <input type="text" name="jumlah"
                                                            class="form-control jumlah angka" id="inlineFormInputGroup"
                                                            style="font-size: .85rem" value="{{ $spp->jumlah }}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group  mb-3">
                                                    <label>Tanggal SPP</label>
                                                    <input type="date" name="tanggal" class="form-control"
                                                        style="font-size: .85rem" value="{{ $spp->tanggal }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group  mb-3 mt-2">
                                            <label>Ganti File SPP dan Lampiran
                                            </label>
                                            <div class="custom-file row">
                                                <div class="col-md-2">
                                                    <a href="{{ asset('storage/'.$spp->file_spp) }}"
                                                        target="_blank"><img src="/img/logo-pdf.jpg" width="40px"></a>
                                                    <input type="hidden" name="old_1" value="{{ $spp->file_spp }}">
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="file" name="file_spp"
                                                        class="custom-file-input file_spp" id="customFile ">
                                                    <label class="custom-file-label nama_file" for="customFile"
                                                        style="font-size: .85rem">Pilih file PDF
                                                        max: 2 MB</label>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">UPDATE
                                            DATA</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </tr>

                @endforeach
                @endforeach
            </table>
        </div>
    </div>
    {{-- Akhir --}}

    @endif
</div>


<br>
<br>

@push('script')
<script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    bsCustomFileInput.init();
    $('#pilihKegiatan').on('change', function(){
        $('#dokumen_spp').html("");
    })
    // $('#formSPP').on('submit', function(e){
    //    e.preventDefault();
    //    $.get("{{ url('adminDesa/cariSPP') }}", $(this).serialize()).done(function(hasil){
    //     $('#dokumen_spp').html(hasil);

    //    })
    // })
   
   
    $('.angka').mask('000.000.000.000.000', {reverse: true});
    
    var Anggaran = $('#anggKeg').val();
        Anggaran = Number(Anggaran.replaceAll(".",""));
               
    var Lspp = $('.jumlahSPP').length;
    var totSPP = 0;
    for(let i = 0; i<Lspp; i++){
        var jumspp = $('.jumlahSPP').eq(i).html().replaceAll('.', '');
            jumspp = Number(jumspp);
            totSPP += jumspp;
    }
    var sisA = Anggaran - totSPP;
    $('#SPPkeg').val(totSPP);
    $('#sisA').val(sisA);
    if(sisA < 0){
        $('#SPPkeg').addClass('text-danger');
        $('#sisA').addClass('text-danger');
    }else{
        $('#SPPkeg').removeClass('text-danger');
        $('#sisA').removeClass('text-danger');
    }

    $('#SPPkeg').mask('000.000.000.000.000', {reverse: true});
    $('#sisA').mask('000.000.000.000.000', {reverse: true});




    $('.file_spp').on('change', function(e){
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
            if(input.files[0]['size'] > 2048000){
                alert('ukuran file tidak boleh > 2 MB !');
                $('.file_spp').val("");
                
                $('.nama_file').html("Choose file PDF (max-size: 2 MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('.file_spp').val("");
            $('.nama_file').html("Choose PDF (max-size: 2 MB)");
            
        }
               
        }

    }

    


</script>


@endpush