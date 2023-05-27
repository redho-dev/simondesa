<table class="table table-bordered">
    <tr class="bg-secondary">
        <td width="3%">II.</td>
        <td width="97%" colspan="2">
            PEMERIKSAAN PENGELOLAAN KEUANGAN DAN ASET DESA
        </td>
    </tr>
    <tr id="realisasi" class="bg-info" style="display: ">
        <td></td>
        <td width="3%">2.1</td>
        <td>Realisasi APB Desa Tahun Anggaran {{ $tahun }} &emsp;<button class="fa fa-angle-double-down"></button>
        </td>
    </tr>
    <tr id="nhp_realisasi" style="display: none">
        <td></td>
        <td width="3%"></td>
        <td>

            <div class="row">
                <div class="col-md-12">
                    <p>Status APB Desa : {{ $status }}</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="bg-secondary" style="line-height: 1rem">
                                <th width="5%" style="vertical-align: middle">Kode_rek</th>
                                <th style="vertical-align: middle">URAIAN</th>
                                <th width="20%" class="text-center" style="vertical-align: middle">Anggaran <br> (Rp)
                                </th>
                                <th width="20%" class="text-center" style="vertical-align: middle">Realiasi <br> (Rp)
                                </th>
                                <th width="20%" class="text-center" style="vertical-align: middle">Lebih / (kurang)
                                    <br>(Rp)
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr class="bg-light">
                                <td>4.</td>
                                <td>PENDAPATAN</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            @foreach($pendapatans as $pend)
                            @if($pend->$anggaran)
                            <tr>
                                <td>{{ $pend->kode_pendapatan }}</td>
                                <td class="pl-42">
                                    @if($pend->pendapatan_id != 1 && $pend->pendapatan_id != 2 && $pend->pendapatan_id
                                    !=
                                    8)
                                    &emsp;&emsp;{{ $pend->jenis_pendapatan }}
                                    @else
                                    {{ $pend->jenis_pendapatan }}
                                    @endif
                                </td>
                                <td class="text-right anggaran_pendapatan">
                                    {{ number_format($pend->$anggaran, 0, ',', '.')}}
                                </td>
                                <td class="text-right realisasi_pendapatan">

                                    @if($pend->pendapatan->id == 1)
                                    {{ number_format($realisasiPend->where('pendapatan_id',
                                    1)->pluck('jumlah')->sum(), 0, ',', '.') }}

                                    @elseif($pend->pendapatan->id == 2)
                                    {{ number_format($realisasiPend->where('pendapatan_id','>',
                                    2)->where('pendapatan_id', '<=', 7)->pluck('jumlah')->sum(), 0, ',', '.') }}
                                        @elseif($pend->pendapatan->id == 8)
                                        {{ number_format($realisasiPend->where('pendapatan_id',
                                        8)->pluck('jumlah')->sum(), 0, ',', '.') }}

                                        @else
                                        {{ number_format($realisasiPend->where('pendapatan_id',
                                        $pend->pendapatan->id)->pluck('jumlah')->sum(), 0, ',', '.') }}
                                        @endif

                                </td>
                                <td class="text-right selisih_pendapatan">

                                </td>

                            </tr>
                            @endif
                            @endforeach

                            <tr class="bg-light">
                                <td></td>
                                <td class="text-center">TOTAL PENDAPATAN
                                </td>
                                <td class="text-right tot_pend"> {{ number_format($totalPendapatan,0,',','.') }}</td>
                                <td class="text-right tot_realpend">{{ number_format($totalRealisasiPend,0,',','.') }}
                                </td>
                                <td class="text-right">
                                    <?php $selTotPend = $totalPendapatan-$totalRealisasiPend; ?>
                                    {{ number_format($selTotPend, 0, ',', '.') }}
                                </td>
                            </tr>

                            <tr class="bg-light">
                                <td>5.</td>
                                <td>BELANJA</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @foreach($belanjas as $bl)
                            <tr>
                                <td>{{ $bl->belanja->kode_belanja }}</td>
                                <td class="pl-4">{{ $bl->belanja->jenis_belanja }}</td>
                                <td class="angka text-right anggaran_belanja">{{ $bl->$anggaran }}</td>
                                <td class="text-right realisasi_belanja">
                                    @if($bl->belanja_id == 1)
                                    {{ number_format($realisasiBpeg,0,',','.') }}
                                    @elseif($bl->belanja_id == 2)
                                    {{ number_format($realisasiBBarjas,0,',','.') }}
                                    @elseif($bl->belanja_id == 3)
                                    {{ number_format($realisasiBModal,0,',','.') }}
                                    @elseif($bl->belanja_id == 4)
                                    {{ number_format($realisasiBTakter,0,',','.') }}
                                    @endif
                                </td>
                                <td class="text-right selisih_belanja">

                                </td>
                            </tr>
                            @endforeach

                            <tr class="bg-light">
                                <td></td>
                                <td class="text-center">TOTAL BELANJA</td>
                                <td class="angka text-right">{{ $totalBelanja }}</td>
                                <td class="angka text-right">
                                    {{ number_format($realisasiBTotal, 0, ',', '.') }}
                                </td>
                                <td class="text-right">
                                    {{ number_format($totalBelanja-$realisasiBTotal, 0,',','.') }}
                                </td>
                            </tr>

                            <tr class="bg-light">
                                <td>
                                    <input type="hidden" id="surplus" value="{{ $totalPendapatan-$totalBelanja  }}">
                                </td>
                                <td class="text-center">SURPLUS/(DEFISIT)</td>
                                <td class="text-right">
                                    @if($totalPendapatan-$totalBelanja < 0) (<span class="angka">{{
                                        ($totalPendapatan-$totalBelanja)*-1 }}</span>)
                                        @else
                                        {{ $totalPendapatan-$totalBelanja }}
                                        @endif
                                </td>
                                <td class="text-right">
                                    {{ $surdef }}
                                </td>
                                <td class="text-right">
                                    {{ $selisihsurdef }}
                                </td>
                            </tr>
                            <tr class="bg-light">
                                <td></td>
                                <td>PEMBIAYAAN</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @foreach($pembiayaans as $pemb)
                            @if($pemb->$anggaran)
                            <tr>
                                <td>{{ $pemb->kode_pembiayaan }}</td>
                                <td class="pl-4">
                                    @if($pemb->pembiayaan_id != 1 && $pemb->pembiayaan_id != 6)
                                    &emsp;&emsp;{{ $pemb->jenis_pembiayaan }}
                                    @else
                                    {{ $pemb->jenis_pembiayaan }}
                                    @endif
                                </td>
                                <td class="angka text-right anggaran_pembiayaan">{{ $pemb->$anggaran }}</td>
                                <td class="text-right realisasi_pembiayaan">
                                    @if($pemb->pembiayaan_id == 1)
                                    {{ number_format($realisasiPemb->where('pembiayaan_id', '<=', 5)->
                                        pluck('jumlah')->sum(), 0,',','.') }}
                                        @elseif($pemb->pembiayaan_id == 6)
                                        {{ number_format($realisasiPemb->where('pembiayaan_id', '>',
                                        6)->pluck('jumlah')->sum(), 0,',','.') }}
                                        @else
                                        {{
                                        number_format($realisasiPemb->where('pembiayaan_id',$pemb->pembiayaan_id)->pluck('jumlah')->sum(),0,',','.')
                                        }}
                                        @endif
                                </td>
                                <td class="text-right selisih_pembiayaan">

                                </td>
                            </tr>
                            @endif
                            @endforeach

                            <tr class="bg-light">
                                <td></td>
                                <td class="text-center">PEMBIAYAAN NETTO</td>
                                <td class="text-right ">{{ number_format($totalPembiayaan,0,',','.') }}</td>
                                <td class="text-right">
                                    {{ number_format($pembiayaanNetto,0,',','.') }}
                                </td>
                                <td class="text-right">
                                    {{ number_format($totalPembiayaan-$pembiayaanNetto, 0,',','.') }}
                                </td>
                            </tr>

                            <tr class="bg-light">
                                <td></td>
                                <td class="text-center">SISA LEBIH PEMBIAYAAN ANGGARAN</td>
                                <td class="angka text-right {{ $silpa != 0 ? 'text-danger' : '' }}">{{ $silpa }}</td>
                                <td class="text-right">
                                    {{ $silpaPembiayaan }}
                                </td>
                                <td class="text-right">
                                    {{ $silpa-$silpaPembiayaan }}
                                </td>
                            </tr>


                        </tbody>



                    </table>
                </div>
            </div>

        </td>
    </tr>
    <tr id="pendapatan" class="bg-info">
        <td></td>
        <td width="3%">2.2</td>
        <td>Penatausahaan Pendapatan &emsp;<button class="fa fa-angle-double-down"></button>
        </td>
    </tr>
    <tr id="nhp_pendapatan" style="display: none">
        <td></td>
        <td width="3%"></td>
        <td>

            <div class="row">
                <div class="col-md-10">
                    Penatausahaan pendapatan desa adalah proses pencatatan yang dilakukan oleh Bendahara Desa terhadap
                    seluruh transaksi penerimaan pendapatan desa yang meliputi pendapatan asli desa, transfer, dan
                    pendapatan lain-lain. Pencatatan dilakukan secara sistematis dan kronologis atas transaksi-transaksi
                    keuangan yang terjadi. </br>
                    Adapun hasil pemeriksaan atas penatausahaan pendapatan desa sebagai berikut :
                    <form action="/adminIrbanwil/nilaiPendapatanEdit" method="post">
                        @csrf
                        <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                        <input type="hidden" name="tahun" value="{{ $tahun }}">
                        <input type="hidden" name="aspek_id" value=2>
                        <input type="hidden" name="indikator_id" value=7>
                        <input type="hidden" name="table" value="nhp_pendapatan">

                        <p class="mb-1">A. Data Pengajuan dan Penerimaan Per Jenis Pendapatan</p>

                        <table class="table table-bordered">
                            <thead style="background-color: beige">
                                <tr style="line-height: 1rem">
                                    <th style="vertical-align: middle">Kode_rek</th>
                                    <th style="vertical-align: middle">Jenis Pendapatan</th>
                                    <th class="text-center" style="vertical-align: middle">Jumlah <br>Pengajuan &
                                        Penerimaan
                                        <br>
                                        (Rp)
                                    </th>
                                    <th class="text-center" style="vertical-align: middle">Tanggal Pengajuan
                                    </th>
                                    <th class="text-center" style="vertical-align: middle">Tanggal Penerimaan </br> Kas
                                        Desa
                                    </th>

                                </tr>
                            </thead>
                            @foreach($realisasiPend as $pd)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $pd->nama_data }}
                                </td>
                                <td class="text-right">
                                    {{ number_format($pd->jumlah,0,',','.') }}
                                </td>
                                <td class="text-center">
                                    {{ $pd->tgl_pengajuan }}
                                </td>
                                <td class="text-center">
                                    {{ $pd->tgl_saldo }}
                                </td>
                            </tr>

                            @endforeach
                        </table>

                        <p>B. Data Buku Pembantu Bank</p>
                        <table class="table table-bordered">
                            <thead style="background-color: beige">
                                <tr>
                                    <th>#</th>
                                    <th>Jenis Data</th>
                                    <th class="text-center">dokumen</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr class="{{ $semester_1 && $semester_1->perbaikan ? 'text-danger' : '' }}">
                                    <th>1</th>
                                    <th>Print-Out Buku Pembantu Bank Bulan Januari s.d Juni (Semester 1)</th>
                                    <th class="text-center">

                                        @if($semester_1)
                                        <a href="{{ asset('storage/'.$semester_1->file_data) }}" target="_blank"> <img
                                                src="/img/logo-pdf.jpg" width="50px"></a>
                                        <input type="hidden" name="old_1" value="{{ $semester_1->file_data  }}">
                                        @endif
                                    </th>

                                </tr>
                                <tr class="{{ $semester_2 && $semester_2->perbaikan ? 'text-danger' : '' }}">
                                    <th>2</th>
                                    <th>Print-Out Buku Pembantu Bank Bulan Juli s.d Desember (Semester 2)</th>
                                    <th class="text-center">
                                        @if($semester_2)
                                        <a href="{{ asset('storage/'.$semester_2->file_data) }}" target="_blank">
                                            <img src="/img/logo-pdf.jpg" width="50px"></a>
                                        <input type="hidden" name="old_2" value="{{ $semester_2->file_data  }}">
                                        @endif
                                    </th>

                                </tr>

                            </tbody>

                        </table>



                        <table class="table">
                            <tr>
                                <td colspan="6" style="background-color: beige">
                                    <div class="form-group">
                                        <label for="uraian7">Catatan / Saran / Uraian Kesimpulan / Apresiasi </label>
                                        <input type="hidden" name="uraian" id="uraian7" autofocus>
                                        <trix-editor input="uraian7" class="bg-white">
                                            {!! $catatan_7->uraian !!}
                                        </trix-editor>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" class="bg-info">
                                    <div class="form-group">
                                        <label for="kesimpulan7">Temuan :</label>
                                        <input type="hidden" name="catatan_sementara" id="kesimpulan7" autofocus>
                                        <trix-editor input="kesimpulan7" class="bg-white">{!!
                                            $catatan_7->catatan_sementara
                                            ??
                                            ''
                                            !!}
                                        </trix-editor>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" class="bg-info">
                                    <div class="form-group">
                                        <label for="saran7">Rekomendasi Tindak Lanjut :</label>
                                        <input type="hidden" name="rekom_sementara" id="saran7">
                                        <trix-editor input="saran7" class="bg-white">{!! $catatan_7->rekom_sementara ??
                                            ''
                                            !!}
                                        </trix-editor>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-right">
                                    <button type="submit" class="btn btn-primary">UPDATE</button>
                                </td>
                            </tr>

                        </table>
                    </form>
                </div>
            </div>

        </td>
    </tr>
    <tr id="belanja" class="bg-info">
        <td></td>
        <td width="3%">2.2</td>
        <td>Penatausahaan Belanja &emsp;<button class="fa fa-angle-double-down"></button>
        </td>
    </tr>
    <tr id="nhp_belanja" style="display">
        <td></td>
        <td width="3%"></td>
        <td>
            Penatausahaan belanja desa adalah proses pencatatan yang dilakukan oleh Bendahara Desa terhadap seluruh
            transaksi pengeluaran belanja desa yang meliputi semua pengeluaran dari Rekening Kas Desa yang merupakan
            kewajiban desa dalam satu tahun anggaran yang tidak akan diperoleh pembayarannya kembali oleh desa. </br>
            Adapun hasil pemeriksaan atas penatausahaan belanja desa sebagai berikut :
            <div class="row">
                <div class="col-md-12">
                    <p class="mb-1">A. Kelengkapan Surat Permintaan Pembayaran (SPP) Kegiatan</p>
                    <table class="table table-bordered mb-1">
                        <thead>
                            <tr class="bg-info" style="line-height: 1rem">
                                <th width="20%" class="text-center" style="vertical-align: middle">Total Anggaran </br>
                                    Kegiatan
                                    (Rp)
                                </th>
                                <th width="10%" class="text-center" style="vertical-align: middle">Jml Dokumen SPP</th>
                                <th width="15%" class="text-center" style="vertical-align: middle">Akumulasi </br>
                                    Jumlah SPP (Rp)
                                </th>
                                <th width="15%" class="text-center" style="vertical-align: middle">Sisa Anggaran <br>
                                    Kegiatan (Rp)
                                </th>
                                <th width="10%" class="text-center" style="vertical-align: middle">Progress SPP </br>
                                    (%)</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="angka"><input type="text" id="totalAnggaran"
                                        class="form-control angka text-center" style="font-size: .8rem"
                                        value="{{ $totalBelanja }}" readonly></td>
                                <td><input type="text" class="form-control text-center" style="font-size: .8rem"
                                        id="jumdok" value="{{ $jumdokspp }}" readonly>
                                </td>
                                <td><input type="text" class="form-control text-center" id="totalSPP"
                                        style="font-size: .8rem" value="{{ number_format($akumulasi_spp, 0,',','.') }}"
                                        readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control text-center" id="sisaAnggaran"
                                        style="font-size: .8rem"
                                        value="{{ number_format($totalBelanja-$akumulasi_spp, 0, ',','.') }}" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control text-center" id="progressSPP"
                                        style="font-size: .8rem" value="{{ round(($akumulasi_spp/$totalBelanja)*100) }}"
                                        readonly>
                                </td>


                            </tr>
                        </tbody>
                    </table>
                    <p class="mb-1">Daftar Temuan SPP : </p>
                    <table class="table table-bordered">
                        <tr class="bg-secondary">
                            <th>No</th>
                            <th>Nomor SPP</th>
                            <th>Jumlah (Rp)</th>
                            <th>Temuan</th>
                            <th>Rekomendasi TL</th>
                        </tr>
                        @foreach($temuanSPP as $tmspp)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tmspp->nomor }}</td>
                            <td>
                                <span class="angka">{{ $tmspp->jumlah }}</span>
                            </td>
                            <td>{{ $tmspp->catatan }}</td>
                            <td>{{ $tmspp->rekomendasi }}</td>
                        </tr>
                        @endforeach
                    </table>

                    <p>B. Kelengkapan Tanda Bukti Pengeluaran Uang (TBPU)</p>
                    <table class="table table-bordered mb-1">
                        <thead>
                            <tr class="bg-info" style="line-height: 1rem">
                                <th width="20%" class="text-center" style="vertical-align: middle">Total Anggaran </br>
                                    Kegiatan
                                    (Rp)
                                </th>
                                <th width="10%" class="text-center" style="vertical-align: middle">Jml Dokumen TBPU</th>
                                <th width="15%" class="text-center" style="vertical-align: middle">
                                    Realisasi SPP (Rp)
                                </th>
                                <th width="15%" class="text-center" style="vertical-align: middle">
                                    Realisasi TBPU (Rp)
                                </th>
                                <th width="15%" class="text-center" style="vertical-align: middle">Selisih Realisasi SPP
                                    <br>
                                    dgn Realisasi TBPU (Rp)
                                </th>
                                <th width="10%" class="text-center" style="vertical-align: middle">Progress TBPU </br>
                                    (%)</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="angka"><input type="text" id="totalAnggaran"
                                        class="form-control angka text-center" style="font-size: .8rem"
                                        value="{{ $totalBelanja }}" readonly></td>
                                <td><input type="text" class="form-control text-center" style="font-size: .8rem"
                                        id="jumdok" value="{{ $jumdokbkp }}" readonly>
                                </td>
                                <td><input type="text" class="form-control text-center" id="totalSPP"
                                        style="font-size: .8rem" value="{{ number_format($akumulasi_spp, 0,',','.') }}"
                                        readonly>
                                </td>
                                <td><input type="text" class="form-control text-center" id="totalSPP"
                                        style="font-size: .8rem" value="{{ number_format($akumulasi_bkp, 0,',','.') }}"
                                        readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control text-center" id="sisaAnggaran"
                                        style="font-size: .8rem"
                                        value="{{ number_format($akumulasi_spp-$akumulasi_bkp, 0, ',','.') }}" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control text-center" id="progressSPP"
                                        style="font-size: .8rem" value="{{ round(($akumulasi_bkp/$totalBelanja)*100) }}"
                                        readonly>
                                </td>


                            </tr>
                        </tbody>
                    </table>
                    <p>Daftar Temuan TBPU : </p>
                    <table class="table table-bordered">
                        <tr class="bg-secondary">
                            <th class="text-center">No</th>
                            <th class="text-center">Kode Kegiatan</th>
                            <th class="text-center">Nomor TBPU</th>
                            <th class="text-center">Jumlah (Rp)</th>
                            <th class="text-center">Koreksi Pajak</th>
                            <th class="text-center">Temuan</th>
                            <th class="text-center">Rekomendasi TL</th>
                        </tr>
                        @foreach($temuanbkp as $tmbkp)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $tmbkp->apbdes_kegiatan->kegiatan->kode_kegiatan }}</td>
                            <td class="text-center">{{ $tmbkp->nomor }}</td>
                            <td class="text-center">
                                <span class="angka">{{ $tmbkp->jumlah }}</span>
                            </td>
                            <td class="text-center">
                                {{ $tmbkp->koreksi_pajak ? 'ya' : 'tidak' }}
                            </td>
                            <td>{{ $tmbkp->catatan_bkp }}</td>
                            <td>{{ $tmbkp->rekomendasi_bkp }}</td>
                        </tr>
                        @endforeach
                    </table>
                    </form>
                    <p>Daftar Temuan Uji Petik : </p>
                    <table class="table table-bordered">
                        <tr class="bg-secondary">
                            <th class="text-center">No</th>
                            <th class="text-center">Kode Kegiatan</th>
                            <th class="text-center">Nomor TBPU</th>
                            <th class="text-center">Jumlah (Rp)</th>
                            <th class="text-center">Sbg Pembayaran</th>
                            <th class="text-center">Tgl Uji Petik</th>
                            <th class="text-center">Temuan</th>
                            <th class="text-center">Rekomendasi TL</th>
                        </tr>

                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">{{ $ujipetik->apbdes_kegiatan->kegiatan->kode_kegiatan }}</td>
                            <td class="text-center">{{ $ujipetik->penataanbelanja_bkp->nomor }}</td>
                            <td class="text-center">
                                <span class="angka">{{ $ujipetik->penataanbelanja_bkp->jumlah }}</span>
                            </td>
                            <td class="text-center">
                                {{ $ujipetik->penataanbelanja_bkp->sebagai }}
                            </td>
                            <td class="text-center">
                                {{ $ujipetik->tgl_uji_petik }}
                            </td>
                            <td>{{ $ujipetik->kesimpulan_sementara }}</td>
                            <td>{{ $ujipetik->rekomendasi_sementara }}</td>
                        </tr>

                    </table>
                    <p>C. Pembukuan </p>
                    <table class="table table-bordered">
                        <thead style="background-color: beige">
                            <tr>
                                <th>#</th>
                                <th>Nama Data</th>
                                <th class="text-center">Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <th>Buku Kas Umum Bulan Januari s.d Juni (Semester 1)</th>
                                <th class="text-center">
                                    @if($bku_semester1)
                                    <a href="{{ asset('storage/'.$bku_semester1->file_data) }}" target="_blank">
                                        <img src="/img/logo-pdf.jpg" width="50px">
                                    </a>
                                    @endif
                                </th>

                            </tr>
                            <tr>
                                <th>2</th>
                                <th>Buku Pembantu Panjar Semester 1</th>
                                <th class="text-center">
                                    @if($bp_semester1)
                                    <a href="{{ asset('storage/'.$bp_semester1->file_data) }}" target="_blank">
                                        <img src="/img/logo-pdf.jpg" width="50px">
                                    </a>
                                    @endif
                                </th>

                            </tr>
                            <tr>
                                <th>3</th>
                                <th>Buku Kas Umum Bulan Juli s.d Desember (Semester 2)</th>
                                <th class="text-center">
                                    @if($bku_semester2)
                                    <a href="{{ asset('storage/'.$bku_semester2->file_data) }}" target="_blank">
                                        <img src="/img/logo-pdf.jpg" width="50px">
                                    </a>
                                    @endif
                                </th>

                            </tr>
                            <tr>
                                <th>4</th>
                                <th>Buku Pembantu Panjar Semester 2</th>
                                <th class="text-center">
                                    @if($bp_semester2)
                                    <a href="{{ asset('storage/'.$bp_semester2->file_data) }}" target="_blank">
                                        <img src="/img/logo-pdf.jpg" width="50px">
                                    </a>
                                    @endif
                                </th>

                            </tr>


                        </tbody>


                    </table>

                </div>
            </div>

        </td>
    </tr>

</table>

<script>
    function angka(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
}

    var length = $('.selisih_pendapatan').length;
   for(let i=0; i<length; i++){
    var pend = $('.anggaran_pendapatan').eq(i).html();
        pend = pend.replaceAll('.', '');
    var realpend = $('.realisasi_pendapatan').eq(i).html();
        realpend = realpend.replaceAll('.', '');
    var selpend = pend-realpend;
    if(selpend < 0){
        selpend = - selpend;
        selpend = '('+ angka(selpend) +')';
    }else{
        selpend = angka(selpend);
    }
    $('.selisih_pendapatan').eq(i).html(selpend);

   }

   var length = $('.selisih_belanja').length;
   for(let i=0; i<length; i++){
    var bel = $('.anggaran_belanja').eq(i).html();
        bel = bel.replaceAll('.', '');
    var realbel = $('.realisasi_belanja').eq(i).html();
        realbel = realbel.replaceAll('.', '');
    var selbel = bel-realbel;
    if(selbel < 0){
        selbel = - selbel;
        selbel = '('+ angka(selbel) +')';
    }else{
        selbel = angka(selbel);
    }
    $('.selisih_belanja').eq(i).html(selbel);

   }

   var length = $('.selisih_pembiayaan').length;
   for(let i=0; i<length; i++){
    var pemb = $('.anggaran_pembiayaan').eq(i).html();
        pemb = pemb.replaceAll('.', '');
    var realpemb = $('.realisasi_pembiayaan').eq(i).html();
        realpemb = realpemb.replaceAll('.', '');
    var selpemb = pemb-realpemb;
    if(selpemb < 0){
        selpemb = - selpemb;
        selpemb = '('+ angka(selpemb) +')';
    }else{
        selpemb = angka(selpemb);
    }
    $('.selisih_pembiayaan').eq(i).html(selpemb);

   }
    

    $('#realisasi').on('click', function(){
        $('#nhp_realisasi').toggle('slow');
        location.href="#nhp_realisasi";
    });
    $('#pendapatan').on('click', function(){
        $('#nhp_pendapatan').toggle('slow');
        location.href="#nhp_pendapatan";
    });
    // $('#kewilayahan').on('click', function(){
    //     $('#nhp_kewilayahan').toggle('slow');
    //     location.href="#nhp_kewilayahan";
    // });
    // $('#kelembagaan').on('click', function(){
    //     $('#nhp_kelembagaan').toggle('slow');
    //     location.href="#nhp_kelembagaan";
    // });
    // $('#perencanaan').on('click', function(){
    //     $('#nhp_perencanaan').toggle('slow');
    //     location.href="#nhp_perencanaan";
    // });
    // $('#adum').on('click', function(){
    //     $('#nhp_adum').toggle('slow');
    //     location.href="#nhp_adum";
    // });
    // $('#pelaporan').on('click', function(){
    //     $('#nhp_pelaporan').toggle('slow');
    //     location.href="#nhp_pelaporan";
    // });

</script>