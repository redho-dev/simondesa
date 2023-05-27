<div class="row">
    <div class="col-md-9">

        <table class="table table-bordered table-striped">
            <tr class="table-secondary">
                <th>No</th>
                <th>Nama Data</th>
                <th class="text-center">Isi Data</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Apakah BUM Desa telah terdaftar di Kemenkum HAM (berbadan hukum)</td>
                <td class="text-center">

                    {{ $datas[0]->isi_data }}

                </td>
            </tr>
            <tr id="skHukum" class="{{ $datas[0]->isi_data=='sudah' ? '' : 'd-none' }}">
                <td></td>
                <td>Surat Keterangan Terdaftar Kemenkum HAM (print out)</td>
                <td class="text-center">
                    <div>
                        @if($datas[7]->isi_data)
                        <a href="{{ asset('storage/'.$datas[7]->isi_data) }}" target="_blank"><img
                                src="{{ asset('/img/logo-pdf.jpg') }}" width="50px"></a>
                        @else
                        <p class="text-danger">(kosong)</p>
                        @endif
                    </div>

                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Nama BUM Desa</td>
                <td class="text-center">
                    <input type="text" class="form-control text-center" name="isi_data[]" required autofocus
                        style="font-size: .85rem" value="{{ $datas[1]->isi_data }}" readonly>
                </td>
            </tr>

            <tr>
                <td>3</td>
                <td>Nomor Perdes Pembentukan BUM Desa </td>
                <td>
                    <input type="number" class="form-control text-center" style="font-size: .85rem" name="isi_data[]"
                        value="{{ $datas[2]->isi_data }}" readonly>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>Tahun Pembentukan BUM Desa</td>
                <td>
                    <input type="number" class="form-control text-center" style="font-size: .85rem" name="isi_data[]"
                        value="{{ $datas[3]->isi_data }}" readonly>
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td>Dokumen Perdes Pembentukan BUM Desa</td>
                <td class="text-center">
                    <div>
                        @if($datas[4]->isi_data)

                        <a href="{{ asset('storage/'.$datas[4]->isi_data) }}" target="_blank"><img
                                src="{{ asset('/img/logo-pdf.jpg') }}" width="50px"></a>
                        @else
                        <p class="text-danger">(kosong)</p>
                        @endif
                    </div>

                </td>
            </tr>
            <tr>
                <td>6</td>
                <td>Anggaran Dasar / Anggaran Rumah Tangga (AD/ART)</td>
                <td class="text-center">
                    <div>
                        @if($datas[5]->isi_data)

                        <a href="{{ asset('storage/'.$datas[5]->isi_data) }}" target="_blank"><img
                                src="{{ asset('/img/logo-pdf.jpg') }}" width="50px"></a>
                        @else
                        <p class="text-danger">(kosong)</p>
                        @endif
                    </div>
                </td>
            </tr>
            <tr>
                <td>7</td>
                <td>Dokumen Perdes Penyertaan Modal</td>
                <td class="text-center">
                    <div>
                        @if($datas[6]->isi_data)
                        <input type="hidden" name="old3" value="{{ $datas[6]->isi_data }}">
                        <a href="{{ asset('storage/'.$datas[6]->isi_data) }}" target="_blank"><img
                                src="{{ asset('/img/logo-pdf.jpg') }}" width="50px"></a>
                        @else
                        <p class="text-danger">(kosong)</p>
                        @endif
                    </div>
                </td>
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