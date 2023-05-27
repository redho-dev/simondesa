<form action="/adminDesa/dokupdate" method="post" enctype="multipart/form-data"
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

    <div class="form-group row">

        <label class="control-label col-md-3 col-sm-3 py-0">Upload Dokumen RAPBDes
            <input type="hidden" name="nama_data[]" value="dokumen_rapbdes">

        </label>
        <div class="col-md-1">
            @if($data[0]->isi_data)
            <a href="{{ asset('storage/'.$data[0]->isi_data) }}" target="_blank">
                <img src="/img/logo-pdf.webp" width="75%">
            </a>
            <input type="hidden" name="old_0" value="{{ $data[0]->isi_data }}">
            @else
            <div class="text-danger">(data kosong)</div>
            @endif

        </div>
        <div class="col-md-3">

            @error('dokumen_rapbdes')
            <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="input-group">
                <div class="custom-file py-0">
                    <input type="file" name="dokumen_rapbdes" class="custom-file-input" id="dokumen_rapbdes">
                    <label class="custom-file-label text-muted dokumen_rapbdes" for="dokumen_rapbdes">Ganti file
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
        <div class="col-md-1">
            @if($data[1]->isi_data)
            <a href="{{ asset('storage/'.$data[1]->isi_data) }}" target="_blank">
                <img src="/img/logo-pdf.webp" width="75%">
            </a>
            <input type="hidden" name="old_1" value="{{ $data[1]->isi_data }}">
            @else
            <div class="text-danger">(data kosong)</div>
            @endif

        </div>
        <div class="col-md-3 ">
            <div class="input-group mb-3">
                <div class="custom-file py-0">
                    <input type="file" name="penyampaian" class="custom-file-input" id="penyampaian">
                    <label class="custom-file-label text-muted penyampaian" for="penyampaian">Ganti
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
        <div class="col-md-1">
            @if($data[2]->isi_data)
            <a href="{{ asset('storage/'.$data[2]->isi_data) }}" target="_blank">
                <img src="/img/logo-pdf.webp" width="75%">
            </a>
            <input type="hidden" name="old_2" value="{{ $data[2]->isi_data }}">
            @else
            <div class="text-danger">(data kosong)</div>
            @endif

        </div>
        <div class="col-md-3 ">
            <div class="input-group mb-3">
                <div class="custom-file py-0">
                    <input type="file" name="bac" class="custom-file-input" id="bac">
                    <label class="custom-file-label text-muted bac" for="bac">Ganti
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

        <div class="col-md-1">
            @if($data[3]->isi_data)
            <a href="{{ asset('storage/'.$data[3]->isi_data) }}" target="_blank">
                <img src="{{ asset('storage/'.$data[3]->isi_data) }}" width="100%">
            </a>
            <input type="hidden" name="old_3" value="{{ $data[3]->isi_data }}">
            @else
            <div class="text-danger">(data kosong)</div>
            @endif

        </div>
        <div class="col-md-3 ">
            @error('foto_musdes')
            <small class="text-danger">{{ $message }}</small>
            @enderror
            <div class="input-group mb-3">
                <div class="custom-file py-0">
                    <input type="file" name="foto_musdes" class="custom-file-input" id="foto_musdes">
                    <label class="custom-file-label text-muted foto_musdes" for="foto_musdes">Ganti
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
        <div class="col-md-1">
            @if($data[4]->isi_data)
            <a href="{{ asset('storage/'.$data[4]->isi_data) }}" target="_blank">
                <img src="/img/logo-pdf.webp" width="75%">
            </a>
            <input type="hidden" name="old_4" value="{{ $data[4]->isi_data }}">
            @else
            <div class="text-danger">(data kosong)</div>
            @endif
        </div>
        <div class="col-md-3">
            <div class="input-group mb-3">
                <div class="custom-file py-0">
                    <input type="file" name="keputusan_bpd" class="custom-file-input" id="keputusan_bpd">
                    <label class="custom-file-label text-muted keputusan_bpd" for="keputusan_bpd">Ganti
                        file PDF
                        (max-size: 1MB)</label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 py-0">Upload SK Camat tentang Hasil Evaluasi APBDes</label>
        <input type="hidden" name="nama_data[]" value="evaluasi">
        <div class="col-md-1">
            @if($data[5]->isi_data)
            <a href="{{ asset('storage/'.$data[5]->isi_data) }}" target="_blank">
                <img src="/img/logo-pdf.webp" width="75%">
            </a>
            <input type="hidden" name="old_5" value="{{ $data[5]->isi_data }}">
            @else
            <div class="text-danger">(data kosong)</div>
            @endif
        </div>
        <div class="col-md-3">
            <div class="input-group mb-3">
                <div class="custom-file py-0">
                    <input type="file" name="evaluasi" class="custom-file-input" id="evaluasi">
                    <label class="custom-file-label text-muted evaluasi" for="evaluasi">Ganti
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
                    <input type="text" class="form-control angka" name="pendapatan_rapbdes"
                        value="{{ $data[6]->isi_data }}"></input>

                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-md-2 ">Total Belanja</label>
                <input type="hidden" name="nama_data[]" value="belanja_rapbdes">
                <div class="col-md-5 d-inline-flex ">
                    <span class="input-group-text border-right-0"
                        style="font-size: .85rem; border-radius: 0;">Rp.</span>
                    <input type="text" class="form-control angka" name="belanja_rapbdes"
                        value="{{ $data[7]->isi_data }}"></input>

                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-md-2 ">Total
                    Pembiayaan</label>
                <input type="hidden" name="nama_data[]" value="pembiayaan_rapbdes">
                <div class="col-md-5 d-inline-flex ">
                    <span class="input-group-text border-right-0"
                        style="font-size: .85rem; border-radius: 0;">Rp.</span>
                    <input type="text" class="form-control angka" name="pembiayaan_rapbdes"
                        value="{{ $data[8]->isi_data }}"></input>

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
                    style="font-size: .85rem; border-radius: 0;" value="{{ $data[9]->isi_data }}">
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
                    style="font-size: .85rem; border-radius: 0;" value="{{ $data[10]->isi_data }}">
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
            <button type="submit" class="btn btn-success">Update Data</button>
        </div>
    </div>

</form>
<br><br><br><br><br><br>