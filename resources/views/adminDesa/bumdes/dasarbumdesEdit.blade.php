<div class="row">
    <div class="col-md-9">
        <p class="alert alert-info" style="font-size: 1rem">Silahkan Update/Edit Data Dasar Keuangan BUM Desa</p>
    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <form action="/adminDesa/dasarEdit" method="post" enctype="multipart/form-data">
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
                <tbody>

                    <tr>
                        <th>1</th>
                        <th>Jumlah Total Penyertaan Modal (APB Desa) yang dikelola BUM Desa dari awal
                            sampai saat
                            ini</th>
                        <th>
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-size: .85rem">Rp.</span>
                                </div>
                                <input type="hidden" name="nama_data[]" value="total_modal">
                                <input type="text" name="isi_data[]" class="form-control angka"
                                    style="font-size: .85rem" value="{{ $datas[0]->isi_data }}">
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>2</th>
                        <th>Jumlah Penyertaan Modal (APB Desa) Tahun Anggaran {{ $tahun-1 }}</th>
                        <th>
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-size: .85rem">Rp.</span>
                                </div>
                                <input type="hidden" name="nama_data[]" value="modal_{{ $tahun-1 }}">
                                <input type="text" name="isi_data[]" class="form-control angka"
                                    style="font-size: .85rem" value="{{ $datas[1]->isi_data }}">
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>3</th>
                        <th>Jumlah Penyertaan Modal (APB Desa) Tahun Anggaran {{ $tahun }}</th>
                        <th>
                            <div class=" input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-size: .85rem">Rp.</span>
                                </div>
                                <input type="hidden" name="nama_data[]" value="modal_{{ $tahun }}">
                                <input type="text" name="isi_data[]" class="form-control angka"
                                    style="font-size: .85rem" value="{{ $datas[2]->isi_data }}">
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>4</th>
                        <th>Foto Rekening BUM Desa</th>
                        <th class="d-flex justify-content-between">
                            <div>
                                @if($datas[3]->isi_data)
                                <input type="hidden" name="old1" value="{{  asset('storage/'.$datas[3]->isi_data) }}">
                                <a href="{{ asset('storage/'.$datas[3]->isi_data) }}" target="_blank"><img
                                        src="{{  asset('storage/'.$datas[3]->isi_data) }}" width="50px"></a>
                                @else
                                <p class="text-danger">(kosong)</p>
                                @endif
                            </div>

                            <div class=" form-group">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="hidden" name="nama_data[]" value="foto_rekening">
                                        <input type="hidden" name="isi_data[]">
                                        <input type="file" name="foto_rekening" class="custom-file-input"
                                            id="foto_rekening">
                                        <label class="custom-file-label text-muted foto_rekening" for="foto_rekening"
                                            style="font-size: .70rem">file gambar
                                            (max-size: 1MB)</label>
                                    </div>
                                </div>
                            </div>


                        </th>
                    </tr>
                    <tr>
                        <th>5</th>
                        <th>Printout Buku Rekening BUM Desa dari awal sampai kondisi
                            terakhir </th>
                        <th class="d-flex justify-content-between">
                            <div>
                                @if($datas[4]->isi_data)
                                <input type="hidden" name="old2" value="{{  asset('storage/'.$datas[4]->isi_data) }}">
                                <a href="{{ asset('storage/'.$datas[4]->isi_data) }}" target="_blank"><img
                                        src="{{ asset('/img/logo-pdf.jpg') }}" width="50px"></a>
                                @else
                                <p class="text-danger">(kosong)</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="hidden" name="nama_data[]" value="catatan_rekening">
                                        <input type="hidden" name="isi_data[]">
                                        <input type="file" name="catatan_rekening" class="custom-file-input"
                                            id="catatan_rekening">
                                        <label class="custom-file-label text-muted catatan_rekening"
                                            for="catatan_rekening" style="font-size: .70rem">file pdf
                                            (max-size: 2MB)</label>
                                    </div>
                                </div>
                            </div>
                        </th>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-center"><button class="btn btn-sm btn-primary">Update</button></td>
                    </tr>
                </tfoot>

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
  position: 'center',
  icon: 'success',
  title: '{{ session("update") }}',
  showConfirmButton: false,
  timer: 1500
})
</script>

@endif