<div class="mt-2">
    <p class="text-info">Form Update Data (Pendapatan) APBDes TA {{ $tahun }}</p>
</div>
<div class="row">
    <div class="col-md-8">
        <form action="/adminDesa/updatePendapatanA" method="POST">
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
                        <th width="20%" class="text-center">
                            <h4>Anggaran (Rp)</h4>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendapatans as $pd)
                    @if($pd->pendapatan_id <= 2 OR $pd->pendapatan_id == 8)
                        <tr style="background-color: darkgray">
                            <th width="5%">{{ $pd->kode_pendapatan }}</th>
                            <th>{{ strtoupper($pd->jenis_pendapatan) }}</th>
                            <th width="20%">
                                <input type="text "
                                    class="form-control text-primary text-right pendapatan transfer_{{ $pd->pendapatan_id }}"
                                    placeholder="0" name="pendapatan[]" autofocus value="{{ $pd->anggaran_murni }}">
                                <input type="hidden" name="pendapatan_id[]" value="{{ $pd->pendapatan_id }}">
                            </th>
                        </tr>
                        @else
                        <tr>
                            <th width="5%">{{ $pd->kode_pendapatan }}</th>
                            <th class="pl-5 text-primary">{{ $pd->jenis_pendapatan }}</th>
                            <th width="20%">
                                <input type="text" class="form-control text-primary text-right pendapatan transfer"
                                    name="pendapatan[]" placeholder="0" autofocus value="{{ $pd->anggaran_murni }}">
                                <input type="hidden" name="pendapatan_id[]" value="{{ $pd->pendapatan_id }}">
                            </th>
                        </tr>
                        @endif

                        @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th colspan="2" class="text-right" style="vertical-align: middle">TOTAL PENDAPATAN</th>
                        <th class="text-right">
                            <input type="text" class="form-control text-right pendapatan total_p"
                                name="pendapatan_murni" autofocus style="font-size: .9rem"
                                value="{{ $total_p->pendapatan_murni }}" readonly>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2">
                            <small>
                                <ul class="text-info">
                                    <li>Silahkan update anggaran pendapatan sesuai APBDes</li>
                                    <li>Klik Tab untuk memastikan Total Pendapatan terisi otomatis</li>
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
    $('.pendapatan').mask('000.000.000.000.000', {reverse: true});

    $('.transfer_2').attr('readonly','readonly');
    $('.transfer_2').css('background-color: lightgray');
    $('.transfer_2').removeClass('text-primary');
    $('.transfer_2').attr('placeholder','');

    var totalTransfer = 0;
    var total_p = 0;
   
    
    $('.transfer').on('change', function(){
    var nilai1 = Number($('.transfer').eq(0).val().replaceAll('.', ''));
    var nilai2 = Number($('.transfer').eq(1).val().replaceAll('.', ''));
    var nilai3 = Number($('.transfer').eq(2).val().replaceAll('.', ''));
    var nilai4 = Number($('.transfer').eq(3).val().replaceAll('.', ''));
    var nilai5 = Number($('.transfer').eq(4).val().replaceAll('.', ''));

        totalTransfer = nilai1+nilai2+nilai3+nilai4+nilai5;
        var transfer = $('.transfer_2').val(totalTransfer);
        var pad = Number($('.transfer_1').val().replaceAll('.', ''));
        var lain = Number($('.transfer_8').val().replaceAll('.', ''));
        total_p = totalTransfer+pad+lain;
        $('.total_p').val(total_p);
    })
    $('.transfer_1').on('change', function(){
        var pad = Number($('.transfer_1').val().replaceAll('.', ''));
        var lain = Number($('.transfer_8').val().replaceAll('.', ''));
        var totalTransfer =  Number($('.transfer_2').val().replaceAll('.', ''));
        total_p = totalTransfer+pad+lain;
        $('.total_p').val(total_p);
    })
    $('.transfer_8').on('change', function(){
        var pad = Number($('.transfer_1').val().replaceAll('.', ''));
        var lain = Number($('.transfer_8').val().replaceAll('.', ''));
        var totalTransfer =  Number($('.transfer_2').val().replaceAll('.', ''));
        total_p = totalTransfer+pad+lain;
        $('.total_p').val(total_p);
    })






   
   

  
</script>

@endpush