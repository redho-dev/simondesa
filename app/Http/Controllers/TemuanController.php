<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Asal;
use App\Models\Aspek;
use App\Models\Indikator;
use App\Models\Catatan_pemerintahan;
use App\Models\Sub_indikator_pemerintahan;
use App\Models\Kecamatan;
use App\Models\Nilai_pemerintahan;
use App\Models\Dft_pegawai;
use App\Models\Indikator_bumd;
use App\Models\Akunadum;
use App\Models\Akunwil;
use App\Models\Akunkel;
use App\Models\Dokren;
use App\Models\Rpjmd;
use App\Models\Rapbd;
use App\Models\Apbdes_dokumen;
use App\Models\Pelaporan;
use App\Models\Catatan_apbd;
use App\Models\Catatan_keuangan;
use App\Models\Penataanbelanja_spp;
use App\Models\Penataanbelanja_bkp;
use App\Models\Pengadaan_aset;
use App\Models\Penataan_pendapatan;
use App\Models\Penataan_pembiayaan;
use App\Models\Catatan_bumd;
use App\Models\Pengadaan_asetnonlapor;
use App\Models\Kegiatan_fisik;
use App\Models\Akun_pajak;
use App\Models\Uji_petik;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class TemuanController extends Controller
{
    public function index(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $tahun = $request->tahun;
            $request->session()->put('tahun', $request->tahun);
        }
        $infos = Admin::where('id', session('loggedAdminDesa'))->first();
        $asal_id = $infos->asal_id;
        $subi = Sub_indikator_pemerintahan::where('indikator_id', 4)->get();
        $kecamatan = Asal::where([
            'id' => $asal_id
        ])->pluck('kecamatan')->first();
        $request->session()->put('asal_id', $asal_id);
        $aspeks = Aspek::with('indikator', 'sub_indikator_pemerintahan', 'nilai_pemerintahan')->where('id', 1)->get();
        $aspekeu = Aspek::with('indikator', 'sub_indikator_keuangan', 'nilai_keuangan')->where('id', 2)->get();

        $progdata1 = Nilai_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 1
        ])->pluck('persen_data')->avg();
        $catatandataumum = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 1
        ])->pluck('catatan_sementara')->first();
        $sarandataumum = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 1
        ])->pluck('rekom_sementara')->first();
        $catatanadum = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 5
        ])->pluck('catatan_sementara')->first();
        $saranadum = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 5
        ])->pluck('rekom_sementara')->first();
        $adum = Akunadum::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id
        ])->get(['nama_data', 'catatan', 'saran']);

        $catatankewilayahan = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 2
        ])->pluck('catatan_sementara')->first();
        $sarankewilayahan = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 2
        ])->pluck('rekom_sementara')->first();
        $kewilayahan = Akunwil::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id
        ])->get(['nama_data', 'catatan', 'saran']);

        $catatankelembagaan = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 3
        ])->pluck('catatan_sementara')->first();
        $sarankelembagaan = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 3
        ])->pluck('rekom_sementara')->first();
        $kelembagaan = Akunkel::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id
        ])->get(['nama_data', 'catatan', 'saran']);

        $catatandokren = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 4
        ])->pluck('catatan_sementara')->first();
        $sarandokren = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 4
        ])->pluck('rekom_sementara')->first();
        $dokrenrpjmdes = Rpjmd::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
            'nama_data' => 'dokumen_rpjmd'
        ])->get(['catatan', 'saran']);
        $dokren = Dokren::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id
        ])->whereIn('nama_data', ['sk_tim_rkpdes', 'bac_musdus', 'bac_musrenbangdes', 'dokumen_rkpdes', 'tanggal_penetapan_rkpdes'])->get(['nama_data', 'catatan', 'saran']);
        $dokrenrapbd = Rapbd::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id
        ])->whereIn('nama_data', ['dokumen_rapbdes', 'bac', 'keputusan_bpd', 'evaluasi'])->get(['nama_data', 'catatan', 'saran']);
        $dokrenapbd = Apbdes_dokumen::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id
        ])->get();
        $catatanpelaporan = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 6
        ])->pluck('catatan_sementara')->first();
        $saranpelaporan = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 6
        ])->pluck('rekom_sementara')->first();
        $pelaporan = Pelaporan::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id
        ])->get();


        //KEUANGAN DESA
        $apbdesumum = Catatan_apbd::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
            'nama_data' => 'murni'
        ])->pluck('catatan')->first();
        $apbdesumumperubahan = Catatan_apbd::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
            'nama_data' => 'perubahan'
        ])->pluck('catatan')->first();
        $penataanpendapatan = Catatan_keuangan::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
            'indikator_id' => 7,
        ])->get();
        $penataanbelanja = Catatan_keuangan::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
            'indikator_id' => 8,
        ])->get('uraian')->first();

        $totalbkp = Penataanbelanja_bkp::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();
        $pembiayaan = Penataan_pembiayaan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();
        $jumlahSPP = Penataanbelanja_spp::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->pluck('jumlah')->sum();
        $pengeluaranPembiayaan = $pembiayaan->where('pembiayaan_id', '>', 6)->pluck('jumlah')->sum();
        $jumlahbkp = $totalbkp->pluck('jumlah')->sum();

        $totalSPJ = $jumlahbkp + $pengeluaranPembiayaan;
        if (!count($totalbkp)) {
            $belumSPJ = '-';
        } else {
            $belumSPJ = ($jumlahSPP + $pengeluaranPembiayaan) - $totalSPJ;
        }
        $penataanbelanjaspp = Penataanbelanja_spp::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
        ])->get();
        $temuanspp = [];
        foreach ($penataanbelanjaspp as $spp => $val) {
            if ($val->catatan || $val->rekomendasi) {
                array_push($temuanspp, $val);
            }
        }
        $penataanbelanjatbpu = Penataanbelanja_bkp::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
        ])->get();
        $temuantbpu = [];
        foreach ($penataanbelanjatbpu as $tbpu => $val) {
            if ($val->catatan_bkp || $val->rekomendasi_bkp) {
                array_push($temuantbpu, $val);
            }
        }
        $ujipetik = Uji_petik::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
        ])->get()->first();
        $penataanpembiayaan = Catatan_keuangan::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
            'indikator_id' => 9,
        ])->get();
        $kepatuhanpajak = Catatan_keuangan::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
            'indikator_id' => 10,
        ])->get();
        $belumsetor = Penataanbelanja_bkp::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->where(function ($query) {
            $query->where('ppn', '>', 0)->where('billing_ppn', '=', NULL);
            $query->orWhere('pph', '>', 0)->where('billing_pph', '=', NULL);
            $query->orWhere('lainnya', '>', 0)->where('billing_lainnya', '=', NULL);
        })->get();
        $rekon = Akun_pajak::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();
        $tatakelola = Catatan_keuangan::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
            'indikator_id' => 13,
        ])->get();

        $pilfis = Kegiatan_fisik::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();
        $fisik = Kegiatan_fisik::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
        ])->get();
        $pengadaanaset = Pengadaan_aset::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
        ])->get();
        $pengadaanasetnonlapor = Pengadaan_asetnonlapor::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
        ])->get();
        $pengadaanbarjas = Catatan_keuangan::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
            'indikator_id' => 11,
        ])->pluck('uraian')->first();

        $asetdesa = Catatan_keuangan::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
            'indikator_id' => 12,
        ])->get();
        $cttbumdes = Catatan_bumd::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
        ])->get();
        return view('adminDesa.beranda.catatan_temuan', [
            'infos' => $infos,
            'desa' => $infos->name,
            'kecamatan' => $kecamatan,
            'tahun' => $tahun,
            'subi' => $subi,
            'aspeks' => $aspeks,
            'aspekeu' => $aspekeu,
            'asal_id' => session()->get('asal_id'),
            'catatandataumum' => $catatandataumum,
            'sarandataumum' => $sarandataumum,
            'catatankewilayahan' => $catatankewilayahan,
            'catatanadum' => $catatanadum,
            'saranadum' => $saranadum,
            'adum' => $adum,
            'catatankewilayahan' => $catatankewilayahan,
            'sarankewilayahan' => $sarankewilayahan,
            'kewilayahan' => $kewilayahan,
            'catatankelembagaan' => $catatankelembagaan,
            'sarankelembagaan' => $sarankelembagaan,
            'kelembagaan' => $kelembagaan,
            'dokrenrpjmdes' => $dokrenrpjmdes,
            'catatandokren' => $catatandokren,
            'sarandokren' => $sarandokren,
            'dokren' => $dokren,
            'dokrenrapbd' => $dokrenrapbd,
            'dokrenapbd' => $dokrenapbd,
            'catatanpelaporan' => $catatanpelaporan,
            'saranpelaporan' => $saranpelaporan,
            'pelaporan' => $pelaporan,
            'apbdesumum' => $apbdesumum,
            'apbdesumumperubahan' => $apbdesumumperubahan,
            'penataanpendapatan' => $penataanpendapatan,
            'penataanbelanja' => $penataanbelanja,
            'penataanbelanjaspp' => $temuanspp,
            'penataanbelanjatbpu' => $temuantbpu,
            'ujipetik' => $ujipetik,
            'penataanpembiayaan' => $penataanpembiayaan,
            'kepatuhanpajak' => $kepatuhanpajak,
            'belumSPJ' => $belumSPJ,
            'belumsetor' => $belumsetor,
            'rekon' => $rekon,
            'tatakelola' => $tatakelola,
            'pilfis' => $pilfis,
            'fisik' => $fisik,
            'pengadaanaset' => $pengadaanaset,
            'pengadaanasetnonlapor' => $pengadaanasetnonlapor,
            'pengadaanbarjas' => $pengadaanbarjas,
            'asetdesa' => $asetdesa,
            'cttbumdes' => $cttbumdes,
        ]);
    }
}
