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
<h4 class="text-info">Form Input Tanda Bukti Pengeluaran Uang (TBPU) atau Kwitansi TA {{ $tahun }}</h4>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered mb-2">
            <thead>
                <tr class="bg-info">
                    <th width="12%" class="text-center" style="vertical-align: middle">Total Anggaran </br> Kegiatan
                        (Rp)
                    </th>
                    <th width="12%" class="text-center" style="vertical-align: middle">Realisasi Pendapatan </br> (Rp)
                    </th>
                    <th width="12%" class="text-center" style="vertical-align: middle">Jumlah SPP Cair </br> (Rp)
                    </th>
                    <th width="12%" class="text-center" style="vertical-align: middle">Akumulasi </br> Jumlah TBPU (Rp)
                    </th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Jumlah Dokumen TBPU</th>

                    <th width="12%" class="text-center" style="vertical-align: middle">Sisa SPP </br> yg belum
                        diterbitkan TBPU (Rp)</th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Sisa Penerimaan <br> (Rp)</th>
                    <th width="12%" class="text-center" style="vertical-align: middle">Sisa Anggaran <br> (Rp)</th>
                    <th width="8%" class="text-center" style="vertical-align: middle">Progress TBPU </br> (%)</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" id="dakeg" class="form-control angka text-center" style="font-size: .8rem"
                            value="{{ $datot }}" readonly>
                    </td>
                    <td>
                        <input type="text" id="penerimaan" class="form-control angka text-center"
                            style="font-size: .8rem" value="{{ $penerimaan }}" readonly>
                    </td>

                    <td>
                        <input type="text" class="form-control text-center angka" id="jumSPP" style="font-size: .8rem"
                            value="{{ $jumlah_spp }}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control text-center" id="jumTBPU" style="font-size: .8rem"
                            value="{{ $jumlah_tbpu }}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control text-center" style="font-size: .8rem" id="jumdok"
                            value="{{ $jumdok }}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control text-center angka" id="sisaSPP" style="font-size: .8rem"
                            value="{{ $sisa_spp }}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control text-center angka" id="sisaPenerimaan"
                            style="font-size: .8rem" value="{{ $sisa_penerimaan }}" readonly>
                    </td>
                    <td id="sisaAnggaran" class="text-center" style="font-size: .8rem; vertical-align: middle">

                    </td>
                    <td>
                        <input type="text" class="form-control text-center angka" id="progress" style="font-size: .8rem"
                            readonly>
                    </td>

                </tr>
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

    $('.file_bkp').on('change', function(e){
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
                $('.file_bkp').val("");
                
                $('.nama_file').html("Choose file PDF (max-size: 2 MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('.file_bkp').val("");
            $('.nama_file').html("Choose PDF (max-size: 2 MB)");
            
        }
               
        }

    }

    $('.file_lampiran').on('change', function(e){
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
                $('.file_lampiran').val("");
                
                $('.nama_file2').html("Choose file PDF (max-size: 1MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('.file_lampiran').val("");
            $('.nama_file2').html("Choose PDF (max-size: 1MB)");
            
        }
               
        }

    }

var totA = Number($('#dakeg').val().replaceAll('.', ''));

var jumTBPU = $('#jumTBPU').val();
var sisaA = totA - jumTBPU;
$('#sisaAnggaran').html(sisaA);

var progress = (jumTBPU/totA)*100;
    progress = progress.toFixed(2);
 
$('#progress').val(progress);
$('#sisaAnggaran').mask('000.000.000.000.000', {reverse: true});

</script>


@endpush