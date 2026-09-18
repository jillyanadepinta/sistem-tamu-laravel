<?php

namespace App\Http\Controllers;

use App\Models\JenisKunjungan;
use Illuminate\Http\Request;

class JenisKunjunganController extends Controller
{
    public function index()
    {
        $daftarJenis = JenisKunjungan::orderBy('nama')->get();
        return view('admin.master-kunjungan', compact('daftarJenis'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required|string|max:100']);
        JenisKunjungan::create(['nama' => $request->nama]);
        return redirect('/admin/master-kunjungan')->with('pesan', 'Jenis kunjungan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['nama' => 'required|string|max:100']);
        $jenis = JenisKunjungan::findOrFail($id);
        $jenis->nama = $request->nama;
        $jenis->save();
        return redirect('/admin/master-kunjungan')->with('pesan', 'Jenis kunjungan berhasil diubah.');
    }

    public function destroy($id)
    {
        JenisKunjungan::findOrFail($id)->delete();
        return redirect('/admin/master-kunjungan')->with('pesan', 'Jenis kunjungan berhasil dihapus.');
    }
}