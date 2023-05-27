<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <style>
        #table-2 {
            border-collapse: collapse;
            font-size: .8rem;
        }

        th,
        td {
            padding: 5px;
        }

        thead {
            background-color: beige;
        }

        .d-none {
            display: none;
        }
    </style>
</head>

<body>



    <p style="text-align: center">BUKU INVENTARIS ASET DESA <br> PEMERINTAH DESA {{ strtoupper($infos->asal->asal) }}
        <br> TAHUN {{
        $tahun
        }}
    </p>
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
    <table class="table table-bordered" id="table-2" border="1">
        <thead class="table-secondary">
            <tr>
                <th rowspan="2" style="vertical-align: middle
                " align="center">NUP</th>
                <th rowspan="2" style="vertical-align: middle
                " align="center">Jenis/Nama Barang</th>
                <th rowspan="2" style="vertical-align: middle
                " align="center">Kode Barang</th>
                <th rowspan="2" style="vertical-align: middle
                " align="center">Identitas Barang</th>
                <th colspan="3" style="vertical-align: middle
                " align="center">Asal-usul Barang</th>
                <th rowspan="2" style="vertical-align: middle
                " align="center">Tahun Perolehan</th>
                <th align="center" rowspan="2" style="vertical-align: middle
                " align="center">Nilai Perolehan <br>(Rp)</th>
                <th rowspan="2" style="vertical-align: middle
                " align="center">Ket</th>
            </tr>
            <tr>

                <td align="center">APB Desa</td>
                <td align="center">Perolehan Lain yg Sah</td>
                <td align="center">Kekayan Asli Desa</td>

            </tr>
        </thead>
        <tbody>
            @foreach($asets as $aset)
            @php
            if ($aset->jenis == 'tanah') {
            $identitas = $aset->lokasi. "- LT: $aset->luas_merk M2";

            }elseif($aset->jenis == 'gedung'){
            $identitas = $aset->lokasi. "- LB: $aset->luas_merk M2";
            }elseif($aset->jenis == 'jalan'){
            $identitas = $aset->luas_merk . "- P: $aset->panjang M, L: $aset->lebar M";
            }else{
            $identitas = $aset->luas_merk;
            }
            @endphp
            <tr>
                <td>{{ $aset->nup }}</td>
                <td>{{ $aset->nama_barang }}</td>
                <td>{{ $aset->kode_barang }}</td>
                <td>{{ $identitas }}</td>
                <td align="center">
                    <div class="{{ $aset->asal_usul == 'APB Desa' ? '' : 'd-none' }}">
                        <img src="{{ asset('/img/done.png') }}" width="15px">
                    </div>
                    {{-- <i class="fa fa-check {{ $aset->asal_usul == 'APB Desa' ? '' : 'd-none' }}"></i> --}}
                </td>
                <td align="center">
                    <div class="{{ $aset->asal_usul == 'Perolehan Lain yang Sah' ? '' : 'd-none' }}">
                        <img src="{{ asset('/img/done.png') }}" width="15px">
                    </div>

                </td>
                <td align="center">
                    <div class="{{ $aset->asal_usul == 'Aset Asli Desa' ? '' : 'd-none' }}">
                        <img src="{{ asset('/img/done.png') }}" width="15px">
                    </div>

                </td>
                <td align="center">{{ $aset->tahun_perolehan }}</td>
                <td class="nilai" align="right">{{ $aset->nilai_perolehan }}</td>
                <td>{{ $aset->keterangan }}</td>
            </tr>
            @endforeach
            <tr align="table-info">
                <td colspan="8" align="center">TOTAL NILAI PEROLEHAN ASET </td>
                <td align="right">{{ $total }}</td>
                <td></td>
            </tr>
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


</body>

</html>