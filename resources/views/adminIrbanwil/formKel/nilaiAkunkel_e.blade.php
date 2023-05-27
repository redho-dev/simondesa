<div class="row ">
    <div class="col-md-9 mt-2">
        <p class="alert bg-warning text-dark" style="font-size: 1rem">Penilaian Indikator : Kelembagaan
            {{
            $tahun }}
        </p>
        <form action="/adminIrbanwil/nilaiAkunkelEdit" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="aspek_id" value=1>
            <input type="hidden" name="indikator_id" value=3>

            <style>
                tbody>tr>td {
                    line-height: 2rem;
                    vertical-align: middle;
                }
            </style>
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-info">
                        <th width="5%" style="vertical-align: middle">No</th>
                        <th width="55%" style="vertical-align: middle">Sub Indikator</th>
                        <th width="10%" style="vertical-align: middle" class="text-center">Bobot <br>(%)</th>
                        <th width="10%" class="text-center">Keterisian<br>Data (%)</th>
                        <th width="10%" class="text-center" style="vertical-align: middle">Nilai (%)</th>
                        <th width="10%" class="text-center" style="vertical-align: middle">Skor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="{{ $datnil[0]->perbaikan ? 'text-danger' : '' }}">
                        <td>1</td>
                        <td>Peraturan Desa Tentang Struktur Organisasi dan Tatakerja (SOTK) Pemerintah Desa</td>
                        <td style="vertical-align: middle" class="text-center bg-secondary">20</td>
                        <td class="text-center" style="vertical-align: middle">{{ round($datnil[0]->persen_data) ?? 0 }}
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=12>
                            <input type="number"
                                class="form-control text-center {{ $datnil[0]->perbaikan ? 'text-danger' : '' }}"
                                style="font-size: .85rem" name="nilai[]" autofocus required
                                value="{{ $datnil[0]->nilai_sementara  }}">
                        </td>
                        <td class="text-center bg-secondary " style="vertical-align: middle">{{ $datnil[0]->skor ?? 0 }}
                        </td>
                    </tr>
                    <tr class="{{ $datnil[1]->perbaikan ? 'text-danger' : '' }}">
                        <td>2</td>
                        <td>SK Lembaga Pemberdayaan Masyarakat (LPM)</td>
                        <td style="vertical-align: middle" class="text-center bg-secondary">10</td>
                        <td class="text-center" style="vertical-align: middle">{{ round($datnil[1]->persen_data) ?? 0 }}
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=13>
                            <input type="number"
                                class="form-control text-center {{ $datnil[1]->perbaikan ? 'text-danger' : '' }}"
                                name="nilai[]" style="font-size: .85rem" required
                                value="{{ $datnil[1]->nilai_sementara  }}">
                        </td>
                        <td class="text-center bg-secondary " style="vertical-align: middle">{{ $datnil[1]->skor ?? 0 }}
                        </td>
                    </tr>
                    <tr class="{{ $datnil[2]->perbaikan ? 'text-danger' : '' }}">
                        <td>3</td>
                        <td>SK Karang Taruna</td>
                        <td style="vertical-align: middle" class="text-center bg-secondary">10</td>
                        <td class="text-center" style="vertical-align: middle">{{ round($datnil[2]->persen_data) ?? 0 }}
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=14>
                            <input type="number"
                                class="form-control text-center {{ $datnil[2]->perbaikan ? 'text-danger' : '' }}"
                                name="nilai[]" style="font-size: .85rem" required
                                value="{{ $datnil[2]->nilai_sementara  }}">
                        </td>
                        <td class="text-center bg-secondary " style="vertical-align: middle">{{ $datnil[2]->skor ?? 0 }}
                        </td>
                    </tr>
                    <tr class="{{ $datnil[3]->perbaikan ? 'text-danger' : '' }}">
                        <td>4</td>
                        <td>SK Perlindungan Masyarakat (Linmas)</td>
                        <td style="vertical-align: middle" class="text-center bg-secondary">10</td>
                        <td class="text-center" style="vertical-align: middle">{{ round($datnil[3]->persen_data) ?? 0 }}
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=15>
                            <input type="number"
                                class="form-control text-center {{ $datnil[3]->perbaikan ? 'text-danger' : '' }}"
                                name="nilai[]" style="font-size: .85rem" required
                                value="{{ $datnil[3]->nilai_sementara  }}">
                        </td>
                        <td class="text-center bg-secondary " style="vertical-align: middle">{{ $datnil[3]->skor ?? 0 }}
                        </td>
                    </tr>
                    <tr class="{{ $datnil[4]->perbaikan ? 'text-danger' : '' }}">
                        <td>5</td>
                        <td>SK Kepengurusan PKK</td>
                        <td style="vertical-align: middle" class="text-center bg-secondary">10</td>
                        <td class="text-center" style="vertical-align: middle">{{ round($datnil[4]->persen_data) ?? 0 }}
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=16>
                            <input type="number"
                                class="form-control text-center {{ $datnil[4]->perbaikan ? 'text-danger' : '' }}"
                                name="nilai[]" style="font-size: .85rem" required
                                value="{{ $datnil[4]->nilai_sementara  }}">
                        </td>
                        <td class="text-center bg-secondary " style="vertical-align: middle">{{ $datnil[4]->skor ?? 0 }}
                        </td>
                    </tr>
                    <tr class="{{ $datnil[5]->perbaikan ? 'text-danger' : '' }}">
                        <td>6</td>
                        <td>Foto Kantor Desa</td>
                        <td style="vertical-align: middle" class="text-center bg-secondary">10</td>
                        <td class="text-center" style="vertical-align: middle">{{ round($datnil[5]->persen_data) ?? 0 }}
                        </td>
                        <td>
                            <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=17>
                            <input type="number"
                                class="form-control text-center {{ $datnil[5]->perbaikan ? 'text-danger' : '' }}"
                                name="nilai[]" style="font-size: .85rem" required
                                value="{{ $datnil[5]->nilai_sementara  }}">
                        </td>
                        <td class="text-center bg-secondary " style="vertical-align: middle">{{ $datnil[5]->skor ?? 0 }}
                        </td>
                    </tr>
                    <tr class="{{ $datnil[6]->perbaikan ? 'text-danger' : '' }}">
                        <td>7</td>
                        <td>Papan Struktur Pemerintah Desa</td>
                        <td style="vertical-align: middle" class="text-center bg-secondary">20</td>
                        <td class="text-center" style="vertical-align: middle">{{ round($datnil[6]->persen_data) ?? 0 }}
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=18>
                            <input type="number"
                                class="form-control text-center {{ $datnil[6]->perbaikan ? 'text-danger' : '' }}"
                                name="nilai[]" style="font-size: .85rem" required
                                value="{{ $datnil[6]->nilai_sementara  }}">
                        </td>
                        <td class="text-center bg-secondary " style="vertical-align: middle">{{ $datnil[6]->skor ?? 0 }}
                        </td>
                    </tr>
                    <tr class="{{ $datnil[7]->perbaikan ? 'text-danger' : '' }}">
                        <td>8</td>
                        <td>Foto Kantor/Sekretariat BPD</td>
                        <td style="vertical-align: middle" class="text-center bg-secondary">10</td>
                        <td class="text-center" style="vertical-align: middle">{{ round($datnil[7]->persen_data) ?? 0 }}
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=19>
                            <input type="number"
                                class="form-control text-center {{ $datnil[7]->perbaikan ? 'text-danger' : '' }}"
                                name="nilai[]" style="font-size: .85rem" required
                                value="{{ $datnil[7]->nilai_sementara  }}">
                        </td>
                        <td class="text-center bg-secondary " style="vertical-align: middle">{{ $datnil[7]->skor ?? 0 }}
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" class="text-muted"><i>Petunjuk Penilaian : 0 jika data kosong, 100 jika data
                                sah dan masih berlaku</i>
                        </td>
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
                            <p>KESIMPULAN : </p>
                            <p>SECARA UMUM PENATAAN KELEMBAGAAN TAHUN {{ $tahun
                                }} <span class="text-primary">-- {{ $kesimpulan }} --</span> , DENGAN URAIAN/CATATAN
                                SEBAGAI BERIKUT :</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="bg-info">
                            <div class="form-group">
                                <label for="kesimpulan">Catatan Umum / Uraian Kesimpulan / Apresiasi : </label>
                                <input type="hidden" name="catatan_sementara" id="kesimpulan" autofocus>
                                <trix-editor input="kesimpulan" class="bg-white text-dark">{!!
                                    $catatan->catatan_sementara
                                    !!}
                                </trix-editor>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="bg-info">
                            <div class="form-group">
                                <label for="saran">Saran Perbaikan ke Depan :</label>
                                <input type="hidden" name="rekom_sementara" id="saran">
                                <trix-editor input="saran" class="bg-white text-dark">{!! $catatan->rekom_sementara !!}
                                </trix-editor>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-right">
                            <button type="submit" class="btn btn-primary">UPDATE</button>
                        </td>
                    </tr>
                </tfoot>

            </table>
        </form>
    </div>

    <div class="col-md-3 mt-2">
        <p class="alert alert-info" style="font-size: 1rem">Capaian Indikator Kelembagaan</p>
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
            <small style="font-size: .8rem">{{ round($rekap->nilai) }}</small>
        </div>
        <div class="card p-2 d-flex">
            <p class="mb-0">Bobot : {{ $rekap->bobot }}%</p>
            <p>Skor : {{ $rekap->skor }}</p>
        </div>

    </div>

</div>