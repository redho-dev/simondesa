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
        <h5 class="alert alert-info">Penilaian Indikator : Penataan Aset (Buku Inventaris Aset)</h5>
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
                        <a class="nav-link active" href="" role="tab">Buku Inventaris Aset Desa
                            <span class="fa fa-check-circle ml-1 {{ $jumset > 0 ? '' : 'd-none' }}"></span>
                        </a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane active show " id="aset" role="tabpanel" aria-labelledby="aset-tab">

                        <h4 class="text-center text-dark mt-4">BUKU INVENTARIS ASET DESA <br> PEMERINTAH DESA {{
                            strtoupper($infos->asal->asal) }} <br>TAHUN {{ $tahun }}</h4>

                        <table class="table table-bordered">
                            <thead class="table-secondary">
                                <tr>
                                    <th rowspan="2" style="vertical-align: middle
                                " class="text-center">NUP</th>
                                    <th rowspan="2" style="vertical-align: middle
                                " class="text-center">Jenis/Nama Barang</th>
                                    <th rowspan="2" style="vertical-align: middle
                                " class="text-center">Kode Barang</th>
                                    <th rowspan="2" style="vertical-align: middle
                                " class="text-center">Identitas Barang</th>
                                    <th colspan="3" style="vertical-align: middle
                                " class="text-center">Asal-usul Barang</th>
                                    <th rowspan="2" style="vertical-align: middle
                                " class="text-center">Tahun Perolehan</th>
                                    <th class="text-center" rowspan="2" style="vertical-align: middle
                                " class="text-center">Nilai Perolehan <br>(Rp)</th>
                                    <th rowspan="2" style="vertical-align: middle
                                " class="text-center">Ket</th>
                                </tr>
                                <tr>

                                    <td class="text-center">APB Desa</td>
                                    <td class="text-center">Perolehan Lain yg Sah</td>
                                    <td class="text-center">Kekayan Asli Desa</td>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($asets as $aset)
                                @php
                                if ($aset->jenis == 'tanah') {
                                $identitas = $aset->lokasi. "- LT: $aset->luas_merk M2";

                                }elseif($aset->jenis == 'gedung'){
                                $identitas = $aset->lokasi. "- LB: $aset->luas_merk M2";
                                }elseif($aset->jenis == 'jalan'){
                                $identitas = $aset->luas_merk . "- P: $aset->panjang M, L: $aset->lebar M";
                                }else{
                                $identitas = $aset->luas_merk;
                                }
                                @endphp
                                <tr>
                                    <td>{{ $aset->nup }}</td>
                                    <td>{{ $aset->nama_barang }}</td>
                                    <td>{{ $aset->kode_barang }}</td>
                                    <td>{{ $identitas }}</td>
                                    <td class="text-center">
                                        <i class="fa fa-check {{ $aset->asal_usul == 'APB Desa' ? '' : 'd-none' }}"></i>
                                    </td>
                                    <td class="text-center">
                                        <i
                                            class="fa fa-check {{ $aset->asal_usul == 'Perolehan Lain yang Sah' ? '' : 'd-none' }}"></i>
                                    </td>
                                    <td class="text-center">
                                        <i
                                            class="fa fa-check {{ $aset->asal_usul == 'Aset Asli Desa' ? '' : 'd-none' }}"></i>
                                    </td>
                                    <td class="text-center">{{ $aset->tahun_perolehan }}</td>
                                    <td class="nilai">{{ $aset->nilai_perolehan }}</td>
                                    <td>{{ $aset->keterangan }}</td>
                                </tr>
                                @endforeach
                                <tr class="table-info">
                                    <td colspan="8" class="text-center">TOTAL NILAI PEROLEHAN ASET </td>
                                    <td class="total"></td>
                                    <td></td>
                                </tr>
                            </tbody>

                        </table>


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
  position: 'top-end',
  icon: 'success',
  title: '{{ session("update") }}',
  showConfirmButton: false,
  timer: 1500
})
</script>

@endif

@endsection
@push('script')
<script src="/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<script>
    $('.angka').mask('000.000.000.000.000', {reverse: true});

    var jumnilai = $('.nilai').length;
    var total = 0;
    for(let i=0; i<jumnilai; i++){
        var nilai = $('.nilai').eq(i).html();
            nilai = nilai.replaceAll('.', '');
            nilai = Number(nilai);
        total += nilai;
        
    }
    $('.total').html(total);
    $('.total').mask('000.000.000.000.000', {reverse: true});
</script>

<script>
    $('#pilcam').on('change', function(){
        var kecamatan = $(this).val();
        $.get('/cariDesa', {data:kecamatan}).done(function(hasil){
            $('#pildes').html("");
            $('#pildes').html(hasil);
        });

        
    })

</script>
@endpush