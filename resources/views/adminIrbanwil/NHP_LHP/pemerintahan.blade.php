<table class="table table-bordered">
    <tr class="bg-secondary">
        <td width="3%">I.</td>
        <td width="97%" colspan="2">
            EVALUASI ATAS PENYELENGGARAAN PEMERINTAHAN DESA
        </td>
    </tr>
    <tr id="datum" class="bg-info">
        <td></td>
        <td width="3%">1.1</td>
        <td>Kelengkapan dan Keterbaruan Data Umum / Monografi &emsp;<button class="fa fa-angle-double-down"></button>
        </td>
    </tr>
    <tr id="nhp_datum" style="display: none">
        <td></td>
        <td width="3%"></td>
        <td>
            Dalam rangka mewujudkan penyelenggaraan Pemerintahan Desa yang efektif dan
            efisien perlu penyajian data administrasi pemerintahan desa secara menyeluruh,
            terpadu, akurat dan dapat dipertanggungjawabkan kebenarannya yang disusun dalam monografi desa, hal ini
            sebagaimana diamanatkan dalam Peraturan Menteri Dalam Negeri Nomor 13 Tahun 2012 tentang Monografi Desa dan
            Kelurahan. <br>
            Adapun hasil evaluasi atas kelengkapan dan keterbaruan data umum /monografi desa sebagai berikut : <br>
            <div class="row">
                <div class="col-md-8">
                    <form action="/adminIrbanwil/nilaiPemdesEdit" method="post">
                        @csrf
                        <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                        <input type="hidden" name="tahun" value="{{ $tahun }}">
                        <input type="hidden" name="aspek_id" value=1>
                        <input type="hidden" name="indikator_id" value=1>
                        <input type="hidden" name="table" value="nhp_datum">


                        <table class="table table-bordered mt-2" width="80%">
                            <thead>
                                <tr class="bg-info">
                                    <th width="5%" style="vertical-align: middle">No</th>
                                    <th width="50%" style="vertical-align: middle">Sub Indikator</th>
                                    <th width="10%" class="text-center">Ketersediaan Data</th>
                                    <th width="15%" class="text-center" style="vertical-align: middle">Nilai</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr class="{{ $datnil->where('sub_indikator_pemerintahan_id',
                                1)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                                    <td>1</td>
                                    <td>Data Umum Wilayah dan Kependudukan
                                    </td>
                                    <td class="text-center">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                                        1)->pluck('persen_data')->first()) ?? 0}}</td>
                                    <td>
                                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=1>
                                        <input type="number" class="form-control text-center nilai"
                                            style="font-size: .85rem" name="nilai[]" autofocus required value="{{ $datnil->where('sub_indikator_pemerintahan_id',
                                        1)->pluck('nilai_sementara')->first() ?? 0}}">
                                    </td>

                                </tr>
                                <tr class="{{ $datnil->where('sub_indikator_pemerintahan_id',
                                2)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                                    <td>2</td>
                                    <td>Data Sarana dan Prasarana</td>
                                    <td class="text-center">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                                        2)->pluck('persen_data')->first()) ?? 0 }}</td>
                                    <td>
                                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=2>
                                        <input type="number" class="form-control text-center nilai" name="nilai[]"
                                            required value="{{ $datnil->where('sub_indikator_pemerintahan_id',
                                    2)->pluck('nilai_sementara')->first() ?? 0 }}" style="font-size: .85rem">
                                    </td>

                                </tr>
                                <tr class="{{ $datnil->where('sub_indikator_pemerintahan_id',
                                3)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                                    <td>3</td>
                                    <td>Data Kelembagaan</td>
                                    <td class="text-center">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                                        3)->pluck('persen_data')->first()) ?? 0 }}</td>
                                    <td>
                                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=3>
                                        <input type="number" class="form-control text-center nilai" name="nilai[]"
                                            required value="{{ $datnil->where('sub_indikator_pemerintahan_id',
                                    3)->pluck('nilai_sementara')->first() ?? 0}}" style="font-size: .85rem">
                                    </td>

                                </tr>
                                <tr class="{{ $datnil->where('sub_indikator_pemerintahan_id',
                                4)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                                    <td>4</td>
                                    <td>Papan Monografi</td>
                                    <td class="text-center">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                                        4)->pluck('persen_data')->first()) ?? 0 }}</td>
                                    <td>
                                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=4>
                                        <input type="number" class="form-control text-center nilai" name="nilai[]"
                                            required value="{{ $datnil->where('sub_indikator_pemerintahan_id',
                                    4)->pluck('nilai_sementara')->first() ?? 0}}" style="font-size: .85rem">
                                    </td>

                                </tr>
                                <tr class="{{ $datnil->where('sub_indikator_pemerintahan_id',
                                5)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                                    <td>5</td>
                                    <td>Data Perangkat, BPD dan RT</td>
                                    <td class="text-center">{{ round($datnil->where('sub_indikator_pemerintahan_id',
                                        5)->pluck('persen_data')->first()) ?? 0 }}</td>
                                    <td>
                                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=5>
                                        <input type="number" class="form-control text-center nilai" name="nilai[]"
                                            required value="{{ $datnil->where('sub_indikator_pemerintahan_id',
                                    5)->pluck('nilai_sementara')->first() ?? 0}}" style="font-size: .85rem">
                                    </td>

                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="text-muted"><i>Petunjuk Penilaian : 0 jika data kosong, 100
                                            jika
                                            data
                                            lengkap
                                            dan
                                            update</i>
                                    </td>
                                </tr>
                                @if($rekap_1)
                                <tr>
                                    <td colspan="6" style="background-color: beige">
                                        <?php 
                                     $nil = $rekap_1->nilai;
                                        if($nil >= 0 && $nil <=30){
                                            $kesimpulan = "TIDAK MEMADAI";
                                        }elseif($nil > 30 && $nil <=55){
                                            $kesimpulan = "KURANG MEMADAI";
                                        }elseif($nil > 55 && $nil <=75){
                                            $kesimpulan = "CUKUP MEMADAI";
                                        }elseif($nil > 75 && $nil <=90){
                                            $kesimpulan = "MEMADAI";
                                        }elseif($nil > 90 && $nil <=100){
                                            $kesimpulan = "SANGAT MEMADAI";
                                        }          
                                    ?>
                                        <p>KESIMPULAN : </p>
                                        <p>SECARA UMUM KELENGKAPAN DAN KETERBARUAN DATA UMUM/MONOGRAFI TAHUN {{ $tahun
                                            }} <span class="text-primary">-- {{ $kesimpulan }} --</span> , DENGAN
                                            URAIAN/CATATAN
                                            SEBAGAI BERIKUT :</p>
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td colspan="6" class="bg-info">
                                        <div class="form-group ">
                                            <label for="kesimpulan">Catatan : </label>
                                            <input type="hidden" name="catatan_sementara" id="kesimpulan" autofocus>
                                            <trix-editor input="kesimpulan" class="bg-white text-dark">{!!
                                                $catatan_1->catatan_sementara
                                                ?? '' !!}
                                            </trix-editor>

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="bg-info">
                                        <div class="form-group">
                                            <label for="saran">Saran/Rekomendasi</label>
                                            <input type="hidden" name="rekom_sementara" id="saran">
                                            <trix-editor input="saran" class="bg-white text-dark">{!!
                                                $catatan_1->rekom_sementara ??
                                                ''
                                                !!}
                                            </trix-editor>

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-right">
                                        <button type="submit" class="btn btn-primary">Update Nilai</button>
                                    </td>
                                </tr>
                            </tfoot>


                        </table>
                    </form>
                </div>
            </div>

        </td>
    </tr>
    <tr id="kewilayahan" class="bg-info">
        <td></td>
        <td width="3%">1.2</td>
        <td>Kewilayahan &emsp;<button class="fa fa-angle-double-down"></button>
        </td>
    </tr>
    <tr id="nhp_kewilayahan" style="display: none">
        <td></td>
        <td width="3%"></td>
        <td>
            Desa sebagai entitas pemerintahan terkecil wajib mendorong terciptanya tertib administrasi kewilayahan,
            memberikan kejelasan dan kepastian hukum terhadap batas wilayah suatu desa yang memenuhi aspek teknis dan
            yuridis. Selain itu dalam rangka pelaksanaan kebijakan satu peta nasional, maka
            Pemerintah menekankan bahwa penyusunan peta batas harus mengikuti kaidah-kaidah kartometrik yaitu kaidah
            dalam menyusun peta. Beberapa regulasi terkait dengan penataan kewilayahan desa, antara lain :
            <ul>
                <li>
                    Permendagri Nomor 45 Tahun 2016 tentang Pedoman Penetapan dan Penegasan Batas Desa
                </li>
                <li>
                    Perka
                    BIG Nomor 3 tahun 2016 tentang Spesifikasi Teknis Penyajian Peta Desa
                </li>
                <li>
                    Peraturan BIG Nomor 15 tahun 2019 tentang Metode
                    Kartometrik pada
                    Penetapan dan Penegasan
                    Batas Desa/Kelurahan
                </li>
            </ul>
            Adapun hasil evaluasi terhadap penataan kewilayahan desa sebagai berikut :
            <div class="row">
                <div class="col-md-8">
                    <form action="/adminIrbanwil/nilaiAkunwilEdit" method="post">
                        @csrf
                        <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                        <input type="hidden" name="tahun" value="{{ $tahun }}">
                        <input type="hidden" name="aspek_id" value=1>
                        <input type="hidden" name="indikator_id" value=2>
                        <input type="hidden" name="table" value="nhp_kewilayahan">


                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-info">
                                    <th width="5%" style="vertical-align: middle">No</th>
                                    <th width="50%" style="vertical-align: middle">Sub Indikator</th>
                                    <th width="10%" class="text-center">Keterisian<br>Data (%)</th>
                                    <th width="15%" class="text-center" style="vertical-align: middle">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="{{ $datnil2->where('sub_indikator_pemerintahan_id',
                                    6)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                                    <td style="vertical-align: middle">1</td>
                                    <td style="vertical-align: middle">Dokumen Dasar Hukum Pembentukan Desa
                                    </td>
                                    <td class="text-center " style="vertical-align: middle">{{
                                        $datnil2->where('sub_indikator_pemerintahan_id',
                                        6)->pluck('persen_data')->first() ?? 0}}
                                    </td>
                                    <td>
                                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=6>
                                        <input type="number" class="form-control text-center" style="font-size: .85rem"
                                            name="nilai[]" autofocus required value="{{ $datnil2->where('sub_indikator_pemerintahan_id',
                                            6)->pluck('nilai_sementara')->first() ?? 0}}">
                                    </td>

                                </tr>
                                <tr class="{{ $datnil2->where('sub_indikator_pemerintahan_id',
                                    7)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                                    <td style="vertical-align: middle">2</td>
                                    <td style="vertical-align: middle">Pilar Batas Utara
                                    </td>
                                    <td class="text-center " style="vertical-align: middle">{{
                                        $datnil2->where('sub_indikator_pemerintahan_id',
                                        7)->pluck('persen_data')->first() ?? 0}}
                                    </td>
                                    <td>
                                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=7>
                                        <input type="number" class="form-control text-center" style="font-size: .85rem"
                                            name="nilai[]" autofocus required value="{{ $datnil2->where('sub_indikator_pemerintahan_id',
                                            7)->pluck('nilai_sementara')->first() ?? 0}}">
                                    </td>

                                </tr>
                                <tr class="{{ $datnil2->where('sub_indikator_pemerintahan_id',
                                    8)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                                    <td style="vertical-align: middle">3</td>
                                    <td style="vertical-align: middle">Pilar Batas Selatan
                                    </td>
                                    <td class="text-center " style="vertical-align: middle">{{
                                        $datnil2->where('sub_indikator_pemerintahan_id',
                                        8)->pluck('persen_data')->first() ?? 0}}
                                    </td>
                                    <td>
                                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=8>
                                        <input type="number" class="form-control text-center" style="font-size: .85rem"
                                            name="nilai[]" autofocus required value="{{ $datnil2->where('sub_indikator_pemerintahan_id',
                                            8)->pluck('nilai_sementara')->first() ?? 0}}">
                                    </td>

                                </tr>
                                <tr class="{{ $datnil2->where('sub_indikator_pemerintahan_id',
                                    9)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                                    <td style="vertical-align: middle">4</td>
                                    <td style="vertical-align: middle">Pilar Batas Barat
                                    </td>
                                    <td class="text-center " style="vertical-align: middle">{{
                                        $datnil2->where('sub_indikator_pemerintahan_id',
                                        9)->pluck('persen_data')->first() ?? 0}}
                                    </td>
                                    <td>
                                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=9>
                                        <input type="number" class="form-control text-center" style="font-size: .85rem"
                                            name="nilai[]" autofocus required value="{{ $datnil2->where('sub_indikator_pemerintahan_id',
                                            9)->pluck('nilai_sementara')->first() ?? 0}}">
                                    </td>

                                </tr>
                                <tr class="{{ $datnil2->where('sub_indikator_pemerintahan_id',
                                    10)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                                    <td style="vertical-align: middle">5</td>
                                    <td style="vertical-align: middle">Pilar Batas Timur
                                    </td>
                                    <td class="text-center " style="vertical-align: middle">{{
                                        $datnil2->where('sub_indikator_pemerintahan_id',
                                        10)->pluck('persen_data')->first() ?? 0}}
                                    </td>
                                    <td>
                                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=10>
                                        <input type="number" class="form-control text-center" style="font-size: .85rem"
                                            name="nilai[]" autofocus required value="{{ $datnil2->where('sub_indikator_pemerintahan_id',
                                            10)->pluck('nilai_sementara')->first() ?? 0}}">
                                    </td>

                                </tr>
                                <tr class="{{ $datnil2->where('sub_indikator_pemerintahan_id',
                                    11)->pluck('perbaikan')->first() ? 'text-danger' : '' }}">
                                    <td style="vertical-align: middle">6</td>
                                    <td style="vertical-align: middle">Peta Batas Desa
                                    </td>
                                    <td class="text-center " style="vertical-align: middle">{{
                                        $datnil2->where('sub_indikator_pemerintahan_id',
                                        11)->pluck('persen_data')->first() ?? 0}}
                                    </td>
                                    <td>
                                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value=11>
                                        <input type="number" class="form-control text-center" style="font-size: .85rem"
                                            name="nilai[]" autofocus required value="{{ $datnil2->where('sub_indikator_pemerintahan_id',
                                            11)->pluck('nilai_sementara')->first() ?? 0}}">
                                    </td>

                                </tr>


                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="text-muted"><i>Petunjuk Penilaian : 0 jika data kosong, 100
                                            jika data
                                            valid dan memenuhi standar/ketentuan</i>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="background-color: beige">
                                        <?php 
                                        $nil = $rekap_2->nilai;
                                        if($nil >= 0 && $nil <=30){
                                            $kesimpulan = "TIDAK MEMADAI";
                                        }elseif($nil >= 31 && $nil <=55){
                                            $kesimpulan = "KURANG MEMADAI";
                                        }elseif($nil >= 36 && $nil <=75){
                                            $kesimpulan = "CUKUP MEMADAI";
                                        }elseif($nil >= 76 && $nil <=90){
                                            $kesimpulan = "MEMADAI";
                                        }elseif($nil >= 91 && $nil <=100){
                                            $kesimpulan = "SANGAT MEMADAI";
                                        }      
                                        ?>
                                        <p>KESIMPULAN : </p>
                                        <p>SECARA UMUM PENATAAN KEWILAYAHAN TAHUN {{ $tahun
                                            }} <span class="text-primary">-- {{ $kesimpulan }} --</span> , DENGAN
                                            URAIAN/CATATAN
                                            SEBAGAI BERIKUT :</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="bg-secondary">
                                        <div class="form-group">
                                            <label for="kesimpulan_2">Catatan :</label>
                                            <input type="hidden" name="catatan_sementara" id="kesimpulan_2" autofocus>
                                            <trix-editor input="kesimpulan_2" class="bg-white text-dark">
                                                {!! $catatan_2->catatan_sementara ?? '' !!}
                                            </trix-editor>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="bg-secondary">
                                        <div class="form-group">
                                            <label for="saran_2">Saran :</label>
                                            <input type="hidden" name="rekom_sementara" id="saran_2">
                                            <trix-editor input="saran_2" class="bg-white text-dark">{!!
                                                $catatan_2->rekom_sementara ??
                                                ''
                                                !!}
                                            </trix-editor>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-right">
                                        <button type="submit" class="btn btn-primary">Update Nilai</button>
                                    </td>
                                </tr>
                            </tfoot>

                        </table>
                    </form>
                </div>
            </div>

        </td>
    </tr>
    <tr id="kelembagaan" class="bg-info">
        <td></td>
        <td width="3%">1.3</td>
        <td>Kelembagaan &emsp;<button class="fa fa-angle-double-down"></button>
        </td>
    </tr>
    <tr id="nhp_kelembagaan" style="display: none">
        <td></td>
        <td width="3%"></td>
        <td>
            Penyelenggaraan Pemerintahan Desa dilaksanakan oleh pemerintah desa, yaitu kepala desa dengan dibantu
            perangkat desa. Perangkat Desa terdiri dari sekretaris desa, perangkat teknis desa (kasi/kaur), dan
            perangkat kewilayahan desa (kepala dusun). pelaksanaan pemerintahan desa tidak akan berjalan efektif tanpa
            dukungan dari elemen masyarakat terutama lembaga-lembaga kemasyarakatan di desa. Untuk itu pemerintah desa
            perlu melakukan penataan kelembagaan, baik dilingkup aparatur desa maupun penataan lembaga kemasyarakatan,
            sebagaimana amanat Permendagri Nomor 18 tahun 2018 tentang Lembaga Kemasyarakatan Desa dan Lembaga Adat
            Desa. <br>
            Adapun hasil evaluasi terhadap penataan kelembagaan desa, sebagai berikut :

            <div class="row">
                <div class="col-md-8">
                    <form action="/adminIrbanwil/nilaiAkunkelEdit" method="post">
                        @csrf
                        <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                        <input type="hidden" name="tahun" value="{{ $tahun }}">
                        <input type="hidden" name="aspek_id" value=1>
                        <input type="hidden" name="indikator_id" value=3>
                        <input type="hidden" name="table" value="nhp_kelembagaan">

                        <style>
                            tbody>tr>td {
                                line-height: 2rem;
                                vertical-align: middle;
                            }
                        </style>
                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-info">
                                    <th width="5%" style="vertical-align: middle">No</th>
                                    <th width="55%" style="vertical-align: middle">Sub Indikator</th>
                                    <th width="10%" class="text-center">Keterisian<br>Data (%)</th>
                                    <th width="15%" class="text-center" style="vertical-align: middle">Nilai</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 12 ?>
                                @foreach($datnil3 as $dakel)
                                <tr class="{{ $dakel->perbaikan ? 'text-danger' : '' }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $dakel->sub_indikator_pemerintahan->sub_indikator }}
                                    </td>

                                    <td class="text-center" style="vertical-align: middle">
                                        {{
                                        $dakel->persen_data ?? 0 }}
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value={{ $i }}>
                                        <input type="number" class="form-control text-center " style="font-size: .85rem"
                                            name="nilai[]" autofocus required
                                            value="{{ $dakel->nilai_sementara ?? 0  }}">
                                    </td>

                                </tr>
                                <?php $i++; ?>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="text-muted"><i>Petunjuk Penilaian : 0 jika data kosong, 100
                                            jika data
                                            sah dan masih berlaku</i>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="background-color: beige">
                                        <?php 
                                         $nil = $rekap_3->nilai;
                                            if($nil >= 0 && $nil <=30){
                                                $kesimpulan = "TIDAK MEMADAI";
                                            }elseif($nil > 30 && $nil <=55){
                                                $kesimpulan = "KURANG MEMADAI";
                                            }elseif($nil > 55 && $nil <=75){
                                                $kesimpulan = "CUKUP MEMADAI";
                                            }elseif($nil > 75 && $nil <=90){
                                                $kesimpulan = "MEMADAI";
                                            }elseif($nil > 90 && $nil <=100){
                                                $kesimpulan = "SANGAT MEMADAI";
                                            }          
                                        ?>
                                        <p>KESIMPULAN : </p>
                                        <p>SECARA UMUM PENATAAN KELEMBAGAAN TAHUN {{ $tahun
                                            }} <span class="text-primary">-- {{ $kesimpulan }} --</span> , DENGAN
                                            URAIAN/CATATAN
                                            SEBAGAI BERIKUT :</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="bg-info">
                                        <div class="form-group">
                                            <label for="kesimpulan_3">Catatan :</label>
                                            <input type="hidden" name="catatan_sementara" id="kesimpulan_3" autofocus>
                                            <trix-editor input="kesimpulan_3" class="bg-white text-dark">{!!
                                                $catatan_3->catatan_sementara
                                                !!}
                                            </trix-editor>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="bg-info">
                                        <div class="form-group">
                                            <label for="saran_3">Saran / Rekomendasi</label>
                                            <input type="hidden" name="rekom_sementara" id="saran_3">
                                            <trix-editor input="saran_3" class="bg-white text-dark">{!!
                                                $catatan_3->rekom_sementara !!}
                                            </trix-editor>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-right">
                                        <button type="submit" class="btn btn-primary">UPDATE</button>
                                    </td>
                                </tr>
                            </tfoot>

                        </table>
                    </form>
                </div>
            </div>

        </td>
    </tr>
    <tr id="perencanaan" class="bg-info">
        <td></td>
        <td width="3%">1.4</td>
        <td>Dokumen Perencanaan Desa &emsp;<button class="fa fa-angle-double-down"></button>
        </td>
    </tr>
    <tr id="nhp_perencanaan" style="display: none">
        <td></td>
        <td width="3%"></td>
        <td>
            Perencanaan pembangunan desa adalah proses tahapan kegiatan yang diselenggarakan oleh pemerintah Desa dengan
            melibatkan BPD dan unsur masyarakat secara partisipatif guna pemanfaatan dan pengalokasian sumber daya desa
            dalam rangka mencapai tujuan pembangunan desa.<br>Regulasi terkait perencanaan desa antara lain :
            <ul>
                <li>
                    Peraturan Menteri Dalam Negeri Nomor 114 Tahun 2014 tentang Pedoman Pembangunan Desa
                </li>
                <li>
                    Peraturan Menteri Dalam Negeri Nomor 20 Tahun 2018 tentang Pengelolaan Keuangan Desa
                </li>
                <li>
                    Peraturan Menteri Desa, Pembangunan Daerah Tertinggal, dan Transmigrasi Nomor 21 Tahun 2020 tentang
                    Pedoman Umum Pembangunan dan Pemberdayaan Masyarakat Desa
                </li>
            </ul>
            Adapun hasil evaluasi terhadap dokumen perencanaan desa, sebagai berikut :

            <div class="row">
                <div class="col-md-8">
                    <form action="/adminIrbanwil/nilaiAkundokEdit" method="post">
                        @csrf
                        <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                        <input type="hidden" name="tahun" value="{{ $tahun }}">
                        <input type="hidden" name="aspek_id" value=1>
                        <input type="hidden" name="indikator_id" value=4>
                        <input type="hidden" name="table" value="nhp_perencanaan">

                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-info">
                                    <th width="5%" style="vertical-align: middle">No</th>
                                    <th width="55%" style="vertical-align: middle">Sub Indikator</th>
                                    <th width="10%" class="text-center">Keterisian<br>Data (%)</th>
                                    <th width="15%" class="text-center" style="vertical-align: middle">Nilai</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 12 ?>
                                @foreach($datnil4 as $dakel)
                                <tr class="{{ $dakel->perbaikan ? 'text-danger' : '' }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $dakel->sub_indikator_pemerintahan->sub_indikator }}
                                    </td>

                                    <td class="text-center" style="vertical-align: middle">
                                        {{
                                        $dakel->persen_data ?? 0 }}
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value={{ $i }}>
                                        <input type="number" class="form-control text-center " style="font-size: .85rem"
                                            name="nilai[]" autofocus required
                                            value="{{ $dakel->nilai_sementara ?? 0  }}">
                                    </td>

                                </tr>
                                <?php $i++; ?>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="text-muted"><i>Petunjuk Penilaian : 0 jika data kosong, 100
                                            jika data
                                            lengkap, sah dan sesuai dengan ketentuan</i>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="background-color: beige">
                                        <?php 
                                             $nil = $rekap_4->nilai;
                                                if($nil >= 0 && $nil <=30){
                                                    $kesimpulan = "TIDAK MEMADAI";
                                                }elseif($nil > 30 && $nil <=55){
                                                    $kesimpulan = "KURANG MEMADAI";
                                                }elseif($nil > 55 && $nil <=75){
                                                    $kesimpulan = "CUKUP MEMADAI";
                                                }elseif($nil > 75 && $nil <=90){
                                                    $kesimpulan = "MEMADAI";
                                                }elseif($nil > 90 && $nil <=100){
                                                    $kesimpulan = "SANGAT MEMADAI";
                                                }          
                                            ?>
                                        <p>KESIMPULAN : </p>
                                        <p>SECARA UMUM KELENGKAPAN DAN KESESUAIAN DOKUMEN PERENCANAAN TAHUN {{ $tahun
                                            }} <span class="text-primary">-- {{ $kesimpulan }} --</span> , DENGAN
                                            URAIAN/CATATAN
                                            SEBAGAI BERIKUT :</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="bg-info">
                                        <div class="form-group">
                                            <label for="kesimpulan_4">Catatan :</label>
                                            <input type="hidden" name="catatan_sementara" id="kesimpulan_4" autofocus>
                                            <trix-editor input="kesimpulan_4" class="bg-white text-dark">{!!
                                                $catatan_4->catatan_sementara
                                                !!}
                                            </trix-editor>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="bg-info">
                                        <div class="form-group">
                                            <label for="saran_4">Saran : </label>
                                            <input type="hidden" name="rekom_sementara" id="saran_4">
                                            <trix-editor input="saran_4" class="bg-white text-dark">{!!
                                                $catatan_4->rekom_sementara !!}
                                            </trix-editor>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-right">
                                        <button type="submit" class="btn btn-primary">UPDATE</button>
                                    </td>
                                </tr>
                            </tfoot>

                        </table>
                    </form>
                </div>
            </div>

        </td>
    </tr>
    <tr id="adum" class="bg-info">
        <td></td>
        <td width="3%">1.5</td>
        <td>Administrasi Umum Desa &emsp;<button class="fa fa-angle-double-down"></button>
        </td>
    </tr>
    <tr id="nhp_adum" style="display: none ">
        <td></td>
        <td width="3%"></td>
        <td>
            Pemerintah Desa wajib melaksanakan tertib administrasi dalam pelaksanaan tugas dan fungsinya. Administrasi
            Umum adalah salah satu bentuk dari administrasi pemerintahan. Berdasarkan Peraturan Menteri Dalam Negeri
            Nomor 47 tahun 2016 tentang Administrasi Pemerintahan Desa, administrasi pemerintahan desa terdiri dari
            :<br>
            <ol type='a' class="mb-0">
                <li>
                    Administrasi Umum;
                </li>
                <li>
                    Administrasi Penduduk;
                </li>
                <li>
                    Administrasi Keuangan;
                </li>
                <li>
                    Administrasi Pembangunan; dan
                </li>
                <li>
                    Administrasi Lainnya.
                </li>
            </ol>
            Adapun evaluasi administrasi umum pada tahun ini hanya difokuskan kepada beberapa dokumen adminstrasi saja,
            dengan hasil evaluasi sebagai berikut :

            <div class="row">
                <div class="col-md-8">
                    <form action="/adminIrbanwil/nilaiAkunadumEdit" method="post">
                        @csrf
                        <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                        <input type="hidden" name="tahun" value="{{ $tahun }}">
                        <input type="hidden" name="aspek_id" value=1>
                        <input type="hidden" name="indikator_id" value=5>
                        <input type="hidden" name="table" value="nhp_adum">


                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-info">
                                    <th width="5%" style="vertical-align: middle">No</th>
                                    <th width="55%" style="vertical-align: middle">Sub Indikator</th>
                                    <th width="10%" class="text-center">Keterisian<br>Data (%)</th>
                                    <th width="15%" class="text-center" style="vertical-align: middle">Nilai</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 34 ?>
                                @foreach($datnil5 as $dadum)
                                <tr class="{{ $dadum->perbaikan ? 'text-danger' : '' }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $dadum->sub_indikator_pemerintahan->sub_indikator }}
                                    </td>

                                    <td class="text-center" style="vertical-align: middle">
                                        {{
                                        $dadum->persen_data ?? 0 }}
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value={{ $i }}>
                                        <input type="number" class="form-control text-center " style="font-size: .85rem"
                                            name="nilai[]" autofocus required
                                            value="{{ $dadum->nilai_sementara ?? 0  }}">
                                    </td>

                                </tr>
                                <?php $i++; ?>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="text-muted"><i>Petunjuk Penilaian : 0 jika data kosong, 100
                                            jika data
                                            lengkap, sah dan sesuai dengan ketentuan</i>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="background-color: beige">
                                        <?php 
                                            $nil = $rekap_5->nilai;
                                            if($nil >= 0 && $nil <=30){
                                                $kesimpulan = "TIDAK MEMADAI";
                                            }elseif($nil > 30 && $nil <=55){
                                                $kesimpulan = "KURANG MEMADAI";
                                            }elseif($nil > 55 && $nil <=75){
                                                $kesimpulan = "CUKUP MEMADAI";
                                            }elseif($nil > 75 && $nil <=90){
                                                $kesimpulan = "MEMADAI";
                                            }elseif($nil > 90 && $nil <=100){
                                                $kesimpulan = "SANGAT MEMADAI";
                                            }     
                                        ?>
                                        <p>KESIMPULAN : </p>
                                        <p>SECARA UMUM KELENGKAPAN DOKUMEN ADMINISTRASI UMUM TAHUN {{ $tahun
                                            }} <span class="text-primary">-- {{ $kesimpulan }} --</span> , DENGAN
                                            URAIAN/CATATAN
                                            SEBAGAI BERIKUT :</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="bg-info">
                                        <div class="form-group">
                                            <label for="kesimpulan_5">Catatan :</label>
                                            <input type="hidden" name="catatan_sementara" id="kesimpulan_5" autofocus>
                                            <trix-editor input="kesimpulan_5" class="bg-white text-dark">{!!
                                                $catatan_5->catatan_sementara
                                                !!}
                                            </trix-editor>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="bg-info">
                                        <div class="form-group">
                                            <label for="saran_5">Saran : </label>
                                            <input type="hidden" name="rekom_sementara" id="saran_5">
                                            <trix-editor input="saran_5" class="bg-white text-dark">{!!
                                                $catatan_5->rekom_sementara !!}
                                            </trix-editor>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-right">
                                        <button type="submit" class="btn btn-primary">UPDATE</button>
                                    </td>
                                </tr>
                            </tfoot>

                        </table>

                    </form>

                </div>
            </div>

        </td>
    </tr>
    <tr id="pelaporan" class="bg-info">
        <td></td>
        <td width="3%">1.6</td>
        <td>Pelaporan dan Pertanggungjawaban &emsp;<button class="fa fa-angle-double-down"></button>
        </td>
    </tr>
    <tr id="nhp_pelaporan" style="display: none">
        <td></td>
        <td width="3%"></td>
        <td>
            Penyelenggaraan Pemerintahan Desa adalah seluruh proses kegiatan manajeman pemerintahan Desa yang meliputi
            bidang penyelenggaraan pemerintahan Desa, pelaksanaan pembangunan, pembinaan kemasyarakatan dan pemberdayaan
            masyarakat sesuai kewenangan Desa. Sebagai bentuk pertanggungjawaban penyelenggaraan pemerintahan tersebut
            pemerintah desa wajib menyampaikan laporan dan pertanggungjawaban kepada Bupati melalui Camat. Regulasi
            terkait pelaporan kepala desa antara lain :<br>
            <ol type='a' class="mb-0">
                <li>
                    Pertauran Menteri Dalam Negeri Nomor 46 tahun 2016 tentang Laporan Kepala Desa
                </li>
                <li>
                    Pertauran Menteri Dalam Negeri Nomor 20 tahun 2018 tentang Pengelolaan Keuangan Desa
                </li>
            </ol>
            Adapun evaluasi atas kepatuhan pelaporan desa, sebagai berikut :
            <div class="row">
                <div class="col-md-8">
                    <form action="/adminIrbanwil/nilaiAkunpelaporanEdit" method="post">
                        @csrf
                        <input type="hidden" name="asal_id" value="{{ $asal_id }}">
                        <input type="hidden" name="tahun" value="{{ $tahun }}">
                        <input type="hidden" name="aspek_id" value=1>
                        <input type="hidden" name="indikator_id" value=6>
                        <input type="hidden" name="table" value="nhp_pelaporan">


                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-info">
                                    <th width="5%" style="vertical-align: middle">No</th>
                                    <th width="55%" style="vertical-align: middle">Sub Indikator</th>
                                    <th width="10%" class="text-center">Keterisian<br>Data (%)</th>
                                    <th width="15%" class="text-center" style="vertical-align: middle">Nilai</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 39 ?>
                                @foreach($datnil6 as $dalap)
                                <tr class="{{ $dalap->perbaikan ? 'text-danger' : '' }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $dalap->sub_indikator_pemerintahan->sub_indikator }}
                                    </td>

                                    <td class="text-center" style="vertical-align: middle">
                                        {{
                                        $dalap->persen_data ?? 0 }}
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        <input type="hidden" name="sub_indikator_pemerintahan_id[]" value={{ $i }}>
                                        <input type="number" class="form-control text-center " style="font-size: .85rem"
                                            name="nilai[]" autofocus required
                                            value="{{ $dalap->nilai_sementara ?? 0  }}">
                                    </td>

                                </tr>
                                <?php $i++; ?>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="text-muted"><i>Petunjuk Penilaian : 0 jika data kosong, 100
                                            jika dokumen
                                            sah,
                                            tepat waktu,
                                            dan sistematika telah sesuai ketentuan</i>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="background-color: beige">
                                        <?php 
                                         $nil = $rekap_6->nilai;
                                            if($nil >= 0 && $nil <=30){
                                                $kesimpulan = "TIDAK MEMADAI";
                                            }elseif($nil > 30 && $nil <=55){
                                                $kesimpulan = "KURANG MEMADAI";
                                            }elseif($nil > 55 && $nil <=75){
                                                $kesimpulan = "CUKUP MEMADAI";
                                            }elseif($nil > 75 && $nil <=90){
                                                $kesimpulan = "MEMADAI";
                                            }elseif($nil > 90 && $nil <=100){
                                                $kesimpulan = "SANGAT MEMADAI";
                                            }          
                                        ?>
                                        <p>KESIMPULAN : </p>
                                        <p>SECARA UMUM KELENGKAPAN DAN KESESUAIAN PELAPORAN TAHUN {{ $tahun
                                            }} <span class="text-primary">-- {{ $kesimpulan }} --</span> , DENGAN
                                            URAIAN/CATATAN
                                            SEBAGAI BERIKUT :</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="bg-info">
                                        <div class="form-group">
                                            <label for="kesimpulan_6">Catatan :</label>
                                            <input type="hidden" name="catatan_sementara" id="kesimpulan_6" autofocus>
                                            <trix-editor input="kesimpulan_6" class="bg-white text-dark">{!!
                                                $catatan_6->catatan_sementara
                                                !!}
                                            </trix-editor>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="bg-info">
                                        <div class="form-group">
                                            <label for="saran_6">Saran : </label>
                                            <input type="hidden" name="rekom_sementara" id="saran_6">
                                            <trix-editor input="saran_6" class="bg-white text-dark">{!!
                                                $catatan_6->rekom_sementara !!}
                                            </trix-editor>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-right">
                                        <button type="submit" class="btn btn-primary">UPDATE</button>
                                    </td>
                                </tr>
                            </tfoot>

                        </table>

                    </form>

                </div>
            </div>

        </td>
    </tr>
</table>

<script>
    $('#datum').on('click', function(){
        $('#nhp_datum').toggle('slow');
        location.href="#nhp_datum";
    });
    $('#kewilayahan').on('click', function(){
        $('#nhp_kewilayahan').toggle('slow');
        location.href="#nhp_kewilayahan";
    });
    $('#kelembagaan').on('click', function(){
        $('#nhp_kelembagaan').toggle('slow');
        location.href="#nhp_kelembagaan";
    });
    $('#perencanaan').on('click', function(){
        $('#nhp_perencanaan').toggle('slow');
        location.href="#nhp_perencanaan";
    });
    $('#adum').on('click', function(){
        $('#nhp_adum').toggle('slow');
        location.href="#nhp_adum";
    });
    $('#pelaporan').on('click', function(){
        $('#nhp_pelaporan').toggle('slow');
        location.href="#nhp_pelaporan";
    });

</script>