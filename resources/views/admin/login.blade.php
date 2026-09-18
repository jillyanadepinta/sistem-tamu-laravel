<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>
<body>
    <div class="login-page-split">
        <div class="login-split-card">
            <div class="login-split-left">
                <img src="{{ asset('assets/logo-malang.png') }}" alt="Logo Kota Malang" class="login-split-logo">
                <h2>TANPAMU</h2>
                <p>Sistem Informasi Tamu Layanan</p>
                <div class="login-split-sub">Dinas Perpustakaan Umum dan Arsip Daerah Kota Malang</div>
            </div>

            <div class="login-split-right">
                <h3>Masuk ke Akun Admin</h3>
                <p class="login-split-desc">Silakan masuk untuk mengelola data kunjungan tamu.</p>

                @if (session('error'))
                    <div class="msg-error">{{ session('error') }}</div>
                @endif

                <form action="{{ url('/admin/login') }}" method="POST">
                    @csrf
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Masukkan username" required>

                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan password" required>

                    <button type="submit">Masuk</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>