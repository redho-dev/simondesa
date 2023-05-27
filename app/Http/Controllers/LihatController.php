<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Asal;
use App\Models\Aspek;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Galeri;
use App\Models\Datum;
use App\Models\Apbdes_pendapatan;
use App\Models\Total_apbd;
use App\Models\Apbdes_belanjaakun;
use App\Models\Apbdes_pembiayaan;

class LihatController extends Controller
{
    public function viewapbdes()
    {
        $data['kecamatans'] = Asal::where('kecamatan', '!=', '')
            ->orderBy('kecamatan')
            ->distinct()
            ->get('kecamatan');

        $data['desas'] = Asal::where('kecamatan', '!=', '')
            ->orderBy('asal')
            ->get();

        return view('beranda.apbdes.apbdes', $data);
    }

    public function lihatapbdes(Request $request)
    {
        $asal = Asal::where('kecamatan', '!=', '')
            ->orderBy('kecamatan')
            ->get();
        $pendapatans = Apbdes_pendapatan::where([
            'asal_id' => $request->desa,
            'tahun' => $request->tahun
        ])->get();
        $total = Total_apbd::where([
            'asal_id' => $request->desa,
            'tahun' => $request->tahun
        ])->first();

        $belanja = Apbdes_belanjaakun::with('belanja')->where([
            'asal_id' => $request->desa,
            'tahun' => $request->tahun
        ])->get();

        $pembiayaan = Apbdes_pembiayaan::where([
            'asal_id' => $request->desa,
            'tahun' => $request->tahun
        ])->get();

        // return $asal;
        return view('beranda.apbdes.viewapbdes', [
            'asals' => $asal,
            'pendapatans' => $pendapatans,
            'totals' => $total,
            'belanjas' => $belanja,
            'pembiayaans' => $pembiayaan,

        ]);
    }

    public function lihatnilai(Request $request)
    {
        $desa = Asal::where([
            'id' => $request->id
        ])->get();

        $tahun = date('Y');

        $aspeks = Aspek::with('indikator', 'sub_indikator_pemerintahan', 'nilai_pemerintahan')->where('id', 1)->get();
        $aspekeu = Aspek::with('indikator', 'sub_indikator_keuangan', 'nilai_keuangan')->where('id', 2)->get();

        foreach ($aspeks as $as) {
            $pemdes = $as->rekap_nilai_aspek->where('asal_id', $request->id)->where('tahun', $tahun)->where('aspek_id', 1)->pluck('skor')->first();
        }

        foreach ($aspekeu as $ask) {
            $keudes = $ask->rekap_nilai_aspek->where('asal_id', $request->id)->where('tahun', $tahun)->where('aspek_id', 2)->pluck('skor')->first();
        }

        $pemerintahan = $pemdes + $keudes;

        foreach ($desa as $ds) {
            $asal_id = $ds->id;
        }

        return view('beranda.viewnilai', [
            'asal_id' => $asal_id,
            'desas' => $desa,
            'aspeks' => $aspeks,
            'aspekeu' => $aspekeu,
            'pemerintahan' => $pemerintahan,
            'tahun' => $tahun
        ]);
    }

    public function lihat($id)
    {
        $article = DB::table('beritas')->where('id', $id)->first();
        return view('beranda.view', ['article' => $article]);
    }

    public function lihatperaturan($id)
    {
        $article = DB::table('peraturans')->where('id', $id)->first();
        return view('beranda.viewperaturan', ['article' => $article]);
    }

    public function lihatpengumuman($id)
    {
        $article = DB::table('pengumumans')->where('id', $id)->first();
        return view('beranda.viewpengumuman', ['article' => $article]);
    }

    public function allberita()
    {
        $berita = Berita::all();
        return view('beranda.allberita',  [
            'berita' => $berita
        ]);
    }

    public function allpengumuman()
    {
        $pengumuman = Pengumuman::all();
        return view('beranda.allpengumuman',  [
            'pengumuman' => $pengumuman
        ]);
    }
}
