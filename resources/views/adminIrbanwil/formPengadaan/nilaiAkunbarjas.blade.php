<div class="row ">
    <div class="col-md-8 mt-2">
        <p class="alert bg-warning text-dark" style="font-size: 1rem">Penilaian Indikator : Pengadaan Barang dan Jasa
            TA
            {{ $tahun }}
        </p>
        <form action="/adminIrbanwil/nilaiAkunBarjas" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="aspek_id" value=2>
            <input type="hidden" name="indikator_id" value=11>

            <table class="table table-bordered">
                <thead>
                    <tr class="bg-info">
                        <th width="5%" style="vertical-align: middle">No</th>
                        <th width="55%" style="vertical-align: middle">Sub Indikator</th>
                        <th width="10%" class="text-center" style="vertical-align: middle">Bobot <br>(%)</th>
                        <th width="15%" class="text-center">Keterisian<br>Data (%)</th>
                        <th width="15%" class="text-center" style="vertical-align: middle">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Subs as $sub)
                    <tr class="{{ $sub->nilai_keuangan->where('asal_id', $asal_id)->where('tahun',
                        $tahun)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{ $sub->sub_indikator }}
                        </td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">{{ $sub->bobot }}</td>
                        <td class="text-center" style="vertical-align: middle">
                            {{ $sub->nilai_keuangan->where('asal_id', $asal_id)->where('tahun',
                            $tahun)->pluck('persen_data')->first() ?? 0 }}
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="perbaikan[]" value="{{  $sub->nilai_keuangan->where('asal_id', $asal_id)->where('tahun',
                            $tahun)->pluck('perbaikan')->first()  }}">
                            <input type="number" class="form-control text-center" value="{{ $sub->nilai_keuangan->where('asal_id', $asal_id)->where('tahun',
                            $tahun)->pluck('nilai_sementara')->first() ?? 0 }}" style="font-size: .8rem" readonly>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
                <tr>
                    @if($jumlahTemuan > 0)
                    <td colspan="5">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#temuan">
                            Daftar Temuan
                        </button>
                    </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="5" style="background-color: beige">
                        KESIMPULAN : (TERISI OTOMATIS SESUAI SKORING YANG DIBERIKAN)
                    </td>
                </tr>
                <tr>
                    <td colspan="5" style="background-color: beige">
                        <div class="form-group">
                            <label for="uraian">Catatan / Saran / Uraian Kesimpulan / Apresiasi :</label>
                            <input type="hidden" name="uraian" id="uraian" autofocus>
                            <trix-editor input="uraian" class="bg-white">
                            </trix-editor>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="5" class="text-right">

                        <button type="submit" class="btn btn-primary">KIRIM</button>

                    </td>
                </tr>


            </table>
        </form>
        <!-- Modal -->
        <div class="modal fade" id="temuan" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-white" id="staticBackdropLabel">DAFTAR TEMUAN PENGADAAN BARANG DAN
                            JASA
                            TA
                            {{
                            $tahun }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-primary">A. TEMUAN PEMBANGUNAN FISIK</p>
                        <table class="table table-bordered">
                            <tr class="bg-secondary">
                                <th>No</th>
                                <th>Kegiatan</th>
                                <th>Anggaran (Rp)</th>
                                <th>Realisasi (Rp)</th>
                                <th>Temuan</th>
                                <th>Rekomendasi TL</th>
                            </tr>
                            @foreach($temuanFisik as $temfis)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="" title="{{ $temfis->apbdes_kegiatan->kegiatan->kegiatan }}">
                                        {{ $temfis->apbdes_kegiatan->kode_kegiatan }}
                                    </a>
                                </td>
                                <td>
                                    <span class="angka">{{ $temfis->anggaran }}</span>
                                </td>
                                <td>
                                    <span class="angka">{{ $temfis->realisasi_anggaran }}</span>
                                </td>
                                <td>{!! $temfis->catatan_sementara !!}</td>
                                <td>{!! $temfis->rekomendasi_sementara !!}</td>
                            </tr>
                            @endforeach
                        </table>
                        <p class="text-primary">B. TEMUAN BELANJA MODAL ASET BARANG</p>
                        <table class="table table-bordered">
                            <tr class="bg-secondary">
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Volume</th>
                                <th>Harga Satuan (Rp)</th>
                                <th>Temuan</th>
                                <th>Rekomendasi TL</th>
                            </tr>
                            @foreach($temuanAset as $temuan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $temuan->nama_barang }}
                                </td>
                                <td>
                                    {{ $temuan->jumlah }}
                                </td>
                                <td>
                                    <span class="angka">{{ $temuan->harga_satuan }}</span>
                                </td>
                                <td>{!! $temuan->catatan_sementara !!}</td>
                                <td>{!! $temuan->rekomendasi_sementara !!}</td>
                            </tr>
                            @endforeach
                        </table>

                        <p class="text-primary">C. BELANJA MODAL ASET BARANG YANG TIDAK DILAPORKAN</p>
                        <table class="table table-bordered">
                            <tr class="bg-secondary">
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Volume</th>
                                <th>Harga Satuan (Rp)</th>
                                <th>Temuan</th>
                                <th>Rekomendasi TL</th>
                            </tr>
                            @foreach($temuanNonlapor as $temnon)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $temnon->nama_barang }}
                                </td>
                                <td>
                                    {{ $temnon->jumlah }}
                                </td>
                                <td>
                                    <span class="angka">{{ $temnon->harga_satuan }}</span>
                                </td>
                                <td>{!! $temnon->catatan_sementara !!}</td>
                                <td>{!! $temnon->rekomendasi_sementara !!}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>