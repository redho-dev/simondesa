@extends('templates.desa.main')
@section('content')
        
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Profil Akun</h2>                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">                                
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile_img">
                            <div id="crop-avatar">                              
                                @forelse ($kantor as $akun)                            
                                <a href="{{ asset('storage/'.$akun->file_data) }}" target="_blank">
                                    <img src="{{ asset('storage/'.$akun->file_data) }}"
                                        width="270px"><br>                    
                                </a>
                                @empty                                
                                <a href="{{ asset('storage/image/kantordesa.jpg') }}" target="_blank">
                                    <img src="{{ asset('storage/image/kantordesa.jpg') }}"
                                        width="270px"><br>                    
                                </a>
                                @endforelse
                            </div>
                        </div>

                        @foreach($desa as $ds)                                                                        
                        <h3>Desa {{ $ds->asal }}</h3>
                        <ul class="list-unstyled user_data">
                            <li><i class="fa fa-map-marker user-profile-icon"></i> Kecamatan {{ $ds->kecamatan }}
                            </li>                            
                        </ul>      
                        @endforeach
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="control-label col-md-2">Username</label>
                                    <div class="col-md-10">
                                        <span style="font-weight: bold;">{{ $infos->username }}</span>
                                    </div>
                                </div>                        
                                <div class="form-group row">
                                    <label class="control-label col-md-2">Password</label>
                                    <div class="col-md-10">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ubahPassword"><i class="fa fa-edit"></i> Ubah Password</button>
                                    </div>
                                </div>               
                            </div>         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="ubahPassword" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-center text-light" id="staticBackdropLabel">Ubah Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white;">&times;</span>
                </button>
            </div>
            <form action="/adminDesa/ubahPassword" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{ $infos->id }}">
                <div class="modal-body pl-4">
                    <div class="form-group row">
                        <label for="inputPassword1" class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="inputPassword1" name="password" required>
                            <span id="eyebtn1" onclick="showpass1()" class="form-control-feedback right"><i class="fa fa-eye-slash"></i></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword2" class="col-sm-4 col-form-label">Password Baru</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="inputPassword2" name="new_password" required>
                            <span id="eyebtn2" onclick="showpass2()" class="form-control-feedback right"><i class="fa fa-eye-slash"></i></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-4 col-form-label" style="font-size: 11.5px;">Konfirmasi Password Baru</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="inputPassword3" name="confirm" required>
                            <span id="eyebtn3" onclick="showpass3()" class="form-control-feedback right"><i class="fa fa-eye-slash"></i></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
@push('script')
<script>
    function showpass1()
    {
        var x = document.getElementById('inputPassword1').type;
        if (x == 'password')
        {
        document.getElementById('inputPassword1').type = 'text';
        document.getElementById('eyebtn1').innerHTML = '<i class="fa fa-eye"></i>';
        }
        else
        {
            document.getElementById('inputPassword1').type = 'password';
            document.getElementById('eyebtn1').innerHTML = '<i class="fa fa-eye-slash"></i>';
        }
    }

    function showpass2()
    {
        var x = document.getElementById('inputPassword2').type;
        if (x == 'password')
        {
        document.getElementById('inputPassword2').type = 'text';
        document.getElementById('eyebtn2').innerHTML = '<i class="fa fa-eye"></i>';
        }
        else
        {
            document.getElementById('inputPassword2').type = 'password';
            document.getElementById('eyebtn2').innerHTML = '<i class="fa fa-eye-slash"></i>';
        }
    }

    function showpass3()
    {
        var x = document.getElementById('inputPassword3').type;
        if (x == 'password')
        {
        document.getElementById('inputPassword3').type = 'text';
        document.getElementById('eyebtn3').innerHTML = '<i class="fa fa-eye"></i>';
        }
        else
        {
            document.getElementById('inputPassword3').type = 'password';
            document.getElementById('eyebtn3').innerHTML = '<i class="fa fa-eye-slash"></i>';
        }
    }
</script>


@if(session()->has('success'))
<script>
    Swal.fire({
  position: 'center',
  icon: 'success',
  title: '{{ session("success") }}',
  showConfirmButton: true
}).then(function(){
    document.location.href='/logoutIrbanwil';
})
</script>

@endif

@if(session()->has('fail'))
<script>
    Swal.fire({
  position: 'center',
  icon: 'error',
  title: '{{ session("fail") }}',
  showConfirmButton: true
  })
</script>
@endif

@endpush

