<div class="row ">
    <div class="col-md-8 mt-2">
        <p class="alert bg-warning text-dark" style="font-size: 1rem">Penilaian Indikator : Pelaporan

        </p>
        <form action="/adminIrbanwil/nilaiAkunpelaporan" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="aspek_id" value=1>
            <input type="hidden" name="indikator_id" value=6>

            <table class="table table-bordered">
                <thead>
                    <tr class="bg-info">
                        <th width="5%" style="vertical-align: middle">No</th>
                        <th width="55%" style="vertical-align: middle">Sub Indikator</th>
                        <th width="10%" class="text-center" style="vertical-align: middle">Bobot <br>(%)</th>
                        <th width="15%" class="text-center">Keterisian<br>Data (%)</th>
                        <th width="15%" class="text-center" style="vertical-align: middle">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subpem as $sub)

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($sub->id < 42) {{ $sub->sub_indikator }} Tahun {{ $tahun-1 }}
                                @else
                                {{ $sub->sub_indikator }} (Tahun Anggaran {{ $tahun }})
                                @endif
                        </td>
                        <td class="text-center bg-secondary" style="vertical-align: middle">{{ $sub->bobot }}</td>
                        <td class="text-center" style="vertical-align: middle">
                            {{ round($sub->nilai_pemerintahan->where('asal_id',
                            $asal_id)->where('tahun', $tahun)->pluck('persen_data')->first()) }}
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <input type="hidden" name="sub_indikator_pemerintahan_id[]" value={{ $sub->id }}>
                            <input type="number" class="form-control text-center" style="font-size: .85rem"
                                name="nilai[]" autofocus required>
                        </td>
                    </tr>


                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-muted"><i>Petunjuk Penilaian : <br> - Nilai 0 jika data kosong, 100
                                jika
                                dokumen
                                sah,
                                tepat waktu,
                                dan sistematika telah sesuai ketentuan <br> - Seluruh Dokumen Laporan Harus disertai
                                Surat Penyampaian kepada Bupati Melalui Camat, <br> &ensp;dan LKPD disertai Surat
                                Penyampaian
                                kepada BPD</i>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="background-color: beige">
                            KESIMPULAN : (TERISI OTOMATIS SESUAI SKORING YANG DIBERIKAN)
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="bg-info">
                            <div class="form-group">
                                <label for="kesimpulan">Catatan :</label>
                                <input type="hidden" name="catatan_sementara" id="kesimpulan" autofocus>
                                <trix-editor input="kesimpulan" class="bg-white">{!! $catatan->catatan_sementara ?? ''
                                    !!}
                                </trix-editor>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="bg-info">
                            <div class="form-group">
                                <label for="saran">Saran Perbaikan Kedepan :</label>
                                <input type="hidden" name="rekom_sementara" id="saran">
                                <trix-editor input="saran" class="bg-white">{!! $catatan->rekom_sementara ?? '' !!}
                                </trix-editor>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right">
                            <button type="submit" class="btn btn-primary">Kirim Nilai</button>
                        </td>
                    </tr>
                </tfoot>

            </table>
        </form>
    </div>

</div>