<p class="text-info">Form Edit/Ganti Data Buku Pembantu Bank TA {{ $tahun }}</p>
<div class="row">
    <div class="col-md-9">
        <form action="/adminDesa/updateBukuBank" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <table class="table table-bordered">
                <thead style="background-color: beige">
                    <tr>
                        <th>#</th>
                        <th>Jenis Data</th>
                        <th class="text-center">dokumen</th>
                        <th>Upload/Ganti Data</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1</th>
                        <th>Print-Out Buku Pembantu Bank Bulan Januari s.d Juni (Semester 1)</th>
                        <th class="text-center">
                            @if($bukubanks->semester_1)
                            <a href="{{ asset('storage/'.$bukubanks->semester_1) }}" target="_blank"> <img
                                    src="/img/logo-pdf.jpg" width="50px"></a>
                            <input type="hidden" name="old_1" value="{{ $bukubanks->semester_1  }}">
                            @endif
                        </th>
                        <th>
                            <div class="form-group mb-4">
                                @error('semester_1')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="custom-file">
                                    <input type="file" name="semester_1" class="custom-file-input" id="semester_1">
                                    <label class="custom-file-label semester_1" for="semester_1">File pdf
                                        (Max: 5 MB)</label>
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>2</th>
                        <th>Print-Out Buku Pembantu Bank Bulan Juli s.d Desember (Semester 2)</th>
                        <th class="text-center">
                            @if($bukubanks->semester_2)
                            <a href="{{ asset('storage/'.$bukubanks->semester_2) }}" target="_blank">
                                <img src="/img/logo-pdf.jpg" width="50px"></a>
                            <input type="hidden" name="old_2" value="{{ $bukubanks->semester_2  }}">
                            @endif
                        </th>
                        <th>
                            <div class="form-group mb-4">
                                <div class="custom-file">
                                    <input type="file" name="semester_2" class="custom-file-input" id="semester_2">
                                    <label class="custom-file-label semester_2" for="semester_2"
                                        style="overflow: hidden">File pdf
                                        (Max: 5 MB)</label>
                                </div>
                            </div>
                        </th>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-right">
                            <button class="btn btn-primary" type="submit">UPDATE DATA</button>
                        </th>
                    </tr>
                </tfoot>

            </table>
        </form>
    </div>
</div>
<hr>


@push('script')
<script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    bsCustomFileInput.init();
    
    $('#semester_1').on('change', function(){
        getURL(this);
    })

                        function getURL(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                var filename = $("#semester_1").val();
                                
                                filename = filename.substring(filename.lastIndexOf('\\') + 1);
                                var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                                if (cekgb == 'pdf' || cekgb == 'PDF') {
                                    if(input.files[0]['size'] > 5120000){
                                        alert('ukuran file tidak boleh > 5 MB !');
                                        $('#semester_1').val("");
                                        $('.semester_1').html("Choose file PDF (max-size: 5MB)");
                                    }else{
                                        
                                    }
                                    
                                }else {
                                    alert ("file harus berjenis 'pdf' ");
                                    $('#semester_1').val("");
                                    $('.semester_1').html("Choose PDF (max-size: 5MB)");
                                    
                                }
                                
                                
                            }
                    
                        }

     $('#semester_2').on('change', function(){
        getURL2(this);
    })

                        function getURL2(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                var filename = $("#semester_2").val();
                                
                                filename = filename.substring(filename.lastIndexOf('\\') + 1);
                                var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                                if (cekgb == 'pdf' || cekgb == 'PDF') {
                                    if(input.files[0]['size'] > 5120000){
                                        alert('ukuran file tidak boleh > 5 MB !');
                                        $('#semester_2').val("");
                                        $('.semester_2').html("Choose file PDF (max-size: 5MB)");
                                    }else{
                                        
                                    }
                                    
                                }else {
                                    alert ("file harus berjenis 'pdf' ");
                                    $('#semester_2').val("");
                                    $('.semester_2').html("Choose PDF (max-size: 5MB)");
                                    
                                }
                                
                                
                            }
                    
                        }
 
</script>
@error('file_data')
<script>
    Swal.fire({
    position: 'center',
    icon: 'error',
    title: 'Failed!, {{ $message }}',
    showConfirmButton: true
    })
</script>
@enderror
@endpush