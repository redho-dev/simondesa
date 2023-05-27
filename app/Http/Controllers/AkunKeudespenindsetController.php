<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Asal;
use App\Models\Kecamatan;
use App\Models\Total_apbd;
use App\Models\Nilai_keuangan;
use App\Models\Apbdes_bidang;
use App\Models\Apbdes_kegiatan;
use App\Models\Pengadaan_aset;
use App\Models\Rekap_nilai_indikator;
use App\Models\Rekap_nilai_aspek;
use App\Models\Indikator;
use App\Models\Catatan_keuangan;
use App\Models\Kegiatan_fisik;
use App\Models\Pengadaan_asetnonlapor;
use App\Models\Sub_indikator_keuangan;
use App\Models\Survey;

class AkunKeudespenindsetController extends Controller
{
    public function penIndset(Request $request)
    {

        $tahun = now()->format('Y');
        $infos = Admin::where('id', session('loggedAdminIrbanwil'))->first();
        if ($infos->role == 'admin_sekretariat' || $infos->role == 'admin_irbansus') {
            $asal_id =  Asal::pluck('id')->first();
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

        $penilaian = Nilai_keuangan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 11
        ])->orderBy('sub_indikator_keuangan_id', 'ASC')->get();
        $cekperbaikan = $penilaian->where('perbaikan', true)->first();


        $rekap = Rekap_nilai_indikator::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 11
        ])->first();


        $Subs = Sub_indikator_keuangan::where('indikator_id', 11)->get();

        $catatan = Catatan_keuangan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 11
        ])->first();

        $temuanFisik = Kegiatan_fisik::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->where('catatan_sementara', '!=', '')->get();
        $temuanAset = Pengadaan_aset::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->where('catatan_sementara', '!=', '')->get();
        $temuanNonlapor = Pengadaan_asetnonlapor::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();
        $jumlahTemuan = count($temuanFisik) + count($temuanAset) + count($temuanNonlapor);

        if (!$rekap) {

            return view('adminIrbanwil.formPengadaan.penilaianIndikator_t', [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'jenis' => $request->jenis,
                'tahun' => $tahun,
                'Subs' => $Subs,
                'rekap' => $rekap,
                'cekperbaikan' => $cekperbaikan,
                'temuanFisik' => $temuanFisik,
                'temuanAset' => $temuanAset,
                'temuanNonlapor' => $temuanNonlapor,
                'jumlahTemuan' => $jumlahTemuan

            ]);
        } else {

            return view('adminIrbanwil.formPengadaan.penilaianIndikator_e', [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'jenis' => $request->jenis,
                'tahun' => $tahun,
                'catatan' => $catatan,
                'rekap' => $rekap,
                'Subs' => $Subs,
                'cekperbaikan' => $cekperbaikan,
                'temuanFisik' => $temuanFisik,
                'temuanAset' => $temuanAset,
                'temuanNonlapor' => $temuanNonlapor,
                'jumlahTemuan' => $jumlahTemuan

            ]);
        }
    }

    public function nilaiAkunBarjas(Request $request)
    {

        if (in_array("1",  $request->perbaikan)) {
            return back()->with('fail', 'penilaian sub indikator belum lengkap atau ada perbaikan!');
        }

        $cek = Rekap_nilai_indikator::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id,
        ])->first();

        $nilai = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id
        ])->with('sub_indikator_keuangan')->get();
        $sub = Sub_indikator_keuangan::where([
            'indikator_id' => $request->indikator_id
        ])->with('indikator')->get();
        $jumsub = $sub->count();
        $bobotIndikator = $sub[0]->indikator->bobot;

        $persenIndikator = 0;
        $nilaiIndikator = 0;
        foreach ($nilai as $nl) {
            $bobot = $nl->sub_indikator_keuangan->bobot;
            $nisem = $nl->nilai_sementara;
            $persenData = $nl->persen_data;
            $persenIndikator += $persenData;
            $skor = $nisem * $bobot;
            $nilaiIndikator += $skor;
            Nilai_keuangan::where('id', $nl->id)->update([
                'bobot' => $bobot,
                'skor' => round($skor / 100, 2)
            ]);
        }
        $nilaiIndikator = $nilaiIndikator / 100;
        $skorindikator = ($bobotIndikator / 100) * $nilaiIndikator;
        $persenIndikator = round($persenIndikator / $jumsub, 2);

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id,
            'nilai' => $nilaiIndikator,
            'bobot' => $bobotIndikator,
            'skor' => $skorindikator,
            'persen_data' => $persenIndikator
        ];

        if (!$cek) {

            $insert = Rekap_nilai_indikator::create($data);
        } else {
            Rekap_nilai_indikator::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'indikator_id' => $request->indikator_id
            ])->update([
                'nilai' => $nilaiIndikator,
                'bobot' => $bobotIndikator,
                'skor' => $skorindikator,
                'persen_data' => $persenIndikator
            ]);
        }

        $cekAspek = Rekap_nilai_aspek::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id
        ])->first();

        $nilaiAspek = Rekap_nilai_indikator::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id
        ])->pluck('skor')->sum();

        $Indikator = Indikator::with('aspek')->where('aspek_id', $request->aspek_id)->get();
        $jumIndikator = $Indikator->count();


        $bobotAspek = $Indikator[0]->aspek->bobot;
        $dataAspek = Rekap_nilai_indikator::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id
        ])->pluck('persen_data')->sum();

        $persenDataAspek = round($dataAspek / $jumIndikator, 2);
        $dataAspek = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'bobot' => $bobotAspek,
            'persen_data' => $persenDataAspek,
            'nilai' => $nilaiAspek,
            'skor' => round(($nilaiAspek / 100) * $bobotAspek, 2)

        ];
        if (!$cekAspek) {
            Rekap_nilai_aspek::create($dataAspek);
        } else {
            Rekap_nilai_aspek::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => $request->aspek_id
            ])->update([
                'bobot' => $bobotAspek,
                'persen_data' => $persenDataAspek,
                'nilai' => $nilaiAspek,
                'skor' => round(($nilaiAspek) / 100 * $bobotAspek, 2)
            ]);
        }

        $cekCatatan = Catatan_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'indikator_id' => $request->indikator_id
        ])->first();
        if (!$cekCatatan) {
            Catatan_keuangan::create([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => $request->aspek_id,
                'indikator_id' => $request->indikator_id,
                'catatan_sementara' => $request->catatan_sementara,
                'rekom_sementara' => $request->rekom_sementara,
                'uraian' => $request->uraian

            ]);
        } else {
            Catatan_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'indikator_id' => $request->indikator_id
            ])->update([
                'catatan_sementara' => $request->catatan_sementara,
                'rekom_sementara' => $request->rekom_sementara,
                'uraian' => $request->uraian
            ]);
        }

        return back()->with('success', 'berhasil kirim nilai');
    }
}
