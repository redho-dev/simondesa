<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

use App\Models\Asal;
use App\Models\Aset_kib;
use App\Models\Aset_kir;
use App\Models\Aset_holder;
use App\Models\Kecamatan;
use App\Models\Sub_indikator_keuangan;
use App\Models\Catatan_keuangan;
use App\Models\Total_apbd;
use App\Models\Nilai_keuangan;
use App\Models\Rekap_nilai_indikator;
use App\Models\Rekap_nilai_aspek;
use App\Models\Indikator;
use App\Models\Dft_pegawai;
use Illuminate\Support\Facades\Storage;

class AkunKeudesasetController extends Controller
{
    public function formKIB(Request $request)
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

        $aset = Aset_kib::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();

        $tanah = $aset->where('jenis', 'tanah');
        $peralatan = $aset->where('jenis', 'peralatan');
        $gedung = $aset->where('jenis', 'gedung');
        $konstruksi = $aset->where('jenis', 'konstruksi');
        $jalan = $aset->where('jenis', 'jalan');
        $lainnya = $aset->where('jenis', 'lainnya');

        if ($request->jenis) {
            $data = Aset_kib::where([
                'asal_id' => $asal_id,
                'jenis' => $request->jenis,
                'tahun' => $request->tahun
            ])->get();

            return view('adminIrbanwil.formAset.formAset_e', [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'jenis' => $request->jenis,
                'tahun' => $tahun,
                'tanah' => count($tanah),
                'peralatan' => count($peralatan),
                'gedung' => count($gedung),
                'konstruksi' => count($konstruksi),
                'jalan' => count($jalan),
                'lainnya' => count($lainnya),
                'datas' => $data


            ]);
        } else {

            return view('adminIrbanwil.formAset.formAset', [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'tahun' => $tahun,
                'jenis' => '',
                'tanah' => count($tanah),
                'peralatan' => count($peralatan),
                'konstruksi' => count($konstruksi),
                'gedung' => count($gedung),
                'jalan' => count($jalan),
                'lainnya' => count($lainnya),

            ]);
        }
    }

    public function formKIR(Request $request)
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

        $aset = Aset_kir::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();


        return view('adminIrbanwil.formAset.formKir', [
            'desa' => $desa,
            'infos' => $infos,
            'asal_id' => $asal_id,
            'kecamatan' => $kecamatan,
            'deswal' => $deswal,
            'tahun' => $tahun,
            'kir' => count($aset),
            'datas' => $aset

        ]);
    }

    public function formHolder(Request $request)
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


        $aset = Aset_holder::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();

        $barang = Aset_kib::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->where(function ($query) {
            $query->where('jenis', 'peralatan');
            $query->orWhere('jenis', 'kendaraan');
        })->get();

        return view('adminIrbanwil.formAset.formHolder', [
            'desa' => $desa,
            'infos' => $infos,
            'asal_id' => $asal_id,
            'kecamatan' => $kecamatan,
            'deswal' => $deswal,
            'tahun' => $tahun,
            'holder' => count($aset),
            'datas' => $aset,
            'barangs' => $barang

        ]);
    }

    public function formInventaris(Request $request)
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


        $aset = Aset_kib::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->orderBy('nup', 'asc')->get();

        $data = [
            'desa' => $desa,
            'infos' => $infos,
            'asal_id' => $asal_id,
            'kecamatan' => $kecamatan,
            'deswal' => $deswal,
            'tahun' => $tahun,
            'asets' => $aset,
            'jumset' => count($aset)

        ];

        return view('adminIrbanwil.formAset.formInventaris', $data);
    }

    public function penilaianPenataanAset(Request $request)
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

        $rekap = Rekap_nilai_indikator::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 12
        ])->first();


        $Subs = Sub_indikator_keuangan::where('indikator_id', 12)->get();

        $catatan = Catatan_keuangan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 12
        ])->first();

        $data = [
            'desa' => $desa,
            'infos' => $infos,
            'asal_id' => $asal_id,
            'kecamatan' => $kecamatan,
            'deswal' => $deswal,
            'tahun' => $tahun,
            'rekap' => $rekap,
            'Subs' => $Subs,
            'catatan' => $catatan


        ];

        if (!$rekap) {
            return view('adminIrbanwil.formAset.formPenilaian_t', $data);
        } else {
            return view('adminIrbanwil.formAset.formPenilaian_e', $data);
        }
    }

    public function nilaiAkunPenataanAset(Request $request)
    {


        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id
        ];


        $i = 16;
        foreach ($request->sub_indikator_keuangan_id as $sub) {
            $cek = Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_keuangan_id' => $i
            ])->first();
            if (!$cek) {
                $data["sub_indikator_keuangan_id"] = $i;
                $data["perbaikan"] = false;
                $data["nilai_sementara"] = $request->nilai[$i - 16];
                $aksi = Nilai_keuangan::create($data);
            } else {

                $ubah = Nilai_keuangan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => $request->aspek_id,
                    'indikator_id' => $request->indikator_id,
                    'sub_indikator_keuangan_id' => $i
                ])->update([
                    'nilai_sementara' => $request->nilai[$i - 16],
                    'perbaikan' => false
                ]);
            }

            $i++;
        }


        unset($data['sub_indikator_keuangan_id']);
        unset($data['nilai_sementara']);
        unset($data['perbaikan']);
        $data['catatan_sementara'] = $request->catatan_sementara;
        $data['rekom_sementara'] = $request->rekom_sementara;
        $data['uraian'] = $request->uraian;
        Catatan_keuangan::create($data);



        return $this->rekap($request);
    }

    public function nilaiAkunPenataanAsetUpdate(Request $request)
    {


        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id
        ];


        $i = 16;
        foreach ($request->sub_indikator_keuangan_id as $sub) {
            $cek = Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_keuangan_id' => $i
            ])->first();
            if (!$cek) {
                $data["sub_indikator_keuangan_id"] = $i;
                $data["perbaikan"] = false;
                $data["nilai_sementara"] = $request->nilai[$i - 16];
                $aksi = Nilai_keuangan::create($data);
            } else {

                $ubah = Nilai_keuangan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => $request->aspek_id,
                    'indikator_id' => $request->indikator_id,
                    'sub_indikator_keuangan_id' => $i
                ])->update([
                    'nilai_sementara' => $request->nilai[$i - 16],
                    'perbaikan' => false
                ]);
            }

            $i++;
        }


        Catatan_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'indikator_id' => $request->indikator_id
        ])->update([
            'catatan_sementara' => $request->catatan_sementara,
            'rekom_sementara' => $request->rekom_sementara,
            'uraian' => $request->uraian
        ]);



        return $this->rekap($request);
    }


    public function rekap($request)
    {

        $cek = Rekap_nilai_indikator::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id,
        ])->first();

        $nilai = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id
        ])->with('sub_indikator_keuangan')->get();
        $sub = Sub_indikator_keuangan::where([
            'indikator_id' => $request->indikator_id
        ])->with('indikator')->get();
        $jumsub = $sub->count();
        $bobotIndikator = $sub[0]->indikator->bobot;

        $persenIndikator = 0;
        $nilaiIndikator = 0;
        foreach ($nilai as $nl) {
            $bobot = $nl->sub_indikator_keuangan->bobot;
            $nisem = $nl->nilai_sementara;
            $persenData = $nl->persen_data;
            $persenIndikator += $persenData;
            $skor = $nisem * $bobot;
            $nilaiIndikator += $skor;
            Nilai_keuangan::where('id', $nl->id)->update([
                'bobot' => $bobot,
                'skor' => round($skor / 100, 2)
            ]);
        }
        $nilaiIndikator = $nilaiIndikator / 100;
        $skorindikator = ($bobotIndikator / 100) * $nilaiIndikator;
        $persenIndikator = round($persenIndikator / $jumsub, 2);

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'indikator_id' => $request->indikator_id,
            'nilai' => $nilaiIndikator,
            'bobot' => $bobotIndikator,
            'skor' => $skorindikator,
            'persen_data' => $persenIndikator
        ];

        if (!$cek) {

            $insert = Rekap_nilai_indikator::create($data);
        } else {
            Rekap_nilai_indikator::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'indikator_id' => $request->indikator_id
            ])->update([
                'nilai' => $nilaiIndikator,
                'bobot' => $bobotIndikator,
                'skor' => $skorindikator,
                'persen_data' => $persenIndikator
            ]);
        }

        $cekAspek = Rekap_nilai_aspek::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id
        ])->first();

        $nilaiAspek = Rekap_nilai_indikator::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id
        ])->pluck('skor')->sum();

        $Indikator = Indikator::with('aspek')->where('aspek_id', $request->aspek_id)->get();
        $jumIndikator = $Indikator->count();

        $bobotAspek = $Indikator[0]->aspek->bobot;
        $dataAspek = Rekap_nilai_indikator::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id
        ])->pluck('persen_data')->sum();

        $persenDataAspek = round($dataAspek / $jumIndikator, 2);
        $dataAspek = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => $request->aspek_id,
            'bobot' => $bobotAspek,
            'persen_data' => $persenDataAspek,
            'nilai' => $nilaiAspek,
            'skor' => round($nilaiAspek / 100 * $bobotAspek, 2)

        ];
        if (!$cekAspek) {
            Rekap_nilai_aspek::create($dataAspek);
        } else {
            Rekap_nilai_aspek::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => $request->aspek_id
            ])->update([
                'bobot' => $bobotAspek,
                'persen_data' => $persenDataAspek,
                'nilai' => $nilaiAspek,
                'skor' => round($nilaiAspek / 100 * $bobotAspek, 2)
            ]);
        }


        return back()->with('success', 'berhasil kirim nilai');
    }
}
