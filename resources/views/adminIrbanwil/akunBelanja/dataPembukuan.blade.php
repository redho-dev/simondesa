<p class="text-info">Form Upload Data Buku Pembantu Bank TA {{ $tahun }}</p>
<div class="row">
    <div class="col-md-7">
        <table class="table table-bordered">
            <thead style="background-color: beige">
                <tr>
                    <th>#</th>
                    <th>Nama Data</th>
                    <th class="text-center">Dokumen</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>1</th>
                    <th>Buku Kas Umum Bulan Januari s.d Juni (Semester 1)</th>
                    <th class="text-center">
                        @if($bku_semester1)
                        <a href="{{ asset('storage/'.$bku_semester1->file_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @endif
                    </th>

                </tr>
                <tr>
                    <th>2</th>
                    <th>Buku Pembantu Panjar Semester 1</th>
                    <th class="text-center">
                        @if($bp_semester1)
                        <a href="{{ asset('storage/'.$bp_semester1->file_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @endif
                    </th>

                </tr>
                <tr>
                    <th>3</th>
                    <th>Buku Kas Umum Bulan Juli s.d Desember (Semester 2)</th>
                    <th class="text-center">
                        @if($bku_semester2)
                        <a href="{{ asset('storage/'.$bku_semester2->file_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @endif
                    </th>

                </tr>
                <tr>
                    <th>4</th>
                    <th>Buku Pembantu Panjar Semester 2</th>
                    <th class="text-center">
                        @if($bp_semester2)
                        <a href="{{ asset('storage/'.$bp_semester2->file_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @endif
                    </th>

                </tr>


            </tbody>


        </table>

    </div>
</div>
<hr>


@push('script')
<script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    bsCustomFileInput.init();
    
    $('.file_pembukuan').on('change', function(){
        var dafile = $(this).val();
        getURL(this, dafile);
    })

                        function getURL(input, dafile) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                var filename = dafile;
                                
                                filename = filename.substring(filename.lastIndexOf('\\') + 1);
                                var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
                                if (cekgb == 'pdf' || cekgb == 'PDF') {
                                    if(input.files[0]['size'] > 2048000){
                                        alert('ukuran file tidak boleh > 2 MB !');
                                        $('.file_pembukuan').val("");
                                        $('.labfile').html("Choose file PDF (max-size: 2 MB)");
                                    }else{
                                        
                                    }
                                    
                                }else {
                                    alert ("file harus berjenis 'pdf' ");
                                    $('.file_pembukuan').val("");
                                    $('.labfile').html("Choose PDF (max-size: 2 MB)");
                                    
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
                                        $('.semester_2').html("Choose file PDF (max-size: 5 MB)");
                                    }else{
                                        
                                    }
                                    
                                }else {
                                    alert ("file harus berjenis 'pdf' ");
                                    $('#semester_2').val("");
                                    $('.semester_2').html("Choose PDF (max-size: 5 MB)");
                                    
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