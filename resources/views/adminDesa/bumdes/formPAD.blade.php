@extends('templates.desa.main')

@section('content')
<div class="clearfix"></div>
<div class="row justify-content-center mt-2">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Kontribus PADes dari BUM Desa</h5>
        <div class="x_panel">
            <div class="x_title">
                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/bumdesPAD" method="get">
                        @csrf
                        <div class="form-group mx-sm-3 mb-2">
                            <h6>Masukkan tahun data :</h6>
                            <input type="text" name="tahun" class="form-control ml-3" placeholder="{{ $tahun }}"
                                data-inputmask="'mask': '9999'" style="font-size: .85rem">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mb-2">Cek Data</button>
                    </form>

                    <button type="button" class="btn btn-primary ml-auto btn-sm" data-toggle="modal"
                        data-target="#copyDataAll">
                        Copy Data PADes BUM Desa
                    </button>

                </div>
                <!-- Modal -->
                <div class="modal fade" id="copyDataAll" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title text-light" id="staticBackdropLabel">Copy Data PADes
                                    BUM Desa
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(session()->has('timpaAll'))
                                <div class="alert bg-danger text-white">Sudah ada data PADes BUM Desa tahun
                                    {{
                                    session('timpaAll') }}
                                </div>
                                <form action="/adminDesa/copyPADbumdes" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tahuncopy">Tetap Copy dan timpa Data PAD BUM Desa Tahun
                                            {{
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
                            <form action="/adminDesa/copyPADbumdes" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="tahuncopy">Copy Seluruh Data PAD BUM Desa Tahun {{ $tahun
                                        }} ke
                                        Tahun
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
                    <a class="nav-link active" href="" role="tab">Kontribusi PADes
                        <span class="fa fa-check-circle ml-1 {{ $pad == 0 ? 'd-none' : '' }}"></span>
                    </a>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane active show " id="dalap" role="tabpanel" aria-labelledby="dalap-tab">

                    <div class="row">
                        <div class="col-md-6">
                            <p class="alert alert-info" style="font-size: 1rem">Silahkan Input/Update Data Kontribusi
                                PADes dari BUM Desa</p>
                            <div>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#staticBackdrop">
                                    + Bukti Setor PADes
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
                                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning">
                                                <h5 class="modal-title" id="staticBackdropLabel">Form Input Bukti Setor
                                                    PAD</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/adminDesa/tambahPAD" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                                    <input type="hidden" name="tahun" value="{{ $tahun }}">


                                                    <div class="form-row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="tahun_pad">Tahun</label>

                                                                <input type="number" class="form-control"
                                                                    name="tahun_pad" required>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="jumlah_pad">Jumlah yang di setor
                                                                    (Rp)</label>
                                                                <input type="text" class="form-control angka"
                                                                    name="jumlah_pad" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="bukti_setor">Upload Bukti Setor ke Kas Desa</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" name="bukti_setor"
                                                                    class="custom-file-input" id="bukti_setor"
                                                                    style="font-size: .85rem" required>
                                                                <label class="custom-file-label text-muted bukti_setor"
                                                                    for="bukti_setor" style="font-size: .85rem">file pdf
                                                                    (max-size: 1MB)</label>

                                                            </div>

                                                        </div>
                                                        <small><i>Bukti setor dapat juga berupa print out buku
                                                                rekening kas desa (penerimaan)</i></small>
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


                                <table class="table table-bordered mt-2">
                                    <tr class="table-info">
                                        <th>No</th>
                                        <th>Uraian</th>
                                        <th>Tahun</th>
                                        <th>Jumlah (Rp)</th>
                                        <th class="text-center">Bukti Setor</th>
                                        <th class="text-center">Aksi</th>
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
                                        <td class="text-center" style="vertical-align : middle">
                                            <a href="/adminDesa/hapusSetorPAD/{{ $data->id }}"
                                                class="btn btn-danger btn-sm hapus_pad"><i class="fa fa-trash"></i></a>
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

@endsection
@push('script')
<script src="/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<script>
    var status = $('#status').html();
    if(status=='close'){
    $('input').attr('disabled', 'disabled');
    }else{
        $('input').removeAttr('disabled');
    }

    bsCustomFileInput.init();
    $('.angka').mask('000.000.000.000.000', {reverse: true});

    $("#bukti_setor").change(function(event) {
        getURL(this);
    });

    function getURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = $("#bukti_setor").val();

            filename = filename.substring(filename.lastIndexOf('\\') + 1);
            var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
        if (cekgb == 'pdf' || cekgb == 'PDF') {
            if(input.files[0]['size'] > 1024000){
                alert('ukuran file tidak boleh > 1 MB !');
                $('#bukti_setor').val("");
                $('.bukti_setor').html("file gambar (max-size: 1MB)");
            }else{

            }

        }else {
            alert ("file harus berjenis PDF ");
            $('#bukti_setor').val("");
            $('.bukti_setor').html("file gambar (max-size: 1MB)");

        }


        }

    }



    $('.hapus_pad').on('click', function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        var yakin = confirm('apakah anda yakin hapus?');
        if (yakin){
            document.location.href = href;
        }
    })
</script>

@if(session()->has('timpaAll'))
<script>
    $('#copyDataAll').modal('show');

</script>
@endif


@endpush