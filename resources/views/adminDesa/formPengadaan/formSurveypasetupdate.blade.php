<form action="/adminDesa/updateSurveyperalatan" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="asal_id" value=" {{ $infos->asal_id }}">
    <input type="hidden" name="tahun" value=" {{ $tahun }}">

    <div class="row">
        <div class="col-md-6">
            <p class="alert alert-info" style="font-size: .9rem">Form Update BAC / Keterangan Survey Harga
                Peralatan/Perlengkapan Kantor </p>
        </div>

    </div>
    <div class="row align-items-center">
        <div class="col-md-1">
            <a href="{{ asset('storage/'.$data[0]->file_data) }}" target="_blank"><img src="/img/logo-pdf.jpg"
                    width="50px"></a>
        </div>
        <div class="col-md-5 mt-2">
            <div class="form-group">
                <label for="kegiatan">Update Berita Acara / Surat Keterangan Survey Harga</label>
                <div class="custom-file">
                    <input type="hidden" name="nama_data" value="survey_peralatan">
                    <input type="hidden" name="old" value="{{ $data[0]->file_data }}">
                    <input type="hidden" name="id" value="{{ $data[0]->id }}">
                    <input type="file" name="survey_peralatan" class="custom-file-input survey_peralatan"
                        id="customFile">
                    <label class="custom-file-label label_survey_peralatan" for="customFile">Choose
                        file
                        PDF Max (1
                        MB)</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary mt-4">Kirim Data</button>
        </div>
    </div>
</form>