@php
if ($anggaran=='perubahan') {
$anggaran = 'anggaran_perubahan';
$status = 'Anggaran Perubahan';
}else{
$anggaran = 'anggaran_murni';
$status = 'Anggaran Murni';
}
@endphp

<p class="text-info my-2">Silahkan Cek/Tambah/Update Data Pengajuan per Jenis Pendapatan (APBDes TA {{ $tahun }})</p>
<form action="/adminDesa/formPenataanPendapatan" method="get">
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
                Pengajuan</button>
        </div>
    </div>
</form>
<hr>
<div class="row" id="isiPengajuan">
    <div class="col-md-10">

        @if(Request('pendapatan'))
        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
            data-target="#pendapatan_{{ Request('pendapatan') }}">
            Tambah Data Pengajuan
        </button>
        <!-- Modal Tambah Pengajuan-->
        <div class="modal fade" id="pendapatan_{{ Request('pendapatan') }}" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-white">Tambah Data Pengajuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body ">
                        <form action="/adminDesa/tambahPengajuan" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                            <input type="hidden" name="jenis" value="{{ $nampend }}">
                            <input type="hidden" name="pendapatan_id" value="{{ $pendapatan_id }}">
                            <input type="hidden" name="apbdes_pendapatan_id" value="{{Request('pendapatan') }}">
                            @if($pendapatan_id == 3)
                            <div class="form-group mb-4">
                                <label for="tahapan">Pilih Tahapan Dana Desa</label>
                                <select class="form-control" id="tahapan" name="nama_data">
                                    <option>Dana Desa Tahap I</option>
                                    <option>Dana Desa Tahap II</option>
                                    <option>Dana Desa Tahap III</option>
                                </select>
                            </div>
                            @endif
                            @if($pendapatan_id == 1)
                            <div class="form-group mb-4">
                                <label for="nama_data">Nama_data</label>
                                <input type="text" class="form-control" name="nama_data"
                                    value="Penerimaan dan Pencatatan PAD" readonly required>
                            </div>
                            @endif
                            @if($pendapatan_id == 4)
                            <div class="form-group mb-4">
                                <label for="nama_data">Nama_data</label>
                                <input type="text" class="form-control" name="nama_data" value="Pengajuan DBH Kabupaten"
                                    readonly required>
                            </div>
                            @endif
                            @if($pendapatan_id == 5)
                            <div class="form-group mb-4">
                                <label for="nama_data">Nama_data</label>
                                <input type="text" class="form-control" name="nama_data" value="Pengajuan ADD" readonly
                                    required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="Jumlah">Pengajuan ADD untuk Bulan :</label>
                                <div class="input-group mb-2">
                                    <span class="ml-2"><input type="checkbox" name="bulan[]"
                                            value="januari">&ensp;Jan</span>
                                    <span class="ml-2"><input type="checkbox" name="bulan[]"
                                            value="februari">&ensp;Feb</span>
                                    <span class="ml-2"><input type="checkbox" name="bulan[]"
                                            value="maret">&ensp;Mar</span>
                                    <span class="ml-2"><input type="checkbox" name="bulan[]"
                                            value="april">&ensp;Apr</span>
                                    <span class="ml-2"><input type="checkbox" name="bulan[]"
                                            value="mei">&ensp;Mei</span>
                                    <span class="ml-2"><input type="checkbox" name="bulan[]"
                                            value="juni">&ensp;Jun</span>
                                    <span class="ml-2"><input type="checkbox" name="bulan[]"
                                            value="juli">&ensp;Jul</span>
                                    <span class="ml-2"><input type="checkbox" name="bulan[]"
                                            value="agustus">&ensp;Agu</span>
                                    <span class="ml-2"><input type="checkbox" name="bulan[]"
                                            value="september">&ensp;Sep</span>
                                    <span class="ml-2"><input type="checkbox" name="bulan[]"
                                            value="oktober">&ensp;Okt</span>
                                    <span class="ml-2"><input type="checkbox" name="bulan[]"
                                            value="november">&ensp;Nov</span>
                                    <span class="ml-2"><input type="checkbox" name="bulan[]"
                                            value="desember">&ensp;Des</span>
                                    <span class="ml-2"><input type="checkbox" name="bulan[]"
                                            value="kurang_salur">&ensp;Kurang Salur</span>

                                </div>
                            </div>
                            @endif
                            @if($pendapatan_id == 6)
                            <div class="form-group mb-4">
                                <label for="nama_data">Nama_data</label>
                                <input type="text" class="form-control" name="nama_data"
                                    value="Pengajuan Bantuan Keuangan Provinsi" readonly required>
                            </div>
                            @endif
                            @if($pendapatan_id == 7)
                            <div class="form-group mb-4">
                                <label for="nama_data">Nama_data</label>
                                <input type="text" class="form-control" name="nama_data"
                                    value="Pengajuan Bantuan Keuangan Kabupaten" readonly required>
                            </div>
                            @endif
                            @if($pendapatan_id == 8)
                            <div class="form-group mb-4">
                                <label for="nama_data">Nama_data</label>
                                <input type="text" class="form-control" name="nama_data"
                                    value="Pencatatan dan Penerimaan Lain-lain Pendapatan" readonly required>
                            </div>
                            @endif


                            <div class="form-group mb-4">
                                @if($pendapatan_id == 1)
                                <label for="jumlah">Jumlah PAD yang diterima dan dicatat bendahara dari sumber
                                    PAD</label>
                                @elseif($pendapatan_id == 8)
                                <label for="jumlah">Jumlah Pendapatan Lain-lain yang diterima dan dicatat
                                    bendahara</label>
                                @else
                                <label for="Jumlah">Jumlah Dana yang diajukan </label>
                                @endif
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp.</div>
                                    </div>
                                    <input type="text" class="form-control jumlah" name="jumlah" id="jumlah" required>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="tgl_pengajuan">Tanggal Pengajuan</label>
                                <input type="date" class="form-control" id="tgl_pengajuan" name="tgl_pengajuan"
                                    required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="tgl_saldo">Tanggal Terima/Transfer/Pemindahan Saldo ke Kas Desa</label>
                                <input type="date" class="form-control" id="tgl_saldo" name="tgl_saldo" required>
                            </div>
                            <div class="form-group mb-4">
                                @if($pendapatan_id == 1 || $pendapatan_id == 8)
                                <label for="tgl_saldo">Upload Bukti Setor ke Kas Desa</label>
                                @else
                                <label for="tgl_saldo">Upload Surat Pengajuan (Tanpa Lampiran)</label>
                                @endif
                                <div class="custom-file">
                                    <input type="file" name="file_data" class="custom-file-input file_pengajuan"
                                        id="customFile" required>
                                    <label class="custom-file-label nama_file" for="customFile">File PDF
                                        (Max:512KB)</label>
                                </div>
                            </div>





                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Kirim Data</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr style="background-color: blanchedalmond">
                    <th style="vertical-align: middle">#</th>
                    <th style="vertical-align: middle">Pengajuan</th>
                    <th style="vertical-align: middle" class="text-center">Jumlah yang <br>diajukan (Rp)</th>
                    <th style="vertical-align: middle" class="text-center">Tgl_pengajuan</th>
                    <th style="vertical-align: middle" class="text-center">Tgl_saldo_kas_desa</th>
                    <th style="vertical-align: middle" class="text-center">Surat Pengajuan</th>
                    <th style="vertical-align: middle" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jenpend->penataan_pendapatan as $pengajuan)
                <tr>
                    <td></td>
                    <td>{{ $pengajuan->nama_data }}</td>
                    <td class="text-right jumlah">{{ $pengajuan->jumlah }}</td>
                    <td class="text-center">{{ $pengajuan->tgl_pengajuan }}</td>
                    <td class="text-center">{{ $pengajuan->tgl_saldo }}</td>
                    <td class="text-center">
                        <a href="{{ asset('storage/'.$pengajuan->file_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px" alt="">
                        </a>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                            data-target="#editPengajuan_{{ $pengajuan->id }}">
                            edit
                        </button>
                        <a href="/adminDesa/deletePengajuan/{{ $pengajuan->id }}" class="btn btn-sm btn-danger"
                            onclick="return confirm('yakin hapus?');">hapus</a>
                    </td>
                    <!-- Modal Edit Pengajuan-->
                    <div class="modal fade" id="editPengajuan_{{ $pengajuan->id }}" data-backdrop="static"
                        data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-white">Edit Data Pengajuan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body ">
                                    <form action="/adminDesa/updatePengajuan" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                        <input type="hidden" name="tahun" value="{{ $tahun }}">
                                        <input type="hidden" name="id" value="{{ $pengajuan->id }}">
                                        <input type="hidden" name="jenis" value="{{ $pengajuan->jenis }}">
                                        <input type="hidden" name="pendapatan_id"
                                            value="{{ $pengajuan->pendapatan_id }}">
                                        <input type="hidden" name="apbdes_pendapatan_id"
                                            value="{{ $pengajuan->apbdes_pendapatan_id }}">

                                        @if($pengajuan->pendapatan_id == 3)
                                        <div class="form-group mb-4">
                                            <label for="tahapan">Pilih Tahapan Dana Desa</label>
                                            <select class="form-control" id="tahapan" name="nama_data">
                                                <option {{ $pengajuan->nama_data == 'Dana Desa Tahap I' ? 'selected' :
                                                    '' }}>Dana Desa Tahap I</option>
                                                <option {{ $pengajuan->nama_data == 'Dana Desa Tahap II' ? 'selected' :
                                                    '' }}>Dana Desa Tahap II</option>
                                                <option {{ $pengajuan->nama_data == 'Dana Desa Tahap III' ? 'selected' :
                                                    '' }}>Dana Desa Tahap III</option>
                                            </select>
                                        </div>
                                        @endif
                                        @if($pengajuan->pendapatan_id == 1)
                                        <div class="form-group mb-4">
                                            <label for="nama_data">Nama_data</label>
                                            <input type="text" class="form-control" name="nama_data"
                                                value="Penerimaan dan Pencatatan PAD" readonly required>
                                        </div>
                                        @endif
                                        @if($pengajuan->pendapatan_id == 4)
                                        <div class="form-group mb-4">
                                            <label for="nama_data">Nama_data</label>
                                            <input type="text" class="form-control" name="nama_data"
                                                value="Pengajuan DBH Kabupaten" readonly required>
                                        </div>
                                        @endif
                                        @if($pengajuan->pendapatan_id == 5)
                                        <div class="form-group mb-4">
                                            <label for="nama_data">Nama_data</label>
                                            <input type="text" class="form-control" name="nama_data"
                                                value="{{ $pengajuan->nama_data }}" required>
                                        </div>
                                        @endif
                                        @if($pengajuan->pendapatan_id == 6)
                                        <div class="form-group mb-4">
                                            <label for="nama_data">Nama_data</label>
                                            <input type="text" class="form-control" name="nama_data"
                                                value="Pengajuan Bantuan Keuangan Provinsi" readonly required>
                                        </div>
                                        @endif
                                        @if($pengajuan->pendapatan_id == 7)
                                        <div class="form-group mb-4">
                                            <label for="nama_data">Nama_data</label>
                                            <input type="text" class="form-control" name="nama_data"
                                                value="Pengajuan Bantuan Keuangan Kabupaten" readonly required>
                                        </div>
                                        @endif
                                        @if($pengajuan->pendapatan_id == 8)
                                        <div class="form-group mb-4">
                                            <label for="nama_data">Nama_data</label>
                                            <input type="text" class="form-control" name="nama_data"
                                                value="Pencatatan dan Penerimaan Lain-lain Pendapatan" readonly
                                                required>
                                        </div>
                                        @endif


                                        <div class="form-group mb-4">
                                            @if($pengajuan->pendapatan_id == 1)
                                            <label for="jumlah">Jumlah PAD yang diterima dan dicatat bendahara dari
                                                sumber
                                                PAD</label>
                                            @elseif($pengajuan->pendapatan_id == 8)
                                            <label for="jumlah">Jumlah Pendapatan Lain-lain yang diterima dan dicatat
                                                bendahara</label>
                                            @else
                                            <label for="Jumlah">Jumlah Dana yang diajukan </label>
                                            @endif
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Rp.</div>
                                                </div>
                                                <input type="text" class="form-control jumlah" name="jumlah" id="jumlah"
                                                    value="{{ $pengajuan->jumlah }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="tgl_pengajuan">Tanggal Pengajuan</label>
                                            <input type="date" class="form-control" id="tgl_pengajuan"
                                                name="tgl_pengajuan" value="{{ $pengajuan->tgl_pengajuan }}" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="tgl_saldo">Tanggal Terima/Transfer/Pemindahan Saldo ke Kas
                                                Desa</label>
                                            <input type="date" class="form-control" id="tgl_saldo" name="tgl_saldo"
                                                value="{{ $pengajuan->tgl_saldo }}" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            @if($pengajuan->pendapatan_id == 1 || $pengajuan->pendapatan_id == 8)
                                            <label for="tgl_saldo">Ganti Bukti Setor ke Kas Desa</label>
                                            @else
                                            <label for="tgl_saldo">Ganti Surat Pengajuan (Tanpa Lampiran)</label>
                                            @endif
                                            <div class="custom-file">
                                                <input type="hidden" name="old_1" value="{{ $pengajuan->file_data }}">
                                                <input type="file" name="file_data"
                                                    class="custom-file-input file_pengajuan" id="customFile">
                                                <label class="custom-file-label nama_file" for="customFile">File PDF
                                                    (Max:512KB)</label>
                                            </div>
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Kirim Data</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
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