@extends('templates.main')

@section('content')
<div class="x_content">
    <br />
    <h5 class="text-center mb-4">Form Tambah Admin</h5>
    <form action="/register/store" method="post" id="demo-form2" data-parsley-validate
        class="form-horizontal form-label-left">
        @csrf
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align " for="name">Nama
                Lengkap
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}">
                @error('name')
                <div><small class="text-danger">{{ $message }}</small></div>
                @enderror

            </div>


        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="username">Username
            </label>
            <div class="col-md-6 col-sm-6 ">
                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                    value="{{ old('username') }}">
                @error('username')
                <div><small class="text-danger">{{ $message }}</small></div>
                @enderror
            </div>
        </div>
        <div class="item form-group">
            <label for="password" class="col-form-label col-md-3 col-sm-3 label-align">Password</label>
            <div class="col-md-6 col-sm-6 ">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    value="{{ old('password') }}">
                @error('password')
                <div><small class="text-danger">{{ $message }}</small></div>
                @enderror
            </div>
        </div>
        <div class="item form-group">
            <label for="asal" class="col-form-label col-md-3 col-sm-3 label-align">Asal_Instansi</label>
            <div class="col-md-6 col-sm-6 ">
                <select class="form-control @error('asal_id') is-invalid @enderror" name="asal_id">
                    <option value="">== pilih asal ==</option>
                    @foreach($asals as $asal)
                    @if($asal->id == old('asal'))
                    <option value="{{ $asal->id }}" selected>{{ $asal->id.". ".$asal->asal." - ".$asal->kecamatan }}
                    </option>
                    @endif
                    <option value="{{ $asal->id }}">{{ $asal->id.". ".$asal->asal." - ".$asal->kecamatan }}</option>
                    @endforeach
                </select>
                @error('asal_id')
                <div><small class="text-danger">{{ $message }}</small></div>
                @enderror
            </div>
        </div>
        <div class="item form-group">
            <label for="obrik" class="col-form-label col-md-3 col-sm-3 label-align">Obrik</label>
            <div class="col-md-6 col-sm-6 ">
                <select class="form-control" name="obrik">
                    <option value="none">None</option>
                    <option value="irban1">Irban1</option>
                    <option value="irban2">Irban2</option>
                    <option value="irban3">Irban3</option>
                    <option value="irban4">Irban4</option>
                </select>
            </div>
        </div>
        <div class="item form-group">
            <label for="asal" class="col-form-label col-md-3 col-sm-3 label-align">Role</label>
            <div class="col-md-6 col-sm-6 ">
                <select class="form-control" name="role">

                    <option value="admin_desa">Admin Desa</option>
                    <option value="admin_irbanwil">Admin Irbanwil</option>
                    <option value="admin_irbansus">Admin Irbansus</option>
                    <option value="admin_sekretariat">Admin Sekretariat</option>
                    <option value="admin_kecamatan">Admin Kecamatan</option>
                    <option value="admin_pmd">Admin PMD</option>
                    <option value="admin_super">Super Admin</option>

                </select>
            </div>
        </div>


        <div class="ln_solid"></div>
        <div class="item form-group">
            <div class="col-md-6 col-sm-6 offset-md-3">
                <button class="btn btn-primary" type="button">Cancel</button>
                <button class="btn btn-primary" type="reset">Reset</button>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>

    </form>
</div>
@endsection