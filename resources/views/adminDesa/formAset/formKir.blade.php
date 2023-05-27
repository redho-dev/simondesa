@extends('templates.desa.main')

@section('content')

<div class="clearfix"></div>
<div class="row justify-content-center mt-2">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Daftar Inventaris Ruangan (DIR)</h5>
        <div class="x_panel">
            <div class="x_title">
                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formKIR" method="get">
                        @csrf
                        <div class="form-group mx-sm-3 mb-2">
                            <h6>Masukkan tahun data :</h6>
                            <input type="text" name="tahun" class="form-control ml-3" placeholder="{{ $tahun }}"
                                data-inputmask="'mask': '9999'" style="font-size: .85rem">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mb-2">Cek Data</button>
                    </form>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm ml-auto" data-toggle="modal"
                        data-target="#copyDataAll">
                        Copy Data DIR
                    </button>

                </div>
                <!-- Modal -->
                <div class="modal fade" id="copyDataAll" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-light" id="staticBackdropLabel">Copy Seluruh Data DIR</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(session()->has('timpaAll'))
                                <div class="alert bg-danger text-white">Sudah ada data DIR tahun {{
                                    session('timpaAll') }}
                                </div>
                                <form action="/adminDesa/copyKIRAll" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tahuncopy">Tetap Copy dan timpa Data DIR Tahun {{
                                            $tahun }} ke
                                            Tahun {{ session('timpaAll') }}
                                            :</label>
                                        <input type="hidden" name="tahuncopy" value="{{ session('timpaAll') }}">
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
                            <form action="/adminDesa/copyKIRAll" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="tahuncopy">Copy Seluruh Data KIR Tahun {{ $tahun }} ke Tahun
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
            <div class="text-dark">Tahun Data : {{ $tahun }}

            </div>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="" role="tab">Daftar Inventaris Ruangan (DIR)
                        <span class="fa fa-check-circle ml-1 {{ $kir==0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane active show " id="aset" role="tabpanel" aria-labelledby="aset-tab">


                    <div class="form-aset">
                        <hr>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#staticBackdrop">
                            + Data DIR
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info">
                                        <h5 class="modal-title text-dark" id="staticBackdropLabel">Form Tambah
                                            Data DIR

                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <form action="/adminDesa/tambahKIR" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="asal_id" value=" {{ $infos->asal_id }}">
                                            <input type="hidden" name="tahun" value=" {{ $tahun }}">

                                            <div class="form-group">
                                                <label for="nama_ruangan">Nama Ruangan</label>
                                                <input type="text" class="form-control" id="nama_ruangan"
                                                    name="nama_ruangan" style="font-size : .8rem" autofocus required>
                                                <small>contoh : ruangan kades, ruangan sekdes, ruang staf keuangan,
                                                    dsb</small>

                                            </div>

                                            <div class="foto_r mb-3" style="display: none">
                                                <img src="" class="gb_ruangan" width="300px" height="200px">
                                            </div>
                                            <div class="form-group">
                                                <label for="dok_kir">Daftar Inventaris Ruangan (KIR) - document
                                                    pdf</label>
                                                <div class="input-group">
                                                    <div class="custom-file py-0">
                                                        <input type="file" name="dok_kir" class="custom-file-input"
                                                            id="dok_kir" required>
                                                        <label class="custom-file-label text-muted dok_kir"
                                                            for="dok_kir">Choose
                                                            file PDF
                                                            (max-size: 1MB)</label>
                                                    </div>
                                                </div>
                                            </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Kirim Data</button>
                                    </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>Tahun Data</th>
                                        <th>Nama Ruangan</th>
                                        <th class="text-center">Dokumen DIR</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datas as $data)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $data->tahun }}</td>
                                        <td>{{ $data->nama_ruangan }}</td>
                                        <td class="text-center"><a href="{{ asset('storage/'.$data->dok_kir) }}"
                                                target="_blank">
                                                <img src="/img/logo-pdf.webp" width="100px"
                                                    title="Klik untuk lihat file ijazah"></a></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit_{{ $data->id }}" title="Edit Data">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <a href="/adminDesa/hapusKIR/{{ $data->id }}" class="btn btn-danger btn-sm"
                                                title="hapus data"><i class="fa fa-trash"></i></a>

                                        </td>

                                        <!-- Modal -->
                                        <div class="modal fade" id="edit_{{ $data->id }}" data-backdrop="static"
                                            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-info">
                                                        <h5 class="modal-title text-dark" id="staticBackdropLabel">Form
                                                            Edit
                                                            Data DIR

                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <form action="/adminDesa/editDIR" method="post"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="asal_id"
                                                                value=" {{ $infos->asal_id }}">
                                                            <input type="hidden" name="tahun" value=" {{ $tahun }}">
                                                            <input type="hidden" name="id" value="{{ $data->id }}">

                                                            <div class="form-group">
                                                                <label for="nama_ruangan_e">Nama Ruangan</label>
                                                                <input type="text" class="form-control"
                                                                    id="nama_ruangan_e" name="nama_ruangan_e"
                                                                    style="font-size : .8rem"
                                                                    value="{{ $data->nama_ruangan }}" autofocus
                                                                    required>
                                                                <small>contoh : ruangan kades, ruangan sekdes, ruang
                                                                    staf
                                                                    keuangan,
                                                                    dsb</small>

                                                            </div>


                                                            <div class="form-group">
                                                                <label for="dok_kir_e">Daftar Inventaris Ruangan (DIR) -
                                                                    document
                                                                    pdf</label>
                                                                <div class="input-group">
                                                                    <div class="custom-file py-0">
                                                                        <input type="hidden" name="oldPdf"
                                                                            value="{{ $data->dok_kir }}">
                                                                        <input type="file" name="dok_kir_e"
                                                                            class="custom-file-input dok_kir_e">
                                                                        <label
                                                                            class="custom-file-label text-muted dok_kir_e"
                                                                            for="dok_kir_e">Ganti
                                                                            file PDF
                                                                            (max-size: 1MB)</label>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update
                                                            Data</button>
                                                    </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>

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

<script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    bsCustomFileInput.init();
</script>

@if(session()->has('timpaAll'))
<script>
    $('#copyDataAll').modal('show');

</script>
@endif

<script>
    $("#dok_kir").change(function(event) {

        getURL2(this);
        });

    function getURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var filename = $("#dok_kir").val();
                
                filename = filename.substring(filename.lastIndexOf('\\') + 1);
                var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                if (cekgb == 'pdf' || cekgb == 'PDF' ) {
                    if(input.files[0]['size'] > 1024000){
                        alert('ukuran file tidak boleh > 1 MB !');
                        $('#dok_kir').val("");
                        $('.dok_kir').html("Choose file PDF (max-size: 1MB)");
                    }else{

                    }
                    
                }else {
                    alert ("file harus berjenis PDF ");
                    $('#dok_kir').val("");
                    $('.dok_kir').html("Choose file PDF (max-size: 1MB)");
                    
                }
                
                
            }

    }

       
        $("input[name='dok_kir_e']").change(function(event) {
            var filename = $(this).val();
            getURL(this, filename);
        });
        function getURL(input, name) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var filename = name;
                filename = filename.substring(filename.lastIndexOf('\\') + 1);
                var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                if (cekgb == 'pdf' || cekgb == 'PDF' ) {
                    if(input.files[0]['size'] > 1024000){
                        alert('ukuran file tidak boleh > 1 MB !');
                        $("input[name='dok_kir_e']").val("");
                        $('.dok_kir_e').html("Choose file PDF (max-size: 1MB)");
                    }else{

                    }
                    
                }else {
                    alert ("file harus berjenis PDF ");
                    $("input[name='dok_kir_e']").val("");
                    $('.dok_kir_e').html("Choose file PDF (max-size: 1MB)");
                    
                }
                
                
            }

    }


   

    

   
</script>

@endpush