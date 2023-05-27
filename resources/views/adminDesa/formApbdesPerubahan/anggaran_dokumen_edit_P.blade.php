<div class="mt-2">
    <p class="text-info">Form Update Data (Dokumen) APBDes TA {{ $tahun }} Perubahan</p>
</div>
<div class="row">
    <div class="col-md-8">
        <form action="/adminDesa/tambahDokumenP" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <style>
                label {
                    overflow: hidden;
                }
            </style>
            <table class="table table-bordered">
                <thead>
                    <tr style="background-color: rgb(183, 197, 197)">
                        <th width="5%" style="vertical-align: middle">No</th>
                        <th width="45" style="vertical-align: middle">
                            Nama Data
                        </th>
                        <th width="50%" class="text-center" colspan="2">
                            Isi Data/Dokumen
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th style="vertical-align: middle">1.</th>
                        <th style="vertical-align: middle">Nomor dan Tahun Perdes tentang APBDes TA {{ $tahun }}
                            Perubahan</th>
                        <th colspan="2">
                            @error('nomor_perdes_perubahan')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" name="nomor_perdes_perubahan" class="form-control"
                                value="{{ old('nomor_perdes_perubahan', $apbdes_doks[0]->nomor_perdes_perubahan) }}"
                                autofocus style="font-size: .85rem">
                        </th>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle">2.</th>
                        <th style="vertical-align: middle">Tanggal Penetapan Perdes APBDes TA {{ $tahun }} Perubahan
                        </th>
                        <th colspan="2">
                            @error('tanggal_perubahan')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" name="tanggal_perubahan" class="form-control"
                                data-inputmask="'mask': '99/99/9999'"
                                value="{{ old('tanggal_perubahan', $apbdes_doks[0]->tanggal_perubahan) }}"
                                style="font-size: .85rem">
                        </th>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle">3.</th>
                        <th style="vertical-align: middle">Dokumen APBDes TA {{ $tahun }} Perubahan</th>
                        <th width="15%" class="text-center">
                            <div class="pr-2">
                                @if($apbdes_doks[0]->dokumen_perubahan)
                                <a href="{{ asset('storage/'.$apbdes_doks[0]->dokumen_perubahan) }}" target="_blank">
                                    <img src="/img/logo-pdf.jpg" width="50px">
                                    <input type="hidden" name="old_1" value="{{ $apbdes_doks[0]->dokumen_perubahan }}">
                                </a>
                                @else
                                <div class="text-danger">(data kosong)</div>
                                @endif
                            </div>
                        </th>
                        <th>
                            @error('dokumen_perubahan')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="dokumen_perubahan" class="custom-file-input"
                                        id="dokumen_perubahan">
                                    <label class="custom-file-label text-muted dokumen_perubahan"
                                        for="dokumen_perubahan" style="font-size: .75rem">Ganti
                                        file PDF
                                        (max-size: 20MB)</label>
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle">4.</th>
                        <th style="vertical-align: middle">Dokumen Penjabaran APBDes TA {{ $tahun }} Perubahan</th>
                        <th class="text-center">
                            <div class="pr-2">
                                @if($apbdes_doks[0]->dokumen_penjabaran_perubahan)
                                <a href="{{ asset('storage/'.$apbdes_doks[0]->dokumen_penjabaran_perubahan) }}"
                                    target="_blank">
                                    <img src="/img/logo-pdf.webp" width="100px">
                                    <input type="hidden" name="old_2"
                                        value="{{ $apbdes_doks[0]->dokumen_penjabaran_perubahan }}">
                                </a>
                                @else
                                <div class="text-danger">(data kosong)</div>
                                @endif
                            </div>
                        </th>
                        <th>
                            @error('dokumen_penjabaran_perubahan')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="dokumen_penjabaran_perubahan" class="custom-file-input"
                                        id="dokumen_penjabaran_perubahan">
                                    <label class="custom-file-label text-muted dokumen_penjabaran_perubahan"
                                        for="dokumen_penjabaran_perubahan" style="font-size: .75rem">Ganti
                                        file PDF
                                        (max-size: 20MB)</label>
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle">5.</th>
                        <th style="vertical-align: middle">Analisa, Gambar dan RAB Pembangunan Fisik Perubahan</th>
                        <th class="text-center">
                            <div class="pr-2">
                                @if($apbdes_doks[0]->desain_gambar_perubahan)
                                <a href="{{ asset('storage/'.$apbdes_doks[0]->desain_gambar_perubahan) }}"
                                    target="_blank">
                                    <img src="/img/logo-pdf.webp" width="100px">
                                    <input type="hidden" name="old_2"
                                        value="{{ $apbdes_doks[0]->desain_gambar_perubahan }}">
                                </a>
                                @else
                                <div class="text-danger">(data kosong)</div>
                                @endif
                            </div>
                        </th>
                        <th>
                            @error('desain_perubahan')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="desain_perubahan" class="custom-file-input"
                                        id="desain_perubahan">
                                    <label class="custom-file-label text-muted desain_perubahan" for="desain_perubahan"
                                        style="font-size: .75rem">Ganti
                                        file PDF
                                        (max-size: 20MB)</label>
                                </div>
                            </div>
                        </th>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-info">Catatan : Dokumen APBDes Perubahan yg diupload adalah print
                            out
                            Siskeudes</th>
                        <th class="text-center"><button class="btn btn-primary" type="submit">UPDATE
                                DATA</button></th>
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
  title: 'Data Berhasil di Update',
  showConfirmButton: false,
  timer: 1500
})
</script>

@endif

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