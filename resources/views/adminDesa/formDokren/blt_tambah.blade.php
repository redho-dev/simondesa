<form action="/adminDesa/tambahBlt" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
    @csrf

    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
    <input type="hidden" name="tahun" value="{{ $tahun }}">
    <input type="hidden" name="nama_dokren" value="{{ $nama_dokren }}">

    <div class="row">
        <div class="col-md-8">
            <p class="alert alert-primary">Input Data BLT DD Tahun {{ $tahun }}
            </p>
            <table class="table table-bordered">
                <tr>
                    <td>Jumlah Penerima BLT DD Tahun Anggaran {{ $tahun }}</td>
                    <td>
                        <div class="input-group ">
                            <input type="hidden" name="nama_data[]" value="jumlah_penerima_blt_{{ $tahun }}">
                            <input type="number" name="isidata[]" class="form-control"
                                style="font-size: .85rem; border-radius: 0;" required>
                            <div class="input-group-append">
                                <span class="input-group-text" style="font-size: .85rem; border-radius: 0;">KPM</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Jumlah bantuan yang dianggarkan per KPM / bulan</td>

                    <td>
                        <div class="input-group ">
                            <input type="hidden" name="nama_data[]" value="jumlah_dana_perkpm_{{ $tahun }}">
                            <input type="text" name="isidata[]" class="form-control angka"
                                style="font-size: .85rem; border-radius: 0;" required>
                            <div class="input-group-append">
                                <span class="input-group-text"
                                    style="font-size: .85rem; border-radius: 0;">Rupiah</span>
                            </div>
                        </div>
                    </td>
                    </td>
                </tr>
                <tr>
                    <th>Berita Acara Musdes Khusus BLT DD untuk Tahun {{ $tahun }}</th>
                    <th>
                        <div class="input-group ">
                            <div class="custom-file">
                                <input type="hidden" name="nama_data[]" value="bac_musdes_blt_{{ $tahun }}">
                                <input type="hidden" name="isidata[]" value="">
                                <input type="file" name="bac_musdes_blt" class="custom-file-input" id="bac_blt"
                                    required>
                                <label class="custom-file-label text-muted bac_blt" for="dokumen_rkpdes">Choose
                                    file PDF
                                    (max-size: 1MB)</label>
                            </div>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td>SK Camat tentang Penetapan BLT DD Tahun {{ $tahun }}</td>
                    <td>
                        <div class="input-group ">
                            <div class="custom-file">
                                <input type="hidden" name="nama_data[]" value="sk_camat_blt_{{ $tahun }}">
                                <input type="hidden" name="isidata[]" value="">
                                <input type="file" name="sk_camat_blt" class="custom-file-input" id="sk_camat_blt"
                                    required>
                                <label class="custom-file-label text-muted sk_camat_blt" for="sk_camat_blt">Choose
                                    file PDF
                                    (max-size: 1MB)</label>
                            </div>
                        </div>
                    </td>
                </tr>

            </table>

        </div>
    </div>


    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-5 col-sm-5  offset-md-2">
            <button type="button" class="btn btn-primary">Cancel</button>
            <button type="reset" class="btn btn-primary">Reset</button>
            <button type="submit" class="btn btn-success">Kirim Data</button>
        </div>
    </div>

</form>