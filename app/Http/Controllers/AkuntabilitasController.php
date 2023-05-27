<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Aspek;
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

        $akuntabilitas = $rekapAspek->pluck('skor')->sum();
        $nilaiPemdes = $rekapAspek->where('aspek_id', 1)->pluck('nilai')->first();
        $skorPemdes = $rekapAspek->where('aspek_id', 1)->pluck('skor')->first();

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();

        return view('adminDesa.progress.nilaiAkun', [
            'tahun' => $tahun,
            'infos' => $infos,
            'akuntabilitas' => $akuntabilitas,
            'nilaiPemdes' => $nilaiPemdes,
            'skorPemdes' => $skorPemdes,

        ]);
    }
}
