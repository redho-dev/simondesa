<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Penataanbelanja_spp;
use App\Models\Apbdes_kegiatan;
use App\Models\Bku_panjar;
use App\Models\Nilai_keuangan;
use App\Models\Total_apbd;
use App\Models\Penataanbelanja_bkp;
use App\Models\Penataan_pendapatan;
use App\Models\Uji_petik;
use Illuminate\Support\Facades\Storage;

class PenataanBelanjaController extends Controller
{
    public function formPenataanBelanja(Request $request)
    {

        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();

        $spp = Penataanbelanja_spp::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun,
        ])->get();

        $bkp = Penataanbelanja_bkp::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun,
        ])->get();

        $bku = Bku_panjar::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun,
        ])->get();

        if (isset($request->jenis)) {

            if ($request->jenis == 'spp' || $request->jenis == 'spp_kegiatan') {
                $datum = $spp;
            } elseif ($request->jenis == 'tbpu' || $request->jenis == 'cek_tbpu' || $request->jenis == 'bukti_belanja') {
                $datum = $bkp;
            } elseif ($request->jenis == 'bku') {
                $datum = $bku;
            }

            $jumbkp = $bkp->pluck('jumlah')->sum();

            $data = [
                'infos' => $infos,
                'jenis' => $request->jenis,
                'tahun' => $tahun,
                'spp' => $spp->count(),
                'bkp' => $bkp->count(),
                'bku' => $bku->count()
            ];

            //cek status anggaran
            $data['total_p'] = Total_apbd::where([
                'asal_id' => $infos->asal_id,
                'tahun' => $tahun
            ])->first();
            if (!$data['total_p']) {
                return back()->with('dok', 'Silahkan Isi Data APBDes Terlebih Dahulu!');
            }
            if ($data['total_p']->belanja_perubahan != NULL) {
                $data['anggaran'] = 'perubahan';
            } else {
                $data['anggaran'] = 'murni';
            }
            //end cek status anggaran

            $penerimaans = Penataan_pendapatan::where([
                'asal_id' => $infos->asal_id,
                'tahun' => $tahun
            ])->pluck('jumlah');
            if (!count($penerimaans)) {
                return back()->with('fail', 'belum ada input realisasi pendapatan!');
            }
            $topen = 0;
            foreach ($penerimaans as $penerimaan) {
                $jump = intval(str_replace('.', '', $penerimaan));
                $topen += $jump;
            }
            $data['penerimaan'] = $topen;
            $data['jumdok'] = $datum->count();
            $data['jumlah_spp'] = Penataanbelanja_spp::where([
                'asal_id' => $infos->asal_id,
                'tahun' => $tahun
            ])->pluck('jumlah')->sum();
            $data['jumlah_tbpu'] = $jumbkp;
            $data['sisa_spp'] = $data['jumlah_spp'] - $jumbkp;
            $data['sisa_penerimaan'] = $topen - $jumbkp;


            if (count($datum) == 0) {

                $data['apbdes_kegiatans'] = Apbdes_kegiatan::where([
                    'asal_id' => $infos->asal_id,
                    'tahun' => $tahun
                ])->get();


                if ($request->jenis == 'spp_kegiatan' && $request->kegiatan) {
                    $data['kegiatan_spp'] = Apbdes_kegiatan::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun,
                        'id' => $request->kegiatan
                    ])->first();
                }
                if ($request->jenis == 'cek_tbpu' && $request->kegiatan) {
                    $data['kegiatan_tbpu'] = Apbdes_kegiatan::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun,
                        'id' => $request->kegiatan
                    ])->first();
                }
                if ($request->jenis == 'bku') {
                    $data_bku = Bku_panjar::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();
                    $bku_semester1 = $data_bku->where('nama_data', 'bku_semester1')->first();
                    $data['data_bku'] = $data_bku;
                    $data['bku_semester1'] = $bku_semester1;
                    $data['bku_semester2'] = $data_bku->where('nama_data', 'bku_semester2')->first();
                    $data['bp_semester1'] = $data_bku->where('nama_data', 'buku_pembantu_panjar_semester1')->first();
                    $data['bp_semester2'] = $data_bku->where('nama_data', 'buku_pembantu_panjar_semester2')->first();
                }
                if ($request->jenis == 'tbpu') {
                    $data['spps'] = Penataanbelanja_spp::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();
                }

                return view('adminDesa.akunBelanja.formPenataanBelanja_t', $data);
            } else {

                if ($request->jenis == 'spp' || $request->jenis == 'spp_kegiatan') {

                    $data['apbdes_kegiatans'] = Apbdes_kegiatan::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();
                }

                if ($request->jenis == 'spp_kegiatan' && $request->kegiatan) {
                    $data['kegiatan_spp'] = Apbdes_kegiatan::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun,
                        'id' => $request->kegiatan
                    ])->first();
                }

                if ($request->jenis == 'tbpu' || $request->jenis == 'cek_tbpu') {
                    $data['apbdes_kegiatans'] = Apbdes_kegiatan::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();

                    $data['tbpus'] = Penataanbelanja_bkp::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();
                    $data['spp'] = Penataanbelanja_spp::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();

                    $data['pph'] = $data['tbpus']->pluck('pph')->sum();
                    $data['ppn'] = $data['tbpus']->pluck('ppn')->sum();
                    $data['lainnya'] = $data['tbpus']->pluck('lainnya')->sum();
                    $data['totalPajak'] = $data['pph'] + $data['ppn'] + $data['lainnya'];
                    $data['belanja_pegawai'] = $data['tbpus']->where('belanja_id', 1)->pluck('jumlah')->sum();
                    $data['belanja_barjas'] = $data['tbpus']->where('belanja_id', 2)->pluck('jumlah')->sum();
                    $data['belanja_modal'] = $data['tbpus']->where('belanja_id', 3)->pluck('jumlah')->sum();
                    $data['belanja_tt'] = $data['tbpus']->where('belanja_id', 4)->pluck('jumlah')->sum();
                    $data['total_realisasi'] =  $data['belanja_pegawai'] + $data['belanja_barjas'] + $data['belanja_modal'] + $data['belanja_tt'];
                }

                if ($request->jenis == 'cek_tbpu' && $request->kegiatan) {
                    $data['kegiatan_tbpu'] = Apbdes_kegiatan::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun,
                        'id' => $request->kegiatan
                    ])->first();
                }

                if ($request->jenis == 'bukti_belanja') {

                    $data['tbpus'] = Penataanbelanja_bkp::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun,
                        'file_lampiran' => NULL
                    ])->get();
                }


                if ($request->jenis == 'bku') {
                    $data_bku = Bku_panjar::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->get();
                    $bku_semester1 = $data_bku->where('nama_data', 'bku_semester1')->first();
                    $data['data_bku'] = $data_bku;
                    $data['bku_semester1'] = $bku_semester1;
                    $data['bku_semester2'] = $data_bku->where('nama_data', 'bku_semester2')->first();
                    $data['bp_semester1'] = $data_bku->where('nama_data', 'buku_pembantu_panjar_semester1')->first();
                    $data['bp_semester2'] = $data_bku->where('nama_data', 'buku_pembantu_panjar_semester2')->first();
                }


                return view('adminDesa.akunBelanja.formPenataanBelanja_e', $data);
            }
        } else {
            $data = [
                'infos' => $infos,
                'jenis' => $request->jenis,
                'tahun' => $tahun,
                'spp' => $spp->count(),
                'bkp' => $bkp->count(),
                'bku' => $bku->count()
            ];
            return view('adminDesa.akunBelanja.formPenataanBelanja', $data);
        }
    }

    public function tambahSPP(Request $request)
    {
        $request->validate([
            'nomor' => 'required|max:50',
            'tanggal' => 'required',
            'jumlah' => 'required',
            'file_spp' => 'required|file|mimes:pdf|max:2048'
        ]);
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'kegiatan_id' => $request->kegiatan_id,
            'apbdes_kegiatan_id' => $request->apbdes_kegiatan_id,
            'nomor' => strip_tags($request->nomor),
            'tanggal' => strip_tags($request->tanggal),
            'jumlah' => strip_tags(str_replace('.', '', $request->jumlah)),
            'perbaikan' => true

        ];
        $ext = $request->file_spp->extension();
        $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_belanja";
        $file1 = $request->file('file_spp')->storeAs($folder, "file_spp_$request->apbdes_kegiatan_id" . "-" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

        $data['file_spp'] = $file1;

        Penataanbelanja_spp::create($data);
        return $this->inputNilaikeu($request);
    }

    public function updateSPP(Request $request)
    {

        $request->validate([
            'nomor' => 'required|max:50',
            'tanggal' => 'required',
            'jumlah' => 'required',
            'file_spp' => 'file|mimes:pdf|max:2048'
        ]);

        $update = Penataanbelanja_spp::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'id' => $request->id
        ])->update([
            'nomor' => strip_tags($request->nomor),
            'tanggal' => strip_tags($request->tanggal),
            'jumlah' => strip_tags(str_replace('.', '', $request->jumlah)),
            'perbaikan' => true

        ]);


        if ($request->file_spp) {
            if ($request->old_1 && strpos($request->old_1, $request->tahun)) {
                Storage::delete($request->old_1);
            }
            $ext = $request->file_spp->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_belanja";
            $file1 = $request->file('file_spp')->storeAs($folder, "file_spp_$request->apbdes_kegiatan_id" . "-" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            Penataanbelanja_spp::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'id' => $request->id
            ])->update([
                'file_spp' => $file1,
                'perbaikan' => true
            ]);
        }



        return $this->updateNilaikeu($request);
    }

    public function hapusSPP($id)
    {
        $spp = Penataanbelanja_spp::where('id', $id)->first();
        if ($spp->nilai) {

            return back()->with('fail', 'anda tidak bisa menghapus SPP yang telah dinilai oleh Inspektorat!');
        }
        $data = [
            'asal_id' => $spp->asal_id,
            'tahun' => $spp->tahun
        ];

        Storage::delete($spp->file_spp);
        Penataanbelanja_spp::destroy($id);
        return $this->hapusNilaikeu($data);
    }

    public function hapusNilaikeu($data)
    {
        $totalApbd = Total_apbd::where([
            'asal_id' => $data['asal_id'],
            'tahun' => $data['tahun']
        ])->first();
        if ($totalApbd->belanja_perubahan != NULL) {
            $totalAK = intval(str_replace('.', '', $totalApbd->belanja_perubahan));
        } else {
            $totalAK = intval(str_replace('.', '', $totalApbd->belanja_murni));
        }

        $jumlahs = Penataanbelanja_spp::where([
            'asal_id' => $data['asal_id'],
            'tahun' => $data['tahun']
        ])->pluck('jumlah');
        $jumdata = $jumlahs->count();
        $tojum = 0;
        foreach ($jumlahs as $jumlah) {
            $tojum += intval(str_replace('.', '', $jumlah));
        }

        $persen_data = round(($tojum / $totalAK) * 100, 2);

        Nilai_keuangan::where([
            'asal_id' => $data['asal_id'],
            'tahun' => $data['tahun'],
            'sub_indikator_keuangan_id' => 3
        ])->update([
            'jumlah_data' => $jumdata,
            'persen_data' => $persen_data,
            'perbaikan' => true
        ]);


        return back()->with('success', 'Berhasil Hapus Data');
    }

    public function hapusNilaibkp($data)
    {
        $totalApbd = Total_apbd::where([
            'asal_id' => $data['asal_id'],
            'tahun' => $data['tahun']
        ])->first();
        if ($totalApbd->belanja_perubahan != NULL) {
            $totalAK = intval(str_replace('.', '', $totalApbd->belanja_perubahan));
        } else {
            $totalAK = intval(str_replace('.', '', $totalApbd->belanja_murni));
        }

        $jumlahs = Penataanbelanja_bkp::where([
            'asal_id' => $data['asal_id'],
            'tahun' => $data['tahun']
        ])->pluck('jumlah');
        $jumdata = $jumlahs->count();
        $tojum = 0;
        foreach ($jumlahs as $jumlah) {
            $tojum += intval(str_replace('.', '', $jumlah));
        }

        $persen_data = round(($tojum / $totalAK) * 100, 2);

        Nilai_keuangan::where([
            'asal_id' => $data['asal_id'],
            'tahun' => $data['tahun'],
            'sub_indikator_keuangan_id' => 4
        ])->update([
            'jumlah_data' => $jumdata,
            'persen_data' => $persen_data,
            'perbaikan' => true
        ]);


        return back()->with('success', 'Berhasil Hapus Data');
    }




    public function inputNilaikeu($request)
    {
        $cek = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_keuangan_id' => 3
        ])->first();
        $totalApbd = Total_apbd::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->first();
        if ($totalApbd->belanja_perubahan != NULL) {
            $totalAK = intval(str_replace('.', '', $totalApbd->belanja_perubahan));
        } else {
            $totalAK = intval(str_replace('.', '', $totalApbd->belanja_murni));
        }
        $jumlahs = Penataanbelanja_spp::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->pluck('jumlah');
        $tojum = 0;
        foreach ($jumlahs as $jumlah) {
            $tojum += intval(str_replace('.', '', $jumlah));
        }

        $persen_data = round(($tojum / $totalAK) * 100, 2);
        if (!$cek) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 2,
                'indikator_id' => 8,
                'sub_indikator_keuangan_id' => 3,
                'jumlah_data' => count($jumlahs),
                'persen_data' => $persen_data,
                'perbaikan' => true
            ];
            Nilai_keuangan::create($data);
        } else {
            $jumdawal = $cek->jumlah_data;
            Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_keuangan_id' => 3
            ])->update([
                'jumlah_data' => $jumdawal + 1,
                'persen_data' => $persen_data,
                'perbaikan' => true
            ]);
        }

        return back()->with('success', 'Berhasil Kirim Data');
    }

    public function inputNilaibkp($request)
    {
        $cek = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_keuangan_id' => 4
        ])->first();
        $totalApbd = Total_apbd::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->first();
        if ($totalApbd->belanja_perubahan != NULL) {
            $totalAK = intval(str_replace('.', '', $totalApbd->belanja_perubahan));
        } else {
            $totalAK = intval(str_replace('.', '', $totalApbd->belanja_murni));
        }
        $jumlahs = Penataanbelanja_bkp::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->pluck('jumlah');
        $tojum = 0;
        foreach ($jumlahs as $jumlah) {
            $tojum += intval(str_replace('.', '', $jumlah));
        }

        $persen_data = round(($tojum / $totalAK) * 100, 2);
        if (!$cek) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 2,
                'indikator_id' => 8,
                'sub_indikator_keuangan_id' => 4,
                'jumlah_data' => count($jumlahs),
                'persen_data' => $persen_data,
                'perbaikan' => true
            ];
            Nilai_keuangan::create($data);
        } else {
            $jumdawal = $cek->jumlah_data;
            Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_keuangan_id' => 4
            ])->update([
                'jumlah_data' => $jumdawal + 1,
                'persen_data' => $persen_data,
                'perbaikan' => true
            ]);
        }

        return redirect(url()->previous() . '#tb_data')->with('success', 'berhasil tambah TBPU');
    }

    public function updateNilaikeu($request)
    {
        $cek = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_keuangan_id' => 3
        ])->first();
        $totalApbd = Total_apbd::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->first();
        if ($totalApbd->belanja_perubahan != NULL) {
            $totalAK = intval(str_replace('.', '', $totalApbd->belanja_perubahan));
        } else {
            $totalAK = intval(str_replace('.', '', $totalApbd->belanja_murni));
        }
        $jumlahs = Penataanbelanja_spp::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->pluck('jumlah');
        $jumdata = $jumlahs->count();
        $tojum = 0;
        foreach ($jumlahs as $jumlah) {
            $tojum += intval(str_replace('.', '', $jumlah));
        }

        $persen_data = round(($tojum / $totalAK) * 100, 2);
        if (!$cek) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 2,
                'indikator_id' => 8,
                'sub_indikator_keuangan_id' => 3,
                'jumlah_data' => count($jumlahs),
                'persen_data' => $persen_data,
                'perbaikan' => true
            ];
            Nilai_keuangan::create($data);
        } else {
            Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_keuangan_id' => 3
            ])->update([
                'jumlah_data' => $jumdata,
                'persen_data' => $persen_data,
                'perbaikan' => true
            ]);
        }

        return redirect(url()->previous() . '#tb_data')->with('success', 'berhasil update data');
    }

    public function updateNilaibkp($request)
    {
        $cek = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_keuangan_id' => 4
        ])->first();
        $totalApbd = Total_apbd::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->first();
        if ($totalApbd->belanja_perubahan != NULL) {
            $totalAK = intval(str_replace('.', '', $totalApbd->belanja_perubahan));
        } else {
            $totalAK = intval(str_replace('.', '', $totalApbd->belanja_murni));
        }
        $jumlahs = Penataanbelanja_bkp::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->pluck('jumlah');
        $jumdata = $jumlahs->count();
        $tojum = 0;
        foreach ($jumlahs as $jumlah) {
            $tojum += intval(str_replace('.', '', $jumlah));
        }

        $persen_data = round(($tojum / $totalAK) * 100, 2);
        if (!$cek) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 2,
                'indikator_id' => 8,
                'sub_indikator_keuangan_id' => 4,
                'jumlah_data' => count($jumlahs),
                'persen_data' => $persen_data,
                'perbaikan' => true
            ];
            Nilai_keuangan::create($data);
        } else {
            Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_keuangan_id' => 4
            ])->update([
                'jumlah_data' => $jumdata,
                'persen_data' => $persen_data,
                'perbaikan' => true
            ]);
        }

        return back()->with('success', 'Berhasil Update Data');
    }

    public function tambahTBPU(Request $request)
    {

        $request->validate([
            'nomor' => 'required|max:50',
            'tanggal' => 'required',
            'jumlah' => 'required',
            'sebagai' => 'required',
            'file_bkp' => 'required|file|mimes:pdf|max:2048',
            'file_lampiran' => 'file|mimes:pdf|max:2048'
        ]);
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'apbdes_kegiatan_id' => $request->apbdes_kegiatan_id,
            'belanja_id' => $request->belanja_id,
            'nomor' => strip_tags($request->nomor),
            'tanggal' => strip_tags($request->tanggal),
            'jumlah' => strip_tags(str_replace('.', '', $request->jumlah)),
            'sebagai' => strip_tags($request->sebagai),
            'pph' =>  intval(strip_tags(str_replace('.', '', $request->pph))),
            'ppn' =>  intval(strip_tags(str_replace('.', '', $request->ppn))),
            'lainnya' =>  intval(strip_tags(str_replace('.', '', $request->lainnya))),
            'perbaikan_bkp' => true

        ];
        $ext = $request->file_bkp->extension();
        $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_belanja";
        $file1 = $request->file('file_bkp')->storeAs($folder, "file_bkp_$request->apbdes_kegiatan_id" . "-" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

        $data['file_bkp'] = $file1;



        if ($request->file_lampiran) {
            $ext = $request->file_lampiran->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_belanja";
            $file2 = $request->file('file_lampiran')->storeAs($folder, "file_lampiran_$request->apbdes_kegiatan_id" . "-" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            $data['file_lampiran'] = $file2;
        }

        Penataanbelanja_bkp::create($data);
        return $this->inputNilaibkp($request);
    }

    public function updateTBPU(Request $request)
    {

        $request->validate([
            'nomor' => 'required|max:50',
            'tanggal' => 'required',
            'jumlah' => 'required',
            'sebagai' => 'required',
            'file_bkp' => 'file|mimes:pdf|max:1024',
            'file_lampiran' => 'file|mimes:pdf|max:2048'
        ]);


        $update = Penataanbelanja_bkp::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'id' => $request->id
        ])->update([
            'nomor' => strip_tags($request->nomor),
            'tanggal' => strip_tags($request->tanggal),
            'jumlah' => strip_tags(str_replace('.', '', $request->jumlah)),
            'belanja_id' => $request->belanja_id,
            'sebagai' => strip_tags($request->sebagai),
            'pph' =>  intval(strip_tags(str_replace('.', '', $request->pph))),
            'ppn' =>  intval(strip_tags(str_replace('.', '', $request->ppn))),
            'lainnya' =>  intval(strip_tags(str_replace('.', '', $request->lainnya))),
            'perbaikan_bkp' => true
        ]);


        if ($request->file_bkp) {
            if ($request->old_1 && strpos($request->old_1, $request->tahun)) {
                Storage::delete($request->old_1);
            }
            $ext = $request->file_bkp->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_belanja";
            $file1 = $request->file('file_bkp')->storeAs($folder, "file_bkp_$request->apbdes_kegiatan_id" . "-" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            Penataanbelanja_bkp::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'id' => $request->id
            ])->update([
                'file_bkp' => $file1
            ]);
        }



        if ($request->file_lampiran) {
            if ($request->old_2 && strpos($request->old_2, $request->tahun)) {
                Storage::delete($request->old_2);
            }
            $ext = $request->file_lampiran->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_belanja";
            $file2 = $request->file('file_lampiran')->storeAs($folder, "file_lampiran_$request->apbdes_kegiatan_id" . "-" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            Penataanbelanja_bkp::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'id' => $request->id
            ])->update([
                'file_lampiran' => $file2
            ]);
        }


        return $this->updateNilaibkp($request);
    }


    function cekDokTbpu(Request $request)
    {
        $databkp = Penataanbelanja_bkp::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'apbdes_kegiatan_id' => $request->keg
        ])->get();
        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();
        $bkp = Penataanbelanja_bkp::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->first();
        //$kegiatan = $databkp->apbdes_kegiatan->kegiatan->kegiatan;
        if (count($databkp)) {
            $kegiatan = $databkp[0]->apbdes_kegiatan->kegiatan->kegiatan;
        } else {
            return "belum ada input BKP";
        }


        $spp = Penataanbelanja_spp::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->first();

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'spp' => $spp,
            'bkp' => $bkp,
            'databkp' => $databkp,
            'kegiatan' => $kegiatan,
            'infos' => $infos
        ];


        return view('adminDesa.akunBelanja.cekBKP', $data);
    }

    function cekDokSPP(Request $request)
    {

        $dataspp = Penataanbelanja_spp::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'apbdes_kegiatan_id' => $request->keg
        ])->get();

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();
        $spp = Penataanbelanja_spp::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->first();
        //$kegiatan = $dataspp->apbdes_kegiatan->kegiatan->kegiatan;
        if (count($dataspp)) {
            $kegiatan = $dataspp[0]->apbdes_kegiatan->kegiatan->kegiatan;
        } else {
            return "belum ada input spp";
        }


        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'spp' => $spp,
            'spp' => $spp,
            'dataspp' => $dataspp,
            'kegiatan' => $kegiatan,
            'infos' => $infos
        ];


        return view('adminDesa.akunBelanja.cekSPP', $data);
    }


    public function hapusTBPU($id)
    {
        $cekuji = Uji_petik::where('penataanbelanja_bkp_id', $id)->first();
        if ($cekuji) {
            return back()->with('fail', 'anda tidak bisa menghapus TBPU yang telah di ujipetik oleh Inspektorat!');
        }
        $bkp = Penataanbelanja_bkp::where('id', $id)->first();
        if ($bkp->nilai_bkp) {
            return back()->with('fail', 'anda tidak bisa menghapus TBPU yang telah dinilai oleh Inspektorat!');
        }
        $data = [
            'asal_id' => $bkp->asal_id,
            'tahun' => $bkp->tahun
        ];
        Storage::delete($bkp->file_bkp);
        Penataanbelanja_bkp::destroy($id);
        return $this->hapusNilaibkp($data);
    }

    public function cariSPP(Request $request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'apbdes_kegiatan_id' => $request->apbdes_kegiatan_id,
            'dataspp' => Penataanbelanja_spp::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'apbdes_kegiatan_id' => $request->apbdes_kegiatan_id
            ])->get()
        ];
        if (count($data['dataspp']) == 0) {
            return "data kosong";
        } else {
            return view('adminDesa.akunBelanja.cekSPPKeg', $data);
        }
    }

    public function pembukuanTambah(Request $request)
    {
        $namadata = $request->nama_data;
        $request->validate([
            $namadata => 'file|mimes:pdf|max:2048',
        ]);

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'nama_data' => $request->nama_data
        ];

        if ($request->file($namadata)) {
            // if ($request->old && strpos($request->old, $request->tahun)) {
            //     Storage::delete($request->old);
            // }
            $ext = $request->$namadata->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_belanja";
            $file = $request->file($namadata)->storeAs($folder, $namadata . "-" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $data['file_data'] = $file;
            Bku_panjar::create($data);
        }


        return $this->inputNilaiPembukuan($request);
    }
    public function inputNilaiPembukuan($request)
    {
        $pembukuan = Bku_panjar::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->get();
        $persen_data = ($pembukuan->count() / 4) * 100;
        $cek = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_keuangan_id' => 5
        ])->first();
        if (!$cek) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 2,
                'indikator_id' => 8,
                'sub_indikator_keuangan_id' => 5,
                'jumlah_data' => $pembukuan->count(),
                'persen_data' => $persen_data,
                'perbaikan' => true
            ];
            Nilai_keuangan::create($data);
        } else {
            Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 2,
                'indikator_id' => 8,
                'sub_indikator_keuangan_id' => 5,
            ])->update([
                'jumlah_data' => $pembukuan->count(),
                'persen_data' => $persen_data,
                'perbaikan' => true
            ]);
        }

        return back()->with('success', 'berhasil kirim data');
    }

    public function pembukuanEdit(Request $request)
    {
        $namadata = $request->nama_data;
        $request->validate([
            $namadata => 'file|mimes:pdf|max:2048',
        ]);


        if ($request->file($namadata)) {
            if ($request->old && strpos($request->old, $request->tahun)) {
                Storage::delete($request->old);
            }
            $ext = $request->$namadata->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_belanja";
            $file = $request->file($namadata)->storeAs($folder, $namadata . "-" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            Bku_panjar::where('id', $request->id)->update([
                'file_data' => $file
            ]);
        }

        return $this->inputNilaiPembukuan($request);
    }

    public function hapusPembukuan(Bku_panjar $data)
    {

        $dapus = [
            'asal_id' => $data->asal_id,
            'tahun' => $data->tahun
        ];
        Storage::delete($data->file_data);
        Bku_panjar::destroy($data->id);

        return $this->hapusNilaiPembukuan($dapus);
    }

    public function hapusNilaiPembukuan($dapus)
    {
        $pembukuan = Bku_panjar::where([
            'asal_id' => $dapus['asal_id'],
            'tahun' => $dapus['tahun']
        ])->get();
        $persen_data = ($pembukuan->count() / 4) * 100;
        $cek = Nilai_keuangan::where([
            'asal_id' => $dapus['asal_id'],
            'tahun' => $dapus['tahun'],
            'sub_indikator_keuangan_id' => 5
        ])->first();

        if ($cek->jumlah_data > 1) {
            Nilai_keuangan::where([
                'asal_id' => $dapus['asal_id'],
                'tahun' => $dapus['tahun'],
                'aspek_id' => 2,
                'indikator_id' => 8,
                'sub_indikator_keuangan_id' => 5,
            ])->update([
                'jumlah_data' => $pembukuan->count(),
                'persen_data' => $persen_data,
                'perbaikan' => true
            ]);
        } elseif ($cek->jumlah_data <= 1) {
            Nilai_keuangan::where([
                'asal_id' => $dapus['asal_id'],
                'tahun' => $dapus['tahun'],
                'aspek_id' => 2,
                'indikator_id' => 8,
                'sub_indikator_keuangan_id' => 5,
            ])->delete();
        }

        return back()->with('success', 'berhasil hapus data');
    }
}
