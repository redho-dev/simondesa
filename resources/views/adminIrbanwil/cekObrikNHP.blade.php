<p class="mb-0 text-dark" style="font-size: 1rem">PILIH OBRIK DAN TAHUN DATA PENILAIAN</p>
<div class="card p-4">
    <form action="/adminIrbanwil/cekObrik" method="post">
        <div class="row align-items-center">

            @csrf
            <div class="col-md-2">
                <div class="form-group">
                    <label for="pilcam">Pilih Kecamatan</label>
                    <select class="form-control" id="pilcam" style="font-size: .85rem" name="kecamatan">
                        @foreach($kecamatan as $kec)
                        <option value="{{ $kec->nama_kecamatan }}" {{ session()->get('pilcam')==$kec->nama_kecamatan ?
                            'selected' : '' }}>{{ $kec->nama_kecamatan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="pildes">Pilih Desa</label>
                    <select class="form-control" id="pildes" style="font-size: .85rem" name="desa">
                        @foreach($deswal as $desa)
                        <option value="{{ $desa->asal }}" {{ session()->get('pildes')==$desa->asal ?
                            'selected' : '' }} >{{ $desa->asal}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="tahun">Tahun Data</label>
                    <input type="text" class="form-control" id="tahun" style="font-size: .85rem"
                        value="{{ session()->get('tahun') ?? " $tahun" }}" name="tahun">
                </div>
            </div>
            <div class="col-md-2 align-items-center">
                <input type="hidden" name="cek_nhp">
                <button class="btn btn-primary btn-sm mt-4">Cek NHP</button>
            </div>

        </div>
    </form>
</div>