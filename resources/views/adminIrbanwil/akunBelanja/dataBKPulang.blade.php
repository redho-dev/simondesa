<hr>
<h4 class="text-info">Daftar TBPU dan Bukti Belanja Perbaikan yang Belum Dinilai Ulang</h4>
<div class="row">

    <div class="col-md-11">
        <table class="table table-bordered">
            <tr style="background-color: azure">
                <th style="vertical-align: middle">#</th>
                <th style="vertical-align: middle">Nomor TBPU</th>
                <th style="vertical-align: middle">Jumlah Uang (Rp)</th>
                <th class="text-center" style="vertical-align: middle">File_TBPU
                    <br>(+Lampiran)
                </th>
                <th class="text-center" style="vertical-align: middle">Nilai Kelengkapan
                </th>
                <th class="text-center" style="vertical-align: middle">Status
                </th>
                <th class="text-center" style="vertical-align: middle">Temuan & <br>Rekomendasi
                </th>
                <th class="text-center" style="vertical-align: middle">Koreksi <br>Pajak
                </th>
                <th class="text-center" style="vertical-align: middle">Aksi</th>

            </tr>
            @foreach($bkpulangs as $bkp)
            <tr id="bkp_{{ $bkp->id }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $bkp->nomor }} </td>
                <td class="angka">{{ $bkp->jumlah }}</td>
                <td class="text-center">
                    <a href="{{ asset('storage/'.$bkp->file_bkp) }}" target="_blank"><img src="/img/logo-pdf.jpg"
                            width="35px"></a>
                </td>

                <td class="text-center">
                    @if($bkp->nilai_bkp)
                    {{ $bkp->nilai_bkp }}
                    @else
                    <p class="text-danger">belum dinilai</p>
                    @endif
                </td>
                <td class="text-center">
                    @if($bkp->status_bkp)
                    {{ $bkp->status_bkp }}
                    @else
                    <p class="text-danger">belum dinilai</p>
                    @endif
                </td>
                <td class="text-center">
                    @if($bkp->catatan_bkp)
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                        data-target="#catatanbkp{{ $bkp->id }}" style="font-size: .75rem">
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
                            data-target="#nilaibkp{{ $bkp->id }}" style="font-size: .75rem">
                            {{ $bkp->nilai_bkp ? 'Edit Nilai & Temuan' : '+ Nilai & Temuan' }}
                        </button>
                    </div>
                </td>
                <!-- Modal -->
                <div class="modal fade" id="nilaibkp{{ $bkp->id }}" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-dark" id="staticBackdropLabel">Penilaian TBPU dan Bukti
                                    Belanja</h5>
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
                                                    <input type="text" name="jumlah" class="form-control jumlah angka"
                                                        id="inlineFormInputGroup" style="font-size: .85rem"
                                                        value="{{ $bkp->jumlah }}" readonly>
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
                                                    <input type="text" name="lainnya" class="form-control lainnya angka"
                                                        id="lainnya" style="font-size: .85rem" placeholder="0"
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
                                    <div class="form-row">
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
                                                        style="font-size: .85rem" value="{{ $bkp->nilai_bkp ?? '' }}"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="status">Koreksi Pajak</label>
                                                <select class="form-control koreksi" name="koreksi_pajak"
                                                    style="font-size: .85rem" required>
                                                    <option value="">- Pilih -</option>
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
                                                        id="koreksi_lainnya" style="font-size: .85rem" placeholder="0"
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
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">{{ $bkp->nilai_bkp ?
                                        "UPDATE" : "KIRIM" }}</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <!-- Modal Catatan BKP-->
                <div class="modal fade" id="catatanbkp{{ $bkp->id }}" data-backdrop="static" data-keyboard="false"
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
                                    <label for="catatan">Temuan : </label>
                                    <textarea class="form-control" id="catatan" rows="3" name="catatan"
                                        style="font-size: .8rem" readonly>{{ $bkp->catatan_bkp ?? ''  }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="catatan">Rekomendasi Tindak Lanjut :</label>
                                    <textarea class="form-control" id="catatan" rows="3" name="rekomendasi"
                                        style="font-size: .8rem" readonly>{{ $bkp->rekomendasi_bkp ?? '' }}</textarea>
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