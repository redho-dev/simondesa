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

                        @if($akun == "pemkeu")
                        @include('adminDesa.progress.akunPemkeu')
                        @elseif($akun == 'bumdes')
                        @include('adminDesa.progress.akunBumdes')
                        @else
                        @include('adminDesa.progress.akunPemkeu')
                        @endif

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
            $this.find(".percent_text").text("Nilai"+ "\n"+Math.round(now));
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