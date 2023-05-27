@extends('templates.desa.main')
@section('content')
<h4>CATATAN & TEMUAN</h4>
<div class="card p-4">
    <form action="/adminDesa/catatan_temuan" method="post">
        <div class="row align-items-center">
            @csrf
            <div class="col-md-2">
                <div class="form-group">
                    <label for="tahun">Tahun Data</label>
                    <input type="text" class="form-control" id="tahun" style="font-size: .85rem"
                        value="{{ session()->get('tahun') ?? " $tahun" }}" name="tahun">
                </div>
            </div>
            <div class="col-md-2 align-items-center">
                <button class="btn btn-primary btn-sm mt-4">Submit</button>
            </div>

        </div>
    </form>
</div>
<div class="card mt-2">
    <div class="row">
        <div class="col">
            <div class="isi">
                <div class="nav mt-2 ml-4">
                    <ul class="nav nav-pills card-header-pills ">
                        <li class="nav-item">

                            <p class="text-primary" style="font-size: 1rem">Rekap Catatan & Temuan </br> Kecamatan {{
                                $kecamatan }} ; Desa {{ $desa
                                }} ; Tahun {{ $tahun }}</p>
                        </li>

                    </ul>

                </div>
                <hr>
                <div class="row justify-contet-center" id="tompil">
                    <div class="col text-center">
                        <button class="btn btn-primary" id="topem">PEMERINTAHAN DESA
                            &emsp; <span class="fa fa-chevron-circle-down"></span></button>
                    </div>
                    <div class="col text-center">
                        <button class="btn btn-secondary" id="tokeu">KEUANGAN DESA
                            &emsp; <span class="fa fa-chevron-circle-down"></span></button>
                    </div>

                </div>
                <hr>

                <div class="x_content">
                    <div class="row pemdes mt-2">
                        <div class="col-md-12">
                            {{-- VARIABEL PEMERINTAHAN DESA --}}
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-info">
                                        <th style="vertical-align: middle" width=30%>Aspek/Indikator/Sub Indikator</th>
                                        <th class="text-center" style="vertical-align: middle" width=35%>Catatan</th>
                                        <th class="text-center" style="vertical-align: middle" width=35%>
                                            Saran/Rekomendasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-secondary ">
                                        <td><strong>PEMERINTAHAN DESA</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Data Umum/Monografi</td>
                                        <td>{!! $catatandataumum ?? '' !!}</td>
                                        <td>{!! $sarandataumum ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kewilayahan</td>
                                        <td>{!! $catatankewilayahan ?? '' !!}</td>
                                        <td>{!! $sarankewilayahan ?? '' !!}</td>
                                    </tr>
                                    @foreach ($kewilayahan as $kwl )
                                    <tr>
                                        <td class="pl-4">-
                                            @switch($kwl->nama_data)
                                            @case('dasar_hukum')
                                            Dokumen Dasar Hukum Pembentukan Desa
                                            @break
                                            @case('patok_batas_utara')
                                            Pilar Batas Utara Desa
                                            @break
                                            @case('patok_batas_selatan')
                                            Pilar Batas Selatan Desa
                                            @break
                                            @case('patok_batas_barat')
                                            Pilar Batas Barat Desa
                                            @break
                                            @case('patok_batas_timur')
                                            Pilar Batas Timur Desa
                                            @break
                                            @case('peta_batas')
                                            Peta Batas Desa
                                            @break
                                            @endswitch
                                        </td>
                                        <td>{!! $kwl->catatan ?? '' !!}</td>
                                        <td>{!! $kwl->saran ?? '' !!}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td><strong>Kelembagaan</td>
                                        <td>{!! $catatankelembagaan ?? '' !!}</td>
                                        <td>{!! $sarankelembagaan ?? '' !!}</td>
                                    </tr>
                                    @foreach ($kelembagaan as $klb )
                                    <tr>
                                        <td class="pl-4">-
                                            @switch($klb->nama_data)
                                            @case('sotk')
                                            Peraturan Desa Tentang Struktur Organisasi dan Tatakerja (SOTK) Pemerintah
                                            Desa
                                            @break
                                            @case('sklpm')
                                            SK Lembaga Pemberdayaan Masyarakat (LPM)
                                            @break
                                            @case('sktaruna')
                                            SK Karang Taruna
                                            @break
                                            @case('sklinmas')
                                            SK Perlindungan Masyarakat (Linmas)
                                            @break
                                            @case('skpkk')
                                            SK Kepengurusan PKK
                                            @break
                                            @case('kantor_desa')
                                            Foto Kantor Desa
                                            @break
                                            @case('papan_struktur')
                                            Papan Struktur Pemerintah Desa
                                            @break
                                            @case('kantor_bpd')
                                            Foto Kantor/Sekretariat BPD
                                            @break
                                            @endswitch
                                        </td>
                                        <td>{!! $klb->catatan ?? '' !!}</td>
                                        <td>{!! $klb->saran ?? '' !!}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td><strong>Dokumen Perencanaan</td>
                                        <td>{!! $catatandokren ?? '' !!}</td>
                                        <td>{!! $sarandokren ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="pl-4">- Perdes dan Dokumen RPJMDes</td>
                                        @foreach ($dokrenrpjmdes as $dokrpjmdes)
                                        <td>{!! $dokrpjmdes->catatan ?? '' !!}</td>
                                        <td>{!! $dokrpjmdes->saran ?? '' !!}</td>
                                        @endforeach
                                    </tr>
                                    @foreach ($dokren as $dkr )
                                    <tr>
                                        <td class="pl-4">-
                                            @switch($dkr->nama_data)
                                            @case('sk_tim_rkpdes')
                                            SK Tim Penyusunan RKP Desa
                                            @break
                                            @case('bac_musdus')
                                            BAC Musyawarah Dusun
                                            @break
                                            @case('bac_musrenbangdes')
                                            BAC Musrenbangdes
                                            @break
                                            @case('dokumen_rkpdes')
                                            Perdes dan Dokumen RKP Desa
                                            @break
                                            @case('tanggal_penetapan_rkpdes')
                                            Ketepatan Waktu Penetapan Perdes RKP Desa
                                            @break
                                            @endswitch
                                        </td>
                                        <td>{!! $dkr->catatan ?? '' !!}</td>
                                        <td>{!! $dkr->saran ?? '' !!}</td>
                                    </tr>
                                    @endforeach
                                    @foreach ($dokrenrapbd as $dokrapbd )
                                    <tr>
                                        <td class="pl-4">-
                                            @switch($dokrapbd->nama_data)
                                            @case('dokumen_rapbdes')
                                            SK Tim Penyusunan RKP Desa
                                            @break
                                            @case('bac')
                                            BAC Musyawarah Dusun
                                            @break
                                            @case('keputusan_bpd')
                                            BAC Musrenbangdes
                                            @break
                                            @case('evaluasi')
                                            Perdes dan Dokumen RKP Desa
                                            @break
                                            @endswitch
                                        </td>
                                        <td>{!! $dokrapbd->catatan ?? '' !!}</td>
                                        <td>{!! $dokrapbd->saran ?? '' !!}</td>
                                    </tr>
                                    @endforeach
                                    @foreach ($dokrenapbd as $dokapbd )
                                    <tr>
                                        <td class="pl-4">- Perdes dan Lampiran/Dokumen APBDes</td>
                                        <td>{!! $dokapbd->catatan_dokumen ?? '' !!}</td>
                                        <td>{!! $dokapbd->saran_dokumen ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="pl-4">- Analisa, Gambar dan RAB Pembangunan Fisik</td>
                                        <td>{!! $dokapbd->catatan_desain ?? '' !!}</td>
                                        <td>{!! $dokapbd->saran_desain ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="pl-4">- Ketepatan Waktu Penetapan Perdes APBDes</td>
                                        <td>{!! $dokapbd->catatan_tanggal ?? '' !!}</td>
                                        <td>{!! $dokapbd->saran_tanggal ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="pl-4">- Perkades dan Lampiran/Dokumen Penjabaran</td>
                                        <td>{!! $dokapbd->catatan_penjabaran ?? '' !!}</td>
                                        <td>{!! $dokapbd->saran_penjabaran ?? '' !!}</td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td><strong>Administrasi Umum</td>
                                        <td>{!! $catatanadum ?? '' !!}</td>
                                        <td>{!! $saranadum ?? '' !!}</td>
                                    </tr>
                                    @foreach ($adum as $adm )
                                    <tr>
                                        <td class="pl-4">-
                                            @switch($adm->nama_data)
                                            @case('surat')
                                            Buku Surat Masuk/Keluar
                                            @break
                                            @case('daftar_hadir')
                                            Rekap Bulanan Daftar Hadir Perangkat Semester 1
                                            @break
                                            @case('daftar_hadir2')
                                            Rekap Bulanan Daftar Hadir Perangkat Semester 2
                                            @break
                                            @case('buku_register')
                                            Buku Register Perdes/Perkades/SK
                                            @break
                                            @case('rekap_penduduk')
                                            Buku Rekap Kependudukan
                                            @break
                                            @endswitch
                                        </td>
                                        <td>{!! $adm->catatan ?? '' !!}</td>
                                        <td>{!! $adm->saran ?? '' !!}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td><strong>Pelaporan</td>
                                        <td>{!! $catatanpelaporan ?? '' !!}</td>
                                        <td>{!! $saranpelaporan ?? '' !!}</td>
                                    </tr>
                                    @foreach ($pelaporan as $plp )
                                    <tr>
                                        <td class="pl-4">-
                                            @switch($plp->nama_data)
                                            @case('lkpd')
                                            Laporan Penyelenggaraan Pemerintahan Desa
                                            @break
                                            @case('perdes_pj')
                                            Laporan Keterangan Penyelenggaraan Pemerintahan Desa (LKPD)
                                            @break
                                            @case('lra_1')
                                            Peraturan Desa tentang Laporan Pertanggungjawaban APB Desa
                                            @break
                                            @case('lra_2')
                                            Laporan Realisasi APB Desa Semester 1
                                            @break
                                            @case('lppd')
                                            Laporan Realisasi APB Desa Akhir Tahun
                                            @break
                                            @endswitch
                                        </td>
                                        <td>{!! $plp->catatan ?? '' !!}</td>
                                        <td>{!! $plp->saran ?? '' !!}</td>
                                    </tr>
                                    @endforeach


                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="row keudes mt-2" style="display: none">
                        <div class="col-md-12">
                            {{-- VARIABEL KEUANGAN DESA --}}
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-info">
                                        <th style="vertical-align: middle" width=20%>Aspek/Indikator/Sub Indikator</th>
                                        <th class="text-center" style="vertical-align: middle" width=25%>
                                            Catatan/Saran/Kesimpulan</th>
                                        <th class="text-center" style="vertical-align: middle" width=30%>Temuan</th>
                                        <th class="text-center" style="vertical-align: middle" width=25%>Rekomendasi
                                            Tindak Lanjut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-secondary ">
                                        <td><strong>KEUANGAN DESA</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>APB Desa Murni</td>
                                        <td>{!! $apbdesumum ?? '' !!}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>APB Desa Perubahan</td>
                                        <td>{!! $apbdesumumperubahan ?? '' !!}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Penataan Pendapatan</td>
                                        @foreach ($penataanpendapatan as $pp)
                                        <td>{!! $pp->uraian ?? '' !!}</td>
                                        <td>{!! $pp->catatan_sementara ?? '' !!}</td>
                                        <td>{!! $pp->rekom_sementara ?? '' !!}</td>
                                        @endforeach

                                    </tr>
                                    <tr>
                                        <td><strong>Penataan Belanja</td>
                                        <td>{!! $penataanbelanja->uraian ?? '' !!}</td>
                                        <td>Jumlah uang yang belum di Pertanggungjawabkan Rp {{ $belumSPJ }}</td>
                                        <td></td>

                                    </tr>
                                    @foreach ($penataanbelanjaspp as $spp )
                                    <tr>
                                        <td class="pl-4">- Nomor SPP : {{ $spp->nomor }}
                                        </td>
                                        <td></td>
                                        <td>{!! $spp->catatan ?? '' !!}</td>
                                        <td>{!! $spp->rekomendasi ?? '' !!}</td>
                                    </tr>
                                    @endforeach
                                    @foreach ($penataanbelanjatbpu as $tbpu )
                                    <tr>
                                        <td class="pl-4">- Nomor TBPU : {{ $tbpu->nomor }}
                                        </td>
                                        <td></td>
                                        <td>{!! $tbpu->catatan_bkp ?? '' !!}</td>
                                        <td>{!! $tbpu->rekomendasi_bkp ?? '' !!}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td class="pl-4">- Uji Petik
                                        </td>
                                        <td></td>
                                        <td>{!! $ujipetik->kesimpulan_sementara ?? '' !!}</td>
                                        <td>{!! $ujipetik->rekomendasi_sementara ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Penataan Pembiayaan</td>
                                        @foreach ($penataanpembiayaan as $pb)
                                        <td>{!! $pb->uraian ?? '' !!}</td>
                                        <td>{!! $pb->catatan_sementara ?? '' !!}</td>
                                        <td>{!! $pb->rekom_sementara ?? '' !!}</td>
                                        @endforeach

                                    </tr>
                                    <tr>
                                        <td><strong>Kepatuhan Pajak</td>
                                        @foreach ($kepatuhanpajak as $pj)
                                        <td></td>
                                        <td>{!! $pj->catatan_sementara ?? '' !!}</td>
                                        <td>{!! $pj->rekom_sementara ?? '' !!}</td>
                                        @endforeach

                                    </tr>
                                    @foreach ($penataanbelanjatbpu as $tbpu )
                                    @if ($tbpu->koreksi_pajak == 1)
                                    <tr>
                                        <td class="pl-4">- Nomor TBPU : {{ $tbpu->nomor }}
                                        </td>
                                        <td>Koreksi Pajak</td>
                                        <td>Kurang Salur Pajak Rp
                                            <?php $tbpukoreksi = $tbpu->koreksi_ppn + $tbpu->koreksi_pph + $tbpu->koreksi_lainyya;
                                            $tbpupajak = $tbpu->pph + $tbpu->ppn + $tbpu->lainnya;
                                            $koreksipajak = $tbpukoreksi - $tbpupajak;
                                        ?>
                                            {!! $koreksipajak ?? '' !!}
                                        </td>
                                        <td></td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    @foreach ($belumsetor as $blmstr )
                                    <tr>
                                        <td class="pl-4">- Nomor TBPU : {{ $blmstr->nomor }}
                                        </td>
                                        <td>Belum Setor</td>
                                        <td>
                                            @if($blmstr->ppn && !$blmstr->billing_ppn)
                                            PPn belum setor Rp {{ $blmstr->ppn }}
                                            @elseif($blmstr->pph && !$blmstr->billing_pph)
                                            PPh belum setor Rp {{ $blmstr->pph }}
                                            @elseif($blmstr->lainnya && !$blmstr->billing_lainnya)
                                            Pajak lainnya belum setor Rp {{ $blmstr->lainnya }}
                                            @endif
                                        </td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                    @foreach ($rekon as $rkn )
                                    <tr>
                                        <td class="pl-4">- Tunggakan pajak tahun-tahun sebelumnya
                                        </td>
                                        <td></td>
                                        <td>
                                            {{$rkn->tunggakan_pajak}}
                                        </td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td><strong>Kemandirian Tata Kelola</td>
                                        @foreach ($tatakelola as $kmd)
                                        <td>{!! $kmd->uraian ?? '' !!}</td>
                                        <td>{!! $kmd->catatan_sementara ?? '' !!}</td>
                                        <td>{!! $kmd->rekom_sementara ?? '' !!}</td>
                                        @endforeach

                                    </tr>
                                    <tr>
                                        <td><strong>Pengadaan Barang dan Jasa</td>
                                        <td>{!! $pengadaanbarjas ?? '' !!}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @foreach ($pilfis as $dp)
                                    @if ($dp->catatan_sementara != '' || $dp->rekomendasi_sementara != '')

                                    <tr>
                                        <td>{{ $dp->apbdes_kegiatan->kegiatan->kegiatan}}
                                            <p class="mt-0 pt-0 mb-0"> - Jumlah Anggaran : Rp. <span
                                                    class="angka mt-0 pt-0 mb-0">{{
                                                    $dp->anggaran}} </span>
                                            </p>

                                            <p class="mt-0 pt-0 mb-0"> - Realisasi Anggaran : Rp. <span
                                                    class="angka mt-0 pt-0 mb-0">{{
                                                    $dp->realisasi_anggaran
                                                    }}</span></p>
                                            <p class="mt-0 pt-0"> - Sifat Kegiatan : {{ $dp->sifat }}</p>
                                        </td>
                                        <td></td>
                                        <td>{!! $dp->catatan_sementara ?? '' !!}</td>
                                        <td>{!! $dp->rekomendasi_sementara ?? '' !!}</td>
                                    <tr>
                                        @endif
                                        @endforeach
                                        @foreach ($pengadaanaset as $pa)
                                        @if ($pa->catatan_sementara != '' || $pa->rekomendasi_sementara != '')

                                    <tr>
                                        <td>{{ $pa->nama_barang}}
                                            <p class="mt-0 pt-0 mb-0"> - Jumlah Anggaran : Rp. <span
                                                    class="angka mt-0 pt-0 mb-0">{{
                                                    $pa->harga_total}} </span>
                                            </p>
                                        <td></td>
                                        <td>{!! $pa->catatan_sementara ?? '' !!}</td>
                                        <td>{!! $pa->rekomendasi_sementara ?? '' !!}</td>
                                    <tr>
                                        @endif
                                        @endforeach
                                        @foreach ($pengadaanasetnonlapor as $panl)
                                        @if ($panl->catatan_sementara != '' || $panl->rekomendasi_sementara != '')

                                    <tr>
                                        <td>{{ $panl->nama_barang}}
                                            <p class="mt-0 pt-0 mb-0"> - Jumlah Anggaran : Rp. <span
                                                    class="angka mt-0 pt-0 mb-0">{{
                                                    $panl->harga_total}} </span>
                                            </p>
                                        <td>Belanja Modal (Aset Barang) Yang Tidak Terlapor</td>
                                        <td>{!! $panl->catatan_sementara ?? '' !!}</td>
                                        <td>{!! $panl->rekomendasi_sementara ?? '' !!}</td>
                                    <tr>
                                        @endif
                                        @endforeach
                                    <tr>
                                        <td><strong>Penataan Aset Desa</td>
                                        @foreach ($asetdesa as $as)
                                        <td>{!! $as->uraian ?? '' !!}</td>
                                        <td>{!! $as->catatan_sementara ?? '' !!}</td>
                                        <td>{!! $as->rekom_sementara ?? '' !!}</td>
                                        @endforeach

                                    </tr>
                                    <tr>
                                        <td><strong>Badan Usaha Milik Desa (BUM Desa)</td>
                                        @foreach ($cttbumdes as $bumd)
                                        <td>{!! $bumd->uraian ?? '' !!}</td>
                                        <td>{!! $bumd->catatan_sementara ?? '' !!}</td>
                                        <td>{!! $bumd->rekom_sementara ?? '' !!}</td>
                                        @endforeach

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<br><br><br><br>


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


    $('#topem').on('click', function(){
    
    var totif = $('#tompil').find('.btn-primary');
    totif.toggleClass('btn-primary');
    totif.toggleClass('btn-secondary');
    $('#topem').toggleClass('btn-secondary');
    $('#topem').toggleClass('btn-primary');
    $('.keudes').hide();
    $('.pemdes').toggle('slow');
      
 })
 $('#tokeu').on('click', function(){
    
    var totif = $('#tompil').find('.btn-primary');
    totif.toggleClass('btn-primary');
    totif.toggleClass('btn-secondary');
    $('#tokeu').toggleClass('btn-secondary');
    $('#tokeu').toggleClass('btn-primary');
    $('.pemdes').hide();
    $('.keudes').toggle('slow');
      
 })


</script>
@endpush