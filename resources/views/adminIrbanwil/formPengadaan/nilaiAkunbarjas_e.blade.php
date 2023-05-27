<div class="row ">
    <div class="col-md-9 mt-2">
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
                        <th width="45%" style="vertical-align: middle">Sub Indikator</th>
                        <th width="10%" class="text-center" style="vertical-align: middle">Bobot <br>(%)</th>
                        <th width="15%" class="text-center">Keterisian<br>Data (%)</th>
                        <th width="15%" class="text-center" style="vertical-align: middle">Nilai</th>
                        <th width="10%" class="text-center" style="vertical-align: middle">Skor</th>
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
                        <td class="text-center bg-secondary" style="vertical-align: middle">
                            {{ $sub->nilai_keuangan->where('asal_id', $asal_id)->where('tahun',
                            $tahun)->pluck('skor')->first() ?? 0}}
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
                    <td colspan="6" style="background-color: beige">
                        <?php 
                        $nil = $rekap->nilai;
                        if($nil >= 0 && $nil <=30){
                            $kesimpulan = "TIDAK MEMADAI";
                        }elseif($nil > 30 && $nil <=55){
                            $kesimpulan = "KURANG MEMADAI";
                        }elseif($nil > 55 && $nil <=75){
                            $kesimpulan = "CUKUP MEMADAI";
                        }elseif($nil > 75 && $nil <=90){
                            $kesimpulan = "MEMADAI";
                        }elseif($nil > 90 && $nil <=100){
                            $kesimpulan = "SANGAT MEMADAI";
                        }      
                        ?>
                        <p class="mb-1">KESIMPULAN : </p>
                        <p class="mb-1">SECARA UMUM PELAKSANAAN PENGADAAN BARANG DAN JASA TAHUN ANGGARAN {{ $tahun
                            }} <span class="text-primary">-- {{ $kesimpulan }} --</span> </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="background-color: beige">
                        <div class="form-group">
                            <label for="uraian">Catatan / Saran / Uraian Kesimpulan / Apresiasi :</label>
                            <input type="hidden" name="uraian" id="uraian" autofocus>
                            <trix-editor input="uraian" class="bg-white">
                                {!! $catatan->uraian !!}
                            </trix-editor>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="6" class="text-right">

                        <button type="submit" class="btn btn-primary">UPDATE</button>


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

    @if($rekap)
    <div class="col-md-3 mt-2">
        <p class="alert alert-info" style="font-size: 1rem">Capaian Indikator : </br>Pengadaan Barang dan Jasa</p>
        <div class="card p-2">
            <label for="">Keterisian Data</label>
            <div class="progress progress_sm mb-1 ">
                <div class="progress-bar bg-green" role="progressbar"
                    data-transitiongoal="{{ $rekap->persen_data ?? 0 }}">
                </div>
            </div>
            <small style="font-size: .7rem">{{ round($rekap->persen_data) ?? 0 }}% Complete</small>
        </div>
        <div class="card p-2">
            <label for="">Nilai Indikator </label>
            <div class="progress progress_sm mb-1 ">
                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{ $rekap->nilai ?? 0}}">
                </div>
            </div>
            <small style="font-size: .8rem">{{ round($rekap->nilai,2) }}</small>
        </div>
        <div class="card p-2 d-flex">
            <p class="mb-0">Bobot : {{ $rekap->bobot }}%</p>
            <p>Skor : {{ $rekap->skor }}</p>
        </div>

    </div>
    @endif

</div>