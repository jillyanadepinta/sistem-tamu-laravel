<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Berhasil</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>
<body>
    <div class="overlay">
        <div class="modal-sukses">
            <div class="icon-check">&#10003;</div>
            <h2>Registrasi Berhasil!</h2>
            <p>Terima kasih, {{ $nama }}!</p>

            <a href="#" class="btn btn-sukses" onclick="return false;">✅ SILAHKAN MASUK</a>

            <a href="{{ url('/') }}" class="btn btn-secondary">🔄 Kembali ke Halaman Utama</a>
        </div>
    </div>
</body>
</html>