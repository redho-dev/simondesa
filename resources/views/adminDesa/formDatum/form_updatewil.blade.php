<div class="row mb-4 ">
    <div class="col-md-8">
        {{-- <a href="/cetak_wilayah" target="_blank" class="btn btn-primary">cetak</a> --}}
        <table class="table table-striped style=" font-size: .8rem">
            <thead>
                <tr class="bg-info">
                    <td colspan="2">Silahkan Update Data Umum Wilayah Tahun {{ $tahun }} Jika Ada Perubahan</td>
                </tr>
            </thead>
            <tbody>
                <form action="/adminDesa/updateDatumWil" method="post">
                    @csrf
                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                    <input type="hidden" name="jenis" value="{{ $jenis }}">


                    <tr>
                        <td width="45%">
                            <label for="dasar" class="col-form-label">1. Dasar Hukum Pembentukan
                                Desa</label>
                            <input type="hidden" name="nama_data[]" value="dasar_hukum">
                        </td>
                        <td>
                            <textarea class="form-control" name="isidata[]" id="dasar" rows="2" style="font-size: .8rem"
                                autofocus>{{ $data[0]->isidata }}</textarea>

                        </td>

                    </tr>
                    <tr>
                        <td>
                            <label for="wilayah" class="col-form-label">2. Luas Wilayah</label>
                            <input type="hidden" name="nama_data[]" value="luas_wilayah">

                        </td>
                        <td class="d-flex" width="30%"><input type="text" class="form-control" name="isidata[]"
                                value="{{ old('isidata[1]', $data[1]->isidata) }}" required style="font-size: .8rem">
                            <span class="input-group-text" id="wilayah" style="font-size: .8rem">Ha</span>

                        </td>

                    </tr>
                    <tr>
                        <td>
                            <label for="utara" class="col-form-label">3. Sebelah Utara
                                berbatasan
                                dengan</label>
                            <input type="hidden" name="nama_data[]" value="batas_utara">
                        </td>
                        <td>
                            <textarea name="isidata[]" class="form-control" id="utara" rows="2" style="font-size: .8rem"
                                required>{{ old('isidata[2]', $data[2]->isidata) }}
                            </textarea>

                        </td>

                    </tr>
                    <tr>
                        <td>
                            <label for="selatan" class="col-form-label">4. Sebelah Selatan
                                berbatasan dengan</label>
                            <input type="hidden" name="nama_data[]" value="batas_selatan">
                        </td>
                        <td>
                            <textarea name="isidata[]" class="form-control" id="selatan" rows="2"
                                style="font-size: .8rem" required>{{ old('isidata[3]', $data[3]->isidata) }}</textarea>

                        </td>

                    </tr>
                    <tr>
                        <td>
                            <label for="barat" class="col-form-label">5. Sebelah Barat
                                berbatasan
                                dengan</label>
                            <input type="hidden" name="nama_data[]" value="batas_barat">

                        </td>
                        <td>
                            <textarea name="isidata[]" class="form-control" id="barat" rows="2" style="font-size: .8rem"
                                required>{{ old('isidata[4]', $data[4]->isidata) }}</textarea>


                        </td>

                    </tr>
                    <tr>
                        <td>
                            <label for="timur" class="col-form-label">6. Sebelah Timur
                                berbatasan
                                dengan</label>
                            <input type="hidden" name="nama_data[]" value="batas_timur">
                        </td>
                        <td><textarea name="isidata[]" class="form-control" id="timur" rows="2" style="font-size: .8rem"
                                required>{{ old('isidata[5]', $data[5]->isidata) }}</textarea>


                        </td>

                    </tr>
                    <tr>
                        <td>
                            <label for="dusun" class="col-form-label">7. Jumlah Dusun</label>
                            <input type="hidden" name="nama_data[]" value="jumlah_dusun">
                        </td>
                        <td class="d-flex" width="60%"><input type="number" name="isidata[]" id="dusun"
                                class="form-control" style="font-size: .8rem"
                                value="{{ old('isidata[6]', $data[6]->isidata) }}" required>
                            <span class="input-group-text" style="font-size: .8rem">Dusun</span>

                        </td>

                    </tr>
                    <tr>
                        <td>
                            <label for="rt" class="col-form-label">8. Jumlah RT</label>
                            <input type="hidden" name="nama_data[]" value="jumlah_rt">
                        </td>
                        <td class="d-flex" width="60%"><input type="number" name="isidata[]" id="rt"
                                class="form-control" style="font-size: .8rem"
                                value="{{ old('isidata[7]', $data[7]->isidata) }}" required>
                            <span class="input-group-text" style="font-size: .8rem">RT</span>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="rt" class="col-form-label">9. Jarak Kantor Desa dari Kantor
                                Kecamatan</label>
                            <input type="hidden" name="nama_data[]" value="jarak_kecamatan" style="font-size: .8rem">
                        </td>
                        <td class="d-flex" width="60%"><input type="text" name="isidata[]" class="form-control"
                                style="font-size: .8rem" value="{{ old('isidata[8]', $data[8]->isidata) }}">
                            <span class="input-group-text" style="font-size: .8rem">Km</span>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="rt" class="col-form-label">10. Jarak Kantor Desa dari Kantor
                                Pemerintah Kabupaten</label>
                            <input type="hidden" name="nama_data[]" value="jarak_pemda" style="font-size: .8rem">
                        </td>
                        <td class="d-flex" width="60%"><input type="text" name="isidata[]" class="form-control"
                                style="font-size: .8rem" value="{{ old('isidata[9]', $data[9]->isidata) }}">
                            <span class="input-group-text" style="font-size: .8rem">Km</span>

                        </td>
                    </tr>


                    <tr>
                        <td colspan="2" align="center">
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                data-target="#copyData">
                                Copy Data {{ $jenis }}
                            </button>
                            <button class="btn btn-primary btn-sm">UPDATE DATA</button>
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>

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


    </div>
</div>