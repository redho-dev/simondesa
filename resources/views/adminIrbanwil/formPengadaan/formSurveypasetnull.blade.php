<form action="/adminIrbanwil/nilaiSurveyPeralatanNull" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="asal_id" value=" {{ $asal_id }}">
    <input type="hidden" name="tahun" value=" {{ $tahun }}">

    <div class="row">
        <div class="col-md-8">
            <p class="alert alert-info" style="font-size: .9rem">Penilaian Sub Indikator Hasil Survey Harga
                Peralatan/Perlengkapan Kantor </p>
        </div>

    </div>

    <div class="row">
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th width="55%" class="text-center">Nama Data</th>
                        <th width="20%" class="text-center">File Data</th>
                        <th width="20%" class="text-center">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>Berita Acara / Surat Keterangan Hasil Survey Harga Peralatan/Perlengkapan Kantor
                            {{ $tahun }}</td>
                        <td class="text-center">
                            <p class="text-danger">kosong</p>
                        </td>
                        <td class="text-center">
                            <input type="number" class="form-control text-center" name="nilai_survey" required>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-primary">
                            Petunjuk penilaian :</br>
                            1. Nilai 0 jika ada anggaran kegiatan pengadaan aset kantor namun hasil survey tidak ada
                            </br>
                            2. Nilai 100 jika hasil survey ada, valid dan memadai dan digunakan untuk dasar penganggaran
                            tahun {{ $tahun }} </br>
                            3. Nilai 100 jika anggaran kegiatan tidak tersedia di Tahun Anggaran {{ $tahun }}
                        </td>
                        <td class="text-center">

                            <button class="btn btn-primary btn-sm">Kirim Nilai</button>



                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</form>