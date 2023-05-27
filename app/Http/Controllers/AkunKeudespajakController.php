<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
use App\Models\Akun_pajak;
use App\Models\Akunkel;
use App\Models\Penataan_pendapatan;
use App\Models\Penataanbelanja_bkp;
use App\Models\Penataanbelanja_spp;
use App\Models\Tunggakan_pajak;
use App\Models\Buku_pembantu_pajak;

class AkunKeudespajakController extends Controller
{
    public function pajak(Request $request)
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
            'indikator_id' => 10,
        ])->where('nilai_sementara', '!=', NULL)->get();

        $datnil = Nilai_keuangan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 10,
        ])->orderBy('sub_indikator_keuangan_id', 'asc')->get();

        $datnilBPP = $datnil->where('sub_indikator_keuangan_id', 11)->first();


        $perbaikan = $datnil->where('perbaikan', true)->first();

        $catatan = Catatan_keuangan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 10
        ])->first();

        $rekap = Rekap_nilai_indikator::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 10
        ])->first();


        $rekon = Akun_pajak::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();

        $totalbkp = Penataanbelanja_bkp::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();

        $ssp = Penataanbelanja_bkp::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->where(function ($query) {
            $query->where('billing_ppn', '!=', NULL)->orWhere('billing_pph', '!=', NULL)->orWhere('billing_lainnya', '!=', NULL);
        })->get();

        $bkpPajak =  Penataanbelanja_bkp::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->where(function ($query) {
            $query->where('ppn', '>', 0)->orWhere('pph', '>', 0)->orWhere('lainnya', '>', 0);
        })->get();

        $buku = Buku_pembantu_pajak::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();

        if (isset($request->jenis)) {

            if (!count($totalbkp)) {
                return back()->with('fail', 'belum ada input TBPU dalam simondes!');
            }


            $jumlahbkp = $totalbkp->pluck('jumlah')->sum();

            $ppn = $totalbkp->where('ppn', '!=', NULL)->pluck('ppn')->sum();
            $pph = $totalbkp->where('pph', '!=', NULL)->pluck('pph')->sum();
            $lainnya = $totalbkp->where('lainnya', '!=', NULL)->pluck('lainnya')->sum();
            $totalPajak = $ppn + $pph + $lainnya;
            $koreksi_ppn =  $totalbkp->where('koreksi_ppn', '!=', NULL)->pluck('koreksi_ppn')->sum();
            $koreksi_pph =  $totalbkp->where('koreksi_pph', '!=', NULL)->pluck('koreksi_pph')->sum();
            $koreksi_lainnya =  $totalbkp->where('koreksi_lainnya', '!=', NULL)->pluck('koreksi_lainnya')->sum();
            $totalKoreksiPajak = $koreksi_ppn +  $koreksi_pph + $koreksi_lainnya;

            $setorppn  = $totalbkp->where('ppn', '!=', NULL)->where('billing_ppn', '!=', NULL)->pluck('ppn')->sum();
            $setorpph  = $totalbkp->where('pph', '!=', NULL)->where('billing_pph', '!=', NULL)->pluck('pph')->sum();
            $setorlainnya  = $totalbkp->where('lainnya', '!=', NULL)->where('billing_lainnya', '!=', NULL)->pluck('lainnya')->sum();

            $setorPajak = $setorppn + $setorpph + $setorlainnya;
            $blmSetor = $totalPajak - $setorPajak;
            $progress = ($setorPajak / $totalPajak) * 100;
            $progress = round($progress, 2);



            $realisasiPendapatan = Penataan_pendapatan::where([
                'asal_id' => $asal_id,
                'tahun' => $tahun
            ])->pluck('jumlah')->sum();
            $pembiayaan = Penataan_pembiayaan::where([
                'asal_id' => $asal_id,
                'tahun' => $tahun
            ])->get();
            $penerimaanPembiayaan = $pembiayaan->where('pembiayaan_id', '<', 6)->pluck('jumlah')->sum();
            $pengeluaranPembiayaan = $pembiayaan->where('pembiayaan_id', '>', 6)->pluck('jumlah')->sum();
            $jumlahSPP = Penataanbelanja_spp::where([
                'asal_id' => $asal_id,
                'tahun' => $tahun
            ])->pluck('jumlah')->sum();
            $totalPenerimaan = $realisasiPendapatan + $penerimaanPembiayaan;
            $totalPengeluaran = $jumlahSPP + $pengeluaranPembiayaan;
            $totalSPJ = $jumlahbkp + $pengeluaranPembiayaan;
            $saldoKas = $totalPenerimaan - $totalPengeluaran;

            $belumSPJ = ($jumlahSPP + $pengeluaranPembiayaan) - $totalSPJ;

            if ($rekon->count()) {
                $tunggakan = trim($rekon[0]->tunggakan_pajak);
                $pengurang = (5 / 1000000) * $tunggakan;
                $nilaiTunggakan = 100 - $pengurang;
                $nilaiTunggakan = round($nilaiTunggakan, 2);
                $persenDataTunggakan = 100;
                $nilaiPemenuhan = $rekon[0]->prosentase_terbayar;
                $persenDataPemenuhan = 100;
            } else {
                $nilaiTunggakan = 0;
                $persenDataTunggakan = 0;
                $nilaiPemenuhan = 0;
                $persenDataPemenuhan = 0;
            }



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
                'datnil' => $datnil,
                'ppn' => $ppn,
                'pph' => $pph,
                'lainnya' => $lainnya,
                'koreksi_ppn' => $koreksi_ppn,
                'koreksi_pph' => $koreksi_pph,
                'koreksi_lainnya' => $koreksi_lainnya,
                'totalPajak' => $totalPajak,
                'totalKoreksiPajak' => $totalKoreksiPajak,
                'setorppn' => $setorppn,
                'setorpph' => $setorpph,
                'setorlainnya' => $setorlainnya,
                'setorPajak' => $setorPajak,
                'totalbkp' => $totalbkp,
                'jumlahbkp' => $jumlahbkp,
                'blmSetor' => $blmSetor,
                'progress' => $progress,
                'realisasiPendapatan' => $realisasiPendapatan,
                'penerimaanPembiayaan' => $penerimaanPembiayaan,
                'pengeluaranPembiayaan' => $pengeluaranPembiayaan,
                'jumlahSPP' => $jumlahSPP,
                'saldoKas' => $saldoKas,
                'totalSPJ' => $totalSPJ,
                'belumSPJ' => $belumSPJ,
                'rekon' => $rekon,
                'ssp' => $ssp,
                'buku' => $buku,


            ];
            $data['total_p'] = Total_apbd::where([
                'asal_id' => $asal_id,
                'tahun' => $tahun
            ])->where('belanja_murni', '!=', NULL)->first();

            if (!$data['total_p']) {
                return back()->with('fail', 'Belum ada input belanja APBDes');
            }

            if ($data['total_p']->belanja_perubahan !== NULL) {
                $data['anggaran'] = 'perubahan';
                $data['totalBelanja'] = $data['total_p']->belanja_perubahan;
            } else {
                $data['anggaran'] = 'murni';
                $data['totalBelanja'] = $data['total_p']->belanja_murni;
            }


            if ($request->jenis == 'ssp') {
                $datum = $totalbkp;
                $data['databkp'] = $totalbkp;
                $data['bkpPajak'] = $bkpPajak;
            } elseif ($request->jenis == 'rekon') {
                $cek = $totalbkp;
                $datum = $rekon;
            } elseif ($request->jenis == 'buku_pajak') {
                $datum = $buku;
            } elseif ($request->jenis == 'penilaian') {
                $datum = $penilaian;
                $data['nilaiTunggakan'] = $nilaiTunggakan;
                $data['persenDataTunggakan'] = $persenDataTunggakan;
                $data['nilaiPemenuhan'] = $nilaiPemenuhan;
                $data['persenDataPemenuhan'] = $persenDataPemenuhan;
                $data['datnilBPP'] = $datnilBPP;
                $data['rekap'] = $rekap;
                $data['catatan'] = $catatan;
                $belumsetor = Penataanbelanja_bkp::where([
                    'asal_id' => $asal_id,
                    'tahun' => $tahun
                ])->where(function ($query) {
                    $query->where('ppn', '>', 0)->where('billing_ppn', '=', NULL);
                    $query->orWhere('pph', '>', 0)->where('billing_pph', '=', NULL);
                    $query->orWhere('lainnya', '>', 0)->where('billing_lainnya', '=', NULL);
                })->get();
                $data['belumsetor'] = $belumsetor;
                $data['koreksiBkp'] = $totalbkp->where('koreksi_pajak', 1);
            }


            if (count($datum) == 0) {

                return view('adminIrbanwil.akunPajak.formPajak_t', $data);
            } else {

                return view('adminIrbanwil.akunPajak.formPajak_e', $data);
            }
        } else {
            $data = [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'jenis' => $request->jenis,
                'tahun' => $tahun,
                'rekon' => $rekon,
                'perbaikan' => $perbaikan,
                'penilaian' => count($penilaian),
                'ssp' => $ssp,
                'buku' => $buku
            ];

            return view('adminIrbanwil.akunPajak.formPajak', $data);
        }
    }

    public function rekonPajak(Request $request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'koreksi_ppn' => str_replace('.', '', $request->koreksi_ppn),
            'koreksi_pph' => str_replace('.', '', $request->koreksi_pph),
            'koreksi_lainnya' => str_replace('.', '', $request->koreksi_lainnya),
            'tunggakan_pajak' => str_replace('.', '', $request->tunggakan_pajak),
            'ppn_terbayar' => str_replace('.', '', $request->ppn_terbayar),
            'pph_terbayar' => str_replace('.', '', $request->pph_terbayar),
            'lainnya_terbayar' => str_replace('.', '', $request->lainnya_terbayar),
        ];
        $data['total_koreksi'] =  $data['koreksi_ppn'] + $data['koreksi_pph'] + $data['koreksi_lainnya'];
        $data['total_terbayar'] = $data['ppn_terbayar'] + $data['pph_terbayar'] + $data['lainnya_terbayar'];

        $data['ppn_terhutang'] = $data['koreksi_ppn'] - $data['ppn_terbayar'];
        $data['pph_terhutang'] = $data['koreksi_pph'] - $data['pph_terbayar'];
        $data['lainnya_terhutang'] = $data['koreksi_lainnya'] - $data['lainnya_terbayar'];
        $data['total_terhutang'] = $data['ppn_terhutang'] + $data['pph_terhutang'] + $data['lainnya_terhutang'];

        $data['prosentase_terbayar'] = ($data['total_terbayar'] / $data['total_koreksi']) * 100;
        $data['prosentase_terbayar'] = round($data['prosentase_terbayar'], 2);



        if ($request->file('bukti_dukung')) {
            if ($request->old_0 && strpos($request->old_0, $request->tahun)) {
                Storage::delete($request->old_0);
            }
            $ext = $request->bukti_dukung->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_belanja";
            $file = $request->file('bukti_dukung')->storeAs($folder, "bukti_dukung_" . $request->tahun . mt_rand(1, 100) . "." . $ext);
            $data['bukti_dukung'] = $file;
        }

        Akun_pajak::create($data);

        $url = url()->previous();

        return redirect($url . "#tabelrekon")->with('success', 'berhasil kirim data');
    }

    public function rekonPajakUpdate(Request $request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'koreksi_ppn' => str_replace('.', '', $request->koreksi_ppn),
            'koreksi_pph' => str_replace('.', '', $request->koreksi_pph),
            'koreksi_lainnya' => str_replace('.', '', $request->koreksi_lainnya),
            'tunggakan_pajak' => str_replace('.', '', $request->tunggakan_pajak),
            'ppn_terbayar' => str_replace('.', '', $request->ppn_terbayar),
            'pph_terbayar' => str_replace('.', '', $request->pph_terbayar),
            'lainnya_terbayar' => str_replace('.', '', $request->lainnya_terbayar),
        ];
        $data['total_koreksi'] =  $data['koreksi_ppn'] + $data['koreksi_pph'] + $data['koreksi_lainnya'];
        $data['total_terbayar'] = $data['ppn_terbayar'] + $data['pph_terbayar'] + $data['lainnya_terbayar'];

        $data['ppn_terhutang'] = $data['koreksi_ppn'] - $data['ppn_terbayar'];
        $data['pph_terhutang'] = $data['koreksi_pph'] - $data['pph_terbayar'];
        $data['lainnya_terhutang'] = $data['koreksi_lainnya'] - $data['lainnya_terbayar'];
        $data['total_terhutang'] = $data['ppn_terhutang'] + $data['pph_terhutang'] + $data['lainnya_terhutang'];

        $data['prosentase_terbayar'] = ($data['total_terbayar'] / $data['total_koreksi']) * 100;
        $data['prosentase_terbayar'] = round($data['prosentase_terbayar'], 2);



        if ($request->file('bukti_dukung')) {
            if ($request->old_0 && strpos($request->old_0, $request->tahun)) {
                Storage::delete($request->old_0);
            }
            $ext = $request->bukti_dukung->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_belanja";
            $file = $request->file('bukti_dukung')->storeAs($folder, "bukti_dukung_" . $request->tahun . mt_rand(1, 100) . "." . $ext);
            $data['bukti_dukung'] = $file;
        }

        Akun_pajak::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->update($data);

        $url = url()->previous();

        return redirect($url . "#tabelrekon")->with('success', 'berhasil update data');
    }

    public function nilaiAkunPajak(Request $request)
    {
        $i = 9;
        foreach ($request->sub_indikator_keuangan_id as $sub) {
            $cek = Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'indikator_id' => 10,
                'sub_indikator_keuangan_id' => $sub
            ])->first();
            if (!$cek) {
                Nilai_keuangan::create([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 2,
                    'indikator_id' => 10,
                    'sub_indikator_keuangan_id' => $sub,
                    'jumlah_data' => 1,
                    'persen_data' => 100,
                    'nilai_sementara' => $request->nilai[$i - 9],
                    'perbaikan' => false
                ]);
            } else {
                Nilai_keuangan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 2,
                    'indikator_id' => 10,
                    'sub_indikator_keuangan_id' => $sub
                ])->update([
                    'jumlah_data' => 1,
                    'persen_data' => 100,
                    'nilai_sementara' => $request->nilai[$i - 9],
                    'perbaikan' => false
                ]);
            }

            $i++;
        }

        Catatan_keuangan::create([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => 2,
            'indikator_id' => 10,
            'uraian' => $request->uraian,
            'catatan_sementara' => $request->catatan_sementara,
            'rekom_sementara' => $request->rekom_sementara
        ]);

        return $this->rekap($request);
    }

    public function nilaiAkunPajakUpdate(Request $request)
    {
        $i = 9;
        foreach ($request->sub_indikator_keuangan_id as $sub) {
            $cek = Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'indikator_id' => 10,
                'sub_indikator_keuangan_id' => $sub
            ])->first();
            if (!$cek) {
                Nilai_keuangan::create([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 2,
                    'indikator_id' => 10,
                    'sub_indikator_keuangan_id' => $sub,
                    'jumlah_data' => 1,
                    'persen_data' => 100,
                    'nilai_sementara' => $request->nilai[$i - 9],
                    'perbaikan' => false
                ]);
            } else {
                Nilai_keuangan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 2,
                    'indikator_id' => 10,
                    'sub_indikator_keuangan_id' => $sub
                ])->update([
                    'jumlah_data' => 1,
                    'persen_data' => 100,
                    'nilai_sementara' => $request->nilai[$i - 9],
                    'perbaikan' => false
                ]);
            }

            $i++;
        }

        Catatan_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => 2,
            'indikator_id' => 10
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
