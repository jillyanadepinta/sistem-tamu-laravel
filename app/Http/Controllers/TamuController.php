<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;

class TamuController extends Controller
{
    public function index()
    {
        return view('pengunjung.index');
    }

    public function form()
    {
        return view('pengunjung.form');
    }

    public function foto()
    {
        return view('pengunjung.foto');
    }

    public function simpan(Request $request)
    {
        // Ambil jenis kunjungan, ganti kalau "Lainnya"
        $jenisKunjungan = $request->jenis_kunjungan;
        if ($jenisKunjungan === 'Lainnya' && $request->filled('jenis_lainnya')) {
            $jenisKunjungan = $request->jenis_lainnya;
        }

        // Proses foto dari base64
        $fotoData = $request->foto_base64;
        $fotoData = str_replace('data:image/jpeg;base64,', '', $fotoData);
        $fotoData = str_replace(' ', '+', $fotoData);
        $fotoDecoded = base64_decode($fotoData);

        $namaFile = time() . '_foto.jpg';
        file_put_contents(public_path('uploads/' . $namaFile), $fotoDecoded);

        // Hitung nomor antrean hari ini
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

        return redirect("/sukses?nama={$tamu->nama}&antrean={$nomorAntrean}");
    }

    public function sukses(Request $request)
    {
        return view('pengunjung.sukses', [
            'nama' => $request->query('nama', 'Tamu'),
            'antrean' => $request->query('antrean', 0),
        ]);
    }
}