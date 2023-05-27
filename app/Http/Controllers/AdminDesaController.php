<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Akunkel;
use App\Models\Datum;
use App\Models\Datum_kewilayahan;
use App\Models\Datum_perangkat;
use App\Models\Asal;
use App\Models\Rpjmd;

class AdminDesaController extends Controller
{

    public function index()
    {
        $adminInfo = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();
        $tahun = now()->format('Y');

        return view('adminDesa.index', [
            'infos' => $adminInfo,
            'tahun' => $tahun

        ]);
    }



    public function profil()
    {
        $adminInfo = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();
        $asal_id = $adminInfo->asal_id;
        $tahun = now()->format('Y');

        $desa =  Asal::where([
            'id' => $asal_id
        ])->get();

        $kantor = Akunkel::where([
            'nama_data' => 'kantor_desa',
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();

        return view('adminDesa.profil.profil', [
            'infos' => $adminInfo,
            'desa' => $desa,
            'kantor' => $kantor
        ]);
    }

    public function ubahPassword(Request $request)
    {
        $id = $request->user_id;
        $data = Admin::where('id', $id)->first();

        if ($request->password !== $data->password) {
            return back()->with('fail', 'Password salah!');
        }
        if ($request->confirm !== $request->new_password) {
            return back()->with('fail', 'Konfirmasi password salah!');
        }

        Admin::where('id', $id)->update([
            'password' => $request->new_password
        ]);
        return redirect('/logoutDesa')->with('success', 'Berhasil Ganti Password');
    }

    public function profildesa()
    {
        $adminInfo = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();
        $asal_id = $adminInfo->asal_id;
        $data['infos'] = $adminInfo;
        $tahun = now()->format('Y');
        $data['tahun'] = $tahun;

        $data['visi'] = Rpjmd::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'jenis' => 'visi_misi',
            'nama_data' => 'visi'
        ])->get();

        $data['misi'] = Rpjmd::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'jenis' => 'visi_misi'
        ])->where('nama_data', 'like', '%' . 'misi' . '%')->get();

        $data['potensi'] = Rpjmd::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
            'jenis' => 'potensi'
        ])->get();

        $data['kantor'] = Akunkel::where([
            'nama_data' => 'kantor_desa',
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();

        $data['kades'] = Datum_perangkat::where([
            'jabatan' => 'Kepala Desa',
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();

        $data['desas'] =  Asal::where([
            'id' => $asal_id
        ])->get();

        $data['datums'] = Datum::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();

        $data['jmlpdd'] = Datum::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'jenis' => 'sarpras'
        ])->whereIn('nama_data', array('tk', 'sd', 'smp', 'sma', 'ponpes'))->sum('isidata');

        $data['jmlibdah'] = Datum::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'jenis' => 'sarpras'
        ])->whereIn('nama_data', array('mesjid', 'mushola', 'gereja', 'pura', 'vihara', 'klenteng'))->sum('isidata');

        $data['jmlkshatan'] = Datum::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'jenis' => 'sarpras'
        ])->whereIn('nama_data', array('puskesmas', 'pustu', 'poskesdes', 'posyandu', 'polindes'))->sum('isidata');

        //Sarana UMUM
        $data['jmlumum'] = Datum::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'jenis' => 'sarpras'
        ])->whereIn('nama_data', array('olahraga', 'kesenian', 'balai', 'sumur', 'pasar', 'lainnya'))->sum('isidata');

        $data['pddmiskin'] = Datum::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'jenis' => 'kependudukan',
            'nama_data' => 'penduduk_miskin'
        ])->sum('isidata');

        return view('adminDesa.beranda.index', $data);
    }

    public function logout(Request $request)
    {
        if (session()->has('loggedAdminDesa')) {
            session()->pull('loggedAdminDesa');
            session()->pull('loggedAdmin');
            session()->pull('adminKeuDesa');
            // $request->session()->invalidate();

            // $request->session()->regenerateToken();
            return redirect('/');
        }
        // if (session()->has('loggedAdminIrwil')) {
        //     session()->pull('loggedAdminDesa');
        //     session()->pull('loggedAdmin');
        //     session()->pull('loggedAdimIrwil');
        //     $request->session()->invalidate();

        //     $request->session()->regenerateToken();
        //     return redirect('/');
        // }
    }

    public function formKewilayahan(Request $request)
    {
        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();


        $datum = Datum_kewilayahan::where('asal_id', $infos->asal_id)->get()->count();


        if ($datum == 0) {
            return view('adminDesa.formDatum.kewilayahan', [
                'infos' => $infos

            ]);
        } else {
            return view('adminDesa.formDatum.kewilayahan_e', [
                'infos' => $infos,
                'wilayahs' => Datum_kewilayahan::where('asal_id', $infos->asal_id)->first()
            ]);
        }
    }

    public function tambahDatumWil(Request $request)
    {
        $data = $request->validate([
            'dasar_hukum' => 'max:255',
            'luas' => 'max:10',
            'asal_id' => 'required',
            'batas_utara' => 'required',
            'batas_selatan' => 'required',
            'batas_barat' => 'required',
            'batas_timur' => 'required',
            'jumlah_dusun' => 'required',
            'jumlah_rt' => 'required',
            'jumlah_bpd' => 'required'

        ]);
        $data = [
            'dasar_hukum' => strip_tags($request->dasar_hukum),
            'luas' => strip_tags($request->luas),
            'asal_id' => strip_tags($request->asal_id),
            'batas_utara' => strip_tags($request->batas_utara),
            'batas_selatan' => strip_tags($request->batas_selatan),
            'batas_barat' => strip_tags($request->batas_barat),
            'batas_timur' => strip_tags($request->batas_timur),
            'jumlah_dusun' => strip_tags($request->jumlah_dusun),
            'jumlah_rt' => strip_tags($request->jumlah_rt),
            'jumlah_bpd' => strip_tags($request->jumlah_bpd)
        ];
        $tambahwil = Datum_kewilayahan::create($data);
        if ($tambahwil) {
            return redirect('/adminDesa/formKewilayahan')->with('tambah', 'Berhasil input data kewilayahan');
        }
    }

    public function updateDatumWil(Request $request)
    {
        $data = $request->validate([
            'dasar_hukum' => 'max:255',
            'luas' => 'max:10',
            'asal_id' => 'required',
            'batas_utara' => 'required',
            'batas_selatan' => 'required',
            'batas_barat' => 'required',
            'batas_timur' => 'required',
            'jumlah_dusun' => 'required',
            'jumlah_rt' => 'required',
            'jumlah_bpd' => 'required'

        ]);


        $data = [
            'dasar_hukum' => strip_tags($request->dasar_hukum),
            'luas' => strip_tags($request->luas),
            'asal_id' => strip_tags($request->asal_id),
            'batas_utara' => strip_tags($request->batas_utara),
            'batas_selatan' => strip_tags($request->batas_selatan),
            'batas_barat' => strip_tags($request->batas_barat),
            'batas_timur' => strip_tags($request->batas_timur),
            'jumlah_dusun' => strip_tags($request->jumlah_dusun),
            'jumlah_rt' => strip_tags($request->jumlah_rt),
            'jumlah_bpd' => strip_tags($request->jumlah_bpd)
        ];
        $updatewil = Datum_kewilayahan::where('asal_id', $data['asal_id'])->update($data);
        if ($updatewil) {
            return redirect('/adminDesa/formKewilayahan')->with('updated', 'data berhasil diupdate');
        }
    }
}
