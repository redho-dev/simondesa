<div class="row akunwil">
    <div class="col-md-8">
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
                        {{ $hasil->nama ?? '' }}
                    </th>
                    <th>
                        {{ $hasil->tanggal_pengujian ?? '' }}

                    </th>
                    <th width="20%" class="text-center" style="vertical-align: middle">
                        @if ($hasil)
                        {{ $hasil->data }}
                        @else
                        <div class="text-danger">
                            {{ 'belum ada data'; }}
                        </div>
                        @endif
                    </th>

                </tr>
                <tr>
                    <th colspan="4">
                        <div class="form-group ">
                            <div class="text-danger">
                                {{ 'Data Diisi Oleh Inspektorat.' }}
                            </div>
                        </div>
                    </th>
                </tr>
            </tbody>
        </table>

    </div>
</div>
<div class="ln_solid"></div>