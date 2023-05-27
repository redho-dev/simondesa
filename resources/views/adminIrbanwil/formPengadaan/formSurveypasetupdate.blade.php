<form action="/adminIrbanwil/nilaiSurveyPeralatan" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="asal_id" value=" {{ $asal_id }}">
    <input type="hidden" name="tahun" value=" {{ $tahun }}">

    <div class="row">
        <div class="col-md-8">
            <p class="alert alert-info" style="font-size: .9rem">Penilaian Sub Indikator Hasil Survey Harga
                Peralatan/Mesin </p>
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
                        <td>Berita Acara / Surat Keterangan Hasil Survey Harga Peralatan/Mesin
                            {{ $tahun }}</td>
                        <td class="text-center">
                            @if($data->count())
                            <a href="{{ asset('storage/'.$data[0]->file_data) }}" target="_blank"><img
                                    src="/img/logo-pdf.jpg" width="50px"></a>
                            @else
                            <p class="text-danger">kosong</p>
                            @endif
                        </td>
                        <td class="text-center">
                            <input type="number" class="form-control text-center" name="nilai_survey"
                                value="{{ $nilaiSurvey->nilai_sementara ?? '' }}" required>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-primary">
                            Petunjuk penilaian :</br>
                            1. Nilai 0 jika BAC hasil survey tidak ada
                            </br>
                            2. Nilai 100 jika hasil survey ada, valid dan memadai dan digunakan untuk dasar penganggaran
                            tahun {{ $tahun }} </br>
                        </td>
                        <td class="text-center">
                            @if($nilaiSurvey && $nilaiSurvey->nilai_sementara >= 0)
                            <button class="btn btn-info btn-sm">Update Nilai</button>
                            @else
                            <button class="btn btn-primary btn-sm">Kirim Nilai</button>
                            @endif

                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</form>