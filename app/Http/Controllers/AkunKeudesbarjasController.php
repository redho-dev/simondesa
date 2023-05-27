<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

use App\Models\Asal;
use App\Models\Kecamatan;
use App\Models\Total_apbd;
use App\Models\Nilai_keuangan;
use App\Models\Apbdes_bidang;
use App\Models\Apbdes_kegiatan;
use App\Models\Cek_fisik;
use App\Models\Pengadaan;
use App\Models\Kegiatan_fisik;
use App\Models\Survey;
use Illuminate\Support\Facades\Storage;

class AkunKeudesbarjasController extends Controller
{
    public function pembFisik(Request $request)
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

        $realisasi = Kegiatan_fisik::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->where('realisasi_anggaran', '!=', NULL)->get();


        $pilfis = Kegiatan_fisik::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();


        $survey = Survey::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->where('nama_data', 'survey_material')->get();

        $perbaikanSurvey = Nilai_keuangan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'sub_indikator_keuangan_id' => 12,
            'perbaikan' => true
        ])->first();

        $perbaikanRealisasi = Kegiatan_fisik::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->where('perbaikan', '!=', NULL)->first();



        $nilaiSurvey = Nilai_keuangan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'sub_indikator_keuangan_id' => 12
        ])->first();

        if ($request->jenis) {
            if ($request->jenis == 'realisasi') {
                $datum = $realisasi;
            } elseif ($request->jenis == 'survey') {
                $datum = $survey;
            }

            $totalApbd = Total_apbd::where([
                'asal_id' => $asal_id,
                'tahun' => $tahun
            ])->first();
            if (!$totalApbd) {
                return back()->with('fail', 'anda belum isi data APB Desa');
            }


            if (count($datum) == 0) {


                return view('adminIrbanwil.formPengadaan.realisasiFisik_t', [
                    'desa' => $desa,
                    'infos' => $infos,
                    'asal_id' => $asal_id,
                    'kecamatan' => $kecamatan,
                    'deswal' => $deswal,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'data' => $datum,
                    'realisasi' => $realisasi->count(),
                    'survey' => $survey->count(),
                    'perbaikanSurvey' => $perbaikanSurvey,
                    'perbaikanRealisasi' => $perbaikanRealisasi

                ]);
            } else {
                return view('adminIrbanwil.formPengadaan.realisasiFisik_e', [
                    'desa' => $desa,
                    'infos' => $infos,
                    'asal_id' => $asal_id,
                    'kecamatan' => $kecamatan,
                    'deswal' => $deswal,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'data' => $datum,

                    'realisasi' => $realisasi->count(),
                    'pilfis' => $pilfis,
                    'survey' => $survey->count(),

                    'nilaiSurvey' => $nilaiSurvey,
                    'perbaikanSurvey' => $perbaikanSurvey,
                    'perbaikanRealisasi' => $perbaikanRealisasi

                ]);
            }
        } else {

            return view('adminIrbanwil.formPengadaan.realisasiFisik', [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'tahun' => $tahun,
                'jenis' => '',
                'realisasi' => $realisasi->count(),
                'survey' => $survey->count(),
                'perbaikanSurvey' => $perbaikanSurvey,
                'perbaikanRealisasi' => $perbaikanRealisasi


            ]);
        }
    }

    public function nilaiSurveyFisik(Request $request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_keuangan_id' => 12,
            'aspek_id' => 2,
            'indikator_id' => 11,
        ];
        $cek = Nilai_keuangan::where($data)->first();
        if (!$cek) {
            $data['jumlah_data'] = 0;
            $data['persen_data'] = 0;
            $data['nilai_sementara'] = $request->nilai_survey;
            $data['perbaikan'] = false;
            Nilai_keuangan::create($data);
        } else {
            Nilai_keuangan::where($data)->update([
                'nilai_sementara' => $request->nilai_survey,
                'perbaikan' => false
            ]);
        }

        return back()->with('success', 'berhasil kirim nilai');
    }

    public function tambahFotoFisik(Request $request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'kegiatan_fisik_id' => $request->kegiatan_fisik_id,
            'nama_data' => 'foto_fisik'
        ];
        if ($request->file('foto_fisik')) {
            $ext = $request->foto_fisik->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/Cek_Fisik";
            $file = $request->file('foto_fisik')->storeAs($folder, "foto_fisik_" . $request->kegiatan_fisik_id . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $data['file_data'] = $file;
        };
        Cek_fisik::create($data);
        $tabel = $request->tabel;
        $url = url()->previous();
        return redirect($url . "#" . $tabel)->with('success', 'berhasil tambah foto');
    }

    public function hapusFotoFisik(Request $request)
    {
        $tabel = "tabel_" . $request->tabel;
        $file = Cek_fisik::where('id', $request->idhapus)->pluck('file_data')->first();
        Storage::delete($file);
        Cek_fisik::destroy($request->idhapus);
        $url = url()->previous();
        return redirect($url . "#" . $tabel)->with('success', 'berhasil hapus foto');
    }

    public function nilaiKegFisik(Request $request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'apbdes_kegiatan_id' => $request->apbdes_kegiatan_id
        ];

        $update = [
            'tgl_cek_fisik' => $request->tgl_cek_fisik,
            'status_temuan' => $request->status_temuan,
            'estimasi_finishing' => $request->estimasi_finishing,
            'estimasi_kerugian' => $request->estimasi_kerugian,
            'catatan_sementara' => $request->catatan_sementara,
            'rekomendasi_sementara' => $request->rekomendasi_sementara,
            'nilai_sementara' => $request->nilai_sementara,
            'perbaikan' => null

        ];
        Kegiatan_fisik::where($data)->update($update);

        $kegFis = Kegiatan_fisik::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->get();
        $nilaiKeg = $kegFis->where('nilai_sementara', '!=', NULL)->pluck('nilai_sementara')->sum();
        $jumkeg = $kegFis->count();
        $nilaiKeu = round($nilaiKeg / $jumkeg, 2);
        Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_keuangan_id' => 13
        ])->update([
            'nilai_sementara' => $nilaiKeu,
            'perbaikan' => false
        ]);

        return 'berhasil';
    }
}
