<div class="row ">
    <div class="col-md-8 mt-2">
        <table class="table table-striped table-bordered">
            <thead class="bg-info">
                <tr>
                    <th style="vertical-align: middle" width="5%">No</th>
                    <th style="vertical-align: middle" width="50%">Nama Data</th>
                    <th class="text-center" width="25%">file_data <br> <small>(klik untuk lihat)</small></th>
                    <th class="text-center" width="20%">Catatan</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Buku Surat Masuk/Keluar</td>
                    <td class="text-center">
                        @if($data[0]->file_data)
                        <a href="{{ asset('storage/'.$data[0]->file_data) }}" target="_blank"><img
                                src="{{ asset('/img/logo-pdf.jpg') }}" alt="" width="50px"></a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif

                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($data[0]->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#surat">
                            + lihat catatan
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#surat">
                            + catatan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="surat" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran Atas Agenda Surat Masuk/Keluar</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaAdum" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="surat">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_surat" class="text-dark">Catatan : </label>
                                                    <input type="hidden" name="catatan" id="catatan_surat" autofocus>
                                                    <trix-editor input="catatan_surat" class="bg-white">
                                                        {!! $data[0]->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_surat" class="text-dark">Saran : </label>
                                                    <input type="hidden" name="saran" id="saran_surat" autofocus>
                                                    <trix-editor input="saran_surat" class="bg-white">
                                                        {!! $data[0]->saran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($data[0]->catatan)
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
                    <td>Rekap Bulanan Daftar Hadir Perangkat Semester 1</td>
                    <td class="text-center">
                        @if($data[1]->file_data)
                        <a href="{{ asset('storage/'.$data[1]->file_data) }}" target="_blank"><img
                                src="{{ asset('/img/logo-pdf.jpg') }}" width="50px"></a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif

                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($data[1]->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#daftar_hadir">
                            + lihat catatan
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#daftar_hadir">
                            + catatan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="daftar_hadir" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran Atas Daftar Hadir Perangkat Semester 1</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaAdum" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="daftar_hadir">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_daftar_hadir" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan" id="catatan_daftar_hadir"
                                                        autofocus>
                                                    <trix-editor input="catatan_daftar_hadir" class="bg-white">
                                                        {!! $data[1]->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_daftar_hadir" class="text-dark">Saran : </label>
                                                    <input type="hidden" name="saran" id="saran_daftar_hadir" autofocus>
                                                    <trix-editor input="saran_daftar_hadir" class="bg-white">
                                                        {!! $data[1]->saran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($data[1]->catatan)
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
                    <td>Rekap Bulanan Daftar Hadir Perangkat Semester 2</td>
                    <td class="text-center">
                        @if($data[2]->file_data)
                        <a href="{{ asset('storage/'.$data[2]->file_data) }}" target="_blank"><img
                                src="{{ asset('/img/logo-pdf.jpg') }}" width="50px"></a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif

                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($data[2]->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#daftar_hadir2">
                            + lihat catatan
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#daftar_hadir2">
                            + catatan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="daftar_hadir2" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran Atas Daftar Hadir Perangkat Semester 2</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaAdum" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="daftar_hadir2">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_daftar_hadir2" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan" id="catatan_daftar_hadir2"
                                                        autofocus>
                                                    <trix-editor input="catatan_daftar_hadir2" class="bg-white">
                                                        {!! $data[2]->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_daftar_hadir2" class="text-dark">Saran : </label>
                                                    <input type="hidden" name="saran" id="saran_daftar_hadir2"
                                                        autofocus>
                                                    <trix-editor input="saran_daftar_hadir2" class="bg-white">
                                                        {!! $data[2]->saran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($data[2]->catatan)
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
                    <td>Buku Register Perdes/Perkades/SK</td>
                    <td class="text-center">
                        @if($data[3]->file_data)
                        <a href="{{ asset('storage/'.$data[3]->file_data) }}" target="_blank"><img
                                src="{{ asset('/img/logo-pdf.jpg') }}" width="50px"></a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif

                    </td>
                    <td class="text-center">
                        @if($data[3]->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#buku_register">
                            + lihat catatan
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#buku_register">
                            + catatan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="buku_register" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran Atas Buku Register Perdes, Perkades dan SK</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaAdum" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="buku_register">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_buku_register" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan" id="catatan_buku_register"
                                                        autofocus>
                                                    <trix-editor input="catatan_buku_register" class="bg-white">
                                                        {!! $data[3]->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_buku_register" class="text-dark">Saran : </label>
                                                    <input type="hidden" name="saran" id="saran_buku_register"
                                                        autofocus>
                                                    <trix-editor input="saran_buku_register" class="bg-white">
                                                        {!! $data[3]->saran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($data[3]->catatan)
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
                    <td>Buku Rekap Kependudukan</td>
                    <td class="text-center">
                        @if($data[4]->file_data)
                        <a href="{{ asset('storage/'.$data[4]->file_data) }}" target="_blank"><img
                                src="{{ asset('/img/logo-pdf.jpg') }}" width="50px"></a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($data[4]->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#rekap_penduduk">
                            + lihat catatan
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#rekap_penduduk">
                            + catatan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="rekap_penduduk" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran Atas Buku Register Perdes, Perkades dan SK</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaAdum" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="rekap_penduduk">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_rekap_penduduk" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan" id="catatan_rekap_penduduk"
                                                        autofocus>
                                                    <trix-editor input="catatan_rekap_penduduk" class="bg-white">
                                                        {!! $data[4]->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_rekap_penduduk" class="text-dark">Saran : </label>
                                                    <input type="hidden" name="saran" id="saran_rekap_penduduk"
                                                        autofocus>
                                                    <trix-editor input="saran_rekap_penduduk" class="bg-white">
                                                        {!! $data[4]->saran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($data[4]->catatan)
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