<?php

namespace App\Http\Controllers;

use App\Models\Datum;
use App\Models\Admin;
use App\Models\Nilai_pemerintahan;
use App\Models\Rekap_data_pemerintahan;
use App\Models\Sub_indikator_pemerintahan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DatumController extends Controller
{
    public function formKewilayahan(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();

        $datumAll = Datum::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();

        $kewilayahan = $datumAll->where('jenis', 'kewilayahan');
        $kependudukan = $datumAll->where('jenis', 'kependudukan');
        $sarpras = $datumAll->where('jenis', 'sarpras');
        $kelembagaan = $datumAll->where('jenis', 'kelembagaan');
        $pekerjaan = $datumAll->where('jenis', 'pekerjaan');
        $papan = $datumAll->where('jenis', 'papan');

        $jumlah_rt = $kewilayahan->where('nama_data', 'jumlah_rt')->pluck('isidata')->first();


        if (isset($request->jenis)) {
            $datum = Datum::where([
                'jenis' => $request->jenis,
                'asal_id' => $infos->asal_id,
                'tahun' => $tahun
            ])->get();
            if ($datum->count() == 0) {
                return view('adminDesa.formDatum.kewilayahan_t', [
                    'infos' => $infos,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'kewilayahan' => count($kewilayahan),
                    'kependudukan' => count($kependudukan),
                    'sarpras' => count($sarpras),
                    'kelembagaan' => count($kelembagaan),
                    'pekerjaan'  => count($pekerjaan),
                    'papan' => count($papan),
                    'jumlah_rt' => $jumlah_rt

                ]);
            } else {

                return view('adminDesa.formDatum.kewilayahan_e', [
                    'infos' => $infos,
                    'jenis' => $request->jenis,
                    'tahun' => $tahun,
                    'kewilayahan' => count($kewilayahan),
                    'kependudukan' => count($kependudukan),
                    'sarpras' => count($sarpras),
                    'kelembagaan' => count($kelembagaan),
                    'pekerjaan'  => count($pekerjaan),
                    'papan' => count($papan),
                    'data' => $datum,
                    'jumlah_rt' => $jumlah_rt

                ]);
            }
        } else {
            return view('adminDesa.formDatum.kewilayahan', [
                'infos' => $infos,
                'jenis' => $request->jenis,
                'tahun' => $tahun,
                'kewilayahan' => count($kewilayahan),
                'kependudukan' => count($kependudukan),
                'sarpras' => count($sarpras),
                'kelembagaan' => count($kelembagaan),
                'pekerjaan'  => count($pekerjaan),
                'papan' => count($papan)


            ]);
        }
    }

    public function tambahDatumWil(Request $request)
    {


        $length = count($request->nama_data);
        for ($i = 0; $i < $length; $i++) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => $request->nama_data[$i],
                'isidata' => strip_tags($request->isidata[$i])
            ];
            $insert = Datum::create($data);
        }

        $cek = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_pemerintahan_id' => 1
        ])->first();
        $jumitem = Sub_indikator_pemerintahan::where('id', 1)->pluck('jumlah_item')->first();

        $datum = Datum::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->get();
        $jumwil = $datum->where('jenis', 'kewilayahan')->count();
        $jumduk = $datum->where('jenis', 'kependudukan')->count();
        $jumja = $datum->where('jenis', 'pekerjaan')->count();
        $jumdata = $jumwil + $jumduk + $jumja;

        $persendata = round(($jumdata / $jumitem) * 100, 2);


        if (!$cek) {
            Nilai_pemerintahan::create([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 1,
                'indikator_id' => 1,
                'sub_indikator_pemerintahan_id' => 1,
                'jumlah_data' => $jumdata,
                'persen_data' => $persendata,
                'perbaikan' => true
            ]);
        } else {
            Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 1
            ])->update([
                'jumlah_data' => $jumdata,
                'persen_data' => $persendata,
                'perbaikan' => true
            ]);
        }

        return back()->with('success', 'berhasil kirim data');
    }

    public function updateDatumWil(Request $request)
    {

        $length = count($request->nama_data);
        for ($i = 0; $i < $length; $i++) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => $request->nama_data[$i],
                'isidata' => strip_tags($request->isidata[$i])
            ];
            $update = Datum::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => $request->nama_data[$i]
            ])->update([
                'isidata' => strip_tags($request->isidata[$i])
            ]);
        }

        if ($update) {
            Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 1
            ])->update([
                'perbaikan' => true
            ]);

            return back()->with('update', 'berhasil update data');
        }
    }

    public function tambahDatumDuk(Request $request)
    {
        $length = count($request->nama_data);
        for ($i = 0; $i < $length; $i++) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => $request->nama_data[$i],
                'isidata' => strip_tags($request->isidata[$i])
            ];
            $insert = Datum::create($data);
        }

        $cek = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_pemerintahan_id' => 1
        ])->first();
        $jumitem = Sub_indikator_pemerintahan::where('id', 1)->pluck('jumlah_item')->first();

        $datum = Datum::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->get();
        $jumwil = $datum->where('jenis', 'kewilayahan')->count();
        $jumduk = $datum->where('jenis', 'kependudukan')->count();
        $jumja = $datum->where('jenis', 'pekerjaan')->count();
        $jumdata = $jumwil + $jumduk + $jumja;

        $persendata = round(($jumdata / $jumitem) * 100, 2);


        if (!$cek) {
            Nilai_pemerintahan::create([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 1,
                'indikator_id' => 1,
                'sub_indikator_pemerintahan_id' => 1,
                'jumlah_data' => $jumdata,
                'persen_data' => $persendata,
                'perbaikan' => true
            ]);
        } else {
            Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 1
            ])->update([
                'jumlah_data' => $jumdata,
                'persen_data' => $persendata,
                'perbaikan' => true
            ]);
        }

        return back()->with('success', 'berhasil kirim data');
    }

    public function updateDatumDuk(Request $request)
    {

        $length = count($request->nama_data);
        for ($i = 0; $i < $length; $i++) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => $request->nama_data[$i],
                'isidata' => strip_tags($request->isidata[$i])
            ];
            $update = Datum::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => $request->nama_data[$i]
            ])->update($data);
        }

        if ($update) {
            Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 1
            ])->update([
                'perbaikan' => true
            ]);

            return back()->with('update', 'berhasil update data');
        }
    }

    public function tambahDatumPras(Request $request)
    {
        $length = count($request->nama_data);
        for ($i = 0; $i < $length; $i++) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => $request->nama_data[$i],
                'isidata' => strip_tags($request->isidata[$i])
            ];
            $insert = Datum::create($data);
        }

        $cek = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_pemerintahan_id' => 2
        ])->first();
        $jumitem = Sub_indikator_pemerintahan::where('id', 2)->pluck('jumlah_item')->first();
        $length = count($request->nama_data);

        if ($insert) {
            if (!$cek) {
                Nilai_pemerintahan::create([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 1,
                    'sub_indikator_pemerintahan_id' => 2,
                    'jumlah_data' => $length,
                    'persen_data' => 100,
                    'perbaikan' => true
                ]);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 2
                ])->update([
                    'perbaikan' => true
                ]);
            }

            return back()->with('success', 'berhasil kirim datass');
        }
    }

    public function updateDatumPras(Request $request)
    {
        $length = count($request->nama_data);
        for ($i = 0; $i < $length; $i++) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => $request->nama_data[$i],
                'isidata' => strip_tags($request->isidata[$i])
            ];
            $update = Datum::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => $request->nama_data[$i]
            ])->update([
                'isidata' => $request->isidata[$i]
            ]);
        }


        if ($update) {
            Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 2
            ])->update([
                'perbaikan' => true
            ]);

            return back()->with('update', 'berhasil update data');
        }
    }


    public function tambahDatumPekerjaan(Request $request)
    {

        $length = count($request->nama_data);
        for ($i = 0; $i < $length; $i++) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => $request->nama_data[$i],
                'isidata' => strip_tags($request->isidata[$i])
            ];
            $insert = Datum::create($data);
        }

        $cek = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_pemerintahan_id' => 1
        ])->first();
        $jumitem = Sub_indikator_pemerintahan::where('id', 1)->pluck('jumlah_item')->first();

        $datum = Datum::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun
        ])->get();
        $jumwil = $datum->where('jenis', 'kewilayahan')->count();
        $jumduk = $datum->where('jenis', 'kependudukan')->count();
        $jumja = $datum->where('jenis', 'pekerjaan')->count();
        $jumdata = $jumwil + $jumduk + $jumja;

        $persendata = round(($jumdata / $jumitem) * 100, 2);


        if (!$cek) {
            Nilai_pemerintahan::create([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'aspek_id' => 1,
                'indikator_id' => 1,
                'sub_indikator_pemerintahan_id' => 1,
                'jumlah_data' => $jumdata,
                'persen_data' => $persendata,
                'perbaikan' => true
            ]);
        } else {
            Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 1
            ])->update([
                'jumlah_data' => $jumdata,
                'persen_data' => $persendata,
                'perbaikan' => true
            ]);
        }

        return back()->with('success', 'berhasil kirim data');
    }

    public function updateDatumPekerjaan(Request $request)
    {

        $length = count($request->nama_data);
        for ($i = 0; $i < $length; $i++) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => $request->nama_data[$i],
                'isidata' => strip_tags($request->isidata[$i])
            ];
            $update = Datum::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'nama_data' => $request->nama_data[$i]
            ])->update($data);
        }

        if ($update) {
            Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 1
            ])->update([
                'perbaikan' => true
            ]);

            return back()->with('update', 'berhasil update data');
        }
    }

    public function tambahDatumPapan(Request $request)
    {
        $request->validate([
            'papan_monografi' => 'image|file|max:1024'
        ]);
        $data = [
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'jenis' => $request->jenis,
            'nama_data' => 'papan_monografi'
        ];
        if ($request->file('papan_monografi')) {
            $ext = $request->papan_monografi->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_papan";
            $file1 = $request->file('papan_monografi')->storeAs($folder, "papan_monografi_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);

            $data['isidata'] = $file1;
        }
        $insert = Datum::create($data);

        $cek = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_pemerintahan_id' => 4
        ])->first();

        $length = Datum::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'nama_data' => 'papan_monografi'
        ])->get()->count();
        $jumitem = $length;


        if ($insert) {
            if (!$cek) {
                Nilai_pemerintahan::create([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 1,
                    'sub_indikator_pemerintahan_id' => 4,
                    'jumlah_data' => $length,
                    'persen_data' => floor(($length / $jumitem) * 100),
                    'perbaikan' => true
                ]);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 4
                ])->update([
                    'jumlah_data' => $length,
                    'persen_data' => floor(($length / $jumitem) * 100),
                    'perbaikan' => true
                ]);
            }

            return back()->with('success', 'berhasil kirim data');
        }
    }

    public function hapusDatumPapan(Request $request)
    {
        $data = Datum::where('id', $request->id_hapus)->first();
        $file = $data->isidata;

        $hapus1 = Storage::delete($file);

        $hapus2 = Datum::destroy($request->id_hapus);

        $cek = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_pemerintahan_id' => 4
        ])->first();

        if ($cek->jumlah_data !== 1) {

            Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 4
            ])->update([
                'jumlah_data' => $cek->jumlah_data - 1,
                'persen_data' => floor((($cek->jumlah_data - 1) / ($cek->jumlah_data - 1)) * 100),
                'perbaikan' => true
            ]);
        } else {
            Nilai_pemerintahan::destroy($cek->id);
        }
        // $cek = Nilai_pemerintahan::where([
        //     'asal_id' => $request->asal_id,
        //     'tahun' => $request->tahun,
        //     'sub_indikator_pemerintahan_id' => 4
        // ])->first();

        // $length = Datum::where([
        //     'asal_id' => $request->asal_id,
        //     'tahun' => $request->tahun,
        //     'nama_data' => 'papan_monografi'
        // ])->get()->count();
        // $jumitem = $length;
        // Nilai_pemerintahan::where([
        //     'asal_id' => $request->asal_id,
        //     'tahun' => $request->tahun,
        //     'sub_indikator_pemerintahan_id' => 4
        // ])->update([
        //     'jumlah_data' => $cek->jumlah_data,
        //     'persen_data' => floor((($cek->jumlah_data) / $jumitem) * 100),
        //     'perbaikan' => true
        // ]);
        return $hapus1;
    }

    // Copy Datum
    // copy Datum All
    public function copyDatum(Request $request)
    {


        $datatuju = Datum::where(
            [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahuncopy,
                'jenis' => $request->jenis

            ]
        )->count();

        $jenis = $request->jenis;
        if ($jenis == 'kewilayahan') {
            $sub_indikator_pemerintahan_id = 1;
            $jumdatanilai = 10;
            $jumitem = 31;
        } elseif ($jenis == 'kependudukan') {
            $sub_indikator_pemerintahan_id = 1;
            $jumdatanilai = 10;
            $jumitem = 31;
        } elseif ($jenis == 'pekerjaan') {
            $sub_indikator_pemerintahan_id = 1;
            $jumdatanilai = 11;
            $jumitem = 31;
        } elseif ($jenis == 'sarpras') {
            $sub_indikator_pemerintahan_id = 2;
            $jumdatanilai = 22;
            $jumitem = 22;
        } elseif ($jenis == 'kelembagaan') {
            $sub_indikator_pemerintahan_id = 3;
            $jumdatanilai = 6;
            $jumitem = 6;
        } elseif ($jenis == 'papan') {
            $sub_indikator_pemerintahan_id = 4;
            $jumdatanilai = Datum::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahunasal,
                'jenis' => 'papan'
            ])->get()->count();
            $jumitem = $jumdatanilai;
        }

        $dataasalnilai = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal,
            'sub_indikator_pemerintahan_id' => $sub_indikator_pemerintahan_id
        ])->get();

        $datatujunilai = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahuncopy,
            'sub_indikator_pemerintahan_id' => $sub_indikator_pemerintahan_id
        ])->first();

        if ($request->timpadata) {
            Datum::where(
                [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahuncopy,
                    'jenis' => $request->jenis

                ]
            )->delete();

            $datas = Datum::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahunasal,
                'jenis' => $request->jenis
            ])->get();
            foreach ($datas as $data) {
                $data['tahun'] = $request->tahuncopy;
                $data['id'] = '';
                $copydata = Datum::create($data->toArray());
            }

            if ($copydata) {
                return redirect()->back()->with('success', 'Data berhasil di copy');
            }

            exit();
            die();
        }

        if ($datatuju > 0) {
            return back()->with('fail', "sudah ada data di tahun $request->tahuncopy");
            exit();
            die();
        }

        $datas = Datum::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal,
            'jenis' => $request->jenis
        ])->get();
        foreach ($datas as $data) {
            $data['tahun'] = $request->tahuncopy;
            $data['id'] = '';
            $copydata = Datum::create($data->toArray());
        }

        if ($copydata) {
            if (!$datatujunilai) {
                foreach ($dataasalnilai as $datan) {
                    $datan['tahun'] = $request->tahuncopy;
                    $datan['id'] = '';
                    $datan['jumlah_data'] = $jumdatanilai;
                    $datan['persen_data'] = floor(($jumdatanilai / $jumitem) * 100);
                    $datan['perbaikan'] = true;
                    // $datan['nilai_sementara'] = NULL;
                    // $datan['catatan_sementara'] = NULL;
                    // $datan['rekom_sementara'] = NULL;
                    // $datan['nilai_akhir'] = NULL;
                    // $datan['catatan_akhir'] = NULL;
                    // $datan['rekom_akhir'] = NULL;
                    Nilai_pemerintahan::create($datan->toArray());
                }
            } else {
                if ($sub_indikator_pemerintahan_id == 1) {
                    Nilai_pemerintahan::where([
                        'asal_id' => $request->asal_id,
                        'tahun' => $request->tahuncopy,
                        'sub_indikator_pemerintahan_id' => 1
                    ])->update([
                        'jumlah_data' => $jumdatanilai + $datatujunilai->jumlah_data,
                        'persen_data' => floor((($jumdatanilai + $datatujunilai->jumlah_data) / $jumitem) * 100),
                        'perbaikan' => true
                    ]);
                } else {
                    return "data sudah ada";
                }
            }



            return redirect()->back()->with('success', 'Data berhasil di copy');
        }
    }


    // copy Datum All
    public function copyDatumAll(Request $request)
    {

        $dataasalnilai = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal
        ])->where('sub_indikator_pemerintahan_id', '<=', 4)->get();

        $datatuju = Datum::where(
            [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahuncopy

            ]
        )->count();

        if ($request->timpadata) {
            Datum::where(
                [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahuncopy

                ]
            )->delete();

            $datas = Datum::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahunasal
            ])->get();
            foreach ($datas as $data) {
                $data['tahun'] = $request->tahuncopy;
                $data['id'] = '';
                $copydata = Datum::create($data->toArray());
            }

            if ($copydata) {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahuncopy
                ])->where('sub_indikator_pemerintahan_id', '<=', 4)->delete();
                foreach ($dataasalnilai as $datan) {
                    $datan['tahun'] = $request->tahuncopy;
                    $datan['id'] = '';
                    $datan['perbaikan'] = true;
                    // $datan['nilai_sementara'] = NULL;
                    // $datan['catatan_sementara'] = NULL;
                    // $datan['rekom_sementara'] = NULL;
                    // $datan['nilai_akhir'] = NULL;
                    // $datan['catatan_akhir'] = NULL;
                    // $datan['rekom_akhir'] = NULL;
                    Nilai_pemerintahan::create($datan->toArray());
                }

                return redirect()->back()->with('success', 'Data berhasil di copy');
            }

            exit();
            die();
        }

        if ($datatuju > 0) {
            return back()->with('timpaAll', $request->tahuncopy);
            exit();
            die();
        }

        $datas = Datum::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal
        ])->get();
        foreach ($datas as $data) {
            $data['tahun'] = $request->tahuncopy;
            $data['id'] = '';
            $copydata = Datum::create($data->toArray());
        }

        if ($copydata) {
            foreach ($dataasalnilai as $datan) {
                $datan['tahun'] = $request->tahuncopy;
                $datan['id'] = '';
                $datan['perbaikan'] = true;
                // $datan['nilai_sementara'] = NULL;
                // $datan['catatan_sementara'] = NULL;
                // $datan['rekom_sementara'] = NULL;
                // $datan['nilai_akhir'] = NULL;
                // $datan['catatan_akhir'] = NULL;
                // $datan['rekom_akhir'] = NULL;
                Nilai_pemerintahan::create($datan->toArray());
            }

            return redirect()->back()->with('success', 'Data berhasil di copy');
        }
    }

    // tambah datum kelembagaan
    public function tambahDatumLembaga(Request $request)
    {

        $length = count($request->nama_data);
        for ($i = 0; $i < $length; $i++) {
            $data = [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => $request->nama_data[$i],
                'isidata' => strip_tags($request->isidata[$i])
            ];
            $insert = Datum::create($data);
        }

        $cek = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_pemerintahan_id' => 3
        ])->first();
        $jumitem = Sub_indikator_pemerintahan::where('id', 3)->pluck('jumlah_item')->first();


        if ($insert) {
            if (!$cek) {
                Nilai_pemerintahan::create([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 1,
                    'sub_indikator_pemerintahan_id' => 3,
                    'jumlah_data' => $length,
                    'persen_data' => 100,
                    'perbaikan' => true
                ]);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 3
                ])->update([
                    'perbaikan' => true
                ]);
            }

            return back()->with('success', 'berhasil kirim data');
        }
    }

    public function updateDatumLembaga(Request $request)
    {

        $length = count($request->nama_data);
        for ($i = 0; $i < $length; $i++) {

            $update =  Datum::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'jenis' => $request->jenis,
                'nama_data' => $request->nama_data[$i]
            ])->update([
                'isidata' => $request->isidata[$i]
            ]);
        }


        if ($update) {
            Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 3
            ])->update([
                'perbaikan' => true
            ]);

            return back()->with('update', 'berhasil update data');
        }
    }
}
