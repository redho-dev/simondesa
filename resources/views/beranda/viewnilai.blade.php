@extends('layouts.main')
@section('css')
<!-- Material Icons -->
<link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
<!-- CSS Files -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
<link id="pagestyle" href="/assets/css/material-kit.css?v=3.0.4" rel="stylesheet" />

@endsection
@section('content')
<div class="container py-4">

    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12 align-self-center p-static order-2 text-center">
            @foreach($desas as $desa)
                <h1 class="text-dark font-weight-bold text-8">Capaian Akuntabilitas Desa</h1>
                <span class="sub-title text-5 text-dark">{{ $desa->asal }}, Kecamatan {{ $desa->kecamatan }}</span>
            @endforeach

                <div class="pull-right mt-3">
                    <a class="btn btn-default" style="border: 1px solid lightgray;" href="/"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <a class="btn btn-primary"><i class="far fa-calendar"></i> Tahun 2023</a>
                </div>
            
            </div>
            
        </div>
    </div>    

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-6">
                    <div class="circular-bar">
                        <div class="circular-bar-chart" data-percent="75" data-plugin-options="{'barColor': '#0088CC'}">
                            <strong>Pemdes</strong>
                            <label class="text-5 font-weight-bold" style="margin: auto;">{{ $pemerintahan }}</label>
                        </div>
                        <span class="text-4 font-weight-bold">Penyelenggaraan Pemerintahan & Keuangan Desa</span>
                    </div>                    
                </div>

                <div class="col-lg-6">
                    <div class="circular-bar">
                        <div class="circular-bar-chart" data-percent="80" data-plugin-options="{'barColor': '#42ba96'}">
                        <strong>BUMDes</strong>
                        <label class="text-5 font-weight-bold" style="margin: auto;">80</label>
                        </div>                        
                        <span class="text-4 font-weight-bold">Pengelolaan BUMDes</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
</div>

    <section class="section border-0 p-relative bg-color-primary">
        <div class="row text-center pt-4 pb-5">
            <div class="col">
                <h2 class="font-weight-bold text-5 mb-2 text-white">Desa {{ $desa->asal }}, Kecamatan {{ $desa->kecamatan }}</h2>
                <h2 class="font-weight-bold text-10 text-white">Mendapatkan Predikat
                    @if($pemerintahan <= 30)
                    <span><i class="fa-solid fa-circle" style="color: red;"></i> Sangat Rendah</span>
                    @elseif ($pemerintahan >=31 && $pemerintahan <= 55)
                        <span><i class="fa-solid fa-circle" style="color: orange;"></i> Rendah</span>
                    @elseif ($pemerintahan >=56 && $pemerintahan <= 75)
                        <span><i class="fa-solid fa-circle" style="color: yellow;"></i> Cukup</span>
                    @elseif ($pemerintahan >=76 && $pemerintahan <= 90)
                        <span><i class="fa-solid fa-circle" style="color: #27a844;"></i> Tinggi</span>
                    @else
                        <span><i class="fa-solid fa-circle" style="color: lightskyblue;"></i> Sangat Tinggi</span>
                    @endif
                </h2>
            </div>
        </div>
    </section>
    

    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col mb-4">
                    <hr class="my-5">
                </div>
            </div>
            
            <div class="row col-md-12">

                <div class="col-md-4">
                    <h4>Pemerintahan Desa</h4>
                    @foreach($aspeks as $as)
                        @foreach($as->indikator as $ind)                        
                            <div class="accordion" id="accordionPrimary">
                                @if ($ind->id == 1)
                                <div class="card card-default">
                                    <div class="card-header bg-color-primary" id="collapsePrimaryHeadingOne">
                                        <h4 class="card-title m-0">
                                            <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                {{ $ind->indikator }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="collapsePrimaryHeadingOne" data-bs-parent="#accordionPrimary">
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <div class="progress-bars mt-2">                                                                
                                                    @foreach ($ind->sub_indikator_pemerintahan as $sub)
                                                        @if ($sub->id == 1)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 2)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 3)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-tertiary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 4)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-quaternary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 5)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach                                                                        

                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @elseif ($ind->id == 2)
                                <div class="card card-default">
                                    <div class="card-header bg-color-primary" id="collapsePrimaryHeadingTwo">
                                        <h4 class="card-title m-0">
                                            <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                {{ $ind->indikator }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="collapsePrimaryHeadingTwo" data-bs-parent="#accordionPrimary">
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <div class="progress-bars mt-2">
                                                    @foreach ($ind->sub_indikator_pemerintahan as $sub)
                                                        @if ($sub->id == 6)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 7)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                {{$sub->nilai_pemerintahan->where('asal_id',
                                                                $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                        @elseif ($sub->id == 8)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-tertiary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                {{$sub->nilai_pemerintahan->where('asal_id',
                                                                $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                        @elseif ($sub->id == 9)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-quaternary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                {{$sub->nilai_pemerintahan->where('asal_id',
                                                                $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                        @elseif ($sub->id == 10)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                {{$sub->nilai_pemerintahan->where('asal_id',
                                                                $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                        @elseif ($sub->id == 11)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                {{$sub->nilai_pemerintahan->where('asal_id',
                                                                $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                        @endif
                                                    @endforeach
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @elseif ($ind->id == 3)
                                <div class="card card-default">
                                    <div class="card-header bg-color-primary" id="collapsePrimaryHeadingThree">
                                        <h4 class="card-title m-0">
                                            <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                {{ $ind->indikator }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="collapsePrimaryHeadingThree" data-bs-parent="#accordionPrimary">
                                        <div class="card-body">
                                            <div class="card-body">
                                                <div class="col-lg-12">
                                                    <div class="progress-bars mt-2">

                                                        @foreach ($ind->sub_indikator_pemerintahan as $sub)
                                                            @if ($sub->id == 12)
                                                                <div class="progress-label">
                                                                    <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                                </div>
                                                                <div class="progress mb-2">
                                                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                        {{$sub->nilai_pemerintahan->where('asal_id',
                                                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                    </div>
                                                                </div>
                                                            @elseif ($sub->id == 13)
                                                                <div class="progress-label">
                                                                    <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                                </div>
                                                                <div class="progress mb-2">
                                                                    <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                        {{$sub->nilai_pemerintahan->where('asal_id',
                                                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                    </div>
                                                                </div>
                                                            @elseif ($sub->id == 14)
                                                                <div class="progress-label">
                                                                    <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                                </div>
                                                                <div class="progress mb-2">
                                                                    <div class="progress-bar progress-bar-tertiary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                        {{$sub->nilai_pemerintahan->where('asal_id',
                                                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                    </div>
                                                                </div>
                                                            @elseif ($sub->id == 15)
                                                                <div class="progress-label">
                                                                    <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                                </div>
                                                                <div class="progress mb-2">
                                                                    <div class="progress-bar progress-bar-quaternary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                        {{$sub->nilai_pemerintahan->where('asal_id',
                                                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                    </div>
                                                                </div>
                                                            @elseif ($sub->id == 16)
                                                                <div class="progress-label">
                                                                    <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                                </div>
                                                                <div class="progress mb-2">
                                                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                        {{$sub->nilai_pemerintahan->where('asal_id',
                                                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                    </div>
                                                                </div>
                                                            @elseif ($sub->id == 17)
                                                                <div class="progress-label">
                                                                    <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                                </div>
                                                                <div class="progress mb-2">
                                                                    <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                        {{$sub->nilai_pemerintahan->where('asal_id',
                                                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                    </div>
                                                                </div>
                                                            @elseif ($sub->id == 18)
                                                                <div class="progress-label">
                                                                    <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                                </div>
                                                                <div class="progress mb-2">
                                                                    <div class="progress-bar progress-bar-tertiary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                        {{$sub->nilai_pemerintahan->where('asal_id',
                                                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                    </div>
                                                                </div>
                                                            @elseif ($sub->id == 19)
                                                                <div class="progress-label">
                                                                    <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                                </div>
                                                                <div class="progress mb-2">
                                                                    <div class="progress-bar progress-bar-quaternary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                        {{$sub->nilai_pemerintahan->where('asal_id',
                                                                        $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach                                                                                                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @elseif ($ind->id == 4)
                                <div class="card card-default">
                                    <div class="card-header bg-color-primary" id="collapsePrimaryHeadingFour">
                                        <h4 class="card-title m-0">
                                            <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#collapsFour" aria-expanded="false" aria-controls="collapsFour">
                                                {{ $ind->indikator }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapsFour" class="collapse" aria-labelledby="collapsePrimaryHeadingFour" data-bs-parent="#accordionPrimary">
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <div class="progress-bars mt-2">
                                                    @foreach ($ind->sub_indikator_pemerintahan as $sub)
                                                        @if ($sub->id == 20)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 21)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 22)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-tertiary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 23)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-quaternary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 24)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 25)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 26)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-tertiary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 27)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-quaternary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 28)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 29)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 30)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-tertiary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 31)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-quaternary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 32)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 33)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach                                                                                                                               
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @elseif ($ind->id == 5)
                                <div class="card card-default">
                                    <div class="card-header bg-color-primary" id="collapsePrimaryHeadingFive">
                                        <h4 class="card-title m-0">
                                            <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#collapsFive" aria-expanded="false" aria-controls="collapsFive">
                                                {{ $ind->indikator }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapsFive" class="collapse" aria-labelledby="collapsePrimaryHeadingFive" data-bs-parent="#accordionPrimary">
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <div class="progress-bars mt-2">
                                                    @foreach ($ind->sub_indikator_pemerintahan as $sub)
                                                        @if ($sub->id == 34)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 35)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 36)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-tertiary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 37)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-quaternary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 38)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach                                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @elseif ($ind->id == 6)
                                <div class="card card-default">
                                    <div class="card-header bg-color-primary" id="collapsePrimaryHeadingSix">
                                        <h4 class="card-title m-0">
                                            <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#collapsSix" aria-expanded="false" aria-controls="collapsSix">
                                                {{ $ind->indikator }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapsSix" class="collapse" aria-labelledby="collapsePrimaryHeadingSix" data-bs-parent="#accordionPrimary">
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <div class="progress-bars mt-2">
                                                    @foreach ($ind->sub_indikator_pemerintahan as $sub)
                                                        @if ($sub->id == 39)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 40)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 41)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-tertiary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 42)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-quaternary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @elseif ($sub->id == 43)
                                                            <div class="progress-label">
                                                                <span class="text-1">{{ $sub->sub_indikator }}</span>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">
                                                                    {{$sub->nilai_pemerintahan->where('asal_id',
                                                                    $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach                                                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>                        
                        @endforeach
                    @endforeach
                </div>                                                      

                <div class="col-md-4">
                    <h4>Keuangan Desa</h4>
                    @foreach($aspekeu as $ask)
                        @foreach($ask->indikator as $indk)
                        <div class="accordion" id="accordionSecondary">
                            @if ($indk->id == 7)                            
                            <div class="card card-default">
                                <div class="card-header bg-color-secondary" id="collapseSecondaryHeadingOne">
                                    <h4 class="card-title m-0">
                                        <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#collapseSecondaryOne" aria-expanded="true" aria-controls="collapseSecondaryOne">
                                            {{ $indk->indikator }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSecondaryOne" class="collapse show" aria-labelledby="collapseSecondaryHeadingOne" data-bs-parent="#accordionSecondary">
                                    <div class="card-body">                                        
                                        <div class="col-lg-12">
                                            <div class="progress-bars mt-2">
                                                @foreach ($indk->sub_indikator_keuangan as $subk)
                                                    @if ($subk->id == 1)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $subk->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">                                                                
                                                                {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                    @elseif ($subk->id == 2)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $subk->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">                                                                
                                                                {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                    @endif                                                                                                    
                                                @endforeach
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            @elseif ($indk->id == 8)
                            <div class="card card-default">
                                <div class="card-header bg-color-secondary" id="collapseSecondaryHeadingTwo">
                                    <h4 class="card-title m-0">
                                        <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#collapseSecondaryTwo" aria-expanded="false" aria-controls="collapseSecondaryTwo">
                                            {{ $indk->indikator }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSecondaryTwo" class="collapse" aria-labelledby="collapseSecondaryHeadingTwo" data-bs-parent="#accordionSecondary">
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <div class="progress-bars mt-2">
                                                @foreach ($indk->sub_indikator_keuangan as $subk)
                                                    @if ($subk->id == 3)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $subk->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">                                                                
                                                                {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                    @elseif ($subk->id == 4)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $subk->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">                                                                
                                                                {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                    @elseif ($subk->id == 5)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $subk->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-tertiary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">                                                                
                                                                {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                    @elseif ($subk->id == 6)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $subk->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-quaternary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">                                                                
                                                                {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @elseif ($indk->id == 9)
                            <div class="card card-default">
                                <div class="card-header bg-color-secondary" id="collapseSecondaryHeadingThree">
                                    <h4 class="card-title m-0">
                                        <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#collapseSecondaryThree" aria-expanded="false" aria-controls="collapseSecondaryThree">
                                            {{ $indk->indikator }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSecondaryThree" class="collapse" aria-labelledby="collapseSecondaryHeadingThree" data-bs-parent="#accordionSecondary">
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <div class="progress-bars mt-2">
                                                @foreach ($indk->sub_indikator_keuangan as $subk)
                                                    @if ($subk->id == 7)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $subk->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">                                                                
                                                                {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                    @elseif ($subk->id == 8)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $subk->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">                                                                
                                                                {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @elseif ($indk->id == 10)
                            <div class="card card-default">
                                <div class="card-header bg-color-secondary" id="collapseSecondaryHeadingFour">
                                    <h4 class="card-title m-0">
                                        <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#collapseSecondaryFour" aria-expanded="false" aria-controls="collapseSecondaryFour">
                                            {{ $indk->indikator }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSecondaryFour" class="collapse" aria-labelledby="collapseSecondaryHeadingFour" data-bs-parent="#accordionSecondary">
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <div class="progress-bars mt-2">
                                                @foreach ($indk->sub_indikator_keuangan as $subk)
                                                    @if ($subk->id == 9)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $subk->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">                                                                
                                                                {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                    @elseif ($subk->id == 10)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $subk->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">                                                                
                                                                {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                    @elseif ($subk->id == 11)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $subk->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-tertiary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">                                                                
                                                                {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @elseif ($indk->id == 11)
                            <div class="card card-default">
                                <div class="card-header bg-color-secondary" id="collapseSecondaryHeadingFive">
                                    <h4 class="card-title m-0">
                                        <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#collapseSecondaryFive" aria-expanded="false" aria-controls="collapseSecondaryFive">
                                            {{ $indk->indikator }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSecondaryFive" class="collapse" aria-labelledby="collapseSecondaryHeadingFive" data-bs-parent="#accordionSecondary">
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <div class="progress-bars mt-2">
                                                @foreach ($indk->sub_indikator_keuangan as $subk)
                                                    @if ($subk->id == 12)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $subk->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">                                                                
                                                                {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                    @elseif ($subk->id == 13)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $subk->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">                                                                
                                                                {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                    @elseif ($subk->id == 14)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $subk->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-tertiary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">                                                                
                                                                {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                    @elseif ($subk->id == 15)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $subk->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-quaternary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">                                                                
                                                                {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @elseif ($indk->id == 12)
                            <div class="card card-default">
                                <div class="card-header bg-color-secondary" id="collapseSecondaryHeadingSix">
                                    <h4 class="card-title m-0">
                                        <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#collapseSecondarySix" aria-expanded="false" aria-controls="collapseSecondarySix">
                                            {{ $indk->indikator }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSecondarySix" class="collapse" aria-labelledby="collapseSecondaryHeadingSix" data-bs-parent="#accordionSecondary">
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <div class="progress-bars mt-2">
                                                @foreach ($indk->sub_indikator_keuangan as $subk)
                                                    @if ($subk->id == 16)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $subk->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">                                                                
                                                                {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                    @elseif ($subk->id == 17)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $subk->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">                                                                
                                                                {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                    @elseif ($subk->id == 18)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $subk->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-tertiary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">                                                                
                                                                {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                    @elseif ($subk->id == 19)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $subk->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-quaternary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">                                                                
                                                                {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @elseif ($indk->id == 13)
                            <div class="card card-default">
                                <div class="card-header bg-color-secondary" id="collapseSecondaryHeadingSeven">
                                    <h4 class="card-title m-0">
                                        <a class="accordion-toggle text-color-light" data-bs-toggle="collapse" data-bs-target="#collapseSecondarySeven" aria-expanded="false" aria-controls="collapseSecondarySeven">
                                            {{ $indk->indikator }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSecondarySeven" class="collapse" aria-labelledby="collapseSecondaryHeadingSeven" data-bs-parent="#accordionSecondary">
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <div class="progress-bars mt-2">
                                                @foreach ($indk->sub_indikator_keuangan as $subk)
                                                    @if ($subk->id == 20)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $subk->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">                                                                
                                                                {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                    @elseif ($subk->id == 21)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $subk->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">                                                                
                                                                {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>
                                                    @elseif ($subk->id == 22)
                                                        <div class="progress-label">
                                                            <span class="text-1">{{ $subk->sub_indikator }}</span>
                                                        </div>
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar progress-bar-tertiary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}%;">                                                                
                                                                {{$subk->nilai_keuangan->where('asal_id', $asal_id)->where('tahun', $tahun)->pluck('nilai_sementara')->first()}}
                                                            </div>
                                                        </div>                                                    
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    @endforeach
                </div>                                    
            </div>   
        </div>   
    </div>
</div>



@endsection