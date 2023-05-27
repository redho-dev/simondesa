@if($anggaran == 'murni')
<?php 
 $datot = $total_p->belanja_murni;
 $datang = 'anggaran_murni';
 ?>
@else
<?php 
 $datot = $total_p->belanja_perubahan;
 $datang = 'anggaran_perubahan';
 ?>
@endif
<hr>
<h4 class="text-info my-3">Form Tambah Data Surat Permintaan Pembayaran (SPP) TA {{ $tahun }}</h4>
<div class="row">
    <div class="col-md-9">
        <table class="table table-bordered mb-2">
            <thead>
                <tr class="bg-info">
                    <th width="20%" class="text-center" style="vertical-align: middle">Total Anggaran </br> Kegiatan
                        (Rp)
                    </th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Jumlah Dokumen SPP</th>
                    <th width="20%" class="text-center" style="vertical-align: middle">Akumulasi </br> Jumlah SPP (Rp)
                    </th>
                    <th width="15%" class="text-center" style="vertical-align: middle">Sisa Anggaran (Rp)</th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Progress SPP </br> (%)</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" id="dakeg" class="form-control angka text-center" style="font-size: .8rem"
                            value="{{ $datot }}" readonly>
                    </td>
                    <td><input type="text" class="form-control text-center" style="font-size: .8rem" id="jumdok"
                            value="{{ $jumdok }}" readonly>
                    </td>
                    <td><input type="text" class="form-control text-center" id="totalSPP" style="font-size: .8rem"
                            readonly></td>
                    <td>
                        <input type="text" class="form-control text-center" id="sisaAnggaran" style="font-size: .8rem"
                            readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control text-center" id="progressSPP" style="font-size: .8rem"
                            readonly>
                    </td>

                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-9">

        <table class="table table-bordered">
            <thead class="table-info">
                <th width="5%" style="vertical-align: middle">Kode_rek</th>
                <th width='40%' style="vertical-align: middle">Kegiatan</th>
                @if($anggaran=='perubahan')
                <th width="10%" class="text-center" style="vertical-align: middle">Anggaran Perubahan <br> (Rp)</th>
                @else
                <th width="10%" class="text-center" style="vertical-align: middle">Anggaran <br>(Rp)</th>
                @endif

                <th width="10%" class="text-center" style="vertical-align: middle">@Jumlah SPP <br> (Rp)</th>
                <th width="20%" style="vertical-align: middle" class="text-center">Cek Dokumen SPP </br> (Edit/Delete)
                </th>
                <th width="15%" style="vertical-align: middle" class="text-center">Upload SPP</th>
            </thead>
            <tbody>
                @foreach($apbdes_kegiatans as $keg)
                @if($keg->$datang)
                <tr>
                    <td>{{ $keg->kode_kegiatan }}</td>
                    <td>{{ $keg->kegiatan->kegiatan }}</td>
                    <td class="text-right angka">{{ $keg->$datang }}</td>
                    <td class="text-right ">
                        <?php $jumto=0; ?>
                        @foreach($keg->penataanbelanja_spp as $spp)
                        @if($spp->apbdes_kegiatan_id == $keg->id)
                        <?php $jumlah = str_replace('.','',$spp->jumlah); $jumlah= intval($jumlah); $jumto += $jumlah; ?>
                        @endif
                        @endforeach
                        <input type="text"
                            class="angka jumSPP text-right border-0 {{ $jumto>$keg->$datang ? 'text-danger' : '' }}"
                            value="{{ $jumto }}" size="12" disabled>

                    </td>
                    <td class="text-center">
                        <?php $i=0; $dat = 0;?>
                        @foreach($keg->penataanbelanja_spp as $spp)
                        @if($spp->apbdes_kegiatan_id == $keg->id && $spp->jumlah)
                        <?php $dat += $i; ?>
                        @endif
                        <?php $i++ ?>
                        @endforeach
                        @if($i>0)
                        <a href="/adminDesa/formPenataanBelanja?jenis=spp_kegiatan&tahun={{ $tahun }}&kegiatan={{ $keg->id }}"
                            class="btn btn-sm btn-info">{{ $i }} dokumen</a>
                        @endif
                    </td>

                    <td class="text-center">

                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#tambahSPP{{ $keg->id }}">
                            + SPP
                        </button>
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="tambahSPP{{ $keg->id }}" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Tambah SPP
                                        Kegiatan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/tambahSPP" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="kegiatan_id" value="{{ $keg->kegiatan_id }}">
                                    <input type="hidden" name="apbdes_kegiatan_id" value="{{ $keg->id }}">
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label for="kegiatan">Nama Kegiatan</label>
                                            <input type="text" class="form-control" id="kegiatan"
                                                value="{{ $keg->kegiatan->kegiatan }}" style="font-size: .75rem"
                                                readonly>
                                        </div>
                                        <div class="form-group  mb-3">
                                            <label>Nomor SPP</label>
                                            <input type="text" name="nomor" class="form-control"
                                                style="font-size: .75rem" required>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group  mb-3">
                                                    <label>Jumlah dana yang diminta</label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="font-size: .75rem">Rp.
                                                            </div>
                                                        </div>
                                                        <input type="text" name="jumlah" class="form-control jumlah"
                                                            id="inlineFormInputGroup" style="font-size: .75rem">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group  mb-3">
                                                    <label>Tanggal SPP</label>
                                                    <input type="date" name="tanggal" class="form-control"
                                                        style="font-size: .75rem" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group  mb-3 mt-2">
                                            <label>Upload Dokumen SPP + Lampiran
                                            </label>
                                            <div class="custom-file">
                                                <input type="file" name="file_spp" class="custom-file-input file_spp"
                                                    id="customFile " required>
                                                <label class="custom-file-label nama_file" for="customFile"
                                                    style="font-size: .75rem">Choose file PDF max:
                                                    2MB</label>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">KIRIM DATA</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </tr>

                @endif
                @endforeach

            </tbody>

        </table>

    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                Keterangan :
            </div>
            <div class="card-body">

                <p class="card-text">Silahkan Upload Dokumen SPP dengan lampiran sbb:</p>
                <p style="font-size: .8rem">1. Jika SPP Definitif : <br>
                    &emsp; - Surat Pengantar;<br>
                    &emsp; - Verifikasi dan Persetujuan; <br>
                    &emsp; - Bukti Pencairan SPP; <br>
                    &emsp; - Pernyataan Tanggungjawab Belanja; <br>
                </p>
                <p style="font-size: .8rem">2. Jika SPP Panjar : <br>
                    &emsp; - Surat Pengantar;<br>
                    &emsp; - Rincian Permintaan Panjar; <br>
                    &emsp; - Bukti Pencairan SPP; <br>
                    &emsp; - Pernyataan Tanggungjawab Belanja; <br>
                    &emsp; - Laporan Pertanggungjawaban Panjar; <br>
                    &emsp; - Surat Pengesahan Panjar Kegiatan; <br>
                </p>

            </div>
        </div>

    </div>
</div>
<hr>
@push('script')
<script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    bsCustomFileInput.init();
    $('.jumlah').mask('000.000.000.000.000', {reverse: true});
    $('.angka').mask('000.000.000.000.000', {reverse: true});
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
            alert('ukuran file tidak boleh > 2MB !');
            $('.file_spp').val("");
            
            $('.nama_file').html("Choose file PDF (max-size: 2MB)");
        }else{
            
        }
        
    }else {
        alert ("file harus berjenis 'pdf' ");
        $('.file_spp').val("");
        $('.nama_file').html("Choose PDF (max-size: 2MB)");
        
    }
    
    
    }

}


var jum = $('.jumSPP').length;
var spp = 0;
for(let i=0; i<jum; i++){
    var nominal = Number($('.jumSPP').eq(i).val().replaceAll('.',''));
    spp += nominal;
}   
var totA = Number($('#dakeg').val().replaceAll('.', ''));

var progress = (spp/totA)*100;
    progress = progress.toFixed(2);
 
$('#totalSPP').val(spp);
$('#progressSPP').val(progress);
$('#sisaAnggaran').val(totA-spp);

$('#totalSPP').mask('000.000.000.000.000', {reverse: true});
$('#sisaAnggaran').mask('000.000.000.000.000', {reverse: true});


</script>


@endpush