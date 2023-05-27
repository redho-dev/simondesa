{{-- Form Kelembagaan --}}
<div class="row {{ $jenis=='kelembagaan' ? '' : 'd-none' }}">
    <div class="col-md-6">
        <form action="/adminDesa/updateDatumLembaga" method="post">
            @csrf
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
            <input type="hidden" name="jenis" value="{{ $jenis }}">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="3" class="bg-info">
                            Silahkan Update Data Kelembagaan Tahun {{ $tahun }} jika ada perubahan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th width="60%">1. Pimpinan & anggota BPD
                            <input type="hidden" name="nama_data[]" value="jumlah_bpd">
                        </th>
                        <th class="p-0 g-0 " width="30%">
                            <input type="number" class="form-control py-0 mt-0 px-2 border-0 text-center"
                                name="isidata[]" style="font-size: .85rem" autofocus value="{{ $data[0]->isidata }}">
                        </th>
                        <th class="bg-light" width="10%">Orang</th>

                    </tr>
                    <tr>
                        <th width="60%">2. Pengurus & anggota LPM
                            <input type="hidden" name="nama_data[]" value="jumlah_lpm">
                        </th>
                        <th class="p-0 g-0 " width="30%">
                            <input type="number" class="form-control py-0 mt-0 px-2 border-0 text-center text-center"
                                name="isidata[]" style="font-size: .85rem" value="{{ $data[1]->isidata }}">
                        </th>
                        <th class="bg-light" width="10%">Orang</th>

                    </tr>
                    <tr>
                        <th width="60%">3. Jumlah RT

                        </th>
                        <th class="p-0 g-0 " width="30%">
                            <input type="number" class="form-control py-0 mt-0 px-2 border-0 text-center"
                                style="font-size: .85rem" value="{{ $jumlah_rt }}" disabled>
                        </th>
                        <th class="bg-light" width="10%">Orang</th>

                    </tr>
                    <tr>
                        <th>4. Pengurus & anggota PKK
                            <input type="hidden" name="nama_data[]" value="jumlah_pkk">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0 text-center"
                                name="isidata[]" style="font-size: .85rem" value="{{ $data[2]->isidata }}">
                        </th>
                        <th class="bg-light">Orang</th>

                    </tr>
                    <tr>
                        <th>5. Pengurus & anggota Karang Taruna
                            <input type="hidden" name="nama_data[]" value="jumlah_karang_taruna">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0 text-center"
                                name="isidata[]" style="font-size: .85rem" value="{{ $data[3]->isidata }}">
                        </th>
                        <th class="bg-light">Orang</th>

                    </tr>
                    <tr>
                        <th>6. Anggota Linmas
                            <input type="hidden" name="nama_data[]" value="jumlah_linmas">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0 text-center"
                                name="isidata[]" style="font-size: .85rem" value="{{ $data[4]->isidata }}">
                        </th>
                        <th class="bg-light">Orang</th>

                    </tr>
                    <tr>
                        <th>7. Kader Posyandu
                            <input type="hidden" name="nama_data[]" value="jumlah_kader">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0 text-center"
                                name="isidata[]" style="font-size: .85rem" value="{{ $data[5]->isidata }}">
                        </th>
                        <th class="bg-light">Orang</th>

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
{{-- End Form Kelembagaan --}}

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