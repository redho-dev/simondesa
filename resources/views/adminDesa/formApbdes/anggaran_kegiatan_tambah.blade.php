<div class="mt-2">
    <p class="text-info">Form Input Data (Anggaran Bidang/Sub-bidang/Kegiatan) APBDes TA {{ $tahun }}</p>
</div>
<div class="row mt-2">
    <div class="col-md-10">
        <form action="/adminDesa/tambahKegiatanA" method="POST" id="kirimKeg">
            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            @csrf
            <table class="table table-bordered">
                <thead>
                    <tr style="background-color: rgb(183, 197, 197)">
                        <th width="5%" style="vertical-align: middle">Kode_rek</th>
                        <th width="75%" style="vertical-align: middle">
                            <h4>BIDANG/SUB BIDANG/KEGIATAN</h4>
                        </th>
                        <th width="20%" class="text-center">
                            <h4>Anggaran (Rp)</h4>
                        </th>
                    </tr>
                    @foreach($bidangs as $ab)
                    <tr style="background-color: grey">
                        <th style="vertical-align: middle">{{ $ab->id}}</th>
                        <th style="vertical-align: middle">
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
                        <th colspan="2" class="text-right" style="vertical-align: middle">TOTAL JUMLAH ANGGARAN
                            BIDANG/SUB/KEG
                        </th>
                        <th>
                            <input type="text" name="totalKegiatan" class="form-control text-right" id="toBlan"
                                value="{{ $total->belanja_murni }}" readonly>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-right" style="vertical-align: middle">TOTAL JUMLAH ANGGARAN
                            BELANJA </th>
                        <th>
                            <input type="text" name="belanjaAkun" class="form-control text-right" id="AkunB"
                                value="{{ $total->akunbelanja_murni }}" readonly>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2">
                            <small class="text-primary pb-0 mb-0">Silahkan ikuti petunjuk pengisian sebagai berikut:
                            </small><br>
                            <small class="text-primary">1. klik tombol bidang, kemudian input anggaran per-kegiatan
                                sesuai APBDes TA {{ $tahun
                                }} (Siskeudes)</small><br>
                            <small class="text-primary">2. klik tab, untuk memastikan anggaran bidang/sub-bidang terisi
                                secara
                                otomatis</small><br>
                            <small class="text-primary">3. biarkan 0 untuk kegiatan yang tidak dianggarkan, kemudian
                                klik kirim data</small><br>
                            <small class="text-primary">4. pastikan total jumlah anggaran bidang/sub/kegiatan = total
                                jumlah
                                anggaran belanja, kemudian
                                klik kirim data</small>
                        </th>
                        <th class="text-center"><button class="btn btn-primary" type="submit">KIRIM
                                DATA</button></th>
                    </tr>
                </tfoot>

            </table>
        </form>
    </div>
</div>
@if(session()->has('selisih'))
<script>
    Swal.fire({
position: 'center',
icon: 'error',
title: '{{ session("selisih") }}',
showConfirmButton: true
})
</script>

@endif

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    $('.a_k').mask('000.000.000.000.000', {reverse: true});
    $('#AkunB').mask('000.000.000.000.000', {reverse: true});

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
    });

    $('#kirimKeg').on('submit', function(e){
        e.preventDefault();
        
       $.post('/adminDesa/cekKegiatanA', $(this).serialize()).done(function(data){
          if(data){
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Data Berhasil Dikirim',
                showConfirmButton: false,
                timer: 1500
                });
                document.location.reload();
          }else{
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Jumlah Anggaran Bidang/Keg/Sub tidak sama dengan Total Jumlah Belanja!',
                showConfirmButton: true
                });
           
          }
       })

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