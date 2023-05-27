<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Asal;
use App\Models\Aspek;
use App\Models\Indikator;
use App\Models\Catatan_pemerintahan;
use App\Models\Sub_indikator_pemerintahan;
use App\Models\Kecamatan;
use App\Models\Nilai_pemerintahan;
use App\Models\Dft_pegawai;
use App\Models\Indikator_bumd;
use App\Models\Akunadum;
use App\Models\Akunwil;
use App\Models\Akunkel;
use App\Models\Dokren;
use App\Models\Rpjmd;
use App\Models\Rapbd;
use App\Models\Apbdes_dokumen;
use App\Models\Pelaporan;
use App\Models\Catatan_apbd;
use App\Models\Catatan_keuangan;
use App\Models\Penataanbelanja_spp;
use App\Models\Penataanbelanja_bkp;
use App\Models\Pengadaan_aset;
use App\Models\Penataan_pendapatan;
use App\Models\Penataan_pembiayaan;
use App\Models\Catatan_bumd;
use App\Models\Pengadaan_asetnonlapor;
use App\Models\Kegiatan_fisik;
use App\Models\Akun_pajak;
use App\Models\Uji_petik;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class AdminIrbanwilController extends Controller
{
    public function index(Request $request)
    {

        $infos = Admin::where('id', session('loggedAdminIrbanwil'))->first();
        $dapeg = Dft_pegawai::where('nip', $infos->username)->first();

        return view('adminIrbanwil.index', [
            'infos' => $infos,
            'dapeg' => $dapeg
        ]);
    }

    public function logout(Request $request)
    {
        if (session()->has('loggedAdminDesa')) {
            session()->pull('loggedAdminDesa');
            session()->pull('loggedAdmin');
            $request->session()->invalidate();

            $request->session()->regenerateToken();
            return redirect('/');
        }
        if (session()->has('loggedAdminIrbanwil')) {
            session()->pull('loggedAdminDesa');
            session()->pull('loggedAdmin');
            session()->pull('loggedAdimIrbanwil');
            $request->session()->invalidate();

            $request->session()->regenerateToken();
            return redirect('/');
        }
    }

    public function pilObrik(Request $request)
    {

        $tahun = now()->format('Y');
        $infos = Admin::where('id', session('loggedAdminIrbanwil'))->first();
        $dapeg = Dft_pegawai::where('nip', $infos->username)->first();
        if ($infos->role == 'admin_sekretariat' || $infos->role == 'admin_irbansus') {
            $asal_id =  Asal::pluck('id')->first();
            $kecamatan = Kecamatan::all();
            $kecamatan1 = $kecamatan->pluck('nama_kecamatan')->first();
        } else {
            $asal_id =  Asal::where('obrik', $infos->obrik)->pluck('id')->first();
            $kecamatan = Kecamatan::where('obrik', $infos->obrik)->get();
            $kecamatan1 = $kecamatan->pluck('nama_kecamatan')->first();
        }

        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
            $asal_id = session()->get('asal_id');
        }
        if (session()->has('pilcam')) {
            $kecamatan1 = session()->get('pilcam');
        }
        $deswal = Asal::where('kecamatan', $kecamatan1)->get();

        $desas = Asal::where('obrik', $infos->obrik)->get();
        // return $aspeks;
        return view('adminIrbanwil.pilihObrik', [
            'infos' => $infos,
            'dapeg' => $dapeg,
            'desas' => $desas,
            'kecamatan' => $kecamatan,
            'deswal' => $deswal,
            'tahun' => $tahun

        ]);
    }


    public function penilaianAkun(Request $request)
    {

        $tahun = now()->format('Y');
        if ($request->tahun) {
            $tahun = $request->tahun;
            $request->session()->put('tahun', $request->tahun);
        }
        $infos = Admin::where('id', session('loggedAdminIrbanwil'))->first();

        if ($infos->role == 'admin_sekretariat' || $infos->role == 'admin_irbansus') {
            $asal_id =  Asal::pluck('id')->first();
            $kecamatan = Kecamatan::all();
            $kecamatan1 = $kecamatan->pluck('nama_kecamatan')->first();
        } else {
            $asal_id =  Asal::where('obrik', $infos->obrik)->pluck('id')->first();
            $kecamatan = Kecamatan::where('obrik', $infos->obrik)->get();
            $kecamatan1 = $kecamatan->pluck('nama_kecamatan')->first();
        }
        $dapeg = Dft_pegawai::where('nip', $infos->username)->first();
        $request->session()->put('pilcam', $request->kecamatan);
        $pilcam = $request->session()->get('pilcam');
        $request->session()->put('pildes', $request->desa);
        $pildes = $request->session()->get('pildes');
        $deswal = Asal::where('kecamatan', $pilcam)->get();
        $subi = Sub_indikator_pemerintahan::where('indikator_id', 4)->get();

        $asal_id = Asal::where('asal', $pildes)->pluck('id')->first();
        $request->session()->put('asal_id', $asal_id);
        $aspeks = Aspek::with('indikator', 'sub_indikator_pemerintahan', 'nilai_pemerintahan')->where('id', 1)->get();
        $aspekeu = Aspek::with('indikator', 'sub_indikator_keuangan', 'nilai_keuangan')->where('id', 2)->get();

        $progdata1 = Nilai_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 1
        ])->pluck('persen_data')->avg();
        $catatan = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 1
        ])->first();
        // return $progdata1;
        // $total = Asal::with('nilai_pemerintahan')->select('asal')->get();

        // $posts = Sub_indikator_pemerintahan::whereHas('nilai_pemerintahan', function (Builder $query) {
        //     $query->where('tahun', '2023');
        //     $query->where('persen_data', 100);
        // })->get();
        // $coba = Asal::whereRelation('nilai_pemerintahan', 'persen_data', NULL)->get();

        // return $posts;

        return view('adminIrbanwil.pilihObrik_cek', [
            'infos' => $infos,
            'dapeg' => $dapeg,
            'kecamatan' => $kecamatan,
            'pilcam' => $pilcam,
            'deswal' => $deswal,
            'pildes' => $pildes,
            'tahun' => $tahun,
            'subi' => $subi,
            'aspeks' => $aspeks,
            'aspekeu' => $aspekeu,
            'asal_id' => session()->get('asal_id'),
            'catatan' => $catatan

        ]);
    }

    public function cekObrik(Request $request)
    {
        $url =  url()->previous();
        $url = explode('?', $url);

        $asal_id = Asal::where('asal', $request->desa)->pluck('id')->first();
        $request->session()->put('tahun', $request->tahun);
        $request->session()->put('asal_id', $asal_id);
        $request->session()->put('pilcam', $request->kecamatan);
        $request->session()->put('pildes', $request->desa);
        return redirect($url[0]);
    }

    public function cariDesa(Request $request)
    {
        $desa = Asal::where('kecamatan', $request->data)->get();
        return view('adminIrbanwil.pildes', [
            'desa' => $desa
        ]);
    }

    public function profilAdmin(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $tahun = $request->tahun;
            $request->session()->put('tahun', $request->tahun);
        }
        $infos = Admin::where('id', session('loggedAdminIrbanwil'))->first();
        $dapeg = Dft_pegawai::where('nip', $infos->username)->first();

        return view('adminIrbanwil.profilAdmin.index', [
            'infos' => $infos,
            'tahun' => $tahun,
            'dapeg' => $dapeg
        ]);
    }

    public function changePass(Request $request)
    {
        $id = $request->user_id;
        $data = Admin::where('id', $id)->first();

        if ($request->password !== $data->password) {
            return back()->with('fail', 'password salah!');
        }
        if ($request->confirm !== $request->new_password) {
            return back()->with('fail', 'confirm password unmatch!');
        }

        Admin::where('id', $id)->update([
            'password' => $request->new_password
        ]);
        return back()->with('success', 'berhasil ganti password');
    }
    public function rekapitulasi()
    {
        $tahun = now()->format('Y');
        $infos = Admin::where('id', session('loggedAdminIrbanwil'))->first();

        if ($infos->role == 'admin_sekretariat' || $infos->role == 'admin_irbansus') {
            $asal_id =  Asal::pluck('id')->first();
            $kecamatan = Kecamatan::all();
            $kecamatan1 = $kecamatan->pluck('nama_kecamatan')->first();
            $asals =  Asal::where('kd_desa', '!=', null)->get();
        } else {
            $asal_id =  Asal::where('obrik', $infos->obrik)->pluck('id')->first();
            $kecamatan = Kecamatan::where('obrik', $infos->obrik)->get();
            $kecamatan1 = $kecamatan->pluck('nama_kecamatan')->first();
            $asals =  Asal::where('obrik', $infos->obrik)->get();
        }

        $aspeks = Aspek::with('indikator', 'sub_indikator_pemerintahan', 'nilai_pemerintahan')->where('id', 1)->get();
        $aspekeu = Aspek::with('indikator', 'sub_indikator_keuangan', 'nilai_keuangan')->where('id', 2)->get();


        return view('adminIrbanwil.rekapitulasi', [
            'infos' => $infos,
            'kecamatan' => $kecamatan,
            'aspeks' => $aspeks,
            'aspekeu' => $aspekeu,
            'asals' => $asals,
            'tahun' => $tahun
        ]);
    }

    public function buatSlug()
    {
        $namadesa = Admin::where('role', 'admin_desa')->pluck('username');
        foreach ($namadesa as $desa) {
            Admin::where('username', $desa)->update([
                'username' => Str::slug($desa)
            ]);
        }
        return "berhasil";
    }

    public function buatAdminKeu()
    {
        $namadesa = Admin::where('role', 'admin_desa')->get();

        foreach ($namadesa as $desa) {
            $data = [
                'asal_id' => $desa->asal_id,
                'name' => $desa->name,
                'username' => $desa->username . '-keu',
                'role' => 'admin_desa_keu',
                'obrik' => $desa->obrik,
                'password' => $desa->password,

            ];
            Admin::create($data);
        }
        return "berhasil";
    }

    public function cekProfil(Admin $data)
    {

        $tahun = now()->format('Y');

        $infos = Admin::where('id', session('loggedAdminIrbanwil'))->first();

        return view('adminIrbanwil.profilAdmin.index', [
            'infos' => $infos,
            'tahun' => $tahun,
        ]);
    }

    public function copyDapeg(Request $request)
    {
        $admins = Admin::all();
        foreach ($admins as $admin) {

            $foto = Dft_pegawai::where('nip', $admin->username)->pluck('foto')->first();
            $jabatan = Dft_pegawai::where('nip', $admin->username)->pluck('jabatan')->first();
            $pangkat = Dft_pegawai::where('nip', $admin->username)->pluck('pangkat')->first();
            $norut = Dft_pegawai::where('nip', $admin->username)->pluck('norut')->first();
            Admin::where('username', $admin->username)->update([
                'foto' => $foto,
                'jabatan' => $jabatan,
                'pangkat' => $pangkat,
                'norut' => $norut
            ]);
        }
        return "berhasil";
    }

    public function personil(Admin $data)
    {

        $tahun = now()->format('Y');
        $pegawai = Admin::where('pangkat', '!=', null)->orderBy('norut', 'ASC')->get();
        $infos = Admin::where('id', session('loggedAdminIrbanwil'))->first();
        $obrik = Asal::all();

        $inspektur = $pegawai->where('obrik', 'Inspektur')->first();

        $sekretariat = $pegawai->where('role', 'admin_sekretariat')->where('obrik', '!=', 'Inspektur');
        $irban1 = $pegawai->where('role', 'admin_irbanwil')->where('obrik', 'irban1');
        $irban2 = $pegawai->where('role', 'admin_irbanwil')->where('obrik', 'irban2');
        $irban3 = $pegawai->where('role', 'admin_irbanwil')->where('obrik', 'irban3');
        $irban4 = $pegawai->where('role', 'admin_irbanwil')->where('obrik', 'irban4');
        $irbansus = $pegawai->where('role', 'admin_irbansus')->where('obrik', 'irbansus');
        $obrik4 = $obrik->where('obrik', 'irban4');
        $obrik3 = $obrik->where('obrik', 'irban3');
        $obrik2 = $obrik->where('obrik', 'irban2');
        $obrik1 = $obrik->where('obrik', 'irban1');
        return view('adminIrbanwil.profilAdmin.personilTotal', [
            'infos' => $infos,
            'tahun' => $tahun,
            'inspektur' => $inspektur,
            'sekretariat' => $sekretariat,
            'irban1' => $irban1,
            'irban2' => $irban2,
            'irban3' => $irban3,
            'irban4' => $irban4,
            'irbansus' => $irbansus,
            'obrik4' => $obrik4,
            'obrik3' => $obrik3,
            'obrik2' => $obrik2,
            'obrik1' => $obrik1,
        ]);
    }

    public function variabel(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $tahun = $request->tahun;
            $request->session()->put('tahun', $request->tahun);
        }
        $infos = Admin::where('id', session('loggedAdminIrbanwil'))->first();
        $dapeg = Dft_pegawai::where('nip', $infos->username)->first();
        $aspeks = Aspek::all();
        $indikators = Indikator::all();
        $indBumdes = Indikator_bumd::all();

        return view('adminIrbanwil.rekapData.variabel', [
            'infos' => $infos,
            'tahun' => $tahun,
            'dapeg' => $dapeg,
            'aspeks' => $aspeks,
            'indikators' => $indikators,
            'indBumdes' => $indBumdes
        ]);
    }

    public function catatantemuan()
    {
        $tahun = now()->format('Y');
        $infos = Admin::where('id', session('loggedAdminIrbanwil'))->first();
        $dapeg = Dft_pegawai::where('nip', $infos->username)->first();
        if ($infos->role == 'admin_sekretariat' || $infos->role == 'admin_irbansus') {
            $asal_id =  Asal::pluck('id')->first();
            $kecamatan = Kecamatan::all();
            $kecamatan1 = $kecamatan->pluck('nama_kecamatan')->first();
        } else {
            $asal_id =  Asal::where('obrik', $infos->obrik)->pluck('id')->first();
            $kecamatan = Kecamatan::where('obrik', $infos->obrik)->get();
            $kecamatan1 = $kecamatan->pluck('nama_kecamatan')->first();
        }

        if (session()->has('tahun')) {
            $tahun = session()->get('tahun');
            $asal_id = session()->get('asal_id');
        }
        if (session()->has('pilcam')) {
            $kecamatan1 = session()->get('pilcam');
        }
        $deswal = Asal::where('kecamatan', $kecamatan1)->get();

        $desas = Asal::where('obrik', $infos->obrik)->get();

        // return $aspeks;
        return view('adminIrbanwil.catatantemuan.catatantemuan', [
            'infos' => $infos,
            'dapeg' => $dapeg,
            'desas' => $desas,
            'kecamatan' => $kecamatan,
            'deswal' => $deswal,
            'tahun' => $tahun

        ]);
    }
    public function catatantemuancek(Request $request)
    {

        $tahun = now()->format('Y');
        if ($request->tahun) {
            $tahun = $request->tahun;
            $request->session()->put('tahun', $request->tahun);
        }
        $infos = Admin::where('id', session('loggedAdminIrbanwil'))->first();

        $dapeg = Dft_pegawai::where('nip', $infos->username)->first();
        if ($infos->role == 'admin_sekretariat' || $infos->role == 'admin_irbansus') {
            $asal_id =  Asal::pluck('id')->first();
            $kecamatan = Kecamatan::all();
            $kecamatan1 = $kecamatan->pluck('nama_kecamatan')->first();
        } else {
            $asal_id =  Asal::where('obrik', $infos->obrik)->pluck('id')->first();
            $kecamatan = Kecamatan::where('obrik', $infos->obrik)->get();
            $kecamatan1 = $kecamatan->pluck('nama_kecamatan')->first();
        }
        $request->session()->put('pilcam', $request->kecamatan);
        $pilcam = $request->session()->get('pilcam');
        $request->session()->put('pildes', $request->desa);
        $pildes = $request->session()->get('pildes');
        $deswal = Asal::where('kecamatan', $pilcam)->get();
        $subi = Sub_indikator_pemerintahan::where('indikator_id', 4)->get();

        $asal_id = Asal::where('asal', $pildes)->pluck('id')->first();
        $request->session()->put('asal_id', $asal_id);
        $aspeks = Aspek::with('indikator', 'sub_indikator_pemerintahan', 'nilai_pemerintahan')->where('id', 1)->get();
        $aspekeu = Aspek::with('indikator', 'sub_indikator_keuangan', 'nilai_keuangan')->where('id', 2)->get();

        $progdata1 = Nilai_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 1
        ])->pluck('persen_data')->avg();
        $catatandataumum = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 1
        ])->pluck('catatan_sementara')->first();
        $sarandataumum = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 1
        ])->pluck('rekom_sementara')->first();
        $catatanadum = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 5
        ])->pluck('catatan_sementara')->first();
        $saranadum = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 5
        ])->pluck('rekom_sementara')->first();
        $adum = Akunadum::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id
        ])->get(['nama_data', 'catatan', 'saran']);

        $catatankewilayahan = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 2
        ])->pluck('catatan_sementara')->first();
        $sarankewilayahan = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 2
        ])->pluck('rekom_sementara')->first();
        $kewilayahan = Akunwil::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id
        ])->get(['nama_data', 'catatan', 'saran']);

        $catatankelembagaan = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 3
        ])->pluck('catatan_sementara')->first();
        $sarankelembagaan = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 3
        ])->pluck('rekom_sementara')->first();
        $kelembagaan = Akunkel::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id
        ])->get(['nama_data', 'catatan', 'saran']);

        $catatandokren = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 4
        ])->pluck('catatan_sementara')->first();
        $sarandokren = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 4
        ])->pluck('rekom_sementara')->first();
        $dokrenrpjmdes = Rpjmd::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
            'nama_data' => 'dokumen_rpjmd'
        ])->get(['catatan', 'saran']);
        $dokren = Dokren::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id
        ])->whereIn('nama_data', ['sk_tim_rkpdes', 'bac_musdus', 'bac_musrenbangdes', 'dokumen_rkpdes', 'tanggal_penetapan_rkpdes'])->get(['nama_data', 'catatan', 'saran']);
        $dokrenrapbd = Rapbd::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id
        ])->whereIn('nama_data', ['dokumen_rapbdes', 'bac', 'keputusan_bpd', 'evaluasi'])->get(['nama_data', 'catatan', 'saran']);
        $dokrenapbd = Apbdes_dokumen::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id
        ])->get();
        $catatanpelaporan = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 6
        ])->pluck('catatan_sementara')->first();
        $saranpelaporan = Catatan_pemerintahan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun,
            'indikator_id' => 6
        ])->pluck('rekom_sementara')->first();
        $pelaporan = Pelaporan::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id
        ])->get();


        //KEUANGAN DESA
        $apbdesumum = Catatan_apbd::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
            'nama_data' => 'murni'
        ])->pluck('catatan')->first();
        $apbdesumumperubahan = Catatan_apbd::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
            'nama_data' => 'perubahan'
        ])->pluck('catatan')->first();
        $penataanpendapatan = Catatan_keuangan::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
            'indikator_id' => 7,
        ])->get();
        $penataanbelanja = Catatan_keuangan::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
            'indikator_id' => 8,
        ])->get('uraian')->first();

        $totalbkp = Penataanbelanja_bkp::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();
        $pembiayaan = Penataan_pembiayaan::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();
        $jumlahSPP = Penataanbelanja_spp::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->pluck('jumlah')->sum();
        $pengeluaranPembiayaan = $pembiayaan->where('pembiayaan_id', '>', 6)->pluck('jumlah')->sum();
        $jumlahbkp = $totalbkp->pluck('jumlah')->sum();

        $totalSPJ = $jumlahbkp + $pengeluaranPembiayaan;
        if (!count($totalbkp)) {
            $belumSPJ = '-';
        } else {
            $belumSPJ = ($jumlahSPP + $pengeluaranPembiayaan) - $totalSPJ;
        }
        $penataanbelanjaspp = Penataanbelanja_spp::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
        ])->get();
        $temuanspp = [];
        foreach ($penataanbelanjaspp as $spp => $val) {
            if ($val->catatan || $val->rekomendasi) {
                array_push($temuanspp, $val);
            }
        }
        $penataanbelanjatbpu = Penataanbelanja_bkp::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
        ])->get();
        $temuantbpu = [];
        foreach ($penataanbelanjatbpu as $tbpu => $val) {
            if ($val->catatan_bkp || $val->rekomendasi_bkp) {
                array_push($temuantbpu, $val);
            }
        }
        $ujipetik = Uji_petik::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
        ])->get()->first();
        $penataanpembiayaan = Catatan_keuangan::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
            'indikator_id' => 9,
        ])->get();
        $kepatuhanpajak = Catatan_keuangan::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
            'indikator_id' => 10,
        ])->get();
        $belumsetor = Penataanbelanja_bkp::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->where(function ($query) {
            $query->where('ppn', '>', 0)->where('billing_ppn', '=', NULL);
            $query->orWhere('pph', '>', 0)->where('billing_pph', '=', NULL);
            $query->orWhere('lainnya', '>', 0)->where('billing_lainnya', '=', NULL);
        })->get();
        $rekon = Akun_pajak::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();
        $tatakelola = Catatan_keuangan::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
            'indikator_id' => 13,
        ])->get();

        $pilfis = Kegiatan_fisik::where([
            'asal_id' => $asal_id,
            'tahun' => $tahun
        ])->get();
        $fisik = Kegiatan_fisik::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
        ])->get();
        $pengadaanaset = Pengadaan_aset::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
        ])->get();
        $pengadaanasetnonlapor = Pengadaan_asetnonlapor::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
        ])->get();
        $pengadaanbarjas = Catatan_keuangan::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
            'indikator_id' => 11,
        ])->pluck('uraian')->first();

        $asetdesa = Catatan_keuangan::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
            'indikator_id' => 12,
        ])->get();
        $cttbumdes = Catatan_bumd::where([
            'tahun' => $tahun,
            'asal_id' => $asal_id,
        ])->get();
        return view('adminIrbanwil.catatantemuan.catatantemuancek', [
            'infos' => $infos,
            'dapeg' => $dapeg,
            'kecamatan' => $kecamatan,
            'pilcam' => $pilcam,
            'deswal' => $deswal,
            'pildes' => $pildes,
            'tahun' => $tahun,
            'subi' => $subi,
            'aspeks' => $aspeks,
            'aspekeu' => $aspekeu,
            'asal_id' => session()->get('asal_id'),
            'catatandataumum' => $catatandataumum,
            'sarandataumum' => $sarandataumum,
            'catatankewilayahan' => $catatankewilayahan,
            'catatanadum' => $catatanadum,
            'saranadum' => $saranadum,
            'adum' => $adum,
            'catatankewilayahan' => $catatankewilayahan,
            'sarankewilayahan' => $sarankewilayahan,
            'kewilayahan' => $kewilayahan,
            'catatankelembagaan' => $catatankelembagaan,
            'sarankelembagaan' => $sarankelembagaan,
            'kelembagaan' => $kelembagaan,
            'dokrenrpjmdes' => $dokrenrpjmdes,
            'catatandokren' => $catatandokren,
            'sarandokren' => $sarandokren,
            'dokren' => $dokren,
            'dokrenrapbd' => $dokrenrapbd,
            'dokrenapbd' => $dokrenapbd,
            'catatanpelaporan' => $catatanpelaporan,
            'saranpelaporan' => $saranpelaporan,
            'pelaporan' => $pelaporan,
            'apbdesumum' => $apbdesumum,
            'apbdesumumperubahan' => $apbdesumumperubahan,
            'penataanpendapatan' => $penataanpendapatan,
            'penataanbelanja' => $penataanbelanja,
            'penataanbelanjaspp' => $temuanspp,
            'penataanbelanjatbpu' => $temuantbpu,
            'ujipetik' => $ujipetik,
            'penataanpembiayaan' => $penataanpembiayaan,
            'kepatuhanpajak' => $kepatuhanpajak,
            'belumSPJ' => $belumSPJ,
            'belumsetor' => $belumsetor,
            'rekon' => $rekon,
            'tatakelola' => $tatakelola,
            'pilfis' => $pilfis,
            'fisik' => $fisik,
            'pengadaanaset' => $pengadaanaset,
            'pengadaanasetnonlapor' => $pengadaanasetnonlapor,
            'pengadaanbarjas' => $pengadaanbarjas,
            'asetdesa' => $asetdesa,
            'cttbumdes' => $cttbumdes,
        ]);
    }

    public function progressData(Request $request)
    {
        $tahun = now()->format('Y');
        if ($request->tahun) {
            $tahun = $request->tahun;
            $request->session()->put('tahun', $request->tahun);
        }
        $infos = Admin::where('id', session('loggedAdminIrbanwil'))->first();

        if ($infos->role == 'admin_sekretariat' || $infos->role == 'admin_irbansus') {
            $asals =  Asal::where('kd_desa', '!=', NULL)->get();
        } else {
            $asals =  Asal::where('obrik', $infos->obrik)->get();
        }

        return view('adminIrbanwil.rekapData.progressData', [
            'infos' => $infos,
            'tahun' => $tahun,
            'asals' => $asals

        ]);
    }
}
