<?php 
if($status_anggaran == 'anggaran_murni'){
    $anggaran = "anggaran_murni";
}elseif($status_anggaran == 'anggaran_perubahan'){
    $anggaran = "anggaran_perubahan";
}

?>
<p class="alert alert-info" style="font-size: 1rem">Form Penilaian Realisasi Kegiatan Pembangunan/Rehab/Pemeliharaan
    Fisik TA {{
    $tahun }}</p>
<p class="text-primary">A. <i>Simondes Mengidentifikasi Terdapat {{ $jumfisik }} Kegiatan
        Pembangunan/Rehab Fisik pada APB
        Desa TA
        {{ $tahun }}</i></p>

<?php $i = 0; ?>
@foreach($dapemb as $dp)
@if(preg_match("/Rehabilitasi/i",$dp->kegiatan->kegiatan))
<?php $i++; ?>
<div class="row mb-0 pb-0">
    <div class="col-md-12 mb-0 pb-0">
        <table class="table table-bordered mb-0 pb-0" id="tabel_{{ $i }}">
            <thead class="mt-2">
                <tr class="bg-info">
                    <th class="text-center" width="4%" style="vertical-align: middle">No</th>
                    <th width="20%">Nama Kegiatan</th>
                    <th class="text-center" width="8%" style="vertical-align: middle">SK TPK</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Desain/RAB/Gambar</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto papan <br> kegiatan</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Progress <br> 0%</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Progress <br> 50%</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Progress <br> 100%</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Prasasti</th>
                    <th class="text-center" width="8%" style="vertical-align: middle">BAST</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $dp->kegiatan->kegiatan}} <br>Jumlah Anggaran : Rp. <span class="angka">{{ $dp->$anggaran
                            }}</span></td>
                    <td class="text-center ">
                        <?php $data = $dp->pengadaan->where('nama_data', 'sk_tpk')->first(); ?>
                        @if($data && $data->file_data)

                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('img/logo-pdf.jpg') }}" width="50px" height="60px"></a><br>
                        <small class="text-danger">{{ $data->perbaikan ? 'perbaikan' : '' }}</small>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'desain')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('img/logo-pdf.jpg') }}" width="50px" height="60px"></a><br>
                        <small class="text-danger">{{ $data->perbaikan ? 'perbaikan' : '' }}</small>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif

                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_papan')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('storage/'.$data->file_data)  }}" width="50px" height="60px"></a>
                        <br>
                        <small class="text-danger">{{ $data->perbaikan ? 'perbaikan' : '' }}</small>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center ">
                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_0')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('storage/'.$data->file_data) }}" width="50px" height="60px"></a>
                        <br>
                        <small class="text-danger">{{ $data->perbaikan ? 'perbaikan' : '' }}</small>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_50')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('storage/'.$data->file_data) }}" width="50px" height="60px"></a>
                        <br>
                        <small class="text-danger">{{ $data->perbaikan ? 'perbaikan' : '' }}</small>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_100')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('storage/'.$data->file_data) }}" width="50px" height="60px"></a>
                        <br>
                        <small class="text-danger">{{ $data->perbaikan ? 'perbaikan' : '' }}</small>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'prasasti')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{   asset('storage/'.$data->file_data) }}" width="50px" height="60px"></a>
                        <br>
                        <small class="text-danger">{{ $data->perbaikan ? 'perbaikan' : '' }}</small>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'bast')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('img/logo-pdf.jpg') }}" width="50px" height="60px"></a>
                        <br>
                        <small class="text-danger">{{ $data->perbaikan ? 'perbaikan' : '' }}</small>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="9" class="text-center pl-4">
                        <?php $data = $dp->pengadaan->where('nama_data', 'tgl_cek_fisik')->first(); ?>
                        @if($data && $data->tgl_cek_fisik)
                        <button id="{{ $i }}" class="btn btn-sm btn-success tamNil">Update Nilai & Catatan
                            &ensp;<span class="fa fa-angle-double-down"></span></button>
                        @else
                        <button id="{{ $i }}" class="btn btn-sm btn-primary tamNil">+ Nilai dan Catatan &ensp;<span
                                class="fa fa-angle-double-down"></span></button>
                        @endif

                        <div class="table-dark text-center float-right py-1 px-2 rounded">
                            <?php $data = $dp->pengadaan->where('nama_data', 'nilai')->first(); ?>
                            @if($data && $data->nilai>=0)
                            Nilai :
                            <span style="font-size: 1rem" id="nilai_{{ $dp->id }}">{{ $data->nilai }}</span>
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
<div class="row mt-0 fisik_{{ $i }} hasil_cek" style="display: none;">
    <div class="col-md-12">

        <form action="/adminIrbanwil/nilaiPembFisik" method="post" class="formBarjas">

            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="apbdes_kegiatan_id" value="{{ $dp->id }}">
            <input type="hidden" name="jumlah_anggaran" value="{{ $dp->$anggaran
            }}">
            <input type="hidden" name="tabel" value="tabel_{{ $i }}">
            <input type="hidden" name="jumkeg" value="{{ $jumfisik+$jumrafis }}">


            <table class="table table-bordered">
                <tr style="background-color: antiquewhite">
                    <td colspan="10">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="status">Tgl Cek Fisik</label>
                                    <?php $data = $dp->pengadaan->where('nama_data', 'tgl_cek_fisik')->first(); ?>
                                    @if($data && $data->tgl_cek_fisik)
                                    <input type="date" name="tgl_cek_fisik" class="form-control"
                                        style="font-size: .8rem" value="{{ $data->tgl_cek_fisik }}" required>
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
                                        <?php $data = $dp->pengadaan->where('nama_data', 'status_temuan')->first(); ?>
                                        @if($data && $data->status_temuan)
                                        <option value="">-- pilih --</option>
                                        <option value=1 {{ $data->status_temuan == 1 ? 'selected' : ''
                                            }}>Indikasi_Fiktif</option>
                                        <option value=2 {{ $data->status_temuan == 2 ? 'selected' : ''
                                            }}>Berpotensi_thd_Kerugian_Desa_(Mayor)</option>
                                        <option value=3 {{ $data->status_temuan == 3 ? 'selected' : ''
                                            }}>Berpotensi_thd_Kerugian Desa_(Minor)</option>
                                        <option value=4 {{ $data->status_temuan == 4 ? 'selected' : ''
                                            }}>Koreksi_Volume_(Penyesuaian)</option>
                                        <option value=5 {{ $data->status_temuan == 5 ? 'selected' : ''
                                            }}>Kekurangan_Administratif</option>
                                        <option value=6 {{ $data->status_temuan == 6 ? 'selected' : ''
                                            }}>Lainnya</option>
                                        @else
                                        <option value="">-- pilih --</option>
                                        <option value=1>Indikasi_Fiktif</option>
                                        <option value=2>Berpotensi_thd_Kerugian_Desa_(Mayor)</option>
                                        <option value=3>Berpotensi_thd_Kerugian Desa_(Minor)</option>
                                        <option value=4>Koreksi_Volume_(Penyesuaian)</option>
                                        <option value=5>Kekurangan_Administratif</option>
                                        <option value=6>Lainnya</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="status">Estimasi Progress (%)</label>
                                    <?php $data = $dp->pengadaan->where('nama_data', 'estimasi_finishing')->first(); ?>
                                    @if($data && $data->estimasi_finishing)
                                    <input type="number" name="estimasi_finishing" class="form-control text-center"
                                        style="font-size: .8rem" value="{{ $data->estimasi_finishing }}">
                                    @else
                                    <input type="number" name="estimasi_finishing" class="form-control"
                                        style="font-size: .8rem">
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="status">Estimasi Kerugian (Rp)</label>
                                    <?php $data = $dp->pengadaan->where('nama_data', 'estimasi_kerugian')->first(); ?>
                                    @if($data && $data->estimasi_kerugian)
                                    <input type="text" name="estimasi_kerugian" class="form-control angka"
                                        style="font-size: .8rem" value="{{ $data->estimasi_kerugian }}">
                                    @else
                                    <input type="text" name="estimasi_kerugian" class="form-control angka"
                                        style="font-size: .8rem">
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="status">Bentuk Laporan</label>
                                    <select class="form-control" name="bentuk_laporan" style="font-size: .8rem"
                                        required>
                                        <?php $data = $dp->pengadaan->where('nama_data', 'bentuk_laporan')->first(); ?>
                                        @if($data && $data->bentuk_laporan)
                                        <option value="">-- pilih --</option>
                                        <option {{ $data->bentuk_laporan=='NHP' ? 'selected' : '' }}>NHP</option>
                                        <option {{ $data->bentuk_laporan=='LHP' ? 'selected' : '' }}>LHP</option>
                                        @else
                                        <option value="">-- pilih --</option>
                                        <option>NHP</option>
                                        <option>LHP</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="status">Diteruskan ke</label>
                                    <select class="form-control" name="diteruskan_ke" style="font-size: .8rem" required>
                                        <?php $data = $dp->pengadaan->where('nama_data', 'diteruskan_ke')->first(); ?>
                                        @if($data && $data->diteruskan_ke)
                                        <option value="">-- pilih --</option>
                                        <option {{ $data->diteruskan_ke=='Tim_Tindak_Lanjut' ? 'selected' : ''
                                            }}>Tim_Tindak_Lanjut</option>
                                        <option {{ $data->diteruskan_ke=='Irban_Khusus' ? 'selected' : ''
                                            }}>Irban_Khusus</option>
                                        <option {{ $data->diteruskan_ke=='Nihil' ? 'selected' : ''
                                            }}>Nihil</option>
                                        @else
                                        <option value="">-- pilih --</option>
                                        <option>Tim_Tindak_Lanjut</option>
                                        <option>Irban_Khusus</option>
                                        <option>Nihil</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="status">Nilai</label>
                                    <?php $data = $dp->pengadaan->where('nama_data', 'nilai')->first(); ?>
                                    @if($data && $data->nilai)
                                    <input type="number" name="nilai" idkeg="{{ $dp->id }}"
                                        class="form-control nilaiKeg" style="font-size: .8rem" required
                                        value="{{ $data->nilai }}">
                                    @else
                                    <input type="number" name="nilai" idkeg="{{ $dp->id }}"
                                        class="form-control nilaiKeg" style="font-size: .8rem" required>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="bg-info">
                        <?php $data = $dp->pengadaan->where('nama_data', 'catatan')->first(); ?>
                        @if($data)
                        <div class="form-group">
                            <label for="rekomendasi">Catatan / Temuan</label>
                            <input type="hidden" name="catatan" id="catatan_awal_{{ $dp->id }}" autofocus>
                            <trix-editor input="catatan_awal_{{ $dp->id }}" class="bg-light">
                                {!! $data->catatan ?? '' !!}
                            </trix-editor>
                        </div>
                        @else
                        <div class="form-group">
                            <label for="rekomendasi">Catatan / Temuan</label>
                            <input type="hidden" name="catatan" id="catatan_{{ $dp->id }}" autofocus>
                            <trix-editor input="catatan_{{ $dp->id }}" class="bg-light">
                            </trix-editor>
                        </div>
                        @endif
                    </td>
                    <td colspan="5" class="bg-secondary">
                        <?php $data = $dp->pengadaan->where('nama_data', 'rekomendasi')->first(); ?>
                        @if($data)
                        <div class="form-group">
                            <label for="rekomendasi">Saran / Rekomendasi</label>
                            <input type="hidden" name="rekomendasi" id="rekomendasi_awal_{{ $dp->id }}" autofocus>
                            <trix-editor input="rekomendasi_awal_{{ $dp->id }}" class="bg-light">
                                {!! $data->rekomendasi ?? '' !!}
                            </trix-editor>
                        </div>
                        @else
                        <div class="form-group">
                            <label for="rekomendasi">Saran / Rekomendasi</label>
                            <input type="hidden" name="rekomendasi" id="rekomendasi_{{ $dp->id }}" autofocus>
                            <trix-editor input="rekomendasi_{{ $dp->id }}" class="bg-light">
                            </trix-editor>
                        </div>
                        @endif
                    </td>

                </tr>
                <tr>
                    <td colspan="10" class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'tgl_cek_fisik')->first(); ?>
                        @if($data && $data->tgl_cek_fisik)
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
</div>
<hr>

@endif
@endforeach

<input type="hidden" id="jumfisik" value="{{ $i }}">

{{-- Data Pemeliharaan --}}

<p class="text-primary">B. <i>Simondes Mengidentifikasi Sekurangnya Terdapat {{ $jumrafis }} Kegiatan Pemeliharaan Fisik
        pada
        APB
        Desa TA
        {{ $tahun }}</i></p>

<?php $j = 0; ?>
@foreach($dapemb as $dp)
@if(preg_match("/pemeliharaan/i",$dp->kegiatan->kegiatan))
<?php $j++; ?>
<div class="row mb-0 pb-0">
    <div class="col-md-12 mb-0 pb-0">
        <table class="table table-bordered mb-0 pb-0" id="tabel_{{ $j }}">
            <thead class="mt-2">
                <tr class="bg-info">
                    <th class="text-center" width="4%" style="vertical-align: middle">No</th>
                    <th width="20%">Nama Kegiatan</th>
                    <th class="text-center" width="8%" style="vertical-align: middle">SK TPK</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Desain/RAB/Gambar</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto papan <br> kegiatan</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Progress <br> 0%</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Progress <br> 50%</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Progress <br> 100%</th>
                    <th class="text-center" width="10%" style="vertical-align: middle">Foto Prasasti <br>(opsional)</th>
                    <th class="text-center" width="8%" style="vertical-align: middle">BAST</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $j }}</td>
                    <td>{{ $dp->kegiatan->kegiatan}} <br>Jumlah Anggaran : Rp. <span class="angka">{{ $dp->$anggaran
                            }}</span></td>
                    <td class="text-center ">
                        <?php $data = $dp->pengadaan->where('nama_data', 'sk_tpk')->first(); ?>
                        @if($data && $data->file_data)

                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('img/logo-pdf.jpg') }}" width="50px" height="60px"></a>
                        <br>
                        <small class="text-danger">{{ $data->perbaikan ? 'perbaikan' : '' }}</small>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'desain')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('img/logo-pdf.jpg') }}" width="50px" height="60px"></a>
                        <br>
                        <small class="text-danger">{{ $data->perbaikan ? 'perbaikan' : '' }}</small>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif

                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_papan')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('storage/'.$data->file_data)  }}" width="50px" height="60px"></a>
                        <br>
                        <small class="text-danger">{{ $data->perbaikan ? 'perbaikan' : '' }}</small>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center ">
                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_0')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('storage/'.$data->file_data) }}" width="50px" height="60px"></a>
                        <br>
                        <small class="text-danger">{{ $data->perbaikan ? 'perbaikan' : '' }}</small>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_50')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('storage/'.$data->file_data) }}" width="50px" height="60px"></a>
                        <br>
                        <small class="text-danger">{{ $data->perbaikan ? 'perbaikan' : '' }}</small>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'foto_100')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('storage/'.$data->file_data) }}" width="50px" height="60px"></a>
                        <br>
                        <small class="text-danger">{{ $data->perbaikan ? 'perbaikan' : '' }}</small>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'prasasti')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{   asset('storage/'.$data->file_data) }}" width="50px" height="60px"></a>
                        <br>
                        <small class="text-danger">{{ $data->perbaikan ? 'perbaikan' : '' }}</small>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                    <td class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'bast')->first(); ?>
                        @if($data && $data->file_data)
                        <a href="{{ asset('storage/'.$data->file_data) }}" target="_blank"><img
                                src="{{  asset('img/logo-pdf.jpg') }}" width="50px" height="60px"></a>
                        <br>
                        <small class="text-danger">{{ $data->perbaikan ? 'perbaikan' : '' }}</small>
                        @else
                        <p class="text-danger">kosong</p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="9" class="text-center pl-4">
                        <?php $data = $dp->pengadaan->where('nama_data', 'tgl_cek_fisik')->first(); ?>
                        @if($data && $data->tgl_cek_fisik)
                        <button id="{{ $j }}" class="btn btn-sm btn-success tamNilRafis">Update Nilai & Catatan
                            &ensp;<span class="fa fa-angle-double-down"></span></button>
                        @else
                        <button id="{{ $j }}" class="btn btn-sm btn-primary tamNilRafis">+ Nilai dan Catatan &ensp;<span
                                class="fa fa-angle-double-down"></span></button>
                        @endif

                        <div class="table-dark text-center float-right py-1 px-2 rounded">
                            <?php $data = $dp->pengadaan->where('nama_data', 'nilai')->first(); ?>
                            @if($data && $data->nilai>=0)
                            Nilai :
                            <span style="font-size: 1rem" id="nilai_{{ $dp->id }}">{{ $data->nilai }}</span>
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
<div class="row mt-0 rafis_{{ $j }} hasil_cek" style="display: none;">
    <div class="col-md-12">

        <form action="/adminIrbanwil/nilaiPembFisik" method="post" class="formBarjas">

            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="apbdes_kegiatan_id" value="{{ $dp->id }}">
            <input type="hidden" name="jumlah_anggaran" value="{{ $dp->$anggaran}}">
            <input type="hidden" name="tabel" value="tabel_{{ $j }}">
            <input type="hidden" name="jumkeg" value="{{ $jumfisik+$jumrafis }}">


            <table class="table table-bordered">
                <tr style="background-color: antiquewhite">
                    <td colspan="10">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="status">Tgl Cek Fisik</label>
                                    <?php $data = $dp->pengadaan->where('nama_data', 'tgl_cek_fisik')->first(); ?>
                                    @if($data && $data->tgl_cek_fisik)
                                    <input type="date" name="tgl_cek_fisik" class="form-control"
                                        style="font-size: .8rem" value="{{ $data->tgl_cek_fisik }}" required>
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
                                        <?php $data = $dp->pengadaan->where('nama_data', 'status_temuan')->first(); ?>
                                        @if($data && $data->status_temuan)
                                        <option value="">-- pilih --</option>
                                        <option value=1 {{ $data->status_temuan == 1 ? 'selected' : ''
                                            }}>Indikasi_Fiktif</option>
                                        <option value=2 {{ $data->status_temuan == 2 ? 'selected' : ''
                                            }}>Berpotensi_thd_Kerugian_Desa_(Mayor)</option>
                                        <option value=3 {{ $data->status_temuan == 3 ? 'selected' : ''
                                            }}>Berpotensi_thd_Kerugian Desa_(Minor)</option>
                                        <option value=4 {{ $data->status_temuan == 4 ? 'selected' : ''
                                            }}>Koreksi_Volume_(Penyesuaian)</option>
                                        <option value=5 {{ $data->status_temuan == 5 ? 'selected' : ''
                                            }}>Kekurangan_Administratif</option>
                                        <option value=6 {{ $data->status_temuan == 6 ? 'selected' : ''
                                            }}>Lainnya</option>
                                        @else
                                        <option value="">-- pilih --</option>
                                        <option value=1>Indikasi_Fiktif</option>
                                        <option value=2>Berpotensi_thd_Kerugian_Desa_(Mayor)</option>
                                        <option value=3>Berpotensi_thd_Kerugian Desa_(Minor)</option>
                                        <option value=4>Koreksi_Volume_(Penyesuaian)</option>
                                        <option value=5>Kekurangan_Administratif</option>
                                        <option value=6>Lainnya</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="status">Estimasi Progress (%)</label>
                                    <?php $data = $dp->pengadaan->where('nama_data', 'estimasi_finishing')->first(); ?>
                                    @if($data && $data->estimasi_finishing)
                                    <input type="number" name="estimasi_finishing" class="form-control text-center"
                                        style="font-size: .8rem" value="{{ $data->estimasi_finishing }}">
                                    @else
                                    <input type="number" name="estimasi_finishing" class="form-control"
                                        style="font-size: .8rem">
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="status">Estimasi Kerugian (Rp)</label>
                                    <?php $data = $dp->pengadaan->where('nama_data', 'estimasi_kerugian')->first(); ?>
                                    @if($data && $data->estimasi_kerugian)
                                    <input type="text" name="estimasi_kerugian" class="form-control angka"
                                        style="font-size: .8rem" value="{{ $data->estimasi_kerugian }}">
                                    @else
                                    <input type="text" name="estimasi_kerugian" class="form-control angka"
                                        style="font-size: .8rem">
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="status">Bentuk Laporan</label>
                                    <select class="form-control" name="bentuk_laporan" style="font-size: .8rem"
                                        required>
                                        <?php $data = $dp->pengadaan->where('nama_data', 'bentuk_laporan')->first(); ?>
                                        @if($data && $data->bentuk_laporan)
                                        <option value="">-- pilih --</option>
                                        <option {{ $data->bentuk_laporan=='NHP' ? 'selected' : '' }}>NHP</option>
                                        <option {{ $data->bentuk_laporan=='LHP' ? 'selected' : '' }}>LHP</option>
                                        @else
                                        <option value="">-- pilih --</option>
                                        <option>NHP</option>
                                        <option>LHP</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="status">Diteruskan ke</label>
                                    <select class="form-control" name="diteruskan_ke" style="font-size: .8rem" required>
                                        <?php $data = $dp->pengadaan->where('nama_data', 'diteruskan_ke')->first(); ?>
                                        @if($data && $data->diteruskan_ke)
                                        <option value="">-- pilih --</option>
                                        <option {{ $data->diteruskan_ke=='Tim_Tindak_Lanjut' ? 'selected' : ''
                                            }}>Tim_Tindak_Lanjut</option>
                                        <option {{ $data->diteruskan_ke=='Irban_Khusus' ? 'selected' : ''
                                            }}>Irban_Khusus</option>
                                        <option {{ $data->diteruskan_ke=='Nihil' ? 'selected' : ''
                                            }}>Nihil</option>
                                        @else
                                        <option value="">-- pilih --</option>
                                        <option>Tim_Tindak_Lanjut</option>
                                        <option>Irban_Khusus</option>
                                        <option>Nihil</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="status">Nilai</label>
                                    <?php $data = $dp->pengadaan->where('nama_data', 'nilai')->first(); ?>
                                    @if($data && $data->nilai)
                                    <input type="number" name="nilai" idkeg="{{ $dp->id }}"
                                        class="form-control nilaiKeg" style="font-size: .8rem" required
                                        value="{{ $data->nilai }}">
                                    @else
                                    <input type="number" name="nilai" idkeg="{{ $dp->id }}"
                                        class="form-control nilaiKeg" style="font-size: .8rem" required>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="bg-info">
                        <?php $data = $dp->pengadaan->where('nama_data', 'catatan')->first(); ?>
                        @if($data)
                        <div class="form-group">
                            <label for="rekomendasi">Catatan / Temuan</label>
                            <input type="hidden" name="catatan" id="catatan_rafis_{{ $dp->id }}" autofocus>
                            <trix-editor input="catatan_rafis_{{ $dp->id }}" class="bg-light">
                                {!! $data->catatan ?? '' !!}
                            </trix-editor>
                        </div>
                        @else
                        <div class="form-group">
                            <label for="rekomendasi">Catatan / Temuan</label>
                            <input type="hidden" name="catatan" id="catatan_pemeliharaan_{{ $dp->id }}" autofocus>
                            <trix-editor input="catatan_pemeliharaan_{{ $dp->id }}" class="bg-light">
                            </trix-editor>
                        </div>
                        @endif
                    </td>
                    <td colspan="5" class="bg-secondary">
                        <?php $data = $dp->pengadaan->where('nama_data', 'rekomendasi')->first(); ?>
                        @if($data)
                        <div class="form-group">
                            <label for="rekomendasi">Saran / Rekomendasi</label>
                            <input type="hidden" name="rekomendasi" id="rekomendasi_rafis_{{ $dp->id }}" autofocus>
                            <trix-editor input="rekomendasi_rafis_{{ $dp->id }}" class="bg-light">
                                {!! $data->rekomendasi ?? '' !!}
                            </trix-editor>
                        </div>
                        @else
                        <div class="form-group">
                            <label for="rekomendasi">Saran / Rekomendasi</label>
                            <input type="hidden" name="rekomendasi" id="rekomendasi_pemeliharaan_{{ $dp->id }}"
                                autofocus>
                            <trix-editor input="rekomendasi_pemeliharaan_{{ $dp->id }}" class="bg-light">
                            </trix-editor>
                        </div>
                        @endif
                    </td>

                </tr>
                <tr>
                    <td colspan="10" class="text-center">
                        <?php $data = $dp->pengadaan->where('nama_data', 'tgl_cek_fisik')->first(); ?>
                        @if($data && $data->tgl_cek_fisik)
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
</div>
<hr>

@endif
@endforeach

<input type="hidden" id="jumfisik" value="{{ $j }}">