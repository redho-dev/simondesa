<div class="row akunwil">
    <div class="col-md-8">


        <form action="/adminIrbanwil/ujiSiskeudesUpdate" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="jenis" value="{{ $jenis }}">

            <table class="table table-bordered">
                <thead class="bg-info">
                    <tr>
                        <th width="5%" style="vertical-align: middle">No</th>
                        <th width="40%" style="vertical-align: middle">Nama Peserta Uji</th>
                        <th width="30%" style="vertical-align: middle">Tanggal Pengujian</th>
                        <th class="text-center" width="25%" style="vertical-align: middle">Nilai

                        </th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <th>1</th>
                        <th>
                            <input type="text" class="form-control" name="nama" value="{{ $hasil->nama }}" required>
                        </th>
                        <th>
                            <input type="date" class="form-control" name="tanggal_pengujian"
                                value="{{ $hasil->tanggal_pengujian }}" required>
                        </th>
                        <th width="20%" class="text-center" style="vertical-align: middle">

                            <input type="number" class="form-control text-center" name="data"
                                value="{{ $hasil->data }}">

                        </th>

                    </tr>
                    <tr>
                        <th colspan="4" class="text-center">
                            <button class="btn btn-primary">UPDATE</button>
                        </th>
                    </tr>
                </tbody>
            </table>
        </form>

    </div>
</div>
<div class="ln_solid"></div>