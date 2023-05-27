@extends('templates.adminIrbanwil.main')

@section('content')
<h4></h4>

<!-- page content -->
<div role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>SUSUNAN PERSONIL {{ strtoupper($infos->obrik) }}</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="x_panel">
                <div class="x_content">
                    <div class="row">
                        @foreach($dapeg as $peg)
                        <div class="col-md-4">
                            <div class="card border-primary mb-3">
                                <div class="card-header text-primary" style="font-size: 1rem">{{ $peg->name }}</div>
                                <div class="card-body text-primary">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="/foto_pegawai/{{ $peg->foto }}" class="img-circle" alt=""
                                                width="100%" style="max-height: 150px">
                                        </div>
                                        <div class="col-md-2">
                                            <p class="card-text mb-0">NIP </p>
                                            <p class="card-text mb-0">Pangkat </p>
                                            <p class="card-text mb-0">Jabatan </p>
                                            <p class="card-text mb-0">Alamat </p>
                                            <p class="card-text mb-0">Phone </p>

                                        </div>
                                        <div class="col-md-6">
                                            <p class="card-text mb-0">:&emsp; {{ $peg->username }} </p>
                                            <p class="card-text mb-0">:&emsp; {{ $peg->pangkat }} </p>
                                            <p class="card-text mb-0">:&emsp; {{ $peg->jabatan }} </p>
                                            <p class="card-text mb-0">:&emsp; Alamat </p>
                                            <p class="card-text mb-0">:&emsp; Phone </p>
                                            <button class="btn btn-sm btn-info mt-3">Kompetensi</button>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->



{{-- notifikasi --}}
@if(session()->has('success'))
<script>
    Swal.fire({
  position: 'center',
  icon: 'success',
  title: '{{ session("success") }}',
  showConfirmButton: true
}).then(function(){
    document.location.href='/logoutIrbanwil';
})
</script>

@endif

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

@endpush