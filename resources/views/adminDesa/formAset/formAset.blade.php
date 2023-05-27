@extends('templates.desa.main')

@section('content')
<?php
if($jenis == 'tanah'){
    $a = "Nama Barang (penggunaan)";
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
    $a = "Nama Barang";
    $merek = "Luas Bangunan (M<sup>2</sup>)";
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
        <h5 class="alert alert-info">Form Input/Update Kartu Inventaris Barang (KIB)</h5>
        <div class="x_panel">
            <div class="x_title">
                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formKIB" method="get">
                        @csrf
                        <div class="form-group mx-sm-3 mb-2">
                            <h6>Masukkan tahun data :</h6>
                            <input type="text" name="tahun" class="form-control ml-3" placeholder="{{ $tahun }}"
                                data-inputmask="'mask': '9999'" style="font-size: .85rem">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mb-2">Cek Data</button>
                    </form>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm ml-auto" data-toggle="modal"
                        data-target="#copyDataAll">
                        Copy Seluruh Data KIB
                    </button>

                </div>
                <!-- Modal -->
                <div class="modal fade" id="copyDataAll" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-light" id="staticBackdropLabel">Copy Seluruh Data KIB</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(session()->has('timpaAll'))
                                <div class="alert bg-danger text-white">Sudah ada data Aset tahun {{
                                    session('timpaAll') }}
                                </div>
                                <form action="/adminDesa/copyAsetAll" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tahuncopy">Tetap Copy dan timpa Data Aset Tahun {{
                                            $tahun }} ke
                                            Tahun {{ session('timpaAll') }}
                                            :</label>
                                        <input type="hidden" name="tahuncopy" value="{{ session('timpaAll') }}">
                                        <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                        <input type="hidden" name="tahunasal" value="{{ $tahun }}">
                                        <input type="hidden" name="timpadata" value="oke">
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Copy Data</button>
                            </div>
                            </form>
                            @else
                            <form action="/adminDesa/copyAsetAll" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="tahuncopy">Copy Seluruh Data Aset Tahun {{ $tahun }} ke Tahun
                                        :</label>
                                    <select class="form-control" id="tahuncopy" name="tahuncopy" required>
                                        <option value="">== pilih tahun ==</option>
                                        <option>{{ $tahun+1 }}</option>
                                        <option>{{ $tahun+2 }}</option>
                                        <option>{{ $tahun+3 }}</option>


                                    </select>
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahunasal" value="{{ $tahun }}">
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Copy Data</button>
                        </div>
                        </form>
                        @endif

                    </div>
                </div>
            </div>
            <hr>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                            class="fa fa-wrench"></i></a>

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
                    <a class="nav-link {{ $jenis=='tanah' ? 'active' : '' }}" href="?jenis=tanah&tahun={{ $tahun }}"
                        role="tab">Tanah
                        <span class="fa fa-check-circle ml-1 {{ $tanah==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='peralatan' ? 'active' : '' }}"
                        href="?jenis=peralatan&tahun={{ $tahun }}" role="tab">Perlatan dan Mesin
                        <span class="fa fa-check-circle ml-1 {{ $peralatan==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='gedung' ? 'active' : '' }}" href="?jenis=gedung&tahun={{ $tahun }}"
                        role="tab">Gedung dan Bangunan
                        <span class="fa fa-check-circle ml-1 {{ $gedung==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='jalan' ? 'active' : '' }}" href="?jenis=jalan&tahun={{ $tahun }}"
                        role="tab">Jalan,
                        Irigasi dan Jaringan
                        <span class="fa fa-check-circle ml-1 {{ $jalan==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='konstruksi' ? 'active' : '' }}"
                        href="?jenis=konstruksi&tahun={{ $tahun }}" role="tab">Konstruksi dalam Pengerjaan
                        <span class="fa fa-check-circle ml-1 {{ $konstruksi==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $jenis=='lainnya' ? 'active' : '' }}" href="?jenis=lainnya&tahun={{ $tahun }}"
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

@if(session()->has('timpaAll'))
<script>
    $('#copyDataAll').modal('show');

</script>
@endif

@endpush