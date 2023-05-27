@extends('templates.desa.main')
@section('css')
<style>
    .circle_percent {
        font-size: 1rem;
        width: 10vw;
        height: 10vw;
        position: relative;
        background: #eee;
        border-radius: 50%;
        overflow: hidden;
        display: inline-block;
        margin: 20px;
        left: 15%;
        right:
    }

    .circle_inner {
        position: absolute;
        left: 0;
        top: 0;
        width: 10vw;
        height: 10vw;
        clip: rect(0 10vw 10vw 5vw);
    }

    .round_per {
        position: absolute;
        left: 0;
        top: 0;
        width: 10vw;
        height: 10vw;
        background: blue;
        clip: rect(0 10vw 10vw 5vw);
        transform: rotate(180deg);
        transition: 1.05s;
    }

    .percent_more .circle_inner {
        clip: rect(0 5vw 10vw 0em);
    }

    .percent_more:after {
        position: absolute;
        left: 5vw;
        top: 0em;
        right: 0;
        bottom: 0;
        background: blue;
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
        font-size: 1.5rem;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        z-index: 3;
    }
</style>
@endsection
@section('content')
<div class="clearfix"></div>
<br>
<div class="row">
    <div class="col-md-3 ">
        <div class="card">
            <h6 class="py-1 text-center">Data Monografi</h6>
            <div class="circle_percent mt-0 " data-percent="0.5">
                <div class="circle_inner ">
                    <div class="round_per"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 ">
        <div class="card">
            <h6 class="py-1 text-center">Data Perangkat</h6>
            <div class="circle_percent mt-0" data-percent="25">
                <div class="circle_inner">
                    <div class="round_per"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 ">
        <div class="card">
            <h6 class="py-1 text-center">Data Kadus & RT</h6>
            <div class="circle_percent mt-0" data-percent="100">
                <div class="circle_inner">
                    <div class="round_per"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 ">
        <div class="card">
            <h6 class="py-1 text-center">Data BPD</h6>
            <div class="circle_percent mt-0" data-percent="77">
                <div class="circle_inner">
                    <div class="round_per"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
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
            $this.find(".percent_text").text(Math.ceil(now)+"%");
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

</script>
@endpush