<div class="mt-2">
    <p class="text-info">Form Edit/Update Data (Jenis Belanja) APBDes TA {{ $tahun }}</p>
</div>
<div class="row">
    <div class="col-md-7">
        <form action="/adminDesa/updateBelanjaA" method="POST">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">

            <table class="table table-bordered">
                <thead>

                    <tr class="bg-info" style="font-size: 1rem">
                        <th width="5%" style="vertical-align: middle">Kode_rek</th>
                        <th>JENIS BELANJA</th>
                        <th width="30%" class="text-center">Anggaran (Rp)</th>
                    </tr>

                    @foreach($apbdes_belanjas as $bl)

                    <tr>
                        <th width="5%">{{ $bl->belanja->kode_belanja }}</th>
                        <th class="pl-4 text-primary">{{ $bl->belanja->jenis_belanja }}</th>
                        <th width="20%" class="text-primary">
                            <input type="text" class="form-control text-primary text-right belanja "
                                name="anggaran_murni[]" value="{{ $bl->anggaran_murni }}" autofocus placeholder="0">
                            <input type="hidden" name="belanja_id[]" value="{{ $bl->belanja->id }}">
                        </th>
                    </tr>

                    @endforeach
                </thead>
                <tfoot>
                    <tr style="background-color: rgb(172, 175, 160)">
                        <th width="5%" style="vertical-align: middle"></th>
                        <th class="text-right" style="vertical-align: middle">JUMLAH BELANJA</th>
                        <th width="20%"><input type="text" name="totalBelanja" class="totalBelanja belanja text-right "
                                value="{{ $total->akunbelanja_murni }}" style="font-size: 1rem" readonly></th>
                    </tr>

                    <tr>
                        <th colspan="2">
                            <small>
                                <ul class="text-info">
                                    <li>Silahkan update anggaran belanja sesuai APBDes</li>
                                    <li>Klik Tab untuk memastikan Total Belanja terisi otomatis</li>
                                </ul>
                            </small>
                        </th>
                        <th class="text-center"><button class="btn btn-primary" type="submit">UPDATE
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
    $('.belanja').mask('000.000.000.000.000', {reverse: true});
 
 var total = 0;
    $('.belanja').on('change', function(){
     var nilai1 = Number($('.belanja').eq(0).val().replaceAll('.', ''));
     var nilai2 = Number($('.belanja').eq(1).val().replaceAll('.', ''));
     var nilai3 = Number($('.belanja').eq(2).val().replaceAll('.', ''));
     var nilai4 = Number($('.belanja').eq(3).val().replaceAll('.', ''));
     total = nilai1+nilai2+nilai3+nilai4;
     $('.totalBelanja').val(total);

 });
</script>


@endpush