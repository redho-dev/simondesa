<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Rapbd;
use App\Models\Nilai_pemerintahan;
use Illuminate\Support\Facades\Storage;

class RapbdesController extends Controller
{
    public function formRapbdes(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();

        $dokrenAll = Rapbd::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();

        $dokumen = $dokrenAll->where('jenis', 'dokumen');
        $fisik = $dokrenAll->where('jenis', 'fisik');
        $jumfisik = $dokrenAll->where('nama_data', 'jumlah_kegiatan_fisik')->pluck('isi_data')->first();
        $jumfisik = Intval($jumfisik);

        if (isset($request->jenis)) {
            $Rapbd = Rapbd::where([
                'jenis' => $request->jenis,
                'asal_id' => $infos->asal_id,
                'tahun' => $tahun
            ])->get()->count();

            if ($Rapbd == 0) {
                return view('adminDesa.formRapbdes.Rapbdes_t', [
                    'infos' => $infos,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'dokumen' => count($dokumen),
                    'fisik' => count($fisik),
                    'jumfisik' => $jumfisik
                ]);
            } else {
                return view('adminDesa.formRapbdes.Rapbdes_e', [
                    'infos' => $infos,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'dokumen' => count($dokumen),
                    'fisik' => count($fisik),
                    'jumfisik' => $jumfisik,
                    'data' => Rapbd::where([
                        'jenis' => $request->jenis,
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get()


                ]);
            }
        } else {
            return view('adminDesa.formRapbdes.Rapbdes', [
                'infos' => $infos,
                'jenis' => $request->jenis,
                'tahun' => $tahun,
                'dokumen' => count($dokumen),
                'fisik' => count($fisik)

            ]);
        }
    }

    public function doktambah(Request $request)
    {
        $request->validate([
            'dokumen_rapbdes' => 'mimes:pdf|file|max:20480',
            'penyampaian' => 'mimes:pdf|file|max:1024',
            'bac' => 'mimes:pdf|file|max:1024',
            'foto_musdes' =>  'image|file|max:1024',
            'keputusan_bpd' => 'mimes:pdf|file|max:1024',
            'evaluasi' => 'mimes:pdf|file|max:1024'
        ]);

        $length = count($request->nama_data);
        for ($i = 0; $i < $length; $i++) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => $request->nama_data[$i]
            ];
            Rapbd::create($data);
        }
        if ($request->file('dokumen_rapbdes')) {
            $ext = $request->dokumen_rapbdes->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_rapbdes";
            $file1 = $request->file('dokumen_rapbdes')->storeAs($folder, "dokumen_rapbdes_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            Rapbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'dokumen_rapbdes'
            ])->update([
                'isi_data' => $file1
            ]);

            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 26
            ])->first();
            if (!$cek) {
                $data_r = [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 26,
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100

                ];
                Nilai_pemerintahan::create($data_r);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 26
                ])->update([
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100
                ]);
            }
        }

        if ($request->file('penyampaian')) {
            $ext = $request->penyampaian->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_rapbdes";
            $file2 = $request->file('penyampaian')->storeAs($folder, "penyampaian_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            Rapbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'penyampaian'
            ])->update([
                'isi_data' => $file2
            ]);
        }

        if ($request->file('bac')) {
            $ext = $request->bac->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_rapbdes";
            $file3 = $request->file('bac')->storeAs($folder, "bac_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            Rapbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'bac'
            ])->update([
                'isi_data' => $file3
            ]);

            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 27
            ])->first();
            if (!$cek) {
                $data_r = [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 27,
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100

                ];
                Nilai_pemerintahan::create($data_r);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 27
                ])->update([
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100
                ]);
            }
        }

        if ($request->file('foto_musdes')) {
            $ext = $request->foto_musdes->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_rapbdes";
            $file4 = $request->file('foto_musdes')->storeAs($folder, "foto_musdes_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            Rapbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'foto_musdes'
            ])->update([
                'isi_data' => $file4
            ]);
        }

        if ($request->file('keputusan_bpd')) {
            $ext = $request->keputusan_bpd->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_rapbdes";
            $file5 = $request->file('keputusan_bpd')->storeAs($folder, "keputusan_bpd_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            Rapbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'keputusan_bpd'
            ])->update([
                'isi_data' => $file5
            ]);

            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 28
            ])->first();
            if (!$cek) {
                $data_r = [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 28,
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100

                ];
                Nilai_pemerintahan::create($data_r);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 28
                ])->update([
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100
                ]);
            }
        }

        if ($request->file('evaluasi')) {
            $ext = $request->evaluasi->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_rapbdes";
            $file5 = $request->file('evaluasi')->storeAs($folder, "evaluasi_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            Rapbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'evaluasi'
            ])->update([
                'isi_data' => $file5
            ]);

            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 29
            ])->first();
            if (!$cek) {
                $data_r = [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 29,
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100

                ];
                Nilai_pemerintahan::create($data_r);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 29
                ])->update([
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100
                ]);
            }
        }

        if ($request->pendapatan_rapbdes) {
            Rapbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'pendapatan_rapbdes'
            ])->update([
                'isi_data' => $request->pendapatan_rapbdes
            ]);
        }
        if ($request->belanja_rapbdes) {
            Rapbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'belanja_rapbdes'
            ])->update([
                'isi_data' => $request->belanja_rapbdes
            ]);
        }
        if ($request->pembiayaan_rapbdes) {
            Rapbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'pembiayaan_rapbdes'
            ])->update([
                'isi_data' => $request->pembiayaan_rapbdes
            ]);
        }
        if ($request->jumlah_total_kegiatan) {
            Rapbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'jumlah_total_kegiatan'
            ])->update([
                'isi_data' => $request->jumlah_total_kegiatan
            ]);
        }
        if ($request->jumlah_kegiatan_fisik) {
            Rapbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'jumlah_kegiatan_fisik'
            ])->update([
                'isi_data' => $request->jumlah_kegiatan_fisik
            ]);
        }

        return back()->with('success', 'Berhasil Kirim Data');
    }

    public function dokupdate(Request $request)
    {
        $request->validate([
            'dokumen_rapbdes' => 'mimes:pdf|file|max:20480',
            'penyampaian' => 'mimes:pdf|file|max:1024',
            'bac' => 'mimes:pdf|file|max:1024',
            'foto_musdes' =>  'image|file|max:1024',
            'keputusan_bpd' => 'mimes:pdf|file|max:1024',
            'evaluasi' => 'mimes:pdf|file|max:1024'
        ]);


        if ($request->file('dokumen_rapbdes')) {
            $ext = $request->dokumen_rapbdes->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_rapbdes";
            $file1 = $request->file('dokumen_rapbdes')->storeAs($folder, "dokumen_rapbdes_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            Rapbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'dokumen_rapbdes'
            ])->update([
                'isi_data' => $file1
            ]);
            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 26
            ])->first();
            if (!$cek) {
                $data_r = [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 26,
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100

                ];
                Nilai_pemerintahan::create($data_r);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 26
                ])->update([
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100
                ]);
            }
        }

        if ($request->file('penyampaian')) {
            $ext = $request->penyampaian->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_rapbdes";
            $file2 = $request->file('penyampaian')->storeAs($folder, "penyampaian_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            Rapbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'penyampaian'
            ])->update([
                'isi_data' => $file2
            ]);
        }

        if ($request->file('bac')) {
            $ext = $request->bac->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_rapbdes";
            $file3 = $request->file('bac')->storeAs($folder, "bac_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            Rapbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'bac'
            ])->update([
                'isi_data' => $file3
            ]);

            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 27
            ])->first();
            if (!$cek) {
                $data_r = [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 27,
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100

                ];
                Nilai_pemerintahan::create($data_r);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 27
                ])->update([
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100
                ]);
            }
        }

        if ($request->file('foto_musdes')) {
            $ext = $request->foto_musdes->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_rapbdes";
            $file4 = $request->file('foto_musdes')->storeAs($folder, "foto_musdes_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            Rapbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'foto_musdes'
            ])->update([
                'isi_data' => $file4
            ]);
        }

        if ($request->file('keputusan_bpd')) {
            $ext = $request->keputusan_bpd->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_rapbdes";
            $file5 = $request->file('keputusan_bpd')->storeAs($folder, "keputusan_bpd_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            Rapbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'keputusan_bpd'
            ])->update([
                'isi_data' => $file5
            ]);
            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 28
            ])->first();
            if (!$cek) {
                $data_r = [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 28,
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100

                ];
                Nilai_pemerintahan::create($data_r);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 28
                ])->update([
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100
                ]);
            }
        }

        if ($request->file('evaluasi')) {
            $ext = $request->evaluasi->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_rapbdes";
            $file5 = $request->file('evaluasi')->storeAs($folder, "evaluasi_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            Rapbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'evaluasi'
            ])->update([
                'isi_data' => $file5
            ]);
            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 29
            ])->first();
            if (!$cek) {
                $data_r = [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 29,
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100

                ];
                Nilai_pemerintahan::create($data_r);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 29
                ])->update([
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100
                ]);
            }
        }

        if ($request->pendapatan_rapbdes) {
            Rapbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'pendapatan_rapbdes'
            ])->update([
                'isi_data' => $request->pendapatan_rapbdes
            ]);
        }
        if ($request->belanja_rapbdes) {
            Rapbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'belanja_rapbdes'
            ])->update([
                'isi_data' => $request->belanja_rapbdes
            ]);
        }
        if ($request->pembiayaan_rapbdes) {
            Rapbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'pembiayaan_rapbdes'
            ])->update([
                'isi_data' => $request->pembiayaan_rapbdes
            ]);
        }
        if ($request->jumlah_total_kegiatan) {
            Rapbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'jumlah_total_kegiatan'
            ])->update([
                'isi_data' => $request->jumlah_total_kegiatan
            ]);
        }
        if ($request->jumlah_kegiatan_fisik) {
            Rapbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'jumlah_kegiatan_fisik'
            ])->update([
                'isi_data' => $request->jumlah_kegiatan_fisik
            ]);
        }

        return back()->with('update', 'Berhasil Update Data');
    }
}
