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
        <h5 class="alert alert-info">Penilaian Indikator : Kontribusi PADes</h5>
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
                        <a class="nav-link active" href="" role="tab">Kontribusi PADes
                            <span class="fa fa-check-circle ml-1 {{ $pad == 0 ? 'd-none' : '' }}"></span>
                        </a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane active show " id="dalap" role="tabpanel" aria-labelledby="dalap-tab">

                        <div class="row">
                            <div class="col-md-6">

                                <div>


                                    <table class="table table-bordered mt-2">
                                        <tr class="table-info">
                                            <th>No</th>
                                            <th>Uraian</th>
                                            <th>Tahun</th>
                                            <th>Jumlah (Rp)</th>
                                            <th class="text-center">Bukti Setor</th>

                                        </tr>
                                        @foreach ($datas as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ substr($data->nama_data, 0, 9) }}</td>
                                            <td>{{ substr($data->nama_data, 16, 4) }}</td>
                                            <td>{{ substr($data->nama_data, 24) }}</td>
                                            <td class="text-center">
                                                <a href="{{ asset('storage/'.$data->isi_data) }}" target="_blank"><img
                                                        src="{{ asset('/img/logo-pdf.jpg') }}" width="50px"></a>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>


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
</script>

@endpush