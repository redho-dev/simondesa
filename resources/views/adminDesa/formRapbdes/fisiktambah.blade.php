<form action="/adminDesa/fisikRapbdestamb" method="post" enctype="multipart/form-data"
    class="form-horizontal form-label-left">
    @csrf

    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
    <input type="hidden" name="tahun" value="{{ $tahun }}">
    <input type="hidden" name="jenis" value="{{ $jenis }}">
    <div class="form-group row">
        <div class="col-md-8 mt-2">
            <h4 class="alert alert-warning text-dark">Input Data Perencanaan Pembangunan Fisik dalam RAPBDes TA {{
                $tahun }}
            </h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <table class="table table-bordered">
                <tr>
                    <th width='5%'>No</th>
                    <th width='35%'>Nama Kegiatan Pembangunan Fisik</th>
                    <th width='10%' class="text-center">Jumlah/Volume</th>
                    <th width='10%' class="text-center">Satuan</th>
                    <th width='15%' class="text-center">Anggaran Dlm RAPBDes <br> TA {{ $tahun }} (Rp) </th>
                    {{-- <th width='25%'>Upload Desain-RAB-Gambar</th> --}}
                </tr>
                @for($i=1; $i<=$jumfisik;$i++) <tr>
                    <td>
                        {{ $i }}
                    </td>

                    <td>
                        <input type="hidden" name="nama_data[]" value="rencana_fisik{{ $i }}">
                        <input type="text" class="form-control" name="isidata[]"
                            style="font-size: .85rem; border-radius: 0;" required>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="volume[]"
                            style="font-size: .85rem; border-radius: 0;">
                    </td>
                    <td>
                        <input type="text" class="form-control" name="satuan[]"
                            style="font-size: .85rem; border-radius: 0;">
                    </td>
                    <td>

                        <input type="text" class="form-control angka" name="anggaran[]"
                            style="font-size: .85rem; border-radius: 0;">

                    </td>

                    </tr>
                    @endfor


            </table>
            <small>contoh : </small><br>
            <small>1. pembangunan jalan onderlagh (L:2,5 meter - P:200 meter) jumlah : 1 , satuan :
                kegiatan</small><br>
            <small>2. pembangunan sumur bor, jumlah : 4 , satuan : unit</small>
        </div>
    </div>


    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-5 col-sm-5  offset-md-2">
            <button type="button" class="btn btn-primary">Cancel</button>
            <button type="reset" class="btn btn-primary">Reset</button>
            <button type="submit" class="btn btn-success">Kirim Data</button>
        </div>
    </div>

</form>