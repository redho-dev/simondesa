{{-- Form Pekerjaan --}}
<div class="row {{ $jenis=='pekerjaan' ? '' : 'd-none' }}">
    <div class="col-md-5">
        <form action="/adminDesa/updateDatumPekerjaan" method="post">
            @csrf
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
            <input type="hidden" name="jenis" value="{{ $jenis }}">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="3" class="bg-info">
                            Silahkan Update Data Pekerjaan / Mata Pencaharian Penduduk Tahun {{ $tahun
                            }} Jika Ada Perubahan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th width="60%">1. TNI/POLRI
                            <input type="hidden" name="nama_data[]" value="tni_polri">
                        </th>
                        <th class="p-0 g-0 " width="30%">
                            <input type="number" class="form-control py-0 mt-0 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" autofocus value="{{ $data[0]->isidata }}">
                        </th>
                        <th class="bg-light" width="10%">Orang</th>

                    </tr>
                    <tr>
                        <th width="60%">2. PNS/PPPK
                            <input type="hidden" name="nama_data[]" value="pns">
                        </th>
                        <th class="p-0 g-0 " width="30%">
                            <input type="number" class="form-control py-0 mt-0 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[1]->isidata }}">
                        </th>
                        <th class="bg-light" width="10%">Orang</th>

                    </tr>
                    <tr>
                        <th>3. Karyawan/Pegawai Swasta
                            <input type="hidden" name="nama_data[]" value="karyawan">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[2]->isidata }}">
                        </th>
                        <th class="bg-light">Orang</th>

                    </tr>
                    <tr>
                        <th>4. Petani
                            <input type="hidden" name="nama_data[]" value="petani">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[3]->isidata }}">
                        </th>
                        <th class="bg-light">Orang</th>

                    </tr>
                    <tr>
                        <th>5. Buruh Tani
                            <input type="hidden" name="nama_data[]" value="buruh_tani">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[4]->isidata }}">
                        </th>
                        <th class="bg-light">Orang</th>

                    </tr>
                    <tr>
                        <th>6. Buruh Perusahaan
                            <input type="hidden" name="nama_data[]" value="buruh_perusahaan">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[5]->isidata }}">
                        </th>
                        <th class="bg-light">Orang</th>

                    </tr>
                    <tr>
                        <th>7. Pedagang/Jasa
                            <input type="hidden" name="nama_data[]" value="pedagang">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[6]->isidata }}">
                        </th>
                        <th class="bg-light">Orang</th>

                    </tr>
                    <tr>
                        <th>8. Peternak
                            <input type="hidden" name="nama_data[]" value="peternak">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[7]->isidata }}">
                        </th>
                        <th class="bg-light">Orang</th>

                    </tr>
                    <tr>
                        <th>9. Tukang / Kuli Bangunan
                            <input type="hidden" name="nama_data[]" value="kuli">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[8]->isidata }}">
                        </th>
                        <th class="bg-light">Orang</th>

                    </tr>
                    <tr>
                        <th>10. Lainnya
                            <input type="hidden" name="nama_data[]" value="lainnya">
                        </th>
                        <th class="p-0">
                            <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[9]->isidata }}">
                        </th>
                        <th class="bg-light">Orang</th>

                    </tr>
                    <tr>
                        <th>11. Tidak bekerja / Pengangguran
                            <input type="hidden" name="nama_data[]" value="pengangguran">
                        </th>
                        <th class="p-0">
                            <input type="text" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                style="font-size: .85rem" value="{{ $data[10]->isidata }}">
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
{{-- End Form Pekerjaan --}}


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