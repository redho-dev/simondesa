<p class="text-info">Form Upload Data Buku Pembantu Bank TA {{ $tahun }}</p>
<div class="row">
    <div class="col-md-9">

        <table class="table table-bordered">
            <thead style="background-color: beige">
                <tr>
                    <th>#</th>
                    <th>Nama Data</th>
                    <th class="text-center">File Data</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>1</th>
                    <th>Buku Pembantu Bank Bulan Januari s.d Juni (Semester 1)</th>
                    <th class="text-center">
                        @if($bukuBank1)
                        <a href="{{ asset('storage/'.$bukuBank1->file_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @endif
                    </th>
                    <th class="text-center">
                        @if($bukuBank1)
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#bb1_edit">
                            Update
                        </button>
                        <a href="/adminDesa/hapusBukubank/{{ $bukuBank1->id }}" class="btn btn-danger btn-sm">Hapus</a>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#bb1">
                            Upload
                        </button>
                        @endif

                    </th>
                    <!-- Modal -->
                    <div class="modal fade" id="bb1" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Upload Buku
                                        Pembantu Bank
                                        Semester 1</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/bukuBankTambah" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="semester_1">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="semester_1"
                                                class="custom-file-input file_pembukuan" id="customFile" required>
                                            <label class="custom-file-label labfile" for="customFile">Choose file
                                                PDF Max (3
                                                MB)</label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">KIRIM</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if($bukuBank1)
                    <!-- Modal Edit-->
                    <div class="modal fade" id="bb1_edit" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Update Buku
                                        Pembantu Bank
                                        Semester 1</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/bukuBankEdit" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="semester_1">
                                    <input type="hidden" name="old" value="{{ $bukuBank1->file_data }}">
                                    <input type="hidden" name="id" value="{{ $bukuBank1->id }}">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="semester_1"
                                                class="custom-file-input file_pembukuan" id="customFile" required>
                                            <label class="custom-file-label labfile" for="customFile">Choose file
                                                PDF Max (3
                                                MB)</label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">UPDATE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </tr>
                <tr>
                    <th>2</th>
                    <th>Buku Pembantu Bank Bulan Juli s.d Desember (Semester 2)</th>
                    <th class="text-center">
                        @if($bukuBank2)
                        <a href="{{ asset('storage/'.$bukuBank2->file_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @endif
                    </th>
                    <th class="text-center">
                        @if($bukuBank2)
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#bb2_edit">
                            Update
                        </button>
                        <a href="/adminDesa/hapusBukubank/{{ $bukuBank2->id }}" class="btn btn-danger btn-sm">Hapus</a>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#bb2">
                            Upload
                        </button>
                        @endif

                    </th>
                    <!-- Modal -->
                    <div class="modal fade" id="bb2" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Upload Buku
                                        Pembantu Bank
                                        Semester 2</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/bukuBankTambah" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="semester_2">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="semester_2"
                                                class="custom-file-input file_pembukuan" id="customFile" required>
                                            <label class="custom-file-label labfile" for="customFile">Choose file
                                                PDF Max (3
                                                MB)</label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">KIRIM</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if($bukuBank2)
                    <!-- Modal Edit-->
                    <div class="modal fade" id="bb2_edit" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Update Buku
                                        Pembantu Bank
                                        Semester 2</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/bukuBankEdit" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="semester_2">
                                    <input type="hidden" name="old" value="{{ $bukuBank2->file_data }}">
                                    <input type="hidden" name="id" value="{{ $bukuBank2->id }}">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="semester_2"
                                                class="custom-file-input file_pembukuan" id="customFile" required>
                                            <label class="custom-file-label labfile" for="customFile">Choose file
                                                PDF Max (3
                                                MB)</label>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary btn-sm">UPDATE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
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
                                    if(input.files[0]['size'] > 3072000){
                                        alert('ukuran file tidak boleh > 3 MB !');
                                        $('.file_pembukuan').val("");
                                        $('.labfile').html("Choose file PDF (max-size: 3 MB)");
                                    }else{
                                        
                                    }
                                    
                                }else {
                                    alert ("file harus berjenis 'pdf' ");
                                    $('.file_pembukuan').val("");
                                    $('.labfile').html("Choose PDF (max-size: 3 MB)");
                                    
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