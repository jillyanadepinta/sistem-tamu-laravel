<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dinas Perpustakaan Umum dan Arsip Daerah Kota Malang</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar-landing">
        <div class="navbar-inner">
            <div class="navbar-brand">
                <img src="{{ asset('assets/logo-malang.png') }}" alt="Logo Kota Malang" class="navbar-logo-img">
                <div>
                    <strong>TANPAMU</strong>
                    <div style="font-size:11px; color:#888;">Tamu Perpustakaan Umum</div>
                </div>
            </div>
            <div class="navbar-menu">
                <a href="#layanan">Layanan</a>
                <a href="#tentang">Tentang</a>
                <a href="{{ url('/admin/login') }}" class="navbar-btn-admin">Login Admin</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero-landing">
        <div class="hero-landing-inner">
            <div class="hero-landing-badge">Selamat datang di Layanan Digital</div>
            <h1>Dinas Perpustakaan Umum<br>dan Arsip Daerah Kota Malang</h1>
            <p>Layani kunjungan Anda secara cepat dan mudah melalui sistem buku tamu digital kami — tanpa perlu antre panjang atau isi formulir kertas.</p>
            <a href="{{ url('/buku-tamu') }}" class="hero-landing-btn">📖 Isi Buku Tamu </a>
        </div>
    </section>

    <!-- Layanan -->
    <section id="layanan" class="section-landing">
        <p class="grid-title" style="text-align:center;">Layanan Kami</p>
        <h2 class="section-landing-title">Berbagai Layanan untuk Masyarakat</h2>

        <div class="grid-kategori">
            <div class="kartu-kategori warna-biru">
                <div class="icon-lingkaran">👥</div>
                <div class="label">Kunjungan Berkelompok</div>
                <div class="sub-label">Kunjungan rombongan/instansi</div>
            </div>
            <div class="kartu-kategori warna-hijau">
                <div class="icon-lingkaran">🔬</div>
                <div class="label">Penelitian/Observasi</div>
                <div class="sub-label">Riset dan pengambilan data</div>
            </div>
            <div class="kartu-kategori warna-oranye">
                <div class="icon-lingkaran">🤝</div>
                <div class="label">Menawarkan Barang/Jasa</div>
                <div class="sub-label">Kerja sama penyediaan barang/jasa</div>
            </div>
            <div class="kartu-kategori warna-ungu">
                <div class="icon-lingkaran">🗄️</div>
                <div class="label">Layanan Kearsipan</div>
                <div class="sub-label">Akses dan pengelolaan arsip</div>
            </div>
        </div>
    </section>

    <!-- Tentang -->
    <section id="tentang" class="section-landing section-alt">
        <div class="tentang-grid">
            <div>
                <p class="grid-title">Tentang Kami</p>
                <h2 class="section-landing-title" style="text-align:left;">Melayani dengan Digitalisasi</h2>
                <p style="color:#555; line-height:1.7;">
                    Dinas Perpustakaan Umum dan Arsip Daerah Kota Malang berkomitmen memberikan pelayanan publik yang cepat, transparan, dan mudah diakses.
                    Sistem buku tamu digital ini menggantikan pencatatan manual, sehingga proses kunjungan Anda tercatat rapi dan dapat ditindaklanjuti dengan cepat oleh petugas kami.
                </p>
            </div>
            <div class="tentang-stat-grid">
                <div class="stat-card-2">
                    <div class="stat-card-icon" style="background:#dbeafe; color:#2563eb;">⚡</div>
                    <div>
                        <div class="stat-num" style="font-size:16px;">Cepat</div>
                        <div class="stat-label">Registrasi hanya 1 menit</div>
                    </div>
                </div>
                <div class="stat-card-2">
                    <div class="stat-card-icon" style="background:#dcfce7; color:#16a34a;">📵</div>
                    <div>
                        <div class="stat-num" style="font-size:16px;">Tanpa Aplikasi</div>
                        <div class="stat-label">Langsung lewat browser</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="kontak" class="footer-landing">
        <div class="footer-landing-inner">
            <div>
                <strong style="color:#fff;">Dinas Perpustakaan Umum dan Arsip Daerah Kota Malang</strong>
                <p style="color:#93c5fd; font-size:13px; margin-top:6px;">Melayani dengan sepenuh hati untuk masyarakat Kota Malang.</p>
            </div>
            <div style="color:#c7d2e4; font-size:13px;">
                &copy; {{ date('Y') }} Dispusip Kota Malang. Seluruh hak cipta dilindungi.
            </div>
        </div>
    </footer>
</body>
</html>