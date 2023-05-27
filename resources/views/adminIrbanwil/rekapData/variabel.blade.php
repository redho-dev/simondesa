@extends('templates.adminIrbanwil.main')

@section('content')

<h4 class="text-dark">Sistem Informasi Monitoring dan Evaluasi Desa (Simondes)</h4>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <h5>A. Bentuk Pengawasan </h5>
                        <table class="table">
                            <tr>
                                <td>
                                    1.
                                </td>
                                <td colspan="4">
                                    Evaluasi Penyelenggaraan Pemerintahan Desa
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    Maksud
                                </td>
                                <td>:</td>
                                <td>
                                    dilaksanakan sebagai bentuk pengawasan APIP Daerah terhadap tata kelola
                                    pemerintahan desa untuk memastikan ketaatan terhadap norma, standar, prosedur
                                    dan kriteria sesuai regulasi yang berlaku, mengidentifikasi faktor pendukung dan
                                    faktor penghambat serta menilai sejauhmana peran Perangkat Daerah Kabupaten
                                    dalam melaksanakan pembinaan dan pengawasan terhadap pemerintahan desa.
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    Tujuan
                                </td>
                                <td>:</td>
                                <td>
                                    - menilai ketaatan penyelenggaraan pemerintahan terhadap ketentuan yang
                                    berlaku <br>
                                    - memberikan catatan dan saran perbaikan kedepan <br>
                                    - meningkatkan akuntabilitas penyelenggaraan pemerintahan desa

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    2.
                                </td>
                                <td colspan="4">
                                    Monitoring / Evaluasi / Pemeriksaan Pengelolaan Keuangan Desa
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    Maksud
                                </td>
                                <td>:</td>
                                <td>
                                    dilaksanakan sebagai bentuk pengawasan APIP Daerah terhadap pengelolaan keuangan
                                    desa secara menyeluruh, dalam rangka menjamin akuntabilitas pengelolaan keuangan
                                    desa dan sebagai upaya pencegahan dini (early warning) terhadap kecurangan (fraud)
                                    terhadap keuangan desa.
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    Tujuan
                                </td>
                                <td>:</td>
                                <td>
                                    - menilai ketaatan pengelolaan keuangan desa terhadap ketentuan yang
                                    berlaku <br>
                                    - menyampaikan temuan dan rekomendasi tindak lanjut <br>
                                    - meningkatkan akuntabilitas pengelolaan keuangan desa

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    3.
                                </td>
                                <td colspan="4">
                                    Evaluasi Efektifitas Pengelolaan Badan Usaha Milik Desa ( BUM Desa )
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    Maksud
                                </td>
                                <td>:</td>
                                <td>
                                    dilaksanakan sebagai bentuk pengawasan APIP Daerah terhadap pengelolaan BUM Desa,
                                    untuk memastikan tata kelola BUM Desa telah dilaksanakan secara tertib, transparan
                                    dan akuntabel dan memastikan efektifitas BUM Desa dalam memberikan pelayanan publik
                                    atau meningkatkan pendapatan asli desa.
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    Tujuan
                                </td>
                                <td>:</td>
                                <td>
                                    - menilai ketaatan pengelolaan BUM Desa terhadap ketentuan yang
                                    berlaku <br>
                                    - menyampaikan temuan dan rekomendasi tindak lanjut <br>
                                    - meningkatkan akuntabilitas pengelolaan BUM Desa

                                </td>
                            </tr>

                        </table>

                        <h5>B. Aspek, Variabel, Indikator, Sub Indikator, dan Bobot</h5>
                        <p class="pl-4 text-dark mt-2">
                            Dalam pelaksanaan penilaian akuntabilitas melalui Simondes, aspek akuntabilitas yang akan
                            dinilai terbagi dua yaitu aspek penyelenggaraan pemerintahan dan keuangan desa, dan aspek
                            pengelolaan BUM Desa. Hal ini dilakukan mengingat bahwa sesuai regulasi yang ada kedua aspek
                            tersebut dilaksanakan oleh dua entitas yang berbeda baik dari sisi kelembagaan maupun
                            keuangannya.
                        </p>
                        <p class="pl-4 text-dark">I. Aspek Penyelenggaraan Pemerintahan dan Keuangan Desa</p>
                        <div class="row">
                            <div class="col-md-9">
                                <table class="table table-bordered table-stripped ml-4" width="75%">
                                    <thead style="background-color: darkkhaki">
                                        <tr>
                                            <th>#</th>
                                            <th>Variabel</th>
                                            <th class="text-center">Bobot</th>
                                            <th>Indikator</th>
                                            <th class="text-center">Bobot</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($aspeks as $asp)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $asp->aspek }}</td>
                                            <td class="text-center">{{ $asp->bobot }}</td>
                                            <td>
                                                <ol>
                                                    @foreach($asp->indikator as $ind)
                                                    <li>
                                                        {{ $ind->indikator }}
                                                    </li>
                                                    @endforeach
                                                </ol>
                                            </td>
                                            <td class="text-center">
                                                <ul style="list-style-type:none;" class="p-0">
                                                    @foreach($asp->indikator as $ind)
                                                    <li>
                                                        {{ $ind->bobot }}
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <table class="table table-bordered table-stripped ml-4" width="75%">
                                    <thead style="background-color: darkkhaki">
                                        <tr>
                                            <th>#</th>
                                            <th>Indikator</th>
                                            <th class="text-center">Bobot</th>
                                            <th>Sub Indikator</th>
                                            <th class="text-center">Bobot</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($indikators as $ind)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $ind->indikator }}</td>
                                            <td class="text-center">{{ $ind->bobot }}</td>
                                            <td>
                                                @if($ind->aspek_id == 1)
                                                <ol type="a">
                                                    @foreach($ind->sub_indikator_pemerintahan as $subp)
                                                    <li>{{ $subp->sub_indikator }}</li>
                                                    @endforeach
                                                </ol>
                                                @endif
                                                @if($ind->aspek_id == 2)
                                                <ol type="a">
                                                    @foreach($ind->sub_indikator_keuangan as $subk)
                                                    <li>{{ $subk->sub_indikator }}</li>
                                                    @endforeach
                                                </ol>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($ind->aspek_id == 1)
                                                <ul style="list-style-type:none;" class="p-0">
                                                    @foreach($ind->sub_indikator_pemerintahan as $subp)
                                                    <li>{{ $subp->bobot }}</li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                                @if($ind->aspek_id == 2)
                                                <ul style="list-style-type:none;" class="p-0">
                                                    @foreach($ind->sub_indikator_keuangan as $subk)
                                                    <li>{{ $subk->bobot }}</li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <p class="pl-4 text-dark">II. Aspek Pengelolaan BUM Desa</p>
                                <table class="table table-bordered table-stripped ml-4" width="75%">
                                    <thead style="background-color: rgb(141, 169, 250)">
                                        <tr>
                                            <th>#</th>
                                            <th>Indikator</th>
                                            <th class="text-center">Bobot</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($indBumdes as $bum)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $bum->indikator }}</td>
                                            <td class="text-center">{{ $bum->bobot }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>

<script>
    //     $(document).ready(function () {
//     $('#datatable').DataTable({
//         order: [[4, 'desc']],
//     });
// });
</script>



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


@endpush