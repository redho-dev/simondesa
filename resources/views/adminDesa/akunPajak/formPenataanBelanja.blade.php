<h4>Form Upload Billing dan Tanda Terima Setoran Pajak</h4>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <tr style="background-color: azure">
                <th>#</th>
                <th>Nomor TBPU/Kwitansi <br> Tanggal</th>
                <th>Jumlah Uang dlm <br>Kwitansi (Rp)</th>
                <th>Jenis Belanja /<br> Sbg Pembayaran</th>
                <th>PPh</th>
                <th>PPn</th>
                <th>Billing & Tanda Terima
                    <br>Setor PPh (21,22,23)
                </th>
                <th>Billing & Tanda Terima
                    <br>Setor PPn
                </th>
                <th class="text-center">Upload/Edit</th>

            </tr>
            @foreach($databkp as $bkp)
            <tr class=" {{ $bkp->billing_pph || $bkp->billing_ppn ? 'text-primary' : '' }}">
                <td>{{ $loop->iteration }}</td>
                <td>
                    <ul class="pl-2">
                        <li>No : {{ $bkp->nomor }}</li>
                        <li>Tgl: {{ $bkp->tanggal }}</li>
                    </ul>
                </td>
                <td>{{ $bkp->jumlah }}</td>
                <td>
                    <ul class="pl-2">
                        <li> {{ $bkp->belanja->jenis_belanja }}</li>
                        <li>{{ $bkp->sebagai }}</li>
                    </ul>

                </td>
                <td>{{ $bkp->pph }}</td>
                <td>{{ $bkp->ppn }}</td>
                <td class="text-center">
                    @if($bkp->pph && $bkp->billing_pph)
                    <a href="{{ asset('storage/'.$bkp->billing_pph) }}" target="_blank"><img src="/img/logo-pdf.jpg"
                            width="35px"></a>
                    @else
                    <small class="text-danger">(kosong)</small>
                    @endif
                </td>
                <td class="text-center">
                    @if($bkp->billing_ppn)
                    <a href="{{ asset('storage/'.$bkp->billing_ppn) }}" target="_blank"><img src="/img/logo-pdf.jpg"
                            width="35px"></a>
                    @else
                    @if($bkp->ppn)
                    <small class="text-danger">(kosong)</small>
                    @else
                    @endif
                    @endif
                </td>
                <td class="text-center">
                    <div class="d-flex justify-content-center">
                        <button
                            class="btn btn-primary btn-sm {{ $bkp->billing_pph || $bkp->billing_ppn ? 'd-none' : '' }}"
                            data-toggle="modal" data-target="#Billing{{ $bkp->id }}" style="font-size: .75rem">+
                            Upload</button>

                        @if($bkp->billing_pph || $bkp->billing_ppn)
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#editTBPU{{ $bkp->id }}" style="font-size: .75rem">
                            Edit
                        </button>
                        <form action="/adminDesa/hapusBilling" method="post">
                            @csrf
                            <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                            <input type="hidden" name="id" value="{{ $bkp->id }}">
                            @if($bkp->billing_pph)
                            <input type="hidden" name="billing_pph" value="{{ $bkp->billing_pph }}">
                            @endif
                            @if($bkp->billing_ppn)
                            <input type="hidden" name="billing_ppn" value="{{ $bkp->billing_ppn }}">
                            @endif
                            <button class="btn btn-danger btn-sm" type="submit"
                                onclick="return confirm('yakin hapus?');">hapus</button>
                        </form>
                        @endif
                    </div>
                </td>
                <!-- Modal Tambah Billing-->
                <div class="modal fade" id="Billing{{ $bkp->id }}" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-dark" id="staticBackdropLabel">Form
                                    Tambah Billing dan Tanda Setor Pajak</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="/adminDesa/tambahBilling" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                <input type="hidden" name="tahun" value="{{ $tahun }}">
                                <input type="hidden" name="id" value="{{ $bkp->id }}">
                                <input type="hidden" name="crud" value="tambah">

                                <div class="modal-body">

                                    <div class="form-group  mb-3">
                                        <label>Nomor Tanda Bukti Pengeluaran Uang
                                            (TBPU/Kwitansi/BKP)</label>
                                        <input type="text" name="nomor" class="form-control" style="font-size: .75rem"
                                            value="{{ $bkp->nomor }}" disabled required>
                                    </div>

                                    <div class="form-group  mb-3">
                                        <label>Sebagai Pembayaran</label>
                                        <div class="input-group mb-2">
                                            <input type="text" name="sebagai" class="form-control sebagai"
                                                style="font-size: .75rem" value="{{ $bkp->sebagai }}" disabled required>
                                        </div>
                                    </div>
                                    @if($bkp->pph)
                                    <div class="form-group  mb-3">
                                        <label>Jumlah Setoran PPh</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                                            </div>
                                            <input type="text" name="pph" class="form-control jumlah angka"
                                                id="inlineFormInputGroup" style="font-size: .75rem"
                                                value="{{ $bkp->pph }}" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group  mb-3 mt-4">
                                        <label>Upload Billing dan Tanda Terima Setor PPh
                                            (21/22/23)
                                        </label>
                                        <div class="custom-file ">
                                            <input type="file" name="billing_pph" class="custom-file-input billing_pph"
                                                id="customFile " required>
                                            <label class="custom-file-label nama_file1" for="customFile"
                                                style="font-size: .75rem">Pilih
                                                file PDF
                                                max: 1MB</label>
                                        </div>
                                    </div>
                                    @endif
                                    @if($bkp->ppn)
                                    <div class="form-group  mb-3">
                                        <label>Jumlah Setoran PPn</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                                            </div>
                                            <input type="text" name="ppn" class="form-control jumlah angka"
                                                id="inlineFormInputGroup" style="font-size: .75rem"
                                                value="{{ $bkp->ppn }}" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group  mb-3 mt-4">
                                        <label>Upload Billing dan Tanda Terima Setor PPn
                                        </label>
                                        <div class="custom-file ">
                                            <input type="file" name="billing_ppn" class="custom-file-input billing_ppn"
                                                id="customFile " required>
                                            <label class="custom-file-label nama_file2" for="customFile"
                                                style="font-size: .75rem">Pilih
                                                file PDF
                                                max: 1MB</label>
                                        </div>
                                    </div>
                                    @endif

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

                <!-- Modal Edit BILLING-->
                <div class="modal fade" id="editTBPU{{ $bkp->id }}" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-dark" id="staticBackdropLabel">Form
                                    Edit/Update Billing dan Tanda Setor Pajak</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="/adminDesa/tambahBilling" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="asal_id" value="{{ $infos->asal_id }}">
                                <input type="hidden" name="tahun" value="{{ $tahun }}">
                                <input type="hidden" name="id" value="{{ $bkp->id }}">
                                <input type="hidden" name="crud" value="update">

                                <div class="modal-body">

                                    <div class="form-group  mb-3">
                                        <label>Nomor Tanda Bukti Pengeluaran Uang
                                            (TBPU/Kwitansi/BKP)</label>
                                        <input type="text" name="nomor" class="form-control" style="font-size: .75rem"
                                            value="{{ $bkp->nomor }}" disabled required>
                                    </div>

                                    <div class="form-group  mb-3">
                                        <label>Sebagai Pembayaran</label>
                                        <div class="input-group mb-2">
                                            <input type="text" name="sebagai" class="form-control sebagai"
                                                style="font-size: .75rem" value="{{ $bkp->sebagai }}" disabled required>
                                        </div>
                                    </div>
                                    @if($bkp->pph)
                                    <div class="form-group  mb-3">
                                        <label>Jumlah Setoran PPh</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                                            </div>
                                            <input type="text" name="pph" class="form-control jumlah angka"
                                                id="inlineFormInputGroup" style="font-size: .75rem"
                                                value="{{ $bkp->pph }}" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group  mb-3 mt-4">
                                        <label>Ganti File Billing dan Tanda Terima Setor PPh
                                            (21/22/23)
                                        </label>
                                        <div class="custom-file ">
                                            <input type="hidden" name="old_pph" value="{{ $bkp->billing_pph }}">
                                            <input type="file" name="billing_pph" class="custom-file-input billing_pph"
                                                id="customFile ">
                                            <label class="custom-file-label nama_file1" for="customFile"
                                                style="font-size: .75rem">{{$bkp->billing_pph}}</label>
                                        </div>
                                    </div>
                                    @endif
                                    @if($bkp->ppn)
                                    <div class="form-group  mb-3">
                                        <label>Jumlah Setoran PPn</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                                            </div>
                                            <input type="text" name="ppn" class="form-control jumlah angka"
                                                id="inlineFormInputGroup" style="font-size: .75rem"
                                                value="{{ $bkp->ppn }}" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group  mb-3 mt-4">
                                        <label>Ganti File Billing dan Tanda Terima Setor PPn
                                        </label>
                                        <div class="custom-file ">
                                            <input type="hidden" name="old_ppn" value="{{ $bkp->billing_ppn }}">
                                            <input type="file" name="billing_ppn" class="custom-file-input billing_ppn"
                                                id="customFile ">
                                            <label class="custom-file-label nama_file2" for="customFile"
                                                style="font-size: .75rem">{{$bkp->billing_ppn}}</label>
                                        </div>
                                    </div>
                                    @endif

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