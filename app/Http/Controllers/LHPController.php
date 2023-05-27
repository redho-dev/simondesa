<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Asal;
use App\Models\Bpd;
use App\Models\Datum_perangkat;
use App\Models\Kecamatan;
use App\Models\Rpjmd;
use App\Models\Dokren;
use App\Models\Apbdes;
use App\Models\Apbdes_dokumen;
use App\Models\Apbdes_pendapatan;
use App\Models\Apbdes_belanjaakun;
use App\Models\Apbdes_pembiayaan;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;

class LHPController extends Controller
{
    public function index()
    {
        $tahun = now()->format('Y');
        $infos = Admin::where('id', session('loggedAdminIrbanwil'))->first();
        $asal_id =  Asal::where('obrik', $infos->obrik)->pluck('id')->first();
        $kecamatan = Kecamatan::where('obrik', $infos->obrik)->get();
        $kecamatan1 = $kecamatan->pluck('nama_kecamatan')->first();

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
        return view('adminIrbanwil.lhp.lhp', [
            'infos' => $infos,
            'desas' => $desas,
            'kecamatan' => $kecamatan,
            'deswal' => $deswal,
            'tahun' => $tahun

        ]);
    }

    public function lhpdesa(Request $request)
    {
        function rupiah($angka)
        {
            $hasil_rupiah = number_format($angka, 0, ',', '.');
            return $hasil_rupiah;
        }
        $asal_id = Asal::where([
            'asal' => $request->desa,
            'kecamatan' => $request->kecamatan
        ])->get();
        $infos = Admin::where('id', session('loggedAdminIrbanwil'))->first();
        if ($infos->obrik == 'irban1') {
            $irban = '1';
        } elseif ($infos->obrik == 'irban2') {
            $irban = '2';
        } elseif ($infos->obrik == 'irban3') {
            $irban = '3';
        } else {
            $irban = '4';
        }

        //VISI & MISI
        $no_urut = array('a.', 'b.', 'c.');
        $RpjmdAll = Rpjmd::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun
        ])->get();
        $visi = $RpjmdAll->where('nama_data', 'visi');
        $misi = Rpjmd::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
        ])->where('nama_data', 'like', '%' . 'misi' . '%')->get('uraian');
        foreach ($misi as $m => $val) {
            $ms[] = $val['uraian'];
            $no_misi[] = $no_urut[$m];
        }

        //Perangkat Desa
        $data_kades = Datum_perangkat::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'jabatan' => 'Kepala Desa'
        ]);
        $data_sekdes = Datum_perangkat::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'jabatan' => 'Sekretaris Desa'
        ]);
        $data_keuangan = Datum_perangkat::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'jabatan' => 'Kaur Keuangan'
        ]);
        $data_perencanaan = Datum_perangkat::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'jabatan' => 'Kaur Perencanaan'
        ]);
        $data_umum = Datum_perangkat::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'jabatan' => 'Kaur Umum'
        ]);
        $data_pemerintahan = Datum_perangkat::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'jabatan' => 'Kasi Pemerintahan'
        ]);
        $data_kesra = Datum_perangkat::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'jabatan' => 'Kasi Kesra'
        ]);
        $data_pelayanan = Datum_perangkat::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'jabatan' => 'Kasi Pelayanan'
        ]);

        $kades = $data_kades->pluck('nama')->first();
        $sk_kades = $data_kades->pluck('nomor_sk')->first();
        $tgl_sk_kades = $data_kades->pluck('sejak')->first();
        $sekdes = $data_sekdes->pluck('nama')->first();
        $sk_sekdes = $data_sekdes->pluck('nomor_sk')->first();
        $tgl_sk_sekdes = $data_sekdes->pluck('sejak')->first();
        $keuangan = $data_keuangan->pluck('nama')->first();
        $sk_keuangan = $data_keuangan->pluck('nomor_sk')->first();
        $tgl_sk_keuangan = $data_keuangan->pluck('sejak')->first();
        $perencanaan = $data_perencanaan->pluck('nama')->first();
        $sk_perencanaan = $data_perencanaan->pluck('nomor_sk')->first();
        $tgl_sk_perencanaan = $data_perencanaan->pluck('sejak')->first();
        $umum = $data_umum->pluck('nama')->first();
        $sk_umum = $data_umum->pluck('nomor_sk')->first();
        $tgl_sk_umum = $data_umum->pluck('sejak')->first();
        $pemerintahan = $data_pemerintahan->pluck('nama')->first();
        $sk_pemerintahan = $data_pemerintahan->pluck('nomor_sk')->first();
        $tgl_sk_pemerintahan = $data_pemerintahan->pluck('sejak')->first();
        $kesra = $data_kesra->pluck('nama')->first();
        $sk_kesra = $data_kesra->pluck('nomor_sk')->first();
        $tgl_sk_kesra = $data_kesra->pluck('sejak')->first();
        $pelayanan = $data_pelayanan->pluck('nama')->first();
        $sk_pelayanan = $data_pelayanan->pluck('nomor_sk')->first();
        $tgl_sk_pelayanan = $data_pelayanan->pluck('sejak')->first();

        //BPD
        $data_ketua_bpd = Bpd::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'jabatan' => 'ketua_bpd'
        ]);
        $data_wakil_bpd = Bpd::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'jabatan' => 'wakil_ketua_bpd'
        ]);
        $data_sekretaris_bpd = Bpd::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'jabatan' => 'sekretaris_bpd'
        ]);

        $data_anggota_bpd = Bpd::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
        ])->where('jabatan', 'like', '%anggota%')->get(['nama', 'nomor_sk', 'sejak']);

        $ket_anggota_bpd = array('Anggota', 'Nomor dan Tanggal SK');
        $kutip = array(':');
        $strip = array('-');
        foreach ($data_anggota_bpd as $anggota => $val) {
            $anggota_bpd[] = $val['nama'];
            array_push($anggota_bpd, $val['nomor_sk'] . ',', 'Tanggal ' . $val['sejak'], '');
            $ket_anggota[] = $ket_anggota_bpd[0];
            array_push($ket_anggota, $ket_anggota_bpd[1], '', '');
            $ket_kutip[] = $kutip[0];
            array_push($ket_kutip, $kutip[0], '', '');
            $ket_strip[] = $strip[0];
            array_push($ket_strip, '', '', '');
        }

        $ketuabpd = $data_ketua_bpd->pluck('nama')->first();
        $sk_ketuabpd = $data_ketua_bpd->pluck('nomor_sk')->first();
        $tgl_sk_ketuabpd = $data_ketua_bpd->pluck('sejak')->first();
        $wakil_bpd = $data_wakil_bpd->pluck('nama')->first();
        $sk_wakil_bpd = $data_wakil_bpd->pluck('nomor_sk')->first();
        $tgl_sk_wakil_bpd = $data_wakil_bpd->pluck('sejak')->first();
        $sekretaris_bpd = $data_sekretaris_bpd->pluck('nama')->first();
        $sk_sekretaris_bpd = $data_sekretaris_bpd->pluck('nomor_sk')->first();
        $tgl_sk_sekretaris_bpd = $data_sekretaris_bpd->pluck('sejak')->first();

        //Dokumen Perencanaan
        $sejak_rpjmd = Rpjmd::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'nama_data' => 'sejak'
        ])->pluck('sejak')->first();

        $sampai_rpjmd = Rpjmd::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'nama_data' => 'sampai'
        ])->pluck('sampai')->first();

        $no_rpjmd = Rpjmd::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'nama_data' => 'nomor_rpjmd'
        ])->pluck('uraian')->first();

        $tgl_rpjmd = Rpjmd::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'nama_data' => 'tanggal_penetapan_rpjmd'
        ])->pluck('uraian')->first();

        $no_rkpdes = Dokren::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'nama_data' => 'nomor_rkpdes'
        ])->pluck('isidata')->first();

        $th_rkpdes = Dokren::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'nama_data' => 'dokumen_rkpdes'
        ])->pluck('tahun')->first();

        $tgl_rkpdes = Dokren::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'nama_data' => 'tanggal_penetapan_rkpdes'
        ])->pluck('isidata')->first();

        $th_apbdes = Apbdes_dokumen::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
        ])->pluck('tahun')->first();

        $no_apbdes = Apbdes_dokumen::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
        ])->pluck('nomor_perdes_murni')->first();

        $tgl_apbdes = Apbdes_dokumen::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
        ])->pluck('tanggal_murni')->first();

        //APBDES Murni
        $padm = Apbdes_pendapatan::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'kode_pendapatan' => '4.1'
        ])->pluck('anggaran_murni')->first();
        if ($padm < 0) {
            $rupiah_padm = rupiah(0);
        } else {
            $rupiah_padm = rupiah($padm);
        }

        $ptm = Apbdes_pendapatan::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'kode_pendapatan' => '4.2'
        ])->pluck('anggaran_murni')->first();
        if ($ptm < 0) {
            $rupiah_ptm = rupiah(0);
        } else {
            $rupiah_ptm = rupiah($ptm);
        }

        $ddm = Apbdes_pendapatan::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'kode_pendapatan' => '4.2.1'
        ])->pluck('anggaran_murni')->first();
        if ($ddm < 0) {
            $rupiah_ddm = rupiah(0);
        } else {
            $rupiah_ddm = rupiah($ddm);
        }

        $dbhm = Apbdes_pendapatan::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'kode_pendapatan' => '4.2.2'
        ])->pluck('anggaran_murni')->first();
        if ($dbhm < 0) {
            $rupiah_dbhm = rupiah(0);
        } else {
            $rupiah_dbhm = rupiah($dbhm);
        }

        $addm = Apbdes_pendapatan::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'kode_pendapatan' => '4.2.3'
        ])->pluck('anggaran_murni')->first();
        if ($addm < 0) {
            $rupiah_addm = rupiah(0);
        } else {
            $rupiah_addm = rupiah($addm);
        }

        $bpm = Apbdes_pendapatan::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'kode_pendapatan' => '4.2.4'
        ])->pluck('anggaran_murni')->first();
        if ($bpm < 0) {
            $rupiah_bpm = rupiah(0);
        } else {
            $rupiah_bpm = rupiah($bpm);
        }

        $bkm = Apbdes_pendapatan::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'kode_pendapatan' => '4.2.5'
        ])->pluck('anggaran_murni')->first();
        if ($bkm < 0) {
            $rupiah_bkm = rupiah(0);
        } else {
            $rupiah_bkm = rupiah($bkm);
        }

        $plm = Apbdes_pendapatan::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'kode_pendapatan' => '4.3'
        ])->pluck('anggaran_murni')->first();
        if ($plm < 0) {
            $rupiah_plm = rupiah(0);
        } else {
            $rupiah_plm = rupiah($plm);
        }

        $tpm = (int)$padm + (int)$ptm + (int)$plm;
        if ($tpm < 0) {
            $rupiah_tpm = rupiah(0);
        } else {
            $rupiah_tpm = rupiah($tpm);
        }

        $bpgwm = Apbdes_belanjaakun::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'belanja_id' => '1'
        ])->pluck('anggaran_murni')->first();
        if ($bpgwm < 0) {
            $rupiah_bpgwm = rupiah(0);
        } else {
            $rupiah_bpgwm = rupiah($bpgwm);
        }
        $bbjm = Apbdes_belanjaakun::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'belanja_id' => '2'
        ])->pluck('anggaran_murni')->first();
        if ($bbjm < 0) {
            $rupiah_bbjm = rupiah(0);
        } else {
            $rupiah_bbjm = rupiah($bbjm);
        }
        $bmm = Apbdes_belanjaakun::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'belanja_id' => '3'
        ])->pluck('anggaran_murni')->first();
        if ($bmm < 0) {
            $rupiah_bmm = rupiah(0);
        } else {
            $rupiah_bmm = rupiah($bmm);
        }
        $bttm = Apbdes_belanjaakun::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'belanja_id' => '4'
        ])->pluck('anggaran_murni')->first();
        if ($bttm < 0) {
            $rupiah_bttm = rupiah(0);
        } else {
            $rupiah_bttm = rupiah($bttm);
        }

        $tbm = (int)$bpgwm + (int)$bbjm + (int)$bmm + (int)$bttm;
        if ($tbm < 0) {
            $rupiah_tbm = rupiah(0);
        } else {
            $rupiah_tbm = rupiah($tbm);
        }
        $surdef = (int)$tpm - (int)$tbm;
        if ($surdef < 0) {
            $result = preg_replace("/[^a-zA-Z0-9]/", "", $surdef);
            $rupiah_result = rupiah($result);
            $rupiah_surdef = '(' . $rupiah_result . ")";
        } else {
            $rupiah_surdef = rupiah($surdef);
        }

        $penpem = Apbdes_pembiayaan::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'kode_pembiayaan' => '6.1'
        ])->pluck('anggaran_murni')->first();
        if ($penpem < 0) {
            $rupiah_penpem = rupiah(0);
        } else {
            $rupiah_penpem = rupiah($penpem);
        }

        $pengpem = Apbdes_pembiayaan::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'kode_pembiayaan' => '6.2'
        ])->pluck('anggaran_murni')->first();
        if ($pengpem < 0) {
            $rupiah_pengpem = rupiah(0);
        } else {
            $rupiah_pengpem = rupiah($pengpem);
        }

        $jumpem = (int)$penpem + (int)$pengpem;
        if ($jumpem < 0) {
            $rupiah_jumpem = rupiah(0);
        } else {
            $rupiah_jumpem = rupiah($jumpem);
        }

        $sisa = ((int)$jumpem + (int)$tpm) - (int)$tbm;
        if ($sisa < 0) {
            $result = preg_replace("/[^a-zA-Z0-9]/", "", $sisa);
            $rupiah_result = rupiah($result);
            $rupiah_sisa = '(' . $rupiah_result . ")";
        } else {
            $rupiah_sisa = rupiah($sisa);
        }

        //APBDES Perubahan
        $padp = Apbdes_pendapatan::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'kode_pendapatan' => '4.1'
        ])->pluck('anggaran_perubahan')->first();
        if ($padp < 0) {
            $rupiah_padp = rupiah(0);
        } else {
            $rupiah_padp = rupiah($padp);
        }

        $ptp = Apbdes_pendapatan::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'kode_pendapatan' => '4.2'
        ])->pluck('anggaran_perubahan')->first();
        if ($ptp < 0) {
            $rupiah_ptp = rupiah(0);
        } else {
            $rupiah_ptp = rupiah($ptp);
        }

        $ddp = Apbdes_pendapatan::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'kode_pendapatan' => '4.2.1'
        ])->pluck('anggaran_perubahan')->first();
        if ($ddp < 0) {
            $rupiah_ddp = rupiah(0);
        } else {
            $rupiah_ddp = rupiah($ddp);
        }

        $dbhp = Apbdes_pendapatan::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'kode_pendapatan' => '4.2.2'
        ])->pluck('anggaran_perubahan')->first();
        if ($dbhp < 0) {
            $rupiah_dbhp = rupiah(0);
        } else {
            $rupiah_dbhp = rupiah($dbhp);
        }

        $addp = Apbdes_pendapatan::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'kode_pendapatan' => '4.2.3'
        ])->pluck('anggaran_perubahan')->first();
        if ($addp < 0) {
            $rupiah_addp = rupiah(0);
        } else {
            $rupiah_addp = rupiah($addp);
        }

        $bpp = Apbdes_pendapatan::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'kode_pendapatan' => '4.2.4'
        ])->pluck('anggaran_perubahan')->first();
        if ($bpp < 0) {
            $rupiah_bpp = rupiah(0);
        } else {
            $rupiah_bpp = rupiah($bpp);
        }

        $bkp = Apbdes_pendapatan::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'kode_pendapatan' => '4.2.5'
        ])->pluck('anggaran_perubahan')->first();
        if ($bkp < 0) {
            $rupiah_bkp = rupiah(0);
        } else {
            $rupiah_bkp = rupiah($bkp);
        }

        $plp = Apbdes_pendapatan::where([
            'asal_id' => $asal_id[0]->id,
            'tahun' => $request->tahun,
            'kode_pendapatan' => '4.3'
        ])->pluck('anggaran_perubahan')->first();
        if ($plp < 0) {
            $rupiah_plp = rupiah(0);
        } else {
            $rupiah_plp = rupiah($plp);
        }

        $tpp = (int)$padp + (int)$ptp + (int)$plp;
        if ($tpp < 0) {
            $rupiah_tpp = rupiah(0);
        } else {
            $rupiah_tpp = rupiah($tpp);
        }





        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/public/template/aset/template.docx'));
        // $my_array_str = implode("</w:t><w:br/><w:t>", $tahun);
        // $template->setValue('array' . '', $my_array_str);
        $template->setValue('data_tahun' . '', $request->tahun);
        $template->setValue('desa' . '', $request->desa);
        $template->setValue('kecamatan' . '', $request->kecamatan);
        $template->setValue('irban' . '', $irban);
        $template->setValue('visi' . '', $visi->first()->uraian);
        $nomis = implode('<w:br/>', $no_misi);
        $template->setValue('no_misi' . '', $nomis);
        $misi_array = implode('<w:br/>', $ms);
        $template->setValue('misi' . '', $misi_array);
        $template->setValue('kades' . '', $kades);
        $template->setValue('sk_kades' . '', $sk_kades);
        $template->setValue('tgl_sk_kades' . '', $tgl_sk_kades);
        $template->setValue('sekdes' . '', $sekdes);
        $template->setValue('sk_sekdes' . '', $sk_sekdes);
        $template->setValue('tgl_sk_sekdes' . '', $tgl_sk_sekdes);
        $template->setValue('keuangan' . '', $keuangan);
        $template->setValue('sk_keuangan' . '', $sk_keuangan);
        $template->setValue('tgl_sk_keuangan' . '', $tgl_sk_keuangan);
        $template->setValue('perencanaan' . '', $perencanaan);
        $template->setValue('sk_perencanaan' . '', $sk_perencanaan);
        $template->setValue('tgl_sk_perencanaan' . '', $tgl_sk_perencanaan);
        $template->setValue('umum' . '', $umum);
        $template->setValue('sk_umum' . '', $sk_umum);
        $template->setValue('tgl_sk_umum' . '', $tgl_sk_umum);
        $template->setValue('pemerintahan' . '', $pemerintahan);
        $template->setValue('sk_pemerintahan' . '', $sk_pemerintahan);
        $template->setValue('tgl_sk_pemerintahan' . '', $tgl_sk_pemerintahan);
        $template->setValue('kesra' . '', $kesra);
        $template->setValue('sk_kesra' . '', $sk_kesra);
        $template->setValue('tgl_sk_kesra' . '', $tgl_sk_kesra);
        $template->setValue('pelayanan' . '', $pelayanan);
        $template->setValue('sk_pelayanan' . '', $sk_pelayanan);
        $template->setValue('tgl_sk_pelayanan' . '', $tgl_sk_pelayanan);
        $template->setValue('ketuabpd' . '', $ketuabpd);
        $template->setValue('sk_ketuabpd' . '', $sk_ketuabpd);
        $template->setValue('tgl_sk_ketuabpd' . '', $tgl_sk_ketuabpd);
        $template->setValue('wakil_bpd' . '', $wakil_bpd);
        $template->setValue('sk_wakil_bpd' . '', $sk_wakil_bpd);
        $template->setValue('tgl_sk_wakil_bpd' . '', $tgl_sk_wakil_bpd);
        $template->setValue('sekretaris_bpd' . '', $sekretaris_bpd);
        $template->setValue('sk_sekretaris_bpd' . '', $sk_sekretaris_bpd);
        $template->setValue('tgl_sk_sekretaris_bpd' . '', $tgl_sk_sekretaris_bpd);
        $agt_bpd = implode('<w:br/>', $anggota_bpd);
        $template->setValue('agt_bpd' . '', $agt_bpd);
        $ket_agt_bpd = implode('<w:br/>', $ket_anggota);
        $template->setValue('ket_anggota' . '', $ket_agt_bpd);
        $ket_agt_bpd_kutip = implode('<w:br/>', $ket_kutip);
        $template->setValue('kutip' . '', $ket_agt_bpd_kutip);
        $ket_agt_bpd_strip = implode('<w:br/>', $ket_strip);
        $template->setValue('strip' . '', $ket_agt_bpd_strip);
        $template->setValue('no_rpjmd' . '', $no_rpjmd);
        $template->setValue('tgl_rpjmd' . '', $tgl_rpjmd);
        $template->setValue('sejak_rpjmd' . '', $sejak_rpjmd);
        $template->setValue('sampai_rpjmd' . '', $sampai_rpjmd);
        $template->setValue('no_rkpdes' . '', $no_rkpdes);
        $template->setValue('th_rkpdes' . '', 'Tahun ' . $th_rkpdes);
        $template->setValue('tgl_rkpdes' . '', $tgl_rkpdes);
        $template->setValue('no_apbdes' . '', $no_apbdes);
        $template->setValue('th_apbdes' . '', 'Tahun ' . $th_apbdes);
        $template->setValue('tgl_apbdes' . '', $tgl_apbdes);

        $template->setValue('padm' . '', $rupiah_padm);
        $template->setValue('ptm' . '', $rupiah_ptm);
        $template->setValue('ddm' . '', $rupiah_ddm);
        $template->setValue('dbhm' . '', $rupiah_dbhm);
        $template->setValue('addm' . '', $rupiah_addm);
        $template->setValue('bpm' . '', $rupiah_bpm);
        $template->setValue('bkm' . '', $rupiah_bkm);
        $template->setValue('plm' . '', $rupiah_plm);
        $template->setValue('tpm' . '', $rupiah_tpm);
        $template->setValue('bpgwm' . '', $rupiah_bpgwm);
        $template->setValue('bbjm' . '', $rupiah_bbjm);
        $template->setValue('bmm' . '', $rupiah_bmm);
        $template->setValue('bttm' . '', $rupiah_bttm);
        $template->setValue('tbm' . '', $rupiah_tbm);
        $template->setValue('surdef' . '', $rupiah_surdef);
        $template->setValue('penpem' . '', $rupiah_penpem);
        $template->setValue('pengpem' . '', $rupiah_pengpem);
        $template->setValue('jumpem' . '', $rupiah_jumpem);
        $template->setValue('sisa' . '', $rupiah_sisa);

        $template->setValue('padp' . '', $rupiah_padp);
        $template->setValue('ptp' . '', $rupiah_ptp);
        $template->setValue('ddp' . '', $rupiah_ddp);
        $template->setValue('dbhp' . '', $rupiah_dbhp);
        $template->setValue('addp' . '', $rupiah_addp);
        $template->setValue('bpp' . '', $rupiah_bpp);
        $template->setValue('bkp' . '', $rupiah_bkp);
        $template->setValue('plp' . '', $rupiah_plp);
        $template->setValue('tpp' . '', $rupiah_tpp);




        // $phpWord = new \PhpOffice\PhpWord\PhpWord();
        // $section = $phpWord->addSection();
        // $section->addText(
        //     '"Learn from yesterday, live for today, hope for tomorrow. '
        //         . 'The important thing is not to stop questioning." '
        //         . '(Albert Einstein)'
        // );

        $filename = 'output.docx';
        header('Content-Type: application/octet-stream');
        header("Content-Disposition: attechment; filename=$filename");
        $template->saveAs('php://output');
    }
}
