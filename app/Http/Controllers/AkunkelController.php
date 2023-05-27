<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Akunkel;
use App\Models\Nilai_pemerintahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AkunkelController extends Controller
{
    public function formAkunkel(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();

        $data = Akunkel::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();

        if (count($data) == 0) {
            return view('adminDesa.akunkel.form_akunkel', [
                'tahun' => $tahun,
                'infos' => $infos,
            ]);
        } else {
            return view('adminDesa.akunkel.form_akunkel_ef', [
                'tahun' => $tahun,
                'infos' => $infos,
                'dataAkun' => $data

            ]);
        }
    }

    public function tambahAkunkel(Request $request)
    {
        $request->validate([
            'upload_sotk' => 'file|mimes:pdf|max:1024',
            'upload_sklpm' => 'file|mimes:pdf|max:1024',
            'upload_sktaruna' => 'file|mimes:pdf|max:1024',
            'upload_linmas' => 'file|mimes:pdf|max:1024',
            'upload_pkk' => 'file|mimes:pdf|max:1024',
            'upload_kantor_desa' => 'file|mimes:jpg,png,jpeg,gif|max:1024',
            'upload_kantor_bpd' => 'file|mimes:jpg,png,jpeg,gif|max:1024',
            'upload_papan_struktur' => 'file|mimes:jpg,png,jpeg,gif|max:1024',

        ]);


        foreach ($request->nama_data as $nm) {
            $data = [
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => $nm,
            ];
            Akunkel::create($data);
        }

        $cek = Nilai_pemerintahan::where([
            'tahun' => $request->tahun,
            'asal_id' => $request->asal_id,
            'indikator_id' => 3
        ])->count();

        if (!$cek) {
            $data = [
                'aspek_id' => 1,
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'indikator_id' => 3
            ];
            $i = 12;
            foreach ($request->nama_data as $nm) {
                $data["sub_indikator_pemerintahan_id"] = $i;
                Nilai_pemerintahan::create($data);
                $i++;
            }
        }


        if ($request->file('upload_sotk')) {
            $ext = $request->upload_sotk->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kelembagaan";
            $file = $request->file('upload_sotk')->storeAs($folder, "upload_sotk_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Akunkel::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'sotk',

            ])->update([
                'file_data' => $file,

            ]);

            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 12
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('upload_sklpm')) {
            $ext = $request->upload_sklpm->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kelembagaan";
            $file = $request->file('upload_sklpm')->storeAs($folder, "upload_sklpm_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Akunkel::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'sklpm',

            ])->update([
                'file_data' => $file,

            ]);
            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 13
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('upload_sktaruna')) {
            $ext = $request->upload_sktaruna->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kelembagaan";
            $file = $request->file('upload_sktaruna')->storeAs($folder, "upload_sktaruna_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Akunkel::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'sktaruna',

            ])->update([
                'file_data' => $file,

            ]);
            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 14
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('upload_linmas')) {
            $ext = $request->upload_linmas->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kelembagaan";
            $file = $request->file('upload_linmas')->storeAs($folder, "upload_linmas_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Akunkel::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'sklinmas',

            ])->update([
                'file_data' => $file,

            ]);
            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 15
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('upload_pkk')) {
            $ext = $request->upload_pkk->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kelembagaan";
            $file = $request->file('upload_pkk')->storeAs($folder, "upload_pkk_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Akunkel::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'skpkk',

            ])->update([
                'file_data' => $file,

            ]);
            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 16
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }


        if ($request->file('upload_kantor_desa')) {
            $ext = $request->upload_kantor_desa->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kelembagaan";
            $file = $request->file('upload_kantor_desa')->storeAs($folder, "upload_kantor_desa_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Akunkel::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'kantor_desa',

            ])->update([
                'file_data' => $file,

            ]);
            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 17
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('upload_papan_struktur')) {
            $ext = $request->upload_papan_struktur->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kelembagaan";
            $file = $request->file('upload_papan_struktur')->storeAs($folder, "upload_papan_struktur_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Akunkel::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'papan_struktur',

            ])->update([
                'file_data' => $file,

            ]);
            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 18
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('upload_kantor_bpd')) {
            $ext = $request->upload_kantor_bpd->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kelembagaan";
            $file = $request->file('upload_kantor_bpd')->storeAs($folder, "upload_kantor_bpd_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Akunkel::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'kantor_bpd',

            ])->update([
                'file_data' => $file,

            ]);
            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 19
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        return back()->with('tambah', 'data berhasil ditambah');
    }

    public function updateAkunkel(Request $request)
    {
        $request->validate([
            'upload_sotk' => 'file|mimes:pdf|max:1024',
            'upload_sklpm' => 'file|mimes:pdf|max:1024',
            'upload_sktaruna' => 'file|mimes:pdf|max:1024',
            'upload_linmas' => 'file|mimes:pdf|max:1024',
            'upload_pkk' => 'file|mimes:pdf|max:1024',
            'upload_kantor_desa' => 'file|mimes:jpg,png,jpeg,gif|max:1024',
            'upload_kantor_bpd' => 'file|mimes:jpg,png,jpeg,gif|max:1024',
            'upload_papan_struktur' => 'file|mimes:jpg,png,jpeg,gif|max:1024',

        ]);


        if ($request->file('upload_sotk')) {
            if ($request->old_0 && strpos($request->old_0, $request->tahun)) {
                Storage::delete($request->old_0);
            }
            $ext = $request->upload_sotk->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kelembagaan";
            $file = $request->file('upload_sotk')->storeAs($folder, "upload_sotk_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Akunkel::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'sotk',

            ])->update([
                'file_data' => $file,
            ]);

            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 12
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('upload_sklpm')) {
            if ($request->old_1 && strpos($request->old_1, $request->tahun)) {
                Storage::delete($request->old_1);
            }
            $ext = $request->upload_sklpm->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kelembagaan";
            $file = $request->file('upload_sklpm')->storeAs($folder, "upload_sklpm_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Akunkel::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'sklpm',

            ])->update([
                'file_data' => $file,

            ]);
            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 13
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('upload_sktaruna')) {
            if ($request->old_2 && strpos($request->old_2, $request->tahun)) {
                Storage::delete($request->old_2);
            }
            $ext = $request->upload_sktaruna->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kelembagaan";
            $file = $request->file('upload_sktaruna')->storeAs($folder, "upload_sktaruna_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Akunkel::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'sktaruna',

            ])->update([
                'file_data' => $file,

            ]);
            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 14
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('upload_linmas')) {
            if ($request->old_3 && strpos($request->old_3, $request->tahun)) {
                Storage::delete($request->old_3);
            }
            $ext = $request->upload_linmas->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kelembagaan";
            $file = $request->file('upload_linmas')->storeAs($folder, "upload_linmas_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Akunkel::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'sklinmas',

            ])->update([
                'file_data' => $file,

            ]);
            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 15
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('upload_pkk')) {
            if ($request->old_4 && strpos($request->old_4, $request->tahun)) {
                Storage::delete($request->old_4);
            }
            $ext = $request->upload_pkk->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kelembagaan";
            $file = $request->file('upload_pkk')->storeAs($folder, "upload_pkk_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Akunkel::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'skpkk',

            ])->update([
                'file_data' => $file,

            ]);
            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 16
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }


        if ($request->file('upload_kantor_desa')) {
            if ($request->old_5 && strpos($request->old_5, $request->tahun)) {
                Storage::delete($request->old_5);
            }
            $ext = $request->upload_kantor_desa->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kelembagaan";
            $file = $request->file('upload_kantor_desa')->storeAs($folder, "upload_kantor_desa_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Akunkel::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'kantor_desa',

            ])->update([
                'file_data' => $file,

            ]);
            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 17
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('upload_papan_struktur')) {
            if ($request->old_6 && strpos($request->old_6, $request->tahun)) {
                Storage::delete($request->old_6);
            }
            $ext = $request->upload_papan_struktur->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kelembagaan";
            $file = $request->file('upload_papan_struktur')->storeAs($folder, "upload_papan_struktur_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Akunkel::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'papan_struktur',

            ])->update([
                'file_data' => $file,

            ]);
            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 18
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('upload_kantor_bpd')) {
            if ($request->old_7 && strpos($request->old_7, $request->tahun)) {
                Storage::delete($request->old_7);
            }
            $ext = $request->upload_kantor_bpd->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kelembagaan";
            $file = $request->file('upload_kantor_bpd')->storeAs($folder, "upload_kantor_bpd_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Akunkel::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'kantor_bpd',

            ])->update([
                'file_data' => $file,

            ]);
            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 19
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }


        return back()->with('success', 'data berhasil diupdate');
    }

    public function copyAkunkel(Request $request)
    {
        $dataasalnilai = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal,
            'indikator_id' => 3
        ])->get();

        $datatuju = Akunkel::where(
            [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahuncopy,
            ]
        )->count();


        if ($request->timpadata) {
            Akunkel::where(
                [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahuncopy
                ]
            )->delete();

            $datas = Akunkel::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahunasal
            ])->get();
            foreach ($datas as $data) {
                $data['tahun'] = $request->tahuncopy;
                $data['id'] = '';
                $copydata = Akunkel::create($data->toArray());
            }

            if ($copydata) {

                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahuncopy,
                    'indikator_id' => 3
                ])->delete();
                foreach ($dataasalnilai as $datan) {
                    $datan['tahun'] = $request->tahuncopy;
                    $datan['id'] = '';
                    $datan['perbaikan'] = true;
                    // $datan['nilai_sementara'] = NULL;
                    // $datan['nilai_akhir'] = NULL;
                    Nilai_pemerintahan::create($datan->toArray());
                }
                return redirect()->back()->with('success', 'Data berhasil di copy');
            }

            exit();
            die();
        }

        if ($datatuju > 0) {
            return back()->with('timpaAll', $request->tahuncopy);
            exit();
            die();
        }

        $datas = Akunkel::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal
        ])->get();
        foreach ($datas as $data) {
            $data['tahun'] = $request->tahuncopy;
            $data['id'] = '';
            $copydata = Akunkel::create($data->toArray());
        }

        if ($copydata) {
            Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahuncopy,
                'indikator_id' => 3
            ])->delete();
            foreach ($dataasalnilai as $datan) {
                $datan['tahun'] = $request->tahuncopy;
                $datan['id'] = '';
                $datan['perbaikan'] = true;
                // $datan['nilai_sementara'] = NULL;
                // $datan['nilai_akhir'] = NULL;
                Nilai_pemerintahan::create($datan->toArray());
            }


            return redirect()->back()->with('success', 'Data berhasil di copy');
        }
    }
}
