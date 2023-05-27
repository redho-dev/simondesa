<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Apbdes_pembiayaan;
use App\Models\Penataan_pendapatan;
use App\Models\Apbdes_pendapatan;
use App\Models\Buku_pembantu_bank;
use App\Models\Total_apbd;
use App\Models\Nilai_keuangan;

use Illuminate\Support\Facades\Storage;


class PenataanPendapatanController extends Controller
{
    public function formPenataanPendapatan(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();

        $pengajuan = Penataan_pendapatan::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun,
        ])->get();

        $bukuBank = Buku_pembantu_bank::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun,
        ])->get();
        $bukuBank1 = $bukuBank->where('nama_data', 'semester_1')->first();
        $bukuBank2 = $bukuBank->where('nama_data', 'semester_2')->first();
        $pembiayaan = Apbdes_pembiayaan::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();


        $data = [
            'infos' => $infos,
            'jenis' => $request->jenis,
            'tahun' => $tahun,
            'pengajuan' => count($pengajuan),
            'bukuBank' => count($bukuBank),
            'bukuBank1' => $bukuBank1,
            'bukuBank2' => $bukuBank2
        ];

        $data['total_p'] = Total_apbd::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->first();
        if (!$data['total_p']) {
            return back()->with('fail', 'Silahkan Isi Data APBDes Terlebih Dahulu!');
        }
        if ($data['total_p']->belanja_perubahan != NULL) {
            $data['anggaran'] = 'perubahan';
            $data['silpa'] = $pembiayaan->where('pembiayaan_id', 2)->pluck('anggaran_perubahan')->first();
            $apem = $pembiayaan->where('pembiayaan_id', '>', 2)->where('pembiayaan_id', '<', 6)->pluck('anggaran_perubahan');
            $topem = 0;
            foreach ($apem as $ap) {
                $ap = intval($ap);
                $topem += $ap;
            }
            $data['topem'] = $topem;
        } else {
            $data['anggaran'] = 'murni';
            $data['silpa'] = $pembiayaan->where('pembiayaan_id', 2)->pluck('anggaran_murni')->first();
            $apem = $pembiayaan->where('pembiayaan_id', '>', 2)->where('pembiayaan_id', '<', 6)->pluck('anggaran_murni');
            $topem = 0;
            foreach ($apem as $ap) {
                $ap = intval($ap);
                $topem += $ap;
            }
            $data['topem'] = $topem;
        }



        if (isset($request->jenis)) {

            if ($request->jenis == 'pengajuan' || $request->jenis == 'cek_pengajuan') {
                $datum = $pengajuan;
            } elseif ($request->jenis == 'buku_pembantu_bank') {
                $datum = $bukuBank;
            }

            if (count($datum) == 0) {
                if ($request->jenis == 'pengajuan') {

                    $data['pendapatans'] = Apbdes_pendapatan::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun,
                    ])->get();
                }


                return view('adminDesa.akunPendapatan.formAkunPendapatan_t', $data);
            } else {


                if ($request->jenis == 'pengajuan' || $request->jenis == 'cek_pengajuan') {

                    $data['pendapatans'] = Apbdes_pendapatan::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun,
                    ])->get();
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
                } elseif ($request->jenis == 'buku_pembantu_bank') {
                    $data['bukubanks'] = Buku_pembantu_bank::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->first();
                }
                if ($request->pendapatan) {
                    $jenpend = Apbdes_pendapatan::where([
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun,
                        'id' => $request->pendapatan
                    ])->first();

                    $data['jenpend'] = $jenpend;
                    $data['nampend'] = $jenpend->jenis_pendapatan;
                    $data['pendapatan_id'] = $jenpend->pendapatan_id;
                }

                return view('adminDesa.akunPendapatan.formAkunPendapatan_e', $data);
            }
        } else {
            return view('adminDesa.akunPendapatan.formAkunPendapatan', $data);
        }
    }

    public function tambahPengajuan(Request $request)
    {

        $request->validate([
            'file_data' => 'required|file|mimes:pdf|max:1024'
        ]);

        if ($request->pendapatan_id == 5) {
            $nama_data = $request->nama_data;
            $bulan = $request->bulan;
            foreach ($bulan as $bln) {
                $nama_data .= "_" . $bln . "_";
            }
            $nama_data = substr($nama_data, 0, -1);
        } else {
            $nama_data = $request->nama_data;
        }


        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'jenis' => $request->jenis,
            'nama_data' => $nama_data,
            'jumlah' => strip_tags(str_replace('.', '', $request->jumlah)),
            'apbdes_pendapatan_id' => $request->apbdes_pendapatan_id,
            'pendapatan_id' => $request->pendapatan_id,
            'tgl_pengajuan' => strip_tags($request->tgl_pengajuan),
            'tgl_saldo' => strip_tags($request->tgl_saldo),
        ];


        if ($request->file('file_data')) {
            $ext = $request->file_data->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_pendapatan";
            $file1 = $request->file('file_data')->storeAs($folder, "file_data_$request->pendapatan_id" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            $data['file_data'] = $file1;
        }


        Penataan_pendapatan::create($data);
        return $this->inputNilai($request);
    }


    public function updatePengajuan(Request $request)
    {


        $request->validate([
            'file_data' => 'file|mimes:pdf|max:1024'
        ]);


        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'jenis' => $request->jenis,
            'nama_data' => $request->nama_data,
            'jumlah' => strip_tags(str_replace('.', '', $request->jumlah)),
            'apbdes_pendapatan_id' => $request->apbdes_pendapatan_id,
            'pendapatan_id' => $request->pendapatan_id,
            'tgl_pengajuan' => strip_tags($request->tgl_pengajuan),
            'tgl_saldo' => strip_tags($request->tgl_saldo),
        ];
        Penataan_pendapatan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'id' => $request->id,
            'apbdes_pendapatan_id' => $request->apbdes_pendapatan_id
        ])->update([
            'nama_data' => $request->nama_data,
            'jumlah' => strip_tags(str_replace('.', '', $request->jumlah)),
            'tgl_pengajuan' => strip_tags($request->tgl_pengajuan),
            'tgl_saldo' => strip_tags($request->tgl_saldo),
            'perbaikan' => 1
        ]);

        if ($request->file('file_data')) {
            if (strpos($request->tahun, $request->old_1)) {
                Storage::delete($request->old_1);
            }
            $ext = $request->file_data->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_pendapatan";
            $file1 = $request->file('file_data')->storeAs($folder, "file_data_$request->pendapatan_id" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            Penataan_pendapatan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'id' => $request->id,
                'apbdes_pendapatan_id' => $request->apbdes_pendapatan_id
            ])->update([
                'file_data' => $file1
            ]);
        }

        return $this->inputNilai($request);
    }


    public function inputNilai($request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => 2,
            'indikator_id' => 7,
            'sub_indikator_keuangan_id' => 1
        ];
        $total = Total_apbd::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->first();
        if ($total->pendapatan_perubahan != NULL) {

            $totalP = $total->pendapatan_perubahan;
        } else {

            $totalP = $total->pendapatan_murni;
        }

        $jumlah = Penataan_pendapatan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->pluck('jumlah');

        $jumto = 0;
        foreach ($jumlah as $jum) {
            $dajum = str_replace('.', '', $jum);
            $dajum = intval($dajum);
            $jumto += $dajum;
        }
        $persen_data = round(($jumto / $totalP) * 100, 2);

        $cek = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_keuangan_id' => 1
        ])->first();
        if (!$cek) {
            $data['jumlah_data'] = 1;
            $data['persen_data'] = $persen_data;
            $data['perbaikan'] = true;
            Nilai_keuangan::create($data);
        } else {
            $jumdawal = $cek->jumlah_data;
            Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_keuangan_id' => 1
            ])->update([
                'jumlah_data' => $jumdawal + 1,
                'persen_data' => $persen_data,
                'perbaikan' => true
            ]);

            Penataan_pendapatan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'apbdes_pendapatan_id' => $request->apbdes_pendapatan_id
            ])->update([
                'perbaikan' => 1
            ]);
        }
        return back()->with('success', 'Berhasil Kirim Data');
    }



    public function deletePengajuan($id)
    {
        $file_data = Penataan_pendapatan::where('id', $id)->pluck('file_data')->first();
        Storage::delete($file_data);
        $data =  Penataan_pendapatan::where('id', $id)->first();
        Penataan_pendapatan::destroy($id);

        return $this->nilaiUlang($data->asal_id, $data->tahun);
    }

    public function nilaiUlang($asal_id, $tahun)
    {

        $total = Total_apbd::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->first();
        if ($total->pendapatan_perubahan != NULL) {
            $totalP = $total->pendapatan_perubahan;
        } else {
            $totalP = $total->pendapatan_murni;
        }

        $jumlah = Penataan_pendapatan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->pluck('jumlah');
        $jumto = 0;
        foreach ($jumlah as $jum) {
            $dajum = str_replace('.', '', $jum);
            $dajum = intval($dajum);
            $jumto += $dajum;
        }
        $jumdawal = Nilai_keuangan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'sub_indikator_keuangan_id' => 1
        ])->pluck('jumlah_data')->first();
        $persen_data = round(($jumto / $totalP) * 100, 2);
        Nilai_keuangan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'sub_indikator_keuangan_id' => 1
        ])->update([
            'jumlah_data' => $jumdawal - 1,
            'persen_data' => $persen_data,
            'perbaikan' => true
        ]);

        return back()->with('success', 'Berhasil hapus data');
    }

    public function tambahBukuBank(Request $request)
    {

        $request->validate([
            'semester_1' => 'file|mimes:pdf|max:5120',
            'semester_2' => 'file|mimes:pdf|max:5120'
        ]);

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ];
        if ($request->semester_1) {
            $ext = $request->semester_1->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_pendapatan";
            $file1 = $request->file('semester_1')->storeAs($folder, "buku_pembantu_bankSemester_1_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            $data['semester_1'] = $file1;
            Buku_pembantu_bank::create($data);
        }
        if ($request->semester_2) {
            $ext = $request->semester_2->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_pendapatan";
            $file2 = $request->file('semester_2')->storeAs($folder, "buku_pembantu_bankSemester_2_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            $data['semester_2'] = $file2;
            Buku_pembantu_bank::create($data);
        }

        return $this->inputNilaiB($request);
    }
    public function inputNilaiB($request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => 2,
            'indikator_id' => 7,
            'sub_indikator_keuangan_id' => 2
        ];
        $cekbuku = Buku_pembantu_bank::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->first();
        if ($cekbuku->semester_2 == NULL) {
            $jumdata = 1;
            $persen_data = 50;
        } else {
            $jumdata = 2;
            $persen_data = 100;
        }
        $cek = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_keuangan_id' => 2
        ])->first();

        if (!$cek) {
            $data['jumlah_data'] = $jumdata;
            $data['persen_data'] = $persen_data;
            $data['perbaikan'] = true;
            Nilai_keuangan::create($data);
        } else {
            Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_keuangan_id' => 2
            ])->update([
                'jumlah_data' => $jumdata,
                'persen_data' => $persen_data,
                'perbaikan' => true
            ]);
        }

        return back()->with('success', 'Berhasil kirim data');
    }

    public function updateBukuBank(Request $request)
    {

        $request->validate([
            'semester_1' => 'file|mimes:pdf|max:5120',
            'semester_2' => 'file|mimes:pdf|max:5120'
        ]);

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ];
        if ($request->semester_1) {
            if ($request->old_1) {
                Storage::delete($request->old_1);
            }
            $ext = $request->semester_1->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_pendapatan";
            $file1 = $request->file('semester_1')->storeAs($folder, "buku_pembantu_bankSemester_1_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            Buku_pembantu_bank::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun
            ])->update([
                'semester_1' => $file1
            ]);
        }
        if ($request->semester_2) {
            if ($request->old_2) {
                Storage::delete($request->old_2);
            }
            $ext = $request->semester_2->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_pendapatan";
            $file2 = $request->file('semester_2')->storeAs($folder, "buku_pembantu_bankSemester_2_" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            Buku_pembantu_bank::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun
            ])->update([
                'semester_2' => $file2
            ]);
        }

        return $this->inputNilaiB($request);
    }

    public function bukuBankTambah(Request $request)
    {
        $namadata = $request->nama_data;
        $request->validate([
            $namadata => 'file|mimes:pdf|max:3072',
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
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_pendapatan";
            $file = $request->file($namadata)->storeAs($folder, "bukuBank" . $namadata . "-" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $data['file_data'] = $file;
            Buku_pembantu_bank::create($data);
        }

        $cek = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_keuangan_id' => 2
        ])->first();

        if (!$cek) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 2,
                'indikator_id' => 7,
                'sub_indikator_keuangan_id' => 2,
                'jumlah_data' => 1,
                'persen_data' => 50,
                'perbaikan' => true
            ];
            Nilai_keuangan::create($data);
        } else {
            $jumdawal = $cek->jumlah_data;
            $persenawal = $cek->persen_data;
            Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 2,
                'indikator_id' => 7,
                'sub_indikator_keuangan_id' => 2
            ])->update([
                'jumlah_data' => $jumdawal + 1,
                'persen_data' => $persenawal + 50,
                'perbaikan' => true
            ]);

            Buku_pembantu_bank::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => $request->nama_data
            ])->update([
                'perbaikan' => 1
            ]);
        }

        return back()->with('success', 'berhasil kirim data');
    }

    public function bukuBankEdit(Request $request)
    {
        $namadata = $request->nama_data;
        $request->validate([
            $namadata => 'file|mimes:pdf|max:3072',
        ]);

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'nama_data' => $request->nama_data
        ];

        if ($request->file($namadata)) {
            if ($request->old && strpos($request->old, $request->tahun)) {
                Storage::delete($request->old);
            }
            $ext = $request->$namadata->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_pendapatan";
            $file = $request->file($namadata)->storeAs($folder, "bukuBank" . $namadata . "-" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);
            $data['file_data'] = $file;
            Buku_pembantu_bank::where('id', $request->id)->update([
                'file_data' => $file
            ]);
        }

        $cek = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_keuangan_id' => 2
        ])->first();

        if (!$cek) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 2,
                'indikator_id' => 7,
                'sub_indikator_keuangan_id' => 2,
                'jumlah_data' => 1,
                'persen_data' => 50,
                'perbaikan' => true
            ];
            Nilai_keuangan::create($data);
        } else {
            $jumdawal = $cek->jumlah_data;
            $persenawal = $cek->persen_data;
            Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 2,
                'indikator_id' => 7,
                'sub_indikator_keuangan_id' => 2
            ])->update([
                'perbaikan' => true
            ]);
        }

        return back()->with('success', 'berhasil update data');
    }

    public function hapusBukubank(Buku_pembantu_bank $data)
    {
        $cek = Nilai_keuangan::where([
            'asal_id' => $data->asal_id,
            'tahun' => $data->tahun,
            'sub_indikator_keuangan_id' => 2
        ])->pluck('jumlah_data')->first();

        if ($cek && $cek <= 1) {
            Nilai_keuangan::where([
                'asal_id' => $data->asal_id,
                'tahun' => $data->tahun,
                'sub_indikator_keuangan_id' => 2
            ])->update([
                'jumlah_data' => 0,
                'persen_data' => 0,
                'perbaikan' => true
            ]);
        } else {
            Nilai_keuangan::where([
                'asal_id' => $data->asal_id,
                'tahun' => $data->tahun,
                'sub_indikator_keuangan_id' => 2
            ])->update([
                'jumlah_data' => $cek - 1,
                'persen_data' => 50,
                'perbaikan' => true
            ]);
        }
        Storage::delete($data->file_data);
        Buku_pembantu_bank::destroy($data->id);
        return back()->with('success', 'berhasil hapus data');
    }
}
