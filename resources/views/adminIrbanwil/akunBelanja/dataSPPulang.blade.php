<hr>
<h4 class="text-info">Daftar Dokumen SPP Perbaikan yang belum dinilai ulang</h4>
<div class="row">
    <div class="col-md-11">
        <table class="table table-bordered">
            <tr style="background-color: azure">
                <th style="vertical-align: middle">#</th>
                <th style="vertical-align: middle">Nomor SPP</th>
                <th style="vertical-align: middle">Jumlah Uang (Rp)</th>
                <th class="text-center" style="vertical-align: middle">File_SPP
                    <br>(+Lampiran)
                </th>
                <th class="text-center" style="vertical-align: middle">Nilai Kelengkapan
                </th>
                <th class="text-center" style="vertical-align: middle">Status
                </th>
                <th class="text-center" style="vertical-align: middle">Temuan & <br>Rekomendasi
                </th>
                <th class="text-center" style="vertical-align: middle">Aksi</th>

            </tr>
            @foreach($sppulangs as $spp)
            <tr class="{{ $spp->perbaikan ? 'text-danger' : '' }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $spp->nomor }} </td>
                <td class="angka">{{ $spp->jumlah }}</td>
                <td class="text-center">
                    <a href="{{ asset('storage/'.$spp->file_spp) }}" target="_blank"><img src="/img/logo-pdf.jpg"
                            width="35px"></a>
                </td>

                <td class="text-center">
                    @if($spp->nilai >= 0)
                    {{ $spp->nilai }}
                    @else
                    <p class="text-danger">belum dinilai</p>
                    @endif
                </td>
                <td class="text-center">
                    @if($spp->status)
                    {{ $spp->status }}
                    @else
                    <p class="text-danger">belum dinilai</p>
                    @endif
                </td>
                <td class="text-center">
                    @if($spp->catatan)
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                        data-target="#catatanSPP{{ $spp->id }}" style="font-size: .75rem">
                        Lihat
                    </button>
                    @endif
                </td>

                <td class="text-center">
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#nilaiSPP{{ $spp->id }}" style="font-size: .75rem">
                            {{ $spp->nilai ? 'Edit Nilai & Temuan' : '+ Nilai & Temuan' }}
                        </button>
                    </div>
                </td>
                <!-- Modal -->
                <div class="modal fade" id="nilaiSPP{{ $spp->id }}" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-dark" id="staticBackdropLabel">Penilaian Kelengkapan SPP
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="/adminIrbanwil/nilaiSPP" method="POST">
                                @csrf
                                <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                <input type="hidden" name="tahun" value="{{ $tahun }}">
                                <input type="hidden" name="id" value="{{ $spp->id }}">
                                <input type="hidden" name="apbdes_kegiatan_id" value="{{ $spp->apbdes_kegiatan_id }}">


                                <div class="modal-body">
                                    <div class="form-group mb-3">
                                        <label for="kegiatan">Nama Kegiatan</label>
                                        <input type="text" class="form-control" id="kegiatan" style="font-size: .75rem"
                                            value="{{ $spp->kegiatan->kegiatan }}" readonly>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group  mb-3">
                                                <label>Nomor SPP</label>
                                                <input type="text" name="nomor" class="form-control"
                                                    style="font-size: .85rem" value="{{ $spp->nomor }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group  mb-3">
                                                <label>Jumlah Uang Diminta</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-size: .85rem">Rp.
                                                        </div>
                                                    </div>
                                                    <input type="text" name="jumlah" class="form-control angka"
                                                        id="inlineFormInputGroup" style="font-size: .85rem"
                                                        value="{{ $spp->jumlah }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="status">Status Dokumen</label>
                                                <select class="form-control" id="status" name="status"
                                                    style="font-size: .85rem" required>
                                                    <option value="">- Pilih -</option>
                                                    <option value="Lengkap" {{ $spp->status=='Lengkap' ? 'selected'
                                                        : '' }}>Lengkap</option>
                                                    <option value="Tidak Lengkap" {{ $spp->status=='Tidak Lengkap' ?
                                                        'selected'
                                                        : '' }}>Tidak Lengkap</option>
                                                    <option value="Tidak Sesuai" {{ $spp->status=='Tidak Sesuai' ?
                                                        'selected'
                                                        : '' }}>Tidak Sesuai</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group  mb-3">
                                                <label>Nilai Kelengkapan SPP (0 - 100)</label>
                                                <div class="input-group mb-2">
                                                    <input type="number" name="nilai" class="form-control"
                                                        style="font-size: .85rem" value="{{ $spp->nilai ?? '' }}"
                                                        autofocus required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="catatan">Temuan :</label>
                                        <textarea class="form-control" id="catatan" rows="3" name="catatan"
                                            style="font-size: .75rem">{{ $spp->catatan ?? ''  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="catatan">Rekomendasi Tindak Lanjut :</label>
                                        <textarea class="form-control" id="catatan" rows="3" name="rekomendasi"
                                            style="font-size: .75rem">{{ $spp->rekomendasi ?? '' }}</textarea>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">KIRIM
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="catatanSPP{{ $spp->id }}" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-light" id="staticBackdropLabel">Catatan dan Rekomendasi
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="kegiatan">Nama Kegiatan</label>
                                    <input type="text" class="form-control" id="kegiatan" style="font-size: .75rem"
                                        value="{{ $spp->kegiatan->kegiatan }}" readonly>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group  mb-3">
                                            <label>Nomor SPP</label>
                                            <input type="text" name="nomor" class="form-control"
                                                style="font-size: .75rem" value="{{ $spp->nomor }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="catatan">Catatan/Temuan</label>
                                    <textarea class="form-control" id="catatan" rows="3" name="catatan"
                                        style="font-size: .75rem" readonly>{{ $spp->catatan ?? ''  }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="catatan">Rekomendasi</label>
                                    <textarea class="form-control" id="catatan" rows="3" name="rekomendasi"
                                        readonly>{{ $spp->rekomendasi ?? '' }}</textarea>
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
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Keterangan :
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col border-right">
                                <p class="card-text">Silahkan Cek SPP dan Lampiran, yaitu :</p>
                                <p style="font-size: .8rem">1. Jika SPP Definitif : <br>
                                    &emsp; - Surat Pengantar;<br>
                                    &emsp; - Verifikasi dan Persetujuan; <br>
                                    &emsp; - Bukti Pencairan SPP; <br>
                                    &emsp; - Pernyataan Tanggungjawab Belanja; <br>
                                </p>
                                <p style="font-size: .8rem">2. Jika SPP Panjar : <br>
                                    &emsp; - Surat Pengantar;<br>
                                    &emsp; - Rincian Permintaan Panjar; <br>
                                    &emsp; - Bukti Pencairan SPP; <br>
                                    &emsp; - Pernyataan Tanggungjawab Belanja; <br>
                                    &emsp; - Laporan Pertanggungjawaban Panjar; <br>
                                    &emsp; - Surat Pengesahan Panjar Kegiatan; <br>
                                </p>
                            </div>
                            <div class="col pl-4">
                                <p>Cara Penilaian :</p>
                                <p class="mb-0">- Nilai 0 Jika Dokumen tidak sesuai / bukan SPP Kegiatan</p>
                                <p>- Nilai 100 Jika Dokumen sesuai, lengkap dan sah</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>
</div>