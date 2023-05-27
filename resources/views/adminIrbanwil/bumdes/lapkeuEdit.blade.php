<div class="row">
    <div class="col-md-8">
        <p class="alert alert-info" style="font-size: 1rem">Silahkan Update Data Laporan Keuangan BUM Desa</p>
    </div>
</div>
<div class="mt-2 mb-4">
    <small class="text-info">
        <i>
            Catatan : <br>
            - Laporan Keuangan BUM Desa Tahunan harus dibuat setiap akhir tahun (dengan atau tanpa adanya penyertaan
            modal
            pada tahun itu) <br>
            - Laporan Keuangan BUM Desa Tahunan sebagaimana dimaksud memuat antara lain kondisi keuangan terakhir dan
            laporan rugi/laba

        </i>
    </small>

</div>


<div class="row mt-2">
    <div class="col-md-8">

        <table class="table table-bordered ">
            <thead class="table-secondary">
                <tr>
                    <th>No</th>
                    <th>Uraian</th>
                    <th class="text-center">Dokumen Laporan</th>

                </tr>
            </thead>
            <tbody>
                @foreach($datas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->nama_data }}</td>
                    <td class="text-center"><a href="{{ asset('storage/'.$data->isi_data) }}" target="_blank"><img
                                src="{{ asset('/img/logo-pdf.jpg') }}" width="50px"></a></td>

                </tr>
                @endforeach
            </tbody>


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