<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Asal;
use App\Models\Rpjmd;
use App\Models\Dokren;
use App\Models\Datum;
use App\Models\Akunkel;
use App\Models\Kecamatan;
use App\Models\Apbdes_dokumen;
use App\Models\Rapbd;
use App\Models\Rekap_nilai_aspek;
use App\Models\Rekap_nilai_indikator;
use App\Models\Indikator;
use App\Models\Sub_indikator_pemerintahan;

use App\Models\Catatan_pemerintahan;
use App\Models\Nilai_pemerintahan;
use Illuminate\Http\Request;

class AkunPemdesdokrenController extends Controller
{
    public function dokren(Request $request)
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


        $rpjmd = Rpjmd::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->get();
        $rkpd = Dokren::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->get();
        $apbdes = Apbdes_dokumen::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->first();

        $rapbdes = Rapbd::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->get();

        $dokren = count($rpjmd) + count($rkpd);
        $dokrpjmd = $rpjmd->where('nama_data', 'dokumen_rpjmd')->first();
        $norpjmd = $rpjmd->where('nama_data', 'nomor_rpjmd')->first();

        $sktim = $rkpd->where('nama_data', 'sk_tim_rkpdes')->first();

        $musdus = $rkpd->where('nama_data', 'bac_musdus')->first();
        $musren = $rkpd->where('nama_data', 'bac_musrenbangdes')->first();
        $fotomusren = $rkpd->where('nama_data', 'foto_musrenbangdes')->first();
        $dokrkpd = $rkpd->where('nama_data', 'dokumen_rkpdes')->first();
        $tglrkpd = $rkpd->where('nama_data', 'tanggal_penetapan_rkpdes')->first();

        $dok_rapbdes = $rapbdes->where('nama_data', 'dokumen_rapbdes')->first();
        $bac = $rapbdes->where('nama_data', 'bac')->first();
        $keputusan_bpd = $rapbdes->where('nama_data', 'keputusan_bpd')->first();
        $evaluasi = $rapbdes->where('nama_data', 'evaluasi')->first();
        $foto_musdes = $rapbdes->where('nama_data', 'foto_musdes')->pluck('isi_data')->first();


        if ($apbdes) {
            $apbdes_murni = $apbdes->dokumen_murni;
            $nomor_murni = $apbdes->nomor_perdes_murni;
            $tgl_murni = $apbdes->tanggal_murni;
            $penjabaran_murni = $apbdes->dokumen_penjabaran_murni;
            $desain_murni = $apbdes->desain_gambar_murni;
        } else {
            $apbdes_murni = '';
            $nomor_murni = '';
            $tgl_murni = '';
            $penjabaran_murni = '';
            $desain_murni = '';
        }

        // return $apbdes;

        // return $sktim;

        // $penilaian = Nilai_pemerintahan::where([
        //     'asal_id' => $asal_id,
        //     'tahun' => $tahun,
        //     'indikator_id' => 4
        // ])->where('nilai_sementara', '!=', NULL)->get();


        $datnil = Nilai_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 4
        ])->Orderby('sub_indikator_pemerintahan_id', 'Asc')->get();


        $penilaian = Nilai_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 4
        ])->where('nilai_sementara', '!=', NULL)->get();

        // return $datnil->where('sub_indikator_pemerintahan_id', 30)->pluck('persen_data')->first();

        $catatan = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 4
        ])->first();

        $perbaikan = $datnil->where('perbaikan', true)->first();
        $rekap = Rekap_nilai_indikator::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'aspek_id' => 1,
            'indikator_id' => 4
        ])->first();

        if (isset($request->jenis)) {
            if ($request->jenis == 'penilaian') {
                $datum = count($penilaian);
            } else {
                $datum = $dokren;
            }

            if ($datum == 0) {
                return view('adminIrbanwil.formDokren.akunPemdesdok', [
                    'desa' => $desa,
                    'infos' => $infos,
                    'asal_id' => $asal_id,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'dokren' => $dokren,
                    'datnil' => $datnil,
                    'penilaian' => count($penilaian),
                    'akunkel' => $dokren,
                    'kecamatan' => $kecamatan,
                    'deswal' => $deswal,
                    'perbaikan' => $perbaikan
                ]);
            } else {

                return view('adminIrbanwil.formDokren.akunPemdesdok_e', [
                    'desa' => $desa,
                    'asal_id' => $asal_id,
                    'infos' => $infos,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'dokren' => $dokren,
                    'datnil' => $datnil,
                    'penilaian' => count($penilaian),
                    'catatan' => $catatan,
                    'kecamatan' => $kecamatan,
                    'deswal' => $deswal,
                    'perbaikan' => $perbaikan,
                    'dokrpjmd' => $dokrpjmd,
                    'dokrkpd' => $dokrkpd,
                    'sktim' => $sktim,
                    'musdus' => $musdus,
                    'musren' => $musren,
                    'tglrkpd' => $tglrkpd,
                    'norpjmd' => $norpjmd,
                    'fotomusren' => $fotomusren,
                    'apbdes' => $apbdes,
                    'apbdes_murni' => $apbdes_murni,
                    'nomor_murni' => $nomor_murni,
                    'tgl_murni' => $tgl_murni,
                    'penjabaran_murni' => $penjabaran_murni,
                    'desain_murni' => $desain_murni,
                    'bac' => $bac,
                    'keputusan_bpd' => $keputusan_bpd,
                    'dok_rapbdes' => $dok_rapbdes,
                    'evaluasi' => $evaluasi,
                    'foto_musdes' => $foto_musdes,
                    'rekap' => $rekap



                ]);
            }
        } else {

            return view('adminIrbanwil.formDokren.akunPemdesdok', [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'jenis' => '',
                'tahun' => $tahun,
                'penilaian' => count($penilaian),
                'dokren' => $dokren,
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'perbaikan' => $perbaikan
            ]);
        }
    }

    public function nilaiAkundok(Request $request)
    {


        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id
        ];


        $i = 20;
        foreach ($request->sub_indikator_pemerintahan_id as $sub) {
            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => $i
            ])->first();
            if (!$cek) {
                $data["sub_indikator_pemerintahan_id"] = $i;
                $data["perbaikan"] = false;
                $data["nilai_sementara"] = $request->nilai[$i - 20];
                $aksi = Nilai_pemerintahan::create($data);
            } else {

                $ubah = Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => $request->aspek_id,
                    'indikator_id' => $request->indikator_id,
                    'sub_indikator_pemerintahan_id' => $i
                ])->update([
                    'nilai_sementara' => $request->nilai[$i - 20],
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

    public function nilaiAkundokEdit(Request $request)
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
        $i = 20;
        foreach ($request->sub_indikator_pemerintahan_id as $sub) {
            $aksi = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => $request->aspek_id,
                'indikator_id' => $request->indikator_id,
                'sub_indikator_pemerintahan_id' => $i
            ])->update([
                'nilai_sementara' => $request->nilai[$i - 20],
                'perbaikan' => false
            ]);
            $i++;
        }

        if ($aksi) {
            return $this->rekap($request);
        }
    }

    public function tamcaDokren(Request $request)
    {
        $dokren = $request->dokren;
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'nama_data' => $request->nama_data
        ];
        if ($dokren == 'rpjmd') {
            Rpjmd::where($data)->update([
                'catatan' => $request->catatan,
                'saran' => $request->saran
            ]);
        } elseif ($dokren == 'rkpdes') {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => $request->nama_data
            ];
            Dokren::where($data)->update([
                'catatan' => $request->catatan,
                'saran' => $request->saran
            ]);
        } elseif ($dokren == 'rapbdes') {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => $request->nama_data
            ];
            Rapbd::where($data)->update([
                'catatan' => $request->catatan,
                'saran' => $request->saran
            ]);
        } elseif ($dokren == 'apbdes') {
            $kolom = $request->nama_data;
            if ($kolom == 'dokumen') {
                Apbdes_dokumen::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun
                ])->update([
                    'catatan_dokumen' => $request->catatan_dokumen,
                    'saran_dokumen' => $request->saran_dokumen,
                ]);
            } elseif ($kolom == 'desain') {
                Apbdes_dokumen::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun
                ])->update([
                    'catatan_desain' => $request->catatan_desain,
                    'saran_desain' => $request->saran_desain,
                ]);
            } elseif ($kolom == 'tanggal') {
                Apbdes_dokumen::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun
                ])->update([
                    'catatan_tanggal' => $request->catatan_tanggal,
                    'saran_tanggal' => $request->saran_tanggal,
                ]);
            } elseif ($kolom == 'penjabaran') {
                Apbdes_dokumen::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun
                ])->update([
                    'catatan_penjabaran' => $request->catatan_penjabaran,
                    'saran_penjabaran' => $request->saran_penjabaran,
                ]);
            }
        }

        return back()->with('success', 'berhasil tambah catatan dan saran');
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
