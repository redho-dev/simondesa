@extends('templates.desa.main')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<h1>REKAP OBRIK IRBANWIL IV</h1>
<table class="table table-bordered" id="tabel_obrik">
    <thead>
        <tr>
            <th>No</th>
            <th>Desa</th>
            <th>Kecamatan</th>
            <th>Data Pemerintahan</th>
            <th>Data Keuangan</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($desas as $desa)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $desa->asal}}</td>
            <td>{{ $desa->kecamatan }}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="">
    <br><br>
</div>
<div class="row">
    <div class="col-md-8">
        <table class="table table-bordered table-striped">
            <tr>
                <td>No</td>
                <td colspan="3">ASPEK/INDIKATOR/SUB-INDIKATOR</td>
                <td>Bobot (%)</td>
            </tr>
            @foreach($aspeks as $asp)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td colspan="3">{{ strtoupper($asp->aspek) }}</td>
                <td>{{ $asp->bobot }}</td>
            </tr>
            @foreach($asp->indikator as $ind)
            <tr>
                <td></td>
                <td class="pl-4">{{ $loop->iteration }}</td>
                <td class="pl-4" colspan="2">{{ $ind->indikator }}</td>
                <td>{{ $ind->bobot }}</td>

            </tr>
            @foreach($ind->sub_indikator_pemerintahan as $sub)
            <tr>
                <td></td>
                <td></td>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $sub->sub_indikator }}</td>
                <td>{{ $sub->bobot }}</td>
            </tr>
            @endforeach
            @endforeach
            @endforeach
        </table>
    </div>
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