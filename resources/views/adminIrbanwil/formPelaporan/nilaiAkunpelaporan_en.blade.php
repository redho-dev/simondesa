<div class="row mb-0">
    {{-- <div class="col-md-9 mb-0">
        <table class="table table-bordered">
            <tr class="bg-warning">
                <td width="55%" colspan="2">
                    <p style="font-size: 1rem" class="p-0">
                        Penilaian Indikator : Pelaporan
                    </p>
                </td>
                <td width="10%" class="text-center">{{ $rekap->bobot ?? 0 }}</td>
                <td width="10%" class="text-center">{{ round($rekap->persen_data) ?? 0 }}</td>
                <td width="15%" class="text-center">{{ $rekap->nilai ?? 0 }}</td>
                <td width="10%" class="text-center">{{ $rekap->skor ?? 0 }}</td>
            </tr>
        </table>
    </div> --}}
    <div class="col-md-9">
        <form action="/adminIrbanwil/nilaiAkunpelaporanEdit" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="aspek_id" value=1>
            <input type="hidden" name="indikator_id" value=6>
            <style>
                .read {
                    background-color: rosybrown;
                }
            </style>
            <table class="table table-bordered">
                <tr class="bg-info">
                    <th width="5%" style="vertical-align: middle">No</th>
                    <th width="50%" style="vertical-align: middle">Sub Indikator</th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Bobot <br>(%)</th>
                    <th width="10%" class="text-center">Keterisian<br>Data (%)</th>
                    <th width="15%" class="text-center" style="vertical-align: middle">Nilai</th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Skor</th>

                </tr>
                <tr class="{{ $datnil[0]->perbaikan ? 'text-danger': '' }}">
                    <td>1</td>
                    <td>Laporan Realisasi APB Desa TA {{ $tahun }} Semester 1</td>
                    <td class="text-center read" style="vertical-align: middle">10</td>
                    <td class="text-center" style="vertical-align: middle">{{ $datnil[0]->persen_data ?? 0 }}</td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=39>
                        <input type="number" class="form-control text-center" style="font-size: .85rem" name="nilai[]"
                            value="{{ $datnil[0]->nilai_sementara }}" autofocus required>
                    </td>
                    <td class="text-center read" style="vertical-align: middle">{{ $datnil[0]->skor ?? 0 }}</td>
                </tr>
                <tr class="{{ $datnil[1]->perbaikan ? 'text-danger': '' }}">
                    <td>2</td>
                    <td>Surat Penyampaian Laporan Realisasi APB Desa TA {{ $tahun }} Semester 1 kepada Camat</td>
                    <td class="text-center read" style="vertical-align: middle">10</td>
                    <td class="text-center" style="vertical-align: middle">{{ $datnil[1]->persen_data ?? 0 }}</td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=40>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            value="{{ $datnil[1]->nilai_sementara }}" required>
                    </td>
                    <td class="text-center read" style="vertical-align: middle">{{ $datnil[1]->skor ?? 0 }}</td>
                </tr>
                <tr class="{{ $datnil[2]->perbaikan ? 'text-danger': '' }}">
                    <td>3</td>
                    <td>Dokumen Laporan Keterangan Penyelenggaraan Pemerintahan Desa (LKPD) Tahun {{ $tahun-1 }}</td>
                    <td class="text-center read" style="vertical-align: middle">10</td>
                    <td class="text-center" style="vertical-align: middle">{{ $datnil[2]->persen_data ?? 0 }}</td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=41>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            value="{{ $datnil[2]->nilai_sementara }}" required>
                    </td>
                    <td class="text-center read" style="vertical-align: middle">{{ $datnil[2]->skor ?? 0 }}</td>
                </tr>
                <tr class="{{ $datnil[3]->perbaikan ? 'text-danger': '' }}">
                    <td>4</td>
                    <td>Surat Penyampaian LKPD Tahun {{ $tahun-1 }} kepada BPD</td>
                    <td class="text-center read" style="vertical-align: middle">10</td>
                    <td class="text-center" style="vertical-align: middle">{{ $datnil[3]->persen_data ?? 0 }}</td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=42>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            value="{{ $datnil[3]->nilai_sementara }}" required>
                    </td>
                    <td class="text-center read" style="vertical-align: middle">{{ $datnil[3]->skor ?? 0 }}</td>
                </tr>
                <tr class="{{ $datnil[4]->perbaikan ? 'text-danger': '' }}">
                    <td>5</td>
                    <td>Peraturan Desa tentang Laporan Pertanggungjawaban APB Desa Tahun {{ $tahun-1 }}</td>
                    <td class="text-center read" style="vertical-align: middle">20</td>
                    <td class="text-center" style="vertical-align: middle">{{ $datnil[4]->persen_data ?? 0 }}</td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=43>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            value="{{ $datnil[4]->nilai_sementara }}" required>
                    </td>
                    <td class="text-center read" style="vertical-align: middle">{{ $datnil[4]->skor ?? 0 }}</td>
                </tr>
                <tr class="{{ $datnil[5]->perbaikan ? 'text-danger': '' }}">
                    <td>6</td>
                    <td>Dokumen Laporan Penyelenggaraan Pemerintahan Desa (LPPD) Tahun {{ $tahun-1 }}</td>
                    <td class="text-center read" style="vertical-align: middle">20</td>
                    <td class="text-center" style="vertical-align: middle">{{ $datnil[5]->persen_data ?? 0 }}</td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=44>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            value="{{ $datnil[5]->nilai_sementara }}" required>
                    </td>
                    <td class="text-center read" style="vertical-align: middle">{{ $datnil[5]->skor ?? 0 }}</td>
                </tr>
                <tr class="{{ $datnil[6]->perbaikan ? 'text-danger': '' }}">
                    <td>7</td>
                    <td>Surat Penyampaian LPPD Tahun {{ $tahun-1 }} kepada Camat</td>
                    <td class="text-center read" style="vertical-align: middle">20</td>
                    <td class="text-center" style="vertical-align: middle">{{ $datnil[6]->persen_data ?? 0 }}</td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=45>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            value="{{ $datnil[6]->nilai_sementara }}" required>
                    </td>
                    <td class="text-center read" style="vertical-align: middle">{{ $datnil[6]->skor ?? 0 }}</td>
                </tr>

                <tr>
                    <td colspan="6" class="text-muted"><i>Petunjuk Penilaian : 0 jika data kosong, 100 jika dokumen sah,
                            tepat waktu,
                            dan sistematika telah sesuai ketentuan</i>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="background-color: beige">
                        <?php 
                        $nil = $rekap->nilai;
                        if($nil >= 0 && $nil <=30){
                            $kesimpulan = "TIDAK MEMADAI";
                        }elseif($nil >= 31 && $nil <=55){
                            $kesimpulan = "KURANG MEMADAI";
                        }elseif($nil >= 36 && $nil <=75){
                            $kesimpulan = "CUKUP MEMADAI";
                        }elseif($nil >= 76 && $nil <=90){
                            $kesimpulan = "MEMADAI";
                        }elseif($nil >= 91 && $nil <=100){
                            $kesimpulan = "SANGAT MEMADAI";
                        }      
                        ?>
                        <p>KESIMPULAN : </p>
                        <p>SECARA UMUM KELENGKAPAN DAN KETERBARUAN DATA UMUM/MONOGRAFI TAHUN {{ $tahun
                            }} <span class="text-primary">-- {{ $kesimpulan }} --</span> , DENGAN URAIAN/CATATAN
                            SEBAGAI BERIKUT :</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="bg-info">
                        <div class="form-group">
                            <label for="kesimpulan">Catatan / Kesimpulan</label>
                            <input type="hidden" name="catatan_sementara" id="kesimpulan" autofocus>
                            <trix-editor input="kesimpulan" class="bg-white">{!! $catatan->catatan_sementara ?? '' !!}
                            </trix-editor>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="bg-info">
                        <div class="form-group">
                            <label for="saran">Saran / Rekomendasi</label>
                            <input type="hidden" name="rekom_sementara" id="saran">
                            <trix-editor input="saran" class="bg-white">{!! $catatan->rekom_sementara ?? '' !!}
                            </trix-editor>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-right">
                        <button type="submit" class="btn btn-primary">Update Nilai</button>
                    </td>
                </tr>


            </table>
        </form>
    </div>
    <div class="col-md-3">
        <p class="alert alert-info" style="font-size: 1rem">Capaian Indikator Pelaporan</p>
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
                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{ $rekap->nilai ?? 0 }}">
                </div>
            </div>
            <small style="font-size: .8rem">{{ round($rekap->nilai) ?? 0}}</small>
        </div>
        <div class="card p-2 d-flex">
            <p class="mb-0">Bobot : {{ $rekap->bobot ?? 0 }}%</p>
            <p>Skor : {{ $rekap->skor ?? 0 }}</p>
        </div>

    </div>

</div>