<div class="row">
    <div class="col-md-8">
        <p class="alert alert-info" style="font-size: 1rem">Silahkan Input Data Pendirian BUM Desa</p>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <form action="/adminDesa/pendirianTambah" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="jenis" value="{{ $jenis }}">

            <table class="table table-bordered table-striped">
                <tr>
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
                            <option value="">--pilih--</option>
                            <option value="sudah">sudah</option>
                            <option value="belum">belum</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Nama BUM Desa</td>
                    <td>
                        <input type="hidden" name="nama_data[]" value="nama_bumdes">
                        <input type="text" class="form-control" name="isi_data[]" required autofocus
                            style="font-size: .85rem">
                    </td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>Nomor Perdes Pembentukan BUM Desa </td>
                    <td>
                        <input type="hidden" name="nama_data[]" value="nomor_perdes_pembentukan">
                        <input type="number" class="form-control" style="font-size: .85rem" name="isi_data[]">
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Tahun Pembentukan BUM Desa</td>
                    <td>
                        <input type="hidden" name="nama_data[]" value="tanggal_pembentukan">
                        <input type="number" class="form-control" style="font-size: .85rem" name="isi_data[]">
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Dokumen Perdes Pembentukan BUM Desa</td>
                    <td>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="custom-file ">
                                    <input type="hidden" name="nama_data[]" value="perdes_pembentukan">
                                    <input type="hidden" name="isi_data[]">
                                    <input type="file" name="perdes_pembentukan" class="custom-file-input"
                                        id="perdes_pembentukan">
                                    <label class="custom-file-label text-muted perdes_pembentukan"
                                        for="perdes_pembentukan" style="font-size: .85rem">Choose
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
                    <td>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="custom-file ">
                                    <input type="hidden" name="nama_data[]" value="ad_art">
                                    <input type="hidden" name="isi_data[]">
                                    <input type="file" name="ad_art" class="custom-file-input" id="ad_art">
                                    <label class="custom-file-label text-muted ad_art" for="ad_art"
                                        style="font-size: .85rem">Choose
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
                    <td>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="custom-file ">
                                    <input type="hidden" name="nama_data[]" value="perdes_modal">
                                    <input type="hidden" name="isi_data[]">
                                    <input type="file" name="perdes_modal" class="custom-file-input" id="perdes_modal">
                                    <label class="custom-file-label text-muted perdes_modal" for="perdes_modal"
                                        style="font-size: .85rem">Choose
                                        file PDF
                                        (max-size: 1MB)</label>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>


                <tr id="skHukum" style="display: none;">
                    <td>8</td>
                    <td>Surat Keterangan Terdaftar Kemenkum HAM (print out)</td>
                    <td>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="custom-file ">
                                    <input type="hidden" name="nama_data[]" value="sk_kemenkum">
                                    <input type="hidden" name="isi_data[]">
                                    <input type="file" name="sk_kemenkum" class="custom-file-input" id="sk_kemenkum">
                                    <label class="custom-file-label text-muted sk_kemenkum" for="sk_kemenkum"
                                        style="font-size: .85rem">Choose
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
                    <td class="text-center"><button class="btn btn-primary">Kirim Data</button></td>
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