<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Aspek;
use App\Models\Nilai_keuangan;
use App\Models\Nilai_pemerintahan;
use App\Models\Nilai_bumd;
use App\Models\Bumd;
use App\Models\Rekap_nilai_aspek;
use App\Models\Rekap_nilai_indikator;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function index(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $request->session()->put('tahun', $request->tahun);
        }
        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
        }

        $infos = Admin::with('asal')->where('id', session('loggedAdminDesa'))->first();

        $rekapAspek = Rekap_nilai_aspek::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();
        $dataPemerintahan = $rekapAspek->where('aspek_id', 1)->pluck('persen_data')->first();
        $dataKeuangan = $rekapAspek->where('aspek_id', 2)->pluck('persen_data')->first();

        $datnilPem = Nilai_pemerintahan::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();



        $datnilKeu = Nilai_keuangan::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();

        $datnilBumdes = Bumd::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->get();

        $dataUmum = $datnilPem->where('indikator_id', 1)->pluck('persen_data')->sum() / 5;
        $dataKewilayahan = $datnilPem->where('indikator_id', 2)->pluck('persen_data')->sum() / 6;
        $dataKelembagaan = $datnilPem->where('indikator_id', 3)->pluck('persen_data')->sum() / 8;
        $dataPerencanaan = $datnilPem->where('indikator_id', 4)->pluck('persen_data')->sum() / 14;
        $dataAdum = $datnilPem->where('indikator_id', 5)->pluck('persen_data')->sum() / 5;
        $dataPelaporan = $datnilPem->where('indikator_id', 6)->pluck('persen_data')->sum() / 5;


        $dataPemerintahan = Nilai_pemerintahan::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->pluck('persen_data')->sum();


        if (!$dataPemerintahan) {
            $dataPemerintahan = 0;
        } else {
            $dataPemerintahan = $dataPemerintahan / 43;
        }



        $dataPendapatan = $datnilKeu->where('indikator_id', 7)->pluck('persen_data')->sum() / 2;
        $dataBelanja = $datnilKeu->where('indikator_id', 8)->pluck('persen_data')->sum() / 4;
        $dataPembiayaan = $datnilKeu->where('indikator_id', 9)->pluck('persen_data')->sum() / 2;
        $dataPajak = $datnilKeu->where('indikator_id', 10)->pluck('persen_data')->sum() / 3;
        $dataBarjas = $datnilKeu->where('indikator_id', 11)->pluck('persen_data')->sum() / 4;
        $dataAset = $datnilKeu->where('indikator_id', 12)->pluck('persen_data')->sum() / 4;
        $dataKemandirian = $datnilKeu->where('indikator_id', 13)->pluck('persen_data')->sum() / 3;

        $dataKeuangan = Nilai_keuangan::where([
            'asal_id' => $infos->asal_id,
            'tahun' => $tahun
        ])->pluck('persen_data')->sum();
        if (!$dataKeuangan) {
            $dataKeuangan = 0;
        } else {
            $dataKeuangan = $dataKeuangan / 22;
        }

        $dataBankum = $datnilBumdes->where('nama_data', 'sk_kemenkum')->where('isi_data', '!=', '')->count();
        $dataBentuk = $datnilBumdes->where('nama_data', 'perdes_pembentukan')->where('isi_data', '!=', '')->count();
        $dataModal = $datnilBumdes->where('nama_data', 'perdes_modal')->where('isi_data', '!=', '')->count();
        $dataPengurus = $datnilBumdes->where('jenis', 'kepengurusan')->where('isi_data', '!=', '')->count();
        $dataPengajuan = $datnilBumdes->where('jenis', 'proposal')->where('isi_data', '!=', '')->count();
        $dataLapkeu = $datnilBumdes->where('jenis', 'laporan')->where('isi_data', '!=', '')->count();
        $dataPades = $datnilBumdes->where('jenis', 'pad')->where('isi_data', '!=', '')->count();


        return view('adminDesa.progress.index', [
            'tahun' => $tahun,
            'infos' => $infos,
            'dataUmum' => $dataUmum,
            'dataKewilayahan' => $dataKewilayahan,
            'dataKelembagaan' => $dataKelembagaan,
            'dataPerencanaan' => $dataPerencanaan,
            'dataAdum' => $dataAdum,
            'dataPelaporan' => $dataPelaporan,
            'dataPendapatan' => $dataPendapatan,
            'dataBelanja' => $dataBelanja,
            'dataPembiayaan' => $dataPembiayaan,
            'dataPajak' => $dataPajak,
            'dataBarjas' => $dataBarjas,
            'dataAset' => $dataAset,
            'dataKemandirian' => $dataKemandirian,
            'dataPemerintahan' => round($dataPemerintahan),
            'dataKeuangan' => round($dataKeuangan),
            'dataBankum' => round($dataBankum),
            'dataBentuk' => round($dataBentuk),
            'dataModal' => round($dataModal),
            'dataPengurus' => round($dataPengurus),
            'dataPengajuan' => round($dataPengajuan),
            'dataLapkeu' => round($dataLapkeu),
            'dataPades' => round($dataPades),

        ]);
    }
}
