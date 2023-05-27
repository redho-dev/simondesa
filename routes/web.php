<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RTController;
use App\Http\Controllers\BpdController;
use App\Http\Controllers\DatumController;
use App\Http\Controllers\DusunController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RpjmdController;
use App\Http\Controllers\ApbdesController;
use App\Http\Controllers\DokrenController;
use App\Http\Controllers\AkunwilController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminDesaController;
use App\Http\Controllers\PerangkatController;
use App\Http\Controllers\ApbdesPerubahanController;
use App\Http\Controllers\PenataanBelanjaController;
use App\Http\Controllers\PenataanPendapatanController;
use App\Http\Controllers\PenataanPajakController;
use App\Http\Controllers\PenataanPembiayaanController;
use App\Http\Controllers\RapbdesController;
use App\Http\Controllers\AsetkibController;
use App\Http\Controllers\AsetkirController;
use App\Http\Controllers\AsetholderController;
use App\Http\Controllers\BumdController;
use App\Http\Controllers\AdminIrbanwilController;
use App\Http\Controllers\AkunPemdesController;
use App\Http\Controllers\AkunPemdeswilController;
use App\Http\Controllers\AkunPemdeskelController;
use App\Http\Controllers\AkunPemdesdokrenController;
use App\Http\Controllers\AkunPemdesadumController;
use App\Http\Controllers\AkunpelaporanController;
use App\Http\Controllers\AkunPemdespelaporanController;
use App\Http\Controllers\AkunKeudespenataanController;
use App\Http\Controllers\AkunKeudespendapatanController;
use App\Http\Controllers\AkunKeudesbelanjaController;
use App\Http\Controllers\AkunKeudespembiayaanController;
use App\Http\Controllers\AkunKeudesbarjasController;
use App\Http\Controllers\AkunKeudespengasetController;
use App\Http\Controllers\AkunKeudespenindsetController;
use App\Http\Controllers\AkunKeudespajakController;
use App\Http\Controllers\AkunKeudeskemandirianController;
use App\Http\Controllers\AkunKeudesasetController;
use App\Http\Controllers\AkunBumdesController;
use App\Http\Controllers\SusunNhpController;
use App\Http\Controllers\LihatController;


use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\PengadaanAsetController;
use App\Http\Controllers\AkunkelController;
use App\Http\Controllers\AkunadumController;
use App\Http\Controllers\AkunasetkibaController;
use App\Http\Controllers\AkunasetkibController;
use App\Http\Controllers\AkunasetpenggunaanController;
use App\Http\Controllers\AkunasetkirController;
use App\Http\Controllers\AkunasetholderController;
use App\Http\Controllers\KemandirianController;
use App\Http\Controllers\CopyTableController;
use App\Http\Controllers\TemuanController;
use App\Http\Controllers\AkuntabilitasController;


use App\Http\Controllers\CetakController;

use App\Models\Admin;
use App\Models\Asal;
use App\Models\Aspek;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Peraturan;
use App\Models\Pengumuman;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $blog = Berita::latest()->paginate(3);
    $peraturan = Peraturan::orderBy('no_urut')->get();
    $pengumuman = Pengumuman::latest()->paginate(6);
    $galeri = Galeri::all();
    $tahun = now()->format('Y');
    $desa = Asal::where('asal', '!=', 'Inspektorat')->get();
    $aspeks = Aspek::with('indikator', 'sub_indikator_pemerintahan', 'nilai_pemerintahan')->where('id', 1)->get();
    $aspekeu = Aspek::with('indikator', 'sub_indikator_keuangan', 'nilai_keuangan')->where('id', 2)->get();

    $info = Admin::where('id', session('loggedAdmin'))->first();
    return view('beranda.utama', [
        'blogs' => $blog,
        'peraturans' => $peraturan,
        'pengumumans' => $pengumuman,
        'galeris' => $galeri,
        'desas' => $desa,
        'tahun' => $tahun,
        'aspeks' => $aspeks,
        'aspekeu' => $aspekeu,
        'infos' => $info
    ]);
});

Route::get('/allberita', [LihatController::class, 'allberita']);
Route::get('/allpengumuman', [LihatController::class, 'allpengumuman']);

// Pege Pengumuman
Route::get('/view/{id}', [LihatController::class, 'lihat']);
Route::get('/viewperaturan/{id}', [LihatController::class, 'lihatperaturan']);
Route::get('/viewpengumuman/{id}', [LihatController::class, 'lihatpengumuman']);

Route::get('/viewnilai/{id}', [LihatController::class, 'lihatnilai']);

Route::post('/masuk', [LoginController::class, 'cekMasuk']);
Route::get('/login', function () {
    return view('beranda.login');
});

// Admin Irbanwil
Route::group(['middleware' => ['AuthIrbanwil']], function () {

    Route::get('/adminIrbanwil/buatSlug', [AdminIrbanwilController::class, 'buatSlug']);
    Route::get('/adminIrbanwil/buatAdminKeu', [AdminIrbanwilController::class, 'buatAdminKeu']);
    Route::get('/adminIrbanwil/copyDapeg', [AdminIrbanwilController::class, 'copyDapeg']);

    Route::get('/adminIrbanwil', [AdminIrbanwilController::class, 'index']);
    Route::get('/adminIrbanwil/cekProfil/{data}', [AdminIrbanwilController::class, 'cekProfil']);
    Route::get('/adminIrbanwil/personil', [AdminIrbanwilController::class, 'personil']);

    Route::get('/logoutIrbanwil', [AdminIrbanwilController::class, 'logout']);
    Route::post('logoutIrbanwil', [AdminIrbanwilController::class, 'logout']);
    Route::get('/adminIrbanwil/profilAdmin', [AdminIrbanwilController::class, 'profilAdmin']);
    Route::post('/adminIrbanwil/changePass', [AdminIrbanwilController::class, 'changePass']);

    Route::get('/cariDesa', [AdminIrbanwilController::class, 'cariDesa']);
    Route::get('/adminIrbanwil/pilihObrik', [AdminIrbanwilController::class, 'pilObrik']);
    Route::post('/adminIrbanwil/pilihObrik', [AdminIrbanwilController::class, 'penilaianAkun']);
    Route::post('/adminIrbanwil/cekObrik', [AdminIrbanwilController::class, 'cekObrik']);
    Route::get('/adminIrbanwil/rekapitulasi', [AdminIrbanwilController::class, 'rekapitulasi']);
    Route::get('/adminIrbanwil/variabel', [AdminIrbanwilController::class, 'variabel']);
    Route::get('/adminIrbanwil/catatantemuan', [AdminIrbanwilController::class, 'catatantemuan']);
    Route::post('/adminIrbanwil/catatantemuan', [AdminIrbanwilController::class, 'catatantemuancek']);
    Route::get('/adminIrbanwil/progressData', [AdminIrbanwilController::class, 'progressData']);


    Route::get('/adminIrbanwil/datum', [AkunPemdesController::class, 'datum']);
    Route::get('/adminIrbanwil/kewilayahan', [AkunPemdeswilController::class, 'kewilayahan']);
    Route::get('/adminIrbanwil/kelembagaan', [AkunPemdeskelController::class, 'kelembagaan']);
    Route::get('/adminIrbanwil/dokren', [AkunPemdesdokrenController::class, 'dokren']);
    Route::get('/adminIrbanwil/adum', [AkunPemdesadumController::class, 'adum']);
    Route::get('/adminIrbanwil/pelaporan', [AkunPemdespelaporanController::class, 'pelaporan']);

    // Penilaian Pemdes
    Route::post('/adminIrbanwil/nilaiPemdes', [AkunPemdesController::class, 'nilaiPemdes']);
    Route::post('/adminIrbanwil/nilaiPemdesEdit', [AkunPemdesController::class, 'nilaiPemdesEdit']);
    Route::post('/adminIrbanwil/nilaiAkunwil', [AkunPemdeswilController::class, 'nilaiAkunwil']);
    Route::post('/adminIrbanwil/tamcaWil', [AkunPemdeswilController::class, 'tamcaWil']);
    Route::post('/adminIrbanwil/nilaiAkunwilEdit', [AkunPemdeswilController::class, 'nilaiAkunwilEdit']);
    Route::post('/adminIrbanwil/nilaiAkunkel', [AkunPemdeskelController::class, 'nilaiAkunkel']);
    Route::post('/adminIrbanwil/tamcaKel', [AkunPemdeskelController::class, 'tamcaKel']);
    Route::post('/adminIrbanwil/nilaiAkunkelEdit', [AkunPemdeskelController::class, 'nilaiAkunkelEdit']);
    Route::post('/adminIrbanwil/nilaiAkundok', [AkunPemdesdokrenController::class, 'nilaiAkundok']);
    Route::post('/adminIrbanwil/nilaiAkundokEdit', [AkunPemdesdokrenController::class, 'nilaiAkundokEdit']);
    Route::post('/adminIrbanwil/tamcaDokren', [AkunPemdesdokrenController::class, 'tamcaDokren']);

    Route::post('/adminIrbanwil/nilaiAkunadum', [AkunPemdesadumController::class, 'nilaiAkunadum']);
    Route::post('/adminIrbanwil/nilaiAkunadumEdit', [AkunPemdesadumController::class, 'nilaiAkunadumEdit']);
    Route::post('/adminIrbanwil/tamcaAdum', [AkunPemdesadumController::class, 'tamcaAdum']);

    Route::post('/adminIrbanwil/nilaiAkunpelaporan', [AkunPemdespelaporanController::class, 'nilaiAkunpelaporan']);
    Route::post('/adminIrbanwil/nilaiAkunpelaporanEdit', [AkunPemdespelaporanController::class, 'nilaiAkunpelaporanEdit']);
    Route::post('/adminIrbanwil/tamcaPel', [AkunPemdespelaporanController::class, 'tamcaPel']);

    // Keuangan Desa
    Route::get('/adminIrbanwil/cekApbdes_m', [AkunKeudespenataanController::class, 'cekApbdes_m']);
    Route::post('/adminIrbanwil/catatanApbdes', [AkunKeudespenataanController::class, 'tambahCatatan']);
    Route::post('/adminIrbanwil/catatanApbdesEdit', [AkunKeudespenataanController::class, 'editCatatan']);
    Route::get('/adminIrbanwil/cekApbdes_p', [AkunKeudespenataanController::class, 'cekApbdes_p']);
    // Penilaian Penatausahaan Pendapatan
    Route::get('/adminIrbanwil/pendapatan', [AkunKeudespendapatanController::class, 'pendapatan']);
    Route::post('/adminIrbanwil/nilaiAkunpendapatan', [AkunKeudespendapatanController::class, 'nilaiPendapatan']);
    Route::post('/adminIrbanwil/nilaiPendapatanEdit', [AkunKeudespendapatanController::class, 'nilaiPendapatanEdit']);
    //Penilaian Penatausahaan Belanja
    Route::get('/adminIrbanwil/belanja', [AkunKeudesbelanjaController::class, 'belanja']);
    Route::post('/adminIrbanwil/nilaiSPP', [AkunKeudesbelanjaController::class, 'nilaiSPP']);
    Route::post('/adminIrbanwil/nilaiTBPU', [AkunKeudesbelanjaController::class, 'nilaiTBPU']);
    Route::post('/adminIrbanwil/tambahUjipetik', [AkunKeudesbelanjaController::class, 'tambahUjipetik']);
    Route::post('/adminIrbanwil/editUjipetik', [AkunKeudesbelanjaController::class, 'editUjipetik']);
    Route::get('/adminIrbanwil/hapusUji/{id}', [AkunKeudesbelanjaController::class, 'hapusUji']);
    Route::post('/adminIrbanwil/nilaiAkunbelanja', [AkunKeudesbelanjaController::class, 'nilaiAkunbelanja']);
    Route::post('/adminIrbanwil/nilaiAkunbelanjaUpdate', [AkunKeudesbelanjaController::class, 'nilaiAkunbelanjaUpdate']);
    Route::get('/adminIrbanwil/resetTBPU', [AkunKeudesbelanjaController::class, 'resetTBPU']);
    Route::get('/adminIrbanwil/resetSPP', [AkunKeudesbelanjaController::class, 'resetSPP']);

    //Penilaian Penatausahaan Pembiayaan
    Route::get('/adminIrbanwil/pembiayaan', [AkunKeudespembiayaanController::class, 'pembiayaan']);
    Route::post('/adminIrbanwil/nilaiAkunpembiayaan', [AkunKeudespembiayaanController::class, 'nilaiAkunpembiayaan']);
    Route::post('/adminIrbanwil/nilaiAkunpembiayaanUpdate', [AkunKeudespembiayaanController::class, 'nilaiAkunpembiayaanUpdate']);

    //Penilaian Pengadaan Barjas
    Route::get('/adminIrbanwil/pembFisik', [AkunKeudesbarjasController::class, 'pembFisik']);
    Route::post('/adminIrbanwil/nilaiPembFisik', [AkunKeudesbarjasController::class, 'nilaiPembFisik']);
    Route::post('/adminIrbanwil/nilaiSurveyFisik', [AkunKeudesbarjasController::class, 'nilaiSurveyFisik']);
    Route::post('/adminIrbanwil/tambahFotoFisik', [AkunKeudesbarjasController::class, 'tambahFotoFisik']);
    Route::get('/adminIrbanwil/hapusFotoFisik', [AkunKeudesbarjasController::class, 'hapusFotoFisik']);
    Route::post('/adminIrbanwil/nilaiKegFisik', [AkunKeudesbarjasController::class, 'nilaiKegFisik']);

    Route::get('/adminIrbanwil/pengAset', [AkunKeudespengasetController::class, 'pengAset']);
    Route::post('/adminIrbanwil/pengasetNon', [AkunKeudespengasetController::class, 'pengasetNon']);
    Route::get('/adminIrbanwil/hapusNonlapor', [AkunKeudespengasetController::class, 'hapusNonlapor']);

    Route::post('/adminIrbanwil/nilaiSurveyPeralatan', [AkunKeudespengasetController::class, 'nilaiSurveyPeralatan']);
    Route::post('/adminIrbanwil/nilaiSurveyPeralatanNull', [AkunKeudespengasetController::class, 'nilaiSurveyPeralatanNull']);
    Route::post('/adminIrbanwil/nilaiPengAset', [AkunKeudespengasetController::class, 'nilaiPengAset']);
    Route::post('/adminIrbanwil/nilaiPengAsetNull', [AkunKeudespengasetController::class, 'nilaiPengAsetNull']);
    Route::get('/adminIrbanwil/penIndset', [AkunKeudespenindsetController::class, 'penIndset']);

    Route::post('/adminIrbanwil/nilaiAkunBarjas', [AkunKeudespenindsetController::class, 'nilaiAkunBarjas']);


    //Kepatuhan Pajak
    Route::get('/adminIrbanwil/pajak', [AkunKeudespajakController::class, 'pajak']);
    Route::post('/adminIrbanwil/rekonPajak', [AkunKeudespajakController::class, 'rekonPajak']);
    Route::post('/adminIrbanwil/rekonPajakUpdate', [AkunKeudespajakController::class, 'rekonPajakUpdate']);
    Route::post('/adminIrbanwil/nilaiAkunPajak', [AkunKeudespajakController::class, 'nilaiAkunPajak']);
    Route::post('/adminIrbanwil/nilaiAkunPajakUpdate', [AkunKeudespajakController::class, 'nilaiAkunPajakUpdate']);

    //Kemandirian tata kelola
    Route::get('/adminIrbanwil/kemandirian', [AkunKeudeskemandirianController::class, 'kemandirian']);
    Route::post('/adminIrbanwil/ujiSiskeudes', [AkunKeudeskemandirianController::class, 'ujiSiskeudes']);
    Route::post('/adminIrbanwil/ujiSiskeudesUpdate', [AkunKeudeskemandirianController::class, 'ujiSiskeudesUpdate']);
    Route::post('/adminIrbanwil/nilaiAkunKemandirian', [AkunKeudeskemandirianController::class, 'nilaiAkunKemandirian']);
    Route::post('/adminIrbanwil/nilaiAkunKemandirianUpdate', [AkunKeudeskemandirianController::class, 'nilaiAkunKemandirianUpdate']);


    // PENILAIAN Penataan Aset
    Route::get('/adminIrbanwil/formKIB', [AkunKeudesasetController::class, 'formKIB']);
    Route::get('/adminIrbanwil/formKIR', [AkunKeudesasetController::class, 'formKIR']);
    Route::get('/adminIrbanwil/formHolder', [AkunKeudesasetController::class, 'formHolder']);
    Route::get('/adminIrbanwil/formInventaris', [AkunKeudesasetController::class, 'formInventaris']);
    Route::get('/adminIrbanwil/penilaianPenataanAset', [AkunKeudesasetController::class, 'penilaianPenataanAset']);
    Route::post('/adminIrbanwil/nilaiAkunPenataanAset', [AkunKeudesasetController::class, 'nilaiAkunPenataanAset']);
    Route::post('/adminIrbanwil/nilaiAkunPenataanAsetUpdate', [AkunKeudesasetController::class, 'nilaiAkunPenataanAsetUpdate']);

    // PENILAIAN BUMDes
    Route::get('/adminIrbanwil/formBumdes', [AkunBumdesController::class, 'formBumdes']);
    Route::get('/adminIrbanwil/bumdesLapkeu', [AkunBumdesController::class, 'bumdesLapkeu']);
    Route::get('/adminIrbanwil/bumdesPAD', [AkunBumdesController::class, 'bumdesPAD']);
    Route::get('/adminIrbanwil/penilaianBumdes', [AkunBumdesController::class, 'penilaianBumdes']);
    Route::post('/adminIrbanwil/nilaiBumdesTambah', [AkunBumdesController::class, 'nilaiBumdesTambah']);
    Route::post('/adminIrbanwil/nilaiBumdesUpdate', [AkunBumdesController::class, 'nilaiBumdesUpdate']);

    //SUSUN NHP
    Route::get('/adminIrbanwil/susun_NHP', [SusunNhpController::class, 'susun_NHP']);




    //copy table
    Route::get('/adminIrbanwil/copyBidang', [CopyTableController::class, 'copyBidang']);
    Route::get('/adminIrbanwil/copySubBidang', [CopyTableController::class, 'copySubBidang']);
    Route::get('/adminIrbanwil/copyKegiatan', [CopyTableController::class, 'copyKegiatan']);
    Route::get('/adminIrbanwil/updateKegiatan', [CopyTableController::class, 'updateKegiatan']);
    Route::get('/adminIrbanwil/copyBelanja', [CopyTableController::class, 'copyBelanja']);
    Route::get('/adminIrbanwil/copyPendapatan', [CopyTableController::class, 'copyPendapatan']);
    Route::get('/adminIrbanwil/copyTotal', [CopyTableController::class, 'copyTotal']);
    Route::get('/adminIrbanwil/copyPembiayaan', [CopyTableController::class, 'copyPembiayaan']);

    Route::get('/adminIrbanwil/copyPenataanPendapatan', [CopyTableController::class, 'copyPenataanPendapatan']);



    //copy table pemerintahan
    Route::get('/adminIrbanwil/copyadum', [CopyTableController::class, 'copyadum']);
    Route::get('/adminIrbanwil/copykel', [CopyTableController::class, 'copykel']);
    Route::get('/adminIrbanwil/copywil', [CopyTableController::class, 'copywil']);
    Route::get('/adminIrbanwil/copybpd', [CopyTableController::class, 'copybpd']);
    Route::get('/adminIrbanwil/copydatum', [CopyTableController::class, 'copydatum']);
    Route::get('/adminIrbanwil/copydatumdusun', [CopyTableController::class, 'copydatumdusun']);
    Route::get('/adminIrbanwil/copydatumperangkat', [CopyTableController::class, 'copydatumperangkat']);
    Route::get('/adminIrbanwil/copydokren', [CopyTableController::class, 'copydokren']);
    Route::get('/adminIrbanwil/copyNilaiPemerintahan', [CopyTableController::class, 'copyNilaiPemerintahan']);
    Route::get('/adminIrbanwil/copypelaporan', [CopyTableController::class, 'copypelaporan']);
    Route::get('/adminIrbanwil/copyrapbdes', [CopyTableController::class, 'copyrapbdes']);
    Route::get('/adminIrbanwil/copyrpjmdes', [CopyTableController::class, 'copyrpjmdes']);
    Route::get('/adminIrbanwil/copyapbdesdok', [CopyTableController::class, 'copyapbdesdok']);
});

//Admin Desa
Route::group(['middleware' => ['AuthDesa']], function () {

    Route::get('/adminDesa', [AdminDesaController::class, 'index']);
    Route::post('/logoutDesa', [AdminDesaController::class, 'logout']);
    Route::get('/logoutDesa', [AdminDesaController::class, 'logout']);
    Route::get('/profildesa', [AdminDesaController::class, 'profildesa']);
    Route::get('/adminDesa/progress', [ProgressController::class, 'index']);
    Route::get('/adminDesa/catatan_temuan', [TemuanController::class, 'index']);
    Route::post('/adminDesa/catatan_temuan', [TemuanController::class, 'index']);
    Route::get('/adminDesa/nilai_akun', [AkuntabilitasController::class, 'nilai_akun']);

    Route::get('/profil', [AdminDesaController::class, 'profil']);
    Route::post('/adminDesa/ubahPassword', [AdminDesaController::class, 'ubahPassword']);



    Route::get('/adminDesa/formKewilayahan', [DatumController::class, 'formKewilayahan']);
    Route::post('/adminDesa/tambahDatumWil', [DatumController::class, 'tambahDatumWil']);
    Route::post('/adminDesa/updateDatumWil', [DatumController::class, 'updateDatumWil']);
    Route::post('/adminDesa/tambahDatumDuk', [DatumController::class, 'tambahDatumDuk']);
    Route::post('/adminDesa/updateDatumDuk', [DatumController::class, 'updateDatumDuk']);
    Route::post('/adminDesa/tambahDatumPras', [DatumController::class, 'tambahDatumPras']);
    Route::post('/adminDesa/updateDatumPras', [DatumController::class, 'updateDatumPras']);
    Route::post('/adminDesa/tambahDatumLembaga', [DatumController::class, 'tambahDatumLembaga']);
    Route::post('/adminDesa/updateDatumLembaga', [DatumController::class, 'updateDatumLembaga']);
    Route::post('/adminDesa/tambahDatumPekerjaan', [DatumController::class, 'tambahDatumPekerjaan']);
    Route::post('/adminDesa/updateDatumPekerjaan', [DatumController::class, 'updateDatumPekerjaan']);
    Route::post('/adminDesa/tambahDatumPapan', [DatumController::class, 'tambahDatumPapan']);
    Route::get('/adminDesa/hapusDatumPapan', [DatumController::class, 'hapusDatumPapan']);

    Route::post('/adminDesa/copyDatum', [DatumController::class, 'copyDatum']);
    Route::post('/adminDesa/copyDatumAll', [DatumController::class, 'copyDatumAll']);

    Route::get('/adminDesa/formPerangkat', [PerangkatController::class, 'formPerangkat']);
    Route::post('/adminDesa/tambahDatumPer', [PerangkatController::class, 'tambahDatumPer']);
    Route::post('/adminDesa/updateDatumPer', [PerangkatController::class, 'updateDatumPer']);
    Route::post('/adminDesa/copyDatumPer', [PerangkatController::class, 'copyDatumPer']);
    Route::post('/adminDesa/copyDatumPerAll', [PerangkatController::class, 'copyDatumPerAll']);

    Route::get('/adminDesa/formBPD', [BpdController::class, 'formBPD']);
    Route::post('/adminDesa/tambahDatumBpd', [BpdController::class, 'tambahDatumBpd']);
    Route::post('/adminDesa/updateDatumBpd', [BpdController::class, 'updateDatumBpd']);
    Route::post('/adminDesa/copyDatumBpdAll', [BpdController::class, 'copyDatumBpdAll']);
    Route::post('/adminDesa/copyDatumBpd', [BpdController::class, 'copyDatumBpd']);

    Route::get('/test', [BpdController::class, 'test']);


    Route::get('/adminDesa/formDusun', [DusunController::class, 'formDusun']);
    Route::post('/adminDesa/tambahDatumDus', [DusunController::class, 'tambahDatumDus']);
    Route::post('/adminDesa/updateDatumDus', [DusunController::class, 'updateDatumDus']);
    Route::post('/adminDesa/copyDatumDus', [DusunController::class, 'copyDatumDus']);
    Route::post('/adminDesa/copyDatumDusAll', [DusunController::class, 'copyDatumDusAll']);

    Route::get('/adminDesa/formRT', [RTController::class, 'formRT']);
    Route::post('/adminDesa/tambahDatumRT', [RTController::class, 'tambahDatumRT']);
    Route::post('/adminDesa/updateDatumRT', [RTController::class, 'updateDatumRT']);
    Route::post('/adminDesa/copyDatumRT', [RTController::class, 'copyDatumRT']);
    Route::post('/adminDesa/copyDatumRTAll', [RTController::class, 'copyDatumRTAll']);

    Route::get('/adminDesa/formDokren', [DokrenController::class, 'formDokren']);
    Route::post('/adminDesa/tambahDokren', [DokrenController::class, 'tambahDokren']);
    Route::post('/adminDesa/updateDokren', [DokrenController::class, 'updateDokren']);
    Route::post('/adminDesa/tambahRenfisik', [DokrenController::class, 'tambahRenfisik']);
    Route::post('/adminDesa/tambahRenfisik', [DokrenController::class, 'tambahRenfisik']);
    Route::post('/adminDesa/updateRenfisik', [DokrenController::class, 'updateRenfisik']);
    Route::post('/adminDesa/tambahBlt', [DokrenController::class, 'tambahBlt']);
    Route::post('/adminDesa/updateBlt', [DokrenController::class, 'updateBlt']);

    Route::get('/adminDesa/formRapbdes', [RapbdesController::class, 'formRapbdes']);
    Route::post('/adminDesa/doktambah', [RapbdesController::class, 'doktambah']);
    Route::post('/adminDesa/dokupdate', [RapbdesController::class, 'dokupdate']);
    Route::post('/adminDesa/dokupdate', [RapbdesController::class, 'dokupdate']);


    Route::get('/adminDesa/formAkunwil', [AkunwilController::class, 'formAkunwil']);
    Route::post('/adminDesa/tambahAkunwil', [AkunwilController::class, 'tambahAkunwil']);
    Route::post('/adminDesa/updateAkunwil', [AkunwilController::class, 'updateAkunwil']);
    Route::post('/adminDesa/copyAkunwil', [AkunwilController::class, 'copyAkunwil']);

    Route::get('/adminDesa/formAkunkel', [AkunkelController::class, 'formAkunkel']);
    Route::post('/adminDesa/tambahAkunkel', [AkunkelController::class, 'tambahAkunkel']);
    Route::post('/adminDesa/updateAkunkel', [AkunkelController::class, 'updateAkunkel']);
    Route::post('/adminDesa/copyAkunkel', [AkunkelController::class, 'copyAkunkel']);

    Route::get('/adminDesa/formAkunadum', [AkunadumController::class, 'formAkunadum']);
    Route::post('/adminDesa/tambahAkunadum', [AkunadumController::class, 'tambahAkunadum']);
    Route::post('/adminDesa/updateAkunadum', [AkunadumController::class, 'updateAkunadum']);
    Route::post('/adminDesa/copyAkunadum', [AkunadumController::class, 'copyAkunadum']);

    Route::get('/adminDesa/formAkunpelaporan', [AkunpelaporanController::class, 'formAkunpelaporan']);
    Route::post('/adminDesa/tambahAkunpelaporan', [AkunpelaporanController::class, 'tambahAkunpelaporan']);
    Route::post('/adminDesa/updateAkunpelaporan', [AkunpelaporanController::class, 'updateAkunpelaporan']);
    Route::post('/adminDesa/laporanTambah', [AkunpelaporanController::class, 'laporanTambah']);
    Route::post('/adminDesa/laporanEdit', [AkunpelaporanController::class, 'laporanEdit']);
    Route::get('/adminDesa/hapusLaporan/{id}', [AkunpelaporanController::class, 'hapusLaporan']);

    //===ASET====// 


    Route::get('/adminDesa/formKIB', [AsetkibController::class, 'formKIB']);
    Route::post('/adminDesa/tambahAset', [AsetkibController::class, 'tambahAset']);
    Route::post('/adminDesa/editAset', [AsetkibController::class, 'editAset']);
    Route::post('/adminDesa/hapusAset', [AsetkibController::class, 'hapusAset']);
    Route::post('/adminDesa/cetakAset', [AsetkibController::class, 'cetakAset']);
    Route::post('/adminDesa/copyAsetAll', [AsetkibController::class, 'copyAsetAll']);

    Route::get('/adminDesa/formKIR', [AsetkirController::class, 'formKIR']);
    Route::post('/adminDesa/tambahKIR', [AsetkirController::class, 'tambahKIR']);
    Route::post('/adminDesa/editKIR', [AsetkirController::class, 'editKIR']);
    Route::get('/adminDesa/hapusKIR/{id}', [AsetkirController::class, 'hapusKIR']);
    Route::post('/adminDesa/copyKIRAll', [AsetkirController::class, 'copyKIRAll']);

    Route::get('/adminDesa/formHolder', [AsetholderController::class, 'formHolder']);
    Route::post('/adminDesa/tambahHolder', [AsetholderController::class, 'tambahHolder']);
    Route::post('/adminDesa/editHolder', [AsetholderController::class, 'editHolder']);
    Route::get('/adminDesa/hapusHolder/{id}', [AsetholderController::class, 'hapusHolder']);
    Route::post('/adminDesa/copyHolderAll', [AsetholderController::class, 'copyHolderAll']);
    Route::get('/adminDesa/formBenbar', [AsetholderController::class, 'formBenbar']);
    Route::post('/adminDesa/tambahBenbar', [AsetholderController::class, 'tambahBenbar']);
    Route::post('/adminDesa/editBenbar', [AsetholderController::class, 'editBenbar']);
    Route::post('/adminDesa/copyBenbar', [AsetholderController::class, 'copyBenbar']);

    Route::get('/adminDesa/formInventaris', [AsetkibController::class, 'formInventaris']);
    Route::post('/adminDesa/cetakInventaris', [AsetkibController::class, 'cetakInventaris']);

    // BUM DESA

    Route::get('/adminDesa/formBumdes', [BumdController::class, 'formBumdes']);
    Route::post('/adminDesa/pendirianTambah', [BumdController::class, 'pendirianTambah']);
    Route::post('/adminDesa/pendirianEdit', [BumdController::class, 'pendirianEdit']);
    Route::post('/adminDesa/pengurusTambah', [BumdController::class, 'pengurusTambah']);
    Route::get('/adminDesa/hapusPengurus/{id}', [BumdController::class, 'hapusPengurus']);
    Route::post('/adminDesa/copyPendirian', [BumdController::class, 'copyPendirian']);

    Route::get('/adminDesa/bumdesLapkeu', [BumdController::class, 'bumdesLapkeu']);
    Route::post('/adminDesa/dasarTambah', [BumdController::class, 'dasarTambah']);
    Route::post('/adminDesa/dasarEdit', [BumdController::class, 'dasarEdit']);
    Route::post('/adminDesa/lapkeubumdesTambah', [BumdController::class, 'lapkeubumdesTambah']);
    Route::get('/adminDesa/hapusLapkeubumdes/{id}', [BumdController::class, 'hapusLapkeubumdes']);
    Route::post('/adminDesa/copyLapkeubumdes', [BumdController::class, 'copyLapkeubumdes']);


    Route::get('/adminDesa/bumdesPAD', [BumdController::class, 'bumdesPAD']);
    Route::post('/adminDesa/tambahPAD', [BumdController::class, 'tambahPAD']);
    Route::get('/adminDesa/hapusSetorPAD/{id}', [BumdController::class, 'hapusSetorPAD']);
    Route::post('/adminDesa/copyPADbumdes', [BumdController::class, 'copyPADbumdes']);
    Route::post('/adminDesa/proposalTambah', [BumdController::class, 'proposalTambah']);



    Route::get('/adminDesa/formRpjmd', [RpjmdController::class, 'formRpjmd']);
    Route::post('/adminDesa/tambahRpjmd', [RpjmdController::class, 'tambahRpjmd']);
    Route::post('/adminDesa/updateRpjmd', [RpjmdController::class, 'updateRpjmd']);
    Route::post('/adminDesa/tambahVisimisi', [RpjmdController::class, 'tambahVisimisi']);
    Route::get('/adminDesa/deleteVisimisi/{id}', [RpjmdController::class, 'deleteVisimisi']);
    Route::post('/adminDesa/updateVisimisi', [RpjmdController::class, 'updateVisimisi']);
    Route::post('/adminDesa/copyRpjmdesAll', [RpjmdController::class, 'copyRpjmdesAll']);

    Route::post('/adminDesa/updateTambahPotensi', [RpjmdController::class, 'updateTambahPotensi']);
    Route::post('/adminDesa/updateUbahPotensi', [RpjmdController::class, 'updateUbahPotensi']);
    Route::post('/adminDesa/hapusPotensi', [RpjmdController::class, 'hapusPotensi']);

    Route::group(['middleware' => ['AuthKeudes']], function () {

        // APBDes
        Route::get('/adminDesa/formApbdes', [ApbdesController::class, 'formApbdes']);
        Route::post('/adminDesa/tambahKegiatanA', [ApbdesController::class, 'tambahKegiatanA']);
        Route::post('/adminDesa/updateKegiatanA', [ApbdesController::class, 'updateKegiatanA']);
        Route::post('/adminDesa/cekKegiatanA', [ApbdesController::class, 'cekKegiatanA']);
        Route::post('/adminDesa/cekUpdateKegiatanA', [ApbdesController::class, 'cekUpdateKegiatanA']);
        Route::post('/adminDesa/tambahPendapatanA', [ApbdesController::class, 'tambahPendapatanA']);
        Route::post('/adminDesa/updatePendapatanA', [ApbdesController::class, 'updatePendapatanA']);
        Route::post('/adminDesa/tambahPembiayaanA', [ApbdesController::class, 'tambahPembiayaanA']);
        Route::post('/adminDesa/updatePembiayaanA', [ApbdesController::class, 'updatePembiayaanA']);
        Route::post('/adminDesa/tambahDokumenA', [ApbdesController::class, 'tambahDokumenA']);
        Route::post('/adminDesa/updateDokumenA', [ApbdesController::class, 'updateDokumenA']);
        Route::post('/adminDesa/tambahBelanjaA', [ApbdesController::class, 'tambahBelanjaA']);
        Route::post('/adminDesa/updateBelanjaA', [ApbdesController::class, 'updateBelanjaA']);
        //Apbdes Perubahan
        Route::get('/adminDesa/formApbdesP', [ApbdesPerubahanController::class, 'formApbdesP']);
        Route::post('/adminDesa/tambahPendapatanP', [ApbdesPerubahanController::class, 'tambahPendapatanP']);
        Route::post('/adminDesa/tambahBelanjaP', [ApbdesPerubahanController::class, 'tambahBelanjaP']);
        Route::post('/adminDesa/tambahKegiatanP', [ApbdesPerubahanController::class, 'tambahKegiatanP']);
        Route::post('/adminDesa/tambahDokumenP', [ApbdesPerubahanController::class, 'tambahDokumenP']);
        Route::post('/adminDesa/cekKegiatanP', [ApbdesPerubahanController::class, 'cekKegiatanP']);
        Route::post('/adminDesa/tambahPembiayaanP', [ApbdesPerubahanController::class, 'tambahPembiayaanP']);
        //Penataan Pendapatan
        Route::get('/adminDesa/formPenataanPendapatan', [PenataanPendapatanController::class, 'formPenataanPendapatan']);
        Route::post('/adminDesa/tambahPengajuan', [PenataanPendapatanController::class, 'tambahPengajuan']);
        Route::post('/adminDesa/updatePengajuan', [PenataanPendapatanController::class, 'updatePengajuan']);
        Route::get('/adminDesa/deletePengajuan/{id}', [PenataanPendapatanController::class, 'deletePengajuan']);
        Route::post('/adminDesa/tambahBukuBank', [PenataanPendapatanController::class, 'tambahBukuBank']);
        Route::post('/adminDesa/updateBukuBank', [PenataanPendapatanController::class, 'updateBukuBank']);
        Route::post('/adminDesa/bukuBankTambah', [PenataanPendapatanController::class, 'bukuBankTambah']);
        Route::post('/adminDesa/bukuBankEdit', [PenataanPendapatanController::class, 'bukuBankEdit']);
        Route::get('/adminDesa/hapusBukubank/{data}', [PenataanPendapatanController::class, 'hapusBukubank']);
        // Penataan Belanja
        Route::get('/adminDesa/formPenataanBelanja', [PenataanBelanjaController::class, 'formPenataanBelanja']);
        Route::post('/adminDesa/tambahSPP', [PenataanBelanjaController::class, 'tambahSPP']);
        Route::post('/adminDesa/tambahTBPU', [PenataanBelanjaController::class, 'tambahTBPU']);
        Route::post('/adminDesa/updateTBPU', [PenataanBelanjaController::class, 'updateTBPU']);
        Route::post('/adminDesa/hapusTBPU/{id}', [PenataanBelanjaController::class, 'hapusTBPU']);
        Route::get('/adminDesa/cekDokTbpu', [PenataanBelanjaController::class, 'cekDokTbpu']);
        Route::get('/adminDesa/cekDokSPP', [PenataanBelanjaController::class, 'cekDokSPP']);
        Route::post('/adminDesa/updateSPP', [PenataanBelanjaController::class, 'updateSPP']);
        Route::post('/adminDesa/hapusSPP/{id}', [PenataanBelanjaController::class, 'hapusSPP']);
        Route::get('/adminDesa/cariSPP', [PenataanBelanjaController::class, 'cariSPP']);
        Route::post('/adminDesa/pembukuanTambah', [PenataanBelanjaController::class, 'pembukuanTambah']);
        Route::post('/adminDesa/pembukuanEdit', [PenataanBelanjaController::class, 'pembukuanEdit']);
        Route::get('/adminDesa/hapusPembukuan/{data}', [PenataanBelanjaController::class, 'hapusPembukuan']);
        // Penataan Pembiayaan
        Route::get('/adminDesa/formPenataanPembiayaan', [PenataanPembiayaanController::class, 'formPenataanPembiayaan']);
        Route::post('/adminDesa/tambahDapemb', [PenataanPembiayaanController::class, 'tambahDapemb']);
        Route::post('/adminDesa/hapusBuktiPenPemb', [PenataanPembiayaanController::class, 'hapusBuktiPenPemb']);
        Route::post('/adminDesa/tambahPengPemb', [PenataanPembiayaanController::class, 'tambahPengPemb']);

        //PENGADAAN BARANG DAN JASA
        Route::get('/adminDesa/realisasiPemb', [PengadaanController::class, 'realisasiPemb']);
        Route::post('/adminDesa/kegfisikTambah', [PengadaanController::class, 'kegfisikTambah']);
        Route::get('/adminDesa/cekKegfis', [PengadaanController::class, 'cekKegfis']);
        Route::get('/adminDesa/hapusKegfis', [PengadaanController::class, 'hapusKegfis']);
        Route::post('/adminDesa/tambahRealisasiFisik', [PengadaanController::class, 'tambahRealisasiFisik']);
        Route::post('/adminDesa/updateRealisasiFisik', [PengadaanController::class, 'updateRealisasiFisik']);

        Route::post('/adminDesa/tambahLaporPemb', [PengadaanController::class, 'tambahLaporPemb']);
        Route::post('/adminDesa/updateLaporPemb', [PengadaanController::class, 'updateLaporPemb']);
        Route::post('/adminDesa/tambahSurveymaterial', [PengadaanController::class, 'tambahSurveymaterial']);
        Route::post('/adminDesa/updateSurveymaterial', [PengadaanController::class, 'updateSurveymaterial']);

        Route::get('/adminDesa/pengadaanAset', [PengadaanAsetController::class, 'pengadaanAset']);
        Route::post('/adminDesa/tambahBelanjaAset', [PengadaanAsetController::class, 'tambahBelanjaAset']);
        Route::post('/adminDesa/tambahSurveyperalatan', [PengadaanAsetController::class, 'tambahSurveyperalatan']);
        Route::post('/adminDesa/updateSurveyperalatan', [PengadaanAsetController::class, 'updateSurveyperalatan']);
        Route::post('/adminDesa/tambahRabAset', [PengadaanAsetController::class, 'tambahRabAset']);
        Route::post('/adminDesa/tambahFotoBarang', [PengadaanAsetController::class, 'tambahFotoBarang']);
        Route::post('/adminDesa/hapusFotoBarang', [PengadaanAsetController::class, 'hapusFotoBarang']);
        Route::get('/adminDesa/hapusBelanjaAset', [PengadaanAsetController::class, 'hapusBelanjaAset']);


        //PENATAAN PAJAK

        Route::get('/adminDesa/formPenataanPajak', [PenataanPajakController::class, 'formPenataanPajak']);
        Route::post('/adminDesa/tambahBilling', [PenataanPajakController::class, 'tambahBilling']);
        Route::post('/adminDesa/hapusBilling', [PenataanPajakController::class, 'hapusBilling']);
        Route::post('/adminDesa/tambahBPP', [PenataanPajakController::class, 'tambahBPP']);
        Route::post('/adminDesa/updateBPP', [PenataanPajakController::class, 'updateBPP']);

        //Kemandirian Tata Kelola
        Route::get('/adminDesa/formKemandirian', [KemandirianController::class, 'formKemandirian']);
        Route::post('/adminDesa/updatePernyataan', [KemandirianController::class, 'updatePernyataan']);
        Route::post('/adminDesa/hapusPernyataan', [KemandirianController::class, 'hapusPernyataan']);
        Route::post('/adminDesa/hapusSertifikat', [KemandirianController::class, 'hapusSertifikat']);
        Route::post('/adminDesa/updateSertifikat', [KemandirianController::class, 'updateSertifikat']);
        Route::post('/adminDesa/copyKemandirian', [KemandirianController::class, 'copyKemandirian']);
    });










    //Penataan Pembiayaan





});


Route::get('/register', [RegisterController::class, 'index']);
Route::get('/register/tambah', [RegisterController::class, 'formTambah']);
Route::post('/register/store', [RegisterController::class, 'store']);
Route::post('/register/delete/{data}', [RegisterController::class, 'delete']);
