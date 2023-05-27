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
        <h5 class="alert alert-info">Penilaian Indikator : Data Umum / Monografi</h5>
        <div class="x_panel">
            <div class="x_title">
                <p class="text-primary" style="font-size: 1rem">Desa {{ $desa->asal }}, Kecamatan {{ $desa->kecamatan }}
                </p>
                <hr>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>

                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="text-dark">Tahun Data : {{ $tahun }}

                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='kewilayahan' ? 'active' : '' }}"
                            href="?jenis=kewilayahan&tahun={{ $tahun }}" role="tab">Wilayah
                            <span class="fa fa-check-circle ml-1 {{ $kewilayahan==0 ? 'd-none' : '' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='kependudukan' ? 'active' : '' }}"
                            href="?jenis=kependudukan&tahun={{ $tahun }}" role="tab">Kependudukan
                            <span
                                class="fa fa-check-circle ml-1 {{ $kependudukan==0 || $pekerjaan==0 ? 'd-none' : '' }}"></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='sarpras' ? 'active' : '' }}"
                            href="?jenis=sarpras&tahun={{ $tahun }}" role="tab">Sarana-Prasarana
                            <span class="fa fa-check-circle ml-1 {{ $sarpras==0 ? 'd-none' : '' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='kelembagaan' ? 'active' : '' }}"
                            href="?jenis=kelembagaan&tahun={{ $tahun }}" role="tab">Kelembagaan
                            <span class="fa fa-check-circle ml-1 {{ $kelembagaan==0 ? 'd-none' : '' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='papan' ? 'active' : '' }}" href="?jenis=papan&tahun={{ $tahun }}"
                            role="tab">Papan Monografi
                            <span class="fa fa-check-circle ml-1 {{ $papan==0 ? 'd-none' : '' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='perangkat' ? 'active' : '' }}"
                            href="?jenis=perangkat&tahun={{ $tahun }}" role="tab">Data Perangkat,BPD,RT
                            <span class="fa fa-check-circle ml-1 {{ $perangkat==0 ? 'd-none' : '' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ $jenis=='nilai_datum' ? 'active' : '' }} {{ $perbaikan ? 'text-danger' : '' }}"
                            href="?jenis=nilai_datum&tahun={{ $tahun }}" role="tab">Penilaian
                            <span class="fa fa-check-circle ml-1 {{ $nilai==0 ? 'd-none' : '' }}"></span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane active show " id="kewilayahan" role="tabpanel"
                        aria-labelledby="kewilayahan-tab">
                        @if($jenis=='kewilayahan')
                        @include('adminIrbanwil.formDatum.wilayah')
                        @elseif($jenis=='kependudukan')
                        @include('.adminIrbanwil.formDatum.kependudukan')
                        @elseif($jenis=='pekerjaan')
                        @include('.adminIrbanwil.formDatum.pekerjaan')
                        @elseif($jenis=='sarpras')
                        @include('.adminIrbanwil.formDatum.sarpras')
                        @elseif($jenis=='kelembagaan')
                        @include('.adminIrbanwil.formDatum.kelembagaan')
                        @elseif($jenis=='papan')
                        @include('.adminIrbanwil.formDatum.papan')
                        @elseif($jenis=='perangkat')
                        @include('.adminIrbanwil.formDatum.perangkat')
                        @elseif($jenis=='nilai_datum')
                        @include('.adminIrbanwil.formDatum.nilaiDatum_e')
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

@endsection
@push('script')

<script>
    $('input').attr('readonly', 'readonly');
    $('.nilai').removeAttr('readonly');
    $('#tahun').removeAttr('readonly');


    $('#pilcam').on('change', function(){
        var kecamatan = $(this).val();
        $.get('/cariDesa', {data:kecamatan}).done(function(hasil){
            $('#pildes').html("");
            $('#pildes').html(hasil);
        });

        
    })

</script>
<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
@endpush