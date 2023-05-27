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
<?php $totbkp = 0; ?>
@foreach($tbpus as $tb)
<?php 
$jm = str_replace(".",'',$tb->jumlah );
$jm = intval($jm);
$totbkp += $jm;

?>
@endforeach
<hr>
<h4 class="text-info">Form Penilaian Kelengkapan TBPU dan Bukti Belanja</h4>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered mb-1">
            <thead>
                <tr class="bg-info">
                    <th width="12%" class="text-center" style="vertical-align: middle">Total Anggaran </br> Kegiatan
                        (Rp)
                    </th>
                    <th width="12%" class="text-center" style="vertical-align: middle">Jumlah SPP Cair </br> (Rp)
                    </th>
                    <th width="12%" class="text-center" style="vertical-align: middle">Akumulasi </br> Jumlah TBPU (Rp)
                    </th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Jumlah Dokumen TBPU</th>
                    <th width="12%" class="text-center" style="vertical-align: middle">Total Pajak <br>(PPN+PPh) <br>
                        (Rp)
                    </th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Progress TBPU </br> (%)</th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Rata-rata Nilai <br>
                        Kelengkapan<br>
                        TBPU
                    </th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Jml Dok TBPU <br> yg blm dinilai
                    </th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Jml Perbaikan <br> yg blm dinilai
                        ulang
                    </th>


                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" id="totalAnggaran" class="form-control angka text-center"
                            style="font-size: .8rem" value="{{ $datot }}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control text-center angka" id="jumSPP" style="font-size: .8rem"
                            value="{{ $jumlah_spp }}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control text-center angka" id="jumTBPU" style="font-size: .8rem"
                            value="{{ $jumlah_tbpu }}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control text-center" style="font-size: .8rem" id="jumdok"
                            value="{{ $jumdok }}" readonly>
                    </td>
                    <td class="text-center" style="font-size: .8rem; vertical-align: middle">
                        <input type="text" class="form-control text-center angka" id="totalPajak"
                            style="font-size: .8rem" value="{{ $topajak }}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control text-center" id="progress" style="font-size: .8rem"
                            readonly>
                    </td>
                    <td class="text-center" style="font-size: .8rem; vertical-align: middle">
                        <input type="hidden" id="totNil" value="{{ $nilai_bkp }}">
                        <input type="text" class="form-control text-center" id="nilai_bkp" style="font-size: .8rem"
                            value="" readonly>
                    </td>
                    <td class="text-center" style="font-size: .8rem; vertical-align: middle">
                        <a href="?jenis=bkp_null" class="btn btn-danger btn-sm px-4" style="font-size: .8rem">{{
                            $jumnulbkp
                            }}</a>

                    </td>
                    <td class="text-center" style="font-size: .8rem; vertical-align: middle">
                        <a href="?jenis=bkp_ulang" class="btn btn-danger btn-sm px-4" style="font-size: .8rem">{{
                            $jumulangbkp
                            }}</a>

                    </td>


                </tr>
            </tbody>
        </table>
        {{-- <small class="float-right my-1">Estimasi Total Nilai Kelengkapan TBPU = (@nilai TBPU / jumlah dokumen) x
            progress
            SPP</small> --}}

    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <table class="table table-bordered table-striped" style="font-size: .8rem">
            <thead style="background: linear-gradient(to right, rgb(168, 171, 173), grey,rgb(248, 247, 247))">
                <tr>
                    <th width="5%" style="vertical-align: middle">Kode_keg</th>
                    <th width='30%' style="vertical-align: middle">Kegiatan</th>
                    @if($anggaran=='perubahan')
                    <th width="10%" class="text-center" style="vertical-align: middle">Anggaran Perubahan
                        <br> (Rp)
                    </th>
                    @else
                    <th width="10%" class="text-center" style="vertical-align: middle">Anggaran <br>(Rp)
                    </th>
                    @endif
                    <th class="text-center" width="10%" style="vertical-align: middle"> Akumulasi TBPU <br>(Rp)</th>
                    <th width="10%" style="vertical-align: middle" class="text-center">Sisa Anggaran
                        <br>(Rp)
                    </th>
                    <th class="text-center" width="10%" style="vertical-align: middle"> Jumlah Dokumen TBPU</th>
                    <th width="10%" style="vertical-align: middle" class="text-center">Nilai Kelengkapan
                        TBPU
                    </th>

                    <th width="15%" style="vertical-align: middle" class="text-center">Penilaian Kelengkapan</th>
                </tr>

            </thead>
            <tbody id="tb_data">
                @foreach($apbdes_kegiatans as $keg)
                @if($keg->$datang)
                <tr>
                    <td style="vertical-align: middle">{{ $keg->kode_kegiatan }}</td>
                    <td style="vertical-align: middle" style="font-size: .65rem">
                        {{ substr($keg->kegiatan->kegiatan,
                        0,75)."..." }}</td>
                    <td class="text-right datang angka" style="vertical-align: middle">{{ $keg->$datang }}</td>
                    <td class="text-right" style="vertical-align: middle">
                        <span class="angka">{{ $keg->penataanbelanja_bkp->pluck('jumlah')->sum() }}</span>
                    </td>
                    <td class="text-right" style="vertical-align: middle">
                        <span class="angka">{{ $keg->$datang -
                            $keg->penataanbelanja_bkp->pluck('jumlah')->sum()}}</span>
                    </td>
                    <td style="vertical-align: middle"
                        class="text-center {{ $keg->penataanbelanja_bkp->where('perbaikan_bkp', true)->pluck('apbdes_kegiatan_id')->first() == $keg->id ? 'text-danger' : '' }}">
                        {{ $keg->penataanbelanja_bkp->count() > 0 ? $keg->penataanbelanja_bkp->count()." dokumen" : ''
                        }}
                    </td>
                    <td style="vertical-align: middle" class="text-center">
                        <?php $nilai = 0; ?>
                        @foreach($keg->penataanbelanja_bkp as $bkp)
                        @if($bkp->apbdes_kegiatan_id == $keg->id && $bkp->nilai_bkp)
                        <?php $nilai += $bkp->nilai_bkp ?>
                        @endif
                        @endforeach
                        {{ $nilai }}
                    </td>
                    <td style="vertical-align: middle" class="text-center">
                        @if(count($tbpus->where('apbdes_kegiatan_id', $keg->id)))
                        <a href="/adminIrbanwil/belanja?jenis=cek_tbpu&tahun={{ $tahun }}&kegiatan={{ $keg->id }}"
                            class="btn btn-sm btn-info px-2 py-1" style="font-size: .85rem">+ Nilai TBPU</a>
                        @endif
                    </td>

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
   

    Jumsisa();
    function Jumsisa(){
        var totA = Number($('#totalAnggaran').val().replaceAll('.', ''));
        var tbpu = 0;
        var jumlahBelanja = 0; 
        var jumsisa = $('.sisa').length;
        var jumlahSisa = 0;
        for(let i=0; i<jumsisa; i++){
            var datang = Number($('.datang').eq(i).html().replaceAll('.',''));
            var jumpeg = Number($('.belanjaPegawai').eq(i).val().replaceAll('.',''));
            var jumbar =  Number($('.belanjaBarjas').eq(i).val().replaceAll('.',''));
            var jummod = Number($('.belanjaModal').eq(i).val().replaceAll('.',''));
            var jumga = Number($('.belanjaTakterduga').eq(i).val().replaceAll('.',''));
            var jumja = jumpeg+jumbar+jummod+jumga;
            tbpu += jumja;
            jumlahBelanja += jumja;
            jumlahSisa = datang - jumja;
           
            if(jumja){
            $('.sisa').eq(i).val(jumlahSisa);}

           if(jumlahSisa < 0){
            
            $('.sisa').eq(i).addClass('text-danger');
           }
                            
        }
        
        var jumTBPU = $('#jumTBPU').val();
               
        var totA = $('#totalAnggaran').val();
        var progress = jumTBPU/totA;
            progress = progress *100;
            progress = progress.toFixed(2);
        $('#progress').val(progress);
        
        var totNil = $('#totNil').val();
   
        var jumdok = $('#jumdok').val();
        var nilaiBKP = (totNil/jumdok);
        nilaiBKP = nilaiBKP.toFixed(2);
        $('#nilai_bkp').val(nilaiBKP);

    }

    $('#totalTBPU').mask('000.000.000.000.000', {reverse: true});
    $('.sisa').mask('000.000.000.000.000', {reverse: true});
    $('.jumlah').mask('000.000.000.000.000', {reverse: true});
    $('.angka').mask('000.000.000.000.000', {reverse: true});
    $('#totalPajak').mask('000.000.000.000.000', {reverse: true});
    




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
            if(input.files[0]['size'] > 2048000){
                alert('ukuran file tidak boleh > 2 Mb !');
                $('.file_lampiran').val("");
                
                $('.nama_file2').html("Choose file PDF (max-size: 2MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('.file_lampiran').val("");
            $('.nama_file2').html("Choose PDF (max-size: 2MB)");
            
        }
               
        }

    }




</script>


@endpush