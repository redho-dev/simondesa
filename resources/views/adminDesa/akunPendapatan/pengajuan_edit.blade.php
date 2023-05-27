<p class="text-info">Form Input Data Pencatatan/Pengajuan/Penerimaan Pendapatan (APBDes TA {{ $tahun }})</p>
<div class="row">
    <div class="col-md-10">
        <table class="table table-bordered">
            <thead style="background-color: beige">
                <tr>
                    <th>Kode_rek</th>
                    <th>Jenis Pendapatan</th>
                    <th>Anggaran Awal (Rp)</th>
                    <th>Anggaran Perubahan (Rp)</th>
                    <th>Cek Berkas Pengajuan</th>
                    <th>Data Pengajuan</th>
                </tr>
            </thead>
            @foreach($pendapatans as $pd)
            @if($pd->pendapatan_id != '2' && $pd->anggaran_murni || $pd->pendapatan_id != '2' &&
            $pd->anggaran_perubahan)
            <tr>
                <th>{{ $pd->kode_pendapatan }}</th>
                <th>{{ $pd->jenis_pendapatan }}</th>

                <th>{{ $pd->anggaran_murni }}</th>

                <th>{{ $pd->anggaran_perubahan }}</th>
                <th>

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
                                        <label for="tgl_saldo">Upload Foto Pengajuan (Tanpa Lampiran)</label>
                                        <div class="custom-file">
                                            <input type="file" name="file_data" class="custom-file-input"
                                                id="customFile" required>
                                            <label class="custom-file-label" for="customFile">File Image
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
                                        <label for="tgl_saldo">Upload Foto Pengajuan (Tanpa Lampiran)</label>
                                        <div class="custom-file">
                                            <input type="file" name="file_data" class="custom-file-input"
                                                id="customFile" required>
                                            <label class="custom-file-label" for="customFile">File Image
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
                                        <label for="Jumlah">Pengajuan ADD untuk Bulan : <small>(tidak termasuk kurang
                                                salur)</small></label>
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
                                        <label for="tgl_saldo">Upload Foto Pengajuan (Tanpa Lampiran)</label>
                                        <div class="custom-file">
                                            <input type="file" name="file_data" class="custom-file-input"
                                                id="customFile" required>
                                            <label class="custom-file-label" for="customFile">File Image
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
                                        <label for="tgl_pengajuan">Tanggal Penerimaan PAD oleh Kaur Keuangan dari Sumber
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
                                        <label for="tgl_saldo">Upload Foto Bukti Setor ke Kas Desa</label>
                                        <div class="custom-file">
                                            <input type="file" name="file_data" class="custom-file-input"
                                                id="customFile" required>
                                            <label class="custom-file-label" for="customFile">File Image
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
                                        <label for="tgl_saldo">Upload Foto Pengajuan (Tanpa Lampiran)</label>
                                        <div class="custom-file">
                                            <input type="file" name="file_data" class="custom-file-input"
                                                id="customFile" required>
                                            <label class="custom-file-label" for="customFile">File Image
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
                                        <label for="tgl_saldo">Upload Foto Pengajuan (Tanpa Lampiran)</label>
                                        <div class="custom-file">
                                            <input type="file" name="file_data" class="custom-file-input"
                                                id="customFile" required>
                                            <label class="custom-file-label" for="customFile">File Image
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
                                        <label for="Jumlah">Jumlah dana yang diterima dan disetorkan ke kas desa</label>
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
                                            <input type="file" name="file_data" class="custom-file-input"
                                                id="customFile" required>
                                            <label class="custom-file-label" for="customFile">File Image
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
            @endif
            @endforeach
        </table>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-10">
        <div class="pad {{ count($pengajuan_pad) ? '': 'd-none' }}">
            <h4>Pendapatan Asli Desa</h4>
            <table class="table table-bordered">
                <thead>
                    <th>#</th>
                    <th>Nama_Data</th>
                    <th>Jumlah</th>
                    <th>Tgl_penerimaan</th>
                    <th>Tgl_setor_kas</th>
                    <th>foto bukti setor</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach($pengajuan_pad as $pad)
                    <tr>
                        <td></td>
                        <td>{{ $pad->nama_data }}</td>
                        <td>{{ $pad->jumlah }}</td>
                        <td>{{ $pad->tgl_pengajuan }}</td>
                        <td>{{ $pad->tgl_saldo }}</td>
                        <td>
                            <a href="{{ asset('storage/'.$pad->file_data) }}" target="_blank">
                                <img src="{{ asset('storage/'.$pad->file_data) }}" width="120px" alt="">
                            </a>
                        </td>
                        <td>
                            <a href="/adminDesa/deletePengajuan/{{ $pad->id }}" class="btn btn-sm btn-danger"
                                onclick="return confirm('yakin hapus?');">hapus</a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
        </div>


        <div class="dana_desa {{ count($pengajuan_dd) ? '': 'd-none' }}">
            <h4>Dana Desa (DD)</h4>
            <table class="table table-bordered">
                <thead>
                    <th>#</th>
                    <th>Pengajuan</th>
                    <th>Jumlah</th>
                    <th>Tgl_pengajuan</th>
                    <th>Tgl_saldo_kas_desa</th>
                    <th>foto pengajuan</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach($pengajuan_dd as $dd)
                    <tr>
                        <td></td>
                        <td>{{ $dd->nama_data }}</td>
                        <td>{{ $dd->jumlah }}</td>
                        <td>{{ $dd->tgl_pengajuan }}</td>
                        <td>{{ $dd->tgl_saldo }}</td>
                        <td>
                            <a href="{{ asset('storage/'.$dd->file_data) }}" target="_blank">
                                <img src="{{ asset('storage/'.$dd->file_data) }}" width="120px" alt="">
                            </a>
                        </td>
                        <td>
                            <a href="/adminDesa/deletePengajuan/{{ $dd->id }}" class="btn btn-sm btn-danger"
                                onclick="return confirm('yakin hapus?');">hapus</a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
        </div>

        <div class="dbh {{ count($pengajuan_dbh) ? '': 'd-none' }}">
            <h4>Dana Bagi Hasil Pajak dan Retribusi Kabupaten/Kota</h4>
            <table class="table table-bordered">
                <thead>
                    <th>#</th>
                    <th>Pengajuan</th>
                    <th>Jumlah</th>
                    <th>Tgl_pengajuan</th>
                    <th>Tgl_saldo_kas_desa</th>
                    <th>foto pengajuan</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach($pengajuan_dbh as $dbh)
                    <tr>
                        <td></td>
                        <td>{{ $dbh->nama_data }}</td>
                        <td>{{ $dbh->jumlah }}</td>
                        <td>{{ $dbh->tgl_pengajuan }}</td>
                        <td>{{ $dbh->tgl_saldo }}</td>
                        <td>
                            <a href="{{ asset('storage/'.$dbh->file_data) }}" target="_blank">
                                <img src="{{ asset('storage/'.$dbh->file_data) }}" width="120px" alt="">
                            </a>
                        </td>
                        <td>
                            <a href="/adminDesa/deletePengajuan/{{ $dbh->id }}" class="btn btn-sm btn-danger"
                                onclick="return confirm('yakin hapus?');">hapus</a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
        </div>

        <div class="add {{ count($pengajuan_add) ? '': 'd-none' }}">
            <h4>Alokasi Dana Desa (ADD)</h4>
            <table class="table table-bordered">
                <thead>
                    <th>#</th>
                    <th>Pengajuan</th>
                    <th>Jumlah</th>
                    <th>Tgl_pengajuan</th>
                    <th>Tgl_saldo_kas_desa</th>
                    <th>foto pengajuan</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach($pengajuan_add as $add)
                    <tr>
                        <td></td>
                        <td>{{ $add->nama_data }}</td>
                        <td>{{ $add->jumlah }}</td>
                        <td>{{ $add->tgl_pengajuan }}</td>
                        <td>{{ $add->tgl_saldo }}</td>
                        <td>
                            <a href="{{ asset('storage/'.$add->file_data) }}" target="_blank">
                                <img src="{{ asset('storage/'.$add->file_data) }}" width="120px" alt="">
                            </a>
                        </td>
                        <td>
                            <a href="/adminDesa/deletePengajuan/{{ $add->id }}" class="btn btn-sm btn-danger"
                                onclick="return confirm('yakin hapus?');">hapus</a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
        </div>

        <div class="bkp {{ count($pengajuan_bkp) ? '': 'd-none' }}">
            <h4>Bantuan Keuangan dari APBD Provinsi</h4>
            <table class="table table-bordered">
                <thead>
                    <th>#</th>
                    <th>Pengajuan</th>
                    <th>Jumlah</th>
                    <th>Tgl_pengajuan</th>
                    <th>Tgl_saldo_kas_desa</th>
                    <th>foto pengajuan</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach($pengajuan_bkp as $bkp)
                    <tr>
                        <td></td>
                        <td>{{ $bkp->nama_data }}</td>
                        <td>{{ $bkp->jumlah }}</td>
                        <td>{{ $bkp->tgl_pengajuan }}</td>
                        <td>{{ $bkp->tgl_saldo }}</td>
                        <td>
                            <a href="{{ asset('storage/'.$bkp->file_data) }}" target="_blank">
                                <img src="{{ asset('storage/'.$bkp->file_data) }}" width="120px" alt="">
                            </a>
                        </td>
                        <td>
                            <a href="/adminDesa/deletePengajuan/{{ $bkp->id }}" class="btn btn-sm btn-danger"
                                onclick="return confirm('yakin hapus?');">hapus</a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
        </div>

        <div class="bkk {{ count($pengajuan_bkk) ? '': 'd-none' }}">
            <h4>Bantuan Keuangan dari APBD Kabupaten/Kota</h4>
            <table class="table table-bordered">
                <thead>
                    <th>#</th>
                    <th>Pengajuan</th>
                    <th>Jumlah</th>
                    <th>Tgl_pengajuan</th>
                    <th>Tgl_saldo_kas_desa</th>
                    <th>foto pengajuan</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach($pengajuan_bkk as $bkk)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $bkk->nama_data }}</td>
                        <td>{{ $bkk->jumlah }}</td>
                        <td>{{ $bkk->tgl_pengajuan }}</td>
                        <td>{{ $bkk->tgl_saldo }}</td>
                        <td>
                            <a href="{{ asset('storage/'.$bkk->file_data) }}" target="_blank">
                                <img src="{{ asset('storage/'.$bkk->file_data) }}" width="120px" alt="">
                            </a>
                        </td>
                        <td>
                            <a href="/adminDesa/deletePengajuan/{{ $bkk->id }}" class="btn btn-sm btn-danger"
                                onclick="return confirm('yakin hapus?');">hapus</a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
        </div>

        <div class="lain {{ count($pengajuan_lain) ? '': 'd-none' }}">
            <h4>Pendapatan Lain-lain</h4>
            <table class="table table-bordered">
                <thead>
                    <th>#</th>
                    <th>Pengajuan</th>
                    <th>Jumlah</th>
                    <th>Tgl_pengajuan</th>
                    <th>Tgl_saldo_kas_desa</th>
                    <th>foto pengajuan</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach($pengajuan_lain as $lain)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $lain->nama_data }}</td>
                        <td>{{ $lain->jumlah }}</td>
                        <td>{{ $lain->tgl_pengajuan }}</td>
                        <td>{{ $lain->tgl_saldo }}</td>
                        <td>
                            <a href="{{ asset('storage/'.$lain->file_data) }}" target="_blank">
                                <img src="{{ asset('storage/'.$lain->file_data) }}" width="120px" alt="">
                            </a>
                        </td>
                        <td>
                            <a href="/adminDesa/deletePengajuan/{{ $lain->id }}" class="btn btn-sm btn-danger"
                                onclick="return confirm('yakin hapus?');">hapus</a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
        </div>

    </div>
</div>
<hr>


@push('script')
<script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    bsCustomFileInput.init();
    $('.jumlah').mask('000.000.000.000.000', {reverse: true});
 
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