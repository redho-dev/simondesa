<form action="/adminDesa/tambahBPP" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="asal_id" value=" {{ $infos->asal_id }}">
    <input type="hidden" name="tahun" value=" {{ $tahun }}">

    <div class="row">
        <div class="col-md-6">
            <p class="alert alert-info" style="font-size: .9rem">Form Upload Buku Pembantu Pajak (Print Out Siskeudes)
                TA {{ $tahun }} </p>
        </div>

    </div>
    <div class="row align-items-center">
        <div class="col-md-6 mt-2">
            <div class="form-group">
                <label for="kegiatan">Upload BPP (per 31 Desember Tahun {{ $tahun }})</label>
                <div class="custom-file">
                    <input type="hidden" name="nama_data" value="buku_pembantu_pajak">
                    <input type="file" name="buku_pembantu_pajak" class="custom-file-input buku_pembantu_pajak"
                        id="customFile" required>
                    <label class="custom-file-label label_buku_pembantu_pajak" for="customFile">Choose
                        file
                        PDF Max (5
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