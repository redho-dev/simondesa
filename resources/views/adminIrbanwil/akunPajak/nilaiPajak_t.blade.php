<div class="row ">
    <div class="col-md-8 mt-2">
        <p class="alert bg-warning text-dark" style="font-size: 1rem">Penilaian Indikator : Kepatuhan Pajak
        </p>
        <form action="/adminIrbanwil/nilaiAkunPajak" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="aspek_id" value=2>
            <input type="hidden" name="indikator_id" value=10>

            <table class="table table-bordered">
                <thead>
                    <tr class="bg-info">
                        <th width="5%" style="vertical-align: middle">No</th>
                        <th width="55%" style="vertical-align: middle">Sub Indikator</th>
                        <th width="10%" class="text-center" style="vertical-align: middle">Bobot <br>(%)</th>
                        <th width="15%" class="text-center">Keterisian<br>Data (%)</th>
                        <th width="15%" class="text-center" style="vertical-align: middle">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Prosentase Bebas Tunggakan Pajak</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">30</td>
                        <td class="text-center" style="vertical-align: middle">{{ $persenDataTunggakan }}
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="persen_data_tunggakan" value={{ $persenDataTunggakan }}>
                            <input type="hidden" name="sub_indikator_keuangan_id[]" value=9>
                            <input type="number" class="form-control text-center" style="font-size: .85rem"
                                name="nilai[]" value="{{ $nilaiTunggakan }}" readonly required>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Prosentase Pemenuhan Pajak Tahun Berkenaan</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">60</td>
                        <td class="text-center" style="vertical-align: middle">{{ $persenDataPemenuhan }}
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="persen_data_pemenuhan" value={{ $persenDataPemenuhan }}>
                            <input type="hidden" name="sub_indikator_keuangan_id[]" value=10>
                            <input type="number" class="form-control text-center" style="font-size: .85rem"
                                name="nilai[]" value="{{ $nilaiPemenuhan }}" required readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Buku Pembantu Pajak</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                        <td class="text-center" style="vertical-align: middle">{{ $datnilBPP ?
                            round($datnilBPP->persen_data) : 0 }}
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="sub_indikator_keuangan_id[]" value=11>
                            <input type="number" class="form-control text-center" name="nilai[]"
                                style="font-size: .85rem" required>
                        </td>
                    </tr>

                </tbody>

                <tr>
                    <td colspan="5" class="text-muted">
                        <p class="mb-0"><i>Petunjuk Penilaian : </i></p>
                        <ul>
                            <li>
                                Nilai Prosentase Bebas Tunggakan Pajak = 100 jika total tunggakan pajak tahun-tahun
                                sebelumnya adalah Rp.0
                            </li>
                            <li>
                                Nilai Prosentase Bebas Tunggakan Pajak = 0 jika total tunggakan pajak tahun-tahun
                                sebelumnya >= Rp. 20.000.000,-
                            </li>
                            <li>
                                Nilai Prosentase Pemenuhan Pajak Tahun Berkenaan diperoleh dari prosentase pemenuhan
                                pajak hasil rekon
                            </li>
                            <li>
                                Nilai Buku Pembantu pajak 0 jika keterisian data 0, dan nilai 100 jika data lengkap dan
                                sesuai
                            </li>
                        </ul>

                    </td>
                </tr>
                <tr>
                    <td colspan="5" style="background-color: beige">
                        KESIMPULAN : (TERISI OTOMATIS SESUAI SKORING YANG DIBERIKAN)
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#temuan">
                            Daftar Temuan
                        </button>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" style="background-color: beige">
                        <div class="form-group">
                            <label for="uraian">Catatan / Saran / Uraian Kesimpulan / Apresiasi </label>
                            <input type="hidden" name="uraian" id="uraian" autofocus>
                            <trix-editor input="uraian" class="bg-white">
                            </trix-editor>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="bg-info">
                        <div class="form-group">
                            <label for="kesimpulan">Temuan (tambahan jika ada) :</label>
                            <input type="hidden" name="catatan_sementara" id="kesimpulan" autofocus>
                            <trix-editor input="kesimpulan" class="bg-white">{!! $catatan->catatan_sementara ?? ''
                                !!}
                            </trix-editor>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="bg-info">
                        <div class="form-group">
                            <label for="saran">Rekomendasi Tindak Lanjut (tambahan jika ada):</label>
                            <input type="hidden" name="rekom_sementara" id="saran">
                            <trix-editor input="saran" class="bg-white">{!! $catatan->rekom_sementara ?? '' !!}
                            </trix-editor>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right">
                        <button type="submit" class="btn btn-primary">KIRIM</button>
                    </td>
                </tr>


            </table>
        </form>
        <!-- Modal -->
        <div class="modal fade" id="temuan" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-white" id="staticBackdropLabel">DAFTAR TEMUAN PAJAK
                            TA
                            {{
                            $tahun }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-primary">A.JUMLAH UANG YANG BELUM DIPERTANGGUNGJAWABKAN</p>
                        <table class="table table-bordered">
                            <thead class="bg-info">
                                <tr>
                                    <th colspan="2" class="text-center" style="vertical-align: middle">Realisasi
                                        Penerimaan Kas
                                        Desa</th>
                                    <th colspan="2" class="text-center" style="vertical-align: middle">Realisasi
                                        Pengeluaran Kas Desa

                                    </th>
                                    <th colspan="2" class="text-center" style="vertical-align: middle">Jumlah Uang Yang
                                        Telah
                                        diPertanggungjawabkan</th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle">Saldo Murni
                                    </th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle">Jumlah Uang Yang
                                        Belum
                                        diPertanggungjawabkan <br>(Temuan)
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-center">Realisasi Pendapatan</th>
                                    <th class="text-center">Realisasi Penerimaan Pembiayaan</th>
                                    <th class="text-center">SPP Kegiatan</th>
                                    <th class="text-center">SPP Pengeluaran Pembiayaan</th>
                                    <th class="text-center">TBPU Kegiatan</th>
                                    <th class="text-center">TBPU Pengeluaran Pembiayaan</th>

                                </tr>
                                <tr>
                                    <th class="text-center p-0 m-0">(Rp)</th>
                                    <th class="text-center p-0 m-0">(Rp)</th>
                                    <th class="text-center p-0 m-0">(Rp)</th>
                                    <th class="text-center p-0 m-0">(Rp)</th>
                                    <th class="text-center p-0 m-0">(Rp)</th>
                                    <th class="text-center p-0 m-0">(Rp)</th>
                                    <th class="text-center p-0 m-0">(Rp)</th>
                                    <th class="text-center p-0 m-0">(Rp)</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center angka bgg">{{ $realisasiPendapatan }}</td>
                                    <td class="text-center angka bgg">{{ $penerimaanPembiayaan }}</td>
                                    <td class="text-center angka bgg">{{ $jumlahSPP }}</td>
                                    <td class="text-center angka bgg">{{ $pengeluaranPembiayaan }}</td>
                                    <td class="text-center angka bgg">{{ $jumlahbkp }}</td>
                                    <td class="text-center angka bgg">{{ $pengeluaranPembiayaan }}</td>
                                    <td class="text-center angka bgg">{{ $saldoKas }}</td>
                                    <td class="text-center angka bgg">{{ $belumSPJ }}</td>
                                </tr>
                            </tbody>
                            <tfoot class="{{ $belumSPJ <= 0 ? 'd-none' : '' }}">
                                <tr class="bg-secondary">
                                    <td colspan="2">
                                        Rekomendasi Tindak Lanjut :
                                    </td>
                                    <td colspan="7">
                                        Agar segera menyelesaikan pertanggungjawaban keuangan sebesar Rp. <span
                                            class="angka">{{ $belumSPJ
                                            }}</span>, serta memungut dan menyetorkan pajak sesuai ketentuan dari nilai
                                        uang yang
                                        belum dipertanggungjawabkan tersebut
                                    </td>
                                </tr>
                            </tfoot>
                        </table>


                        <p class="text-primary">B. KOREKSI PAJAK ATAS BELANJA (TBPU) </p>

                        @if($koreksiBkp->count() > 0)
                        <ul class="mt-0 mb-2">
                            <li class="text-primary">Temuan :</li>
                        </ul>
                        <table class="table table-bordered">
                            <tr style="background-color:steelblue">
                                <th>#</th>
                                <th>Nomor TBPU/BKP <br> Tanggal</th>
                                <th class="text-center">Jumlah Uang dlm <br>TBPU (Rp)</th>
                                <th>Jenis Belanja /<br> Sbg Pembayaran</th>
                                <th class="text-center">Potongan <br> PPN (Rp)</th>
                                <th class="text-center">Potongan <br> PPh (Rp)</th>

                                <th class="text-center">Potongan <br> Lainnya (Rp)</th>
                                <th class="text-center">Koreksi
                                    <br>PPN
                                </th>
                                <th class="text-center">Koreksi
                                    <br>PPh
                                </th>
                                <th class="text-center">Koreksi
                                    <br>Lainnya
                                </th>


                            </tr>
                            @foreach($koreksiBkp as $korek)
                            <tr class=" {{ $korek->billing_pph || $korek->billing_ppn ? 'text-primary' : '' }}"
                                id="row_{{ $korek->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <ul class="pl-2">
                                        <li>No : {{ $korek->nomor }}</li>
                                        <li>Tgl: {{ $korek->tanggal }}</li>
                                    </ul>
                                </td>
                                <td class="angka">{{ $korek->jumlah }}</td>
                                <td>
                                    <ul class="pl-2">
                                        <li> {{ $korek->belanja->jenis_belanja }}</li>
                                        <li>{{ $korek->sebagai }}</li>
                                    </ul>

                                </td>
                                <td class="text-center">
                                    <span class="angka">{{ $korek->ppn }}</span><br>
                                    <span class="text-primary">
                                        {{ $korek->ppn > 0 && $korek->billing_ppn ? '(sudah setor)' : ''
                                        }}
                                    </span>
                                    <span class="text-warning">
                                        {{ $korek->ppn > 0 && !$korek->billing_ppn ? '(belum setor)' : '' }}

                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="angka">{{ $korek->pph }}</span><br>
                                    <span class="text-primary">
                                        {{ $korek->pph > 0 && $korek->billing_pph ? '(sudah setor)' : ''
                                        }} </span>
                                    <span class="text-warning">
                                        {{ $korek->pph > 0 && !$korek->billing_pph ? '(belum setor)' : '' }}

                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="angka">{{ $korek->lainnya }}</span><br>
                                    <span class="text-primary">
                                        {{ $korek->lainnya > 0 && $korek->billing_lainnya ? '(sudah setor)' : ''
                                        }}
                                    </span>
                                    <span class="text-warning">
                                        {{ $korek->lainnya > 0 && !$korek->billing_lainnya ? '(belum setor)' : '' }}

                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="angka {{ $korek->ppn != $korek->koreksi_ppn ? 'text-danger' : ''}}">
                                        {{ $korek->koreksi_ppn }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="angka {{ $korek->pph != $korek->koreksi_pph ? 'text-danger' : ''}}">{{
                                        $korek->koreksi_pph }}</span>
                                </td>
                                <td class="text-center">
                                    <span
                                        class="angka {{ $korek->lainnya != $korek->koreksi_lainnya ? 'text-danger' : ''}} ">{{
                                        $korek->koreksi_lainnya }}</span>
                                </td>


                            </tr>
                            @endforeach
                            <tfoot class="{{ count($koreksiBkp)<=0 ? 'd-none' : '' }}">
                                <tr class="bg-secondary">
                                    <td colspan="2">Rekomendasi Tindak Lanjut :</td>
                                    <td colspan="8">
                                        <ul>
                                            <li>
                                                Agar bendahara pengeluaran memungut ulang pajak sebesar nilai
                                                terkoreksi,
                                                mengganti TBPU, dan menyetorkan pajak dimaksud secara tepat waktu.
                                            </li>
                                            <li>
                                                Agar bendahara pengeluaran menyetorkan sisa pajak (kurang setor),
                                                sebesar selisih pajak terkoreksi dengan yang telah dibayarkan
                                            </li>
                                        </ul>

                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        @else
                        <p class="ml-4">tidak ada</p>
                        @endif
                        <p class="text-primary mt-2 mb-0">C. PAJAK YANG TELAH DIPUNGUT NAMUN BELUM DISETORKAN TA
                            {{ $tahun }}</p>
                        <ul class="mt-0 mb-2 mt-1">
                            <li class="text-primary">Temuan :</li>
                        </ul>
                        <table class="table table-bordered">
                            <tr style="background-color:steelblue">
                                <th>#</th>
                                <th>Nomor TBPU/BKP <br> Tanggal</th>
                                <th class="text-center">Jumlah Uang dlm <br>TBPU (Rp)</th>
                                <th>Jenis Belanja /<br> Sbg Pembayaran</th>
                                <th class="text-center">Potongan <br> PPn (Rp)</th>
                                <th class="text-center">Potongan <br> PPh (Rp)</th>

                                <th class="text-center">Potongan <br> Lainnya (Rp)</th>
                                <th class="text-center">Surat Setor Pajak
                                    <br>PPn
                                </th>
                                <th class="text-center">Surat Setor Pajak
                                    <br>PPh (21,22,23)
                                </th>
                                <th class="text-center">Surat Setor Pajak
                                    <br>Lainnya
                                </th>


                            </tr>
                            @foreach($belumsetor as $bkp)
                            <tr class=" {{ $bkp->billing_pph || $bkp->billing_ppn ? 'text-primary' : '' }}"
                                id="row_{{ $bkp->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <ul class="pl-2">
                                        <li>No : {{ $bkp->nomor }}</li>
                                        <li>Tgl: {{ $bkp->tanggal }}</li>
                                    </ul>
                                </td>
                                <td class="angka">{{ $bkp->jumlah }}</td>
                                <td>
                                    <ul class="pl-2">
                                        <li> {{ $bkp->belanja->jenis_belanja }}</li>
                                        <li>{{ $bkp->sebagai }}</li>
                                    </ul>

                                </td>
                                <td class="angka">{{ $bkp->koreksi_ppn }}</td>
                                <td class="angka">{{ $bkp->koreksi_pph }}</td>
                                <td class="angka">{{ $bkp->koreksi_lainnya }}</td>
                                <td class="text-center">
                                    @if($bkp->ppn && $bkp->billing_ppn)
                                    <a href="{{ asset('storage/'.$bkp->billing_ppn) }}" target="_blank"><img
                                            src="/img/logo-pdf.jpg" width="35px"></a>
                                    @elseif($bkp->ppn && !$bkp->billing_ppn)
                                    <small class="text-danger">(belum setor)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($bkp->pph && $bkp->billing_pph)
                                    <a href="{{ asset('storage/'.$bkp->billing_pph) }}" target="_blank"><img
                                            src="/img/logo-pdf.jpg" width="35px"></a>
                                    @elseif($bkp->pph && !$bkp->billing_pph)
                                    <small class="text-danger">(belum setor)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($bkp->lainnya && $bkp->billing_lainnya)
                                    <a href="{{ asset('storage/'.$bkp->billing_lainnya) }}" target="_blank"><img
                                            src="/img/logo-pdf.jpg" width="35px"></a>
                                    @elseif($bkp->lainnya && !$bkp->billing_lainnya)
                                    <small class="text-danger">(belum setor)</small>
                                    @endif
                                </td>


                            </tr>
                            @endforeach
                            <tfoot class="{{ count($belumsetor)<=0 ? 'd-none' : '' }}">

                                <tr class="bg-secondary">
                                    <td colspan="2">
                                        Rekomendasi Tindak Lanjut :
                                    </td>
                                    <td colspan="8">
                                        Agar segera menyetorkan pajak yang telah dipungut sesuai
                                        daftar temuan diatas
                                    </td>
                                </tr>
                            </tfoot>

                        </table>

                        <p class="text-primary mt-2 mb-0">D. TUNGGAKAN PAJAK TAHUN-TAHUN SEBELUMNYA DAN PAJAK TERHUTANG
                            TA {{ $tahun }}</p>
                        <p class="text-primary ml-2 my-2">1. Data Hasil Rekon Pajak TA {{ $tahun }}
                        </p>
                        <table class="table table-bordered" id="tabelrekon">
                            <thead class="bg-info">
                                <tr>
                                    <th class="text-center" style="vertical-align: middle">Jumlah PPN Terkoreksi</th>
                                    <th class="text-center" style="vertical-align: middle">Jumlah PPh Terkoreksi</th>
                                    <th class="text-center" style="vertical-align: middle">Jumlah Lainnya Terkoreksi
                                    </th>
                                    <th class="text-center" style="vertical-align: middle">Jumlah PPN Terbayar TA {{
                                        $tahun
                                        }} </th>
                                    <th class="text-center" style="vertical-align: middle">Jumlah PPh Terbayar TA {{
                                        $tahun
                                        }} </th>

                                    <th class="text-center" style="vertical-align: middle">Jumlah Pajak Lainnya Terbayar
                                        TA {{
                                        $tahun
                                        }} </th>

                                    <th class="text-center" style="vertical-align: middle">Tunggakan Pajak Tahun-tahun
                                        sebelumnya
                                    </th>
                                    <th class="text-center" style="vertical-align: middle">Bukti Dukung
                                    </th>
                                </tr>
                                <tr class="p-0 m-0">
                                    <td class="text-center p-0 m-0">(Rp)</td>
                                    <td class="text-center p-0 m-0">(Rp)</td>
                                    <td class="text-center p-0 m-0">(Rp)</td>
                                    <td class="text-center p-0 m-0">(Rp)</td>
                                    <td class="text-center p-0 m-0">(Rp)</td>
                                    <td class="text-center p-0 m-0">(Rp)</td>
                                    <td class="text-center p-0 m-0">(Rp)</td>
                                    <td class="text-center p-0 m-0"></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rekon as $rek)
                                <tr>
                                    <td>
                                        <input type="text" name="koreksi_ppn" class="form-control angka  text-center"
                                            value="{{ $koreksi_ppn }}" style="font-size: .8rem" required readonly>
                                    </td>
                                    <td>
                                        <input type="text" name="koreksi_pph" class="form-control angka  text-center"
                                            value="{{ $koreksi_pph }}" style="font-size: .8rem" required readonly>
                                    </td>
                                    <td>
                                        <input type="text" name="koreksi_lainnya"
                                            class="form-control angka  text-center" value="{{ $koreksi_lainnya }}"
                                            style="font-size: .8rem" required readonly>
                                    </td>
                                    <td>
                                        <input type="text" name="ppn_terbayar" class="form-control angka text-center"
                                            value="{{ $rek->ppn_terbayar }}" style="font-size: .8rem" readonly>
                                    </td>
                                    <td>
                                        <input type="text" name="pph_terbayar" class="form-control angka text-center"
                                            value="{{ $rek->pph_terbayar }}" style="font-size: .8rem" readonly>
                                    </td>
                                    <td>
                                        <input type="text" name="lainnya_terbayar"
                                            class="form-control angka text-center" value="{{ $rek->lainnya_terbayar }}"
                                            style="font-size: .8rem" readonly>
                                    </td>

                                    <td>
                                        <input type="text" name="tunggakan_pajak" class="form-control angka text-center"
                                            value="{{ $rek->tunggakan_pajak }}" style="font-size: .8rem" readonly>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ asset('storage/'.$rek->bukti_dukung) }}" target="_blank"><img
                                                src="/img/logo-pdf.jpg" width="50px"></a>
                                        <input type="hidden" name="old_0" value="{{ $rek->bukti_dukung }}">
                                    </td>

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <p class="text-primary ml-2 my-2">2. Temuan Tunggakan Pajak dan Pajak Terhutang TA {{ $tahun }}
                            (berdasarkan hasil rekon)
                        </p>
                        <table class="table table-bordered" id="tabelrekon">
                            <thead class="bg-info">
                                <tr>
                                    <th class="text-center" style="vertical-align: middle">Jumlah PPN Terhutang TA {{
                                        $tahun }}</th>
                                    <th class="text-center" style="vertical-align: middle">Jumlah PPh Terhutang TA {{
                                        $tahun }}</th>
                                    <th class="text-center" style="vertical-align: middle">Jumlah Pajak Lainnya
                                        Terhutang TA {{
                                        $tahun }}</th>
                                    <th class="text-center" style="vertical-align: middle">Total Jumlah Pajak Terhutang
                                        TA {{
                                        $tahun
                                        }} </th>

                                    <th class="text-center" style="vertical-align: middle">Tunggakan Pajak Tahun-tahun
                                        sebelumnya
                                    </th>

                                </tr>
                                <tr class="p-0 m-0">
                                    <td class="text-center p-0 m-0">(Rp)</td>
                                    <td class="text-center p-0 m-0">(Rp)</td>
                                    <td class="text-center p-0 m-0">(Rp)</td>
                                    <td class="text-center p-0 m-0">(Rp)</td>
                                    <td class="text-center p-0 m-0">(Rp)</td>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rekon as $rek)
                                <tr>
                                    <td>
                                        <input type="text" name="koreksi_ppn" class="form-control angka  text-center"
                                            value="{{ $rek->ppn_terhutang }}" style="font-size: .8rem" required
                                            readonly>
                                    </td>
                                    <td>
                                        <input type="text" name="koreksi_pph" class="form-control angka  text-center"
                                            value="{{  $rek->pph_terhutang }}" style="font-size: .8rem" required
                                            readonly>
                                    </td>
                                    <td>
                                        <input type="text" name="koreksi_lainnya"
                                            class="form-control angka  text-center"
                                            value="{{  $rek->lainnya_terhutang }}" style="font-size: .8rem" required
                                            readonly>
                                    </td>
                                    <td>
                                        <input type="text" name="ppn_terbayar" class="form-control angka text-center"
                                            value="{{ $rek->total_terhutang }}" style="font-size: .8rem" readonly>
                                    </td>
                                    <td>
                                        <input type="text" name="pph_terbayar" class="form-control angka text-center"
                                            value="{{ $rek->tunggakan_pajak }}" style="font-size: .8rem" readonly>
                                    </td>
                                </tr>


                            </tbody>
                            <tfoot>
                                <tr class="bg-secondary">
                                    <td>
                                        Rekomendasi Tindak Lanjut
                                    </td>
                                    <td colspan="4">
                                        <ul>
                                            <li class="{{ $rek->tunggakan_pajak <= 0 ? 'd-none' : '' }}">
                                                Agar pemerintah desa segera melunasi tunggakan pajak tahun-tahun
                                                sebelumnya senilai Rp. <span class="angka">{{ $rek->tunggakan_pajak
                                                    }}</span>
                                            </li>
                                            <li class="{{ $rek->total_terhutang <= 0 ? 'd-none' : '' }}">
                                                Agar pemerintah desa segera melunasi pajak terhutang tahun {{ $tahun }}
                                                senilai Rp. <span class="angka">{{ $rek->total_terhutang
                                                    }}</span>,
                                                dengan menyesuaikan jenis
                                                dan
                                                besaran pajak terhutang sebagaimana termuat dalam poin C diatas
                                            </li>
                                            <li class="{{ $rek->total_terhutang <= 0 ? 'd-none' : '' }}">
                                                Apabila terdapat selisih antara nilai akumulasi pajak terhutang pada
                                                poin C dengan pajak terhutang berdasarkan hasil rekon, maka nilai yang
                                                diakui adalah nilai pajak terhutang berdasarkan hasil rekon
                                            </li>
                                        </ul>

                                    </td>
                                </tr>
                            </tfoot>
                            @endforeach
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>


    </div>

</div>