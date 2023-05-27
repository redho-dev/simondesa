@if($anggaran == 'murni')
<?php 
 $datot = $total_p->belanja_murni;
 $datang = 'anggaran_murni';
 ?>
@else
<?php 
 $datot = $total_p->belanja_perubahan;
 $datang = 'anggaran_perubahan';
 ?>
@endif
<h4 class="text-info mt-4 mb-4">Daftar TBPU/Kwitansi/BKP yang belum melampirkan Bukti Belanja TA {{
    $tahun }}
</h4>

<div class="row">
    <div class="col-md-10">
        <table class="table table-bordered">
            <tr style="background-color: azure">
                <th>#</th>
                <th>Nomor TBPU <br> Tanggal</th>
                <th>Jumlah Uang (Rp)</th>
                <th>Jenis Belanja /<br> Sbg Pembayaran</th>
                <th class="text-center">PPh</th>
                <th class="text-center">PPn</th>
                <th class="text-center">File_TBPU <br> (Kwitansi/BKP)</th>
                <th class="text-center">File_Lampiran <br>(Bukti Belanja)</th>
                <th class="text-center">Aksi</th>

            </tr>
            @foreach($tbpus as $bkp)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <ul class="pl-2">
                        <li>No : {{ $bkp->nomor }}</li>
                        <li>Tgl: {{ $bkp->tanggal }}</li>
                    </ul>
                </td>
                <td>{{ $bkp->jumlah }}</td>
                <td>
                    <ul class="pl-2">
                        <li> {{ $bkp->belanja->jenis_belanja }}</li>
                        <li>{{ $bkp->sebagai }}</li>
                    </ul>

                </td>
                <td>{{ $bkp->pph }}</td>
                <td>{{ $bkp->ppn }}</td>
                <td class="text-center">
                    <a href="{{ asset('storage/'.$bkp->file_bkp) }}" target="_blank"><img src="/img/logo-pdf.jpg"
                            width="35px"></a>
                </td>
                <td class="text-center">
                    @if($bkp->file_lampiran)
                    <a href="{{ asset('storage/'.$bkp->file_lampiran) }}" target="_blank"><img src="/img/logo-pdf.jpg"
                            width="35px"></a>
                    @else
                    <small class="text-danger">(kosong)</small>
                    @endif
                </td>
                <td class="text-center">
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#editTBPU{{ $bkp->id }}" style="font-size: .75rem">
                            Edit
                        </button>
                        <form action="/adminDesa/hapusTBPU/{{ $bkp->id }}" method="post">
                            @csrf
                            <button class="btn btn-danger btn-sm" type="submit"
                                onclick="return confirm('yakin hapus?');">hapus</button>
                        </form>
                    </div>
                </td>
                <!-- Modal -->
                <div class="modal fade" id="editTBPU{{ $bkp->id }}" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-dark" id="staticBackdropLabel">Form
                                    Edit/Update TBPU</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="/adminDesa/updateTBPU" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                <input type="hidden" name="tahun" value="{{ $tahun }}">
                                <input type="hidden" name="id" value="{{ $bkp->id }}">

                                <div class="modal-body">
                                    <div class="form-group mb-3">
                                        <label for="kegiatan">Nama Kegiatan</label>
                                        <input type="text" class="form-control" id="kegiatan"
                                            value="{{ $bkp->apbdes_kegiatan->kegiatan->kegiatan }}"
                                            style="font-size: .75rem" readonly>
                                    </div>
                                    <div class="form-group  mb-3">
                                        <label>Nomor Tanda Bukti Pengeluaran Uang</label>
                                        <input type="text" name="nomor" class="form-control" style="font-size: .75rem"
                                            value="{{ $bkp->nomor }}" required>
                                    </div>
                                    <div class="form-group  mb-3">
                                        <label>Jumlah Uang</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                                            </div>
                                            <input type="text" name="jumlah" class="form-control jumlah angka"
                                                id="inlineFormInputGroup" style="font-size: .75rem"
                                                value="{{ $bkp->jumlah }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group  mb-3">
                                        <label>Sebagai Pembayaran</label>
                                        <div class="input-group mb-2">
                                            <input type="text" name="sebagai" class="form-control sebagai"
                                                style="font-size: .75rem" value="{{ $bkp->sebagai }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="jenis_belanja">Jenis Belanja</label>
                                        <select class="form-control" name="belanja_id" id="jenis_belanja"
                                            style="font-size: .75rem" required>

                                            <option value="">==pilih jenis belanja==</option>
                                            <option value="1" {{ $bkp->belanja_id == 1 ?
                                                'selected' : '' }}>5.1 Belanja Pegawai</option>
                                            <option value="2" {{ $bkp->belanja_id == 2 ?
                                                'selected' : '' }}>5.2 Belanja Barang/Jasa
                                            </option>
                                            <option value="3" {{ $bkp->belanja_id == 3 ?
                                                'selected' : '' }}>5.3 Belanja Modal</option>
                                            <option value="4" {{ $bkp->belanja_id == 4 ?
                                                'selected' : '' }}>5.4 Belanja Tak Terduga
                                            </option>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6 mb-3">
                                            <label>Jumlah Potongan PPh</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text" style="font-size: .75rem">Rp.
                                                    </div>
                                                </div>
                                                <input type="text" name="pph" class="form-control pph angka" id="pph"
                                                    style="font-size: .75rem" placeholder="0" value="{{ $bkp->pph }}">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label>Jumlah Potongan PPn</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text" style="font-size: .75rem">Rp.
                                                    </div>
                                                </div>
                                                <input type="text" name="ppn" class="form-control ppn angka" id="ppn"
                                                    style="font-size: .75rem" placeholder="0" value="{{ $bkp->ppn }}">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group  mb-3">
                                        <label>Tanggal Tanda Bukti Pengeluaran Uang</label>
                                        <input type="date" name="tanggal" class="form-control" style="font-size: .75rem"
                                            value="{{ $bkp->tanggal }}" required>
                                    </div>
                                    <div class="form-group  mb-3 mt-4">
                                        <label>Ganti File Tanda Bukti Pengeluaran Uang
                                        </label>
                                        <div class="custom-file row">
                                            <div class="col-md-2">
                                                <a href="{{ asset('storage/'.$bkp->file_bkp) }}" target="_blank"><img
                                                        src="/img/logo-pdf.jpg" width="25px"></a>
                                                <input type="hidden" name="old_1" value="{{ $bkp->file_bkp }}">
                                            </div>
                                            <div class="col-md-10">
                                                <input type="file" name="file_bkp" class="custom-file-input file_bkp"
                                                    id="customFile ">
                                                <label class="custom-file-label nama_file" for="customFile"
                                                    style="font-size: .75rem">Pilih file PDF
                                                    max: 2MB</label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group  mb-3 mt-4">
                                        <label>Upload Lampiran TBPU (struk/nota/tanda terima/SPT/SPPD/Dokumen
                                            Pengadaan/lainnya)
                                        </label>
                                        <div class="custom-file row">
                                            <div class="col-md-2">
                                                @if($bkp->file_lampiran)
                                                <a href="{{ asset('storage/'.$bkp->file_lampiran) }}"
                                                    target="_blank"><img src="/img/logo-pdf.jpg" width="25px"></a>
                                                <input type="hidden" name="old_2" value="{{ $bkp->file_lampiran }}">
                                                @else
                                                <small class="text-danger">(kosong)</small>
                                                @endif
                                            </div>
                                            <div class="col-md-10">
                                                <input type="file" name="file_lampiran"
                                                    class="custom-file-input file_lampiran" id="customFile ">
                                                <label class="custom-file-label nama_file2" for="customFile"
                                                    style="font-size: .75rem">Upload/ganti file
                                                    PDF
                                                    max:
                                                    2MB</label>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">KIRIM
                                        DATA</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </tr>
            @endforeach
        </table>
    </div>
</div>
{{-- Akhir --}}
@push('script')
<script src="/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    bsCustomFileInput.init();
   



    $('.jumlah').mask('000.000.000.000.000', {reverse: true});
    $('.angka').mask('000.000.000.000.000', {reverse: true});



    $('.file_bkp').on('change', function(e){
        e.preventDefault();
        var file = $(this).val();
        getURL(this, file);

    })


    function getURL(input, data) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var filename = data;
        filename = filename.substring(filename.lastIndexOf('\\') + 1);
        var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    
        if (cekgb == 'pdf' || cekgb == 'PDF') {
            if(input.files[0]['size'] > 1024000){
                alert('ukuran file tidak boleh > 1 Mb !');
                $('.file_bkp').val("");
                
                $('.nama_file').html("Choose file PDF (max-size: 1MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('.file_bkp').val("");
            $('.nama_file').html("Choose PDF (max-size: 1MB)");
            
        }
               
        }

    }

    $('.file_lampiran').on('change', function(e){
        e.preventDefault();
        var file = $(this).val();
        getURL2(this, file);

    })
    function getURL2(input, data) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var filename = data;
        filename = filename.substring(filename.lastIndexOf('\\') + 1);
        var cekgb = filename.substring(filename.lastIndexOf('.') + 1);
    
        if (cekgb == 'pdf' || cekgb == 'PDF') {
            if(input.files[0]['size'] > 2048000){
                alert('ukuran file tidak boleh > 2 Mb !');
                $('.file_lampiran').val("");
                
                $('.nama_file2').html("Choose file PDF (max-size: 2MB)");
            }else{
                
            }
            
        }else {
            alert ("file harus berjenis 'pdf' ");
            $('.file_lampiran').val("");
            $('.nama_file2').html("Choose PDF (max-size: 2MB)");
            
        }
               
        }

    }




</script>


@endpush