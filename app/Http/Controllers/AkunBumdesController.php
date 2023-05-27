<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use App\Models\Bumd;
use App\Models\Asal;
use App\Models\Catatan_bumd;
use App\Models\Kecamatan;
use App\Models\Nilai_bumd;

class AkunBumdesController extends Controller
{
    public function formBumdes(Request $request)
    {
        $tahun = now()->format('Y');
        $infos = Admin::where('id', session('loggedAdminIrbanwil'))->first();
        if ($infos->role == 'admin_sekretariat' || $infos->role == 'admin_irbansus') {
            $asal_id =  Asal::first();
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

        $pendirian = Bumd::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'jenis' => 'pendirian'
        ])->get();

        $kepengurusan = Bumd::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'jenis' => 'kepengurusan'
        ])->get();

        if ($request->jenis) {
            $dapen = Bumd::where([
                'asal_id' => $asal_id,
                'tahun' => $tahun,
                'jenis' => $request->jenis
            ])->get();
            if (count($dapen) == 0) {
                return view('adminIrbanwil.bumdes.formBumdes_t', [
                    'desa' => $desa,
                    'infos' => $infos,
                    'asal_id' => $asal_id,
                    'kecamatan' => $kecamatan,
                    'deswal' => $deswal,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'pendirian' => count($pendirian),
                    'kepengurusan' => count($kepengurusan)
                ]);
            } else {
                return view('adminIrbanwil.bumdes.formBumdes_e', [
                    'desa' => $desa,
                    'infos' => $infos,
                    'asal_id' => $asal_id,
                    'kecamatan' => $kecamatan,
                    'deswal' => $deswal,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'pendirian' => count($pendirian),
                    'kepengurusan' => count($kepengurusan),
                    'datas' => $dapen
                ]);
            }
        } else {
            return view('adminIrbanwil.bumdes.formBumdes', [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'jenis' => '',
                'tahun' => $tahun,
                'pendirian' => count($pendirian),
                'kepengurusan' => count($kepengurusan)
            ]);
        }
    }





    public function bumdesLapkeu(Request $request)
    {
        $tahun = now()->format('Y');
        $infos = Admin::where('id', session('loggedAdminIrbanwil'))->first();
        if ($infos->role == 'admin_sekretariat' || $infos->role == 'admin_irbansus') {
            $asal_id =  Asal::first();
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

        $laporan = Bumd::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'jenis' => 'laporan'
        ])->get();
        $dasar = Bumd::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'jenis' => 'dasar_keuangan'
        ])->get();

        if ($request->jenis) {
            $dalap = Bumd::where([
                'asal_id' => $asal_id,
                'tahun' => $tahun,
                'jenis' => $request->jenis
            ])->get();
            if (count($dalap) == 0) {
                return view('adminIrbanwil.bumdes.formLap_t', [
                    'desa' => $desa,
                    'infos' => $infos,
                    'asal_id' => $asal_id,
                    'kecamatan' => $kecamatan,
                    'deswal' => $deswal,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'laporan' => count($laporan),
                    'dasar' => count($dasar)
                ]);
            } else {
                // return $dalap;
                return view('adminIrbanwil.bumdes.formLap_e', [
                    'desa' => $desa,
                    'infos' => $infos,
                    'asal_id' => $asal_id,
                    'kecamatan' => $kecamatan,
                    'deswal' => $deswal,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'laporan' => count($laporan),
                    'dasar' => count($dasar),
                    'datas' => $dalap
                ]);
            }
        } else {

            return view('adminIrbanwil.bumdes.formLap', [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'jenis' => '',
                'tahun' => $tahun,
                'laporan' => count($laporan),
                'dasar' => count($dasar)
            ]);
        }
    }




    public function bumdesPAD(Request $request)
    {
        $tahun = now()->format('Y');
        $infos = Admin::where('id', session('loggedAdminIrbanwil'))->first();
        if ($infos->role == 'admin_sekretariat' || $infos->role == 'admin_irbansus') {
            $asal_id =  Asal::first();
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

        $pad = Bumd::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'jenis' => 'pad'
        ])->get();


        return view('adminIrbanwil.bumdes.formPAD', [
            'desa' => $desa,
            'infos' => $infos,
            'asal_id' => $asal_id,
            'kecamatan' => $kecamatan,
            'deswal' => $deswal,
            'jenis' => '',
            'tahun' => $tahun,
            'pad' => count($pad),
            'datas' => $pad

        ]);
    }

    public function penilaianBumdes(Request $request)
    {
        $tahun = now()->format('Y');
        $infos = Admin::where('id', session('loggedAdminIrbanwil'))->first();
        if ($infos->role == 'admin_sekretariat' || $infos->role == 'admin_irbansus') {
            $asal_id =  Asal::first();
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
        $penilaian = Nilai_bumd::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();
        $catatan = Catatan_bumd::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->first();


        $data = Bumd::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();
        $dasarHukum = $data->where('nama_data', 'sk_kemenkum')->where('isi_data', '!=', '')->count();
        $perdesPembentukan = $data->where('nama_data', 'perdes_pembentukan')->where('isi_data', '!=', '')->count();
        $perdesModal = $data->where('nama_data', 'perdes_modal')->where('isi_data', '!=', '')->count();
        $skPengurus = $data->where('jenis', 'kepengurusan')->where('isi_data', '!=', '')->count();
        $proposal = $data->where('jenis', 'proposal')->where('isi_data', '!=', '')->count();
        $laporan = $data->where('jenis', 'laporan')->where('isi_data', '!=', '')->count();
        $pad = $data->where('jenis', 'pad')->where('isi_data', '!=', '')->count();

        if (count($penilaian) == 0) {
            return view('adminIrbanwil.bumdes.penilaian', [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'jenis' => '',
                'tahun' => $tahun,
                'penilaian' => count($penilaian),
                'dasarHukum' => $dasarHukum,
                'perdesPembentukan' => $perdesPembentukan,
                'perdesModal' => $perdesModal,
                'skPengurus' => $skPengurus,
                'proposal' => $proposal,
                'laporan' => $laporan,
                'pad' => $pad,

            ]);
        } else {
            $totalSkor = $penilaian->pluck('skor')->sum();
            $totalData = $penilaian->pluck('persen_data')->avg();
            $totalNilai = $penilaian->pluck('nilai_sementara')->avg();
            $perbaikan = $penilaian->where('perbaikan', true)->first();
            return view('adminIrbanwil.bumdes.penilaian_e', [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'jenis' => '',
                'tahun' => $tahun,
                'penilaian' => count($penilaian),
                'catatan' => $catatan,
                'datnil' => $penilaian,
                'dasarHukum' => $dasarHukum,
                'perdesPembentukan' => $perdesPembentukan,
                'perdesModal' => $perdesModal,
                'skPengurus' => $skPengurus,
                'proposal' => $proposal,
                'laporan' => $laporan,
                'pad' => $pad,
                'totalSkor' => $totalSkor,
                'totalData' => $totalData,
                'totalNilai' => $totalNilai,
                'perbaikan' => $perbaikan

            ]);
        }
    }


    public function nilaiBumdesTambah(Request $request)
    {

        $i = 1;
        foreach ($request->nilai as $nilai) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 3,
                'indikator_bumd_id' => $i,
                'jumlah_data' => $request->jumlah_data[$i - 1],
                'perbaikan' => false,
                'nilai_sementara' => $nilai,
                'bobot' => $request->bobot[$i - 1]
            ];
            if ($data['jumlah_data'] > 0) {
                $data['persen_data'] = 100;
            } else {
                $data['persen_data'] = 0;
            }
            $data['skor'] = $data['nilai_sementara'] * ($data['bobot'] / 100);
            $data['skor'] = round($data['skor'], 2);

            Nilai_bumd::create($data);

            $i++;
        }

        Catatan_bumd::create([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'uraian' => $request->uraian,
            'catatan_sementara' => $request->catatan_sementara,
            'rekom_sementara' => $request->rekom_sementara
        ]);

        return back()->with('success', 'berhasil kirim nilai');
    }

    public function nilaiBumdesUpdate(Request $request)
    {

        $i = 1;
        foreach ($request->nilai as $nilai) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 3,
                'indikator_bumd_id' => $i,
                'jumlah_data' => $request->jumlah_data[$i - 1],
                'perbaikan' => false,
                'nilai_sementara' => $nilai,
                'bobot' => $request->bobot[$i - 1]
            ];
            if ($data['jumlah_data'] > 0) {
                $data['persen_data'] = 100;
            } else {
                $data['persen_data'] = 0;
            }
            $data['skor'] = $data['nilai_sementara'] * ($data['bobot'] / 100);
            $data['skor'] = round($data['skor'], 2);

            Nilai_bumd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'indikator_bumd_id' => $i
            ])->update($data);

            $i++;
        }

        Catatan_bumd::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,

        ])->update([
            'uraian' => $request->uraian,
            'catatan_sementara' => $request->catatan_sementara,
            'rekom_sementara' => $request->rekom_sementara
        ]);

        return back()->with('success', 'berhasil update nilai');
    }
}
