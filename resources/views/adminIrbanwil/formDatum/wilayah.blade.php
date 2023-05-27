<div class="row mb-4 ">
    <div class="col-md-7">
        {{-- <a href="/cetak_wilayah" target="_blank" class="btn btn-primary">cetak</a> --}}
        <table class="table table-striped table-bordered" style=" font-size: .8rem">
            <thead>
                <tr class="bg-info">
                    <td colspan="3">Data Umum Kewilayahan Tahun {{ $tahun }}</td>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-secondary">
                    <td>No</td>
                    <td>Uraian Data</td>
                    <td>Isi Data</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>
                        Dasar Hukum Pembentukan
                        Desa
                    </td>
                    <td>
                        {{ $data[0]->isidata }}
                    </td>

                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        Luas Wilayah
                    </td>
                    <td>
                        {{ $data[1]->isidata }} Ha
                    </td>

                </tr>
                <tr>
                    <td>3</td>
                    <td>
                        Sebelah Utara
                        berbatasan
                        dengan
                    </td>
                    <td>
                        {{ $data[2]->isidata }}
                    </td>

                </tr>
                <tr>
                    <td>4</td>
                    <td>
                        Sebelah Selatan
                        berbatasan dengan
                    </td>
                    <td>
                        {{ $data[3]->isidata }}
                    </td>

                </tr>
                <tr>
                    <td>5</td>
                    <td>
                        Sebelah Barat
                        berbatasan
                        dengan

                    </td>
                    <td>
                        {{ $data[4]->isidata }}
                    </td>

                </tr>
                <tr>
                    <td>6</td>
                    <td>
                        Sebelah Timur
                        berbatasan
                        dengan
                    </td>
                    <td>
                        {{ $data[5]->isidata }}

                    </td>

                </tr>
                <tr>
                    <td>7</td>
                    <td>
                        Jumlah Dusun
                    </td>
                    <td>
                        {{ $data[6]->isidata }}
                    </td>

                </tr>
                <tr>
                    <td>8</td>
                    <td>
                        Jumlah RT
                    </td>
                    <td>
                        {{ $data[7]->isidata }}
                    </td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>
                        Jarak Kantor Desa dari
                        Kantor
                        Kecamatan
                    </td>
                    <td>
                        {{ $data[8]->isidata }} Km
                    </td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>
                        Jarak Kantor Desa dari
                        Kantor
                        Pemerintah Kabupaten
                    </td>
                    <td>
                        {{ $data[9]->isidata }} Km

                    </td>
                </tr>




            </tbody>
        </table>

    </div>
</div>