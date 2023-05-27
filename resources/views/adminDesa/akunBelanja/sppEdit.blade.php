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
<p class="text-info">Form Input Surat Permintaan Pembayaran SPP TA {{ $tahun }}</p>
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label for="totalAnggaran">Jumlah Total Anggaran</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                </div>
                <input type="text" class="form-control angka" id="totalAnggaran" value="{{ $datot }}"
                    style="font-size: .75rem">
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="totalSPP">Jumlah Akumulasi SPP</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                </div>
                <input type="text" class="form-control" id="totalSPP" style="font-size: .75rem">
            </div>

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="progressSPP">Progress SPP</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="progressSPP" style="font-size: .75rem">
                <div class="input-group-append">
                    <div class="input-group-text" style="font-size: .75rem">%</div>
                </div>
            </div>

        </div>
    </div>
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

                <th width="15%" class="text-center" style="vertical-align: middle">@Jumlah SPP <br> (Rp)</th>
                <th width="15%" style="vertical-align: middle" class="text-center">Cek Dokumen SPP </br> (Edit/Delete)
                </th>
                <th width="10%" style="vertical-align: middle">Upload SPP</th>
            </thead>
            <tbody>
                @foreach($apbdes_kegiatans as $keg)
                @if($keg->anggaran_murni || $keg->anggaran_perubahan)
                <tr>
                    <td>{{ $keg->kode_kegiatan }}</td>
                    <td>{{ $keg->kegiatan->kegiatan }}</td>
                    <td class="text-right">{{ $keg->$datang }}</td>
                    <td class="text-right ">
                        <?php $jumto=0; ?>
                        @foreach($keg->penataanbelanja_spp as $spp)
                        @if($spp->apbdes_kegiatan_id == $keg->id)
                        <?php $jumlah = str_replace('.','',$spp->jumlah); $jumlah= intval($jumlah); $jumto += $jumlah; ?>
                        @endif
                        @endforeach
                        <input type="text" class="angka jumSPP text-right border-0" value="{{ $jumto }}" size="12"
                            disabled>

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
                        <a href="/adminDesa/cekDokSPP?asal_id={{ $infos->asal_id }}&tahun={{ $tahun }}&keg={{ $keg->id }}"
                            class="btn btn-sm btn-info">{{ $i }} dokumen</a>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="editSPP{{ $spp->id }}" data-backdrop="static" data-keyboard="false"
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


                                        <div class="form-group  mb-3 mt-4">
                                            <label>Upload SPP + Persetujuan + Pernyataan Tanggungjawab Belanja
                                            </label>
                                            <div class="custom-file">
                                                <input type="file" name="file_spp" class="custom-file-input file_spp"
                                                    id="customFile " required>
                                                <label class="custom-file-label nama_file" for="customFile"
                                                    style="font-size: .75rem">Upload file PDF max:
                                                    1MB</label>
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


                    <td>

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
                                        <div class="form-group  mb-3">
                                            <label>Jumlah dana yang diminta</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                                                </div>
                                                <input type="text" name="jumlah" class="form-control jumlah"
                                                    id="inlineFormInputGroup" style="font-size: .75rem">
                                            </div>

                                        </div>
                                        <div class="form-group  mb-3">
                                            <label>Tanggal SPP</label>
                                            <input type="date" name="tanggal" class="form-control"
                                                style="font-size: .75rem" required>
                                        </div>
                                        <div class="form-group  mb-3 mt-4">
                                            <label>Upload SPP + Persetujuan + Pernyataan Tanggungjawab Belanja
                                            </label>
                                            <div class="custom-file">
                                                <input type="file" name="file_spp" class="custom-file-input file_spp"
                                                    id="customFile " required>
                                                <label class="custom-file-label nama_file" for="customFile"
                                                    style="font-size: .75rem">Upload file PDF max:
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
            alert('ukuran file tidak boleh > 2 MB !');
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

var totA = Number($('#totalAnggaran').val().replaceAll('.', ''));

var jum = $('.jumSPP').length;
var spp = 0;
for(let i=0; i<jum; i++){
    var nominal = Number($('.jumSPP').eq(i).val().replaceAll('.',''));
    spp += nominal;
}   
var progress = (spp/totA)*100;
    progress = progress.toFixed(2);
 
$('#totalSPP').val(spp);
$('#progressSPP').val(progress);
$('#totalSPP').mask('000.000.000.000.000', {reverse: true});

</script>


@endpush