@extends('templates.adminIrbanwil.main')
@section('css')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
<script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
@endsection

@section('content')
@include('adminIrbanwil.cekObrik')
<div class="clearfix"></div>
<div class="row justify-content-center mt-2">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Penilaian Indikator : Pengadaan Barang dan Jasa (Pengadaan Aset Tetap Kantor)</h5>
        <div class="x_panel">
            <div class="x_title">
                <p class="text-primary" style="font-size: 1rem">Desa {{ $desa->asal }} - Kecamatan {{ $desa->kecamatan
                    }} - Tahun Data {{ $tahun }}
                </p>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='survey' ? 'active' : '' }} {{ $perbaikanSurvey ? 'text-danger' : '' }}"
                            href="?jenis=survey&tahun={{ $tahun }}" role="tab">Survey Harga
                            <span class="fa fa-check-circle ml-1 {{ $survey ? '' : 'd-none' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='realisasi' ? 'active' : '' }}  {{ $perbaikanAset ? 'text-danger' : '' }}"
                            href="?jenis=realisasi&tahun={{ $tahun }}" role="tab">Realisasi
                            Belanja Modal (Aset Barang)
                            <span class="fa fa-check-circle ml-1 {{ $realisasi ? '' : 'd-none' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='nonlapor' ? 'active' : '' }} "
                            href="?jenis=nonlapor&tahun={{ $tahun }}" role="tab">Cek Belanja Modal(Aset Barang) Yang
                            Tidak Terlapor
                            <span class="fa fa-check-circle ml-1 {{ count($nonlapor) ? '' : 'd-none' }}"></span>
                        </a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane active show " id="kewilayahan" role="tabpanel"
                        aria-labelledby="kewilayahan-tab">

                        <h4 class="text-center my-4">Klik tab untuk lihat data</h4>

                    </div>

                </div>
            </div>
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

@if(session()->has('fail'))
<script>
    Swal.fire({
  position: 'center',
  icon: 'error',
  title: '{{ session("fail") }}',
  showConfirmButton: false,
  timer: 1500
})
</script>

@endif

@endsection
@push('script')
<script>
    $('#pilcam').on('change', function(){
        var kecamatan = $(this).val();
        $.get('/cariDesa', {data:kecamatan}).done(function(hasil){
            $('#pildes').html("");
            $('#pildes').html(hasil);
        });

        
    })
</script>

@endpush