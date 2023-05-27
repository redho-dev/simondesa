<form action="/adminDesa/doktambah" method="post" enctype="multipart/form-data"
    class="form-horizontal form-label-left mb-4">
    @csrf

    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
    <input type="hidden" name="tahun" value="{{ $tahun }}">
    <input type="hidden" name="jenis" value="{{ $jenis }}">
    <div class="form-group row">
        <div class="col-md-7">
            <h6 class="alert alert-primary">Form Input Data RAPBDes Tahun Anggaran {{ $tahun }} </h6>
        </div>
    </div>
    <style>
        label {
            overflow: hidden;
        }
    </style>
    <div class="form-group row">

        <label class="control-label col-md-3 col-sm-3 py-0">Upload Dokumen RAPBDes
            <input type="hidden" name="nama_data[]" value="dokumen_rapbdes">

        </label>
        <div class="col-md-4 col-sm-5 ">

            @error('dokumen_rapbdes')
            <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="input-group">
                <div class="custom-file py-0">
                    <input type="file" name="dokumen_rapbdes" class="custom-file-input" id="dokumen_rapbdes" required>
                    <label class="custom-file-label text-muted dokumen_rapbdes" for="dokumen_rapbdes">Choose
                        file PDF
                        (max-size: 20MB)</label>
                </div>
            </div>


        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 py-0">Surat Penyampaian RAPBDes kepada BPD
        </label>
        <input type="hidden" name="nama_data[]" value="penyampaian">
        <div class="col-md-4 col-sm-5 ">
            <div class="input-group mb-3">
                <div class="custom-file py-0">
                    <input type="file" name="penyampaian" class="custom-file-input" id="penyampaian">
                    <label class="custom-file-label text-muted penyampaian" for="penyampaian">Choose
                        file PDF
                        (max-size: 1MB)</label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 py-0">Upload BAC dan Daftar Hadir
            Musdes Pembahasan RAPBDes</label>
        <input type="hidden" name="nama_data[]" value="bac">
        <div class="col-md-4 col-sm-5 ">
            <div class="input-group mb-3">
                <div class="custom-file py-0">
                    <input type="file" name="bac" class="custom-file-input" id="bac">
                    <label class="custom-file-label text-muted bac" for="bac">Choose
                        file PDF
                        (max-size: 1MB)</label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 py-0">Upload dokumentasi/foto
            Musdes RAPBDes</label>
        <input type="hidden" name="nama_data[]" value="foto_musdes">
        <div class="col-md-4 col-sm-5 ">
            @error('foto_musdes')
            <small class="text-danger">{{ $message }}</small>
            @enderror
            <div class="input-group mb-3">
                <div class="custom-file py-0">
                    <input type="file" name="foto_musdes" class="custom-file-input" id="foto_musdes">
                    <label class="custom-file-label text-muted foto_musdes" for="foto_musdes">Choose
                        file Image
                        (max-size: 1MB)</label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 py-0">Upload Keputusan BPD tentang Persetujuan RAPBDes Menjadi
            APBDes</label>
        <input type="hidden" name="nama_data[]" value="keputusan_bpd">
        <div class="col-md-4 col-sm-5 ">
            <div class="input-group mb-3">
                <div class="custom-file py-0">
                    <input type="file" name="keputusan_bpd" class="custom-file-input" id="keputusan_bpd">
                    <label class="custom-file-label text-muted keputusan_bpd" for="keputusan_bpd">Choose
                        file PDF
                        (max-size: 1MB)</label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 py-0">Upload SK Camat tentang Hasil Evaluasi APBDes</label>
        <input type="hidden" name="nama_data[]" value="evaluasi">
        <div class="col-md-4 col-sm-5 ">
            <div class="input-group mb-3">
                <div class="custom-file py-0">
                    <input type="file" name="evaluasi" class="custom-file-input" id="evaluasi">
                    <label class="custom-file-label text-muted evaluasi" for="evaluasi">Choose
                        file PDF
                        (max-size: 1MB)</label>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">

        <div class="col-md-8 ">
            <p>Jumlah Anggaran dalam RAPBDes TA {{ $tahun }} : </p>
            <div class="form-group row">
                <label class="control-label col-md-2 ">Total Pendapatan</label>
                <input type="hidden" name="nama_data[]" value="pendapatan_rapbdes">
                <div class="col-md-5 d-inline-flex ">
                    <span class="input-group-text border-right-0"
                        style="font-size: .85rem; border-radius: 0;">Rp.</span>
                    <input type="text" class="form-control angka" name="pendapatan_rapbdes"></input>

                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-md-2 ">Total Belanja</label>
                <input type="hidden" name="nama_data[]" value="belanja_rapbdes">
                <div class="col-md-5 d-inline-flex ">
                    <span class="input-group-text border-right-0"
                        style="font-size: .85rem; border-radius: 0;">Rp.</span>
                    <input type="text" class="form-control angka" name="belanja_rapbdes"></input>

                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-md-2 ">Total
                    Pembiayaan</label>
                <input type="hidden" name="nama_data[]" value="pembiayaan_rapbdes">
                <div class="col-md-5 d-inline-flex ">
                    <span class="input-group-text border-right-0"
                        style="font-size: .85rem; border-radius: 0;">Rp.</span>
                    <input type="text" class="form-control angka" name="pembiayaan_rapbdes"></input>

                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3">
            Jumlah Total Kegiatan dalam RAPBDes TA {{ $tahun }}
            <input type="hidden" name="nama_data[]" value="jumlah_total_kegiatan">
        </div>
        <div class="col-md-2">
            <div class="input-group ">
                <input type="number" name="jumlah_total_kegiatan" class="form-control"
                    style="font-size: .85rem; border-radius: 0;">
                <div class="input-group-append">
                    <span class="input-group-text" style="font-size: .85rem; border-radius: 0;">kegiatan</span>
                </div>
            </div>
        </div>


    </div>
    <div class="form-group row">
        <div class="col-md-3">
            Jumlah Rencana Kegiatan Pembangunan Fisik/Infrastruktur
            <input type="hidden" name="nama_data[]" value="jumlah_kegiatan_fisik">

        </div>
        <div class="col-md-2">
            <div class="input-group ">
                <input type="number" name="jumlah_kegiatan_fisik" class="form-control"
                    style="font-size: .85rem; border-radius: 0;">
                <div class="input-group-append">
                    <span class="input-group-text" style="font-size: .85rem; border-radius: 0;">kegiatan</span>
                </div>
            </div>
        </div>
    </div>


    </div>
    </div>

    <div class="ln_solid"></div>
    <div class="form-group mb-4">
        <div class="col-md-5 col-sm-5  offset-md-2">
            <button type="button" class="btn btn-primary">Cancel</button>
            <button type="reset" class="btn btn-primary">Reset</button>
            <button type="submit" class="btn btn-success">Kirim Data</button>
        </div>
    </div>

</form>
<br><br><br><br><br><br>