<div class="row ">
    <div class="col-md-8 mt-2">
        <p class="alert bg-warning text-dark" style="font-size: 1rem">Penilaian Indikator : Dokumen Perencanaan
            {{
            $tahun }}
        </p>
        <form action="/adminIrbanwil/nilaiAkundok" method="post">
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
                    <th width="15%" class="text-center">Keterisian<br>Data (%)</th>
                    <th width="15%" class="text-center" style="vertical-align: middle">Nilai</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Perdes dan Dokumen RPJMDes</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                    <td class="text-center" style="vertical-align: middle">
                        {{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        20)->pluck('persen_data')->first()) ?? 0

                        }}
                    </td>
                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=20>
                        <input type="number" class="form-control text-center" style="font-size: .85rem" name="nilai[]"
                            autofocus required>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>SK Tim Penyusunan RKP Desa Tahun {{ $tahun }}</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">5</td>
                    <td class="text-center" style="vertical-align: middle">
                        {{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        21)->pluck('persen_data')->first()) ?? 0
                        }}
                    </td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=21>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>BAC Musyawarah Dusun</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">5</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        22)->pluck('persen_data')->first() ) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=22>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>BAC Musrenbangdes</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        23)->pluck('persen_data')->first() ) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=23>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Perdes dan Dokumen RKP Desa Tahun {{ $tahun }}</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        24)->pluck('persen_data')->first() ) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=24>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Ketepatan Waktu Penetapan Perdes RKP Desa Tahun {{ $tahun }}</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        25)->pluck('persen_data')->first() ) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=25>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Dokumen RAPBDes Tahun {{ $tahun }}</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">5</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        26)->pluck('persen_data')->first() ) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=26>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>BAC Pembahasan RAPBDes dengan BPD</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">5</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        27)->pluck('persen_data')->first() ) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=27>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Keputusan BPD tentang Persetujuan RAPBDes menjadi APBDes TA {{ $tahun }}</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">5</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        28)->pluck('persen_data')->first() ) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=28>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Hasil Evaluasi Camat atas Raperdes APBDes TA {{ $tahun }}</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">5</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        29)->pluck('persen_data')->first() ) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=29>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>


                <tr>
                    <td>11</td>
                    <td>Perdes dan Lampiran/Dokumen APBDes TA {{ $tahun }}</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        30)->pluck('persen_data')->first() ) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=30>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>Analisa, Gambar dan RAB Pembangunan Fisik (APBDes Murni TA {{ $tahun }})</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">5</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        31)->pluck('persen_data')->first() ) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=31>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>13</td>
                    <td>Ketepatan Waktu Penetapan Perdes APBDes TA {{ $tahun }}</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        32)->pluck('persen_data')->first() ) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=32>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>14</td>
                    <td>Perkades dan Lampiran/Dokumen Penjabaran (APBDes Murni TA {{ $tahun }})</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">5</td>
                    <td class="text-center" style="vertical-align: middle">{{
                        round($datnil->where('sub_indikator_pemerintahan_id',
                        33)->pluck('persen_data')->first() ) ?? 0 }}</td>

                    <td>
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=33>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="text-muted"><i>Petunjuk Penilaian : 0 jika data kosong, 100 jika data
                            lengkap, sah dan sesuai dengan ketentuan</i>
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
                            <label for="kesimpulan">Catatan Umum / Uraian Kesimpulan / Apresiasi :</label>
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