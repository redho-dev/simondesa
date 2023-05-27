@extends('editor.templates.main')

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Galeri Foto</h2><button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#tambahGaleri"><i class="fa fa-plus-circle"></i> Tambah Galeri</button>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>                                        
                                        <th>Deskripsi</th>												
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @forelse ($galeris as $dt)                                        
                                    <tr>
                                        <td>{{ $no; }}</td>
                                        <td class="text-center">
                                            <img src="{{ Storage::url('galeris/').$dt->image }}" class="rounded" style="width: 150px">
                                        </td>
                                        <td>{{ $dt->description }}</td>                                        
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('galeri.destroy', $dt->id) }}" method="POST">                                                
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ubahGaleri{{ $dt->id }}" title="Ubah Galeri"><i class="fa fa-edit"></i> UBAH</button>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                    <?php $no++?>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Galeri belum Tersedia.
                                        </div>
                                    @endforelse									
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="tambahGaleri" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Tambah Galeri</h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('galeri.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal mb-lg">
                <div class="modal-body">
                @csrf
                    <div class="form-group row">
                        <label class="control-label col-md-2 col-sm-2 ">Gambar</label>
                        <div class="col-md-10 col-sm-10">
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">                
                        <!-- error message untuk title -->
                        @error('image')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 col-sm-2 ">Deskripsi</label>
                        <div class="col-md-10 col-sm-10">
                        <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" placeholder="Masukkan Deskripsi Galeri">                    
                        <!-- error message untuk title -->
                        @error('description')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach ($galeris as $up)
<div id="ubahGaleri{{ $up->id }}" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Ubah Galeri</h5>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="/galeri/update" method="post" enctype="multipart/form-data" class="form-horizontal mb-lg">
                <div class="modal-body">
                @csrf
                    <input type="hidden" class="form-control" name="id" value="{{ $up->id }}" readonly>
                    <div class="form-group row">
                        <label class="control-label col-md-2 col-sm-2 ">Gambar</label>
                        <div class="col-md-10 col-sm-10">
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">                
                        <!-- error message untuk title -->
                        @error('image')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 col-sm-2 ">Deskripsi</label>
                        <div class="col-md-10 col-sm-10">
                        <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $up->description }}" placeholder="Masukkan Deskripsi Galeri">                    
                        <!-- error message untuk title -->
                        @error('description')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach


<div class="clearfix"><br></div>

<script>
    //message with toastr
    @if(session()-> has('success'))
    
        toastr.success('{{ session('success') }}', 'BERHASIL!'); 

    @elseif(session()-> has('error'))

        toastr.error('{{ session('error') }}', 'GAGAL!'); 
        
    @endif
</script>



@endsection