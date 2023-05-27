@extends('adminSimondes.templates.main')

@section('content')

<section role="main" class="content-body">
    <header class="page-header">
        <h2>ASPEK</h2>

        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="/irban">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>

                <li><span>Beranda</span></li>

                <li>&nbsp;</li>
            </ol>            
        </div>
    </header>

    <div class="row">
        <div class="col">
            <section class="card">
                <header class="card-header">
                    
                    <h2 class="card-title"><a class="modal-with-form btn btn-primary btn-sm float-left" href="#tambah"><i class="fa fa-plus-circle"></i> Tambah Data</a> Aspek</h2>
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    </div>
                    
                </header>
                <div class="card-body">
                    <table class="table table-bordered table-striped mb-0" id="datatable-default">
                        <thead>
                            <tr>
                                <th style="width: 3%">No.</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Obrik</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listadmin as $dt)
                            <tr>                                
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dt->name }}</td>
                                <td>{{ $dt->username }}</td>
                                <td>{{ $dt->obrik }}</td>                                
                                <td style="width:10%; white-space: nowrap;"><a type="button" class="modal-with-form btn btn-success btn-sm" title="Ubah Data Verifikator Inspektorat" href="#ubah{{ $dt->id }}"><i class="fa fa-edit"></i></a> <a onclick="return confirm('Anda yakin menghapus data Admin ini?');" href="/admin/delete/{{ $dt->id }}" method="POST" class="btn btn-danger btn-sm" title="Hapus Data Admin"><i class="fa fa-trash"></i></a>                                    
                                </td>
                            </tr>                            
                            @endforeach                            
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</section>


<div id="tambah" class="modal-block modal-header-color modal-block-primary mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Tambah Verifikator Inspektorat</h2>
        </header>
        <div class="card-body">
            <form action="/admin/tambahirban" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Admin</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label>Irban</label>
                    <select data-plugin-selectTwo class="form-control populate" name="obrik">
                        <option value="" selected disabled>-- Pilih Irban --</option>    
                        <option value="irban1">Irban Wilayah 1</option>
                        <option value="irban2">Irban Wilayah 2</option>
                        <option value="irban3">Irban Wilayah 3</option>
                        <option value="irban4">Irban Wilayah 4</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Username (NIP)</label>
                    <input type="number" class="form-control" name="username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" class="form-control" name="password">
                </div>                            
        </div>
        <footer class="card-footer">
            <div class="row">
                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button class="btn btn-default modal-dismiss">Batal</button>
                </div>
            </div>
        </footer>
    </form>
    </section>
</div>


@foreach($listadmin as $up)
<div id="ubah{{ $up->id }}" class="modal-block modal-header-color modal-block-primary mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Ubah Data Verifikator Inspektorat</h2>
        </header>
        <div class="card-body">
            <form action="/admin/update/{{ $up->id }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $up->id }}">
                <div class="form-group">
                    <label>Nama Admin</label>
                    <input type="text" class="form-control" name="name" value="{{ $up->name }}">
                </div>
                <div class="form-group">
                    <label>Irban</label>
                    <select data-plugin-selectTwo class="form-control populate" name="obrik">
                        <option value="" selected disabled>-- Pilih Irban --</option>    
                        <option value="irban1" {{ $up->obrik == 'irban1' ? 'selected' : '' }}>Irban Wilayah 1</option>
                        <option value="irban2" {{ $up->obrik == 'irban2' ? 'selected' : '' }}>Irban Wilayah 2</option>
                        <option value="irban3" {{ $up->obrik == 'irban3' ? 'selected' : '' }}>Irban Wilayah 3</option>
                        <option value="irban4" {{ $up->obrik == 'irban4' ? 'selected' : '' }}>Irban Wilayah 4</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Username (NIP)</label>
                    <input type="text" class="form-control" name="username" value="{{ $up->username }}" readonly>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" value="{{ $up->password }}">
                </div>                            
        </div>
        <footer class="card-footer">
            <div class="row">
                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button class="btn btn-default modal-dismiss">Batal</button>
                </div>
            </div>
        </footer>
    </form>
    </section>
</div>
@endforeach


@endsection