<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index(Request $request)
    {
        $obrik = Admin::where('id', session('loggedAdminIrwil'))->pluck('obrik')->first();
        $kecamatan = Kecamatan::where('obrik', $obrik)->get();

        // foreach ($kecamatan as $kec) {
        //     echo $kec->nama_kecamatan . "<br>";
        // }
        return session()->all();
        $request->session()->put('loggedAdminDesa', 1);

        return redirect('/adminDesa');
    }
}
