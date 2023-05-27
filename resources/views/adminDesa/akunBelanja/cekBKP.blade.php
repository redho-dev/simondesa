@extends('templates.desa.main')

@section('content')
<div class="clearfix"></div>
<div class="row justify-content-center mt-2 mb-4">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Data Penatausahaan Belanja</h5>
        <div class="x_panel">

            <div class="x_title">

                <div class="d-flex">
                    <form class="form-inline" action="/adminDesa/formPenataanBelanja" method="get">
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
                <div>Tahun Data : {{ $tahun }}</div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ $jenis=='spp' ? 'active' : ''}}" href="?jenis=spp&tahun={{ $tahun }}"
                            role="tab">+ SPP Kegiatan
                            <span class="fa fa-check-circle ml-1 {{ $spp ? '' : 'd-none' }}"></span>
                        </a>
                    </li>
                    <li class=" nav-item">
                        <a class="nav-link  {{ $jenis=='tbpu' ? 'active' : ''}} " href="?jenis=tbpu&tahun={{ $tahun }}"
                            role="tab">+ Tanda Bukti
                            Pengeluaran Uang (TBPU)
                            <span class="fa fa-check-circle ml-1 {{ $bkp ? '' : 'd-none' }}"></span>
                        </a>
                    </li>
                    <li class=" nav-item">
                        <a class="nav-link  {{ $jenis=='spp_kegiatan' ? 'active' : ''}}"
                            href="?jenis=spp_kegiatan&tahun={{ $tahun }}" role="tab">Cek Dokumen SPP
                            per
                            Kegiatan

                        </a>
                    </li>
                    <li class=" nav-item">
                        <a class="nav-link  {{ $jenis=='tbpu_kegiatan' ? 'active' : ''}}"
                            href="?jenis=tbpu_kegiatan&tahun={{ $tahun }}" role="tab">Cek Dokumen TBPU
                            per
                            Kegiatan
                        </a>
                    </li>
                    <li class=" nav-item">
                        <a class="nav-link  {{ $jenis=='bukti_belanja' ? 'active' : ''}} "
                            href="?jenis=bukti_belanja&tahun={{ $tahun }}" role="tab">+ Lampiran Bukti
                            Belanja
                        </a>
                    </li>

                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <p class="mt-2 mb-0 text-primary">Dokumen :Tanda Bukti Pengeluaran Uang (TBPU/Kwitansi/BKP)</p>
                        <p class="text-primary">Nama Kegiatan : {{ $kegiatan }}</p>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <tr style="background-color: azure">
                                        <th>#</th>
                                        <th>Nomor TBPU <br> Tanggal</th>
                                        <th>Jumlah Uang (Rp)</th>
                                        <th>Jenis Belanja /<br> Sbg Pembayaran</th>
                                        <th>PPh</th>
                                        <th>PPn</th>
                                        <th>File_TBPU <br> (Kwitansi/BKP)</th>
                                        <th>File_Lampiran <br>(Bukti Belanja)</th>
                                        <th class="text-center">Aksi</th>

                                    </tr>
                                    @foreach($databkp as $bkp)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <ul class="pl-2">
                                                <li>No : {{ $bkp->nomor }}</li>
                                                <li>Tgl: {{ $bkp->tanggal }}</li>
                                            </ul>
                                        </td>
                                        <td>{{ $bkp->jumlah }}</td>
                                        <td>
                                            <ul class="pl-2">
                                                <li> {{ $bkp->belanja->jenis_belanja }}</li>
                                                <li>{{ $bkp->sebagai }}</li>
                                            </ul>

                                        </td>
                                        <td>{{ $bkp->pph }}</td>
                                        <td>{{ $bkp->ppn }}</td>
                                        <td>
                                            <a href="{{ asset('storage/'.$bkp->file_bkp) }}" target="_blank"><img
                                                    src="/img/logo-pdf.jpg" width="35px"></a>
                                        </td>
                                        <td>
                                            @if($bkp->file_lampiran)
                                            <a href="{{ asset('storage/'.$bkp->file_lampiran) }}" target="_blank"><img
                                                    src="/img/logo-pdf.jpg" width="35px"></a>
                                            @else
                                            <small class="text-danger">(kosong)</small>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#editTBPU{{ $bkp->id }}" style="font-size: .75rem">
                                                    Edit
                                                </button>
                                                <form action="/adminDesa/hapusTBPU/{{ $bkp->id }}" method="post">
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm" type="submit"
                                                        onclick="return confirm('yakin hapus?');">hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                        <!-- Modal -->
                                        <div class="modal fade" id="editTBPU{{ $bkp->id }}" data-backdrop="static"
                                            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title text-dark" id="staticBackdropLabel">Form
                                                            Edit/Update TBPU</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="/adminDesa/updateTBPU" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="asal_id"
                                                            value="{{ $infos->asal_id }}">
                                                        <input type="hidden" name="tahun" value="{{ $tahun }}">
                                                        <input type="hidden" name="id" value="{{ $bkp->id }}">

                                                        <div class="modal-body">
                                                            <div class="form-group mb-3">
                                                                <label for="kegiatan">Nama Kegiatan</label>
                                                                <input type="text" class="form-control" id="kegiatan"
                                                                    value="{{$kegiatan }}" style="font-size: .75rem"
                                                                    readonly>
                                                            </div>
                                                            <div class="form-group  mb-3">
                                                                <label>Nomor Tanda Bukti Pengeluaran Uang</label>
                                                                <input type="text" name="nomor" class="form-control"
                                                                    style="font-size: .75rem" value="{{ $bkp->nomor }}"
                                                                    required>
                                                            </div>
                                                            <div class="form-group  mb-3">
                                                                <label>Jumlah Uang</label>
                                                                <div class="input-group mb-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text"
                                                                            style="font-size: .75rem">Rp.</div>
                                                                    </div>
                                                                    <input type="text" name="jumlah"
                                                                        class="form-control jumlah angka"
                                                                        id="inlineFormInputGroup"
                                                                        style="font-size: .75rem"
                                                                        value="{{ $bkp->jumlah }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group  mb-3">
                                                                <label>Sebagai Pembayaran</label>
                                                                <div class="input-group mb-2">
                                                                    <input type="text" name="sebagai"
                                                                        class="form-control sebagai"
                                                                        style="font-size: .75rem"
                                                                        value="{{ $bkp->sebagai }}" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group mb-3">
                                                                <label for="jenis_belanja">Jenis Belanja</label>
                                                                <select class="form-control" name="belanja_id"
                                                                    id="jenis_belanja" style="font-size: .75rem"
                                                                    required>

                                                                    <option value="">==pilih jenis belanja==</option>
                                                                    <option value="1" {{ $bkp->belanja_id == 1 ?
                                                                        'selected' : '' }}>5.1 Belanja Pegawai</option>
                                                                    <option value="2" {{ $bkp->belanja_id == 2 ?
                                                                        'selected' : '' }}>5.2 Belanja Barang/Jasa
                                                                    </option>
                                                                    <option value="3" {{ $bkp->belanja_id == 3 ?
                                                                        'selected' : '' }}>5.3 Belanja Modal</option>
                                                                    <option value="4" {{ $bkp->belanja_id == 4 ?
                                                                        'selected' : '' }}>5.4 Belanja Tak Terduga
                                                                    </option>
                                                                </select>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group col-md-6 mb-3">
                                                                    <label>Jumlah Potongan PPh</label>
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text"
                                                                                style="font-size: .75rem">Rp.
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" name="pph"
                                                                            class="form-control pph angka" id="pph"
                                                                            style="font-size: .75rem" placeholder="0"
                                                                            value="{{ $bkp->pph }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-6 mb-3">
                                                                    <label>Jumlah Potongan PPn</label>
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text"
                                                                                style="font-size: .75rem">Rp.
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" name="ppn"
                                                                            class="form-control ppn angka" id="ppn"
                                                                            style="font-size: .75rem" placeholder="0"
                                                                            value="{{ $bkp->ppn }}">
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="form-group  mb-3">
                                                                <label>Tanggal Tanda Bukti Pengeluaran Uang</label>
                                                                <input type="date" name="tanggal" class="form-control"
                                                                    style="font-size: .75rem"
                                                                    value="{{ $bkp->tanggal }}" required>
                                                            </div>
                                                            <div class="form-group  mb-3 mt-4">
                                                                <label>Ganti File Tanda Bukti Pengeluaran Uang
                                                                </label>
                                                                <div class="custom-file row">
                                                                    <div class="col-md-2">
                                                                        <a href="{{ asset('storage/'.$bkp->file_bkp) }}"
                                                                            target="_blank"><img src="/img/logo-pdf.jpg"
                                                                                width="25px"></a>
                                                                        <input type="hidden" name="old_1"
                                                                            value="{{ $bkp->file_bkp }}">
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <input type="file" name="file_bkp"
                                                                            class="custom-file-input file_bkp"
                                                                            id="customFile ">
                                                                        <label class="custom-file-label nama_file"
                                                                            for="customFile"
                                                                            style="font-size: .75rem">Pilih file PDF
                                                                            max: 2MB</label>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="form-group  mb-3 mt-4">
                                                                <label>Upload/Ganti Lampiran TBPU (bukti belanja)
                                                                </label>
                                                                <div class="custom-file row">
                                                                    <div class="col-md-2">
                                                                        @if($bkp->file_lampiran)
                                                                        <a href="{{ asset('storage/'.$bkp->file_lampiran) }}"
                                                                            target="_blank"><img src="/img/logo-pdf.jpg"
                                                                                width="25px"></a>
                                                                        <input type="hidden" name="old_2"
                                                                            value="{{ $bkp->file_lampiran }}">
                                                                        @else
                                                                        <small class="text-danger">(kosong)</small>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <input type="file" name="file_lampiran"
                                                                            class="custom-file-input file_lampiran"
                                                                            id="customFile ">
                                                                        <label class="custom-file-label nama_file2"
                                                                            for="customFile"
                                                                            style="font-size: .75rem">Upload/ganti file
                                                                            PDF
                                                                            max:
                                                                            2MB</label>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">KIRIM
                                                                DATA</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                    </div>


                </div>

                <br><br><br>
            </div>
        </div>
    </div>
</div>
<br>
<br>
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
<script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    bsCustomFileInput.init();
    $('.angka').mask('000.000.000.000.000', {reverse: true});



    $('.file_bkp').on('change', function(e){
        e.preventDefault();
        var file = $(this).val();
        getURL(this, file);

    })


    function getURL(input, data) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var filename = data;
        filename = filename.substring(filename.lastIndexOf('\\') + 1);
        var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    
        if (cekgb == 'pdf' || cekgb == 'PDF') {
            if(input.files[0]['size'] > 1024000){
                alert('ukuran file tidak boleh > 1 Mb !');
                $('.file_bkp').val("");
                
                $('.nama_file').html("Choose file PDF (max-size: 1MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('.file_bkp').val("");
            $('.nama_file').html("Choose PDF (max-size: 1MB)");
            
        }
               
        }

    }

    $('.file_lampiran').on('change', function(e){
        e.preventDefault();
        var file = $(this).val();
        getURL2(this, file);

    })
    function getURL2(input, data) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var filename = data;
        filename = filename.substring(filename.lastIndexOf('\\') + 1);
        var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    
        if (cekgb == 'pdf' || cekgb == 'PDF') {
            if(input.files[0]['size'] > 2048000){
                alert('ukuran file tidak boleh > 2 Mb !');
                $('.file_lampiran').val("");
                
                $('.nama_file2').html("Choose file PDF (max-size: 2MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('.file_lampiran').val("");
            $('.nama_file2').html("Choose PDF (max-size: 2MB)");
            
        }
               
        }

    }


</script>


@endpush