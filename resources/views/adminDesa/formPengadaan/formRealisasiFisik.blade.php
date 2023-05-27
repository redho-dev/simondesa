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
        <?php $i = 1; ?>
        @foreach($pilfis as $dp)
        <table class="table table-bordered" id="tabel_{{ $i }}">
            <thead class="mt-2">
                <tr class="bg-info">
                    <th class="text-center" width="4%" style="vertical-align: middle">No</th>
                    <th width="20%">Nama Kegiatan</th>
                    <th class="text-center" width="8%" style="vertical-align: middle">SK TPK</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Desain/RAB/Gambar</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Progress <br> 0%</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Progress <br> 50%</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Progress <br> 100%</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto papan <br> kegiatan</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Prasasti</th>
                    <th class="text-center" width="8%" style="vertical-align: middle">BAST</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $dp->apbdes_kegiatan->kegiatan->kegiatan}} <br>- Jumlah Anggaran : Rp. <span class="angka">{{
                            $dp->anggaran
                            }} </span> <br> - Realisasi Anggaran : Rp. <span class="angka">{{ $dp->realisasi_anggaran
                            }}</span>
                    </td>
                    <td class="text-center">

                        @if($dp->sk_tpk)
                        <a href="{{ asset('storage/'.$dp->sk_tpk) }}" target="_blank"><img
                                src="{{  asset('img/logo-pdf.jpg') }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($dp->desain_rab)
                        <a href="{{ asset('storage/'.$dp->desain_rab) }}" target="_blank"><img
                                src="{{  asset('img/logo-pdf.jpg') }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif

                    </td>
                    <td class="text-center">
                        @if($dp->foto_0)
                        <a href="{{ asset('storage/'.$dp->foto_0) }}" target="_blank"><img
                                src="{{  asset('storage/'.$dp->foto_0) }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($dp->foto_50)
                        <a href="{{ asset('storage/'.$dp->foto_50) }}" target="_blank"><img
                                src="{{  asset('storage/'.$dp->foto_50) }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($dp->foto_100)
                        <a href="{{ asset('storage/'.$dp->foto_100) }}" target="_blank"><img
                                src="{{  asset('storage/'.$dp->foto_100) }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($dp->foto_papan)
                        <a href="{{ asset('storage/'.$dp->foto_papan) }}" target="_blank"><img
                                src="{{  asset('storage/'.$dp->foto_papan)  }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($dp->foto_prasasti)
                        <a href="{{ asset('storage/'.$dp->foto_prasasti) }}" target="_blank"><img
                                src="{{   asset('storage/'.$dp->foto_prasasti) }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($dp->bast)
                        <a href="{{ asset('storage/'.$dp->bast) }}" target="_blank"><img
                                src="{{  asset('img/logo-pdf.jpg') }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                </tr>
                <tr>

                    <td colspan="10" class="text-center">
                        @if($dp->realisasi_anggaran)
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
                                <form action="/adminDesa/tambahRealisasiFisik" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="apbdes_kegiatan_id"
                                        value="{{ $dp->apbdes_kegiatan_id }}">

                                    <input type="hidden" name="tabel" value={{ $i }}>

                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="kegiatan">Nama Kegiatan</label>
                                            <input type="text" class="form-control"
                                                value="{{ $dp->apbdes_kegiatan->kegiatan->kegiatan }}"
                                                style="font-size: .8rem" readonly>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="sifat">Sifat Kegiatan</label>
                                                    <input type="text" class="form-control" id="sifat" name="sifat"
                                                        value="{{ $dp->sifat }}" style="font-size: .8rem" readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="anggaran">Anggaran (Rp.)</label>
                                                    <input type="text" class="form-control angka" id="anggaran"
                                                        name="anggaran" value="{{ $dp->anggaran }}"
                                                        style="font-size: .8rem" readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="jenis">Jenis Output / Objek Kegiatan</label>
                                                    <select class="form-control" id="jenis" style="font-size: .8rem"
                                                        name="jenis" required>
                                                        <option value="">== pilih ==</option>
                                                        <option value="1">Jalan
                                                            / Prasarana Jalan
                                                        </option>
                                                        <option value="2">Jembatan</option>
                                                        <option value="3">Irigasi/Drainase/Embung/Persampahan
                                                        </option>
                                                        <option value="4">Jaringan / Instalasi
                                                        </option>
                                                        <option value="5">Gedung, Bangunan, dan Taman
                                                        </option>
                                                        <option value="6">Lainnya
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-row mt-3">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="realisasi_anggaran">Realisasi Anggaran (Rp.)</label>
                                                    <input type="text" class="form-control angka"
                                                        id="realisasi_anggaran" name="realisasi_anggaran"
                                                        style="font-size: .8rem" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="kegiatan">Upload SK TPK</label>
                                                    <div class="custom-file">
                                                        <input type="hidden" name="nama_data[]" value="sk_tpk">
                                                        <input type="file" name="sk_tpk"
                                                            class="custom-file-input sk_tpk" id="customFile ">
                                                        <label class="custom-file-label label_sk_tpk" for="customFile"
                                                            style="font-size: .7rem">Choose
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
                                                        <input type="hidden" name="nama_data[]" value="desain_rab">
                                                        <input type="file" name="desain_rab"
                                                            class="custom-file-input desain" id="customFile ">
                                                        <label class="custom-file-label label_desain" for="customFile"
                                                            style="font-size: .7rem">Choose
                                                            file
                                                            PDF Max (1
                                                            MB)</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
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
                                        <hr>
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
                                <form action="/adminDesa/updateRealisasiFisik" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="apbdes_kegiatan_id"
                                        value="{{ $dp->apbdes_kegiatan_id }}">

                                    <input type="hidden" name="tabel" value={{ $i }}>


                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="kegiatan">Nama Kegiatan</label>
                                            <input type="text" class="form-control"
                                                value="{{ $dp->apbdes_kegiatan->kegiatan->kegiatan }}"
                                                style="font-size: .8rem" readonly>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="sifat">Sifat Kegiatan</label>
                                                    <input type="text" class="form-control" id="sifat" name="sifat"
                                                        value="{{ $dp->sifat }}" style="font-size: .8rem" readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="realisasi_anggaran">Realisasi Anggaran (Rp.)</label>
                                                    <input type="text" class="form-control angka"
                                                        id="realisasi_anggaran" name="realisasi_anggaran"
                                                        value="{{ $dp->realisasi_anggaran }}" style="font-size: .8rem"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="jenis">Jenis Output / Objek Kegiatan</label>
                                                    <select class="form-control" id="jenis" style="font-size: .8rem"
                                                        name="jenis" required>
                                                        <option value="">==
                                                            Pilih ==</option>
                                                        <option value="1" {{ $dp->jenis=='1' ? 'selected' : '' }}>Jalan
                                                            / Prasarana Jalan
                                                        </option>
                                                        <option value="2" {{ $dp->jenis=='2' ? 'selected' : ''
                                                            }}>Jembatan</option>
                                                        <option value="3" {{ $dp->jenis=='3' ? 'selected' : ''
                                                            }}>Irigasi/Drainase/Embung/Persampahan
                                                        </option>
                                                        <option value="4" {{ $dp->jenis=='4' ? 'selected' : ''
                                                            }}>Jaringan / Instalasi
                                                        </option>
                                                        <option value="5" {{ $dp->jenis=='5' ? 'selected' : ''
                                                            }}>Gedung, Bangunan, dan Taman
                                                        </option>
                                                        <option value="6" {{ $dp->jenis=='6' ? 'selected' : ''
                                                            }}>Lainnya
                                                        </option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row mt-3">
                                            <div class="col">
                                                <div class="row align-items-center">
                                                    <div class="col-md-3">

                                                        @if($dp->sk_tpk)
                                                        <input type="hidden" name="old_1" value="{{ $dp->sk_tpk }}">
                                                        <a href="{{ asset('storage/'.$dp->sk_tpk) }}"
                                                            target="_blank"><img src="{{  asset('img/logo-pdf.jpg') }}"
                                                                width="50px" height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif


                                                    </div>
                                                    <div class="col-md-9 pr-4">
                                                        <div class="form-group">
                                                            <label for="kegiatan">Upload/Ganti SK TPK</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="sk_tpk"
                                                                    class="custom-file-input sk_tpk" id="customFile">
                                                                <label class="custom-file-label label_sk_tpk"
                                                                    for="customFile" style="font-size: .7rem">Choose
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
                                                    <div class="col-md-3 text-center ">

                                                        @if($dp->desain_rab)
                                                        <input type="hidden" name="old_2" value="{{ $dp->desain_rab }}">
                                                        <a href="{{ asset('storage/'.$dp->desain_rab) }}"
                                                            target="_blank"><img src="{{  asset('img/logo-pdf.jpg') }}"
                                                                width="50px" height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif


                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <label for="kegiatan">Upload/ganti
                                                                Desain/Analisa/Gambar</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="desain_rab"
                                                                    class="custom-file-input desain" id="customFile ">
                                                                <label class="custom-file-label label_desain"
                                                                    for="customFile" style="font-size: .7rem">Choose
                                                                    file
                                                                    PDF Max (1
                                                                    MB)</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-row mt-3">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-md-3">

                                                        @if($dp->foto_0)
                                                        <input type="hidden" name="old_3" value="{{ $dp->foto_0 }}">
                                                        <a href="{{ asset('storage/'.$dp->foto_0) }}"
                                                            target="_blank"><img
                                                                src="{{  asset('storage/'.$dp->foto_0) }}" width="50px"
                                                                height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-9 pr-4">
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
                                                    <div class="col-md-3 text-center">

                                                        @if($dp && $dp->foto_50)
                                                        <input type="hidden" name="old_4" value="{{ $dp->foto_50 }}">
                                                        <a href="{{ asset('storage/'.$dp->foto_50) }}"
                                                            target="_blank"><img
                                                                src="{{  asset('storage/'.$dp->foto_50) }}" width="50px"
                                                                height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-9">
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
                                        <hr>
                                        <div class="form-row mt-3">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        @if($dp && $dp->foto_100)
                                                        <input type="hidden" name="old_5" value="{{ $dp->foto_100 }}">
                                                        <a href="{{ asset('storage/'.$dp->foto_100) }}"
                                                            target="_blank"><img
                                                                src="{{  asset('storage/'.$dp->foto_100) }}"
                                                                width="50px" height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-9 pr-4">
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
                                                    <div class="col-md-3 text-center">

                                                        @if($dp && $dp->foto_prasasti)
                                                        <input type="hidden" name="old_6"
                                                            value="{{ $dp->foto_prasasti }}">
                                                        <a href="{{ asset('storage/'.$dp->foto_prasasti) }}"
                                                            target="_blank"><img
                                                                src="{{  asset('storage/'.$dp->foto_prasasti) }}"
                                                                width="50px" height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-9">
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
                                        <hr>
                                        <div class="form-row mt-3">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-md-3">

                                                        @if($dp && $dp->foto_papan)
                                                        <input type="hidden" name="old_8" value="{{ $dp->foto_papan }}">
                                                        <a href="{{ asset('storage/'.$dp->foto_papan) }}"
                                                            target="_blank"><img
                                                                src="{{  asset('storage/'.$dp->foto_papan) }}"
                                                                width="50px" height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-9">
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
                                                    <div class="col-md-3 text-center">

                                                        @if($dp && $dp->bast)
                                                        <input type="hidden" name="old_7" value="{{ $dp->bast }}">
                                                        <a href="{{ asset('storage/'.$dp->bast) }}" target="_blank"><img
                                                                src="{{  asset('img/logo-pdf.jpg') }}" width="50px"
                                                                height="60px"></a>
                                                        @else
                                                        <p class="text-danger mt-4">(kosong)</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-9 pr-3">
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
        <?php $i++; ?>
        @endforeach


    </div>
</div>