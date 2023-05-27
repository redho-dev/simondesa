<div class="row ">
    <div class="col-md-8 mt-2">
        <p class="alert bg-warning text-dark" style="font-size: 1rem">Penilaian Indikator : Kelembagaan
            {{
            $tahun }}
        </p>
        <form action="/adminIrbanwil/nilaiAkunkel" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="aspek_id" value=1>
            <input type="hidden" name="indikator_id" value=3>

            <table class="table table-bordered">
                <tr class="bg-info">
                    <th width="5%" style="vertical-align: middle">No</th>
                    <th width="55%" style="vertical-align: middle">Sub Indikator</th>
                    <th width="10%" class="text-center" style="vertical-align: middle">Bobot <br>(%)</th>
                    <th width="15%" class="text-center">Keterisian<br>Data (%)</th>
                    <th width="15%" class="text-center" style="vertical-align: middle">Nilai</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Peraturan Desa Tentang Struktur Organisasi dan Tatakerja (SOTK) Pemerintah Desa</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">20</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        12)->pluck('persen_data')->first() ) ?? 0 }}
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=12>
                        <input type="number" class="form-control text-center" style="font-size: .85rem" name="nilai[]"
                            autofocus required>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>SK Lembaga Pemberdayaan Masyarakat (LPM)</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        13)->pluck('persen_data')->first() ) ?? 0 }}
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=13>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>SK Karang Taruna</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        14)->pluck('persen_data')->first() ) ?? 0 }}
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=14>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>SK Perlindungan Masyarakat (Linmas)</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        15)->pluck('persen_data')->first() ) ?? 0 }}
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=15>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>SK Kepengurusan PKK</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        16)->pluck('persen_data')->first() ) ?? 0 }}
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=16>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Foto Kantor Desa</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        17)->pluck('persen_data')->first() ) ?? 0 }}
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=17>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Papan Struktur Pemerintah Desa</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">20</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        18)->pluck('persen_data')->first() ) ?? 0 }}
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=18>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Foto Kantor/Sekretariat BPD</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        19)->pluck('persen_data')->first() ) ?? 0 }}
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=19>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="text-muted"><i>Petunjuk Penilaian : 0 jika data kosong, 100 jika data
                            sah dan masih berlaku</i>
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
                            <label for="kesimpulan">Catatan Umum / Uraian Kesimpulan / Apresiasi : </label>
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