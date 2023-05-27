<form action="/adminDesa/updateRpjmd" method="post" enctype="multipart/form-data"
    class="form-horizontal form-label-left">
    @csrf

    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
    <input type="hidden" name="tahun" value="{{ $tahun }}">
    <input type="hidden" name="jenis" value="{{ $jenis }}">

    <div class="form-group row">
        <label class="control-label col-md-2 col-sm-2 ">Perdes RPJMDes</label>

        <div class="col-md-5 col-sm-5 ">
            <span class="input-group-text" style="font-size: .85rem; border-radius: 0;">Nomor
                : <input type="text" class="form-control ml-2" name="isidata[]" value="{{ $data[0]->uraian }}"
                    style="font-size: .85rem"></span>
            <input type="hidden" name="nama_data[]" value="nomor_rpjmd">

        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2 col-sm-2 ">Tanggal Penetapan Perdes </label>

        <div class="col-md-5 col-sm-5 ">
            <input type="text" class="form-control " name="isidata[]" style="font-size: .85rem"
                data-inputmask="'mask': '99/99/9999'" value="{{ $data[1]->uraian }}">
            <input type="hidden" name="nama_data[]" value="tanggal_penetapan_rpjmd">

        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2 col-sm-2 ">Masa Berlaku </label>

        <div class="col-md-3 col-sm-3 ">
            <span class="input-group-text" style="font-size: .85rem; border-radius: 0;">dari tahun
                : <input type="text" class="form-control ml-2" name="sejak" style="font-size: .85rem"
                    data-inputmask="'mask': '9999'" value="{{ $data[2]->sejak }}"></span>
            <input type="hidden" name="isidata[]" value="">
            <input type="hidden" name="nama_data[]" value="sejak">

        </div>
        <div class="col-md-2 col-sm-2 ">
            <span class="input-group-text" style="font-size: .85rem; border-radius: 0;">s.d
                : <input type="text" class="form-control ml-2" name="sampai" style="font-size: .85rem"
                    data-inputmask="'mask': '9999'" value="{{ $data[3]->sampai }}"></span>
            <input type="hidden" name="isidata[]" value="">
            <input type="hidden" name="nama_data[]" value="sampai">

        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2 col-sm-2 ">File Dokumen RPJMDes</label>
        <input type="hidden" name="nama_data[]" value="dokumen_rpjmd">
        <input type="hidden" name="isidata[]" value="">
        <div class="col-md-5 col-sm-5 ">
            <div class="row">
                <div class="col-md-3">
                    @if($data[4]->file_data)
                    <a href="{{ asset('storage/'.$data[4]->file_data) }}" target="_blank">
                        <img src="/img/logo-pdf.webp" width="100%">
                        <input type="hidden" name="old_1" value="{{ $data[4]->file_data }}">
                    </a>
                    @else
                    <div class="text-danger">(data kosong)</div>
                    @endif

                </div>
                <div class="col-md-9">
                    @error('dokumen_rpjmd')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" name="dokumen_rpjmd" class="custom-file-input" id="dokumen_rpjmd">
                            <label class="custom-file-label text-muted dokumen_rpjmd" for="dokumen_rpjmd">Ganti
                                file PDF
                                (max-size: 30MB)</label>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    </div>
    </div>

    <div class="ln_solid"></div>
    <div class="form-group ">
        <div class="col-md-5 col-sm-5  offset-md-2">
            <button type="button" class="btn btn-primary">Cancel</button>
            <button type="reset" class="btn btn-primary">Reset</button>
            <button type="submit" class="btn btn-success">Update Data</button>
        </div>
    </div>

</form>