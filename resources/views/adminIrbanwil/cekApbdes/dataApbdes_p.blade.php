<div class="row">
    <div class="col-md-7">
        <p class="alert alert-warning text-dark" style="font-size: 1rem">Silahkan Cek Kesesuaian Struktur APBDes
            Perubahan TA {{
            $tahun }} yang terinput
            di Simondes
            dengan
            Siskeudes</p>
        <div>
            <p class="text-dark">A. Dokumen APBDes Perubaan Tahun Anggaran {{ $tahun }} Print Out Siskedes</p>
            <table class="table table-bordered ">
                <tr class="bg-success">
                    <td>No</td>
                    <td>Nama Data</td>
                    <td class="text-center">File Data</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Dokumen APBDes Perubahan TA {{ $tahun }}</td>
                    <td class="text-center">
                        @if($dokumen[0]->dokumen_perubahan)
                        <a href="{{ asset('storage/'.$dokumen[0]->dokumen_perubahan) }}" target="_blank"><img
                                src="/img/logo-pdf.jpg" width="50px"></a>
                        @else
                        <p class="text-danger">Data Kosong</p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Penjabaran APBDes Perubahan TA {{ $tahun }}</td>
                    <td class="text-center">
                        @if($dokumen[0]->dokumen_penjabaran_perubahan)
                        <a href="{{ asset('storage/'.$dokumen[0]->dokumen_penjabaran_perubahan) }}" target="_blank"><img
                                src="/img/logo-pdf.jpg" width="50px"></a>
                        @else
                        <p class="text-danger">Data Kosong</p>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        <div class="mt-4">
            <p class="text-dark">B. Data Jumlah Pendapatan, Belanja, dan Pembiayaan yang terinput di SIMONDES</p>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr style="background-color: rgb(183, 197, 197)">
                        <th width="5%" style="vertical-align: middle">Kode_rek</th>
                        <th style="vertical-align: middle">URAIAN</th>
                        <th width="20%" class="text-center">Anggaran <br> Awal (Rp)</th>
                        <th width="20%" class="text-center">Anggaran <br>Perubahan (Rp)</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>4.</td>
                        <td>PENDAPATAN</td>
                        <td></td>
                        <td></td>
                    </tr>

                    @foreach($pendapatans as $pend)
                    @if($pend->anggaran_murni)
                    <tr>
                        <td>{{ $pend->kode_pendapatan }}</td>
                        <td class="pl-4">
                            <span class="{{ strlen($pend->kode_pendapatan) != 3 ? 'pl-4' : '' }}">{{
                                $pend->jenis_pendapatan }}</span>
                        </td>
                        <td class="angka text-right">{{ $pend->anggaran_murni}}</td>
                        <td class="angka text-right">{{ $pend->anggaran_perubahan}}</td>
                    </tr>
                    @endif
                    @endforeach
                    @foreach($total as $tot)
                    <tr>
                        <td></td>
                        <td class="text-center">TOTAL PENDAPATAN</td>
                        <td class="angka text-right"> {{ $totalPendapatan = $tot->pendapatan_murni }}</td>
                        <td class="angka text-right"> {{ $totalPendapatan2 = $tot->pendapatan_perubahan }}</td>

                    </tr>
                    @endforeach
                    <tr>
                        <td>5.</td>
                        <td>BELANJA</td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach($belanjas as $bl)
                    <tr>
                        <td>{{ $bl->belanja->kode_belanja }}</td>
                        <td class="pl-4">{{ $bl->belanja->jenis_belanja }}</td>
                        <td class="angka text-right">{{ $bl->anggaran_murni }}</td>
                        <td class="angka text-right">{{ $bl->anggaran_perubahan }}</td>
                    </tr>
                    @endforeach

                    <tr>
                        <td></td>
                        <td class="text-center">TOTAL BELANJA</td>
                        <td class="angka text-right">{{ $totalBelanja = $tot->belanja_murni }}</td>
                        <td class="angka text-right">{{ $totalBelanja2 = $tot->belanja_perubahan }}</td>
                    </tr>

                    <tr>
                        <td>
                            <input type="hidden" id="surplus" value="{{ $totalPendapatan-$totalBelanja  }}">
                        </td>
                        <td class="text-center">SURPLUS/(DEFISIT)</td>
                        <td class="text-right">
                            {{ $totalPendapatan-$totalBelanja < 0 ? "(" .-($totalPendapatan-$totalBelanja).")" :
                                $totalPendapatan-$totalBelanja }} </td>
                        <td class="text-right ">
                            {{ $totalPendapatan2-$totalBelanja2 < 0 ? "(" .-($totalPendapatan2-$totalBelanja2).")" :
                                $totalPendapatan2-$totalBelanja2 }} </td>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <td>PEMBIAYAAN</td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach($pembiayaans as $pemb)
                    @if($pemb->anggaran_murni OR $pemb->anggaran_perubahan)
                    <tr>
                        <td>{{ $pemb->kode_pembiayaan }}</td>
                        <td class="pl-4">
                            <span class="{{ strlen($pemb->kode_pembiayaan) != 3 ? 'pl-4' : '' }}">{{
                                $pemb->jenis_pembiayaan }}</span>
                        </td>
                        <td class="angka text-right">{{ $pemb->anggaran_murni=='' ? 0 : $pemb->anggaran_murni }}</td>
                        <td class="angka text-right">{{ $pemb->anggaran_perubahan }}</td>
                    </tr>
                    @endif
                    @endforeach
                    <?php 
                    $silpa =  ($tot->pendapatan_murni - $tot->belanja_murni)+$tot->pembiayaan_murni;
                    $silpa2 = ($tot->pendapatan_perubahan - $tot->belanja_perubahan)+$tot->pembiayaan_perubahan;
                     ?>
                    <tr>
                        <td><input type="hidden" id="netto" value="{{ $tot->pembiayaan_murni }}"> </td>
                        <td class="text-center">PEMBIAYAAN NETTO</td>
                        <td class="angka text-right ">{{ $tot->pembiayaan_murni }}</td>
                        <td class="angka text-right ">{{ $tot->pembiayaan_perubahan }}</td>
                    </tr>

                    <tr>
                        <td></td>
                        <td class="text-center">SISA LEBIH PEMBIAYAAN ANGGARAN</td>
                        <td class="angka text-right {{ $silpa != 0 ? 'text-danger' : '' }}">{{ $silpa }}</td>
                        <td class="angka text-right {{ $silpa2 != 0 ? 'text-danger' : '' }}">{{ $silpa2 }}</td>
                    </tr>


                </tbody>


            </table>
        </div>

    </div>
</div>


@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    $('.angka').mask('000.000.000.000.000', {
        reverse: true
    });
   
    var surplus = Number($('#surplus').val());
    var netto = Number($('#netto').val());
    var silpa = surplus + netto;
   


   
</script>

@endpush