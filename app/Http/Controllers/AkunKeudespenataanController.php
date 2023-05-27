<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Apbdes_dokumen;
use App\Models\Asal;
use App\Models\Kecamatan;

use App\Models\Apbdes_belanjaakun;
use App\Models\Apbdes_bidang;
use App\Models\Apbdes_pendapatan;
use App\Models\Apbdes_pembiayaan;
use App\Models\Total_apbd;
use App\Models\Catatan_apbd;

use Illuminate\Http\Request;


class AkunKeudespenataanController extends Controller
{
    public function cekApbdes_m(Request $request)
    {
        $tahun = now()->format('Y');
        $infos = Admin::where('id', session('loggedAdminIrbanwil'))->first();
        if ($infos->role == 'admin_sekretariat' || $infos->role == 'admin_irbansus') {
            $asal_id =  Asal::pluck('id')->first();
            $kecamatan = Kecamatan::all();
            $kecamatan1 = $kecamatan->pluck('nama_kecamatan')->first();
        } else {
            $asal_id =  Asal::where('obrik', $infos->obrik)->pluck('id')->first();
            $kecamatan = Kecamatan::where('obrik', $infos->obrik)->get();
            $kecamatan1 = $kecamatan->pluck('nama_kecamatan')->first();
        }

        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }
        if (session()->has('asal_id')) {
            $asal_id = session()->get('asal_id');
        }
        if (session()->has('pilcam')) {
            $kecamatan1 = session()->get('pilcam');
        }

        $deswal = Asal::where('kecamatan', $kecamatan1)->get();
        $desa = Asal::where('id', $asal_id)->first();


        $catatan = Catatan_apbd::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'nama_data' => 'murni'
        ])->get();



        // Data APBDes Murni
        $dokumen = Apbdes_dokumen::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();


        $belanjaakun = Apbdes_belanjaakun::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();

        $apbdes_pendapatan = Apbdes_pendapatan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();

        $apbdes_belanja = Apbdes_bidang::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();

        $apbdes_pembiayaan = Apbdes_pembiayaan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();

        $total = Total_apbd::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();


        if (isset($request->jenis)) {
            if ($request->jenis == 'catatan') {
                $data = $catatan;
            } else {
                $data = $dokumen;
            }

            if (count($data) == 0) {
                return view('adminIrbanwil.cekApbdes.cekApbdes_m', [
                    'desa' => $desa,
                    'infos' => $infos,
                    'asal_id' => $asal_id,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'apbdesm' => count($dokumen),
                    'kecamatan' => $kecamatan,
                    'deswal' => $deswal,

                    'catatan' => count($catatan)
                ]);
            } else {

                if (!count($apbdes_pendapatan) || !count($belanjaakun) || !count($apbdes_belanja) || !count($apbdes_pendapatan) || !count($apbdes_pembiayaan)) {
                    return redirect('/adminIrbanwil/cekApbdes_m')->with('error', 'Data APBDes belum terinput seluruhnya');
                }
                return view('adminIrbanwil.cekApbdes.cekApbdes_m_e', [
                    'desa' => $desa,
                    'asal_id' => $asal_id,
                    'infos' => $infos,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'apbdesm' => count($dokumen),
                    'catatan' => $catatan,
                    'kecamatan' => $kecamatan,
                    'deswal' => $deswal,

                    'dokumen' => $dokumen,
                    'belanjas' => $belanjaakun,
                    'pendapatans' => $apbdes_pendapatan,
                    'pembiayaans' => $apbdes_pembiayaan,
                    'total' => $total,
                    'catatan' => count($catatan),
                    'dacat' => $catatan

                ]);
            }
        } else {

            return view('adminIrbanwil.cekApbdes.cekApbdes_m', [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'jenis' => '',
                'tahun' => $tahun,
                'apbdesm' => count($dokumen),
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,

                'catatan' => count($catatan),

            ]);
        }
    }

    public function tambahCatatan(Request $request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'nama_data' => $request->nama_data,
            'catatan' => $request->catatan
        ];
        Catatan_apbd::create($data);
        return back()->with('success', 'berhasil kirim catatan');
    }

    public function editCatatan(Request $request)
    {

        Catatan_apbd::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'nama_data' => $request->nama_data
        ])->update([
            'catatan' => $request->catatan
        ]);
        return back()->with('success', 'berhasil update catatan');
    }

    public function cekApbdes_p(Request $request)
    {
        $tahun = now()->format('Y');
        $infos = Admin::where('id', session('loggedAdminIrbanwil'))->first();
        if ($infos->role == 'admin_sekretariat' || $infos->role == 'admin_irbansus') {
            $asal_id =  Asal::pluck('id')->first();
            $kecamatan = Kecamatan::all();
            $kecamatan1 = $kecamatan->pluck('nama_kecamatan')->first();
        } else {
            $asal_id =  Asal::where('obrik', $infos->obrik)->pluck('id')->first();
            $kecamatan = Kecamatan::where('obrik', $infos->obrik)->get();
            $kecamatan1 = $kecamatan->pluck('nama_kecamatan')->first();
        }

        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }
        if (session()->has('asal_id')) {
            $asal_id = session()->get('asal_id');
        }
        if (session()->has('pilcam')) {
            $kecamatan1 = session()->get('pilcam');
        }

        $deswal = Asal::where('kecamatan', $kecamatan1)->get();
        $desa = Asal::where('id', $asal_id)->first();




        $catatan = Catatan_apbd::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'nama_data' => 'perubahan'
        ])->get();



        // Data APBDes Perubahan
        $dokumen = Apbdes_dokumen::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->where('dokumen_perubahan', '!=', NULL)->get();


        $belanjaakun = Apbdes_belanjaakun::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->where('anggaran_perubahan', '!=', NULL)->get();

        $apbdes_pendapatan = Apbdes_pendapatan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->where('anggaran_perubahan', '!=', NULL)->get();

        $apbdes_belanja = Apbdes_bidang::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->where('anggaran_perubahan', '!=', NULL)->get();

        $apbdes_pembiayaan = Apbdes_pembiayaan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->where('anggaran_perubahan', '!=', NULL)->get();

        $total = Total_apbd::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->where('pendapatan_perubahan', '!=', NULL)->get();


        if (isset($request->jenis)) {
            if ($request->jenis == 'catatan') {
                $data = $catatan;
            } else {
                $data = $dokumen;
            }

            if (count($data) == 0) {
                return view('adminIrbanwil.cekApbdes.cekApbdes_p', [
                    'desa' => $desa,
                    'infos' => $infos,
                    'asal_id' => $asal_id,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'apbdesm' => count($dokumen),
                    'kecamatan' => $kecamatan,
                    'deswal' => $deswal,

                    'catatan' => count($catatan)
                ]);
            } else {
                if (!count($apbdes_pendapatan) || !count($belanjaakun) || !count($apbdes_belanja) || !count($apbdes_pendapatan) || !count($apbdes_pembiayaan)) {
                    return redirect('/adminIrbanwil/cekApbdes_m')->with('error', 'Data APBDes belum terinput seluruhnya');
                }
                return view('adminIrbanwil.cekApbdes.cekApbdes_p_e', [
                    'desa' => $desa,
                    'asal_id' => $asal_id,
                    'infos' => $infos,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'apbdesm' => count($dokumen),
                    'catatan' => $catatan,
                    'kecamatan' => $kecamatan,
                    'deswal' => $deswal,

                    'dokumen' => $dokumen,
                    'belanjas' => $belanjaakun,
                    'pendapatans' => $apbdes_pendapatan,
                    'pembiayaans' => $apbdes_pembiayaan,
                    'total' => $total,
                    'catatan' => count($catatan),
                    'dacat' => $catatan

                ]);
            }
        } else {

            return view('adminIrbanwil.cekApbdes.cekApbdes_p', [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'jenis' => '',
                'tahun' => $tahun,
                'apbdesm' => count($dokumen),
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,

                'catatan' => count($catatan),

            ]);
        }
    }
}
