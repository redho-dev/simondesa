<div class="row ">
    <div class="col-md-8 mt-2">
        <table class="table table-striped table-bordered">
            <thead class="bg-info">
                <tr>
                    <th style="vertical-align: middle" width="5%">No</th>
                    <th style="vertical-align: middle" width="50%">Nama Data</th>
                    <th class="text-center" width="25%">file_data <br> <small>(klik untuk lihat)</small></th>
                    <th class="text-center" width="25%">Aksi</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Peraturan Desa Tentang Struktur Organisasi dan Tatakerja (SOTK) Pemerintah Desa</td>
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
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#sotk">
                            + lihat catatan
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#sotk">
                            + catatan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="sotk" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaKel" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="sotk">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_sotk" class="text-dark">Catatan : </label>
                                                    <input type="hidden" name="catatan" id="catatan_sotk" autofocus>
                                                    <trix-editor input="catatan_sotk" class="bg-white">
                                                        {!! $data[0]->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_sotk" class="text-dark">Saran : </label>
                                                    <input type="hidden" name="saran" id="saran_sotk" autofocus>
                                                    <trix-editor input="saran_sotk" class="bg-white">
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
                    <td>SK Lembaga Pemberdayaan Masyarakat (LPM)</td>
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
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#sklpm">
                            + lihat catatan
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#sklpm">
                            + catatan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="sklpm" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaKel" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="sklpm">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_sklpm" class="text-dark">Catatan : </label>
                                                    <input type="hidden" name="catatan" id="catatan_sklpm" autofocus>
                                                    <trix-editor input="catatan_sklpm" class="bg-white">
                                                        {!! $data[1]->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_sklpm" class="text-dark">Saran : </label>
                                                    <input type="hidden" name="saran" id="saran_sklpm" autofocus>
                                                    <trix-editor input="saran_sklpm" class="bg-white">
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
                    <td>SK Karang Taruna</td>
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
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#sktaruna">
                            + lihat catatan
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#sktaruna">
                            + catatan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="sktaruna" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaKel" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="sktaruna">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_sktaruna" class="text-dark">Catatan : </label>
                                                    <input type="hidden" name="catatan" id="catatan_sktaruna" autofocus>
                                                    <trix-editor input="catatan_sktaruna" class="bg-white">
                                                        {!! $data[2]->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_sktaruna" class="text-dark">Saran : </label>
                                                    <input type="hidden" name="saran" id="saran_sktaruna" autofocus>
                                                    <trix-editor input="saran_sktaruna" class="bg-white">
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
                    <td>SK Perlindungan Masyarakat (Linmas)</td>
                    <td class="text-center">
                        @if($data[3]->file_data)
                        <a href="{{ asset('storage/'.$data[3]->file_data) }}" target="_blank"><img
                                src="{{ asset('/img/logo-pdf.jpg') }}" width="50px"></a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif

                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($data[3]->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#sklinmas">
                            + lihat catatan
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#sklinmas">
                            + catatan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="sklinmas" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaKel" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="sklinmas">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_sklinmas" class="text-dark">Catatan : </label>
                                                    <input type="hidden" name="catatan" id="catatan_sklinmas" autofocus>
                                                    <trix-editor input="catatan_sklinmas" class="bg-white">
                                                        {!! $data[3]->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_sklinmas" class="text-dark">Saran : </label>
                                                    <input type="hidden" name="saran" id="saran_sklinmas" autofocus>
                                                    <trix-editor input="saran_sklinmas" class="bg-white">
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
                    <td>SK Kepengurusan PKK</td>
                    <td class="text-center">
                        @if($data[4]->file_data)
                        <a href="{{ asset('storage/'.$data[4]->file_data) }}" target="_blank"><img
                                src="{{ asset('/img/logo-pdf.jpg') }}" width="50px"></a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif

                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($data[4]->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#skpkk">
                            + lihat catatan
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#skpkk">
                            + catatan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="skpkk" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaKel" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="skpkk">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_skpkk" class="text-dark">Catatan : </label>
                                                    <input type="hidden" name="catatan" id="catatan_skpkk" autofocus>
                                                    <trix-editor input="catatan_skpkk" class="bg-white">
                                                        {!! $data[4]->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_skpkk" class="text-dark">Saran : </label>
                                                    <input type="hidden" name="saran" id="saran_skpkk" autofocus>
                                                    <trix-editor input="saran_skpkk" class="bg-white">
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
                <tr>
                    <td>6</td>
                    <td>Foto Kantor Desa</td>
                    <td class="text-center">
                        @if($data[5]->file_data)
                        <a href="{{ asset('storage/'.$data[5]->file_data) }}" target="_blank"><img
                                src="{{ asset('storage/'.$data[5]->file_data) }}" alt="" width="50px"></a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif

                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($data[5]->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#kantor_desa">
                            + lihat catatan
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#kantor_desa">
                            + catatan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="kantor_desa" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaKel" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="kantor_desa">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_kantor_desa" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan" id="catatan_kantor_desa"
                                                        autofocus>
                                                    <trix-editor input="catatan_kantor_desa" class="bg-white">
                                                        {!! $data[5]->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_kantor_desa" class="text-dark">Saran : </label>
                                                    <input type="hidden" name="saran" id="saran_kantor_desa" autofocus>
                                                    <trix-editor input="saran_kantor_desa" class="bg-white">
                                                        {!! $data[5]->saran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($data[5]->catatan)
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
                    <td>Papan Struktur Pemerintah Desa</td>
                    <td class="text-center">
                        @if($data[6]->file_data)
                        <a href="{{ asset('storage/'.$data[6]->file_data) }}" target="_blank"><img
                                src="{{ asset('storage/'.$data[6]->file_data) }}" alt="" width="50px"></a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif

                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($data[6]->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#papan_struktur">
                            + lihat catatan
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#papan_struktur">
                            + catatan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="papan_struktur" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaKel" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="papan_struktur">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_papan_struktur" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan" id="catatan_papan_struktur"
                                                        autofocus>
                                                    <trix-editor input="catatan_papan_struktur" class="bg-white">
                                                        {!! $data[6]->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_papan_struktur" class="text-dark">Saran : </label>
                                                    <input type="hidden" name="saran" id="saran_papan_struktur"
                                                        autofocus>
                                                    <trix-editor input="saran_papan_struktur" class="bg-white">
                                                        {!! $data[6]->saran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($data[6]->catatan)
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
                    <td>Foto Kantor/Sekretariat BPD</td>
                    <td class="text-center">
                        @if($data[7]->file_data)
                        <a href="{{ asset('storage/'.$data[7]->file_data) }}" target="_blank"><img
                                src="{{ asset('storage/'.$data[7]->file_data) }}" alt="" width="50px"></a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif

                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($data[7]->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#kantor_bpd">
                            + lihat catatan
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#kantor_bpd">
                            + catatan
                        </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="kantor_bpd" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaKel" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="kantor_bpd">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_kantor_bpd" class="text-dark">Catatan : </label>
                                                    <input type="hidden" name="catatan" id="catatan_kantor_bpd"
                                                        autofocus>
                                                    <trix-editor input="catatan_kantor_bpd" class="bg-white">
                                                        {!! $data[7]->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_kantor_bpd" class="text-dark">Saran : </label>
                                                    <input type="hidden" name="saran" id="saran_kantor_bpd" autofocus>
                                                    <trix-editor input="saran_kantor_bpd" class="bg-white">
                                                        {!! $data[7]->saran ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        @if($data[7]->catatan)
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