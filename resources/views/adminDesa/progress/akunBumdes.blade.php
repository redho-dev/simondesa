<div class="row mb-2">
    <div class="col">
        <a href="/adminDesa/nilai_akun?akun=pemkeu" class="btn btn-secondary">Pemerintahan &
            Keuangan Desa</a>
        <a href="/adminDesa/nilai_akun?akun=bumdes" class="btn btn-primary">Pengelolaan BUM
            Desa</a>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card " style="height: 400px">
            <h4 class="text-info text-center mt-2">AKUNTABILITAS <br> PENGELOLAAN BADAN USAHA MILIK DESA (BUM DESA)
            </h4>

            <span id="skorP" class="d-none">{{ $akunBumdes }}</span>
            <div class="gauge-container mb-0 pb-2">
                <div class="gauge"></div>
            </div>
            <svg width="0" height="0" version="1.1" class="gradient-mask" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="gradientGauge">
                        <stop class="color-red" offset="0%" />
                        <stop class="color-orange" offset="30%" />
                        <stop class="color-yellow" offset="55%" />
                        <stop class="color-yellow" offset="75%" />
                        <stop class="color-green" offset="90%" />
                        <stop class="color-blue" offset="100%" />


                    </linearGradient>
                </defs>
            </svg>

            <h4 class="mt-0 mb-2 text-center text-dark">Tingkat Akuntabilitas : {{
                akun($akunBumdes) }}</h4>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header" style="background-color: rgb(20, 37, 145)">
                <h4 class="text-center text-white"> INDIKATOR PENILAIAN AKUNTABILITAS
                    <br>PENGELOLAAN BUM DESA
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Indikator</th>
                                    <th>Bobot</th>
                                    <th>Nilai</th>
                                    <th>Skor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($indikatorBumdes as $ind)
                                <tr>
                                    <td>{{ $ind->id }}</td>
                                    <td>{{ $ind->indikator }}</td>
                                    <td>{{ $ind->bobot }}</td>
                                    <td>{{ $ind->nilai_bumd->pluck('nilai_sementara')->first() }}</td>
                                    <td>{{ $ind->nilai_bumd->pluck('skor')->first() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td class="text-right mr-4" colspan="3">Total Skor </td>
                                    <td class="text-center">{{ $akunBumdes }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center mt-2">
    <div class="col-md-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <span class="badge badge-sm"
                            style="display: block; height:100%; background-color:red;">&nbsp;</span>
                    </div>
                    <div class="col-md-10">
                        <span class="text-4 font-weight-bold">0-30</span><br>
                        <span>Sangat Rendah</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <span class="badge badge-sm"
                            style="display: block; height:100%; background-color:orange;">&nbsp;</span>
                    </div>
                    <div class="col-md-10">
                        <span class="text-4 font-weight-bold">31-55</span><br>
                        <span>Rendah</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <span class="badge badge-sm"
                            style="display: block; height:100%; background-color:yellow;">&nbsp;</span>
                    </div>
                    <div class="col-md-10">
                        <span class="text-4 font-weight-bold">56-75</span><br>
                        <span>Cukup</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <span class="badge badge-success badge-sm" style="display: block; height:100%;">&nbsp;</span>
                    </div>
                    <div class="col-md-10">
                        <span class="text-4 font-weight-bold">76-90</span><br>
                        <span>Tinggi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card ">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <span class="badge badge-primary badge-sm" style="display: block; height:100%;">&nbsp;</span>
                    </div>
                    <div class="col-md-10">
                        <span class="text-4 font-weight-bold">91-100</span><br>
                        <span>Sangat Tinggi </span>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<br><br>