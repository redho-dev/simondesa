<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Asal;
use App\Models\Kecamatan;
use App\Models\Pelaporan;

use App\Models\Catatan_pemerintahan;
use App\Models\Nilai_pemerintahan;
use App\Models\Indikator;
use App\Models\Rekap_nilai_aspek;
use App\Models\Rekap_nilai_indikator;
use App\Models\Sub_indikator_pemerintahan;
use Illuminate\Http\Request;


class AkunPemdespelaporanController extends Controller
{
    public function pelaporan(Request $request)
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


        $pelaporan = Pelaporan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->get();


        $penilaian = Nilai_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 6
        ])->where('nilai_sementara', '!=', NULL)->get();


        $datnil = Nilai_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 6
        ])->orderBy('sub_indikator_pemerintahan_id', 'ASC')->get();


        $catatan = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 6
        ])->first();

        $perbaikan = $datnil->where('perbaikan', true)->first();

        $subpem = Sub_indikator_pemerintahan::where('indikator_id', 6)->get();
        $nipem = Nilai_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 6
        ])->get();


        if (isset($request->jenis)) {
            if ($request->jenis == 'penilaian') {
                $data = $penilaian;
            } else {
                $data = $pelaporan;
            }

            if (count($data) == 0) {

                return view('adminIrbanwil.formPelaporan.akunPemdespelaporan', [
                    'desa' => $desa,
                    'infos' => $infos,
                    'asal_id' => $asal_id,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'penilaian' => count($penilaian),
                    'datnil' => $datnil,
                    'pelaporan' => count($pelaporan),
                    'kecamatan' => $kecamatan,
                    'deswal' => $deswal,
                    'perbaikan' => $perbaikan,
                    'nipem' => $nipem,
                    'subpem' => $subpem
                ]);
            } else {
                if ($request->jenis == 'penilaian') {
                    $rekap = Rekap_nilai_indikator::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun,
                        'indikator_id' => 6
                    ])->first();
                } else {
                    $rekap = [];
                }
                $dalap = [
                    'lppd' => $pelaporan->where('nama_data', 'lppd')->first(),
                    'lkpd' => $pelaporan->where('nama_data', 'lkpd')->first(),
                    'perdes_pj' => $pelaporan->where('nama_data', 'perdes_pj')->first(),
                    'lra_1' => $pelaporan->where('nama_data', 'lra_1')->first(),
                    'lra_2' => $pelaporan->where('nama_data', 'lra_2')->first()
                ];
                return view('adminIrbanwil.formPelaporan.akunPemdespelaporan_e', [
                    'desa' => $desa,
                    'asal_id' => $asal_id,
                    'infos' => $infos,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'data' => $data,
                    'dalap' => $dalap,
                    'dawil' => $pelaporan,
                    'datnil' => $datnil,
                    'nipem' => $nipem,
                    'pelaporan' => count($pelaporan),
                    'penilaian' => count($penilaian),
                    'catatan' => $catatan,
                    'kecamatan' => $kecamatan,
                    'deswal' => $deswal,
                    'perbaikan' => $perbaikan,
                    'rekap' => $rekap,
                    'nipem' => $nipem,
                    'subpem' => $subpem

                ]);
            }
        } else {


            return view('adminIrbanwil.formPelaporan.akunPemdespelaporan', [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'jenis' => '',
                'tahun' => $tahun,
                'penilaian' => count($penilaian),
                'pelaporan' => count($pelaporan),
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'perbaikan' => $perbaikan
            ]);
        }
    }

    public function nilaiAkunpelaporan(Request $request)
    {


        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id
        ];


        $i = 39;
        foreach ($request->sub_indikator_pemerintahan_id as $sub) {
            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => $i
            ])->first();
            if (!$cek) {
                $data["sub_indikator_pemerintahan_id"] = $i;
                $data["perbaikan"] = false;
                $data["nilai_sementara"] = $request->nilai[$i - 39];
                $aksi = Nilai_pemerintahan::create($data);
            } else {

                $ubah = Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => $request->aspek_id,
                    'indikator_id' => $request->indikator_id,
                    'sub_indikator_pemerintahan_id' => $i
                ])->update([
                    'nilai_sementara' => $request->nilai[$i - 39],
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

    public function tamcaPel(Request $request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'nama_data' => $request->nama_data
        ];
        Pelaporan::where($data)->update([
            'catatan' => $request->catatan,
            'saran' => $request->saran
        ]);
        return back()->with('success', 'berhasil tambah catatan dan saran');
    }


    public function nilaiAkunpelaporanEdit(Request $request)
    {


        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id
        ];


        $i = 39;
        foreach ($request->sub_indikator_pemerintahan_id as $sub) {
            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => $i
            ])->first();
            if (!$cek) {
                $data["sub_indikator_pemerintahan_id"] = $i;
                $data["perbaikan"] = false;
                $data["nilai_sementara"] = $request->nilai[$i - 39];
                $aksi = Nilai_pemerintahan::create($data);
            } else {

                $ubah = Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => $request->aspek_id,
                    'indikator_id' => $request->indikator_id,
                    'sub_indikator_pemerintahan_id' => $i
                ])->update([
                    'nilai_sementara' => $request->nilai[$i - 39],
                    'perbaikan' => false
                ]);
            }

            $i++;
        }


        Catatan_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id
        ])->update([
            'catatan_sementara' => $request->catatan_sementara,
            'rekom_sementara' => $request->rekom_sementara
        ]);

        return $this->rekap($request);
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
            'skor' => round($nilaiAspek * $bobotAspek, 2)

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
