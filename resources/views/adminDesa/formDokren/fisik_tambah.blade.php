<?php 
use App\Http\Controllers\DokrenController;
$cardat = new DokrenController;
$jumfisik = $cardat->jumlahKegiatan('rkpdes_murni_'.$tahun,'jumlah_kegiatan_fisik', $tahun, $infos->asal_id);
if(!$jumfisik){
    $jumfisik = 0;
}
?>

<form action="/adminDesa/tambahRenfisik" method="post" enctype="multipart/form-data"
    class="form-horizontal form-label-left">
    @csrf

    <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
    <input type="hidden" name="tahun" value="{{ $tahun }}">
    <input type="hidden" name="nama_dokren" value="{{ $nama_dokren }}">
    <div class="form-group row">
        <div class="col-md-8 mt-2">
            <p class="alert alert-primary">Input Data Perencanaan Pembangunan Fisik dalam RKP Desa Tahun {{ $tahun
                }}
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <table class="table table-bordered">
                <tr>
                    <th width='5%'>No</th>
                    <th width='35%'>Nama Kegiatan Pembangunan Fisik</th>
                    <th width='10%'>Jumlah/Volume</th>
                    <th width='10%'>Satuan</th>
                    <th width='15%'>Pagu Dlm RKPDes (Rp) </th>
                    {{-- <th width='25%'>Upload Desain-RAB-Gambar</th> --}}
                </tr>
                @for($i=1; $i<=$jumfisik;$i++) <tr>
                    <td>
                        {{ $i }}
                    </td>

                    <td>
                        <input type="hidden" name="nama_data[]" value="rencana_fisik{{ $i }}">
                        <input type="text" class="form-control" name="isidata[]"
                            style="font-size: .85rem; border-radius: 0;" required>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="volume[]"
                            style="font-size: .85rem; border-radius: 0;">
                    </td>
                    <td>
                        <input type="text" class="form-control" name="satuan[]"
                            style="font-size: .85rem; border-radius: 0;">
                    </td>
                    <td>

                        <input type="text" class="form-control pagu_fisik" name="pagu[]"
                            style="font-size: .85rem; border-radius: 0;">

                    </td>
                    {{-- <td>
                        @error("file_data_".$i)
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="input-group">
                            <div class="custom-file py-0">
                                <input type="file" name="file_data_{{ $i }}" class="custom-file-input" id="file_data"
                                    style="font-size: .85rem; border-radius: 0;">
                                <label class="custom-file-label text-muted file_data"
                                    style="font-size: .85rem; border-radius: 0;" for="file_sk">choose file PDF
                                </label>

                            </div>
                        </div>
                    </td> --}}
                    </tr>
                    @endfor


            </table>
            <small>contoh : </small><br>
            <small>1. pembangunan jalan onderlagh (L:2,5 meter - P:200 meter) jumlah : 1 , satuan :
                kegiatan</small><br>
            <small>2. pembangunan sumur bor, jumlah : 4 , satuan : unit</small>
        </div>
    </div>


    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-5 col-sm-5  offset-md-2">
            <button type="button" class="btn btn-primary">Cancel</button>
            <button type="reset" class="btn btn-primary">Reset</button>
            <button type="submit" class="btn btn-success">Kirim Data</button>
        </div>
    </div>

</form>