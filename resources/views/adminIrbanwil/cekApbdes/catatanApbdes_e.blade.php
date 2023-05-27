<div class="row">
    <div class="col-md-7">
        <p class="alert alert-warning text-dark">Silahkan Update Catatan atau Tanggapan Jika Ditemukan Ketidaksesuaian,
            atau terdapat hal penting lainnya
        </p>

        <form action="/adminIrbanwil/catatanApbdesEdit" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="nama_data" value="murni">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="7" class="bg-info">
                            <div class="form-group">
                                <label for="kesimpulan">Catatan / Tanggapan</label>
                                <input type="hidden" name="catatan" id="catatan" autofocus>
                                <trix-editor input="catatan" class="bg-white">{!! $dacat[0]->catatan
                                    !!}
                                </trix-editor>
                            </div>
                        </th>
                    <tr>
                        <th colspan="7" class="text-right">
                            <button type="submit" class="btn btn-primary">Update Catatan</button>
                        </th>
                    </tr>

                    </tr>
                </thead>
            </table>
        </form>
    </div>
</div>