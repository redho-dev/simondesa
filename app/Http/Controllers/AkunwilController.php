<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Akunwil;
use App\Models\Datum;
use App\Models\Nilai_pemerintahan;
use App\Models\Sub_indikator_pemerintahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AkunwilController extends Controller
{
    public function formAkunwil(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();
        $dawil = Datum::where([
            'jenis' => 'kewilayahan',
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();


        if (!count($dawil)) {
            return redirect('/adminDesa/formKewilayahan?jenis=kewilayahan&tahun=' . $tahun)->with('kosong', 'data kosong, data monografi kewilayahan tahun ' . $tahun . ' harus diinput terlebih dahulu! ');
        }

        $dataAkunwil = Akunwil::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get()->count();

        if ($dataAkunwil == 0) {
            return view('adminDesa.akunwil.form_akunwil', [
                'tahun' => $tahun,
                'infos' => $infos,
                'dawil' => $dawil

            ]);
        } else {
            return view('adminDesa.akunwil.form_akunwil_e', [
                'tahun' => $tahun,
                'infos' => $infos,
                'dawil' => $dawil,
                'dataAkun' => Akunwil::where([
                    'asal_id' => $infos->asal_id,
                    'tahun' => $tahun
                ])->get()

            ]);
        }
    }

    public function tambahAkunwil(Request $request)
    {

        $request->validate([
            'upload_dasar_hukum' => 'file|mimes:pdf|max:1024',
            'upload_batas_utara' => 'file|image|max:1024',
            'upload_batas_selatan' => 'file|image|max:1024',
            'upload_batas_barat' => 'file|image|max:1024',
            'upload_batas_timur' => 'file|image|max:1024',
            'upload_peta_batas' => 'file|image|max:5120',
        ]);

        $cek = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'indikator_id' => 2
        ])->first();
        $danil = [
            'tahun' => $request->tahun,
            'asal_id' => $request->asal_id,
            'aspek_id' => 1,
            'indikator_id' => 2
        ];

        $i = 6;
        foreach ($request->nama_data as $nm) {
            $data = [
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => $nm
            ];
            Akunwil::create($data);

            if (!$cek) {
                $danil['sub_indikator_pemerintahan_id'] = $i;
                Nilai_pemerintahan::create($danil);
            }

            $i++;
        }


        if ($request->file('upload_dasar_hukum')) {
            $ext = $request->upload_dasar_hukum->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kewilayahan";
            $file = $request->file('upload_dasar_hukum')->storeAs($folder, "upload_dasar_hukum_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            Akunwil::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'dasar_hukum'
            ])->update([
                'file_data' => $file
            ]);

            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 6
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('upload_batas_utara')) {
            $ext = $request->upload_batas_utara->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kewilayahan";
            $file = $request->file('upload_batas_utara')->storeAs($folder, "upload_batas_utara_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            Akunwil::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'patok_batas_utara'
            ])->update([
                'file_data' => $file
            ]);

            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 7
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('upload_batas_selatan')) {
            $ext = $request->upload_batas_selatan->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kewilayahan";
            $file = $request->file('upload_batas_selatan')->storeAs($folder, "upload_batas_selatan_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            Akunwil::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'patok_batas_selatan'
            ])->update([
                'file_data' => $file
            ]);

            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 8
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }



        if ($request->file('upload_batas_barat')) {
            $ext = $request->upload_batas_barat->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kewilayahan";
            $file = $request->file('upload_batas_barat')->storeAs($folder, "upload_batas_barat_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            Akunwil::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'patok_batas_barat'
            ])->update([
                'file_data' => $file
            ]);

            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 9
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('upload_batas_timur')) {
            $ext = $request->upload_batas_timur->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kewilayahan";
            $file = $request->file('upload_batas_timur')->storeAs($folder, "upload_batas_timur_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            Akunwil::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'patok_batas_timur'
            ])->update([
                'file_data' => $file
            ]);

            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 10
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('upload_peta_batas')) {
            $ext = $request->upload_peta_batas->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kewilayahan";
            $file = $request->file('upload_peta_batas')->storeAs($folder, "upload_peta_batas_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            Akunwil::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'peta_batas'
            ])->update([
                'file_data' => $file
            ]);

            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 11
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }


        return back()->with('tambah', 'data berhasil ditambah');
    }

    public function updateAkunwil(Request $request)
    {

        $request->validate([
            'upload_dasar_hukum' => 'file|mimes:pdf|max:1024',
            'upload_batas_utara' => 'file|image|max:1024',
            'upload_batas_selatan' => 'file|image|max:1024',
            'upload_batas_barat' => 'file|image|max:1024',
            'upload_batas_timur' => 'file|image|max:1024',
            'upload_peta_batas' => 'file|image|max:5120',
        ]);
        if ($request->file('upload_dasar_hukum')) {
            if ($request->old_0 && strpos($request->old_0, $request->tahun)) {

                Storage::delete($request->old_0);
            }

            $ext = $request->upload_dasar_hukum->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kewilayahan";
            $file = $request->file('upload_dasar_hukum')->storeAs($folder, "upload_dasar_hukum_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            Akunwil::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'dasar_hukum'
            ])->update([
                'file_data' => $file
            ]);

            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'indikator_id' => 2,
                'sub_indikator_pemerintahan_id' => 6
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('upload_batas_utara')) {
            if ($request->old_1 && strpos($request->old_1, $request->tahun)) {
                Storage::delete($request->old_1);
            }
            $ext = $request->upload_batas_utara->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kewilayahan";
            $file = $request->file('upload_batas_utara')->storeAs($folder, "upload_batas_utara_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            Akunwil::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'patok_batas_utara'
            ])->update([
                'file_data' => $file
            ]);
            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'indikator_id' => 2,
                'sub_indikator_pemerintahan_id' => 7
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('upload_batas_selatan')) {
            if ($request->old_2 && strpos($request->old_2, $request->tahun)) {
                Storage::delete($request->old_2);
            }
            $ext = $request->upload_batas_selatan->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kewilayahan";
            $file = $request->file('upload_batas_selatan')->storeAs($folder, "upload_batas_selatan_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            Akunwil::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'patok_batas_selatan'
            ])->update([
                'file_data' => $file
            ]);
            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'indikator_id' => 2,
                'sub_indikator_pemerintahan_id' => 8
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }



        if ($request->file('upload_batas_barat')) {
            if ($request->old_3 && strpos($request->old_3, $request->tahun)) {
                Storage::delete($request->old_3);
            }
            $ext = $request->upload_batas_barat->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kewilayahan";
            $file = $request->file('upload_batas_barat')->storeAs($folder, "upload_batas_barat_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            Akunwil::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'patok_batas_barat'
            ])->update([
                'file_data' => $file
            ]);
            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'indikator_id' => 2,
                'sub_indikator_pemerintahan_id' => 9
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('upload_batas_timur')) {
            if ($request->old_4 && strpos($request->old_4, $request->tahun)) {
                Storage::delete($request->old_4);
            }
            $ext = $request->upload_batas_timur->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kewilayahan";
            $file = $request->file('upload_batas_timur')->storeAs($folder, "upload_batas_timur_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            Akunwil::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'patok_batas_timur'
            ])->update([
                'file_data' => $file
            ]);
            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'indikator_id' => 2,
                'sub_indikator_pemerintahan_id' => 10
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('upload_peta_batas')) {
            if ($request->old_5 && strpos($request->old_5, $request->tahun)) {
                Storage::delete($request->old_5);
            }
            $ext = $request->upload_peta_batas->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_kewilayahan";
            $file = $request->file('upload_peta_batas')->storeAs($folder, "upload_peta_batas_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            Akunwil::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'peta_batas'
            ])->update([
                'file_data' => $file
            ]);
            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'indikator_id' => 2,
                'sub_indikator_pemerintahan_id' => 11
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        return back()->with('update', 'data berhasil update');
    }

    public function copyAkunwil(Request $request)
    {

        $dataasalnilai = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal,
            'indikator_id' => 2
        ])->get();

        $datatuju = Akunwil::where(
            [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahuncopy,

            ]
        )->count();

        if ($request->timpadata) {
            Akunwil::where(
                [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahuncopy

                ]
            )->delete();

            $datas = Akunwil::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahunasal
            ])->get();
            foreach ($datas as $data) {
                $data['tahun'] = $request->tahuncopy;
                $data['id'] = '';
                $copydata = Akunwil::create($data->toArray());
            }

            if ($copydata) {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahuncopy,
                    'indikator_id' => 2
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

        $datas = Akunwil::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal
        ])->get();
        foreach ($datas as $data) {
            $data['tahun'] = $request->tahuncopy;
            $data['id'] = '';
            $copydata = Akunwil::create($data->toArray());
        }

        if ($copydata) {
            Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahuncopy,
                'indikator_id' => 2
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
