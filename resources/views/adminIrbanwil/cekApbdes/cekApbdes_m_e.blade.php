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
        <h5 class="alert alert-info">Cek Kesesuaian APB Desa Tahun Anggaran {{ $tahun }} dengan Input Data Simondes</h5>
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
                        <a class="nav-link {{ $jenis=='apbdesm' ? 'active' : '' }}"
                            href="?jenis=apbdesm&tahun={{ $tahun }}" role="tab">Data APBDes Murni
                            <span class="fa fa-check-circle ml-1 {{ $apbdesm==0 ? 'd-none' : '' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='catatan' ? 'active' : '' }} "
                            href="?jenis=catatan&tahun={{ $tahun }}" role="tab">Tanggapan/Catatan
                            <span class="fa fa-check-circle ml-1 {{ $catatan==0 ? 'd-none' : '' }}"></span>
                        </a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane active show " id="kewilayahan" role="tabpanel"
                        aria-labelledby="kewilayahan-tab">
                        @if($jenis=='apbdesm')
                        @include('adminIrbanwil.cekApbdes.dataApbdes_m')
                        @elseif($jenis=='catatan')
                        @include('adminIrbanwil.cekApbdes.catatanApbdes_e')
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
    $('#pilcam').on('change', function(){
        var kecamatan = $(this).val();
        $.get('/cariDesa', {data:kecamatan}).done(function(hasil){
            $('#pildes').html("");
            $('#pildes').html(hasil);
        });

        
    })
</script>

@endpush