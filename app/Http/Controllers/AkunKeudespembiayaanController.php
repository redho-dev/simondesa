<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

use App\Models\Asal;
use App\Models\Kecamatan;
use App\Models\Apbdes_pembiayaan;
use App\Models\Total_apbd;
use App\Models\Penataan_pembiayaan;
use App\Models\Nilai_keuangan;
use App\Models\Catatan_keuangan;
use App\Models\Sub_indikator_keuangan;
use App\Models\Indikator;
use App\Models\Rekap_nilai_aspek;
use App\Models\Rekap_nilai_indikator;



class AkunKeudespembiayaanController extends Controller
{
    public function pembiayaan(Request $request)
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
            'indikator_id' => 9,
        ])->where('nilai_sementara', '!=', NULL)->get();

        $datnil = Nilai_keuangan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 9,
        ])->orderBy('sub_indikator_keuangan_id', 'asc')->get();



        $perbaikan = $datnil->where('perbaikan', true)->first();

        $catatan = Catatan_keuangan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 9
        ])->first();

        $rekap = [];
        $pembiayaan = Apbdes_pembiayaan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();

        $penataan = Penataan_pembiayaan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();

        $data = [
            'desa' => $desa,
            'infos' => $infos,
            'asal_id' => $asal_id,
            'kecamatan' => $kecamatan,
            'deswal' => $deswal,
            'jenis' => $request->jenis,
            'tahun' => $tahun,
            'perbaikan' => $perbaikan,
            'penilaian' => count($penilaian),
            'pembiayaan' => $pembiayaan,
            'datnil' => $datnil

        ];
        $data['penerimaan'] = $penataan->where('pembiayaan_id', '>', 1)->where('pembiayaan_id', '<', 6);
        $data['pengeluaran'] = $penataan->where('pembiayaan_id', '>', 6);


        if (isset($request->jenis)) {

            $data['total_p'] = Total_apbd::where([
                'asal_id' => $asal_id,
                'tahun' => $tahun
            ])->where('pembiayaan_murni', '!=', NULL)->first();

            if (!$data['total_p']) {
                return back()->with('fail', 'Belum ada input pembiayaan di APBDes');
            }

            if ($data['total_p']->pembiayaan_perubahan != NULL) {
                $data['anggaran'] = 'perubahan';
            } else {
                $data['anggaran'] = 'murni';
            }


            if ($request->jenis == 'penerimaan') {
                $datum = $penataan->where('pembiayaan_id', '>', 1)->where('pembiayaan_id', '<', 6);
                $data['penPemb'] = $pembiayaan->where('pembiayaan_id', '>', 1)->where('pembiayaan_id', '<', 6);
                $data['anggaranPen'] = $pembiayaan->where('pembiayaan_id', 1)->first();
                $data['realisasi'] = $datum->pluck('jumlah')->sum();
            } elseif ($request->jenis == 'pengeluaran') {
                $datum = $penataan->where('pembiayaan_id', '>', 6);
                $data['pengPemb'] = $pembiayaan->where('pembiayaan_id', '>', 6);
                $data['anggaranPeng'] = $pembiayaan->where('pembiayaan_id', 6)->first();
                $data['realisasi'] = $datum->pluck('jumlah')->sum();
            } elseif ($request->jenis == 'penilaian') {
                $datum = $penilaian;
                $data['anggaranPen'] = $pembiayaan->where('pembiayaan_id', 1)->first();
                $data['anggaranPeng'] = $pembiayaan->where('pembiayaan_id', 6)->first();
                $data['datnilPen'] = $datnil->where('sub_indikator_keuangan_id', 7)->first();
                $data['datnilPeng'] = $datnil->where('sub_indikator_keuangan_id', 8)->first();
                $data['catatan'] = $catatan;
                $data['rekap'] = Rekap_nilai_indikator::where([
                    'asal_id' => $asal_id,
                    'tahun' => $tahun,
                    'indikator_id' => 9
                ])->first();
            }


            if (count($datum) == 0) {

                return view('adminIrbanwil.pembiayaan.formPembiayaan_t', $data);
            } else {

                return view('adminIrbanwil.pembiayaan.formPembiayaan_e', $data);
            }
        } else {

            return view('adminIrbanwil.pembiayaan.formPembiayaan', $data);
        }
    }

    public function nilaiAkunpembiayaan(Request $request)
    {

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id
        ];


        $i = 7;
        foreach ($request->sub_indikator_keuangan_id as $sub) {
            $cek = Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_keuangan_id' => $i
            ])->first();
            if (!$cek) {
                $data["sub_indikator_keuangan_id"] = $i;
                $data["perbaikan"] = false;
                $data["nilai_sementara"] = $request->nilai[$i - 7];
                $aksi = Nilai_keuangan::create($data);
            } else {

                $ubah = Nilai_keuangan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => $request->aspek_id,
                    'indikator_id' => $request->indikator_id,
                    'sub_indikator_keuangan_id' => $i
                ])->update([
                    'nilai_sementara' => $request->nilai[$i - 7],
                    'perbaikan' => false
                ]);
            }

            $i++;
        }

        if ($request->persen_data_pen) {
            Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_keuangan_id' => 7
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100
            ]);
        }
        if ($request->persen_data_peng) {
            Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_keuangan_id' => 8
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100
            ]);
        }




        unset($data['sub_indikator_keuangan_id']);
        unset($data['nilai_sementara']);
        unset($data['perbaikan']);
        $data['catatan_sementara'] = $request->catatan_sementara;
        $data['rekom_sementara'] = $request->rekom_sementara;
        $data['uraian'] = $request->uraian;
        Catatan_keuangan::create($data);


        return $this->rekap($request);
    }

    public function nilaiAkunpembiayaanUpdate(Request $request)
    {

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id
        ];


        $i = 7;
        foreach ($request->sub_indikator_keuangan_id as $sub) {
            $cek = Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_keuangan_id' => $i
            ])->first();
            if (!$cek) {
                $data["sub_indikator_keuangan_id"] = $i;
                $data["perbaikan"] = false;
                $data["nilai_sementara"] = $request->nilai[$i - 7];
                $aksi = Nilai_keuangan::create($data);
            } else {

                Nilai_keuangan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => $request->aspek_id,
                    'indikator_id' => $request->indikator_id,
                    'sub_indikator_keuangan_id' => $i
                ])->update([
                    'nilai_sementara' => $request->nilai[$i - 7],
                    'perbaikan' => false
                ]);
            }

            $i++;
        }



        Catatan_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'indikator_id' => $request->indikator_id
        ])->update([
            'catatan_sementara' => $request->catatan_sementara,
            'rekom_sementara' => $request->rekom_sementara,
            'uraian' => $request->uraian
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
