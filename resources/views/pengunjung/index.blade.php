<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buku Tamu Digital</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>
<body class="body-watermark">
    <div class="container-wide">
        <div class="topbar-home">
            <strong>📖 BUKU TAMU DIGITAL</strong>
            <div style="display:flex; align-items:center; gap:12px;">
                <a href="{{ url('/') }}" style="font-size:13px; color:#378ADD; text-decoration:none; font-weight:600;">&larr; Beranda</a>
                <span id="jamSekarang" style="font-size:13px; color:#666;"></span>
                <span class="badge-online">● Online</span>
            </div>
        </div>

        <div class="hero">
            <div class="hero-badge">Dinas Perpustakaan Umum dan Arsip Daerah Kota Malang</div>
            <h1>Selamat Datang di<br>Buku Tamu Digital</h1>
            <p>Silakan pilih jenis kunjungan Anda untuk memulai proses registrasi</p>
        </div>

        <p class="grid-title">Pilih Jenis Kunjungan</p>

        <div class="grid-kategori">
            @php
                $ikonKategori = [
                    'Kunjungan Berkelompok' => ['icon' => '👥', 'warna' => 'warna-biru', 'sub' => 'Kunjungan rombongan/instansi'],
                    'Penelitian/Observasi' => ['icon' => '🔬', 'warna' => 'warna-hijau', 'sub' => 'Riset dan pengambilan data'],
                    'Menawarkan Barang/Jasa' => ['icon' => '🤝', 'warna' => 'warna-oranye', 'sub' => 'Kerja sama barang/jasa'],
                    'Layanan Kearsipan' => ['icon' => '🗄️', 'warna' => 'warna-ungu', 'sub' => 'Akses dan pengelolaan arsip'],
                ];
            @endphp

            @foreach ($daftarJenis as $jenis)
                @php
                    $meta = $ikonKategori[$jenis->nama] ?? ['icon' => '📌', 'warna' => 'warna-abu', 'sub' => ''];
                @endphp
                <button class="kartu-kategori {{ $meta['warna'] }}" onclick="pilihKategori('{{ $jenis->nama }}')">
                    <div class="icon-lingkaran">{{ $meta['icon'] }}</div>
                    <div class="label">{{ $jenis->nama }}</div>
                    <div class="sub-label">{{ $meta['sub'] }}</div>
                </button>
            @endforeach
        </div>

        <p class="footer-note">Butuh bantuan? Silakan hubungi petugas di ruang sekretariat</p>
    </div>

    <script>
        function pilihKategori(jenis) {
            sessionStorage.clear();
            sessionStorage.setItem('jenis_kunjungan', jenis);
            window.location.href = "{{ url('/form-tamu') }}";
        }

        function updateJam() {
            const now = new Date();
            const hari = now.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
            const jam = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            document.getElementById('jamSekarang').textContent = hari + ' • ' + jam;
        }
        updateJam();
        setInterval(updateJam, 1000);
    </script>
</body>
</html>