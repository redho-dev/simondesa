<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Hasil Invetarisasi Jalan Irigasi dan Jaringan</title>
    {{-- <!-- Bootstrap -->
    <link href="/vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet"> --}}
    <!-- Font Awesome -->
    <link href="/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
 
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
        }
        th {
            background-color: rgb(184, 204, 217);
            color: rgba(22, 10, 10, 0.764);
        }
        tr:hover {background-color: #f5f5f5;}
    </style>
</head>
<body>
    <p style="text-align: center"><strong>LAPORAN HASIL INVENTARISASI (LHI) ASET DESA</strong></p>
    <p style="text-align: center"><strong>BERUPA JALAN IRIGASI DAN JARINGAN</strong></p><br>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content">
                <div>
                    <table class="table1">
                        <thead>
                            <tr>
                            <th style="width: 3%; text-align: center">No</th>
                            <th style="width: 10%; text-align: center">Jenis Jalan</th>
                            <th style="width: 7%; text-align: center">Kode Barang</th>
                            <th style="width: 7%; text-align: center">NUP</th>
                            <th style="width: 10%; text-align: center">Ukuran</th>
                            <th style="width: 7%; text-align: center">Tahun Perolehan</th>
                            <th style="width: 10%; text-align: center">Type</th>
                            <th style="width: 10%; text-align: center">Asal Usul Barang</th>
                            <th style="width: 10%; text-align: center">Keterangan</th>
                            <th style="width: 15%; text-align: center">Nilai Perolehan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Akunasetkibas as $Akunasetkiba)
                            <tr>
                                <td style="text-align: center">{{ $loop->iteration }}</td>
                                <td>{{$Akunasetkiba->jenis}}</td>
                                <td>{{$Akunasetkiba->kd_barang}}</td>
                                <td>{{$Akunasetkiba->nup}}</td>
                                <td>{{$Akunasetkiba->identitas}}</td>
                                <td>{{$Akunasetkiba->tahun_perolehan}}</td>
                                <td>{{$Akunasetkiba->type_identitas}}</td>
                                <td>{{$Akunasetkiba->asal}}</td>
                                <td>{{$Akunasetkiba->ket}}</td>
                                <td style="text-align: right">@rupiah($Akunasetkiba->nilai_perolehan)</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td colspan="8" style="margin-left: 10px; text-align: center"> Jumlah </td>
                                <td style="text-align: right">@rupiah($totals)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <table style="border: 1px solid rgb(255, 255, 255);"> 
        <tbody>
            <tr>
                <td style="border: 1px solid rgb(255, 255, 255); width:70%"><strong>Tim Inventarisasi : </strong></td>
                <td style="border: 1px solid rgb(255, 255, 255);"><strong>Mengetahui, </strong><br>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid rgb(255, 255, 255);">1..............................&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp..................</td>
            </tr>
            <tr>
                <td style="border: 1px solid rgb(255, 255, 255);">2..............................&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp..................</td>
            </tr>
            <tr>
                <td style="border: 1px solid rgb(255, 255, 255);">3..............................&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp..................</td>
                <td style="border: 1px solid rgb(255, 255, 255);"><u>@foreach($kades as $kd){{ $kd->nama }} @endforeach</u><br>Kepala Desa @foreach($desas as $ds){{ $ds->asal }} @endforeach</td>
            </tr>
            <tr>
                <td style="border: 1px solid rgb(255, 255, 255);">4..............................&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp..................</td>
            </tr>
            <tr>
                <td style="border: 1px solid rgb(255, 255, 255);">5..............................&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp..................</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
