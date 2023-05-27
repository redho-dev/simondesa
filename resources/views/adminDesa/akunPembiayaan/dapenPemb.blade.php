<?php 
if($anggaran == 'perubahan'){
    $jumgar = 'anggaran_perubahan';
}else{
    $jumgar = 'anggaran_murni';
}

?>
<div class="row">
    <div class="col-md-8">
        <p class="alert alert-info" style="font-size: 1rem">Form Upload Data Penerimaan Pembiayaan</p>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="totalAnggaran">Anggaran Penerimaan Pembiayaan </label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                </div>
                <input type="text" class="form-control angka" id="totalAnggaran" value="{{ $anggaranPen->$jumgar }}"
                    style="font-size: .75rem" readonly>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="realisasi">Realisasi Penerimaan Pembiayaan</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                </div>
                <input type="text" class="form-control angka" id="realisasi" style="font-size: .75rem"
                    value="{{ $realisasi }}" readonly>
            </div>

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="progress">Progress Penerimaan </label>
            <div class="input-group mb-2">
                @if($anggaranPen->$jumgar > 0)
                <input type="text" class="form-control text-right" id="progress"
                    value="{{ round(($realisasi/$anggaranPen->$jumgar)*100,2) }}" style="font-size: .75rem;" readonly>
                @else
                <input type="text" class="form-control text-right" id="progress" value="0" style="font-size: .75rem;"
                    readonly>
                @endif
                <div class="input-group-append">
                    <div class="input-group-text" style="font-size: .75rem"> %</div>
                </div>
            </div>

        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-8">
        <table class="table table-bordered">
            <thead class="bg-info">
                <tr>
                    <th style="vertical-align: middle">#</th>
                    <th style="vertical-align: middle">Jenis Penerimaan Pembiayaan</th>
                    <th class="text-center" style="vertical-align: middle">Jumlah Anggaran <br>(Rp)</th>
                    <th class="text-center" style="vertical-align: middle">Realisasi <br>(Rp)</th>
                    <th class="text-center" style="vertical-align: middle">File_data</th>
                    <th class="text-center" style="vertical-align: middle">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penPemb as $pen)
                <tr class="{{ $pen->$jumgar > 0 ? '' : 'd-none' }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pen->jenis_pembiayaan }}</td>
                    <td class="text-right angka">{{ $pen->$jumgar }}</td>
                    <td class="text-right angka">{{ $pen->penataan_pembiayaan->jumlah ?? 0
                        }}</td>
                    <td class="text-center ">
                        @if($pen->penataan_pembiayaan)
                        <a href="{{ asset('storage/'.$pen->penataan_pembiayaan->file_data) }}" target="_blank"><img
                                src="{{ asset('storage/'.$pen->penataan_pembiayaan->file_data) }}" width="50px"></a>
                        @else
                        <p class="text-danger">(kosong)</p>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($pen->penataan_pembiayaan)

                        <form action="/adminDesa/hapusBuktiPenPemb" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $pen->penataan_pembiayaan->id }}">
                            <input type="hidden" name="old" value="{{ $pen->penataan_pembiayaan->file_data }}">
                            <button type="submit" class="btn btn-danger btn-sm">hapus</button>
                        </form>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#pemb_{{ $pen->id }}">
                            Upload Data
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="pemb_{{ $pen->id }}" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Form Upload Bukti
                                        Penerimaan {{
                                        $pen->jenis_pembiayaan }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/adminDesa/tambahDapemb" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                        <input type="hidden" name="tahun" value="{{ $tahun }}">
                                        <input type="hidden" name="pembiayaan_id" value="{{ $pen->pembiayaan_id }}">
                                        <input type="hidden" name="apbdes_pembiayaan_id" value="{{ $pen->id }}">
                                        <input type="hidden" name="jenis" value="{{ $pen->jenis_pembiayaan }}">


                                        <div class="form-group mb-4">
                                            <label for="Jumlah">Jumlah Realisasi {{ $pen->jenis_pembiayaan }}</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text" style="font-size: .8rem">Rp.</div>
                                                </div>
                                                <input type="text" class="form-control angka" name="jumlah" id="jumlah"
                                                    style="font-size: .8rem" required>
                                            </div>
                                        </div>
                                        @if($pen->pembiayaan_id == 2)
                                        <div class="form-group mb-4">
                                            <label for="foto_rek">Upload Foto Buku Rekening Kas Desa <br> (yang
                                                menunjukkan
                                                kondisi kas awal tahun {{ $tahun }})</label>
                                            <div class="custom-file">
                                                <input type="hidden" name="nama_data" value="foto_rekening">
                                                <input type="file" name="file_data" class="custom-file-input file_data"
                                                    id="customFile" required>
                                                <label class="custom-file-label label_file_data" for="customFile">File
                                                    Image
                                                    (Max : 1MB)</label>
                                            </div>
                                        </div>
                                        @else
                                        <div class="form-group mb-4">
                                            <label for="foto_rek">Upload Bukti Setor ke Kas Desa (Foto)</label>
                                            <div class="custom-file">
                                                <input type="hidden" name="nama_data" value="bukti_setor">
                                                <input type="file" name="file_data" class="custom-file-input file_data"
                                                    id="customFile" required>
                                                <label class="custom-file-label label_file_data" for="customFile">File
                                                    Image
                                                    (Max : 1MB)</label>
                                            </div>
                                        </div>
                                        @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">KIRIM</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>