<div class="row">
    <div class="col-md-10">
        <form action="/adminDesa/tambahBidangsubA" method="POST">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">

            <table class="table table-bordered">
                <thead>
                    <tr style="background-color: rgb(183, 197, 197)">
                        <th width="5%">Kode_rek</th>
                        <th width="75%">BIDANG/SUB BIDANG/KEGIATAN</th>
                        <th width="20%">Anggaran (Rp)</th>
                    </tr>
                    @foreach($bidangs as $bidang)
                    <tr class="bidang" id="{{ $bidang->id }}" style="background-color: rgb(158, 150, 140)">
                        <th style="vertical-align: middle">{{ $loop->iteration }}</th>
                        <th style="vertical-align: middle">
                            {{ $bidang->bidang }}
                        </th>
                        <th>
                            <input type="text" class="form-control anggaran_bidang text-right text-primary"
                                name="anggaran_bidang[]" placeholder="0">
                            <input type="hidden" name="bidang_id[]" value="{{ $bidang->id }}">
                            <input type="hidden" name="bidang[]" value="{{ $bidang->bidang }}">

                        </th>
                    </tr>
                    @foreach($bidang->sub_bidang as $sub)
                    <tr class="subbidang_{{ $sub->bidang_id }}" id="{{ $sub->id }}">
                        <th style="vertical-align: middle">{{ $sub->kode_sub_bidang }}</th>
                        <th class="pl-4" style="vertical-align: middle"><span class="pl-2 left">{{ $sub->sub_bidang
                                }}</span></th>
                        <th>
                            <input type="text" class="form-control anggaran_sub text-right text-primary"
                                name="anggaran_sub_bidang[]" placeholder="0">
                            <input type="hidden" name="sub_bidang[]" value="{{ $sub->sub_bidang }}">
                            <input type="hidden" name="sub_bidang_id[]" value="{{ $sub->id }}">
                            <input type="hidden" name="kode_sub_bidang[]" value="{{ $sub->kode_sub_bidang }}">
                            <input type="hidden" name="sub_dari[]" value="{{ $sub->bidang_id }}">
                        </th>
                    </tr>
                    @endforeach
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
    $('.anggaran_bidang').mask('000.000.000.000.000', {reverse: true});
    $('.anggaran_sub').mask('000.000.000.000.000', {reverse: true});


    $('.bidang').on('click', function(){

    $('.open').slideUp();
    var id = $(this).attr('id');
    var trsubbid = $(this).siblings('.subbidang_'+id);
        trsubbid.addClass('open');
        trsubbid.slideDown("slow");
    var subbidId = trsubbid.attr('id');
    $('.kegiatan_'+id).slideDown("slow");
    $('.kegiatan_'+id).addClass('open');
    $('.anggaran').mask('000.000.000.000.000', {reverse: true});
    $('.jumsub').mask('000.000.000.000.000', {reverse: true});
    })
  
</script>

@endpush