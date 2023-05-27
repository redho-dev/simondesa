<div class="row ">
    <div class="col-md-9 mt-2">
        <p class="alert bg-warning text-dark" style="font-size: 1rem">Penilaian Indikator : Dokumen Perencanaan
            {{
            $tahun }}
        </p>
        <form action="/adminIrbanwil/nilaiAkundokEdit" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="aspek_id" value=1>
            <input type="hidden" name="indikator_id" value=4>

            <table class="table table-bordered table-striped">
                <tr class="bg-info">
                    <th width="5%" style="vertical-align: middle">No</th>
                    <th width="55%" style="vertical-align: middle">Sub Indikator</th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Bobot <br>(%)</th>
                    <th width="10%" class="text-center">Keterisian<br>Data (%)</th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Nilai (%)</th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Skor</th>
                </tr>
                <tr class="{{ $datnil[0]->perbaikan ? 'text-danger' : ''}}">
                    <td>1</td>
                    <td>Perdes dan Dokumen RPJMDes</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        20)->pluck('persen_data')->first()) ?? 0 }}</td>
                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=20>
                        <input type="number" class="form-control text-center" style="font-size: .85rem" name="nilai[]"
                            value="{{ $datnil[0]->nilai_sementara }}" autofocus required>
                    </td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">
                        {{ $datnil[0]->skor }}
                    </td>
                </tr>
                <tr class="{{ $datnil[1]->perbaikan ? 'text-danger' : ''}}">
                    <td>2</td>
                    <td>SK Tim Penyusunan RKP Desa Tahun {{ $tahun }}</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">5</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        21)->pluck('persen_data')->first()) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=21>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            value="{{ $datnil[1]->nilai_sementara }}" required>
                    </td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">
                        {{ $datnil[1]->skor }}
                    </td>
                </tr>

                <tr class="{{ $datnil[2]->perbaikan ? 'text-danger' : ''}}">
                    <td>3</td>
                    <td>BAC Musyawarah Dusun</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">5</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        22)->pluck('persen_data')->first()) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=22>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            value="{{ $datnil[2]->nilai_sementara }}" required>
                    </td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">
                        {{ $datnil[2]->skor }}
                    </td>
                </tr>
                <tr class="{{ $datnil[3]->perbaikan ? 'text-danger' : ''}}">
                    <td>4</td>
                    <td>BAC Musrenbangdes</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        23)->pluck('persen_data')->first()) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=23>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            value="{{ $datnil[3]->nilai_sementara }}" required>
                    </td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">
                        {{ $datnil[3]->skor }}
                    </td>
                </tr>
                <tr class="{{ $datnil[4]->perbaikan ? 'text-danger' : ''}}">
                    <td>5</td>
                    <td>Perdes dan Dokumen RKP Desa Tahun {{ $tahun }}</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        24)->pluck('persen_data')->first()) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=24>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            value="{{ $datnil[4]->nilai_sementara }}" required>
                    </td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">
                        {{ $datnil[4]->skor }}
                    </td>
                </tr>
                <tr class="{{ $datnil[5]->perbaikan ? 'text-danger' : ''}}">
                    <td>6</td>
                    <td>Ketepatan Waktu Penetapan Perdes RKP Desa Tahun {{ $tahun }}</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        25)->pluck('persen_data')->first()) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=25>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            value="{{ $datnil[5]->nilai_sementara }}" required>
                    </td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">
                        {{ $datnil[5]->skor }}
                    </td>
                </tr>
                <tr class="{{ $datnil[6]->perbaikan ? 'text-danger' : ''}}">
                    <td>7</td>
                    <td>Dokumen RAPBDes Tahun {{ $tahun }}</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">5</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        26)->pluck('persen_data')->first()) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=26>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            value="{{ $datnil[6]->nilai_sementara }}" required>
                    </td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">
                        {{ $datnil[6]->skor }}
                    </td>
                </tr>
                <tr class="{{ $datnil[7]->perbaikan ? 'text-danger' : ''}}">
                    <td>8</td>
                    <td>BAC Pembahasan RAPBDes dengan BPD</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">5</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        27)->pluck('persen_data')->first()) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=27>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            value="{{ $datnil[7]->nilai_sementara }}" required>
                    </td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">
                        {{ $datnil[7]->skor }}
                    </td>
                </tr>
                <tr class="{{ $datnil[8]->perbaikan ? 'text-danger' : ''}}">
                    <td>9</td>
                    <td>Keputusan BPD tentang Persetujuan RAPBDes menjadi APBDes TA {{ $tahun }}</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">5</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        28)->pluck('persen_data')->first()) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=28>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            value="{{ $datnil[8]->nilai_sementara }}" required>
                    </td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">
                        {{ $datnil[8]->skor }}
                    </td>
                </tr>
                <tr class="{{ $datnil[9]->perbaikan ? 'text-danger' : ''}}">
                    <td>10</td>
                    <td>Hasil Evaluasi Camat atas Raperdes APBDes TA {{ $tahun }}</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">5</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        29)->pluck('persen_data')->first()) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=29>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            value="{{ $datnil[9]->nilai_sementara }}" required>
                    </td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">
                        {{ $datnil[9]->skor }}
                    </td>
                </tr>


                <tr class="{{ $datnil[10]->perbaikan ? 'text-danger' : ''}}">
                    <td>11</td>
                    <td>Perdes dan Lampiran/Dokumen APBDes TA {{ $tahun }}</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        30)->pluck('persen_data')->first()) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=30>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            value="{{ $datnil[10]->nilai_sementara }}" required>
                    </td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">
                        {{ $datnil[10]->skor }}
                    </td>
                </tr>
                <tr class="{{ $datnil[11]->perbaikan ? 'text-danger' : ''}}">
                    <td>12</td>
                    <td>Analisa, Gambar dan RAB Pembangunan Fisik (APBDes Murni TA {{ $tahun }})</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">5</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        31)->pluck('persen_data')->first()) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=31>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            value="{{ $datnil[11]->nilai_sementara }}" required>
                    </td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">
                        {{ $datnil[11]->skor }}
                    </td>
                </tr>
                <tr class="{{ $datnil[12]->perbaikan ? 'text-danger' : ''}}">
                    <td>13</td>
                    <td>Ketepatan Waktu Penetapan Perdes APBDes TA {{ $tahun }}</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        32)->pluck('persen_data')->first()) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=32>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            value="{{ $datnil[12]->nilai_sementara }}" required>
                    </td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">
                        {{ $datnil[12]->skor }}
                    </td>
                </tr>
                <tr class="{{ $datnil[13]->perbaikan ? 'text-danger' : ''}}">
                    <td>14</td>
                    <td>Perkades dan Lampiran/Dokumen Penjabaran (APBDes Murni TA {{ $tahun }})</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">5</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        33)->pluck('persen_data')->first()) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=33>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            value="{{ $datnil[13]->nilai_sementara }}" required>
                    </td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">
                        {{ $datnil[13]->skor }}
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-muted"><i>Petunjuk Penilaian : 0 jika data kosong, 100 jika data
                            lengkap, sah dan sesuai dengan ketentuan</i>
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
                        <p>SECARA UMUM KELENGKAPAN DAN KESESUAIAN DOKUMEN PERENCANAAN TAHUN {{ $tahun
                            }} <span class="text-primary">-- {{ $kesimpulan }} --</span> , DENGAN URAIAN/CATATAN
                            SEBAGAI BERIKUT :</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="bg-info">
                        <div class="form-group">
                            <label for="kesimpulan">Catatan Umum / Uraian Kesimpulan / Apresiasi :</label>
                            <input type="hidden" name="catatan_sementara" id="kesimpulan" autofocus>
                            <trix-editor input="kesimpulan" class="bg-white">{!! $catatan->catatan_sementara ?? '' !!}
                            </trix-editor>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="bg-info">
                        <div class="form-group">
                            <label for="saran">Saran Perbaikan Kedepan :</label>
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
    <div class="col-md-3 mt-2">
        <p class="alert alert-info" style="font-size: 1rem">Capaian Indikator Dokren {{ $tahun }}</p>
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