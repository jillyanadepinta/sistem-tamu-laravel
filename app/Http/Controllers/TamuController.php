<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use App\Models\JenisKunjungan;
use Illuminate\Http\Request;

class TamuController extends Controller
{
    public function index()
    {
        $daftarJenis = JenisKunjungan::orderBy('nama')->get();
        return view('pengunjung.index', compact('daftarJenis'));
    }

    public function form()
    {
        $daftarJenis = JenisKunjungan::orderBy('nama')->get();
        return view('pengunjung.form', compact('daftarJenis'));
    }

    public function foto()
    {
        return view('pengunjung.foto');
    }

    public function simpan(Request $request)
    {
        $jenisKunjungan = $request->jenis_kunjungan;

        // Proses foto dari base64
        $fotoData = $request->foto_base64;
        $fotoData = str_replace('data:image/jpeg;base64,', '', $fotoData);
        $fotoData = str_replace(' ', '+', $fotoData);
        $fotoDecoded = base64_decode($fotoData);

        $namaFile = time() . '_foto.jpg';
        file_put_contents(public_path('uploads/' . $namaFile), $fotoDecoded);

        // Hitung nomor antrean hari ini (tetap disimpan sebagai catatan urutan internal,
        // tapi tidak ditampilkan ke pengunjung karena yang melayani hanya 1 orang)
        $hariIni = now()->format('Y-m-d');
        $jumlahHariIni = Tamu::whereDate('tanggal', $hariIni)->count();
        $nomorAntrean = $jumlahHariIni + 1;

        // Simpan ke database pakai Eloquent
        $tamu = Tamu::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'asal' => $request->asal,
            'jenis_kunjungan' => $jenisKunjungan,
            'keperluan' => $request->keperluan,
            'foto' => $namaFile,
            'tanggal' => $hariIni,
            'jam' => now()->format('H:i:s'),
            'nomor_antrean' => $nomorAntrean,
        ]);

        return redirect("/sukses?nama={$tamu->nama}");
    }

    public function sukses(Request $request)
    {
        return view('pengunjung.sukses', [
            'nama' => $request->query('nama', 'Tamu'),
        ]);
    }
}