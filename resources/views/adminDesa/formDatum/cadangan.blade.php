@extends('templates.desa.main')

@section('content')
<br><br>
<h3>Form Data Perangkat Desa</h3>
<style>
    .form-control {
        font-size: .8rem;
    }

    .form-select {
        font-size: .8rem;
    }
</style>
<form action="/adminDesa/tambahDatumPer" method="post">
    @csrf
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Jabatan</th>
                <th>Nama</th>
                <th>Nomor SK</th>
                <th class="text-center">Masa Berlaku</th>
                <th>Pendidikan</th>
                <th>foto</th>

            </tr>

        </thead>
        <tbody>
            <tr>
                <input type="hidden" value="desa_id" name="id_desa">
                <td><input type="text" class="form-control" value="Kepala Desa" name="kades" readonly>
                </td>
                <td><input type="text" class="form-control" value="" name="nama_kades"></td>
                <td><input type="text" class="form-control" value="" name="sk_kades">
                </td>
                <td class="d-flex">

                    <input type="text" class="form-control" placeholder="sejak tahun" name="sj_tahun_kades">
                    <span class="input-group-text py-0">s.d</span>
                    <input type="text" class="form-control" placeholder="tahun" name="sd_tahun_kades">

                </td>

                <td>
                    <select class="form-select form-control" name="pendidikan_kades">
                        <option selected>pilih</option>
                        <option value="1">SD/Sederajat</option>
                        <option value="2">SMP/Sederajat</option>
                        <option value="3">SMA/Sederajat</option>
                        <option value="4">Diploma</option>
                        <option value="5">Sarjana</option>
                        <option value="6">S2/Magister</option>
                        <option value="7">S3/Doktoral</option>
                    </select>
                </td>
                <td><a href="" class="btn btn-info btn-sm">upload foto</a></td>
            </tr>
            <tr>
                <input type="hidden" value="desa_id" name="id_desa">
                <td><input type="text" class="form-control" value="Sekretaris Desa" name="jabatan" readonly>
                </td>
                <td><input type="text" class="form-control" value="" name="nama_kades"></td>
                <td><input type="text" class="form-control" value="" name="sk_kades">
                </td>
                <td class="d-flex">

                    <input type="text" class="form-control" placeholder="sejak tahun" name="sj_tahun_kades">
                    <span class="input-group-text py-0">s.d</span>
                    <input type="text" class="form-control" placeholder="tahun" name="sd_tahun_kades">

                </td>

                <td>
                    <select class="form-select form-control" name="pendidikan_kades">
                        <option selected>pilih</option>
                        <option value="1">SD/Sederajat</option>
                        <option value="2">SMP/Sederajat</option>
                        <option value="3">SMA/Sederajat</option>
                        <option value="4">Diploma</option>
                        <option value="5">Sarjana</option>
                        <option value="6">S2/Magister</option>
                        <option value="7">S3/Doktoral</option>
                    </select>
                </td>
                <td><a href="" class="btn btn-info btn-sm">upload foto</a></td>
            </tr>
            <tr>
                <td colspan="6" class="text-center"><button type="submit" class="btn btn-primary btn-sm">Tambah
                        Data</button></td>
            </tr>


        </tbody>

    </table>
</form>

<div class="form-group row">
    <label class="control-label col-md-2 col-sm-2 ">Upload File SK (pdf)</label>
    <div class="col-md-2 col-sm-5">
        <p class="image_upload">
            <label for="file_sk">
                <a class="btn btn-warning btn-sm" rel="nofollow"><span class='fa fa-file'></span> Sisipkan file</a>
            </label>
            <input type="file" name="file_sk" id="file_sk" style="display: none">
        </p>
    </div>
    <div class="col-md-2">
        <span id="nmfile_sk">
            < nama file>
        </span>
    </div>
</div>



@endsection