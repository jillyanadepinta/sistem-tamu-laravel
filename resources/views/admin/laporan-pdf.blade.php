<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        h2 { text-align: center; margin-bottom: 2px; }
        p.sub { text-align: center; margin-top: 0; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { border: 1px solid #999; padding: 6px 8px; text-align: left; }
        th { background: #1e3a5f; color: #fff; }
    </style>
</head>
<body>
    <h2>Laporan Data Kunjungan</h2>
    <p class="sub">Dinas Perpustakaan Umum dan Arsip Daerah Kota Malang</p>
    <p class="sub">Periode: {{ \Carbon\Carbon::parse($tglAwal)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($tglAkhir)->format('d-m-Y') }}</p>

    <table>
        <tr>
            <th>Nama</th><th>No HP</th><th>Asal</th><th>Jenis</th><th>Keperluan</th><th>Tanggal</th><th>Jam</th>
        </tr>
        @forelse ($data as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->no_hp }}</td>
                <td>{{ $item->asal }}</td>
                <td>{{ $item->jenis_kunjungan }}</td>
                <td>{{ $item->keperluan }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                <td>{{ $item->jam }}</td>
            </tr>
        @empty
            <tr><td colspan="7">Belum ada data pada periode ini.</td></tr>
        @endforelse
    </table>
</body>
</html>