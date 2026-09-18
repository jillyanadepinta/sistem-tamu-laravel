<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>
<body>
    <div class="admin-layout">
        @include('admin.partials.sidebar')

        <div class="main-content">
            <div class="admin-topbar">
                <h1>Laporan</h1>
                <div class="topbar-right">
                    <div class="avatar-circle">{{ strtoupper(substr(session('admin_username'), 0, 1)) }}</div>
                </div>
            </div>

            <div class="content-area">
                <div class="card">
                    <form method="GET" style="display:flex; gap:12px; align-items:flex-end; flex-wrap:wrap;">
                        <div style="flex:1; min-width:160px;">
                            <label>Dari Tanggal</label>
                            <input type="date" name="tanggal_awal" value="{{ $tglAwal }}" style="margin-bottom:0;">
                        </div>
                        <div style="flex:1; min-width:160px;">
                            <label>Sampai Tanggal</label>
                            <input type="date" name="tanggal_akhir" value="{{ $tglAkhir }}" style="margin-bottom:0;">
                        </div>
                        <button type="submit" style="width:auto; padding:12px 24px; margin-bottom:0;">Terapkan</button>
                    </form>
                </div>

                <div class="stat-cards-4">
                    <div class="stat-card-2">
                        <div class="stat-card-icon" style="background:#dbeafe; color:#2563eb;">📋</div>
                        <div>
                            <div class="stat-num">{{ $totalKunjungan }}</div>
                            <div class="stat-label">Total Kunjungan</div>
                        </div>
                    </div>
                    <div class="stat-card-2">
                        <div class="stat-card-icon" style="background:#dcfce7; color:#16a34a;">✅</div>
                        <div>
                            <div class="stat-num">{{ $totalDilayani }}</div>
                            <div class="stat-label">Dilayani</div>
                        </div>
                    </div>
                    <div class="stat-card-2">
                        <div class="stat-card-icon" style="background:#fee2e2; color:#991b1b;">✕</div>
                        <div>
                            <div class="stat-num">{{ $totalDibatalkan }}</div>
                            <div class="stat-label">Dibatalkan</div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <h3 style="margin-top:0;">Rekap per Jenis Kunjungan</h3>
                    <table>
                        <tr><th>Jenis Kunjungan</th><th>Jumlah</th></tr>
                        @forelse ($rekapJenis as $jenis => $jumlah)
                            <tr><td>{{ $jenis }}</td><td>{{ $jumlah }}</td></tr>
                        @empty
                            <tr><td colspan="2">Belum ada data pada periode ini.</td></tr>
                        @endforelse
                    </table>
                </div>

                <div class="card">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:14px;">
                        <h3 style="margin:0;">Detail Data Kunjungan</h3>
                        <div style="display:flex; gap:8px;">
                            <a href="{{ url('/admin/laporan/export-excel?tanggal_awal=' . $tglAwal . '&tanggal_akhir=' . $tglAkhir) }}"
                               class="btn-mini btn-panggil" style="padding:9px 16px;">📊 Export Excel</a>
                            <a href="{{ url('/admin/laporan/export-pdf?tanggal_awal=' . $tglAwal . '&tanggal_akhir=' . $tglAkhir) }}"
                               class="btn-mini btn-batal" style="padding:9px 16px;">📄 Export PDF</a>
                        </div>
                    </div>
                    <table>
                        <tr>
                            <th>Nama</th><th>Asal</th><th>Jenis</th><th>Tanggal</th><th>Jam</th>
                        </tr>
                        @forelse ($data as $item)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->asal }}</td>
                                <td>{{ $item->jenis_kunjungan }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $item->jam }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5">Belum ada data pada periode ini.</td></tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>