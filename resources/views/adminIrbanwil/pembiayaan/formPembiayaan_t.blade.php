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
        <h5 class="alert alert-info">Penilaian Indikator : Penatausahaan Pembiayaan</h5>
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
                        <a class="nav-link {{ $jenis=='penerimaan' ? 'active' : '' }}"
                            href="?jenis=penerimaan&tahun={{ $tahun }}" role="tab">Penerimaan Pembiayaan
                            <span class="fa fa-check-circle ml-1 {{ count($penerimaan) ? '' : 'd-none' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='pengeluaran' ? 'active' : '' }}"
                            href="?jenis=pengeluaran&tahun={{ $tahun }}" role="tab">Pengeluaran
                            Pembiayaan
                            <span class="fa fa-check-circle ml-1 {{ count($pengeluaran) ? '' : 'd-none' }}"></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='penilaian' ? 'active' : '' }} {{ $perbaikan ? 'text-danger' : '' }}"
                            href="?jenis=penilaian&tahun={{ $tahun }}" role="tab">
                            Penilaian
                            <span class="fa fa-check-circle ml-1  {{ $penilaian > 0 ? '' : 'd-none' }}"></span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane active show " id="kewilayahan" role="tabpanel"
                        aria-labelledby="kewilayahan-tab">
                        @if($jenis=='penilaian')
                        @include('adminIrbanwil.pembiayaan.nilaiAkunpembiayaan')
                        @elseif($jenis=='penerimaan')
                        @include('adminIrbanwil.pembiayaan.dataPenerimaanPembiayaan')
                        @elseif($jenis=='pengeluaran')
                        @include('adminIrbanwil.pembiayaan.dataPengeluaranPembiayaan')
                        @endif
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    $('#pilcam').on('change', function(){
        var kecamatan = $(this).val();
        $.get('/cariDesa', {data:kecamatan}).done(function(hasil){
            $('#pildes').html("");
            $('#pildes').html(hasil);
        });

        
    });


    $('.angka').mask('000.000.000.000.000', {reverse: true});
</script>

@endpush