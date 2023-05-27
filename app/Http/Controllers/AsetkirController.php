<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use App\Models\Aset_kir;
use App\Models\Nilai_keuangan;


class AsetkirController extends Controller
{
    public function formKIR(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();
        $aset = Aset_kir::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();


        return view('adminDesa.formAset.formKir', [
            'infos' => $infos,
            'tahun' => $tahun,
            'kir' => count($aset),
            'datas' => $aset

        ]);
    }

    public function tambahKIR(Request $request)
    {
        $request->validate([

            'dok_kir' => 'file|mimes:pdf|max:1024'
        ]);

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'nama_ruangan' => strip_tags($request->nama_ruangan),
        ];

        if ($request->file('dok_kir')) {
            $ext = $request->dok_kir->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/KIR";
            $file2 = $request->file('dok_kir')->storeAs($folder, "dok_kir_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            $data['dok_kir'] = $file2;
        }
        Aset_kir::create($data);

        $cek = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_keuangan_id' => 17
        ])->first();
        if (!$cek) {
            Nilai_keuangan::create([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 2,
                'indikator_id' => 12,
                'sub_indikator_keuangan_id' => 17,
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        } else {
            Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 2,
                'sub_indikator_keuangan_id' => 17
            ])->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }


        return back()->with('success', 'Berhasil Tambah Data');
    }

    public function editKIR(Request $request)
    {
        $request->validate([

            'dok_kir_e' => 'file|mimes:pdf|max:1024'
        ]);

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'nama_ruangan' => strip_tags($request->nama_ruangan_e),
        ];


        if ($request->file('dok_kir_e')) {
            if ($request->oldPdf && strpos($request->oldPdf, $request->tahun)) {
                Storage::delete($request->oldPdf);
            }

            $ext = $request->dok_kir_e->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/KIR";
            $file2 = $request->file('dok_kir_e')->storeAs($folder, "dok_kir_e_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            $data['dok_kir'] = $file2;
        }
        Aset_kir::where('id', $request->id)->update($data);

        return back()->with('success', 'Berhasil Update Data');
    }

    public function hapusKIR(Aset_kir $id)
    {
        Aset_kir::destroy($id->id);
        return back()->with('success', 'Berhasil Hapus Data');
    }
    public function copyKIRAll(Request $request)
    {
        $cek = Aset_kir::where([
            'tahun' => $request->tahuncopy,
            'asal_id' => $request->asal_id
        ])->get()->count();
        if ($request->timpadata) {
            Aset_kir::where(
                [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahuncopy

                ]
            )->delete();

            $datas = Aset_kir::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahunasal
            ])->get();
            foreach ($datas as $data) {
                $data['tahun'] = $request->tahuncopy;
                $data['id'] = '';
                $copydata = Aset_kir::create($data->toArray());
            }

            if ($copydata) {
                return $this->copyNilaiAset($request);
            }

            exit();
            die();
        }

        if ($cek > 0) {
            return back()->with('timpaAll', $request->tahuncopy);
            exit();
            die();
        }

        $datas = Aset_kir::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal
        ])->get();
        foreach ($datas as $data) {
            $data['tahun'] = $request->tahuncopy;
            $data['id'] = '';
            $copydata = Aset_kir::create($data->toArray());
        }

        if ($copydata) {
            return $this->copyNilaiAset($request);
        }
    }

    public function copyNilaiAset($request)
    {
        $cekawal = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal,
            'sub_indikator_keuangan_id' => 17
        ])->first();
        $cektuju = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahuncopy,
            'sub_indikator_keuangan_id' => 17
        ])->first();

        if (!$cektuju) {
            $data = [
                'asal_id' => $cekawal->asal_id,
                'tahun' => $request->tahuncopy,
                'aspek_id' => $cekawal->aspek_id,
                'indikator_id' => $cekawal->indikator_id,
                'sub_indikator_keuangan_id' => $cekawal->sub_indikator_keuangan_id,
                'jumlah_data' => $cekawal->jumlah_data,
                'persen_data' => $cekawal->persen_data,
                'perbaikan' => true
            ];
            Nilai_keuangan::create($data);
        } else {
            Nilai_keuangan::where([
                'asal_id' => $cekawal->asal_id,
                'tahun' => $request->tahuncopy,
                'aspek_id' => $cekawal->aspek_id,
                'indikator_id' => $cekawal->indikator_id,
                'sub_indikator_keuangan_id' => $cekawal->sub_indikator_keuangan_id
            ])->delete();
            $data = [
                'asal_id' => $cekawal->asal_id,
                'tahun' => $request->tahuncopy,
                'aspek_id' => $cekawal->aspek_id,
                'indikator_id' => $cekawal->indikator_id,
                'sub_indikator_keuangan_id' => $cekawal->sub_indikator_keuangan_id,
                'jumlah_data' => $cekawal->jumlah_data,
                'persen_data' => $cekawal->persen_data,
                'perbaikan' => true
            ];
            Nilai_keuangan::create($data);
        }

        return back()->with('success', 'berhasil copy data');
    }
}
