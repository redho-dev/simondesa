<form action="/adminDesa/updateDokren" method="post" enctype="multipart/form-data"
    class="form-horizontal form-label-left">
    @csrf

    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
    <input type="hidden" name="tahun" value="{{ $tahun }}">
    <input type="hidden" name="nama_dokren" value="{{ $nama_dokren }}">
    <div class="content">
        <div class="row">
            <div class="col-md-9">
                <p class="alert alert-info">Form Update Data RKP Desa tahun {{ $tahun }}</p>
                <table class="table table-bordered table-striped">
                    <thead class="bg-success">
                        <tr>
                            <th style="vertical-align: middle">No</th>
                            <th style="vertical-align: middle">Nama Data</th>
                            <th class="text-center" style="vertical-align: middle">Isi / File Data <br>(klik utk lihat)
                            </th>
                            <th class="text-center" style="vertical-align: middle">Ganti Upload/Input Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Upload SK Tim Penyusun RKP
                                Desa
                                <input type="hidden" name="nama_data[]" value="sk_tim_rkpdes">
                                <input type="hidden" name="isidata[]">
                            </td>
                            <td class="text-center">
                                @if($data[0]->isidata)
                                <a href="{{ asset('storage/'.$data[0]->isidata) }}" target="_blank">
                                    <img src="/img/logo-pdf.jpg" width="50px">
                                </a>
                                <input type="hidden" name="old_0" value="{{ $data[0]->isidata }}">
                                @else
                                <p class="text-danger">(data kosong)</p>
                                @endif
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="custom-file py-0">
                                        <input type="file" name="sk_tim_rkpdes" class="custom-file-input"
                                            id="sk_tim_rkpdes">
                                        <label class="custom-file-label text-muted sk_tim_rkpdes" for="file_sk"
                                            style="font-size: .75rem">Choose
                                            file PDF
                                            (max-size: 1MB)</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                Upload BAC Musyawarah Dusun
                                <input type="hidden" name="nama_data[]" value="bac_musdus">
                                <input type="hidden" name="isidata[]">
                            </td>
                            <td class="text-center">
                                @if($data[1]->isidata)
                                <a href="{{ asset('storage/'.$data[1]->isidata) }}" target="_blank">
                                    <img src="/img/logo-pdf.jpg" width="50px">
                                </a>
                                <input type="hidden" name="old_1" value="{{ $data[1]->isidata }}">
                                @else
                                <p class="text-danger">(data kosong)</p>
                                @endif
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="custom-file py-0">
                                        <input type="file" name="bac_musdus" class="custom-file-input" id="bac_musdus">
                                        <label class="custom-file-label text-muted bac_musdus" for="bac_musdus"
                                            style="font-size: .75rem">Choose
                                            file PDF
                                            (max-size: 1MB)</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>
                                Upload BAC dan Daftar Hadir Musrenbangdes
                                <input type="hidden" name="nama_data[]" value="bac_musrenbangdes">
                                <input type="hidden" name="isidata[]">
                            </td>
                            <td class="text-center">
                                @if($data[2]->isidata)
                                <a href="{{ asset('storage/'.$data[2]->isidata) }}" target="_blank">
                                    <img src="/img/logo-pdf.jpg" width="50px">
                                </a>
                                <input type="hidden" name="old_2" value="{{ $data[2]->isidata }}">
                                @else
                                <p class="text-danger">(data kosong)</p>
                                @endif
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="custom-file py-0">
                                        <input type="file" name="bac_musrenbangdes" class="custom-file-input"
                                            id="bac_musrenbangdes">
                                        <label class="custom-file-label text-muted bac_musrenbangdes"
                                            for="bac_musrenbangdes" style="font-size: .75rem">Choose
                                            file PDF
                                            (max-size: 1MB)</label>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>
                                Upload dokumentasi/foto
                                Musrenbangdes
                                <input type="hidden" name="nama_data[]" value="foto_musrenbangdes">
                                <input type="hidden" name="isidata[]">
                            </td>
                            <td class="text-center">
                                @if($data[3]->isidata)
                                <a href="{{ asset('storage/'.$data[3]->isidata) }}" target="_blank">
                                    <img src="{{ asset('storage/'.$data[3]->isidata) }}" width="50px">
                                </a>
                                <input type="hidden" name="old_3" value="{{ $data[3]->isidata }}">
                                @else
                                <p class="text-danger">(data kosong)</p>
                                @endif
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="custom-file py-0">
                                        <input type="file" name="foto_musrenbangdes" class="custom-file-input"
                                            id="foto_musrenbangdes">
                                        <label class="custom-file-label text-muted foto_musrenbangdes"
                                            for="foto_musrenbangdes" style="font-size: .75rem">Choose
                                            file Image
                                            (max-size: 1MB)</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>
                                Upload Dokumen RKP Desa Th {{ $tahun }}
                                <input type="hidden" name="nama_data[]" value="dokumen_rkpdes">
                                <input type="hidden" name="isidata[]">
                            </td>
                            <td class="text-center">
                                @if($data[4]->isidata)
                                <a href="{{ asset('storage/'.$data[4]->isidata) }}" target="_blank">
                                    <img src="/img/logo-pdf.jpg" width="50px">
                                </a>
                                <input type="hidden" name="old_4" value="{{ $data[4]->isidata }}">
                                @else
                                <p class="text-danger">(data kosong)</p>
                                @endif
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" name="dokumen_rkpdes" class="custom-file-input"
                                            id="dokumen_rkpdes">
                                        <label class="custom-file-label text-muted dokumen_rkpdes" for="dokumen_rkpdes"
                                            style="font-size: .75rem">Choose
                                            file PDF
                                            (max-size: 20MB)</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>
                                Nomor Perdes RKP Desa Th {{ $tahun }}
                            </td>
                            <td class="text-center">
                                @if($data[5]->isidata)
                                <p>{{ $data[5]->isidata }}</p>
                                @else
                                <p class="text-danger">(data kosong)</p>
                                @endif
                            </td>
                            <td>
                                <span class="input-group-text" style="font-size: .85rem; border-radius: 0;">Nomor
                                    : <input type="text" class="form-control ml-2" name="isidata[]"
                                        style="font-size: .85rem" value="{{ $data[5]->isidata }}"></span>
                                <input type="hidden" name="nama_data[]" value="nomor_rkpdes">
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>
                                Tanggal Penetapan Perdes
                            </td>
                            <td class="text-center">
                                @if($data[6]->isidata)
                                <p>{{ $data[6]->isidata }}</p>
                                @else
                                <p class="text-danger">(data kosong)</p>
                                @endif
                            </td>
                            <td>
                                <input type="text" class="form-control " name="isidata[]" style="font-size: .85rem"
                                    data-inputmask="'mask': '99/99/9999'" value="{{ $data[6]->isidata }}">
                                <input type="hidden" name="nama_data[]" value="tanggal_penetapan_rkpdes">
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>
                                Pagu Indikatif
                                Pendapatan
                                <input type="hidden" name="nama_data[]" value="pagu_pendapatan">
                            </td>
                            <td class="text-center">
                                @if($data[7]->isidata)
                                <p>{{ $data[7]->isidata }}</p>
                                @else
                                <p class="text-danger">(data kosong)</p>
                                @endif
                            </td>

                            <td>
                                <div class="col-md-8 d-inline-flex ">
                                    <span class="input-group-text border-right-0"
                                        style="font-size: .85rem; border-radius: 0;">Rp.</span>
                                    <input type="text" class="form-control pendapatan" name="isidata[]"
                                        style="font-size: .8rem" value="{{ $data[7]->isidata }}"></input>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>
                                Pagu Indikatif Belanja
                                <input type="hidden" name="nama_data[]" value="pagu_belanja">

                            </td>
                            <td class="text-center">
                                @if($data[8]->isidata)
                                <p>{{ $data[8]->isidata }}</p>
                                @else
                                <p class="text-danger">(data kosong)</p>
                                @endif
                            </td>
                            <td>
                                <div class="col-md-8 d-inline-flex ">
                                    <span class="input-group-text border-right-0"
                                        style="font-size: .85rem; border-radius: 0;">Rp.</span>
                                    <input type="text" class="form-control pendapatan" name="isidata[]"
                                        style="font-size: .8rem" value="{{ $data[8]->isidata }}"></input>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>
                                Pagu Indikatif
                                Pembiayaan
                                <input type="hidden" name="nama_data[]" value="pagu_pembiayaan">

                            </td>
                            <td class="text-center">
                                @if($data[9]->isidata)
                                <p>{{ $data[9]->isidata }}</p>
                                @else
                                <p class="text-danger">(data kosong)</p>
                                @endif
                            </td>
                            <td>
                                <div class="col-md-8 d-inline-flex ">
                                    <span class="input-group-text border-right-0"
                                        style="font-size: .85rem; border-radius: 0;">Rp.</span>
                                    <input type="text" class="form-control pendapatan" name="isidata[]"
                                        style="font-size: .8rem" value="{{ $data[9]->isidata }}"></input>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>
                                Jumlah Total Kegiatan dalam <br>RKP Desa Th {{ $tahun }}
                                <input type="hidden" name="nama_data[]" value="jumlah_total_kegiatan">

                            </td>
                            <td class="text-center">
                                @if($data[10]->isidata)
                                <p>{{ $data[10]->isidata }}</p>
                                @else
                                <p class="text-danger">(data kosong)</p>
                                @endif
                            </td>

                            <td>
                                <div class="input-group col-md-8 ">
                                    <input type="number" name="isidata[]" class="form-control"
                                        style="font-size: .85rem; border-radius: 0;" value="{{ $data[10]->isidata }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text"
                                            style="font-size: .85rem; border-radius: 0;">kegiatan</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>
                                Jumlah Rencana Kegiatan Pembangunan Fisik/Infrastruktur
                                <input type="hidden" name="nama_data[]" value="jumlah_kegiatan_fisik">
                            </td>
                            <td class="text-center">
                                @if($data[11]->isidata)
                                <p>{{ $data[11]->isidata }}</p>
                                @else
                                <p class="text-danger">(data kosong)</p>
                                @endif
                            </td>
                            <td>
                                <div class="input-group col-md-8">
                                    <input type="number" name="isidata[]" class="form-control"
                                        style="font-size: .85rem; border-radius: 0;" value="{{ $data[11]->isidata }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text"
                                            style="font-size: .85rem; border-radius: 0;">kegiatan</span>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>


    </div>
    </div>

    <div class="ln_solid"></div>
    <div class="form-group row justify-content-center">
        <div class="col-md-4 col-sm-4">
            <button type="button" class="btn btn-primary">Cancel</button>
            <button type="reset" class="btn btn-primary">Reset</button>
            <button type="submit" class="btn btn-success">Update Data</button>
        </div>
    </div>

</form>