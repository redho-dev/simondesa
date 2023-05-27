<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Dokren;
use App\Models\Nilai_pemerintahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokrenController extends Controller
{
    public function formDokren(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();

        $dokrenAll = Dokren::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();

        $rkpdes = $dokrenAll->where('nama_dokren', 'rkpdes_murni_' . $tahun);
        $fisik = $dokrenAll->where('nama_dokren', 'fisik_murni_' . $tahun);
        $modal = $dokrenAll->where('nama_dokren', 'modal_murni_' . $tahun);
        $pelatihan = $dokrenAll->where('nama_dokren', 'pelatihan_murni' . $tahun);
        $blt = $dokrenAll->where('nama_dokren', 'blt_dd_' . $tahun);


        if (isset($request->dokren)) {
            $dokren = Dokren::where([
                'nama_dokren' => $request->dokren,
                'asal_id' => $infos->asal_id,
                'tahun' => $tahun
            ])->get()->count();
            if ($dokren == 0) {
                return view('adminDesa.formDokren.dokren_t', [
                    'infos' => $infos,
                    'nama_dokren' => $request->dokren,
                    'tahun' => $tahun,
                    'rkpdes' => count($rkpdes),
                    'fisik' => count($fisik),
                    'modal' => count($modal),
                    'pelatihan' => count($pelatihan),
                    'blt' => count($blt)

                ]);
            } else {
                return view('adminDesa.formDokren.dokren_e', [
                    'infos' => $infos,
                    'nama_dokren' => $request->dokren,
                    'tahun' => $tahun,
                    'rkpdes' => count($rkpdes),
                    'fisik' => count($fisik),
                    'modal' => count($modal),
                    'pelatihan' => count($pelatihan),
                    'blt' => count($blt),
                    'data' => Dokren::where([
                        'nama_dokren' => $request->dokren,
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get()

                ]);
            }
        } else {
            return view('adminDesa.formDokren.dokren', [
                'infos' => $infos,
                'nama_dokren' => $request->dokren,
                'tahun' => $tahun,
                'rkpdes' => count($rkpdes),
                'fisik' => count($fisik),
                'modal' => count($modal),
                'pelatihan' => count($pelatihan),
                'blt' => count($blt)


            ]);
        }
    }

    public function tambahDokren(Request $request)
    {


        $valid = $request->validate([
            'sk_tim_rkpdes' => 'mimes:pdf|file|max:1024',
            'bac_musrenbangdes' => 'mimes:pdf|file|max:1024',
            'bac_musdus' => 'mimes:pdf|file|max:1024',
            'daftar_hadir_musrenbangdes' => 'mimes:pdf|file|max:1024',
            'foto_musrenbangdes' =>  'image|file|max:1024',
            'dokumen_rkpdes' => 'mimes:pdf|file|max:20480|required',
        ]);

        $length = count($request->nama_data);
        for ($i = 0; $i < $length; $i++) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_dokren' => $request->nama_dokren,
                'nama_data' => $request->nama_data[$i],
                'isidata' => strip_tags($request->isidata[$i])
            ];

            Dokren::create($data);
        }
        $cek = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_pemerintahan_id' => 25
        ])->first();
        if (!$cek) {
            $data_r = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 1,
                'indikator_id' => 4,
                'sub_indikator_pemerintahan_id' => 25,
                'perbaikan' => true,
                'jumlah_data' => 1,
                'persen_data' => 100

            ];
            Nilai_pemerintahan::create($data_r);
        } else {
            Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 25
            ])->update([
                'perbaikan' => true,
                'jumlah_data' => 1,
                'persen_data' => 100
            ]);
        }

        if ($request->file('sk_tim_rkpdes')) {
            $ext = $request->sk_tim_rkpdes->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_dokren";
            $file = $request->file('sk_tim_rkpdes')->storeAs($folder, "sk_tim_rkpdes_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            Dokren::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'sk_tim_rkpdes'
            ])->update([
                'isidata' => $file
            ]);


            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 21
            ])->first();
            if (!$cek) {
                $data_r = [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 21,
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100

                ];
                Nilai_pemerintahan::create($data_r);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 21
                ])->update([
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100
                ]);
            }
        };
        if ($request->file('bac_musdus')) {
            $ext = $request->bac_musdus->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_dokren";
            $file = $request->file('bac_musdus')->storeAs($folder, "bac_musdus_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            Dokren::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'bac_musdus'
            ])->update([
                'isidata' => $file
            ]);

            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 22
            ])->first();
            if (!$cek) {
                $data_r = [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 22,
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100

                ];
                Nilai_pemerintahan::create($data_r);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 22
                ])->update([
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100
                ]);
            }
        };
        if ($request->file('bac_musrenbangdes')) {
            $ext = $request->bac_musrenbangdes->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_dokren";
            $file = $request->file('bac_musrenbangdes')->storeAs($folder, "bac_musrenbangdes_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            Dokren::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'bac_musrenbangdes'
            ])->update([
                'isidata' => $file
            ]);

            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 23
            ])->first();
            if (!$cek) {
                $data_r = [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 23,
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100

                ];
                Nilai_pemerintahan::create($data_r);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 23
                ])->update([
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100
                ]);
            }
        };


        if ($request->file('foto_musrenbangdes')) {
            $ext = $request->foto_musrenbangdes->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_dokren";
            $file = $request->file('foto_musrenbangdes')->storeAs($folder, "foto_musrenbangdes_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            Dokren::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'foto_musrenbangdes'
            ])->update([
                'isidata' => $file
            ]);
        };

        if ($request->file('dokumen_rkpdes')) {
            $ext = $request->dokumen_rkpdes->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_dokren";
            $file = $request->file('dokumen_rkpdes')->storeAs($folder, "dokumen_rkpdes_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            Dokren::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'dokumen_rkpdes'
            ])->update([
                'isidata' => $file
            ]);
            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 24
            ])->first();
            if (!$cek) {
                $data_r = [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 24,
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100

                ];
                Nilai_pemerintahan::create($data_r);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 24
                ])->update([
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100
                ]);
            }
        };

        return back()->with('tambah', 'berhasil tambah data');
    }

    public function updateDokren(Request $request)
    {

        $valid = $request->validate([
            'sk_tim_rkpdes' => 'mimes:pdf|file|max:1024',
            'bac_musrenbangdes' => 'mimes:pdf|file|max:1024',
            'daftar_hadir_musrenbangdes' => 'mimes:pdf|file|max:1024',
            'foto_musrenbangdes' =>  'image|file|max:1024',
            'dokumen_rkpdes' => 'mimes:pdf|file|max:20480',
        ]);

        $length = count($request->nama_data);

        for ($i = 0; $i < $length; $i++) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_dokren' => $request->nama_dokren,
                'nama_data' => $request->nama_data[$i],
                'isidata' => strip_tags($request->isidata[$i])
            ];
            if ($i > 4) {
                Dokren::Where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'nama_dokren' => $request->nama_dokren,
                    'nama_data' => $request->nama_data[$i]
                ])->update([
                    'isidata' => strip_tags($request->isidata[$i])
                ]);
            }
        }



        if ($request->file('sk_tim_rkpdes')) {
            if ($request->old_0 && strpos($request->old_0, $request->tahun)) {
                Storage::delete($request->old_0);
            }

            $ext = $request->sk_tim_rkpdes->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_dokren";
            $file = $request->file('sk_tim_rkpdes')->storeAs($folder, "sk_tim_rkpdes_" . $request->tahun . "-" . mt_rand(1, 100) . "."  . $ext);
            Dokren::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'sk_tim_rkpdes'
            ])->update([
                'isidata' => $file
            ]);

            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 21
            ])->first();
            if (!$cek) {
                $data_r = [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 21,
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100

                ];
                Nilai_pemerintahan::create($data_r);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 21
                ])->update([
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100
                ]);
            }
        };

        if ($request->file('bac_musdus')) {
            if ($request->old_1 && strpos($request->old_1, $request->tahun)) {
                Storage::delete($request->old_1);
            }
            $ext = $request->bac_musdus->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_dokren";
            $file = $request->file('bac_musdus')->storeAs($folder, "bac_musdus_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            Dokren::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'bac_musdus'
            ])->update([
                'isidata' => $file
            ]);

            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 22
            ])->first();
            if (!$cek) {
                $data_r = [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 22,
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100

                ];
                Nilai_pemerintahan::create($data_r);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 22
                ])->update([
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100
                ]);
            }
        };

        if ($request->file('bac_musrenbangdes')) {
            if ($request->old_2 && strpos($request->old_2, $request->tahun)) {
                Storage::delete($request->old_2);
            }
            $ext = $request->bac_musrenbangdes->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_dokren";
            $file = $request->file('bac_musrenbangdes')->storeAs($folder, "bac_musrenbangdes_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            Dokren::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'bac_musrenbangdes'
            ])->update([
                'isidata' => $file
            ]);
            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 23
            ])->first();
            if (!$cek) {
                $data_r = [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 23,
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100

                ];
                Nilai_pemerintahan::create($data_r);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 23
                ])->update([
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100
                ]);
            }
        };


        if ($request->file('foto_musrenbangdes')) {
            if ($request->old_3 && strpos($request->old_3, $request->tahun)) {
                Storage::delete($request->old_3);
            }
            $ext = $request->foto_musrenbangdes->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_dokren";
            $file = $request->file('foto_musrenbangdes')->storeAs($folder, "foto_musrenbangdes_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            Dokren::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'foto_musrenbangdes'
            ])->update([
                'isidata' => $file
            ]);
        };

        if ($request->file('dokumen_rkpdes')) {
            if ($request->old_4 && strpos($request->old_4, $request->tahun)) {
                Storage::delete($request->old_4);
            }
            $ext = $request->dokumen_rkpdes->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_dokren";
            $file = $request->file('dokumen_rkpdes')->storeAs($folder, "dokumen_rkpdes_" . $request->tahun . "-" . mt_rand(1, 100) . "."  . $ext);
            Dokren::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'dokumen_rkpdes'
            ])->update([
                'isidata' => $file
            ]);

            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 24
            ])->first();
            if (!$cek) {
                $data_r = [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 24,
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100

                ];
                Nilai_pemerintahan::create($data_r);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 24
                ])->update([
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100
                ]);
            }
        };

        return back()->with('update', 'berhasil update data');
    }

    public function jumlahKegiatan($nama_dokren, $nama_data, $tahun, $asal_id)
    {
        $data = Dokren::Where([
            'nama_dokren' => $nama_dokren,
            'nama_data' => $nama_data,
            'tahun' => $tahun,
            'asal_id' => $asal_id
        ])->first();
        if ($data) {
            return $data->isidata;
        } else {
            return false;
        }
    }

    public function tambahRenfisik(Request $request)
    {

        $jml = count($request->nama_data);
        for ($i = 1; $i < $jml; $i++) {
            $request->validate([
                'file_data_' . $i => 'mimes:pdf|file|max:20480',
            ]);
        }


        for ($i = 0; $i < $jml; $i++) {

            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_dokren' => $request->nama_dokren,
                'nama_data' => $request->nama_data[$i],
                'isidata' => strip_tags($request->isidata[$i]),
                'volume' => strip_tags($request->volume[$i]),
                'satuan' => strip_tags($request->satuan[$i]),
                'pagu' => strip_tags($request->pagu[$i]),
            ];
            // if ($request->file('file_data_' . $i + 1)) {
            //     $ext = $request->file('file_data_' . $i + 1)->extension();
            //     $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_dokren";
            //     $file = $request->file('file_data_' . $i + 1)->storeAs($folder, "desain_rab_" . mt_rand(1, 10) . "-" . $i + 1 . "." . $ext);
            // } else {
            //     $file = '';
            // }

            // $data["file_data"] = $file;

            Dokren::create($data);
        }

        return back()->with('tambah', 'berhasil tambah data');
    }

    public function updateRenfisik(Request $request)
    {

        $jml = count($request->nama_data);
        // for ($i = 1; $i < $jml; $i++) {
        //     $request->validate([
        //         'file_data_' . $i => 'mimes:pdf|file|max:20480',
        //     ]);
        // }

        for ($i = 0; $i < $jml; $i++) {

            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_dokren' => $request->nama_dokren,
                'nama_data' => $request->nama_data[$i],
                'isidata' => strip_tags($request->isidata[$i]),
                'volume' => strip_tags($request->volume[$i]),
                'satuan' => strip_tags($request->satuan[$i]),
                'pagu' => strip_tags($request->pagu[$i]),
            ];


            Dokren::Where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_dokren' => $request->nama_dokren,
                'nama_data' => $request->nama_data[$i]
            ])->update([
                'isidata' => strip_tags($request->isidata[$i]),
                'volume' => strip_tags($request->volume[$i]),
                'satuan' => strip_tags($request->satuan[$i]),
                'pagu' => strip_tags($request->pagu[$i]),
            ]);

            // if ($request->file('file_data_' . $i + 1)) {
            //     $ext = $request->file('file_data_' . $i + 1)->extension();
            //     $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_dokren";
            //     $file = $request->file('file_data_' . $i + 1)->storeAs($folder, "desain_rab_" . mt_rand(1, 10) . "-" . $i + 1 . "." . $ext);
            //     Dokren::Where([
            //         'asal_id' => $request->asal_id,
            //         'tahun' => $request->tahun,
            //         'nama_dokren' => $request->nama_dokren,
            //         'nama_data' => $request->nama_data[$i]
            //     ])->update([
            //         'file_data' => $file
            //     ]);
            // } else {
            //     $file[$i] = '';
            // }
        }

        return back()->with('update', 'berhasil update data');
    }

    public function tambahBlt(Request $request)
    {
        for ($i = 0; $i <= 1; $i++) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_dokren' => $request->nama_dokren,
                'nama_data' => $request->nama_data[$i],
                'isidata' => strip_tags($request->isidata[$i])
            ];
            Dokren::create($data);
        }
        if ($request->file('bac_musdes_blt')) {
            $ext = $request->bac_musdes_blt->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_dokren";
            $file = $request->file('bac_musdes_blt')->storeAs($folder, "bac_musdes_blt_" . $request->tahun . mt_rand(1, 100) . "." . $ext);
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_dokren' => $request->nama_dokren,
                'nama_data' => 'bac_musdes_blt_' . $request->tahun,
                'isidata' => $file
            ];
            Dokren::create($data);
        }
        if ($request->file('sk_camat_blt')) {
            $ext = $request->sk_camat_blt->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_dokren";
            $file = $request->file('sk_camat_blt')->storeAs($folder, "sk_camat_blt_" . $request->tahun . mt_rand(1, 100) . "." . $ext);
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_dokren' => $request->nama_dokren,
                'nama_data' => 'sk_camat_blt_' . $request->tahun,
                'isidata' => $file
            ];
            Dokren::create($data);
        }

        return back()->with('tambah', 'berhasil tambah data');
    }

    public function updateBlt(Request $request)
    {

        for ($i = 0; $i <= 1; $i++) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_dokren' => $request->nama_dokren,
                'nama_data' => $request->nama_data[$i],

            ];
            Dokren::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_dokren' => $request->nama_dokren,
                'nama_data' => $request->nama_data[$i]
            ])->update([
                'isidata' => strip_tags($request->isidata[$i])
            ]);
        }
        if ($request->file('bac_musdes_blt')) {
            if ($request->old_1 && strpos($request->old_1, $request->tahun)) {
                Storage::delete($request->old_1);
            }

            $ext = $request->bac_musdes_blt->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_dokren";
            $file = $request->file('bac_musdes_blt')->storeAs($folder, "bac_musdes_blt_" . $request->tahun . mt_rand(1, 100) . "." . $ext);
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_dokren' => $request->nama_dokren,
                'nama_data' => 'bac_musdes_blt_' . $request->tahun,
                'isidata' => $file
            ];
            Dokren::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_dokren' => $request->nama_dokren,
                'nama_data' => 'bac_musdes_blt_' . $request->tahun,
            ])->update([
                'isidata' => $file
            ]);
        }
        if ($request->file('sk_camat_blt')) {
            if ($request->old_2 && strpos($request->old_2, $request->tahun)) {
                Storage::delete($request->old_2);
            }
            $ext = $request->sk_camat_blt->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_dokren";
            $file = $request->file('sk_camat_blt')->storeAs($folder, "sk_camat_blt_" . $request->tahun . mt_rand(1, 100) . "." . $ext);
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_dokren' => $request->nama_dokren,
                'nama_data' => 'sk_camat_blt_' . $request->tahun,
                'isidata' => $file
            ];
            Dokren::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_dokren' => $request->nama_dokren,
                'nama_data' => 'sk_camat_blt_' . $request->tahun,
            ])->update([
                'isidata' => $file
            ]);
        }

        return back()->with('update', 'berhasil update data');
    }
}
