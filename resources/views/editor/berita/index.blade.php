@extends('editor.templates.main')

@section('content')
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Daftar Berita</h2><a class="btn btn-primary btn-sm float-right" href="{{ route('berita.create') }}"><i class="fa fa-plus-circle"></i> Tambah Data</a>
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
												<th>Judul</th>
												<th>Deskripsi</th>												
												<th>Opsi</th>
											</tr>
										</thead>
										<tbody>
                                            <?php $no = 1; ?>
                                            @forelse ($beritas as $berita)                                        
                                            <tr>
                                                <td>{{ $no; }}</td>
                                                <td class="text-center">
                                                    <img src="{{ Storage::url('blogs/').$berita->image }}" class="rounded" style="width: 150px">
                                                </td>
                                                <td>{{ $berita->title }}</td>
                                                <td>{!! Str::limit($berita->content, 150) !!}</td>
                                                <td class="text-center">
                                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('berita.destroy', $berita->id) }}" method="POST">
                                                        <a href="/berita/edit/{{ $berita->id }}" class="btn btn-sm btn-primary">EDIT</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                                    </form>
                                                    
                                                </td>
                                            </tr>
                                            <?php $no++?>
                                          @empty
                                              <div class="alert alert-danger">
                                                  Data Blog belum Tersedia.
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