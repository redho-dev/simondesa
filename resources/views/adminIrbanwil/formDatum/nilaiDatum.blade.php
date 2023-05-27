<div class="row ">
    <div class="col-md-8 mt-2">
        {{-- <p class="alert bg-warning text-dark" style="font-size: 1rem">Penilaian Indikator : Data Umum-Monografi
            Tahun
            {{
            $tahun }}
        </p> --}}
        <form action="/adminIrbanwil/nilaiPemdes" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="aspek_id" value=1>
            <input type="hidden" name="indikator_id" value=1>

            <style>

            </style>

            <table class="table table-bordered">
                <tr class="bg-info">
                    <th width="5%" style="vertical-align: middle">No</th>
                    <th width="55%" style="vertical-align: middle">Sub Indikator</th>
                    <th width="10%" style="vertical-align: middle" class="text-center">Bobot <br> (%)</th>
                    <th width="15%" class="text-center">Keterisian<br>Data (%)</th>
                    <th width="15%" class="text-center" style="vertical-align: middle">Nilai</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Data Umum Wilayah dan Kependudukan</td>
                    <td class="text-center bg-secondary">20</td>
                    <td class="text-center">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                        1)->pluck('persen_data')->first() ?? 0 )}}</td>
                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=1>
                        <input type="number" class="form-control text-center" style="font-size: .85rem" name="nilai[]"
                            autofocus required>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Data Sarana dan Prasarana</td>
                    <td class="text-center bg-secondary">20</td>
                    <td class="text-center ">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                        2)->pluck('persen_data')->first() ?? 0 )}}</td>
                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=2>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Data Kelembagaan</td>
                    <td class="text-center bg-secondary">20</td>
                    <td class="text-center ">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                        3)->pluck('persen_data')->first() ?? 0 )}}</td>
                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=3>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Papan Monografi</td>
                    <td class="text-center bg-secondary">20</td>
                    <td class="text-center ">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                        4)->pluck('persen_data')->first() ?? 0 )}}</td>
                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=4>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Data Perangkat, BPD dan RT</td>
                    <td class="text-center bg-secondary">20</td>
                    <td class="text-center ">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                        5)->pluck('persen_data')->first() ?? 0 )}}</td>
                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=5>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="text-muted"><i>Petunjuk Penilaian : 0 jika data kosong, 100 jika data lengkap
                            dan
                            update</i>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" style="background-color: beige">
                        KESIMPULAN : (TERISI OTOMATIS SESUAI SKORING YANG DIBERIKAN)
                    </td>
                </tr>

                <tr>
                    <td colspan="5" class="bg-info">
                        <div class="form-group ">
                            <label for="kesimpulan">Catatan Umum / Uraian Kesimpulan / Apresiasi : </label>
                            <input type="hidden" name="catatan_sementara" id="kesimpulan" autofocus>
                            <trix-editor input="kesimpulan" class="bg-white text-dark">{!! $catatan->catatan_sementara
                                ?? '' !!}
                            </trix-editor>
                            {{-- <textarea class="form-control" id="kesimpulan" rows="2" style="font-size: .8rem"
                                name="catatan_sementara">{{ $catatan->catatan_sementara ?? '' }}</textarea> --}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="bg-info">
                        <div class="form-group">
                            <label for="saran">Saran Perbaikan Kedepan :</label>
                            <input type="hidden" name="rekom_sementara" id="saran">
                            <trix-editor input="saran" class="bg-white text-dark">{!! $catatan->rekom_sementara ?? ''
                                !!}
                            </trix-editor>
                            {{-- <textarea class="form-control" id="saran" rows="2" name="rekom_sementara"
                                style="font-size: .8rem">{{ $catatan->rekom_sementara ?? '' }}</textarea> --}}
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
</div>