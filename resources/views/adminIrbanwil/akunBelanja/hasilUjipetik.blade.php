<div class="row">

    <div class="col-md-7">
        <h4 class="alert alert-info">Hasil Uji Petik</h4>
        <table class="table table-bordered ">
            <tr>
                <td colspan="4">
                    Nama Kegiatan : {{ $kegiatan }}<br>
                </td>
            </tr>
            <tr class="bg-info">
                <td class="text-center">Nomor TBPU </td>
                <td class="text-center">Jumlah Uang (Rp) </td>
                <td class="text-center">Jenis Belanja </td>
                <td class="text-center">Dokumen TBPU </td>
            </tr>
            <tr>
                <td class="text-center">{{ $nomor_bkp }}</td>
                <td class="text-center angka"> {{ $jumlah_bkp }}</td>
                <td class="text-center">{{ $jenis_belanja }}</td>
                <td class="text-center"><a href="{{ asset('storage/'.$file_bkp) }}"><img src="/img/logo-pdf.jpg"
                            width="50px"></a></td>
            </tr>
            <tr class="bg-info">
                <td class="text-center">Tgl Uji Petik </td>
                <td class="text-center">Metode </td>
                <td class="text-center">Validator </td>
                <td class="text-center">Nilai </td>
            </tr>
            <tr>
                <td class="text-center">{{ $hasil->tgl_uji_petik }}</td>
                <td class="text-center">{{ $hasil->metode }} </td>
                <td class="text-center">{{ $hasil->validator }}</td>
                <td class="text-center" style="font-size: 1.2rem">{{ $hasil->nilai }}</td>
            </tr>
            <tr>
                <td colspan="4">
                    Temuan Uji Petik : <br>
                    <ul>
                        <li>
                            {{ $hasil->kesimpulan_sementara }}
                        </li>
                    </ul>

                </td>
            </tr>
            <tr>
                <td colspan="4">
                    Rekomendasi Tindak Lanjuti: <br>
                    <ul>
                        <li>
                            {{ $hasil->rekomendasi_sementara }}
                        </li>
                    </ul>

                </td>
            </tr>
            <tr>
                <td colspan="4" class="text-right">
                    <button idhap="{{ $hasil->id }}" id="hapus_uji" class="btn btn-danger btn-sm">Hapus</button>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#ujiTBPU{{ $hasil->id }}" style="font-size: .85rem">
                        Edit Uji Petik
                    </button>
                </td>
            </tr>
            <!-- Modal -->
            <div class="modal fade" id="ujiTBPU{{ $hasil->id }}" data-backdrop="static" data-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-light" id="staticBackdropLabel">Form
                                Edit Hasil Validasi / Uji Petik </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/adminIrbanwil/editUjipetik" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $hasil->id }}">
                            <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                            <input type="hidden" name="tahun" value="{{ $tahun }}">

                            <div class="modal-body p-4">
                                <div class="form-group mb-3">
                                    <label for="kegiatan">Nama Kegiatan :</label>
                                    <input type="text" class="form-control" id="kegiatan" value="{{ $kegiatan }}"
                                        style="font-size: .75rem" readonly>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group  mb-3">
                                            <label>Nomor TBPU :</label>
                                            <input type="text" name="nomor" class="form-control"
                                                style="font-size: .85rem" value="{{ $nomor_bkp }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-3">
                                            <label for="jenis_belanja">Jenis Belanja :</label>
                                            <select class="form-control" name="belanja_id" id="jenis_belanja"
                                                style="font-size: .85rem" readonly>
                                                <option selected>{{ $jenis_belanja }}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Jumlah Uang :</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text" style="font-size: .85rem">
                                                        Rp.
                                                    </div>
                                                </div>
                                                <input type="text" name="jumlah" class="form-control jumlah angka"
                                                    id="inlineFormInputGroup" style="font-size: .85rem"
                                                    value="{{ $jumlah_bkp }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group  mb-3">
                                    <label>Sebagai Pembayaran :</label>
                                    <div class="input-group mb-2">
                                        <input type="text" name="sebagai" class="form-control sebagai"
                                            style="font-size: .85rem" value="{{ $hasil->penataanbelanja_bkp->sebagai }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="status">Metode Uji Petik :</label>
                                            <select class="form-control" id="status" name="metode"
                                                style="font-size: .85rem" required>
                                                <option value="">- Pilih -</option>
                                                <option>Konfirmasi Langsung</option>
                                                <option>Konfirmasi Tidak Langsung</option>
                                                <option>Kuisioner</option>
                                                <option>Surat Pernyataan</option>
                                                <option>Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="status">Tanggal Uji Petik :</label>
                                            <input type="date" class="form-control" style="font-size: .85rem"
                                                name="tgl_uji_petik" value="{{ $hasil->tgl_uji_petik }}" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group  mb-3">
                                            <label>Nilai Hasil Validasi (0-100) :</label>
                                            <div class="input-group mb-2">
                                                <input type="number" name="nilai" class="form-control"
                                                    style="font-size: .85rem" value="{{ $hasil->nilai }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group  mb-3">
                                    <label>Nama Validator (Pelaksana Uji Petik) :</label>
                                    <div class="input-group mb-2">
                                        <input type="tet" name="validator" class="form-control"
                                            style="font-size: .85rem" value="{{ $hasil->validator }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kesimpulan">Temuan Uji Petik :</label>
                                    <textarea class="form-control" id="kesimpulan" rows="3" name="kesimpulan_sementara"
                                        style="font-size: .85rem">{{ $hasil->kesimpulan_sementara }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="catatan">Rekomendasi Tindak Lanjut :</label>
                                    <textarea class="form-control" id="catatan" rows="3" name="rekomendasi_sementara"
                                        style="font-size: .85rem">{{ $hasil->rekomendasi_sementara }}</textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-sm">UPDATE </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </table>
    </div>
</div>
<script>
    $('#hapus_uji').on('click', function(){
        var idhap = $(this).attr('idhap');
        var yakin = confirm('apakah anda yakin hapus ?');
        if(yakin){
            document.location.href='/adminIrbanwil/hapusUji/'+idhap;
        }

    })
</script>