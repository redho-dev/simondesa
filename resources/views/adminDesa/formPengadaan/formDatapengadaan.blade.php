<?php 
if($status_anggaran == 'anggaran_murni'){
    $anggaran = "anggaran_murni";
}elseif($status_anggaran == 'anggaran_perubahan'){
    $anggaran = "anggaran_perubahan";
}

?>
<p class="alert alert-info" style="font-size: 1rem">Form Input/Update Data Realisasi Pembangunan/Rehab/Pemeliharaan
    Fisik TA {{
    $tahun }}</p>

<div class="row">
    <div class="col-md-12">
        <p class="text-primary">A. <i>Simondes Mengidentifikasi Terdapat <span id="dafis"></span> Kegiatan
                Pembangunan/Rehab Fisik pada APB
                Desa TA
                {{ $tahun }}</i></p>
    </div>

    <div class="col-md-12">
        <?php $i = 0; ?>
        @foreach($dapemb as $dp)
        @if(preg_match("/Rehabilitasi/i",$dp->kegiatan->kegiatan))
        <?php $i++; ?>
        <table class="table table-bordered" id="tabel_{{ $i }}">
            <thead class="mt-2">
                <tr class="bg-info">
                    <th class="text-center" width="4%" style="vertical-align: middle">No</th>
                    <th width="20%">Nama Kegiatan</th>
                    <th class="text-center" width="8%" style="vertical-align: middle">SK TPK</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Desain/RAB/Gambar</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto papan <br> kegiatan</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Progress <br> 0%</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Progress <br> 50%</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Progress <br> 100%</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Prasasti</th>
                    <th class="text-center" width="8%" style="vertical-align: middle">BAST</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $dp->kegiatan->kegiatan}} <br>Jumlah Anggaran : Rp. <span class="angka">{{ $dp->$anggaran
                            }}</span></td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'sk_tpk')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('img/logo-pdf.jpg') }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'desain')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('img/logo-pdf.jpg') }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif

                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_papan')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('storage/'.$data->file_data)  }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_0')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('storage/'.$data->file_data) }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_50')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('storage/'.$data->file_data) }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_100')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('storage/'.$data->file_data) }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'prasasti')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{   asset('storage/'.$data->file_data) }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'bast')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('img/logo-pdf.jpg') }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                </tr>
                <tr>

                    <td colspan="10" class="text-center">
                        @if($dp->pengadaan->where('file_data', '!=', NULL)->count())
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#update{{ $dp->id }}">
                            Update Data
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#laporan{{ $dp->id }}">
                            Input Data Pembangunan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="laporan{{ $dp->id }}" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Upload Laporan
                                        Realisasi Pembangunan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/tambahLaporPemb" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="apbdes_kegiatan_id" value="{{ $dp->id }}">
                                    <input type="hidden" name="jumlah_anggaran" value="{{ $dp->$anggaran }}">
                                    <input type="hidden" name="nama_data[]" value="nilai">
                                    <input type="hidden" name="nama_data[]" value="tgl_cek_fisik">
                                    <input type="hidden" name="nama_data[]" value="catatan">
                                    <input type="hidden" name="nama_data[]" value="status_temuan">
                                    <input type="hidden" name="nama_data[]" value="rekomendasi">
                                    <input type="hidden" name="nama_data[]" value="estimasi_finishing">
                                    <input type="hidden" name="nama_data[]" value="estimasi_kerugian">
                                    <input type="hidden" name="nama_data[]" value="bentuk_laporan">
                                    <input type="hidden" name="nama_data[]" value="status_tindak_lanjut">
                                    <input type="hidden" name="nama_data[]" value="diteruskan_ke">
                                    <input type="hidden" name="jumlah_fisik" value={{ $jumFisik }}>
                                    <input type="hidden" name="jumlah_rafis" value={{ $jumRafis }}>
                                    <input type="hidden" name="tabel" value={{ $i }}>

                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="kegiatan">Nama Kegiatan</label>
                                            <input type="text" class="form-control"
                                                value="{{ $dp->kegiatan->kegiatan }}" style="font-size: .8rem" readonly>
                                        </div>
                                        <div class="form-row mt-3">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="kegiatan">Upload SK TPK</label>
                                                    <div class="custom-file">
                                                        <input type="hidden" name="nama_data[]" value="sk_tpk">
                                                        <input type="file" name="sk_tpk"
                                                            class="custom-file-input sk_tpk" id="customFile ">
                                                        <label class="custom-file-label label_sk_tpk"
                                                            for="customFile">Choose
                                                            file
                                                            PDF Max (1
                                                            MB)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="kegiatan">Upload Desain/Analisa/Gambar</label>
                                                    <div class="custom-file">
                                                        <input type="hidden" name="nama_data[]" value="desain">
                                                        <input type="file" name="desain"
                                                            class="custom-file-input desain" id="customFile ">
                                                        <label class="custom-file-label label_desain"
                                                            for="customFile">Choose
                                                            file
                                                            PDF Max (1
                                                            MB)</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row mt-3">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="kegiatan">Foto 0%</label>
                                                    <div class="custom-file">
                                                        <input type="hidden" name="nama_data[]" value="foto_0">
                                                        <input type="file" name="foto_0"
                                                            class="custom-file-input foto_0" id="customFile ">
                                                        <label class="custom-file-label label_foto_0" for="customFile"
                                                            style="font-size: .7rem">Choose
                                                            file
                                                            Image Max (1
                                                            MB)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="kegiatan">Foto 50%</label>
                                                    <div class="custom-file">
                                                        <input type="hidden" name="nama_data[]" value="foto_50">
                                                        <input type="file" name="foto_50"
                                                            class="custom-file-input foto_50" id="customFile ">
                                                        <label class="custom-file-label label_foto_50" for="customFile"
                                                            style="font-size: .7rem">Choose
                                                            file
                                                            Image Max (1
                                                            MB)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="kegiatan">Foto 100%</label>
                                                    <div class="custom-file">
                                                        <input type="hidden" name="nama_data[]" value="foto_100">
                                                        <input type="file" name="foto_100"
                                                            class="custom-file-input foto_100" id="customFile ">
                                                        <label class="custom-file-label label_foto_100" for="customFile"
                                                            style="font-size: .7rem">Choose
                                                            file
                                                            Image Max (1
                                                            MB)</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row mt-3">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="kegiatan">Foto Papan Kegiatan</label>
                                                    <div class="custom-file">
                                                        <input type="hidden" name="nama_data[]" value="foto_papan">
                                                        <input type="file" name="foto_papan"
                                                            class="custom-file-input foto_papan" id="customFile ">
                                                        <label class="custom-file-label label_foto_papan"
                                                            for="customFile" style="font-size: .7rem">Choose
                                                            file
                                                            Image Max (1
                                                            MB)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="kegiatan">Foto Prasasti</label>
                                                    <div class="custom-file">
                                                        <input type="hidden" name="nama_data[]" value="prasasti">
                                                        <input type="file" name="prasasti"
                                                            class="custom-file-input prasasti" id="customFile ">
                                                        <label class="custom-file-label label_prasasti" for="customFile"
                                                            style="font-size: .7rem">Choose
                                                            file
                                                            Image Max (1
                                                            MB)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="kegiatan">BAC Serah Terima</label>
                                                    <div class="custom-file">
                                                        <input type="hidden" name="nama_data[]" value="bast">
                                                        <input type="file" name="bast" class="custom-file-input bast"
                                                            id="customFile ">
                                                        <label class="custom-file-label label_bast" for="customFile "
                                                            style="font-size: .7rem">Choose
                                                            file
                                                            PDF (1
                                                            MB)</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">KIRIM</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="update{{ $dp->id }}" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Update Laporan
                                        Realisasi Pembangunan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/updateLaporPemb" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="apbdes_kegiatan_id" value="{{ $dp->id }}">
                                    <input type="hidden" name="jumlah_anggaran" value="{{ $dp->$anggaran }}">
                                    <input type="hidden" name="jumlah_fisik" value={{ $jumFisik }}>
                                    <input type="hidden" name="jumlah_rafis" value={{ $jumRafis }}>
                                    <input type="hidden" name="tabel" value={{ $i }}>


                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="kegiatan">Nama Kegiatan</label>
                                            <input type="text" class="form-control"
                                                value="{{ $dp->kegiatan->kegiatan }}" style="font-size: .8rem" readonly>
                                        </div>
                                        <div class="form-row mt-3">
                                            <div class="col">
                                                <div class="row align-items-center">
                                                    <div class="col-md-2">

                                                        <?php $data = $dp->pengadaan->where('nama_data', 'sk_tpk')->first(); ?>
                                                        @if($data && $data->file_data)
                                                        <input type="hidden" name="old_1"
                                                            value="{{ $data->file_data }}">
                                                        <a href="{{ asset('storage/'.$data->file_data) }}"
                                                            target="_blank"><img src="{{  asset('img/logo-pdf.jpg') }}"
                                                                width="50px" height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif


                                                    </div>
                                                    <div class="col-md-10 pr-4">
                                                        <div class="form-group">
                                                            <label for="kegiatan">Upload/Ganti SK TPK</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="sk_tpk"
                                                                    class="custom-file-input sk_tpk" id="customFile">
                                                                <label class="custom-file-label label_sk_tpk"
                                                                    for="customFile">Choose
                                                                    file
                                                                    PDF Max (1
                                                                    MB)</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="col">
                                                <div class="row align-items-center">
                                                    <div class="col-md-2 text-center ">

                                                        <?php $data = $dp->pengadaan->where('nama_data', 'desain')->first(); ?>
                                                        @if($data && $data->file_data)
                                                        <input type="hidden" name="old_2"
                                                            value="{{ $data->file_data }}">
                                                        <a href="{{ asset('storage/'.$data->file_data) }}"
                                                            target="_blank"><img src="{{  asset('img/logo-pdf.jpg') }}"
                                                                width="50px" height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif


                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                            <label for="kegiatan">Upload/ganti
                                                                Desain/Analisa/Gambar</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="desain"
                                                                    class="custom-file-input desain" id="customFile ">
                                                                <label class="custom-file-label label_desain"
                                                                    for="customFile">Choose
                                                                    file
                                                                    PDF Max (1
                                                                    MB)</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-row mt-3">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_0')->first(); ?>
                                                        @if($data && $data->file_data)
                                                        <input type="hidden" name="old_3"
                                                            value="{{ $data->file_data }}">
                                                        <a href="{{ asset('storage/'.$data->file_data) }}"
                                                            target="_blank"><img
                                                                src="{{  asset('storage/'.$data->file_data) }}"
                                                                width="50px" height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-10 pr-4">
                                                        <div class="form-group">
                                                            <label for="kegiatan">Ganti/Upload Foto 0%</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="foto_0"
                                                                    class="custom-file-input foto_0" id="customFile ">
                                                                <label class="custom-file-label label_foto_0"
                                                                    for="customFile" style="font-size: .7rem">Choose
                                                                    file
                                                                    Image Max (1
                                                                    MB)</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_50')->first(); ?>
                                                        @if($data && $data->file_data)
                                                        <input type="hidden" name="old_4"
                                                            value="{{ $data->file_data }}">
                                                        <a href="{{ asset('storage/'.$data->file_data) }}"
                                                            target="_blank"><img
                                                                src="{{  asset('storage/'.$data->file_data) }}"
                                                                width="50px" height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                            <label for="kegiatan">Upload/Ganti Foto 50%</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="foto_50"
                                                                    class="custom-file-input foto_50" id="customFile ">
                                                                <label class="custom-file-label label_foto_50"
                                                                    for="customFile" style="font-size: .7rem">Choose
                                                                    file
                                                                    Image Max (1
                                                                    MB)</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-row mt-3">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_100')->first(); ?>
                                                        @if($data && $data->file_data)
                                                        <input type="hidden" name="old_5"
                                                            value="{{ $data->file_data }}">
                                                        <a href="{{ asset('storage/'.$data->file_data) }}"
                                                            target="_blank"><img
                                                                src="{{  asset('storage/'.$data->file_data) }}"
                                                                width="50px" height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-10 pr-4">
                                                        <div class="form-group">
                                                            <label for="kegiatan">Upload/Ganti Foto 100%</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="foto_100"
                                                                    class="custom-file-input foto_100" id="customFile ">
                                                                <label class="custom-file-label label_foto_100"
                                                                    for="customFile" style="font-size: .7rem">Choose
                                                                    file
                                                                    Image Max (1
                                                                    MB)</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <?php $data = $dp->pengadaan->where('nama_data', 'prasasti')->first(); ?>
                                                        @if($data && $data->file_data)
                                                        <input type="hidden" name="old_6"
                                                            value="{{ $data->file_data }}">
                                                        <a href="{{ asset('storage/'.$data->file_data) }}"
                                                            target="_blank"><img
                                                                src="{{  asset('storage/'.$data->file_data) }}"
                                                                width="50px" height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                            <label for="kegiatan">Upload/ganti Foto Prasasti</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="prasasti"
                                                                    class="custom-file-input prasasti" id="customFile ">
                                                                <label class="custom-file-label label_prasasti"
                                                                    for="customFile" style="font-size: .7rem">Choose
                                                                    file
                                                                    Image Max (1
                                                                    MB)</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-row mt-3">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_papan')->first(); ?>
                                                        @if($data && $data->file_data)
                                                        <input type="hidden" name="old_8"
                                                            value="{{ $data->file_data }}">
                                                        <a href="{{ asset('storage/'.$data->file_data) }}"
                                                            target="_blank"><img
                                                                src="{{  asset('storage/'.$data->file_data) }}"
                                                                width="50px" height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                            <label for="kegiatan">Upload/ganti Foto Papan</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="foto_papan"
                                                                    class="custom-file-input foto_papan"
                                                                    id="customFile ">
                                                                <label class="custom-file-label label_foto_papan"
                                                                    for="customFile" style="font-size: .7rem">Choose
                                                                    file
                                                                    Image Max (1
                                                                    MB)</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <?php $data = $dp->pengadaan->where('nama_data', 'bast')->first(); ?>
                                                        @if($data && $data->file_data)
                                                        <input type="hidden" name="old_7"
                                                            value="{{ $data->file_data }}">
                                                        <a href="{{ asset('storage/'.$data->file_data) }}"
                                                            target="_blank"><img src="{{  asset('img/logo-pdf.jpg') }}"
                                                                width="50px" height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-10 pr-3">
                                                        <div class="form-group">
                                                            <label for="kegiatan">Upload/Ganti BAST</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="bast"
                                                                    class="custom-file-input bast" id="customFile bast">
                                                                <label class="custom-file-label label_bast"
                                                                    for="customFile" style="font-size: .7rem">Choose
                                                                    file
                                                                    PDF (1
                                                                    MB)</label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">UPDATE DATA</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </tr>
            </tbody>
        </table>
        @endif
        @endforeach


    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <p class="text-primary">B. <i>Simondes Mengidentifikasi Terdapat <span id="rafis"></span> Kegiatan Pemeliharaan
                Fisik pada APB
                Desa TA
                {{ $tahun }}</i></p>
    </div>

    <div class="col-md-12">
        <?php $j = 0; ?>
        @foreach($dapemb as $dp)
        @if(preg_match("/pemeliharaan/i",$dp->kegiatan->kegiatan) )
        <?php $j++; ?>
        <table class="table table-bordered" id="tabel_{{ $i+$j }}">
            <thead class="mt-2">
                <tr class="bg-info">
                    <th class="text-center" width="4%" style="vertical-align: middle">No</th>
                    <th width="20%">Nama Kegiatan</th>
                    <th class="text-center" width="8%" style="vertical-align: middle">SK TPK</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Desain/RAB/Gambar</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto papan <br> kegiatan</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Progress <br> 0%</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Progress <br> 50%</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Progress <br> 100%</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Prasasti <br>(jika ada)</th>
                    <th class="text-center" width="8%" style="vertical-align: middle">BAST / Laporan Kegtn</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $j }}</td>
                    <td>{{ $dp->kegiatan->kegiatan}} <br>Jumlah Anggaran : Rp. <span class="angka">{{ $dp->$anggaran
                            }}</span></td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'sk_tpk')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('img/logo-pdf.jpg') }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'desain')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('img/logo-pdf.jpg') }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif

                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_papan')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('storage/'.$data->file_data)  }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_0')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('storage/'.$data->file_data) }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_50')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('storage/'.$data->file_data) }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_100')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('storage/'.$data->file_data) }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'prasasti')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{   asset('storage/'.$data->file_data) }}" width="50px" height="60px"></a>
                        @else

                        @endif
                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'bast')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('img/logo-pdf.jpg') }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                </tr>
                <tr>

                    <td colspan="10" class="text-center">
                        @if($dp->pengadaan->where('file_data', '!=', NULL)->count())
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#update{{ $dp->id }}">
                            Update Data
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#laporan{{ $dp->id }}">
                            Input Data Pembangunan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="laporan{{ $dp->id }}" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Upload Laporan
                                        Realisasi Pembangunan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/tambahLaporPemb" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="apbdes_kegiatan_id" value="{{ $dp->id }}">
                                    <input type="hidden" name="jumlah_anggaran" value="{{ $dp->$anggaran }}">
                                    <input type="hidden" name="nama_data[]" value="nilai">
                                    <input type="hidden" name="nama_data[]" value="tgl_cek_fisik">
                                    <input type="hidden" name="nama_data[]" value="catatan">
                                    <input type="hidden" name="nama_data[]" value="status_temuan">
                                    <input type="hidden" name="nama_data[]" value="rekomendasi">
                                    <input type="hidden" name="nama_data[]" value="estimasi_finishing">
                                    <input type="hidden" name="nama_data[]" value="estimasi_kerugian">
                                    <input type="hidden" name="nama_data[]" value="bentuk_laporan">
                                    <input type="hidden" name="nama_data[]" value="status_tindak_lanjut">
                                    <input type="hidden" name="nama_data[]" value="diteruskan_ke">
                                    <input type="hidden" name="jumlah_fisik" value={{ $jumFisik }}>
                                    <input type="hidden" name="jumlah_rafis" value={{ $jumRafis }}>
                                    <input type="hidden" name="tabel" value="{{ $i+$j }}">

                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="kegiatan">Nama Kegiatan</label>
                                            <input type="text" class="form-control"
                                                value="{{ $dp->kegiatan->kegiatan }}" style="font-size: .8rem" readonly>
                                        </div>
                                        <div class="form-row mt-3">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="kegiatan">Upload SK TPK</label>
                                                    <div class="custom-file">
                                                        <input type="hidden" name="nama_data[]" value="sk_tpk">
                                                        <input type="file" name="sk_tpk"
                                                            class="custom-file-input sk_tpk" id="customFile ">
                                                        <label class="custom-file-label label_sk_tpk"
                                                            for="customFile">Choose
                                                            file
                                                            PDF Max (1
                                                            MB)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="kegiatan">Upload Desain/Analisa/Gambar</label>
                                                    <div class="custom-file">
                                                        <input type="hidden" name="nama_data[]" value="desain">
                                                        <input type="file" name="desain"
                                                            class="custom-file-input desain" id="customFile ">
                                                        <label class="custom-file-label label_desain"
                                                            for="customFile">Choose
                                                            file
                                                            PDF Max (1
                                                            MB)</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row mt-3">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="kegiatan">Foto 0%</label>
                                                    <div class="custom-file">
                                                        <input type="hidden" name="nama_data[]" value="foto_0">
                                                        <input type="file" name="foto_0"
                                                            class="custom-file-input foto_0" id="customFile ">
                                                        <label class="custom-file-label label_foto_0" for="customFile"
                                                            style="font-size: .7rem">Choose
                                                            file
                                                            Image Max (1
                                                            MB)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="kegiatan">Foto 50%</label>
                                                    <div class="custom-file">
                                                        <input type="hidden" name="nama_data[]" value="foto_50">
                                                        <input type="file" name="foto_50"
                                                            class="custom-file-input foto_50" id="customFile ">
                                                        <label class="custom-file-label label_foto_50" for="customFile"
                                                            style="font-size: .7rem">Choose
                                                            file
                                                            Image Max (1
                                                            MB)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="kegiatan">Foto 100%</label>
                                                    <div class="custom-file">
                                                        <input type="hidden" name="nama_data[]" value="foto_100">
                                                        <input type="file" name="foto_100"
                                                            class="custom-file-input foto_100" id="customFile ">
                                                        <label class="custom-file-label label_foto_100" for="customFile"
                                                            style="font-size: .7rem">Choose
                                                            file
                                                            Image Max (1
                                                            MB)</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row mt-3">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="kegiatan">Foto Papan Kegiatan</label>
                                                    <div class="custom-file">
                                                        <input type="hidden" name="nama_data[]" value="foto_papan">
                                                        <input type="file" name="foto_papan"
                                                            class="custom-file-input foto_papan" id="customFile ">
                                                        <label class="custom-file-label label_foto_papan"
                                                            for="customFile" style="font-size: .7rem">Choose
                                                            file
                                                            Image Max (1
                                                            MB)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="kegiatan">Foto Prasasti</label>
                                                    <div class="custom-file">
                                                        <input type="hidden" name="nama_data[]" value="prasasti">
                                                        <input type="file" name="prasasti"
                                                            class="custom-file-input prasasti" id="customFile ">
                                                        <label class="custom-file-label label_prasasti" for="customFile"
                                                            style="font-size: .7rem">Choose
                                                            file
                                                            Image Max (1
                                                            MB)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="kegiatan">BAC Serah Terima</label>
                                                    <div class="custom-file">
                                                        <input type="hidden" name="nama_data[]" value="bast">
                                                        <input type="file" name="bast" class="custom-file-input bast"
                                                            id="customFile ">
                                                        <label class="custom-file-label label_bast" for="customFile "
                                                            style="font-size: .7rem">Choose
                                                            file
                                                            PDF (1
                                                            MB)</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">KIRIM</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="update{{ $dp->id }}" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Update Laporan
                                        Realisasi Pembangunan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/updateLaporPemb" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="apbdes_kegiatan_id" value="{{ $dp->id }}">
                                    <input type="hidden" name="jumlah_anggaran" value="{{ $dp->$anggaran }}">
                                    <input type="hidden" name="jumlah_fisik" value={{ $jumFisik }}>
                                    <input type="hidden" name="jumlah_fisik" value={{ $jumFisik }}>
                                    <input type="hidden" name="jumlah_rafis" value={{ $jumRafis }}>
                                    <input type="hidden" name="tabel" value={{ $i+$j }}>



                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="kegiatan">Nama Kegiatan</label>
                                            <input type="text" class="form-control"
                                                value="{{ $dp->kegiatan->kegiatan }}" style="font-size: .8rem" readonly>
                                        </div>
                                        <div class="form-row mt-3">
                                            <div class="col">
                                                <div class="row align-items-center">
                                                    <div class="col-md-2">

                                                        <?php $data = $dp->pengadaan->where('nama_data', 'sk_tpk')->first(); ?>
                                                        @if($data && $data->file_data)
                                                        <input type="hidden" name="old_1"
                                                            value="{{ $data->file_data }}">
                                                        <a href="{{ asset('storage/'.$data->file_data) }}"
                                                            target="_blank"><img src="{{  asset('img/logo-pdf.jpg') }}"
                                                                width="50px" height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif


                                                    </div>
                                                    <div class="col-md-10 pr-4">
                                                        <div class="form-group">
                                                            <label for="kegiatan">Upload/Ganti SK TPK</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="sk_tpk"
                                                                    class="custom-file-input sk_tpk" id="customFile">
                                                                <label class="custom-file-label label_sk_tpk"
                                                                    for="customFile">Choose
                                                                    file
                                                                    PDF Max (1
                                                                    MB)</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="col">
                                                <div class="row align-items-center">
                                                    <div class="col-md-2 text-center ">

                                                        <?php $data = $dp->pengadaan->where('nama_data', 'desain')->first(); ?>
                                                        @if($data && $data->file_data)
                                                        <input type="hidden" name="old_2"
                                                            value="{{ $data->file_data }}">
                                                        <a href="{{ asset('storage/'.$data->file_data) }}"
                                                            target="_blank"><img src="{{  asset('img/logo-pdf.jpg') }}"
                                                                width="50px" height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif


                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                            <label for="kegiatan">Upload/ganti
                                                                Desain/Analisa/Gambar</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="desain"
                                                                    class="custom-file-input desain" id="customFile ">
                                                                <label class="custom-file-label label_desain"
                                                                    for="customFile">Choose
                                                                    file
                                                                    PDF Max (1
                                                                    MB)</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-row mt-3">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_0')->first(); ?>
                                                        @if($data && $data->file_data)
                                                        <input type="hidden" name="old_3"
                                                            value="{{ $data->file_data }}">
                                                        <a href="{{ asset('storage/'.$data->file_data) }}"
                                                            target="_blank"><img
                                                                src="{{  asset('storage/'.$data->file_data) }}"
                                                                width="50px" height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-10 pr-4">
                                                        <div class="form-group">
                                                            <label for="kegiatan">Ganti/Upload Foto 0%</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="foto_0"
                                                                    class="custom-file-input foto_0" id="customFile ">
                                                                <label class="custom-file-label label_foto_0"
                                                                    for="customFile" style="font-size: .7rem">Choose
                                                                    file
                                                                    Image Max (1
                                                                    MB)</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_50')->first(); ?>
                                                        @if($data && $data->file_data)
                                                        <input type="hidden" name="old_4"
                                                            value="{{ $data->file_data }}">
                                                        <a href="{{ asset('storage/'.$data->file_data) }}"
                                                            target="_blank"><img
                                                                src="{{  asset('storage/'.$data->file_data) }}"
                                                                width="50px" height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                            <label for="kegiatan">Upload/Ganti Foto 50%</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="foto_50"
                                                                    class="custom-file-input foto_50" id="customFile ">
                                                                <label class="custom-file-label label_foto_50"
                                                                    for="customFile" style="font-size: .7rem">Choose
                                                                    file
                                                                    Image Max (1
                                                                    MB)</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-row mt-3">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_100')->first(); ?>
                                                        @if($data && $data->file_data)
                                                        <input type="hidden" name="old_5"
                                                            value="{{ $data->file_data }}">
                                                        <a href="{{ asset('storage/'.$data->file_data) }}"
                                                            target="_blank"><img
                                                                src="{{  asset('storage/'.$data->file_data) }}"
                                                                width="50px" height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-10 pr-4">
                                                        <div class="form-group">
                                                            <label for="kegiatan">Upload/Ganti Foto 100%</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="foto_100"
                                                                    class="custom-file-input foto_100" id="customFile ">
                                                                <label class="custom-file-label label_foto_100"
                                                                    for="customFile" style="font-size: .7rem">Choose
                                                                    file
                                                                    Image Max (1
                                                                    MB)</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <?php $data = $dp->pengadaan->where('nama_data', 'prasasti')->first(); ?>
                                                        @if($data && $data->file_data)
                                                        <input type="hidden" name="old_6"
                                                            value="{{ $data->file_data }}">
                                                        <a href="{{ asset('storage/'.$data->file_data) }}"
                                                            target="_blank"><img
                                                                src="{{  asset('storage/'.$data->file_data) }}"
                                                                width="50px" height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                            <label for="kegiatan">Upload/ganti Foto Prasasti</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="prasasti"
                                                                    class="custom-file-input prasasti" id="customFile ">
                                                                <label class="custom-file-label label_prasasti"
                                                                    for="customFile" style="font-size: .7rem">Choose
                                                                    file
                                                                    Image Max (1
                                                                    MB)</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-row mt-3">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_papan')->first(); ?>
                                                        @if($data && $data->file_data)
                                                        <input type="hidden" name="old_8"
                                                            value="{{ $data->file_data }}">
                                                        <a href="{{ asset('storage/'.$data->file_data) }}"
                                                            target="_blank"><img
                                                                src="{{  asset('storage/'.$data->file_data) }}"
                                                                width="50px" height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                            <label for="kegiatan">Upload/ganti Foto Papan</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="foto_papan"
                                                                    class="custom-file-input foto_papan"
                                                                    id="customFile ">
                                                                <label class="custom-file-label label_foto_papan"
                                                                    for="customFile" style="font-size: .7rem">Choose
                                                                    file
                                                                    Image Max (1
                                                                    MB)</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <?php $data = $dp->pengadaan->where('nama_data', 'bast')->first(); ?>
                                                        @if($data && $data->file_data)
                                                        <input type="hidden" name="old_7"
                                                            value="{{ $data->file_data }}">
                                                        <a href="{{ asset('storage/'.$data->file_data) }}"
                                                            target="_blank"><img src="{{  asset('img/logo-pdf.jpg') }}"
                                                                width="50px" height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-10 pr-3">
                                                        <div class="form-group">
                                                            <label for="kegiatan">Upload/Ganti BAST</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="bast"
                                                                    class="custom-file-input bast" id="customFile bast">
                                                                <label class="custom-file-label label_bast"
                                                                    for="customFile" style="font-size: .7rem">Choose
                                                                    file
                                                                    PDF (1
                                                                    MB)</label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">UPDATE DATA</button>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </tr>
            </tbody>
        </table>
        @endif
        @endforeach
        <input type="hidden" id="jumfisik" name="jumfisik" value="{{ $i }}">
        <input type="hidden" id="rafisik" name="rafisik" value="{{ $j }}">
    </div>
</div>