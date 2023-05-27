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
        <h5 class="alert alert-info">Penilaian Indikator : Kepatuhan Pajak</h5>
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
                        <a class="nav-link" href="?jenis=rekon" role="tab">Rekon Pajak Tahun {{
                            $tahun }}
                            <span class="fa fa-check-circle ml-1  {{ count($rekon) ? '' : 'd-none' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?jenis=ssp" role="tab"> SSP Tahun {{ $tahun }}
                            <span class="fa fa-check-circle ml-1 {{ count($ssp)>0 ? '' : 'd-none' }}"></span>
                        </a>
                    </li>
                    <li class=" nav-item">
                        <a class="nav-link " href="?jenis=buku_pajak" role="tab">Buku
                            Pembantu Pembantu Pajak
                            <span class="fa fa-check-circle ml-1 {{ count($buku)>0 ? '' : 'd-none' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='penilaian' ? 'active' : '' }} {{ $perbaikan ? 'text-danger' : '' }}"
                            href="?jenis=penilaian" role="tab">
                            Penilaian
                            <span class="fa fa-check-circle ml-1  {{ $penilaian > 0 ? '' : 'd-none' }}"></span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane active show " id="kewilayahan" role="tabpanel"
                        aria-labelledby="kewilayahan-tab">

                        <h4 class="text-center">Klik tab untuk lihat data</h4>

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