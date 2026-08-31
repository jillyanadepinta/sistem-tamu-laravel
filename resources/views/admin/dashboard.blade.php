<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
</head>
<body>
    <div class="admin-layout">
        @include('admin.partials.sidebar')

        <div class="main-content">
            <div class="admin-topbar">
                <h1>Dashboard</h1>
                <div class="topbar-right">
                    <input type="text" class="search-box" placeholder="Search...">
                    <a href="{{ url('/admin/daftar-tamu') }}" class="notif-bell" style="text-decoration:none;">
                        🔔
                        @if ($jumlahNotifBaru > 0)
                            <span class="notif-badge">{{ $jumlahNotifBaru }}</span>
                        @endif
                    </a>
                    <div class="avatar-circle">{{ strtoupper(substr(session('admin_username'), 0, 1)) }}</div>
                </div>
            </div>

            <div class="content-area">
                <p class="date-today">{{ now()->translatedFormat('l, j F Y') }}</p>

                <div class="stat-cards-4">
                    <div class="stat-card-2">
                        <div class="stat-card-icon" style="background:#dbeafe; color:#2563eb;">👥</div>
                        <div>
                            <div class="stat-num">{{ $totalHariIni }}</div>
                            <div class="stat-label">Total Tamu Hari Ini</div>
                        </div>
                    </div>
                    <div class="stat-card-2">
                        <div class="stat-card-icon" style="background:#fef3c7; color:#d97706;">⏳</div>
                        <div>
                            <div class="stat-num">{{ $jumlahMenunggu }}</div>
                            <div class="stat-label">Menunggu</div>
                        </div>
                    </div>
                    <div class="stat-card-2">
                        <div class="stat-card-icon" style="background:#dcfce7; color:#16a34a;">✅</div>
                        <div>
                            <div class="stat-num">{{ $jumlahDilayani }}</div>
                            <div class="stat-label">Dilayani Hari Ini</div>
                        </div>
                    </div>
                    <div class="stat-card-2">
                        <div class="stat-card-icon" style="background:#fee2e2; color:#991b1b;">✕</div>
                        <div>
                            <div class="stat-num">{{ $jumlahDibatalkan }}</div>
                            <div class="stat-label">Dibatalkan Hari Ini</div>
                        </div>
                    </div>
                </div>

                <div class="charts-row">
                    <div class="card">
                        <h3 style="margin-top:0;">Kunjungan per Hari (Minggu Ini)</h3>
                        <div class="chart-wrap">
                            <canvas id="chartBatang"></canvas>
                        </div>
                    </div>

                    @if (count($labelJenis) > 0)
                    <div class="card">
                        <h3 style="margin-top:0;">Jenis Kunjungan</h3>
                        <div class="chart-wrap">
                            <canvas id="chartPie"></canvas>
                        </div>
                    </div>
                    @else
                    <div class="card" style="display:flex; align-items:center; justify-content:center; color:#999; font-size:13px;">
                        Belum ada data untuk ditampilkan.
                    </div>
                    @endif
                </div>

                <div class="card">
                    <h3 style="margin-top:0;">Aktivitas Terbaru</h3>
                    <table>
                        <tr>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th>Jam</th>
                        </tr>
                        @forelse ($aktivitasTerbaru as $data)
                            <tr>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->jenis_kunjungan }}</td>
                                <td>
                                    @php
                                        $warna = match($data->status) {
                                            'Menunggu' => 'background:#fef3c7; color:#92400e;',
                                            'Dilayani' => 'background:#dcfce7; color:#166534;',
                                            'Dibatalkan' => 'background:#fee2e2; color:#991b1b;',
                                            default => ''
                                        };
                                    @endphp
                                    <span style="{{ $warna }} padding:3px 10px; border-radius:12px; font-size:12px; font-weight:600;">{{ $data->status }}</span>
                                </td>
                                <td>{{ $data->jam }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4">Belum ada data tamu.</td></tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        new Chart(document.getElementById('chartBatang'), {
            type: 'bar',
            data: {
                labels: @json($labelHari),
                datasets: [{
                    label: 'Jumlah Tamu',
                    data: @json($dataHari),
                    backgroundColor: '#378ADD',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, ticks: { stepSize: 5 } } }
            }
        });

        @if (count($labelJenis) > 0)
        new Chart(document.getElementById('chartPie'), {
            type: 'pie',
            data: {
                labels: @json($labelJenis),
                datasets: [{
                    data: @json($dataJenis),
                    backgroundColor: ['#2563eb', '#f59e0b', '#16a34a', '#7c3aed', '#64748b']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { font: { size: 11 } } } }
            }
        });
        @endif
    </script>
</body>
</html>