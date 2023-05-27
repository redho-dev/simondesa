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
        <h5 class="alert alert-info">Penilaian Indikator : Penatausahaan Belanja</h5>
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
                        <a class="nav-link {{ $jenis=='spp' ? 'active' : ''}}" href="?jenis=spp&tahun={{ $tahun }}"
                            role="tab">SPP Kegiatan
                            <span class="fa fa-check-circle ml-1 {{ $spp ? '' : 'd-none' }}"></span>
                        </a>
                    </li>

                    <li class=" nav-item">
                        <a class="nav-link  {{ $jenis=='tbpu' ? 'active' : ''}} " href="?jenis=tbpu&tahun={{ $tahun }}"
                            role="tab">Tanda Bukti
                            Pengeluaran Uang (TBPU)
                            <span class="fa fa-check-circle ml-1 {{ $bkp ? '' : 'd-none' }}"></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='pembukuan' ? 'active' : ''}}"
                            href="?jenis=pembukuan&tahun={{ $tahun }}" role="tab">Pembukuan
                            <span class="fa fa-check-circle ml-1 {{ $pembukuan ? '' : 'd-none' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='uji_petik' ? 'active' : '' }}"
                            href="?jenis=uji_petik&tahun={{ $tahun }}" role="tab">Uji Petik Bukti
                            Belanja
                            <span class="fa fa-check-circle ml-1 {{ $uji_petik ? '' : 'd-none' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='penilaian' ? 'active' : '' }} {{ $penilaianNull ? 'text-danger' : '' }}"
                            href="?jenis=penilaian&tahun={{ $tahun }}" role="tab">Penilaian Indikator
                            <span class="fa fa-check-circle ml-1 {{ $penilaian ? '' : 'd-none' }}"></span>
                        </a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane active show " id="kewilayahan" role="tabpanel"
                        aria-labelledby="kewilayahan-tab">
                        @if($jenis == 'spp')
                        @include('adminIrbanwil.akunBelanja.dataSPP')
                        @elseif($jenis == 'spp_null')
                        @include('adminIrbanwil.akunBelanja.dataSPPnull')
                        @elseif($jenis == 'spp_ulang')
                        @include('adminIrbanwil.akunBelanja.dataSPPulang')
                        @elseif($jenis == 'tbpu')
                        @include('adminIrbanwil.akunBelanja.dataTBPU')
                        @elseif($jenis == 'spp_kegiatan')
                        @include('adminIrbanwil.akunBelanja.sppKegiatan')
                        @elseif($jenis == 'cek_tbpu')
                        @include('adminIrbanwil.akunBelanja.dataTBPUkegiatan')

                        @elseif($jenis == 'bkp_null')
                        @include('adminIrbanwil.akunBelanja.dataBKPnull')
                        @elseif($jenis == 'bkp_ulang')
                        @include('adminIrbanwil.akunBelanja.dataBKPulang')
                        @elseif($jenis == 'pembukuan')
                        @include('adminIrbanwil.akunBelanja.dataPembukuan')
                        @elseif($jenis == 'uji_petik')
                        @include('adminIrbanwil.akunBelanja.hasilUjipetik')
                        @elseif($jenis == 'penilaian')
                        @include('adminIrbanwil.akunBelanja.nilaiAkunbelanja_e')
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
<script>
    $('#pilcam').on('change', function(){
        var kecamatan = $(this).val();
        $.get('/cariDesa', {data:kecamatan}).done(function(hasil){
            $('#pildes').html("");
            $('#pildes').html(hasil);
        });

        
    })

    $('.reset').on('click', function(){
        konfirm = confirm('anda yakin reset penilaian ?');
        if(konfirm){
        var idbkp = $(this).attr('idbkp');
        var tr = $(this).parents('tr');
        var status = tr.find('.status');
        var nilai = tr.find('.nilai');
        var catatan = tr.find('.catatan');
        $.get('/adminIrbanwil/resetTBPU', {id : idbkp}).done(function(hasil){
            if(hasil=='berhasil'){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'berhasil reset data',
                    showConfirmButton: false,
                    timer: 1500
                    });
                status.html("");
                nilai.html("");
                catatan.html("");

            };
        })
    }

    })

    $('.reset_spp').on('click', function(){
        konfirm = confirm('anda yakin reset penilaian SPP ?');
        if(konfirm){
        var idspp = $(this).attr('idspp');
        var tr = $(this).parents('tr');
        var status = tr.find('.status');
        var nilai = tr.find('.nilai');
        var catatan = tr.find('.catatan');
        $.get('/adminIrbanwil/resetSPP', {id : idspp}).done(function(hasil){
            if(hasil=='berhasil'){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'berhasil reset data',
                    showConfirmButton: false,
                    timer: 1500
                    });
                status.html("");
                nilai.html("");
                catatan.html("");
            };
        })
    }

    })

    $('.koreksi').on('change', function(){
        
        var pilih = $(this).val();
        var row = $(this).parents('.induk_row');
        var koreksi_pajak = row.find('.koreksi_pajak');
        
        if(pilih==1){
            $('.koreksi_pajak').removeClass('d-none');
           $('.koreksi_pajak').show();
        }else{
            $('.koreksi_pajak').hide();
        }
    })

</script>
<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    $('.angka').mask('000.000.000.000.000', {reverse: true});
</script>
@endpush