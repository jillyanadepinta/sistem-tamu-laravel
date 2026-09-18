<?php

namespace App\Http\Controllers;

use App\Models\JenisKunjungan;
use Illuminate\Http\Request;

class MasterKunjunganController extends Controller
{
    public function index()
    {
        $daftarJenis = JenisKunjungan::orderBy('nama')->get();

        return view('admin.master-kunjungan', compact('daftarJenis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:jenis_kunjungans,nama',
        ], [
            'nama.required' => 'Nama jenis kunjungan wajib diisi.',
            'nama.unique' => 'Jenis kunjungan tersebut sudah ada.',
        ]);

        JenisKunjungan::create(['nama' => $request->nama]);

        return redirect('/admin/master-kunjungan')->with('pesan', 'Jenis kunjungan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $jenis = JenisKunjungan::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:100|unique:jenis_kunjungans,nama,' . $jenis->id,
        ], [
            'nama.required' => 'Nama jenis kunjungan wajib diisi.',
            'nama.unique' => 'Jenis kunjungan tersebut sudah ada.',
        ]);

        $jenis->nama = $request->nama;
        $jenis->save();

        return redirect('/admin/master-kunjungan')->with('pesan', 'Jenis kunjungan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jenis = JenisKunjungan::findOrFail($id);
        $jenis->delete();

        return redirect('/admin/master-kunjungan')->with('pesan', 'Jenis kunjungan berhasil dihapus.');
    }
}
