@extends('templates.desa.main')

@section('content')
<div class="row justify-content-center mt-2 mb-4">
    <div class="col-md-12 col-sm-12  ">
        <h5 class="alert alert-info">Form Input/Update Data Surat Kuasa Pemegang Barang (Holder)</h5>
        <div class="x_panel">
            <div class="x_title">
                <div class="d-flex">
                    <form class="form-inline" action="/Akunasetholder" method="get">
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
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error !</strong> Harap periksa inputan dan file berupa pdf dengan maksimal yang ditentukan 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
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
                <div>Tahun Data : {{ $tahun }} &emsp; &emsp; <span class="text-info">(Form Input Data Akuntabilitas Surat Kuasa Pemegang Barang (Holder)</span></div>
            <div class="clearfix"></div>
            
            <br>
            <div class="x_content">
                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#holder" role="tab" aria-controls="kiba" aria-selected="true">Surat Kuasa Pemegang Barang (Holder)</a>
                    </li>
                </ul>
            

                
                <div class="modal fade" id="modalMd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="modalMdTitle"></h4>
                            </div>
                            <div class="modal-body">
                                <div class="modalError"></div>
                                <div id="modalMdContent"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="tab-content" id="myTabContent">
                    <!-- view data Holder-->
                    <div class="tab-pane fade show active" id="holder" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-tools">
                                        <button class="btn btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#modal-add">Tambah Nama Barang</button>
                                        <button type="button" class="btn btn-secondary btn-sm mb-2  float-right" data-toggle="modal" data-target="#copyAkunaset">Copy data Holder</button>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                            <thead>
                                                <tr>
                                                <th style="width: 5%">No</th>
                                                <th style="text-align: center">Nama Barang</th>
                                                <th style="text-align: center">Nama Pemegang Barang</th>
                                                <th style="text-align: center">Dokumen</th>
                                                <th style="text-align: center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($Akunasetholders as $Akunasetholder)
                                                <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$Akunasetholder->nama_barang}}</td>
                                                <td>{{$Akunasetholder->nama}}</td>
                                                <td style="text-align: center"><a class="btn btn-sm btn-primary" target="_blank" rel="noopener"  href="storage/{{$Akunasetholder->file}}">Lihat Dokumen</a></td>
                                                <td style="width: 10%">
                                                    <button type="button" class="btn btn-xs btn-success edit float-left" data-toggle="modal" data-target="#modal-edit{{ $Akunasetholder->id }}"><i class="fa fa-pencil"></i></button>
                                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('Akunasetholder.destroy', $Akunasetholder->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-xs btn-danger hapus"><i class="fa fa-trash"></i></button>
                                                    </form>    
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

                
                    <!-- modal add data Holder-->
                    <div class="modal inmodal fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
                        <div class="modal-dialog modal-md">
                            <form name="frm_add" id="frm_add" class="form-horizontal" 
                            action="{{ route('Akunasetholder.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Tambah Data</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                            <label class="font-weight-bold">Nama Barang</label>
                                            <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" placeholder="Masukkan Nama Barang" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nama Pemegang Barang</label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama Pemegang Barang" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">File</label>
                                            <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" placeholder="Unggah Dokumen" required>
                                        </div>                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary" id="tambah">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- modal edit data Holder-->
                    @foreach ($Akunasetholders as $Akunasetholder)
                    <div id="modal-edit{{ $Akunasetholder->id }}" class="modal fade" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <form name="frm_add" id="frm_add" class="form-horizontal" action="{{ route('Akunasetholder.update', $Akunasetholder->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Edit Data</h4>
                                        </div>
                                        <div class="modal-body">
                                            @method('PUT')
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="{{ $Akunasetholder->id }}">
                                                <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                                <input type="hidden" name="tahun" value="{{ $tahun }}">
                                                <label class="font-weight-bold">Nama Barang</label>
                                                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" id="nama_barang" value="{{ old('nama_barang', $Akunasetholder->nama_barang) }}" placeholder="Masukkan Nama Barang" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-bold">Nama Pemegang Barang</label>
                                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama', $Akunasetholder->nama) }}" placeholder="Masukkan Nama Pemegang Barang" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-bold">Ubah Dokumen</label>
                                                <input type="hidden" name="file_lama" value="{{ $Akunasetholder->file }}">
                                                <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" id="file" placeholder="Unggah Dokumen"><br>
                                                <a href="storage/{{$Akunasetholder->file}}">Dokumen Tersedia</a>
                                                <br>**Kosongkan "Ubah Dokumen" Jika tidak ada perubahan Dokumen
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                
                <!-- modal copy data Holder-->
                <div class="modal fade" id="copyAkunaset" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h6 class="modal-title text-light" id="staticBackdropLabel">Copy Data Aset Desa</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(session()->has('timpaAll'))
                                <div class="alert bg-danger text-white">Sudah ada data Holder tahun
                                    {{
                                    session('timpaAll') }}
                                </div>
                                <form action="/Akunasetholder/copyAkunaset" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tahuncopy">Tetap Copy dan timpa Seluruh Data Holder Tahun {{
                                            $tahun }} ke
                                            Tahun {{ session('timpaAll') }}
                                            :</label>
                                        <input type="hidden" name="tahuncopy" value="{{ session('timpaAll') }}">
                                        <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                        <input type="hidden" name="tahunasal" value="{{ $tahun }}">
                                        <input type="hidden" name="timpadata" value="oke">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Copy Data</button>
                                    </div>
                                </form>
                                @else
                                <form action="/Akunasetholder/copyAkunaset" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tahuncopy">Copy Seluruh Data Aset Tahun {{ $tahun }} ke Tahun:</label>
                                        <select class="form-control" id="tahuncopy" name="tahuncopy" required>
                                            <option value="">== pilih tahun ==</option>
                                            <option>{{ $tahun+1 }}</option>
                                            <option>{{ $tahun+2 }}</option>
                                            <option>{{ $tahun+3 }}</option>
                                        </select>
                                        <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                        <input type="hidden" name="tahunasal" value="{{ $tahun }}">
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
                </div>

            </div>
@endsection

@push('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script>
    $(document).ready(function() {
        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            $('#myTab a[href="' + activeTab + '"]').tab('show');
        }
    });
</script>

@if(session()->has('timpaAll'))
<script>
    $('#copyAkunaset').modal('show');
</script>
@endif

@endpush