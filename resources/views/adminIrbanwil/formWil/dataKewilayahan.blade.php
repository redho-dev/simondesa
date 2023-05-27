<div class="row ">
    <div class="col-md-9 mt-2">
        <table class="table table-striped table-bordered">
            <thead class="bg-info">
                <tr>
                    <th style="vertical-align: middle" width="5%">No</th>
                    <th style="vertical-align: middle" width="25%">Nama Data</th>
                    <th class="text-center" width="20%">file_data <br> <small>(klik untuk lihat)</small></th>
                    <th class="text-center" style="vertical-align: middle" width="35%">Keterangan</th>
                    <th class="text-center" style="vertical-align: middle" width="15%">Catatan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Dokumen Dasar Hukum Pembentukan Desa</td>
                    <td class="text-center">
                        @if($data[0]->file_data)
                        <a href="{{ asset('storage/'.$data[0]->file_data) }}" target="_blank"><img
                                src="{{ asset('/img/logo-pdf.jpg') }}" alt="" width="50px"></a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif

                    </td>
                    <td>
                        <p>{{ $dawil[0]->isidata }}</p>
                    </td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($data[0]->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#dasar_hukum">
                            + lihat catatan
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#dasar_hukum">
                            + catatan
                        </button>
                        @endif

                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="dasar_hukum" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran ( {{ $data[0]->nama_data }} )</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaWil" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="dasar_hukum">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_dasar_hukum" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan" id="catatan_dasar_hukum"
                                                        autofocus>
                                                    <trix-editor input="catatan_dasar_hukum" class="bg-white">
                                                        {!! $data[0]->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_dasar_hukum" class="text-dark">Saran : </label>
                                                    <input type="hidden" name="saran" id="saran_dasar_hukum" autofocus>
                                                    <trix-editor input="saran_dasar_hukum" class="bg-white">
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
                    <td>Pilar Batas Utara Desa</td>
                    <td class="text-center">
                        @if($data[1]->file_data)
                        <a href="{{ asset('storage/'.$data[1]->file_data) }}" target="_blank"><img
                                src="{{ asset('storage/'.$data[1]->file_data) }}" alt="" width="50px"></a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif

                    </td>
                    <td>{{ $dawil[1]->isidata }}</td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($data[1]->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#patok_batas_utara">
                            + lihat catatan
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#patok_batas_utara">
                            + catatan
                        </button>
                        @endif

                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="patok_batas_utara" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran ( {{ $data[1]->nama_data }} )</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaWil" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="patok_batas_utara">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_patok_batas_utara" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan" id="catatan_patok_batas_utara"
                                                        autofocus>
                                                    <trix-editor input="catatan_patok_batas_utara" class="bg-white">
                                                        {!! $data[1]->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_patok_batas_utara" class="text-dark">Saran :
                                                    </label>
                                                    <input type="hidden" name="saran" id="saran_patok_batas_utara"
                                                        autofocus>
                                                    <trix-editor input="saran_patok_batas_utara" class="bg-white">
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
                    <td>Pilar Batas Selatan Desa</td>
                    <td class="text-center">
                        @if($data[2]->file_data)
                        <a href="{{ asset('storage/'.$data[2]->file_data) }}" target="_blank"><img
                                src="{{ asset('storage/'.$data[2]->file_data) }}" alt="" width="50px"></a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif

                    </td>
                    <td>{{ $dawil[2]->isidata }}</td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($data[2]->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#patok_batas_selatan">
                            + lihat catatan
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#patok_batas_selatan">
                            + catatan
                        </button>
                        @endif

                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="patok_batas_selatan" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran ( {{ $data[2]->nama_data }} )</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaWil" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="patok_batas_selatan">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_patok_batas_selatan" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan" id="catatan_patok_batas_selatan"
                                                        autofocus>
                                                    <trix-editor input="catatan_patok_batas_selatan" class="bg-white">
                                                        {!! $data[2]->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_patok_batas_selatan" class="text-dark">Saran :
                                                    </label>
                                                    <input type="hidden" name="saran" id="saran_patok_batas_selatan"
                                                        autofocus>
                                                    <trix-editor input="saran_patok_batas_selatan" class="bg-white">
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
                    <td>Pilar Batas Barat Desa</td>
                    <td class="text-center">
                        @if($data[3]->file_data)
                        <a href="{{ asset('storage/'.$data[3]->file_data) }}" target="_blank"><img
                                src="{{ asset('storage/'.$data[3]->file_data) }}" alt="" width="50px"></a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif

                    </td>
                    <td>{{ $dawil[3]->isidata }}</td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($data[3]->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#patok_batas_barat">
                            + lihat catatan
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#patok_batas_barat">
                            + catatan
                        </button>
                        @endif

                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="patok_batas_barat" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran ( {{ $data[3]->nama_data }} )</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaWil" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="patok_batas_barat">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_patok_batas_barat" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan" id="catatan_patok_batas_barat"
                                                        autofocus>
                                                    <trix-editor input="catatan_patok_batas_barat" class="bg-white">
                                                        {!! $data[3]->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_patok_batas_barat" class="text-dark">Saran :
                                                    </label>
                                                    <input type="hidden" name="saran" id="saran_patok_batas_barat"
                                                        autofocus>
                                                    <trix-editor input="saran_patok_batas_barat" class="bg-white">
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
                    <td>Pilar Batas Timur Desa</td>
                    <td class="text-center">
                        @if($data[4]->file_data)
                        <a href="{{ asset('storage/'.$data[4]->file_data) }}" target="_blank"><img
                                src="{{ asset('storage/'.$data[4]->file_data) }}" alt="" width="50px"></a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif

                    </td>
                    <td>{{ $dawil[4]->isidata }}</td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($data[4]->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                            data-target="#patok_batas_timur">
                            + lihat catatan
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#patok_batas_timur">
                            + catatan
                        </button>
                        @endif

                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="patok_batas_timur" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran ( {{ $data[4]->nama_data }} )</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaWil" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="patok_batas_timur">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_patok_batas_timur" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan" id="catatan_patok_batas_timur"
                                                        autofocus>
                                                    <trix-editor input="catatan_patok_batas_timur" class="bg-white">
                                                        {!! $data[4]->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_patok_batas_timur" class="text-dark">Saran :
                                                    </label>
                                                    <input type="hidden" name="saran" id="saran_patok_batas_timur"
                                                        autofocus>
                                                    <trix-editor input="saran_patok_batas_timur" class="bg-white">
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
                    <td>Peta Batas Desa</td>
                    <td class="text-center">
                        @if($data[5]->file_data)
                        <a href="{{ asset('storage/'.$data[5]->file_data) }}" target="_blank"><img
                                src="{{ asset('storage/'.$data[5]->file_data) }}" alt="" width="50px"></a>
                        @else
                        <p class="text-danger">data kosong</p>
                        @endif

                    </td>
                    <td>{{ $dawil[5]->isidata }}</td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        @if($data[5]->catatan)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#peta_batas">
                            + lihat catatan
                        </button>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#peta_batas">
                            + catatan
                        </button>
                        @endif

                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="peta_batas" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Catatan dan
                                        Saran ( {{ $data[5]->nama_data }} )</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tamcaWil" method="post">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="peta_batas">


                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="catatan_peta_batas" class="text-dark">Catatan :
                                                    </label>
                                                    <input type="hidden" name="catatan" id="catatan_peta_batas"
                                                        autofocus>
                                                    <trix-editor input="catatan_peta_batas" class="bg-white">
                                                        {!! $data[5]->catatan ?? '' !!}
                                                    </trix-editor>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group bg-secondary p-2">
                                                    <label for="saran_peta_batas" class="text-dark">Saran :
                                                    </label>
                                                    <input type="hidden" name="saran" id="saran_peta_batas" autofocus>
                                                    <trix-editor input="saran_peta_batas" class="bg-white">
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
            </tbody>
        </table>

    </div>
</div>
<div class="row">
    <div class="col-md-9 mt-2" style="heigth : 100%; overflow: hidden">
        <p class="alert bg-success text-dark" style="font-size: 1rem">Petunjuk Pengujian</p>
        <div class="card pl-3" style="height: 100vh; overflow: scroll">
            <p class="mb-0">Regulasi Terkait : </p>
            <ol>
                <li>
                    <a href="{{ asset('storage/regulasi/Permendagri-Nomor-45-Tahun-2016-batas_desa.pdf') }}"
                        target="_blank" class="text-primary">Permendagri Nomor 45
                        Tahun 2016 tentang Pedoman Penetapan dan Penegasan Batas Desa</a>
                </li>
                <li>
                    <a href="{{ asset('storage/regulasi/perka_BIG_3_2016.pdf') }}" target="_blank"
                        class="text-primary">Perka
                        BIG Nomor 3 tahun 2016 tentang Spesifikasi Teknis Penyajian Peta Desa</a>
                </li>
                <li>
                    <a href="{{ asset('storage/regulasi/Peraturan BIG Nomor 15 Tahun 2019.pdf') }}" target="_blank"
                        class="text-primary">Peraturan BIG Nomor 15 tahun 2019 tentang Metode
                        Kartometrik pada
                        Penetapan dan Penegasan
                        Batas Desa/Kelurahan</a>
                </li>
            </ol>

            <p class="mb-0">Langkah Pengujian : </p>
            <p class="mt-0 mb-0"> 1. Dokumen Dasar Hukum Pembentukan Desa</p>
            <p class="ml-3 mb-0" ">Cek Apakah benar dokumen yang diupload merupakan produk hukum
                yang menjadi dasar atau
                asal
                susul pembentukan desa, lakukan konfirmasi ke Dinas PMD, Bagian Tapem serta Kecamatan </p>
            <p class=" mt-0 mb-0"> 2. Pilar Batas Desa</p>
            <p class="ml-4 mb-0">a. Pilar Batas antar desa antar kecamatan</p>
            <p class="ml-4 mb-0 ">&emsp; - dapat menggunakan pilar batas antar kecamatan dengan standarisasi seuai <br>
                &emsp; &emsp;permendagri tentang penegasan batas daerah</p>
            <p class="ml-4 mb-0">b. Pilar Batas antar desa dalam satu kecamatan</p>
            <p class="ml-4 mb-0">&emsp;standirasi pilar sbb : </p>
            <img src="{{ asset('storage/referensi/standar-patok-desa.JPG') }}" alt="">
            <p class="ml-4 mb-2">&emsp;contoh pilar sbb : </p>
            <div class="row">
                <div class="col-6 text-center">
                    <img src="{{ asset('storage/referensi/patok1.JPG') }}" width="100%" height="250px">
                </div>
                <div class="col-6">
                    <img src="{{ asset('storage/referensi/patok2.png') }}" width="100%" height="250px">
                </div>
            </div>
            <p class="mt-4">3. Peta Batas Desa</p>
            <p>Peta Batas Desa adalah Peta hasil proses penegasan batas desa.
                peta ini menggunakan ketentuan dan spesifikasi peta kerja,
                ditambahi informasi daftar titik kartometrik dan informasi pilar
                batas yang sudah terpasang di lapangan</p>
            <p>peta batas desa dapat disajikan dalam bentuk peta administrasi wilayah desa atau peta tematik lainnya,
                dengan standarisasi sebagaimana diatur dalam Perka BIG Nomor 3 Tahun 2016 dan Perka BIG Nomor 15 Tahun
                2019, dimana ketentuan utamnya yaitu :</p>
            a. Penyajian peta dalam garis koordinat </br>
            b. Menampilkan Nama Desa, Kecamatan dan Kabupaten </br>
            d. Menampilkan garis batas, arah dan legenda (jalan, infrastruktur umum, sawah, dll) </br>
            e. Skala Peta ( 1 : 2.500 s.d 1 : 10.000 ) </br>
            <p class="mt-2"> Contoh Peta Desa : </p>
            <a href="{{ asset('/referensi/peta1.jpg') }}" target="_blank"><img src="{{ asset('/referensi/peta1.jpg') }}"
                    width="80%"></a><br>
            <a href="{{ asset('/referensi/petadesa.jpg') }}" target="_blank"><img
                    src="{{ asset('/referensi/petadesa.jpg') }}" width="80%"></a>

        </div>
    </div>
</div>