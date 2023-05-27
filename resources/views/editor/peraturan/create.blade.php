@extends('editor.templates.main')

@section('content')

<div class="row mt-2">
    <div class="col-md-12">
        <div class="card">            
            <div class="card-body">
                <div class="x_title">
                    <h5>Tambah Peraturan</h5>
                    <div class="clearfix"></div>
                </div>
                <form id="peraturanform" action="{{ route('peraturan.store') }}" method="POST" enctype="multipart/form-data">            
                    @csrf

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="font-weight-bold">NO URUT</label>
                            <input type="text" class="form-control @error('no_urut') is-invalid @enderror" name="no_urut" value="{{ old('no_urut') }}" placeholder="Masukkan Nomor Urut">
                        
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
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="Masukkan Judul Peraturan">
                        
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
                            <input type="text" class="form-control @error('nomor') is-invalid @enderror" name="nomor" value="{{ old('nomor') }}" placeholder="Masukkan Nomor Peraturan">
                        
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
                            <input type="text" class="form-control @error('tahun') is-invalid @enderror" name="tahun" value="{{ old('tahun') }}" placeholder="Masukkan Tahun Peraturan">
                        
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
                            <input type="file" class="form-control @error('dokumen') is-invalid @enderror" name="dokumen">                                
                            @error('dokumen')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror                            
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                        </div>
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


<script>
    $(function(){
        $(document).ready(function(){
            $('#peraturanform').ajaxForm({
                beforeSend: function(){
                    var percentage = '0';
                },
                uploadProgress: function(event, position, total, percentComplete){
                    var percentage = percentComplete;
                    $('.progress .progress-bar').css("width", percentage+'%', function(){
                        return $(this).attr("aria-valuenow", percentage) + "%";
                    })
                },
                complete: function(xhr){
                    console.log('File has uploaded');
                }
            })
        })
    })
</script>

<script>
    //message with toastr
    @if(session()-> has('success'))
    
        toastr.success('{{ session('success') }}', 'BERHASIL!'); 

    @elseif(session()-> has('error'))

        toastr.error('{{ session('error') }}', 'GAGAL!'); 
        
    @endif
</script>


@endsection