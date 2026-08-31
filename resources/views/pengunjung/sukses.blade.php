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

            <div class="antrean-box">Nomor Antrean: #{{ str_pad($antrean, 3, '0', STR_PAD_LEFT) }}</div>

            <p>Ruangan sekretariat sedang kosong. Anda dapat langsung menuju ruang sekretariat.</p>

            <a href="{{ url('/') }}" class="btn btn-secondary">🔄 Kembali ke Halaman Utama</a>
        </div>
    </div>
</body>
</html>