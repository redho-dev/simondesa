<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Penataanbelanja_spp;
use App\Models\Apbdes_kegiatan;
use App\Models\Buku_pembantu_pajak;
use App\Models\Total_apbd;
use App\Models\Penataanbelanja_bkp;
use App\Models\Nilai_keuangan;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;

class PenataanPajakController extends Controller
{
    public function formPenataanPajak(Request $request)
    {

        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();

        $pajak = Penataanbelanja_bkp::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->where(function ($query) {
            $query->where('billing_ppn', '!=', NULL)->orWhere('billing_pph', '!=', NULL)->orWhere('billing_lainnya', '!=', NULL);
        })->get();


        $buku = Buku_pembantu_pajak::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();

        $bkpPajak =  Penataanbelanja_bkp::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->where(function ($query) {
            $query->where('ppn', '>', 0)->orWhere('pph', '>', 0)->orWhere('lainnya', '>', 0);
        })->get();
        $databkp = Penataanbelanja_bkp::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();

        $data = [
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun,
            'infos' => $infos,
            'jenis' => $request->jenis,
            'databkp' => $databkp,
            'bkpPajak' => $bkpPajak,
            'billing' => $pajak->count(),
            'buku' => $buku->count(),
            'bpp' => $buku
        ];

        $lainnya = $data['databkp']->pluck('lainnya')->sum();
        $lainnya_t = $data['databkp']->where('billing_lainnya', '!=', NULL)->pluck('lainnya')->sum();


        $totalbkp = 0;
        $totalpph = 0;
        $totalppn = 0;
        $pphterbayar = 0;
        $ppnterbayar = 0;
        foreach ($data['databkp'] as $bkp) {
            $nominal = intval(str_replace('.', '', $bkp->jumlah));
            $totalbkp += $nominal;
            $pph = intval(str_replace('.', '', $bkp->pph));
            $ppn = intval(str_replace('.', '', $bkp->ppn));
            $totalpph += $pph;
            $totalppn += $ppn;
            if ($bkp->billing_pph) {
                $pph_t = intval(str_replace('.', '', $bkp->pph));
                $pphterbayar += $pph_t;
            }
            if ($bkp->billing_ppn) {
                $ppn_t = intval(str_replace('.', '', $bkp->ppn));
                $ppnterbayar += $ppn_t;
            }
        }
        $totalpajak = $totalpph + $totalppn + $lainnya;
        $pajakterbayar = $pphterbayar + $ppnterbayar + $lainnya_t;

        $data['totalbkp'] = $totalbkp;
        $data['totalpajak'] = $totalpajak;
        $data['pajakterbayar'] = $pajakterbayar;



        if ($request->jenis) {
            if ($request->jenis == 'billing') {
                $datum = $pajak;
            } elseif ($request->jenis == 'buku') {
                $datum = $buku;
            }

            $apbdes = Total_apbd::where([
                'asal_id' => $infos->asal_id,
                'tahun' => $tahun
            ])->first();
            if (!$apbdes) {
                return "Belum Ada Input APBDes TA $tahun";
            }
            if ($apbdes->akunbelanja_perubahan) {
                $data['belanja'] = $apbdes->akunbelanja_perubahan;
            } else {
                $data['belanja'] = $apbdes->akunbelanja_murni;
            }


            if (count($datum) == 0) {

                return view('adminDesa.akunPajak.formPenataanPajak_t', $data);
            } else {

                return view('adminDesa.akunPajak.formPenataanPajak_e', $data);
            }
        } else {
            $data = [
                'asal_id' => $infos->asal_id,
                'tahun' => $tahun,
                'infos' => $infos,
                'billing' => $pajak->count(),
                'buku' => $buku->count()
            ];
            return view('adminDesa.akunPajak.formPenataanPajak', $data);
        }
    }

    public function tambahBilling(Request $request)
    {
        if ($request->billing_pph) {
            if ($request->old_pph && strpos($request->old_pph, $request->tahun)) {
                Storage::delete($request->old_pph);
            }
            $ext = $request->billing_pph->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_belanja";
            $file1 = $request->file('billing_pph')->storeAs($folder, "billing_pph_$request->id" . "-" . $request->tahun . "-" . mt_rand(1, 100) . "." . $ext);

            Penataanbelanja_bkp::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'id' => $request->id
            ])->update([
                'billing_pph' => $file1
            ]);
        }

        if ($request->billing_ppn) {
            if ($request->old_ppn && strpos($request->old_ppn, $request->tahun)) {
                Storage::delete($request->old_ppn);
            }
            $ext = $request->billing_ppn->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_belanja";
            $file2 = $request->file('billing_ppn')->storeAs($folder, "billing_ppn_$request->id" . "-" . $request->tahun . "-" . mt_rand(2, 100) . "." . $ext);

            Penataanbelanja_bkp::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'id' => $request->id
            ])->update([
                'billing_ppn' => $file2
            ]);
        }
        if ($request->billing_lainnya) {
            if ($request->old_lainnya && strpos($request->old_lainnya, $request->tahun)) {
                Storage::delete($request->old_lainnya);
            }
            $ext = $request->billing_lainnya->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_belanja";
            $file3 = $request->file('billing_lainnya')->storeAs($folder, "billing_lainnya_$request->id" . "-" . $request->tahun . "-" . mt_rand(2, 100) . "." . $ext);

            Penataanbelanja_bkp::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'id' => $request->id
            ])->update([
                'billing_lainnya' => $file3
            ]);
        }


        if ($request->crud == 'tambah') {
            $kata = "Berhasil Tambah Data";
        } else {
            $kata = "Berhasil Update Data";
        }

        return $this->inputNilaiPajak($request);
    }

    public function inputNilaiPajak($request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => 2,
            'indikator_id' => 10,
            'sub_indikator_keuangan_id' => 10
        ];

        $pajak = Penataanbelanja_bkp::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->where('billing_pph', '!=', Null)->orWhere('billing_ppn', '!=', Null)->get();

        $dataBkp = Penataanbelanja_bkp::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->get();
        $totalbkp = 0;
        $totalpph = 0;
        $totalppn = 0;
        $pphterbayar = 0;
        $ppnterbayar = 0;
        foreach ($dataBkp as $bkp) {
            $nominal = intval(str_replace('.', '', $bkp->jumlah));
            $totalbkp += $nominal;
            $pph = intval(str_replace('.', '', $bkp->pph));
            $ppn = intval(str_replace('.', '', $bkp->ppn));
            $totalpph += $pph;
            $totalppn += $ppn;
            if ($bkp->billing_pph) {
                $pph_t = intval(str_replace('.', '', $bkp->pph));
                $pphterbayar += $pph_t;
            }
            if ($bkp->billing_ppn) {
                $ppn_t = intval(str_replace('.', '', $bkp->ppn));
                $ppnterbayar += $ppn_t;
            }
        }
        $totalpajak = $totalpph + $totalppn;
        $pajakterbayar = $pphterbayar + $ppnterbayar;

        $persendata = ($pajakterbayar / $totalpajak) * 100;
        $data['persen_data'] = round($persendata, 2);
        $data['jumlah_data'] = count($pajak);
        $data['perbaikan'] = true;

        $cek = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_keuangan_id' => 10
        ])->first();
        if (!$cek) {
            Nilai_keuangan::create($data);
        } else {
            Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_keuangan_id' => 10
            ])->update($data);
        }

        $kalimat = $request->crud;
        $url = url()->previous();

        return redirect($url . "#row_" . $request->id)->with('success', 'Data Berhasil di' . $kalimat);
    }



    public function hapusBilling(Request $request)
    {

        if ($request->billing_pph) {
            Storage::delete($request->billing_pph);
        }
        if ($request->billing_ppn) {
            Storage::delete($request->billing_ppn);
        }
        if ($request->billing_lainnya) {
            Storage::delete($request->billing_lainnya);
        }

        Penataanbelanja_bkp::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'id' => $request->id
        ])->update([
            'billing_pph' => Null,
            'billing_ppn' => Null,
            'billing_lainnya' => Null
        ]);

        return $this->inputNilaiPajak($request);
    }

    public function tambahBPP(Request $request)
    {
        $request->validate([
            'buku_pembantu_pajak' => 'file|mimes:pdf|max:5120'
        ]);

        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'nama_data' => $request->nama_data
        ];

        if ($request->file('buku_pembantu_pajak')) {

            $ext = $request->buku_pembantu_pajak->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_belanja";
            $file = $request->file('buku_pembantu_pajak')->storeAs($folder, "buku_pembantu_pajak_$request->id" . "-" . $request->tahun . "-" . mt_rand(2, 100) . "." . $ext);
            $data['file_data'] = $file;
            Buku_pembantu_pajak::create($data);
        }

        return $this->inputNilaiBPP($request);
    }

    public function inputNilaiBPP($request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => 2,
            'indikator_id' => 10,
            'sub_indikator_keuangan_id' => 11,
            'jumlah_data' => 1,
            'persen_data' => 100,
            'perbaikan' => true
        ];

        $cek = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_keuangan_id' => 11
        ])->first();
        if (!$cek) {
            Nilai_keuangan::create($data);
        } else {
            Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_keuangan_id' => 11
            ])->update($data);
        }

        return back()->with('success', 'data berhasil dikirim');
    }

    public function updateBPP(Request $request)
    {
        $request->validate([
            'buku_pembantu_pajak' => 'file|mimes:pdf|max:5120'
        ]);


        if ($request->file('buku_pembantu_pajak')) {
            if ($request->old && strpos($request->old, $request->tahun)) {
                Storage::delete($request->old);
            }
            $ext = $request->buku_pembantu_pajak->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/penataan_belanja";
            $file = $request->file('buku_pembantu_pajak')->storeAs($folder, "buku_pembantu_pajak_$request->id" . "-" . $request->tahun . "-" . mt_rand(2, 100) . "." . $ext);

            Buku_pembantu_pajak::where('id', $request->id)->update([
                'file_data' => $file
            ]);
        }

        return $this->inputNilaiBPP($request);
    }
}
