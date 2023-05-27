<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use App\Models\Akunadum;
use App\Models\Akunkel;
use App\Models\Bidang;
use App\Models\Sub_bidang;
use App\Models\Kegiatan;
use App\Models\Apbdes_kegiatan;
use App\Models\Apbdes_sub_bidang;
use App\Models\Apbdes_bidang;
use App\Models\Pendapatan;
use App\Models\Apbdes_pendapatan;
use App\Models\Total_apbd;
use App\Models\Apbdes_pembiayaan;
use App\Models\Pembiayaan;
use App\Models\Apbdes_dokumen;
use App\Models\Apbdes_belanjaakun;
use App\Models\Belanja;
use App\Models\Nilai_pemerintahan;
use App\Models\Akunwil;
use App\Models\Bpd;
use App\Models\Datum;
use App\Models\Datum_dusun;
use App\Models\Datum_perangkat;
use App\Models\Dokren;
use App\Models\Pelaporan;
use App\Models\Penataan_pendapatan;
use App\Models\Rapbd;
use App\Models\Rpjmd;
use Illuminate\Http\Request;

class CopyTableController extends Controller
{
    public function copyBelanja(Request $request)
    {
        $apbdes_belanja = Apbdes_belanjaakun::where('asal_id', 89)->get();

        for ($i = 1; $i <= 247; $i++) {
            if ($i !== 89) {
                foreach ($apbdes_belanja as $bj) {
                    $data = [
                        'asal_id' => $i,
                        'tahun' => $bj->tahun,
                        'belanja_id' => $bj->belanja_id,
                        'anggaran_murni' => $bj->anggaran_murni,
                        'anggaran_perubahan' => $bj->anggaran_perubahan,
                        'updated_at' => $bj->updated_at,
                        'created_at' => $bj->created_at
                    ];
                    Apbdes_belanjaakun::create($data);
                }
            }
        }
        return "berhasil";
    }

    public function copyPendapatan(Request $request)
    {
        $apbdes_pendapatan = Apbdes_pendapatan::where('asal_id', 89)->get();

        for ($i = 1; $i <= 247; $i++) {
            if ($i !== 89) {
                foreach ($apbdes_pendapatan as $pend) {
                    $data = [
                        'asal_id' => $i,
                        'tahun' => $pend->tahun,
                        'pendapatan_id' => $pend->pendapatan_id,
                        'kode_pendapatan' => $pend->kode_pendapatan,
                        'jenis_pendapatan' => $pend->jenis_pendapatan,
                        'anggaran_murni' => $pend->anggaran_murni,
                        'anggaran_perubahan' => $pend->anggaran_perubahan,
                        'updated_at' => $pend->updated_at,
                        'created_at' => $pend->created_at
                    ];
                    Apbdes_pendapatan::create($data);
                }
            }
        }
        return "berhasil";
    }

    public function copyTotal(Request $request)
    {
        $total_apbdes = Total_apbd::where('asal_id', 89)->get();

        for ($i = 1; $i <= 247; $i++) {
            if ($i !== 89) {
                foreach ($total_apbdes as $tot) {
                    $data = [
                        'asal_id' => $i,
                        'tahun' => $tot->tahun,
                        'pendapatan_murni' => $tot->pendapatan_murni,
                        'pendapatan_perubahan' => $tot->pendapatan_perubahan,
                        'belanja_murni' => $tot->belanja_murni,
                        'belanja_perubahan' => $tot->belanja_perubahan,
                        'akunbelanja_murni' => $tot->akunbelanja_murni,
                        'akunbelanja_perubahan' => $tot->akunbelanja_perubahan,
                        'pembiayaan_murni' => $tot->pembiayaan_murni,
                        'pembiayaan_perubahan' => $tot->pembiayaan_perubahan,
                        'updated_at' => $tot->updated_at,
                        'created_at' => $tot->created_at
                    ];
                    Total_apbd::create($data);
                }
            }
        }
        return "berhasil";
    }

    public function copyPembiayaan(Request $request)
    {
        $apbdes_pembiayaan = Apbdes_pembiayaan::where('asal_id', 89)->get();

        for ($i = 1; $i <= 247; $i++) {
            if ($i !== 89) {
                foreach ($apbdes_pembiayaan as $pby) {
                    $data = [
                        'asal_id' => $i,
                        'tahun' => $pby->tahun,
                        'pembiayaan_id' => $pby->pembiayaan_id,
                        'kode_pembiayaan' => $pby->kode_pembiayaan,
                        'jenis_pembiayaan' => $pby->jenis_pembiayaan,
                        'anggaran_murni' => $pby->anggaran_murni,
                        'anggaran_perubahan' => $pby->anggaran_perubahan,
                        'updated_at' => $pby->updated_at,
                        'created_at' => $pby->created_at
                    ];
                    Apbdes_pembiayaan::create($data);
                }
            }
        }
        return "berhasil";
    }

    public function copyBidang(Request $request)
    {
        $apbdes_bidang = Apbdes_bidang::where('asal_id', 89)->get();

        for ($i = 1; $i <= 247; $i++) {
            if ($i !== 89) {
                foreach ($apbdes_bidang as $bid) {
                    $data = [
                        'asal_id' => $i,
                        'tahun' => $bid->tahun,
                        'bidang_id' => $bid->bidang_id,
                        'anggaran_murni' => $bid->anggaran_murni,
                        'anggaran_perubahan' => $bid->anggaran_perubahan,
                        'updated_at' => $bid->updated_at,
                        'created_at' => $bid->created_at
                    ];
                    Apbdes_bidang::create($data);
                }
            }
        }
        return "berhasil";
    }
    public function copySubBidang(Request $request)
    {
        $apbdes_sub_bidang = Apbdes_sub_bidang::where('asal_id', 89)->get();

        // $i = 1;
        // foreach ($apbdes_sub_bidang as $sub) {
        //     $id = $sub->id;
        //     if ($id > 27) {
        //         Apbdes_sub_bidang::where('id', $id)->update([
        //             'id' => 27 + $i
        //         ]);
        //     }
        //     $i++;
        // }
        // return "berhasil juga";

        for ($i = 201; $i <= 247; $i++) {
            if ($i !== 89) {
                foreach ($apbdes_sub_bidang as $sub) {
                    $data = [
                        'asal_id' => $i,
                        'tahun' => $sub->tahun,
                        'apbdes_bidang_id' => $sub->apbdes_bidang_id,
                        'bidang_id' => $sub->bidang_id,
                        'sub_bidang_id' => $sub->sub_bidang_id,
                        'kode_sub_bidang' => $sub->kode_sub_bidang,
                        'anggaran_murni' => $sub->anggaran_murni,
                        'anggaran_perubahan' => $sub->anggaran_perubahan,
                        'updated_at' => $sub->updated_at,
                        'created_at' => $sub->created_at
                    ];
                    $copy = Apbdes_sub_bidang::create($data);
                }
            }
        }
        if ($copy) {
            for ($i = 1; $i <= 247; $i++) {
                $apbdes_bidang_1 = Apbdes_bidang::where('asal_id', $i)->where('bidang_id', 1)->pluck('id')->first();
                $apbdes_bidang_2 = Apbdes_bidang::where('asal_id', $i)->where('bidang_id', 2)->pluck('id')->first();
                $apbdes_bidang_3 = Apbdes_bidang::where('asal_id', $i)->where('bidang_id', 3)->pluck('id')->first();
                $apbdes_bidang_4 = Apbdes_bidang::where('asal_id', $i)->where('bidang_id', 4)->pluck('id')->first();
                $apbdes_bidang_5 = Apbdes_bidang::where('asal_id', $i)->where('bidang_id', 5)->pluck('id')->first();

                Apbdes_sub_bidang::where('asal_id', $i)->where('bidang_id', 1)->update([
                    'apbdes_bidang_id' => $apbdes_bidang_1
                ]);
                Apbdes_sub_bidang::where('asal_id', $i)->where('bidang_id', 2)->update([
                    'apbdes_bidang_id' => $apbdes_bidang_2
                ]);
                Apbdes_sub_bidang::where('asal_id', $i)->where('bidang_id', 3)->update([
                    'apbdes_bidang_id' => $apbdes_bidang_3
                ]);
                Apbdes_sub_bidang::where('asal_id', $i)->where('bidang_id', 4)->update([
                    'apbdes_bidang_id' => $apbdes_bidang_4
                ]);
                Apbdes_sub_bidang::where('asal_id', $i)->where('bidang_id', 5)->update([
                    'apbdes_bidang_id' => $apbdes_bidang_5
                ]);
            }
        }

        return 'berhasil';
    }

    public function copyKegiatan(Request $request)
    {
        $apbdes_kegiatan = Apbdes_kegiatan::where('asal_id', 89)->get();

        // $i = 1;
        // foreach ($apbdes_sub_bidang as $sub) {
        //     $id = $sub->id;
        //     if ($id > 27) {
        //         Apbdes_sub_bidang::where('id', $id)->update([
        //             'id' => 27 + $i
        //         ]);
        //     }
        //     $i++;
        // }
        // return "berhasil juga";

        for ($i = 201; $i <= 247; $i++) {
            if ($i !== 89) {
                foreach ($apbdes_kegiatan as $keg) {
                    $data = [
                        'asal_id' => $i,
                        'tahun' => $keg->tahun,
                        'apbdes_bidang_id' => $keg->apbdes_bidang_id,
                        'apbdes_sub_bidang_id' => $keg->apbdes_sub_bidang_id,
                        'kegiatan_id' => $keg->kegiatan_id,
                        'kode_kegiatan' => $keg->kode_kegiatan,
                        'anggaran_murni' => $keg->anggaran_murni,
                        'anggaran_perubahan' => $keg->anggaran_perubahan,
                        'updated_at' => $keg->updated_at,
                        'created_at' => $keg->created_at
                    ];
                    $copy = Apbdes_kegiatan::create($data);
                }
            }
        }


        return 'berhasil';
    }

    public function updateKegiatan(Request $request)
    {

        for ($i = 221; $i <= 247; $i++) {
            $apbdes_bidang_1 = Apbdes_bidang::where('asal_id', $i)->where('bidang_id', 1)->pluck('id')->first();
            $apbdes_bidang_2 = Apbdes_bidang::where('asal_id', $i)->where('bidang_id', 2)->pluck('id')->first();
            $apbdes_bidang_3 = Apbdes_bidang::where('asal_id', $i)->where('bidang_id', 3)->pluck('id')->first();
            $apbdes_bidang_4 = Apbdes_bidang::where('asal_id', $i)->where('bidang_id', 4)->pluck('id')->first();
            $apbdes_bidang_5 = Apbdes_bidang::where('asal_id', $i)->where('bidang_id', 5)->pluck('id')->first();


            $apbdes_sub_bidang_id_1 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 1)->pluck('id')->first();
            $apbdes_sub_bidang_id_2 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 2)->pluck('id')->first();
            $apbdes_sub_bidang_id_3 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 3)->pluck('id')->first();
            $apbdes_sub_bidang_id_4 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 4)->pluck('id')->first();
            $apbdes_sub_bidang_id_5 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 5)->pluck('id')->first();
            $apbdes_sub_bidang_id_6 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 6)->pluck('id')->first();
            $apbdes_sub_bidang_id_7 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 7)->pluck('id')->first();
            $apbdes_sub_bidang_id_8 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 8)->pluck('id')->first();
            $apbdes_sub_bidang_id_9 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 9)->pluck('id')->first();
            $apbdes_sub_bidang_id_10 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 10)->pluck('id')->first();
            $apbdes_sub_bidang_id_11 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 11)->pluck('id')->first();
            $apbdes_sub_bidang_id_12 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 12)->pluck('id')->first();
            $apbdes_sub_bidang_id_13 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 13)->pluck('id')->first();
            $apbdes_sub_bidang_id_14 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 14)->pluck('id')->first();
            $apbdes_sub_bidang_id_15 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 15)->pluck('id')->first();
            $apbdes_sub_bidang_id_16 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 16)->pluck('id')->first();
            $apbdes_sub_bidang_id_17 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 17)->pluck('id')->first();
            $apbdes_sub_bidang_id_18 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 18)->pluck('id')->first();
            $apbdes_sub_bidang_id_19 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 19)->pluck('id')->first();
            $apbdes_sub_bidang_id_20 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 20)->pluck('id')->first();
            $apbdes_sub_bidang_id_21 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 21)->pluck('id')->first();
            $apbdes_sub_bidang_id_22 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 22)->pluck('id')->first();
            $apbdes_sub_bidang_id_23 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 23)->pluck('id')->first();
            $apbdes_sub_bidang_id_24 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 24)->pluck('id')->first();
            $apbdes_sub_bidang_id_25 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 25)->pluck('id')->first();
            $apbdes_sub_bidang_id_26 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 26)->pluck('id')->first();
            $apbdes_sub_bidang_id_27 = Apbdes_sub_bidang::where('asal_id', $i)->where('sub_bidang_id', 27)->pluck('id')->first();



            if ($i !== 89) {
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '<=', 43)->update([
                    'apbdes_bidang_id' => $apbdes_bidang_1
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 43)->where('kegiatan_id', '<=', 118)->update([
                    'apbdes_bidang_id' => $apbdes_bidang_2
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 118)->where('kegiatan_id', '<=', 144)->update([
                    'apbdes_bidang_id' => $apbdes_bidang_3
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 144)->where('kegiatan_id', '<=', 177)->update([
                    'apbdes_bidang_id' => $apbdes_bidang_4
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 177)->where('kegiatan_id', '<=', 180)->update([
                    'apbdes_bidang_id' => $apbdes_bidang_5
                ]);


                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '<=', 13)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_1
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 13)->where('kegiatan_id', '<=', 17)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_2
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 17)->where('kegiatan_id', '<=', 23)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_3
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 23)->where('kegiatan_id', '<=', 35)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_4
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 35)->where('kegiatan_id', '<=', 43)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_5
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 43)->where('kegiatan_id', '<=', 54)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_6
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 54)->where('kegiatan_id', '<=', 64)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_7
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 64)->where('kegiatan_id', '<=', 85)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_8
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 85)->where('kegiatan_id', '<=', 103)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_9
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 103)->where('kegiatan_id', '<=', 107)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_10
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 107)->where('kegiatan_id', '<=', 111)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_11
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 111)->where('kegiatan_id', '<=', 114)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_12
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 114)->where('kegiatan_id', '<=', 118)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_13
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 118)->where('kegiatan_id', '<=', 126)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_14
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 126)->where('kegiatan_id', '<=', 132)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_15
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 132)->where('kegiatan_id', '<=', 139)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_16
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 139)->where('kegiatan_id', '<=', 144)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_17
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 144)->where('kegiatan_id', '<=', 151)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_18
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 151)->where('kegiatan_id', '<=', 157)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_19
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 157)->where('kegiatan_id', '<=', 161)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_20
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 161)->where('kegiatan_id', '<=', 165)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_21
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 165)->where('kegiatan_id', '<=', 169)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_22
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 169)->where('kegiatan_id', '<=', 172)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_23
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 172)->where('kegiatan_id', '<=', 177)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_24
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 177)->where('kegiatan_id', '<=', 178)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_25
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 178)->where('kegiatan_id', '<=', 179)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_26
                ]);
                Apbdes_kegiatan::where('asal_id', $i)->where('kegiatan_id', '>', 179)->where('kegiatan_id', '<=', 180)->update([
                    'apbdes_sub_bidang_id' => $apbdes_sub_bidang_id_27
                ]);
            }
        }
        return "berhasil update";
    }


    public function copyapbdesdok(Request $request)
    {
        $adum = Apbdes_dokumen::where('asal_id', 89)->get();

        for ($i = 1; $i <= 247; $i++) {
            if ($i !== 89) {
                foreach ($adum as $ad) {
                    $data = [
                        'asal_id' => $i,
                        'tahun' => $ad->tahun,
                        'nomor_perdes_murni' => $ad->nomor_perdes_murni,
                        'dokumen_murni' => $ad->dokumen_murni,
                        'tanggal_murni' => $ad->tanggal_murni,
                        'dokumen_penjabaran_murni' => $ad->dokumen_penjabaran_murni,
                        'desain_gambar_murni' => $ad->desain_gambar_murni,

                    ];
                    Apbdes_dokumen::create($data);
                }
            }
        }
        return "berhasil";
    }


    public function copyPenataanPendapatan(Request $request)
    {
        $adum = Penataan_pendapatan::where('asal_id', 89)->get();

        for ($i = 1; $i <= 247; $i++) {
            if ($i !== 89) {
                foreach ($adum as $ad) {
                    $data = [
                        'asal_id' => $i,
                        'tahun' => $ad->tahun,
                        'apbdes_pendapatan_id' => $ad->apbdes_pendapatan_id,
                        'dokumen_murni' => $ad->dokumen_murni,
                        'tanggal_murni' => $ad->tanggal_murni,
                        'dokumen_penjabaran_murni' => $ad->dokumen_penjabaran_murni,
                        'desain_gambar_murni' => $ad->desain_gambar_murni,

                    ];
                    Penataan_pendapatan::create($data);
                }
            }
        }
        return "berhasil";
    }

    // PEMERINTAHAN
    public function copyadum(Request $request)
    {
        $adum = Akunadum::all();

        for ($i = 1; $i <= 247; $i++) {
            if ($i !== 89) {
                foreach ($adum as $ad) {
                    $data = [
                        'asal_id' => $i,
                        'tahun' => $ad->tahun,
                        'nama_data' => $ad->nama_data,
                        'file_data' => $ad->file_data,

                    ];
                    Akunadum::create($data);
                }
            }
        }
        return "berhasil";
    }

    public function copykel(Request $request)
    {
        $adum = Akunkel::all();

        for ($i = 1; $i <= 247; $i++) {
            if ($i !== 89) {
                foreach ($adum as $ad) {
                    $data = [
                        'asal_id' => $i,
                        'tahun' => $ad->tahun,
                        'nama_data' => $ad->nama_data,
                        'file_data' => $ad->file_data,

                    ];
                    Akunkel::create($data);
                }
            }
        }
        return "berhasil";
    }

    public function copywil(Request $request)
    {
        $adum = Akunwil::all();

        for ($i = 1; $i <= 247; $i++) {
            if ($i !== 89) {
                foreach ($adum as $ad) {
                    $data = [
                        'asal_id' => $i,
                        'tahun' => $ad->tahun,
                        'nama_data' => $ad->nama_data,
                        'file_data' => $ad->file_data,

                    ];
                    Akunwil::create($data);
                }
            }
        }
        return "berhasil";
    }

    public function copybpd(Request $request)
    {
        $adum = Bpd::all();

        for ($i = 1; $i <= 247; $i++) {
            if ($i !== 89) {
                foreach ($adum as $ad) {
                    $data = [
                        'asal_id' => $i,
                        'tahun' => $ad->tahun,
                        'jabatan' => $ad->jabatan,
                        'status_jab' => $ad->status_jab,
                        'nama' => $ad->nama,
                        'tempat_lahir' => $ad->tempat_lahir,
                        'tgl_lahir' => $ad->tgl_lahir,
                        'jenkel' => $ad->jenkel,
                        'agama' => $ad->agama,
                        'hp' => $ad->hp,
                        'nomor_sk' => $ad->nomor_sk,
                        'sejak' => $ad->sejak,
                        'sampai' => $ad->sampai,
                        'file_sk' => $ad->file_sk,
                        'pendidikan' => $ad->pendidikan,
                        'file_ijazah' => $ad->file_ijazah,
                        'foto_perangkat' => $ad->foto_perangkat,

                    ];
                    Bpd::create($data);
                }
            }
        }
        return "berhasil";
    }

    public function copydatum(Request $request)
    {
        $adum = Datum::where('asal_id', 89)->get();

        for ($i = 201; $i <= 247; $i++) {
            if ($i !== 89) {
                foreach ($adum as $ad) {
                    $data = [
                        'asal_id' => $i,
                        'tahun' => $ad->tahun,
                        'jenis' => $ad->jenis,
                        'nama_data' => $ad->nama_data,
                        'isidata' => $ad->isidata,

                    ];
                    Datum::create($data);
                }
            }
        }
        return "berhasil";
    }

    public function copydatumdusun(Request $request)
    {
        $adum = Datum_dusun::where('asal_id', 89)->get();

        for ($i = 1; $i <= 247; $i++) {
            if ($i !== 89) {
                foreach ($adum as $ad) {
                    $data = [
                        'asal_id' => $i,
                        'tahun' => $ad->tahun,
                        'jabatan' => $ad->jabatan,
                        'status_jab' => $ad->status_jab,
                        'nama' => $ad->nama,
                        'tempat_lahir' => $ad->tempat_lahir,
                        'tgl_lahir' => $ad->tgl_lahir,
                        'jenkel' => $ad->jenkel,
                        'agama' => $ad->agama,
                        'hp' => $ad->hp,
                        'nomor_sk' => $ad->nomor_sk,
                        'sejak' => $ad->sejak,
                        'sampai' => $ad->sampai,
                        'file_sk' => $ad->file_sk,
                        'pendidikan' => $ad->pendidikan,
                        'file_ijazah' => $ad->file_ijazah,
                        'foto_perangkat' => $ad->foto_perangkat,
                    ];
                    Datum_dusun::create($data);
                }
            }
        }
        return "berhasil";
    }

    public function copydatumperangkat(Request $request)
    {
        $adum = Datum_perangkat::where('asal_id', 89)->get();

        for ($i = 1; $i <= 247; $i++) {
            if ($i !== 89) {
                foreach ($adum as $ad) {
                    $data = [
                        'asal_id' => $i,
                        'tahun' => $ad->tahun,
                        'jabatan' => $ad->jabatan,
                        'status_jab' => $ad->status_jab,
                        'nama' => $ad->nama,
                        'tempat_lahir' => $ad->tempat_lahir,
                        'tgl_lahir' => $ad->tgl_lahir,
                        'jenkel' => $ad->jenkel,
                        'agama' => $ad->agama,
                        'hp' => $ad->hp,
                        'nomor_sk' => $ad->nomor_sk,
                        'sejak' => $ad->sejak,
                        'sampai' => $ad->sampai,
                        'file_sk' => $ad->file_sk,
                        'pendidikan' => $ad->pendidikan,
                        'file_ijazah' => $ad->file_ijazah,
                        'foto_perangkat' => $ad->foto_perangkat,
                    ];
                    Datum_perangkat::create($data);
                }
            }
        }
        return "berhasil";
    }

    public function copydokren(Request $request)
    {
        $adum = Dokren::all();

        for ($i = 1; $i <= 247; $i++) {
            if ($i !== 89) {
                foreach ($adum as $ad) {
                    $data = [
                        'asal_id' => $i,
                        'tahun' => $ad->tahun,
                        'nama_dokren' => $ad->nama_dokren,
                        'nama_data' => $ad->nama_data,
                        'isidata' => $ad->isidata,
                        'volume' => $ad->volume,
                        'satuan' => $ad->satuan,
                        'pagu' => $ad->pagu,
                        'file_data' => $ad->file_data,


                    ];
                    Dokren::create($data);
                }
            }
        }
        return "berhasil";
    }

    public function copyNilaiPemerintahan(Request $request)
    {
        $adum = Nilai_pemerintahan::where('asal_id', 89)->get();

        for ($i = 101; $i <= 247; $i++) {
            if ($i !== 89) {
                foreach ($adum as $ad) {
                    $data = [
                        'asal_id' => $i,
                        'tahun' => $ad->tahun,
                        'aspek_id' => $ad->aspek_id,
                        'indikator_id' => $ad->indikator_id,
                        'sub_indikator_pemerintahan_id' => $ad->sub_indikator_pemerintahan_id,
                        'jumlah_data' => $ad->jumlah_data,
                        'persen_data' => $ad->persen_data,
                        'perbaikan' => $ad->perbaikan,
                        'nilai_sementara' => $ad->nilai_sementara,

                    ];
                    Nilai_pemerintahan::create($data);
                }
            }
        }
        return "berhasil";
    }

    public function copypelaporan(Request $request)
    {
        $adum = Pelaporan::where('asal_id', 89)->get();

        for ($i = 1; $i <= 247; $i++) {
            if ($i !== 89) {
                foreach ($adum as $ad) {
                    $data = [
                        'asal_id' => $i,
                        'tahun' => $ad->tahun,
                        'nama_data' => $ad->nama_data,
                        'file_data' => $ad->file_data,
                    ];
                    Pelaporan::create($data);
                }
            }
        }
        return "berhasil";
    }

    public function copyrapbdes(Request $request)
    {
        $adum = Rapbd::where('asal_id', 89)->get();

        for ($i = 1; $i <= 247; $i++) {
            if ($i !== 89) {
                foreach ($adum as $ad) {
                    $data = [
                        'asal_id' => $i,
                        'tahun' => $ad->tahun,
                        'jenis' => $ad->jenis,
                        'nama_data' => $ad->nama_data,
                        'isi_data' => $ad->isi_data,
                    ];
                    Rapbd::create($data);
                }
            }
        }
        return "berhasil";
    }
    public function copyrpjmdes(Request $request)
    {
        $adum = Rpjmd::where('asal_id', 89)->get();

        for ($i = 1; $i <= 247; $i++) {
            if ($i !== 89) {
                foreach ($adum as $ad) {
                    $data = [
                        'asal_id' => $i,
                        'tahun' => $ad->tahun,
                        'jenis' => $ad->jenis,
                        'nama_data' => $ad->nama_data,
                        'uraian' => $ad->uraian,
                        'file_data' => $ad->file_data,
                        'sejak' => $ad->sejak,
                        'sampai' => $ad->sampai,
                    ];
                    Rpjmd::create($data);
                }
            }
        }
        return "berhasil";
    }
}
