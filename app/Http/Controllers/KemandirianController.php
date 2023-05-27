<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Kemandirian;
use App\Models\Nilai_keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KemandirianController extends Controller
{
    public function formKemandirian(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();

        $kemandirian = Kemandirian::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();

        $sertifikat = $kemandirian->where('jenis', 'sertifikat')->first();

        $pernyataan =  $kemandirian->where('jenis', 'pernyataan')->first();
        $hasil =  $kemandirian->where('jenis', 'hasil')->first();


        if ($request->jenis) {
            return view('adminDesa.formKemandirian.kemandirian_e', [
                'infos' => $infos,
                'jenis' => $request->jenis,
                'tahun' => $tahun,
                'pernyataan' => $pernyataan,
                'sertifikat' => $sertifikat,
                'hasil' => $hasil
            ]);
        } else {
            return view('adminDesa.formKemandirian.kemandirian', [
                'infos' => $infos,
                'jenis' => $request->jenis,
                'tahun' => $tahun,
                'pernyataan' => $pernyataan,
                'sertifikat' => $sertifikat,
                'hasil' => $hasil
            ]);
        }
    }


    public function updatePernyataan(Request $request)
    {
        $valid = $request->validate([
            'asal_id' => 'required',
            'tahun' => 'required',
            'jenis' => 'required',
        ]);


        if ($request->file('pernyataan_baru')) {
            if ($request->old1 && strpos($request->old1, $request->tahun)) {
                Storage::delete($request->old1);
            }

            $ext = $request->pernyataan_baru->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/Kemandirian";
            $file2 = $request->file('pernyataan_baru')->storeAs($folder, "pernyataan" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);
            $valid['data'] = $file2;
            $update = Kemandirian::where('id', $request->id)->update($valid);

            Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 2,
                'indikator_id' => 13,
                'sub_indikator_keuangan_id' => 20
            ])->update([
                'perbaikan' => true
            ]);

            return redirect()->back()->with('update', 'Data berhasil di Update');
        }

        if ($request->file('pernyataan')) {
            $ext = $request->pernyataan->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/Kemandirian";
            $file1 = $request->file('pernyataan')->storeAs($folder, "pernyataan" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);

            $valid['data'] = $file1;
            $insert = Kemandirian::create($valid);
            $dakeu = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 2,
                'indikator_id' => 13,
                'sub_indikator_keuangan_id' => 20,
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ];
            Nilai_keuangan::create($dakeu);


            return redirect()->back()->with('success', 'Data berhasil di Tambah');
        }
    }

    public function hapusPernyataan(Request $request)
    {
        $data = Kemandirian::where('id', $request->id)->first();
        Storage::delete($data->data);
        Nilai_keuangan::where([
            'asal_id' => $data->asal_id,
            'tahun' => $data->tahun,
            'aspek_id' => 2,
            'indikator_id' => 13,
            'sub_indikator_keuangan_id' => 20
        ])->delete();
        Kemandirian::where('id', $request->id)->delete();

        return back()->with('success', 'Data berhasil di Hapus');
    }



    public function updateSertifikat(Request $request)
    {
        $valid = $request->validate([
            'asal_id' => 'required',
            'tahun' => 'required',
            'jenis' => 'required',
        ]);

        if ($request->file('sertifikat_baru')) {
            if ($request->old2 && strpos($request->old2, $request->tahun)) {
                Storage::delete($request->old2);
            }

            $ext = $request->sertifikat_baru->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/Kemandirian";
            $file2 = $request->file('sertifikat_baru')->storeAs($folder, "sertifikat" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);
            $valid['data'] = $file2;
            $update = Kemandirian::where('id', $request->id)->update($valid);
            Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 2,
                'indikator_id' => 13,
                'sub_indikator_keuangan_id' => 21
            ])->update([
                'perbaikan' => true
            ]);

            return redirect()->back()->with('update', 'Data berhasil di Update');
        }

        if ($request->file('sertifikat')) {
            $ext = $request->sertifikat->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/Kemandirian";
            $file1 = $request->file('sertifikat')->storeAs($folder, "sertifikat" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);

            $valid['data'] = $file1;
            $insert = Kemandirian::create($valid);
            $dakeu = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 2,
                'indikator_id' => 13,
                'sub_indikator_keuangan_id' => 21,
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ];
            Nilai_keuangan::create($dakeu);


            return redirect()->back()->with('success', 'Data berhasil di Tambah');
        }
    }

    public function hapusSertifikat(Request $request)
    {
        $data = Kemandirian::where('id', $request->id)->first();
        Storage::delete($data->data);
        Nilai_keuangan::where([
            'asal_id' => $data->asal_id,
            'tahun' => $data->tahun,
            'aspek_id' => 2,
            'indikator_id' => 13,
            'sub_indikator_keuangan_id' => 21
        ])->delete();
        Kemandirian::where('id', $request->id)->delete();

        return back()->with('success', 'Data berhasil di Hapus');
    }
}
