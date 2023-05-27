@extends('editor.templates.main')

@section('content')
    <br>
    <br>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('pengumuman.create') }}" class="btn btn-md btn-success mb-3">TAMBAH PENGUMUMAN</a>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">JUDUL</th>
                                <th scope="col">CONTENT</th>
                                <th scope="col">AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($pengumumans as $pengumuman)
                                <tr>
                                    <td>{{ $pengumuman->title }}</td>
                                    <td>{!! Str::limit($pengumuman->content, 150) !!}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('pengumuman.destroy', $pengumuman->id) }}" method="POST">
                                            <a href="{{ route('pengumuman.edit', $pengumuman->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                        
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data Blog belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>
                          </table>  
                    </div>
                    <div class="footer">
                        {{ $pengumumans->links() }}
                        </div>
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