<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Aspek;
use App\Models\Indikator_bumd;
use App\Models\Nilai_bumd;
use App\Models\Nilai_keuangan;
use App\Models\Nilai_pemerintahan;
use App\Models\Rekap_nilai_aspek;
use App\Models\Rekap_nilai_indikator;
use Illuminate\Http\Request;

class AkuntabilitasController extends Controller
{
    public function nilai_akun(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();

        $rekapAspek = Rekap_nilai_aspek::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();

        if (count($rekapAspek) > 0) {
            $akuntabilitas = $rekapAspek->pluck('skor')->sum();
            $nilaiPemdes = round($rekapAspek->where('aspek_id', 1)->pluck('nilai')->first());
            $skorPemdes = $rekapAspek->where('aspek_id', 1)->pluck('skor')->first();
            $nilaiKeudes = $rekapAspek->where('aspek_id', 2)->pluck('nilai')->first();
            $skorKeudes = $rekapAspek->where('aspek_id', 2)->pluck('skor')->first();
        } else {
            $akuntabilitas = 0;
            $nilaiPemdes = 0;
            $skorPemdes = 0;
            $nilaiKeudes = 0;
            $skorKeudes = 0;
        }
        $rekapBumdes = Nilai_bumd::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();
        $akunBumdes = $rekapBumdes->pluck('skor')->sum();
        $indikatorBumdes = Indikator_bumd::where('tahun', $tahun)->get();

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();
        $akun = $request->akun;
        return view('adminDesa.progress.nilaiAkun', [
            'tahun' => $tahun,
            'infos' => $infos,
            'akuntabilitas' => $akuntabilitas,
            'nilaiPemdes' => $nilaiPemdes,
            'skorPemdes' => $skorPemdes,
            'nilaiKeudes' => $nilaiKeudes,
            'skorKeudes' => $skorKeudes,
            'akunBumdes' => $akunBumdes,
            'indikatorBumdes' => $indikatorBumdes,
            'akun' => $akun

        ]);
    }
}
