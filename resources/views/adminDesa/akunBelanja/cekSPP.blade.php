<div class="row">
    <div class="col-md-10">
        <table class="table table-bordered">
            <tr style="background-color: azure">
                <th style="vertical-align: middle">#</th>
                <th style="vertical-align: middle">Nomor SPP</th>
                <th style="vertical-align: middle">Tanggal</th>
                <th style="vertical-align: middle">Jumlah Uang (Rp)</th>
                <th class="text-center" style="vertical-align: middle">File_SPP
                    <br>(+Lampiran)
                </th>
                <th class="text-center" style="vertical-align: middle">Aksi</th>

            </tr>
            @foreach($dataspp as $spp)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $spp->nomor }} </td>
                <td>{{ $spp->tanggal }}</td>
                <td>{{ $spp->jumlah }}</td>
                <td class="text-center">
                    <a href="{{ asset('storage/'.$spp->file_spp) }}" target="_blank"><img src="/img/logo-pdf.jpg"
                            width="35px"></a>
                </td>

                <td class="text-center">
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#editSPP{{ $spp->id }}" style="font-size: .75rem">
                            Edit
                        </button>
                        <form action="/adminDesa/hapusSPP/{{ $spp->id }}" method="post">
                            @csrf
                            <button class="btn btn-danger btn-sm" type="submit"
                                onclick="return confirm('yakin hapus?');">hapus</button>
                        </form>
                    </div>
                </td>
                <!-- Modal -->
                <div class="modal fade" id="editSPP{{ $spp->id }}" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-dark" id="staticBackdropLabel">Form
                                    Edit/Update SPP</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="/adminDesa/updateSPP" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                <input type="hidden" name="tahun" value="{{ $tahun }}">
                                <input type="hidden" name="id" value="{{ $spp->id }}">
                                <input type="hidden" name="apbdes_kegiatan_id" value="{{ $spp->apbdes_kegiatan_id }}">


                                <div class="modal-body">
                                    <div class="form-group mb-3">
                                        <label for="kegiatan">Nama Kegiatan</label>
                                        <input type="text" class="form-control" id="kegiatan" value="{{$kegiatan }}"
                                            style="font-size: .75rem" readonly>
                                    </div>
                                    <div class="form-group  mb-3">
                                        <label>Nomor SPP</label>
                                        <input type="text" name="nomor" class="form-control" style="font-size: .75rem"
                                            value="{{ $spp->nomor }}" required>
                                    </div>

                                    <div class="form-group  mb-3">
                                        <label>Jumlah Uang Diminta</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="font-size: .75rem">Rp.
                                                </div>
                                            </div>
                                            <input type="text" name="jumlah" class="form-control jumlah angka"
                                                id="inlineFormInputGroup" style="font-size: .75rem"
                                                value="{{ $spp->jumlah }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group  mb-3">
                                        <label>Tanggal Tanda Bukti Pengeluaran Uang</label>
                                        <input type="date" name="tanggal" class="form-control" style="font-size: .75rem"
                                            value="{{ $spp->tanggal }}" required>
                                    </div>
                                    <div class="form-group  mb-3 mt-4">
                                        <label>Ganti File SPP (+ Persetujuan, Pernyataan
                                            Tanggungjawab Belanja)
                                        </label>
                                        <div class="custom-file row">
                                            <div class="col-md-2">
                                                <a href="{{ asset('storage/'.$spp->file_spp) }}" target="_blank"><img
                                                        src="/img/logo-pdf.jpg" width="25px"></a>
                                                <input type="hidden" name="old_1" value="{{ $spp->file_spp }}">
                                            </div>
                                            <div class="col-md-10">
                                                <input type="file" name="file_spp" class="custom-file-input file_spp"
                                                    id="customFile ">
                                                <label class="custom-file-label nama_file" for="customFile"
                                                    style="font-size: .75rem">Pilih file PDF
                                                    max: 1MB</label>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">KIRIM
                                        DATA</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </tr>
            @endforeach
        </table>
    </div>
</div>