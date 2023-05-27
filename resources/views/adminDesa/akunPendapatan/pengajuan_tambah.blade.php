@php
if ($anggaran=='perubahan') {
$anggaran = 'anggaran_perubahan';
$status = 'Anggaran Perubahan';
}else{
$anggaran = 'anggaran_murni';
$status = 'Anggaran Murni';
}
@endphp

<p class="text-info">Form Input Data Pengajuan/Penerimaan Pendapatan (APBDes TA {{ $tahun }})</p>

<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label for="totalAnggaran">Jumlah Anggaran Pendapatan</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                </div>
                <input type="text" class="form-control angka" id="totalAnggaran"
                    value="{{ $total_p->pendapatan_perubahan ?? $total_p->pendapatan_murni }}" style="font-size: .75rem"
                    readonly>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="totalPengajuan">Realisasi Pendapatan</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                </div>
                <input type="text" class="form-control text-right angka" id="totalPengajuan" style="font-size: .75rem"
                    readonly>
            </div>

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="progressSPP">Progress Pendapatan</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control text-right" id="progressPengajuan" style="font-size: .75rem;"
                    readonly>
                <div class=" input-group-append">
                    <div class="input-group-text" style="font-size: .75rem">%</div>
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="sisaAnggaran">Sisa Anggaran Pendapatan</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                </div>
                <input type="text" class="form-control text-right angka" id="sisaAnggaran" style="font-size: .75rem"
                    readonly>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-11">
        <table class="table table-bordered">
            <thead style="background-color: beige">
                <tr>
                    <th style="vertical-align: middle">Kode_rek</th>
                    <th style="vertical-align: middle">Jenis Pendapatan</th>
                    <th class="text-center" style="vertical-align: middle">{{ $status }} <br> (Rp)</th>
                    <th class="text-center" style="vertical-align: middle">Akumlasi Jumlah <br>Pengajuan &
                        Penerimaan
                        <br>
                        (Rp)
                    </th>
                    <th class="text-center" style="vertical-align: middle">Cek Dokumen Pengajuan <br>& Penerimaan
                        <br><small>(klik untuk
                            cek)</small>
                    </th>
                    <th class="text-center" style="vertical-align: middle">Upload </br>Data Pengajuan <br>&
                        Penerimaan
                    </th>
                </tr>
            </thead>
            @foreach($pendapatans as $pd)
            @if($pd->pendapatan_id != '2' && $pd->anggaran_murni || $pd->pendapatan_id != '2' &&
            $pd->anggaran_perubahan)
            <tr>
                <th>{{ $pd->kode_pendapatan }}</th>
                <th>{{ $pd->jenis_pendapatan }}</th>

                <th class="text-right">
                    <input type="text" class="angka text-right" value="{{ $pd->$anggaran }}" disabled>

                </th>
                <th>

                    <?php $i = 0; $jum = 0; $nominal=0; ?>
                    @foreach($pd->penataan_pendapatan as $jumja)
                    <?php 
                    $nominal = intval(str_replace('.', '', $jumja->jumlah)); 
                    $jum += $nominal;
                    $i++;
                    ?>
                    @endforeach
                    <input type="text" class="angka jumlahPengajuan text-right" value="{{ $jum }}" disabled>

                </th>
                <th class="text-center">
                    <?php $i = 0; ?>
                    @foreach($pd->penataan_pendapatan as $pengajuan)

                    <?php $i++; ?>
                    @endforeach
                    @if($i>0)
                    <a href="/adminDesa/formPenataanPendapatan?jenis=cek_pengajuan&tahun={{ $tahun }}&pendapatan={{ $pd->id }}"
                        class="btn btn-info btn-sm">{{ $i }} Dokumen</a>
                    @endif
                </th>

                <th>
                    <button type="button" class="btn btn-primary btn-sm " data-toggle="modal"
                        data-target="#pendapatan_{{ $pd->pendapatan_id }}">
                        + Data Pengajuan
                    </button>
                </th>
                <!-- Modal DD-->
                <div class="modal fade" id="pendapatan_{{ $pd->pendapatan_id }}" data-backdrop="static"
                    data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content {{ $pd->pendapatan_id == 3 ? '' : 'd-none' }}">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-white">Tambah Data Pengajuan {{
                                    $pd->jenis_pendapatan }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body ">
                                <form action="/adminDesa/tambahPengajuan" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="jenis" value="{{ $pd->jenis_pendapatan }}">
                                    <input type="hidden" name="pendapatan_id" value="{{ $pd->pendapatan_id }}">
                                    <input type="hidden" name="apbdes_pendapatan_id" value="{{ $pd->id }}">
                                    <div class="form-group mb-4">
                                        <label for="tahapan">Pilih Tahapan Dana Desa</label>
                                        <select class="form-control" id="tahapan" name="nama_data">
                                            <option>Dana Desa Tahap I</option>
                                            <option>Dana Desa Tahap II</option>
                                            <option>Dana Desa Tahap III</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="Jumlah">Jumlah Dana yang diajukan</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp.</div>
                                            </div>
                                            <input type="text" class="form-control jumlah" name="jumlah" id="jumlah"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="tgl_pengajuan">Tanggal Pengajuan</label>
                                        <input type="date" class="form-control" id="tgl_pengajuan" name="tgl_pengajuan"
                                            required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="tgl_saldo">Tanggal Pemindahan Saldo ke Kas Desa</label>
                                        <input type="date" class="form-control" id="tgl_saldo" name="tgl_saldo"
                                            required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="tgl_saldo">Upload Surat Pengajuan dari Kades (Tanpa
                                            Lampiran)</label>
                                        <div class="custom-file">
                                            <input type="file" name="file_data" class="custom-file-input file_pengajuan"
                                                id="customFile" required>
                                            <label class="custom-file-label nama_file" for="customFile">File PDF
                                                (Max : 1MB)</label>
                                        </div>
                                    </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Kirim Data</button>
                            </div>
                            </form>
                        </div>

                        {{-- Modal DBH --}}
                        <div class="modal-content {{ $pd->pendapatan_id == 4 ? '' : 'd-none' }}">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-white">Tambah Data Pengajuan {{
                                    $pd->jenis_pendapatan }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body ">
                                <form action="/adminDesa/tambahPengajuan" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="jenis" value="{{ $pd->jenis_pendapatan }}">
                                    <input type="hidden" name="pendapatan_id" value="{{ $pd->pendapatan_id }}">
                                    <input type="hidden" name="apbdes_pendapatan_id" value="{{ $pd->id }}">
                                    <div class="form-group mb-4">
                                        <label for="nama_data">Nama_data</label>
                                        <input type="text" class="form-control" name="nama_data"
                                            value="Pengajuan DBH Kabupaten" readonly required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="Jumlah">Jumlah Dana yang diajukan</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp.</div>
                                            </div>
                                            <input type="text" class="form-control jumlah" name="jumlah" id="jumlah"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="tgl_pengajuan">Tanggal Pengajuan</label>
                                        <input type="date" class="form-control" id="tgl_pengajuan" name="tgl_pengajuan"
                                            required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="tgl_saldo">Tanggal Pemindahan Saldo ke Kas Desa</label>
                                        <input type="date" class="form-control" id="tgl_saldo" name="tgl_saldo"
                                            required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="tgl_saldo">Upload Surat Pengajuan dari Kades (Tanpa
                                            Lampiran)</label>
                                        <div class="custom-file">
                                            <input type="file" name="file_data" class="custom-file-input file_pengajuan"
                                                id="customFile" required>
                                            <label class="custom-file-label nama_file" for="customFile">File PDF
                                                (Max : 1MB)</label>
                                        </div>
                                    </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Kirim Data</button>
                            </div>
                            </form>
                        </div>

                        {{-- Modal ADD --}}
                        <div class="modal-content {{ $pd->pendapatan_id == 5 ? '' : 'd-none' }}">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-white">Tambah Data Pengajuan {{
                                    $pd->jenis_pendapatan }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body ">
                                <form action="/adminDesa/tambahPengajuan" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="jenis" value="{{ $pd->jenis_pendapatan }}">
                                    <input type="hidden" name="pendapatan_id" value="{{ $pd->pendapatan_id }}">
                                    <input type="hidden" name="apbdes_pendapatan_id" value="{{ $pd->id }}">
                                    <div class="form-group mb-4">
                                        <label for="nama_data">Nama_data</label>
                                        <input type="text" class="form-control" name="nama_data" value="Pengajuan ADD"
                                            readonly required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="Jumlah">Pengajuan ADD untuk Bulan : </label>
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
                                                    value="Kurang Salur">&ensp;Kurang Salur</span>

                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="Jumlah">Jumlah Dana yang diajukan</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp.</div>
                                            </div>
                                            <input type="text" class="form-control jumlah" name="jumlah" id="jumlah"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="tgl_pengajuan">Tanggal Pengajuan</label>
                                        <input type="date" class="form-control" id="tgl_pengajuan" name="tgl_pengajuan"
                                            required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="tgl_saldo">Tanggal Pemindahan Saldo ke Kas Desa</label>
                                        <input type="date" class="form-control" id="tgl_saldo" name="tgl_saldo"
                                            required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="tgl_saldo">Upload Surat Pengajuan dari Kades (Tanpa
                                            Lampiran)</label>
                                        <div class="custom-file">
                                            <input type="file" name="file_data" class="custom-file-input file_pengajuan"
                                                id="customFile" required>
                                            <label class="custom-file-label nama_file" for="customFile">File PDF
                                                (Max : 1MB)</label>
                                        </div>
                                    </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Kirim Data</button>
                            </div>
                            </form>
                        </div>

                        {{-- Modal PAD --}}
                        <div class="modal-content {{ $pd->pendapatan_id == 1 ? '' : 'd-none' }}">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-white">Tambah Data Pencatatan dan Penerimaan {{
                                    $pd->jenis_pendapatan }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body ">
                                <form action="/adminDesa/tambahPengajuan" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="jenis" value="{{ $pd->jenis_pendapatan }}">
                                    <input type="hidden" name="pendapatan_id" value="{{ $pd->pendapatan_id }}">
                                    <input type="hidden" name="apbdes_pendapatan_id" value="{{ $pd->id }}">
                                    <div class="form-group mb-4">
                                        <label for="nama_data">Nama_data</label>
                                        <input type="text" class="form-control" name="nama_data"
                                            value="Penerimaan dan Pencatatan PAD" readonly required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="Jumlah">Jumlah PAD yang diterima</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp.</div>
                                            </div>
                                            <input type="text" class="form-control jumlah" name="jumlah" id="jumlah"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="tgl_pengajuan">Tanggal Penerimaan PAD oleh Kaur Keuangan dari
                                            Sumber
                                            PAD</label>
                                        <input type="date" class="form-control" id="tgl_pengajuan" name="tgl_pengajuan"
                                            required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="tgl_saldo">Tanggal Setor ke Kas Desa</label>
                                        <input type="date" class="form-control" id="tgl_saldo" name="tgl_saldo"
                                            required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="tgl_saldo">Upload Bukti Setor ke Kas Desa</label>
                                        <div class="custom-file">
                                            <input type="file" name="file_data" class="custom-file-input file_pengajuan"
                                                id="customFile" required>
                                            <label class="custom-file-label nama_file" for="customFile">File PDF
                                                (Max : 1MB)</label>
                                        </div>
                                    </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Kirim Data</button>
                            </div>
                            </form>
                        </div>

                        {{-- Modal Bantuan Keuangan Provinsi --}}
                        <div class="modal-content {{ $pd->pendapatan_id == 6 ? '' : 'd-none' }}">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-white">Tambah Data Pengajuan {{
                                    $pd->jenis_pendapatan }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body ">
                                <form action="/adminDesa/tambahPengajuan" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="jenis" value="{{ $pd->jenis_pendapatan }}">
                                    <input type="hidden" name="pendapatan_id" value="{{ $pd->pendapatan_id }}">
                                    <input type="hidden" name="apbdes_pendapatan_id" value="{{ $pd->id }}">
                                    <div class="form-group mb-4">
                                        <label for="nama_data">Nama_data</label>
                                        <input type="text" class="form-control" name="nama_data"
                                            value="Pengajuan Bantuan Keuangan Provinsi" readonly required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="Jumlah">Jumlah Dana yang diajukan</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp.</div>
                                            </div>
                                            <input type="text" class="form-control jumlah" name="jumlah" id="jumlah"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="tgl_pengajuan">Tanggal Pengajuan</label>
                                        <input type="date" class="form-control" id="tgl_pengajuan" name="tgl_pengajuan"
                                            required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="tgl_saldo">Tanggal Pemindahan Saldo ke Kas Desa</label>
                                        <input type="date" class="form-control" id="tgl_saldo" name="tgl_saldo"
                                            required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="tgl_saldo">Upload Surat Pengajuan dari Kades (Tanpa
                                            Lampiran)</label>
                                        <div class="custom-file">
                                            <input type="file" name="file_data" class="custom-file-input file_pengajuan"
                                                id="customFile" required>
                                            <label class="custom-file-label nama_file" for="customFile">File PDF
                                                (Max : 1MB)</label>
                                        </div>
                                    </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Kirim Data</button>
                            </div>
                            </form>
                        </div>

                        {{-- Modal Bantuan Keuangan Kab/Kota --}}
                        <div class="modal-content {{ $pd->pendapatan_id == 7 ? '' : 'd-none' }}">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-white">Tambah Data Pengajuan {{
                                    $pd->jenis_pendapatan }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body ">
                                <form action="/adminDesa/tambahPengajuan" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="jenis" value="{{ $pd->jenis_pendapatan }}">
                                    <input type="hidden" name="pendapatan_id" value="{{ $pd->pendapatan_id }}">
                                    <input type="hidden" name="apbdes_pendapatan_id" value="{{ $pd->id }}">
                                    <div class="form-group mb-4">
                                        <label for="nama_data">Nama_data</label>
                                        <input type="text" class="form-control" name="nama_data"
                                            value="Pengajuan Bantuan Keuangan Kabupaten" readonly required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="Jumlah">Jumlah Dana yang diajukan</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp.</div>
                                            </div>
                                            <input type="text" class="form-control jumlah" name="jumlah" id="jumlah"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="tgl_pengajuan">Tanggal Pengajuan</label>
                                        <input type="date" class="form-control" id="tgl_pengajuan" name="tgl_pengajuan"
                                            required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="tgl_saldo">Tanggal Pemindahan Saldo ke Kas Desa</label>
                                        <input type="date" class="form-control" id="tgl_saldo" name="tgl_saldo"
                                            required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="tgl_saldo">Upload Surat Pengajuan dari Kades (Tanpa
                                            Lampiran)</label>
                                        <div class="custom-file">
                                            <input type="file" name="file_data" class="custom-file-input file_pengajuan"
                                                id="customFile" required>
                                            <label class="custom-file-label nama_file" for="customFile">File PDF
                                                (Max : 1MB)</label>
                                        </div>
                                    </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Kirim Data</button>
                            </div>
                            </form>
                        </div>

                        {{-- Modal lain-lain Pendapatan --}}
                        <div class="modal-content {{ $pd->pendapatan_id == 8 ? '' : 'd-none' }}">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-white">Tambah Data Penerimaan {{
                                    $pd->jenis_pendapatan }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body ">
                                <form action="/adminDesa/tambahPengajuan" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="jenis" value="{{ $pd->jenis_pendapatan }}">
                                    <input type="hidden" name="pendapatan_id" value="{{ $pd->pendapatan_id }}">
                                    <input type="hidden" name="apbdes_pendapatan_id" value="{{ $pd->id }}">
                                    <div class="form-group mb-4">
                                        <label for="nama_data">Nama_data</label>
                                        <input type="text" class="form-control" name="nama_data"
                                            value="Pencatatan dan Penerimaan Lain-lain Pendapatan" readonly required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="Jumlah">Jumlah dana yang diterima dan disetorkan ke kas
                                            desa</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp.</div>
                                            </div>
                                            <input type="text" class="form-control jumlah" name="jumlah" id="jumlah"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="tgl_pengajuan">Tanggal Penerimaan oleh Kaur Keuangan</label>
                                        <input type="date" class="form-control" id="tgl_pengajuan" name="tgl_pengajuan"
                                            required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="tgl_saldo">Tanggal Setor ke Kas Desa</label>
                                        <input type="date" class="form-control" id="tgl_saldo" name="tgl_saldo"
                                            required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="tgl_saldo">Upload Bukti Setor/Saldo</label>
                                        <div class="custom-file">
                                            <input type="file" name="file_data" class="custom-file-input file_pengajuan"
                                                id="customFile" required>
                                            <label class="custom-file-label nama_file" for="customFile">File PDF
                                                (Max : 1MB)</label>
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
            @endif
            @endforeach
        </table>
    </div>
</div>
<hr>



@push('script')
<script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    bsCustomFileInput.init();
    
    var totA = Number($('#totalAnggaran').val().replaceAll('.', ''));
    var akumulasi = 0
    var jumP = $('.jumlahPengajuan').length;
    
    for(let i=0; i<jumP; i++){
        var nominal = $('.jumlahPengajuan').eq(i).val().replaceAll('.', '');
            nominal = Number(nominal);
            akumulasi += nominal;
    }
    $('#totalPengajuan').val(akumulasi);
    var progress = (akumulasi/totA)*100;
    progress = progress.toFixed(2);
    $('#progressPengajuan').val(progress);
    $('#sisaAnggaran').val(totA-akumulasi);

    $('.jumlah').mask('000.000.000.000.000', {reverse: true});
    $('.angka').mask('000.000.000.000.000', {reverse: true});
    $('#sisaAnggaran').mask('000.000.000.000.000', {reverse: true});

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
        if(input.files[0]['size'] > 1024000){
            alert('ukuran file tidak boleh > 1 MB !');
            $('.file_pengajuan').val("");
            
            $('.nama_file').html("Choose file PDF (max-size: 1 MB)");
        }else{
            
        }
        
    }else {
        alert ("file harus berjenis 'pdf' ");
        $('.file_pengajuan').val("");
        $('.nama_file').html("Choose PDF (max-size: 1 MB)");
        
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