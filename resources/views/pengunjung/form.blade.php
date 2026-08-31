<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Registrasi Tamu</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>
<body class="body-watermark">
    <div class="container">
        <div class="step-header">
            <a href="{{ url('/') }}" class="btn btn-secondary" style="width:auto; padding:10px 16px; margin:0;">&larr; Kembali</a>
            <div class="step-label">
                Langkah 1 dari 2
                <div class="step-bar"><div class="step-bar-fill" style="width:50%;"></div></div>
            </div>
        </div>

        <div class="card card-form">
            <div class="form-title">
                <div class="form-icon">📋</div>
                <div>
                    <h3>Formulir Registrasi Tamu</h3>
                    <p>Lengkapi data diri Anda dengan benar</p>
                </div>
            </div>

            <form id="formTamu" action="{{ url('/kirim-tamu') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <div>
                        <label>Jenis Kunjungan *</label>
                        <select name="jenis_kunjungan" id="jenis_kunjungan" required>
                            <option value="Magang">Magang</option>
                            <option value="Donasi Buku">Donasi Buku</option>
                            <option value="Tamu Dinas">Tamu Dinas</option>
                            <option value="Kerja Sama">Kerja Sama</option>
                            <option value="Lainnya">Keperluan Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label>Nama Lengkap *</label>
                        <input type="text" name="nama" id="nama" placeholder="Isi nama lengkap Anda..." required>
                    </div>

                    <div id="areaJenisLainnya" class="full" style="display:none;">
                        <label>Sebutkan Keperluan Lainnya *</label>
                        <input type="text" name="jenis_lainnya" id="jenis_lainnya" placeholder="Tuliskan jenis kunjungan Anda...">
                    </div>

                    <div>
                        <label>Nomor HP/WhatsApp *</label>
                        <input type="text" name="no_hp" id="no_hp" placeholder="0812-3456-7890" required>
                    </div>
                    <div>
                        <label>Asal Instansi/Perusahaan *</label>
                        <input type="text" name="asal" id="asal" placeholder="Nama instansi/perusahaan..." required>
                    </div>

                    <div class="full">
                        <label>Detail Keperluan</label>
                        <textarea name="keperluan" id="keperluan" placeholder="Jelaskan keperluan kunjungan..."></textarea>
                    </div>
                </div>

                <div id="areaBelumFoto" class="foto-section">
                    <div class="foto-icon">📷</div>
                    <div>
                        <label style="margin-bottom:2px;">Foto Diri (pengganti tanda tangan) *</label>
                        <p style="font-size:12px; color:#888; margin:0;">Ambil foto untuk daftar hadir</p>
                    </div>
                    <button type="button" id="btnKeFoto" class="btn btn-secondary" style="width:auto; padding:10px 18px; margin:0 0 0 auto;">Ambil Foto</button>
                </div>

                <div id="areaSudahFoto" class="foto-hasil" style="display:none;">
                    <img id="previewFoto" class="preview" style="margin-bottom:10px;">
                    <button type="button" id="btnUlangiFoto" class="btn btn-secondary">Ambil Ulang</button>
                </div>

                <input type="hidden" name="foto_base64" id="foto_base64">

                <button type="submit" id="btnSimpan" disabled>📧 KIRIM DATA</button>
                <p style="font-size:12px; color:#888; text-align:right; margin:0;">* Wajib diisi</p>
            </form>
        </div>
    </div>

    <script>
        const jenisKunjungan = document.getElementById('jenis_kunjungan');
        const areaJenisLainnya = document.getElementById('areaJenisLainnya');
        const jenisLainnya = document.getElementById('jenis_lainnya');
        const nama = document.getElementById('nama');
        const noHp = document.getElementById('no_hp');
        const asal = document.getElementById('asal');
        const keperluan = document.getElementById('keperluan');
        const btnKeFoto = document.getElementById('btnKeFoto');
        const btnUlangiFoto = document.getElementById('btnUlangiFoto');
        const areaBelumFoto = document.getElementById('areaBelumFoto');
        const areaSudahFoto = document.getElementById('areaSudahFoto');
        const previewFoto = document.getElementById('previewFoto');
        const fotoBase64 = document.getElementById('foto_base64');
        const btnSimpan = document.getElementById('btnSimpan');

        function toggleJenisLainnya() {
            if (jenisKunjungan.value === 'Lainnya') {
                areaJenisLainnya.style.display = 'block';
                jenisLainnya.required = true;
            } else {
                areaJenisLainnya.style.display = 'none';
                jenisLainnya.required = false;
            }
        }
        jenisKunjungan.addEventListener('change', toggleJenisLainnya);

        window.addEventListener('DOMContentLoaded', () => {
            const jenisTersimpan = sessionStorage.getItem('jenis_kunjungan');
            if (jenisTersimpan) {
                jenisKunjungan.value = jenisTersimpan;
            }
            toggleJenisLainnya();

            nama.value = sessionStorage.getItem('nama') || '';
            noHp.value = sessionStorage.getItem('no_hp') || '';
            asal.value = sessionStorage.getItem('asal') || '';
            keperluan.value = sessionStorage.getItem('keperluan') || '';
            jenisLainnya.value = sessionStorage.getItem('jenis_lainnya') || '';

            const fotoTersimpan = sessionStorage.getItem('foto_base64');
            if (fotoTersimpan) {
                fotoBase64.value = fotoTersimpan;
                previewFoto.src = fotoTersimpan;
                areaBelumFoto.style.display = 'none';
                areaSudahFoto.style.display = 'block';
                btnSimpan.disabled = false;
            }
        });

        btnKeFoto.addEventListener('click', () => {
            sessionStorage.setItem('jenis_kunjungan', jenisKunjungan.value);
            sessionStorage.setItem('jenis_lainnya', jenisLainnya.value);
            sessionStorage.setItem('nama', nama.value);
            sessionStorage.setItem('no_hp', noHp.value);
            sessionStorage.setItem('asal', asal.value);
            sessionStorage.setItem('keperluan', keperluan.value);
            window.location.href = "{{ url('/foto-tamu') }}";
        });

        btnUlangiFoto.addEventListener('click', () => {
            sessionStorage.removeItem('foto_base64');
            btnKeFoto.click();
        });

        document.getElementById('formTamu').addEventListener('submit', () => {
            sessionStorage.clear();
        });
    </script>
</body>
</html>