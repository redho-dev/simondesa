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
<h4 class="text-info my-3">Rekap Data dan Penilaian Kelengkapan Surat Permintaan Pembayaran (SPP) TA {{ $tahun }}</h4>

<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered mb-1">
            <thead>
                <tr class="bg-info">
                    <th width="20%" class="text-center" style="vertical-align: middle">Total Anggaran </br> Kegiatan
                        (Rp)
                    </th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Jml Dokumen SPP</th>
                    <th width="15%" class="text-center" style="vertical-align: middle">Akumulasi </br> Jumlah SPP (Rp)
                    </th>
                    <th width="15%" class="text-center" style="vertical-align: middle">Sisa Anggaran <br> Kegiatan (Rp)
                    </th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Progress SPP </br> (%)</th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Rata-rata Nilai </br>
                        Kelengkapan SPP
                    </th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Jml Dok SPP </br> yg Belum
                        dinilai</th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Jml Perbaikan </br> yg
                        Belum
                        dinilai ulang</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="angka"><input type="text" id="totalAnggaran" class="form-control angka text-center"
                            style="font-size: .8rem" value="{{ $datot }}" readonly></td>
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
                    <td>
                        <input type="hidden" id="totNil" value="{{ $nilai_spp }}">
                        <input type="text" class="form-control text-center" id="nilai_spp" style="font-size: .8rem"
                            value="" readonly>
                    </td>
                    <td class="text-center">
                        <a href="?jenis=spp_null&tahun={{ $tahun }}"
                            class="btn btn-sm btn-danger px-3 {{ $jumnul > 0 ? 'text-light' : '' }}">{{
                            $jumnul
                            }}</a>

                    </td>
                    <td class="text-center">
                        <a href="?jenis=spp_ulang&tahun={{ $tahun }}"
                            class="btn btn-sm btn-danger px-3 {{ $jumulang > 0 ? 'text-light' : '' }}">{{
                            $jumulang
                            }}</a>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
{{-- <small class="float-right my-1">Estimasi Total Nilai Kelengkapan SPP = (@nilai SPP / jumlah dokumen) x
    progress
    SPP</small> --}}

<div class="row">
    <div class="col-md-12">
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
                <th width="10%" style="vertical-align: middle" class="text-center">Jml Dokumen SPP
                </th>
                <th width="10%" style="vertical-align: middle" class="text-center">Nilai SPP <br>Per Kegiatan</th>
                <th width="15%" style="vertical-align: middle" class="text-center">Penilaian kelengkapan</th>
            </thead>
            <tbody>
                @foreach($apbdes_kegiatans as $keg)
                @if($keg->$datang)
                <tr>
                    <td>{{ $keg->kode_kegiatan }} </td>
                    <td>{{ $keg->kegiatan->kegiatan }}</td>
                    <td class="text-right angka">{{ $keg->$datang }}</td>
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
                    <td
                        class="{{ $keg->penataanbelanja_spp->where('perbaikan', true)->pluck('apbdes_kegiatan_id')->first() == $keg->id ? 'text-danger' : '' }} text-center">
                        <?php $i=0; $dat = 0;?>
                        @foreach($keg->penataanbelanja_spp as $spp)
                        @if($spp->apbdes_kegiatan_id == $keg->id && $spp->jumlah)
                        <?php $dat += $i; ?>
                        @endif
                        <?php $i++ ?>
                        @endforeach
                        @if($i>0)
                        <p>{{ $i }} dokumen</p>

                        @endif
                    </td>
                    <td class="text-center">
                        <?php $nilai = 0; ?>
                        @foreach($keg->penataanbelanja_spp as $spp)
                        @if($spp->apbdes_kegiatan_id == $keg->id && $spp->nilai)
                        <?php $nilai += $spp->nilai ?>
                        @endif
                        @endforeach
                        {{ $nilai }}
                    </td>

                    <td class="text-center">
                        @if($i > 0)
                        <a href="/adminIrbanwil/belanja?jenis=spp_kegiatan&tahun={{ $tahun }}&kegiatan={{ $keg->id }}"
                            class="btn btn-sm btn-info">+ Nilai SPP</a>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    $('.jumlah').mask('000.000.000.000.000', {reverse: true});
    $('.angka').mask('000.000.000.000.000', {reverse: true});


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
$('#sisaAnggaran').val(totA-spp);

$('#totalSPP').mask('000.000.000.000.000', {reverse: true});
$('#sisaAnggaran').mask('000.000.000.000.000', {reverse: true});
var totNil = $('#totNil').val();
var jumdok = $('#jumdok').val();
var nilaiSPP = (totNil/jumdok);
    nilaiSPP = nilaiSPP.toFixed(2);
$('#nilai_spp').val(nilaiSPP);
 
</script>