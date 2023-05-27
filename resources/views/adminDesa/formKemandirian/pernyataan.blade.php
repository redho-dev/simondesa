<div class="row akunwil">
    <div class="col-md-6">
        <p class="text-primary mb-0">Catatan :</p>
        <ul>
            <li class="text-primary">
                Silahkan Upload Surat Pernyataan Kepala Desa, yang menyatakan bahwa Pengelolaan dan Penatausahaan
                Keuangan Desa
                Tahun Anggaran {{ $tahun }} dilaksanakan secara mandiri oleh Perangkat Desa
            </li>
        </ul>
        @if($pernyataan)
        <button type="button" class="btn btn-primary btn-sm my-3" data-toggle="modal" data-target="#staticBackdrop">
            Ganti Surat Pernyataan
        </button>
        @else
        <button type="button" class="btn btn-primary btn-sm my-3" data-toggle="modal" data-target="#staticBackdrop">
            Upload Surat Pernyataan
        </button>
        @endif
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-white" id="staticBackdropLabel">Form Upload Surat Pernyataan
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/adminDesa/updatePernyataan" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                        <input type="hidden" name="tahun" value="{{ $tahun }}">
                        <input type="hidden" name="jenis" value="{{ $jenis }}">

                        <div class="modal-body">
                            <div class="form-group mb-3">
                                @if ($pernyataan)
                                <div class="custom-file">
                                    <input type="hidden" name="old1" value="{{ $pernyataan->data }}">
                                    <input type="hidden" name="id" value="{{ $pernyataan->id }}">
                                    <input type="file" name="pernyataan_baru" class="custom-file-input pernyataan"
                                        id="customFile" required>
                                    <label class="custom-file-label text-muted label_pernyataan" for="customFile">choose
                                        file
                                        pdf (max: 1MB)</label>
                                </div>
                                @else
                                <div class="custom-file">
                                    <input type="file" name="pernyataan" class="custom-file-input pernyataan" required>
                                    <label class="custom-file-label text-muted label_pernyataan" for="pernyataan">choose
                                        file
                                        pdf (max: 1MB)</label>
                                </div>
                                @endif
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">KIRIM</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table class="table table-bordered">
            <thead class="bg-info">
                <tr>
                    <th width="5%" style="vertical-align: middle">No</th>
                    <th width="40%" style="vertical-align: middle">Nama Data</th>
                    <th class="text-center" width="15%" style="vertical-align: middle">Isi Data
                        <br> <small>(klik untuk
                            lihat)</small>
                    </th>
                    <th class="text-center" width="40%" style="vertical-align: middle">
                        Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>1</th>
                    <th>
                        Surat Pernyataan
                    </th>
                    <th width="30%" class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="jenis" value="pernyataan">
                        @if ($pernyataan)
                        <a href="{{ asset('storage/'.$pernyataan->data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @else
                        <div class="text-danger">
                            {{ 'Kosong'; }}
                        </div>
                        @endif
                    </th>
                    <th width="10%" style="vertical-align: middle" class="text-center">

                        <div class="form-group mb-3">
                            @if ($pernyataan)
                            <form action="/adminDesa/hapusPernyataan" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $pernyataan->id }}">
                                <button class="btn btn-sm btn-danger">hapus</button>
                            </form>
                            @endif
                        </div>
                    </th>
                </tr>

            </tbody>
        </table>

    </div>
</div>
<div class="ln_solid"></div>