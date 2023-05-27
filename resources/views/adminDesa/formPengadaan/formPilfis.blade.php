<div class="row">
    <div class="col-md-7">
        <p class="alert alert-info" style="font-size: 1rem">Silahkan Pilih Kegiatan Dalam APB Desa TA {{ $tahun }}
            <span class="text-warning"> yang
                Memiliki Output Kegiatan
                Fisik/Konstruksi ! </span>
        </p>
    </div>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm my-2" data-toggle="modal" data-target="#staticBackdrop">
    + Kegiatan Fisik
</button>

<div class="row">
    <div class="col-md-7">
        <table class="table table-bordered">
            <tr>
                <th width="5%">No</th>
                <th width="50%">Nama Kegiatan</th>
                <th width="25%">Jumlah Anggaran (Rp)</th>
                <th width="20%">Sifat Kegiatan</th>
            </tr>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="staticBackdropLabel">Tambah Kegiatan Fisik/Konstruksi TA {{
                    $tahun }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/adminDesa/kegfisikTambah" method="post">
                    @csrf
                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                    <input type="hidden" name="tahun" value="{{ $tahun }}">

                    <div class="form-group">
                        <label for="pilkeg">Pilih Kegiatan Yang Memiliki Output Kegiatan
                            Fisik/Konstruksi</label>
                        <select class="form-control form-control-sm" id="pilkeg" style="font-size: .8rem;"
                            name="apbdes_kegiatan_id" required>
                            <option value="">== Pilih Kegiatan ==</option>
                            @foreach($dapemb as $dp)

                            <option value="{{ $dp->id }}">{{ $dp->kegiatan->kode_kegiatan."
                                ".Str::limit($dp->kegiatan->kegiatan,70) }}
                            </option>

                            @endforeach
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="anggaran">Jumlah Anggaran (Rp.)</label>
                                <input type="text" class="form-control angka" id="anggaran" name="anggaran" value=""
                                    style="font-size: .8rem" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="pilkeg">Sifat Kegiatan</label>
                                <select class="form-control" id="pilkeg" style="font-size: .8rem" name="sifat" required>
                                    <option value="">== Pilih ==</option>
                                    <option>Pembangunan_Baru</option>
                                    <option>Rehab</option>
                                    <option>Pemeliharaan</option>
                                    <option>Peningkatan</option>
                                </select>
                            </div>
                        </div>
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