<div class="row">
    <div class="col-md-8">
        <p class="alert alert-primary">Form Input Data (Dokumen) APBDes TA {{ $tahun }}</p>
        <form action="/adminDesa/tambahDokumenA" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">

            <table class="table table-bordered">
                <thead>
                    <tr class="bg-info">
                        <th width="5%" style="vertical-align: middle">#</th>
                        <th style="vertical-align: middle">
                            Nama Data
                        </th>
                        <th width="40%" class="text-center">
                            Input Data / Upload Dokumen
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1.</th>
                        <th>Nomor dan Tahun Perdes tentang APBDes TA {{ $tahun }}</th>
                        <th width="30%">
                            @error('nomor_perdes_murni')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" name="nomor_perdes_murni" class="form-control"
                                value="{{ old('nomor_perdes_murni') }}" autofocus required style="font-size: .85rem">
                        </th>
                    </tr>
                    <tr>
                        <th>2.</th>
                        <th>Tanggal Penetapan Perdes APBDes TA {{ $tahun }}</th>
                        <th>
                            @error('tanggal_murni')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" name="tanggal_murni" class="form-control"
                                data-inputmask="'mask': '99/99/9999'" value="{{ old('tanggal_murni') }}" required
                                style="font-size: .85rem">
                        </th>
                    </tr>
                    <tr>
                        <th>3.</th>
                        <th>Dokumen APBDes TA {{ $tahun }} <br>(Perdes dan Lampiran)</th>
                        <th>
                            @error('dokumen_murni')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="dokumen_murni" class="custom-file-input" id="dokumen_murni"
                                        required>
                                    <label class="custom-file-label text-muted dokumen_murni" for="dokumen_murni">Choose
                                        file PDF
                                        (max-size: 20MB)</label>
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>4.</th>
                        <th>Dokumen Penjabaran APBDes TA {{ $tahun }} <br>(Perkades dan Lampiran)</th>
                        <th>
                            @error('dokumen_penjabaran_murni')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="dokumen_penjabaran_murni" class="custom-file-input"
                                        id="dokumen_penjabaran_murni">
                                    <label class="custom-file-label text-muted dokumen_penjabaran_murni"
                                        for="dokumen_penjabaran_murni">Choose
                                        file PDF
                                        (max-size: 20MB)</label>
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>5.</th>
                        <th>Analisa, Gambar dan RAB <br>(Seluruh Pembangunan Fisik APBDes Murni TA {{ $tahun }}) </th>
                        <th>
                            @error('desain_gambar')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="desain_gambar" class="custom-file-input"
                                        id="desain_gambar">
                                    <label class="custom-file-label text-muted desain_gambar" for="desain_gambar">Choose
                                        file PDF
                                        (max-size: 10MB)</label>
                                </div>
                            </div>
                        </th>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" class="text-info">Catatan : Dokumen APBDes yg diupload adalah print out
                            Siskeudes</th>
                        <th class="text-center"><button class="btn btn-primary" type="submit">KIRIM
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
    $('#dokumen_penjabaran_murni').on('change', function(){
        getURL(this);
    })

    function getURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = $("#dokumen_penjabaran_murni").val();
            
            filename = filename.substring(filename.lastIndexOf('\\') + 1);
            var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
            if (cekgb == 'pdf' || cekgb == 'PDF') {
                if(input.files[0]['size'] > 20480000){
                    alert('ukuran file tidak boleh > 20 Mb !');
                    $('#dokumen_penjabaran_murni').val("");
                    $('.dokumen_penjabaran_murni').html("Choose file PDF (max-size: 20MB)");
                }else{
                    
                }
                
            }else {
                alert ("file harus berjenis 'pdf' ");
                $('#dokumen_penjabaran_murni').val("");
                $('.dokumen_penjabaran_murni').html("Choose file PDF (max-size: 20MB)");
                
            }
            
            
        }

    }

    $('#dokumen_murni').on('change', function(){
        getURL2(this);
    })

    function getURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = $("#dokumen_murni").val();
            
            filename = filename.substring(filename.lastIndexOf('\\') + 1);
            var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
            if (cekgb == 'pdf' || cekgb == 'PDF') {
                if(input.files[0]['size'] > 20480000){
                    alert('ukuran file tidak boleh > 20 Mb !');
                    $('#dokumen_murni').val("");
                    $('.dokumen_murni').html("Choose file PDF (max-size: 20MB)");
                }else{
                    
                }
                
            }else {
                alert ("file harus berjenis 'pdf' ");
                $('#dokumen_murni').val("");
                $('.dokumen_murni').html("Choose file PDF (max-size: 20MB)");
                
            }
            
            
        }

    }

    $('#desain_gambar').on('change', function(){
        getURL3(this);
    })

    function getURL3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = $("#desain_gambar").val();
            
            filename = filename.substring(filename.lastIndexOf('\\') + 1);
            var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
            if (cekgb == 'pdf' || cekgb == 'PDF') {
                if(input.files[0]['size'] > 10240000){
                    alert('ukuran file tidak boleh > 10MB !');
                    $('#desain_gambar').val("");
                    $('.desain_gambar').html("Choose file PDF (max-size: 10MB)");
                }else{
                    
                }
                
            }else {
                alert ("file harus berjenis 'pdf' ");
                $('#desain_gambar').val("");
                $('.desain_gambar').html("Choose file PDF (max-size: 10MB)");
                
            }
            
            
        }

    }
</script>
@endpush