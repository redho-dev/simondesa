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
                <thead>
                    <tr class="bg-info">
                        <th width="5%" style="vertical-align: middle">No</th>
                        <th width="50%" style="vertical-align: middle">Sub Indikator</th>
                        <th width="10%" class="text-center" style="vertical-align: middle">Bobot <br>(%)</th>
                        <th width="10%" class="text-center">Keterisian<br>Data (%)</th>
                        <th width="15%" class="text-center" style="vertical-align: middle">Nilai</th>
                        <th width="10%" class="text-center" style="vertical-align: middle">Skor</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($subpem as $sub)
                    <tr class="{{ $sub->nilai_pemerintahan->where('asal_id',
                        $asal_id)->where('tahun', $tahun)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($sub->id < 42) {{ $sub->sub_indikator }} ( Tahun {{ $tahun-1 }} )
                                @else
                                {{ $sub->sub_indikator }} (Tahun Anggaran {{ $tahun }})
                                @endif
                        </td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">{{ $sub->bobot }}</td>
                        <td class="text-center" style="vertical-align: middle">
                            {{ round($sub->nilai_pemerintahan->where('asal_id',
                            $asal_id)->where('tahun', $tahun)->pluck('persen_data')->first()) }}
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="sub_indikator_pemerintahan_id[]" value={{ $sub->id }}>
                            <input type="number" class="form-control text-center" style="font-size: .85rem"
                                name="nilai[]" value="{{ $sub->nilai_pemerintahan->where('asal_id',
                                $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first() }}" autofocus
                                required>
                        </td>
                        <td class="text-center read" style="vertical-align: middle">
                            {{ $sub->nilai_pemerintahan->where('asal_id',
                            $asal_id)->where('tahun', $tahun)->pluck('skor')->first() }}
                        </td>
                    </tr>

                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="6" class="text-muted"><i>Petunjuk Penilaian : 0 jika data kosong, 100 jika dokumen
                                sah,
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
                            <p>SECARA UMUM KELENGKAPAN DAN KESESUAIAN PELAPORAN TAHUN {{ $tahun
                                }} <span class="text-primary">-- {{ $kesimpulan }} --</span> , DENGAN URAIAN/CATATAN
                                SEBAGAI BERIKUT :</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="bg-info">
                            <div class="form-group">
                                <label for="kesimpulan">Catatan Umum / Uraian Kesimpulan / Apresiasi : </label>
                                <input type="hidden" name="catatan_sementara" id="kesimpulan">
                                <trix-editor input="kesimpulan" class="bg-white">
                                    {!! $catatan->catatan_sementara !!}
                                </trix-editor>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="bg-info">
                            <div class="form-group">
                                <label for="saran">Saran Perbaikan Kedepan : </label>
                                <input type="hidden" name="rekom_sementara" id="saran">
                                <trix-editor input="saran" class="bg-white">{!! $catatan->rekom_sementara !!}
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