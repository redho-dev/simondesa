{{-- Form Update Papan Monografi --}}
@php
$kades = $data->where('jabatan', 'Kepala Desa')->first();
$sekdes = $data->where('jabatan', 'Sekretaris Desa')->first();
$kaur_umum = $data->where('jabatan', 'Kaur Umum')->first();
$kaur_perencanaan = $data->where('jabatan', 'Kaur Perencanaan')->first();
$kaur_keu = $data->where('jabatan', 'Kaur Keuangan')->first();
$kasi_pem = $data->where('jabatan', 'Kasi Pemerintahan')->first();
$kasi_pemb = $data->where('jabatan', 'Kasi Pemberdayaan')->first();
$kasi_pel = $data->where('jabatan', 'Kasi Pelayanan')->first();
$jumper = count($data);
$kurang = 8-$jumper;
$jumdasun = count($kadus);
$kurangdusun = intval($jumdus)-intval($jumdasun);
$jumdabpd = count($bpd);
$kurangbpd = intval($jumbpd)-$jumdabpd;
$jumdart = count($rt);
$kurangrt = intval($jumrt)-$jumdart;
@endphp

<div class="row mt-4">
    <div class="col-md-4">
        <table class="table table-bordered">
            <tr>
                <td>Jumlah Data yang harus terisi</td>
                <td>: {{ 8+$jumdus+$jumbpd+$jumrt }} data</td>
            </tr>
            <tr>
                <td>Jumlah Data Terisi</td>
                <td>: {{ $jumper+$jumdasun+$jumdabpd+$jumdart }} data, ( {{
                    intval(($jumper+$jumdasun+$jumdabpd+$jumdart)/(8+$jumdus+$jumbpd+$jumrt) * 100) }} % )</td>
            </tr>
        </table>
    </div>
</div>

<div class="row ">
    <div class="col-md-12">

        <p>A. Data Kades dan Perangkat : {!! $jumper==8 ? '(data terisi lengkap)' : "<span class='text-danger'>(data
                kurang
                $kurang)</span>" !!} </p>
        <table class=" table table-bordered">
            <tr class="bg-info">
                <td class="text-center">No</td>
                <td class="text-center">Jabatan</td>
                <td class="text-center">Nama</td>
                <td class="text-center">TTL</td>
                <td class="text-center">JK</td>
                <td class="text-center">Agama</td>
                <td class="text-center">SK</td>
                <td class="text-center">sejak</td>
                <td class="text-center">sampai</td>
                <td class="text-center">pendidikan</td>
                <td class="text-center">foto</td>

            </tr>
            @foreach($data as $dt)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $dt->jabatan }}</td>
                <td>{{ $dt->nama }}</td>
                <td>{{ $dt->tempat_lahir }}, {{ $dt->tgl_lahir }}</td>
                <td>{{ $dt->jenkel }}</td>
                <td>{{ $dt->agama }}</td>
                <td>{{ $dt->nomor_sk }} <br> <a class="text-primary" href="{{ asset('storage/'.$dt->file_sk) }}"
                        target="_blank"> <i class="fa fa-file-pdf-o mr-2"></i>cek dokumen</a></td>
                <td>{{ $dt->sejak }}</td>
                <td>{{ $dt->sampai }}</td>
                <td>{{ $dt->pendidikan }} <br><a class="text-primary" href="{{ asset('storage/'.$dt->file_ijazah) }}"
                        target="_blank"> <i class="fa fa-file-pdf-o mr-2"></i>cek dokumen</a>
                </td>

                <td>
                    @if($dt->foto_perangkat)
                    <a href="{{ asset('storage/'.$dt->foto_perangkat) }}" target="_blank"><img
                            src="{{ asset('storage/'.$dt->foto_perangkat) }}" width="35px"></a>
                    @else
                    <img src="{{ asset('/img/no_image.png')}}" width="35px">
                    @endif
                </td>
            </tr>
            @endforeach
        </table>

        <p class="mt-4">B. Data Kepala Dusun :
            {!! $jumdasun==$jumdus ? '(data terisi lengkap)' : "<span class='text-danger'>(data
                kurang
                $kurangdusun)</span>" !!}
        </p>
        <table class=" table table-bordered">
            <tr class="bg-info">
                <td class="text-center">No</td>
                <td class="text-center">Jabatan</td>
                <td class="text-center">Nama</td>
                <td class="text-center">TTL</td>
                <td class="text-center">JK</td>
                <td class="text-center">Agama</td>
                <td class="text-center">SK</td>
                <td class="text-center">sejak</td>
                <td class="text-center">sampai</td>
                <td class="text-center">pendidikan</td>
                <td class="text-center">foto</td>

            </tr>
            @foreach($kadus as $kd)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $kd->jabatan }}</td>
                <td>{{ $kd->nama }}</td>
                <td>{{ $kd->tempat_lahir }}, {{ $kd->tgl_lahir }}</td>
                <td>{{ $kd->jenkel }}</td>
                <td>{{ $kd->agama }}</td>
                <td>{{ $kd->nomor_sk }} <br> <a class="text-primary" href="{{ asset('storage/'.$kd->file_sk) }}"
                        target="_blank"> <i class="fa fa-file-pdf-o mr-2"></i>cek dokumen</a></td>
                <td>{{ $kd->sejak }}</td>
                <td>{{ $kd->sampai }}</td>
                <td>{{ $kd->pendidikan }} <br><a class="text-primary" href="{{ asset('storage/'.$kd->file_ijazah) }}"
                        target="_blank"> <i class="fa fa-file-pdf-o mr-2"></i>cek dokumen</a>
                </td>

                <td>
                    @if($kd->foto_perangkat)
                    <a href="{{ asset('storage/'.$kd->foto_perangkat) }}" target="_blank"><img
                            src="{{ asset('storage/'.$kd->foto_perangkat) }}" width="35px"></a>
                    @else
                    <img src="{{ asset('/img/no_image.png')}}" width="35px">
                    @endif
                </td>
            </tr>
            @endforeach
        </table>

        <p class="mt-4">C. Data BPD :
            {!! $jumdabpd==$jumbpd ? '(data terisi lengkap)' : "<span class='text-danger'>(data
                kurang
                $kurangbpd)</span>" !!}
        </p>
        <table class=" table table-bordered">
            <tr class="bg-info">
                <td class="text-center">No</td>
                <td class="text-center">Jabatan</td>
                <td class="text-center">Nama</td>
                <td class="text-center">TTL</td>
                <td class="text-center">JK</td>
                <td class="text-center">Agama</td>
                <td class="text-center">SK</td>
                <td class="text-center">sejak</td>
                <td class="text-center">sampai</td>
                <td class="text-center">pendidikan</td>
                <td class="text-center">foto</td>

            </tr>
            @foreach($bpd as $bp)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $bp->jabatan }}</td>
                <td>{{ $bp->nama }}</td>
                <td>{{ $bp->tempat_lahir }}, {{ $bp->tgl_lahir }}</td>
                <td>{{ $bp->jenkel }}</td>
                <td>{{ $bp->agama }}</td>
                <td>{{ $bp->nomor_sk }} <br> <a class="text-primary" href="{{ asset('storage/'.$bp->file_sk) }}"
                        target="_blank"> <i class="fa fa-file-pdf-o mr-2"></i>cek dokumen</a></td>
                <td>{{ $bp->sejak }}</td>
                <td>{{ $bp->sampai }}</td>
                <td>{{ $bp->pendidikan }} <br><a class="text-primary" href="{{ asset('storage/'.$bp->file_ijazah) }}"
                        target="_blank"> <i class="fa fa-file-pdf-o mr-2"></i>cek dokumen</a>
                </td>

                <td>
                    @if($bp->foto_perangkat)
                    <a href="{{ asset('storage/'.$bp->foto_perangkat) }}" target="_blank"><img
                            src="{{ asset('storage/'.$bp->foto_perangkat) }}" width="35px"></a>
                    @else
                    <img src="{{ asset('/img/no_image.png')}}" width="35px">
                    @endif
                </td>
            </tr>
            @endforeach
        </table>

        <p class="mt-4">D. Data RT :
            {!! $jumdart==$jumrt ? '(data terisi lengkap)' : "<span class='text-danger'>(data
                kurang
                $kurangrt)</span>" !!}
        </p>
        <table class=" table table-bordered">
            <tr class="bg-info">
                <td class="text-center">No</td>
                <td class="text-center">Jabatan</td>
                <td class="text-center">Nama</td>
                <td class="text-center">TTL</td>
                <td class="text-center">JK</td>
                <td class="text-center">Agama</td>
                <td class="text-center">SK</td>
                <td class="text-center">sejak</td>
                <td class="text-center">sampai</td>
                <td class="text-center">pendidikan</td>
                <td class="text-center">foto</td>

            </tr>
            @foreach($rt as $r)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $r->jabatan }}</td>
                <td>{{ $r->nama }}</td>
                <td>{{ $r->tempat_lahir }}, {{ $r->tgl_lahir }}</td>
                <td>{{ $r->jenkel }}</td>
                <td>{{ $r->agama }}</td>
                <td>{{ $r->nomor_sk }} <br> <a class="text-primary" href="{{ asset('storage/'.$r->file_sk) }}"
                        target="_blank"> <i class="fa fa-file-pdf-o mr-2"></i>cek dokumen</a></td>
                <td>{{ $r->sejak }}</td>
                <td>{{ $r->sampai }}</td>
                <td>{{ $r->pendidikan }} <br><a class="text-primary" href="{{ asset('storage/'.$r->file_ijazah) }}"
                        target="_blank"> <i class="fa fa-file-pdf-o mr-2"></i>cek dokumen</a>
                </td>

                <td>
                    @if($r->foto_perangkat)
                    <a href="{{ asset('storage/'.$r->foto_perangkat) }}" target="_blank"><img
                            src="{{ asset('storage/'.$r->foto_perangkat) }}" width="35px"></a>
                    @else
                    <img src="{{ asset('/img/no_image.png')}}" width="35px">
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>