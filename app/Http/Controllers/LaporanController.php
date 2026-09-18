<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    private function ambilData(Request $request)
    {
        $tglAwal = $request->query('tanggal_awal', now()->startOfMonth()->format('Y-m-d'));
        $tglAkhir = $request->query('tanggal_akhir', now()->format('Y-m-d'));

        $data = Tamu::whereBetween('tanggal', [$tglAwal, $tglAkhir])
            ->orderBy('tanggal')
            ->orderBy('jam')
            ->get();

        return [$data, $tglAwal, $tglAkhir];
    }

    public function index(Request $request)
    {
        [$data, $tglAwal, $tglAkhir] = $this->ambilData($request);

        $totalKunjungan = $data->count();
        $totalDilayani = $data->where('status', 'Dilayani')->count();
        $totalDibatalkan = $data->where('status', 'Dibatalkan')->count();

        $rekapJenis = $data->groupBy('jenis_kunjungan')->map->count();

        return view('admin.laporan', compact(
            'data', 'tglAwal', 'tglAkhir', 'totalKunjungan', 'totalDilayani', 'totalDibatalkan', 'rekapJenis'
        ));
    }

    public function exportExcel(Request $request)
    {
        [$data, $tglAwal, $tglAkhir] = $this->ambilData($request);

        $namaFile = 'laporan_kunjungan_' . date('Ymd_His') . '.xls';

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$namaFile");

        echo "<table border='1'>";
        echo "<tr><th>Nama</th><th>No HP</th><th>Asal</th><th>Jenis</th><th>Keperluan</th><th>Tanggal</th><th>Jam</th></tr>";
        foreach ($data as $item) {
            echo "<tr>";
            echo "<td>{$item->nama}</td>";
            echo "<td>{$item->no_hp}</td>";
            echo "<td>{$item->asal}</td>";
            echo "<td>{$item->jenis_kunjungan}</td>";
            echo "<td>{$item->keperluan}</td>";
            echo "<td>{$item->tanggal}</td>";
            echo "<td>{$item->jam}</td>";
            echo "</tr>";
        }
        echo "</table>";
        exit;
    }

    public function exportPdf(Request $request)
    {
        [$data, $tglAwal, $tglAkhir] = $this->ambilData($request);

        $pdf = Pdf::loadView('admin.laporan-pdf', compact('data', 'tglAwal', 'tglAkhir'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan_kunjungan_' . date('Ymd_His') . '.pdf');
    }
}