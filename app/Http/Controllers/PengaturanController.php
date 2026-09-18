<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        $daftarAdmin = Admin::orderBy('username')->get();
        return view('admin.pengaturan', compact('daftarAdmin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:admins,username',
            'password' => 'required|min:6',
        ]);

        Admin::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 'sekretariat',
        ]);

        return redirect('/admin/pengaturan')->with('pesan', 'Admin baru berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:admins,username,' . $id,
            'password' => 'nullable|min:6',
        ]);

        $admin = Admin::findOrFail($id);
        $admin->username = $request->username;

        if ($request->filled('password')) {
            $admin->password = bcrypt($request->password);
        }

        $admin->save();

        // Kalau yang diedit adalah admin yang sedang login, update juga sesi
        if ($admin->id == session('admin_id')) {
            session(['admin_username' => $admin->username]);
        }

        return redirect('/admin/pengaturan')->with('pesan', 'Data admin berhasil diperbarui.');
    }

    public function destroy($id)
    {
        if ($id == session('admin_id')) {
            return redirect('/admin/pengaturan')->with('error', 'Tidak bisa menghapus akun yang sedang digunakan.');
        }

        Admin::findOrFail($id)->delete();

        return redirect('/admin/pengaturan')->with('pesan', 'Admin berhasil dihapus.');
    }
}