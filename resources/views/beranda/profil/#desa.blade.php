<label class="control-label text-lg-end pt-2">Pilih Desa</label>
<select data-plugin-selectTwo class="form-control populate" name="desa" id="desa">
    @foreach ($desas as $desa) { ?>
        <option value="{{$desa->id}}">{{ $desa->asal }}</option>
        @endforeach
</select>

<label class="control-label text-lg-end pt-2">Pilih Tahun</label>
<select data-plugin-selectTwo class="form-control populate" name="tahun" id="tahun">
        <option value="2022">2022</option>
        <option value="2023">2023</option>
</select>
<br>
<button class="btn btn-primary btn-rounded btn-px-4 btn-py-2 font-weight-bold" type="submit">Pilih</button>