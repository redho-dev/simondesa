<p class="alert alert-info" style="font-size: 1rem">Form Penilaian Realisasi Kegiatan Pembangunan/Rehab/Pemeliharaan
    Fisik TA {{
    $tahun }}</p>


<?php $i = 1; ?>
@foreach($pilfis as $dp)

<div class="row mb-0 pb-0">
    <div class="col-md-12 mb-0 pb-0">
        <table class="table table-bordered mb-0 pb-0" id="tabel_{{ $i }}">
            <thead class="mt-2">
                <tr class="bg-info">
                    <th class="text-center" width="4%" style="vertical-align: middle">No</th>
                    <th width="20%" style="vertical-align: middle">Nama Kegiatan</th>
                    <th class="text-center" width="8%" style="vertical-align: middle">SK TPK</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Desain/RAB/Gambar</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Progress <br> 0%</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Progress <br> 50%</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Progress <br> 100%</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto papan <br> kegiatan</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Prasasti</th>
                    <th class="text-center" width="8%" style="vertical-align: middle">BAST</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $dp->apbdes_kegiatan->kegiatan->kegiatan}}
                        <p class="mt-0 pt-0 mb-0"> - Jumlah Anggaran : Rp. <span class="angka mt-0 pt-0 mb-0">{{
                                $dp->anggaran}} </span>
                        </p>

                        <p class="mt-0 pt-0 mb-0"> - Realisasi Anggaran : Rp. <span class="angka mt-0 pt-0 mb-0">{{
                                $dp->realisasi_anggaran
                                }}</span></p>
                        <p class="mt-0 pt-0"> - Sifat Kegiatan : {{ $dp->sifat }}</p>
                    </td>
                    <td class="text-center">

                        @if($dp->sk_tpk)
                        <a href="{{ asset('storage/'.$dp->sk_tpk) }}" target="_blank"><img
                                src="{{  asset('img/logo-pdf.jpg') }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif

                        <?php $perbaikan = explode("|",$dp->perbaikan); ?>
                        @if(in_array("1",$perbaikan))
                        <p class="text-danger mt-1 perbaikan">(perbaikan)</p>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($dp->desain_rab)
                        <a href="{{ asset('storage/'.$dp->desain_rab) }}" target="_blank"><img
                                src="{{  asset('img/logo-pdf.jpg') }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif

                        @if(in_array("2",$perbaikan))
                        <p class="text-danger mt-1 perbaikan">(perbaikan)</p>
                        @endif

                    </td>
                    <td class="text-center">
                        @if($dp->foto_0)
                        <a href="{{ asset('storage/'.$dp->foto_0) }}" target="_blank"><img
                                src="{{  asset('storage/'.$dp->foto_0) }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif

                        @if(in_array("3",$perbaikan))
                        <p class="text-danger mt-1 perbaikan">(perbaikan)</p>
                        @endif

                    </td>
                    <td class="text-center">
                        @if($dp->foto_50)
                        <a href="{{ asset('storage/'.$dp->foto_50) }}" target="_blank"><img
                                src="{{  asset('storage/'.$dp->foto_50) }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif

                        @if(in_array("4",$perbaikan))
                        <p class="text-danger mt-1 perbaikan">(perbaikan)</p>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($dp->foto_100)
                        <a href="{{ asset('storage/'.$dp->foto_100) }}" target="_blank"><img
                                src="{{  asset('storage/'.$dp->foto_100) }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif

                        @if(in_array("5",$perbaikan))
                        <p class="text-danger mt-1 perbaikan">(perbaikan)</p>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($dp->foto_papan)
                        <a href="{{ asset('storage/'.$dp->foto_papan) }}" target="_blank"><img
                                src="{{  asset('storage/'.$dp->foto_papan)  }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif

                        @if(in_array("6",$perbaikan))
                        <p class="text-danger mt-1 perbaikan">(perbaikan)</p>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($dp->foto_prasasti)
                        <a href="{{ asset('storage/'.$dp->foto_prasasti) }}" target="_blank"><img
                                src="{{   asset('storage/'.$dp->foto_prasasti) }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif

                        @if(in_array("7",$perbaikan))
                        <p class="text-danger mt-1 perbaikan">(perbaikan)</p>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($dp->bast)
                        <a href="{{ asset('storage/'.$dp->bast) }}" target="_blank"><img
                                src="{{  asset('img/logo-pdf.jpg') }}" width="50px" height="60px"></a>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif

                        @if(in_array("8",$perbaikan))
                        <p class="text-danger mt-1 perbaikan">(perbaikan)</p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#fotocek_{{ $dp->id }}">
                            + Foto Hasil Cek Fisik
                        </button>
                        <br>
                        <small>utamakan foto yang menunjukkan temuan</small>
                    </td>
                    <td colspan="8">
                        <div class="d-flex flex-wrap">
                            @foreach($dp->cek_fisik as $cek)
                            @if($cek->file_data)
                            <div class="mr-2 d-flex flex-column align-items-center">
                                <a href="{{ asset('storage/'.$cek->file_data) }}" target="_blank"><img
                                        src="{{ asset('storage/'.$cek->file_data) }}" width="100" height="75"></a>
                                <a href="/adminIrbanwil/hapusFotoFisik/?idhapus={{ $cek->id }}&tabel={{ $i }}"
                                    class="btn btn-sm btn-danger mt-1" style="font-size: .7rem"><i
                                        class="fa fa-trash"></i></a>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="fotocek_{{ $dp->id }}" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Tambah Foto Hasil Cek
                                        Fisik</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminIrbanwil/tambahFotoFisik" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="kegiatan_fisik_id" value="{{ $dp->id }}">
                                    <input type="hidden" name="tabel" value="tabel_{{ $i }}">

                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="kegiatan">Nama Kegiatan</label>
                                            <div class="custom-file">
                                                <input type="text" class="form-control"
                                                    value="{{ $dp->apbdes_kegiatan->kegiatan->kegiatan }}"
                                                    style="font-size: .7rem" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="foto_temuan">Foto Hasil Cek Fisik</label>
                                            <div class="custom-file">
                                                <input type="hidden" name="nama_data[]" value="foto_fisik">
                                                <input type="file" name="foto_fisik"
                                                    class="custom-file-input foto_fisik" id="customFile" required>
                                                <label class="custom-file-label label_foto_fisik" for="customFile"
                                                    style="font-size: .7rem">Choose
                                                    file
                                                    Image Max (1
                                                    MB)</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary btn-sm">Tambah Foto</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>


                </tr>

                <tr>
                    <td></td>
                    <td colspan="9" class="text-center pl-4">

                        @if($dp && $dp->tgl_cek_fisik)
                        <button id="{{ $i }}" class="btn btn-sm btn-success" data-toggle="modal"
                            data-target="#datafisik_{{ $i }}">Update Nilai & Temuan
                        </button>
                        @else
                        <button id="{{ $i }}" class="btn btn-sm btn-primary" data-toggle="modal"
                            data-target="#datafisik_{{ $i }}">+ Nilai dan Temuan </button>
                        @endif

                        <div class="table-dark text-center float-right py-1 px-2 rounded">
                            @if($dp && $dp->nilai_sementara>=0)
                            Nilai :
                            <span style="font-size: 1rem" id="nilai_{{ $dp->id }}">{{ $dp->nilai_sementara }}</span>
                            @else
                            <span style="font-size: .8rem">Belum Dinilai</span>
                            @endif
                        </div>
                    </td>

                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="datafisik_{{ $i }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="staticBackdropLabel">Form Penilaian dan Temuan Atas Pengadaan
                    Fisik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/adminIrbanwil/nilaiKegFisik" method="post" class="formFisik" tabel="tabel_{{ $i }}">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                    <input type="hidden" name="apbdes_kegiatan_id" value="{{ $dp->apbdes_kegiatan_id }}">
                    <input type="hidden" name="tabel" value="tabel_{{ $i }}">

                    <div class="form-row bg-light">
                        <div class="col">
                            <div class="form-group">
                                <label for="status">Tgl Cek Fisik</label>

                                @if($dp && $dp->tgl_cek_fisik)
                                <input type="date" name="tgl_cek_fisik" class="form-control" style="font-size: .8rem"
                                    value="{{ $dp->tgl_cek_fisik }}" required>
                                @else
                                <input type="date" name="tgl_cek_fisik" class="form-control" style="font-size: .8rem"
                                    required>
                                @endif



                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="status">Kategori Temuan</label>
                                <select class="form-control" name="status_temuan" style="font-size: .8rem" required>

                                    @if($dp && $dp->status_temuan)
                                    <option value="">-- pilih --</option>
                                    <option value=1 {{ $dp->status_temuan == 1 ? 'selected' : ''
                                        }}>Indikasi_Fiktif</option>
                                    <option value=2 {{ $dp->status_temuan == 2 ? 'selected' : ''
                                        }}>Berpotensi_thd_Kerugian_Desa_(Mayor)</option>
                                    <option value=3 {{ $dp->status_temuan == 3 ? 'selected' : ''
                                        }}>Berpotensi_thd_Kerugian Desa_(Minor)</option>
                                    <option value=4 {{ $dp->status_temuan == 4 ? 'selected' : ''
                                        }}>Koreksi_Volume_(Penyesuaian)</option>
                                    <option value=5 {{ $dp->status_temuan == 5 ? 'selected' : ''
                                        }}>Kekurangan_Administratif</option>
                                    <option value=6 {{ $dp->status_temuan == 6 ? 'selected' : ''
                                        }}>Lainnya</option>
                                    <option value=7 {{ $dp->status_temuan == 7 ? 'selected' : ''
                                        }}>Nihil</option>
                                    @else
                                    <option value="">-- pilih --</option>
                                    <option value=1>Indikasi_Fiktif</option>
                                    <option value=2>Berpotensi_thd_Kerugian_Desa_(Mayor)</option>
                                    <option value=3>Berpotensi_thd_Kerugian Desa_(Minor)</option>
                                    <option value=4>Koreksi_Volume_(Penyesuaian)</option>
                                    <option value=5>Kekurangan_Administratif</option>
                                    <option value=6>Lainnya</option>
                                    <option value=7>Nihil</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="status">Estimasi Progress (%)</label>
                                @if($dp && $dp->estimasi_finishing)
                                <input type="number" name="estimasi_finishing" class="form-control text-center"
                                    style="font-size: .8rem" value="{{ $dp->estimasi_finishing }}">
                                @else
                                <input type="number" name="estimasi_finishing" class="form-control"
                                    style="font-size: .8rem">
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="status">Estimasi Kerugian (Rp)</label>

                                @if($dp && $dp->estimasi_kerugian)
                                <input type="text" name="estimasi_kerugian" class="form-control angka"
                                    style="font-size: .8rem" value="{{ $dp->estimasi_kerugian }}">
                                @else
                                <input type="text" name="estimasi_kerugian" class="form-control angka"
                                    style="font-size: .8rem">
                                @endif
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="status">Nilai (0 - 100)</label>

                                @if($dp && $dp->nilai_sementara)
                                <input type="number" name="nilai_sementara" idkeg="{{ $dp->id }}"
                                    class="form-control nilaiKeg" style="font-size: .8rem" required
                                    value="{{ $dp->nilai_sementara }}">
                                @else
                                <input type="number" name="nilai_sementara" idkeg="{{ $dp->id }}"
                                    class="form-control nilaiKeg" style="font-size: .8rem" required>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($dp->catatan_sementara)
                    <div class="form-group bg-info p-2">
                        <label for="rekomendasi" class="text-dark">Temuan : </label>
                        <input type="hidden" name="catatan_sementara" id="catatan_awal_{{ $dp->id }}" autofocus>
                        <trix-editor input="catatan_awal_{{ $dp->id }}" class="bg-light">
                            {!! $dp->catatan_sementara ?? '' !!}
                        </trix-editor>
                    </div>
                    @else
                    <div class="form-group bg-info p-2">
                        <label for="rekomendasi" class="text-dark">Temuan :</label>
                        <input type="hidden" name="catatan_sementara" id="catatan_{{ $dp->id }}" autofocus>
                        <trix-editor input="catatan_{{ $dp->id }}" class="bg-light">
                        </trix-editor>
                    </div>
                    @endif

                    @if($dp->rekomendasi_sementara)
                    <div class="form-group bg-info p-2">
                        <label for="rekomendasi" class="text-dark">Rekomendasi Tindak Lanjut :</label>
                        <input type="hidden" name="rekomendasi_sementara" id="rekomendasi_awal_{{ $dp->id }}" autofocus>
                        <trix-editor input="rekomendasi_awal_{{ $dp->id }}" class="bg-light">
                            {!! $dp->rekomendasi_sementara ?? '' !!}
                        </trix-editor>
                    </div>
                    @else
                    <div class="form-group  bg-info p-2">
                        <label for="rekomendasi" class="text-dark">Rekomendasi Tindak Lanjut :</label>
                        <input type="hidden" name="rekomendasi_sementara" id="rekomendasi_{{ $dp->id }}" autofocus>
                        <trix-editor input="rekomendasi_{{ $dp->id }}" class="bg-light">
                        </trix-editor>
                    </div>
                    @endif

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    @if($dp && $dp->tgl_cek_fisik)
                    <button type="submit" class="btn btn-success ">UPDATE &ensp;<span
                            class="fa fa-send"></span></button>
                    @else
                    <button type="submit" class="btn btn-primary ">KIRIM &ensp;<span class="fa fa-send"></span></button>
                    @endif

                </div>
            </form>
        </div>

    </div>
</div>


{{-- <div class="row mt-0 fisik_{{ $i }} hasil_cek" style="display: none;">
    <div class="col-md-12">

        <form action="/adminIrbanwil/nilaiKegFisik" method="post" class="formFisik" tabel="tabel_{{ $i }}">

            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="apbdes_kegiatan_id" value="{{ $dp->apbdes_kegiatan_id }}">

            <input type="hidden" name="tabel" value="tabel_{{ $i }}">


            <table class="table table-bordered">
                <tr style="background-color: antiquewhite">
                    <td colspan="10">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="status">Tgl Cek Fisik</label>

                                    @if($dp && $dp->tgl_cek_fisik)
                                    <input type="date" name="tgl_cek_fisik" class="form-control"
                                        style="font-size: .8rem" value="{{ $dp->tgl_cek_fisik }}" required>
                                    @else
                                    <input type="date" name="tgl_cek_fisik" class="form-control"
                                        style="font-size: .8rem" required>
                                    @endif



                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="status">Kategori Temuan</label>
                                    <select class="form-control" name="status_temuan" style="font-size: .8rem" required>

                                        @if($dp && $dp->status_temuan)
                                        <option value="">-- pilih --</option>
                                        <option value=1 {{ $dp->status_temuan == 1 ? 'selected' : ''
                                            }}>Indikasi_Fiktif</option>
                                        <option value=2 {{ $dp->status_temuan == 2 ? 'selected' : ''
                                            }}>Berpotensi_thd_Kerugian_Desa_(Mayor)</option>
                                        <option value=3 {{ $dp->status_temuan == 3 ? 'selected' : ''
                                            }}>Berpotensi_thd_Kerugian Desa_(Minor)</option>
                                        <option value=4 {{ $dp->status_temuan == 4 ? 'selected' : ''
                                            }}>Koreksi_Volume_(Penyesuaian)</option>
                                        <option value=5 {{ $dp->status_temuan == 5 ? 'selected' : ''
                                            }}>Kekurangan_Administratif</option>
                                        <option value=6 {{ $dp->status_temuan == 6 ? 'selected' : ''
                                            }}>Lainnya</option>
                                        <option value=7 {{ $dp->status_temuan == 7 ? 'selected' : ''
                                            }}>Nihil</option>
                                        @else
                                        <option value="">-- pilih --</option>
                                        <option value=1>Indikasi_Fiktif</option>
                                        <option value=2>Berpotensi_thd_Kerugian_Desa_(Mayor)</option>
                                        <option value=3>Berpotensi_thd_Kerugian Desa_(Minor)</option>
                                        <option value=4>Koreksi_Volume_(Penyesuaian)</option>
                                        <option value=5>Kekurangan_Administratif</option>
                                        <option value=6>Lainnya</option>
                                        <option value=7>Nihil</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="status">Estimasi Progress (%)</label>
                                    @if($dp && $dp->estimasi_finishing)
                                    <input type="number" name="estimasi_finishing" class="form-control text-center"
                                        style="font-size: .8rem" value="{{ $dp->estimasi_finishing }}">
                                    @else
                                    <input type="number" name="estimasi_finishing" class="form-control"
                                        style="font-size: .8rem">
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="status">Estimasi Kerugian (Rp)</label>

                                    @if($dp && $dp->estimasi_kerugian)
                                    <input type="text" name="estimasi_kerugian" class="form-control angka"
                                        style="font-size: .8rem" value="{{ $dp->estimasi_kerugian }}">
                                    @else
                                    <input type="text" name="estimasi_kerugian" class="form-control angka"
                                        style="font-size: .8rem">
                                    @endif
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="status">Nilai (0 - 100)</label>

                                    @if($dp && $dp->nilai_sementara)
                                    <input type="number" name="nilai_sementara" idkeg="{{ $dp->id }}"
                                        class="form-control nilaiKeg" style="font-size: .8rem" required
                                        value="{{ $dp->nilai_sementara }}">
                                    @else
                                    <input type="number" name="nilai_sementara" idkeg="{{ $dp->id }}"
                                        class="form-control nilaiKeg" style="font-size: .8rem" required>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>

                <tr>
                    <td colspan="5" class="bg-secondary">

                        @if($dp->catatan_sementara)
                        <div class="form-group">
                            <label for="rekomendasi">Temuan : </label>
                            <input type="hidden" name="catatan_sementara" id="catatan_awal_{{ $dp->id }}" autofocus>
                            <trix-editor input="catatan_awal_{{ $dp->id }}" class="bg-light">
                                {!! $dp->catatan_sementara ?? '' !!}
                            </trix-editor>
                        </div>
                        @else
                        <div class="form-group">
                            <label for="rekomendasi">Temuan :</label>
                            <input type="hidden" name="catatan_sementara" id="catatan_{{ $dp->id }}" autofocus>
                            <trix-editor input="catatan_{{ $dp->id }}" class="bg-light">
                            </trix-editor>
                        </div>
                        @endif
                    </td>
                    <td colspan="5" class="bg-secondary">

                        @if($dp->rekomendasi_sementara)
                        <div class="form-group">
                            <label for="rekomendasi">Rekomendasi Tindak Lanjut :</label>
                            <input type="hidden" name="rekomendasi_sementara" id="rekomendasi_awal_{{ $dp->id }}"
                                autofocus>
                            <trix-editor input="rekomendasi_awal_{{ $dp->id }}" class="bg-light">
                                {!! $dp->rekomendasi_sementara ?? '' !!}
                            </trix-editor>
                        </div>
                        @else
                        <div class="form-group">
                            <label for="rekomendasi">Rekomendasi Tindak Lanjut :</label>
                            <input type="hidden" name="rekomendasi_sementara" id="rekomendasi_{{ $dp->id }}" autofocus>
                            <trix-editor input="rekomendasi_{{ $dp->id }}" class="bg-light">
                            </trix-editor>
                        </div>
                        @endif
                    </td>

                </tr>
                <tr>
                    <td colspan="10" class="text-center">

                        @if($dp && $dp->tgl_cek_fisik)
                        <button type="submit" class="btn btn-success btn-sm">UPDATE &ensp;<span
                                class="fa fa-send"></span></button>
                        @else
                        <button type="submit" class="btn btn-primary btn-sm">KIRIM &ensp;<span
                                class="fa fa-send"></span></button>
                        @endif
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div> --}}
<hr>
<br>
<?php $i++; ?>
@endforeach

<input type="hidden" id="jumfisik" value="{{ $i }}">