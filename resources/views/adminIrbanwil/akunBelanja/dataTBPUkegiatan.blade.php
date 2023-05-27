@php
if ($anggaran=='perubahan') {
$anggaran = 'anggaran_perubahan';
$status = 'Anggaran Perubahan';
}else{
$anggaran = 'anggaran_murni';
$status = 'Anggaran Murni';
}
@endphp
<hr>
<h4 class="text-info mt-2">Silahkan Cek Dokumen TBPU dan Bukti Belanja per
    Kegiatan dan Lakukan Penilaian</h4>
<div class="row mt-4">

    <div class="col-md-6">
        <form id="formSPP" action="/adminIrbanwil/belanja" method="get">
            {{-- <input type="hidden" id="asal_id" name="asal_id" value="{{ $infos->asal_id }}"> --}}
            <input type="hidden" id="tahun" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="jenis" value="cek_tbpu">
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
    <div class="col-md-3">
        <button class="btn btn-sm btn-primary" id="carkeg" type="submit" style="font-size: .80rem">Cek
            TBPU </button>
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
                    <th colspan="5"> {{ $kegiatan_tbpu->kegiatan->kegiatan }}</th>
                </tr>
                <tr>
                    <th>Anggaran Kegiatan
                    </th>
                    <th>Rp. <input type="text" class="angka" id="anggKeg" value="{{ $kegiatan_tbpu->$anggaran }}"
                            disabled></th>
                    <th>Akumulasi TBPU</th>
                    <th>Rp. <input type="text" id="totalBKP" class="angka" disabled> </th>
                    <th>Sisa Anggaran</th>
                    <th>Rp. <input type="text" class="angka" id="sisA" disabled></th>
                </tr>
            </table>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">

            <table class="table table-bordered">
                <tr style="background-color: azure">
                    <th width="4%" style="vertical-align: middle">#</th>
                    <th width="10%" style="vertical-align: middle">Nomor TBPU <br> Tanggal</th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Jumlah Uang (Rp)</th>
                    <th width="18%" style="vertical-align: middle">Jenis Belanja /<br> Sbg Pembayaran</th>
                    <th width="8%" class="text-center" style="vertical-align: middle">TBPU <br> & Bukti Belanja</th>
                    <th width="8%" class="text-center" style="vertical-align: middle">Status</th>
                    <th width="8%" class="text-center" style="vertical-align: middle">Nilai Kelengkapan</th>
                    <th width="8%" class="text-center" style="vertical-align: middle">Temuan & Rekomendasi</th>
                    <th width="6%" class="text-center" style="vertical-align: middle">Koreksi Pajak</th>

                    <th width="20%" class="text-center" style="vertical-align: middle">Aksi</th>

                </tr>
                @foreach($kegiatan_tbpu->penataanbelanja_bkp as $bkp)
                <tr id="bkp_{{ $bkp->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <ul class="pl-2">
                            <li>No : {{ $bkp->nomor }}</li>
                            <li>Tgl: {{ $bkp->tanggal }}</li>
                        </ul>
                    </td>
                    <td class="jumlahBKP angka">{{ $bkp->jumlah }}</td>
                    <td>
                        <ul class="pl-2">
                            <li> {{ $bkp->belanja->jenis_belanja }}</li>
                            <li>{{ $bkp->sebagai }}</li>
                        </ul>

                    </td>
                    <td class="text-center">
                        <a href="{{ asset('storage/'.$bkp->file_bkp) }}" target="_blank"><img src="/img/logo-pdf.jpg"
                                width="35px"></a>
                    </td>
                    <td class="text-center status">
                        {{ $bkp->status_bkp ?? '' }}
                    </td>
                    <td class="text-center nilai">
                        {{ $bkp->nilai_bkp ?? '' }}
                    </td>
                    <td class="text-center catatan">
                        @if($bkp->catatan_bkp)
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#catatanBKP{{ $bkp->id }}" style="font-size: .85rem">
                            Lihat
                        </button>
                        @endif
                    </td>
                    <td class="text-center">
                        {{ $bkp->koreksi_pajak ? 'ya' : 'tidak' }}
                    </td>

                    <td class="text-center">
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#nilaiTBPU{{ $bkp->id }}" style="font-size: .85rem">
                                {{ $bkp->nilai_bkp ? 'Edit Nilai & Temuan' : '+ Nilai & Temuan' }}
                            </button>

                            <button class="btn btn-warning btn-sm reset" idbkp="{{ $bkp->id }}">
                                Reset
                            </button>
                        </div>
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="nilaiTBPU{{ $bkp->id }}" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form
                                        Penilaian Kelengkapan TBPU dan Bukti Belanja</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/nilaiTBPU" method="POST">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="id" value="{{ $bkp->id }}">


                                    <div class="modal-body p-4">
                                        <div class="form-row">
                                            <div class="col-md-8">
                                                <div class="form-group mb-3">
                                                    <label for="kegiatan">Nama Kegiatan :</label>
                                                    <input type="text" class="form-control" id="kegiatan"
                                                        value="{{ $bkp->apbdes_kegiatan->kegiatan->kegiatan }}"
                                                        style="font-size: .75rem" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group  mb-3">
                                                    <label>Nomor TBPU :</label>
                                                    <input type="text" name="nomor" class="form-control"
                                                        style="font-size: .85rem" value="{{ $bkp->nomor }}" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Jumlah Uang :</label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="font-size: .85rem">
                                                                Rp.
                                                            </div>
                                                        </div>
                                                        <input type="text" name="jumlah"
                                                            class="form-control jumlah angka" id="inlineFormInputGroup"
                                                            style="font-size: .85rem" value="{{ $bkp->jumlah }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group mb-3">
                                                    <label for="jenis_belanja">Jenis Belanja :</label>
                                                    <select class="form-control" name="belanja_id" id="jenis_belanja"
                                                        style="font-size: .85rem" readonly>

                                                        <option value="">==pilih jenis belanja==</option>
                                                        <option value="1" {{ $bkp->belanja_id == 1 ?
                                                            'selected' : '' }}>5.1 Belanja Pegawai</option>
                                                        <option value="2" {{ $bkp->belanja_id == 2 ?
                                                            'selected' : '' }}>5.2 Belanja Barang/Jasa
                                                        </option>
                                                        <option value="3" {{ $bkp->belanja_id == 3 ?
                                                            'selected' : '' }}>5.3 Belanja Modal</option>
                                                        <option value="4" {{ $bkp->belanja_id == 4 ?
                                                            'selected' : '' }}>5.4 Belanja Tak Terduga
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group  mb-3">
                                                    <label>Tanggal TBPU :</label>
                                                    <input type="date" name="tanggal" class="form-control"
                                                        style="font-size: .85rem" value="{{ $bkp->tanggal }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Jumlah Potongan PPn :</label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="font-size: .85rem">
                                                                Rp.
                                                            </div>
                                                        </div>
                                                        <input type="text" name="ppn" class="form-control ppn angka"
                                                            id="ppn" style="font-size: .85rem" placeholder="0"
                                                            value="{{ $bkp->ppn }}" readonly>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col">
                                                <div class="form-group ">
                                                    <label>Jumlah Potongan PPh :</label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="font-size: .85rem">
                                                                Rp.
                                                            </div>
                                                        </div>
                                                        <input type="text" name="pph" class="form-control pph angka"
                                                            id="pph" style="font-size: .85rem" placeholder="0"
                                                            value="{{ $bkp->pph }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group ">
                                                    <label>Jumlah Potongan Lainnya :</label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="font-size: .85rem">
                                                                Rp.
                                                            </div>
                                                        </div>
                                                        <input type="text" name="lainnya"
                                                            class="form-control lainnya angka" id="lainnya"
                                                            style="font-size: .85rem" placeholder="0"
                                                            value="{{ $bkp->lainnya }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group  mb-3">
                                            <label>Sebagai Pembayaran :</label>
                                            <div class="input-group mb-2">
                                                <input type="text" name="sebagai" class="form-control sebagai"
                                                    style="font-size: .85rem" value="{{ $bkp->sebagai }}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-row induk_row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="status">Status Dokumen</label>
                                                    <select class="form-control" id="status" name="status_bkp"
                                                        style="font-size: .85rem" required>
                                                        <option value="">-- Pilih --</option>
                                                        <option value="Lengkap" {{ trim($bkp->status_bkp) == 'Lengkap' ?
                                                            'selected' : '' }}>Lengkap</option>
                                                        <option value="Tidak_Lengkap" {{ $bkp->status_bkp ==
                                                            'Tidak_Lengkap' ?
                                                            'selected' : '' }}>Tidak_Lengkap</option>
                                                        <option value="Tidak_Sesuai" {{ $bkp->status_bkp ==
                                                            'Tidak_Sesuai' ?
                                                            'selected' : '' }}>Tidak_Sesuai</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group  mb-3">
                                                    <label>Nilai Kelengkapan TBPU (0 - 100)</label>
                                                    <div class="input-group mb-2">

                                                        <input type="number" name="nilai_bkp" class="form-control"
                                                            style="font-size: .85rem"
                                                            value="{{ $bkp->nilai_bkp ?? '' }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="status">Koreksi Pajak</label>
                                                    <select class="form-control koreksi" name="koreksi_pajak"
                                                        style="font-size: .85rem" required>
                                                        <option value="">- Pilih -
                                                        </option>
                                                        <option value=1 {{ $bkp->koreksi_pajak ? 'selected' :
                                                            ''}}>Ya</option>
                                                        <option value=0 {{ !$bkp->koreksi_pajak ? 'selected' :
                                                            ''}}>Tidak</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="form-row bg-secondary koreksi_pajak {{ $bkp->koreksi_pajak ? '' : 'd-none' }}">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="text-white">Koreksi PPn :</label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="font-size: .85rem">
                                                                Rp.
                                                            </div>
                                                        </div>
                                                        <input type="text" name="koreksi_ppn"
                                                            class="form-control koreksi_ppn angka {{ $bkp->ppn < $bkp->koreksi_ppn ? 'text-danger' : 'text-primary' }}"
                                                            id="koreksi_ppn" style="font-size: .85rem" placeholder="0"
                                                            value="{{ $bkp->koreksi_ppn ?? $bkp->ppn }}">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col">
                                                <div class="form-group ">
                                                    <label class="text-white">Koreksi PPh :</label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="font-size: .85rem">
                                                                Rp.
                                                            </div>
                                                        </div>
                                                        <input type="text" name="koreksi_pph"
                                                            class="form-control koreksi_pph angka {{ $bkp->pph < $bkp->koreksi_pph ? 'text-danger' : 'text-primary' }}"
                                                            id="koreksi_pph" style="font-size: .85rem" placeholder="0"
                                                            value="{{ $bkp->koreksi_pph ?? $bkp->pph }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group ">
                                                    <label class="text-white">Koreksi Lainnya :</label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="font-size: .85rem">
                                                                Rp.
                                                            </div>
                                                        </div>
                                                        <input type="text" name="koreksi_lainnya"
                                                            class="form-control koreksi_lainnya angka {{ $bkp->lainnya < $bkp->koreksi_lainnya ? 'text-danger' : 'text-primary' }}"
                                                            id="koreksi_lainnya" style="font-size: .85rem"
                                                            placeholder="0"
                                                            value="{{ $bkp->koreksi_lainnya ?? $bkp->lainnya }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group mt-2">
                                            <label for="catatan">Temuan : </label>
                                            <textarea class="form-control" id="catatan" rows="3" name="catatan_bkp"
                                                style="font-size: .85rem">{{ $bkp->catatan_bkp ?? ''  }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="catatan">Rekomendasi Tindak Lanjut :</label>
                                            <textarea class="form-control" id="catatan" rows="3" name="rekomendasi_bkp"
                                                style="font-size: .85rem">{{ $bkp->rekomendasi_bkp ?? '' }}</textarea>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">{{ $bkp->nilai_bkp ?
                                            "UPDATE" : "KIRIM" }}</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                    <!-- Modal Catatan BKP-->
                    <div class="modal fade" id="catatanBKP{{ $bkp->id }}" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-dark" id="staticBackdropLabel">Temuan dan Rekomendasi TL
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group mb-3">
                                        <label for="kegiatan">Nama Kegiatan</label>
                                        <input type="text" class="form-control" id="kegiatan" style="font-size: .75rem"
                                            value="{{ $bkp->apbdes_kegiatan->kegiatan->kegiatan }}" readonly>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group  mb-3">
                                                <label>Nomor BKP</label>
                                                <input type="text" name="nomor" class="form-control"
                                                    style="font-size: .75rem" value="{{ $bkp->nomor }}" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="catatan">Temuan :</label>
                                        <textarea class="form-control" id="catatan" rows="3" name="catatan"
                                            style="font-size: .8rem" readonly>{{ $bkp->catatan_bkp ?? ''  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="catatan">Rekomendasi Tindak Lanjut :</label>
                                        <textarea class="form-control" id="catatan" rows="3" name="rekomendasi"
                                            style="font-size: .8rem"
                                            readonly>{{ $bkp->rekomendasi_bkp ?? '' }}</textarea>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </tr>
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
   
   
   

    var Anggaran = $('#anggKeg').val();
        Anggaran = Number(Anggaran.replaceAll(".",""));
               
    var Lbkp = $('.jumlahBKP').length;
    var totbkp = 0;
    for(let i = 0; i<Lbkp; i++){
        var jumbkp = $('.jumlahBKP').eq(i).html().replaceAll('.', '');
            jumbkp = Number(jumbkp);
            totbkp += jumbkp;
    }
    $('#totalBKP').val(totbkp);
    var sisA = Anggaran-totbkp;
    $('#sisA').val(sisA);
    if(sisA < 0){
        $('#totalBKP').addClass('text-danger');
        $('#sisA').addClass('text-danger');
    }else{
        $('#totalBKP').removeClass('text-danger');
        $('#sisA').removeClass('text-danger');
    }
    
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
            if(input.files[0]['size'] > 1024000){
                alert('ukuran file tidak boleh > 1 Mb !');
                $('.file_spp').val("");
                
                $('.nama_file').html("Choose file PDF (max-size: 1MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('.file_spp').val("");
            $('.nama_file').html("Choose PDF (max-size: 1MB)");
            
        }
               
        }

    }

    


</script>


@endpush