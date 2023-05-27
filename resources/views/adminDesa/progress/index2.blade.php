@extends('templates.desa.main')
@section('css')

@endsection
@section('content')
<div class="clearfix"></div>
<br>
<div class="row">
    <div class="col-md-8">
        <table class="table table-bordered table-striped">
            <tr class="bg-info">
                <th class="text-center" width="5%">No</th>
                <th class="text-center" width="45%">Variabel/Indikator</th>
                <th class="text-center" width="15%">Bobot</th>
                <th class="text-center" width="35%">Progress Data</th>
            </tr>
            <?php $char = range('A', 'Z'); $i=0; ?>
            @foreach($aspeks as $asp)
            <tr class="bg-secondary">
                <td class="text-center">{{ $char[$i] }}</td>
                <td>{{ strtoupper($asp->aspek) }}</td>
                <td class="text-center">{{ $asp->bobot }}</td>
                <td class="text-center">
                    @if($asp->sub_indikator_pemerintahan->count() != 0)
                    {{ round($asp->nilai_pemerintahan->where('asal_id', $asal_id)->where('aspek_id',
                    $asp->id)->where('tahun', $tahun)->pluck('persen_data')->sum()
                    /$asp->sub_indikator_pemerintahan->count(),2) . '%' }}
                    @endif

                    @if($asp->sub_indikator_keuangan->count() != 0)
                    {{ round($asp->nilai_keuangan->where('asal_id', $asal_id)->where('aspek_id',
                    $asp->id)->where('tahun', $tahun)->pluck('persen_data')->sum()
                    /$asp->sub_indikator_keuangan->count(),2) . '%' }}
                    @endif

                    {{-- {{ $asp->sub_indikator_pemerintahan->count() }} --}}
                    {{-- {{ $asp->nilai_pemerintahan->where('asal_id', $asal_id)->where('aspek_id',
                    $asp->id)->pluck('persen_data')->sum() }} --}}
                </td>
            </tr>
            @foreach($asp->indikator as $ind)
            <tr>
                <td></td>
                <td>{{ $loop->iteration}}.&ensp;{{ $ind->indikator }}</td>
                <td class="text-center">{{ $ind->bobot }}</td>
                <td class="text-center">
                    @if($ind->sub_indikator_pemerintahan->count() != 0)
                    {{ round($ind->nilai_pemerintahan->where('asal_id', $asal_id)->where('indikator_id',
                    $ind->id)->where('tahun', $tahun)->pluck('persen_data')->sum()
                    /$ind->sub_indikator_pemerintahan->count(),2) . '%' }}
                    @endif

                    @if($ind->sub_indikator_keuangan->count() != 0)
                    {{ round($ind->nilai_keuangan->where('asal_id', $asal_id)->where('indikator_id',
                    $ind->id)->where('tahun', $tahun)->pluck('persen_data')->sum()
                    /$ind->sub_indikator_keuangan->count(),2). '%' }}
                    @endif
                </td>
            </tr>
            @foreach($rekapNP as $rek)

            @if($rek->indikator_id == $ind->id)

            <tr>
                <td></td>
                <td class="pl-4">-&ensp;{{ $rek->sub_indikator_pemerintahan->sub_indikator }}</td>
                <td class="text-center">{{ $rek->sub_indikator_pemerintahan->bobot }}</td>
                <td>
                    <div class="progress progress_sm mb-1 ">
                        <div class="progress-bar bg-green" role="progressbar"
                            data-transitiongoal="{{ $rek->persen_data }}">
                        </div>
                    </div>
                    <small style="font-size: .7rem">{{ round($rek->persen_data) ?? 0 }}% Complete</small>
                </td>
            </tr>

            @endif
            @endforeach

            @foreach($rekapNK as $reku)

            @if($reku->indikator_id == $ind->id)

            <tr>
                <td></td>
                <td class="pl-4">-&ensp;{{ $reku->sub_indikator_keuangan->sub_indikator }}</td>
                <td class="text-center">{{ $reku->sub_indikator_keuangan->bobot }}</td>
                <td>
                    <div class="progress progress_sm mb-1 ">
                        <div class="progress-bar bg-green" role="progressbar"
                            data-transitiongoal="{{ $reku->persen_data }}">
                        </div>
                    </div>
                    <small style="font-size: .7rem">{{ round($reku->persen_data) ?? 0 }}% Complete</small>
                </td>
            </tr>

            @endif
            @endforeach



            @endforeach
            <?php $i++; ?>
            @endforeach
        </table>
    </div>
</div>


<br><br>

@endsection
@push('script')
<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>


@endpush