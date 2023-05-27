<div class="row ">
    <div class="col-md-8 mt-2">

        <form action="/adminIrbanwil/nilaiBumdesTambah" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">

            <table class="table table-bordered">
                <thead>
                    <tr class="bg-info">
                        <th width="5%" style="vertical-align: middle">No</th>
                        <th width="55%" style="vertical-align: middle">Sub Indikator</th>
                        <th width="10%" class="text-center" style="vertical-align: middle">Bobot <br>(%)</th>
                        <th width="15%" class="text-center">Jumlah<br>Data</th>
                        <th width="15%" class="text-center" style="vertical-align: middle">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Badan Hukum BUM Desa</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">30</td>
                        <td class="text-center" style="vertical-align: middle">{{ $dasarHukum }} dokumen
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="bobot[]" value=30>
                            <input type="hidden" name="jumlah_data[]" value={{ $dasarHukum }}>
                            <input type="number" class="form-control text-center" style="font-size: .85rem"
                                name="nilai[]" autofocus required>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Perdes Pembentukan BUM Desa dan AD/ART</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                        <td class="text-center" style="vertical-align: middle">{{ $perdesPembentukan }} dokumen
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="bobot[]" value=10>
                            <input type="hidden" name="jumlah_data[]" value={{ $perdesPembentukan }}>
                            <input type="number" class="form-control text-center" name="nilai[]"
                                style="font-size: .85rem" required>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Perdes Penyertaan Modal</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                        <td class="text-center" style="vertical-align: middle">{{ $perdesModal }} dokumen
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="bobot[]" value=10>
                            <input type="hidden" name="jumlah_data[]" value={{ $perdesModal }}>
                            <input type="number" class="form-control text-center" name="nilai[]"
                                style="font-size: .85rem" required>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>SK Kepengurusan</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                        <td class="text-center" style="vertical-align: middle">{{ $skPengurus }} dokumen
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="bobot[]" value=10>
                            <input type="hidden" name="jumlah_data[]" value={{ $skPengurus }}>
                            <input type="number" class="form-control text-center" name="nilai[]"
                                style="font-size: .85rem" required>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Proposal Pengajuan Modal</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                        <td class="text-center" style="vertical-align: middle">{{ $proposal }} dokumen
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="bobot[]" value=10>
                            <input type="hidden" name="jumlah_data[]" value={{ $proposal }}>
                            <input type="number" class="form-control text-center" name="nilai[]"
                                style="font-size: .85rem" required>
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Laporan Keuangan BUM Desa</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">15</td>
                        <td class="text-center" style="vertical-align: middle">{{ $laporan }} dokumen
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="bobot[]" value=15>
                            <input type="hidden" name="jumlah_data[]" value={{ $laporan }}>
                            <input type="number" class="form-control text-center" name="nilai[]"
                                style="font-size: .85rem" required>
                        </td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Kontribusi PADes</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">15</td>
                        <td class="text-center" style="vertical-align: middle">{{ $pad }} dokumen
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="bobot[]" value=15>
                            <input type="hidden" name="jumlah_data[]" value={{ $pad }}>
                            <input type="number" class="form-control text-center" name="nilai[]"
                                style="font-size: .85rem" required>
                        </td>
                    </tr>


                </tbody>

                <tr>
                    <td colspan="5" class="text-muted">
                        <p class="mb-0">Petunjuk Penilaian :</p>
                        <ul>
                            <li>
                                Nilai 0 jika tidak ada data, nilai 100 jika data lengkap dan sesuai
                            </li>
                        </ul>
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