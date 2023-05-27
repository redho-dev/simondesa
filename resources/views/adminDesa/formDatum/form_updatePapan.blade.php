{{-- Form Update Papan Monografi --}}
<div class="row  {{ $jenis=='papan' ? '' : 'd-none' }}">
    <div class="col-md-8 mt-2">
        <p class="alert bg-info text-dark">Silahkan Update/Tambah Foto Papan Monografi dengan Data Terbaru
            Tahun {{ $tahun }}
        </p>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah">Tambah
            Foto</button>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Foto Papan Monografi</th>
                <th class="text-center">Aksi</th>
            </tr>
            @foreach($data as $dt)
            <tr>
                <td style="vertical-align: middle">{{ $loop->iteration }}</td>
                <td style="vertical-align: middle">
                    <a href="{{ asset('storage/'.$dt->isidata) }}" target="_blank"><img
                            src="{{ asset('storage/'.$dt->isidata) }}" class="img-fluid" width="500"></a>
                </td>
                <td style="vertical-align: middle" class="text-center">

                    <button class="btn btn-danger btn-sm hapus" id_hapus={{ $dt->id }} asal_id="{{ $infos->asal_id }}"
                        tahun="{{ $tahun }}">hapus</button>

                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="tambah" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-light" id="staticBackdropLabel">Tambah Foto Papan
                    Monografi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/adminDesa/tambahDatumPapan" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="tahun" value="{{ $tahun }}">
                <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                <input type="hidden" name="jenis" value="{{ $jenis }}">
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" name="papan_monografi" class="custom-file-input" id="file_papan"
                                aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label text-muted file_papan" for="file_papan">
                                File Image (max: 1MB)
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Kirim Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Form Papan Monografi --}}


<div class="row mb-4 justify-content-center">
    <div class="col-md-6">
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#copyData">
            Copy Data {{ $jenis }}
        </button>

    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="copyData" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-light" id="staticBackdropLabel">Copy Data {{ $jenis }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(session()->has('timpa'))
                <div class="alert bg-danger text-white">Sudah ada data {{ $jenis }} tahun {{
                    session('timpa') }}
                </div>
                <form action="/adminDesa/copyDatum" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="tahuncopy">Tetap Copy dan timpa Seluruh Data {{ $jenis }} Tahun {{
                            $tahun }} ke
                            Tahun {{ session('timpa') }}
                            :</label>
                        <input type="hidden" name="tahuncopy" value="{{ session('timpa') }}">
                        <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                        <input type="hidden" name="tahunasal" value="{{ $tahun }}">
                        <input type="hidden" name="jenis" value="{{ $jenis }}">
                        <input type="hidden" name="timpadata" value="oke">

                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Copy Data</button>
            </div>
            </form>
            @else
            <form action="/adminDesa/copyDatum" method="post">
                @csrf
                <div class="form-group">
                    <label for="tahuncopy">Copy Seluruh Data {{ $jenis }} Tahun {{ $tahun }} ke Tahun
                        :</label>
                    <select class="form-control" id="tahuncopy" name="tahuncopy" required>
                        <option value="">== pilih tahun ==</option>
                        <option>{{ $tahun+1 }}</option>
                        <option>{{ $tahun+2 }}</option>
                        <option>{{ $tahun+3 }}</option>

                    </select>
                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                    <input type="hidden" name="tahunasal" value="{{ $tahun }}">
                    <input type="hidden" name="jenis" value="{{ $jenis }}">

                </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Copy Data</button>
        </div>
        </form>
        @endif

    </div>
</div>