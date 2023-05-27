<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Inventarasasi Aset</title>
    {{-- <!-- Bootstrap -->
    <link href="/vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet"> --}}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


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
    <p style="text-align: center"><strong>BUKU INVENTARIS ASET DESA</strong></p>
    <p style="text-align: center"><strong>PEMERINTAH DESA @foreach($desas as $ds) {{ strtoupper($ds->asal) }} @endforeach</strong></p>
    <p style="text-align: center"><strong>TAHUN {{ $tahuns }} </strong></p><br>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content">
                <div>
                    <table class="table1">
                        <thead>
                            <tr>
                                <th style="width: 3%; text-align: center">No</th>
                                <th style="width: 10%; text-align: center">Jenis Barang</th>
                                <th style="width: 7%; text-align: center">Kode Barang</th>
                                <th style="width: 7%; text-align: center">Identitas Barang</th>
                                <th colspan="3" style="width: 10%; text-align: center">Asal Usul Barang</th>
                                <th style="width: 7%; text-align: center">Tanggal Perolehan / Pembelian</th>
                                <th style="width: 10%; text-align: center">Ket.</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>APBDesa</th>
                                <th>Perolehan Lain Yang Sah</th>
                                <th>Aset / Kekayaan Asli Desa</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Akunasetkibas as $Akunasetkiba)
                            <tr>
                                <td style="text-align: center">{{ $loop->iteration }}</td>
                                <td>{{$Akunasetkiba->jenis}}</td>
                                <td>{{$Akunasetkiba->kd_barang}}</td>
                                <td>{{$Akunasetkiba->identitas}}</td>
                                <td style="text-align: center">
                                    @if($Akunasetkiba->asal == 'APBDesa')
                                    <i class="fa-solid fa-check"></i>
                                    @endif
                                </td>
                                <td style="text-align: center">
                                    @if($Akunasetkiba->asal == 'Perolehan Lain Yang Sah')
                                    <i class="fa-solid fa-check"></i>
                                    @endif
                                </td>
                                <td style="text-align: center">
                                    @if($Akunasetkiba->asal == 'Aset / Kekayaan Asli Desa')
                                    <i class="fa-solid fa-check"></i>
                                    @endif
                                </td>
                                <td style="text-align: center">{{$Akunasetkiba->tahun_perolehan}}</td>
                                <td>{{$Akunasetkiba->ket}}</td>
                            </tr>
                            @endforeach
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
                <td style="border: 1px solid rgb(255, 255, 255); width:50%; text-align: center">
                    <strong>MENGETAHUI :</strong><br>
                    <strong>SEKRETARIS DESA</strong><br>
                    <strong>Selaku Pembantu Pengelola Barang Milik Desa</strong><br><br><br><br><br><br>
                    <strong>(........................................)</strong>
                </td>
                <td style="border: 1px solid rgb(255, 255, 255); text-align: center">
                    <strong>Desa @foreach($desas as $ds) {{ $ds->asal }} @endforeach, Tanggal....................</strong><br>
                    <strong>PETUGAS/PENGURUS</strong><br>
                    <strong>BARANG MILIK DESA</strong><br><br><br><br><br><br>
                    <strong>(........................................)</strong>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
