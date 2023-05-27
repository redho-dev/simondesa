@extends('templates.adminIrbanwil.main')

@section('content')
<h4>PILIH OBRIK DAN TAHUN DATA PENILAIAN</h4>
<div class="card p-4">
    <form action="/adminIrbanwil/pilihObrik" method="post">
        <div class="row align-items-center">

            @csrf
            <div class="col-md-2">
                <div class="form-group">
                    <label for="pilcam">Pilih Kecamatan</label>
                    <select class="form-control" id="pilcam" style="font-size: .85rem" name="kecamatan">
                        @foreach($kecamatan as $kec)
                        <option value="{{ $kec->nama_kecamatan }}" {{ session()->get('pilcam')==$kec->nama_kecamatan ?
                            'selected' : '' }}>{{ $kec->nama_kecamatan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="pildes">Pilih Desa</label>
                    <select class="form-control" id="pildes" style="font-size: .85rem" name="desa">
                        @foreach($deswal as $desa)
                        <option value="{{ $desa->asal }}" {{ session()->get('pildes')==$desa->asal ?
                            'selected' : '' }} >{{ $desa->asal}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="tahun">Tahun Data</label>
                    <input type="text" class="form-control" id="tahun" style="font-size: .85rem"
                        value="{{ session()->get('tahun') ?? '' }}" name="tahun">
                </div>
            </div>
            <div class="col-md-2 align-items-center">
                <button class="btn btn-primary btn-sm mt-4">Submit</button>
            </div>

        </div>
    </form>
</div>
<br><br><br><br>

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

<script>
    $('#pilcam').on('change', function(){
        var kecamatan = $(this).val();
        $.get('/cariDesa', {data:kecamatan}).done(function(hasil){
            $('#pildes').html("");
            $('#pildes').html(hasil);
        });

        
    })

</script>
@endpush