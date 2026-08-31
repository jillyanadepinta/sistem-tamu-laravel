<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ambil Foto Daftar Hadir</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>
<body class="body-watermark">
    <div class="container">
        <div class="step-header">
            <a href="{{ url('/form-tamu') }}" class="btn btn-secondary" style="width:auto; padding:10px 16px; margin:0;">&larr; Kembali</a>
            <div class="step-label">
                Langkah 2 dari 2
                <div class="step-bar"><div class="step-bar-fill" style="width:100%;"></div></div>
            </div>
        </div>

        <div class="card">
            <h3 style="margin-top:0;">Ambil Foto untuk Daftar Hadir</h3>
            <p style="font-size:13px; color:#666; margin-top:-8px;">Pastikan wajah terlihat jelas</p>

            <div id="areaKamera">
                <video id="video" autoplay playsinline></video>
                <button type="button" id="btnJepret">Jepret</button>
            </div>

            <div id="areaHasil" style="display:none;">
                <img id="previewFoto" class="preview">
                <button type="button" id="btnFotoUlang" class="btn btn-secondary">Foto Ulang</button>
                <button type="button" id="btnSimpanFoto">Simpan</button>
            </div>

            <canvas id="canvas" width="300" height="225" style="display:none;"></canvas>
        </div>
    </div>

    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const btnJepret = document.getElementById('btnJepret');
        const btnFotoUlang = document.getElementById('btnFotoUlang');
        const btnSimpanFoto = document.getElementById('btnSimpanFoto');
        const previewFoto = document.getElementById('previewFoto');
        const areaKamera = document.getElementById('areaKamera');
        const areaHasil = document.getElementById('areaHasil');
        let hasilFoto = '';

        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => { video.srcObject = stream; })
            .catch(err => { alert('Tidak bisa mengakses kamera: ' + err); });

        btnJepret.addEventListener('click', () => {
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            hasilFoto = canvas.toDataURL('image/jpeg');

            previewFoto.src = hasilFoto;
            areaKamera.style.display = 'none';
            areaHasil.style.display = 'block';
        });

        btnFotoUlang.addEventListener('click', () => {
            hasilFoto = '';
            areaHasil.style.display = 'none';
            areaKamera.style.display = 'block';
        });

        btnSimpanFoto.addEventListener('click', () => {
            sessionStorage.setItem('foto_base64', hasilFoto);
            window.location.href = "{{ url('/form-tamu') }}";
        });
    </script>
</body>
</html>