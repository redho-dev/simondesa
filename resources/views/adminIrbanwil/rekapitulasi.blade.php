@extends('templates.adminIrbanwil.main')

@section('content')

<h4>Rekapitulasi Skor Akuntabilitas </h4>
<div class="form-row">
    <div class="col">
        <button class="btn btn-primary pemdes">Peny Pemerintahan & Keuangan Desa</button>
        <button class="btn btn-secondary bumdes">Pengelolaan BUM Desa</button>

    </div>
</div>
<div class="row" id="akunPemdes">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <h5 class="text-center">Skor Akuntabilitas Pemerintahan dan Keuangan Desa Tahun {{ $tahun }}
                            </h5>
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead style="background-color: lightsteelblue">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Desa</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Pemerintahan Desa</th>
                                        <th>Keuangan Desa</th>
                                        <th>Total Skor</th>
                                        <th>Predikat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($asals as $ds)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ds->asal }}</td>
                                        <td>{{ $ds->kecamatan }}</td>
                                        @foreach($aspeks as $as)
                                        <?php $pemdes = $as->rekap_nilai_aspek->where('asal_id', $ds->id)->where('tahun',
                                                $tahun)->where('aspek_id', $as->id)->pluck('skor')->first(); ?>
                                        <td>{{ $pemdes }}</td>
                                        @endforeach
                                        @foreach($aspekeu as $ask)
                                        <?php $keudes = $ask->rekap_nilai_aspek->where('asal_id', $ds->id)->where('tahun',
                                            $tahun)->where('aspek_id', 2)->pluck('skor')->first(); ?>
                                        <td>{{ $keudes }}</td>
                                        @endforeach
                                        <td class="text-center">{{ $total = $pemdes + $keudes }}</td>
                                        <td>
                                            <?php 
                                           
                                               if($total > 0 && $total <=30){
                                                   $kesimpulan = "Sangat Rendah";
                                               }elseif($total > 30 && $total <=55){
                                                   $kesimpulan = "Rendah";
                                               }elseif($total > 55 && $total <=75){
                                                   $kesimpulan = "Cukup";
                                               }elseif($total > 75 && $total <=90){
                                                   $kesimpulan = "Tinggi";
                                               }elseif($total > 90 && $total <=100){
                                                   $kesimpulan = "Sangat Tinggi";
                                               }else{
                                                $kesimpulan = "";
                                               }          
                                           ?>
                                            {{ $kesimpulan }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" id="akunBumdes" style="display: none">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <h5 class="text-center">Skor Akuntabilitas BUM Desa Tahun {{ $tahun }}</h5>
                            <table id="databumdes" class="table table-striped table-bordered" style="width:100%">
                                <thead style="background-color: lightsteelblue">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Desa</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Total Skor</th>
                                        <th>Predikat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($asals as $ds)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ds->asal }}</td>
                                        <td>{{ $ds->kecamatan }}</td>

                                        <td>
                                            {{ $tobum = $ds->nilai_bumd->where('tahun', $tahun)->pluck('skor')->sum() }}
                                        </td>
                                        <td>
                                            <?php 
                                           
                                               if($tobum > 0 && $tobum <=30){
                                                   $akunbumdes = "Sangat Rendah";
                                               }elseif($tobum > 30 && $tobum <=55){
                                                   $akunbumdes = "Rendah";
                                               }elseif($tobum > 55 && $tobum <=75){
                                                   $akunbumdes = "Cukup";
                                               }elseif($tobum > 75 && $tobum <=90){
                                                   $akunbumdes = "Tinggi";
                                               }elseif($tobum > 90 && $tobum <=100){
                                                   $akunbumdes = "Sangat Tinggi";
                                               }else{
                                                $akunbumdes = "";
                                               }  
                                                     
                                           ?>
                                            {{ $akunbumdes }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>

<script>
    $(document).ready(function () {
    $('#datatable').DataTable({
        scrollX: true,
    });
    $('#databumdes').DataTable();
});
</script>



@if(session()->has('fail'))
<script>
    Swal.fire({
  position: 'center',
  icon: 'error',
  title: '{{ session("fail") }}',
  showConfirmButton: true
  
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

    $('.pemdes').on('click', function(){
        $('.pemdes').toggleClass('btn-primary');
        $('.pemdes').toggleClass('btn-secondary');
        $('.bumdes').toggleClass('btn-secondary');
        $('.bumdes').toggleClass('btn-primary');
        $('#akunPemdes').toggle();
        $('#akunBumdes').toggle();
    })
    $('.bumdes').on('click', function(){
        $('.pemdes').toggleClass('btn-primary');
        $('.pemdes').toggleClass('btn-secondary');
        $('.bumdes').toggleClass('btn-secondary');
        $('.bumdes').toggleClass('btn-primary');
        $('#akunPemdes').toggle();
        $('#akunBumdes').toggle();
    })

</script>
@endpush