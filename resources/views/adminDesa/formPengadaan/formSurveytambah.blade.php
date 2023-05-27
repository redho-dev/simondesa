<form action="/adminDesa/tambahSurveymaterial" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="asal_id" value=" {{ $infos->asal_id }}">
    <input type="hidden" name="tahun" value=" {{ $tahun }}">

    <div class="row">
        <div class="col-md-6">
            <p class="alert alert-info" style="font-size: .9rem">Form Input BAC / Keterangan Survey Harga Material
                Pembangunan Fisik </p>
        </div>

    </div>
    <div class="row align-items-center">
        <div class="col-md-6 mt-2">
            <div class="form-group">
                <label for="kegiatan">Upload Berita Acara / Surat Keterangan Survey Harga</label>
                <div class="custom-file">
                    <input type="hidden" name="nama_data" value="survey_material">
                    <input type="file" name="survey_material" class="custom-file-input survey_material" id="customFile"
                        required>
                    <label class="custom-file-label label_survey_material" for="customFile">Choose
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