<div class="row">
    <div class="col-md-10">
        <form action="/adminDesa/tambahKegiatanA" method="POST">
            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            @csrf
            <table class="table table-bordered">
                <thead>
                    <tr style="background-color: rgb(183, 197, 197)">
                        <th width="5%">Kode_rek</th>
                        <th width="75%">BIDANG/SUB BIDANG/KEGIATANs</th>
                        <th width="20%">Anggaran (Rp)</th>
                    </tr>
                    @foreach($bidangs as $ab)
                    <tr style="background-color: grey">
                        <th>{{ $ab->id}}</th>
                        <th>
                            <button type="button" class="btn btn-info Tbidang_{{ $ab->id }}">{{ $ab->bidang }} &ensp;
                                <span class="fa fa-angle-double-down"></span></button>
                        </th>
                        <th class="text-right">
                            <input type="text" name="anggaran_bidang[]"
                                class="form-control text-right bidang bidang_{{ $ab->id }}" placeholder="0" readonly>

                        </th>
                    </tr>
                    @foreach($ab->sub_bidang as $asub)
                    @if($asub->bidang_id == $ab->id)
                    <tr style="background-color: rgb(239, 231, 231); display: none" class="subB_{{ $asub->bidang_id }}">
                        <th>{{ $asub->kode_sub_bidang }}</th>
                        <th class="pl-4">{{ $asub->sub_bidang }}</th>
                        <th class="text-right">
                            <input type="text" name="anggaran_subbidang[]"
                                class="form-control text-right subbid_{{ $asub->id }} subbidang_{{ $ab->id }}"
                                placeholder="0" readonly>
                            <input type="hidden" name="bidang_id[]" value="{{ $asub->bidang_id }}">
                            <input type="hidden" name="sub_bidang_id[]" value="{{ $asub->id }}">

                        </th>
                    </tr>
                    @foreach($daftar_kegiatan as $kegiatan)
                    @if($kegiatan->sub_bidang_id == $asub->id)
                    <tr class="kegB_{{ $kegiatan->bidang_id }}" style="display: none">
                        <th>{{ $kegiatan->kode_kegiatan }}</th>
                        <th style="padding-left:50px" class="text-primary">{{ $kegiatan->kegiatan }}</th>
                        <th>
                            <input type="text" name="anggaran_kegiatan[]"
                                class="form-control text-right text-primary a_k a_k_{{ $asub->id }}" placeholder="0"
                                autofocus>
                            <input type="hidden" class="bidang_id" value="{{ $asub->bidang_id }}">
                            <input type="hidden" name="kegiatan_id[]" value="{{ $kegiatan->id }}">
                            <input type="hidden" name="kode_kegiatan[]" value="{{ $kegiatan->kode_kegiatan }}">
                            <input type="hidden" name="keg_sub[]" class="subbidId" value="{{ $asub->id }}">
                        </th>


                    </tr>
                    @endif
                    @endforeach
                    @endif
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
    $('.a_k').mask('000.000.000.000.000', {reverse: true});
   
    var totalSejenis = 0;
    
    $('.a_k').on('change', function(){
       
        var id = $(this).siblings('.subbidId').val();
        var sejenis = $('.a_k_'+id).length;
        var nilai = 0;
        for(let i = 0; i < sejenis; i++ ){
           nilai += Number($('.a_k_'+id).eq(i).val().replaceAll('.', ''));

            
        }
       $('.subbid_'+id).val(nilai);

       var bidang_id =  $(this).siblings('.bidang_id').val();
       var jumsubbidang = $('.subbidang_'+bidang_id).length;

       var nilaibid = 0
       for(let i = 0; i < jumsubbidang; i++ ){
           nilaibid += Number($('.subbidang_'+bidang_id).eq(i).val().replaceAll('.', ''));
            
        }
       
       $('.bidang_'+bidang_id).val(nilaibid);
        
    });


    // $('.bidang_1').on('click', function(){

    // $('.open').slideUp();
    // var id = $(this).attr('id');
    // var trsubbid = $(this).siblings('.subbidang_'+id);
    //     trsubbid.addClass('open');
    //     trsubbid.slideDown("slow");
    // var subbidId = trsubbid.attr('id');
    // $('.kegiatan_'+id).slideDown("slow");
    // $('.kegiatan_'+id).addClass('open');
    // $('.anggaran').mask('000.000.000.000.000', {reverse: true});
    // $('.jumsub').mask('000.000.000.000.000', {reverse: true});
    // })

    $('.Tbidang_1').on('click', function(){
        $('.subB_1').slideToggle('slow');
        $('.kegB_1').slideToggle('slow');
        $('.subB_2').hide('slow');
        $('.kegB_2').hide('slow');
        $('.subB_3').hide('slow');
        $('.kegB_3').hide('slow');
        $('.subB_4').hide('slow');
        $('.kegB_4').hide('slow');
        $('.subB_5').hide('slow');
        $('.kegB_5').hide('slow');
    })

    $('.Tbidang_2').on('click', function(){
        $('.subB_1').hide('slow');
        $('.kegB_1').hide('slow');
        $('.subB_2').slideToggle('slow');
        $('.kegB_2').slideToggle('slow');
        $('.subB_3').hide('slow');
        $('.kegB_3').hide('slow');
        $('.subB_4').hide('slow');
        $('.kegB_4').hide('slow');
        $('.subB_5').hide('slow');
        $('.kegB_5').hide('slow');
    })

    $('.Tbidang_3').on('click', function(){
        $('.subB_1').hide('slow');
        $('.kegB_1').hide('slow');
        $('.subB_3').slideToggle('slow');
        $('.kegB_3').slideToggle('slow');
        $('.subB_2').hide('slow');
        $('.kegB_2').hide('slow');
        $('.subB_4').hide('slow');
        $('.kegB_4').hide('slow');
        $('.subB_5').hide('slow');
        $('.kegB_5').hide('slow');
    })

    $('.Tbidang_4').on('click', function(){
        $('.subB_1').hide('slow');
        $('.kegB_1').hide('slow');
        $('.subB_4').slideToggle('slow');
        $('.kegB_4').slideToggle('slow');
        $('.subB_2').hide('slow');
        $('.kegB_2').hide('slow');
        $('.subB_3').hide('slow');
        $('.kegB_3').hide('slow');
        $('.subB_5').hide('slow');
        $('.kegB_5').hide('slow');
    })

    $('.Tbidang_5').on('click', function(){
        $('.subB_1').hide('slow');
        $('.kegB_1').hide('slow');
        $('.subB_5').slideToggle('slow');
        $('.kegB_5').slideToggle('slow');
        $('.subB_2').hide('slow');
        $('.kegB_2').hide('slow');
        $('.subB_3').hide('slow');
        $('.kegB_3').hide('slow');
        $('.subB_4').hide('slow');
        $('.kegB_4').hide('slow');
    })
  
</script>

@endpush