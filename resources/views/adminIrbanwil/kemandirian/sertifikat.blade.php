<div class="row akunwil">
    <div class="col-md-6">

        <table class="table table-bordered">
            <thead class="bg-info">
                <tr>
                    <th width="5%" style="vertical-align: middle">No</th>
                    <th width="40%" style="vertical-align: middle">Nama Data</th>
                    <th class="text-center" width="15%" style="vertical-align: middle">Isi Data
                        <br> <small>(klik untuk
                            lihat)</small>
                    </th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>1</th>
                    <th>
                        Sertifikat Siskeudes Atas Nama Perangkat Desa
                    </th>
                    <th width="30%" class="text-center" style="vertical-align: middle">
                        <input type="hidden" name="jenis" value="sertifikat">
                        @if ($sertifikat)
                        <a href="{{ asset('storage/'.$sertifikat->data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @else
                        <div class="text-danger">
                            {{ 'Kosong'; }}
                        </div>
                        @endif
                    </th>

                </tr>

            </tbody>
        </table>

    </div>
</div>
<div class="ln_solid"></div>