<div class="row ">
    <div class="col-md-10 mt-2">
        <table class="table table-striped table-bordered">
            <thead class="bg-info">
                <tr>
                    <th style="vertical-align: middle" width="5%">No</th>
                    <th style="vertical-align: middle" width="40%">Nama Data</th>
                    <th class="text-center" width="20%">file_data <br> <small>(klik untuk lihat)</small></th>
                    <th width="20%" class="text-center">Keterangan</th>
                    <th width="15%" class="text-center">Catatan </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Perdes dan Dokumen RPJMDes
                    </td>
                    <td class="text-center">
                        @if($dokrpjmd->file_data)
                        <a href="{{ asset('storage/'.$dokrpjmd->file_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif
                    </td>
                    <td>
                        @if($norpjmd->uraian)
                        <p>Perdes Nomor : {{ $norpjmd->uraian }}</p>
                        @endif
                    </td>

                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($dokrpjmd->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#dokumen_rpjmd">
                            + lihat catatan
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#dokumen_rpjmd">
                            + catatan
                        </button>
                        @endif
                    </td>

                    <!-- Modal -->
                    <div class="modal fade" id="dokumen_rpjmd" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran {{ $dokrpjmd->nama_data ?? '' }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaDokren" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="dokumen_rpjmd">
                                    <input type="hidden" name="dokren" value="rpjmd">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_dokumen_rpjmd" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan" id="catatan_dokumen_rpjmd"
                                                        autofocus>
                                                    <trix-editor input="catatan_dokumen_rpjmd" class="bg-white">
                                                        {!! $dokrpjmd->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_dokumen_rpjmd" class="text-dark">Saran : </label>
                                                    <input type="hidden" name="saran" id="saran_dokumen_rpjmd"
                                                        autofocus>
                                                    <trix-editor input="saran_dokumen_rpjmd" class="bg-white">
                                                        {!! $dokrpjmd->saran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($dokrpjmd->catatan)
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
                    <td>SK Tim Penyusunan RKP Desa Tahun {{ $tahun }}</td>
                    <td class="text-center">
                        @if($sktim && $sktim->isidata)
                        <a href="{{ asset('storage/'.$sktim->isidata) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif
                    </td>
                    <td></td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($sktim && $sktim->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#sk_tim_rkpdes">
                            + lihat catatan
                        </button>
                        @elseif($sktim && !$sktim->catatan)
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#sk_tim_rkpdes">
                            + catatan
                        </button>
                        @endif
                    </td>

                    <!-- Modal -->
                    <div class="modal fade" id="sk_tim_rkpdes" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran {{ $sktim->nama_data ?? '' }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaDokren" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="sk_tim_rkpdes">
                                    <input type="hidden" name="dokren" value="rkpdes">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_sk_tim_rkpdes" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan" id="catatan_sk_tim_rkpdes"
                                                        autofocus>
                                                    <trix-editor input="catatan_sk_tim_rkpdes" class="bg-white">
                                                        {!! $sktim->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_sk_tim_rkpdes" class="text-dark">Saran : </label>
                                                    <input type="hidden" name="saran" id="saran_sk_tim_rkpdes"
                                                        autofocus>
                                                    <trix-editor input="saran_sk_tim_rkpdes" class="bg-white">
                                                        {!! $sktim->saran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($sktim && $sktim->catatan)
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
                    <td>BAC Musyawarah Dusun</td>
                    <td class="text-center">
                        @if($musdus && $musdus->isidata)
                        <a href="{{ asset('storage/'.$musdus->isidata) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif
                    </td>
                    <td></td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($musdus && $musdus->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#bac_musdus">
                            + lihat catatan
                        </button>
                        @elseif($musdus && !$musdus->catatan)
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#bac_musdus">
                            + catatan
                        </button>
                        @endif
                    </td>

                    <!-- Modal -->
                    <div class="modal fade" id="bac_musdus" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran {{ $musdus->nama_data ?? '' }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaDokren" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="bac_musdus">
                                    <input type="hidden" name="dokren" value="rkpdes">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_bac_musdus" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan" id="catatan_bac_musdus"
                                                        autofocus>
                                                    <trix-editor input="catatan_bac_musdus" class="bg-white">
                                                        {!! $musdus->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_bac_musdus" class="text-dark">Saran : </label>
                                                    <input type="hidden" name="saran" id="saran_bac_musdus" autofocus>
                                                    <trix-editor input="saran_bac_musdus" class="bg-white">
                                                        {!! $musdus->saran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($musdus && $musdus->catatan)
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
                    <td>BAC Musrenbangdes</td>
                    <td class="text-center">
                        @if($musren && $musren->isidata)
                        <a href="{{ asset('storage/'.$musren->isidata) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($fotomusren && $fotomusren->isidata)
                        <a href="{{ asset('storage/'.$fotomusren->isidata) }}" target="_blank">
                            <img src="{{ asset('storage/'.$fotomusren->isidata) }}" width="50px">
                        </a>
                        @endif
                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($musren && $musren->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#bac_musrenbangdes">
                            + lihat catatan
                        </button>
                        @elseif($musren && !$musren->catatan)
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#bac_musrenbangdes">
                            + catatan
                        </button>
                        @endif
                    </td>

                    <!-- Modal -->
                    <div class="modal fade" id="bac_musrenbangdes" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran {{ $musren->nama_data ?? '' }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaDokren" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="bac_musrenbangdes">
                                    <input type="hidden" name="dokren" value="rkpdes">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_bac_musrenbangdes" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan" id="catatan_bac_musrenbangdes"
                                                        autofocus>
                                                    <trix-editor input="catatan_bac_musrenbangdes" class="bg-white">
                                                        {!! $musren->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_bac_musrenbangdes" class="text-dark">Saran :
                                                    </label>
                                                    <input type="hidden" name="saran" id="saran_bac_musrenbangdes"
                                                        autofocus>
                                                    <trix-editor input="saran_bac_musrenbangdes" class="bg-white">
                                                        {!! $musren->saran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($musren && $musren->catatan)
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
                    <td>Perdes dan Dokumen RKP Desa Tahun {{ $tahun }}</td>
                    <td class="text-center">
                        @if($dokrkpd && $dokrkpd->isidata)
                        <a href="{{ asset('storage/'.$dokrkpd->isidata) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif
                    </td>
                    <td></td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($dokrkpd && $dokrkpd->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#dokumen_rkpdes">
                            + lihat catatan
                        </button>
                        @elseif($dokrkpd && !$dokrkpd->catatan)
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#dokumen_rkpdes">
                            + catatan
                        </button>
                        @endif
                    </td>

                    <!-- Modal -->
                    <div class="modal fade" id="dokumen_rkpdes" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran {{ $dokrkpd->nama_data ?? '' }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaDokren" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="dokumen_rkpdes">
                                    <input type="hidden" name="dokren" value="rkpdes">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_dokumen_rkpdes" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan" id="catatan_dokumen_rkpdes"
                                                        autofocus>
                                                    <trix-editor input="catatan_dokumen_rkpdes" class="bg-white">
                                                        {!! $dokrkpd->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_dokumen_rkpdes" class="text-dark">Saran :
                                                    </label>
                                                    <input type="hidden" name="saran" id="saran_dokumen_rkpdes"
                                                        autofocus>
                                                    <trix-editor input="saran_dokumen_rkpdes" class="bg-white">
                                                        {!! $dokrkpd->saran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($dokrkpd && $dokrkpd->catatan)
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
                    <td>6</td>
                    <td>Ketepatan Waktu Penetapan Perdes RKP Desa Tahun {{ $tahun }}</td>
                    <td class="text-center">
                        @if($tglrkpd && $tglrkpd->isidata)
                        <p>{{ $tglrkpd->isidata }}</p>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif
                    </td>
                    <td>
                        Perdes RKP Desa Tahun {{ $tahun }} ditetapkan paling lambat akhir bulan september tahun {{
                        $tahun-1 }}
                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($tglrkpd && $tglrkpd->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#tanggal_penetapan_rkpdes">
                            + lihat catatan
                        </button>
                        @elseif($tglrkpd && !$tglrkpd->catatan)
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#tanggal_penetapan_rkpdes">
                            + catatan
                        </button>
                        @endif
                    </td>

                    <!-- Modal -->
                    <div class="modal fade" id="tanggal_penetapan_rkpdes" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran {{ $tglrkpd->nama_data ?? '' }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaDokren" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="tanggal_penetapan_rkpdes">
                                    <input type="hidden" name="dokren" value="rkpdes">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_tanggal_penetapan_rkpdes"
                                                        class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan"
                                                        id="catatan_tanggal_penetapan_rkpdes" autofocus>
                                                    <trix-editor input="catatan_tanggal_penetapan_rkpdes"
                                                        class="bg-white">
                                                        {!! $tglrkpd->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_tanggal_penetapan_rkpdes" class="text-dark">Saran
                                                        :
                                                    </label>
                                                    <input type="hidden" name="saran"
                                                        id="saran_tanggal_penetapan_rkpdes" autofocus>
                                                    <trix-editor input="saran_tanggal_penetapan_rkpdes"
                                                        class="bg-white">
                                                        {!! $tglrkpd->saran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($tglrkpd && $tglrkpd->catatan)
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
                    <td>7</td>
                    <td>Dokumen RAPBDes Tahun {{ $tahun }}</td>
                    <td class="text-center">
                        @if($dok_rapbdes && $dok_rapbdes->isi_data)
                        <a href="{{ asset('storage/'.$dok_rapbdes->isi_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif
                    </td>
                    <td>
                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($dok_rapbdes && $dok_rapbdes->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#dokumen_rapbdes">
                            + lihat catatan
                        </button>
                        @elseif($dok_rapbdes && !$dok_rapbdes->catatan)
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#dokumen_rapbdes">
                            + catatan
                        </button>
                        @endif
                    </td>

                    <!-- Modal -->
                    <div class="modal fade" id="dokumen_rapbdes" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran {{ $dok_rapbdes->nama_data ?? '' }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaDokren" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="dokumen_rapbdes">
                                    <input type="hidden" name="dokren" value="rapbdes">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_dokumen_rapbdes" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan" id="catatan_dokumen_rapbdes"
                                                        autofocus>
                                                    <trix-editor input="catatan_dokumen_rapbdes" class="bg-white">
                                                        {!! $dok_rapbdes->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_dokumen_rapbdes" class="text-dark">Saran :
                                                    </label>
                                                    <input type="hidden" name="saran" id="saran_dokumen_rapbdes"
                                                        autofocus>
                                                    <trix-editor input="saran_dokumen_rapbdes" class="bg-white">
                                                        {!! $dok_rapbdes->saran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($dok_rapbdes && $dok_rapbdes->catatan)
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
                    <td>8</td>
                    <td>BAC Pembahasan RAPBDes dengan BPD</td>
                    <td class="text-center">
                        @if($bac && $bac->isi_data)
                        <a href="{{ asset('storage/'.$bac->isi_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif
                    </td>
                    <td>

                        @if($foto_musdes)
                        <p>foto musdes pembahasan RAPBDes</p>
                        <a href="{{ asset('storage/'.$foto_musdes) }}" target="_blank">
                            <img src="{{ asset('storage/'.$foto_musdes) }}" width="100px">
                        </a>
                        @endif

                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($bac && $bac->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#bac">
                            + lihat catatan
                        </button>
                        @elseif($bac && !$bac->catatan)
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#bac">
                            + catatan
                        </button>
                        @endif
                    </td>

                    <!-- Modal -->
                    <div class="modal fade" id="bac" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran {{ $bac->nama_data ?? '' }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaDokren" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="bac">
                                    <input type="hidden" name="dokren" value="rapbdes">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_bac" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan" id="catatan_bac" autofocus>
                                                    <trix-editor input="catatan_bac" class="bg-white">
                                                        {!! $bac->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_bac" class="text-dark">Saran :
                                                    </label>
                                                    <input type="hidden" name="saran" id="saran_bac" autofocus>
                                                    <trix-editor input="saran_bac" class="bg-white">
                                                        {!! $bac->saran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($bac && $bac->catatan)
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
                    <td>9</td>
                    <td>Keputusan BPD tentang Persetujuan RAPBDes menjadi APBDes TA {{ $tahun }}</td>
                    <td class="text-center">
                        @if($keputusan_bpd && $keputusan_bpd->isi_data)
                        <a href="{{ asset('storage/'.$keputusan_bpd->isi_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif
                    </td>
                    <td>
                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($keputusan_bpd && $keputusan_bpd->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#keputusan_bpd">
                            + lihat catatan
                        </button>
                        @elseif($keputusan_bpd && !$keputusan_bpd->catatan)
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#keputusan_bpd">
                            + catatan
                        </button>
                        @endif
                    </td>

                    <!-- Modal -->
                    <div class="modal fade" id="keputusan_bpd" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran {{ $keputusan_bpd->nama_data ?? '' }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaDokren" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="keputusan_bpd">
                                    <input type="hidden" name="dokren" value="rapbdes">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_keputusan_bpd" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan" id="catatan_keputusan_bpd"
                                                        autofocus>
                                                    <trix-editor input="catatan_keputusan_bpd" class="bg-white">
                                                        {!! $keputusan_bpd->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_keputusan_bpd" class="text-dark">Saran :
                                                    </label>
                                                    <input type="hidden" name="saran" id="saran_keputusan_bpd"
                                                        autofocus>
                                                    <trix-editor input="saran_keputusan_bpd" class="bg-white">
                                                        {!! $keputusan_bpd->saran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($keputusan_bpd && $keputusan_bpd->catatan)
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
                    <td>10</td>
                    <td>Hasil Evaluasi Camat atas Raperdes APBDes TA {{ $tahun }}</td>
                    <td class="text-center">
                        @if($evaluasi && $evaluasi->isi_data)
                        <a href="{{ asset('storage/'.$evaluasi->isi_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif
                    </td>
                    <td>
                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($evaluasi && $evaluasi->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#evaluasi">
                            + lihat catatan
                        </button>
                        @elseif($evaluasi && !$evaluasi->catatan)
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#evaluasi">
                            + catatan
                        </button>
                        @endif
                    </td>

                    <!-- Modal -->
                    <div class="modal fade" id="evaluasi" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran {{ $evaluasi->nama_data ?? '' }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaDokren" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="evaluasi">
                                    <input type="hidden" name="dokren" value="rapbdes">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_evaluasi" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan" id="catatan_evaluasi" autofocus>
                                                    <trix-editor input="catatan_evaluasi" class="bg-white">
                                                        {!! $evaluasi->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_evaluasi" class="text-dark">Saran :
                                                    </label>
                                                    <input type="hidden" name="saran" id="saran_evaluasi" autofocus>
                                                    <trix-editor input="saran_evaluasi" class="bg-white">
                                                        {!! $evaluasi->saran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($evaluasi && $evaluasi->catatan)
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
                    <td>11</td>
                    <td>Perdes dan Lampiran/Dokumen APBDes TA {{ $tahun }}</td>
                    <td class="text-center">
                        @if($apbdes_murni)
                        <a href="{{ asset('storage/'.$apbdes_murni) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif
                    </td>
                    <td>
                        Perdes Nomor {{ $nomor_murni ?? '' }}
                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($apbdes && $apbdes->catatan_dokumen)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#apbdes_dokumen">
                            + lihat catatan
                        </button>
                        @elseif($apbdes && !$apbdes->catatan_dokumen)
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#apbdes_dokumen">
                            + catatan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="apbdes_dokumen" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran Atas Dokumen APB Desa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaDokren" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="dokumen">
                                    <input type="hidden" name="dokren" value="apbdes">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_apbdes_dokumen" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan_dokumen"
                                                        id="catatan_apbdes_dokumen" autofocus>
                                                    <trix-editor input="catatan_apbdes_dokumen" class="bg-white">
                                                        {!! $apbdes->catatan_dokumen ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_apbdes_dokumen" class="text-dark">Saran :
                                                    </label>
                                                    <input type="hidden" name="saran_dokumen" id="saran_apbdes_dokumen"
                                                        autofocus>
                                                    <trix-editor input="saran_apbdes_dokumen" class="bg-white">
                                                        {!! $apbdes->saran_dokumen ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($apbdes && $apbdes->catatan_dokumen)
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
                    <td>12</td>
                    <td>Analisa, Gambar dan RAB Pembangunan Fisik (APBDes Murni TA {{ $tahun }})</td>
                    <td class="text-center">
                        @if($desain_murni)
                        <a href="{{ asset('storage/'.$desain_murni) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif
                    </td>
                    <td>
                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($apbdes && $apbdes->catatan_desain)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#apbdes_desain">
                            + lihat catatan
                        </button>
                        @elseif($apbdes && !$apbdes->catatan_desain)
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#apbdes_desain">
                            + catatan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="apbdes_desain" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran Atas Desain, Analisa dan Gambar Teknis</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaDokren" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="desain">
                                    <input type="hidden" name="dokren" value="apbdes">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_apbdes_desain" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan_desain"
                                                        id="catatan_apbdes_desain" autofocus>
                                                    <trix-editor input="catatan_apbdes_desain" class="bg-white">
                                                        {!! $apbdes->catatan_desain ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_apbdes_desain" class="text-dark">Saran :
                                                    </label>
                                                    <input type="hidden" name="saran_desain" id="saran_apbdes_desain"
                                                        autofocus>
                                                    <trix-editor input="saran_apbdes_desain" class="bg-white">
                                                        {!! $apbdes->saran_desain ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($apbdes && $apbdes->catatan_desain)
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
                    <td>13</td>
                    <td>Ketepatan Waktu Penetapan Perdes APBDes TA {{ $tahun }}</td>
                    <td class="text-center">
                        @if($tgl_murni)
                        <p>{{ $tgl_murni }}</p>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif
                    </td>
                    <td>
                        Perdes APBDes TA {{ $tahun }} ditetapkan paling lambat 31 Desember Tahun {{ $tahun-1 }}
                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($apbdes && $apbdes->catatan_tanggal)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#apbdes_tanggal">
                            + lihat catatan
                        </button>
                        @elseif($apbdes && !$apbdes->catatan_tanggal)
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#apbdes_tanggal">
                            + catatan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="apbdes_tanggal" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran Atas Tanggal Penetapan Perdes APB Desa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaDokren" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="tanggal">
                                    <input type="hidden" name="dokren" value="apbdes">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_apbdes_tanggal" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan_tanggal"
                                                        id="catatan_apbdes_tanggal" autofocus>
                                                    <trix-editor input="catatan_apbdes_tanggal" class="bg-white">
                                                        {!! $apbdes->catatan_tanggal ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_apbdes_tanggal" class="text-dark">Saran :
                                                    </label>
                                                    <input type="hidden" name="saran_tanggal" id="saran_apbdes_tanggal"
                                                        autofocus>
                                                    <trix-editor input="saran_apbdes_tanggal" class="bg-white">
                                                        {!! $apbdes->saran_tanggal ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($apbdes && $apbdes->catatan_tanggal)
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
                    <td>14</td>
                    <td>Perkades dan Lampiran/Dokumen Penjabaran (APBDes Murni TA {{ $tahun }})</td>
                    <td class="text-center">
                        @if($penjabaran_murni)
                        <a href="{{ asset('storage/'.$penjabaran_murni) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif
                    </td>
                    <td>
                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($apbdes && $apbdes->catatan_penjabaran)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#apbdes_penjabaran">
                            + lihat catatan
                        </button>
                        @elseif($apbdes && !$apbdes->catatan_penjabaran)
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#apbdes_penjabaran">
                            + catatan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="apbdes_penjabaran" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran Atas Dokumen Penjabaran APB Desa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaDokren" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="penjabaran">
                                    <input type="hidden" name="dokren" value="apbdes">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_apbdes_penjabaran" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan_penjabaran"
                                                        id="catatan_apbdes_penjabaran" autofocus>
                                                    <trix-editor input="catatan_apbdes_penjabaran" class="bg-white">
                                                        {!! $apbdes->catatan_penjabaran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_apbdes_penjabaran" class="text-dark">Saran :
                                                    </label>
                                                    <input type="hidden" name="saran_penjabaran"
                                                        id="saran_apbdes_penjabaran" autofocus>
                                                    <trix-editor input="saran_apbdes_penjabaran" class="bg-white">
                                                        {!! $apbdes->saran_penjabaran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($apbdes && $apbdes->catatan_penjabaran)
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