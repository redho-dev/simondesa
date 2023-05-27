<div class="row">
    <div class="col-md-8">
        <p class="alert alert-info" style="font-size: 1rem">Silahkan Input Data Proposal Pengajuan Modal Sejak Awal
            Berdiri BUM Desa</p>
    </div>
</div>
<div class="mt-2 mb-4">
    <small class="text-info">
        <i>
            Catatan : <br>
            - Setiap penyertaan podal wajib didahului dengan Proposal Pengajuan Modal <br>
            - Proposal Pengajuan Modal memuat estimasi jumlah modal dengan analisa bisnis dan rincian penggunaan

        </i>
    </small>

</div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#staticBackdrop">
    + Dokumen Proposal Pengajuan Modal
</button>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-dark" id="staticBackdropLabel">Input Dokumen Proposal Pengajuan Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/adminDesa/proposalTambah" method="post" action="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                    <input type="hidden" name="jenis" value="{{ $jenis }}">

                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="tahun_proposal">Tahun Proposal</label>
                                <input type="number" class="form-control" name="tahun_proposal"
                                    style="font-size: .85rem" autofocus required>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="tahun_proposal">Upload Dokumen Proposal</label>

                                <div class="input-group">
                                    <div class="custom-file">

                                        <input type="file" name="proposal" class="custom-file-input" id="proposal"
                                            style="font-size: .85rem" required>
                                        <label class="custom-file-label text-muted proposal" for="proposal"
                                            style="font-size: .85rem">file pdf
                                            (max-size: 5 MB)</label>
                                    </div>
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


<div class="row mt-2">
    <div class="col-md-8">
        <form action="/adminDesa/dasarTambah" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="jenis" value="{{ $jenis }}">

            <table class="table table-bordered table-striped">
                <thead class="table-secondary">
                    <tr>
                        <th>No</th>
                        <th>Uraian</th>
                        <th>Input Data</th>

                    </tr>
                </thead>


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