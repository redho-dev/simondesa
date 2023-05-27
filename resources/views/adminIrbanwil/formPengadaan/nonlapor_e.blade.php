<div class="row">
    <div class="col-md-10">
        <p class="alert alert-info" style="font-size: 1rem">Cek Belanja Modal (Aset Barang) Yang Tidak Terinput Dalam
            SIMONDes</p>
    </div>
</div>

<p class="text-primary">I. Langkah Pertama : Cek Belanja Modal (Aset Barang Yang Diinput Dalam Simondes), yaitu :</p>
<div class="row">
    <div class="col-md-10">
        <table class="table table-bordered ml-2">
            <tr class="bg-secondary">
                <th>No</th>
                <th>Kegiatan</th>
                <th>Nama Barang</th>
                <th>Merk/Type</th>
                <th class="text-center">Harga Satuan (Rp)</th>
                <th>Volume</th>
            </tr>
            @foreach($barangs as $br)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $br->apbdes_kegiatan->kode_kegiatan. " ". Str::limit($br->apbdes_kegiatan->kegiatan->kegiatan,
                    40) }}</td>
                <td>{{ $br->nama_barang }}</td>
                <td>{{ $br->merk_type }}</td>
                <td class="text-center">
                    <span class="angka">{{ $br->harga_satuan }}</span>
                </td>
                <td>
                    {{ $br->jumlah }}
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

<p class="text-primary">II. Langkah Kedua, Cek Dokumen APBDes TA {{ $tahun }}</p>

<a href="{{ asset('storage/'.$apbdes) }}" class="ml-3" target="_blank"><img src="/img/logo-pdf.jpg" width="50px"></a>

<p class="text-primary mt-3">III. Langkah Ketiga, Input Data Belanja Modal (Aset Barang) Yang Tidak Terlapor Jika
    Ditemukan Dalam APBDes</p>

<button type="button" class="btn btn-primary btn-sm ml-3" data-toggle="modal" data-target="#staticBackdrop">
    + Belanja Modal (Aset Barang)
</button>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="staticBackdropLabel">Belanja Modal (Aset Barang) Yang Tidak Terlapor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/adminIrbanwil/pengasetNon" method="post">
                @csrf
                <input type="hidden" name="asal_id" value=" {{ $asal_id }}">
                <input type="hidden" name="tahun" value=" {{ $tahun }}">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="kegiatan">Nama Kegiatan</label>
                        <select class="custom-select custom-select-sm" style="font-size: .8rem" id="pilihKegiatan"
                            name="kegiatan" required>
                            <option selected value="">-- Pilih Kegiatan --</option>
                            @foreach($apbdes_kegiatans as $keg)
                            @if($keg->$anggaran)
                            <option value="{{ $keg->id }}">{{
                                $keg->kode_kegiatan." ".$keg->kegiatan->kegiatan }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" id="nama_barang"
                            style="font-size: .8rem" required>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="merk_type">Merk/Type</label>
                                <input type="text" class="form-control" name="merk_type" id="merk_type"
                                    style="font-size: .8rem">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="harga">Harga Satuan (Rp)</label>
                                <input type="text" class="form-control angka" name="harga_satuan" id="harga"
                                    style="font-size: .8rem" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="jumlah">Jumlah Barang</label>
                                <input type="number" class="form-control text-center angka" name="jumlah" id="jumlah"
                                    style="font-size: .8rem" required>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">KIRIM</button>
                </div>
            </form>
        </div>

    </div>
</div>
<div class="row mb-4">
    <div class="col-md-12">
        <table class="table table-bordered ml-3 mt-2">
            <tr class="bg-secondary">
                <th class="center" style="vertical-align: middle">No</th>
                <th style="vertical-align: middle">Kegiatan</th>
                <th class="center" style="vertical-align: middle">Nama Barang</th>
                <th class="center" style="vertical-align: middle">Jumlah <br>barang</th>
                <th class="text-center" style="vertical-align: middle">Harga Satuan <br> (Rp)</th>
                <th class="text-center" style="vertical-align: middle">Estimasi Kerugian Desa <br> (Rp)</th>
                <th class="text-center" style="vertical-align: middle">Temuan</th>
                <th class="text-center" style="vertical-align: middle">Rekomendasi TL</th>
                <th class="text-center" style="vertical-align: middle">Aksi</th>
            </tr>
            @foreach($nonlapor as $non)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $non->apbdes_kegiatan->kode_kegiatan ." ".Str::limit($non->apbdes_kegiatan->kegiatan->kegiatan,
                    40) }}</td>
                <td class="text-center">{{ $non->nama_barang }}</td>
                <td class="text-center">{{ $non->jumlah }}</td>
                <td class="text-center">
                    <span class="angka">{{ $non->harga_satuan }}</span>
                </td>
                <td class="text-center">
                    <span class="angka">{{ $non->estimasi_kerugian }}</span>
                </td>
                <td>{{ $non->catatan_sementara }}</td>
                <td>{{ $non->rekomendasi_sementara }}</td>
                <td class="text-center">
                    <button idhap="{{ $non->id }}" class="btn btn-sm btn-danger hapus">hapus</button>
                </td>

            </tr>
            @endforeach
        </table>
    </div>
</div>