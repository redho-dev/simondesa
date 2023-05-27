<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Apbdes_bidang;
use App\Models\Apbdes_kegiatan;
use App\Models\Kegiatan_fisik;
use App\Models\Pengadaan;
use App\Models\Total_apbd;
use App\Models\Survey;
use App\Models\Nilai_keuangan;
use App\Models\Aset_kib;
use Illuminate\Support\Facades\Storage;

class PengadaanController extends Controller
{

    public function realisasiPemb(Request $request)
    {

        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();


        $realisasi = Kegiatan_fisik::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun,
        ])->where('realisasi_anggaran', '!=', NULL)->get();

        $survey = Survey::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun,
        ])->where('nama_data', 'survey_material')->get();


        // $pembangunan = Apbdes_bidang::where([
        //     'asal_id' => $infos->asal_id,
        //     'tahun' => $tahun,
        // ])->with('apbdes_kegiatan')->get();

        $totalApbd = Total_apbd::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->first();
        if (!$totalApbd) {
            return back()->with('fail', 'anda belum isi data APB Desa');
        }

        if ($totalApbd->belanja_perubahan != NULL) {

            $status_anggaran = "anggaran_perubahan";
            $dapemb = Apbdes_kegiatan::where([
                'asal_id' => $infos->asal_id,
                'tahun' => $tahun
            ])->where('anggaran_perubahan', '!=', 0)->get();
        } else {
            $status_anggaran = "anggaran_murni";
            $dapemb = Apbdes_kegiatan::where([
                'asal_id' => $infos->asal_id,
                'tahun' => $tahun
            ])->where('anggaran_murni', '!=', 0)->get();
        }

        $pilfis = Kegiatan_fisik::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();


        if ($request->jenis) {
            if ($request->jenis == 'realisasi') {
                $datum = $realisasi;
                if (!count($pilfis)) {
                    return back()->with('fail', 'anda belum mengisi pilihan kegiatan fisik!');
                }
            } elseif ($request->jenis == 'survey') {
                $datum = $survey;
            } elseif ($request->jenis == 'pilfis') {
                $datum = $pilfis;
            }

            if (count($datum) == 0) {

                return view('adminDesa.formPengadaan.realisasiFisik_t', [
                    'infos' => $infos,
                    'tahun' => $tahun,
                    'jenis' => $request->jenis,
                    'data' => $datum,
                    'dapemb' => $dapemb,
                    'status_anggaran' => $status_anggaran,
                    'realisasi' => $realisasi->count(),
                    'survey' => $survey->count(),
                    'pilfis' => $pilfis
                ]);
            } else {
                return view('adminDesa.formPengadaan.realisasiFisik_e', [
                    'infos' => $infos,
                    'tahun' => $tahun,
                    'jenis' => $request->jenis,
                    'data' => $datum,
                    'dapemb' => $dapemb,
                    'status_anggaran' => $status_anggaran,
                    'realisasi' => $realisasi->count(),
                    'survey' => $survey->count(),
                    'pilfis' => $pilfis

                ]);
            }
        } else {

            return view('adminDesa.formPengadaan.realisasiFisik', [
                'infos' => $infos,
                'tahun' => $tahun,
                'jenis' => '',
                'dapemb' => $dapemb,
                'status_anggaran' => $status_anggaran,
                'realisasi' => $realisasi->count(),
                'survey' => $survey->count(),
                'pilfis' => $pilfis


            ]);
        }
    }

    public function kegfisikTambah(Request $request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'apbdes_kegiatan_id' => $request->apbdes_kegiatan_id,
            'anggaran' => str_replace('.', '', $request->anggaran),
            'sifat' => $request->sifat
        ];

        $cek = Kegiatan_fisik::where([
            'apbdes_kegiatan_id' => $request->apbdes_kegiatan_id
        ])->first();

        if (!$cek) {
            Kegiatan_fisik::create($data);
        } else {
            return back()->with('fail', 'kegiatan ini sudah ditambahkan');
        }

        return back()->with('success', 'berhasil tambah data');
    }

    public function tambahRealisasiFisik(Request $request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'apbdes_kegiatan_id' => $request->apbdes_kegiatan_id
        ];

        $update = [
            'realisasi_anggaran' => str_replace('.', '', $request->realisasi_anggaran),
            'jenis' => $request->jenis
        ];


        if ($request->file('sk_tpk')) {
            $ext = $request->sk_tpk->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file1 = $request->file('sk_tpk')->storeAs($folder, "sk_tpk_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $update['sk_tpk'] = $file1;
        }

        if ($request->file('desain_rab')) {
            $ext = $request->desain_rab->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file2 = $request->file('desain_rab')->storeAs($folder, "desain_rab_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $update['desain_rab'] = $file2;
        }

        if ($request->file('foto_0')) {
            $ext = $request->foto_0->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file3 = $request->file('foto_0')->storeAs($folder, "foto_0_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $update['foto_0'] = $file3;
        }

        if ($request->file('foto_50')) {
            $ext = $request->foto_50->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file4 = $request->file('foto_50')->storeAs($folder, "foto_50_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $update['foto_50'] = $file4;
        }

        if ($request->file('foto_100')) {
            $ext = $request->foto_100->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file5 = $request->file('foto_100')->storeAs($folder, "foto_100_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $update['foto_100'] = $file5;
        }

        if ($request->file('prasasti')) {
            $ext = $request->prasasti->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file6 = $request->file('prasasti')->storeAs($folder, "prasasti_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $update['foto_prasasti'] = $file6;
        }

        if ($request->file('foto_papan')) {
            $ext = $request->foto_papan->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file7 = $request->file('foto_papan')->storeAs($folder, "foto_papan_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $update['foto_papan'] = $file7;
        }

        if ($request->file('bast')) {
            $ext = $request->bast->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file8 = $request->file('bast')->storeAs($folder, "bast_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $update['bast'] = $file8;
        }

        Kegiatan_fisik::where($data)->update($update);
        if ($request->sifat == 'Pembangunan_Baru') {
            return $this->inputAset($request);
        } else {
            return $this->inputNilaiFisik($request);
        }
    }

    public function inputAset($request)
    {
        $jenis = $request->jenis;
        if ($jenis == '1') {
            $jenis = 'Jalan';
            $nama_barang = 'Jalan / Prasarana jalan';
        } elseif ($jenis == '2') {
            $jenis = 'jalan';
            $nama_barang = 'Jembatan';
        } elseif ($jenis == '3') {
            $jenis = 'jalan';
            $nama_barang = 'Irigasi/Drainase/Embung/Persampahan';
        } elseif ($jenis == '4') {
            $jenis = 'jalan';
            $nama_barang = 'Jaringan / Instalasi';
        } elseif ($jenis == '5') {
            $jenis = 'gedung';
            $nama_barang = 'Gedung / Bangunan';
        } elseif ($jenis == '6') {
            $jenis = 'gedung';
            $nama_barang = 'Lainnya';
        }


        $nupmax = Aset_kib::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
        ])->pluck('nup')->max();


        $data = [
            'asal_id' => $request->asal_id,
            'jenis' => $jenis,
            'tahun' => $request->tahun,
            'nama_barang' => $nama_barang,
            'nup' => $nupmax + 1,
            'tahun_perolehan' => $request->tahun,
            'kondisi_barang' => 'baik',
            'nilai_perolehan' => str_replace('.', '', $request->realisasi_anggaran),
            'asal_usul' => "APB Desa",
            'keterangan' => 'hasil pembangunan tahun ' . $request->tahun
        ];

        Aset_kib::create($data);
        return $this->inputNilaiFisik($request);
    }






    public function tambahLaporPemb(Request $request)
    {


        $data = [
            'asal_id' => strip_tags($request->asal_id),
            'tahun' => strip_tags($request->tahun),
            'apbdes_kegiatan_id' => strip_tags($request->apbdes_kegiatan_id),
            'jumlah_anggaran' => strip_tags(str_replace('.', '', $request->jumlah_anggaran))
        ];

        $cek = Pengadaan::where($data)->first();
        if (!$cek) {
            foreach ($request->nama_data as $dt) {
                $data['nama_data'] = $dt;
                Pengadaan::create($data);
            }
        }


        if ($request->file('sk_tpk')) {
            $ext = $request->sk_tpk->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file = $request->file('sk_tpk')->storeAs($folder, "sk_tpk_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);

            Pengadaan::where([
                'asal_id' => strip_tags($request->asal_id),
                'tahun' => strip_tags($request->tahun),
                'apbdes_kegiatan_id' => strip_tags($request->apbdes_kegiatan_id),
                'nama_data' => 'sk_tpk'
            ])->update([
                'file_data' => $file
            ]);
        }

        if ($request->file('desain')) {
            $ext = $request->desain->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file = $request->file('desain')->storeAs($folder, "desain_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);
            Pengadaan::where([
                'asal_id' => strip_tags($request->asal_id),
                'tahun' => strip_tags($request->tahun),
                'apbdes_kegiatan_id' => strip_tags($request->apbdes_kegiatan_id),
                'nama_data' => 'desain'
            ])->update([
                'file_data' => $file
            ]);
        }

        if ($request->file('foto_0')) {
            $ext = $request->foto_0->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file = $request->file('foto_0')->storeAs($folder, "foto_0_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);
            Pengadaan::where([
                'asal_id' => strip_tags($request->asal_id),
                'tahun' => strip_tags($request->tahun),
                'apbdes_kegiatan_id' => strip_tags($request->apbdes_kegiatan_id),
                'nama_data' => 'foto_0'
            ])->update([
                'file_data' => $file
            ]);
        }

        if ($request->file('foto_50')) {
            $ext = $request->foto_50->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file = $request->file('foto_50')->storeAs($folder, "foto_50_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);
            Pengadaan::where([
                'asal_id' => strip_tags($request->asal_id),
                'tahun' => strip_tags($request->tahun),
                'apbdes_kegiatan_id' => strip_tags($request->apbdes_kegiatan_id),
                'nama_data' => 'foto_50'
            ])->update([
                'file_data' => $file
            ]);
        }
        if ($request->file('foto_100')) {
            $ext = $request->foto_100->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file = $request->file('foto_100')->storeAs($folder, "foto_100_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);
            Pengadaan::where([
                'asal_id' => strip_tags($request->asal_id),
                'tahun' => strip_tags($request->tahun),
                'apbdes_kegiatan_id' => strip_tags($request->apbdes_kegiatan_id),
                'nama_data' => 'foto_100'
            ])->update([
                'file_data' => $file
            ]);
        }
        if ($request->file('prasasti')) {
            $ext = $request->prasasti->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file = $request->file('prasasti')->storeAs($folder, "prasasti_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);
            Pengadaan::where([
                'asal_id' => strip_tags($request->asal_id),
                'tahun' => strip_tags($request->tahun),
                'apbdes_kegiatan_id' => strip_tags($request->apbdes_kegiatan_id),
                'nama_data' => 'prasasti'
            ])->update([
                'file_data' => $file
            ]);
        }
        if ($request->file('bast')) {
            $ext = $request->bast->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file = $request->file('bast')->storeAs($folder, "bast_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);
            Pengadaan::where([
                'asal_id' => strip_tags($request->asal_id),
                'tahun' => strip_tags($request->tahun),
                'apbdes_kegiatan_id' => strip_tags($request->apbdes_kegiatan_id),
                'nama_data' => 'bast'
            ])->update([
                'file_data' => $file
            ]);
        }

        if ($request->file('foto_papan')) {
            $ext = $request->foto_papan->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file = $request->file('foto_papan')->storeAs($folder, "foto_papan_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);

            Pengadaan::where([
                'asal_id' => strip_tags($request->asal_id),
                'tahun' => strip_tags($request->tahun),
                'apbdes_kegiatan_id' => strip_tags($request->apbdes_kegiatan_id),
                'nama_data' => 'foto_papan'
            ])->update([
                'file_data' => $file
            ]);
        }


        return $this->inputNilaiFisik($request);
    }

    public function inputNilaiFisik($request)
    {
        $fisik = Kegiatan_fisik::where([
            'asal_id' => strip_tags($request->asal_id),
            'tahun' => strip_tags($request->tahun)
        ])->get();
        $jumFisik = $fisik->count();
        $jumRealisasi = $fisik->where('realisasi_anggaran', '!=', NULL)->count();
        $persen = ($jumRealisasi / $jumFisik) * 100;
        $persendata = round($persen, 2);

        $data = [
            'asal_id' => strip_tags($request->asal_id),
            'tahun' => strip_tags($request->tahun),
            'aspek_id' => 2,
            'indikator_id' => 11,
            'sub_indikator_keuangan_id' => 13
        ];
        $cek = Nilai_keuangan::where($data)->first();
        if (!$cek) {
            $data['jumlah_data'] = $jumRealisasi;
            $data['persen_data'] = $persendata;
            $data['perbaikan'] = true;
            Nilai_keuangan::create($data);
        } else {
            Nilai_keuangan::where($data)->update([
                'jumlah_data' => $jumRealisasi,
                'persen_data' => $persendata,
                'perbaikan' => true
            ]);
        }

        $tabel = "tabel_" . $request->tabel;
        $url = url()->previous();

        if ($request->sifat == 'Pembangunan_Baru') {
            return redirect("$url#$tabel")->with('aset', 'berhasil kirim data, aset telah ditambahkan secara otomatis, silahkan anda update data aset (nama barang, volume, dll)');
        } else {
            return redirect("$url#$tabel")->with('success', 'berhasil kirim data');
        }
    }

    public function updateRealisasiFisik(Request $request)
    {

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'apbdes_kegiatan_id' => $request->apbdes_kegiatan_id
        ];
        $update = [
            'realisasi_anggaran' => $request->realisasi_anggaran,
            'jenis' => $request->jenis
        ];


        if ($request->file('sk_tpk')) {
            if ($request->old_1 && strpos($request->old_1, $request->tahun)) {
                Storage::delete($request->old_1);
            }
            $ext = $request->sk_tpk->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file1 = $request->file('sk_tpk')->storeAs($folder, "sk_tpk_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $update['sk_tpk'] = $file1;
            $perbaikan = Kegiatan_fisik::where($data)->pluck('perbaikan')->first();
            $update['perbaikan'] = $perbaikan . "|" . "1";
            Kegiatan_fisik::where($data)->update($update);
        }

        if ($request->file('desain_rab')) {
            if ($request->old_2 && strpos($request->old_2, $request->tahun)) {
                Storage::delete($request->old_2);
            }
            $ext = $request->desain_rab->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file2 = $request->file('desain_rab')->storeAs($folder, "desain_rab_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $update['desain_rab'] = $file2;
            $perbaikan = Kegiatan_fisik::where($data)->pluck('perbaikan')->first();
            $update['perbaikan'] = $perbaikan . "|" . "2";
            Kegiatan_fisik::where($data)->update($update);
        }

        if ($request->file('foto_0')) {
            if ($request->old_3 && strpos($request->old_3, $request->tahun)) {
                Storage::delete($request->old_3);
            }
            $ext = $request->foto_0->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file3 = $request->file('foto_0')->storeAs($folder, "foto_0_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $update['foto_0'] = $file3;
            $perbaikan = Kegiatan_fisik::where($data)->pluck('perbaikan')->first();
            $update['perbaikan'] = $perbaikan . "|" . "3";
            Kegiatan_fisik::where($data)->update($update);
        }

        if ($request->file('foto_50')) {
            if ($request->old_4 && strpos($request->old_4, $request->tahun)) {
                Storage::delete($request->old_4);
            }
            $ext = $request->foto_50->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file4 = $request->file('foto_50')->storeAs($folder, "foto_50_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $update['foto_50'] = $file4;
            $perbaikan = Kegiatan_fisik::where($data)->pluck('perbaikan')->first();
            $update['perbaikan'] = $perbaikan . "|" . "4";
            Kegiatan_fisik::where($data)->update($update);
        }

        if ($request->file('foto_100')) {
            if ($request->old_5 && strpos($request->old_5, $request->tahun)) {
                Storage::delete($request->old_5);
            }
            $ext = $request->foto_100->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file5 = $request->file('foto_100')->storeAs($folder, "foto_100_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $update['foto_100'] = $file5;
            $perbaikan = Kegiatan_fisik::where($data)->pluck('perbaikan')->first();
            $update['perbaikan'] = $perbaikan . "|" . "5";
            Kegiatan_fisik::where($data)->update($update);
        }
        if ($request->file('prasasti')) {
            if ($request->old_6 && strpos($request->old_6, $request->tahun)) {
                Storage::delete($request->old_6);
            }
            $ext = $request->prasasti->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file6 = $request->file('prasasti')->storeAs($folder, "prasasti_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $update['foto_prasasti'] = $file6;
            $perbaikan = Kegiatan_fisik::where($data)->pluck('perbaikan')->first();
            $update['perbaikan'] = $perbaikan . "|" . "7";
            Kegiatan_fisik::where($data)->update($update);
        }
        if ($request->file('bast')) {
            if ($request->old_7 && strpos($request->old_7, $request->tahun)) {
                Storage::delete($request->old_7);
            }
            $ext = $request->bast->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file7 = $request->file('bast')->storeAs($folder, "bast_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $update['bast'] = $file7;
            $perbaikan = Kegiatan_fisik::where($data)->pluck('perbaikan')->first();
            $update['perbaikan'] = $perbaikan . "|" . "8";
            Kegiatan_fisik::where($data)->update($update);
        }

        if ($request->file('foto_papan')) {
            if ($request->old_8 && strpos($request->old_8, $request->tahun)) {
                Storage::delete($request->old_8);
            }
            $ext = $request->foto_papan->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file8 = $request->file('foto_papan')->storeAs($folder, "foto_papan_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $update['foto_papan'] = $file8;
            $perbaikan = Kegiatan_fisik::where($data)->pluck('perbaikan')->first();
            $update['perbaikan'] = $perbaikan . "|" . "6";
            Kegiatan_fisik::where($data)->update($update);
        }



        return $this->inputNilaiFisik($request);
    }



    public function updateLaporPemb(Request $request)
    {

        if ($request->file('sk_tpk')) {
            if ($request->old_1 && strpos($request->old_1, $request->tahun)) {
                Storage::delete($request->old_1);
            }
            $ext = $request->sk_tpk->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file = $request->file('sk_tpk')->storeAs($folder, "sk_tpk_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);
            $data['file_data'] = $file;
            $data['nama_data'] = 'sk_tpk';
            Pengadaan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'apbdes_kegiatan_id' => $request->apbdes_kegiatan_id,
                'nama_data' => 'sk_tpk'
            ])->update([
                'file_data' => $file,
                'perbaikan' => true
            ]);
        }

        if ($request->file('desain')) {
            if ($request->old_2 && strpos($request->old_2, $request->tahun)) {
                Storage::delete($request->old_2);
            }
            $ext = $request->desain->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file = $request->file('desain')->storeAs($folder, "desain_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);
            $data['file_data'] = $file;
            $data['nama_data'] = 'desain';
            Pengadaan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'apbdes_kegiatan_id' => $request->apbdes_kegiatan_id,
                'nama_data' => 'desain'
            ])->update([
                'file_data' => $file,
                'perbaikan' => true
            ]);
        }

        if ($request->file('foto_0')) {
            if ($request->old_3 && strpos($request->old_3, $request->tahun)) {
                Storage::delete($request->old_3);
            }
            $ext = $request->foto_0->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file = $request->file('foto_0')->storeAs($folder, "foto_0_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);
            $data['file_data'] = $file;
            $data['nama_data'] = 'foto_0';
            Pengadaan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'apbdes_kegiatan_id' => $request->apbdes_kegiatan_id,
                'nama_data' => 'foto_0'
            ])->update([
                'file_data' => $file,
                'perbaikan' => true
            ]);
        }

        if ($request->file('foto_50')) {
            if ($request->old_4 && strpos($request->old_4, $request->tahun)) {
                Storage::delete($request->old_4);
            }
            $ext = $request->foto_50->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file = $request->file('foto_50')->storeAs($folder, "foto_50_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);
            $data['file_data'] = $file;
            $data['nama_data'] = 'foto_50';
            Pengadaan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'apbdes_kegiatan_id' => $request->apbdes_kegiatan_id,
                'nama_data' => 'foto_50'
            ])->update([
                'file_data' => $file,
                'perbaikan' => true
            ]);
        }

        if ($request->file('foto_100')) {
            if ($request->old_5 && strpos($request->old_5, $request->tahun)) {
                Storage::delete($request->old_5);
            }
            $ext = $request->foto_100->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file = $request->file('foto_100')->storeAs($folder, "foto_100_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);
            $data['file_data'] = $file;
            $data['nama_data'] = 'foto_100';
            Pengadaan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'apbdes_kegiatan_id' => $request->apbdes_kegiatan_id,
                'nama_data' => 'foto_100'
            ])->update([
                'file_data' => $file,
                'perbaikan' => true
            ]);
        }
        if ($request->file('prasasti')) {
            if ($request->old_6 && strpos($request->old_6, $request->tahun)) {
                Storage::delete($request->old_6);
            }
            $ext = $request->prasasti->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file = $request->file('prasasti')->storeAs($folder, "prasasti_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);
            $data['file_data'] = $file;
            $data['nama_data'] = 'prasasti';
            Pengadaan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'apbdes_kegiatan_id' => $request->apbdes_kegiatan_id,
                'nama_data' => 'prasasti'
            ])->update([
                'file_data' => $file,
                'perbaikan' => true
            ]);
        }
        if ($request->file('bast')) {
            if ($request->old_7 && strpos($request->old_7, $request->tahun)) {
                Storage::delete($request->old_7);
            }
            $ext = $request->bast->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file = $request->file('bast')->storeAs($folder, "bast_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);
            $data['file_data'] = $file;
            $data['nama_data'] = 'bast';
            Pengadaan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'apbdes_kegiatan_id' => $request->apbdes_kegiatan_id,
                'nama_data' => 'bast'
            ])->update([
                'file_data' => $file,
                'perbaikan' => true
            ]);
        }

        if ($request->file('foto_papan')) {
            if ($request->old_8 && strpos($request->old_8, $request->tahun)) {
                Storage::delete($request->old_8);
            }
            $ext = $request->foto_papan->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file = $request->file('foto_papan')->storeAs($folder, "foto_papan_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);
            $data['file_data'] = $file;
            $data['nama_data'] = 'foto_papan';
            Pengadaan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'apbdes_kegiatan_id' => $request->apbdes_kegiatan_id,
                'nama_data' => 'foto_papan'
            ])->update([
                'file_data' => $file,
                'perbaikan' => true
            ]);
        }

        return $this->inputNilaiFisik($request);
    }

    public function tambahSurveymaterial(Request $request)
    {

        if ($request->file('survey_material')) {

            $ext = $request->survey_material->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file = $request->file('survey_material')->storeAs($folder, "survey_material_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);

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

    public function updateSurveymaterial(Request $request)
    {

        if ($request->file('survey_material')) {
            if ($request->old && strpos($request->old, $request->tahun)) {
                Storage::delete($request->old);
            }
            $ext = $request->survey_material->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_pengadaan";
            $file = $request->file('survey_material')->storeAs($folder, "survey_material_" . $request->apbdes_kegiatan_id . "_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);
            Survey::where('id', $request->id)->update([
                'file_data' => $file,
                'perbaikan' => true
            ]);
        }

        return $this->inputNilaiSurvey($request);
    }

    public function inputNilaiSurvey($request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => 2,
            'indikator_id' => 11,
            'sub_indikator_keuangan_id' => 12
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

    public function cekKegfis(Request $request)
    {
        $apbdes_kegiatan_id = $request->apbdes_kegiatan_id;
        $data = Apbdes_kegiatan::where('id', $apbdes_kegiatan_id)->first();
        $aper = $data->anggaran_perubahan;
        if ($aper == null || $aper == 0) {
            $aper = $data->anggaran_murni;
        }

        return  number_format($aper, 0, ",", ".");
    }

    public function hapusKegfis(Request $request)
    {
        $cek = Kegiatan_fisik::where('id', $request->idhap)->pluck('tgl_cek_fisik')->first();
        if ($cek) {
            return "gagal";
        } else {
            Kegiatan_fisik::destroy($request->idhap);
            return "berhasil";
        }
    }
}
