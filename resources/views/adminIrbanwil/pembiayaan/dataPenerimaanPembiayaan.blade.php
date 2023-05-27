<?php 
if($anggaran == 'perubahan'){
    $jumgar = 'anggaran_perubahan';
}else{
    $jumgar = 'anggaran_murni';
}

?>
<div class="row">
    <div class="col-md-8">
        <p class="alert alert-info" style="font-size: 1rem">Data Penerimaan Pembiayaan Tahun Anggaran {{ $tahun }}</p>
    </div>
</div>

<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label for="totalAnggaran">Anggaran Penerimaan Pembiayaan </label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                </div>
                <input type="text" class="form-control angka" id="totalAnggaran" value="{{ $anggaranPen->$jumgar }}"
                    style="font-size: .75rem" readonly>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="realisasi">Realisasi Penerimaan Pembiayaan</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                </div>
                <input type="text" class="form-control angka" id="realisasi" style="font-size: .75rem"
                    value="{{ $realisasi }}" readonly>
            </div>

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="progress">Progress Penerimaan </label>
            <div class="input-group mb-2">
                @if($anggaranPen->$jumgar > 0)
                <input type="text" class="form-control text-right" id="progress"
                    value="{{ round(($realisasi/$anggaranPen->$jumgar)*100,2) }}" style="font-size: .75rem;" readonly>
                @else
                <input type="text" class="form-control text-right" id="progress" value="0" style="font-size: .75rem;"
                    readonly>
                @endif
                <div class="input-group-append">
                    <div class="input-group-text" style="font-size: .75rem"> %</div>
                </div>
            </div>

        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-8">
        <table class="table table-bordered">
            <thead class="bg-info">
                <tr>
                    <th style="vertical-align: middle">#</th>
                    <th style="vertical-align: middle">Jenis Penerimaan Pembiayaan</th>
                    <th class="text-center" style="vertical-align: middle">Jumlah Anggaran <br>(Rp)</th>
                    <th class="text-center" style="vertical-align: middle">Realisasi <br>(Rp)</th>
                    <th class="text-center" style="vertical-align: middle">Nama Data</th>
                    <th class="text-center" style="vertical-align: middle">File_data</th>

                </tr>
            </thead>
            <tbody>
                @foreach($penPemb as $pen)
                <tr class="{{ $pen->$jumgar > 0 ? '' : 'd-none' }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pen->jenis_pembiayaan }}</td>
                    <td class="text-right angka">{{ $pen->$jumgar }}</td>
                    <td class="text-right angka">{{ $pen->penataan_pembiayaan->jumlah ?? 0
                        }}</td>
                    <td>
                        {{ $pen->penataan_pembiayaan->nama_data ?? '' }}
                    </td>
                    <td class="text-center ">
                        @if($pen->penataan_pembiayaan)
                        <a href="{{ asset('storage/'.$pen->penataan_pembiayaan->file_data) }}" target="_blank"><img
                                src="{{ asset('storage/'.$pen->penataan_pembiayaan->file_data) }}" width="100px"></a>
                        @else
                        <p class="text-danger">(kosong)</p>
                        @endif
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>