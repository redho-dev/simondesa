<div class="row">
    <div class="col-md-8">


        <table class="table table-bordered table-striped mt-2">
            <tr>
                <th>No</th>
                <th>Periode</th>
                <th class="text-center">SK Kepengurusan</th>

            </tr>
            @foreach($datas as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->nama_data }}</td>
                <td class="text-center">
                    <a href="{{ asset('storage/'.$data->isi_data) }}" target="_blank"><img
                            src="{{ asset('/img/logo-pdf.jpg') }}" width="50px"></a>
                </td>

            </tr>
            @endforeach
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