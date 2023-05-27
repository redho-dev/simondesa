<style>
    #rujukan {
        height: 85vh;
        overflow: scroll;
    }
</style>
<div class="row ">
    <div class="col-md-7 mt-2">
        <table class="table table-striped table-bordered">
            <thead class="bg-info">
                <tr>
                    <th style="vertical-align: middle" width="5%">No</th>
                    <th style="vertical-align: middle" width="50%">Nama Data</th>
                    <th class="text-center" width="25%">file_data </th>
                    <th class="text-center" width="20%">Catatan </th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Laporan Penyelenggaraan Pemerintahan Desa (LPPD) Tahun {{ $tahun-1 }}
                    </td>
                    <td class="text-center">
                        @if($dalap['lppd'])
                        <a href="{{ asset('storage/'.$dalap['lppd']->file_data) }}" target="_blank"><img
                                src="{{ asset('/img/logo-pdf.jpg') }}" alt="" width="50px"></a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif

                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($dalap['lppd'] && $dalap['lppd']->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#lppd">
                            + lihat catatan
                        </button>
                        @elseif($dalap['lppd'] && !$dalap['lppd']->catatan)
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#lppd">
                            + catatan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="lppd" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran Atas LPPD</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaPel" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="lppd">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_lppd" class="text-dark">Catatan : </label>
                                                    <input type="hidden" name="catatan" id="catatan_lppd" autofocus>
                                                    <trix-editor input="catatan_lppd" class="bg-white">
                                                        {!! $dalap['lppd']->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_lppd" class="text-dark">Saran : </label>
                                                    <input type="hidden" name="saran" id="saran_lppd" autofocus>
                                                    <trix-editor input="saran_lppd" class="bg-white">
                                                        {!! $dalap['lppd']->saran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($dalap['lppd'] && $dalap['lppd']->catatan)
                                        <button type="submit" class="btn btn-primary">UPDATE</button>
                                        @else
                                        <button type="submit" class="btn btn-primary">KIRIM</button>
                                        @endif

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </tr>
                <tr>
                    <td>2</td>
                    <td>Laporan Keterangan Penyelenggaraan Pemerintahan Desa (LKPD) Tahun {{ $tahun-1 }}</td>
                    <td class="text-center">
                        @if($dalap["lkpd"])
                        <a href="{{ asset('storage/'.$dalap['lkpd']->file_data) }}" target="_blank"><img
                                src="{{ asset('/img/logo-pdf.jpg') }}" width="50px"></a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif

                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($dalap['lkpd'] && $dalap['lkpd']->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#lkpd">
                            + lihat catatan
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#lkpd">
                            + catatan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="lkpd" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran Atas LKPD</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaPel" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="lkpd">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_lkpd" class="text-dark">Catatan : </label>
                                                    <input type="hidden" name="catatan" id="catatan_lkpd" autofocus>
                                                    <trix-editor input="catatan_lkpd" class="bg-white">
                                                        {!! $dalap['lkpd']->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_lkpd" class="text-dark">Saran : </label>
                                                    <input type="hidden" name="saran" id="saran_lkpd" autofocus>
                                                    <trix-editor input="saran_lkpd" class="bg-white">
                                                        {!! $dalap['lkpd']->saran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($dalap['lkpd'] && $dalap['lkpd']->catatan)
                                        <button type="submit" class="btn btn-primary">UPDATE</button>
                                        @else
                                        <button type="submit" class="btn btn-primary">KIRIM</button>
                                        @endif

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </tr>
                <tr>
                    <td>3</td>
                    <td>Peraturan Desa tentang Laporan Pertanggungjawaban APB Desa Tahun {{ $tahun-1 }}</td>
                    <td class="text-center">
                        @if($dalap["perdes_pj"])
                        <a href="{{ asset('storage/'.$dalap['perdes_pj']->file_data) }}" target="_blank"><img
                                src="{{ asset('/img/logo-pdf.jpg') }}" width="50px"></a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif

                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($dalap['perdes_pj'] && $dalap['perdes_pj']->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#perdes_pj">
                            + lihat catatan
                        </button>
                        @elseif($dalap['perdes_pj'] && !$dalap['perdes_pj']->catatan)
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#perdes_pj">
                            + catatan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="perdes_pj" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran Atas Perdes Pertanggungjawaban APB Desa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaPel" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="perdes_pj">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_perdes_pj" class="text-dark">Catatan : </label>
                                                    <input type="hidden" name="catatan" id="catatan_perdes_pj"
                                                        autofocus>
                                                    <trix-editor input="catatan_perdes_pj" class="bg-white">
                                                        {!! $dalap['perdes_pj']->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_perdes_pj" class="text-dark">Saran : </label>
                                                    <input type="hidden" name="saran" id="saran_perdes_pj" autofocus>
                                                    <trix-editor input="saran_perdes_pj" class="bg-white">
                                                        {!! $dalap['perdes_pj']->saran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($dalap['perdes_pj'] && $dalap['perdes_pj']->catatan)
                                        <button type="submit" class="btn btn-primary">UPDATE</button>
                                        @else
                                        <button type="submit" class="btn btn-primary">KIRIM</button>
                                        @endif

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </tr>
                <tr>
                    <td>4</td>
                    <td>Laporan Realisasi APB Desa TA {{ $tahun }} Semester 1</td>
                    <td class="text-center">
                        @if($dalap["lra_1"])
                        <a href="{{ asset('storage/'.$dalap['lra_1']->file_data) }}" target="_blank"><img
                                src="{{ asset('/img/logo-pdf.jpg') }}" width="50px"></a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($dalap['lra_1'] && $dalap['lra_1']->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#lra_1">
                            + lihat catatan
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#lra_1">
                            + catatan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="lra_1" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran Atas LRA Semester 1</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaPel" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="lra_1">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_lra_1" class="text-dark">Catatan : </label>
                                                    <input type="hidden" name="catatan" id="catatan_lra_1" autofocus>
                                                    <trix-editor input="catatan_lra_1" class="bg-white">
                                                        {!! $dalap['lra_1']->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_lra_1" class="text-dark">Saran : </label>
                                                    <input type="hidden" name="saran" id="saran_lra_1" autofocus>
                                                    <trix-editor input="saran_lra_1" class="bg-white">
                                                        {!! $dalap['lra_1']->saran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($dalap['lra_1'] && $dalap['lra_1']->catatan)
                                        <button type="submit" class="btn btn-primary">UPDATE</button>
                                        @else
                                        <button type="submit" class="btn btn-primary">KIRIM</button>
                                        @endif

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </tr>
                <tr>
                    <td>5</td>
                    <td>Laporan Realisasi APB Desa TA {{ $tahun }} Akhir Tahun</td>
                    <td class="text-center">
                        @if($dalap["lra_2"])
                        <a href="{{ asset('storage/'.$dalap['lra_2']->file_data) }}" target="_blank"><img
                                src="{{ asset('/img/logo-pdf.jpg') }}" width="50px"></a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif

                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($dalap['lra_2'] && $dalap['lra_2']->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#lra_2">
                            + lihat catatan
                        </button>
                        @elseif($dalap['lra_2'] && !$dalap['lra_2']->catatan)
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#lra_2">
                            + catatan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="lra_2" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran Atas LRA Akhir Tahun</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaPel" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="lra_2">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_lra_2" class="text-dark">Catatan : </label>
                                                    <input type="hidden" name="catatan" id="catatan_lra_2" autofocus>
                                                    <trix-editor input="catatan_lra_2" class="bg-white">
                                                        {!! $dalap['lra_2']->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_lra_2" class="text-dark">Saran : </label>
                                                    <input type="hidden" name="saran" id="saran_lra_2" autofocus>
                                                    <trix-editor input="saran_lra_2" class="bg-white">
                                                        {!! $dalap['lra_2']->saran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($dalap['lra_2'] && $dalap['lra_2']->catatan)
                                        <button type="submit" class="btn btn-primary">UPDATE</button>
                                        @else
                                        <button type="submit" class="btn btn-primary">KIRIM</button>
                                        @endif

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </tr>

            </tbody>
        </table>

    </div>
</div>
<div class="row">
    <div class="col-md-7 mt-2" id="rujukan">
        <table class="table table-striped table-bordered">
            <thead class="bg-info">
                <tr>
                    <th>Rujukan Regulasi</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        1. Permendagri Nomor 20 Tahun 2018 tentang Pengelolaan Keuangan Desa
                    </td>
                </tr>
                <tr>
                    <td>
                        &emsp; a. Laporan Realisasi APB Desa Semester 1
                        <br><br>
                        <img src="{{ asset('storage/regulasi/lra_semester1.JPG') }}" width="80%" class="ml-4">
                        <br><br>
                        &emsp; b. Peraturan Desa tentang Laporan Pertanggungjawaban APB Desa
                        <br><br>
                        <img src="{{ asset('storage/regulasi/pertanggungjawaban.JPG') }}" width="80%" class="ml-4">
                    </td>
                </tr>
                <tr>
                    <td>
                        2. Permendagri Nomor 46 Tahun 2016 tentang Laporan Kepala Desa
                    </td>
                </tr>
                <tr>
                    <td>
                        <img src="{{ asset('storage/regulasi/ruling_laporankades.JPG') }}" width="80%" class="ml-4">
                        <br><br>

                        a. Laporan Penyelenggaraan Pemerintahan Desa (LPPD)
                        <br><br>
                        <img src="{{ asset('storage/regulasi/lppd_1.JPG') }}" width="80%" class="ml-4">
                        <br>
                        <img src="{{ asset('storage/regulasi/lppd_2.JPG') }}" width="80%" class="ml-4">
                        <br><br>
                        b. Laporan Keterangan Penyelenggaraan Pemerintahan Desa (LKPD)
                        <br><br>
                        <img src="{{ asset('storage/regulasi/lkpd.JPG') }}" width="80%" class="ml-4">
                    </td>

                </tr>
            </tbody>

        </table>

    </div>
</div>