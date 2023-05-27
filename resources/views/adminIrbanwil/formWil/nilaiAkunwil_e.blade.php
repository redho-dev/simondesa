<style>
    td {
        line-height: 1rem;
        vertical-align: middle;
    }
</style>
<div class="row ">
    <div class="col-md-8 mt-2">
        <p class="alert bg-warning text-dark" style="font-size: 1rem">Penilaian Indikator : Kewilayahan
            {{
            $tahun }}
        </p>
        <form action="/adminIrbanwil/nilaiAkunwilEdit" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="aspek_id" value=1>
            <input type="hidden" name="indikator_id" value=2>

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
                        <th width="50%" style="vertical-align: middle">Sub Indikator</th>
                        <th width="10%" style="vertical-align: middle" class="text-center">Bobot <br>(%)</th>
                        <th width="10%" class="text-center">Keterisian<br>Data (%)</th>
                        <th width="15%" class="text-center" style="vertical-align: middle">Nilai</th>
                        <th width="10%" class="text-center" style="vertical-align: middle">Skor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="{{ $data[0]->perbaikan ? 'text-danger': '' }}">
                        <td style="vertical-align: middle">1</td>
                        <td style="vertical-align: middle">Dokumen Dasar Hukum Pembentukan Desa
                        </td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">20</td>

                        <td class="text-center " style="vertical-align: middle">{{ round($data[0]->persen_data) ?? 0 }}
                        </td>
                        <td>
                            <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=6>
                            <input type="number"
                                class="form-control text-center {{ $data[0]->perbaikan ? 'text-danger': '' }}"
                                style="font-size: .85rem" name="nilai[]" autofocus required
                                value="{{ $data[0]->nilai_sementara }}">
                        </td>
                        <td class="text-center bg-secondary " style="vertical-align: middle">{{ $data[0]->skor ?? 0 }}
                        </td>
                    </tr>
                    <tr class="{{ $data[1]->perbaikan ? 'text-danger': '' }}">
                        <td>2</td>
                        <td>Pilar Batas Utara</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                        <td class="text-center">{{ round($data[1]->persen_data) ?? 0 }}</td>
                        <td>
                            <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=7>
                            <input type="number"
                                class="form-control text-center {{ $data[1]->perbaikan ? 'text-danger': '' }}"
                                name="nilai[]" style="font-size: .85rem" required
                                value="{{ $data[1]->nilai_sementara }}">
                        </td>
                        <td class="text-center bg-secondary " style="vertical-align: middle">{{ $data[1]->skor ?? 0 }}
                        </td>
                    </tr>
                    <tr class="{{ $data[2]->perbaikan ? 'text-danger': '' }}">
                        <td>3</td>
                        <td>Pilar Batas Selatan</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                        <td class="text-center">{{ round($data[2]->persen_data) ?? 0 }}</td>
                        <td>
                            <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=8>
                            <input type="number"
                                class="form-control text-center {{ $data[2]->perbaikan ? 'text-danger': '' }} "
                                name="nilai[]" style="font-size: .85rem" required
                                value="{{  $data[2]->nilai_sementara }}">
                        </td>
                        <td class="text-center bg-secondary " style="vertical-align: middle">{{ $data[2]->skor ?? 0 }}
                        </td>
                    </tr>
                    <tr class="{{ $data[3]->perbaikan ? 'text-danger': '' }}">
                        <td>4</td>
                        <td>Pilar Batas Barat </td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                        <td class="text-center">{{ round($data[3]->persen_data) ?? 0 }}</td>
                        <td>
                            <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=9>
                            <input type="number"
                                class="form-control text-center {{ $data[3]->perbaikan ? 'text-danger': '' }}"
                                name="nilai[]" style="font-size: .85rem" required
                                value="{{  $data[3]->nilai_sementara }}">
                        </td>
                        <td class="text-center bg-secondary " style="vertical-align: middle">{{ $data[3]->skor ?? 0 }}
                        </td>
                    </tr>
                    <tr class="{{ $data[4]->perbaikan ? 'text-danger': '' }}">
                        <td>5</td>
                        <td>Pilar Batas Timur</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                        <td class="text-center">{{ round($data[4]->persen_data) ?? 0 }}</td>
                        <td>
                            <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=10>
                            <input type="number"
                                class="form-control text-center {{ $data[4]->perbaikan ? 'text-danger': '' }}"
                                name="nilai[]" style="font-size: .85rem" required
                                value="{{  $data[4]->nilai_sementara }}">
                        </td>
                        <td class="text-center bg-secondary " style="vertical-align: middle">{{ $data[4]->skor ?? 0 }}
                        </td>
                    </tr>
                    <tr class="{{ $data[5]->perbaikan ? 'text-danger': '' }}">
                        <td>6</td>
                        <td>Peta Batas Desa</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">40</td>
                        <td class="text-center">{{ round($data[5]->persen_data) ?? 0}} </td>
                        <td>
                            <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=11>
                            <input type="number"
                                class="form-control text-center {{ $data[5]->perbaikan ? 'text-danger': '' }}"
                                name="nilai[]" style="font-size: .85rem" required
                                value="{{  $data[5]->nilai_sementara }}">
                        </td>
                        <td class="text-center bg-secondary " style="vertical-align: middle">{{ $data[5]->skor ?? 0 }}
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" class="text-muted"><i>Petunjuk Penilaian : 0 jika data kosong, 100 jika data
                                valid dan memenuhi standar/ketentuan</i>
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
                            <p>SECARA UMUM PENATAAN KEWILAYAHAN TAHUN {{ $tahun
                                }} <span class="text-primary">-- {{ $kesimpulan }} --</span> , DENGAN URAIAN/CATATAN
                                SEBAGAI BERIKUT :</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="bg-info">
                            <div class="form-group">
                                <label for="kesimpulan">Catatan Umum / Uraian Kesimpulan / Apresiasi:</label>
                                <input type="hidden" name="catatan_sementara" id="kesimpulan" autofocus>
                                <trix-editor input="kesimpulan" class="bg-white text-dark">{!!
                                    $catatan->catatan_sementara
                                    ?? '' !!}
                                </trix-editor>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="bg-info">
                            <div class="form-group">
                                <label for="saran">Saran Perbaikan Kedepan :</label>
                                <input type="hidden" name="rekom_sementara" id="saran">
                                <trix-editor input="saran" class="bg-white text-dark">{!! $catatan->rekom_sementara ??
                                    ''
                                    !!}
                                </trix-editor>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-right">
                            <button type="submit" class="btn btn-primary">Update Nilai</button>
                        </td>
                    </tr>
                </tfoot>

            </table>
        </form>
    </div>
    <div class="col-md-3 mt-2">
        <p class="alert alert-info" style="font-size: 1rem">Capaian Indikator Kewilayahan</p>
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