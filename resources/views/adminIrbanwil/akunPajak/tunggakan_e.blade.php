<div class="row">
    <div class="col-md-10">
        <form action="/adminIrbanwil/tunggakanUpdate" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">

            <table class="table table-bordered">
                <thead>
                    <tr class="bg-info">
                        <th width="5%">#</th>
                        <th width="20%" class="text-center">Tunggakan Pajak s.d Saat Ini <br> (Rp)</th>
                        <th width="20%" class="text-center">Sumber Data</th>
                        <th width="15%" class="text-center">Bukti Data</th>
                        <th width="20%" class="text-center">Ganti Bukti Data</th>
                        <th width="20%" class="text-center">Prosentase Bebas <br> Tunggakan Pajak (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><input type="text" name="tunggakan" class="form-control angka text-center"
                                style="font-size: .8rem" value="{{ $tunggakan[0]->tunggakan }}" required>
                        </td>
                        <td>
                            <input type=" text" name="sumber_data" class="form-control" style="font-size: .8rem"
                                value="{{ $tunggakan[0]->sumber_data }}">
                        </td>
                        <td class="text-center">
                            <a href="{{ asset('storage/'.$tunggakan[0]->bukti_data) }}" target="_blank"><img
                                    src="/img/logo-pdf.jpg" width="50px"></a>
                        </td>
                        <td>
                            <input type="hidden" name="old" value="{{ $tunggakan[0]->bukti_data }}">
                            <input type="file" class="form-control" name="bukti_pelunasan" style="font-size: .8rem">
                        </td>
                        <td class="text-center">
                            <p style="font-size: 1.2rem">{{ $tunggakan[0]->prosentase }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-center">
                            <button class="btn btn-sm btn-primary">UPDATE</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p class="text-info">Cara Perhitungan Prosentase Bebas Tunggakan Pajak <br> - Prosentase 0 Jika Tunggakan
                Pajak Rp.0 <br>-
                Prosentase 100 Jika Tunggakan Pajak >= Rp. 50.000.000,- </p>
        </form>
    </div>
</div>