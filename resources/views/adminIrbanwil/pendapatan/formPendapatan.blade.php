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
        <h5 class="alert alert-info">Penilaian Indikator : Penatausahaan Pendapatan</h5>
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
                        <a class="nav-link  {{ $jenis=='pengajuan' ? 'active' : '' }}"
                            href="?jenis=pengajuan&tahun={{ $tahun }}" role="tab">Dokumen Pengajuan &
                            Penerimaan
                            <span class="fa fa-check-circle ml-1 {{ $pengajuan ? '' : 'd-none' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{ $jenis=='cek_pengajuan' ? 'active' : '' }}"
                            href="?jenis=cek_pengajuan&tahun={{ $tahun }}" role="tab">Cek Dokumen
                            Pengajuan & Penerimaan

                        </a>
                    </li>
                    <li class=" nav-item">
                        <a class="nav-link  {{ $jenis=='buku_pembantu_bank' ? 'active' : '' }} "
                            href="?jenis=buku_pembantu_bank&tahun={{ $tahun }}" role="tab">Buku
                            Pembantu Banks
                            <span class="fa fa-check-circle ml-1  {{ $bukuBank ? '' : 'd-none' }}"></span>
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
                        @include('adminIrbanwil.pendapatan.nilaiAkunpendapatan')
                        @elseif($jenis == 'pengajuan' OR $jenis=='cek_pengajuan' OR $jenis=='buku_pembantu_bank')
                        <p class="text-center text-danger">data kosong</p>
                        @else
                        <h4 class="text-center">Klik tab untuk lihat data</h4>
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
  position: 'top-end',
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