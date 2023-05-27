<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Admin;

use App\Models\Apbdes_kegiatan;
use App\Models\Apbdes_sub_bidang;
use App\Models\Apbdes_bidang;

use App\Models\Apbdes_pendapatan;
use App\Models\Total_apbd;
use App\Models\Apbdes_pembiayaan;
use App\Models\Pembiayaan;
use App\Models\Apbdes_dokumen;
use App\Models\Apbdes_belanjaakun;
use App\Models\Belanja;



use Illuminate\Http\Request;

class ApbdesPerubahanController extends Controller
{
    public function formApbdesP(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();


        $dokumen = Apbdes_dokumen::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun,
        ])->pluck('dokumen_perubahan')->first();


        $belanjaakun = Apbdes_belanjaakun::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->where('anggaran_perubahan', '!=', NULL)->first();

        $apbdes_pendapatan = Apbdes_pendapatan::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->where('anggaran_perubahan', '!=', NULL)->first();


        $apbdes_belanja = Apbdes_bidang::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->where('anggaran_perubahan', '!=', NULL)->first();

        $apbdes_pembiayaan = Apbdes_pembiayaan::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->where('anggaran_perubahan', '!=', NULL)->first();


        if (isset($request->jenis)) {
            if ($request->jenis == 'anggaran_kegiatan_P') {
                $datum = Apbdes_kegiatan::where([
                    'asal_id' => $infos->asal_id,
                    'tahun' => $tahun
                ])->where('anggaran_perubahan', '!=', NULL)->get()->count();
            } elseif ($request->jenis == 'pendapatan_P') {
                $datum = Apbdes_pendapatan::where([
                    'asal_id' => $infos->asal_id,
                    'tahun' => $tahun
                ])->where('anggaran_perubahan', '!=', NULL)->get()->count();
            } elseif ($request->jenis == 'pembiayaan_P') {
                $datum = Apbdes_pembiayaan::where([
                    'asal_id' => $infos->asal_id,
                    'tahun' => $tahun
                ])->where('anggaran_perubahan', '!=', NULL)->get()->count();
            } elseif ($request->jenis == 'anggaran_bidangsub_P') {
                $datum = Apbdes_bidang::where([
                    'asal_id' => $infos->asal_id,
                    'tahun' => $tahun
                ])->where('anggaran_perubahan', '!=', NULL)->get()->count();
            } elseif ($request->jenis == 'dokumen_P') {
                $datum = Apbdes_dokumen::where([
                    'asal_id' => $infos->asal_id,
                    'tahun' => $tahun
                ])->where('dokumen_perubahan', '!=', NULL)->get()->count();
            } elseif ($request->jenis == 'belanja_P') {
                $datum = Apbdes_belanjaakun::where([
                    'asal_id' => $infos->asal_id,
                    'tahun' => $tahun
                ])->where('anggaran_perubahan', '!=', NULL)->get()->count();
            } elseif ($request->jenis == 'cek_struktur_P') {
                $datum = 1;
            }

            if ($datum == 0) {
                $data = [
                    'infos' => $infos,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'dokumen' => $dokumen,
                    'belanja' => $belanjaakun,
                    'apbdes_pendapatan' => $apbdes_pendapatan,
                    'apbdes_belanja' => $apbdes_belanja,
                    'apbdes_pembiayaan' => $apbdes_pembiayaan
                ];
                if ($request->jenis == 'pendapatan_P') {
                    $data['pendapatans'] = Apbdes_pendapatan::with('pendapatan')->where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();
                    $data['total_p'] = Total_apbd::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->first();
                    if ($data['total_p'] == false) {
                        return redirect("/adminDesa/formApbdesP?tahun=$tahun")->with('error_apbdes', 'Anda belum mengisi data APBDes Murni!');
                    }
                }

                if ($request->jenis == 'anggaran_kegiatan_P') {
                    $data['apbdes_bidangs'] = Apbdes_bidang::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();
                    $data['apbdes_sub_bidangs'] = Apbdes_sub_bidang::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();
                    $data['apbdes_kegiatans'] = Apbdes_kegiatan::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();

                    $data['total_p'] = Total_apbd::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->first();

                    if (!$data['total_p'] || !$data['total_p']->akunbelanja_perubahan) {
                        return redirect("/adminDesa/formApbdesP?tahun=$tahun")->with('error_apbdes', 'Anda belum mengisi data jenis belanja!');
                    }
                }
                if ($request->jenis == 'pembiayaan_P') {
                    $data['pembiayaans'] = Apbdes_pembiayaan::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();
                    $data['total_p'] = Total_apbd::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->first();
                    if ($data['total_p'] == false) {
                        return redirect("/adminDesa/formApbdesP?tahun=$tahun")->with('error_apbdes', 'Anda belum mengisi data APBDes Murni!');
                    }
                }
                if ($request->jenis == 'belanja_P') {
                    $data['apbdes_belanjas'] = Apbdes_belanjaakun::with('belanja')->where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();

                    $data['total'] = Total_apbd::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->first();
                    if ($data['total'] == false) {
                        return redirect("/adminDesa/formApbdesP?tahun=$tahun")->with('error_apbdes', 'Anda belum mengisi data APBDes Murni!');
                    }
                }


                return view('adminDesa.formApbdesPerubahan.apbdes_t_P', $data);
            } else {
                $data = [
                    'infos' => $infos,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'dokumen' => $dokumen,
                    'belanja' => $belanjaakun,
                    'apbdes_pendapatan' => $apbdes_pendapatan,
                    'apbdes_belanja' => $apbdes_belanja,
                    'apbdes_pembiayaan' => $apbdes_pembiayaan
                ];
                if ($request->jenis == 'pendapatan_P') {
                    $data['pendapatans'] = Apbdes_pendapatan::with('pendapatan')->where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();
                    $data['total_p'] = Total_apbd::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->first();
                }
                if ($request->jenis == 'anggaran_kegiatan_P') {
                    $data['apbdes_bidangs'] = Apbdes_bidang::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();
                    $data['apbdes_sub_bidangs'] = Apbdes_sub_bidang::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();
                    $data['apbdes_kegiatans'] = Apbdes_kegiatan::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();

                    $data['total_p'] = Total_apbd::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->first();
                }
                if ($request->jenis == 'pembiayaan_P') {
                    $data['pembiayaans'] = Apbdes_pembiayaan::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();
                    $data['total_p'] = Total_apbd::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->first();
                }
                if ($request->jenis == 'dokumen_P') {
                    $data['apbdes_doks'] = Apbdes_dokumen::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();
                }
                if ($request->jenis == 'belanja_P') {
                    $data['apbdes_belanjas'] = Apbdes_belanjaakun::with('belanja')->where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();

                    $data['total'] = Total_apbd::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->first();
                }
                if ($request->jenis == 'cek_struktur_P') {

                    if (!$apbdes_pendapatan || !$belanjaakun || !$apbdes_pendapatan || !$apbdes_pembiayaan) {
                        return redirect("/adminDesa/formApbdesP?tahun=$tahun")->with('error_apbdes', 'anda belum input data apbdes secara lengkap!');
                    }
                    $data['total'] = Total_apbd::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();


                    $data['belanjas'] = Apbdes_belanjaakun::with('belanja')->where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();


                    $data['pendapatans'] = Apbdes_pendapatan::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();
                    $data['pembiayaans'] = Apbdes_pembiayaan::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();
                }

                return view('adminDesa.formApbdesPerubahan.apbdes_e_P', $data);
            }
        } else {
            return view('adminDesa.formApbdesPerubahan.apbdes_P', [
                'infos' => $infos,
                'jenis' => $request->jenis,
                'tahun' => $tahun,
                'dokumen' => $dokumen,
                'belanja' => $belanjaakun,
                'apbdes_pendapatan' => $apbdes_pendapatan,
                'apbdes_belanja' => $apbdes_belanja,
                'apbdes_pembiayaan' => $apbdes_pembiayaan

            ]);
        }
    }


    public function tambahKegiatanP(Request $request)
    {

        $i = 0;
        foreach ($request->kegiatan_id as $kegiatan) {
            Apbdes_kegiatan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'kegiatan_id' => $kegiatan
            ])->update([
                'anggaran_perubahan' => str_replace(".", "", strip_tags($request->anggaran_kegiatan[$i]))
            ]);

            $i++;
        }

        $i = 1;
        foreach ($request->anggaran_subbidang as $asub) {

            Apbdes_sub_bidang::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_bidang_id' => $i
            ])->update([
                'anggaran_perubahan' => str_replace(".", "", strip_tags($asub))
            ]);
            $i++;
        }


        $i = 1;
        $total = 0;
        foreach ($request->anggaran_bidang as $abid) {

            Apbdes_bidang::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'bidang_id' => $i
            ])->update([
                'anggaran_perubahan' => str_replace(".", "", strip_tags($abid))
            ]);

            $nominal = str_replace(".", "", $abid);
            $nominal = intval($nominal);
            $total += $nominal;

            $i++;
        }



        $cek = Total_apbd::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->get()->count();
        if ($cek == 0) {
            Total_apbd::create([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'belanja_perubahan' => $total
            ]);
        } else {
            Total_apbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun
            ])->update([
                'belanja_perubahan' => $total
            ]);
        }


        return back()->with('success', 'data berhasil dikirim');
    }

    public function cekKegiatanP(Request $request)
    {
        $belanjaAkun = str_replace('.', '', $request->belanjaAkun);
        $totalKegiatan = str_replace('.', '', $request->totalKegiatan);
        if ($belanjaAkun !== $totalKegiatan) {
            return false;
            exit();
            die();
        } else {
            return $this->tambahKegiatanP($request);
        }
    }



    public function tambahPendapatanP(Request $request)
    {

        $i = 0;
        $total = 0;
        foreach ($request->pendapatan_id as $pendapatan) {

            if ($i <= 1 or $i == 7) {
                $nominal = str_replace(".", "", strip_tags($request->pendapatan[$i]));
                $nominal = intval($nominal);
                $total += $nominal;
            }

            Apbdes_pendapatan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'pendapatan_id' => $pendapatan
            ])->update([
                'anggaran_perubahan' => str_replace(".", "", strip_tags($request->pendapatan[$i])),
            ]);
            $i++;
        }

        $cek = Total_apbd::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->get()->count();
        if ($cek == 0) {
            Total_apbd::create([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'pendapatan_perubahan' => $total
            ]);
        } else {
            Total_apbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun
            ])->update([
                'pendapatan_perubahan' => $total
            ]);
        }

        if ($request->update) {
            $pesan = "Data Berhasil diupdate";
        } else {
            $pesan = "Data Berhasil dikirim";
        }

        return back()->with('success', $pesan);
    }


    public function tambahPembiayaanP(Request $request)
    {

        $pembiayaan_all = Pembiayaan::all();

        $i = 0;
        $total = 0;
        foreach ($request->pembiayaan_id as $pembiayaan) {

            Apbdes_pembiayaan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'pembiayaan_id' => $pembiayaan
            ])->update([
                'anggaran_perubahan' => str_replace(".", "", strip_tags($request->pembiayaan[$i]))
            ]);
            $i++;
        }
        $nominal1 = str_replace(".", "", strip_tags($request->pembiayaan[0]));
        $nominal1 = intval($nominal1);
        $nominal2 = str_replace(".", "", strip_tags($request->pembiayaan[5]));
        $nominal2 = intval($nominal2);
        $total = $nominal1 - $nominal2;


        $cek = Total_apbd::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->get()->count();
        if ($cek == 0) {
            Total_apbd::create([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'pembiayaan_perubahan' => $total
            ]);
        } else {
            Total_apbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun
            ])->update([
                'pembiayaan_perubahan' => $total
            ]);
        }

        return back()->with('success', 'data berhasil dikirim');
    }

    public function tambahDokumenP(Request $request)
    {
        $valid = $request->validate([
            'dokumen_perubahan' => 'mimes:pdf|file|max:20480',
            'dokumen_penjabaran_perubahan' => 'mimes:pdf|file|max:20480',
            'desain_perubahan' => 'mimes:pdf|file|max:20480',
        ]);
        $valid = [
            'nomor_perdes_perubahan' => strip_tags($request->nomor_perdes_perubahan),
            'tanggal_perubahan' => strip_tags($request->tanggal_perubahan)
        ];

        if ($request->file('dokumen_perubahan')) {
            if ($request->old_1 && strpos($request->old_1, $request->tahun)) {
                Storage::delete($request->old_1);
            }
            $ext = $request->dokumen_perubahan->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_apbdes";
            $file_dokumen = $request->file('dokumen_perubahan')->storeAs($folder, "dokumen_perubahan_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);
            $valid['dokumen_perubahan'] = $file_dokumen;
        }
        if ($request->file('dokumen_penjabaran_perubahan')) {
            if ($request->old_2 && strpos($request->old_2, $request->tahun)) {
                Storage::delete($request->old_2);
            }
            $ext = $request->dokumen_penjabaran_perubahan->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_apbdes";
            $file_penjabaran = $request->file('dokumen_penjabaran_perubahan')->storeAs($folder, "dokumen_penjabaran_perubahan_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);
            $valid['dokumen_penjabaran_perubahan'] = $file_penjabaran;
        }
        if ($request->file('desain_perubahan')) {
            if ($request->old_3 && strpos($request->old_3, $request->tahun)) {
                Storage::delete($request->old_3);
            }
            $ext = $request->desain_perubahan->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_apbdes";
            $file_desain = $request->file('desain_perubahan')->storeAs($folder, "desain_perubahan_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);
            $valid['desain_gambar_perubahan'] = $file_desain;
        }

        Apbdes_dokumen::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->update($valid);

        return back()->with('success', 'berhasil kirim data');
    }

    public function tambahbelanjaP(Request $request)
    {

        $i = 0;
        $total = 0;
        foreach ($request->belanja_id as $belanja) {

            $nominal = str_replace(".", "", strip_tags($request->anggaran_perubahan[$i]));
            $nominal = intval($nominal);
            $total += $nominal;
            Apbdes_belanjaakun::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'belanja_id' => $belanja
            ])->update([
                'anggaran_perubahan' => str_replace(".", "", strip_tags($request->anggaran_perubahan[$i]))

            ]);
            $i++;
        }

        $cek = Total_apbd::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->get()->count();
        if ($cek == 0) {
            Total_apbd::create([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'akunbelanja_perubahan' => $total
            ]);
        } else {
            Total_apbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun
            ])->update([
                'akunbelanja_perubahan' => $total
            ]);
        }

        if ($request->update) {
            $pesan = "Data Berhasil diupdate";
        } else {
            $pesan = "Data Berhasil dikirim";
        }

        return back()->with('success', $pesan);
    }



    public function updateBelanjaP(Request $request)
    {

        $belanja_all = belanja::all();

        $i = 0;
        $total = 0;
        foreach ($request->belanja_id as $belanja) {
            $data = [
                'anggaran_murni' => str_replace(".", "", strip_tags($request->anggaran_murni[$i]))
            ];
            $nominal = str_replace(".", "", strip_tags($request->anggaran_murni[$i]));
            $nominal = intval($nominal);
            $total += $nominal;
            Apbdes_belanjaakun::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'belanja_id' => $belanja
            ])->update($data);
            $i++;
        }


        $cek = Total_apbd::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->get()->count();
        if ($cek == 0) {
            Total_apbd::create([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'akunbelanja_murni' => $total
            ]);
        } else {
            Total_apbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun
            ])->update([
                'akunbelanja_murni' => $total
            ]);
        }

        return "Berhasil Update Data";
    }
}
