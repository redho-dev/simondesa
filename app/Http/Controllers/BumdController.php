<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use App\Models\Bumd;
use App\Models\Nilai_bumd;

class BumdController extends Controller
{
    public function formBumdes(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }
        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();

        $pendirian = Bumd::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun,
            'jenis' => 'pendirian'
        ])->get();

        $kepengurusan = Bumd::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun,
            'jenis' => 'kepengurusan'
        ])->get();

        if ($request->jenis) {
            $dapen = Bumd::where([
                'asal_id' => $infos->asal_id,
                'tahun' => $tahun,
                'jenis' => $request->jenis
            ])->get();
            if (count($dapen) == 0) {
                return view('adminDesa.bumdes.formBumdes_t', [
                    'infos' => $infos,
                    'tahun' => $tahun,
                    'jenis' => $request->jenis,
                    'pendirian' => count($pendirian),
                    'kepengurusan' => count($kepengurusan)
                ]);
            } else {
                return view('adminDesa.bumdes.formBumdes_e', [
                    'infos' => $infos,
                    'tahun' => $tahun,
                    'jenis' => $request->jenis,
                    'pendirian' => count($pendirian),
                    'kepengurusan' => count($kepengurusan),
                    'datas' => $dapen
                ]);
            }
        } else {
            return view('adminDesa.bumdes.formBumdes', [
                'infos' => $infos,
                'tahun' => $tahun,
                'pendirian' => count($pendirian),
                'kepengurusan' => count($kepengurusan)
            ]);
        }
    }

    public function pendirianTambah(Request $request)
    {
        $request->validate([
            'perdes_pembentukan' => 'file|mimes:pdf|max:1024',
            'sk_kemenkum' => 'file|mimes:pdf|max:1024',
            'ad_art' => 'file|mimes:pdf|max:1024',
            'perdes_modal' => 'file|mimes:pdf|max:1024'
        ]);

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'jenis' => $request->jenis
        ];

        $i = 0;
        foreach ($request->nama_data as $nm) {

            $data["nama_data"] = $nm;
            $data["isi_data"] = strip_tags($request->isi_data[$i]);
            Bumd::create($data);
            $i++;
        }

        if ($request->file('perdes_pembentukan')) {
            $ext = $request->perdes_pembentukan->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/BUMDes";
            $file1 = $request->file('perdes_pembentukan')->storeAs($folder, "perdes_pembentukan_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            $data['perdes_pembentukan'] = $file1;
            Bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => 'perdes_pembentukan'
            ])->update([
                'isi_data' => $file1
            ]);
        }

        if ($request->file('sk_kemenkum')) {
            $ext = $request->sk_kemenkum->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/BUMDes";
            $file2 = $request->file('sk_kemenkum')->storeAs($folder, "sk_kemenkum_" . $request->tahun . "-" . mt_rand(2, 200) . "." . $ext);

            $data['sk_kemenkum'] = $file2;
            Bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => 'sk_kemenkum'
            ])->update([
                'isi_data' => $file2
            ]);
        }

        if ($request->file('ad_art')) {
            $ext = $request->ad_art->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/BUMDes";
            $file3 = $request->file('ad_art')->storeAs($folder, "ad_art_" . $request->tahun . "-" . mt_rand(2, 200) . "." . $ext);

            $data['ad_art'] = $file3;
            Bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => 'ad_art'
            ])->update([
                'isi_data' => $file3
            ]);
        }

        if ($request->file('perdes_modal')) {
            $ext = $request->perdes_modal->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/BUMDes";
            $file4 = $request->file('perdes_modal')->storeAs($folder, "perdes_modal_" . $request->tahun . "-" . mt_rand(2, 200) . "." . $ext);

            $data['perdes_modal'] = $file4;
            Bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => 'perdes_modal'
            ])->update([
                'isi_data' => $file4
            ]);
        }



        return back()->with('success', 'Berhasil Kirim Data');
    }


    public function nilaiBumdes(Request $request)
    {
        $data = Bumd::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->get();
        $dasarHukum = $data->where('nama_data', 'sk_kemenkum')->where('isi_data', '!=', '')->first();
        $perdesPembentukan = $data->where('nama_data', 'perdes_pembentukan')->where('isi_data', '!=', '')->first();
        $perdesModal = $data->where('nama_data', 'perdes_modal')->where('isi_data', '!=', '')->first();
        $skPengurus = $data->where('jenis', 'kepengurusan')->where('isi_data', '!=', '');
        $proposal = $data->where('nama_data', 'perdes_pembentukan')->where('isi_data', '!=', '')->first();
    }


    public function pendirianEdit(Request $request)
    {
        $request->validate([
            'perdes_pembentukan' => 'file|mimes:pdf|max:1024',
            'sk_kemenkum' => 'file|mimes:pdf|max:1024',
            'ad_art' => 'file|mimes:pdf|max:1024',
            'perdes_modal' => 'file|mimes:pdf|max:1024'
        ]);

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'jenis' => $request->jenis
        ];

        $i = 0;
        foreach ($request->nama_data as $nm) {

            $data["nama_data"] = $nm;
            $data["isi_data"] = strip_tags($request->isi_data[$i]);
            if ($nm != 'perdes_pembentukan' && $nm != 'sk_kemenkum' && $nm != 'ad_art' && $nm != 'perdes_modal') {

                Bumd::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'jenis' => $request->jenis,
                    'nama_data' => $nm
                ])->update([
                    'isi_data' => strip_tags($request->isi_data[$i])
                ]);
            }

            $i++;
        }


        if ($request->file('perdes_pembentukan')) {
            if ($request->old1 && strpos($request->old1, $request->tahun)) {
                Storage::delete($request->old1);
            }
            $ext = $request->perdes_pembentukan->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/BUMDes";
            $file1 = $request->file('perdes_pembentukan')->storeAs($folder, "perdes_pembentukan_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            $data['perdes_pembentukan'] = $file1;
            Bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => 'perdes_pembentukan'
            ])->update([
                'isi_data' => $file1
            ]);

            Nilai_bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'indikator_bumd_id' => 2
            ])->update([
                'perbaikan' => true
            ]);
        }

        if ($request->file('ad_art')) {
            if ($request->old2 && strpos($request->old2, $request->tahun)) {
                Storage::delete($request->old2);
            }
            $ext = $request->ad_art->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/BUMDes";
            $file3 = $request->file('ad_art')->storeAs($folder, "ad_art_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            $data['ad_art'] = $file3;
            Bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => 'ad_art'
            ])->update([
                'isi_data' => $file3
            ]);
            Nilai_bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'indikator_bumd_id' => 2
            ])->update([
                'perbaikan' => true
            ]);
        }

        if ($request->file('perdes_modal')) {
            if ($request->old3 && strpos($request->old3, $request->tahun)) {
                Storage::delete($request->old3);
            }
            $ext = $request->perdes_modal->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/BUMDes";
            $file4 = $request->file('perdes_modal')->storeAs($folder, "perdes_modal_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            $data['perdes_modal'] = $file4;
            Bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => 'perdes_modal'
            ])->update([
                'isi_data' => $file4
            ]);
            Nilai_bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'indikator_bumd_id' => 3
            ])->update([
                'perbaikan' => true
            ]);
        }

        if ($request->file('sk_kemenkum')) {
            if ($request->old2 && strpos($request->old2, $request->tahun)) {
                Storage::delete($request->old2);
            }
            $ext = $request->sk_kemenkum->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/BUMDes";
            $file2 = $request->file('sk_kemenkum')->storeAs($folder, "sk_kemenkum_" . $request->tahun . "-" . mt_rand(2, 200) . "." . $ext);

            $data['sk_kemenkum'] = $file2;
            Bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => 'sk_kemenkum'
            ])->update([
                'isi_data' => $file2
            ]);
            Nilai_bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'indikator_bumd_id' => 1
            ])->update([
                'perbaikan' => true
            ]);
        }


        return back()->with('success', 'Berhasil Update Data');
    }

    public function pengurusTambah(Request $request)
    {
        $request->validate([
            'sk_pengurus' => 'file|mimes:pdf|max:1024'
        ]);
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'jenis' => $request->jenis,
            'nama_data' => 'kepengurusan_' . $request->tahunawal . '_' . $request->tahunsampai
        ];

        if ($request->file('sk_pengurus')) {

            $ext = $request->sk_pengurus->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/BUMDes";
            $file = $request->file('sk_pengurus')->storeAs($folder, "sk_pengurus_" . $request->tahun . "-" . mt_rand(2, 200) . "." . $ext);

            $data['isi_data'] = $file;
            Bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => 'sk_pengurus'
            ])->update([
                'isi_data' => $file
            ]);
            $cek = Nilai_bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'indikator_bumd_id' => 4
            ])->first();
            if ($cek) {
                Nilai_bumd::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'indikator_bumd_id' => 4
                ])->update([
                    'perbaikan' => true
                ]);
            }
        }

        Bumd::create($data);

        return back()->with('success', 'Berhasil Kirim Data');
    }

    public function hapusPengurus(Bumd $id)
    {
        $hapus = Bumd::destroy($id->id);
        return back()->with('success', 'Berhasil Hapus Data');
    }

    public function copyPendirian(Request $request)
    {
        $cek = Bumd::where([
            'tahun' => $request->tahuncopy,
            'asal_id' => $request->asal_id,
        ])->where(function ($query) {
            $query->where('jenis', 'pendirian');
            $query->orWhere('jenis', 'kepengurusan');
        })->get()->count();

        if ($request->timpadata) {
            Bumd::where(
                [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahuncopy

                ]
            )->where(function ($query) {
                $query->where('jenis', 'pendirian');
                $query->orWhere('jenis', 'kepengurusan');
            })->delete();

            $datas = Bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahunasal
            ])->where(function ($query) {
                $query->where('jenis', 'pendirian');
                $query->orWhere('jenis', 'kepengurusan');
            })->get();


            foreach ($datas as $data) {
                $data['tahun'] = $request->tahuncopy;
                $data['id'] = '';
                $copydata = Bumd::create($data->toArray());
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

        $datas = Bumd::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal
        ])->where(function ($query) {
            $query->where('jenis', 'pendirian');
            $query->orWhere('jenis', 'kepengurusan');
        })->get();
        foreach ($datas as $data) {
            $data['tahun'] = $request->tahuncopy;
            $data['id'] = '';
            $copydata = Bumd::create($data->toArray());
        }

        if ($copydata) {
            
            return redirect()->back()->with('success', 'Data berhasil di copy');
        }
    }

    public function bumdesLapkeu(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }
        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();

        $bumd = Bumd::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();

        $laporan = $bumd->where('jenis', 'laporan');
        $dasar = $bumd->where('jenis', 'dasar_keuangan');
        $proposal = $bumd->where('jenis', 'proposal');


        if ($request->jenis) {
            $dalap = Bumd::where([
                'asal_id' => $infos->asal_id,
                'tahun' => $tahun,
                'jenis' => $request->jenis
            ])->get();
            if (count($dalap) == 0) {
                return view('adminDesa.bumdes.formLap_t', [
                    'infos' => $infos,
                    'tahun' => $tahun,
                    'jenis' => $request->jenis,
                    'laporan' => count($laporan),
                    'dasar' => count($dasar),
                    'proposal' => count($proposal)
                ]);
            } else {
                // return $dalap;
                return view('adminDesa.bumdes.formLap_e', [
                    'infos' => $infos,
                    'tahun' => $tahun,
                    'jenis' => $request->jenis,
                    'laporan' => count($laporan),
                    'dasar' => count($dasar),
                    'proposal' => count($proposal),
                    'datas' => $dalap
                ]);
            }
        } else {

            return view('adminDesa.bumdes.formLap', [
                'infos' => $infos,
                'tahun' => $tahun,
                'laporan' => count($laporan),
                'dasar' => count($dasar),
                'proposal' => count($proposal),
            ]);
        }
    }

    public function dasarTambah(Request $request)
    {
        $request->validate([
            'foto_rekening' => 'file|image|max:1024',
            'catatan_rekening' => 'file|mimes:pdf|max:2048'
        ]);

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'jenis' => $request->jenis
        ];

        $i = 0;
        foreach ($request->nama_data as $nm) {

            $data["nama_data"] = $nm;
            $data["isi_data"] = strip_tags($request->isi_data[$i]);
            Bumd::create($data);
            $i++;
        }

        if ($request->file('foto_rekening')) {
            $ext = $request->foto_rekening->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/BUMDes";
            $file1 = $request->file('foto_rekening')->storeAs($folder, "foto_rekening_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            $data['foto_rekening'] = $file1;
            Bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => 'foto_rekening'
            ])->update([
                'isi_data' => $file1
            ]);
        }

        if ($request->file('catatan_rekening')) {
            $ext = $request->catatan_rekening->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/BUMDes";
            $file2 = $request->file('catatan_rekening')->storeAs($folder, "catatan_rekening_" . $request->tahun . "-" . mt_rand(2, 200) . "." . $ext);

            $data['catatan_rekening'] = $file2;
            Bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => 'catatan_rekening'
            ])->update([
                'isi_data' => $file2
            ]);
        }

        return back()->with('success', 'Berhasil Kirim Data');
    }

    public function dasarEdit(Request $request)
    {
        $request->validate([
            'foto_rekening' => 'file|image|max:1024',
            'catatan_rekening' => 'file|mimes:pdf|max:2048'
        ]);

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'jenis' => $request->jenis
        ];

        $i = 0;
        foreach ($request->nama_data as $nm) {

            if ($nm != 'foto_rekening' && $nm != 'catatan_rekening') {
                Bumd::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'jenis' => $request->jenis,
                    'nama_data' => $nm
                ])->update([
                    'isi_data' => strip_tags($request->isi_data[$i])
                ]);
            }

            $i++;
        }

        if ($request->file('foto_rekening')) {
            if ($request->old1 && strpos($request->old1, $request->tahun)) {
                Storage::delete($request->old1);
            }
            $ext = $request->foto_rekening->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/BUMDes";
            $file1 = $request->file('foto_rekening')->storeAs($folder, "foto_rekening_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            $data['foto_rekening'] = $file1;
            Bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => 'foto_rekening'
            ])->update([
                'isi_data' => $file1
            ]);
        }

        if ($request->file('catatan_rekening')) {
            if ($request->old2 && strpos($request->old2, $request->tahun)) {
                Storage::delete($request->old2);
            }
            $ext = $request->catatan_rekening->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/BUMDes";
            $file2 = $request->file('catatan_rekening')->storeAs($folder, "catatan_rekening_" . $request->tahun . "-" . mt_rand(2, 200) . "." . $ext);

            $data['catatan_rekening'] = $file2;
            Bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => 'catatan_rekening'
            ])->update([
                'isi_data' => $file2
            ]);
        }

        return back()->with('success', 'Berhasil Update Data');
    }

    public function lapkeubumdesTambah(Request $request)
    {

        $request->validate([
            'lapkeu' => 'file|mimes:pdf|max:2048|required'
        ]);
        $tahunlaporan = strip_tags($request->tahun_lapkeu);
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'jenis' => $request->jenis,
            'nama_data' => 'laporan_keu_' . $tahunlaporan
        ];

        if ($request->file('lapkeu')) {

            $ext = $request->lapkeu->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/BUMDes";
            $file = $request->file('lapkeu')->storeAs($folder, "lapkeu_" . $request->tahun . "-" . mt_rand(2, 200) . "." . $ext);

            $data['isi_data'] = $file;
            $cek = Nilai_bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'indikator_bumd_id' => 6
            ])->first();
            if ($cek) {
                Nilai_bumd::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'indikator_bumd_id' => 6
                ])->update([
                    'perbaikan' => true
                ]);
            }
        }

        $input = Bumd::create($data);

        return back()->with('success', 'Berhasil Kirim Data');
    }

    public function proposalTambah(Request $request)
    {

        $request->validate([
            'proposal' => 'file|mimes:pdf|max:5120000|required'
        ]);
        $tahunproposal = strip_tags($request->tahun_proposal);
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'jenis' => $request->jenis,
            'nama_data' => 'proposal_' . $tahunproposal
        ];

        if ($request->file('proposal')) {

            $ext = $request->proposal->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/BUMDes";
            $file = $request->file('proposal')->storeAs($folder, "proposal_" . $request->tahun . "-" . mt_rand(2, 200) . "." . $ext);

            $data['isi_data'] = $file;

            $cek = Nilai_bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'indikator_bumd_id' => 5
            ])->first();
            if ($cek) {
                Nilai_bumd::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'indikator_bumd_id' => 5
                ])->update([
                    'perbaikan' => true
                ]);
            }
        }

        $input = Bumd::create($data);

        return back()->with('success', 'Berhasil Kirim Data');
    }


    public function hapusLapkeubumdes(Bumd $id)
    {
        $hapfile = storage::delete($id->isi_data);
        Bumd::destroy($id->id);

        return back()->with('success', 'Berhasil Hapus Data');
    }


    public function copyLapkeubumdes(Request $request)
    {
        $cek = Bumd::where([
            'tahun' => $request->tahuncopy,
            'asal_id' => $request->asal_id,
        ])->where(function ($query) {
            $query->where('jenis', 'dasar_keuangan');
            $query->orWhere('jenis', 'laporan');
            $query->orWhere('jenis', 'proposal');
        })->get()->count();

        if ($request->timpadata) {
            Bumd::where(
                [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahuncopy

                ]
            )->where(function ($query) {
                $query->where('jenis', 'dasar_keuangan');
                $query->orWhere('jenis', 'laporan');
                $query->orWhere('jenis', 'proposal');
            })->delete();

            $datas = Bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahunasal
            ])->where(function ($query) {
                $query->where('jenis', 'dasar_keuangan');
                $query->orWhere('jenis', 'laporan');
                $query->orWhere('jenis', 'proposal');
            })->get();


            foreach ($datas as $data) {
                $data['tahun'] = $request->tahuncopy;
                $data['id'] = '';
                $copydata = Bumd::create($data->toArray());
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

        $datas = Bumd::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal
        ])->where(function ($query) {
            $query->where('jenis', 'dasar_keuangan');
            $query->orWhere('jenis', 'laporan');
            $query->orWhere('jenis', 'proposal');
        })->get();
        foreach ($datas as $data) {
            $data['tahun'] = $request->tahuncopy;
            $data['id'] = '';
            $copydata = Bumd::create($data->toArray());
        }

        if ($copydata) {
            return redirect()->back()->with('success', 'Data berhasil di copy');
        }
    }

    public function bumdesPAD(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }
        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();

        $pad = Bumd::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun,
            'jenis' => 'pad'
        ])->get();


        return view('adminDesa.bumdes.formPAD', [
            'infos' => $infos,
            'tahun' => $tahun,
            'pad' => count($pad),
            'datas' => $pad

        ]);
    }

    public function tambahPAD(Request $request)
    {
        $request->validate([
            'bukti_setor' => 'file|mimes:pdf|required'
        ]);
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'jenis' => 'pad',
            'nama_data' => 'setor_pad_tahun_' . $request->tahun_pad . "_Rp_" . $request->jumlah_pad
        ];
        if ($request->file('bukti_setor')) {

            $ext = $request->bukti_setor->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/BUMDes";
            $file = $request->file('bukti_setor')->storeAs($folder, "bukti_setor_" . $request->tahun . "-" . mt_rand(2, 200) . "." . $ext);

            $data['isi_data'] = $file;

            $cek = Nilai_bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'indikator_bumd_id' => 7
            ])->first();
            if ($cek) {
                Nilai_bumd::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'indikator_bumd_id' => 7
                ])->update([
                    'perbaikan' => true
                ]);
            }
        }

        Bumd::create($data);

        return back()->with('success', 'berhasil kirim data');
    }

    public function hapusSetorPAD(Bumd $id)
    {
        Storage::delete($id->isi_data);
        Bumd::destroy($id->id);
        return back()->with('success', 'berhasil hapus data');
    }

    public function copyPADbumdes(Request $request)
    {
        $cek = Bumd::where([
            'tahun' => $request->tahuncopy,
            'asal_id' => $request->asal_id,
            'jenis' => 'pad'
        ])->get()->count();

        if ($request->timpadata) {
            Bumd::where(
                [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahuncopy,
                    'jenis' => 'pad'

                ]
            )->delete();

            $datas = Bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahunasal,
                'jenis' => 'pad'
            ])->get();


            foreach ($datas as $data) {
                $data['tahun'] = $request->tahuncopy;
                $data['id'] = '';
                $copydata = Bumd::create($data->toArray());
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

        $datas = Bumd::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal,
            'jenis' => 'pad'
        ])->get();
        foreach ($datas as $data) {
            $data['tahun'] = $request->tahuncopy;
            $data['id'] = '';
            $copydata = Bumd::create($data->toArray());
        }

        if ($copydata) {
            return redirect()->back()->with('success', 'Data berhasil di copy');
        }
    }
}
