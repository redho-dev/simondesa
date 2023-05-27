<?php
if($jenis == 'tanah'){
    $a = "Jenis Tanah / Penggunaan";
    $merek = "Luas"."<br>"."(M <sup>2</sup>)";
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

<style>
    th {
        padding: 3px;
    }
</style>
<p style="text-align: center">KARTU INVENTARIS BARANG (KIB) <br> {{ strtoupper($ketjenis) }}</p>
<table style="font-size: .8rem">
    <tr>
        <td>Kabupaten</td>
        <td>: Lampung Utara</td>
    </tr>
    <tr>
        <td>Kecamatan</td>
        <td>: {{ $infos->asal->kecamatan }}</td>
    </tr>
    <tr>
        <td>Desa</td>
        <td>: {{ $infos->asal->asal }}</td>
        <td width="700px" align="right">Kode Lokasi : {{ $infos->asal->kd_desa }}</td>
    </tr>

</table>
<br>
<table border="1" style="border-collapse: collapse; border : black 1px solid ; font-size : .8rem" width="100%">
    <thead style="background-color:beige">
        <tr style="border : black 1px solid">
            <th style="vertical-align : middle">No</th>
            <th style="vertical-align : middle">{{ $a }}</th>
            <th class=""
                style="vertical-align : middle ; {{ $jenis=='tanah' || $jenis=='gedung' ? '' : 'display:none' }}">
                Alamat/Lokasi
            </th>
            <th style="vertical-align : middle">Kode Barang</th>
            <th style="vertical-align : middle">NUP</th>
            <th style="vertical-align : middle">Tahun <br>Perolehan</th>
            <th style="vertical-align : middle">{!! $merek !!}</th>
            <th class="" style="vertical-align : middle; {{ $jenis=='tanah' ? '' : 'display:none' }}">Alas Hak</th>
            <th class=""
                style="vertical-align : middle; {{ $jenis=='peralatan' || $jenis=='jalan' ? 'display:none' : '' }}">{{
                $c }}</th>
            <th class="" style="vertical-align : middle ; {{ $jenis=='jalan' ? '' : 'display:none' }}">P (m)</th>
            <th class="" style="vertical-align : middle; {{ $jenis=='jalan' ? '' : 'display:none' }}">L (m)</th>
            <th class="" style="vertical-align : middle; {{ $jenis=='tanah' ? 'display:none' : '' }}">Kondisi</th>
            <th class="text-center">Nilai Perolehan <br>(Rp)</th>
            <th style="vertical-align : middle">Keterangan</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr style="border : black 1px 1px solid">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->nama_barang }}</td>
            <td style="vertical-align : middle ; {{ $jenis=='tanah' || $jenis=='gedung' ? '' : 'display:none' }}">
                {{ $data->lokasi }}</td>
            <td align="center">{{ $data->kode_barang }}</td>
            <td align="center">{{ $data->nup }}</td>
            <td align="center">{{ $data->tahun_perolehan }}</td>
            <td align="center">{{ $data->luas_merk }}</td>
            <td align="center" style="vertical-align : middle; {{ $jenis=='tanah' ? '' : 'display:none' }}">{{
                $data->alas_hak }}</td>
            <td align="center"
                style="vertical-align : middle; {{ $jenis=='peralatan' || $jenis=='jalan' ? 'display:none' : '' }}">{{
                $data->nomor_kepemilikan }}</td>
            <td align="center" style="vertical-align : middle ; {{ $jenis=='jalan' ? '' : 'display:none' }}">{{
                $data->panjang }}</td>
            <td align="center" style="vertical-align : middle ; {{ $jenis=='jalan' ? '' : 'display:none' }}">{{
                $data->lebar }}</td>
            <td align="center" style="vertical-align : middle; {{ $jenis=='tanah' ? 'display:none' : '' }}">{{
                $data->kondisi_barang
                }}</td>
            <td align="center">{{ $data->nilai_perolehan }}</td>
            <td>{{ $data->keterangan }}</td>

        </tr>
        @endforeach
    </tbody>
</table>
<br><br>
<table style="width: 100%">
    <tr>
        <td align="center" width="50%"></td>
        <td align="center">{{ $infos->asal->asal }}, {{ now()->translatedFormat('
            d-F-Y') }}</td>
    </tr>
    <tr>
        <td align="center">Mengetahui <br> Kepala Desa,</td>
        <td align="center">Pengelola/Bendahara <br> Barang Desa</td>
    </tr>

    <tr>
        <td align="center" style="padding-top: 30px">{{ $kades }}</td>
        <td align="center" style="padding-top: 30px">(..........................)</td>
    </tr>
</table>

<script src="/vendors/jquery/dist/jquery.js"></script>

<!-- Bootstrap -->
<script src="/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>