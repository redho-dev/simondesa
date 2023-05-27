<h4 class="alert alert-info">Surat Setoran Pajak (SSP) Atas Belanja APB Desa TA {{ $tahun }}</h4>
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label for="totalAnggaran">Jumlah Anggaran Belanja</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                </div>
                <input type="text" class="form-control angka" id="Anggaran" value="{{ $totalBelanja }}"
                    style="font-size: .75rem" readonly>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="totalAnggaran">Total TBPU/BKP</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                </div>
                <input type="text" class="form-control angka" id="totalBkp" value="{{ $jumlahbkp }}"
                    style="font-size: .75rem" readonly>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="totalSPP">Total Potongan Pajak</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                </div>
                <input type="text" class="form-control angka" id="totalPajak" value="{{ $totalPajak }}"
                    style="font-size: .75rem" readonly>
            </div>

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="progressSPP">Pajak disetor</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                </div>
                <input type="text" class="form-control angka" id="pajakTerbayar" value="{{ $setorPajak }}"
                    style="font-size: .75rem" readonly>
            </div>

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="progressSPP">Pajak Belum disetor</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                </div>
                <input type="text" class="form-control angka" id="pajakBelum" style=" font-size: .75rem"
                    value="{{ $blmSetor }}" readonly>
            </div>

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="progressSPP">Progress Setor Pajak</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="progressPajak" style="font-size: .75rem"
                    value="{{ $progress }}" readonly>
                <div class="input-group-append">
                    <div class="input-group-text" style="font-size: .75rem">%</div>
                </div>
            </div>

        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
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
            @foreach($bkpPajak as $bkp)
            <tr class=" {{ $bkp->billing_pph || $bkp->billing_ppn ? 'text-primary' : '' }}" id="row_{{ $bkp->id }}">
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
                <td class="angka">{{ $bkp->ppn }}</td>
                <td class="angka">{{ $bkp->pph }}</td>
                <td class="angka">{{ $bkp->lainnya }}</td>
                <td class="text-center">
                    @if($bkp->ppn && $bkp->billing_ppn)
                    <a href="{{ asset('storage/'.$bkp->billing_ppn) }}" target="_blank"><img src="/img/logo-pdf.jpg"
                            width="35px"></a>
                    @elseif($bkp->ppn && !$bkp->billing_ppn)
                    <small class="text-danger">(belum setor)</small>
                    @endif
                </td>
                <td class="text-center">
                    @if($bkp->pph && $bkp->billing_pph)
                    <a href="{{ asset('storage/'.$bkp->billing_pph) }}" target="_blank"><img src="/img/logo-pdf.jpg"
                            width="35px"></a>
                    @elseif($bkp->pph && !$bkp->billing_pph)
                    <small class="text-danger">(belum setor)</small>
                    @endif
                </td>
                <td class="text-center">
                    @if($bkp->lainnya && $bkp->billing_lainnya)
                    <a href="{{ asset('storage/'.$bkp->billing_lainnya) }}" target="_blank"><img src="/img/logo-pdf.jpg"
                            width="35px"></a>
                    @elseif($bkp->lainnya && !$bkp->billing_lainnya)
                    <small class="text-danger">(belum setor)</small>
                    @endif
                </td>


            </tr>
            @endforeach
        </table>
    </div>
</div>