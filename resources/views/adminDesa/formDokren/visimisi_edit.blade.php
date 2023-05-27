<form action="/adminDesa/updateVisimisi" method="post" enctype="multipart/form-data"
    class="form-horizontal form-label-left">
    @csrf

    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
    <input type="hidden" name="tahun" value="{{ $tahun }}">
    <input type="hidden" name="jenis" value="{{ $jenis }}">

    <div class="form-group row">
        <label class="control-label col-md-2 col-sm-2 ">Visi </label>

        <div class="col-md-5 col-sm-5 ">
            <textarea class="form-control" name="isidata[]" id="dasar" rows="2" style="font-size: .9rem"
                autofocus>{{ $visi->uraian }}</textarea>
            <input type="hidden" name="nama_data[]" value="visi">

        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <table class="table table-bordered" id="misi">
                <tr>
                    <th colspan="3">
                        <button class="btn btn-info" type="button" id="tambah_misi">Tambah Misi</button>
                        <input type="hidden" id="jumlah_misi" value="{{ $jumlah_misi }}">
                    </th>
                </tr>
                <?php $i=1; ?>
                @foreach($misis as $misi)
                <tr>
                    <th width="10%" style="vertical-align: middle">Misi_{{ $i }}</th>
                    <th>
                        <input type="hidden" name="nama_data[]" value="misi_{{ $i }}">
                        <textarea class="form-control" name="isidata[]" id="dasar" rows="1" style="font-size: .9rem"
                            autofocus>{{ $misi->uraian }}</textarea>
                    </th>
                    <th width="10%" class="text-center" style="vertical-align: middle">
                        <a href="/adminDesa/deleteVisimisi/{{ $misi->id }}" class="badge bg-danger text-white"
                            style="font-size: 1rem; vertical-align: middle" title="hapus misi"><i
                                class="fa fa-trash "></i></a>
                    </th>
                </tr>
                <?php $i++; ?>
                @endforeach

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
            <button type="submit" class="btn btn-success">Update Data</button>
        </div>
    </div>

</form>
@push('script')
<script>
    var i = Number($('#jumlah_misi').val());
    i = i+1;
    $('#tambah_misi').on('click', function(){
        
        $('#misi').append(`<tr>
            <th style="vertical-align: middle">misi_ `+ i +`</th>
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