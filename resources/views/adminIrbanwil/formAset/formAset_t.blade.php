@extends('templates.adminIrbanwil.main')
@section('css')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
<script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
@endsection

@section('content')
@include('adminIrbanwil.cekObrik')
<?php
if($jenis == 'tanah'){
    $a = "Jenis Tanah / Penggunaan";
    $merek = "Luas (M <sup>2</sup>)";
    $c = "Nomor Alas Hak";
    $ketjenis = "Tanah";
}elseif($jenis =='peralatan'){
    $a = "Nama Barang";
    $merek = "Merk /Type";
    $c = "Kondisi Barang";
    $ketjenis = "Peralatan dan Mesin";
}
elseif($jenis =='gedung'){
    $a = "Jenis Gedung dan Bangunan";
    $merek = "Luas Bangunan (M <sup>2</sup>)";
    $c = "Type Bangunan";
    $ketjenis = "Gedung dan Bangunan";

}elseif($jenis =='kendaraan'){
    $a = "Nama Barang";
    $merek = "Merk /Type";
    $c = "Nomor BPKB";
    $ketjenis = "Kendaraan Bermotor";

}elseif($jenis =='jalan'){
    $a = "Nama atau Jenis Jalan/Irigasi/Jaringan ";
    $merek = "Type";
    $c = "Ukuran";
    $ketjenis = "Jalan, Irigasi dan Jaringan";
}elseif($jenis =='lainnya'){
    $a = "Nama Barang";
    $merek = "Merk/Type";
    $c = "Ukuran";
    $ketjenis = "Aset Tetap Lainnya";
}else{
    $a = "Nama Barang";
    $merek = "Merk/Type";
    $c = "Ukuran";
    $ketjenis = "Aset Tetap Lainnya";
}

?>
<div class="clearfix"></div>
<div class="row justify-content-center mt-2">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Penilaian Indikator : Penataan Aset (Kartu Inventaris Barang)</h5>
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
                        <a class="nav-link {{ $jenis=='tanah' ? 'active' : '' }}" href="?jenis=tanah" role="tab">Tanah
                            <span class="fa fa-check-circle ml-1 {{ $tanah==0 ? 'd-none' : '' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='peralatan' ? 'active' : '' }}" href="?jenis=peralatan"
                            role="tab">Perlatan dan Mesin
                            <span class="fa fa-check-circle ml-1 {{ $peralatan==0 ? 'd-none' : '' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='gedung' ? 'active' : '' }}" href="?jenis=gedung"
                            role="tab">Gedung dan Bangunan
                            <span class="fa fa-check-circle ml-1 {{ $gedung==0 ? 'd-none' : '' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='kendaraan' ? 'active' : '' }}" href="?jenis=kendaraan"
                            role="tab">Kendaraan Bermotor
                            <span class="fa fa-check-circle ml-1 {{ $kendaraan==0 ? 'd-none' : '' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='jalan' ? 'active' : '' }}" href="?jenis=jalan" role="tab">Jalan,
                            Irigasi dan Jaringan
                            <span class="fa fa-check-circle ml-1 {{ $jalan==0 ? 'd-none' : '' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='lainnya' ? 'active' : '' }}" href="?jenis=lainnya"
                            role="tab">Aset Tetap Lainnya
                            <span class="fa fa-check-circle ml-1 {{ $lainnya==0 ? 'd-none' : '' }}"></span>
                        </a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane active show " id="aset" role="tabpanel" aria-labelledby="aset-tab">


                        <h4 class="text-center mt-4">Silahkan Pilih Tab untuk Menambah/Edit Data Aset</h4>


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
<script src="/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<script>
    $('.angka').mask('000.000.000.000.000', {reverse: true});

    $('.hapusAset').on('click', function(e){
        e.preventDefault();
        var tanya = confirm('yakin Hapus?');
        var form = $(this).parents('form');
        if(tanya){
            form.submit();
        }
    })
</script>



@endpush