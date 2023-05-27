<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\Aset_kib;
use App\Models\Datum_perangkat;
use App\Models\Nilai_keuangan;
use PDF;

class AsetkibController extends Controller
{
    public function formKIB(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();
        $aset = Aset_kib::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();

        $tanah = $aset->where('jenis', 'tanah');
        $peralatan = $aset->where('jenis', 'peralatan');
        $gedung = $aset->where('jenis', 'gedung');
        $konstruksi = $aset->where('jenis', 'konstruksi');
        $jalan = $aset->where('jenis', 'jalan');
        $lainnya = $aset->where('jenis', 'lainnya');

        if ($request->jenis) {
            $data = Aset_kib::where([
                'asal_id' => $infos->asal_id,
                'jenis' => $request->jenis,
                'tahun' => $request->tahun
            ])->get();

            return view('adminDesa.formAset.formAset_e', [
                'infos' => $infos,
                'jenis' => $request->jenis,
                'tahun' => $tahun,
                'tanah' => count($tanah),
                'peralatan' => count($peralatan),
                'gedung' => count($gedung),
                'konstruksi' => count($konstruksi),
                'jalan' => count($jalan),
                'lainnya' => count($lainnya),
                'datas' => $data
            ]);
        } else {

            return view('adminDesa.formAset.formAset', [
                'infos' => $infos,
                'jenis' => $request->jenis,
                'tahun' => $tahun,
                'tanah' => count($tanah),
                'peralatan' => count($peralatan),
                'konstruksi' => count($konstruksi),
                'gedung' => count($gedung),
                'jalan' => count($jalan),
                'lainnya' => count($lainnya),
            ]);
        }
    }

    public function tambahAset(Request $request)
    {

        $data = [
            'asal_id' => $request->asal_id,
            'jenis' => $request->jenis,
            'tahun' => $request->tahun,
            'nama_barang' => strip_tags($request->nama_barang),
            'nup' => strip_tags($request->nup),
            'lokasi' => strip_tags($request->lokasi),
            'kode_barang' => strip_tags($request->kode_barang),
            'luas_merk' => strip_tags($request->luas_merk),
            'tahun_perolehan' => strip_tags($request->tahun_perolehan),
            'alas_hak' => strip_tags($request->alas_hak),
            'kondisi_barang' => strip_tags($request->kondisi_barang),
            'nomor_kepemilikan' => strip_tags($request->nomor_kepemilikan),
            'nilai_perolehan' => strip_tags(str_replace('.', '', $request->nilai_perolehan)),
            'panjang' => strip_tags($request->panjang),
            'lebar' => strip_tags($request->lebar),
            'asal_usul' => strip_tags($request->asal_usul),
            'keterangan' => strip_tags($request->keterangan)
        ];
        if ($request->jenis == 'jalan') {
            $data['nama_barang'] = $request->kategori . ": " . $request->nama_barang;
        }

        Aset_kib::create($data);
        return $this->inputNilaiAset($request);
    }

    public function inputNilaiAset($request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'aspek_id' => 2,
            'indikator_id' => 12,
            'sub_indikator_keuangan_id' => 16,
            'perbaikan' => true
        ];

        $jumjenis = DB::table('aset_kibs')->distinct()->get(['jenis'])->count();
        $persendata =  ($jumjenis / 4) * 100;
        $data['jumlah_data'] = $jumjenis;
        $data['persen_data'] = round($persendata, 2);

        $cek = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_keuangan_id' => 16
        ])->first();
        if (!$cek) {
            Nilai_keuangan::create($data);
        } else {
            Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_keuangan_id' => 16
            ])->update($data);
        }


        $cekDI = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_keuangan_id' => 19
        ])->first();
        if (!$cekDI) {
            $data['sub_indikator_keuangan_id'] = 19;
            Nilai_keuangan::create($data);
        } else {
            $data['sub_indikator_keuangan_id'] = 19;
            Nilai_keuangan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_keuangan_id' => 19
            ])->update($data);
        }

        return back()->with('success', 'berhasil kirim data');
    }

    public function editAset(Request $request)
    {
        $data = [
            'asal_id' => $request->asal_id,
            'jenis' => $request->jenis,
            'tahun' => $request->tahun,
            'nama_barang' => strip_tags($request->nama_barang),
            'nup' => strip_tags($request->nup),
            'lokasi' => strip_tags($request->lokasi),
            'kode_barang' => strip_tags($request->kode_barang),
            'luas_merk' => strip_tags($request->luas_merk),
            'tahun_perolehan' => strip_tags($request->tahun_perolehan),
            'alas_hak' => strip_tags($request->alas_hak),
            'kondisi_barang' => strip_tags($request->kondisi_barang),
            'nomor_kepemilikan' => strip_tags($request->nomor_kepemilikan),
            'nilai_perolehan' => strip_tags(str_replace('.', '', $request->nilai_perolehan)),
            'panjang' => strip_tags($request->panjang),
            'lebar' => strip_tags($request->lebar),
            'asal_usul' => strip_tags($request->asal_usul),
            'keterangan' => strip_tags($request->keterangan)
        ];

        Aset_kib::where('id', $request->id)->update($data);
        return back()->with('success', 'Berhasil Edit Data ' . $request->jenis);
    }
    public function hapusAset(Request $request)
    {

        Aset_kib::where('id', $request->idhapus)->delete();
        return back()->with('success', 'Berhasil Hapus Data ' . $request->jenis);
    }

    public function cetakAset(Request $request)
    {
        $aset = Aset_kib::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'jenis' => $request->jenis
        ])->get();

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();
        $kades = Datum_perangkat::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'jabatan' => 'Kepala Desa'
        ])->get()->pluck('nama')->first();

        $pdf = PDF::loadview('adminDesa.formAset.asetCetak', [
            'datas' => $aset,
            'jenis' => $request->jenis,
            'tahun' => $request->tahun,
            'asal_id' => $request->asal_id,
            'infos' => $infos,
            'kades' => $kades

        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function copyAsetAll(Request $request)
    {
        $cek = Aset_kib::where([
            'tahun' => $request->tahuncopy,
            'asal_id' => $request->asal_id
        ])->get()->count();
        if ($request->timpadata) {
            Aset_kib::where(
                [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahuncopy

                ]
            )->delete();

            $datas = Aset_kib::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahunasal
            ])->get();
            foreach ($datas as $data) {
                $data['tahun'] = $request->tahuncopy;
                $data['id'] = '';
                $copydata = Aset_kib::create($data->toArray());
            }

            if ($copydata) {
                return $this->copyNilaiAset($request);
            }

            exit();
            die();
        }

        if ($cek > 0) {
            return back()->with('timpaAll', $request->tahuncopy);
            exit();
            die();
        }

        $datas = Aset_kib::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal
        ])->get();
        foreach ($datas as $data) {
            $data['tahun'] = $request->tahuncopy;
            $data['id'] = '';
            $copydata = Aset_kib::create($data->toArray());
        }

        if ($copydata) {

            return $this->copyNilaiAset($request);
        }
    }

    public function copyNilaiAset($request)
    {
        $cekawal = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal,
            'sub_indikator_keuangan_id' => 16
        ])->first();
        $cektuju = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahuncopy,
            'sub_indikator_keuangan_id' => 16
        ])->first();

        if (!$cektuju) {
            $data = [
                'asal_id' => $cekawal->asal_id,
                'tahun' => $request->tahuncopy,
                'aspek_id' => $cekawal->aspek_id,
                'indikator_id' => $cekawal->indikator_id,
                'sub_indikator_keuangan_id' => $cekawal->sub_indikator_keuangan_id,
                'jumlah_data' => $cekawal->jumlah_data,
                'persen_data' => $cekawal->persen_data,
                'perbaikan' => true
            ];
            Nilai_keuangan::create($data);
        } else {
            Nilai_keuangan::where([
                'asal_id' => $cekawal->asal_id,
                'tahun' => $request->tahuncopy,
                'aspek_id' => $cekawal->aspek_id,
                'indikator_id' => $cekawal->indikator_id,
                'sub_indikator_keuangan_id' => $cekawal->sub_indikator_keuangan_id
            ])->delete();
            $data = [
                'asal_id' => $cekawal->asal_id,
                'tahun' => $request->tahuncopy,
                'aspek_id' => $cekawal->aspek_id,
                'indikator_id' => $cekawal->indikator_id,
                'sub_indikator_keuangan_id' => $cekawal->sub_indikator_keuangan_id,
                'jumlah_data' => $cekawal->jumlah_data,
                'persen_data' => $cekawal->persen_data,
                'perbaikan' => true
            ];
            Nilai_keuangan::create($data);
        }

        $cekawal_i = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal,
            'sub_indikator_keuangan_id' => 19
        ])->first();
        $cektuju_i = Nilai_keuangan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahuncopy,
            'sub_indikator_keuangan_id' => 19
        ])->first();
        if (!$cektuju_i) {
            $data = [
                'asal_id' => $cekawal_i->asal_id,
                'tahun' => $request->tahuncopy,
                'aspek_id' => $cekawal_i->aspek_id,
                'indikator_id' => $cekawal_i->indikator_id,
                'sub_indikator_keuangan_id' => $cekawal_i->sub_indikator_keuangan_id,
                'jumlah_data' => $cekawal_i->jumlah_data,
                'persen_data' => $cekawal_i->persen_data,
                'perbaikan' => true
            ];
            Nilai_keuangan::create($data);
        } else {
            Nilai_keuangan::where([
                'asal_id' => $cekawal_i->asal_id,
                'tahun' => $request->tahuncopy,
                'aspek_id' => $cekawal_i->aspek_id,
                'indikator_id' => $cekawal_i->indikator_id,
                'sub_indikator_keuangan_id' => $cekawal_i->sub_indikator_keuangan_id
            ])->delete();
            $data = [
                'asal_id' => $cekawal_i->asal_id,
                'tahun' => $request->tahuncopy,
                'aspek_id' => $cekawal_i->aspek_id,
                'indikator_id' => $cekawal_i->indikator_id,
                'sub_indikator_keuangan_id' => $cekawal_i->sub_indikator_keuangan_id,
                'jumlah_data' => $cekawal_i->jumlah_data,
                'persen_data' => $cekawal_i->persen_data,
                'perbaikan' => true
            ];
            Nilai_keuangan::create($data);
        }

        return back()->with('success', 'berhasil copy data');
    }



    public function formInventaris(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }
        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();
        $aset = Aset_kib::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->orderBy('nup', 'asc')->get();

        $data = [
            'infos' => $infos,
            'tahun' => $tahun,
            'asets' => $aset,
            'jumset' => count($aset)

        ];

        return view('adminDesa.formAset.formInventaris', $data);
    }

    public function cetakInventaris(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $tahun = $request->tahun;
        }
        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();
        $aset = Aset_kib::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->orderBy('nup', 'asc')->get();

        $total = 0;
        foreach ($aset as $as) {
            $nilai = intval(str_replace(".", "", $as->nilai_perolehan));
            $total += $nilai;
        }
        $kades = Datum_perangkat::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'jabatan' => 'Kepala Desa'
        ])->get()->pluck('nama')->first();


        $data = [
            'infos' => $infos,
            'tahun' => $tahun,
            'asets' => $aset,
            'total' => number_format($total, 0, ',', '.'),
            'kades' => $kades

        ];

        $pdf = PDF::loadview('adminDesa.formAset.asetCetakInventaris', $data)->setPaper('a4', 'landscape');

        return $pdf->stream();
    }
}
