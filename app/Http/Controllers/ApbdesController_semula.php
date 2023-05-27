<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use App\Models\Bidang;
use App\Models\Sub_bidang;
use App\Models\Kegiatan;
use App\Models\Apbdes_kegiatan;
use App\Models\Apbdes_sub_bidang;
use App\Models\Apbdes_bidang;
use App\Models\Pendapatan;
use App\Models\Apbdes_pendapatan;
use App\Models\Total_apbd;
use App\Models\Apbdes_pembiayaan;
use App\Models\Pembiayaan;
use App\Models\Apbdes_dokumen;
use App\Models\Apbdes_belanjaakun;
use App\Models\Belanja;
use App\Models\Nilai_pemerintahan;



use Illuminate\Http\Request;

class ApbdesController extends Controller
{
    public function formApbdes(Request $request)
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
            'tahun' => $tahun
        ])->first();



        $belanjaakun = Apbdes_belanjaakun::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->first();



        $apbdes_pendapatan = Apbdes_pendapatan::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->first();

        $apbdes_belanja = Apbdes_bidang::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->first();

        $apbdes_pembiayaan = Apbdes_pembiayaan::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->first();


        if (isset($request->jenis)) {
            if ($request->jenis == 'anggaran_kegiatan') {
                $datum = Apbdes_kegiatan::where([
                    'asal_id' => $infos->asal_id,
                    'tahun' => $tahun
                ])->get()->count();
            } elseif ($request->jenis == 'pendapatan') {
                $datum = Apbdes_pendapatan::where([
                    'asal_id' => $infos->asal_id,
                    'tahun' => $tahun
                ])->get()->count();
            } elseif ($request->jenis == 'pembiayaan') {
                $datum = Apbdes_pembiayaan::where([
                    'asal_id' => $infos->asal_id,
                    'tahun' => $tahun
                ])->get()->count();
            } elseif ($request->jenis == 'anggaran_bidangsub') {
                $datum = Apbdes_bidang::where([
                    'asal_id' => $infos->asal_id,
                    'tahun' => $tahun
                ])->get()->count();
            } elseif ($request->jenis == 'dokumen') {
                $datum = Apbdes_dokumen::where([
                    'asal_id' => $infos->asal_id,
                    'tahun' => $tahun
                ])->get()->count();
            } elseif ($request->jenis == 'belanja') {
                $datum = Apbdes_belanjaakun::where([
                    'asal_id' => $infos->asal_id,
                    'tahun' => $tahun
                ])->get()->count();
            } elseif ($request->jenis == 'cek_struktur') {
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
                if ($request->jenis == 'pendapatan') {
                    $data['pendapatans'] = Pendapatan::all();
                }

                if ($request->jenis == 'anggaran_kegiatan') {
                    $data['bidangs'] = Bidang::with('sub_bidang')->get();
                    $data['daftar_kegiatan'] = Kegiatan::all();
                    $data['total'] = Total_apbd::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->first();
                    if ($data['total'] == false) {
                        return redirect("/adminDesa/formApbdes?tahun=$tahun")->with('error_apbdes', 'Silahkan Input Data Belanja Terlebih Dahulu!');
                    }
                }
                if ($request->jenis == 'pembiayaan') {
                    $data['pembiayaans'] = Pembiayaan::all();
                }
                if ($request->jenis == 'belanja') {
                    $data['belanjas'] = Belanja::all();
                }

                return view('adminDesa.formApbdes.apbdes_t', $data);
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
                if ($request->jenis == 'pendapatan') {
                    $data['pendapatans'] = Apbdes_pendapatan::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();
                    $data['total_p'] = Total_apbd::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->first();
                }
                if ($request->jenis == 'anggaran_kegiatan') {
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
                    $data['total'] = Total_apbd::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->first();
                }
                if ($request->jenis == 'pembiayaan') {
                    $data['pembiayaans'] = Apbdes_pembiayaan::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();
                    $data['total_p'] = Total_apbd::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->first();
                }
                if ($request->jenis == 'dokumen') {
                    $data['apbdes_doks'] = Apbdes_dokumen::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();
                }
                if ($request->jenis == 'belanja') {
                    $data['apbdes_belanjas'] = Apbdes_belanjaakun::with('belanja')->where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();

                    $data['total'] = Total_apbd::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->first();
                }
                if ($request->jenis == 'cek_struktur') {

                    if (!$apbdes_pendapatan || !$belanjaakun || !$apbdes_belanja || !$apbdes_pendapatan || !$apbdes_pembiayaan) {
                        return redirect("/adminDesa/formApbdes?tahun=$tahun")->with('error_apbdes', 'anda belum input data apbdes secara lengkap!');
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

                return view('adminDesa.formApbdes.apbdes_e', $data);
            }
        } else {
            return view('adminDesa.formApbdes.apbdes', [
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


    public function tambahKegiatanA(Request $request)
    {

        // if (str_replace('.', '', $request->totalKegiatan) !== str_replace('.', '', $request->belanjaAkun)) {
        //     return back()->with('selisih', 'jumlah anggaran kegiatan tidak sama dengan jumlah belanja!');
        // };

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ];
        $bidangAll = Bidang::All();
        $i = 0;
        $total = 0;
        foreach ($request->anggaran_bidang as $abid) {
            $data['bidang_id'] = $bidangAll[$i]->id;

            $data['anggaran_murni'] = $abid;
            $nominal = intval($abid);
            $total += $nominal;

            Apbdes_bidang::create($data);
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
                'belanja_murni' => $total
            ]);
        } else {
            Total_apbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun
            ])->update([
                'belanja_murni' => $total
            ]);
        }


        $apbdes_bidang = Apbdes_bidang::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->get();
        $subbidangAll = Sub_bidang::all();
        unset($data['bidang']);
        $i = 0;
        foreach ($request->anggaran_subbidang as $asub) {
            $data['bidang_id'] = $request->bidang_id[$i];
            $data['apbdes_bidang_id'] = $apbdes_bidang->where('bidang_id', $request->bidang_id[$i])->pluck('id')->first();
            $data['sub_bidang_id'] = $request->sub_bidang_id[$i];
            $data['kode_sub_bidang'] = $subbidangAll->where('id', $i + 1)->pluck('kode_sub_bidang')->first();

            $data['anggaran_murni'] = $asub;

            Apbdes_sub_bidang::create($data);
            $i++;
        }

        unset($data['bidang_id']);
        unset($data['sub_bidang_id']);
        unset($data['kode_sub_bidang']);
        unset($data['sub_bidang']);


        $apbdes_sub_bidang = Apbdes_sub_bidang::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->get();

        $i = 0;
        foreach ($request->kegiatan_id as $kegiatan) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'kode_kegiatan' => $request->kode_kegiatan[$i],
                'kegiatan_id' => $kegiatan,

                'apbdes_sub_bidang_id' => $apbdes_sub_bidang->where('sub_bidang_id', $request->keg_sub[$i])->pluck('id')->first(),
                'apbdes_bidang_id' => $apbdes_sub_bidang->where('sub_bidang_id', $request->keg_sub[$i])->pluck('apbdes_bidang_id')->first(),
                'anggaran_murni' => strip_tags($request->anggaran_kegiatan[$i])

            ];


            Apbdes_kegiatan::create($data);

            $i++;
        }

        return "Berhasil Kirim Data";
    }

    public function cekKegiatanA(Request $request)
    {
        $belanjaAkun = str_replace('.', '', $request->belanjaAkun);
        $totalKegiatan = str_replace('.', '', $request->totalKegiatan);
        if ($belanjaAkun !== $totalKegiatan) {
            return false;
            exit();
            die();
        } else {
            return $this->tambahKegiatanA($request);
        };
    }

    public function cekUpdateKegiatanA(Request $request)
    {
        $belanjaAkun = str_replace('.', '', $request->belanjaAkun);
        $totalKegiatan = str_replace('.', '', $request->totalKegiatan);
        if ($belanjaAkun !== $totalKegiatan) {
            return false;
            exit();
            die();
        } else {
            return $this->updateKegiatanA($request);
        };
    }


    public function updateKegiatanA(Request $request)
    {
        if (str_replace('.', '', $request->totalKegiatan) !== str_replace('.', '', $request->belanjaAkun)) {
            return back()->with('selisih', 'jumlah anggaran kegiatan tidak sama dengan jumlah belanja!');
        };

        $i = 0;
        foreach ($request->kegiatan_id as $kegiatan) {
            Apbdes_kegiatan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'kegiatan_id' => $kegiatan
            ])->update([
                'anggaran_murni' => strip_tags($request->anggaran_kegiatan[$i])
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
                'anggaran_murni' => strip_tags($asub)
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
                'anggaran_murni' => strip_tags($abid)
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
                'belanja_murni' => $total
            ]);
        } else {
            Total_apbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun
            ])->update([
                'belanja_murni' => $total
            ]);
        }


        return "Berhasil Update";
    }

    public function tambahPendapatanA(Request $request)
    {

        $pendapatan_all = Pendapatan::all();

        $i = 0;
        $total = 0;
        foreach ($request->pendapatan_id as $pendapatan) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'pendapatan_id' => $pendapatan,
                'jenis_pendapatan' => $pendapatan_all[$i]->jenis_pendapatan,
                'kode_pendapatan' =>  $pendapatan_all[$i]->kode_pendapatan,
                'anggaran_murni' => strip_tags($request->pendapatan[$i]),

            ];
            if ($i <= 1 or $i == 7) {
                $nominal = str_replace(".", "", strip_tags($request->pendapatan[$i]));
                $nominal = intval($nominal);
                $total += $nominal;
            }

            Apbdes_pendapatan::create($data);
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
                'pendapatan_murni' => $total
            ]);
        } else {
            Total_apbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun
            ])->update([
                'pendapatan_murni' => $total
            ]);
        }


        return back()->with('success', 'data berhasil dikirim');
    }

    public function updatePendapatanA(Request $request)
    {

        $pendapatan_all = Pendapatan::all();

        $i = 0;
        $total = 0;
        foreach ($request->pendapatan_id as $pendapatan) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'pendapatan_id' => $pendapatan,
                'jenis_pendapatan' => $pendapatan_all[$i]->jenis_pendapatan,
                'kode_pendapatan' =>  $pendapatan_all[$i]->kode_pendapatan,
                'anggaran_murni' => strip_tags($request->pendapatan[$i]),

            ];
            if ($i <= 1 or $i == 7) {
                $nominal = str_replace(".", "", strip_tags($request->pendapatan[$i]));
                $nominal = intval($nominal);
                $total += $nominal;
            }

            Apbdes_pendapatan::Where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'pendapatan_id' => $pendapatan,
                'kode_pendapatan' =>  $pendapatan_all[$i]->kode_pendapatan
            ])->update([
                'anggaran_murni' => strip_tags($request->pendapatan[$i])
            ]);

            $i++;
        }
        Total_apbd::Where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->update([
            'pendapatan_murni' => $total
        ]);

        return back()->with('success', 'data berhasil diupdate');
    }

    public function tambahPembiayaanA(Request $request)
    {

        $pembiayaan_all = Pembiayaan::all();

        $i = 0;
        $total = 0;
        foreach ($request->pembiayaan_id as $pembiayaan) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'pembiayaan_id' => $pembiayaan,
                'jenis_pembiayaan' => $pembiayaan_all[$i]->jenis_pembiayaan,
                'kode_pembiayaan' =>  $pembiayaan_all[$i]->kode_pembiayaan,
                'anggaran_murni' => strip_tags($request->pembiayaan[$i]),

            ];

            $nominal1 = str_replace(".", "", strip_tags($request->pembiayaan[0]));
            $nominal1 = intval($nominal1);
            $nominal2 = str_replace(".", "", strip_tags($request->pembiayaan[5]));
            $nominal2 = intval($nominal2);
            $total = $nominal1 - $nominal2;

            Apbdes_pembiayaan::create($data);
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
                'pembiayaan_murni' => $total
            ]);
        } else {
            Total_apbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun
            ])->update([
                'pembiayaan_murni' => $total
            ]);
        }

        return back()->with('success', 'data berhasil dikirim');
    }

    public function updatePembiayaanA(Request $request)
    {

        $pembiayaan_all = Pembiayaan::all();

        $i = 0;
        $total = 0;
        foreach ($request->pembiayaan_id as $pembiayaan) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'pembiayaan_id' => $pembiayaan,
                'jenis_pembiayaan' => $pembiayaan_all[$i]->jenis_pembiayaan,
                'kode_pembiayaan' =>  $pembiayaan_all[$i]->kode_pembiayaan,
                'anggaran_murni' => strip_tags($request->pembiayaan[$i]),

            ];


            Apbdes_pembiayaan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'pembiayaan_id' => $pembiayaan
            ])->update([
                'anggaran_murni' => strip_tags($request->pembiayaan[$i])
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
                'pembiayaan_murni' => $total
            ]);
        } else {
            Total_apbd::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun
            ])->update([
                'pembiayaan_murni' => $total
            ]);
        }

        return back()->with('success', 'data berhasil diupdate');
    }

    public function tambahDokumenA(Request $request)
    {
        $valid = $request->validate([
            'asal_id' => 'required',
            'tahun' => 'required',
            'nomor_perdes_murni' => 'required',
            'tanggal_murni' => 'max:25',
            'dokumen_murni' => 'mimes:pdf|file|max:20480',
            'dokumen_penjabaran_murni' => 'mimes:pdf|file|max:20480',
            'desain_gambar' => 'mimes:pdf|file|max:10240'
        ]);

        $valid = [
            'asal_id' => strip_tags($request->asal_id),
            'tahun' => strip_tags($request->tahun),
            'nomor_perdes_murni' => strip_tags($request->nomor_perdes_murni),
            'tanggal_murni' => strip_tags($request->tanggal_murni)

        ];

        if ($request->file('dokumen_murni')) {
            $ext = $request->dokumen_murni->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_apbdes";
            $file_dokumen = $request->file('dokumen_murni')->storeAs($folder, "dokumen_murni_" . $request->tahun . "-"  . mt_rand(1, 100) . "." . $ext);
            $valid['dokumen_murni'] = $file_dokumen;
            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 30
            ])->first();
            if (!$cek) {
                $data_r = [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 30,
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100

                ];
                Nilai_pemerintahan::create($data_r);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 30
                ])->update([
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100
                ]);
            }
        }
        if ($request->file('dokumen_penjabaran_murni')) {
            $ext = $request->dokumen_penjabaran_murni->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_apbdes";
            $file_penjabaran = $request->file('dokumen_penjabaran_murni')->storeAs($folder, "dokumen_penjabaran_murni_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $valid['dokumen_penjabaran_murni'] = $file_penjabaran;

            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 33
            ])->first();
            if (!$cek) {
                $data_r = [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 33,
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100

                ];
                Nilai_pemerintahan::create($data_r);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 33
                ])->update([
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100
                ]);
            }
        }
        if ($request->file('desain_gambar')) {
            $ext = $request->desain_gambar->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_apbdes";
            $file_desain = $request->file('desain_gambar')->storeAs($folder, "desain_gambar_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $valid['desain_gambar_murni'] = $file_desain;

            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 31
            ])->first();
            if (!$cek) {
                $data_r = [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 31,
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100

                ];
                Nilai_pemerintahan::create($data_r);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 31
                ])->update([
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100
                ]);
            }
        }


        Apbdes_dokumen::create($valid);
        $cek = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_pemerintahan_id' => 32
        ])->first();
        if (!$cek) {
            $data_r = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 1,
                'indikator_id' => 4,
                'sub_indikator_pemerintahan_id' => 32,
                'perbaikan' => true,
                'jumlah_data' => 1,
                'persen_data' => 100

            ];
            Nilai_pemerintahan::create($data_r);
        } else {
            Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 32
            ])->update([
                'perbaikan' => true,
                'jumlah_data' => 1,
                'persen_data' => 100
            ]);
        }

        return back()->with('success', 'berhasil kirim data');
    }

    public function updateDokumenA(Request $request)
    {
        $valid = $request->validate([
            'dokumen_murni' => 'mimes:pdf|file|max:20480',
            'dokumen_penjabaran_murni' => 'mimes:pdf|file|max:20480',
            'desain_gambar' => 'mimes:pdf|file|max:10240'
        ]);
        $valid = [
            'nomor_perdes_murni' => strip_tags($request->nomor_perdes_murni),
            'tanggal_murni' => strip_tags($request->tanggal_murni)
        ];

        if ($request->file('dokumen_murni')) {
            if ($request->old_1 && strpos($request->old_1, $request->tahun)) {
                Storage::delete($request->old_1);
            }
            $ext = $request->dokumen_murni->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_apbdes";
            $file_dokumen = $request->file('dokumen_murni')->storeAs($folder, "dokumen_murni_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $valid['dokumen_murni'] = $file_dokumen;
            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 30
            ])->first();
            if (!$cek) {
                $data_r = [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 30,
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100

                ];
                Nilai_pemerintahan::create($data_r);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 30
                ])->update([
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100
                ]);
            }
        }
        if ($request->file('dokumen_penjabaran_murni')) {
            if ($request->old_2 && strpos($request->old_2, $request->tahun)) {
                Storage::delete($request->old_2);
            }
            $ext = $request->dokumen_penjabaran_murni->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_apbdes";
            $file_penjabaran = $request->file('dokumen_penjabaran_murni')->storeAs($folder, "dokumen_penjabaran_murni_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $valid['dokumen_penjabaran_murni'] = $file_penjabaran;
            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 33
            ])->first();
            if (!$cek) {
                $data_r = [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 33,
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100

                ];
                Nilai_pemerintahan::create($data_r);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 33
                ])->update([
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100
                ]);
            }
        }
        if ($request->file('desain_gambar')) {
            if ($request->old_3 && strpos($request->old_3, $request->tahun)) {
                Storage::delete($request->old_3);
            }
            $ext = $request->desain_gambar->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_apbdes";
            $file_desain = $request->file('desain_gambar')->storeAs($folder, "desain_gambar_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $valid['desain_gambar_murni'] = $file_desain;

            $cek = Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 31
            ])->first();
            if (!$cek) {
                $data_r = [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 4,
                    'sub_indikator_pemerintahan_id' => 31,
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100

                ];
                Nilai_pemerintahan::create($data_r);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 31
                ])->update([
                    'perbaikan' => true,
                    'jumlah_data' => 1,
                    'persen_data' => 100
                ]);
            }
        }

        Apbdes_dokumen::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->update($valid);

        $cek = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_pemerintahan_id' => 32
        ])->first();
        if (!$cek) {
            $data_r = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 1,
                'indikator_id' => 4,
                'sub_indikator_pemerintahan_id' => 32,
                'perbaikan' => true,
                'jumlah_data' => 1,
                'persen_data' => 100

            ];
            Nilai_pemerintahan::create($data_r);
        } else {
            Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 32
            ])->update([
                'perbaikan' => true,
                'jumlah_data' => 1,
                'persen_data' => 100
            ]);
        }

        return back()->with('success', 'berhasil Update data');
    }

    public function tambahbelanjaA(Request $request)
    {

        $i = 0;
        $total = 0;
        foreach ($request->belanja_id as $belanja) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'belanja_id' => $belanja,
                'anggaran_murni' => strip_tags($request->anggaran_murni[$i])

            ];
            $nominal = str_replace(".", "", strip_tags($request->anggaran_murni[$i]));
            $nominal = intval($nominal);
            $total += $nominal;
            Apbdes_belanjaakun::create($data);
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

        return back()->with('success', 'data berhasil dikirim');
    }

    public function cekBelanjaA(Request $request)
    {
        $totalAkun = $request->totalBelanja;
        $totalKeg = str_replace(".", "", $request->totalKeg);
        if ($totalAkun != $totalKeg) {
            return false;
            exit();
            die();
        }
        return $this->tambahBelanjaA($request);
    }
    public function cekupdateBelanjaA(Request $request)
    {

        $totalAkun = str_replace(".", "", $request->totalBelanja);
        $totalKeg = str_replace(".", "", $request->totalKeg);

        if ($totalAkun != $totalKeg) {
            return false;
            exit();
            die();
        } else {
            return $this->updateBelanjaA($request);
        }
    }

    public function updateBelanjaA(Request $request)
    {

        $i = 0;
        $total = 0;
        foreach ($request->belanja_id as $belanja) {
            $data = [
                'anggaran_murni' => strip_tags($request->anggaran_murni[$i])
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

        return back()->with('success', 'Berhasil Update Data');
    }
}
