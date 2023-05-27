<?php

namespace App\Http\Controllers;

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



use Illuminate\Http\Request;

class ApbdesController extends Controller
{
    public function formApbdes(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $tahun = $request->tahun;
        }
        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();

        $data = Apbdes_kegiatan::with('kegiatan')->where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();

        // return $data[174]->kegiatan;

        $dokumen = 0;
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



        $kegiatan = Apbdes_kegiatan::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();

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
            }

            if ($datum == 0) {
                $data = [
                    'infos' => $infos,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'apbdes_pendapatan' => $apbdes_pendapatan,
                    'apbdes_belanja' => $apbdes_belanja,
                    'apbdes_pembiayaan' => $apbdes_pembiayaan
                ];
                if ($request->jenis == 'pendapatan') {
                    $data['pendapatans'] = Pendapatan::all();
                }
                if ($request->jenis == 'anggaran_bidangsub') {
                    $data['bidangs'] = Bidang::with('sub_bidang', 'kegiatan')->get();
                }
                if ($request->jenis == 'anggaran_kegiatan') {
                    $data['bidangs'] = Bidang::with('sub_bidang')->get();
                    $data['daftar_kegiatan'] = Kegiatan::all();
                }
                if ($request->jenis == 'pembiayaan') {
                    $data['pembiayaans'] = Pembiayaan::all();
                }
                return view('adminDesa.formApbdes.apbdes_t', $data);
            } else {
                $data = [
                    'infos' => $infos,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'apbdes_pendapatan' => $apbdes_pendapatan,
                    'apbdes_belanja' => $apbdes_belanja,
                    'apbdes_pembiayaan' => $apbdes_pembiayaan
                ];
                if ($request->jenis == 'pendapatan') {
                    $data['pendapatans'] = Apbdes_pendapatan::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();
                }
                if ($request->jenis == 'anggaran_kegiatan') {
                    $data['apbdes_bidangs'] = Apbdes_bidang::with('apbdes_sub_bidang')->where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();
                    $data['apbdes_kegiatans'] = Apbdes_kegiatan::with('kegiatan')->where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();
                }
                if ($request->jenis == 'pembiayaan') {
                    $data['pembiayaans'] = Apbdes_pembiayaan::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();
                }
                $data['total_p'] = Total_apbd::where([
                    'asal_id' => $infos->asal_id,
                    'tahun' => $tahun
                ])->first();


                return view('adminDesa.formApbdes.apbdes_e', $data);
            }
        } else {
            return view('adminDesa.formApbdes.apbdes', [
                'infos' => $infos,
                'jenis' => $request->jenis,
                'tahun' => $tahun,
                'dokumen' => 0,
                'apbdes_pendapatan' => $apbdes_pendapatan,
                'apbdes_belanja' => $apbdes_belanja,
                'apbdes_pembiayaan' => $apbdes_pembiayaan

            ]);
        }
    }

    function tambahBidangsubA(Request $request)
    {


        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ];
        $i = 0;
        foreach ($request->bidang_id as $abid) {
            $data['bidang'] = $request->bidang[$i];
            $data['bidang_id'] = $abid;
            $data['anggaran_murni'] = $request->anggaran_bidang[$i];

            $inputBidang = Apbdes_bidang::create($data);
            $i++;
        }

        if ($inputBidang) {
            unset($data['bidang']);
            $abidang = Apbdes_bidang::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun
            ])->get();

            $i = 0;
            foreach ($request->sub_bidang_id as $sub) {
                $apbdes_bidang_id = $abidang->where('bidang_id', $request->sub_dari[$i])->pluck('id');

                $data['apbdes_bidang_id'] = $apbdes_bidang_id[0];
                $data['sub_bidang_id'] = $sub;
                $data['kode_sub_bidang'] = $request->kode_sub_bidang[$i];
                $data['bidang_id'] = $request->sub_dari[$i];
                $data['sub_bidang'] = $request->sub_bidang[$i];
                $data['anggaran_murni'] = $request->anggaran_sub_bidang[$i];

                $inputSubbidang = Apbdes_sub_bidang::create($data);
                $i++;
            }
        }

        if ($inputSubbidang) {
            return back()->with('success', 'data berhasil dikirim');
        }
    }

    public function tambahKegiatanA(Request $request)
    {


        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ];
        $bidangAll = Bidang::All();
        $i = 0;
        foreach ($request->anggaran_bidang as $abid) {
            $data['bidang_id'] = $bidangAll[$i]->id;
            $data['bidang'] = $bidangAll[$i]->bidang;
            $data['anggaran_murni'] = $abid;

            Apbdes_bidang::create($data);
            $i++;
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
            $data['sub_bidang'] = $subbidangAll->where('id', $i + 1)->pluck('sub_bidang')->first();
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

        $kegiatan_all = Kegiatan::all();
        $i = 0;
        foreach ($request->kegiatan_id as $kegiatan) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'kode_kegiatan' => $request->kode_kegiatan[$i],
                'kegiatan_id' => $kegiatan,
                'kegiatan' => $kegiatan_all[$i]->kegiatan,
                'apbdes_sub_bidang_id' => $apbdes_sub_bidang->where('sub_bidang_id', $request->keg_sub[$i])->pluck('id')->first(),
                'apbdes_bidang_id' => $apbdes_sub_bidang->where('sub_bidang_id', $request->keg_sub[$i])->pluck('apbdes_bidang_id')->first(),
                'anggaran_murni' => strip_tags($request->anggaran_kegiatan[$i])

            ];

            // $nominal = str_replace(".", "", strip_tags($request->anggaran_kegiatan[$i]));
            // $nominal = intval($nominal);
            // $total += $nominal;

            Apbdes_kegiatan::create($data);

            $i++;
        }

        return back()->with('success', 'berhasil kirim data');


        // $kegiatan = Apbdes_kegiatan::where([
        //     'asal_id' => $request->asal_id,
        //     'tahun' => $request->tahun
        // ])->get();
        // $subbidang = Sub_bidang::all();

        // for ($i = 1; $i <= 27; $i++) {

        //     $jumlah_subbid = $kegiatan->where('sub_bidang_id', $i)->pluck('anggaran_murni');
        //     $jumlah = 0;
        //     foreach ($jumlah_subbid as $jum) {
        //         $jum = str_replace('.', '', $jum);
        //         $jum = intval($jum);
        //         $jumlah += $jum;
        //     }

        //     $data = [
        //         'asal_id' => $request->asal_id,
        //         'tahun' => $request->tahun,
        //         'sub_bidang_id' => $i,
        //         'bidang_id' => $kegiatan->where('sub_bidang_id', $i)->pluck('bidang_id')->first(),
        //         'sub_bidang' => $subbidang->where('id', $i)->pluck('sub_bidang')->first(),
        //         'kode_sub_bidang' =>  $subbidang->where('id', $i)->pluck('kode_sub_bidang')->first(),
        //         'anggaran_murni' => $jumlah
        //     ];

        //     Apbdes_sub_bidang::create($data);
        // }

        // $anggaran_sub = Apbdes_sub_bidang::where([
        //     'asal_id' => $request->asal_id,
        //     'tahun' => $request->tahun
        // ])->get();

        // $bidang = Bidang::all();

        // for ($i = 1; $i <= 5; $i++) {

        //     $jumlah_bidang = $anggaran_sub->where('bidang_id', $i)->pluck('anggaran_murni');
        //     $jumlah = 0;
        //     foreach ($jumlah_bidang as $jum) {
        //         $jum = str_replace('.', '', $jum);
        //         $jum = intval($jum);
        //         $jumlah += $jum;
        //     }
        //     $dabid = $bidang->where('id', $i)->pluck('bidang');

        //     $data = [
        //         'asal_id' => $request->asal_id,
        //         'tahun' => $request->tahun,
        //         'bidang_id' => $i,
        //         'bidang' => $dabid[0],
        //         'anggaran_murni' => $jumlah
        //     ];

        //     Apbdes_bidang::create($data);
        // }

        // $cek = Total_apbd::where([
        //     'asal_id' => $request->asal_id,
        //     'tahun' => $request->tahun
        // ])->get()->count();
        // if ($cek == 0) {
        //     Total_apbd::create([
        //         'asal_id' => $request->asal_id,
        //         'tahun' => $request->tahun,
        //         'belanja_murni' => $total
        //     ]);
        // } else {
        //     Total_apbd::where([
        //         'asal_id' => $request->asal_id,
        //         'tahun' => $request->tahun
        //     ])->update([
        //         'belanja_murni' => $total
        //     ]);
        // }


        // return back()->with('success', 'data berhasil dikirim');
    }

    public function updateKegiatanA(Request $request)
    {

        return $request;
        $kegiatan_all = Kegiatan::all();

        $i = 0;
        $total = 0;

        foreach ($request->kegiatan_id as $kegiatan) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'desa' => $request->desa,
                'kegiatan_id' => $kegiatan,
                'kegiatan' => $kegiatan_all[$i]->kegiatan,
                'bidang_id' => $kegiatan_all[$i]->bidang_id,
                'sub_bidang_id' => $kegiatan_all[$i]->sub_bidang_id,
                'anggaran_murni' => strip_tags($request->jumlah[$i]),

            ];

            $nominal = str_replace(".", "", strip_tags($request->jumlah[$i]));
            $nominal = intval($nominal);
            $total += $nominal;

            Apbdes_kegiatan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'kegiatan_id' => $kegiatan
            ])->update([
                'anggaran_murni' => strip_tags($request->jumlah[$i])
            ]);

            $i++;
        }

        $kegiatan = Apbdes_kegiatan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->get();
        $subbidang = Sub_bidang::all();

        for ($i = 1; $i <= 27; $i++) {

            $jumlah_subbid = $kegiatan->where('sub_bidang_id', $i)->pluck('anggaran_murni');
            $jumlah = 0;
            foreach ($jumlah_subbid as $jum) {
                $jum = str_replace('.', '', $jum);
                $jum = intval($jum);
                $jumlah += $jum;
            }

            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_bidang_id' => $i,
                'bidang_id' => $kegiatan->where('sub_bidang_id', $i)->pluck('bidang_id')->first(),
                'sub_bidang' => $subbidang->where('id', $i)->pluck('sub_bidang')->first(),
                'kode_sub_bidang' =>  $subbidang->where('id', $i)->pluck('kode_sub_bidang')->first(),
                'anggaran_murni' => $jumlah
            ];

            Apbdes_sub_bidang::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_bidang_id' => $i
            ])->update([
                'anggaran_murni' => $jumlah
            ]);
        }

        $anggaran_sub = Apbdes_sub_bidang::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->get();

        $bidang = Bidang::all();

        for ($i = 1; $i <= 5; $i++) {

            $jumlah_bidang = $anggaran_sub->where('bidang_id', $i)->pluck('anggaran_murni');
            $jumlah = 0;
            foreach ($jumlah_bidang as $jum) {
                $jum = str_replace('.', '', $jum);
                $jum = intval($jum);
                $jumlah += $jum;
            }
            $dabid = $bidang->where('id', $i)->pluck('bidang');

            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'bidang_id' => $i,
                'bidang' => $dabid[0],
                'anggaran_murni' => $jumlah
            ];

            Apbdes_bidang::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'bidang_id' => $i
            ])->update([
                'anggaran_murni' => $jumlah
            ]);
        }


        Total_apbd::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->update([
            'belanja_murni' => $total
        ]);


        return back()->with('success', 'data berhasil diupdate');
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

        return back()->with('success', 'data berhasil update');
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

            $nominal1 = str_replace(".", "", strip_tags($request->pembiayaan[0]));
            $nominal1 = intval($nominal1);
            $nominal2 = str_replace(".", "", strip_tags($request->pembiayaan[5]));
            $nominal2 = intval($nominal2);
            $total = $nominal1 - $nominal2;

            Apbdes_pembiayaan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'pembiayaan_id' => $pembiayaan
            ])->update([
                'anggaran_murni' => strip_tags($request->pembiayaan[$i])
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
}
