@extends('layouts.main')
@section('css')
<script src="/package/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="/package/dist/sweetalert2.min.css">

<style>
    .card {
        background-color: rgba(255, 255, 255, 0.8);
    }

    .card-header,
    .card-footer {
        opacity: 1
    }
</style>
@endsection
@section('content')
@yield('css')

<div class="page-header overlay overlay-color-dark overlay-show overlay-op-5"
    style="background-image: url('/img/foto-desa.jpg'); background-repeat: no-repeat; background-size: 100% 100%; height: 600px;"
    loading="lazy">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-12 mx-auto">
                <div class="card">
                    <div class="card-header p-0 position-relative mt-n5 mx-3 z-index-2 rounded-5"
                        style="margin-top : -15px">
                        <div class="bg-primary py-3 pe-1 rounded">
                            <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">SIMONDES</h4>
                            <h6 class="text-white font-weight-bolder text-center mt-1 mb-0">LOGIN</h6>
                        </div>

                    </div>
                    <form role="form" class="text-start" action="/masuk" method="post">
                        @csrf
                        <div class="card-body">

                            <div class="row">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="instansi" id="instansi1"
                                            value="inspektorat" checked>
                                        <label class="form-check-label" for="instansi1">
                                            Inspektorat
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="instansi" id="instansi2"
                                            value="dinas_pmd">
                                        <label class="form-check-label" for="instansi2">
                                            Dinas PMD
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="instansi" id="instansi3"
                                            value="kecamatan">
                                        <label class="form-check-label" for="instansi3">
                                            Kecamatan
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="instansi" id="instansi4"
                                            value="desa">
                                        <label class="form-check-label" for="instansi4">
                                            Desa
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group input-group-outline mt-3 mb-0">

                                <input type="text" class="form-control " placeholder="Username" name="username"
                                    value="{{ old('username') }}">

                            </div>
                            @error('username')
                            <div><small class="text-danger mb-3">{{ $message }}</small></div>
                            @enderror

                            <div class="input-group input-group-outline mt-3 mb-0">
                                <input type="password" class="form-control" id="pass" placeholder="Password"
                                    name="password">
                                <span class="input-group-text" id="eyebtn" onclick="showpass()">
                                    <i class="fas fa-eye-slash"></i>
                                </span>
                            </div>
                            @error('password')
                            <div><small class="text-danger mb-3">{{ $message }}</small></div>
                            @enderror
                            <div class="text-center">
                                <button type="submit" class="btn btn-rounded btn-primary w-100 my-4 mb-2">Login
                                </button>
                            </div>
                            <p class="mt-4 text-sm text-center">
                                Belum ada akun? <a href="/superAdmin">Registrasi sekarang</a>
                            </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@if(session()->has('fail'))
<script>
    Swal.fire({
    position: 'center',
    icon: 'error',
    title:  "{{ session('fail') }}",
    showConfirmButton: true,

    });
</script>
@endif

<script>
    function showpass()
    {
        var x = document.getElementById('pass').type;
        if (x == 'password')
        {
        document.getElementById('pass').type = 'text';
        document.getElementById('eyebtn').innerHTML = '<i class="fas fa-eye"></i>';
        }
        else
        {
            document.getElementById('pass').type = 'password';
            document.getElementById('eyebtn').innerHTML = '<i class="fas fa-eye-slash"></i>';
        }
    }
</script>


@endsection