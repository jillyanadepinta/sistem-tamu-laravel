<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $admin = Admin::where('username', $request->username)->first();

        if ($admin && password_verify($request->password, $admin->password)) {
            session([
                'admin_id' => $admin->id,
                'admin_username' => $admin->username,
                'admin_role' => $admin->role,
            ]);
            return redirect('/admin/dashboard');
        }

        return back()->with('error', 'Username atau password salah.');
    }

    public function logout()
    {
        session()->forget(['admin_id', 'admin_username', 'admin_role']);
        return redirect('/admin/login');
    }
}