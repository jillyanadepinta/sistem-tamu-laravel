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
            <button class="kartu-kategori warna-biru" onclick="pilihKategori('Magang')">
                <div class="icon-lingkaran">📖</div>
                <div class="label">Magang</div>
                <div class="sub-label">Praktik Kerja Lapangan</div>
            </button>
            <button class="kartu-kategori warna-hijau" onclick="pilihKategori('Donasi Buku')">
                <div class="icon-lingkaran">📚</div>
                <div class="label">Donasi Buku</div>
                <div class="sub-label">Sumbangan koleksi buku</div>
            </button>
            <button class="kartu-kategori warna-ungu" onclick="pilihKategori('Tamu Dinas')">
                <div class="icon-lingkaran">🏢</div>
                <div class="label">Tamu Dinas</div>
                <div class="sub-label">Kunjungan resmi instansi</div>
            </button>
            <button class="kartu-kategori warna-oranye" onclick="pilihKategori('Kerja Sama')">
                <div class="icon-lingkaran">🤝</div>
                <div class="label">Kerja Sama</div>
                <div class="sub-label">Kemitraan &amp; kolaborasi</div>
            </button>
            <button class="kartu-kategori warna-abu" onclick="pilihKategori('Lainnya')">
                <div class="icon-lingkaran">📌</div>
                <div class="label">Keperluan Lainnya</div>
                <div class="sub-label">Selain kategori di atas</div>
            </button>
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