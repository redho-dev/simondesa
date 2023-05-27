@extends('editor.templates.main')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
            <h2>Daftar Peraturan</h2><a href="{{ route('peraturan.create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus-circle"></i> Tambah Peraturan</a>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <table class="table table-bordered" id="datatable">
                <thead>
                    <tr>
                        <th style="text-align: center;" width="20px">NO</th>
                        <th style="text-align: center;" width="50px">DOKUMEN</th>
                        <th style="text-align: center;" width="400px">JUDUL</th>
                        <th style="text-align: center;" width="150px">NOMOR</th>
                        <th style="text-align: center;" width="100px">TAHUN</th>
                        <th style="text-align: center;" width="30px">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($peraturans as $peraturan)
                    <tr>
                        <td>{{ $peraturan->no_urut }}</td>
                        <td class="text-center">
                            <a href="storage/peraturans/{{ $peraturan->image }}" target="_blank">Unduh Peraturan</a>
                        </td>
                        <td>{{ $peraturan->title }}</td>
                        <td>{{ $peraturan->nomor }}</td>
                        <td>{{ $peraturan->tahun }}</td>
                        <td style="white-space: nowrap;">
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('peraturan.destroy', $peraturan->id) }}" method="POST">
                                <a href="{{ route('peraturan.edit', $peraturan->id) }}" class="btn btn-sm btn-success" title="Ubah Peraturan"><i class="fa fa-edit"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus Peraturan"><i class="fa fa-trash"></i></button>
                            </form>                            
                        </td>
                    </tr>
                    @empty
                        <div class="alert alert-danger">
                            Data Peraturan belum Tersedia.
                        </div>
                    @endforelse
                </tbody>
            </table>
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

</body>

@endsection