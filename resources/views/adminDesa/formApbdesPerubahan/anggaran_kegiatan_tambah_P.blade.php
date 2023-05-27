<div class="row">
    <div class="col-md-12">
        <table class="table p-0 mb-0 mt-0">
            <tr>
                <th width="60%" colspan="2" style="vertical-align: middle" class="text-info">
                    Form Input Data (Anggaran Bidang/Sub-bidang/Kegiatan) APBDes TA {{ $tahun }} Perubahan
                </th>
                <th width="40%" class="text-center">
                    @if(Request('copy')==false)
                    <?php $copy = false; ?>
                    <a href="?jenis={{ $jenis }}&tahun={{ $tahun }}&copy=true" class="btn btn-sm btn-success"
                        style="font-size: .75rem"><span class="fa fa-share-square"></span>&nbsp;Copy</a>
                    @else
                    <?php $copy = true; ?>
                    <a href="?jenis={{ $jenis }}&tahun={{ $tahun }}" class="btn btn-sm btn-success"
                        style="font-size: .75rem"><span class="fa fa-reply"></span>&nbsp;Undo Copy</a>
                    @endif
                </th>
            </tr>
        </table>
        <form id="kirimKeg">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">

            <table class="table table-bordered">
                <thead>
                    <tr style="background-color: rgb(183, 197, 197)">
                        <th width="5%" style="vertical-align: middle">Kode_rek</th>
                        <th width="55%" style="vertical-align: middle">
                            <h4>BIDANG/SUB BIDANG/KEGIATAN</h4>
                        </th>
                        <th width="20%" class="text-center">
                            <h4>Anggaran (Rp)</h4>
                        </th>
                        <th width="20%" class="text-center">
                            <h4>Anggaran Perubahan (Rp)</h4>
                        </th>

                    </tr>
                    @foreach($apbdes_bidangs as $ab)
                    <tr style="background-color: grey">
                        <th style="vertical-align: middle">{{ $ab->bidang_id }}</th>
                        <th style="vertical-align: middle">
                            <button type="button" class="btn btn-info Tbidang_{{ $ab->bidang_id }}">{{
                                $ab->bidang->bidang }} &ensp;
                                <span class="fa fa-angle-double-down"></span>
                            </button>
                        </th>
                        <th class="text-right">
                            <input type="text" value="{{ $ab->anggaran_murni }}" class="form-control text-right angka"
                                placeholder="0" disabled>
                        </th>
                        <th class="text-right">
                            <input type="text" name="anggaran_bidang[]"
                                value="{{ $copy==true ? $ab->anggaran_murni : 0 }}"
                                class="form-control text-right bidang bidang_{{ $ab->bidang_id }}" placeholder="0"
                                readonly>
                        </th>
                    </tr>
                    @foreach($apbdes_sub_bidangs as $asub)
                    @if($asub->bidang_id == $ab->bidang_id)
                    <tr class="subB_{{ $asub->bidang_id }}" style="background-color: rgb(239, 231, 231); display:none">
                        <th>{{ $asub->kode_sub_bidang }}</th>
                        <th class="pl-3">{{ $asub->sub_bidang->sub_bidang }}</th>
                        <th class="text-right">
                            <input type="text" class="form-control text-right angka" placeholder="0"
                                value="{{ $asub->anggaran_murni }}" disabled>


                        </th>
                        <th class="text-right">
                            <input type="text" name="anggaran_subbidang[]"
                                class="form-control text-right subbid_{{ $asub->sub_bidang_id }} subbidang_{{ $ab->bidang_id }} AsuB"
                                placeholder="0" value="{{ $copy==true ? $asub->anggaran_murni : 0 }}" readonly>
                            <input type="hidden" name="bidang_id[]" value="{{ $asub->bidang_id }}">
                            <input type="hidden" name="sub_bidang_id[]" value="{{ $asub->sub_bidang_id }}">

                        </th>
                    </tr>
                    @foreach($apbdes_kegiatans as $akeg)
                    @if($akeg->apbdes_sub_bidang_id == $asub->id)
                    <tr class="kegB_{{ $asub->bidang_id }}" style="display: none">
                        <th>{{ $akeg->kode_kegiatan }}</th>
                        <th class="pl-4">{{ $akeg->kegiatan->kegiatan }}</th>
                        <th>
                            <input type="text" value="{{ $akeg->anggaran_murni }}" class="form-control text-right angka"
                                placeholder="0" disabled>

                        </th>
                        <th>
                            <input type="text" name="anggaran_kegiatan[]"
                                value="{{ $copy==true ? $akeg->anggaran_murni : 0 }}"
                                class="form-control text-right text-primary a_k a_k_{{ $asub->sub_bidang_id }}"
                                placeholder="0" autofocus>
                            <input type="hidden" class="bidang_id" value="{{ $asub->bidang_id }}">
                            <input type="hidden" name="kegiatan_id[]" value="{{ $akeg->kegiatan_id }}">
                            <input type="hidden" name="kode_kegiatan[]" value="{{ $akeg->kode_kegiatan }}">
                            <input type="hidden" name="keg_sub[]" class="subbidId" value="{{ $asub->sub_bidang_id }}">
                        </th>
                    </tr>
                    @endif
                    @endforeach
                    @endif
                    @endforeach
                    @endforeach



                <tfoot>
                    <tr>
                        <th colspan="2" class="text-right" style="vertical-align: middle">TOTAL JUMLAH ANGGARAN
                            BIDANG/SUB/KEG
                        </th>
                        <th>
                            <input type="text" class="form-control text-right angka"
                                value="{{ $total_p->belanja_murni }}" disabled>
                        </th>
                        <th>
                            <input type="text" name="totalKegiatan" class="form-control text-right text-danger angka"
                                id="toBlan" value="{{ $copy==true ? $total_p->belanja_murni : 0 }}" readonly>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-right" style="vertical-align: middle">TOTAL JUMLAH ANGGARAN
                            BELANJA </th>
                        <th>
                            <input type="text" class="form-control text-right angka"
                                value="{{ $total_p->akunbelanja_murni }}" disabled>
                        </th>
                        <th>
                            <input type="text" name="belanjaAkun" class="form-control text-right angka" id="AkunB"
                                value="{{ $total_p->akunbelanja_perubahan }}" readonly>
                        </th>
                    </tr>
                    <tr>
                        <th colspan=" 3">
                            <small class="text-primary pb-0 mb-0">Silahkan input data kegiatan dalam APBDes Perubahan:
                            </small><br>
                            <small class="text-primary">1. klik tombol bidang, kemudian edit anggaran per-kegiatan
                                sesuai APBDes TA {{ $tahun
                                }} Perubahan (Siskeudes)</small><br>
                            <small class="text-primary">2. klik tab, untuk memastikan anggaran bidang/sub-bidang terisi
                                secara
                                otomatis</small><br>
                            <small class="text-primary">3. biarkan 0 untuk kegiatan yang tidak dianggarkan, kemudian
                                klik kirim data</small><br>
                            <small class="text-primary">4. pastikan total jumlah anggaran bidang/sub/kegiatan
                                (perubahan) = total
                                jumlah
                                anggaran belanja (perubahan), kemudian
                                klik kirim data</small>
                        </th>
                        <th class="text-center"><button class="btn btn-primary" type="submit">KIRIM
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
    $('.angka').mask('000.000.000.000.000', {reverse: true});
    $('.bidang').mask('000.000.000.000.000', {reverse: true});
    $('.AsuB').mask('000.000.000.000.000', {reverse: true});
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

       var toBlan = 0;
       var jumbid = 5;
       for(let i =1; i <= jumbid; i++ ){
           toBlan += Number($('.bidang_'+i).val().replaceAll('.', ''));
            
        }

        $('#toBlan').val(toBlan);

        var AkunB = Number($('#AkunB').val().replaceAll('.',''));
        if(toBlan == AkunB){
          $('#toBlan').removeClass('text-danger');
        }else{
            $('#toBlan').addClass('text-danger');
        }
              
    });

    $('#kirimKeg').on('submit', function(e){
        e.preventDefault();
        $.post('/adminDesa/cekKegiatanP', $(this).serialize()).done(function(data){
            if(data){
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Berhasil Kirim Data',
                showConfirmButton: true
                })
                document.location.reload();
            }else{
                Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Jumlah Anggaran Perubahan Keg tidak sama dengan Jumlah Belanja Perubahan!',
                showConfirmButton: true
                })
            }

       });

    });


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