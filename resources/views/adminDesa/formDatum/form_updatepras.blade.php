{{-- Form Sarpras --}}
<div class="{{ $jenis=='sarpras' ? '' : 'd-none' }} row">
    <div class="col-md-8">
        <form action="/adminDesa/updateDatumPras" method="post">
            @csrf
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
            <input type="hidden" name="jenis" value="{{ $jenis }}">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="6" class="bg-info">
                            Silahkan Update Jumlah Prasarana Desa Tahun {{ $tahun }} jika ada perubahan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="background-color: lightgrey">
                        <th colspan="3">Sarpras Pendidikan</th>
                        <th colspan="3">Sarpras Kesehatan</th>

                    </tr>
                    <tr>
                        <th>1. TK/PAUD
                            <input type="hidden" name="nama_data[]" value="tk">
                        </th>
                        <th class="p-0 g-0 ">
                            <input type="number" class="form-control py-0 mt-0 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[0]->isidata }}" autofocus>
                        </th>
                        <th class="bg-light">Unit</th>
                        <th>1. Puskesmas
                            <input type="hidden" name="nama_data[]" value="puskesmas">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[1]->isidata }}">
                        </th>
                        <th class="bg-light">Unit</th>
                    </tr>
                    <tr>
                        <th>2. SD/MI
                            <input type="hidden" name="nama_data[]" value="sd">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[2]->isidata }}">
                        </th>
                        <th class="bg-light">Unit</th>
                        <th>2. Pustu
                            <input type="hidden" name="nama_data[]" value="pustu">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[3]->isidata }}">
                        </th>
                        <th class="bg-light">Unit</th>
                    </tr>
                    <tr>
                        <th>3. SMP/MTs
                            <input type="hidden" name="nama_data[]" value="smp">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[4]->isidata }}">
                        </th>
                        <th class="bg-light">Unit</th>
                        <th>3. Poskesdes
                            <input type="hidden" name="nama_data[]" value="poskesdes">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[5]->isidata }}">
                        </th>
                        <th class="bg-light">Unit</th>
                    </tr>
                    <tr>
                        <th>4. SMA/MA
                            <input type="hidden" name="nama_data[]" value="sma">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[6]->isidata }}">
                        </th>
                        <th class="bg-light">Unit</th>
                        <th>4. Posyandu
                            <input type="hidden" name="nama_data[]" value="posyandu">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[7]->isidata }}">
                        </th>
                        <th class="bg-light">Unit</th>
                    </tr>
                    <tr>
                        <th>5. Pondok Pesantren
                            <input type="hidden" name="nama_data[]" value="ponpes">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[8]->isidata }}">
                        </th>
                        <th class="bg-light">Unit</th>
                        <th>5. Polindes
                            <input type="hidden" name="nama_data[]" value="polindes">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[9]->isidata }}">
                        </th>
                        <th class="bg-light">Unit</th>
                    </tr>
                    <tr style="background-color: lightgrey">
                        <th colspan="3">Prasarana Ibadah</th>
                        <th colspan="3">Prasarana Umum</th>
                    </tr>
                    <tr>
                        <th>1. Mesjid
                            <input type="hidden" name="nama_data[]" value="mesjid">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[10]->isidata }}">
                        </th>
                        <th class="bg-light">Buah</th>
                        <th>1. Olahraga (gedung/lapangan)
                            <input type="hidden" name="nama_data[]" value="olahraga">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[11]->isidata }}">
                        </th>
                        <th class="bg-light">Buah</th>
                    </tr>
                    <tr>
                        <th>2. Mushola
                            <input type="hidden" name="nama_data[]" value="mushola">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[12]->isidata }}">
                        </th>
                        <th class="bg-light">Buah</th>
                        <th>2. Kesenian/Budaya
                            <input type="hidden" name="nama_data[]" value="kesenian">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[13]->isidata }}">
                        </th>
                        <th class="bg-light">Buah</th>
                    </tr>
                    <tr>
                        <th>3. Gereja
                            <input type="hidden" name="nama_data[]" value="gereja">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[14]->isidata }}">
                        </th>
                        <th class="bg-light">Buah</th>
                        <th>3. Balai Pertemuan
                            <input type="hidden" name="nama_data[]" value="balai">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[15]->isidata }}">
                        </th>
                        <th class="bg-light">Buah</th>
                    </tr>
                    <tr>
                        <th>4. Pura
                            <input type="hidden" name="nama_data[]" value="pura">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[16]->isidata }}">
                        </th>
                        <th class="bg-light">Buah</th>
                        <th>4. Sumur Desa
                            <input type="hidden" name="nama_data[]" value="sumur">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[17]->isidata }}">
                        </th>
                        <th class="bg-light">Buah</th>
                    </tr>
                    <tr>
                        <th>5. Vihara
                            <input type="hidden" name="nama_data[]" value="vihara">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[18]->isidata }}">
                        </th>
                        <th class="bg-light">Buah</th>
                        <th>5. Pasar Desa
                            <input type="hidden" name="nama_data[]" value="pasar">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[19]->isidata }}">
                        </th>
                        <th class="bg-light">Buah</th>
                    </tr>
                    <tr>
                        <th>6. Klenteng
                            <input type="hidden" name="nama_data[]" value="klenteng">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[20]->isidata }}">
                        </th>
                        <th class="bg-light">Buah</th>
                        <th>6. Lainnya
                            <input type="hidden" name="nama_data[]" value="lainnya">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[21]->isidata }}">
                        </th>
                        <th class="bg-light">Buah</th>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6" class="text-center">
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                data-target="#copyData">
                                Copy Data {{ $jenis }}
                            </button>
                            <button type="submit" class="btn btn-primary btn-sm">Update Data</button>
                        </th>
                    </tr>
                </tfoot>

            </table>
        </form>
    </div>
</div>
{{-- Akhir Form Sarpras --}}

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