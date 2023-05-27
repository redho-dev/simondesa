<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Nilai_pemerintahan;
use App\Models\Rpjmd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RpjmdController extends Controller
{
    public function formRpjmd(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();

        $RpjmdAll = Rpjmd::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();

        $dokumen = $RpjmdAll->where('jenis', 'dokumen');
        $visimisi = $RpjmdAll->where('jenis', 'visi_misi');
        $potensi = $RpjmdAll->where('jenis', 'potensi');


        if (isset($request->jenis)) {
            $Rpjmd = Rpjmd::where([
                'jenis' => $request->jenis,
                'asal_id' => $infos->asal_id,
                'tahun' => $tahun
            ])->get()->count();

            if ($Rpjmd == 0) {
                return view('adminDesa.formDokren.rpjmd_t', [
                    'infos' => $infos,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'dokumen' => count($dokumen),
                    'visimisi' => count($visimisi),

                    'potensi' => count($potensi),

                ]);
            } else {
                return view('adminDesa.formDokren.rpjmd_e', [
                    'infos' => $infos,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'dokumen' => count($dokumen),
                    'visimisi' => count($visimisi),
                    'potensi' => count($potensi),
                    'data' => Rpjmd::where([
                        'jenis' => $request->jenis,
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get(),
                    'visi' => Rpjmd::where([
                        'jenis' => $request->jenis,
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun,
                        'nama_data' => 'visi'
                    ])->first(),
                    'misis' => Rpjmd::where([
                        'jenis' => $request->jenis,
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun,
                    ])->where('nama_data', 'like', '%' . 'misi' . '%')->get(),
                    'jumlah_misi' => Rpjmd::where([
                        'jenis' => $request->jenis,
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun,
                    ])->where('nama_data', 'like', '%' . 'misi' . '%')->get()->count()

                ]);
            }
        } else {
            return view('adminDesa.formDokren.rpjmd', [
                'infos' => $infos,
                'jenis' => $request->jenis,
                'tahun' => $tahun,
                'dokumen' => count($dokumen),
                'visimisi' => count($visimisi),
                'potensi' => count($potensi)


            ]);
        }
    }

    public function tambahRpjmd(Request $request)
    {
        $validate = $request->validate([
            'dokumen_rpjmd' => 'file|mimes:pdf|max:30720|required'
        ]);
        $i = 0;
        foreach ($request->nama_data as $data) {

            $data = [
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'jenis' => $request->jenis,
                'nama_data' => $data,
                'uraian' => strip_tags($request->isidata[$i]),
                'sejak' => strip_tags($request->sejak),
                'sampai' => strip_tags($request->sampai)
            ];

            Rpjmd::create($data);
            $i++;
        }
        if ($request->file('dokumen_rpjmd')) {
            $ext = $request->dokumen_rpjmd->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_dokren";
            $file = $request->file('dokumen_rpjmd')->storeAs($folder, "dokumen_rpjmd_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            Rpjmd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'dokumen_rpjmd'
            ])->update([
                'file_data' => $file,
                'perbaikan' => 1
            ]);

            $data_r = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 1,
                'indikator_id' => 4,
                'sub_indikator_pemerintahan_id' => 20,
                'perbaikan' => true,
                'jumlah_data' => 1,
                'persen_data' => 100

            ];
            Nilai_pemerintahan::create($data_r);
        }

        return back()->with('success', 'berhasil tambah data');
    }
    public function updateRpjmd(Request $request)
    {
        $validate = $request->validate([
            'dokumen_rpjmd' => 'file|mimes:pdf|max:30720'

        ]);
        $i = 0;
        foreach ($request->nama_data as $data) {

            $data = [
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'jenis' => $request->jenis,
                'nama_data' => $data

            ];

            Rpjmd::Where($data)->update([
                'uraian' => strip_tags($request->isidata[$i]),
                'sejak' => strip_tags($request->sejak),
                'sampai' => strip_tags($request->sampai)
            ]);
            $i++;
        }
        if ($request->file('dokumen_rpjmd')) {
            if ($request->old_1 && strpos($request->old_1, $request->tahun)) {
                Storage::delete($request->old_1);
            }
            $ext = $request->dokumen_rpjmd->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_dokren";
            $file = $request->file('dokumen_rpjmd')->storeAs($folder, "dokumen_rpjmd_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            Rpjmd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => 'dokumen_rpjmd'
            ])->update([
                'file_data' => $file,
                'perbaikan' => 2
            ]);

            Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 1,
                'indikator_id' => 4,
                'sub_indikator_pemerintahan_id' => 20
            ])->update([
                'perbaikan' => true
            ]);
        }

        return back()->with('success', 'berhasil Update data');
    }

    public function tambahVisimisi(Request $request)
    {
        $i = 0;
        foreach ($request->nama_data as $data) {

            $data = [
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'jenis' => $request->jenis,
                'nama_data' => $data,
                'uraian' => strip_tags($request->isidata[$i])

            ];

            Rpjmd::create($data);
            $i++;
        }


        return back()->with('success', 'berhasil tambah data');
    }

    public function deleteVisimisi($id)
    {
        Rpjmd::destroy($id);
        return back()->with('success', 'data berhasil dihapus');
    }

    public function updateVisimisi(Request $request)
    {

        $delete = Rpjmd::where([
            'tahun' => $request->tahun,
            'asal_id' => $request->asal_id,
            'jenis' => $request->jenis
        ])->delete();


        $i = 0;

        foreach ($request->nama_data as $data) {

            $data = [
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'jenis' => $request->jenis,
                'nama_data' => $data,
                'uraian' => strip_tags($request->isidata[$i])

            ];

            Rpjmd::create($data);
            $i++;
        }

        return back()->with('success', 'berhasil update data');
    }





    public function updateTambahPotensi(Request $request)
    {
        $request->validate([
            'upload_potensi' => 'file|image|max:1024'
        ]);
        $jumdata = Rpjmd::where([
            'tahun' => $request->tahun,
            'jenis' => $request->jenis,
            'asal_id' => $request->asal_id
        ])->get()->count();
        $ke = $jumdata + 1;
        if ($request->file('upload_potensi')) {
            $ext = $request->upload_potensi->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_dokren";
            $file = $request->upload_potensi->storeAs($folder, "upload_potensi$ke" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);
        }
        $data = [
            'tahun' => $request->tahun,
            'jenis' => $request->jenis,
            'asal_id' => $request->asal_id,
            'nama_data' => 'potensi_' . $ke,
            'uraian' => $request->uraian,
            'file_data' => $file
        ];

        Rpjmd::create($data);
        return back()->with('success', 'data berhasil ditambah');
    }

    public function updateUbahPotensi(Request $request)
    {
        $id = $request->id;

        Rpjmd::where('id', $id)->update([
            'uraian' => strip_tags($request->uraian)
        ]);

        if ($request->file('upload_potensi')) {
            Storage::delete($request->old);
            $ext = $request->upload_potensi->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_dokren";
            $file = $request->upload_potensi->storeAs($folder, "upload_potensi_ubah" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);

            Rpjmd::where('id', $id)->update([
                'file_data' => $file
            ]);
        }


        return back()->with('success', 'data berhasil diubah');
    }

    public function hapusPotensi(Request $request)
    {
        $data = Rpjmd::where('id', $request->id)->first();

        Rpjmd::where('id', $request->id)->delete();
        Storage::delete($data->file_data);

        $dapot = Rpjmd::where([
            'tahun' => $request->tahun,
            'asal_id' => $request->asal_id,
            'jenis' => $request->jenis
        ])->get();


        $jumpot = count($dapot);
        $i = 1;
        foreach ($dapot as $pot) {
            $potensi = $pot->nama_data;
            Rpjmd::where([
                'tahun' => $request->tahun,
                'asal_id' => $request->asal_id,
                'jenis' => $request->jenis,
                'nama_data' => $potensi
            ])->update([
                'nama_data' => 'potensi_' . $i
            ]);
            $i++;
        }

        return back()->with('success', 'data berhasil dihapus');
    }

    public function copyRpjmdesAll(Request $request)
    {
        $datanilaiasal = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal,
            'aspek_id' => 1,
            'indikator_id' => 4,
            'sub_indikator_pemerintahan_id' => 20
        ])->first();

        $cek = Rpjmd::where([
            'tahun' => $request->tahuncopy,
            'asal_id' => $request->asal_id
        ])->get()->count();
        if ($request->timpadata) {
            Rpjmd::where(
                [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahuncopy

                ]
            )->delete();

            $datas = Rpjmd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahunasal
            ])->get();
            foreach ($datas as $data) {
                $data['tahun'] = $request->tahuncopy;
                $data['id'] = '';
                $copydata = Rpjmd::create($data->toArray());
            }

            if ($copydata) {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahuncopy,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 20
                ])->delete();
                $data_r = [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahuncopy,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 20,
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100

                ];
                Nilai_pemerintahan::create($data_r);


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

        $datas = Rpjmd::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal
        ])->get();
        foreach ($datas as $data) {
            $data['tahun'] = $request->tahuncopy;
            $data['id'] = '';
            $copydata = Rpjmd::create($data->toArray());
        }

        if ($copydata) {

            $data_r = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahuncopy,
                'aspek_id' => 1,
                'indikator_id' => 4,
                'sub_indikator_pemerintahan_id' => 20,
                'perbaikan' => true,
                'jumlah_data' => 1,
                'persen_data' => 100

            ];
            Nilai_pemerintahan::create($data_r);

            return redirect()->back()->with('success', 'Data berhasil di copy');
        }
    }
}
