<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Apbdes_kegiatan;
use App\Models\Aset_kib;
use App\Models\Pengadaan_aset;
use App\Models\Total_apbd;
use App\Models\Survey;
use App\Models\Nilai_keuangan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PengadaanAsetController extends Controller
{
    public function pengadaanAset(Request $request)
    {

        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();


        $realisasi = Pengadaan_aset::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun,
        ])->get();


        $survey = Survey::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun,
        ])->where('nama_data', 'survey_peralatan')->get();

        // $pembangunan = Apbdes_bidang::where([
        //     'asal_id' => $infos->asal_id,
        //     'tahun' => $tahun,
        // ])->with('apbdes_kegiatan')->get();




        if ($request->jenis) {
            if ($request->jenis == 'realisasi') {
                $datum = $realisasi;
            } elseif ($request->jenis == 'survey') {
                $datum = $survey;
            }

            $apbdes_kegiatan = Apbdes_kegiatan::where([
                'asal_id' => $infos->asal_id,
                'tahun' => $tahun
            ])->get();
            //cek status anggaran
            $data['total_p'] = Total_apbd::where([
                'asal_id' => $infos->asal_id,
                'tahun' => $tahun
            ])->first();
            if (!$data['total_p']) {
                return back()->with('fail', 'Belum Ada Input APB Desa!');
            }
            if ($data['total_p']->belanja_perubahan != NULL) {
                $anggaran = 'anggran_perubahan';
            } else {
                $anggaran = 'anggaran_murni';
            }
            //end cek status anggaran

            if (count($datum) == 0) {


                return view('adminDesa.formPengadaan.realisasiPaset_t', [
                    'infos' => $infos,
                    'tahun' => $tahun,
                    'jenis' => $request->jenis,
                    'data' => $datum,
                    'realisasi' => $realisasi->count(),
                    'barangs' => $realisasi,
                    'survey' => $survey->count(),
                    'apbdes_kegiatans' => $apbdes_kegiatan,
                    'anggaran' => $anggaran
                ]);
            } else {
                return view('adminDesa.formPengadaan.realisasiPaset_e', [
                    'infos' => $infos,
                    'tahun' => $tahun,
                    'jenis' => $request->jenis,
                    'data' => $datum,
                    'barangs' => $realisasi,
                    'realisasi' => $realisasi->count(),
                    'survey' => $survey->count(),
                    'apbdes_kegiatans' => $apbdes_kegiatan,
                    'anggaran' => $anggaran

                ]);
            }
        } else {

            return view('adminDesa.formPengadaan.realisasiPaset', [
                'infos' => $infos,
                'tahun' => $tahun,
                'jenis' => '',
                'realisasi' => $realisasi->count(),
                'survey' => $survey->count()


            ]);
        }
    }


    public function tambahSurveyperalatan(Request $request)
    {

        if ($request->file('survey_peralatan')) {

            $ext = $request->survey_peralatan->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file = $request->file('survey_peralatan')->storeAs($folder, "survey_peralatan_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);

            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => $request->nama_data,
                'file_data' => $file
            ];

            Survey::create($data);
        }

        return $this->inputNilaiSurvey($request);
    }

    public function updateSurveyperalatan(Request $request)
    {

        if ($request->file('survey_peralatan')) {
            if ($request->old && strpos($request->old, $request->tahun)) {
                Storage::delete($request->old);
            }
            $ext = $request->survey_peralatan->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file = $request->file('survey_peralatan')->storeAs($folder, "survey_peralatan_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);
            Survey::where('id', $request->id)->update([
                'file_data' => $file
            ]);
        }

        return $this->inputNilaiSurvey($request);
    }


    public function inputNilaiDaset($request, $penghubung)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => 2,
            'indikator_id' => 11,
            'sub_indikator_keuangan_id' => 15,

        ];

        $cek = Nilai_keuangan::where($data)->first();
        $barang = Pengadaan_aset::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->get();

        if (!$cek) {
            $data['jumlah_data'] = 1;
            $data['persen_data'] = 100;
            $data['perbaikan'] = true;
            Nilai_keuangan::create($data);
        } else {
            $jumdata = $barang->count();
            $nilai = $barang->pluck('nilai_sementara')->sum();
            $nilai_sementara = round($nilai / $jumdata);

            Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 2,
                'indikator_id' => 11,
                'sub_indikator_keuangan_id' => 15
            ])->update([
                'jumlah_data' => $jumdata,
                'persen_data' => 100,
                'perbaikan' => true,
                'nilai_sementara' => $nilai_sementara
            ]);
        }

        return $this->inputDaftarAset($request, $penghubung);
    }

    public function inputDaftarAset($request, $penghubung)
    {
        $nup = Aset_kib::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->pluck('nup')->max();
        if (!$nup) {
            $nup = 0;
        }


        for ($i = 1; $i <= $request->jumlah; $i++) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'luas_merk' => $request->merk_type,
                'nama_barang' => $request->nama_barang,
                'jenis' => 'peralatan',
                'tahun_perolehan' => $request->tahun,
                'nilai_perolehan' => str_replace('.', '', $request->harga),
                'kondisi_barang' => 'baik',
                'asal_usul' => 'APB Desa',
                'keterangan' => 'Pengadaan Tahun ' . $request->tahun,
                'nup' => $nup + $i,
                'penghubung' => $penghubung
            ];
            Aset_kib::create($data);
        }

        return back()->with('success', 'berhasil kirim data');
    }





    public function inputNilaiSurvey($request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => 2,
            'indikator_id' => 11,
            'sub_indikator_keuangan_id' => 14
        ];

        $cek = Nilai_keuangan::where($data)->first();
        if (!$cek) {
            $data['jumlah_data'] = 1;
            $data['persen_data'] = 100;
            $data['perbaikan'] = true;
            Nilai_keuangan::create($data);
        } else {
            Nilai_keuangan::where($data)->update([
                'jumlah_data' => 1,
                'persen_data' => 100,
                'perbaikan' => true
            ]);
        }
        return back()->with('success', 'Berhasil Kirim Data');
    }

    public function tambahBelanjaAset(Request $request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'apbdes_kegiatan_id' => $request->kegiatan,
            'harga_satuan' => str_replace('.', '', $request->harga),
            'nama_barang' => strip_tags($request->nama_barang),
            'merk_type' => strip_tags($request->merk_type),
            'jumlah' => $request->jumlah
        ];
        $data['harga_total'] = $data['harga_satuan'] * $data['jumlah'];

        if ($request->file('foto_barang')) {

            $ext = $request->foto_barang->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file_data = $request->foto_barang->storeAs($folder, "foto_barang_" . trim($request->nama_barang) . "_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $data['foto_barang'] = $file_data;
        }

        if ($request->file('bukti')) {

            $ext = $request->bukti->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file = $request->bukti->storeAs($folder, "bukti_" . trim($request->nama_barang) . "_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $data['bukti_belanja'] = $file;
        }
        $data['penghubung'] = mt_rand(1, 1000) . Str::random(4);
        Pengadaan_aset::create($data);

        return $this->inputNilaiDaset($request, $data['penghubung']);
    }



    public function hapusBelanjaAset(Request $request)
    {
        $id = $request->idhapus;
        $data = Pengadaan_aset::where('id', $id)->first();
        $cegah = $data->tgl_cek_fisik;
        if ($cegah) {
            return 'anda tidak bisa menghapus data yang sudah dicek Inspektorat!';
        }

        $asal_id = $data->asal_id;
        $tahun = $data->tahun;
        $penghubung = $data->penghubung;
        $nama_barang = $data->nama_barang;

        Storage::delete($data->foto_barang);
        Storage::delete($data->bukti_belanja);
        Pengadaan_aset::destroy($id);
        $cek = Pengadaan_aset::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();
        if (!$cek->count()) {
            Nilai_keuangan::where([
                'asal_id' => $asal_id,
                'tahun' => $tahun,
                'sub_indikator_keuangan_id' => 15
            ])->delete();
        } else {
            $jumdata = $cek->count();
            $nilai = $cek->pluck('nilai_sementara')->sum();
            $nilai_sementara = round($nilai / $jumdata);

            Nilai_keuangan::where([
                'asal_id' => $asal_id,
                'tahun' => $tahun,
                'aspek_id' => 2,
                'indikator_id' => 11,
                'sub_indikator_keuangan_id' => 15
            ])->update([
                'jumlah_data' => $jumdata,
                'persen_data' => 100,
                'nilai_sementara' => $nilai_sementara
            ]);
        }
        Aset_kib::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'nama_barang' => $nama_barang,
            'penghubung' => $penghubung
        ])->delete();
        return "berhasil";
    }
}
