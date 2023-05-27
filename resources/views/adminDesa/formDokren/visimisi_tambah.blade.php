<form action="/adminDesa/tambahVisimisi" method="post" enctype="multipart/form-data"
    class="form-horizontal form-label-left">
    @csrf

    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
    <input type="hidden" name="tahun" value="{{ $tahun }}">
    <input type="hidden" name="jenis" value="{{ $jenis }}">

    <div class="form-group row">
        <label class="control-label col-md-2 col-sm-2 ">Visi </label>

        <div class="col-md-5 col-sm-5 ">
            <textarea class="form-control" name="isidata[]" id="dasar" rows="2" style="font-size: .9rem"
                autofocus></textarea>
            <input type="hidden" name="nama_data[]" value="visi">

        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <table class="table table-bordered" id="misi">
                <tr>
                    <th colspan="2">
                        <button class="btn btn-info" type="button" id="tambah_misi">Tambah Misi</button>
                    </th>
                </tr>
                <tr>
                    <th width="10%" style="vertical-align: middle">Misi 1</th>
                    <th>
                        <input type="hidden" name="nama_data[]" value="misi_1">
                        <textarea class="form-control" name="isidata[]" id="dasar" rows="1" style="font-size: .9rem"
                            autofocus></textarea>
                    </th>
                </tr>

            </table>
        </div>
    </div>


    </div>
    </div>

    <div class="ln_solid"></div>
    <div class="form-group ">
        <div class="col-md-5 col-sm-5  offset-md-2">
            <button type="button" class="btn btn-primary">Cancel</button>
            <button type="reset" class="btn btn-primary">Reset</button>
            <button type="submit" class="btn btn-success">Kirim Data</button>
        </div>
    </div>

</form>
@push('script')
<script>
    var i =2;
    $('#tambah_misi').on('click', function(){
        
        $('#misi').append(`<tr>
            <th style="vertical-align: middle">Misi `+ i +`</th>
            <th>
                <input type="hidden" name="nama_data[]" value="misi_`+i+`">
                <textarea class="form-control" name="isidata[]"  rows="1" style="font-size: .9rem"
                            autofocus></textarea>
            </th>
            
            </tr>`);
        i++;
    })
</script>
@endpush