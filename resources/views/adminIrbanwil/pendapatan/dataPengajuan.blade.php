@php
if ($anggaran=='perubahan') {
$anggaran = 'anggaran_perubahan';
$status = 'Anggaran Perubahan';
}else{
$anggaran = 'anggaran_murni';
$status = 'Anggaran Murni';
}
@endphp

<p class="text-info" style="font-size: 1rem">Data Pengajuan/Penerimaan Pendapatan (APBDes TA {{ $tahun }})</p>

<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label for="totalAnggaran">Jumlah Anggaran Pendapatan</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                </div>
                <input type="text" class="form-control angka" id="totalAnggaran"
                    value="{{ $total_p->pendapatan_perubahan ?? $total_p->pendapatan_murni }}"
                    style="font-size: .75rem">
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="totalSPP">Realisasi Pendapatan</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                </div>
                <input type="text" class="form-control text-right angka" id="totalPengajuan" style="font-size: .75rem">
            </div>

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="progressSPP">Progress Pendapatan</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control text-right" id="progressPengajuan" style="font-size: .75rem; >
                <div class=" input-group-append">
                <div class="input-group-text" style="font-size: .75rem">%</div>
            </div>
        </div>

    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="sisaAnggaran">Sisa Anggaran Pendapatan</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                </div>
                <input type="text" class="form-control text-right angka" id="sisaAnggaran" style="font-size: .75rem">
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-11">
        <table class="table table-bordered">
            <thead style="background-color: beige">
                <tr>
                    <th style="vertical-align: middle">Kode_rek</th>
                    <th style="vertical-align: middle">Jenis Pendapatan</th>
                    <th class="text-center" style="vertical-align: middle">{{ $status }} <br> (Rp)</th>
                    <th class="text-center" style="vertical-align: middle">Akumlasi Jumlah <br>Pengajuan & Penerimaan
                        <br>
                        (Rp)
                    </th>
                    <th class="text-center" style="vertical-align: middle">Cek Dokumen Pengajuan <br>& Penerimaan
                        <br><small>(klik untuk
                            cek)</small>
                    </th>

                </tr>
            </thead>
            @foreach($pendapatans as $pd)
            @if($pd->pendapatan_id != '2' && $pd->anggaran_murni || $pd->pendapatan_id != '2' &&
            $pd->anggaran_perubahan)
            <?php $cek=0; ?>
            @foreach($pd->penataan_pendapatan as $pn)
            <?php $cek+= $pn->perbaikan; ?>
            @endforeach
            <tr class="{{ $cek > 0 ? '' : '' }}">
                <th>{{ $pd->kode_pendapatan }}</th>
                <th>{{ $pd->jenis_pendapatan }}</th>

                <th class="text-right">
                    <input type="text" class="angka text-right" value="{{ $pd->$anggaran }}" disabled>

                </th>
                <th>
                    <?php $i = 0; $jum = 0; $nominal=0; ?>
                    @foreach($pd->penataan_pendapatan as $jumja)
                    <?php 
                    $nominal = intval(str_replace('.', '', $jumja->jumlah)); 
                    $jum += $nominal;
                    $i++;
                    ?>
                    @endforeach
                    <input type="text" class="angka jumlahPengajuan text-right" value="{{ $jum }}" disabled>

                </th>
                <th class="text-center">
                    <?php $i = 0; ?>
                    @foreach($pd->penataan_pendapatan as $pengajuan)

                    <?php $i++; ?>
                    @endforeach
                    @if($i>0)
                    <a href="?jenis=cek_pengajuan&tahun={{ $tahun }}&pendapatan={{ $pd->id }}"
                        class="btn btn-info btn-sm {{ $cek > 0 ? 'text-warning' : '' }}">{{ $i }}
                        Dokumen</a>
                    @endif
                </th>


            </tr>
            @endif
            @endforeach
        </table>
    </div>
</div>
<hr>



@push('script')
<script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    bsCustomFileInput.init();
    
    var totA = Number($('#totalAnggaran').val().replaceAll('.', ''));
    var akumulasi = 0
    var jumP = $('.jumlahPengajuan').length;
    
    for(let i=0; i<jumP; i++){
        var nominal = $('.jumlahPengajuan').eq(i).val().replaceAll('.', '');
            nominal = Number(nominal);
            akumulasi += nominal;
    }
    $('#totalPengajuan').val(akumulasi);
    var progress = (akumulasi/totA)*100;
    progress = progress.toFixed(2);
    $('#progressPengajuan').val(progress);
    $('#sisaAnggaran').val(totA-akumulasi);

    $('.jumlah').mask('000.000.000.000.000', {reverse: true});
    $('.angka').mask('000.000.000.000.000', {reverse: true});
    $('#sisaAnggaran').mask('000.000.000.000.000', {reverse: true});

    $('.file_pengajuan').on('change', function(e){
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
        if(input.files[0]['size'] > 512000){
            alert('ukuran file tidak boleh > 512 KB !');
            $('.file_pengajuan').val("");
            
            $('.nama_file').html("Choose file PDF (max-size: 512 KB)");
        }else{
            
        }
        
    }else {
        alert ("file harus berjenis 'pdf' ");
        $('.file_pengajuan').val("");
        $('.nama_file').html("Choose PDF (max-size: 512 KB)");
        
    }
    
    
    }

}

</script>
@error('file_data')
<script>
    Swal.fire({
    position: 'center',
    icon: 'error',
    title: 'Failed!, {{ $message }}',
    showConfirmButton: true
    })
</script>
@enderror

@endpush