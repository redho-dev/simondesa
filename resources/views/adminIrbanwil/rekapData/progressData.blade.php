@extends('templates.adminIrbanwil.main')

@section('content')

<!-- page content -->
<div role="main">
    <div class="">
        <div class="page-title">

            <h3 class="text-center">REKAP PROGRESS INPUT DATA DESA TAHUN {{ $tahun }}</h3>

        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="x_panel">
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered" id="table_progress" width="100%">
                                <thead style="background-color: cornflowerblue">
                                    <tr>
                                        <th>No</th>
                                        <th>Kecamatan</th>
                                        <th>Desa</th>
                                        <th>Pemerintahan Desa</th>
                                        <th></th>
                                        <th>Keuangan Desa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($asals as $as)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $as->kecamatan }}</td>
                                        <td>{{ $as->asal }}</td>
                                        <td>
                                            {{ round($as->nilai_pemerintahan->pluck('persen_data')->sum()/43,2) }} %

                                        </td>
                                        <td>
                                            <span class="fa fa-envelope-o"></span>
                                        </td>
                                        <td>
                                            {{ round($as->nilai_keuangan->pluck('persen_data')->sum()/22,2) }} %
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>




                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->



{{-- notifikasi --}}
@if(session()->has('success'))
<script>
    Swal.fire({
  position: 'center',
  icon: 'success',
  title: '{{ session("success") }}',
  showConfirmButton: true
}).then(function(){
    document.location.href='/logoutIrbanwil';
})
</script>

@endif

@if(session()->has('fail'))
<script>
    Swal.fire({
  position: 'center',
  icon: 'error',
  title: '{{ session("fail") }}',
  showConfirmButton: true
  })
</script>

@endif

@endsection
@push('script')
<script>

</script>
<script>
    $(document).ready(function () {
    $('#table_progress').DataTable({
        scrollX: true,
    });
  
});
</script>

@endpush