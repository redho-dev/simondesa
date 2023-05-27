<div class="row">
    <div class="col-md-9">
        <p class="alert alert-info" style="font-size: 1rem">Silahkan Update Data Pendirian BUM Desa (Jika Ada Perubahan)
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-9">
        <form action="/adminDesa/pendirianEdit" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="jenis" value="{{ $jenis }}">

            <table class="table table-bordered table-striped">
                <tr class="table-secondary">
                    <th>No</th>
                    <th>Nama Data</th>
                    <th class="text-center">Isi Data</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Apakah BUM Desa telah terdaftar di Kemenkum HAM (berbadan hukum)</td>
                    <td>
                        <input type="hidden" name="nama_data[]" value="berbadan_hukum">
                        <select name="isi_data[]" class="form-control" style="font-size: .85rem" id="badanHukum"
                            required>
                            <option value="sudah" {{ $datas[0]->isi_data == 'sudah' ? 'selected' : '' }}>sudah</option>
                            <option value="belum" {{ $datas[0]->isi_data == 'belum' ? 'selected' : '' }} >belum
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Nama BUM Desa</td>
                    <td>
                        <input type="hidden" name="nama_data[]" value="nama_bumdes">
                        <input type="text" class="form-control" name="isi_data[]" required autofocus
                            style="font-size: .85rem" value="{{ $datas[1]->isi_data }}">
                    </td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>Nomor Perdes Pembentukan BUM Desa </td>
                    <td>
                        <input type="hidden" name="nama_data[]" value="nomor_perdes_pembentukan">
                        <input type="number" class="form-control" style="font-size: .85rem" name="isi_data[]"
                            value="{{ $datas[2]->isi_data }}">
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Tahun Pembentukan BUM Desa</td>
                    <td>
                        <input type="hidden" name="nama_data[]" value="tanggal_pembentukan">
                        <input type="number" class="form-control" style="font-size: .85rem" name="isi_data[]"
                            value="{{ $datas[3]->isi_data }}">
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Dokumen Perdes Pembentukan BUM Desa</td>
                    <td class="d-flex justify-content-between">
                        <div>
                            @if($datas[4]->isi_data)
                            <input type="hidden" name="old1" value="{{ $datas[4]->isi_data }}">
                            <a href="{{ asset('storage/'.$datas[4]->isi_data) }}" target="_blank"><img
                                    src="{{ asset('/img/logo-pdf.jpg') }}" width="50px"></a>
                            @else
                            <p class="text-danger">(kosong)</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="custom-file ">
                                    <input type="hidden" name="nama_data[]" value="perdes_pembentukan">
                                    <input type="hidden" name="isi_data[]">
                                    <input type="file" name="perdes_pembentukan" class="custom-file-input"
                                        id="perdes_pembentukan">
                                    <label class="custom-file-label text-muted perdes_pembentukan"
                                        for="perdes_pembentukan" style="font-size: .70rem">Ganti
                                        file PDF
                                        (max-size: 1MB)</label>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Anggaran Dasar / Anggaran Rumah Tangga (AD/ART)</td>
                    <td class="d-flex justify-content-between">
                        <div>
                            @if($datas[5]->isi_data)
                            <input type="hidden" name="old2" value="{{ $datas[5]->isi_data }}">
                            <a href="{{ asset('storage/'.$datas[5]->isi_data) }}" target="_blank"><img
                                    src="{{ asset('/img/logo-pdf.jpg') }}" width="50px"></a>
                            @else
                            <p class="text-danger">(kosong)</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="custom-file ">
                                    <input type="hidden" name="nama_data[]" value="ad_art">
                                    <input type="hidden" name="isi_data[]">
                                    <input type="file" name="ad_art" class="custom-file-input" id="ad_art">
                                    <label class="custom-file-label text-muted ad_art" for="ad_art"
                                        style="font-size: .70rem">Ganti
                                        file PDF
                                        (max-size: 1MB)</label>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Dokumen Perdes Penyertaan Modal</td>
                    <td class="d-flex justify-content-between">
                        <div>
                            @if($datas[6]->isi_data)
                            <input type="hidden" name="old3" value="{{ $datas[6]->isi_data }}">
                            <a href="{{ asset('storage/'.$datas[6]->isi_data) }}" target="_blank"><img
                                    src="{{ asset('/img/logo-pdf.jpg') }}" width="50px"></a>
                            @else
                            <p class="text-danger">(kosong)</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="custom-file ">
                                    <input type="hidden" name="nama_data[]" value="perdes_modal">
                                    <input type="hidden" name="isi_data[]">
                                    <input type="file" name="perdes_modal" class="custom-file-input" id="perdes_modal">
                                    <label class="custom-file-label text-muted perdes_modal" for="perdes_modal"
                                        style="font-size: .70rem">Ganti
                                        file PDF
                                        (max-size: 1MB)</label>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr id="skHukum" class="{{ $datas[0]->isi_data=='sudah' ? '' : 'd-none' }}">
                    <td>8</td>
                    <td>Surat Keterangan Terdaftar Kemenkum HAM (print out)</td>
                    <td class="d-flex justify-content-between">
                        <div>
                            @if($datas[7]->isi_data)
                            <input type="hidden" name="old4" value="{{ $datas[7]->isi_data }}">
                            <a href="{{ asset('storage/'.$datas[7]->isi_data) }}" target="_blank"><img
                                    src="{{ asset('/img/logo-pdf.jpg') }}" width="50px"></a>
                            @else
                            <p class="text-danger">(kosong)</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="custom-file ">
                                    <input type="hidden" name="nama_data[]" value="sk_kemenkum">
                                    <input type="hidden" name="isi_data[]">
                                    <input type="file" name="sk_kemenkum" class="custom-file-input" id="sk_kemenkum">
                                    <label class="custom-file-label text-muted sk_kemenkum" for="sk_kemenkum"
                                        style="font-size: .70rem">Ganti
                                        file PDF
                                        (max-size: 1MB)</label>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="text-center"><button class="btn btn-primary">Update Data</button></td>
                </tr>
            </table>
        </form>
    </div>
</div>

</div>


{{-- notifikasi --}}
@if(session()->has('success'))
<script>
    Swal.fire({
  position: 'center',
  icon: 'success',
  title: '{{ session("success") }}',
  showConfirmButton: false,
  timer: 1500
})
</script>

@endif

@if(session()->has('update'))
<script>
    Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: '{{ session("update") }}',
  showConfirmButton: false,
  timer: 1500
})
</script>

@endif