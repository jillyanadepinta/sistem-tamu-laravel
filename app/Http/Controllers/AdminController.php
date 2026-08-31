<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $hariIni = now()->format('Y-m-d');

        $totalHariIni = Tamu::whereDate('tanggal', $hariIni)->count();
        $jumlahMenunggu = Tamu::where('status', 'Menunggu')->count();
        $jumlahDilayani = Tamu::where('status', 'Dilayani')->whereDate('tanggal', $hariIni)->count();
        $jumlahDibatalkan = Tamu::where('status', 'Dibatalkan')->whereDate('tanggal', $hariIni)->count();
        $jumlahNotifBaru = Tamu::where('dilihat', false)->count();

        $labelHari = [];
        $dataHari = [];
        for ($i = 6; $i >= 0; $i--) {
            $tgl = Carbon::now()->subDays($i);
            $labelHari[] = $tgl->translatedFormat('D');
            $dataHari[] = Tamu::whereDate('tanggal', $tgl->format('Y-m-d'))->count();
        }

        $jenisData = Tamu::selectRaw('jenis_kunjungan, count(*) as jumlah')
            ->groupBy('jenis_kunjungan')
            ->orderByDesc('jumlah')
            ->get();
        $labelJenis = $jenisData->pluck('jenis_kunjungan')->toArray();
        $dataJenis = $jenisData->pluck('jumlah')->toArray();

        $aktivitasTerbaru = Tamu::orderByDesc('tanggal')->orderByDesc('jam')->limit(6)->get();

        return view('admin.dashboard', compact(
            'totalHariIni', 'jumlahMenunggu', 'jumlahDilayani', 'jumlahDibatalkan',
            'jumlahNotifBaru', 'labelHari', 'dataHari', 'labelJenis', 'dataJenis',
            'aktivitasTerbaru'
        ));
    }

    public function daftarTamu(Request $request)
    {
        Tamu::where('dilihat', false)->update(['dilihat' => true]);

        $keyword = $request->query('keyword', '');

        $query = Tamu::query();
        if ($keyword !== '') {
            $query->where(function ($q) use ($keyword) {
                $q->where('nama', 'like', "%$keyword%")
                  ->orWhere('asal', 'like', "%$keyword%")
                  ->orWhere('keperluan', 'like', "%$keyword%");
            });
        }

        $daftarTamu = $query->orderByDesc('tanggal')->orderByDesc('jam')->get();

        return view('admin.daftar-tamu', compact('daftarTamu', 'keyword'));
    }

    public function dilayani($id)
    {
        $tamu = Tamu::findOrFail($id);
        $tamu->status = 'Dilayani';
        $tamu->save();

        return redirect('/admin/daftar-tamu')->with('pesan', 'Tamu ditandai sedang dilayani.');
    }

    public function batalkan(Request $request, $id)
    {
        $request->validate(['alasan' => 'required|string|max:255']);

        $tamu = Tamu::findOrFail($id);
        $tamu->status = 'Dibatalkan';
        $tamu->alasan_batal = $request->alasan;
        $tamu->save();

        return redirect('/admin/daftar-tamu')->with('pesan', 'Kunjungan berhasil dibatalkan.');
    }
}