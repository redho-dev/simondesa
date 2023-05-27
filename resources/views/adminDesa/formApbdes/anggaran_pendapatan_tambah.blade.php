<div class="mt-2">
    <p class="text-info">Form Input Data (Pendapatan) APBDes TA {{ $tahun }}</p>
</div>
<div class="row">
    <div class="col-md-8">
        <form action="/adminDesa/tambahPendapatanA" method="POST">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">

            <table class="table table-bordered">
                <thead>
                    <tr class="bg-success">
                        <th width="5%" style="vertical-align: middle">Kode_rek</th>
                        <th style="vertical-align: middle">
                            <h4>JENIS PENDAPATAN</h4>
                        </th>
                        <th width="20%" class="text-center">Anggaran (Rp)</th>

                    </tr>
                    @foreach($pendapatans as $pd)
                    @if($pd->id <= 2 OR $pd->id == 8)
                        <tr style="background-color: darkgray">
                            <th width="5%">{{ $pd->kode_pendapatan }}</th>
                            <th>{{ strtoupper($pd->jenis_pendapatan) }}</th>
                            <th width="20%">
                                <input type="text "
                                    class="form-control text-primary text-right pendapatan transfer_{{ $pd->id }}"
                                    name="pendapatan[]" autofocus style="font-size: .9rem" placeholder="0">
                                <input type="hidden" name="pendapatan_id[]" value="{{ $pd->id }}">
                            </th>

                        </tr>
                        @else
                        <tr>
                            <th width="5%">&emsp;{{ $pd->kode_pendapatan }}</th>
                            <th class="pl-5 text-primary">{{ $pd->jenis_pendapatan }}</th>
                            <th width="20%">
                                <input type="text" class="form-control text-primary text-right pendapatan transfer"
                                    name="pendapatan[]" autofocus style="font-size: .9rem" placeholder="0">
                                <input type="hidden" name="pendapatan_id[]" value="{{ $pd->id }}">
                            </th>

                        </tr>
                        @endif
                        @endforeach
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-center"><button class="btn btn-primary" type="submit">KIRIM
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
    $('.pendapatan').mask('000.000.000.000.000', {reverse: true});

    $('.transfer_2').attr('readonly','readonly');
    $('.transfer_2').css('background-color: lightgray');
    $('.transfer_2').removeClass('text-primary');
    $('.transfer_2').attr('placeholder','');

    var totalTransfer = 0;
    $('.transfer').on('keyup', function(){
    var nilai1 = Number($('.transfer').eq(0).val().replaceAll('.', ''));
    var nilai2 = Number($('.transfer').eq(1).val().replaceAll('.', ''));
    var nilai3 = Number($('.transfer').eq(2).val().replaceAll('.', ''));
    var nilai4 = Number($('.transfer').eq(3).val().replaceAll('.', ''));
    var nilai5 = Number($('.transfer').eq(4).val().replaceAll('.', ''));

    totalTransfer = nilai1+nilai2+nilai3+nilai4+nilai5;
     var transfer = $('.transfer_2').val(totalTransfer);
    
})

  
</script>

@endpush