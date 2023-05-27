<div class="row mt-2">
    <div class="col-md-5">
        <p class="text-info">Form Input Data (Jenis Belanja) APBDes TA {{ $tahun }} Perubahan</p>
    </div>

</div>
<div class="row">
    <div class="col-md-8">
        <form action="/adminDesa/tambahBelanjaP" method="POST">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">

            <table class="table table-bordered">
                <thead>

                    <tr style="background-color: rgb(147, 151, 151)">
                        <th width="5%" style="vertical-align: middle">Kode_rek</th>
                        <th>JENIS BELANJA</th>
                        <th width="30%" class="text-center">Anggaran (Rp)</th>
                        <th width="30%" class="text-center">Anggaran Perubahan (Rp)</th>
                    </tr>

                    @foreach($apbdes_belanjas as $bl)

                    <tr>
                        <th width="5%">{{ $bl->belanja->kode_belanja }}</th>
                        <th class="pl-4 text-primary">{{ $bl->belanja->jenis_belanja }}</th>
                        <th width="20%" class="text-primary">
                            <input type="text" class="form-control text-right belanja "
                                value="{{ $bl->anggaran_murni }}" placeholder="0" disabled>
                        </th>
                        <th width="20%" class="text-primary">
                            <input type="text" class="form-control text-primary text-right belanja belanja_P"
                                name="anggaran_perubahan[]" value=0 autofocus>
                            <input type="hidden" name="belanja_id[]" value="{{ $bl->belanja->id }}">
                        </th>
                    </tr>

                    @endforeach
                </thead>
                <tfoot>
                    <tr style="background-color: rgb(172, 175, 160)">
                        <th width="5%" style="vertical-align: middle"></th>
                        <th class="text-right" style="vertical-align: middle">JUMLAH BELANJA</th>
                        <th width="20%">
                            <input type="text" class="belanja text-right form-control"
                                value="{{ $total->akunbelanja_murni }}" disabled>
                        </th>
                        <th width="20%">
                            <input type="text" name="totalBelanja" class="totalBelanja belanja text-right form-control"
                                value=0 readonly>
                        </th>
                    </tr>

                    <tr>
                        <th colspan="3">
                            <small>
                                Catatan :
                                <ul>
                                    <li>Silahkan edit jumlah jenis belanja jika ada perubahan dari anggaran awal</li>
                                    <li>Jika seluruhnya tidak ada perubahan, tetap klik kirim data untuk memastikan data
                                        Belanja Perubahan
                                        terinput di simondes</li>
                                </ul>
                            </small>
                        </th>
                        <th colspan="2" class="text-center"><button class="btn btn-primary" type="submit">KIRIM
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
    $('.belanja_P').on('change', function(){
     var nilai1 = Number($('.belanja_P').eq(0).val().replaceAll('.', ''));
     var nilai2 = Number($('.belanja_P').eq(1).val().replaceAll('.', ''));
     var nilai3 = Number($('.belanja_P').eq(2).val().replaceAll('.', ''));
     var nilai4 = Number($('.belanja_P').eq(3).val().replaceAll('.', ''));
     total = nilai1+nilai2+nilai3+nilai4;
     $('.totalBelanja').val(total);

 })
    
    
</script>

@endpush