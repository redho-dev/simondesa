@extends('editor.templates.main')
@section('content')

<div class="row mt-2">
    <div class="col-md-12">
        <div class="card">            
            <div class="card-body">
                <div class="x_title">
                    <h5>Ubah Peraturan</h5>
                    <div class="clearfix"></div>
                </div>
                <form action="{{ route('peraturan.update', $peraturan->id) }}" method="POST" enctype="multipart/form-data">                                                
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="font-weight-bold">No Urut</label>
                            <input type="text" class="form-control @error('no_urut') is-invalid @enderror" name="no_urut" value="{{ old('no_urut', $peraturan->no_urut) }}" placeholder="Masukkan Nomor Urut">
                        
                            <!-- error message untuk title -->
                            @error('no_urut')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>                

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="font-weight-bold">JUDUL</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $peraturan->title) }}" placeholder="Masukkan Judul Blog">
                        
                            <!-- error message untuk title -->
                            @error('title')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="font-weight-bold">NOMOR</label>
                            <input type="text" class="form-control @error('nomor') is-invalid @enderror" name="nomor" value="{{ old('nomor', $peraturan->nomor) }}" placeholder="Masukkan Nomor Peraturan">
                        
                            <!-- error message untuk title -->
                            @error('nomor')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="font-weight-bold">TAHUN</label>
                            <input type="text" class="form-control @error('tahun') is-invalid @enderror" name="tahun" value="{{ old('tahun', $peraturan->tahun) }}" placeholder="Masukkan Tahun Peraturan">
                        
                            <!-- error message untuk title -->
                            @error('tahun')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="font-weight-bold">Dokumen</label>
                            <input type="file" class="form-control" name="dokumen">
                            @error('dokumen')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror                            
                            <div class="progress d-none">
                                <div class="progress-bar progress-bar-striped" role="progressbar"></div>
                            </div>
                        </div>
                    </div>

                    <div class="ln_solid">
                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Ubah</button>
                                <button type="reset" class="btn btn-warning pull-right"> Batal</button>
                                <a type="button" class="btn" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                </form>                 
            </div>
        </div>
    </div>
</div>

<script>
    //message with toastr
    @if(session()-> has('success'))
    
        toastr.success('{{ session('success') }}', 'BERHASIL!'); 

    @elseif(session()-> has('error'))

        toastr.error('{{ session('error') }}', 'GAGAL!'); 
        
    @endif
</script>


@endsection