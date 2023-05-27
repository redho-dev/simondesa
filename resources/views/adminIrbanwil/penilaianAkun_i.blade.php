@extends('templates.desa.main')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<h4>PENILAIAN AKUNTUBALITAS PEMERINTAHAN DAN KEUANGAN DESA</h4>
<div class="card p-4">
    <form action="/pilObrik" method="post">
        <div class="row align-items-center">

            @csrf
            <div class="col-md-2">
                <div class="form-group">
                    <label for="pilcam">Pilih Kecamatan</label>
                    <select class="form-control" id="pilcam" style="font-size: .85rem" name="kecamatan">
                        @foreach($kecamatan as $kec)
                        <option value="{{ $kec->nama_kecamatan }}">{{ $kec->nama_kecamatan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="pildes">Pilih Desa</label>
                    <select class="form-control" id="pildes" style="font-size: .85rem" name="desa">
                        @foreach($deswal as $desa)
                        <option value="{{ $desa->asal }}">{{ $desa->asal}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="tahun">Tahun Data</label>
                    <input type="text" class="form-control" id="tahun" style="font-size: .85rem" value="{{ $tahun }}"
                        name="tahun">
                </div>
            </div>
            <div class="col-md-2 align-items-center">
                <button class="btn btn-primary btn-sm mt-4">Submit</button>
            </div>

        </div>
    </form>
</div>
<br><br><br><br>


@endsection
@push('script')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>
    $('#tabel_obrik').DataTable();

</script>
@endpush