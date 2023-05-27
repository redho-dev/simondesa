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
                            style="font-size: .8rem" value="" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control text-center" id="progress" style="font-size: .8rem"
                            readonly>
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
                    <th width="8%" class="text-center" style="vertical-align: middle">Dokumen TBPU</th>
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
                        {{ number_format($spps->where('apbdes_kegiatan_id',
                        $keg->id)->pluck('jumlah')->sum(),0,',','.') }}
                    </td>
                    <td style="vertical-align: middle">

                    </td>
                    <td class="text-right" style="vertical-align: middle">

                    </td>
                    <td class="text-right" style="vertical-align: middle">

                    </td>
                    <td class="text-right" style="vertical-align: middle">

                    </td>
                    <td class="text-right" style="vertical-align: middle">

                    </td>
                    <td class="text-center" style="vertical-align: middle">


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

    var jumTBPU = $('#jumTBPU').val();
               
               var totA = $('#totalAnggaran').val();
               var progress = jumTBPU/totA;
                   progress = progress *100;
                   progress = progress.toFixed(2);


</script>


@endpush