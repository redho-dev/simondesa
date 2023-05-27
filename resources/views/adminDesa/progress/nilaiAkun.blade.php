@extends('templates.desa.main')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:400,700'>
<link rel="stylesheet" href="/css/gauge.css">
<style>
    .circle_percent {
        font-size: 1rem;
        width: 7vw;
        height: 7vw;
        position: relative;
        background: #dcd2d2;
        border-radius: 50%;
        overflow: hidden;
        display: inline-block;
        margin: 0px;
        left: 0%;
        right:
    }

    .circle_inner {
        position: absolute;
        left: -20px;
        top: 0;
        width: 10vw;
        height: 10vw;
        clip: rect(0 10vw 10vw 5vw);

    }

    .round_per {
        position: absolute;
        left: 0px;
        border-top-left-radius: 80px;
        border-bottom-left-radius: 80px;
        border-right: 0;
        top: -10px;
        width: 10vw;
        height: 10vw;
        background: darkmagenta;
        clip: rect(0 10vw 10vw 5vw);
        transform: rotate(180deg);
        transition: 2s;
    }

    .percent_more .circle_inner {
        clip: rect(0 5vw 10vw 0em);
    }

    .percent_more:after {
        position: absolute;
        left: 3.5vw;
        top: 0em;
        right: 0;
        bottom: 0;
        background: darkmagenta;
        content: '';
    }

    .circle_inbox {
        position: absolute;
        top: 20px;
        left: 20px;
        right: 20px;
        bottom: 20px;
        background: #fff;
        z-index: 3;
        border-radius: 50%;
    }

    .percent_text {
        position: absolute;
        font-size: 1rem;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        z-index: 3;
    }
</style>
@endsection
@section('content')

<div class="clearfix"></div>
<!-- page content -->
<div role="main">
    <div class="">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Capaian Akuntabilitas Tahun {{ $tahun }}</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Settings 1</a>
                                    <a class="dropdown-item" href="#">Settings 2</a>
                                </div>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="row">
                            <div class="col" style="height: 500px">
                                <div class="card " style="height: 400px">
                                    <h4 class="text-info text-center mt-2">AKUNTABILITAS <br> PENYELENGGARAAN
                                        PEMERINTAHAN
                                        & KEUANGAN DESA
                                    </h4>

                                    <span id="skorP" class="d-none">{{ $akuntabilitas }}</span>
                                    <div class="gauge-container mb-0 pb-2">
                                        <div class="gauge"></div>
                                    </div>
                                    <svg width="0" height="0" version="1.1" class="gradient-mask"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <defs>
                                            <linearGradient id="gradientGauge">
                                                <stop class="color-red" offset="0%" />
                                                <stop class="color-orange" offset="30%" />
                                                <stop class="color-yellow" offset="55%" />
                                                <stop class="color-yellow" offset="75%" />
                                                <stop class="color-green" offset="90%" />
                                                <stop class="color-blue" offset="100%" />


                                            </linearGradient>
                                        </defs>
                                    </svg>
                                    <?php 
                                    
                                       if($akuntabilitas >= 0 && $akuntabilitas <=30){
                                           $predikat = "SANGAT RENDAH";
                                       }elseif($akuntabilitas > 30 && $akuntabilitas <=55){
                                           $predikat = "RENDAH";
                                       }elseif($akuntabilitas > 55 && $akuntabilitas <=75){
                                           $predikat = "CUKUP";
                                       }elseif($akuntabilitas > 75 && $akuntabilitas <=90){
                                           $predikat = "TINGGI";
                                       }elseif($akuntabilitas > 90 && $akuntabilitas <=100){
                                           $predikat = "SANGAT TINGGI";
                                       }else{
                                        $predikat = '';
                                       }          
                                   ?>
                                    <h4 class="mt-0 mb-2 text-center text-dark">Tingkat Akuntabilitas : {{
                                        $predikat
                                        }}</h4>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card" style="height: 400px">
                                    <div class="card-header" style="background-color: aquamarine">
                                        <h4 class="text-info text-center"> VARIABEL PENILAIAN AKUNTABILITAS
                                            <br>PENYELENGGARAAN PEMERINTAHAN DESA
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col text-center">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <p class="text-center" style="font-size: 1rem">Pemerintahan Desa
                                                        </p>
                                                        <p class="text-center">Bobot : 30%</p>

                                                    </div>
                                                    <div class="card-body">
                                                        <div class="circle_percent mt-0"
                                                            data-percent="{{ $nilaiPemdes ?? 0 }}">
                                                            <div class="circle_inner">
                                                                <div class="round_per"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <p class="text-center">Skor : {{ $skorPemdes }}</p>
                                                    <p class="text-center">Akuntabilitas : {{ $skorPemdes }}</p>
                                                </div>
                                            </div>
                                            <div class="col text-center">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <p class="text-center" style="font-size: 1rem">Pemerintahan Desa
                                                        </p>
                                                        <p class="text-center">Bobot : 30%</p>

                                                    </div>
                                                    <div class="card-body">
                                                        <div class="circle_percent mt-0"
                                                            data-percent="{{ $nilaiPemdes ?? 0 }}">
                                                            <div class="circle_inner">
                                                                <div class="round_per"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <p class="text-center">Skor : {{ $skorPemdes }}</p>
                                                    <p class="text-center">Akuntabilitas : {{ $skorPemdes }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>

                </div>
                <div class="row mt-3">
                    <div class="col-md-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <span class="badge badge-sm"
                                            style="display: block; height:100%; background-color:red;">&nbsp;</span>
                                    </div>
                                    <div class="col-md-10">
                                        <span class="text-4 font-weight-bold">0-30</span><br>
                                        <span>Sangat Rendah</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <span class="badge badge-sm"
                                            style="display: block; height:100%; background-color:orange;">&nbsp;</span>
                                    </div>
                                    <div class="col-md-10">
                                        <span class="text-4 font-weight-bold">31-55</span><br>
                                        <span>Rendah</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <span class="badge badge-sm"
                                            style="display: block; height:100%; background-color:yellow;">&nbsp;</span>
                                    </div>
                                    <div class="col-md-10">
                                        <span class="text-4 font-weight-bold">56-75</span><br>
                                        <span>Cukup</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <span class="badge badge-success badge-sm"
                                            style="display: block; height:100%;">&nbsp;</span>
                                    </div>
                                    <div class="col-md-10">
                                        <span class="text-4 font-weight-bold">76-90</span><br>
                                        <span>Tinggi</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card ">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <span class="badge badge-primary badge-sm"
                                            style="display: block; height:100%;">&nbsp;</span>
                                    </div>
                                    <div class="col-md-10">
                                        <span class="text-4 font-weight-bold">91-100</span><br>
                                        <span>Sangat Tinggi </span>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>



    </div>


</div>
<!-- /page content -->



@endsection
@push('script')
{{-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.2/jquery.min.js'></script> --}}
<script src='https://cdn3.devexpress.com/jslib/17.1.6/js/dx.all.js'></script>
<script src="/js/gauge.js"></script>
<script>
    $(".circle_percent").each(function() {
    var $this = $(this),
		$dataV = $this.data("percent"),
		$dataDeg = $dataV * 3.6,
		$round = $this.find(".round_per");
	$round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)");	
	$this.append('<div class="circle_inbox"><span class="percent_text"></span></div>');
	$this.prop('Counter', 0).animate({Counter: $dataV},
	{
		duration: 2000, 
		easing: 'swing', 
		step: function (now) {
            var text = $this.find(".percent_text");
            $this.find(".percent_text").text("Nilai"+ "\n"+Math.ceil(now));
        }
    });
	if($dataV >= 51){
		$round.css("transform", "rotate(" + 360 + "deg)");
		setTimeout(function(){
			$this.addClass("percent_more");
		},1000);
		setTimeout(function(){
			$round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)");
		},1000);
	} 
});

$('#keudes').on('click', function(){
    $('#keudes').addClass('alert-danger');
    $('#pemdes').removeClass('alert-danger');
    $('#bumdes').removeClass('alert-danger');

$('#row-keudes').show();
$('#row-pemdes').hide();
$('#row-bumdes').hide();


})

$('#pemdes').on('click', function(){
    $('#keudes').removeClass('alert-danger');
    $('#pemdes').addClass('alert-danger');
    $('#bumdes').removeClass('alert-danger');
    
$('#row-keudes').hide();
$('#row-pemdes').show();
$('#row-bumdes').hide();


})

$('#bumdes').on('click', function(){
    $('#keudes').removeClass('alert-danger');
    $('#pemdes').removeClass('alert-danger');
    $('#bumdes').addClass('alert-danger');
    
$('#row-keudes').hide();
$('#row-pemdes').hide();
$('#row-bumdes').show();


})



</script>
@endpush