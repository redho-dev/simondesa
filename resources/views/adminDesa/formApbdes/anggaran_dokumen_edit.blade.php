<div class="mt-2">

</div>
<div class="row">
    <div class="col-md-9">
        <p class="alert alert-info">Form Update Data (Dokumen) APBDes TA {{ $tahun }}</p>
        <form action="/adminDesa/updateDokumenA" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">

            <table class="table table-bordered">
                <thead>
                    <tr class="bg-success">
                        <th width="5%" style="vertical-align: middle">No</th>
                        <th style="vertical-align: middle" width="40%">
                            Nama Data
                        </th>
                        <th width="20%" class="text-center">
                            Isi Data / Dokumen
                        </th>
                        <th width="35%">Ganti Data / Dokumen</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th style="vertical-align: middle">1.</th>
                        <th style="vertical-align: middle">Nomor dan Tahun Perdes tentang APBDes TA {{ $tahun }}</th>
                        <th class="text-center" style="vertical-align: middle">{{ $apbdes_doks[0]->nomor_perdes_murni }}
                        </th>
                        <th width="50%">
                            @error('nomor_perdes_murni')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" name="nomor_perdes_murni" class="form-control"
                                value="{{ old('nomor_perdes_murni', $apbdes_doks[0]->nomor_perdes_murni) }}" autofocus
                                style="font-size: .85rem">
                        </th>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle">2.</th>
                        <th style="vertical-align: middle">Tanggal Penetapan Perdes APBDes TA {{ $tahun }}</th>
                        <th class="text-center" style="vertical-align: middle">{{ $apbdes_doks[0]->tanggal_murni }}</th>
                        <th class="text-center" style="vertical-align: middle">
                            @error('tanggal_murni')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" name="tanggal_murni" class="form-control"
                                data-inputmask="'mask': '99/99/9999'"
                                value="{{ old('tanggal_murni', $apbdes_doks[0]->tanggal_murni) }}"
                                style="font-size: .85rem">
                        </th>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle">3.</th>
                        <th style="vertical-align: middle">Dokumen APBDes TA {{ $tahun }} <br>(Perdes dan Lampiran)</th>
                        <th class="text-center" style="vertical-align: middle">
                            <div class="pr-2">
                                @if($apbdes_doks[0]->dokumen_murni)
                                <a href="{{ asset('storage/'.$apbdes_doks[0]->dokumen_murni) }}" target="_blank">
                                    <img src="/img/logo-pdf.webp" width="100px">
                                    <input type="hidden" name="old_1" value="{{ $apbdes_doks[0]->dokumen_murni }}">
                                </a>
                                @else
                                <div class="text-danger">(data kosong)</div>
                                @endif
                            </div>
                        </th>
                        <th>

                            @error('dokumen_murni')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="dokumen_murni" class="custom-file-input"
                                        id="dokumen_murni">
                                    <label class="custom-file-label text-muted dokumen_murni" for="dokumen_murni"
                                        style="font-size: .75rem">Ganti
                                        file PDF
                                        (max-size: 20MB)</label>
                                </div>
                            </div>
                        </th>
                    </tr>

                    <tr>
                        <th style="vertical-align: middle">4.</th>
                        <th style="vertical-align: middle">Dokumen Penjabaran APBDes TA {{ $tahun }} <br>(Perkades dan
                            Lampiran)</th>
                        <th class="text-center" style="vertical-align: middle">
                            <div class="pr-2">
                                @if($apbdes_doks[0]->dokumen_penjabaran_murni)
                                <a href="{{ asset('storage/'.$apbdes_doks[0]->dokumen_penjabaran_murni) }}"
                                    target="_blank">
                                    <img src="/img/logo-pdf.webp" width="100px">
                                    <input type="hidden" name="old_2"
                                        value="{{ $apbdes_doks[0]->dokumen_penjabaran_murni }}">
                                </a>
                                @else
                                <div class="text-danger">(data kosong)</div>
                                @endif
                            </div>
                        </th>
                        <th>

                            @error('dokumen_penjabaran_murni')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="dokumen_penjabaran_murni" class="custom-file-input"
                                        id="dokumen_penjabaran_murni">
                                    <label class="custom-file-label text-muted dokumen_penjabaran_murni"
                                        for="dokumen_penjabaran_murni" style="font-size: .75rem">Ganti
                                        file PDF
                                        (max-size: 20MB)</label>
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle">5.</th>
                        <th style="vertical-align: middle">Analisa, Gambar dan RAB <br>(Seluruh Pembangunan Fisik APBDes
                            Murni TA {{ $tahun }})</th>
                        <th class="text-center" style="vertical-align: middle">
                            <div class="pr-2">
                                @if($apbdes_doks[0]->desain_gambar_murni)
                                <a href="{{ asset('storage/'.$apbdes_doks[0]->desain_gambar_murni) }}" target="_blank">
                                    <img src="/img/logo-pdf.webp" width="100px">
                                    <input type="hidden" name="old_3"
                                        value="{{ $apbdes_doks[0]->desain_gambar_murni }}">
                                </a>
                                @else
                                <p class="text-danger">(data kosong)</p>
                                @endif
                            </div>
                        </th>
                        <th>
                            @error('desain_gambar')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="desain_gambar" class="custom-file-input"
                                        id="desain_gambar">
                                    <label class="custom-file-label text-muted desain_gambar" for="desain_gambar"
                                        style="font-size: .75rem">Ganti
                                        file PDF
                                        (max-size: 10MB)</label>
                                </div>
                            </div>

                        </th>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-info">Catatan : Dokumen APBDes yg diupload adalah print out
                            Siskeudes</th>
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