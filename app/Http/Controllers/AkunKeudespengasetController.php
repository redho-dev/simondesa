<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

use App\Models\Asal;
use App\Models\Kecamatan;
use App\Models\Total_apbd;
use App\Models\Nilai_keuangan;
use App\Models\Apbdes_bidang;
use App\Models\Apbdes_dokumen;
use App\Models\Apbdes_kegiatan;
use App\Models\Pengadaan_aset;
use App\Models\Pengadaan_asetnonlapor;
use App\Models\Survey;

class AkunKeudespengasetController extends Controller
{
    public function pengAset(Request $request)
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

        $realisasi = Pengadaan_aset::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->get();

        $survey = Survey::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->where('nama_data', 'survey_peralatan')->get();

        $niSur = Nilai_keuangan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'sub_indikator_keuangan_id' => 14
        ])->get();

        $nilaiSurvey = $niSur->where('nilai_sementara', '!=', NULL)->first();
        $perbaikanSurvey = $niSur->where('perbaikan', true)->first();

        $nonlapor = Pengadaan_asetnonlapor::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
        ])->get();

        $niAset = Nilai_keuangan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'sub_indikator_keuangan_id' => 15
        ])->get();
        $nilaiPengaset = $niAset->first();
        $perbaikanAset = $niAset->where('perbaikan', true)->first();


        if ($request->jenis) {
            if ($request->jenis == 'realisasi') {
                $datum = $realisasi;
            } elseif ($request->jenis == 'survey') {
                $datum = $survey;
            } elseif ($request->jenis == 'nonlapor') {
                $datum = $nonlapor;
            }

            $totalApbd = Total_apbd::where([
                'asal_id' => $asal_id,
                'tahun' => $tahun
            ])->first();
            if (!$totalApbd || !$totalApbd->belanja_murni) {
                return back()->with('fail', 'anda belum isi data APB Desa');
            }
            if ($totalApbd->belanja_perubahan != NULL) {
                $anggaran = 'anggran_perubahan';
            } else {
                $anggaran = 'anggaran_murni';
            }

            $dokumen = Apbdes_dokumen::where([
                'asal_id' => $asal_id,
                'tahun' => $tahun
            ])->first();
            if ($dokumen && $dokumen->dokumen_penjabaran_perubahan) {
                $apbdes = $dokumen->dokumen_penjabaran_perubahan;
                $status = "(perubahan)";
            } elseif ($dokumen && !$dokumen->dokumen_penjabaran_perubahan) {
                $apbdes = $dokumen->dokumen_penjabaran_murni;
                $status = "(murni)";
            } else {
                $apbdes = [];
                $status = "";
            }

            $apbdes_kegiatan = Apbdes_kegiatan::where([
                'asal_id' => $asal_id,
                'tahun' => $tahun
            ])->get();


            if (count($datum) == 0) {

                return view('adminIrbanwil.formPengadaan.realisasiAset_t', [
                    'desa' => $desa,
                    'infos' => $infos,
                    'asal_id' => $asal_id,
                    'kecamatan' => $kecamatan,
                    'deswal' => $deswal,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'data' => $datum,
                    'barangs' => $realisasi,
                    'realisasi' => $realisasi->count(),
                    'survey' => $survey->count(),
                    'nilaiSurvey' => $nilaiSurvey,
                    'nilaiPengaset' => $nilaiPengaset,
                    'nonlapor' => $nonlapor,
                    'apbdes' => $apbdes,
                    'perbaikanSurvey' => $perbaikanSurvey,
                    'perbaikanAset' => $perbaikanAset,
                    'apbdes_kegiatans' => $apbdes_kegiatan,
                    'anggaran' => $anggaran

                ]);
            } else {

                return view('adminIrbanwil.formPengadaan.realisasiAset_e', [
                    'desa' => $desa,
                    'infos' => $infos,
                    'asal_id' => $asal_id,
                    'kecamatan' => $kecamatan,
                    'deswal' => $deswal,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'data' => $datum,
                    'barangs' => $realisasi,
                    'apbdes' => $apbdes,
                    'status' => $status,
                    'realisasi' => $realisasi->count(),
                    'survey' => $survey->count(),
                    'nilaiSurvey' => $nilaiSurvey,
                    'nilaiPengaset' => $nilaiPengaset,
                    'nonlapor' => $nonlapor,
                    'perbaikanSurvey' => $perbaikanSurvey,
                    'perbaikanAset' => $perbaikanAset,
                    'apbdes_kegiatans' => $apbdes_kegiatan,
                    'anggaran' => $anggaran


                ]);
            }
        } else {

            return view('adminIrbanwil.formPengadaan.realisasiAset', [
                'desa' => $desa,
                'infos' => $infos,
                'asal_id' => $asal_id,
                'kecamatan' => $kecamatan,
                'deswal' => $deswal,
                'tahun' => $tahun,
                'jenis' => '',
                'realisasi' => $realisasi->count(),
                'survey' => $survey->count(),
                'nilaiSurvey' => $nilaiSurvey,
                'nilaiPengaset' => $nilaiPengaset,
                'nonlapor' => $nonlapor,
                'perbaikanSurvey' => $perbaikanSurvey,
                'perbaikanAset' => $perbaikanAset


            ]);
        }
    }

    public function nilaiSurveyPeralatan(Request $request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_keuangan_id' => 14,
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

    public function nilaiSurveyPeralatanNull(Request $request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_keuangan_id' => 14,
            'aspek_id' => 2,
            'indikator_id' => 11,
        ];
        $cek = Nilai_keuangan::where($data)->first();
        if (!$cek) {
            $data['jumlah_data'] = 1;
            $data['persen_data'] = 100;
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


    public function nilaiPengAset(Request $request)
    {


        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'id' => $request->id
        ];
        $update = [
            'tgl_cek_fisik' => $request->tgl_cek_fisik,
            'status_temuan' => $request->status_temuan,
            'estimasi_kerugian' => $request->estimasi_kerugian,
            'nilai_sementara' => $request->nilai_sementara,
            'catatan_sementara' => $request->catatan_sementara,
            'rekomendasi_sementara' => $request->rekomendasi_sementara,
        ];

        Pengadaan_aset::where($data)->update($update);
        return $this->nilaiKeuAset($request);
    }

    public function nilaiKeuAset($request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_keuangan_id' => 15,
            'indikator_id' => 11
        ];
        $barang = Pengadaan_aset::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->get();
        $jumbar = $barang->count();
        $jumnil = $barang->pluck('nilai_sementara')->sum();
        $nilai_sementara = round($jumnil / $jumbar);
        $cek = Nilai_keuangan::where($data)->first();
        if (!$cek) {
            $data['jumlah_data'] = 0;
            $data['persen_data'] = 0;
            $data['aspek_id'] = 2;
            $data['nilai_sementara'] = 0;
            $data['perbaikan'] = false;
            Nilai_keuangan::create($data);
        } else {
            Nilai_keuangan::where($data)->update([
                'nilai_sementara' => $nilai_sementara,
                'perbaikan' => false
            ]);
        }
        $tabel = $request->tabel;
        $url = url()->previous();

        return redirect($url . "#" . $tabel)->with('success', 'Berhasil Kirim Nilai');
    }

    public function nilaiPengAsetNull(Request $request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => 2,
            'indikator_id' => 11,
            'sub_indikator_keuangan_id' => 15,
            'jumlah_data' => 1,
            'persen_data' => 100,
            'nilai_sementara' => 100,
            'perbaikan' => false
        ];
        $cek = Nilai_keuangan::where($data)->first();
        if (!$cek) {
            Nilai_keuangan::create($data);
        }

        return back()->with('success', 'berhasil kirim nilai');
    }

    public function pengasetNon(Request $request)
    {

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'apbdes_kegiatan_id' => $request->kegiatan,
            'harga_satuan' => str_replace('.', '', $request->harga_satuan),
            'nama_barang' => strip_tags($request->nama_barang),
            'merk_type' => strip_tags($request->merk_type),
            'jumlah' => $request->jumlah,
            'status_temuan' => 1,
            'catatan_sementara' => 'Indikasi Fiktif, tidak dilaporkan, dan tidak dapat dibuktikan keberadaannya kepada tim pemeriksa',
            'rekomendasi_sementara' => 'Agar segera melaporkan dan membuktikan keberadaan barang kepada inspektorat, kemdian menambahkan barang tersebut ke dalam Daftar Inventaris Aset Desa'
        ];
        $data['harga_total'] = $data['harga_satuan'] * $data['jumlah'];
        $data['estimasi_kerugian'] = $data['harga_satuan'] * $data['jumlah'];
        Pengadaan_asetnonlapor::create($data);

        return back()->with('success', 'berhasil kirim data');
    }

    public function hapusNonlapor(Request $request)
    {
        $id = $request->idhapus;
        Pengadaan_asetnonlapor::destroy($id);
        return "berhasil";
    }
}
