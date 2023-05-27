<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Asal;
use App\Models\Catatan_pemerintahan;
use App\Models\Catatan_keuangan;
use App\Models\Kecamatan;
use App\Models\Nilai_pemerintahan;
use App\Models\Nilai_keuangan;
use App\Models\Rekap_nilai_indikator;
use App\Models\Total_apbd;
use App\Models\Apbdes_pendapatan;
use App\Models\Apbdes_kegiatan;
use App\Models\Apbdes_pembiayaan;
use App\Models\Apbdes_belanjaakun;
use App\Models\Datum;
use App\Models\Penataan_pembiayaan;
use App\Models\Penataan_pendapatan;
use App\Models\Penataanbelanja_bkp;
use App\Models\Buku_pembantu_bank;
use App\Models\Penataanbelanja_spp;
use App\Models\Uji_petik;
use App\Models\Bku_panjar;

class SusunNhpController extends Controller
{
    public function susun_NHP(Request $request)
    {
        $tahun = now()->format('Y');
        $infos = Admin::where('id', session('loggedAdminIrbanwil'))->first();
        if ($infos->role == 'admin_sekretariat' || $infos->role == 'admin_irbansus') {
            $asal_id =  Asal::first();
            $kecamatan = Kecamatan::all();
            $kecamatan1 = $kecamatan->pluck('nama_kecamatan')->first();
        } else {
            $asal_id =  Asal::where('obrik', $infos->obrik)->pluck('id')->first();
            $kecamatan = Kecamatan::where('obrik', $infos->obrik)->get();
            $kecamatan1 = $kecamatan->pluck('nama_kecamatan')->first();
        }

        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }
        if (session()->has('asal_id')) {
            $asal_id = session()->get('asal_id');
        }
        if (session()->has('pilcam')) {
            $kecamatan1 = session()->get('pilcam');
        }

        $deswal = Asal::where('kecamatan', $kecamatan1)->get();
        $desa = Asal::where('id', $asal_id)->first();

        $nilaiP = Nilai_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->orderBy('sub_indikator_pemerintahan_id', 'ASC')->get();

        if (count($nilaiP) <= 0) {
            return view('adminIrbanwil.NHP_LHP.nhp', [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'tahun' => $tahun,
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'error' => "Belum ada data pemerintahan"
            ]);
        }

        $datnil = $nilaiP->where('indikator_id', 1);
        $datnil2 = $nilaiP->where('indikator_id', 2);
        $datnil3 = $nilaiP->where('indikator_id', 3);
        $datnil4 = $nilaiP->where('indikator_id', 4);
        $datnil5 = $nilaiP->where('indikator_id', 5);
        $datnil6 = $nilaiP->where('indikator_id', 6);

        $data = Nilai_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 1
        ])->where('nilai_sementara', '!=', NULL)->get();


        $catatan = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();
        $catatanK = Catatan_keuangan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();
        $catatan_1 = $catatan->where('indikator_id', 1)->first();
        $catatan_2 = $catatan->where('indikator_id', 2)->first();
        $catatan_3 = $catatan->where('indikator_id', 3)->first();
        $catatan_4 = $catatan->where('indikator_id', 4)->first();
        $catatan_5 = $catatan->where('indikator_id', 5)->first();
        $catatan_6 = $catatan->where('indikator_id', 6)->first();
        $catatan_7 = $catatanK->where('indikator_id', 7)->first();
        $catatan_8 = $catatanK->where('indikator_id', 8)->first();
        $catatan_9 = $catatanK->where('indikator_id', 9)->first();
        $catatan_10 = $catatanK->where('indikator_id', 10)->first();
        $catatan_11 = $catatanK->where('indikator_id', 11)->first();
        $catatan_12 = $catatanK->where('indikator_id', 12)->first();
        $catatan_13 = $catatanK->where('indikator_id', 13)->first();

        $nilaiK = Nilai_keuangan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->orderBy('sub_indikator_keuangan_id', 'ASC')->get();
        if (count($nilaiK) <= 0) {
            return view('adminIrbanwil.NHP_LHP.nhp', [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'tahun' => $tahun,
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'error' => "Belum ada data keuangan"
            ]);
        }

        $datnilK = $nilaiK->where('indikator_id', 7);
        $datnilK2 = $nilaiK->where('indikator_id', 8);
        $datnilK3 = $nilaiK->where('indikator_id', 9);
        $datnilK4 = $nilaiK->where('indikator_id', 10);
        $datnilK5 = $nilaiK->where('indikator_id', 11);
        $datnilK6 = $nilaiK->where('indikator_id', 12);
        $datnilK7 = $nilaiK->where('indikator_id', 13);


        $rekap = Rekap_nilai_indikator::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->get();
        if (count($rekap) <= 0) {
            return view('adminIrbanwil.NHP_LHP.nhp', [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'tahun' => $tahun,
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'error' => "Anda belum melakukan penilaian"
            ]);
        }

        $rekap_1 = $rekap->where('indikator_id', 1)->first();
        $rekap_2 = $rekap->where('indikator_id', 2)->first();
        $rekap_3 = $rekap->where('indikator_id', 3)->first();
        $rekap_4 = $rekap->where('indikator_id', 4)->first();
        $rekap_5 = $rekap->where('indikator_id', 5)->first();
        $rekap_6 = $rekap->where('indikator_id', 6)->first();
        $rekap_7 = $rekap->where('indikator_id', 7)->first();
        $rekap_8 = $rekap->where('indikator_id', 8)->first();
        $rekap_9 = $rekap->where('indikator_id', 9)->first();
        $rekap_10 = $rekap->where('indikator_id', 10)->first();
        $rekap_11 = $rekap->where('indikator_id', 11)->first();
        $rekap_12 = $rekap->where('indikator_id', 12)->first();
        $rekap_13 = $rekap->where('indikator_id', 13)->first();

        //Data Keuangan
        $total = Total_apbd::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->first();
        if (!$total) {
            return view('adminIrbanwil.NHP_LHP.nhp', [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'tahun' => $tahun,
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'error' => "Belum ada data APBDes!"
            ]);
        }

        if ($total->belanja_perubahan != null) {
            $status = 'APB Desa perubahan';
            $anggaran = 'anggaran_perubahan';
            $totalPendapatan = $total->pendapatan_perubahan;
            $totalBelanja = $total->belanja_perubahan;
            $totalPembiayaan = $total->pembiayaan_perubahan;
            $silpa = ($totalPendapatan - $totalBelanja) + $totalPembiayaan;
        } else {
            $status = 'APB Desa murni';
            $anggaran = 'anggaran_murni';
            $totalPendapatan = $total->pendapatan_murni;
            $totalBelanja = $total->belanja_murni;
            $totalPembiayaan = $total->pembiayaan_murni;
            $silpa = ($totalPendapatan - $totalBelanja) + $totalPembiayaan;
        }


        $belanjas = Apbdes_belanjaakun::with('belanja')->where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();
        $pendapatans = Apbdes_pendapatan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();

        $pembiayaans = Apbdes_pembiayaan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();

        $realisasiPend = Penataan_pendapatan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();
        $totRealisasiPend = $realisasiPend->pluck('jumlah')->sum();
        $realisasiBelanja = Penataanbelanja_bkp::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();
        $realisasiBPeg = $realisasiBelanja->where('belanja_id', 1)->pluck('jumlah')->sum();
        $realisasiBBarjas = $realisasiBelanja->where('belanja_id', 2)->pluck('jumlah')->sum();
        $realisasiBModal = $realisasiBelanja->where('belanja_id', 3)->pluck('jumlah')->sum();
        $realisasiBTakter = $realisasiBelanja->where('belanja_id', 4)->pluck('jumlah')->sum();
        $realisasiBTotal = $realisasiBelanja->pluck('jumlah')->sum();
        $surdef = $totRealisasiPend - $realisasiBTotal;
        $selisihsurdef = ($totalPendapatan - $totalBelanja) - ($surdef);


        $realisasiPemb = Penataan_pembiayaan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();
        $realisasiPenPemb = $realisasiPemb->where('pembiayaan_id', '<=', 5)->pluck('jumlah')->sum();
        $realisasiPengPemb = $realisasiPemb->where('pembiayaan_id', '>', 6)->pluck('jumlah')->sum();
        $pembiayaanNetto = $realisasiPenPemb - $realisasiPengPemb;
        $silpaPembiayaan = $surdef + $pembiayaanNetto;



        if ($surdef && $surdef < 0) {
            $surdef = "(" . - (number_format($surdef, 0, ',', '.')) . ")";
        }
        if ($pembiayaanNetto  && $pembiayaanNetto < 0) {
            $pembiayaanNetto = "(" . - (number_format($pembiayaanNetto, 0, ',', '.')) . ")";
        }
        if ($selisihsurdef && $selisihsurdef < 0) {
            $selisihsurdef = "(" . - (number_format($selisihsurdef, 0, ',', '.')) . ")";
        }

        // Penataan Pendapatan - Buku Pembantu Bank
        $bukubank = Buku_pembantu_bank::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();
        $semester_1 = $bukubank->where('nama_data', 'semester_1')->first();
        $semester_2 = $bukubank->where('nama_data', 'semester_2')->first();

        // SPP Kegiatan
        $spp = Penataanbelanja_spp::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->get();
        $jumdokspp = $spp->count();
        $akumulasi_spp = $spp->pluck('jumlah')->sum();
        $temuanSPP = $spp->where('catatan', '!=', '');

        $bkp = Penataanbelanja_bkp::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->get();
        $jumdokbkp = $bkp->count();
        $akumulasi_bkp = $bkp->pluck('jumlah')->sum();
        $temuanbkp = $bkp->where('catatan_bkp', '!=', '');

        $ujipetik = Uji_petik::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->first();

        $data_bku = Bku_panjar::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();
        $bku_semester1 = $data_bku->where('nama_data', 'bku_semester1')->first();
        $bku_semester2 = $data_bku->where('nama_data', 'bku_semester2')->first();
        $bp_semester1 = $data_bku->where('nama_data', 'buku_pembantu_panjar_semester1')->first();
        $bp_semester2 = $data_bku->where('nama_data', 'buku_pembantu_panjar_semester2')->first();

        return view('adminIrbanwil.NHP_LHP.nhp', [
            'desa' => $desa,
            'infos' => $infos,
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'kecamatan' => $kecamatan,
            'deswal' => $deswal,
            'error' => '',
            'datnil' => $datnil,
            'datnil2' => $datnil2,
            'datnil3' => $datnil3,
            'datnil4' => $datnil4,
            'datnil5' => $datnil5,
            'datnil6' => $datnil6,
            'datnilK' => $datnilK,
            'datnilK2' => $datnilK2,
            'datnilK3' => $datnilK3,
            'datnilK4' => $datnilK4,
            'datnilK5' => $datnilK5,
            'datnilK6' => $datnilK6,
            'datnilK7' => $datnilK7,
            'data' => $data,
            'catatan_1' => $catatan_1,
            'catatan_2' => $catatan_2,
            'catatan_3' => $catatan_3,
            'catatan_4' => $catatan_4,
            'catatan_5' => $catatan_5,
            'catatan_6' => $catatan_6,
            'catatan_7' => $catatan_7,
            'catatan_8' => $catatan_8,
            'catatan_9' => $catatan_9,
            'catatan_10' => $catatan_10,
            'catatan_11' => $catatan_11,
            'catatan_12' => $catatan_12,
            'catatan_13' => $catatan_13,
            'rekap_1' => $rekap_1,
            'rekap_2' => $rekap_2,
            'rekap_3' => $rekap_3,
            'rekap_4' => $rekap_4,
            'rekap_5' => $rekap_5,
            'rekap_6' => $rekap_6,
            'rekap_7' => $rekap_7,
            'rekap_8' => $rekap_8,
            'rekap_9' => $rekap_9,
            'rekap_10' => $rekap_10,
            'rekap_11' => $rekap_11,
            'rekap_12' => $rekap_12,
            'rekap_13' => $rekap_13,
            'total' => $total,
            'totalPendapatan' => $totalPendapatan,
            'totalBelanja' => $totalBelanja,
            'totalPembiayaan' => $totalPembiayaan,
            'silpa' => $silpa,
            'status' => $status,
            'anggaran' => $anggaran,
            'belanjas' => $belanjas,
            'pendapatans' => $pendapatans,
            'pembiayaans' => $pembiayaans,
            'realisasiPend' => $realisasiPend,
            'totalRealisasiPend' => $totRealisasiPend,
            'realisasiBpeg' => $realisasiBPeg,
            'realisasiBBarjas' => $realisasiBBarjas,
            'realisasiBModal' => $realisasiBModal,
            'realisasiBTakter' => $realisasiBTakter,
            'realisasiBTotal' => $realisasiBTotal,
            'surdef' => $surdef,
            'selisihsurdef' => $selisihsurdef,
            'realisasiPemb' => $realisasiPemb,
            'pembiayaanNetto' => $pembiayaanNetto,
            'silpaPembiayaan' => $silpaPembiayaan,
            'semester_1' => $semester_1,
            'semester_2' => $semester_2,
            'jumdokspp' => $jumdokspp,
            'akumulasi_spp' => $akumulasi_spp,
            'temuanSPP' => $temuanSPP,
            'bkp' => $bkp,
            'jumdokbkp' => $jumdokbkp,
            'akumulasi_bkp' => $akumulasi_bkp,
            'temuanbkp' => $temuanbkp,
            'ujipetik' => $ujipetik,
            'data_bku' => $data_bku,
            'bku_semester1' => $bku_semester1,
            'bku_semester2' => $bku_semester2,
            'bp_semester1' => $bp_semester1,
            'bp_semester2' => $bp_semester2,


        ]);
    }
}
