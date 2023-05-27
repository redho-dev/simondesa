<form action="/adminDesa/updateBlt" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
    @csrf

    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
    <input type="hidden" name="tahun" value="{{ $tahun }}">
    <input type="hidden" name="nama_dokren" value="{{ $nama_dokren }}">

    <div class="row">
        <div class="col-md-8">
            <p class="alert alert-primary">Form Edit Data BLT DD Tahun {{ $tahun }}
            </p>
            <table class="table table-bordered">
                <tr>
                    <td>Jumlah Penerima BLT DD Tahun Anggaran {{ $tahun }}</td>
                    <td>
                        <div class="input-group ">
                            <input type="hidden" name="nama_data[]" value="jumlah_penerima_blt_{{ $tahun }}">
                            <input type="number" name="isidata[]" class="form-control"
                                style="font-size: .85rem; border-radius: 0;" value="{{$data[0]->isidata}}" required>
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
                            <input type="text" name="isidata[]" value="{{$data[1]->isidata}}"
                                class="form-control nominal" style="font-size: .85rem; border-radius: 0;" required>
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
                    <th class="d-flex">
                        <div class="mr-1">
                            @if($data[2]->isidata)
                            <a href="{{ asset('storage/'.$data[2]->isidata) }}" target="_blank">
                                <img src="/img/logo-pdf.webp" width="50px">
                                <input type="hidden" name="old_1" value="{{ $data[2]->isidata }}">
                            </a>
                            @else
                            <div class="text-danger">(data kosong)</div>
                            @endif

                        </div>
                        <div class="input-group ">
                            <div class="custom-file">
                                <input type="hidden" name="nama_data[]" value="bac_musdes_blt_{{ $tahun }}">
                                <input type="hidden" name="isidata[]" value="">
                                <input type="file" name="bac_musdes_blt" class="custom-file-input" id="bac_blt">
                                <label class="custom-file-label text-muted dokumen_rkpdes" for="dokumen_rkpdes">Choose
                                    file PDF
                                    (max-size: 1MB)</label>
                            </div>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td>SK Camat tentang Penetapan BLT DD Tahun {{ $tahun }}</td>
                    <td class="d-flex">
                        <div class="mr-1">
                            @if($data[3]->isidata)
                            <a href="{{ asset('storage/'.$data[3]->isidata) }}" target="_blank">
                                <img src="/img/logo-pdf.webp" width="50px">
                                <input type="hidden" name="old_2" value="{{ $data[3]->isidata }}">
                            </a>
                            @else
                            <div class="text-danger">(data kosong)</div>
                            @endif

                        </div>
                        <div class="input-group ">
                            <div class="custom-file">
                                <input type="hidden" name="nama_data[]" value="sk_camat_blt_{{ $tahun }}">
                                <input type="hidden" name="isidata[]" value="">
                                <input type="file" name="sk_camat_blt" class="custom-file-input" id="dokumen_rkpdes">
                                <label class="custom-file-label text-muted dokumen_rkpdes" for="dokumen_rkpdes">Choose
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
            <button type="submit" class="btn btn-success">Update Data</button>
        </div>
    </div>

</form>