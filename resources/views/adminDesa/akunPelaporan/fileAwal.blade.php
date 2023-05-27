<form action="/adminDesa/tambahAkunpelaporan" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
    <input type="hidden" name="tahun" value="{{ $tahun }}">
    <table class="table table-bordered table-striped">
        <thead>
            <tr class="bg-info">
                <th width="5%">No</th>
                <th width="50%">Nama Data</th>
                <th width="45%">Upload Data/Dokumen</th>
            </tr>
        </thead>
        <tr>
            <th>1</th>
            <th>
                Laporan Realisasi APB Desa TA {{ $tahun }} Semester-1
                <input type="hidden" name="nama_data[]" value="lra_semester1">
            </th>
            <th>
                <div class="custom-file">
                    <input type="file" name="lra_semester1" class="custom-file-input" id="lra_semester1">
                    <label class="custom-file-label text-muted lra_semester1" for="lra_semester1"
                        style="font-size: .8rem">Choose
                        file PDF
                        (max-size: 5 MB)</label>
                </div>
            </th>
        </tr>
        <tr>
            <th>2</th>
            <th>
                Surat Penyampaian Laporan Realisasi APB Desa TA {{ $tahun }} Semester-1
                Kepada Camat
                <input type="hidden" name="nama_data[]" value="surat_lra">
            </th>
            <th>
                <div class="custom-file">
                    <input type="file" name="surat_lra" class="custom-file-input" id="surat_lra">
                    <label class="custom-file-label text-muted surat_lra" for="surat_lra"
                        style="font-size: .8rem">Choose
                        file PDF
                        (max-size: 1 MB)</label>
                </div>
            </th>
        </tr>
        <tr>
            <th>3</th>
            <th>
                Dokumen Laporan Keterangan Penyelenggaraan Pemerintahan Desa (LKPD)
                Tahun {{
                $tahun-1 }}
                <input type="hidden" name="nama_data[]" value="lkpd">
            </th>
            <th>
                <div class="custom-file">
                    <input type="file" name="lkpd" class="custom-file-input" id="lkpd">
                    <label class="custom-file-label text-muted lkpd" for="lkpd" style="font-size: .8rem">Choose
                        file PDF
                        (max-size: 10 MB)</label>
                </div>
            </th>
        </tr>
        <tr>
            <th>4</th>
            <th>
                Surat Penyampaian LKPD Tahun {{ $tahun-1 }} kepada BPD
                <input type="hidden" name="nama_data[]" value="surat_lkpd">
            </th>
            <th>

                <div class="custom-file">
                    <input type="file" name="surat_lkpd" class="custom-file-input" id="surat_lkpd">
                    <label class="custom-file-label text-muted surat_lkpd" for="surat_lkpd"
                        style="font-size: .8rem">Choose
                        file PDF
                        (max-size: 1 MB)</label>
                </div>

            </th>
        </tr>
        <tr>
            <th>5</th>
            <th>
                Peraturan Desa tentang Pertanggungjawaban APB Desa TA {{ $tahun-1 }}
                <input type="hidden" name="nama_data[]" value="perdes_pertanggungjawaban">
            </th>
            <th>

                <div class="custom-file">
                    <input type="file" name="perdes_pertanggungjawaban" class="custom-file-input"
                        id="perdes_pertanggungjawaban">
                    <label class="custom-file-label text-muted perdes_pertanggungjawaban"
                        for="perdes_pertanggungjawaban" style="font-size: .8rem">Choose
                        file PDF
                        (max-size: 5 MB)</label>
                </div>

            </th>
        </tr>
        <tr>
            <th>6</th>
            <th>
                Dokumen Laporan Penyelenggaraan Pemerintahan Desa (LPPD) Tahun {{
                $tahun-1 }}
                <input type="hidden" name="nama_data[]" value="dok_lppd">
            </th>
            <th>

                <div class="custom-file">
                    <input type="file" name="dok_lppd" class="custom-file-input" id="dok_lppd">
                    <label class="custom-file-label text-muted dok_lppd" for="dok_lppd" style="font-size: .8rem">Choose
                        file PDF
                        (max-size: 10 MB)</label>
                </div>

            </th>
        </tr>
        <tr>
            <th>7</th>
            <th>
                Surat Penyampaian LPPD Tahun {{ $tahun-1 }} kepada Camat
                <input type="hidden" name="nama_data[]" value="surat_lppd">
            </th>
            <th>

                <div class="custom-file">
                    <input type="file" name="surat_lppd" class="custom-file-input" id="surat_lppd">
                    <label class="custom-file-label text-muted surat_lppd" for="surat_lppd"
                        style="font-size: .8rem">Choose
                        file PDF
                        (max-size: 1 MB)</label>
                </div>

            </th>
        </tr>
    </table>
    </div>
    </div>
    <div class="ln_solid"></div>
    <div class="form-group row justify-content-center">
        <div class="col-md-5 col-sm-5">
            <button type="button" class="btn btn-primary">Cancel</button>
            <button type="reset" class="btn btn-primary">Reset</button>
            <button type="submit" class="btn btn-success">Kirim Data</button>
        </div>
    </div>
</form>