<style>
    .bgg {
        background-color: lightslategray;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <p class="text-primary mt-4">A. Jumlah Uang Yang Belum Dipertanggungjawabkan</p>
        <table class="table table-bordered">
            <thead class="bg-info">
                <tr>
                    <th colspan="2" class="text-center" style="vertical-align: middle">Realisasi Penerimaan Kas
                        Desa</th>
                    <th colspan="2" class="text-center" style="vertical-align: middle">Realisasi Pengeluaran Kas Desa

                    </th>
                    <th colspan="2" class="text-center" style="vertical-align: middle">Jumlah Uang Yang Telah
                        diPertanggungjawabkan</th>
                    <th rowspan="2" class="text-center" style="vertical-align: middle">Saldo Murni
                    </th>
                    <th rowspan="2" class="text-center" style="vertical-align: middle">Jumlah Uang Yang Belum
                        diPertanggungjawabkan
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
                    <td class="text-center bgg {{ $saldoKas < 0 ? 'text-danger' : '' }}">{{ Pembantu::mask($saldoKas) }}
                    </td>
                    <td class="text-center angka bgg">{{ $belumSPJ }}</td>
                </tr>
            </tbody>

        </table>

        <p class="text-primary mt-4">B. Data Pajak TA {{ $tahun }} yg Terinput di SIMONDES</p>
        <table class="table table-bordered">
            <thead class="bg-success">
                <tr>
                    <th class="text-center" style="vertical-align: middle">Jumlah Anggaran <br>Belanja</th>
                    <th class="text-center" style="vertical-align: middle">Jumlah TBPU </th>
                    <th class="text-center" style="vertical-align: middle">Jumlah PPN</th>
                    <th class="text-center" style="vertical-align: middle">Jumlah PPh</th>
                    <th class="text-center" style="vertical-align: middle">Jumlah Pajak Lainnya</th>
                    <th class="text-center" style="vertical-align: middle">Total Pajak</th>
                    <th class="text-center" style="vertical-align: middle">PPN disetor</th>
                    <th class="text-center" style="vertical-align: middle">PPh disetor</th>
                    <th class="text-center" style="vertical-align: middle">Pajak Lainnya disetor</th>
                    <th class="text-center" style="vertical-align: middle">Total Pajak disetor</th>
                    <th class="text-center" style="vertical-align: middle">Pajak Blm disetor</th>
                    <th class="text-center" style="vertical-align: middle">Progress Pajak</th>
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
                    <th class="text-center p-0 m-0">(Rp)</th>
                    <th class="text-center p-0 m-0">(Rp)</th>
                    <th class="text-center p-0 m-0">(Rp)</th>
                    <th class="text-center p-0 m-0">(%)</th>


                </tr>

            </thead>
            <tbody>
                <tr>
                    <td class="text-center angka bgg">{{ $totalBelanja }}</td>
                    <td class="text-center angka bgg">{{ $jumlahbkp }}</td>
                    <td class="text-center angka bgg">{{ $ppn }}</td>
                    <td class="text-center angka bgg">{{ $pph }}</td>
                    <td class="text-center angka bgg">{{ $lainnya }}</td>
                    <td class="text-center angka bgg">{{ $totalPajak }}</td>
                    <td class="text-center angka bgg">{{ $setorppn }}</td>
                    <td class="text-center angka bgg">{{ $setorpph }}</td>
                    <td class="text-center angka bgg">{{ $setorlainnya }}</td>
                    <td class="text-center angka bgg">{{ $setorPajak }}</td>
                    <td class="text-center angka bgg">{{ $blmSetor }}</td>
                    <td class="text-center bgg">{{ $progress }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <p class="text-primary">C. Hasil Rekon Pajak TA {{ $tahun }} </p>
        <ul>
            <li class="text-info">Koreksi jumlah potongan pajak adalah jumlah total potongan pajak setelah koreksi
                setiap TBPU di SIMONDes</li>
            <li class="text-info">Koreksi jumlah pajak (PPN dan PPh) terbayar TA {{ $tahun }} dapat dilakukan dengan
                meminta data dari Kantor Pajak Pratama Kotabumi</li>
            <li class="text-info">Koreksi jumlah pajak lainnya terbayar TA {{ $tahun }} dapat dilakukan dengan
                meminta data dari BPPRD</li>
            <li class="text-info">Tunggakan Pajak tahun-tahun sebelumnya dapat diperoleh dari LHP Inspektorat atau dari
                Buku Pembantu
                Pajak tahun-tahun sebelumnya dan data dari Kantor Pajak Pratama Kotabumi</li>
        </ul>
        <form action="/adminIrbanwil/rekonPajakUpdate" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">

            <table class="table table-bordered" id="tabelrekon">
                <thead class="bg-info">
                    <tr>
                        <th class="text-center" style="vertical-align: middle">Jumlah PPN Terkoreksi</th>
                        <th class="text-center" style="vertical-align: middle">Jumlah PPh Terkoreksi</th>
                        <th class="text-center" style="vertical-align: middle">Jumlah Pajak Lainnya Terkoreksi</th>
                        <th class="text-center" style="vertical-align: middle">Jumlah PPN Terbayar TA {{
                            $tahun
                            }} </th>
                        <th class="text-center" style="vertical-align: middle">Jumlah PPh Terbayar TA {{
                            $tahun
                            }} </th>

                        <th class="text-center" style="vertical-align: middle">Jumlah Pajak Lainnya Terbayar TA {{
                            $tahun
                            }} </th>

                        <th class="text-center" style="vertical-align: middle">Tunggakan Pajak Tahun-tahun sebelumnya
                        </th>
                        <th class="text-center" style="vertical-align: middle">Update Bukti Dukung
                        </th>
                        <th class="text-center" style="vertical-align: middle">% Pemenuhan Pajak
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
                        <td class="text-center p-0 m-0">%</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rekon as $rek)
                    <tr>
                        <td>
                            <input type="text" name="koreksi_ppn"
                                class="form-control angka  text-center {{ $koreksi_ppn != $ppn ? 'text-danger' : '' }}"
                                value="{{ $koreksi_ppn }}" style="font-size: .8rem" required readonly>
                        </td>
                        <td>
                            <input type="text" name="koreksi_pph"
                                class="form-control angka  text-center {{ $koreksi_pph != $pph ? 'text-danger' : '' }}"
                                value="{{ $koreksi_pph }}" style="font-size: .8rem" required readonly>
                        </td>
                        <td>
                            <input type="text" name="koreksi_lainnya"
                                class="form-control angka  text-center {{ $koreksi_lainnya != $lainnya ? 'text-danger' : '' }}"
                                value="{{ $koreksi_lainnya }}" style="font-size: .8rem" required readonly>
                        </td>
                        <td>
                            <input type="text" name="ppn_terbayar" class="form-control angka text-center"
                                value="{{ $rek->ppn_terbayar }}" style="font-size: .8rem" required>
                        </td>
                        <td>
                            <input type="text" name="pph_terbayar" class="form-control angka text-center"
                                value="{{ $rek->pph_terbayar }}" style="font-size: .8rem" required>
                        </td>
                        <td>
                            <input type="text" name="lainnya_terbayar" class="form-control angka text-center"
                                value="{{ $rek->lainnya_terbayar }}" style="font-size: .8rem" required>
                        </td>

                        <td>
                            <input type="text" name="tunggakan_pajak" class="form-control angka text-center"
                                value="{{ $rek->tunggakan_pajak }}" style="font-size: .8rem" required>
                        </td>
                        <td class="text-center">
                            <a href="{{ asset('storage/'.$rek->bukti_dukung) }}" target="_blank"><img
                                    src="/img/logo-pdf.jpg" width="50px"></a>
                            <input type="hidden" name="old_0" value="{{ $rek->bukti_dukung }}">
                        </td>
                        <td class="text-center bg-secondary">
                            <span style="font-size: 1.2rem">{{ $rek->prosentase_terbayar }}</span>
                        </td>
                    </tr>
                    @endforeach
                    <tr class="text-center">
                        <td colspan="7">
                            <button type="submit" class="btn btn-primary">UPDATE</button>
                        </td>
                        <td>
                            <p class="image_upload mb-0">
                                <label for="bukti_dukung">
                                    <a class="btn btn-warning btn-sm" rel="nofollow"><span class='fa fa-file'></span>
                                        Upload</a>
                                </label>

                                <input type="file" name="bukti_dukung" id="bukti_dukung" style="display: none">
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>