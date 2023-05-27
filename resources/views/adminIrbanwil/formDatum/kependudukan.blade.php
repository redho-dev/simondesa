<div class="row mb-0">
    <div class="col-md-8">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="6" class="bg-info">
                        Data Kependudukan Tahun {{ $tahun }}
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div class="row mt-0">
    <div class="col-md-4">
        <table class="table table-bordered">
            <tbody>
                <tr class="bg-secondary">
                    <th>Jenis Data</th>
                    <th>Isi Data</th>
                    <th>Satuan</th>
                </tr>
                <tr>
                    <th width='60%'>1. Jumlah penduduk
                        <input type="hidden" name="nama_data[]" value="jumlah_penduduk">
                    </th>
                    <th class="p-0 g-0 ">
                        <input type="number" class="form-control py-0 mt-0 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[0]->isidata }}" autofocus>
                    </th>
                    <th class="bg-light">Jiwa</th>


                </tr>
                <tr>
                    <th>2. Penduduk laki-laki
                        <input type="hidden" name="nama_data[]" value="jumlah_penduduk_l">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[1]->isidata }}">
                    </th>
                    <th class="bg-light">Orang</th>


                </tr>
                <tr>
                    <th>3. Penduduk Perempuan
                        <input type="hidden" name="nama_data[]" value="jumlah_penduduk_p">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[2]->isidata }}">
                    </th>
                    <th class="bg-light">Orang</th>

                </tr>
                <tr>
                    <th>4. Usia 0-15 tahun
                        <input type="hidden" name="nama_data[]" value="usia_0_15">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[3]->isidata }}">
                    </th>
                    <th class="bg-light">Orang</th>


                </tr>
                <tr>
                    <th>5. Usia 15-65 tahun
                        <input type="hidden" name="nama_data[]" value="usia_15_65">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[4]->isidata }}">
                    </th>
                    <th class="bg-light">Orang</th>
                </tr>
                <tr>
                    <th width='60%'>6. Usia > 65 tahun
                        <input type="hidden" name="nama_data[]" value="usia_65_keatas">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[5]->isidata }}">
                    </th>
                    <th class="bg-light">Orang</th>


                </tr>
                <tr>
                    <th>7. Jumlah Kepala Keluarga
                        <input type="hidden" name="nama_data[]" value="jumlah_kk">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[6]->isidata }}">
                    </th>
                    <th class="bg-light">KK</th>
                </tr>
                <tr>
                    <th>8. Jumlah Penduduk Miskin
                        <input type="hidden" name="nama_data[]" value="penduduk_miskin">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[7]->isidata }}">
                    </th>
                    <th class="bg-light">Jiwa</th>

                </tr>
                <tr>
                    <th>9. Jumlah KK Miskin
                        <input type="hidden" name="nama_data[]" value="kk_miskin">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[8]->isidata }}">
                    </th>
                    <th class="bg-light">KK</th>
                </tr>
                <tr>
                    <th>10. Jumlah Penerima Bansos
                        <input type="hidden" name="nama_data[]" value="penerima_bansos">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[9]->isidata }}">
                    </th>
                    <th class="bg-light">Orang</th>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="3" class="bg-secondary">
                        Data Penduduk Berdasarkan Pekerjaan
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th width="60%">1. TNI/POLRI
                        <input type="hidden" name="nama_data[]" value="tni_polri">
                    </th>
                    <th class="p-0 g-0 " width="30%">
                        <input type="number" class="form-control py-0 mt-0 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" autofocus value="{{ $daker[0]->isidata }}">
                    </th>
                    <th class="bg-light" width="10%">Orang</th>

                </tr>
                <tr>
                    <th width="60%">2. PNS/PPPK
                        <input type="hidden" name="nama_data[]" value="pns">
                    </th>
                    <th class="p-0 g-0 " width="30%">
                        <input type="number" class="form-control py-0 mt-0 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $daker[1]->isidata }}">
                    </th>
                    <th class="bg-light" width="10%">Orang</th>

                </tr>
                <tr>
                    <th>3. Karyawan/Pegawai Swasta
                        <input type="hidden" name="nama_data[]" value="karyawan">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $daker[2]->isidata }}">
                    </th>
                    <th class="bg-light">Orang</th>

                </tr>
                <tr>
                    <th>4. Petani
                        <input type="hidden" name="nama_data[]" value="petani">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $daker[3]->isidata }}">
                    </th>
                    <th class="bg-light">Orang</th>

                </tr>
                <tr>
                    <th>5. Buruh Tani
                        <input type="hidden" name="nama_data[]" value="buruh_tani">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $daker[4]->isidata }}">
                    </th>
                    <th class="bg-light">Orang</th>

                </tr>
                <tr>
                    <th>6. Buruh Perusahaan
                        <input type="hidden" name="nama_data[]" value="buruh_perusahaan">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $daker[5]->isidata }}">
                    </th>
                    <th class="bg-light">Orang</th>

                </tr>
                <tr>
                    <th>7. Pedagang/Jasa
                        <input type="hidden" name="nama_data[]" value="pedagang">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $daker[6]->isidata }}">
                    </th>
                    <th class="bg-light">Orang</th>

                </tr>
                <tr>
                    <th>8. Peternak
                        <input type="hidden" name="nama_data[]" value="peternak">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $daker[7]->isidata }}">
                    </th>
                    <th class="bg-light">Orang</th>

                </tr>
                <tr>
                    <th>9. Tukang / Kuli Bangunan
                        <input type="hidden" name="nama_data[]" value="kuli">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $daker[8]->isidata }}">
                    </th>
                    <th class="bg-light">Orang</th>

                </tr>
                <tr>
                    <th>10. Lainnya
                        <input type="hidden" name="nama_data[]" value="lainnya">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $daker[9]->isidata }}">
                    </th>
                    <th class="bg-light">Orang</th>

                </tr>
                <tr>
                    <th>11. Tidak bekerja / Pengangguran
                        <input type="hidden" name="nama_data[]" value="pengangguran">
                    </th>
                    <th class="p-0">
                        <input type="text" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $daker[10]->isidata }}">
                    </th>
                    <th class="bg-light">Orang</th>

                </tr>
            </tbody>

        </table>
    </div>
</div>