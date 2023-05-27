<div class="row ">
    <div class="col-md-8 mt-2">
        <p class="alert bg-warning text-dark" style="font-size: 1rem">Penilaian Indikator : Penataan Belanja
        </p>
        <form action="/adminIrbanwil/nilaiAkunbelanjaUpdate" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="aspek_id" value=2>
            <input type="hidden" name="indikator_id" value=8>

            <style>
                .smoke {
                    background-color: darkgray;
                }
            </style>
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-info">
                        <th width="5%" style="vertical-align: middle">No</th>
                        <th width="40%" style="vertical-align: middle">Sub Indikator</th>
                        <th width="10%" class="text-center" style="vertical-align: middle">Bobot <br>(%)</th>
                        <th width="10%" class="text-center" style="vertical-align: middle">Keterisian<br>Data (%)</th>
                        <th width="10%" class="text-center" style="vertical-align: middle">Rata-rata <br> Nilai Dokumen
                        </th>
                        <th width="15%" class="text-center" style="vertical-align: middle">Nilai</th>
                        <th width="10%" class="text-center" style="vertical-align: middle">Skor</th>

                    </tr>
                </thead>
                <tbody>
                    <tr class="{{ $spp_null > 0 || $spp_ulang > 0 ? 'text-danger' : '' }}">
                        <td>1</td>
                        <td>Kelengkapan SPP Kegiatan</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">30</td>
                        <td class="text-center" style="vertical-align: middle">{{ $datnilSPP->persen_data ?? 0
                            }}
                        </td>
                        <td class="text-center smoke" style="vertical-align: middle">{{ round($rata_spp,2) }}
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="spp_null" value="{{ $spp_null }}">
                            <input type="hidden" name="spp_ulang" value="{{ $spp_ulang }}">
                            <input type="hidden" name="sub_indikator_keuangan_id[]" value=3>
                            @if($datnilSPP)
                            @if($datnilSPP->persen_data >= 95)
                            <input type="number" class="form-control text-center text-primary" style="font-size: .85rem"
                                name="nilai[]" value="{{ round(($datnilSPP->persen_data * $rata_spp)/100) }}" required>
                            @elseif($datnilSPP->persen_data < 95) <input type="number" class="form-control text-center"
                                style="font-size: .85rem" name="nilai[]"
                                value="{{ round(($datnilSPP->persen_data * $rata_spp)/100) }}" required readonly>
                                @endif
                                @else
                                <input type="number" class="form-control text-center " style="font-size: .85rem"
                                    name="nilai[]" value=0 required readonly>
                                @endif
                        </td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">{{ $datnilSPP->skor }}</td>
                    </tr>
                    <tr class="{{ $bkp_null > 0 || $bkp_ulang > 0 ? 'text-danger' : '' }}">
                        <td>2</td>
                        <td>Kelengkapan TBPU dan Bukti Belanja</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">30</td>
                        <td class="text-center" style="vertical-align: middle">{{ $datnilBKP->persen_data ?? 0
                            }}
                        </td>
                        <td class="text-center smoke" style="vertical-align: middle">{{ round($rata_bkp,2) }}
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="bkp_null" value="{{ $bkp_null }}">
                            <input type="hidden" name="bkp_ulang" value="{{ $bkp_ulang }}">
                            <input type="hidden" name="sub_indikator_keuangan_id[]" value=4>
                            @if($datnilBKP)
                            @if($datnilBKP->persen_data >= 95)
                            <input type="number" class="form-control text-center text-primary" name="nilai[]"
                                style="font-size: .85rem" value="{{ round(($datnilBKP->persen_data * $rata_bkp)/100) }}"
                                required>
                            @elseif($datnilBKP->persen_data < 95) <input type="number" class="form-control text-center "
                                name="nilai[]" style="font-size: .85rem"
                                value="{{ round(($datnilBKP->persen_data * $rata_bkp)/100) }}" required readonly>
                                @endif
                                @else <input type="number" class="form-control text-center " name="nilai[]"
                                    style="font-size: .85rem" value=0 required readonly>
                                @endif

                        </td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">{{ $datnilBKP->skor }}</td>
                    </tr>
                    <tr class="{{ $datnilBank && $datnilBank->perbaikan ? 'text-danger' : '' }}">
                        <td>3</td>
                        <td>Pembukuan</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">10</td>
                        <td class="text-center" style="vertical-align: middle">{{ $datnilBank->persen_data ?? 0
                            }}
                        </td>
                        <td class="text-center smoke" style="vertical-align: middle">-
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="sub_indikator_keuangan_id[]" value=5>
                            <input type="number" class="form-control text-center" name="nilai[]"
                                style="font-size: .85rem" value="{{ $datnilBank->nilai_sementara ?? 0  }}" required>
                        </td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">{{ $datnilBank->skor ?? 0 }}
                        </td>
                    </tr>
                    <tr class="{{ $uji_null || $data_upet==0 ? 'text-danger' : '' }} ">
                        <td>4</td>
                        <td>Validasi / Uji Petik Bukti Belanja</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">30</td>
                        <td class="text-center" style="vertical-align: middle">{{ $data_upet }}
                        </td>
                        <td class="text-center smoke" style="vertical-align: middle">-
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="data_upet" value="{{ $data_upet }}">
                            <input type="hidden" name="uji_null" value="{{ $uji_null }}">
                            <input type="hidden" name="sub_indikator_keuangan_id[]" value=6>
                            <input type="number" class="form-control text-center" name="nilai[]"
                                value="{{ $nilai_upet ?? 0 }}" style="font-size: .85rem" readonly required>
                        </td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">{{ $datnilUji->skor ?? 0 }}
                        </td>
                    </tr>

                </tbody>

                <tr>
                    <td colspan="7" class="text-muted">
                        <p class="mb-0"><i>Petunjuk Penilaian : </i></p>
                        <ul>
                            <li>Untuk sub indikator SPP dan TBPU,
                                keterisian data merupakan
                                persentase realisasi SPP/TBPU terhadap jumlah anggaran kegiatan</li>
                            <li>Perhitungan nilai sub indikator SPP/TBPU adalah
                                (keterisian data x rata-rata nilai per dokumen), dan menjadi updateable jika keterisian
                                data >= 95%</li>
                            <li>Nilai Sub indikator Pembukuan = 0 jika keterisian data 0, dan nilai = 100 jika data
                                pembukuan
                                lengkap dan sesuai</li>
                            <li>Nilai sub indikator hasil uji petik otomatis terisi jika penilaian uji petik telah
                                dilakukan</li>
                        </ul>

                    </td>
                </tr>
                <tr>
                    <td colspan="7" style="background-color: beige">
                        <?php 
                    //    $nil = $rekap->nilai;
                    //     if($nil >= 0 && $nil <=30){
                    //         $kesimpulan = "TIDAK MEMADAI";
                    //     }elseif($nil > 30 && $nil <=55){
                    //         $kesimpulan = "KURANG MEMADAI";
                    //     }elseif($nil > 55 && $nil <=75){
                    //         $kesimpulan = "CUKUP MEMADAI";
                    //     }elseif($nil > 75 && $nil <=90){
                    //         $kesimpulan = "MEMADAI";
                    //     }elseif($nil > 90 && $nil <=100){
                    //         $kesimpulan = "SANGAT MEMADAI";
                    //     }       
                        ?>
                        {{-- <p class="mb-1">KESIMPULAN : </p>
                        <p>SECARA UMUM PENATAUSAHAAN BELANJA TAHUN ANGGARAN {{ $tahun
                            }} <span class="text-primary">-- {{ $kesimpulan }} --</span> , DENGAN DAFTAR
                            TEMUAN DAN CATATAN SEBAGAI BERIKUT :</p> --}}
                    </td>
                </tr>
                <tr>
                    @if($jumlahTemuan > 0)
                    <td colspan="7">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#temuan">
                            Daftar Temuan
                        </button>
                    </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="7" style="background-color: beige">
                        <div class="form-group">
                            <label for="uraian">Catatan / Uraian Kesimpulan / Saran / Apresiasi</label>
                            <input type="hidden" name="uraian" id="uraian" autofocus>
                            <trix-editor input="uraian" class="bg-white">
                                {!! $catatan->uraian ?? '' !!}
                            </trix-editor>
                        </div>
                    </td>
                </tr>
                {{-- <tr>
                    <td colspan="7" class="bg-info">
                        <div class="form-group">
                            <label for="saran">Saran / Rekomendasi</label>
                            <input type="hidden" name="rekom_sementara" id="saran">
                            <trix-editor input="saran" class="bg-white">{!! $catatan->rekom_sementara ?? '' !!}
                            </trix-editor>
                        </div>
                    </td>
                </tr> --}}
                <tr>
                    <td colspan="7" class="text-right">
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                    </td>
                </tr>


            </table>
        </form>
        <!-- Modal -->
        <div class="modal fade" id="temuan" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-white" id="staticBackdropLabel">DAFTAR TEMUAN PENATAUSAHAAN BELANJA
                            TA
                            {{
                            $tahun }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-primary">A. SPP</p>
                        <table class="table table-bordered">
                            <tr class="bg-secondary">
                                <th>No</th>
                                <th>Nomor SPP</th>
                                <th>Jumlah (Rp)</th>
                                <th>Temuan</th>
                                <th>Rekomendasi TL</th>
                            </tr>
                            @foreach($temuanSPP as $tmspp)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tmspp->nomor }}</td>
                                <td>
                                    <span class="angka">{{ $tmspp->jumlah }}</span>
                                </td>
                                <td>{{ $tmspp->catatan }}</td>
                                <td>{{ $tmspp->rekomendasi }}</td>
                            </tr>
                            @endforeach
                        </table>
                        <p class="text-primary">B. TBPU</p>
                        <table class="table table-bordered">
                            <tr class="bg-secondary">
                                <th>No</th>
                                <th>Nomor TBPU</th>
                                <th>Jumlah (Rp)</th>
                                <th>Temuan</th>
                                <th>Rekomendasi TL</th>
                            </tr>
                            @foreach($daftarTemuan as $temuan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $temuan->nomor }}</td>
                                <td>
                                    <span class="angka">{{ $temuan->jumlah }}</span>
                                </td>
                                <td>{{ $temuan->catatan_bkp }}</td>
                                <td>{{ $temuan->rekomendasi_bkp }}</td>
                            </tr>
                            @endforeach
                        </table>
                        <p class="text-primary">C. UJI PETIK </p>
                        <table class="table table-bordered">
                            <tr class="bg-secondary">
                                <th>No</th>
                                <th>Nomor TBPU</th>
                                <th>Jumlah (Rp)</th>
                                <th>Temuan</th>
                                <th>Rekomendasi TL</th>
                            </tr>
                            @foreach($temuanUjipetik as $temu)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $temu->penataanbelanja_bkp->nomor }}</td>
                                <td>
                                    <span class="angka">{{ $temu->penataanbelanja_bkp->jumlah }}</span>
                                </td>
                                <td>{{ $temu->kesimpulan_sementara }}</td>
                                <td>{{ $temu->rekomendasi_sementara }}</td>
                            </tr>
                            @endforeach
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mt-2">
        <p class="alert alert-info" style="font-size: 1rem">Capaian Indikator : </br>Penataan Belanja</p>
        <div class="card p-2">
            <label for="">Keterisian Data</label>
            <div class="progress progress_sm mb-1 ">
                <div class="progress-bar bg-green" role="progressbar"
                    data-transitiongoal="{{ $rekap->persen_data ?? 0 }}">
                </div>
            </div>
            <small style="font-size: .7rem">{{ $rekap->persen_data ?? 0 }}% Complete</small>
        </div>
        <div class="card p-2">
            <label for="">Nilai Indikator </label>
            <div class="progress progress_sm mb-1 ">
                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{ $rekap->nilai ?? 0}}">
                </div>
            </div>
            <small style="font-size: .8rem">{{ round($rekap->nilai,2) }}</small>
        </div>
        <div class="card p-2 d-flex">
            <p class="mb-0">Bobot : {{ $rekap->bobot ?? 0 }}%</p>
            <p>Skor : {{ $rekap->skor ?? 0}}</p>
        </div>

    </div>
</div>