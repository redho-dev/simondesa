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
<h4 class="text-info mt-2">Silahkan Cek/Input/Update Dokumen Tanda Bukti Pengeleluaran Uang (TBPU/Kwitansi/BKP) per
    Kegiatan</h4>
<div class="row mt-4">

    <div class="col-md-6">
        <form id="formSPP" action="/adminDesa/formPenataanBelanja" method="get">
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
    {{-- Awal --}}
    <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
        data-target="#tambahTBPU{{ $kegiatan_tbpu->id }}">
        Tambah TBPU
    </button>
    <!-- Modal -->
    <div class="modal fade" id="tambahTBPU{{ $kegiatan_tbpu->id }}" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Tambah Tanda Bukti
                        Pengeluaran Uang (TBPU)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/adminDesa/tambahTBPU" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                    <input type="hidden" name="kegiatan_id" value="{{ $kegiatan_tbpu->kegiatan_id }}">
                    <input type="hidden" name="apbdes_kegiatan_id" value="{{ $kegiatan_tbpu->id }}">

                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="kegiatan">Nama Kegiatan</label>
                            <input type="text" class="form-control" id="kegiatan"
                                value="{{ $kegiatan_tbpu->kegiatan->kegiatan }}" style="font-size: .75rem" readonly>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group  mb-3">
                                    <label>Nomor TBPU :</label>
                                    <input type="text" name="nomor" class="form-control" style="font-size: .85rem"
                                        required>
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
                                            id="inlineFormInputGroup" style="font-size: .85rem" required>
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
                                    <input type="date" name="tanggal" class="form-control" style="font-size: .85rem"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group  mb-3">
                            <label>Sebagai Pembayaran :</label>
                            <div class="input-group mb-2">
                                <input type="text" name="sebagai" class="form-control sebagai" style="font-size: .85rem"
                                    required>
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
                                    <input type="text" name="pph" class="form-control pph angka" id="pph"
                                        style="font-size: .75rem" placeholder="0">
                                </div>
                            </div>
                            <div class="form-group col-md-4 ">
                                <label>Potongan PPN :</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-size: .75rem">Rp.
                                        </div>
                                    </div>
                                    <input type="text" name="ppn" class="form-control ppn angka" id="ppn"
                                        style="font-size: .75rem" placeholder="0">
                                </div>
                            </div>
                            <div class="form-group col-md-4 ">
                                <label>Potongan Lainnya :</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-size: .75rem">Rp.
                                        </div>
                                    </div>
                                    <input type="text" name="lainnya" class="form-control lainnya angka" id="lainnya"
                                        style="font-size: .75rem" placeholder="0">
                                </div>
                            </div>
                        </div>
                        <div class="form-group  mb-2 mt-2">
                            <label>Upload TBPU :
                            </label>
                            <div class="custom-file">
                                <input type="file" name="file_bkp" class="custom-file-input file_bkp" id="customFile "
                                    required>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">KIRIM DATA</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-10">
            <table class="table table-bordered">
                <tr style="background-color: azure">
                    <th>#</th>
                    <th>Nomor TBPU <br> Tanggal</th>
                    <th>Jumlah Uang (Rp)</th>
                    <th>Jenis Belanja /<br> Sbg Pembayaran</th>
                    <th class="text-center">PPh</th>
                    <th class="text-center">PPn</th>
                    <th class="text-center">Lainnya</th>
                    <th class="text-center">File_TBPU <br> (Kwitansi/BKP)</th>
                    <th class="text-center">Aksi</th>

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
                    <td class="jumlahBKP angka">{{ $bkp->jumlah }}</td>
                    <td>
                        <ul class="pl-2">
                            <li> {{ $bkp->belanja->jenis_belanja }}</li>
                            <li>{{ $bkp->sebagai }}</li>
                        </ul>

                    </td>
                    <td class="text-right angka">{{ $bkp->pph }}</td>
                    <td class="text-right angka">{{ $bkp->ppn }}</td>
                    <td class="text-right angka">{{ $bkp->lainnya }}</td>

                    <td class="text-center">
                        <a href="{{ asset('storage/'.$bkp->file_bkp) }}" target="_blank"><img src="/img/logo-pdf.jpg"
                                width="35px"></a>
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#editTBPU{{ $bkp->id }}" style="font-size: .75rem">
                                Edit
                            </button>
                            <form action="/adminDesa/hapusTBPU/{{ $bkp->id }}" method="post">
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit"
                                    onclick="return confirm('yakin hapus?');">hapus</button>
                            </form>
                        </div>
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="editTBPU{{ $bkp->id }}" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-dark" id="staticBackdropLabel">Form
                                        Edit/Update TBPU</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/updateTBPU" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="id" value="{{ $bkp->id }}">

                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label for="kegiatan">Nama Kegiatan :</label>
                                            <input type="text" class="form-control" id="kegiatan"
                                                value="{{ $bkp->apbdes_kegiatan->kegiatan->kegiatan }}"
                                                style="font-size: .75rem" readonly>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group  mb-3">
                                                    <label>Nomor Tanda Bukti Pengeluaran Uang :</label>
                                                    <input type="text" name="nomor" class="form-control"
                                                        style="font-size: .85rem" value="{{ $bkp->nomor }}" required>
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
                                                        <input type="text" name="jumlah"
                                                            class="form-control jumlah angka" id="inlineFormInputGroup"
                                                            style="font-size: .85rem" value="{{ $bkp->jumlah }}"
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
                                                    <label>Tanggal Tanda Bukti Pengeluaran Uang :</label>
                                                    <input type="date" name="tanggal" class="form-control"
                                                        style="font-size: .85rem" value="{{ $bkp->tanggal }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group  mb-3">
                                            <label>Sebagai Pembayaran :</label>
                                            <div class="input-group mb-2">
                                                <input type="text" name="sebagai" class="form-control sebagai"
                                                    style="font-size: .85rem" value="{{ $bkp->sebagai }}" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-4 mb-3">
                                                <label>Jumlah Potongan PPh :</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-size: .75rem">Rp.
                                                        </div>
                                                    </div>
                                                    <input type="text" name="pph" class="form-control pph angka"
                                                        id="pph" style="font-size: .75rem" placeholder="0"
                                                        value="{{ $bkp->pph }}">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4 mb-3">
                                                <label>Jumlah Potongan PPn :</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-size: .75rem">Rp.
                                                        </div>
                                                    </div>
                                                    <input type="text" name="ppn" class="form-control ppn angka"
                                                        id="ppn" style="font-size: .75rem" placeholder="0"
                                                        value="{{ $bkp->ppn }}">
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
                                                        id="lainnya" style="font-size: .75rem" placeholder="0"
                                                        value="{{ $bkp->lainnya }}">
                                                </div>
                                            </div>

                                        </div>


                                        <div class="form-group mb-3 mt-2">
                                            <label>Ganti File TPBU dan Lampiran :
                                            </label>
                                            <div class="custom-file row">
                                                <div class="col-md-2">
                                                    <a href="{{ asset('storage/'.$bkp->file_bkp) }}"
                                                        target="_blank"><img src="/img/logo-pdf.jpg" width="40px"></a>
                                                    <input type="hidden" name="old_1" value="{{ $bkp->file_bkp }}">
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="file" name="file_bkp"
                                                        class="custom-file-input file_bkp" id="customFile ">
                                                    <label class="custom-file-label nama_file" for="customFile"
                                                        style="font-size: .85rem">Pilih file PDF
                                                        max: 4 MB</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">UPDATE
                                            DATA</button>
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

@if(session()->has('fail'))
<script>
    Swal.fire({
    position: 'center',
    icon: 'error',
    title: '{{ session("fail") }}',
    showConfirmButton: true
    
    })
</script>

@endif


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
                alert('ukuran file tidak boleh > 4 Mb !');
                $('.file_bkp').val("");
                
                $('.nama_file').html("file PDF (max 4 MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('.file_bkp').val("");
            $('.nama_file').html("file PDF (max 4 MB)");
            
        }
               
        }

    }

    


</script>


@endpush