{{-- Form Tambah Data Kependudukan --}}
<div class="row mb-4 {{ $jenis=='kependudukan' ? '' : 'd-none' }}">
    <div class="col-md-8">
        <form action="/adminDesa/updateDatumDuk" method="post">
            @csrf
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
            <input type="hidden" name="jenis" value="kependudukan">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="6" class="bg-info">
                            Silah Update Data Kependudukan Tahun {{ $tahun }} jika ada perubahan
                        </th>
                    </tr>
                </thead>
            </table>
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width='60%'>1. Jumlah penduduk
                                    <input type="hidden" name="nama_data[]" value="jumlah_penduduk">
                                </th>
                                <th class="p-0 g-0 ">
                                    <input type="number" class="form-control py-0 mt-0 px-2 border-0" name="isidata[]"
                                        style="font-size: .85rem" value="{{ $data[0]->isidata }}" autofocus>
                                </th>
                                <th class="bg-light">Jiwa</th>


                            </tr>
                            <tr>
                                <th>2. Penduduk laki-laki
                                    <input type="hidden" name="nama_data[]" value="jumlah_penduduk_l">
                                </th>
                                <th class="p-0">
                                    <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                        style="font-size: .85rem" value="{{ $data[1]->isidata }}">
                                </th>
                                <th class="bg-light">Orang</th>


                            </tr>
                            <tr>
                                <th>3. Penduduk Perempuan
                                    <input type="hidden" name="nama_data[]" value="jumlah_penduduk_p">
                                </th>
                                <th class="p-0">
                                    <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                        style="font-size: .85rem" value="{{ $data[2]->isidata }}">
                                </th>
                                <th class="bg-light">Orang</th>

                            </tr>
                            <tr>
                                <th>4. Usia 0-15 tahun
                                    <input type="hidden" name="nama_data[]" value="usia_0_15">
                                </th>
                                <th class="p-0">
                                    <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                        style="font-size: .85rem" value="{{ $data[3]->isidata }}">
                                </th>
                                <th class="bg-light">Orang</th>


                            </tr>
                            <tr>
                                <th>5. Usia 15-65 tahun
                                    <input type="hidden" name="nama_data[]" value="usia_15_65">
                                </th>
                                <th class="p-0">
                                    <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                        style="font-size: .85rem" value="{{ $data[4]->isidata }}">
                                </th>
                                <th class="bg-light">Orang</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width='60%'>6. Usia > 65 tahun
                                    <input type="hidden" name="nama_data[]" value="usia_65_keatas">
                                </th>
                                <th class="p-0">
                                    <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                        style="font-size: .85rem" value="{{ $data[5]->isidata }}">
                                </th>
                                <th class="bg-light">Orang</th>


                            </tr>
                            <tr>
                                <th>7. Jumlah Kepala Keluarga
                                    <input type="hidden" name="nama_data[]" value="jumlah_kk">
                                </th>
                                <th class="p-0">
                                    <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                        style="font-size: .85rem" value="{{ $data[6]->isidata }}">
                                </th>
                                <th class="bg-light">KK</th>
                            </tr>
                            <tr>
                                <th>8. Jumlah Penduduk Miskin
                                    <input type="hidden" name="nama_data[]" value="penduduk_miskin">
                                </th>
                                <th class="p-0">
                                    <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                        style="font-size: .85rem" value="{{ $data[7]->isidata }}">
                                </th>
                                <th class="bg-light">Jiwa</th>

                            </tr>
                            <tr>
                                <th>9. Jumlah KK Miskin
                                    <input type="hidden" name="nama_data[]" value="kk_miskin">
                                </th>
                                <th class="p-0">
                                    <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                        style="font-size: .85rem" value="{{ $data[8]->isidata }}">
                                </th>
                                <th class="bg-light">KK</th>
                            </tr>
                            <tr>
                                <th>10. Jumlah Penerima Bansos
                                    <input type="hidden" name="nama_data[]" value="penerima_bansos">
                                </th>
                                <th class="p-0">
                                    <input type="number" class="form-control py-0 pb-1 px-2 border-0" name="isidata[]"
                                        style="font-size: .85rem" value="{{ $data[9]->isidata }}">
                                </th>
                                <th class="bg-light">Orang</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
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


                </div>
            </div>

        </form>
    </div>
</div>
{{-- Akhir form kependudukan --}}



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