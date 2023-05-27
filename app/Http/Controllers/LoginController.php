<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Inspektorat;

class LoginController extends Controller
{
    public function cekMasuk(Request $request)
    {
        $admin = $request->validate([
            'instansi' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($request->instansi == 'inspektorat') {
            $adminInfo = Admin::with('asal')->where([
                'username' => strip_tags($request->username),
            ])->Where(function ($query) {
                $query->where('role', 'admin_irbanwil');
                $query->orwhere('role', 'admin_sekretariat');
                $query->orwhere('role', 'admin_irbansus');
            })->first();
        } elseif ($request->instansi == 'desa') {
            $adminInfo = Admin::with('asal')->where([
                'username' => strip_tags($request->username),
            ])->Where(function ($query) {
                $query->where('role', 'admin_desa_keu');
                $query->orwhere('role', 'admin_desa');
                $query->orwhere('role', 'admin_desa_bumdes');
            })->first();
        } else {
            return back()->with('fail', 'Maaf Akun Belum Tersedia untuk ' . $request->instansi);
        }


        if (!$adminInfo) {
            return back()->with('fail', 'username tidak ada!');
        } else {
            // cek password
            if ($adminInfo->password == strip_tags($request->password)) {

                // $request->session()->put('loggedAdmin', $adminInfo->role);
                // cek role
                if ($adminInfo->role == 'admin_desa') {
                    $request->session()->put('loggedAdminDesa', $adminInfo->id);
                    return redirect('/adminDesa');
                } elseif ($adminInfo->role == 'admin_irbanwil') {
                    $request->session()->put('loggedAdminIrbanwil', $adminInfo->id);
                    return redirect('/adminIrbanwil/personil');
                } elseif ($adminInfo->role == 'admin_sekretariat') {
                    $request->session()->put('loggedAdminIrbanwil', $adminInfo->id);
                    $request->session()->put('loggedAdminInspektorat', $adminInfo->id);
                    return redirect('/adminIrbanwil/personil');
                } elseif ($adminInfo->role == 'admin_irbansus') {
                    $request->session()->put('loggedAdminIrbanwil', $adminInfo->id);
                    $request->session()->put('loggedAdminInspektorat', $adminInfo->id);
                    return redirect('/adminIrbanwil/personil');
                } elseif ($adminInfo->role == 'admin_super') {
                    $request->session()->put('loggedAdminSuper', $adminInfo->id);
                    return redirect('/superadmin');
                } elseif ($adminInfo->role == 'admin_desa_keu') {
                    $request->session()->put('loggedAdminDesa', $adminInfo->id);
                    $request->session()->put('adminKeuDesa', $adminInfo->id);
                    return redirect('/adminDesa');
                }
            } else {
                return back()->with('fail', 'password salah!');
            }
        }
    }
}
