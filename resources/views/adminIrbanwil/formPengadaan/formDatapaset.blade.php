<p class="alert alert-info" style="font-size: 1rem">Silahkan Cek dan Nilai Realisasi Belanja Modal Yang Berupa Aset
    Barang
    Berdasarkan APB Desa TA {{ $tahun }}
</p>
<div class="row">
    <div class="col-md-9">
        <p class="mb-0 pb-0 text-primary">Catatan :</p>
        <ol>
            <li class="text-primary">
                Yang Dimaksud Belanja Modal Aset Barang Adalah Belanja Modal Dengan Kriteria/Kode Belanja Sebagai
                Berikut : <br>
                <button type="button" class="btn btn-info btn-sm mt-2 mb-2" data-toggle="modal" data-target="#kriteria">
                    Kriteria Belanja Modal Aset Barang
                </button>

                <!-- Modal -->
                <div class="modal fade" id="kriteria" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-white" id="staticBackdropLabel">Kriteria Belanja Modal Aset
                                    Barang
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

    </div>
    <div class="col-md-3 text-center">
        <p>Cek Dokumen APBDes TA {{ $tahun }}</p>
        <a href="{{ asset('storage/'.$apbdes) }}" target="_blank"><img src="/img/logo-pdf.jpg" width="60px"></a>
        <p class="mt-0 pt-0 text-center">{{ $status }}</p>
    </div>
</div>

<hr>

<?php $i=1; ?>
@foreach($barangs as $br)
<div class="row">
    <div class="col-md-12">

        <table class="table table-bordered" id="tabel_{{ $i }}">
            <thead class="bg-secondary">
                <th style="vertical-align: middle">No</th>
                <th style="vertical-align: middle">Kegiatan</th>
                <th style="vertical-align: middle">Nama Barang</th>
                <th class="text-center" style="vertical-align: middle">Merk/Type</th>
                <th class="text-center" style="vertical-align: middle">Harga Satuan <br>(Rp)</th>
                <th class="text-center" style="vertical-align: middle">Jumlah <br>Barang</th>
                <th class="text-center" style="vertical-align: middle">Foto Barang</th>
                <th class="text-center" style="vertical-align: middle">Bukti Belanja</th>
                <th class="text-center" style="vertical-align: middle">Nilai</th>
            </thead>
            <tbody>

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $br->apbdes_kegiatan->kode_kegiatan.".
                        ".Str::limit($br->apbdes_kegiatan->kegiatan->kegiatan,40) }}</td>
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
                                src="/img/logo-pdf.jpg" width="50px"></a>
                    </td>
                    <td class="text-center">
                        @if($br->nilai_sementara)
                        <p class="bg-dark p-2 text-white" style="font-size: 1.2rem">{{ $br->nilai_sementara }}</p>
                        @else
                        <p class="bg-danger p-2 text-white">Belum dinilai</p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="7" class="text-center pl-4">

                        @if($br->tgl_cek_fisik)
                        <button id="{{ $i }}" class="btn btn-sm btn-success" data-toggle="modal"
                            data-target="#dataset_{{ $i }}">Update Nilai & Temuan
                        </button>
                        @else
                        <button id="{{ $i }}" class="btn btn-sm btn-primary" data-toggle="modal"
                            data-target="#dataset_{{ $i }}">+ Nilai dan Temuan </button>
                        @endif

                    </td>

                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="dataset_{{ $i }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="staticBackdropLabel">Form Penilaian dan Temuan Atas Belanja Modal
                    Aset
                    Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/adminIrbanwil/nilaiPengAset" method="post" class="formaset">

                    @csrf
                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                    <input type="hidden" name="id" value="{{ $br->id }}">
                    <input type="hidden" name="tabel" value="tabel_{{ $i }}">

                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="status">Tgl Cek Fisik</label>

                                @if($br && $br->tgl_cek_fisik)
                                <input type="date" name="tgl_cek_fisik" class="form-control" style="font-size: .8rem"
                                    value="{{ $br->tgl_cek_fisik }}" required>
                                @else
                                <input type="date" name="tgl_cek_fisik" class="form-control" style="font-size: .8rem"
                                    required>
                                @endif



                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="status">Kategori Temuan</label>
                                <select class="form-control" name="status_temuan" style="font-size: .8rem" required>

                                    @if($br && $br->status_temuan)
                                    <option value="">-- pilih --</option>
                                    <option value=1 {{ $br->status_temuan == 1 ? 'selected' : ''
                                        }}>Indikasi_Fiktif</option>
                                    <option value=2 {{ $br->status_temuan == 2 ? 'selected' : ''
                                        }}>Indikasi Mark Up</option>
                                    <option value=3 {{ $br->status_temuan == 3 ? 'selected' : ''
                                        }}>Barang Tidak Sesuai Spek</option>
                                    <option value=4 {{ $br->status_temuan == 4 ? 'selected' : ''
                                        }}>Kekurangan Administratif</option>
                                    <option value=5 {{ $br->status_temuan == 5 ? 'selected' : ''
                                        }}>Lainnya</option>
                                    <option value=6 {{ $br->status_temuan == 6 ? 'selected' : ''
                                        }}>Nihil</option>
                                    @else
                                    <option value="">-- pilih --</option>
                                    <option value=1>Indikasi_Fiktif</option>
                                    <option value=2>Indikasi Mark Up</option>
                                    <option value=3>Barang Tidak Sesuai Spek</option>
                                    <option value=4>Kekurangan Administratif</option>
                                    <option value=5>Lainnya</option>
                                    <option value=6>Nihil</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="status">Estimasi Kerugian (Rp)</label>

                                @if($br && $br->estimasi_kerugian)
                                <input type="text" name="estimasi_kerugian" class="form-control angka"
                                    style="font-size: .8rem" value="{{ $br->estimasi_kerugian }}">
                                @else
                                <input type="text" name="estimasi_kerugian" class="form-control angka"
                                    style="font-size: .8rem">
                                @endif
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="status">Nilai (0 - 100)</label>

                                @if($br && $br->nilai_sementara)
                                <input type="number" name="nilai_sementara" idkeg="{{ $br->id }}"
                                    class="form-control nilaiKeg" style="font-size: .8rem" required
                                    value="{{ $br->nilai_sementara }}">
                                @else
                                <input type="number" name="nilai_sementara" idkeg="{{ $br->id }}"
                                    class="form-control nilaiKeg" style="font-size: .8rem" required>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-row bg-info">
                        <div class="col">
                            @if($br->catatan_sementara)
                            <div class="form-group">
                                <label for="rekomendasi" class="text-dark p-2">Temuan :</label>
                                <input type="hidden" name="catatan_sementara" id="catatan_awal_{{ $br->id }}" autofocus>
                                <trix-editor input="catatan_awal_{{ $br->id }}" class="bg-light">
                                    {!! $br->catatan_sementara ?? '' !!}
                                </trix-editor>
                            </div>
                            @else
                            <div class="form-group">
                                <label for="rekomendasi" class="text-dark p-2">Temuan :</label>
                                <input type="hidden" name="catatan_sementara" id="catatan_{{ $br->id }}" autofocus>
                                <trix-editor input="catatan_{{ $br->id }}" class="bg-light">
                                </trix-editor>
                            </div>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="form-row bg-secondary">
                        <div class="col">

                            @if($br->rekomendasi_sementara)
                            <div class="form-group">
                                <label for="rekomendasi" class="text-dark p-2">Rekomendasi Tindak Lanjut :</label>
                                <input type="hidden" name="rekomendasi_sementara" id="rekomendasi_awal_{{ $br->id }}"
                                    autofocus>
                                <trix-editor input="rekomendasi_awal_{{ $br->id }}" class="bg-light">
                                    {!! $br->rekomendasi_sementara ?? '' !!}
                                </trix-editor>
                            </div>
                            @else
                            <div class="form-group">
                                <label for="rekomendasi" class="text-dark p-2">Rekomendasi Tindak Lanjut :</label>
                                <input type="hidden" name="rekomendasi_sementara" id="rekomendasi_{{ $br->id }}"
                                    autofocus>
                                <trix-editor input="rekomendasi_{{ $br->id }}" class="bg-light">
                                </trix-editor>
                            </div>
                            @endif
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @if($br && $br->tgl_cek_fisik)
                <button type="submit" class="btn btn-info ">UPDATE &ensp;<span class="fa fa-send"></span></button>
                @else
                <button type="submit" class="btn btn-primary ">KIRIM &ensp;<span class="fa fa-send"></span></button>
                @endif

            </div>
        </div>
        </form>
    </div>
</div>

<hr>
<br>
<?php $i++; ?>
@endforeach