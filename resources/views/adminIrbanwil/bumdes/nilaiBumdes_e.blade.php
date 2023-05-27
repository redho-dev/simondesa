<div class="row ">
    <div class="col-md-8 mt-2">

        <form action="/adminIrbanwil/nilaiBumdesUpdate" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">

            <table class="table table-bordered">
                <thead>
                    <tr class="bg-info">
                        <th width="5%" style="vertical-align: middle">No</th>
                        <th width="45%" style="vertical-align: middle">Sub Indikator</th>
                        <th width="10%" class="text-center" style="vertical-align: middle">Bobot <br>(%)</th>
                        <th width="15%" class="text-center">Jumlah<br>Data</th>
                        <th width="15%" class="text-center" style="vertical-align: middle">Nilai</th>
                        <th width="10%" class="text-center" style="vertical-align: middle">Skor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="{{ $datnil->where('indikator_bumd_id', 1)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                        <td>1</td>
                        <td>Badan Hukum BUM Desa</td>
                        <td class=" text-center bg-secondary" style="vertical-align: middle">30</td>
                        <td class="text-center" style="vertical-align: middle">{{ $dasarHukum }} dokumen
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="bobot[]" value=30>
                            <input type="hidden" name="jumlah_data[]" value={{ $dasarHukum }}>
                            <input type="number" class="form-control text-center" style="font-size: .85rem"
                                name="nilai[]"
                                value="{{ $datnil->where('indikator_bumd_id', 1)->pluck('nilai_sementara')->first() }}"
                                required>
                        </td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">
                            {{ $datnil->where('indikator_bumd_id', 1)->pluck('skor')->first() }}
                        </td>
                    </tr>
                    <tr
                        class="{{ $datnil->where('indikator_bumd_id', 2)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                        <td>2</td>
                        <td>Perdes Pembentukan BUM Desa dan AD/ART</td>
                        <td class=" text-center bg-secondary" style="vertical-align: middle">10</td>
                        <td class="text-center" style="vertical-align: middle">{{ $perdesPembentukan }} dokumen
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="bobot[]" value=10>
                            <input type="hidden" name="jumlah_data[]" value={{ $perdesPembentukan }}>
                            <input type="number" class="form-control text-center" name="nilai[]"
                                style="font-size: .85rem"
                                value="{{ $datnil->where('indikator_bumd_id', 2)->pluck('nilai_sementara')->first() }}"
                                required>
                        </td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">
                            {{ $datnil->where('indikator_bumd_id', 2)->pluck('skor')->first() }}
                        </td>
                    </tr>
                    <tr
                        class="{{ $datnil->where('indikator_bumd_id', 3)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                        <td>3</td>
                        <td>Perdes Penyertaan Modal</td>
                        <td class=" text-center bg-secondary" style="vertical-align: middle">10</td>
                        <td class="text-center" style="vertical-align: middle">{{ $perdesModal }} dokumen
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="bobot[]" value=10>
                            <input type="hidden" name="jumlah_data[]" value={{ $perdesModal }}>
                            <input type="number" class="form-control text-center" name="nilai[]"
                                style="font-size: .85rem"
                                value="{{ $datnil->where('indikator_bumd_id', 3)->pluck('nilai_sementara')->first() }}"
                                required>
                        </td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">
                            {{ $datnil->where('indikator_bumd_id', 3)->pluck('skor')->first() }}
                        </td>
                    </tr>
                    <tr
                        class="{{ $datnil->where('indikator_bumd_id', 4)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                        <td>4</td>
                        <td>SK Kepengurusan</td>
                        <td class=" text-center bg-secondary" style="vertical-align: middle">10</td>
                        <td class="text-center" style="vertical-align: middle">{{ $skPengurus }} dokumen
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="bobot[]" value=10>
                            <input type="hidden" name="jumlah_data[]" value={{ $skPengurus }}>
                            <input type="number" class="form-control text-center" name="nilai[]"
                                style="font-size: .85rem"
                                value="{{ $datnil->where('indikator_bumd_id', 4)->pluck('nilai_sementara')->first() }}"
                                required>
                        </td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">
                            {{ $datnil->where('indikator_bumd_id', 4)->pluck('skor')->first() }}
                        </td>
                    </tr>
                    <tr
                        class="{{ $datnil->where('indikator_bumd_id', 5)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                        <td>5</td>
                        <td>Proposal Pengajuan Modal</td>
                        <td class=" text-center bg-secondary" style="vertical-align: middle">10</td>
                        <td class="text-center" style="vertical-align: middle">{{ $proposal }} dokumen
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="bobot[]" value=10>
                            <input type="hidden" name="jumlah_data[]" value={{ $proposal }}>
                            <input type="number" class="form-control text-center" name="nilai[]"
                                style="font-size: .85rem"
                                value="{{ $datnil->where('indikator_bumd_id', 5)->pluck('nilai_sementara')->first() }}"
                                required>
                        </td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">
                            {{ $datnil->where('indikator_bumd_id', 5)->pluck('skor')->first() }}
                        </td>
                    </tr>
                    <tr
                        class="{{ $datnil->where('indikator_bumd_id', 6)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                        <td>6</td>
                        <td>Laporan Keuangan BUM Desa</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">15</td>
                        <td class="text-center" style="vertical-align: middle">{{ $laporan }} dokumen
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="bobot[]" value=15>
                            <input type="hidden" name="jumlah_data[]" value={{ $laporan }}>
                            <input type="number" class="form-control text-center" name="nilai[]"
                                style="font-size: .85rem"
                                value="{{ $datnil->where('indikator_bumd_id', 6)->pluck('nilai_sementara')->first() }}"
                                required>
                        </td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">
                            {{ $datnil->where('indikator_bumd_id', 6)->pluck('skor')->first() }}
                        </td>
                    </tr>
                    <tr
                        class="  {{ $datnil->where('indikator_bumd_id', 7)->pluck('perbaikan')->first() ? 'text-danger' : '' }} ">
                        <td>7</td>
                        <td>Kontribusi PADes</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">15</td>
                        <td class="text-center" style="vertical-align: middle">{{ $pad }} dokumen
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="bobot[]" value=15>
                            <input type="hidden" name="jumlah_data[]" value={{ $pad }}>
                            <input type="number" class="form-control text-center" name="nilai[]"
                                style="font-size: .85rem"
                                value="{{ $datnil->where('indikator_bumd_id', 7)->pluck('nilai_sementara')->first() }}"
                                required>
                        </td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">
                            {{ $datnil->where('indikator_bumd_id', 7)->pluck('skor')->first() }}
                        </td>
                    </tr>


                </tbody>

                <tr>
                    <td colspan="6" class="text-muted">
                        <p class="mb-0">Petunjuk Penilaian :</p>
                        <ul>
                            <li>
                                Nilai 0 jika tidak ada data, nilai 100 jika data lengkap dan sesuai
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="background-color: beige">
                        <?php 
                        $nil = $totalSkor;
                        if($nil >= 0 && $nil <=30){
                            $kesimpulan = "TIDAK MEMADAI";
                        }elseif($nil > 30 && $nil <=55){
                            $kesimpulan = "KURANG MEMADAI";
                        }elseif($nil > 55 && $nil <=75){
                            $kesimpulan = "CUKUP MEMADAI";
                        }elseif($nil > 75 && $nil <=90){
                            $kesimpulan = "MEMADAI";
                        }elseif($nil > 90 && $nil <=100){
                            $kesimpulan = "SANGAT MEMADAI";
                        }       
                        ?>
                        <p class="mb-0">KESIMPULAN : </p>
                        @if($catatan->uraian == '')
                        <p class="mb-0">SECARA UMUM TATA KELOLA BUMDES TAHUN {{ $tahun
                            }} <span class="text-primary">-- {{ $kesimpulan }} --</span>
                        </p>
                        @else
                        <p class="mb-0">SECARA UMUM TATA KELOLA BUMDES TAHUN {{ $tahun
                            }} <span class="text-primary">-- {{ $kesimpulan }} --</span>, DENGAN BEBERAPA CATATAN /
                            TEMUAN
                            SEBAGAI
                            BERIKUT :
                        </p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="background-color: beige">
                        <div class="form-group">
                            <label for="uraian">Catatan / Saran / Uraian Kesimpulan / Apresiasi </label>
                            <input type="hidden" name="uraian" id="uraian" autofocus>
                            <trix-editor input="uraian" class="bg-white">
                                {!! $catatan->uraian !!}
                            </trix-editor>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="bg-info">
                        <div class="form-group">
                            <label for="kesimpulan">Temuan : </label>
                            <input type="hidden" name="catatan_sementara" id="kesimpulan" autofocus>
                            <trix-editor input="kesimpulan" class="bg-white">{!! $catatan->catatan_sementara ?? ''
                                !!}
                            </trix-editor>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="bg-info">
                        <div class="form-group">
                            <label for="saran">Rekomendasi Tindak Lanjut:</label>
                            <input type="hidden" name="rekom_sementara" id="saran">
                            <trix-editor input="saran" class="bg-white">{!! $catatan->rekom_sementara ?? '' !!}
                            </trix-editor>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-right">
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                    </td>
                </tr>


            </table>
        </form>
    </div>
    <div class="col-md-3 mt-2">
        <p class="alert alert-info" style="font-size: 1rem">Capaian Akuntabilitas Pengelolaan BUM Desa</p>
        <div class="card p-2">
            <label for="">Keterisian Data</label>
            <div class="progress progress_sm mb-1 ">
                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{ $totalData ?? 0 }}">
                </div>
            </div>
            <small style="font-size: .7rem">{{ round($totalData) ?? 0 }}% Complete</small>
        </div>
        <div class="card p-2">
            <label for="">Skor </label>
            <div class="progress progress_sm mb-1 ">
                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{ $totalSkor ?? 0}}">
                </div>
            </div>
            <small style="font-size: .8rem">{{ round($totalSkor,2) }}</small>
        </div>


    </div>

</div>