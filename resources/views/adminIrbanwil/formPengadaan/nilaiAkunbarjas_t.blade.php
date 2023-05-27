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
                    <td colspan="5" class="bg-info">
                        <div class="form-group">
                            <label for="kesimpulan">Buat Kesimpulan Terkait Pengadaan Barang dan Jasa Secara
                                Umum</label>
                            <input type="hidden" name="catatan_sementara" id="kesimpulan" autofocus>
                            <trix-editor input="kesimpulan" class="bg-white">{!! $catatan->catatan_sementara ?? ''
                                !!}
                            </trix-editor>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="bg-info">
                        <div class="form-group">
                            <label for="saran">Saran / Rekomendasi</label>
                            <input type="hidden" name="rekom_sementara" id="saran">
                            <trix-editor input="saran" class="bg-white">{!! $catatan->rekom_sementara ?? '' !!}
                            </trix-editor>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right">

                        <button type="submit" class="btn btn-primary">Kirim Nilai</button>


                    </td>
                </tr>


            </table>
        </form>
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