<div class="row ">
    <div class="col-md-8 mt-2">
        <p class="alert bg-warning text-dark" style="font-size: 1rem">Penilaian Indikator : Penatausahaan Pendapatan
        </p>
        <form action="/adminIrbanwil/nilaiAkunpendapatan" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="aspek_id" value=2>
            <input type="hidden" name="indikator_id" value=7>

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
                        <td>Pengajuan dan Penerimaan</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">70</td>
                        <td class="text-center" style="vertical-align: middle">{{ $datnilPengajuan->persen_data ?? 0 }}
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="sub_indikator_keuangan_id[]" value=1>
                            <input type="number" class="form-control text-center" style="font-size: .85rem"
                                name="nilai[]" autofocus required>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Buku Pembantu Bank</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">30</td>
                        <td class="text-center" style="vertical-align: middle">{{ $datnilBank->persen_data ?? 0 }}
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="sub_indikator_keuangan_id[]" value=2>
                            <input type="number" class="form-control text-center" name="nilai[]"
                                style="font-size: .85rem" required>
                        </td>
                    </tr>

                </tbody>

                <tr>
                    <td colspan="5" class="text-muted">
                        <p><i>Petunjuk Penilaian : <br>
                                1. Nilai 0 jika data kosong, 100 jika dokumen
                                pengajuan lengkap, tepat waktu dan mencapai 100% dari jumlah anggaran pendapatan <br>
                                2. Nilai 0 jika data kosong, 100 jika dokumen lengkap dan tgl penerimaan sesuai dengan
                                yang terinput di simondes
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