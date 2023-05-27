<div class="mt-2">
    <p class="text-info">Form Update Data (Pembiayaan) APBDes TA {{ $tahun }}</p>
</div>
<div class="row">
    <div class="col-md-8">
        <form action="/adminDesa/updatePembiayaanA" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">

            <table class="table table-bordered">
                <thead>
                    <tr class="bg-info">
                        <th width="5%" style="vertical-align: middle">Kode_rek</th>
                        <th>JENIS PEMBIAYAAN</th>
                        <th width="20%" class="text-center">Anggaran (Rp)</th>
                    </tr>
                    @foreach($pembiayaans as $pd)
                    @if($pd->pembiayaan_id == 1 OR $pd->pembiayaan_id == 6)
                    <tr style="background-color:darkgray">
                        <th width="5%">{{ $pd->kode_pembiayaan }}</th>
                        <th>{{ $pd->jenis_pembiayaan }}</th>
                        <th width="20%">
                            <input type="text " class="form-control text-primary text-right pembiayaan "
                                name="pembiayaan[]" placeholder="0" value="{{ $pd->anggaran_murni }}" readonly>
                            <input type="hidden" name="pembiayaan_id[]" value="{{ $pd->pembiayaan_id }}">
                        </th>
                    </tr>
                    @else
                    <tr>
                        <th width="5%">{{ $pd->kode_pembiayaan }}</th>
                        <th class="pl-5 text-primary">{{ $pd->jenis_pembiayaan }}</th>
                        <th width="20%">
                            <input type="text" class="form-control text-primary text-right pembiayaan "
                                name="pembiayaan[]" placeholder="0" autofocus value="{{ $pd->anggaran_murni }}">
                            <input type="hidden" name="pembiayaan_id[]" value="{{ $pd->pembiayaan_id }}">
                        </th>
                    </tr>
                    @endif
                    @endforeach
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="2" class="text-right" style="vertical-align: middle">
                            PEMBIAYAAN NETTO
                            &ensp;
                            <span class="{{ $total_p->pembiayaan_murni < 0 ? '':'d-none' }}">(-)</span>
                            <span class="{{ $total_p->pembiayaan_murni > 0 ? '':'d-none' }}">(+)</span>
                        </th>
                        <th class="text-right">
                            <input type="text" class="form-control text-right pembiayaan" name="pembiayaan_murni"
                                autofocus style="font-size: .9rem" value="{{ $total_p->pembiayaan_murni }}" readonly>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-center"><button class="btn btn-primary" type="submit">UPDATE
                                DATA</button></th>
                    </tr>
                </tfoot>

            </table>
        </form>
    </div>
</div>


@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    $('.pembiayaan').mask('000.000.000.000.000', {reverse: true});
    $('.pembiayaan').eq(0).addClass('text-dark');
    $('.pembiayaan').eq(5).addClass('text-dark');

    var total = 0;
    var total2 = 0;
    $('.pembiayaan').on('change', function(){
                    
        var nilai1 = Number($('.pembiayaan').eq(1).val().replaceAll('.', ''));
        var nilai2 = Number($('.pembiayaan').eq(2).val().replaceAll('.', ''));
        var nilai3 = Number($('.pembiayaan').eq(3).val().replaceAll('.', ''));
        var nilai4 = Number($('.pembiayaan').eq(4).val().replaceAll('.', ''));
        total = nilai1+nilai2+nilai3+nilai4;
        $('.pembiayaan').eq(0).val(total);

        var nilai6 = Number($('.pembiayaan').eq(6).val().replaceAll('.', ''));
        var nilai7 = Number($('.pembiayaan').eq(7).val().replaceAll('.', ''));
        var nilai8 = Number($('.pembiayaan').eq(8).val().replaceAll('.', ''));
        total2 = nilai6+nilai7+nilai8;
        $('.pembiayaan').eq(5).val(total2);

    })

   
   

  
</script>

@endpush