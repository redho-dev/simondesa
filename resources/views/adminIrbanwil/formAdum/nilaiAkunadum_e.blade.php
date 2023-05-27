<div class="row ">
    <div class="col-md-8 mt-2">
        <p class="alert bg-warning text-dark" style="font-size: 1rem">Penilaian Indikator : Administrasi Umum
            Tahun {{ $tahun }}
        </p>
        <form action="/adminIrbanwil/nilaiAkunadumEdit" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="aspek_id" value=1>
            <input type="hidden" name="indikator_id" value=5>

            <table class="table table-bordered" id="tabelPenilaian">
                <tr class="bg-info">
                    <th width="5%" style="vertical-align: middle">No</th>
                    <th width="50%" style="vertical-align: middle">Sub Indikator</th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Bobot <br>(%)</th>
                    <th width="10%" class="text-center">Keterisian<br>Data (%)</th>
                    <th width="15%" class="text-center" style="vertical-align: middle">Nilai</th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Skor</th>
                </tr>
                <tr class="{{ $datnil[0]->perbaikan ? 'text-danger' : '' }}">
                    <td>1</td>
                    <td>Buku Surat Masuk/Keluar</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">20</td>
                    <td class="text-center" style="vertical-align: middle">{{ round($datnil[0]->persen_data) ?? 0 }}
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=34>
                        <input type="number" max="100" class="form-control text-center" style="font-size: .85rem"
                            name="nilai[]" value="{{ $datnil[0]->nilai_sementara }}" autofocus required>
                    </td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">
                        {{ round($datnil[0]->skor, 2) ?? 0 }}
                    </td>
                </tr>
                <tr class="{{ $datnil[1]->perbaikan ? 'text-danger' : '' }}">
                    <td>2</td>
                    <td>Rekap Bulanan Daftar hadir Perangkat Semester-1</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">15</td>
                    <td class="text-center" style="vertical-align: middle">{{ round($datnil[1]->persen_data) ?? 0 }}
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=35>
                        <input type="number" max="100" class="form-control text-center" name="nilai[]"
                            style="font-size: .85rem" value="{{ $datnil[1]->nilai_sementara }}" required>
                    </td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">
                        {{ round($datnil[1]->skor, 2) ?? 0 }}
                    </td>
                </tr>
                <tr class="{{ $datnil[2]->perbaikan ? 'text-danger' : '' }}">
                    <td>3</td>
                    <td>Rekap Bulanan Daftar hadir Perangkat Semester-2</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">15</td>
                    <td class="text-center" style="vertical-align: middle">{{ round($datnil[2]->persen_data) ?? 0 }}
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=36>
                        <input type="number" max="100" class="form-control text-center" name="nilai[]"
                            style="font-size: .85rem" value="{{ $datnil[2]->nilai_sementara }}" required>
                    </td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">
                        {{ round($datnil[2]->skor, 2) ?? 0 }}
                    </td>
                </tr>
                <tr class="{{ $datnil[3]->perbaikan ? 'text-danger' : '' }}">
                    <td>4</td>
                    <td>Buku Register Perdes/Perkades/SK</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">25</td>
                    <td class="text-center" style="vertical-align: middle">{{ round($datnil[3]->persen_data) ?? 0 }}
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=37>
                        <input type="number" max="100" class="form-control text-center" name="nilai[]"
                            style="font-size: .85rem" value="{{ $datnil[3]->nilai_sementara }}" required>
                    </td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">
                        {{ round($datnil[3]->skor, 2) ?? 0 }}
                    </td>
                </tr>
                <tr class="{{ $datnil[4]->perbaikan ? 'text-danger' : '' }}">
                    <td>5</td>
                    <td>Buku Rekap Kependudukan</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">25</td>
                    <td class="text-center" style="vertical-align: middle">{{ round($datnil[4]->persen_data) ?? 0 }}
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=38>
                        <input type="number" max="100" class="form-control text-center" name="nilai[]"
                            style="font-size: .85rem" value="{{ $datnil[4]->nilai_sementara }}" required>
                    </td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">
                        {{ round($datnil[4]->skor, 2) ?? 0 }}
                    </td>
                </tr>

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
                        <p>SECARA UMUM KELENGKAPAN DOKUMEN ADMINISTRASI UMUM TAHUN {{ $tahun
                            }} <span class="text-primary">-- {{ $kesimpulan }} --</span> , DENGAN URAIAN/CATATAN
                            SEBAGAI BERIKUT :</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="bg-info">
                        <div class="form-group">
                            <label for="kesimpulan">Catatan Umum / Uraian Kesimpulan / Apresiasi :</label>
                            <input type="hidden" name="catatan_sementara" id="kesimpulan" autofocus>
                            <trix-editor input="kesimpulan" class="bg-white">{!!
                                $catatan->catatan_sementara ??
                                '' !!}
                            </trix-editor>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="bg-info">
                        <div class="form-group">
                            <label for="saran">Saran Perbaikan Kedepan :</label>
                            <input type="hidden" name="rekom_sementara" id="saran">
                            <trix-editor input="saran" class="bg-white">{!! $catatan->rekom_sementara ??
                                '' !!}
                            </trix-editor>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-right">
                        <button type="submit" class="btn btn-primary" id="kirimNilai">Update Nilai</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <div class="col-md-3 mt-2">
        <p class="alert alert-info" style="font-size: 1rem">Capaian Indikator Administrasi Umum </p>
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