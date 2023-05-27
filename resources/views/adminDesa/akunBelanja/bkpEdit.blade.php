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
<h4 class="text-info">Form Tambah/Update Data TBPU dan Bukti Belanja</h4>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered mb-2">
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
                    <th width="10%" class="text-center" style="vertical-align: middle">Total Pajak <br>(PPN+PPh+Lainnya)
                        <br> (Rp)
                    </th>
                    <th width="8%" class="text-center" style="vertical-align: middle">Progress TBPU </br> (%)</th>

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
                            style="font-size: .8rem" value="{{ $totalPajak }}" readonly>
                    </td>
                    <td>
                        <?php 
                        $persen = ($jumlah_tbpu/$datot)*100;
                        ?>
                        <input type="text" class="form-control text-center" id="totalPajak" style="font-size: .8rem"
                            value="{{ round($persen,2) }}" readonly>

                    </td>

                </tr>
            </tbody>
        </table>

        <table class="table table-bordered mb-2">
            <thead>
                <tr class="bg-info">
                    <th width="12%" class="text-center" style="vertical-align: middle">Realisasi <br>Belanja Pegawai
                        (Rp)
                    </th>
                    <th width="12%" class="text-center" style="vertical-align: middle">Realisasi </br>Belanja Barang &
                        Jasa (Rp)
                    </th>
                    <th width="12%" class="text-center" style="vertical-align: middle">Realisasi <br> Belanja Modal (Rp)
                    </th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Realisasi <br> Belanja Tak
                        Terduga (Rp)
                    </th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Total Realisasi
                        <br> (Rp)
                    </th>
                    <th width="8%" class="text-center" style="vertical-align: middle">Progress Realisasi </br> (%)</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" id="totalAnggaran" class="form-control angka text-center"
                            style="font-size: .8rem" value="{{ $belanja_pegawai }}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control text-center angka" id="jumSPP" style="font-size: .8rem"
                            value="{{ $belanja_barjas }}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control text-center angka" id="jumTBPU" style="font-size: .8rem"
                            value="{{ $belanja_modal }}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control angka text-center" style="font-size: .8rem" id="jumdok"
                            value="{{ $belanja_tt }}" readonly>
                    </td>
                    <td class="text-center" style="font-size: .8rem; vertical-align: middle">
                        <input type="text" class="form-control text-center angka" id="totalPajak"
                            style="font-size: .8rem" value="{{ $total_realisasi }}" readonly>
                    </td>
                    <td>
                        <?php 
                        $persen = ($total_realisasi/$datot)*100;
                        ?>
                        <input type="text" class="form-control text-center" id="totalPajak" style="font-size: .8rem"
                            value="{{ round($persen,2) }}" readonly>

                    </td>

                </tr>
            </tbody>
        </table>

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-striped" style="font-size: .75rem">
            <thead style="background-color:cadetblue">
                <tr>
                    <th width="5%" style="vertical-align: middle">Kode_keg</th>
                    <th width="26%" style="vertical-align: middle">Nama Kegiatan</th>
                    <th width="7%" class="text-center" style="vertical-align: middle">Anggaran (Rp)</th>
                    <th width="7%" class="text-center" style="vertical-align: middle">Jumlah SPP Cair (Rp)</th>
                    <th width="7%" class="text-center" style="vertical-align: middle">@Jumlah TBPU <br>(Rp)</th>
                    <th width="7%" class="text-center" style="vertical-align: middle">Pot PPN <br>(Rp)</th>
                    <th width="7%" class="text-center" style="vertical-align: middle">Pot PPh <br>(Rp)</th>
                    <th width="7%" class="text-center" style="vertical-align: middle">Pot Lainnya <br>(Rp)</th>
                    <th width="7%" class="text-center" style="vertical-align: middle">Sisa Anggaran <br>(Rp)</th>
                    <th width="8%" class="text-center" style="vertical-align: middle">Edit Dokumen TBPU</th>
                    <th width="8%" class="text-center" style="vertical-align: middle">Upload TBPU</th>
                </tr>
            </thead>
            <tbody id="tb_data">
                @foreach($apbdes_kegiatans as $keg)
                @if($keg->$datang)
                <tr>
                    <td style="vertical-align: middle">
                        {{ $keg->kode_kegiatan }}
                    </td>
                    <td style="vertical-align: middle">{{ substr($keg->kegiatan->kegiatan,
                        0,75)."..." }}</td>
                    <td class="text-right datang angka" style="vertical-align: middle">{{ $keg->$datang }}</td>
                    <td class="text-right" style="vertical-align: middle">
                        {{ number_format($spp->where('apbdes_kegiatan_id',
                        $keg->id)->pluck('jumlah')->sum(),0,',','.') }}
                    </td>
                    <td style="vertical-align: middle">
                        {{ number_format($tbpus->where('apbdes_kegiatan_id',
                        $keg->id)->pluck('jumlah')->sum(),0,',','.') }}
                    </td>
                    <td class="text-right" style="vertical-align: middle">
                        {{ number_format($tbpus->where('apbdes_kegiatan_id',
                        $keg->id)->pluck('ppn')->sum(), 0,',','.') }}
                    </td>
                    <td class="text-right" style="vertical-align: middle">
                        {{ number_format($tbpus->where('apbdes_kegiatan_id',
                        $keg->id)->pluck('pph')->sum(), 0,',','.') }}
                    </td>
                    <td class="text-right" style="vertical-align: middle">
                        {{ number_format($tbpus->where('apbdes_kegiatan_id',
                        $keg->id)->pluck('lainnya')->sum(), 0,',','.') }}
                    </td>
                    <td class="text-right" style="vertical-align: middle">
                        <?php 
                            $angg = $keg->$datang; 
                            $real = $tbpus->where('apbdes_kegiatan_id',$keg->id)->pluck('jumlah')->sum();
                            $sisa = $angg-$real;
                        ?>
                        {{ number_format($sisa, 0,',','.') }}
                    </td>
                    <td class="text-center" style="vertical-align: middle">

                        @if(count($tbpus->where('apbdes_kegiatan_id', $keg->id)))
                        <a href="/adminDesa/formPenataanBelanja?jenis=cek_tbpu&tahun={{ $tahun }}&kegiatan={{ $keg->id }}"
                            class="btn btn-sm btn-info px-2 py-0" style="font-size: .9rem">{{
                            $keg->penataanbelanja_bkp->count() }} dok</a>
                        @endif
                    </td>
                    <td style="vertical-align: middle" class="text-center">

                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#tambahTBPU{{ $keg->id }}" style="font-size: .8rem">
                            + TBPU
                        </button>
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="tambahTBPU{{ $keg->id }}" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Tambah Tanda Bukti
                                        Pengeluaran Uang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/tambahTBPU" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="apbdes_kegiatan_id" value="{{ $keg->id }}">

                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label for="kegiatan">Nama Kegiatan :</label>
                                            <input type="text" class="form-control" id="kegiatan"
                                                value="{{ $keg->kegiatan->kegiatan }}" style="font-size: .85rem"
                                                readonly>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group  mb-3">
                                                    <label>Nomor TBPU :</label>
                                                    <input type="text" name="nomor" class="form-control"
                                                        style="font-size: .85rem" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group  mb-3">
                                                    <label>Jumlah Uang :</label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="font-size: .85rem">Rp.
                                                            </div>
                                                        </div>
                                                        <input type="text" name="jumlah" class="form-control jumlah"
                                                            id="inlineFormInputGroup" style="font-size: .85rem"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group mb-3">
                                                    <label for="jenis_belanja">Jenis Belanja :</label>
                                                    <select class="form-control" name="belanja_id" id="jenis_belanja"
                                                        style="font-size: .85rem" required>
                                                        <option value="">-- pilih jenis belanja --</option>
                                                        <option value="1">5.1 Belanja Pegawai</option>
                                                        <option value="2">5.2 Belanja Barang/Jasa</option>
                                                        <option value="3">5.3 Belanja Modal</option>
                                                        <option value="4">5.4 Belanja Tak Terduga</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group  mb-3">
                                                    <label>Tanggal TBPU :</label>
                                                    <input type="date" name="tanggal" class="form-control"
                                                        style="font-size: .85rem" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group  mb-3">
                                            <label>Sebagai Pembayaran :</label>
                                            <div class="input-group mb-2">
                                                <input type="text" name="sebagai" class="form-control sebagai"
                                                    style="font-size: .85rem" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4 ">
                                                <label>Potongan PPh :</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-size: .75rem">Rp.
                                                        </div>
                                                    </div>
                                                    <input type="text" name="pph" class="form-control pph angka"
                                                        id="pph" style="font-size: .75rem" placeholder="0">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4 ">
                                                <label>Potongan PPN :</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-size: .75rem">Rp.
                                                        </div>
                                                    </div>
                                                    <input type="text" name="ppn" class="form-control ppn angka"
                                                        id="ppn" style="font-size: .75rem" placeholder="0">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4 ">
                                                <label>Potongan Lainnya :</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-size: .75rem">Rp.
                                                        </div>
                                                    </div>
                                                    <input type="text" name="lainnya" class="form-control lainnya angka"
                                                        id="lainnya" style="font-size: .75rem" placeholder="0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group  mb-2 mt-2">
                                            <label>Upload TBPU :
                                            </label>
                                            <div class="custom-file">
                                                <input type="file" name="file_bkp" class="custom-file-input file_bkp"
                                                    id="customFile " required>
                                                <label class="custom-file-label nama_file" for="customFile"
                                                    style="font-size: .85rem">Upload file PDF max:
                                                    4 MB</label>
                                            </div>
                                        </div>
                                        <small class="text-primary">Catatan : TBPU wajib melampirkan SPJ
                                            (nota/struk/tanda terima/pesanan/bukti belanja
                                            lainnya)</small>

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

        {{-- <table class="table table-bordered table-striped" style="font-size: .7rem">
            <thead style="background: linear-gradient(to right, rgb(168, 171, 173), grey,rgb(248, 247, 247))">
                <tr>
                    <th width="4%" style="vertical-align: middle" rowspan="2">Kode_keg</th>
                    <th width='23%' style="vertical-align: middle" rowspan="2">Kegiatan</th>
                    @if($anggaran=='perubahan')
                    <th width="7%" class="text-center" style="vertical-align: middle" rowspan="2">Anggaran Perubahan
                        <br> (Rp)
                    </th>
                    @else
                    <th width="7%" class="text-center" style="vertical-align: middle" rowspan="2">Anggaran <br>(Rp)
                    </th>
                    @endif
                    <th colspan="6" class="text-center">Akumulasi Tanda Bukti Pengeluaran Uang (TBPU)</th>
                    <th width="7%" rowspan="2" style="vertical-align: middle" class="text-center">Sisa Anggaran <br>(Rp)
                    </th>

                    <th width="10%" style="vertical-align: middle" class="text-center" rowspan="2">Cek Dokumen TBPU
                    </th>

                    <th width="10%" style="vertical-align: middle" rowspan="2">Upload TBPU</th>
                </tr>
                <tr>
                    <th width="7%" class="text-center" style="vertical-align: middle">Belanja <br>Pegawai <br>(Rp)
                    </th>
                    <th width="7%" class="text-center" style="vertical-align: middle">Belanja <br>Barjas <br>(Rp)
                    </th>
                    <th width="7%" class="text-center" style="vertical-align: middle">Belanja <br>Modal <br>(Rp)
                    </th>
                    <th width="7%" class="text-center" style="vertical-align: middle">Belanja <br>Tak Terduga
                        <br>(Rp)
                    </th>
                    <th width="6%" class="text-center" style="vertical-align: middle">Potongan PPh <br>(Rp)</th>
                    <th width="6%" class="text-center" style="vertical-align: middle">Potongan PPN <br>(Rp)</th>
                </tr>
            </thead>
            <tbody id="tb_data">
                @foreach($apbdes_kegiatans as $keg)
                @if($keg->$datang)
                <tr>
                    <td style="vertical-align: middle">
                        {{ $keg->kode_kegiatan }}
                    </td>
                    <td style="vertical-align: middle" style="font-size: .65rem">{{ substr($keg->kegiatan->kegiatan,
                        0,75)."..." }}</td>
                    <td class="text-right datang angka" style="vertical-align: middle">{{ $keg->$datang }}</td>
                    <td class="text-right pr-1 " style="vertical-align: middle">
                        <?php 
                            $topeg = 0;
                                                         
                            $belpeg = $tbpus->where('apbdes_kegiatan_id', $keg->id)->where('belanja_id', 1);
                           foreach ($belpeg as $p) {
                             $p = intval(str_replace('.', '', $p->jumlah));
                             $topeg += $p;
                           }
                           
                        ?>

                        <span class="angka text-right p-0 belanjaPegawai">{{ $topeg }}</span>
                    </td>
                    <td class="text-right " style="vertical-align: middle">
                        <?php 
                            $tobar = 0;
                                                         
                            $belbar = $tbpus->where('apbdes_kegiatan_id', $keg->id)->where('belanja_id', 2);
                           foreach ($belbar as $bb) {
                             $bb = intval(str_replace('.', '', $bb->jumlah));
                             $tobar += $bb;
                           }
                           
                        ?>

                        <span class="angka text-right p-0 belanjaBarjas">{{ $tobar }}</span>
                    </td>
                    <td class="text-right " style="vertical-align: middle">
                        <?php 
                        $tomod = 0;
                                                     
                        $belmod = $tbpus->where('apbdes_kegiatan_id', $keg->id)->where('belanja_id', 3);
                       foreach ($belmod as $bm) {
                         $bm = intval(str_replace('.', '', $bm->jumlah));
                         $tomod += $bm;
                       }
                       
                    ?>
                        <span class="angka text-right p-0 belanjaModal">{{ $tomod }}</span>
                    </td>
                    <td class="text-right " style="vertical-align: middle">
                        <?php 
                        $toga = 0;
                                                     
                        $belga = $tbpus->where('apbdes_kegiatan_id', $keg->id)->where('belanja_id', 4);
                       foreach ($belga as $bg) {
                         $bg = intval(str_replace('.', '', $bg->jumlah));
                         $toga += $bg;
                       }
                       
                    ?>
                        <span class="angka text-right p-0 belanjaTakterduga">{{ $toga }}</span>
                    </td>
                    <td class="text-right" style="vertical-align: middle">
                        <?php 
                        $pph = 0;
                                                     
                        $belga = $tbpus->where('apbdes_kegiatan_id', $keg->id);
                       foreach ($belga as $p) {
                         $p = intval(str_replace('.', '', $p->pph));
                         $pph += $p;
                       }
                       
                    ?>
                        <span class="angka text-right p-0 pph">{{ $pph }}</span>
                    </td>
                    <td class="text-right" style="vertical-align: middle">
                        <?php 
                        $ppn = 0;
                                                     
                        $belga = $tbpus->where('apbdes_kegiatan_id', $keg->id);
                       foreach ($belga as $pn) {
                         $pn = intval(str_replace('.', '', $pn->ppn));
                         $ppn += $pn;
                       }
                       
                    ?>
                        <span class="angka text-right p-0 ppn">{{ $ppn }}</span>
                    </td>
                    <td class="text-right" style="vertical-align: middle">
                        <span class="text-right p-0 sisa"> </span>
                    </td>
                    <td class="text-center" style="vertical-align: middle">

                        @if(count($tbpus->where('apbdes_kegiatan_id', $keg->id)))
                        <a href="/adminDesa/formPenataanBelanja?jenis=cek_tbpu&tahun={{ $tahun }}&kegiatan={{ $keg->id }}"
                            class="btn btn-sm btn-info px-2 py-0" style="font-size: .85rem">{{
                            $keg->penataanbelanja_bkp->count() }} dok</a>
                        @endif
                    </td>
                    <td style="vertical-align: middle" class="text-center">

                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#tambahTBPU{{ $keg->id }}" style="font-size: .75rem">
                            + TBPU
                        </button>
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="tambahTBPU{{ $keg->id }}" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Tambah Tanda Bukti
                                        Pengeluaran Uang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/tambahTBPU" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="apbdes_kegiatan_id" value="{{ $keg->id }}">

                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label for="kegiatan">Nama Kegiatan :</label>
                                            <input type="text" class="form-control" id="kegiatan"
                                                value="{{ $keg->kegiatan->kegiatan }}" style="font-size: .85rem"
                                                readonly>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group  mb-3">
                                                    <label>Nomor TBPU :</label>
                                                    <input type="text" name="nomor" class="form-control"
                                                        style="font-size: .85rem" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group  mb-3">
                                                    <label>Jumlah Uang :</label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="font-size: .85rem">Rp.
                                                            </div>
                                                        </div>
                                                        <input type="text" name="jumlah" class="form-control jumlah"
                                                            id="inlineFormInputGroup" style="font-size: .85rem"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group mb-3">
                                                    <label for="jenis_belanja">Jenis Belanja :</label>
                                                    <select class="form-control" name="belanja_id" id="jenis_belanja"
                                                        style="font-size: .85rem" required>
                                                        <option value="">-- pilih jenis belanja --</option>
                                                        <option value="1">5.1 Belanja Pegawai</option>
                                                        <option value="2">5.2 Belanja Barang/Jasa</option>
                                                        <option value="3">5.3 Belanja Modal</option>
                                                        <option value="4">5.4 Belanja Tak Terduga</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group  mb-3">
                                                    <label>Tanggal TBPU :</label>
                                                    <input type="date" name="tanggal" class="form-control"
                                                        style="font-size: .85rem" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group  mb-3">
                                            <label>Sebagai Pembayaran :</label>
                                            <div class="input-group mb-2">
                                                <input type="text" name="sebagai" class="form-control sebagai"
                                                    style="font-size: .85rem" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4 ">
                                                <label>Potongan PPh :</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-size: .75rem">Rp.
                                                        </div>
                                                    </div>
                                                    <input type="text" name="pph" class="form-control pph angka"
                                                        id="pph" style="font-size: .75rem" placeholder="0">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4 ">
                                                <label>Potongan PPN :</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-size: .75rem">Rp.
                                                        </div>
                                                    </div>
                                                    <input type="text" name="ppn" class="form-control ppn angka"
                                                        id="ppn" style="font-size: .75rem" placeholder="0">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4 ">
                                                <label>Potongan Lainnya :</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-size: .75rem">Rp.
                                                        </div>
                                                    </div>
                                                    <input type="text" name="lainnya" class="form-control lainnya angka"
                                                        id="lainnya" style="font-size: .75rem" placeholder="0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group  mb-2 mt-2">
                                            <label>Upload TBPU :
                                            </label>
                                            <div class="custom-file">
                                                <input type="file" name="file_bkp" class="custom-file-input file_bkp"
                                                    id="customFile " required>
                                                <label class="custom-file-label nama_file" for="customFile"
                                                    style="font-size: .85rem">Upload file PDF max:
                                                    2 MB</label>
                                            </div>
                                        </div>
                                        <small class="text-primary">Catatan : TBPU wajib melampirkan SPJ
                                            (nota/struk/tanda terima/pesanan/bukti belanja
                                            lainnya)</small>

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

        </table> --}}

    </div>
</div>
<hr>
@push('script')
<script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    bsCustomFileInput.init();
   

 
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
            if(input.files[0]['size'] > 4096000){
                alert('ukuran file tidak boleh > 4 MB !');
                $('.file_bkp').val("");
                
                $('.nama_file').html("Choose file PDF (max-size: 4 MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('.file_bkp').val("");
            $('.nama_file').html("Choose PDF (max-size: 4 MB)");
            
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