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
<h4 class="text-info mt-2">Silahkan lakukan uji petik terhadap <u>satu dokumen TBPU beserta bukti belanjanya</u></h4>
<div class="row mt-4">

    <div class="col-md-6">
        <form id="formSPP" action="/adminIrbanwil/belanja" method="get">
            {{-- <input type="hidden" id="asal_id" name="asal_id" value="{{ $infos->asal_id }}"> --}}
            <input type="hidden" id="tahun" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="jenis" value="uji_petik">
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
        <div class="col-md-8">
            <table class="table table-bordered">
                <tr style="background-color: rgb(188, 246, 246)">
                    <th width="5%">#</th>
                    <th width="20%">Nomor TBPU <br> Tanggal</th>
                    <th width="20%" class="text-center">Jumlah Uang (Rp)</th>
                    <th width="25%">Jenis Belanja /<br> Sbg Pembayaran</th>
                    <th width="15%" class="text-center">File_TBPU <br> dan Bukti Belanja</th>
                    <th width="15%" class="text-center">Aksi</th>

                </tr>
                @foreach($kegiatan_tbpu->penataanbelanja_bkp as $bkp)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <ul class="pl-2">
                            <li>No : {{ $bkp->nomor }}</li>
                            <li>Tgl: {{ $bkp->tanggal }}</li>
                        </ul>
                    </td>
                    <td class="jumlahBKP text-center">
                        <span class="angka">{{ $bkp->jumlah }}</span>
                    </td>
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

                    <td class="text-center">
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#ujiTBPU{{ $bkp->id }}" style="font-size: .85rem">
                                + Uji Petik
                            </button>
                        </div>
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="ujiTBPU{{ $bkp->id }}" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form
                                        Validasi / Uji Petik terhadap Bukti Belanja</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tambahUjipetik" method="POST">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="penataanbelanja_bkp_id" value="{{ $bkp->id }}">
                                    <input type="hidden" name="apbdes_kegiatan_id"
                                        value="{{ $bkp->apbdes_kegiatan_id }}">


                                    <div class="modal-body p-4">
                                        <div class="form-group mb-3">
                                            <label for="kegiatan">Nama Kegiatan :</label>
                                            <input type="text" class="form-control" id="kegiatan"
                                                value="{{ $bkp->apbdes_kegiatan->kegiatan->kegiatan }}"
                                                style="font-size: .75rem" readonly>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group  mb-3">
                                                    <label>Nomor TBPU :</label>
                                                    <input type="text" name="nomor" class="form-control"
                                                        style="font-size: .85rem" value="{{ $bkp->nomor }}" readonly>
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
                                        </div>
                                        <div class="form-group  mb-3">
                                            <label>Sebagai Pembayaran :</label>
                                            <div class="input-group mb-2">
                                                <input type="text" name="sebagai" class="form-control sebagai"
                                                    style="font-size: .85rem" value="{{ $bkp->sebagai }}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="status">Metode Uji Petik :</label>
                                                    <select class="form-control" id="status" name="metode"
                                                        style="font-size: .85rem" required>
                                                        <option value="">- Pilih -</option>
                                                        <option>Konfirmasi Langsung</option>
                                                        <option>Konfirmasi Tidak Langsung</option>
                                                        <option>Kuisioner</option>
                                                        <option>Surat Pernyataan</option>
                                                        <option>Lainnya</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="status">Tanggal Uji Petik :</label>
                                                    <input type="date" class="form-control" style="font-size: .85rem"
                                                        name="tgl_uji_petik" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group  mb-3">
                                                    <label>Nilai Hasil Validasi (0-100) :</label>
                                                    <div class="input-group mb-2">
                                                        <input type="number" name="nilai" class="form-control"
                                                            style="font-size: .85rem" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group  mb-3">
                                            <label>Nama Validator (Pelaksana Uji Petik) :</label>
                                            <div class="input-group mb-2">
                                                <input type="tet" name="validator" class="form-control"
                                                    style="font-size: .85rem" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kesimpulan">Temuan :</label>
                                            <textarea class="form-control" id="kesimpulan" rows="3"
                                                name="kesimpulan_sementara" style="font-size: .85rem"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="catatan">Rekomendasi Tindak Lanjut :</label>
                                            <textarea class="form-control" id="catatan" rows="3"
                                                name="rekomendasi_sementara" style="font-size: .85rem"></textarea>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">KIRIM</button>
                                    </div>
                                </form>
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