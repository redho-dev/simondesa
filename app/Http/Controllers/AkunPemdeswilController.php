<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Asal;
use App\Models\Datum;
use App\Models\Akunwil;
use App\Models\Kecamatan;
use App\Models\Rekap_nilai_indikator;
use App\Models\Sub_indikator_pemerintahan;
use App\Models\Rekap_nilai_aspek;
use App\Models\Indikator;

use App\Models\Catatan_pemerintahan;
use App\Models\Nilai_pemerintahan;


use Illuminate\Http\Request;

class AkunPemdeswilController extends Controller
{
    public function kewilayahan(Request $request)
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

        $akunwil = Akunwil::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();

        $dawil = Datum::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'jenis' => 'kewilayahan'
        ])->get();
        $dasarhukum = $dawil->where('nama_data', 'dasar_hukum')->pluck('isidata')->first();
        $batasutara = $dawil->where('nama_data', 'batas_utara')->pluck('isidata')->first();
        $batasselatan = $dawil->where('nama_data', 'batas_selatan')->pluck('isidata')->first();
        $batastimur = $dawil->where('nama_data', 'batas_timur')->pluck('isidata')->first();
        $batasbarat = $dawil->where('nama_data', 'batas_barat')->pluck('isidata')->first();


        $penilaian = Nilai_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 2
        ])->where('nilai_sementara', '!=', NULL)->get();


        $datnil = Nilai_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 2
        ])->get();

        $catatan = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 2
        ])->first();

        $perbaikan = $datnil->where('perbaikan', true)->first();

        if (isset($request->jenis)) {
            if ($request->jenis == 'penilaian') {
                $data = $penilaian;
                $rekap = Rekap_nilai_indikator::where([
                    'asal_id' => $asal_id,
                    'tahun' => $tahun,
                    'indikator_id' => 2
                ])->first();
            } else {
                $data = $akunwil;
                $rekap = [];
            }

            $datum = count($data);
            if ($datum == 0) {
                return view('adminIrbanwil.formWil.akunPemdeswil', [
                    'desa' => $desa,
                    'asal_id' => $asal_id,
                    'infos' => $infos,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'akunwil' => count($akunwil),
                    'penilaian' => count($penilaian),
                    'datnil' => $datnil,
                    'kecamatan' => $kecamatan,
                    'deswal' => $deswal,
                    'perbaikan' => $perbaikan
                ]);
            } else {

                return view('adminIrbanwil.formWil.akunPemdeswil_e', [
                    'desa' => $desa,
                    'asal_id' => $asal_id,
                    'infos' => $infos,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'data' => $data,
                    'dawil' => $dawil,
                    'datnil' => $datnil,
                    'akunwil' => count($akunwil),
                    'penilaian' => count($penilaian),
                    'catatan' => $catatan,
                    'kecamatan' => $kecamatan,
                    'deswal' => $deswal,
                    'perbaikan' => $perbaikan,
                    'rekap' => $rekap


                ]);
            }
        } else {

            return view('adminIrbanwil.formWil.akunPemdeswil', [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'jenis' => '',
                'tahun' => $tahun,
                'penilaian' => count($penilaian),
                'akunwil' => count($akunwil),
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'perbaikan' => $perbaikan
            ]);
        }
    }

    public function nilaiAkunwil(Request $request)
    {


        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id
        ];


        $i = 6;
        foreach ($request->sub_indikator_pemerintahan_id as $sub) {
            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => $i
            ])->first();
            if (!$cek) {
                $data["sub_indikator_pemerintahan_id"] = $i;
                $data["perbaikan"] = false;
                $data["nilai_sementara"] = $request->nilai[$i - 6];
                $aksi = Nilai_pemerintahan::create($data);
            } else {

                $ubah = Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => $request->aspek_id,
                    'indikator_id' => $request->indikator_id,
                    'sub_indikator_pemerintahan_id' => $i
                ])->update([
                    'nilai_sementara' => $request->nilai[$i - 6],
                    'perbaikan' => false
                ]);
            }

            $i++;
        }

        unset($data['sub_indikator_pemerintahan_id']);
        unset($data['nilai_sementara']);
        unset($data['perbaikan']);
        $data['catatan_sementara'] = $request->catatan_sementara;
        $data['rekom_sementara'] = $request->rekom_sementara;
        Catatan_pemerintahan::create($data);

        return $this->rekap($request);
    }

    public function tamcaWil(Request $request)
    {
        Akunwil::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'nama_data' => $request->nama_data
        ])->update([
            'catatan' => $request->catatan,
            'saran' => $request->saran
        ]);
        return back()->with('success', 'berhasil kirim catatan dan saran');
    }

    public function nilaiAkunwilEdit(Request $request)
    {

        Catatan_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id
        ])->update([
            'catatan_sementara' => $request->catatan_sementara,
            'rekom_sementara' => $request->rekom_sementara
        ]);

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id
        ];
        $i = 6;
        foreach ($request->sub_indikator_pemerintahan_id as $sub) {
            $aksi = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => $request->aspek_id,
                'indikator_id' => $request->indikator_id,
                'sub_indikator_pemerintahan_id' => $i
            ])->update([
                'nilai_sementara' => $request->nilai[$i - 6],
                'perbaikan' => false
            ]);
            $i++;
        }

        if ($aksi) {
            return $this->rekap($request);
        }
    }

    public function rekap($request)
    {

        $cek = Rekap_nilai_indikator::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id
        ])->first();

        $nilai = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id
        ])->with('sub_indikator_pemerintahan')->get();
        $sub = Sub_indikator_pemerintahan::where([
            'indikator_id' => $request->indikator_id
        ])->with('indikator')->get();
        $jumsub = $sub->count();
        $bobotIndikator = $sub[0]->indikator->bobot;

        $persenIndikator = 0;
        $nilaiIndikator = 0;
        foreach ($nilai as $nl) {
            $bobot = $nl->sub_indikator_pemerintahan->bobot;
            $nisem = $nl->nilai_sementara;
            $persenData = $nl->persen_data;
            $persenIndikator += $persenData;
            $skor = $nisem * $bobot;
            $nilaiIndikator += $skor;
            Nilai_pemerintahan::where('id', $nl->id)->update([
                'bobot' => $bobot,
                'skor' => round($skor / 100, 2)
            ]);
        }
        $nilaiIndikator = $nilaiIndikator / 100;
        $skorindikator = ($bobotIndikator / 100) * $nilaiIndikator;
        $persenIndikator = round($persenIndikator / $jumsub, 2);

        $data = [
            'asal_id' => $request->asal_id,
            'aspek_id' => $request->aspek_id,
            'tahun' => $request->tahun,
            'indikator_id' => $request->indikator_id,
            'nilai' => $nilaiIndikator,
            'bobot' => $bobotIndikator,
            'skor' => $skorindikator,
            'persen_data' => $persenIndikator
        ];

        if (!$cek) {
            Rekap_nilai_indikator::create($data);
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
            'skor' => round($nilaiAspek * ($bobotAspek / 100), 2)

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
                'skor' => round($nilaiAspek / 100 * $bobotAspek, 2)
            ]);
        }


        if ($request->table) {
            $url = url()->previous();
            $url = str_replace('?', '', $url);
            $table = $request->table;
            $request->session()->put('table', $table);
            return redirect($url . "?#" . $table)->with('success', 'berhasil kirim nilai');
        } else {
            return back()->with('success', 'berhasil kirim nilai');
        }
    }
}
