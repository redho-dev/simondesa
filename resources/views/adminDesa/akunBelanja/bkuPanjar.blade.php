<p class="text-info">Form Upload Data Buku Pembantu Bank TA {{ $tahun }}</p>
<div class="row">
    <div class="col-md-9">
        <table class="table table-bordered">
            <thead style="background-color: beige">
                <tr>
                    <th>#</th>
                    <th>Nama Data</th>
                    <th class="text-center">Dokumen</th>
                    <th class="text-center">Aksi</th>
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
                    <th class="text-center">
                        @if($bku_semester1)
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#bku_1_edit">
                            Update
                        </button>
                        <a href="/adminDesa/hapusPembukuan/{{ $bku_semester1->id }}"
                            class="btn btn-danger btn-sm">Hapus</a>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#bku_1">
                            Upload
                        </button>
                        @endif

                    </th>
                    <!-- Modal -->
                    <div class="modal fade" id="bku_1" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Upload BKU
                                        Semester 1</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/pembukuanTambah" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="bku_semester1">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="bku_semester1"
                                                class="custom-file-input file_pembukuan" id="customFile" required>
                                            <label class="custom-file-label labfile" for="customFile">Choose file
                                                PDF Max (2
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
                    @if($bku_semester1)
                    <!-- Modal Edit-->
                    <div class="modal fade" id="bku_1_edit" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Update BKU
                                        Semester 1</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/pembukuanEdit" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="bku_semester1">
                                    <input type="hidden" name="old" value="{{ $bku_semester1->file_data }}">
                                    <input type="hidden" name="id" value="{{ $bku_semester1->id }}">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="bku_semester1"
                                                class="custom-file-input file_pembukuan" id="customFile" required>
                                            <label class="custom-file-label labfile" for="customFile">Choose file
                                                PDF Max (2
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
                    <th>Buku Pembantu Panjar Semester 1</th>
                    <th class="text-center">
                        @if($bp_semester1)
                        <a href="{{ asset('storage/'.$bp_semester1->file_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @endif
                    </th>
                    <th class="text-center">
                        @if($bp_semester1)
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#bku_3_edit">
                            Update
                        </button>
                        <a href="/adminDesa/hapusPembukuan/{{ $bp_semester1->id }}"
                            class="btn btn-danger btn-sm">Hapus</a>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#bku_3">
                            Upload
                        </button>
                        @endif

                    </th>
                    <!-- Modal -->
                    <div class="modal fade" id="bku_3" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Upload Buku
                                        Pembantu Panjar Semester 1</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/pembukuanTambah" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="buku_pembantu_panjar_semester1">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="buku_pembantu_panjar_semester1"
                                                class="custom-file-input file_pembukuan" id="customFile" required>
                                            <label class="custom-file-label labfile" for="customFile">Choose file
                                                PDF Max (2
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
                    @if($bp_semester1)
                    <!-- Modal Edit-->
                    <div class="modal fade" id="bku_3_edit" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Update Buku
                                        Pembantu Panjar Semester 1</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/pembukuanEdit" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="buku_pembantu_panjar_semester1">
                                    <input type="hidden" name="old" value="{{ $bp_semester1->file_data }}">
                                    <input type="hidden" name="id" value="{{ $bp_semester1->id }}">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="buku_pembantu_panjar_semester1"
                                                class="custom-file-input file_pembukuan" id="customFile" required>
                                            <label class="custom-file-label labfile" for="customFile">Choose file
                                                PDF Max (2
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
                    <th>3</th>
                    <th>Buku Kas Umum Bulan Juli s.d Desember (Semester 2)</th>
                    <th class="text-center">
                        @if($bku_semester2)
                        <a href="{{ asset('storage/'.$bku_semester2->file_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @endif
                    </th>
                    <th class="text-center">
                        @if($bku_semester2)
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#bku_2_edit">
                            Update
                        </button>
                        <a href="/adminDesa/hapusPembukuan/{{ $bku_semester2->id }}"
                            class="btn btn-danger btn-sm">Hapus</a>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#bku_2">
                            Upload
                        </button>
                        @endif

                    </th>
                    <!-- Modal -->
                    <div class="modal fade" id="bku_2" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Upload BKU
                                        Semester 2</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/pembukuanTambah" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="bku_semester2">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="bku_semester2"
                                                class="custom-file-input file_pembukuan" id="customFile" required>
                                            <label class="custom-file-label labfile" for="customFile">Choose file
                                                PDF Max (2
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
                    @if($bku_semester2)
                    <!-- Modal Edit-->
                    <div class="modal fade" id="bku_2_edit" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Update BKU
                                        Semester 2</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/pembukuanEdit" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="bku_semester2">
                                    <input type="hidden" name="old" value="{{ $bku_semester2->file_data }}">
                                    <input type="hidden" name="id" value="{{ $bku_semester2->id }}">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="bku_semester2"
                                                class="custom-file-input file_pembukuan" id="customFile" required>
                                            <label class="custom-file-label labfile" for="customFile">Choose file
                                                PDF Max (2
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
                    <th>4</th>
                    <th>Buku Pembantu Panjar Semester 2</th>
                    <th class="text-center">
                        @if($bp_semester2)
                        <a href="{{ asset('storage/'.$bp_semester2->file_data) }}" target="_blank">
                            <img src="/img/logo-pdf.jpg" width="50px">
                        </a>
                        @endif
                    </th>
                    <th class="text-center">
                        @if($bp_semester2)
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#bku_4_edit">
                            Update
                        </button>
                        <a href="/adminDesa/hapusPembukuan/{{ $bp_semester2->id }}"
                            class="btn btn-danger btn-sm">Hapus</a>
                        @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#bku_4">
                            Upload
                        </button>
                        @endif

                    </th>
                    <!-- Modal -->
                    <div class="modal fade" id="bku_4" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Upload Buku
                                        Pembantu Panjar Semester 2</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/pembukuanTambah" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="buku_pembantu_panjar_semester2">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="buku_pembantu_panjar_semester2"
                                                class="custom-file-input file_pembukuan" id="customFile" required>
                                            <label class="custom-file-label labfile" for="customFile">Choose file
                                                PDF Max (2
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
                    @if($bp_semester2)
                    <!-- Modal Edit-->
                    <div class="modal fade" id="bku_4_edit" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-light" id="staticBackdropLabel">Form Update Buku
                                        Pembantu Panjar Semester 2</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/adminDesa/pembukuanEdit" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="nama_data" value="buku_pembantu_panjar_semester2">
                                    <input type="hidden" name="old" value="{{ $bp_semester2->file_data }}">
                                    <input type="hidden" name="id" value="{{ $bp_semester2->id }}">
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" name="buku_pembantu_panjar_semester2"
                                                class="custom-file-input file_pembukuan" id="customFile" required>
                                            <label class="custom-file-label labfile" for="customFile">Choose file
                                                PDF Max (2
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