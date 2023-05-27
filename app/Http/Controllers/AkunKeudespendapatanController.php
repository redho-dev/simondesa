<?php

namespace App\Http\Controllers;

use App\Models\Admin;

use App\Models\Asal;
use App\Models\Kecamatan;
use App\Models\Apbdes_pendapatan;
use App\Models\Apbdes_kegiatan;
use App\Models\Total_apbd;
use App\Models\Penataan_pendapatan;
use App\Models\Buku_pembantu_bank;
use App\Models\Nilai_keuangan;
use App\Models\Catatan_keuangan;
use App\Models\Sub_indikator_keuangan;
use App\Models\Indikator;
use App\Models\Rekap_nilai_aspek;
use App\Models\Rekap_nilai_indikator;


use Illuminate\Http\Request;

class AkunKeudespendapatanController extends Controller
{

    public function pendapatan(Request $request)
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

        $pengajuan = Penataan_pendapatan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->get();

        $bukuBank = Buku_pembantu_bank::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->get();

        $penilaian = Nilai_keuangan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 7,
        ])->where('nilai_sementara', '!=', NULL)->get();

        $datnil = Nilai_keuangan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 7,
        ])->orderBy('sub_indikator_keuangan_id', 'asc')->get();
        $datnilPengajuan = $datnil->where('sub_indikator_keuangan_id', 1)->first();
        $datnilBank = $datnil->where('sub_indikator_keuangan_id', 2)->first();

        $perbaikan = $datnil->where('perbaikan', true)->first();

        $catatan = Catatan_keuangan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 7
        ])->first();

        $rekap = [];

        if (isset($request->jenis)) {
            if ($request->jenis == 'pengajuan' || $request->jenis == 'cek_pengajuan') {
                $datum = $pengajuan;
            } elseif ($request->jenis == 'buku_pembantu_bank') {
                $datum = $bukuBank;
            } elseif ($request->jenis == 'penilaian') {
                $datum = $penilaian;
                $rekap = Rekap_nilai_indikator::where([
                    'asal_id' => $asal_id,
                    'tahun' => $tahun,
                    'indikator_id' => 7
                ])->first();
            }
            if (count($datum) == 0) {

                return view('adminIrbanwil.pendapatan.formPendapatan', [
                    'desa' => $desa,
                    'infos' => $infos,
                    'asal_id' => $asal_id,
                    'kecamatan' => $kecamatan,
                    'deswal' => $deswal,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'pengajuan' => count($pengajuan),
                    'bukuBank' => count($bukuBank),
                    'penilaian' => count($penilaian),
                    'datnil' => $datnil,
                    'datnilPengajuan' => $datnilPengajuan,
                    'datnilBank' => $datnilBank,
                    'perbaikan' => $perbaikan
                ]);
            } elseif (count($datum) > 0) {
                $data = [
                    'desa' => $desa,
                    'infos' => $infos,
                    'asal_id' => $asal_id,
                    'kecamatan' => $kecamatan,
                    'deswal' => $deswal,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'pengajuan' => count($pengajuan),
                    'bukuBank' => count($bukuBank),
                    'penilaian' => count($penilaian),
                    'datnil' => $datnil,
                    'datnilPengajuan' => $datnilPengajuan,
                    'datnilBank' => $datnilBank,
                    'catatan' => $catatan,
                    'rekap' => $rekap,
                    'perbaikan' => $perbaikan
                ];

                if ($request->jenis == 'pengajuan' || $request->jenis == 'cek_pengajuan') {

                    $data['pendapatans'] = Apbdes_pendapatan::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun,
                    ])->get();
                    $data['total_p'] = Total_apbd::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun
                    ])->first();
                    if (!$data['total_p']) {
                        return back()->with('dok', 'Silahkan Isi Data APBDes Terlebih Dahulu!');
                    }
                    if ($data['total_p']->belanja_perubahan != NULL) {
                        $data['anggaran'] = 'perubahan';
                    } else {
                        $data['anggaran'] = 'murni';
                    }
                } elseif ($request->jenis == 'buku_pembantu_bank') {
                    $bukubank = Buku_pembantu_bank::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun
                    ])->get();
                    $data['semester_1'] = $bukubank->where('nama_data', 'semester_1')->first();
                    $data['semester_2'] = $bukubank->where('nama_data', 'semester_2')->first();
                }
                if ($request->pendapatan) {
                    $jenpend = Apbdes_pendapatan::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun,
                        'id' => $request->pendapatan
                    ])->first();

                    $data['jenpend'] = $jenpend;
                    $data['nampend'] = $jenpend->jenis_pendapatan;
                    $data['pendapatan_id'] = $jenpend->pendapatan_id;
                }

                return view('adminIrbanwil.pendapatan.formPendapatan_e', $data);
            }
        } else {

            return view('adminIrbanwil.pendapatan.formPendapatan', [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'jenis' => '',
                'tahun' => $tahun,
                'pengajuan' => count($pengajuan),
                'bukuBank' => count($bukuBank),
                'penilaian' => count($penilaian),
                'perbaikan' => $perbaikan
            ]);
        }
    }

    public function nilaiPendapatan(Request $request)
    {


        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id
        ];


        if ($request->sub_indikator_keuangan_id) {
            $i = 1;
            foreach ($request->sub_indikator_keuangan_id as $sub) {
                $cek = Nilai_keuangan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_keuangan_id' => $i
                ])->first();
                if (!$cek) {
                    $data["sub_indikator_keuangan_id"] = $i;
                    $data["perbaikan"] = false;
                    $data["nilai_sementara"] = $request->nilai[$i - 1];
                    $aksi = Nilai_keuangan::create($data);
                } else {

                    $ubah = Nilai_keuangan::where([
                        'asal_id' => $request->asal_id,
                        'tahun' => $request->tahun,
                        'aspek_id' => $request->aspek_id,
                        'indikator_id' => $request->indikator_id,
                        'sub_indikator_keuangan_id' => $i
                    ])->update([
                        'nilai_sementara' => $request->nilai[$i - 1],
                        'perbaikan' => false
                    ]);
                }

                $i++;
            }

            Penataan_pendapatan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'perbaikan' => 1
            ])->update([
                'perbaikan' => 0
            ]);
            Buku_pembantu_bank::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'perbaikan' => 1
            ])->update([
                'perbaikan' => 0
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


    public function nilaiPendapatanEdit(Request $request)
    {


        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id
        ];

        if ($request->sub_indikator_keuangan_id) {

            $i = 1;
            foreach ($request->sub_indikator_keuangan_id as $sub) {
                $cek = Nilai_keuangan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_keuangan_id' => $i
                ])->first();
                if (!$cek) {
                    $data["sub_indikator_keuangan_id"] = $i;
                    $data["perbaikan"] = false;
                    $data["nilai_sementara"] = $request->nilai[$i - 1];
                    $aksi = Nilai_keuangan::create($data);
                } else {

                    $ubah = Nilai_keuangan::where([
                        'asal_id' => $request->asal_id,
                        'tahun' => $request->tahun,
                        'aspek_id' => $request->aspek_id,
                        'indikator_id' => $request->indikator_id,
                        'sub_indikator_keuangan_id' => $i
                    ])->update([
                        'nilai_sementara' => $request->nilai[$i - 1],
                        'perbaikan' => false
                    ]);
                }

                $i++;
            }

            Penataan_pendapatan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'perbaikan' => 1
            ])->update([
                'perbaikan' => 0
            ]);
            Buku_pembantu_bank::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'perbaikan' => 1
            ])->update([
                'perbaikan' => 0
            ]);
        }



        Catatan_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id
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
