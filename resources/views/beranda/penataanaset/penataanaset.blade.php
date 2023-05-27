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

<div class="container">
    <div class="row">
        <div class="col">
            <section class="card card-admin">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                        <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                    </div>

                    <h2 class="card-title">Penataan Aset Desa</h2>
                </header>
                <div class="card-body">
                    <form class="form-horizontal form-bordered" action="/penataanaset/lihatpenataanaset" method="POST">
                       @csrf
                            <label class="control-label text-lg-end pt-2">Pilih Kecamatan</label>
                            <div class="col-md-12">
                                <select data-plugin-selectTwo class="form-control populate" name="kecamatan" id="kecamatanss">
                                    <option selected>---Pilih Kecamatan---</option>
                                    @foreach ($kecamatans as $kec) { ?>
                                    <option value="{{$kec->kecamatan}}">{{ $kec->kecamatan }}</option>
                                    @endforeach
                                </select>

                                <label class="control-label text-lg-end pt-2">Pilih Desa</label>
                                <select data-plugin-selectTwo class="form-control populate" name="desa" id="desa">                                
                                    <option selected value="0">---Pilih Desa---</option>
                                </select>

                                <label class="control-label text-lg-end pt-2">Pilih Tahun</label>
                                <select data-plugin-selectTwo class="form-control populate" name="tahun" id="tahun">
                                    <option value="">---Pilih Tahun---</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                </select>
                                <br>
                                <button class="btn btn-primary btn-rounded btn-px-4 btn-py-2 font-weight-bold" type="submit">Pilih</button>                                
                            </div>

					</form>
				</div>
		    </section>
                        
		</div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>

<script>
jQuery(document).ready(function(){
jQuery('#kecamatanss').change(function(){
    let kecamatan=jQuery(this).val();
    jQuery.ajax({
        url:'/getDesa',
        type:'post',
        data:'kecamatan='+kecamatan+'&_token={{ csrf_token() }}',
        success:function(result){            
            jQuery('#desa').html(result);
        }
    })
})
});
</script>

@endsection
					

