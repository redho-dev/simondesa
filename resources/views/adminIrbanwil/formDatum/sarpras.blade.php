{{-- Form Sarpras --}}
<div class="row">
    <div class="col-md-8">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="6" class="bg-info">
                        Data Sarana Prasarana Tahun {{ $tahun }}
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
                    </th>
                    <th class="p-0 g-0 ">
                        <input type="number" class="form-control text-center py-0 mt-0 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[0]->isidata }}" autofocus>
                    </th>
                    <th class="bg-light">Unit</th>
                    <th>1. Puskesmas
                        <input type="hidden" name="nama_data[]" value="puskesmas">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control text-center py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[1]->isidata }}">
                    </th>
                    <th class="bg-light">Unit</th>
                </tr>
                <tr>
                    <th>2. SD/MI
                        <input type="hidden" name="nama_data[]" value="sd">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control text-center py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[2]->isidata }}">
                    </th>
                    <th class="bg-light">Unit</th>
                    <th>2. Pustu
                        <input type="hidden" name="nama_data[]" value="pustu">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control text-center py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[3]->isidata }}">
                    </th>
                    <th class="bg-light">Unit</th>
                </tr>
                <tr>
                    <th>3. SMP/MTs
                        <input type="hidden" name="nama_data[]" value="smp">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control text-center py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[4]->isidata }}">
                    </th>
                    <th class="bg-light">Unit</th>
                    <th>3. Poskesdes
                        <input type="hidden" name="nama_data[]" value="poskesdes">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control text-center py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[5]->isidata }}">
                    </th>
                    <th class="bg-light">Unit</th>
                </tr>
                <tr>
                    <th>4. SMA/MA
                        <input type="hidden" name="nama_data[]" value="sma">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control text-center py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[6]->isidata }}">
                    </th>
                    <th class="bg-light">Unit</th>
                    <th>4. Posyandu
                        <input type="hidden" name="nama_data[]" value="posyandu">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control text-center py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[7]->isidata }}">
                    </th>
                    <th class="bg-light">Unit</th>
                </tr>
                <tr>
                    <th>5. Pondok Pesantren
                        <input type="hidden" name="nama_data[]" value="ponpes">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control text-center py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[8]->isidata }}">
                    </th>
                    <th class="bg-light">Unit</th>
                    <th>5. Polindes
                        <input type="hidden" name="nama_data[]" value="polindes">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control text-center py-0 pb-1 px-2 border-0" name="isidata[]"
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
                        <input type="number" class="form-control text-center py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[10]->isidata }}">
                    </th>
                    <th class="bg-light">Buah</th>
                    <th>1. Olahraga (gedung/lapangan)
                        <input type="hidden" name="nama_data[]" value="olahraga">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control text-center py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[11]->isidata }}">
                    </th>
                    <th class="bg-light">Buah</th>
                </tr>
                <tr>
                    <th>2. Mushola
                        <input type="hidden" name="nama_data[]" value="mushola">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control text-center py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[12]->isidata }}">
                    </th>
                    <th class="bg-light">Buah</th>
                    <th>2. Kesenian/Budaya
                        <input type="hidden" name="nama_data[]" value="kesenian">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control text-center py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[13]->isidata }}">
                    </th>
                    <th class="bg-light">Buah</th>
                </tr>
                <tr>
                    <th>3. Gereja
                        <input type="hidden" name="nama_data[]" value="gereja">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control text-center py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[14]->isidata }}">
                    </th>
                    <th class="bg-light">Buah</th>
                    <th>3. Balai Pertemuan
                        <input type="hidden" name="nama_data[]" value="balai">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control text-center py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[15]->isidata }}">
                    </th>
                    <th class="bg-light">Buah</th>
                </tr>
                <tr>
                    <th>4. Pura
                        <input type="hidden" name="nama_data[]" value="pura">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control text-center py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[16]->isidata }}">
                    </th>
                    <th class="bg-light">Buah</th>
                    <th>4. Sumur Desa
                        <input type="hidden" name="nama_data[]" value="sumur">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control text-center py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[17]->isidata }}">
                    </th>
                    <th class="bg-light">Buah</th>
                </tr>
                <tr>
                    <th>5. Vihara
                        <input type="hidden" name="nama_data[]" value="vihara">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control text-center py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[18]->isidata }}">
                    </th>
                    <th class="bg-light">Buah</th>
                    <th>5. Pasar Desa
                        <input type="hidden" name="nama_data[]" value="pasar">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control text-center py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[19]->isidata }}">
                    </th>
                    <th class="bg-light">Buah</th>
                </tr>
                <tr>
                    <th>6. Klenteng
                        <input type="hidden" name="nama_data[]" value="klenteng">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control text-center py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[20]->isidata }}">
                    </th>
                    <th class="bg-light">Buah</th>
                    <th>6. Lainnya
                        <input type="hidden" name="nama_data[]" value="lainnya">
                    </th>
                    <th class="p-0">
                        <input type="number" class="form-control text-center py-0 pb-1 px-2 border-0" name="isidata[]"
                            style="font-size: .85rem" value="{{ $data[21]->isidata }}">
                    </th>
                    <th class="bg-light">Buah</th>
                </tr>
            </tbody>
        </table>

    </div>
</div>
{{-- Akhir Form Sarpras --}}