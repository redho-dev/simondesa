<div class="row">
    <div class="col-md-8">
        <p class="alert alert-info" style="font-size: 1rem">Silahkan Input Data Kepengurusan BUM Desa</p>
    </div>
</div>
<div class="mb-3">
    <small class="text-info mt-2"><i>
            Catatan : SK Kepengurusan bisa lebih dari 1 (terdapat penggantian pengurus)</i>
    </small>
</div>
<div class="row">
    <div class="col-md-8">

        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pengurus">
            + Data Kepengurusan
        </button>

        <!-- Modal -->
        <div class="modal fade" id="pengurus" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="staticBackdropLabel">Form Tambah Data Kepengurusan BUM
                            Desa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/adminDesa/pengurusTambah" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                            <input type="hidden" name="jenis" value="{{ $jenis }}">

                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tahunawal">Pengurus sejak Tahun</label>
                                        <input type="number" class="form-control" name="tahunawal"
                                            style="font-size: .85rem" autofocus required>

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tahunsampai">sampai dengan</label>
                                        <input type="text" class="form-control" name="tahunsampai"
                                            style="font-size: .85rem" required>
                                        <small>isi "sekarang" jika masih berlaku</small>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sk_pengurus">Upload SK Kepengurusan</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="sk_pengurus" class="custom-file-input"
                                                id="sk_pengurus" required>
                                            <label class="custom-file-label text-muted sk_pengurus" for="sk_pengurus"
                                                style="font-size: .70rem">Ganti
                                                file PDF
                                                (max-size: 1MB)</label>
                                        </div>
                                    </div>
                                </div>

                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Kirim Data</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <table class="table table-bordered table-striped mt-2">
            <tr>
                <th>No</th>
                <th>Periode</th>
                <th class="text-center">SK Kepengurusan</th>
            </tr>


        </table>

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