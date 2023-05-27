<div class="row ">
    <div class="col-md-8 mt-2">
        <p class="alert bg-warning text-dark" style="font-size: 1rem">Penilaian Indikator : Kewilayahan
            {{
            $tahun }}
        </p>
        <form action="/adminIrbanwil/nilaiAkunwil" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="aspek_id" value=1>
            <input type="hidden" name="indikator_id" value=2>



            <table class="table table-bordered">
                <tr class="bg-info">
                    <th width="5%" style="vertical-align: middle">No</th>
                    <th width="55%" style="vertical-align: middle">Sub Indikator</th>
                    <th width="10%" style="vertical-align: middle" class="text-center">Bobot <br>(%)</th>
                    <th width="15%" class="text-center">Keterisian<br>Data (%)</th>
                    <th width="15%" class="text-center" style="vertical-align: middle">Nilai</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Dokumen Dasar Hukum Pembentukan Desa</td>
                    <td style="vertical-align: middle" class="text-center bg-secondary">20</td>
                    <td class="text-center">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                        6)->pluck('persen_data')->first() ) ?? 0 }}</td>
                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=6>
                        <input type="number" class="form-control text-center" style="font-size: .85rem" name="nilai[]"
                            autofocus required>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Pilar Batas Utara</td>
                    <td style="vertical-align: middle" class="text-center bg-secondary">10</td>
                    <td class="text-center">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                        7)->pluck('persen_data')->first() ) ?? 0 }}</td>
                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=7>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Pilar Batas Selatan</td>
                    <td style="vertical-align: middle" class="text-center bg-secondary">10</td>
                    <td class="text-center">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                        8)->pluck('persen_data')->first() ) ?? 0 }}</td>
                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=8>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Pilar Batas Barat </td>
                    <td style="vertical-align: middle" class="text-center bg-secondary">10</td>
                    <td class="text-center">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                        9)->pluck('persen_data')->first() ) ?? 0 }}</td>
                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=9>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Pilar Batas Timur</td>
                    <td style="vertical-align: middle" class="text-center bg-secondary">10</td>
                    <td class="text-center">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                        10)->pluck('persen_data')->first()) ?? 0 }}</td>
                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=10>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Peta Batas Desa</td>
                    <td style="vertical-align: middle" class="text-center bg-secondary">40</td>
                    <td class="text-center">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                        11)->pluck('persen_data')->first()) ?? 0 }}</td>
                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=11>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="text-muted"><i>Petunjuk Penilaian : 0 jika data kosong, 100 jika data
                            valid dan memenuhi standar/ketentuan</i>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" style="background-color: beige">
                        KESIMPULAN : (TERISI OTOMATIS SESUAI SKORING YANG DIBERIKAN)
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="bg-info">
                        <div class="form-group">
                            <label for="kesimpulan">Catatan Umum / Uraian Kesimpulan / Apresiasi:</label>
                            <input type="hidden" name="catatan_sementara" id="kesimpulan" autofocus>
                            <trix-editor input="kesimpulan" class="bg-white">{!! $catatan->catatan_sementara ?? '' !!}
                            </trix-editor>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="bg-info">
                        <div class="form-group">
                            <label for="saran">Saran Perbaikan Kedepan :</label>
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

</div>