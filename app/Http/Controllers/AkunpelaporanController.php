<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Pelaporan;
use App\Models\Nilai_pemerintahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AkunpelaporanController extends Controller
{
    public function formAkunpelaporan(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $tahun = $request->tahun;
        }
        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();

        $pelaporan = Pelaporan::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();
        $lppd = $pelaporan->where('nama_data', 'lppd')->first();
        $surat_lppd = $pelaporan->where('nama_data', 'surat_lppd')->first();
        $lkpd = $pelaporan->where('nama_data', 'lkpd')->first();
        $surat_lkpd = $pelaporan->where('nama_data', 'surat_lkpd')->first();
        $perdes_pj = $pelaporan->where('nama_data', 'perdes_pj')->first();
        $lra_1 = $pelaporan->where('nama_data', 'lra_1')->first();
        $lra_2 = $pelaporan->where('nama_data', 'lra_2')->first();
        $amj = $pelaporan->where('nama_data', 'amj')->first();

        if (count($pelaporan) == 0) {
            return view('adminDesa.akunPelaporan.formPelaporan', [
                'tahun' => $tahun,
                'infos' => $infos,
                'lppd' => $lppd,
                'surat_lppd' => $surat_lppd,
                'lkpd' => $lkpd,
                'surat_lkpd' => $surat_lkpd,
                'perdes_pj' => $perdes_pj,
                'lra_1' => $lra_1,
                'lra_2' => $lra_2,
                'amj' => $amj

            ]);
        } else {
            return view('adminDesa.akunPelaporan.formPelaporan', [
                'tahun' => $tahun,
                'infos' => $infos,
                'data' => $pelaporan,
                'lppd' => $lppd,
                'surat_lppd' => $surat_lppd,
                'lkpd' => $lkpd,
                'surat_lkpd' => $surat_lkpd,
                'perdes_pj' => $perdes_pj,
                'lra_1' => $lra_1,
                'lra_2' => $lra_2,
                'amj' => $amj


            ]);
        }
    }

    public function tambahAkunpelaporan(Request $request)
    {



        $request->validate([
            'lra_semester1' => 'file|mimes:pdf|max:5120',
            'surat_lra' => 'file|mimes:pdf|max:1024',
            'lkpd' => 'file|mimes:pdf|max:10240',
            'surat_lkpd' => 'file|mimes:pdf|max:1024',
            'perdes_pertanggungjawaban' => 'file|mimes:pdf|max:10240',
            'dok_lppd' => 'file|mimes:pdf|max:10240',
            'surat_lppd' => 'file|mimes:pdf|max:1024',
        ]);

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
        ];

        foreach ($request->nama_data as $dt) {
            $data['nama_data'] = $dt;
            Pelaporan::create($data);
        }

        $cek = Nilai_pemerintahan::where([
            'tahun' => $request->tahun,
            'asal_id' => $request->asal_id,
            'indikator_id' => 6
        ])->count();

        if (!$cek) {
            $data = [
                'aspek_id' => 1,
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'indikator_id' => 6
            ];
            $i = 39;
            foreach ($request->nama_data as $nm) {
                $data["sub_indikator_pemerintahan_id"] = $i;
                Nilai_pemerintahan::create($data);
                $i++;
            }
        }



        if ($request->file('lra_semester1')) {
            $ext = $request->lra_semester1->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pelaporan";
            $file = $request->file('lra_semester1')->storeAs($folder, "lra_semester1_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Pelaporan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'lra_semester1',

            ])->update([
                'file_data' => $file

            ]);

            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 39
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }


        if ($request->file('surat_lra')) {
            $ext = $request->surat_lra->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pelaporan";
            $file = $request->file('surat_lra')->storeAs($folder, "surat_lra_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Pelaporan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'surat_lra',

            ])->update([
                'file_data' => $file

            ]);

            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 40
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('lkpd')) {
            $ext = $request->lkpd->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pelaporan";
            $file = $request->file('lkpd')->storeAs($folder, "lkpd_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Pelaporan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'lkpd',

            ])->update([
                'file_data' => $file

            ]);

            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 41
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }
        if ($request->file('surat_lkpd')) {
            $ext = $request->surat_lkpd->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pelaporan";
            $file = $request->file('surat_lkpd')->storeAs($folder, "surat_lkpd_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Pelaporan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'surat_lkpd',

            ])->update([
                'file_data' => $file

            ]);

            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 42
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }
        if ($request->file('perdes_pertanggungjawaban')) {
            $ext = $request->perdes_pertanggungjawaban->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pelaporan";
            $file = $request->file('perdes_pertanggungjawaban')->storeAs($folder, "perdes_pertanggungjawaban_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Pelaporan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'perdes_pertanggungjawaban',

            ])->update([
                'file_data' => $file

            ]);

            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 43
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('dok_lppd')) {
            $ext = $request->dok_lppd->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pelaporan";
            $file = $request->file('dok_lppd')->storeAs($folder, "dok_lppd_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Pelaporan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'dok_lppd',

            ])->update([
                'file_data' => $file

            ]);

            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 44
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('surat_lppd')) {
            $ext = $request->surat_lppd->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pelaporan";
            $file = $request->file('surat_lppd')->storeAs($folder, "surat_lppd_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Pelaporan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'surat_lppd',

            ])->update([
                'file_data' => $file

            ]);

            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 45
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }



        return back()->with('success', 'berhasil tambah data');
    }

    public function updateAkunpelaporan(Request $request)
    {
        $request->validate([
            'lra_semester1' => 'file|mimes:pdf|max:5120',
            'surat_lra' => 'file|mimes:pdf|max:1024',
            'lkpd' => 'file|mimes:pdf|max:10240',
            'surat_lkpd' => 'file|mimes:pdf|max:1024',
            'perdes_pertanggungjawaban' => 'file|mimes:pdf|max:10240',
            'dok_lppd' => 'file|mimes:pdf|max:10240',
            'surat_lppd' => 'file|mimes:pdf|max:1024',
        ]);

        if ($request->file('lra_semester1')) {
            if ($request->old_0 && strpos($request->old_0, $request->tahun)) {
                Storage::delete($request->old_0);
            }
            $ext = $request->lra_semester1->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pelaporan";
            $file = $request->file('lra_semester1')->storeAs($folder, "lra_semester1_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Pelaporan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'lra_semester1',

            ])->update([
                'file_data' => $file

            ]);

            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 39
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }


        if ($request->file('surat_lra')) {
            if ($request->old_1 && strpos($request->old_1, $request->tahun)) {
                Storage::delete($request->old_1);
            }
            $ext = $request->surat_lra->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pelaporan";
            $file = $request->file('surat_lra')->storeAs($folder, "surat_lra_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Pelaporan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'surat_lra',

            ])->update([
                'file_data' => $file

            ]);

            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 40
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('lkpd')) {
            if ($request->old_2 && strpos($request->old_2, $request->tahun)) {
                Storage::delete($request->old_2);
            }
            $ext = $request->lkpd->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pelaporan";
            $file = $request->file('lkpd')->storeAs($folder, "lkpd_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Pelaporan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'lkpd',

            ])->update([
                'file_data' => $file

            ]);

            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 41
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }
        if ($request->file('surat_lkpd')) {
            if ($request->old_3 && strpos($request->old_3, $request->tahun)) {
                Storage::delete($request->old_3);
            }
            $ext = $request->surat_lkpd->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pelaporan";
            $file = $request->file('surat_lkpd')->storeAs($folder, "surat_lkpd_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Pelaporan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'surat_lkpd',

            ])->update([
                'file_data' => $file

            ]);

            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 42
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }
        if ($request->file('perdes_pertanggungjawaban')) {
            if ($request->old_4 && strpos($request->old_4, $request->tahun)) {
                Storage::delete($request->old_4);
            }
            $ext = $request->perdes_pertanggungjawaban->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pelaporan";
            $file = $request->file('perdes_pertanggungjawaban')->storeAs($folder, "perdes_pertanggungjawaban_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Pelaporan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'perdes_pertanggungjawaban',

            ])->update([
                'file_data' => $file

            ]);

            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 43
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('dok_lppd')) {
            if ($request->old_5 && strpos($request->old_5, $request->tahun)) {
                Storage::delete($request->old_5);
            }
            $ext = $request->dok_lppd->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pelaporan";
            $file = $request->file('dok_lppd')->storeAs($folder, "dok_lppd_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Pelaporan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'dok_lppd',

            ])->update([
                'file_data' => $file

            ]);

            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 44
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        if ($request->file('surat_lppd')) {
            if ($request->old_6 && strpos($request->old_6, $request->tahun)) {
                Storage::delete($request->old_6);
            }
            $ext = $request->surat_lppd->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pelaporan";
            $file = $request->file('surat_lppd')->storeAs($folder, "surat_lppd_" . $request->tahun . mt_rand(1, 100) . "." . $ext);

            Pelaporan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'nama_data' => 'surat_lppd',

            ])->update([
                'file_data' => $file

            ]);

            Nilai_pemerintahan::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'sub_indikator_pemerintahan_id' => 45
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }

        return back()->with('success', 'berhasil update data');
    }

    public function laporanTambah(Request $request)
    {
        $namadata = $request->nama_data;
        $request->validate([
            $namadata => 'file|mimes:pdf|max:5120',
        ]);

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'nama_data' => $request->nama_data
        ];

        if ($request->file($namadata)) {
            // if ($request->old && strpos($request->old, $request->tahun)) {
            //     Storage::delete($request->old);
            // }
            $ext = $request->$namadata->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pelaporan";
            $file = $request->file($namadata)->storeAs($folder, $namadata . "-" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $data['file_data'] = $file;
            Pelaporan::create($data);
        }

        return $this->inputNilai($request);
    }

    public function laporanEdit(Request $request)
    {
        $namadata = $request->nama_data;
        $request->validate([
            $namadata => 'file|mimes:pdf|max:5120',
        ]);


        if ($request->file($namadata)) {
            if ($request->old && strpos($request->old, $request->tahun)) {
                Storage::delete($request->old);
            }
            $ext = $request->$namadata->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_laporan";
            $file = $request->file($namadata)->storeAs($folder, $namadata . "-" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            Pelaporan::where('id', $request->id)->update([
                'file_data' => $file
            ]);
        }

        return $this->inputNilai($request);
    }

    public function hapusLaporan(Pelaporan $id)
    {
        Storage::delete($id->file_data);
        Pelaporan::destroy($id->id);

        return $this->hapusNilai($id);
    }

    public function hapusNilai($id)
    {
        $namadata = $id->nama_data;
        switch ($namadata) {
            case 'lppd':
                $indikator_pemerintahan_id = 39;
                break;
            case 'lkpd':
                $indikator_pemerintahan_id = 40;
                break;
            case 'perdes_pj':
                $indikator_pemerintahan_id = 41;
                break;
            case 'lra_1':
                $indikator_pemerintahan_id = 42;
                break;
            case 'lra_2':
                $indikator_pemerintahan_id = 43;
                break;
            default:
                $indikator_pemerintahan_id = 43;
                break;
        }

        Nilai_pemerintahan::where([
            'asal_id' => $id->asal_id,
            'tahun' => $id->tahun,
            'sub_indikator_pemerintahan_id' => $indikator_pemerintahan_id
        ])->update([
            'jumlah_data' => 0,
            'persen_data' => 0,
            'nilai_sementara' => NULL,
            'perbaikan' => true
        ]);

        return back()->with('success', 'berhasil hapus data');
    }

    public function inputNilai($request)
    {
        $namadata = $request->nama_data;
        switch ($namadata) {
            case 'lppd':
                $indikator_pemerintahan_id = 39;
                break;
            case 'lkpd':
                $indikator_pemerintahan_id = 40;
                break;
            case 'perdes_pj':
                $indikator_pemerintahan_id = 41;
                break;
            case 'lra_1':
                $indikator_pemerintahan_id = 42;
                break;
            case 'lra_2':
                $indikator_pemerintahan_id = 43;
                break;
            default:
                $indikator_pemerintahan_id = 43;
                break;
        }
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => 1,
            'indikator_id' => 6,
            'sub_indikator_pemerintahan_id' => $indikator_pemerintahan_id,
            'jumlah_data' => 1,
            'persen_data' => 100,
            'perbaikan' => true
        ];

        $cek = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_pemerintahan_id' => $indikator_pemerintahan_id
        ])->first();
        if ($cek) {
            Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => $indikator_pemerintahan_id
            ])->update([
                'persen_data' => 100,
                'jumlah_data' => 1,
                'perbaikan' => true
            ]);
        } else {
            Nilai_pemerintahan::create($data);
        }

        return back()->with('success', 'berhasil kirim data');
    }
}
