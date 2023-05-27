<p class="alert alert-info" style="font-size: 1rem">Silahkan Input Data Realisasi Belanja Modal Yang Berupa Aset Barang
    Berdasarkan APB Desa TA {{ $tahun }}
</p>

<p class="mb-0 pb-0 text-primary">Catatan :</p>
<ol>
    <li class="text-primary">
        Yang Dimaksud Belanja Modal Aset Barang Adalah Belanja Modal Dengan Kriteria/Kode Belanja Sebagai Berikut : <br>
        <button type="button" class="btn btn-info btn-sm mt-2 mb-2" data-toggle="modal" data-target="#kriteria">
            Kriteria Belanja Modal Aset Barang
        </button>

        <!-- Modal -->
        <div class="modal fade" id="kriteria" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-white" id="staticBackdropLabel">Kriteria Belanja Modal Aset Barang
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <img src="/img/belanja-asetBarang.JPG" class="img-fluid">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">KIRIM</button>
                    </div>

                </div>
            </div>
        </div>

    </li>
    <li class="text-primary">
        Dalam Hal ini Belanja Modal Upah dan Belanja Modal Material Pembanguan Tidak
        Termasuk Sebagai
        Belanja Modal Aset
        Barang
    </li>
    <li class="text-primary">
        Seluruh Belanja Modal Aset Barang dalam APB Desa TA {{ $tahun }} Wajib di Input
        dalam SIMONDES
    </li>
    <li class="text-danger">
        Belanja Modal Aset Barang Yang Tidak di Input Dalam SIMONDES akan menjadi Temuan
        Inspektorat
    </li>
</ol>
<hr>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm mt-2 mb-2" data-toggle="modal" data-target="#modalAset">
    + Belanja Aset Barang
</button>

<!-- Modal -->
<div class="modal fade" id="modalAset" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="staticBackdropLabel">Form Tambah Belanja Aset Barang
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/adminDesa/tambahBelanjaAset" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                <input type="hidden" name="tahun" value="{{ $tahun }}">

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
                            style="font-size: .8rem" autofocus required>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="merk_type">Merk/Type</label>
                                <input type="text" class="form-control" name="merk_type" id="merk_type"
                                    style="font-size: .8rem" autofocus required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="harga">Harga Satuan (Rp)</label>
                                <input type="text" class="form-control angka" name="harga" id="harga"
                                    style="font-size: .8rem" autofocus required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="jumlah">Jumlah Barang</label>
                                <input type="number" class="form-control text-center" name="jumlah" id="jumlah"
                                    style="font-size: .8rem" value=1 required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="foto">Foto Barang</label>
                        <div class="custom-file">
                            <input type="file" name="foto_barang" class="custom-file-input foto_barang" id="customFile"
                                required>
                            <label class="custom-file-label label_foto_barang" for="customFile"
                                style="font-size: .7rem">Choose
                                file
                                Image Max (1
                                MB)</label>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group mt-2">
                        <label for="bukti">Bukti Belanja (Pesananan/Penawaran/Nota/kwitansi/dll)</label>
                        <div class="custom-file">
                            <input type="file" name="bukti" class="custom-file-input bukti" id="customFile" required>
                            <label class="custom-file-label label_bukti" for="customFile"
                                style="font-size: .7rem">Choose
                                file
                                PDF Max (1
                                MB)</label>
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

<div class="row">
    <div class="col-md-9">
        <table class="table table-bordered">
            <thead class="bg-secondary">
                <th class="text-center" style="vertical-align: middle">No</th>
                <th class="text-center" style="vertical-align: middle">Kode </br>Kegiatan</th>
                <th class="text-center" style="vertical-align: middle">Nama Barang</th>
                <th class="text-center" style="vertical-align: middle">Merk/Type</th>
                <th class="text-center" style="vertical-align: middle">Harga Satuan </br> (Rp)</th>
                <th class="text-center" style="vertical-align: middle">Jumlah Barang</th>
                <th class="text-center" style="vertical-align: middle">Foto Barang</th>
                <th class="text-center" style="vertical-align: middle">Bukti Belanja</th>
                <th class="text-center" style="vertical-align: middle">Aksi</th>
            </thead>
            <tbody>
                @foreach($barangs as $br)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $br->apbdes_kegiatan->kode_kegiatan }}</td>
                    <td>{{ $br->nama_barang }}</td>
                    <td class="text-center">{{ $br->merk_type }}</td>
                    <td class="text-center"><span class="angka">{{ $br->harga_satuan }}</span></td>
                    <td class="text-center">{{ $br->jumlah }}</td>
                    <td class="text-center">
                        <a href="{{ asset('storage/'.$br->foto_barang) }}" target="_blank"><img
                                src="{{ asset('storage/'.$br->foto_barang) }}" width="150px"></a>
                    </td>
                    <td class="text-center">
                        <a href="{{ asset('storage/'.$br->bukti_belanja) }}" target="_blank"><img
                                src="/img/logo-pdf.jpg" width="75px"></a>
                    </td>
                    <td class="text-center">
                        <button idhap="{{ $br->id }}" class="btn btn-sm btn-danger hapus"><i
                                class="fa fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>