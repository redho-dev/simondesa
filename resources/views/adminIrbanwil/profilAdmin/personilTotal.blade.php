@extends('templates.adminIrbanwil.main')

@section('content')

<!-- page content -->
<div role="main">
    <div class="">
        <div class="page-title">

            <h3 class="text-center">SUSUNAN PERSONIL INSPEKTORAT KABUPATEN LAMPUNG UTARA TAHUN {{ $tahun }}</h3>

        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="x_panel">
                <div class="x_content">
                    <h4 class="text-dark text-center">INSPEKTUR KABUPATEN LAMPUNG UTARA</h4>
                    <div class="row justify-content-center">

                        <div class="col-md-4">
                            <div class="card border-primary mb-3">
                                <div class="card-header text-primary" style="font-size: 1rem">{{ $inspektur->name }}
                                </div>
                                <div class="card-body text-primary">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="/foto_pegawai/{{ $inspektur->foto }}" class="img-circle" alt=""
                                                width="100%" style="max-height: 150px">
                                        </div>
                                        <div class="col-md-8">
                                            <table>
                                                <tr>
                                                    <td>NIP</td>
                                                    <td>:&emsp; {{ $inspektur->username }} </td>
                                                </tr>
                                                <tr>
                                                    <td>Pangkat &ensp;</td>
                                                    <td>:&emsp; {{ $inspektur->pangkat }} </td>
                                                </tr>
                                                <tr>
                                                    <td>Jabatan</td>
                                                    <td>:&emsp; {{ $inspektur->jabatan }} </td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat</td>
                                                    <td>:&emsp; Alamat</td>
                                                </tr>
                                                <tr>
                                                    <td>Phone</td>
                                                    <td>:&emsp; Phone </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="text-right">
                                                        <button class="btn btn-sm btn-info mt-3">Kompetensi</button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                    </div>
                    <hr>
                    <div class="row justify-contet-center" id="tompil">
                        <div class="col text-center">
                            <button
                                class="btn  {{ $infos->obrik=='sekretariat' || $infos->obrik=='Inspektur'  ? 'btn-primary' : 'btn-secondary' }}  t_sekretariat">SEKRETARIAT
                                &emsp; <span class="fa fa-chevron-circle-down"></span></button>
                        </div>
                        <div class="col text-center">
                            <button
                                class="btn  {{ $infos->obrik=='irbansus' ? 'btn-primary' : 'btn-secondary' }}  t_irbansus">IRBANSUS
                                &emsp; <span class="fa fa-chevron-circle-down"></span></button>
                        </div>
                        <div class="col text-center">
                            <button
                                class="btn  {{ $infos->obrik=='irban1' ? 'btn-primary' : 'btn-secondary' }}  t_irban1">IRBAN
                                1 &emsp; <span class="fa fa-chevron-circle-down"></span></button>
                        </div>
                        <div class="col text-center">
                            <button
                                class="btn  {{ $infos->obrik=='irban2' ? 'btn-primary' : 'btn-secondary' }}  t_irban2">IRBAN
                                2 &emsp; <span class="fa fa-chevron-circle-down"></span></button>
                        </div>
                        <div class="col text-center">
                            <button
                                class="btn  {{ $infos->obrik=='irban3' ? 'btn-primary' : 'btn-secondary' }}  t_irban3">IRBAN
                                3 &emsp; <span class="fa fa-chevron-circle-down"></span></button>
                        </div>
                        <div class="col text-center">
                            <button
                                class="btn  {{ $infos->obrik=='irban4' ? 'btn-primary' : 'btn-secondary' }} t_irban4">IRBAN
                                4 &emsp; <span class="fa fa-chevron-circle-down"></span></button>
                        </div>
                    </div>
                    <hr>

                    <div class="row sekretariat mt-2"
                        style="display: {{ $infos->obrik=='sekretariat' || $infos->obrik == 'Inspektur' ? '' : 'none' }}">
                        @foreach($sekretariat as $set)
                        <div class="col-md-4">
                            <div class="card border-primary mb-3">
                                <div class="card-header text-primary" style="font-size: 1rem">{{ $set->name }}</div>
                                <div class="card-body text-primary">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="/foto_pegawai/{{ $set->foto }}" class="img-circle" alt=""
                                                width="100%" style="max-height: 150px">
                                        </div>
                                        <div class="col-md-8 ">
                                            <style>
                                                td,
                                                tr {
                                                    vertical-align: middle;
                                                }
                                            </style>
                                            <table width="100%">
                                                <tr>
                                                    <td width="25%">NIP</td>
                                                    <td width="5%">:</td>
                                                    <td width="70%">{{ $set->username }} </td>
                                                </tr>
                                                <tr style="vertical-align: middle">
                                                    <td style="vertical-align: middle">Pangkat</td>
                                                    <td style="vertical-align: middle">:</td>
                                                    <td style="vertical-align: middle">{{ trim($set->pangkat) }} </td>
                                                </tr>
                                                <tr style="vertical-align: middle">
                                                    <td style="vertical-align: middle">Jabatan</td>
                                                    <td style="vertical-align: middle">:</td>
                                                    <td style="vertical-align: middle">{{ $set->jabatan }} </td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat</td>
                                                    <td>:</td>
                                                    <td>Alamat</td>
                                                </tr>
                                                <tr>
                                                    <td>Phone</td>
                                                    <td>:</td>
                                                    <td>Phone </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right">
                                                        <button class="btn btn-sm btn-info mt-3">Kompetensi</button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>



                    <div class="row irbansus mt-2" style="display: {{ $infos->obrik=='irbansus' ? '' : 'none' }}">
                        @foreach($irbansus as$sus)
                        <div class="col-md-4">
                            <div class="card border-primary mb-3">
                                <div class="card-header text-primary" style="font-size: 1rem">{{$sus->name }}</div>
                                <div class="card-body text-primary">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="/foto_pegawai/{{$sus->foto }}" class="img-circle" alt=""
                                                width="100%" style="max-height: 150px">
                                        </div>
                                        <div class="col-md-8 ">
                                            <style>
                                                td,
                                                tr {
                                                    vertical-align: middle;
                                                }
                                            </style>
                                            <table width="100%">
                                                <tr>
                                                    <td width="25%">NIP</td>
                                                    <td width="5%">:</td>
                                                    <td width="70%">{{ $sus->username }} </td>
                                                </tr>
                                                <tr style="vertical-align: middle">
                                                    <td style="vertical-align: middle">Pangkat</td>
                                                    <td style="vertical-align: middle">:</td>
                                                    <td style="vertical-align: middle">{{ trim($sus->pangkat) }} </td>
                                                </tr>
                                                <tr style="vertical-align: middle">
                                                    <td style="vertical-align: middle">Jabatan</td>
                                                    <td style="vertical-align: middle">:</td>
                                                    <td style="vertical-align: middle">{{ $sus->jabatan }} </td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat</td>
                                                    <td>:</td>
                                                    <td>Alamat</td>
                                                </tr>
                                                <tr>
                                                    <td>Phone</td>
                                                    <td>:</td>
                                                    <td>Phone </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right">
                                                        <button class="btn btn-sm btn-info mt-3">Kompetensi</button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>



                    <div class="row irban1 mt-2" style="display: {{ $infos->obrik=='irban1' ? '' : 'none' }}">
                        <div class="col-md-12 text-center">
                            <button class="btn btn-info btn-sm mb-2" data-toggle="modal" data-target="#obrik_irban1">
                                <span class="fa fa-binoculars"></span> Cek Daftar
                                Obrik</button>
                        </div>
                        @foreach($irban1 as $ir1)
                        <div class="col-md-4">
                            <div class="card border-primary mb-3">
                                <div class="card-header text-primary" style="font-size: 1rem">{{$ir1->name }}</div>
                                <div class="card-body text-primary">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="/foto_pegawai/{{$ir1->foto }}" class="img-circle" alt=""
                                                width="100%" style="max-height: 150px">
                                        </div>
                                        <div class="col-md-8 ">
                                            <style>
                                                td,
                                                tr {
                                                    vertical-align: middle;
                                                }
                                            </style>
                                            <table width="100%">
                                                <tr>
                                                    <td width="25%">NIP</td>
                                                    <td width="5%">:</td>
                                                    <td width="70%">{{ $ir1->username }} </td>
                                                </tr>
                                                <tr style="vertical-align: middle">
                                                    <td style="vertical-align: middle">Pangkat</td>
                                                    <td style="vertical-align: middle">:</td>
                                                    <td style="vertical-align: middle">{{ trim($ir1->pangkat) }} </td>
                                                </tr>
                                                <tr style="vertical-align: middle">
                                                    <td style="vertical-align: middle">Jabatan</td>
                                                    <td style="vertical-align: middle">:</td>
                                                    <td style="vertical-align: middle">{{ $ir1->jabatan }} </td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat</td>
                                                    <td>:</td>
                                                    <td>Alamat</td>
                                                </tr>
                                                <tr>
                                                    <td>Phone</td>
                                                    <td>:</td>
                                                    <td>Phone </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right">
                                                        <button class="btn btn-sm btn-info mt-3">Kompetensi</button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                    </div>


                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>



                    <div class="row irban2 mt-2" style="display: {{ $infos->obrik=='irban2' ? '' : 'none' }}">
                        <div class="col-md-12 text-center">
                            <button class="btn btn-info btn-sm mb-2" data-toggle="modal" data-target="#obrik_irban2">
                                <span class="fa fa-binoculars"></span> Cek Daftar
                                Obrik</button>
                        </div>
                        @foreach($irban2 as $ir2)
                        <div class="col-md-4">
                            <div class="card border-primary mb-3">
                                <div class="card-header text-primary" style="font-size: 1rem">{{$ir2->name }}</div>
                                <div class="card-body text-primary">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="/foto_pegawai/{{$ir2->foto }}" class="img-circle" alt=""
                                                width="100%" style="max-height: 150px">
                                        </div>
                                        <div class="col-md-8 ">
                                            <style>
                                                td,
                                                tr {
                                                    vertical-align: middle;
                                                }
                                            </style>
                                            <table width="100%">
                                                <tr>
                                                    <td width="25%">NIP</td>
                                                    <td width="5%">:</td>
                                                    <td width="70%">{{ $ir2->username }} </td>
                                                </tr>
                                                <tr style="vertical-align: middle">
                                                    <td style="vertical-align: middle">Pangkat</td>
                                                    <td style="vertical-align: middle">:</td>
                                                    <td style="vertical-align: middle">{{ trim($ir2->pangkat) }} </td>
                                                </tr>
                                                <tr style="vertical-align: middle">
                                                    <td style="vertical-align: middle">Jabatan</td>
                                                    <td style="vertical-align: middle">:</td>
                                                    <td style="vertical-align: middle">{{ $ir2->jabatan }} </td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat</td>
                                                    <td>:</td>
                                                    <td>Alamat</td>
                                                </tr>
                                                <tr>
                                                    <td>Phone</td>
                                                    <td>:</td>
                                                    <td>Phone </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right">
                                                        <button class="btn btn-sm btn-info mt-3">Kompetensi</button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>



                    <div class="row irban3 mt-2" style="display: {{ $infos->obrik=='irban3' ? '' : 'none' }}">
                        <div class="col-md-12 text-center">
                            <button class="btn btn-info btn-sm mb-2" data-toggle="modal" data-target="#obrik_irban3">
                                <span class="fa fa-binoculars"></span> Cek Daftar
                                Obrik</button>
                        </div>
                        @foreach($irban3 as $ir3)
                        <div class="col-md-4">
                            <div class="card border-primary mb-3">
                                <div class="card-header text-primary" style="font-size: 1rem">{{$ir3->name }}</div>
                                <div class="card-body text-primary">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="/foto_pegawai/{{$ir3->foto }}" class="img-circle" alt=""
                                                width="100%" style="max-height: 150px">
                                        </div>
                                        <div class="col-md-8 ">
                                            <style>
                                                td,
                                                tr {
                                                    vertical-align: middle;
                                                }
                                            </style>
                                            <table width="100%">
                                                <tr>
                                                    <td width="25%">NIP</td>
                                                    <td width="5%">:</td>
                                                    <td width="70%">{{ $ir3->username }} </td>
                                                </tr>
                                                <tr style="vertical-align: middle">
                                                    <td style="vertical-align: middle">Pangkat</td>
                                                    <td style="vertical-align: middle">:</td>
                                                    <td style="vertical-align: middle">{{ trim($ir3->pangkat) }} </td>
                                                </tr>
                                                <tr style="vertical-align: middle">
                                                    <td style="vertical-align: middle">Jabatan</td>
                                                    <td style="vertical-align: middle">:</td>
                                                    <td style="vertical-align: middle">{{ $ir3->jabatan }} </td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat</td>
                                                    <td>:</td>
                                                    <td>Alamat</td>
                                                </tr>
                                                <tr>
                                                    <td>Phone</td>
                                                    <td>:</td>
                                                    <td>Phone </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right">
                                                        <button class="btn btn-sm btn-info mt-3">Kompetensi</button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>



                    <div class="row irban4 mt-2" style="display: {{ $infos->obrik=='irban4' ? '' : 'none' }}">
                        <div class="col-md-12 text-center">
                            <button class="btn btn-info btn-sm mb-2" data-toggle="modal" data-target="#obrik_irban4">
                                <span class="fa fa-binoculars"></span> Cek Daftar
                                Obrik</button>
                        </div>
                        @foreach($irban4 as $ir4)
                        <div class="col-md-4">
                            <div class="card border-primary mb-3">
                                <div class="card-header text-primary" style="font-size: 1rem">{{$ir4->name }}</div>
                                <div class="card-body text-primary">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="/foto_pegawai/{{$ir4->foto }}" class="img-circle" alt=""
                                                width="100%" style="max-height: 150px">
                                        </div>
                                        <div class="col-md-8 ">
                                            <style>
                                                td,
                                                tr {
                                                    vertical-align: middle;
                                                }
                                            </style>
                                            <table width="100%">
                                                <tr>
                                                    <td width="25%">NIP</td>
                                                    <td width="5%">:</td>
                                                    <td width="70%">{{ $ir4->username }} </td>
                                                </tr>
                                                <tr style="vertical-align: middle">
                                                    <td style="vertical-align: middle">Pangkat</td>
                                                    <td style="vertical-align: middle">:</td>
                                                    <td style="vertical-align: middle">{{ trim($ir4->pangkat) }} </td>
                                                </tr>
                                                <tr style="vertical-align: middle">
                                                    <td style="vertical-align: middle">Jabatan</td>
                                                    <td style="vertical-align: middle">:</td>
                                                    <td style="vertical-align: middle">{{ $ir4->jabatan }} </td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat</td>
                                                    <td>:</td>
                                                    <td>Alamat</td>
                                                </tr>
                                                <tr>
                                                    <td>Phone</td>
                                                    <td>:</td>
                                                    <td>Phone </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right">
                                                        <button class="btn btn-sm btn-info mt-3">Kompetensi</button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="obrik_irban4" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Daftar Obrik Desa Irban
                                        4</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered table-striped">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>No</th>
                                                <th>Kecamatan</th>
                                                <th>Nama Desa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($obrik4 as $ob4)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $ob4->kecamatan }}</td>
                                                <td>{{ $ob4->asal }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="obrik_irban1" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Daftar Obrik Desa Irban
                                        1</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered table-striped">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>No</th>
                                                <th>Kecamatan</th>
                                                <th>Nama Desa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($obrik1 as $ob1)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $ob1->kecamatan }}</td>
                                                <td>{{ $ob1->asal }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="obrik_irban2" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Daftar Obrik Desa Irban
                                        2</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered table-striped">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>No</th>
                                                <th>Kecamatan</th>
                                                <th>Nama Desa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($obrik2 as $ob2)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $ob2->kecamatan }}</td>
                                                <td>{{ $ob2->asal }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="obrik_irban3" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title text-white" id="staticBackdropLabel">Daftar Obrik Desa Irban
                                        3</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered table-striped">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>No</th>
                                                <th>Kecamatan</th>
                                                <th>Nama Desa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($obrik3 as $ob3)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $ob3->kecamatan }}</td>
                                                <td>{{ $ob3->asal }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->



{{-- notifikasi --}}
@if(session()->has('success'))
<script>
    Swal.fire({
  position: 'center',
  icon: 'success',
  title: '{{ session("success") }}',
  showConfirmButton: true
}).then(function(){
    document.location.href='/logoutIrbanwil';
})
</script>

@endif

@if(session()->has('fail'))
<script>
    Swal.fire({
  position: 'center',
  icon: 'error',
  title: '{{ session("fail") }}',
  showConfirmButton: true
  })
</script>

@endif

@endsection
@push('script')
<script>
    $('.t_sekretariat').on('click', function(){
        var tompil = $('#tompil');
        var aktif = tompil.find('.btn-primary');
        aktif.toggleClass('btn-secondary');
        aktif.toggleClass('btn-primary');
        $('.t_sekretariat').toggleClass('btn-secondary');
        $('.t_sekretariat').toggleClass('btn-primary');
        
        $('.sekretariat').toggle('slow');
        
        $('.irbansus').hide();
        $('.irban1').hide();
        $('.irban2').hide();
        $('.irban3').hide();
        $('.irban4').hide();
    })
    
    $('.t_irbansus').on('click', function(){
        var tompil = $('#tompil');
        var aktif = tompil.find('.btn-primary');
        aktif.toggleClass('btn-secondary');
        aktif.toggleClass('btn-primary');
        $('.t_irbansus').toggleClass('btn-secondary');
        $('.t_irbansus').toggleClass('btn-primary');
        
        $('.irbansus').toggle('slow');
        
        $('.sekretariat').hide();
        $('.irban1').hide();
        $('.irban2').hide();
        $('.irban3').hide();
        $('.irban4').hide();
    })

    $('.t_irban1').on('click', function(){
        var tompil = $('#tompil');
        var aktif = tompil.find('.btn-primary');
        aktif.toggleClass('btn-secondary');
        aktif.toggleClass('btn-primary');
        $('.t_irban1').toggleClass('btn-secondary');
        $('.t_irban1').toggleClass('btn-primary');
        
        $('.irban1').toggle('slow');
        
        $('.irbansus').hide();
        $('.sekretariat').hide();
        $('.irban2').hide();
        $('.irban3').hide();
        $('.irban4').hide();
    })

    $('.t_irban2').on('click', function(){
        var tompil = $('#tompil');
        var aktif = tompil.find('.btn-primary');
        aktif.toggleClass('btn-secondary');
        aktif.toggleClass('btn-primary');
        $('.t_irban2').toggleClass('btn-secondary');
        $('.t_irban2').toggleClass('btn-primary');
        
        $('.irban2').toggle('slow');
        
        $('.irbansus').hide();
        $('.sekretariat').hide();
        $('.irban1').hide();
        $('.irban3').hide();
        $('.irban4').hide();
    })

    $('.t_irban3').on('click', function(){
        var tompil = $('#tompil');
        var aktif = tompil.find('.btn-primary');
        aktif.toggleClass('btn-secondary');
        aktif.toggleClass('btn-primary');
        $('.t_irban3').toggleClass('btn-secondary');
        $('.t_irban3').toggleClass('btn-primary');
        
        $('.irban3').toggle('slow');
        
        $('.irbansus').hide();
        $('.sekretariat').hide();
        $('.irban1').hide();
        $('.irban2').hide();
        $('.irban4').hide();
    })

    $('.t_irban4').on('click', function(){
        var tompil = $('#tompil');
        var aktif = tompil.find('.btn-primary');
        aktif.toggleClass('btn-secondary');
        aktif.toggleClass('btn-primary');
        $('.t_irban4').toggleClass('btn-secondary');
        $('.t_irban4').toggleClass('btn-primary');
        
        $('.irban4').toggle('slow');
        
        $('.irbansus').hide();
        $('.sekretariat').hide();
        $('.irban1').hide();
        $('.irban2').hide();
        $('.irban3').hide();
    })
</script>

@endpush