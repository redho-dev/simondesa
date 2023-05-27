<div class="row ">
    <div class="col-md-8 mt-2">
        <p class="alert bg-warning text-dark" style="font-size: 1rem">Penilaian Indikator : Kemandirian Tata Kelola
        </p>
        <form action="/adminIrbanwil/nilaiAkunKemandirian" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="aspek_id" value=2>
            <input type="hidden" name="indikator_id" value=13>

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
                    <tr>
                        <td>1</td>
                        <td>Surat Pernyataan Kepala Desa</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">25</td>
                        <td class="text-center" style="vertical-align: middle">{{ $datnilPernyataan->persen_data ?? 0 }}
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="sub_indikator_keuangan_id[]" value=20>
                            <input type="number" class="form-control text-center" style="font-size: .85rem"
                                name="nilai[]" autofocus required>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Sertifikat Siskeudes Perangkat Desa</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">50</td>
                        <td class="text-center" style="vertical-align: middle">{{ $datnilSertifikat->persen_data ?? 0 }}
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="sub_indikator_keuangan_id[]" value=21>
                            <input type="number" class="form-control text-center" name="nilai[]"
                                style="font-size: .85rem" required>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Hasil Uji Penguasaan Siskeudes</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">25</td>
                        <td class="text-center" style="vertical-align: middle">{{ $hasil ? '100.00' : 0 }}
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="sub_indikator_keuangan_id[]" value=23>
                            <input type="number" class="form-control text-center" name="nilai[]"
                                style="font-size: .85rem" value="{{ $hasil->data ?? 0 }}" required readonly>
                        </td>
                    </tr>

                </tbody>

                <tr>
                    <td colspan="5" class="text-muted">
                        <p><i>Petunjuk Penilaian : <br>
                                1. Nilai 0 jika data kosong, 100 jika data terisi dan sesuai <br>
                                2. Nilai 0 jika data kosong, 100 jika sertifikat valid dan atas nama perangkat desa <br>
                                3. Nilai terisi otomatis sesuai hasil pengujian
                            </i></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" style="background-color: beige">
                        KESIMPULAN : (TERISI OTOMATIS SESUAI SKORING YANG DIBERIKAN)
                    </td>
                </tr>
                <tr>
                    <td colspan="5" style="background-color: beige">
                        <div class="form-group">
                            <label for="uraian">Catatan / Saran / Uraian Kesimpulan / Apresiasi </label>
                            <input type="hidden" name="uraian" id="uraian" autofocus>
                            <trix-editor input="uraian" class="bg-white">
                            </trix-editor>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="bg-info">
                        <div class="form-group">
                            <label for="kesimpulan">Temuan : </label>
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
                            <label for="saran">Rekomendasi Tindak Lanjut:</label>
                            <input type="hidden" name="rekom_sementara" id="saran">
                            <trix-editor input="saran" class="bg-white">{!! $catatan->rekom_sementara ?? '' !!}
                            </trix-editor>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right">
                        <button type="submit" class="btn btn-primary">KIRIM</button>
                    </td>
                </tr>


            </table>
        </form>
    </div>

</div>