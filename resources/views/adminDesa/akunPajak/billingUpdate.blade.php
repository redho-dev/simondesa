<h4 class="alert alert-info">Form Upload Surat Setoran Pajak (SSP) Atas Belanja APB Desa TA {{ $tahun }}</h4>
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label for="totalAnggaran">Jumlah Anggaran Belanja</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                </div>
                <input type="text" class="form-control angka" id="Anggaran" value="{{ $belanja }}"
                    style="font-size: .75rem" readonly>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="totalAnggaran">Total TBPU/BKP</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                </div>
                <input type="text" class="form-control angka" id="totalBkp" value="{{ $totalbkp }}"
                    style="font-size: .75rem" readonly>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="totalSPP">Total Potongan Pajak</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                </div>
                <input type="text" class="form-control angka" id="totalPajak" value="{{ $totalpajak }}"
                    style="font-size: .75rem" readonly>
            </div>

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="progressSPP">Pajak disetor</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                </div>
                <input type="text" class="form-control angka" id="pajakTerbayar" value="{{ $pajakterbayar }}"
                    style="font-size: .75rem" readonly>
            </div>

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="progressSPP">Pajak Belum disetor</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-size: .75rem">Rp.</div>
                </div>
                <input type="text" class="form-control angka" id="pajakBelum" style=" font-size: .75rem" readonly>
            </div>

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="progressSPP">Progress Setor Pajak</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="progressPajak" style="font-size: .75rem" readonly>
                <div class="input-group-append">
                    <div class="input-group-text" style="font-size: .75rem">%</div>
                </div>
            </div>

        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <tr style="background-color:steelblue">
                <th>#</th>
                <th>Nomor TBPU/BKP <br> Tanggal</th>
                <th class="text-center">Jumlah Uang dlm <br>TBPU (Rp)</th>
                <th>Jenis Belanja /<br> Sbg Pembayaran</th>
                <th class="text-center">Potongan <br> PPn (Rp)</th>
                <th class="text-center">Potongan <br> PPh (Rp)</th>

                <th class="text-center">Potongan <br> Lainnya (Rp)</th>
                <th class="text-center">Surat Setor Pajak
                    <br>PPn
                </th>
                <th class="text-center">Surat Setor Pajak
                    <br>PPh (21,22,23)
                </th>
                <th class="text-center">Surat Setor Pajak
                    <br>Lainnya
                </th>
                <th class="text-center">Upload/Edit</th>

            </tr>
            @foreach($bkpPajak as $bkp)
            <tr class=" {{ $bkp->billing_pph || $bkp->billing_ppn ? 'text-primary' : '' }}" id="row_{{ $bkp->id }}">
                <td>{{ $loop->iteration }}</td>
                <td>
                    <ul class="pl-2">
                        <li>No : {{ $bkp->nomor }}</li>
                        <li>Tgl: {{ $bkp->tanggal }}</li>
                    </ul>
                </td>
                <td class="angka">{{ $bkp->jumlah }}</td>
                <td>
                    <ul class="pl-2">
                        <li> {{ $bkp->belanja->jenis_belanja }}</li>
                        <li>{{ $bkp->sebagai }}</li>
                    </ul>

                </td>
                <td class="angka">{{ $bkp->ppn }}</td>
                <td class="angka">{{ $bkp->pph }}</td>
                <td class="angka">{{ $bkp->lainnya }}</td>
                <td class="text-center">
                    @if($bkp->ppn && $bkp->billing_ppn)
                    <a href="{{ asset('storage/'.$bkp->billing_ppn) }}" target="_blank"><img src="/img/logo-pdf.jpg"
                            width="35px"></a>
                    @elseif($bkp->ppn && !$bkp->billing_ppn)
                    <small class="text-danger">(belum setor)</small>
                    @endif
                </td>
                <td class="text-center">
                    @if($bkp->pph && $bkp->billing_pph)
                    <a href="{{ asset('storage/'.$bkp->billing_pph) }}" target="_blank"><img src="/img/logo-pdf.jpg"
                            width="35px"></a>
                    @elseif($bkp->pph && !$bkp->billing_pph)
                    <small class="text-danger">(belum setor)</small>
                    @endif
                </td>
                <td class="text-center">
                    @if($bkp->lainnya && $bkp->billing_lainnya)
                    <a href="{{ asset('storage/'.$bkp->billing_lainnya) }}" target="_blank"><img src="/img/logo-pdf.jpg"
                            width="35px"></a>
                    @elseif($bkp->lainnya && !$bkp->billing_lainnya)
                    <small class="text-danger">(belum setor)</small>
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
                            <input type="hidden" name="crud" value="hapus">
                            @if($bkp->billing_pph)
                            <input type="hidden" name="billing_pph" value="{{ $bkp->billing_pph }}">
                            @endif
                            @if($bkp->billing_ppn)
                            <input type="hidden" name="billing_ppn" value="{{ $bkp->billing_ppn }}">
                            @endif
                            @if($bkp->billing_ppn)
                            <input type="hidden" name="billing_lainnya" value="{{ $bkp->billing_lainnya }}">
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
                                    Tambah Surat Setor Pajak</h5>
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
                                    @if($bkp->ppn)
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="text-dark">Jumlah Setoran PPn</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-size: .75rem">Rp.
                                                        </div>
                                                    </div>
                                                    <input type="text" name="ppn" class="form-control jumlah angka"
                                                        id="inlineFormInputGroup" style="font-size: .75rem"
                                                        value="{{ $bkp->ppn }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="text-dark">Upload Surat Setor PPn
                                                </label>
                                                <div class="custom-file ">
                                                    <input type="file" name="billing_ppn"
                                                        class="custom-file-input billing_ppn" id="customFile ">
                                                    <label class="custom-file-label nama_file2" for="customFile"
                                                        style="font-size: .75rem">Pilih
                                                        file PDF
                                                        max: 1MB</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <hr>
                                    @if($bkp->pph)
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="text-dark">Jumlah Setoran PPh</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-size: .75rem">Rp.
                                                        </div>
                                                    </div>
                                                    <input type="text" name="pph" class="form-control jumlah angka"
                                                        id="inlineFormInputGroup" style="font-size: .75rem"
                                                        value="{{ $bkp->pph }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="text-dark">Upload Surat Setor PPh
                                                    (21/22/23)
                                                </label>
                                                <div class="custom-file ">
                                                    <input type="file" name="billing_pph"
                                                        class="custom-file-input billing_pph" id="customFile ">
                                                    <label class="custom-file-label nama_file1" for="customFile"
                                                        style="font-size: .75rem">Pilih
                                                        file PDF
                                                        max: 1MB</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <hr>
                                    @if($bkp->lainnya)
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="text-dark">Jumlah Setoran Lainnya</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-size: .75rem">Rp.
                                                        </div>
                                                    </div>
                                                    <input type="text" name="lainnya" class="form-control jumlah angka"
                                                        id="inlineFormInputGroup" style="font-size: .75rem"
                                                        value="{{ $bkp->lainnya }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="text-dark">Upload Surat Setor lainnya
                                                </label>
                                                <div class="custom-file ">
                                                    <input type="file" name="billing_lainnya"
                                                        class="custom-file-input billing_lainnya" id="customFile">
                                                    <label class="custom-file-label nama_file3" for="customFile"
                                                        style="font-size: .75rem">Pilih
                                                        file PDF
                                                        max: 1MB</label>
                                                </div>
                                            </div>
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
                                    Edit/Update Surat Setor Pajak (SSP)</h5>
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

                                    @if($bkp->ppn)
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Jumlah Setoran PPn</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-size: .75rem">Rp.
                                                        </div>
                                                    </div>
                                                    <input type="text" name="ppn" class="form-control jumlah angka"
                                                        id="inlineFormInputGroup" style="font-size: .75rem"
                                                        value="{{ $bkp->ppn }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Ganti SSP PPn
                                                </label>
                                                <div class="custom-file ">
                                                    <input type="hidden" name="old_ppn" value="{{ $bkp->billing_ppn }}">
                                                    <input type="file" name="billing_ppn"
                                                        class="custom-file-input billing_ppn" id="customFile ">
                                                    <label class="custom-file-label nama_file2" for="customFile"
                                                        style="font-size: .75rem">{{$bkp->billing_ppn}}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <hr>
                                    @if($bkp->pph)
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Jumlah Setoran PPh</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-size: .75rem">Rp.
                                                        </div>
                                                    </div>
                                                    <input type="text" name="pph" class="form-control jumlah angka"
                                                        id="inlineFormInputGroup" style="font-size: .75rem"
                                                        value="{{ $bkp->pph }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Ganti SSP PPh
                                                    (21/22/23)
                                                </label>
                                                <div class="custom-file ">
                                                    <input type="hidden" name="old_pph" value="{{ $bkp->billing_pph }}">
                                                    <input type="file" name="billing_pph"
                                                        class="custom-file-input billing_pph" id="customFile ">
                                                    <label class="custom-file-label nama_file1" for="customFile"
                                                        style="font-size: .75rem">{{$bkp->billing_pph}}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <hr>
                                    @if($bkp->lainnya)
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Jumlah Setoran Lainnya</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-size: .75rem">Rp.
                                                        </div>
                                                    </div>
                                                    <input type="text" name="lainnya" class="form-control jumlah angka"
                                                        id="inlineFormInputGroup" style="font-size: .75rem"
                                                        value="{{ $bkp->lainnya }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Ganti SSP Lainnya
                                                </label>
                                                <div class="custom-file ">
                                                    <input type="hidden" name="old_lainnya"
                                                        value="{{ $bkp->billing_lainnya }}">
                                                    <input type="file" name="billing_lainnya"
                                                        class="custom-file-input billing_lainnya" id="customFile ">
                                                    <label class="custom-file-label nama_file3" for="customFile"
                                                        style="font-size: .75rem">{{$bkp->billing_lainnya}}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">UPDATE</button>
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