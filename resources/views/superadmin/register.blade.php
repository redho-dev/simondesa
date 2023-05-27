@extends('templates.main')

@section('content')
<br>
<div class="container">



    <div class="row justify-content-center">
        <div class="col-8">
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <a href="/register/tambah" class="btn btn-primary">Tambah Admin</a>
            <table class="table table-bordered table-striped">
                <thead class="bg-info">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Asal</th>
                        <th>Obrik</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datas as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->username }}</td>
                        <td>{{ $data->asal->asal." - ".$data->asal->kecamatan }}</td>
                        <td>{{ $data->obrik }}</td>
                        <td>{{ $data->role }}</td>
                        <td>
                            <form action="/register/delete/{{ $data->id }}" method="post">
                                @csrf

                                <button class="btn btn-danger btn-sm" onclick="return confirm('yakin hapus?');"> <i
                                        class="fa fa-trash"></i></button>

                            </form>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection