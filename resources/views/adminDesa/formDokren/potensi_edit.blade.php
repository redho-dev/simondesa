<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered" id="potensi">
            <tr>
                <th colspan="5">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                        Tambah Potensi
                    </button>
                </th>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Tambah Potensi Desa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="/adminDesa/updateTambahPotensi" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                <input type="hidden" name="tahun" value="{{ $tahun }}">
                                <input type="hidden" name="jenis" value="{{ $jenis }}">
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="nama_data">Uraian potensi desa</label>
                                        <textarea class="form-control" name="uraian" rows="1" style="font-size: .9rem"
                                            autofocus required></textarea>

                                    </div>
                                    <div class="form-group">
                                        <label for="upload_potensi">Upload foto potensi desa</label>
                                        <div class="custom-file">
                                            <input type="file" name="upload_potensi"
                                                class="custom-file-input upload_file_potensi" required>
                                            <label class="custom-file-label text-muted upload_potensi"
                                                for="upload_potensi">Choose
                                                file Image
                                                (max-size: 1MB)</label>
                                        </div>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </tr>
            <tr class="table-secondary border-1">
                <th width="15%"></th>
                <th width="35%">Uraian Potensi</th>
                <th width="15%" class="text-center">Foto Potensi</th>
                <th width="10%" class="text-center">Aksi</th>
            </tr>
            @foreach($data as $dt)
            <tr>
                <th>Potensi_{{ $loop->iteration }}</th>
                <th>
                    <input type="hidden" name="nama_data[]" value="potensi_1">
                    <textarea class="form-control" name="isidata[]" rows="1" style="font-size: .9rem" autofocus
                        readonly>{{ $dt->uraian }}</textarea>
                </th>
                <th class="text-center">
                    <div>
                        @if($dt->file_data)
                        <a href="{{ asset('storage/'.$dt->file_data) }}" target="_blank"><img
                                src="{{ asset('storage/'.$dt->file_data) }}" width="100px"></a>
                        @else
                        <span>(kosong)</span>
                        @endif
                    </div>
                </th>

                <th class="text-center">
                    <div class="d-inline-flex">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#editpotensi_{{ $dt->id }}">
                            edit
                        </button>
                        <form action="/adminDesa/hapusPotensi" method="post">
                            @csrf
                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                            <input type="hidden" name="jenis" value="{{ $jenis }}">
                            <input type="hidden" name="id" value="{{ $dt->id }}">
                            <button class="btn btn-danger btn-sm hapus">hapus</button>
                        </form>
                    </div>
                </th>
                <!-- Modal -->
                <div class="modal fade" id="editpotensi_{{ $dt->id }}" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Tambah Potensi Desa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="/adminDesa/updateUbahPotensi" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                <input type="hidden" name="tahun" value="{{ $tahun }}">
                                <input type="hidden" name="jenis" value="{{ $jenis }}">
                                <input type="hidden" name="id" value="{{ $dt->id }}">
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="nama_data">Uraian potensi desa</label>
                                        <textarea class="form-control" name="uraian" rows="1" style="font-size: .9rem"
                                            autofocus required>{{ $dt->uraian }}</textarea>

                                    </div>
                                    <div class="form-group">
                                        <label for="upload_potensi">Ganti foto potensi desa</label>
                                        <div class="custom-file">
                                            <input type="hidden" name="old" value="{{ $dt->file_data }}">
                                            <input type="file" name="upload_potensi"
                                                class="custom-file-input upload_file_potensi">
                                            <label class="custom-file-label text-muted upload_potensi"
                                                for="upload_potensi">Choose
                                                file Image
                                                (max-size: 1MB)</label>
                                        </div>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



            </tr>

            @endforeach

        </table>
        <small class="mt-0 mb-2 text-info">(klik tambah potensi untuk menambah daftar potensi desa)</small><br>
        <small>Contoh : <br> potensi_1: sektor perkebunan sawit dengan luas areal +- 250 ha dan total produksi
            rata-rata
            5000 ton per
            tahun <br>potensi_2: sektor wisata alam (danau) <br>
            potensi_3: sektor perikanan dengan luas tambak +- 25ha (120 orang petambak) dengan total produksi
            rata-rata 1000 ton per tahun <br>
            potensi_4: sektor UMKM (produk gula aren) dengan jumlah UMKM sebanyak 20 unit dengan total produksi
            rata-rata
            10 ton pertahun</small>
    </div>
</div>


</div>
</div>

<div class="ln_solid"></div>
@error('upload_potensi')
<script>
    Swal.fire({
  position: 'center',
  icon: 'error',
  title: '{{ $message }}',
  showConfirmButton: true,
})
</script>

@enderror


@push('script')

<script>
    var i =2;
    $('#tambah_potensi').on('click', function(){
       
        $('#potensi').append(`<tr>
                    <th width="" style="vertical-align: middle">Potensi_`+i+`</th>
                    <th width="">
                        <input type="hidden" name="nama_data[]" value="potensi_`+i+`">
                        <textarea class="form-control" name="isidata[]" rows="1" style="font-size: .9rem" autofocus
                            required></textarea>
                    </th>
                    <th></th>
                    <th width="">
                        <div class="">
                            @error('upload_potensi[]')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" name="upload_potensi[]"
                                        class="custom-file-input upload_file_potensi" required>
                                    <label class="custom-file-label text-muted label_upload_potensi"
                                        for="upload_potensi[]">Choose
                                        file Image
                                        (max-size: 1MB)</label>
                                </div>
                            </div>
                        </div>
                    </th>
                </tr>`);
        i++;
        bsCustomFileInput.init();
    })
</script>
@endpush