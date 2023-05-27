<div class="mt-2">
    <p class="text-info">Form Input Data (Dokumen) APBDes TA {{ $tahun }} Perubahan</p>
</div>
<div class="row">
    <div class="col-md-8">
        <form action="/adminDesa/tambahDokumenP" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">

            <table class="table table-bordered">
                <thead>
                    <tr style="background-color: rgb(183, 197, 197)">
                        <th width="5%" style="vertical-align: middle">#</th>
                        <th style="vertical-align: middle">
                            <h4>Jenis Data</h4>
                        </th>
                        <th width="40%" class="text-center">
                            <h4>Data</h4>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1.</th>
                        <th>Nomor dan Tahun Perdes tentang APBDes TA {{ $tahun }} Perubahan</th>
                        <th width="30%">
                            @error('nomor_perdes_perubahan')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" name="nomor_perdes_perubahan" class="form-control"
                                value="{{ old('nomor_perdes_perubahan') }}" autofocus required
                                style="font-size: .85rem">
                        </th>
                    </tr>
                    <tr>
                        <th>2.</th>
                        <th>Tanggal Penetapan Perdes APBDes TA {{ $tahun }} Perubahan</th>
                        <th>
                            @error('tanggal_perubahan')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" name="tanggal_perubahan" class="form-control"
                                data-inputmask="'mask': '99/99/9999'" value="{{ old('tanggal_perubahan') }}" required
                                style="font-size: .85rem">
                        </th>
                    </tr>
                    <tr>
                        <th>3.</th>
                        <th>Dokumen APBDes TA {{ $tahun }} Perubahan <br>(Perdes dan Lampiran)</th>
                        <th>
                            @error('dokumen_perubahan')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="dokumen_perubahan" class="custom-file-input"
                                        id="dokumen_perubahan" required>
                                    <label class="custom-file-label text-muted dokumen_perubahan"
                                        for="dokumen_perubahan">Choose
                                        file PDF
                                        (max-size: 20MB)</label>
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>4.</th>
                        <th>Dokumen Penjabaran APBDes TA {{ $tahun }} Perubahan <br>(Perkades dan Lampiran)</th>
                        <th>
                            @error('dokumen_penjabaran_perubahan')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="dokumen_penjabaran_perubahan" class="custom-file-input"
                                        id="dokumen_penjabaran_perubahan">
                                    <label class="custom-file-label text-muted dokumen_penjabaran_perubahan"
                                        for="dokumen_penjabaran_perubahan">Choose
                                        file PDF
                                        (max-size: 20MB)</label>
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>5.</th>
                        <th>Analisa, Gambar dan RAB Pembangunan Fisik Perubahan</th>
                        <th>
                            @error('desain_perubahan')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="desain_perubahan" class="custom-file-input"
                                        id="desain_perubahan">
                                    <label class="custom-file-label text-muted desain_perubahan"
                                        for="desain_perubahan">Choose
                                        file PDF
                                        (max-size: 20MB)</label>
                                </div>
                            </div>
                        </th>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" class="text-info">Catatan : Dokumen APBDes Perubahan yg diupload adalah print
                            out
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
    $('#dokumen_penjabaran_perubahan').on('change', function(){
        getURL(this);
    })

    function getURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = $("#dokumen_penjabaran_perubahan").val();
            
            filename = filename.substring(filename.lastIndexOf('\\') + 1);
            var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
            if (cekgb == 'pdf' || cekgb == 'PDF') {
                if(input.files[0]['size'] > 20480000){
                    alert('ukuran file tidak boleh > 20 Mb !');
                    $('#dokumen_penjabaran_perubahan').val("");
                    $('.dokumen_penjabaran_perubahan').html("Choose file PDF (max-size: 20MB)");
                }else{
                    
                }
                
            }else {
                alert ("file harus berjenis 'pdf' ");
                $('#dokumen_penjabaran_perubahan').val("");
                $('.dokumen_penjabaran_perubahan').html("Choose file PDF (max-size: 20MB)");
                
            }
            
            
        }

    }

    $('#dokumen_perubahan').on('change', function(){
        getURL2(this);
    })

    function getURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = $("#dokumen_perubahan").val();
            
            filename = filename.substring(filename.lastIndexOf('\\') + 1);
            var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
            if (cekgb == 'pdf' || cekgb == 'PDF') {
                if(input.files[0]['size'] > 20480000){
                    alert('ukuran file tidak boleh > 20 Mb !');
                    $('#dokumen_perubahan').val("");
                    $('.dokumen_perubahan').html("Choose file PDF (max-size: 20MB)");
                }else{
                    
                }
                
            }else {
                alert ("file harus berjenis 'pdf' ");
                $('#dokumen_perubahan').val("");
                $('.dokumen_perubahan').html("Choose file PDF (max-size: 20MB)");
                
            }
            
            
        }

    }


    $('#desain_perubahan').on('change', function(){
        getURL3(this);
    })

    function getURL3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = $("#desain_perubahan").val();
            
            filename = filename.substring(filename.lastIndexOf('\\') + 1);
            var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
            if (cekgb == 'pdf' || cekgb == 'PDF') {
                if(input.files[0]['size'] > 20480000){
                    alert('ukuran file tidak boleh > 20 MB !');
                    $('#desain_perubahan').val("");
                    $('.desain_perubahan').html("Choose file PDF (max-size: 20MB)");
                }else{
                    
                }
                
            }else {
                alert ("file harus berjenis 'pdf' ");
                $('#desain_perubahan').val("");
                $('.desain_perubahan').html("Choose file PDF (max-size: 20MB)");
                
            }
            
            
        }

    }
</script>
@endpush