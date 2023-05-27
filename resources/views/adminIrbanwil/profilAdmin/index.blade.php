@extends('templates.adminIrbanwil.main')

@section('content')
<h4>PROFIL ADMIN </h4>

<div class="card mb-3" style="max-width: 800px;">
    <div class="row no-gutters">
        <div class="col-md-4 p-3">
            <img src="/foto_pegawai/{{ $infos->foto }}" width="200px">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ $infos->name }}</h5>
                <h6>NIP : {{ $infos->username }}</h6>
                <h6>Pangkat : {{ $infos->pangkat }}</h6>
                <h6>Jabatan : {{ $infos->jabatan }}</h6>
                <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#staticBackdrop">
                    Change Password
                </button>

            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-center text-light" id="staticBackdropLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/adminIrbanwil/changePass" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{ $infos->id }}">
                <input type="hidden" name="username" value="{{ $infos->username }}">


                <div class="modal-body pl-4">
                    <div class="form-group row">
                        <label for="inputPassword1" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="inputPassword1" name="password" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword2" class="col-sm-3 col-form-label">New Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="inputPassword2" name="new_password"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Confirm New Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="inputPassword3" name="confirm" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- notifikasi --}}
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

@endsection
@push('script')

@endpush