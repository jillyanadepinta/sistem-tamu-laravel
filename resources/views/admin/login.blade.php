<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>
<body>
    <div class="login-page">
        <div class="login-card">
            <div class="login-icon">📘</div>
            <h2>Login Admin</h2>
            <p>Sistem Informasi Tamu Layanan</p>

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

        <p class="login-footer">Dinas Perpustakaan Umum dan Arsip Daerah Kota Malang</p>
    </div>
</body>
</html>