@extends('templates.adminIrbanwil.main')
@section('css')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
<script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
@endsection

@section('content')
@include('adminIrbanwil.cekObrik')
<?php
if($jenis == 'tanah'){
    $a = "Nama Barang (penggunaan)";
    $merek = "Luas (M<sup>2</sup>)";
    $c = "Nomor Alas Hak";
    $ketjenis = "Tanah";
}elseif($jenis =='peralatan'){
    $a = "Nama Barang";
    $merek = "Merk /Type";
    $c = "Kondisi Barang";
    $ketjenis = "Peralatan dan Mesin";
}
elseif($jenis =='gedung'){
    $a = "Nama Barang (penggunaan)";
    $merek = "Luas Bangunan (M<sup>2</sup>)";
    $c = "Type Bangunan";
    $ketjenis = "Gedung dan Bangunan";

}elseif($jenis =='konstruksi'){
    $a = "Nama Barang";
    $merek = "Type/Bahan Konstruksi";
    $c = "ukuran";
    $ketjenis = "Konstruksi dalam Pengerjaan";

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
                        <a class="nav-link {{ $jenis=='gedung' ? 'active' : '' }}"
                            href="?jenis=gedung&tahun={{ $tahun }}" role="tab">Gedung dan Bangunan
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
                        <a class="nav-link {{ $jenis=='lainnya' ? 'active' : '' }}"
                            href="?jenis=lainnya&tahun={{ $tahun }}" role="tab">Aset Tetap Lainnya
                            <span class="fa fa-check-circle ml-1 {{ $lainnya==0 ? 'd-none' : '' }}"></span>
                        </a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane active show " id="aset" role="tabpanel" aria-labelledby="aset-tab">

                        <h4 class="mt-3 text-center text-primary">KARTU INVENTARIS BARANG (KIB) <br> {{
                            strtoupper($ketjenis) }}</h4>
                        <p class="text-center">Kondisi Pencatatan Aset sampai dengan {{ now()->translatedFormat('l,
                            d-F-Y, h:i:s') }}</p>
                        <div class="form-aset">
                            <hr>


                            <table class="table table-bordered">
                                <thead>
                                    <tr style="background-color: rgb(244, 246, 249)">
                                        <th style="vertical-align : middle">No</th>
                                        <th style="vertical-align : middle">{{ $a }}</th>
                                        <th class="{{ $jenis=='tanah' || $jenis=='gedung' ? '' : 'd-none' }}"
                                            style="vertical-align : middle">
                                            Alamat/Lokasi
                                        </th>
                                        <th style="vertical-align : middle">Kode Barang</th>
                                        <th style="vertical-align : middle">NUP</th>
                                        <th style="vertical-align : middle">Tahun <br>Perolehan</th>
                                        <th style="vertical-align : middle">{!! $merek !!}</th>
                                        <th class="{{ $jenis=='tanah' ? '' : 'd-none' }}"
                                            style="vertical-align : middle">
                                            Alas Hak</th>
                                        <th class="{{ $jenis=='peralatan' || $jenis=='jalan' ? 'd-none' : '' }} text-center"
                                            style="vertical-align : middle">{{ $c }}</th>
                                        <th class="{{ $jenis=='jalan' ? '' : 'd-none' }}"
                                            style="vertical-align : middle">P
                                            (m)</th>
                                        <th class="{{ $jenis=='jalan' ? '' : 'd-none' }}"
                                            style="vertical-align : middle">L
                                            (m)</th>
                                        <th class="{{ $jenis=='tanah' ? 'd-none' : '' }}"
                                            style="vertical-align : middle">
                                            Kondisi</th>
                                        <th class="text-center">Nilai Perolehan <br>(Rp)</th>
                                        <th style="vertical-align : middle">Keterangan</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama_barang }}</td>
                                        <td class="{{ $jenis=='tanah' || $jenis=='gedung' ? '' : 'd-none' }}">
                                            {{ $data->lokasi }}</td>
                                        <td>{{ $data->kode_barang }}</td>
                                        <td>{{ $data->nup }}</td>
                                        <td>{{ $data->tahun_perolehan }}</td>
                                        <td>{{ $data->luas_merk }}</td>
                                        <td class="{{ $jenis=='tanah' ? '' : 'd-none' }}">{{ $data->alas_hak }}</td>
                                        <td class="{{ $jenis=='peralatan' || $jenis=='jalan' ? 'd-none' : '' }}">{{
                                            $data->nomor_kepemilikan }}</td>
                                        <td class="{{ $jenis=='jalan' ? '' : 'd-none' }}"
                                            style="vertical-align : middle">{{
                                            $data->panjang }}</td>
                                        <td class="{{ $jenis=='jalan' ? '' : 'd-none' }}"
                                            style="vertical-align : middle">{{
                                            $data->lebar }}</td>
                                        <td class="{{ $jenis=='tanah' ? 'd-none' : '' }}">{{ $data->kondisi_barang
                                            }}</td>
                                        <td>{{ $data->nilai_perolehan }}</td>
                                        <td>{{ $data->keterangan }}</td>



                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="keterangan">
                            <small>Keterangan : <br>
                                - NUP : diisi dengan Nomor Urut Pendaftaran Barang sesuai Buku Inventaris <br>
                                - Kode Barang: diisi sesuai dengan kodefikasinya <br>
                                <a href="{{ asset('storage/regulasi/pedoman-umum-kodefikasi-aset-desa-oleh-kemendagri.pdf') }}"
                                    class="text-primary" target="_blank">- Klik untuk lihat Pedoman Kodefikasi Barang
                                    oleh
                                    Kemendagri</a></small>
                        </div>

                    </div>
                    <br><br><br><br>
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