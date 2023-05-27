<div class="row ">
    <div class="col-md-8 mt-2">
        <p class="alert bg-warning text-dark" style="font-size: 1rem">Penilaian Indikator : Administrasi Umum
            Tahun {{ $tahun }}
        </p>
        <form action="/adminIrbanwil/nilaiAkunadum" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="aspek_id" value=1>
            <input type="hidden" name="indikator_id" value=5>

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
                    <td>Buku Surat Masuk/Keluar</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">20</td>
                    <td class="text-center" style="vertical-align: middle">{{ round($datnil[0]->persen_data ?? 0) }}
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=34>
                        <input type="number" class="form-control text-center" style="font-size: .85rem" name="nilai[]"
                            autofocus required>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Rekap Bulanan Daftar hadir Perangkat Semester-1</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">15</td>
                    <td class="text-center" style="vertical-align: middle">{{ round($datnil[1]->persen_data ?? 0) }}
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=35>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Rekap Bulanan Daftar hadir Perangkat Semester-2</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">15</td>
                    <td class="text-center" style="vertical-align: middle">{{ round($datnil[2]->persen_data ?? 0) }}
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=36>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Buku Register Perdes/Perkades/SK</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">25</td>
                    <td class="text-center" style="vertical-align: middle">{{ round($datnil[3]->persen_data ?? 0) }}
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=37>
                        <input type="number" class="form-control text-center" name="nilai[]" style="font-size: .85rem"
                            required>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Buku Rekap Kependudukan</td>
                    <td class="text-center bg-secondary" style="vertical-align: middle">25</td>
                    <td class="text-center" style="vertical-align: middle">{{ round($datnil[4]->persen_data ?? 0) }}
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=38>
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
                            <label for="saran">Saran Perbaikan Kedepan : </label>
                            <input type="hidden" name="rekom_sementara" id="saran">
                            <trix-editor input="saran" class="bg-white">{!! $catatan->rekom_sementara ?? '' !!}
                            </trix-editor>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right">
                        <button type="submit" class="btn btn-primary" id="kirimNilai">Kirim Nilai</button>
                    </td>
                </tr>


            </table>
        </form>
    </div>

</div>