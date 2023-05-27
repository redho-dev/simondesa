<div class="mt-2">
    <p class="text-info">Silahkan Cek Kesesuaian Struktur APBDes TA {{ $tahun }} yang terinput di Simondes dengan
        Siskeudes</p>
</div>
<div class="row">
    <div class="col-md-7">
        <form action="/adminDesa/updatePembiayaanA" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">

            <table class="table table-bordered">
                <thead>
                    <tr style="background-color: rgb(183, 197, 197)">
                        <th width="5%" style="vertical-align: middle">Kode_rek</th>
                        <th>URAIAN</th>
                        <th width="20%" class="text-center">Anggaran (Rp)</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>4.</td>
                        <td>PENDAPATAN</td>
                        <td></td>
                    </tr>

                    @foreach($pendapatans as $pend)
                    @if($pend->anggaran_murni)
                    <tr>
                        <td>{{ $pend->kode_pendapatan }}</td>
                        <td class="pl-4">{{ $pend->jenis_pendapatan }}</td>
                        <td class="angka text-right">{{ $pend->anggaran_murni}}</td>
                    </tr>
                    @endif
                    @endforeach
                    @foreach($total as $tot)
                    <tr>
                        <td></td>
                        <td class="text-center">TOTAL PENDAPATAN</td>
                        <td class="angka text-right"> {{ $totalPendapatan = $tot->pendapatan_murni }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>5.</td>
                        <td>BELANJA</td>
                        <td></td>
                    </tr>
                    @foreach($belanjas as $bl)
                    <tr>
                        <td>{{ $bl->belanja->kode_belanja }}</td>
                        <td class="pl-4">{{ $bl->belanja->jenis_belanja }}</td>
                        <td class="angka text-right">{{ $bl->anggaran_murni }}</td>
                    </tr>
                    @endforeach

                    <tr>
                        <td></td>
                        <td class="text-center">TOTAL BELANJA</td>
                        <td class="angka text-right">{{ $totalBelanja = $tot->akunbelanja_murni }}</td>
                    </tr>

                    <tr>
                        <td>
                            <input type="hidden" id="surplus" value="{{ $totalPendapatan-$totalBelanja  }}">
                        </td>
                        <td class="text-center">SURPLUS/(DEFISIT)</td>
                        <td class="text-right ">
                            @if($totalPendapatan-$totalBelanja < 0) (<span class="angka">{{
                                $totalPendapatan-$totalBelanja }}</span>)
                                @else
                                {{ $totalPendapatan-$totalBelanja }}
                                @endif
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>PEMBIAYAAN</td>
                        <td></td>
                    </tr>
                    @foreach($pembiayaans as $pemb)
                    @if($pemb->anggaran_murni)
                    <tr>
                        <td>{{ $pemb->kode_pembiayaan }}</td>
                        <td class="pl-4">{{ $pemb->jenis_pembiayaan }}</td>
                        <td class="angka text-right">{{ $pemb->anggaran_murni }}</td>
                    </tr>
                    @endif
                    @endforeach
                    <?php $silpa =  ($tot->pendapatan_murni - $tot->belanja_murni)+
                    $tot->pembiayaan_murni; ?>
                    <tr>
                        <td><input type="hidden" id="netto" value="{{ $tot->pembiayaan_murni }}"> </td>
                        <td class="text-center">PEMBIAYAAN NETTO</td>
                        <td class="angka text-right ">{{ $tot->pembiayaan_murni }}</td>
                    </tr>

                    <tr>
                        <td></td>
                        <td class="text-center">SISA LEBIH PEMBIAYAAN ANGGARAN</td>
                        <td class="angka text-right {{ $silpa != 0 ? 'text-danger' : '' }}">{{ $silpa }}</td>
                    </tr>


                </tbody>


            </table>
        </form>
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