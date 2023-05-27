<style>
    .subbid {
        height: auto;
        transition: height .5s ease;
    }
</style>


<h4>Form Edit</h4>
<div class="row">
    <div class="col-md-10">
        <form action="/adminDesa/updateKegiatanA" method="POST">
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
                    @foreach($apbdes_bidangs as $ab)
                    <tr style="background-color: grey">
                        <th>{{ $ab->bidang_id }}</th>
                        <th><button class="btn btn-info">{{ $ab->bidang }}</button></th>
                        <th class="text-right">{{ $ab->anggaran_murni }}</th>
                    </tr>
                    @foreach($ab->apbdes_sub_bidang as $asub)
                    @if($asub->bidang_id == $ab->bidang_id)
                    <tr style="background-color: rgb(239, 231, 231)">
                        <th>{{ $asub->kode_sub_bidang }}</th>
                        <th class="pl-3">{{ $asub->sub_bidang }}</th>
                        <th class="text-right">{{ $asub->anggaran_murni }}</th>
                    </tr>
                    @foreach($ab->apbdes_kegiatan as $akeg)
                    @if($akeg->apbdes_sub_bidang_id == $asub->id)
                    <tr>
                        <th>{{ $akeg->kode_kegiatan }}</th>
                        <th class="pl-4">{{ $akeg->kegiatan }}</th>
                        <th>
                            <input type="text" name="anggaran_kegiatan[]" class="form-control text-right text-primary"
                                placeholder="0" value="{{ $akeg->anggaran_murni }}" style="font-size: .85rem">
                            <input type="hidden" name="id[]" value="{{ $akeg->id }}">
                            <input type="hidden" name="apbdes_sub_bidang_id[]" value="{{ $akeg->apbdes_sub_bidang_id }}"">

                        </th>
                    </tr>
                    @endif
                    @endforeach
                    @endif
                    @endforeach
                    @endforeach



                <tfoot>
                    <tr>
                        <th colspan=" 3" class="text-center"><button class="btn btn-primary" type="submit">UPDATE
                                DATA</button>
                        </th>
                    </tr>
                    </tfoot>

            </table>
        </form>
    </div>
</div>
@if(session()->has('success'))
<script>
    Swal.fire({
position: 'center',
icon: 'success',
title: '{{ session("success") }}',
showConfirmButton: true
})
</script>

@endif

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<script>
    $('.jumbid').mask('000.000.000.000.000', {reverse: true});

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

        });

    // $('.anggaran').on('change', function(){
    //     var jumkeg = $(this).val();
    //         jumkeg = jumkeg.replace('.', '');
    //         jumkeg = Number(jumkeg);
    //     var kumlatif = [];

    //     var tr = $(this).parents('tr');
    //     var jumsub = tr.siblings('.subbid');
    //     jumsub = jumsub.find('.jumsub').val(jumkeg);
       
    // })
</script>

@endpush