<div class="row akunwil">
    <div class="col-md-9">
        <p class="alert alert-success" style="font-size: 1rem">Form Input Data Pelaporan
        </p>
        <style>
            label {
                overflow: hidden;
            }
        </style>
        <table class="table table-bordered">
            <thead style="background-color: beige">
                <tr>
                    <th>#</th>
                    <th>Nama Data</th>
                    <th class="text-center">Dokumen</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>1</th>
                    <th>Laporan Penyelenggaraan Pemerintahan Desa (LPPD) Tahun {{ $tahun-1 }}</th>
                    <th class="text-center">
                        @if($lppd)
                        <a href="{{ asset('storage/'.$lppd->file_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @endif
                    </th>
                    <th class="text-center">
                        @if($lppd)
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#lppd_edit">
                            Update
                        </button>
                        <a href="/adminDesa/hapusLaporan/{{ $lppd->id }}" class="btn btn-danger btn-sm">Hapus</a>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#lppd">
                            Upload
                        </button>
                        @endif

                    </th>
                    <!-- Modal -->
                    <div class="modal fade" id="lppd" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Upload LPPD
                                        Tahun {{ $tahun-1 }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/laporanTambah" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="lppd">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="lppd" class="custom-file-input file_laporan"
                                                id="customFile" required>
                                            <label class="custom-file-label labfile" for="customFile">Choose file
                                                PDF Max (5
                                                MB)</label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">KIRIM</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if($lppd)
                    <!-- Modal Edit-->
                    <div class="modal fade" id="lppd_edit" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Update LPPD
                                        Tahun {{ $tahun-1 }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/laporanEdit" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="lppd">
                                    <input type="hidden" name="old" value="{{ $lppd->file_data }}">
                                    <input type="hidden" name="id" value="{{ $lppd->id }}">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="lppd" class="custom-file-input file_laporan"
                                                id="customFile" required>
                                            <label class="custom-file-label labfile" for="customFile">Choose file
                                                PDF Max (5
                                                MB)</label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">UPDATE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </tr>
                {{-- <tr>
                    <th>2</th>
                    <th>Surat Penyampaian LPPD Tahun {{ $tahun-1 }} Kepada Camat</th>
                    <th class="text-center">
                        @if($surat_lppd)
                        <a href="{{ asset('storage/'.$surat_lppd->file_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @endif
                    </th>
                    <th class="text-center">
                        @if($surat_lppd)
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#suratlppd_edit">
                            Update
                        </button>
                        <a href="/adminDesa/hapusLaporan/{{ $surat_lppd->id }}" class="btn btn-danger btn-sm">Hapus</a>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#suratlppd">
                            Upload
                        </button>
                        @endif

                    </th>
                    <!-- Modal -->
                    <div class="modal fade" id="suratlppd" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Upload Surat
                                        Penyampaian LPPD
                                        Tahun {{ $tahun-1 }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/laporanTambah" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="surat_lppd">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="surat_lppd" class="custom-file-input file_laporan"
                                                id="customFile" required>
                                            <label class="custom-file-label labfile" maks="1" for="customFile">Choose
                                                file
                                                PDF Max (1
                                                MB)</label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">KIRIM</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if($surat_lppd)
                    <!-- Modal Edit-->
                    <div class="modal fade" id="suratlppd_edit" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Update Surat
                                        Penyampaian LPPD
                                        Tahun {{ $tahun-1 }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/laporanEdit" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="surat_lppd">
                                    <input type="hidden" name="old" value="{{ $surat_lppd->file_data }}">
                                    <input type="hidden" name="id" value="{{ $surat_lppd->id }}">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="surat_lppd" class="custom-file-input file_laporan"
                                                id="customFile" required>
                                            <label class="custom-file-label labfile" maks="1" for="customFile">Choose
                                                file
                                                PDF Max (1
                                                MB)</label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">UPDATE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </tr> --}}
                <tr>
                    <th>2</th>
                    <th>Laporan Keterangan Penyelenggaraan Pemerintahan Desa (LKPD) Tahun {{ $tahun-1 }}</th>
                    <th class="text-center">
                        @if($lkpd)
                        <a href="{{ asset('storage/'.$lkpd->file_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @endif
                    </th>
                    <th class="text-center">
                        @if($lkpd)
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#lkpd_edit">
                            Update
                        </button>
                        <a href="/adminDesa/hapusLaporan/{{ $lkpd->id }}" class="btn btn-danger btn-sm">Hapus</a>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#lkpd">
                            Upload
                        </button>
                        @endif

                    </th>
                    <!-- Modal -->
                    <div class="modal fade" id="lkpd" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Upload LKPD
                                        Tahun {{ $tahun-1 }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/laporanTambah" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="lkpd">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="lkpd" class="custom-file-input file_laporan"
                                                id="customFile" required>
                                            <label class="custom-file-label labfile" maks="5" for="customFile">Choose
                                                file
                                                PDF Max (5 MB)</label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">KIRIM</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if($lkpd)
                    <!-- Modal Edit-->
                    <div class="modal fade" id="lkpd_edit" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Update LKPD
                                        Tahun {{ $tahun-1 }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/laporanEdit" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="lkpd">
                                    <input type="hidden" name="old" value="{{ $lkpd->file_data }}">
                                    <input type="hidden" name="id" value="{{ $lkpd->id }}">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="lkpd" class="custom-file-input file_laporan"
                                                id="customFile" required>
                                            <label class="custom-file-label labfile" maks="5" for="customFile">Choose
                                                file
                                                PDF Max (5 MB)</label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">UPDATE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </tr>
                {{-- <tr>
                    <th>4</th>
                    <th>Surat Penyampaian LKPD Tahun {{ $tahun-1 }} Kepada BPD</th>
                    <th class="text-center">
                        @if($surat_lkpd)
                        <a href="{{ asset('storage/'.$surat_lkpd->file_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @endif
                    </th>
                    <th class="text-center">
                        @if($surat_lkpd)
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#surat_lkpd_edit">
                            Update
                        </button>
                        <a href="/adminDesa/hapusLaporan/{{ $surat_lkpd->id }}" class="btn btn-danger btn-sm">Hapus</a>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#surat_lkpd">
                            Upload
                        </button>
                        @endif

                    </th>
                    <!-- Modal -->
                    <div class="modal fade" id="surat_lkpd" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Upload Surat
                                        Penyampaian LKPD
                                        Tahun {{ $tahun-1 }} Kepada BPD</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/laporanTambah" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="surat_lkpd">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="surat_lkpd" class="custom-file-input file_laporan"
                                                id="customFile" required>
                                            <label class="custom-file-label labfile" maks="1" for="customFile">Choose
                                                file
                                                PDF Max (1 MB)</label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">KIRIM</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if($surat_lkpd)
                    <!-- Modal Edit-->
                    <div class="modal fade" id="surat_lkpd_edit" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Update Surat
                                        Penyampaian LKPD
                                        Tahun {{ $tahun-1 }} Kepada BPD</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/laporanEdit" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="surat_lkpd">
                                    <input type="hidden" name="old" value="{{ $surat_lkpd->file_data }}">
                                    <input type="hidden" name="id" value="{{ $surat_lkpd->id }}">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="surat_lkpd" class="custom-file-input file_laporan"
                                                id="customFile" required>
                                            <label class="custom-file-label labfile" maks="1" for="customFile">Choose
                                                file
                                                PDF Max (1 MB)</label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">UPDATE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </tr> --}}
                <tr>
                    <th>3</th>
                    <th>Peraturan Desa tentang Pertanggungjawaban APB Desa Tahun Anggaran {{ $tahun-1 }}</th>
                    <th class="text-center">
                        @if($perdes_pj)
                        <a href="{{ asset('storage/'.$perdes_pj->file_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @endif
                    </th>
                    <th class="text-center">
                        @if($perdes_pj)
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#perdes_pj_edit">
                            Update
                        </button>
                        <a href="/adminDesa/hapusLaporan/{{ $perdes_pj->id }}" class="btn btn-danger btn-sm">Hapus</a>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#perdes_pj">
                            Upload
                        </button>
                        @endif

                    </th>
                    <!-- Modal -->
                    <div class="modal fade" id="perdes_pj" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Upload Perdes
                                        Pertanggungjawaban APB Desa TA {{ $tahun-1 }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/laporanTambah" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="perdes_pj">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="perdes_pj" class="custom-file-input file_laporan"
                                                id="customFile" required>
                                            <label class="custom-file-label labfile" maks="5" for="customFile">Choose
                                                file
                                                PDF Max (5 MB)</label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">KIRIM</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if($perdes_pj)
                    <!-- Modal Edit-->
                    <div class="modal fade" id="perdes_pj_edit" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Update Perdes
                                        Pertanggungjawaban APB Desa TA {{ $tahun-1 }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/laporanEdit" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="perdes_pj">
                                    <input type="hidden" name="old" value="{{ $perdes_pj->file_data }}">
                                    <input type="hidden" name="id" value="{{ $perdes_pj->id }}">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="perdes_pj" class="custom-file-input file_laporan"
                                                id="customFile" required>
                                            <label class="custom-file-label labfile" maks="5" for="customFile">Choose
                                                file
                                                PDF Max (5 MB)</label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">UPDATE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </tr>
                <tr>
                    <th>4</th>
                    <th>Laporan Realisasi APB Desa Tahun Anggaran {{ $tahun }} Semester 1 </th>
                    <th class="text-center">
                        @if($lra_1)
                        <a href="{{ asset('storage/'.$lra_1->file_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @endif
                    </th>
                    <th class="text-center">
                        @if($lra_1)
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#lra_1_edit">
                            Update
                        </button>
                        <a href="/adminDesa/hapusLaporan/{{ $lra_1->id }}" class="btn btn-danger btn-sm">Hapus</a>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#lra_1">
                            Upload
                        </button>
                        @endif

                    </th>
                    <!-- Modal -->
                    <div class="modal fade" id="lra_1" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Upload LRA Tahun
                                        Anggaran {{ $tahun }} Semester 1</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/laporanTambah" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="lra_1">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="lra_1" class="custom-file-input file_laporan"
                                                id="customFile" required>
                                            <label class="custom-file-label labfile" maks="5" for="customFile">Choose
                                                file
                                                PDF Max (5 MB)</label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">KIRIM</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if($lra_1)
                    <!-- Modal Edit-->
                    <div class="modal fade" id="lra_1_edit" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Update LRA Tahun
                                        Anggaran {{ $tahun }} Semester 1</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/laporanEdit" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="lra_1">
                                    <input type="hidden" name="old" value="{{ $lra_1->file_data }}">
                                    <input type="hidden" name="id" value="{{ $lra_1->id }}">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="lra_1" class="custom-file-input file_laporan"
                                                id="customFile" required>
                                            <label class="custom-file-label labfile" maks="5" for="customFile">Choose
                                                file
                                                PDF Max (5 MB)</label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">UPDATE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </tr>
                <tr>
                    <th>5</th>
                    <th>Laporan Realisasi APB Desa Tahun Anggaran {{ $tahun }} (Akhir Tahun)</th>
                    <th class="text-center">
                        @if($lra_2)
                        <a href="{{ asset('storage/'.$lra_2->file_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @endif
                    </th>
                    <th class="text-center">
                        @if($lra_2)
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#lra_2_edit">
                            Update
                        </button>
                        <a href="/adminDesa/hapusLaporan/{{ $lra_2->id }}" class="btn btn-danger btn-sm">Hapus</a>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#lra_2">
                            Upload
                        </button>
                        @endif

                    </th>
                    <!-- Modal -->
                    <div class="modal fade" id="lra_2" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Upload LRA Tahun
                                        Anggaran {{ $tahun }} Akhir Tahun</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/laporanTambah" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="lra_2">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="lra_2" class="custom-file-input file_laporan"
                                                id="customFile" required>
                                            <label class="custom-file-label labfile" maks="5" for="customFile">Choose
                                                file
                                                PDF Max (5 MB)</label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">KIRIM</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if($lra_2)
                    <!-- Modal Edit-->
                    <div class="modal fade" id="lra_2_edit" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Update LRA Tahun
                                        Anggaran {{ $tahun }} Akhir Tahun</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/laporanEdit" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="lra_2">
                                    <input type="hidden" name="old" value="{{ $lra_2->file_data }}">
                                    <input type="hidden" name="id" value="{{ $lra_2->id }}">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="lra_2" class="custom-file-input file_laporan"
                                                id="customFile" required>
                                            <label class="custom-file-label labfile" maks="5" for="customFile">Choose
                                                file
                                                PDF Max (5 MB)</label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">UPDATE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </tr>
                <tr>
                    <th>6</th>
                    <th>LPPD Akhir Masa Jabatan <br>(Khusus Kepala Desa yang berakhir masa jabatan pada tahun {{ $tahun
                        }})</th>
                    <th class="text-center">
                        @if($amj)
                        <a href="{{ asset('storage/'.$amj->file_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @endif
                    </th>
                    <th class="text-center">
                        @if($amj)
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#amj_edit">
                            Update
                        </button>
                        <a href="/adminDesa/hapusLaporan/{{ $amj->id }}" class="btn btn-danger btn-sm">Hapus</a>
                        @else
                        <button type="button" class="btn btn-primary btn-sm btn-sm" data-toggle="modal"
                            data-target="#amj">
                            Upload
                        </button>
                        @endif

                    </th>
                    <!-- Modal -->
                    <div class="modal fade" id="amj" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Upload LPPD Akhir
                                        Masa Jabatan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/laporanTambah" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="amj">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="amj" class="custom-file-input file_laporan"
                                                id="customFile" required>
                                            <label class="custom-file-label labfile" maks="5" for="customFile">Choose
                                                file
                                                PDF Max (5 MB)</label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">KIRIM</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if($amj)
                    <!-- Modal Edit-->
                    <div class="modal fade" id="amj_edit" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Update LPPD Akhir
                                        Masa Jabatan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/laporanEdit" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="amj">
                                    <input type="hidden" name="old" value="{{ $amj->file_data }}">
                                    <input type="hidden" name="id" value="{{ $amj->id }}">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="amj" class="custom-file-input file_laporan"
                                                id="customFile" required>
                                            <label class="custom-file-label labfile" maks="5" for="customFile">Choose
                                                file
                                                PDF Max (5 MB)</label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">UPDATE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </tr>


            </tbody>
        </table>
        <p class="alert alert-light text-primary">Catatan : <br>
            - Silahkan Upload Dokumen Laporan yang ada terlebih dahulu, dokumen lain dapat
            disusulkan kemudian melalui form update<br>
            - Seluruh Dokumen Laporan (Kecuali LKPD) Wajib Menyertakan Surat Penyampaian kepada Bupati Melalui Camat
            <br>
            - Dokumen LKPD Wajib Menyertakan Surat Penyampaian Kepada BPD
        </p>