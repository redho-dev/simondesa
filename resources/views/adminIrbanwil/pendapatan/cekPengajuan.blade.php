@php
if ($anggaran=='perubahan') {
$anggaran = 'anggaran_perubahan';
$status = 'Anggaran Perubahan';
}else{
$anggaran = 'anggaran_murni';
$status = 'Anggaran Murni';
}
@endphp

<p class="text-info my-2">Silahkan Cek Data Pengajuan per Jenis Pendapatan (APBDes TA {{ $tahun }})</p>
<form action="/adminIrbanwil/pendapatan" method="get">
    <input type="hidden" name="jenis" value="cek_pengajuan">
    <input type="hidden" name="tahun" value="{{ $tahun }}">
    <div class="row mt-4 mb-2">
        <div class="col-md-4">
            <select id="pilihPendapatan" class="custom-select custom-select-sm" style="font-size: .8rem"
                name="pendapatan" required>
                <option selected value="" class="text-secondary" disabled>Pilih Pendapatan</option>
                @foreach($pendapatans as $pend)
                @if($pend->$anggaran && $pend->pendapatan_id != 2)
                <option value="{{ $pend->id }}" {{ Request('pendapatan')==$pend->id ? 'selected' : '' }}>{{
                    $pend->kode_pendapatan." ".$pend->pendapatan->jenis_pendapatan }}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-sm btn-primary" id="carkeg" type="submit" style="font-size: .80rem">Cek Dokumen
                Pengajuanss</button>
        </div>
    </div>
</form>
<hr>
<div class="row" id="isiPengajuan">
    <div class="col-md-10">

        @if(Request('pendapatan'))

        <table class="table table-bordered">
            <thead>
                <tr style="background-color: blanchedalmond">
                    <th style="vertical-align: middle">#</th>
                    <th style="vertical-align: middle">Pengajuan</th>
                    <th style="vertical-align: middle" class="text-center">Jumlah yang <br>diajukan (Rp)</th>
                    <th style="vertical-align: middle" class="text-center">Tgl_pengajuan</th>
                    <th style="vertical-align: middle" class="text-center">Tgl_saldo_kas_desa</th>
                    <th style="vertical-align: middle" class="text-center">Surat Pengajuan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jenpend->penataan_pendapatan as $pengajuan)
                <tr>
                    <td></td>
                    <td>{{ $pengajuan->nama_data }}</td>
                    <td class="text-right">
                        <span class="angka">{{ $pengajuan->jumlah }}</span>
                    </td>
                    <td class="text-center">{{ $pengajuan->tgl_pengajuan }}</td>
                    <td class="text-center">{{ $pengajuan->tgl_saldo }}</td>
                    <td class="text-center">
                        <a href="{{ asset('storage/'.$pengajuan->file_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px" alt="">
                        </a>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        @endif

    </div>
</div>
<hr>



@push('script')
<script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    bsCustomFileInput.init();
    $('.jumlah').mask('000.000.000.000.000', {reverse: true});
    
    $('#pilihPendapatan').on('change', function(){
        $('#isiPengajuan').html("");
    })

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