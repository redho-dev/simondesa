<div class="row">
    <div class="col">
        <div class="isi">
            <div class="nav mt-2 ml-4">
                <ul class="nav nav-pills card-header-pills ">
                    <li class="nav-item">

                        <p class="text-primary" style="font-size: 1rem">Rekap Data dan Penilaian </br> Kecamatan {{
                            $pilcam }} ; Desa {{ $pildes
                            }} ; Tahun {{ $tahun }}</p>
                    </li>

                </ul>

            </div>

            <div class="x_content">
                <div class="row">
                    <div class="col-md-8">
                        {{-- VARIABEL PEMERINTAHAN DESA --}}
                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-info">
                                    <th style="vertical-align: middle">Kode</th>
                                    <th style="vertical-align: middle">Aspek/Indikator/Sub Indikator</th>
                                    <th class="text-center" style="vertical-align: middle">bobot <br>(%)</th>
                                    <th class="text-center" style="vertical-align: middle">Keterisian Data <br>(%)</th>
                                    <th class="text-center" style="vertical-align: middle">Nilai <br>(%)</th>
                                    <th class="text-center" style="vertical-align: middle">Status Penilaian</th>
                                    <th class="text-center" style="vertical-align: middle">Skor</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach($aspeks as $as)
                                <tr class="bg-secondary ">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ strtoupper($as->aspek) }}</td>
                                    <td class="text-center">{{ $as->bobot }}</td>
                                    <td class="text-center">
                                        {{ $as->rekap_nilai_aspek->where('asal_id', $asal_id)->where('tahun',
                                        $tahun)->where('aspek_id', $as->id)->pluck('persen_data')->first() }}
                                    </td>
                                    <td class="text-center">
                                        {{ $as->rekap_nilai_aspek->where('asal_id', $asal_id)->where('tahun',
                                        $tahun)->where('aspek_id', $as->id)->pluck('nilai')->first() }}
                                    </td>
                                    <td></td>
                                    <td>
                                        {{ $as->rekap_nilai_aspek->where('asal_id', $asal_id)->where('tahun',
                                        $tahun)->where('aspek_id', $as->id)->pluck('skor')->first() }}
                                    </td>
                                    </td>
                                </tr>
                                <?php $i=0; $char = range('a','z'); ?>
                                @foreach($as->indikator as $ind)
                                <tr class="bg-light">
                                    <td class="pl-4">{{ $char[$i] }}</td>
                                    <td class="pl-4">{{ $ind->indikator }}</td>
                                    <td class="text-center">{{ $ind->bobot }}</td>
                                    <td class="text-center">{{
                                        $ind->rekap_nilai_indikator->where('asal_id', $asal_id)->where('tahun',
                                        $tahun)->where('indikator_id', $ind->id)->pluck('persen_data')->first()
                                        }}
                                    </td>
                                    <td class="text-center">
                                        {{ $ind->rekap_nilai_indikator->where('asal_id', $asal_id)->where('tahun',
                                        $tahun)->where('indikator_id', $ind->id)->pluck('nilai')->first() }}
                                    </td>
                                    <td></td>
                                    <td>
                                        {{ $ind->rekap_nilai_indikator->where('asal_id', $asal_id)->where('tahun',
                                        $tahun)->where('indikator_id', $ind->id)->pluck('skor')->first() }}
                                    </td>
                                </tr>
                                <?php $i++; ?>
                                @foreach ($ind->sub_indikator_pemerintahan as $sub)
                                <tr>
                                    <td></td>
                                    <td class="pl-4">{{ $loop->iteration."). ".$sub->sub_indikator }}</td>
                                    <td class="text-center">{{ $sub->bobot }}</td>
                                    <td class="text-center">
                                        {{
                                        $sub->nilai_pemerintahan->where('asal_id',
                                        $asal_id)->where('tahun', $tahun)->pluck('persen_data')->first() ?? 0
                                        }}
                                    </td>
                                    <td class="text-center">
                                        {{-- @if( $sub->nilai_pemerintahan->where('asal_id',
                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first())
                                        {{ $sub->nilai_pemerintahan->where('asal_id',
                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()
                                        }}
                                        @else
                                        <p class="text-danger">NULL</p>
                                        @endif --}}

                                        {{$sub->nilai_pemerintahan->where('asal_id',
                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}

                                    </td>
                                    <td class="text-center">
                                        @if($sub->nilai_pemerintahan->where('asal_id',
                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first() !== null &&
                                        $sub->nilai_pemerintahan->where('asal_id',
                                        $asal_id)->where('tahun', $tahun)->pluck('perbaikan')->first()== false)
                                        <p class="text-primary">sudah dinilai</p>



                                        @elseif($sub->nilai_pemerintahan->where('asal_id',
                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first() !== null &&
                                        $sub->nilai_pemerintahan->where('asal_id',
                                        $asal_id)->where('tahun', $tahun)->pluck('perbaikan')->first()== true)
                                        <p class="text-danger">belum dinilai ulang</p>
                                        @else
                                        <p class="text-danger">belum dinilai</p>

                                        @endif

                                    </td>
                                    <td>{{ $sub->nilai_pemerintahan->where('asal_id',
                                        $asal_id)->where('tahun', $tahun)->pluck('skor')->first() }}</td>
                                </tr>
                                @endforeach
                                @endforeach
                                @endforeach
                            </tbody>

                        </table>
                        {{-- VARIABEL KEUANGAN DESA --}}
                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-info">
                                    <th style="vertical-align: middle">Kode</th>
                                    <th style="vertical-align: middle">Aspek/Indikator/Sub Indikator</th>
                                    <th class="text-center" style="vertical-align: middle">bobot <br>(%)</th>
                                    <th class="text-center" style="vertical-align: middle">Keterisian Data <br>(%)</th>
                                    <th class="text-center" style="vertical-align: middle">Nilai <br>(%)</th>
                                    <th class="text-center" style="vertical-align: middle">Status Penilaian</th>
                                    <th class="text-center" style="vertical-align: middle">Skor</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach($aspekeu as $ask)
                                <tr class="bg-secondary ">
                                    <td>2</td>
                                    <td>{{ strtoupper($ask->aspek) }}</td>
                                    <td class="text-center">{{ $ask->bobot }}</td>
                                    <td class="text-center">
                                        {{ $ask->rekap_nilai_aspek->where('asal_id', $asal_id)->where('tahun',
                                        $tahun)->where('aspek_id', 2)->pluck('persen_data')->first() }}
                                    </td>
                                    <td class="text-center">
                                        {{ $ask->rekap_nilai_aspek->where('asal_id', $asal_id)->where('tahun',
                                        $tahun)->where('aspek_id', 2)->pluck('nilai')->first() }}
                                    </td>
                                    <td></td>
                                    <td>
                                        {{ $ask->rekap_nilai_aspek->where('asal_id', $asal_id)->where('tahun',
                                        $tahun)->where('aspek_id', 2)->pluck('skor')->first() }}
                                    </td>
                                    </td>
                                </tr>
                                <?php $i=0; $char = range('a','z'); ?>
                                @foreach($ask->indikator as $indk)
                                <tr class="bg-light">
                                    <td class="pl-4">{{ $char[$i] }}</td>
                                    <td class="pl-4">{{ $indk->indikator }}</td>
                                    <td class="text-center">{{ $indk->bobot }}</td>
                                    <td class="text-center">{{
                                        $indk->rekap_nilai_indikator->where('asal_id', $asal_id)->where('tahun',
                                        $tahun)->where('indikator_id', $indk->id)->pluck('persen_data')->first()
                                        }}
                                    </td>
                                    <td class="text-center">
                                        {{ $indk->rekap_nilai_indikator->where('asal_id', $asal_id)->where('tahun',
                                        $tahun)->where('indikator_id', $indk->id)->pluck('nilai')->first() }}
                                    </td>
                                    <td></td>
                                    <td>
                                        {{ $indk->rekap_nilai_indikator->where('asal_id', $asal_id)->where('tahun',
                                        $tahun)->where('indikator_id', $indk->id)->pluck('skor')->first() }}
                                    </td>
                                </tr>
                                <?php $i++; ?>
                                @foreach ($indk->sub_indikator_keuangan as $subk)
                                <tr>
                                    <td></td>
                                    <td class="pl-4">{{ $loop->iteration."). ".$subk->sub_indikator }}</td>
                                    <td class="text-center">{{ $subk->bobot }}</td>
                                    <td class="text-center">
                                        {{
                                        $subk->nilai_keuangan->where('asal_id',
                                        $asal_id)->where('tahun', $tahun)->pluck('persen_data')->first() ?? 0
                                        }}
                                    </td>
                                    <td class="text-center">
                                        {{-- @if( $subk->nilai_pemerintahan->where('asal_id',
                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first())
                                        {{ $subk->nilai_pemerintahan->where('asal_id',
                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()
                                        }}
                                        @else
                                        <p class="text-danger">NULL</p>
                                        @endif --}}

                                        {{$subk->nilai_keuangan->where('asal_id',
                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}

                                    </td>
                                    <td class="text-center">
                                        @if($subk->nilai_keuangan->where('asal_id',
                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first() !== null &&
                                        $subk->nilai_keuangan->where('asal_id',
                                        $asal_id)->where('tahun', $tahun)->pluck('perbaikan')->first()== false)
                                        <p class="text-primary">sudah dinilai</p>



                                        @elseif($subk->nilai_keuangan->where('asal_id',
                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first() !== null &&
                                        $subk->nilai_keuangan->where('asal_id',
                                        $asal_id)->where('tahun', $tahun)->pluck('perbaikan')->first()== true)
                                        <p class="text-danger">belum dinilai ulang</p>
                                        @else
                                        <p class="text-danger">belum dinilai</p>

                                        @endif

                                    </td>
                                    <td>{{ $subk->nilai_keuangan->where('asal_id',
                                        $asal_id)->where('tahun', $tahun)->pluck('skor')->first() }}</td>
                                </tr>
                                @endforeach
                                @endforeach
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>