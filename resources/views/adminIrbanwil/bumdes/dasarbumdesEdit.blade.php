<div class="row">
    <div class="col-md-9">
        <p class="alert alert-info" style="font-size: 1rem">Silahkan Update/Edit Data Dasar Keuangan BUM Desa</p>
    </div>
</div>

<div class="row">
    <div class="col-md-9">

        <table class="table table-bordered table-striped">
            <thead class="table-secondary">
                <tr>
                    <th>No</th>
                    <th>Uraian</th>
                    <th class="text-center">Isi Data</th>

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
                            <input type="text" name="isi_data[]" class="form-control angka" style="font-size: .85rem"
                                value="{{ $datas[0]->isi_data }}" readonly>
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
                            <input type="text" name="isi_data[]" class="form-control angka" style="font-size: .85rem"
                                value="{{ $datas[1]->isi_data }}" readonly>
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
                            <input type="text" name="isi_data[]" class="form-control angka" style="font-size: .85rem"
                                value="{{ $datas[2]->isi_data }}" readonly>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>4</th>
                    <th>Foto Rekening BUM Desa</th>
                    <th class="text-center">
                        <div>
                            @if($datas[3]->isi_data)
                            <input type="hidden" name="old1" value="{{  asset('storage/'.$datas[3]->isi_data) }}">
                            <a href="{{ asset('storage/'.$datas[3]->isi_data) }}" target="_blank"><img
                                    src="{{  asset('storage/'.$datas[3]->isi_data) }}" width="75px"></a>
                            @else
                            <p class="text-danger">(kosong)</p>
                            @endif
                        </div>




                    </th>
                </tr>
                <tr>
                    <th>5</th>
                    <th>Printout Buku Rekening BUM Desa dari awal sampai kondisi
                        terakhir </th>
                    <th class="text-center">
                        <div>
                            @if($datas[4]->isi_data)
                            <input type="hidden" name="old2" value="{{  asset('storage/'.$datas[4]->isi_data) }}">
                            <a href="{{ asset('storage/'.$datas[4]->isi_data) }}" target="_blank"><img
                                    src="{{ asset('/img/logo-pdf.jpg') }}" width="75px"></a>
                            @else
                            <p class="text-danger">(kosong)</p>
                            @endif
                        </div>

                    </th>
                </tr>

            </tbody>

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
  position: 'center',
  icon: 'success',
  title: '{{ session("update") }}',
  showConfirmButton: false,
  timer: 1500
})
</script>

@endif