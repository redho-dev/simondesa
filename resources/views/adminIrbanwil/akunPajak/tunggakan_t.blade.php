<div class="row">
    <div class="col-md-12">
        <form action="/adminIrbanwil/tunggakanTambah" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">

            <table class="table table-bordered">
                <thead>
                    <tr class="bg-info">
                        <th width="16%" class="text-center">Pajak TA {{ $tahun }} <br>Yang Belum disetor <br> (Rp)</th>
                        <th width="18%" class="text-center">Tunggakan Pajak <br> (Tahun2 Sblmnya) <br> (Rp)</th>
                        <th width="18%" class="text-center">Total Tunggakan Pajak <br> (Rp)</th>
                        <th width="30%" class="text-center">Sumber Data</th>
                        <th width="18%" class="text-center">Upload Bukti Data</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="text" name="pajak_terhutang" class="form-control angka text-center"
                                style="font-size: .8rem" required>
                        </td>
                        <td>
                            <input type="text" name="tunggakan_pajak" class="form-control angka text-center"
                                style="font-size: .8rem" required>
                        </td>
                        <td>
                            <input type="text" name="total_tunggakan" class="form-control angka text-center"
                                style="font-size: .8rem" required>
                        </td>
                        <td>
                            <input type="text" name="sumber_data" class="form-control" style="font-size: .8rem"
                                required>
                        </td>
                        <td>
                            <input type="file" name="bukti_data" class="form-control" style="font-size: .8rem" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-center">
                            <button class="btn btn-primary">KIRIM</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>