<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Penataanbelanja_spp;
use App\Models\Apbdes_kegiatan;
use App\Models\Total_apbd;
use App\Models\Penataanbelanja_bkp;
use App\Models\Kecamatan;
use App\Models\Asal;
use App\Models\Penataan_pendapatan;
use App\Models\Bku_panjar;
use App\Models\Nilai_keuangan;
use App\Models\Uji_petik;
use App\Models\Catatan_keuangan;
use App\Models\Rekap_nilai_aspek;
use App\Models\Rekap_nilai_indikator;
use App\Models\Indikator;
use App\Models\Sub_indikator_keuangan;

class AkunKeudesbelanjaController extends Controller
{
    public function belanja(Request $request)
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


        $spp = Penataanbelanja_spp::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->get();
        $bkp = Penataanbelanja_bkp::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->get();

        $bku = Bku_panjar::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->get();
        $uji_petik = Uji_petik::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->get();

        $nilai = Nilai_keuangan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 8
        ])->get();
        $penilaian = $nilai->where('nilai_sementara', '!=', NULL);
        $penilaianNull = $nilai->where('perbaikan', true)->first();


        $rekap = [];

        if ($request->jenis) {
            if ($request->jenis == 'spp' || $request->jenis == 'spp_kegiatan') {
                $datum = $spp;
            } elseif ($request->jenis == 'tbpu' || $request->jenis == 'cek_tbpu' || $request->jenis == 'bukti_belanja') {
                $datum = $bkp;
            } elseif ($request->jenis == 'spp_null') {
                $datum = Penataanbelanja_spp::where([
                    'asal_id' => $asal_id,
                    'tahun' => $tahun,
                    'status' => NULL,
                    'perbaikan' => true
                ])->get();
            } elseif ($request->jenis == 'spp_ulang') {
                $datum = Penataanbelanja_spp::where([
                    'asal_id' => $asal_id,
                    'tahun' => $tahun,
                    'perbaikan' => true
                ])->where('status', '!=', NULL)->get();
            } elseif ($request->jenis == 'bkp_null') {
                $datum = Penataanbelanja_bkp::where([
                    'asal_id' => $asal_id,
                    'tahun' => $tahun,
                    'status_bkp' => NULL,
                    'perbaikan_bkp' => true
                ])->get();
            } elseif ($request->jenis == 'bkp_ulang') {
                $datum = Penataanbelanja_bkp::where([
                    'asal_id' => $asal_id,
                    'tahun' => $tahun,
                    'perbaikan_bkp' => true
                ])->where('status_bkp', '!=', NULL)->get();
            }
            if ($request->jenis == 'pembukuan') {
                $datum = $bku;
            } elseif ($request->jenis == 'uji_petik') {
                $datum = $uji_petik;
            } elseif ($request->jenis == 'penilaian') {

                $rekap = Rekap_nilai_indikator::where([
                    'asal_id' => $asal_id,
                    'tahun' => $tahun,
                    'indikator_id' => 8
                ])->first();
                $datum = Rekap_nilai_indikator::where([
                    'asal_id' => $asal_id,
                    'tahun' => $tahun,
                    'indikator_id' => 8
                ])->get();

                $daftarTemuan = Penataanbelanja_bkp::where([
                    'asal_id' => $asal_id,
                    'tahun' => $tahun
                ])->where('catatan_bkp', '!=', '')->get();
                $temuanSPP = Penataanbelanja_spp::where([
                    'asal_id' => $asal_id,
                    'tahun' => $tahun
                ])->where('catatan', '!=', '')->get();
                $temuanUjipetik = Uji_petik::where([
                    'asal_id' => $asal_id,
                    'tahun' => $tahun
                ])->where('kesimpulan_sementara', '!=', '')->get();
                $jumlahTemuan = count($daftarTemuan) + count($temuanSPP) + count($temuanUjipetik);
            }



            $jumbkp = $bkp->pluck('jumlah')->sum();
            $topajak = $bkp->pluck('ppn')->sum() + $bkp->pluck('pph')->sum();
            $jumnulbkp = $bkp->where('status_bkp', NULL)->where('perbaikan_bkp', true)->count();
            $jumulangbkp = $bkp->where('status_bkp', '!=', NULL)->where('perbaikan_bkp', true)->count();
            $nilai_bkp = $bkp->where('nilai_bkp', '!=', NULL)->pluck('nilai_bkp')->sum();

            $data = [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'jenis' => $request->jenis,
                'tahun' => $tahun,
                'spp' => $spp->count(),
                'bkp' => $bkp->count(),
                'topajak' => $topajak,
                'jumnulbkp' => $jumnulbkp,
                'jumulangbkp' => $jumulangbkp,
                'nilai_bkp' => $nilai_bkp,
                'pembukuan' => $bku->count(),
                'uji_petik' => $uji_petik->count(),
                'penilaian' => $penilaian->count(),
                'rekap' => $rekap,
                'penilaianNull' => $penilaianNull
            ];
            $penerimaans = Penataan_pendapatan::where([
                'asal_id' => $asal_id,
                'tahun' => $tahun
            ])->pluck('jumlah');
            if (!count($penerimaans) && $request->jenis != 'penilaian') {
                return back()->with('fail', 'belum ada input realisasi pendapatan!');
            }
            $topen = 0;
            foreach ($penerimaans as $penerimaan) {
                $jump = intval(str_replace('.', '', $penerimaan));
                $topen += $jump;
            }
            $data['penerimaan'] = $topen;
            $data['jumdok'] = $datum->count();
            $data['jumlah_spp'] = Penataanbelanja_spp::where([
                'asal_id' => $asal_id,
                'tahun' => $tahun
            ])->pluck('jumlah')->sum();
            $data['jumlah_tbpu'] = $jumbkp;
            $data['sisa_spp'] = $data['jumlah_spp'] - $jumbkp;
            $data['sisa_penerimaan'] = $topen - $jumbkp;

            if (count($datum) == 0) {


                $data['apbdes_kegiatans'] = Apbdes_kegiatan::where([
                    'asal_id' => $asal_id,
                    'tahun' => $tahun
                ])->get();


                $data['total_p'] = Total_apbd::where([
                    'asal_id' => $asal_id,
                    'tahun' => $tahun
                ])->first();
                if (!$data['total_p'] && $request->jenis != 'penilaian') {
                    return back()->with('fail', 'Data APBDes Belum Terisi!');
                }
                if ($data['total_p'] && $data['total_p']->belanja_perubahan != NULL) {
                    $data['anggaran'] = 'perubahan';
                } else {
                    $data['anggaran'] = 'murni';
                }


                if ($request->jenis == 'spp_kegiatan' && $request->kegiatan) {
                    $data['kegiatan_spp'] = Apbdes_kegiatan::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun,
                        'id' => $request->kegiatan
                    ])->first();
                }
                if ($request->jenis == 'cek_tbpu' && $request->kegiatan) {
                    $data['kegiatan_tbpu'] = Apbdes_kegiatan::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun,
                        'id' => $request->kegiatan
                    ])->first();
                }
                if ($request->jenis == 'bukti_belanja') {
                    $data['tbpus'] = [];
                }


                if ($request->jenis == 'uji_petik') {
                    $data['apbdes_kegiatans'] = Apbdes_kegiatan::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun
                    ])->get();

                    $data['total_p'] = Total_apbd::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun
                    ])->first();
                    if (!$data['total_p']) {
                        return back()->with('fail', 'belum ada input apbd !');
                    }

                    if ($data['total_p']->belanja_perubahan != NULL) {
                        $data['anggaran'] = 'perubahan';
                    } else {
                        $data['anggaran'] = 'murni';
                    }

                    $data['tbpus'] = Penataanbelanja_bkp::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun
                    ])->get();
                }

                if ($request->jenis == 'uji_petik' && $request->kegiatan) {
                    $data['kegiatan_tbpu'] = Apbdes_kegiatan::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun,
                        'id' => $request->kegiatan
                    ])->first();
                }

                if ($request->jenis == 'penilaian') {
                    $datnil = Nilai_keuangan::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun,
                        'indikator_id' => 8
                    ])->orderBy('sub_indikator_keuangan_id', 'asc')->get();
                    $data['datnil'] = $datnil;
                    $data['datnilSPP'] = $datnil->where('sub_indikator_keuangan_id', 3)->first();
                    $data['datnilBKP'] = $datnil->where('sub_indikator_keuangan_id', 4)->first();
                    $data['datnilBank'] = $datnil->where('sub_indikator_keuangan_id', 5)->first();
                    $data['datnilUji'] = $datnil->where('sub_indikator_keuangan_id', 6)->first();


                    if ($uji_petik->count()) {
                        $data['data_upet'] = 100;
                        $data['nilai_upet'] = $uji_petik[0]->nilai;
                    } else {
                        $data['data_upet'] = 0;
                        $data['nilai_upet'] = 0;
                    }
                    $spp = Penataanbelanja_spp::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun
                    ])->get();
                    $bkp = Penataanbelanja_bkp::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun
                    ])->get();
                    if ($spp->count() > 0) {
                        $data['rata_spp'] = ($spp->pluck('nilai')->sum() / $spp->count());
                    } else {
                        $data['rata_spp'] = 0;
                    }
                    if ($bkp->count() > 0) {
                        $data['rata_bkp'] = ($bkp->pluck('nilai_bkp')->sum() / $bkp->count());
                    } else {
                        $data['rata_bkp'] = 0;
                    }

                    $data['spp_null'] = $spp->where('nilai', NULL)->where('nilai', '!=', 0)->count();
                    $data['spp_ulang'] = $spp->where('perbaikan', 1)->count();
                    $data['bkp_null'] = $bkp->where('nilai_bkp', NULL)->where('nilai_bkp', '!=', 0)->count();
                    $data['bkp_ulang'] = $bkp->where('perbaikan_bkp', 1)->count();
                    $bkpid = $uji_petik->pluck('penataanbelanja_bkp_id')->first();
                    $data['uji_null'] = $bkp->where('id', $bkpid)->pluck('perbaikan_bkp')->first();
                    $data['daftarTemuan'] = $daftarTemuan;
                    $data['temuanSPP'] = $temuanSPP;
                    $data['temuanUjipetik'] = $temuanUjipetik;
                    $data['jumlahTemuan'] = $jumlahTemuan;
                }


                return view('adminIrbanwil.akunBelanja.penataanBelanja', $data);
            } else {

                if ($request->jenis == 'spp' || $request->jenis == 'spp_kegiatan') {

                    $data['apbdes_kegiatans'] = Apbdes_kegiatan::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun
                    ])->get();

                    $penerimaans = Penataan_pendapatan::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun
                    ])->pluck('jumlah');
                    $topen = 0;
                    foreach ($penerimaans as $penerimaan) {
                        $jump = intval(str_replace('.', '', $penerimaan));
                        $topen += $jump;
                    }
                    $data['penerimaan'] = $topen;

                    $data['nilai_spp'] = $datum->pluck('nilai')->sum();
                    $data['jumdok'] = $datum->count();
                    $data['jumnul'] = $datum->where('status', NULL)->where('perbaikan', true)->count();

                    $data['jumulang'] = $datum->where('perbaikan', true)->where('status', '!=', NULL)->count();

                    $data['total_p'] = Total_apbd::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun
                    ])->first();
                    if ($data['total_p']->belanja_perubahan != NULL) {
                        $data['anggaran'] = 'perubahan';
                    } else {
                        $data['anggaran'] = 'murni';
                    }
                }

                if ($request->jenis == 'spp_kegiatan' && $request->kegiatan) {
                    $data['kegiatan_spp'] = Apbdes_kegiatan::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun,
                        'id' => $request->kegiatan
                    ])->first();
                }

                if ($request->jenis == 'tbpu' || $request->jenis == 'cek_tbpu') {
                    $data['apbdes_kegiatans'] = Apbdes_kegiatan::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun
                    ])->get();

                    $data['total_p'] = Total_apbd::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun
                    ])->first();
                    if ($data['total_p']->belanja_perubahan != NULL) {
                        $data['anggaran'] = 'perubahan';
                    } else {
                        $data['anggaran'] = 'murni';
                    }

                    $data['tbpus'] = Penataanbelanja_bkp::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun
                    ])->get();
                }

                if ($request->jenis == 'cek_tbpu' && $request->kegiatan) {
                    $data['kegiatan_tbpu'] = Apbdes_kegiatan::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun,
                        'id' => $request->kegiatan
                    ])->first();
                }



                // return $data['tbpus']->where('kegiatan_id', 1)->where('belanja_id', 2);
                // return $data['apbdes_kegiatans'];
                // return $data['apbdes_kegiatans'][0]->penataanbelanja_spp[0]->jumlah;
                if ($request->jenis == 'spp_null') {
                    $data['sppnulls'] = $datum;
                }
                if ($request->jenis == 'spp_ulang') {
                    $data['sppulangs'] = $datum;
                }
                if ($request->jenis == 'bkp_null') {
                    $data['bkpnulls'] = $datum;
                }
                if ($request->jenis == 'bkp_ulang') {
                    $data['bkpulangs'] = $datum;
                }

                if ($request->jenis == 'pembukuan') {
                    $data_bku = $bku;
                    $bku_semester1 = $data_bku->where('nama_data', 'bku_semester1')->first();
                    $data['data_bku'] = $data_bku;
                    $data['bku_semester1'] = $bku_semester1;
                    $data['bku_semester2'] = $data_bku->where('nama_data', 'bku_semester2')->first();
                    $data['bp_semester1'] = $data_bku->where('nama_data', 'buku_pembantu_panjar_semester1')->first();
                    $data['bp_semester2'] = $data_bku->where('nama_data', 'buku_pembantu_panjar_semester2')->first();
                }
                if ($request->jenis == 'uji_petik') {
                    $hasil = $datum->first();
                    $data['kegiatan'] = $hasil->apbdes_kegiatan->kegiatan->kegiatan;
                    $data['nomor_bkp'] = $hasil->penataanbelanja_bkp->nomor;
                    $data['jumlah_bkp'] = $hasil->penataanbelanja_bkp->jumlah;
                    $data['file_bkp'] = $hasil->penataanbelanja_bkp->file_bkp;
                    $data['jenis_belanja'] = $hasil->penataanbelanja_bkp->belanja->jenis_belanja;
                    $data['hasil'] = $hasil;
                }

                if ($request->jenis == 'penilaian') {
                    $datnil = Nilai_keuangan::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun,
                        'indikator_id' => 8
                    ])->orderBy('sub_indikator_keuangan_id', 'asc')->get();
                    $data['datnil'] = $datnil;
                    $data['datnilSPP'] = $datnil->where('sub_indikator_keuangan_id', 3)->first();
                    $data['datnilBKP'] = $datnil->where('sub_indikator_keuangan_id', 4)->first();
                    $data['datnilBank'] = $datnil->where('sub_indikator_keuangan_id', 5)->first();
                    $data['datnilUji'] = $datnil->where('sub_indikator_keuangan_id', 6)->first();

                    if ($uji_petik->count()) {
                        $data['data_upet'] = 100;
                        $data['nilai_upet'] = $uji_petik[0]->nilai;
                    } else {
                        $data['data_upet'] = 0;
                        $data['nilai_upet'] = 0;
                    }
                    $spp = Penataanbelanja_spp::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun
                    ])->get();
                    $bkp = Penataanbelanja_bkp::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun
                    ])->get();

                    if ($spp->count() > 0) {
                        $data['rata_spp'] = ($spp->pluck('nilai')->sum() / $spp->count());
                    } else {
                        $data['rata_spp'] = 0;
                    }
                    if ($bkp->count() > 0) {
                        $data['rata_bkp'] = ($bkp->pluck('nilai_bkp')->sum() / $bkp->count());
                    } else {
                        $data['rata_bkp'] = 0;
                    }

                    $data['spp_null'] = $spp->where('nilai', NULL)->where('nilai', '!=', 0)->count();
                    $data['spp_ulang'] = $spp->where('perbaikan', 1)->count();
                    $data['bkp_null'] = $bkp->where('nilai_bkp', NULL)->where('nilai_bkp', '!=', 0)->count();
                    $data['bkp_ulang'] = $bkp->where('perbaikan_bkp', 1)->count();
                    $bkpid = $uji_petik->pluck('penataanbelanja_bkp_id')->first();
                    $data['uji_null'] = $bkp->where('id', $bkpid)->pluck('perbaikan_bkp')->first();

                    $data['catatan'] = Catatan_keuangan::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun,
                        'indikator_id' => 8
                    ])->first();
                    $data['daftarTemuan'] = $daftarTemuan;
                    $data['temuanSPP'] = $temuanSPP;
                    $data['temuanUjipetik'] = $temuanUjipetik;
                    $data['jumlahTemuan'] = $jumlahTemuan;
                }

                return view('adminIrbanwil.akunBelanja.penataanBelanja_e', $data);
            }
        } else {
            $data = [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'jenis' => '',
                'tahun' => $tahun,
                'spp' => $spp->count(),
                'bkp' => $bkp->count(),
                'pembukuan' => $bku->count(),
                'uji_petik' => $uji_petik->count(),
                'penilaian' => $penilaian->count(),
                'rekap' => $rekap,
                'penilaianNull' => $penilaianNull

            ];
            return view('adminIrbanwil.akunBelanja.penataanBelanja', $data);
        }
    }

    public function nilaiSPP(Request $request)
    {

        Penataanbelanja_spp::where('id', $request->id)->update([
            'status' => $request->status,
            'nilai' => $request->nilai,
            'catatan' => strip_tags($request->catatan),
            'rekomendasi' => strip_tags($request->rekomendasi),
            'perbaikan' => false
        ]);
        return back()->with('success', 'berhasil kirim nilai dan temuan');
    }

    public function nilaiTBPU(Request $request)
    {

        if ($request->koreksi_pajak == 1) {
            Penataanbelanja_bkp::where('id', $request->id)->update([
                'status_bkp' => trim($request->status_bkp),
                'nilai_bkp' => $request->nilai_bkp,
                'catatan_bkp' => strip_tags($request->catatan_bkp),
                'rekomendasi_bkp' => strip_tags($request->rekomendasi_bkp),
                'koreksi_pajak' => $request->koreksi_pajak,
                'perbaikan_bkp' => false,
                'koreksi_ppn' => str_replace('.', '', $request->koreksi_ppn),
                'koreksi_pph' => str_replace('.', '', $request->koreksi_pph),
                'koreksi_lainnya' => str_replace('.', '', $request->koreksi_lainnya)
            ]);
        } else {
            Penataanbelanja_bkp::where('id', $request->id)->update([
                'status_bkp' => trim($request->status_bkp),
                'nilai_bkp' => $request->nilai_bkp,
                'catatan_bkp' => strip_tags($request->catatan_bkp),
                'rekomendasi_bkp' => strip_tags($request->rekomendasi_bkp),
                'koreksi_pajak' => $request->koreksi_pajak,
                'perbaikan_bkp' => false,
                'koreksi_ppn' => str_replace('.', '', $request->ppn),
                'koreksi_pph' => str_replace('.', '', $request->pph),
                'koreksi_lainnya' => str_replace('.', '', $request->lainnya)
            ]);
        }
        $url = url()->previous();

        return redirect($url . "#bkp_" . $request->id)->with('success', 'berhasil kirim nilai dan temuan');
    }

    public function resetTBPU(Request $request)
    {
        Penataanbelanja_bkp::where('id', $request->id)->update([
            'status_bkp' => NULL,
            'nilai_bkp' => NULL,
            'catatan_bkp' => NULL,
            'rekomendasi_bkp' => NULL,
            'koreksi_pajak' => NULL,
            'koreksi_ppn' => NULL,
            'koreksi_pph' => NULL,
            'koreksi_lainnya' => NULL,
            'perbaikan_bkp' => true
        ]);
        return "berhasil";
    }
    public function resetSPP(Request $request)
    {
        Penataanbelanja_spp::where('id', $request->id)->update([
            'status' => NULL,
            'nilai' => NULL,
            'catatan' => NULL,
            'rekomendasi' => NULL,
            'perbaikan' => true
        ]);
        return "berhasil";
    }

    public function belanja_2(Request $request)
    {
        $tahun = now()->format('Y');
        $infos = Admin::where('id', session('loggedAdminIrbanwil'))->first();
        $asal_id =  Asal::where('obrik', $infos->obrik)->pluck('id')->first();
        $kecamatan = Kecamatan::where('obrik', $infos->obrik)->get();
        $kecamatan1 = $kecamatan->pluck('nama_kecamatan')->first();

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

        $bku = Bku_panjar::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->get();
        $uji_petik = Uji_petik::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->get();

        $penilaian = Nilai_keuangan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 8
        ])->where('nilai_sementara', '!=', NULL)->get();

        if ($request->jenis) {
            if ($request->jenis == 'pembukuan') {
                $datum = $bku;
            } elseif ($request->jenis == 'uji_petik') {
                $datum = $uji_petik;
            } elseif ($request->jenis == 'penilaian') {
                $datum = $penilaian;
            }

            $data = [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'jenis' => $request->jenis,
                'tahun' => $tahun,
                'pembukuan' => $bku->count(),
                'uji_petik' => $uji_petik->count(),
                'penilaian' => $penilaian->count()
            ];

            if (count($datum) == 0) {
                if ($request->jenis == 'uji_petik') {
                    $data['apbdes_kegiatans'] = Apbdes_kegiatan::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun
                    ])->get();

                    $data['total_p'] = Total_apbd::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun
                    ])->first();
                    if (!$data['total_p']) {
                        return back()->with('fail', 'belum ada input apbd !');
                    }

                    if ($data['total_p']->belanja_perubahan != NULL) {
                        $data['anggaran'] = 'perubahan';
                    } else {
                        $data['anggaran'] = 'murni';
                    }

                    $data['tbpus'] = Penataanbelanja_bkp::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun
                    ])->get();
                }

                if ($request->jenis == 'uji_petik' && $request->kegiatan) {
                    $data['kegiatan_tbpu'] = Apbdes_kegiatan::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun,
                        'id' => $request->kegiatan
                    ])->first();
                }

                if ($request->jenis == 'penilaian') {
                    $datnil = Nilai_keuangan::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun,
                        'indikator_id' => 8
                    ])->orderBy('sub_indikator_keuangan_id', 'asc')->get();
                    $data['datnil'] = $datnil;
                    $data['datnilSPP'] = $datnil->where('sub_indikator_keuangan_id', 3)->first();
                    $data['datnilBKP'] = $datnil->where('sub_indikator_keuangan_id', 4)->first();
                    $data['datnilBank'] = $datnil->where('sub_indikator_keuangan_id', 5)->first();
                    $data['datnilUji'] = $datnil->where('sub_indikator_keuangan_id', 6)->first();


                    if ($uji_petik->count()) {
                        $data['data_upet'] = 100;
                        $data['nilai_upet'] = $uji_petik[0]->nilai;
                    } else {
                        $data['data_upet'] = 0;
                        $data['nilai_upet'] = 0;
                    }
                    $spp = Penataanbelanja_spp::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun
                    ])->get();
                    $bkp = Penataanbelanja_bkp::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun
                    ])->get();
                    if ($spp->count() > 0) {
                        $data['rata_spp'] = ($spp->pluck('nilai')->sum() / $spp->count());
                    } else {
                        $data['rata_spp'] = 0;
                    }
                    if ($bkp->count() > 0) {
                        $data['rata_bkp'] = ($bkp->pluck('nilai_bkp')->sum() / $bkp->count());
                    } else {
                        $data['rata_bkp'] = 0;
                    }

                    $data['spp_null'] = $spp->where('nilai', NULL)->count();
                    $data['spp_ulang'] = $spp->where('perbaikan', 1)->count();
                    $data['bkp_null'] = $bkp->where('nilai_bkp', NULL)->count();
                    $data['bkp_ulang'] = $bkp->where('perbaikan_bkp', 1)->count();
                    $bkpid = $uji_petik->pluck('penataanbelanja_bkp_id')->first();
                    $data['uji_null'] = $bkp->where('id', $bkpid)->pluck('perbaikan_bkp')->first();
                }

                return view('adminIrbanwil.akunBelanja.penataanBelanja2', $data);
            } else {

                if ($request->jenis == 'pembukuan') {
                    $data_bku = $bku;
                    $bku_semester1 = $data_bku->where('nama_data', 'bku_semester1')->first();
                    $data['data_bku'] = $data_bku;
                    $data['bku_semester1'] = $bku_semester1;
                    $data['bku_semester2'] = $data_bku->where('nama_data', 'bku_semester2')->first();
                    $data['bp_semester1'] = $data_bku->where('nama_data', 'buku_pembantu_panjar_semester1')->first();
                    $data['bp_semester2'] = $data_bku->where('nama_data', 'buku_pembantu_panjar_semester2')->first();
                }
                if ($request->jenis == 'uji_petik') {
                    $hasil = $datum->first();
                    $data['kegiatan'] = $hasil->apbdes_kegiatan->kegiatan->kegiatan;
                    $data['nomor_bkp'] = $hasil->penataanbelanja_bkp->nomor;
                    $data['jumlah_bkp'] = $hasil->penataanbelanja_bkp->jumlah;
                    $data['file_bkp'] = $hasil->penataanbelanja_bkp->file_bkp;
                    $data['jenis_belanja'] = $hasil->penataanbelanja_bkp->belanja->jenis_belanja;
                    $data['hasil'] = $hasil;
                }

                if ($request->jenis == 'penilaian') {
                    $datnil = Nilai_keuangan::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun,
                        'indikator_id' => 8
                    ])->orderBy('sub_indikator_keuangan_id', 'asc')->get();
                    $data['datnil'] = $datnil;
                    $data['datnilSPP'] = $datnil->where('sub_indikator_keuangan_id', 3)->first();
                    $data['datnilBKP'] = $datnil->where('sub_indikator_keuangan_id', 4)->first();
                    $data['datnilBank'] = $datnil->where('sub_indikator_keuangan_id', 5)->first();
                    $data['datnilUji'] = $datnil->where('sub_indikator_keuangan_id', 6)->first();

                    if ($uji_petik->count()) {
                        $data['data_upet'] = 100;
                        $data['nilai_upet'] = $uji_petik[0]->nilai;
                    } else {
                        $data['data_upet'] = 0;
                        $data['nilai_upet'] = 0;
                    }
                    $spp = Penataanbelanja_spp::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun
                    ])->get();
                    $bkp = Penataanbelanja_bkp::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun
                    ])->get();

                    if ($spp->count() > 0) {
                        $data['rata_spp'] = ($spp->pluck('nilai')->sum() / $spp->count());
                    } else {
                        $data['rata_spp'] = 0;
                    }
                    if ($bkp->count() > 0) {
                        $data['rata_bkp'] = ($bkp->pluck('nilai_bkp')->sum() / $bkp->count());
                    } else {
                        $data['rata_bkp'] = 0;
                    }

                    $data['spp_null'] = $spp->where('nilai', NULL)->count();
                    $data['spp_ulang'] = $spp->where('perbaikan', 1)->count();
                    $data['bkp_null'] = $bkp->where('nilai_bkp', NULL)->count();
                    $data['bkp_ulang'] = $bkp->where('perbaikan_bkp', 1)->count();
                    $bkpid = $uji_petik->pluck('penataanbelanja_bkp_id')->first();
                    $data['uji_null'] = $bkp->where('id', $bkpid)->pluck('perbaikan_bkp')->first();

                    $data['catatan'] = Catatan_keuangan::where([
                        'asal_id' => $asal_id,
                        'tahun' => $tahun,
                        'indikator_id' => 8
                    ])->first();
                }

                return view('adminIrbanwil.akunBelanja.penataanBelanja2_e', $data);
            }
        } else {
            $data = [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'jenis' => '',
                'tahun' => $tahun,
                'pembukuan' => $bku->count(),
                'uji_petik' => $uji_petik->count(),
                'penilaian' => $penilaian->count()
            ];


            return view('adminIrbanwil.akunBelanja.penataanBelanja2', $data);
        }
    }

    public function tambahUjipetik(Request $request)
    {

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'apbdes_kegiatan_id' => $request->apbdes_kegiatan_id,
            'penataanbelanja_bkp_id' => $request->penataanbelanja_bkp_id,
            'metode' => $request->metode,
            'tgl_uji_petik' => $request->tgl_uji_petik,
            'nilai' => $request->nilai,
            'validator' => strip_tags($request->validator),
            'kesimpulan_sementara' => strip_tags($request->kesimpulan_sementara),
            'rekomendasi_sementara' => strip_tags($request->rekomendasi_sementara),
        ];

        Uji_petik::create($data);

        $cek = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_keuangan_id' => 6
        ])->first();
        if (!$cek) {
            Nilai_keuangan::create([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 2,
                'indikator_id' => 8,
                'sub_indikator_keuangan_id' => 6,
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => false,
                'nilai_sementara' => $request->nilai
            ]);
        } else {
            Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_keuangan_id' => 6
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => false,
                'nilai_sementara' => $request->nilai
            ]);
        }


        return back()->with('success', 'Berhasil Kirim Hasil Uji Petik');
    }

    public function editUjipetik(Request $request)
    {
        Uji_petik::where('id', $request->id)->update([
            'metode' => $request->metode,
            'tgl_uji_petik' => $request->tgl_uji_petik,
            'nilai' => $request->nilai,
            'validator' => strip_tags($request->validator),
            'kesimpulan_sementara' => strip_tags($request->kesimpulan_sementara),
            'rekomendasi_sementara' => strip_tags($request->rekomendasi_sementara)

        ]);
        Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_keuangan_id' => 6
        ])->update([
            'nilai_sementara' => $request->nilai,
            'jumlah_data' => 1,
            'persen_data' => 100,
            'perbaikan' => false
        ]);

        return back()->with('success', 'berhasil update uji petik');
    }

    public function hapusUji(Uji_petik $id)
    {
        Nilai_keuangan::where([
            'asal_id' => $id->asal_id,
            'tahun' => $id->tahun,
            'sub_indikator_keuangan_id' => 6
        ])->delete();
        Uji_petik::destroy($id->id);
        return back()->with('success', 'berhasil hapus data ');
    }

    public function nilaiAkunbelanja(Request $request)
    {


        if ($request->spp_null > 0) {
            return back()->with('fail', "ada $request->spp_null dokumen SPP belum dinilai!");
        }

        if ($request->bkp_null > 0) {
            return back()->with('fail', "ada $request->bkp_null dokumen TBPU belum dinilai!");
        }

        if ($request->spp_ulang > 0) {
            return back()->with('fail', "ada $request->spp_ulang dokumen SPP belum dinilai ulang !");
        }

        if ($request->bkp_ulang > 0) {
            return back()->with('fail', "ada $request->bkp_ulang dokumen TBPU belum dinilai ulang !");
        }

        if ($request->uji_null) {
            return back()->with('fail', "ada perbaikan TBPU yang perlu di Uji Petik Ulang !");
        }


        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id
        ];

        $i = 3;
        foreach ($request->sub_indikator_keuangan_id as $sub) {
            $cek = Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_keuangan_id' => $i
            ])->first();
            if (!$cek) {
                $data["sub_indikator_keuangan_id"] = $i;
                $data["perbaikan"] = false;
                $data["nilai_sementara"] = $request->nilai[$i - 3];
                $aksi = Nilai_keuangan::create($data);
            } else {

                $ubah = Nilai_keuangan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => $request->aspek_id,
                    'indikator_id' => $request->indikator_id,
                    'sub_indikator_keuangan_id' => $i
                ])->update([
                    'nilai_sementara' => $request->nilai[$i - 3],
                    'perbaikan' => false
                ]);
            }

            $i++;
        }

        unset($data['sub_indikator_keuangan_id']);
        unset($data['nilai_sementara']);
        unset($data['perbaikan']);
        // $data['catatan_sementara'] = $request->catatan_sementara;
        // $data['rekom_sementara'] = $request->rekom_sementara;
        $data['uraian'] = $request->uraian;
        Catatan_keuangan::create($data);

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

    public function nilaiAkunbelanjaUpdate(Request $request)
    {
        if ($request->spp_null > 0) {
            return back()->with('fail', "ada $request->spp_null dokumen SPP belum dinilai!");
        }

        if ($request->spp_ulang > 0) {
            return back()->with('fail', "ada $request->spp_ulang dokumen SPP Perbaikan belum dinilai ulang !");
        }

        if ($request->bkp_null > 0) {
            return back()->with('fail', "ada $request->bkp_null dokumen TBPU belum dinilai!");
        }
        if ($request->bkp_ulang > 0) {
            return back()->with('fail', "ada $request->bkp_ulang dokumen TBPU belum dinilai ulang !");
        }

        if ($request->data_upet == 0) {
            return back()->with('fail', "anda belum melakukan uji petik!");
        }
        if ($request->uji_null) {
            return back()->with('fail', "ada perbaikan TBPU yang perlu di Uji Petik Ulang !");
        }

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id
        ];


        $i = 3;
        foreach ($request->sub_indikator_keuangan_id as $sub) {
            $cek = Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_keuangan_id' => $i
            ])->first();
            if (!$cek) {
                $data["sub_indikator_keuangan_id"] = $i;
                $data["perbaikan"] = false;
                $data["nilai_sementara"] = $request->nilai[$i - 3];
                $aksi = Nilai_keuangan::create($data);
            } else {

                $ubah = Nilai_keuangan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => $request->aspek_id,
                    'indikator_id' => $request->indikator_id,
                    'sub_indikator_keuangan_id' => $i
                ])->update([
                    'nilai_sementara' => $request->nilai[$i - 3],
                    'perbaikan' => false
                ]);
            }

            $i++;
        }


        Catatan_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id
        ])->update([
            'catatan_sementara' => $request->catatan_sementara,
            'rekom_sementara' => $request->rekom_sementara,
            'uraian' => $request->uraian
        ]);

        return $this->rekap($request);
    }
}
