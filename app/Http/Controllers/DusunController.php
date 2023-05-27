<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Datum_kewilayahan;
use App\Models\Datum;
use App\Models\Datum_dusun;
use App\Models\Datum_perangkat;
use App\Models\Nilai_pemerintahan;
use App\Models\Sub_indikator_pemerintahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DusunController extends Controller
{
    public function formDusun(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();

        $cek1 = Datum::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun,
            'nama_data' => 'jumlah_dusun'
        ])->first();
        $cek2 = Datum::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun,
            'nama_data' => 'jumlah_bpd'
        ])->first();
        if (!$cek1 or !$cek2) {
            return redirect('/adminDesa/formKewilayahan')->with('fail', 'Anda wajib menyelesaikan data monografi dahulu!');
        }


        $dawil = Datum::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun,
            'jenis' => 'kewilayahan',
            'nama_data' => 'jumlah_dusun'
        ])->first();



        $daper = Datum_dusun::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();

        if (!$dawil) {
            $jumdus = 0;
        } else {
            $jumdus = $dawil->isidata;
        }

        $kadus = "";


        for ($i = 1; $i <= $jumdus; $i++) {

            $kadus = $kadus . "kadus_" . $i . "|";
        }
        substr($kadus, 0, -1);
        $kadus = explode("|", $kadus);
        $data = [];
        for ($i = 1; $i <= $jumdus; $i++) {

            $data[] = Datum_dusun::where([
                'asal_id' => $infos->asal_id,
                'tahun' => $tahun,
                'jabatan' => 'Kadus_' . $i
            ])->count();
        }




        if (isset($request->jabatan)) {
            $datum = Datum_dusun::where([
                'jabatan' => $request->jabatan,
                'asal_id' => $infos->asal_id,
                'tahun' => $tahun
            ])->get()->count();
            if ($datum == 0) {
                return view('adminDesa.formDatum.dusun_t', [
                    'infos' => $infos,
                    'jabatan' => $request->jabatan,
                    'tahun' => $tahun,
                    'kadusun' => $data,
                    'jumdus' => $jumdus

                ]);
            } else {
                return view('adminDesa.formDatum.dusun_e', [
                    'infos' => $infos,
                    'jabatan' => $request->jabatan,
                    'tahun' => $tahun,
                    'data' => Datum_dusun::where([
                        'jabatan' => $request->jabatan,
                        'asal_id' => $infos->asal_id,
                        'tahun' => $tahun
                    ])->first(),
                    'kadusun' => $data,
                    'jumdus' => $jumdus
                ]);
            }
        } else {
            return view('adminDesa.formDatum.dusun', [
                'infos' => $infos,
                'jabatan' => $request->jabatan,
                'tahun' => $tahun,
                'kadusun' => $data,
                'jumdus' => $jumdus

            ]);
        }
    }




    public function tambahDatumDus(Request $request)
    {

        $valid = $request->validate([
            'asal_id' => 'required',
            'tahun' => 'required',
            'jabatan' => 'required',
            'status_jab' => 'required',
            'nama' => 'required|max:50',
            'tempat_lahir' => 'required|max:100',
            'tgl_lahir' => 'required',
            'jenkel' => 'required',
            'agama' => 'max:50',
            'nomor_sk' => 'required|max:100',
            'sejak' => 'required',
            'sampai' => 'max:50',
            'pendidikan' => 'required',
            'foto_perangkat' => 'image|file|max:1024',
            'file_sk' => 'mimes:pdf|file|max:1024',
            'file_ijazah' => 'mimes:pdf|file|max:1024'

        ]);

        if ($request->file('foto_perangkat')) {
            $ext = $request->foto_perangkat->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_perangkat";
            $file1 = $request->file('foto_perangkat')->storeAs($folder, "foto_perangkat_dusun_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);

            $valid['foto_perangkat'] = $file1;
        }

        if ($request->file('file_sk')) {
            $ext = $request->file_sk->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_perangkat";
            $file2 = $request->file('file_sk')->storeAs($folder, "file_sk_dusun_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);

            $valid['file_sk'] = $file2;
        }
        if ($request->file('file_ijazah')) {
            $ext = $request->file_ijazah->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_perangkat";
            $file3 = $request->file('file_ijazah')->storeAs($folder, "file_ijazah_dusun_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);

            $valid['file_ijazah'] = $file3;
        }


        $insert = Datum_dusun::create($valid);

        $cek = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'sub_indikator_pemerintahan_id' => 5
        ])->first();
        $jumperangkat = 8;
        $jumdus = Datum::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'nama_data' => 'jumlah_dusun'
        ])->pluck('isidata')->first();
        $jumrt = Datum::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'nama_data' => 'jumlah_rt'
        ])->pluck('isidata')->first();
        $jumbpd = Datum::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahun,
            'nama_data' => 'jumlah_bpd'
        ])->pluck('isidata')->first();


        $jumitem = $jumperangkat + intval($jumdus) + intval($jumrt) + intval($jumbpd);

        $length = 1;

        if ($insert) {
            if (!$cek) {
                Nilai_pemerintahan::create([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'aspek_id' => 1,
                    'indikator_id' => 1,
                    'sub_indikator_pemerintahan_id' => 5,
                    'jumlah_data' => $length,
                    'persen_data' => round(($length / $jumitem) * 100),
                    'perbaikan' => true
                ]);
            } else {
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahun,
                    'sub_indikator_pemerintahan_id' => 5
                ])->update([
                    'jumlah_data' => $cek->jumlah_data + $length,
                    'persen_data' => round((($cek->jumlah_data + $length) / $jumitem) * 100),
                    'perbaikan' => true
                ]);
            }


            return redirect()->back()->with('success', 'berhasil kirim data perangkat');
        }
    }

    public function updateDatumDus(Request $request)
    {
        $valid = $request->validate([
            'asal_id' => 'required',
            'tahun' => 'required',
            'jabatan' => 'required',
            'status_jab' => 'required',
            'nama' => 'required|max:50',
            'tempat_lahir' => 'required|max:100',
            'tgl_lahir' => 'required',
            'jenkel' => 'required',
            'agama' => 'max:50',
            'nomor_sk' => 'required|max:100',
            'sejak' => 'required',
            'sampai' => 'max:50',
            'pendidikan' => 'required',
            'foto_perangkat' => 'image|file|max:1024',
            'file_sk' => 'mimes:pdf|file|max:1024',
            'file_ijazah' => 'mimes:pdf|file|max:1024'

        ]);

        $data = [
            'asal_id' => strip_tags($request->asal_id),
            'tahun' => strip_tags($request->tahun),
            'jabatan' => strip_tags($request->jabatan),
            'status_jab' => strip_tags($request->status_jab),
            'nama' => strip_tags($request->nama),
            'tempat_lahir' => strip_tags($request->tempat_lahir),
            'tgl_lahir' => strip_tags($request->tgl_lahir),
            'jenkel' => strip_tags($request->jenkel),
            'agama' => strip_tags($request->agama),
            'nomor_sk' => strip_tags($request->nomor_sk),
            'sejak' => strip_tags($request->sejak),
            'sampai' => strip_tags($request->sampai),
            'pendidikan' => strip_tags($request->pendidikan)
        ];

        if ($request->file('foto_perangkat')) {
            if ($request->oldImage && strpos($request->oldImage, $request->tahun)) {
                Storage::delete($request->oldImage);
            }

            $ext = $request->foto_perangkat->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_perangkat";
            $file1 = $request->file('foto_perangkat')->storeAs($folder, "foto_perangkat_dusun_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);

            $data['foto_perangkat'] = $file1;
        }
        if ($request->file('file_sk')) {
            if ($request->oldSk && strpos($request->oldSk, $request->tahun)) {
                Storage::delete($request->oldSk);
            }
            $ext = $request->file_sk->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_perangkat";
            $file2 = $request->file('file_sk')->storeAs($folder, "file_sk_dusun_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);

            $data['file_sk'] = $file2;
        }
        if ($request->file('file_ijazah')) {
            if ($request->oldIjazah && strpos($request->oldIjazah, $request->tahun)) {
                Storage::delete($request->oldIjazah);
            }
            $ext = $request->file_ijazah->extension();
            $folder = "adminDesa/desa_" . $request->asal_id . "/" . $request->tahun . "/file_perangkat";
            $file3 = $request->file('file_ijazah')->storeAs($folder, "file_ijazah_dusun_" . $request->tahun . "-" . mt_rand(1, 20) . "." . $ext);

            $data['file_ijazah'] = $file3;
        }


        $update = Datum_dusun::where('id', $request->id)->update($data);

        if ($update) {
            Nilai_pemerintahan::where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahun,
                'sub_indikator_pemerintahan_id' => 5
            ])->update([
                'perbaikan' => true
            ]);

            return redirect("/adminDesa/formDusun?jabatan=$request->jabatan&tahun=$request->tahun")->with('success', 'berhasil update data');
        }
    }

    public function copyDatumDus(Request $request)
    {

        $datatuju = Datum_dusun::where(
            [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahuncopy,
                'jabatan' => $request->jabatan
            ]
        )->first();

        $dataasalnilai = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal,
            'sub_indikator_pemerintahan_id' => 5
        ])->get();

        $datatujunilai = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahuncopy,
            'sub_indikator_pemerintahan_id' => 5
        ])->first();

        $jumperangkat = 8;
        $jumdus = Datum::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal,
            'nama_data' => 'jumlah_dusun'
        ])->pluck('isidata')->first();
        $jumrt = Datum::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal,
            'nama_data' => 'jumlah_rt'
        ])->pluck('isidata')->first();
        $jumbpd = Datum::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal,
            'nama_data' => 'jumlah_bpd'
        ])->pluck('isidata')->first();

        $jumitem = $jumperangkat + intval($jumdus) + intval($jumrt) + intval($jumbpd);

        if ($request->timpadata) {
            $data = Datum_dusun::where('id', $request->id)->first();
            $data['tahun'] = $request->tahuncopy;
            $data['id'] = '';

            $timpa = Datum_dusun::create($data->toArray());
            Datum_dusun::where(
                [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahuncopy,
                    'jabatan' => $request->jabatan
                ]
            )->first()->delete();


            if ($timpa) {
                return redirect()->back()->with('success', 'Data berhasil di timpa');
            }
            exit();
            die();
        }


        if ($datatuju) {
            return back()->with('fail', "sudah ada data Kadus di tahun $request->tahuncopy");
            exit();
            die();
        }

        $data = Datum_dusun::where('id', $request->id)->first();
        $data['tahun'] = $request->tahuncopy;
        $data['id'] = '';

        // return $data->toArray();

        $copydata = Datum_dusun::create($data->toArray());
        if ($copydata) {

            if (!$datatujunilai) {

                foreach ($dataasalnilai as $datan) {
                    $datan['tahun'] = $request->tahuncopy;
                    $datan['id'] = '';
                    $datan['jumlah_data'] = 1;
                    $datan['persen_data'] = floor((1 / $jumitem) * 100);
                    $datan['perbaikan'] = true;
                    $datan['nilai_sementara'] = NULL;
                    $datan['catatan_sementara'] = NULL;
                    $datan['rekom_sementara'] = NULL;
                    $datan['nilai_akhir'] = NULL;
                    $datan['catatan_akhir'] = NULL;
                    $datan['rekom_akhir'] = NULL;
                    Nilai_pemerintahan::create($datan->toArray());
                }
            } else {

                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahuncopy,
                    'sub_indikator_pemerintahan_id' => 5
                ])->update([
                    'jumlah_data' => 1 + $datatujunilai->jumlah_data,
                    'persen_data' => floor(((1 + $datatujunilai->jumlah_data) / $jumitem) * 100),
                    'perbaikan' => true
                ]);
            }
            return redirect()->back()->with('success', 'Data berhasil di copy');
        }
    }

    public function copyDatumDusAll(Request $request)
    {

        $datatuju = Datum_dusun::where('jabatan', 'like', '%Kadus%')->where(
            [
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahuncopy

            ]
        )->count();

        $dataasalnilai = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal
        ])->where('sub_indikator_pemerintahan_id', 5)->get();

        $datatujunilai = Nilai_pemerintahan::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahuncopy
        ])->where('sub_indikator_pemerintahan_id', 5)->first();

        $jumdusawal =  Datum_dusun::where('jabatan', 'like', '%Kadus%')->where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal
        ])->get()->count();
        $jumdustuju =  Datum_dusun::where('jabatan', 'like', '%Kadus%')->where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahuncopy
        ])->get()->count();
        $selisih = intval($jumdusawal) - intval($jumdustuju);


        $jumperangkat = 8;
        $jumdus = Datum::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal,
            'nama_data' => 'jumlah_dusun'
        ])->pluck('isidata')->first();
        $jumrt = Datum::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal,
            'nama_data' => 'jumlah_rt'
        ])->pluck('isidata')->first();
        $jumbpd = Datum::where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal,
            'nama_data' => 'jumlah_bpd'
        ])->pluck('isidata')->first();

        $jumitem = $jumperangkat + intval($jumdus) + intval($jumrt) + intval($jumbpd);

        if ($request->timpadata) {
            Datum_dusun::where('jabatan', 'like', '%Kadus%')->where(
                [
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahuncopy

                ]
            )->delete();

            $datas = Datum_dusun::where('jabatan', 'like', '%Kadus%')->where([
                'asal_id' => $request->asal_id,
                'tahun' => $request->tahunasal
            ])->get();
            foreach ($datas as $data) {
                $data['tahun'] = $request->tahuncopy;
                $data['id'] = '';
                $copydata = Datum_dusun::create($data->toArray());
            }

            if ($copydata) {
                $datan['perbaikan'] = true;
                $datan['jumlah_data'] = $datatujunilai->jumlah_data + $selisih;
                $datan['persen_data'] = floor((($datatujunilai->jumlah_data + $selisih) / $jumitem) * 100);
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahuncopy,
                    'sub_indikator_pemerintahan_id' => 5
                ])->update($datan);
                return redirect()->back()->with('success', 'Data berhasil di copy');
            }

            exit();
            die();
        }

        if ($datatuju > 0) {
            return back()->with('timpaDus', $request->tahuncopy);
            exit();
            die();
        }

        $datas = Datum_dusun::where('jabatan', 'like', '%Kadus%')->where([
            'asal_id' => $request->asal_id,
            'tahun' => $request->tahunasal
        ])->get();
        foreach ($datas as $data) {
            $data['tahun'] = $request->tahuncopy;
            $data['id'] = '';
            $copydata = Datum_dusun::create($data->toArray());
        }

        if ($copydata) {

            if (!$datatujunilai) {
                foreach ($dataasalnilai as $datan) {
                    $datan['tahun'] = $request->tahuncopy;
                    $datan['id'] = '';
                    $datan['perbaikan'] = true;
                    $datan['jumlah_data'] = $jumdusawal;
                    $datan['persen_data'] = floor(($jumdusawal / $jumitem) * 100);
                    $datan['nilai_sementara'] = NULL;
                    $datan['catatan_sementara'] = NULL;
                    $datan['rekom_sementara'] = NULL;
                    $datan['nilai_akhir'] = NULL;
                    $datan['catatan_akhir'] = NULL;
                    $datan['rekom_akhir'] = NULL;
                    Nilai_pemerintahan::create($datan->toArray());
                }
            } else {
                $datan['perbaikan'] = true;
                $datan['jumlah_data'] = $datatujunilai->jumlah_data + $selisih;
                $datan['persen_data'] = floor((($datatujunilai->jumlah_data + $selisih) / $jumitem) * 100);
                Nilai_pemerintahan::where([
                    'asal_id' => $request->asal_id,
                    'tahun' => $request->tahuncopy,
                    'sub_indikator_pemerintahan_id' => 5
                ])->update($datan);
            }

            return redirect()->back()->with('success', 'Data berhasil di copy');
        }
    }
}
