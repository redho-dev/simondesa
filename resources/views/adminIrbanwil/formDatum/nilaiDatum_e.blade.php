{{-- Form Update Papan Monografi --}}
<div class="row ">
    <div class="col-md-8 mt-2">
        <form action="/adminIrbanwil/nilaiPemdesEdit" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="aspek_id" value=1>
            <input type="hidden" name="indikator_id" value=1>

            <style>
                tbody>tr>td {
                    line-height: 2rem;
                    vertical-align: middle;
                }

                /* .bg-secondary {
                    background-color: antiquewhite;
                    color: slategrey;
                } */
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
                    <tr class="{{ $datnil->where('sub_indikator_pemerintahan_id',
                        1)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                        <td>1</td>
                        <td>Data Umum Wilayah dan Kependudukan
                        </td>
                        <td class="text-center bg-secondary">20</td>
                        <td class="text-center">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                            1)->pluck('persen_data')->first()) ?? 0}}</td>
                        <td>
                            <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=1>
                            <input type="number"
                                class="form-control text-center nilai {{ $data[0]->perbaikan ? 'text-danger' : ''}}"
                                style="font-size: .85rem" name="nilai[]" autofocus required value="{{ $datnil->where('sub_indikator_pemerintahan_id',
                                1)->pluck('nilai_sementara')->first() ?? 0}}">
                        </td>
                        <td class="text-center bg-secondary">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                            1)->pluck('skor')->first()) ?? 0}}</td>
                    </tr>
                    <tr class="{{ $datnil->where('sub_indikator_pemerintahan_id',
                        2)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                        <td>2</td>
                        <td>Data Sarana dan Prasarana</td>
                        <td class="text-center bg-secondary">20</td>
                        <td class="text-center">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                            2)->pluck('persen_data')->first()) ?? 0 }}</td>
                        <td>
                            <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=2>
                            <input type="number" class="form-control text-center nilai" name="nilai[]" required value="{{ $datnil->where('sub_indikator_pemerintahan_id',
                            2)->pluck('nilai_sementara')->first() ?? 0 }}" style="font-size: .85rem">
                        </td>
                        <td class="text-center bg-secondary">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                            2)->pluck('skor')->first()) ?? 0}}</td>
                    </tr>
                    <tr class="{{ $datnil->where('sub_indikator_pemerintahan_id',
                        3)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                        <td>3</td>
                        <td>Data Kelembagaan</td>
                        <td class="text-center bg-secondary">20</td>
                        <td class="text-center">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                            3)->pluck('persen_data')->first()) ?? 0 }}</td>
                        <td>
                            <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=3>
                            <input type="number" class="form-control text-center nilai" name="nilai[]" required value="{{ $datnil->where('sub_indikator_pemerintahan_id',
                            3)->pluck('nilai_sementara')->first() ?? 0}}" style="font-size: .85rem">
                        </td>
                        <td class="text-center bg-secondary">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                            3)->pluck('skor')->first()) ?? 0}}</td>
                    </tr>
                    <tr class="{{ $datnil->where('sub_indikator_pemerintahan_id',
                        4)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                        <td>4</td>
                        <td>Papan Monografi</td>
                        <td class="text-center bg-secondary">20</td>
                        <td class="text-center">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                            4)->pluck('persen_data')->first()) ?? 0 }}</td>
                        <td>
                            <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=4>
                            <input type="number" class="form-control text-center nilai" name="nilai[]" required value="{{ $datnil->where('sub_indikator_pemerintahan_id',
                            4)->pluck('nilai_sementara')->first() ?? 0}}" style="font-size: .85rem">
                        </td>
                        <td class="text-center bg-secondary">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                            4)->pluck('skor')->first()) ?? 0}}</td>
                    </tr>
                    <tr class="{{ $datnil->where('sub_indikator_pemerintahan_id',
                        5)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                        <td>5</td>
                        <td>Data Perangkat, BPD dan RT</td>
                        <td class="text-center bg-secondary">20</td>
                        <td class="text-center">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                            5)->pluck('persen_data')->first()) ?? 0 }}</td>
                        <td>
                            <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=5>
                            <input type="number" class="form-control text-center nilai" name="nilai[]" required value="{{ $datnil->where('sub_indikator_pemerintahan_id',
                            5)->pluck('nilai_sementara')->first() ?? 0}}" style="font-size: .85rem">
                        </td>
                        <td class="text-center bg-secondary">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                            5)->pluck('skor')->first()) ?? 0}}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" class="text-muted"><i>Petunjuk Penilaian : 0 jika data kosong, 100 jika data
                                lengkap
                                dan
                                update</i>
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
                            <p>SECARA UMUM KELENGKAPAN DAN KETERBARUAN DATA UMUM/MONOGRAFI TAHUN {{ $tahun
                                }} <span class="text-primary">-- {{ $kesimpulan }} --</span> , DENGAN URAIAN/CATATAN
                                SEBAGAI BERIKUT :</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="bg-info">
                            <div class="form-group ">
                                <label for="kesimpulan">Catatan : </label>
                                <input type="hidden" name="catatan_sementara" id="kesimpulan" autofocus>
                                <trix-editor input="kesimpulan" class="bg-white text-dark">{!!
                                    $catatan->catatan_sementara
                                    ?? '' !!}
                                </trix-editor>
                                {{-- <textarea class="form-control" id="kesimpulan" rows="2" style="font-size: .8rem"
                                    name="catatan_sementara">{{ $catatan->catatan_sementara ?? '' }}</textarea> --}}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="bg-info">
                            <div class="form-group">
                                <label for="saran">Saran/Rekomendasi</label>
                                <input type="hidden" name="rekom_sementara" id="saran">
                                <trix-editor input="saran" class="bg-white text-dark">{!! $catatan->rekom_sementara ??
                                    ''
                                    !!}
                                </trix-editor>
                                {{-- <textarea class="form-control" id="saran" rows="2" name="rekom_sementara"
                                    style="font-size: .8rem">{{ $catatan->rekom_sementara ?? '' }}</textarea> --}}
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
        <p class="alert alert-info" style="font-size: 1rem">Capaian Indikator Data Umum/Monografi</p>
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