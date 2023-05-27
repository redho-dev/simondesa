<div class="mt-2">
    <p class="text-info">Form Update Data (Pembiayaan) APBDes TA {{ $tahun }} Perubahan</p>
</div>
<div class="row">
    <div class="col-md-8">
        <form action="/adminDesa/tambahPembiayaanP" method="post">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">

            <table class="table table-bordered">
                <thead>
                    <tr style="background-color: rgb(183, 197, 197)">
                        <th width="5%" style="vertical-align: middle">Kode_rek</th>
                        <th>JENIS PEMBIAYAAN</th>
                        <th width="20%" class="text-center">Anggaran (Rp)</th>
                        <th width="20%" class="text-center">Anggaran Perubahan (Rp)</th>
                    </tr>
                    @foreach($pembiayaans as $pd)
                    @if($pd->pembiayaan_id == 1 OR $pd->pembiayaan_id == 6)
                    <tr style="background-color: rgb(215, 215, 223)">
                        <th width="5%">{{ $pd->kode_pembiayaan }}</th>
                        <th>{{ $pd->jenis_pembiayaan }}</th>
                        <th width="20%">
                            <input type="text " class="form-control text-right angka" placeholder="0"
                                value="{{ $pd->anggaran_murni }}" disabled>
                        </th>
                        <th width="20%">
                            <input type="text " class="form-control text-primary text-right pembiayaan "
                                name="pembiayaan[]" placeholder="0" value="{{ $pd->anggaran_perubahan }}" readonly>
                            <input type="hidden" name="pembiayaan_id[]" value="{{ $pd->pembiayaan_id }}">
                        </th>
                    </tr>
                    @else
                    <tr>
                        <th width="5%">{{ $pd->kode_pembiayaan }}</th>
                        <th class="pl-5 text-primary">{{ $pd->jenis_pembiayaan }}</th>
                        <th width="20%">
                            <input type="text" class="form-control text-right angka" placeholder="0"
                                value="{{ $pd->anggaran_murni }}" disabled>

                        </th>
                        <th width="20%">
                            <input type="text" class="form-control text-primary text-right pembiayaan"
                                name="pembiayaan[]" placeholder="0" autofocus value="{{ $pd->anggaran_perubahan }}">
                            <input type="hidden" name="pembiayaan_id[]" value="{{ $pd->pembiayaan_id }}">
                        </th>
                    </tr>
                    @endif
                    @endforeach
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="2" class="text-right" style="vertical-align: middle">
                            PEMBIAYAAN NETTO &ensp;
                            <span class="{{ $total_p->pembiayaan_perubahan < 0 ? '':'d-none' }}">(-)</span>
                            <span class="{{ $total_p->pembiayaan_perubahan > 0 ? '':'d-none' }}">(+)</span>

                        </th>
                        <th class="text-right">
                            <input type="text" class="form-control text-right angka" style="font-size: .9rem"
                                value="{{ $total_p->pembiayaan_murni }}" disabled>
                        </th>
                        <th class="text-right">
                            <input type="text" class="form-control text-right pembiayaan" name="pembiayaan_perubahan"
                                autofocus style="font-size: .9rem" value="{{ $total_p->pembiayaan_perubahan }}"
                                id="netto" readonly>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="3">
                            <small class="text-primary">
                                Catatan :
                                <ul>
                                    <li>Silahkan edit/update jumlah pembiayaan perubahan pada setiap jenis pembiayaan
                                        yang
                                        berubah</li>
                                    <li>Klik Tab untuk memastikan Pembiayaan Netto Perubahan Terisi Otomatis, kemudian
                                        klik kirim data</li>
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
    $('.angka').mask('000.000.000.000.000', {reverse: true});
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

        netto = total-total2;
            $('#netto').val(netto);

    })

   
   

  
</script>

@endpush