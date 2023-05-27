<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Apbdes_pembiayaan;
use App\Models\Nilai_keuangan;
use App\Models\Penataan_pembiayaan;
use App\Models\Total_apbd;

use Illuminate\Support\Facades\Storage;

class PenataanPembiayaanController extends Controller
{
    public function formPenataanPembiayaan(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();


        $pembiayaan = Apbdes_pembiayaan::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();

        $penataan = Penataan_pembiayaan::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();

        $data = [
            'infos' => $infos,
            'jenis' => $request->jenis,
            'tahun' => $tahun,
            'pembiayaan' => $pembiayaan

        ];
        $data['penerimaan'] = $penataan->where('pembiayaan_id', '>', 1)->where('pembiayaan_id', '<', 6);
        $data['pengeluaran'] = $penataan->where('pembiayaan_id', '>', 6);


        $data['total_p'] = Total_apbd::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->where('pembiayaan_murni', '!=', NULL)->first();
        if (!$data['total_p']) {
            return back()->with('fail', 'Silahkan Isi Data Pembiayaan Dlm APBDes Terlebih Dahulu!');
        }

        if ($data['total_p']->pembiayaan_perubahan != NULL) {
            $data['anggaran'] = 'perubahan';
        } else {
            $data['anggaran'] = 'murni';
        }


        if (isset($request->jenis)) {
            if ($request->jenis == 'penerimaan') {
                $datum = $penataan->where('pembiayaan_id', '>', 1)->where('pembiayaan_id', '<', 6);
                $data['penPemb'] = $pembiayaan->where('pembiayaan_id', '>', 1)->where('pembiayaan_id', '<', 6);
                $data['anggaranPen'] = $pembiayaan->where('pembiayaan_id', 1)->first();
                $data['realisasi'] = $datum->pluck('jumlah')->sum();
            } elseif ($request->jenis == 'pengeluaran') {
                $datum = $penataan->where('pembiayaan_id', '>', 6);
                $data['pengPemb'] = $pembiayaan->where('pembiayaan_id', '>', 6);
                $data['anggaranPeng'] = $pembiayaan->where('pembiayaan_id', 6)->first();
                $data['realisasi'] = $datum->pluck('jumlah')->sum();
            }

            if (count($datum) == 0) {
                return view('adminDesa.akunPembiayaan.formAkunPembiayaan_t', $data);
            } else {

                return view('adminDesa.akunPembiayaan.formAkunPembiayaan_t', $data);
            }
        } else {
            return view('adminDesa.akunPembiayaan.formAkunPembiayaan', $data);
        }
    }

    public function tambahDapemb(Request $request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'apbdes_pembiayaan_id' => $request->apbdes_pembiayaan_id,
            'pembiayaan_id' => $request->pembiayaan_id,
            'jenis' => $request->jenis,
            'nama_data' => $request->nama_data,
            'jumlah' => strip_tags(str_replace('.', '', $request->jumlah))
        ];
        if ($request->file('file_data')) {
            $ext = $request->file_data->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_pembiayaan";
            $file1 = $request->file('file_data')->storeAs($folder, "file_data_$request->pembiayaan_id" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            $data['file_data'] = $file1;
        }
        Penataan_pembiayaan::create($data);
        return $this->nilaiPembiayaan($request);
    }

    public function hapusBuktiPenPemb(Request $request)
    {

        $dapemb = Penataan_pembiayaan::where('id', $request->id)->first();
        $data = [
            'asal_id' => $dapemb->asal_id,
            'tahun' => $dapemb->tahun,
            'pembiayaan_id' => $dapemb->pembiayaan_id
        ];
        Penataan_pembiayaan::destroy($request->id);
        Storage::delete($request->old);
        return $this->hapusNilaipemb($dapemb);
    }

    public function tambahPengPemb(Request $request)
    {

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'apbdes_pembiayaan_id' => $request->apbdes_pembiayaan_id,
            'pembiayaan_id' => $request->pembiayaan_id,
            'jenis' => $request->jenis,
            'nama_data' => $request->nama_data,
            'jumlah' => strip_tags(str_replace('.', '', $request->jumlah))
        ];


        if ($request->file('file_spp')) {
            $ext = $request->file_spp->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_pembiayaan";
            $file1 = $request->file('file_spp')->storeAs($folder, "file_spp_$request->pembiayaan_id" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $data['file_data'] = $file1;
        }

        Penataan_pembiayaan::create($data);
        return $this->nilaiPembiayaan($request);
    }

    public function nilaiPembiayaan($request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => 2,
            'indikator_id' => 9,
        ];
        $total = Total_apbd::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->first();
        if ($total->pembiayaan_perubahan != NULL) {
            $anggaran = 'anggaran_perubahan';
        } else {
            $anggaran = 'anggaran_murni';
        }

        $pembiayaan_id = $request->pembiayaan_id;
        if ($pembiayaan_id > 1 && $pembiayaan_id < 6) {
            $data['sub_indikator_keuangan_id'] = 7;
            $data['jumlah_data'] = 1;
            $topen = Apbdes_pembiayaan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun
            ])->where('pembiayaan_id', 1)->pluck($anggaran)->first();
            $jumpen = Penataan_pembiayaan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun
            ])->where('pembiayaan_id', '>', 1)->where('pembiayaan_id', '<', 6)->pluck('jumlah')->sum();
            $data['persen_data'] = round(($jumpen / $topen) * 100, 2);
            $data['perbaikan'] = 1;
            $sub_id = 7;
        } else {
            $data['sub_indikator_keuangan_id'] = 8;
            $data['jumlah_data'] = 1;
            $topen = Apbdes_pembiayaan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun
            ])->where('pembiayaan_id', 6)->pluck($anggaran)->first();
            $jumpen = Penataan_pembiayaan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun
            ])->where('pembiayaan_id', '>', 6)->pluck('jumlah')->sum();
            $data['persen_data'] = round(($jumpen / $topen) * 100, 2);
            $data['perbaikan'] = 1;
            $sub_id = 8;
        }



        $cek = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_keuangan_id' => $sub_id
        ])->first();
        if (!$cek) {

            Nilai_keuangan::create($data);
        } else {
            $jumdawal = $cek->jumlah_data;
            Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_keuangan_id' => $sub_id
            ])->update([
                'jumlah_data' => $jumdawal + 1,
                'persen_data' => $data['persen_data'],
                'perbaikan' => true
            ]);
        }
        return back()->with('success', 'Berhasil Kirim Data');
    }

    public function hapusNilaipemb($dapemb)
    {
        $data = [
            'asal_id' => $dapemb->asal_id,
            'tahun' => $dapemb->tahun,
            'aspek_id' => 2,
            'indikator_id' => 9,
        ];
        $total = Total_apbd::where([
            'asal_id' => $dapemb->asal_id,
            'tahun' => $dapemb->tahun
        ])->first();
        if ($total->pembiayaan_perubahan != NULL) {
            $anggaran = 'anggaran_perubahan';
        } else {
            $anggaran = 'anggaran_murni';
        }

        $pembiayaan_id = $dapemb->pembiayaan_id;
        if ($pembiayaan_id > 1 && $pembiayaan_id < 6) {
            $data['sub_indikator_keuangan_id'] = 7;
            $data['jumlah_data'] = 1;
            $topen = Apbdes_pembiayaan::where([
                'asal_id' => $dapemb->asal_id,
                'tahun' => $dapemb->tahun
            ])->where('pembiayaan_id', 1)->pluck($anggaran)->first();
            $jumpen = Penataan_pembiayaan::where([
                'asal_id' => $dapemb->asal_id,
                'tahun' => $dapemb->tahun
            ])->where('pembiayaan_id', '>', 1)->where('pembiayaan_id', '<', 6)->pluck('jumlah')->sum();
            $data['persen_data'] = round(($jumpen / $topen) * 100, 2);
            $data['perbaikan'] = 1;
            $sub_id = 7;
        } else {
            $data['sub_indikator_keuangan_id'] = 8;
            $data['jumlah_data'] = 1;
            $topen = Apbdes_pembiayaan::where([
                'asal_id' => $dapemb->asal_id,
                'tahun' => $dapemb->tahun
            ])->where('pembiayaan_id', 6)->pluck($anggaran)->first();
            $jumpen = Penataan_pembiayaan::where([
                'asal_id' => $dapemb->asal_id,
                'tahun' => $dapemb->tahun
            ])->where('pembiayaan_id', '>', 6)->pluck('jumlah')->sum();
            $data['persen_data'] = round(($jumpen / $topen) * 100, 2);
            $data['perbaikan'] = 1;
            $sub_id = 8;
        }



        $cek = Nilai_keuangan::where([
            'asal_id' => $dapemb->asal_id,
            'tahun' => $dapemb->tahun,
            'sub_indikator_keuangan_id' => $sub_id
        ])->first();
        if (!$cek) {

            Nilai_keuangan::create($data);
        } else {
            $jumdawal = $cek->jumlah_data;
            Nilai_keuangan::where([
                'asal_id' => $dapemb->asal_id,
                'tahun' => $dapemb->tahun,
                'sub_indikator_keuangan_id' => $sub_id
            ])->update([
                'jumlah_data' => $jumdawal - 1,
                'persen_data' => $data['persen_data'],
                'perbaikan' => true
            ]);
        }
        return back()->with('success', 'Berhasil Hapus Data');
    }
}
