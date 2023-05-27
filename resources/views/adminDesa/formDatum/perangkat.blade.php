@extends('templates.desa.main')
@section('css')
<style>
    #tabaktif {
        background-color: aqua;
        color: black;
    }
</style>
@endsection
@section('content')
<div class="clearfix"></div>
<div class="row justify-content-center mt-2">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Data Perangkat</h5>
        <div class="x_panel">
            <div class="x_title">

                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formPerangkat" method="get">
                        @csrf
                        <div class="form-group mx-sm-3 mb-2">
                            <h6>Masukkan tahun data :</h6>
                            <input type="text" name="tahun" class="form-control ml-3" placeholder="{{ $tahun }}"
                                data-inputmask="'mask': '9999'" style="font-size: .85rem">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mb-2">Cek Data</button>
                    </form>

                    <button type="button" class="btn btn-primary ml-auto btn-sm" data-toggle="modal"
                        data-target="#copyDataPer">
                        Copy Seluruh Data Perangkat
                    </button>

                </div>
                <!-- Modal -->
                <div class="modal fade" id="copyDataPer" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-light" id="staticBackdropLabel">Copy Data Perangkat</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(session()->has('timpaPer'))
                                <div class="alert bg-danger text-white">Sudah ada data perangkat tahun {{
                                    session('timpaPer') }}
                                </div>
                                <form action="/adminDesa/copyDatumPerAll" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tahuncopy">Tetap Copy dan timpa Seluruh Data Perangkat Tahun {{
                                            $tahun }} ke
                                            Tahun {{ session('timpaPer') }}
                                            :</label>
                                        <input type="hidden" name="tahuncopy" value="{{ session('timpaPer') }}">
                                        <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                        <input type="hidden" name="tahunasal" value="{{ $tahun }}">
                                        <input type="hidden" name="timpadata" value="oke">
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Copy Data</button>
                            </div>
                            </form>
                            @else
                            <form action="/adminDesa/copyDatumPerAll" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="tahuncopy">Copy Seluruh Data Perangkat Tahun {{ $tahun }} ke Tahun
                                        :</label>
                                    <select class="form-control" id="tahuncopy" name="tahuncopy" required>
                                        <option value="">== pilih tahun ==</option>
                                        <option>{{ $tahun+1 }}</option>
                                        <option>{{ $tahun+2 }}</option>
                                        <option>{{ $tahun+3 }}</option>

                                    </select>
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahunasal" value="{{ $tahun }}">
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Copy Data</button>
                        </div>
                        </form>
                        @endif

                    </div>
                </div>
            </div>
            <hr>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                            class="fa fa-wrench"></i></a>

                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div>Tahun Data : {{ $tahun }}</div>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">

            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" href="?jabatan=Kepala Desa&tahun={{ $tahun }}" role="tab"
                        aria-selected="true">Kades
                        <span class="fa fa-check-circle ml-1 {{ $kades==0 ? 'd-none' : '' }}"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" href="?jabatan=Sekretaris Desa&tahun={{ $tahun }}">
                        Sekdes <span class="fa fa-check-circle ml-1 {{ $sekdes==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?jabatan=Kaur Umum&tahun={{ $tahun }}" role="tab" aria-selected="true">
                        Kaur Umum <span class="fa fa-check-circle ml-1 {{ $kaur_umum==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?jabatan=Kaur Perencanaan&tahun={{ $tahun }}" role="tab"
                        aria-selected="true">
                        Kaur Perencanaan <span
                            class="fa fa-check-circle ml-1 {{ $kaur_per==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?jabatan=Kaur Keuangan&tahun={{ $tahun }}" role="tab"
                        aria-selected="true">
                        Kaur Keuangan <span class="fa fa-check-circle ml-1 {{ $kaur_keu==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?jabatan=Kasi Pemerintahan&tahun={{ $tahun }}" role="tab"
                        aria-selected="true">Kasi
                        Pemerintahan <span class="fa fa-check-circle ml-1 {{ $kasi_pem==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?jabatan=Kasi Kesra&tahun={{ $tahun }}" role="tab"
                        aria-selected="true">Kasi
                        Kesra <span class="fa fa-check-circle ml-1 {{ $kasi_kesra==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?jabatan=Kasi Pelayanan&tahun={{ $tahun }}" role="tab"
                        aria-selected="true">Kasi
                        Pelayanan <span class="fa fa-check-circle ml-1 {{ $kasi_pel==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h4 class="text-center">Pilih Tab untuk lihat/input/edit data</h4>
                </div>

            </div>
            <br><br><br>
        </div>
    </div>
</div>

<br>
<br>


@if(session()->has('success'))
<script>
    Swal.fire({
    icon: 'success',
    title: '{{ session("success") }}',
    showConfirmButton: false,
    timer: 1500
})
</script>
@endif

@endsection
@push('script')


@if(session()->has('timpaPer'))
<script>
    $('#copyDataPer').modal('show');

</script>
@endif


@endpush