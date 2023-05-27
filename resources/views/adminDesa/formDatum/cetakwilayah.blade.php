<table class="table table-striped style=" font-size: .8rem">

    <tbody>

        <tr>
            <td>
                <label for="dasar" class="col-form-label">1. Dasar Hukum Pembentukan
                    Desa</label>
                <input type="hidden" name="nama_data[]" value="dasar_hukum">
            </td>
            <td>
                <textarea class="form-control" name="isidata[]" id="dasar" rows="2" style="font-size: .9rem"
                    autofocus>{{ $data[0]->isidata }}</textarea>

            </td>

        </tr>
        <tr>
            <td>
                <label for="wilayah" class="col-form-label">2. Luas Wilayah</label>
                <input type="hidden" name="nama_data[]" value="luas_wilayah">

            </td>
            <td class="d-flex"><input type="text" class="form-control" name="isidata[]"
                    value="{{ old('isidata[1]', $data[1]->isidata) }}" required>
                <span class="input-group-text" id="wilayah" style="font-size: .9rem">Km2</span>

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
                <textarea name="isidata[]" class="form-control" id="utara" rows="2" style="font-size: .9rem" required>{{ old('isidata[2]', $data[2]->isidata) }}
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
                <textarea name="isidata[]" class="form-control" id="selatan" rows="2" style="font-size: .9rem"
                    required>{{ old('isidata[3]', $data[3]->isidata) }}</textarea>

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
                <textarea name="isidata[]" class="form-control" id="barat" rows="2" style="font-size: .9rem"
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
            <td><textarea name="isidata[]" class="form-control" id="timur" rows="2" style="font-size: .9rem"
                    required>{{ old('isidata[5]', $data[5]->isidata) }}</textarea>


            </td>

        </tr>
        <tr>
            <td>
                <label for="dusun" class="col-form-label">7. Jumlah Dusun</label>
                <input type="hidden" name="nama_data[]" value="jumlah_dusun">
            </td>
            <td class="d-flex"><input type="number" name="isidata[]" id="dusun" class="form-control"
                    style="font-size: .9rem" value="{{ old('isidata[6]', $data[6]->isidata) }}" required>
                <span class="input-group-text" style="font-size: .9rem">Dusun</span>

            </td>

        </tr>
        <tr>
            <td>
                <label for="rt" class="col-form-label">8. Jumlah RT</label>
                <input type="hidden" name="nama_data[]" value="jumlah_rt">
            </td>
            <td class="d-flex"><input type="number" name="isidata[]" id="rt" class="form-control"
                    style="font-size: .9rem" value="{{ old('isidata[7]', $data[7]->isidata) }}" required>
                <span class="input-group-text" style="font-size: .9rem">RT</span>

            </td>
        </tr>

    </tbody>
</table>