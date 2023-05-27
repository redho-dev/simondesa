<?php 
if($anggaran == 'perubahan'){
    $jumgar = 'anggaran_perubahan';
}else{
    $jumgar = 'anggaran_murni';
}

?>

<div class="row ">
    <div class="col-md-8 mt-2">
        <p class="alert bg-warning text-dark" style="font-size: 1rem">Penilaian Indikator : Penataan Pembiayaan
        </p>
        <form action="/adminIrbanwil/nilaiAkunpembiayaanUpdate" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="aspek_id" value=2>
            <input type="hidden" name="indikator_id" value=9>

            <table class="table table-bordered">
                <thead>
                    <tr class="bg-info">
                        <th width="5%" style="vertical-align: middle">No</th>
                        <th width="45%" style="vertical-align: middle">Sub Indikator</th>
                        <th width="10%" class="text-center" style="vertical-align: middle">Bobot <br>(%)</th>
                        <th width="15%" class="text-center">Keterisian<br>Data (%)</th>
                        <th width="15%" class="text-center" style="vertical-align: middle">Nilai</th>
                        <th width="10%" class="text-center" style="vertical-align: middle">Skor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="{{ $datnilPen->perbaikan ? 'text-danger' : '' }}">
                        <td>1</td>
                        <td>Penataan Penerimaan Pembiayaan</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">50</td>
                        <td class="text-center" style="vertical-align: middle">
                            @if($anggaranPen && $anggaranPen->$jumgar == 0)
                            <input type="hidden" name="persen_data_pen" value=100>
                            <span class="text-primary">{{ 100 }}</span>
                            @else
                            {{ $datnilPen->persen_data ?? 0 }}
                            @endif

                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="sub_indikator_keuangan_id[]" value=7>

                            <input type="number" class="form-control text-center " style="font-size: .85rem"
                                name="nilai[]" value="{{ $datnilPen->nilai_sementara }}" autofocus required>

                        </td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">{{ $datnilPen->skor }}</td>
                    </tr>
                    <tr class="{{ $datnilPen->perbaikan ? 'text-danger' : '' }}">
                        <td>2</td>
                        <td>Penataan Pengeluaran Pembiayaan</td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">50</td>
                        <td class="text-center" style="vertical-align: middle">
                            @if($anggaranPeng && $anggaranPeng->$jumgar == 0)
                            <input type="hidden" name="persen_data_peng" value=100>
                            <span class="text-primary">{{ 100 }}</span>
                            @else
                            {{ $datnilPeng->persen_data ?? 0 }}
                            @endif
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="sub_indikator_keuangan_id[]" value=8>

                            <input type="number" class="form-control text-center " style="font-size: .85rem"
                                name="nilai[]" value="{{ $datnilPeng->nilai_sementara }}" required>

                        </td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">{{ $datnilPeng->skor }}</td>
                    </tr>

                </tbody>

                <tr>
                    <td colspan="6" class="text-muted">
                        <p><i>Petunjuk Penilaian : <br>
                                1. Nilai 0 jika data kosong, 100 jika setiap jenis penerimaan pembiayaan dilengkapi
                                dengan dokumen (bukti penerimaan) dan keterisian data 100% <br>
                                2. Nilai 0 jika data kosong, 100 jika setiap jenis pengeluaran pembiayaan dilengkapi
                                dengan dokumen (file SPP dan TBPU) dan keterisian data 100% <br>
                                3. Kolom Keterisian Data dan Kolom Nilai akan terisi 100, jika
                                Anggaran Penerimaan Pembiayaan atau Anggaran Pengeluaran Pembiayaan <br>&emsp; di dalam
                                APBDes = Rp. 0

                            </i></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="7" style="background-color: beige">
                        <?php 
                        $nil = $rekap->nilai;
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
                        <p class="mb-1">KESIMPULAN : </p>
                        <p class="mb-1">SECARA UMUM PENATAUSAHAAN PEMBIAYAAN TAHUN ANGGARAN {{ $tahun
                            }} <span class="text-primary">-- {{ $kesimpulan }} --</span> </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="background-color: beige">
                        <div class="form-group">
                            <label for="uraian">Catatan / Saran / Uraian Kesimpulan / Apresiasi :</label>
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
                            <label for="kesimpulan">Temuan :</label>
                            <input type="hidden" name="catatan_sementara" id="kesimpulan" autofocus>
                            <trix-editor input="kesimpulan" class="bg-white">{!! $catatan->catatan_sementara
                                !!}
                            </trix-editor>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="bg-info">
                        <div class="form-group">
                            <label for="saran">Rekomendasi Tindak Lanjut :</label>
                            <input type="hidden" name="rekom_sementara" id="saran">
                            <trix-editor input="saran" class="bg-white">{!! $catatan->rekom_sementara !!}
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
        <p class="alert alert-info" style="font-size: 1rem">Capaian Indikator : </br>Penataan Pembiayaan</p>
        <div class="card p-2">
            <label for="">Keterisian Data</label>
            <div class="progress progress_sm mb-1 ">
                <div class="progress-bar bg-green" role="progressbar"
                    data-transitiongoal="{{ $rekap->persen_data ?? 0 }}">
                </div>
            </div>
            <small style="font-size: .7rem">{{ round($rekap->persen_data) ?? 0 }}% Complete</small>
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
            <p class="mb-0">Bobot : {{ $rekap->bobot }}%</p>
            <p>Skor : {{ $rekap->skor }}</p>
        </div>

    </div>

</div>