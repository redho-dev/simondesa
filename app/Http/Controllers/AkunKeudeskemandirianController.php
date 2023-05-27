<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use App\Models\Asal;
use App\Models\Catatan_keuangan;
use App\Models\Kecamatan;
use App\Models\Kemandirian;
use App\Models\Nilai_keuangan;
use App\Models\Rekap_nilai_indikator;
use App\Models\Rekap_nilai_aspek;
use App\Models\Indikator;
use App\Models\Sub_indikator_keuangan;

class AkunKeudeskemandirianController extends Controller
{
    public function kemandirian(Request $request)
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

        $kemandirian = Kemandirian::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();

        $sertifikat = $kemandirian->where('jenis', 'sertifikat')->first();

        $pernyataan =  $kemandirian->where('jenis', 'pernyataan')->first();
        $hasil =  $kemandirian->where('jenis', 'hasil')->first();

        $rekap = Rekap_nilai_indikator::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 13
        ])->first();
        $datnil = Nilai_keuangan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 13
        ])->get();
        $datnilPernyataan = $datnil->where('sub_indikator_keuangan_id', 20)->first();
        $datnilSertifikat = $datnil->where('sub_indikator_keuangan_id', 21)->first();
        $datnilHasil = $datnil->where('sub_indikator_keuangan_id', 22)->first();

        $catatan = Catatan_keuangan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 13
        ])->first();
        $perbaikan = Nilai_keuangan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 13,
            'perbaikan' => true
        ])->first();

        if ($request->jenis) {

            return view('adminIrbanwil.kemandirian.formKemandirian_e', [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'jenis' => $request->jenis,
                'tahun' => $tahun,
                'pernyataan' => $pernyataan,
                'sertifikat' => $sertifikat,
                'hasil' => $hasil,
                'rekap' => $rekap,
                'datnilPernyataan' => $datnilPernyataan,
                'datnilSertifikat' => $datnilSertifikat,
                'datnilHasil' => $datnilHasil,
                'catatan' => $catatan,
                'perbaikan' => $perbaikan

            ]);
        } else {
            return view('adminIrbanwil.kemandirian.formKemandirian', [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'jenis' => $request->jenis,
                'tahun' => $tahun,
                'pernyataan' => $pernyataan,
                'sertifikat' => $sertifikat,
                'hasil' => $hasil,
                'rekap' => $rekap,
                'perbaikan' => $perbaikan
            ]);
        }
    }


    public function ujiSiskeudes(Request $request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'jenis' => 'hasil',
            'data' => strip_tags($request->data),
            'tanggal_pengujian' => strip_tags($request->tanggal_pengujian),
            'nama' => strip_tags($request->nama)
        ];

        Kemandirian::create($data);
        Nilai_keuangan::create([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => 2,
            'indikator_id' => 13,
            'sub_indikator_keuangan_id' => 22,
            'jumlah_data' => 1,
            'persen_data' => 100,
            'nilai_sementara' => strip_tags($request->data),
            'perbaikan' => true
        ]);
        return back()->with('success', 'berhasil kirim data');
    }
    public function ujiSiskeudesUpdate(Request $request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'jenis' => 'hasil',
            'data' => strip_tags($request->data),
            'tanggal_pengujian' => strip_tags($request->tanggal_pengujian),
            'nama' => strip_tags($request->nama)
        ];
        Kemandirian::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'jenis' => 'hasil'
        ])->update($data);

        Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => 2,
            'indikator_id' => 13,
            'sub_indikator_keuangan_id' => 22
        ])->update([
            'jumlah_data' => 1,
            'persen_data' => 100,
            'nilai_sementara' => strip_tags($request->data),
            'perbaikan' => true
        ]);

        return back()->with('success', 'berhasil update data');
    }

    public function nilaiAkunKemandirian(Request $request)
    {
        $i = 20;
        foreach ($request->sub_indikator_keuangan_id as $sub) {
            $cek = Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_keuangan_id' => $i
            ])->first();
            if (!$cek) {
                Nilai_keuangan::create([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 2,
                    'indikator_id' => 13,
                    'sub_indikator_keuangan_id' => $i,
                    'jumlah_data' => 1,
                    'persen_data' => 100,
                    'nilai_sementara' => $request->nilai[$i - 20],
                    'perbaikan' => false
                ]);
            } else {
                Nilai_keuangan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 2,
                    'indikator_id' => 13,
                    'sub_indikator_keuangan_id' => $i
                ])->update([
                    'jumlah_data' => 1,
                    'persen_data' => 100,
                    'nilai_sementara' => $request->nilai[$i - 20],
                    'perbaikan' => false
                ]);
            }

            $i++;
        }

        Catatan_keuangan::create([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => 2,
            'indikator_id' => 13,
            'uraian' => $request->uraian,
            'catatan_sementara' => $request->catatan_sementara,
            'rekom_sementara' => $request->rekom_sementara
        ]);

        return $this->rekap($request);
    }

    public function nilaiAkunKemandirianUpdate(Request $request)
    {
        $i = 20;
        foreach ($request->sub_indikator_keuangan_id as $sub) {
            $cek = Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_keuangan_id' => $i
            ])->first();
            if (!$cek) {
                Nilai_keuangan::create([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 2,
                    'indikator_id' => 13,
                    'sub_indikator_keuangan_id' => $i,
                    'jumlah_data' => 1,
                    'persen_data' => 100,
                    'nilai_sementara' => $request->nilai[$i - 20],
                    'perbaikan' => false
                ]);
            } else {
                Nilai_keuangan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 2,
                    'indikator_id' => 13,
                    'sub_indikator_keuangan_id' => $i
                ])->update([
                    'jumlah_data' => 1,
                    'persen_data' => 100,
                    'nilai_sementara' => $request->nilai[$i - 20],
                    'perbaikan' => false
                ]);
            }

            $i++;
        }

        Catatan_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => 2,
            'indikator_id' => 13
        ])->update([
            'uraian' => $request->uraian,
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
            'skor' => round($nilaiAspek / 100 * $bobotAspek, 2)

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


        return back()->with('success', 'berhasil kirim nilai');
    }
}
