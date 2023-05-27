@extends('editor.templates.main')

@section('content')

<div class="row mt-2">
    <div class="col-md-12">
        <div class="card">            
            <div class="card-body">
                <div class="x_title">
                    <h5>Tambah Berita</h5>
                    <div class="clearfix"></div>
                </div>
                <form  action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">  
                        
                    @csrf

                    <div class="form-group">
                        <label class="font-weight-bold">GAMBAR</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                    
                        <!-- error message untuk title -->
                        @error('image')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">JUDUL</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="Masukkan Judul Blog">
                    
                        <!-- error message untuk title -->
                        @error('title')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">KONTEN</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="5" placeholder="Masukkan Konten Berita">{{ old('content') }}</textarea>
                    
                        <!-- error message untuk content -->
                        @error('content')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>                    

                    <div class="ln_solid">
                        <div class="form-group">
                            <div class="col-md-12">
                            <button type="submit" id="simpan" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
                            <button type="reset" class="btn btn-warning pull-right">Batal</button>
                            <a type="button" class="btn" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>

                </form>                
            </div>
        </div>
    </div>
</div>

@endsection