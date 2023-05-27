<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use App\Models\Aset_holder;
use App\Models\Aset_kib;
use App\Models\Aset_benbar;
use App\Models\Nilai_keuangan;

class AsetholderController extends Controller
{
    public function formHolder(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();
        $aset = Aset_holder::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();

        $barang = Aset_kib::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun,
        ])->where(function ($query) {
            $query->where('jenis', 'peralatan');
            $query->orWhere('jenis', 'kendaraan');
        })->get();

        return view('adminDesa.formAset.formHolder', [
            'infos' => $infos,
            'tahun' => $tahun,
            'holder' => count($aset),
            'datas' => $aset,
            'barangs' => $barang

        ]);
    }

    public function tambahHolder(Request $request)
    {
        $request->validate([

            'sk_holder' => 'file|mimes:pdf|max:1024'
        ]);

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'nama_barang' => strip_tags($request->nama_barang)
        ];
        if ($request->file('sk_holder')) {
            $ext = $request->sk_holder->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/KIR";
            $file = $request->file('sk_holder')->storeAs($folder, "sk_holder_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            $data['sk_holder'] = $file;
        }
        Aset_holder::create($data);

        $cek = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_keuangan_id' => 18
        ])->first();
        if (!$cek) {
            Nilai_keuangan::create([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 2,
                'indikator_id' => 12,
                'sub_indikator_keuangan_id' => 18,
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        } else {
            Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 2,
                'sub_indikator_keuangan_id' => 18
            ])->update([
                'perbaikan' => true,
                'jumlah_data' => 1,
                'persen_data' => 100
            ]);
        }

        return back()->with('success', 'Berhasil Tambah Data');
    }

    public function editHolder(Request $request)
    {
        $request->validate([

            'sk_holder_e' => 'file|mimes:pdf|max:1024'
        ]);

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'nama_barang' => strip_tags($request->nama_barang_e),
        ];


        if ($request->file('sk_holder_e')) {
            if ($request->oldPdf && strpos($request->oldPdf, $request->tahun)) {
                Storage::delete($request->oldPdf);
            }

            $ext = $request->sk_holder_e->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/KIR";
            $file2 = $request->file('sk_holder_e')->storeAs($folder, "sk_holder_e_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            $data['sk_holder'] = $file2;
        }
        Aset_holder::where('id', $request->id)->update($data);

        return back()->with('success', 'Berhasil Update Data');
    }

    public function hapusHolder(Aset_holder $id)
    {
        Aset_holder::destroy($id->id);
        return back()->with('success', 'Berhasil Hapus Data');
    }

    public function copyHolderAll(Request $request)
    {
        $cek = Aset_holder::where([
            'tahun' => $request->tahuncopy,
            'asal_id' => $request->asal_id
        ])->get()->count();
        if ($request->timpadata) {
            Aset_holder::where(
                [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahuncopy

                ]
            )->delete();

            $datas = Aset_holder::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahunasal
            ])->get();
            foreach ($datas as $data) {
                $data['tahun'] = $request->tahuncopy;
                $data['id'] = '';
                $copydata = Aset_holder::create($data->toArray());
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

        $datas = Aset_holder::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal
        ])->get();
        foreach ($datas as $data) {
            $data['tahun'] = $request->tahuncopy;
            $data['id'] = '';
            $copydata = Aset_holder::create($data->toArray());
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
            'sub_indikator_keuangan_id' => 18
        ])->first();
        $cektuju = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahuncopy,
            'sub_indikator_keuangan_id' => 18
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





    public function formBenbar(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();
        $benbar = Aset_benbar::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();

        if (count($benbar) == 0) {
            return view('adminDesa.formAset.formBenbar', [
                'infos' => $infos,
                'tahun' => $tahun,
                'benbar' => count($benbar),

            ]);
        } else {
            return view('adminDesa.formAset.formBenbar_e', [
                'infos' => $infos,
                'tahun' => $tahun,
                'benbar' => count($benbar),
                'datas' => $benbar->first()

            ]);
        }
    }

    public function tambahBenbar(Request $request)
    {
        $request->validate([
            'sk_benbar' => 'file|mimes:pdf|max:1024|required'
        ]);

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'nama' => strip_tags($request->nama),
        ];

        if ($request->file('sk_benbar')) {
            $ext = $request->sk_benbar->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/Benbar";
            $file = $request->file('sk_benbar')->storeAs($folder, "sk_benbar_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            $data['sk_benbar'] = $file;
        }
        Aset_benbar::create($data);



        return back()->with('success', 'Berhasil Tambah Data');
    }

    public function editBenbar(Request $request)
    {
        $request->validate([
            'sk_benbar' => 'file|mimes:pdf|max:1024'
        ]);

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'nama' => strip_tags($request->nama),
        ];

        if ($request->file('sk_benbar')) {
            if ($request->oldPdf && strpos($request->oldPdf, $request->tahun)) {
                Storage::delete($request->oldPdf);
            }
            $ext = $request->sk_benbar->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/Benbar";
            $file = $request->file('sk_benbar')->storeAs($folder, "sk_benbar_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            $data['sk_benbar'] = $file;
        }
        Aset_benbar::where('id', $request->id)->update($data);
        return back()->with('success', 'Berhasil Update Data');
    }

    public function copyBenbar(Request $request)
    {
        $cek = Aset_benbar::where([
            'tahun' => $request->tahuncopy,
            'asal_id' => $request->asal_id
        ])->get()->count();
        if ($request->timpadata) {
            Aset_benbar::where(
                [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahuncopy

                ]
            )->delete();

            $datas = Aset_benbar::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahunasal
            ])->get();
            foreach ($datas as $data) {
                $data['tahun'] = $request->tahuncopy;
                $data['id'] = '';
                $copydata = Aset_benbar::create($data->toArray());
            }

            if ($copydata) {
                return redirect()->back()->with('success', 'Data berhasil di copy');
            }

            exit();
            die();
        }

        if ($cek > 0) {
            return back()->with('timpaAll', $request->tahuncopy);
            exit();
            die();
        }

        $datas = Aset_benbar::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal
        ])->get();
        foreach ($datas as $data) {
            $data['tahun'] = $request->tahuncopy;
            $data['id'] = '';
            $copydata = Aset_benbar::create($data->toArray());
        }

        if ($copydata) {
            return redirect()->back()->with('success', 'Data berhasil di copy');
        }
    }
}
