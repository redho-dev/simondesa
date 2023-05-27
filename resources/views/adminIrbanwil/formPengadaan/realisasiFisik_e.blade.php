@extends('templates.adminIrbanwil.main')
@section('css')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
<script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
@endsection

@section('content')
@include('adminIrbanwil.cekObrik')
<div class="clearfix"></div>
<div class="row justify-content-center mt-2">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Penilaian Indikator : Pengadaan Barang dan Jasa (Pembangunan Fisik)</h5>
        <div class="x_panel">
            <div class="x_title">
                <p class="text-primary" style="font-size: 1rem">Desa {{ $desa->asal }} - Kecamatan {{ $desa->kecamatan
                    }} - Tahun Data {{ $tahun }}
                </p>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='survey' ? 'active' : '' }} {{ $perbaikanSurvey ? 'text-danger' : '' }}"
                            href="?jenis=survey&tahun={{ $tahun }}" role="tab">Survey Harga
                            <span class="fa fa-check-circle ml-1 {{ $survey ? '' : 'd-none' }}"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='realisasi' ? 'active' : '' }} {{ $perbaikanRealisasi ? 'text-danger' : '' }}"
                            href="?jenis=realisasi&tahun={{ $tahun }}" role="tab">Realisasi
                            Pembangunan Fisik
                            <span class="fa fa-check-circle ml-1 {{ $realisasi ? '' : 'd-none' }}"></span>
                        </a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane active show " id="kewilayahan" role="tabpanel"
                        aria-labelledby="kewilayahan-tab">

                        @if($jenis=='realisasi')
                        @include('adminIrbanwil.formPengadaan.formDataFisik')
                        @elseif($jenis=='survey')
                        @include('adminIrbanwil.formPengadaan.formSurveyupdate')
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
{{-- notifikasi --}}
@if(session()->has('success'))
<script>
    Swal.fire({
  position: 'center',
  icon: 'success',
  title: '{{ session("success") }}',
  showConfirmButton: false,
  timer: 1500
})
</script>

@endif

@if(session()->has('update'))
<script>
    Swal.fire({
  position: 'center',
  icon: 'success',
  title: '{{ session("update") }}',
  showConfirmButton: false,
  timer: 1500
})
</script>

@endif

@if(session()->has('fail'))
<script>
    Swal.fire({
  position: 'center',
  icon: 'error',
  title: '{{ session("fail") }}',
  showConfirmButton: false,
  timer: 1500
})
</script>

@endif

@endsection
@push('script')
<script>
    $('#pilcam').on('change', function(){
        var kecamatan = $(this).val();
        $.get('/cariDesa', {data:kecamatan}).done(function(hasil){
            $('#pildes').html("");
            $('#pildes').html(hasil);
        });

        
    })

    $('.tamNil').on('click', function(){
    //     $('.hasil_cek').hide();
        var id = $(this).attr('id');
    //    var text = "fisik_"+id;
       $('.fisik_'+id).slideToggle('slow');
    })


</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    $('.angka').mask('000.000.000.000.000', {reverse: true});

    $('.formFisik').on('submit', function(e){
        e.preventDefault();
        var tabel = $(this).attr('tabel');
        var perbaikan = $("#"+tabel).find('.perbaikan');
       

        var url = $(this).attr('action');
        $.ajax({
            'type' : 'post',
            'url' : url,
            'data' : $(this).serialize(),
            'success' : function(hasil){
                if(hasil == 'berhasil'){
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'berhasil kirim nilai',
                        showConfirmButton: false,
                        timer: 1500
                        });
                        perbaikan.remove();
                }
                location.reload();
            }
        })
    })

$('.nilaiKeg').on('change', function(){
    var idkeg = $(this).attr('idkeg');
    var nilaiKeg = $(this).val();
    $('#nilai_'+idkeg).html(nilaiKeg);
})


$(".foto_fisik").change(function(event) {
    var nfile = $(this).val();
    getURLc(this, nfile);
});

function getURLc(input, nfile) {
if (input.files && input.files[0]) {
    var reader = new FileReader();
    var filename = nfile;
      filename = filename.substring(filename.lastIndexOf('\\') + 1);
    var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    if (cekgb == 'jpg' || cekgb == 'JPG' || cekgb == 'png' || cekgb == 'PNG' || cekgb == 'jpeg' || cekgb == 'JPEG') {
        if(input.files[0]['size'] > 1024000){
            alert('ukuran file tidak boleh > 1 MB !');
            $('.foto_fisik').val("");
            $('.label_foto_fisik').html("Choose file Image (max: 1MB)");
        }else{
            
        }
        
    }else {
        alert ("file harus berjenis jpg/jpeg/png' ");
        $('.foto_fisik').val("");
        $('.label_foto_fisik').html("Choose file Image (max: 1MB)");
        
    }
    
    
}

}



</script>

@endpush