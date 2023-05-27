@extends('templates.desa.main')

@section('content')
<div class="clearfix"></div>
<div class="row justify-content-center mt-2">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Data RAPBDes</h5>
        <div class="x_panel">
            <div class="x_title">
                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formRapbdes" method="get">
                        @csrf
                        <div class="form-group mx-sm-3 mb-2">
                            <h6>Masukkan tahun data :</h6>
                            <input type="text" name="tahun" class="form-control ml-3" placeholder="{{ $tahun }}"
                                data-inputmask="'mask': '9999'" style="font-size: .85rem">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mb-2">Cek Data</button>
                    </form>

                </div>

                <hr>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>

                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="text-dark">Tahun Data : {{ $tahun }}

                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='dokumen' ? 'active' : '' }}"
                            href="?jenis=dokumen&tahun={{ $tahun }}" role="tab">RAPBDes
                            <span class="fa fa-check-circle ml-1 {{ $dokumen==0 ? 'd-none' : '' }}"></span>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link {{ $jenis=='fisik' ? 'active' : '' }}" href="?jenis=fisik&tahun={{ $tahun }}"
                            role="tab">Rencana Pembangunan Fisik
                            <span class="fa fa-check-circle ml-1 {{ $fisik==0 ? 'd-none' : '' }}"></span>
                        </a>
                    </li> --}}

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane active show " id="dokumen_RPJMD" role="tabpanel"
                        aria-labelledby="dokumen_RPJMD-tab">
                        @if($jenis == 'dokumen')
                        @include('adminDesa.formRapbdes.doktambah')
                        @elseif($jenis == 'fisik')
                        @include('adminDesa.formRapbdes.fisiktambah')
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

@endsection

@push('script')
<!-- jquery.inputmask -->
<script src="/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    bsCustomFileInput.init();
    

</script>
<script src="/js/rapbdes.js"></script>
@endpush