<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Master Kunjungan</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>
<body>
    <div class="admin-layout">
        @include('admin.partials.sidebar')

        <div class="main-content">
            <div class="admin-topbar">
                <h1>Master Kunjungan</h1>
                <div class="topbar-right">
                    <div class="avatar-circle">{{ strtoupper(substr(session('admin_username'), 0, 1)) }}</div>
                </div>
            </div>

            <div class="content-area">
                @if (session('pesan'))
                    <div class="msg-success">{{ session('pesan') }}</div>
                @endif

                @if ($errors->any())
                    <div class="msg-error">{{ $errors->first() }}</div>
                @endif

                <div class="card">
                    <h3 style="margin-top:0;">Tambah Jenis Kunjungan</h3>
                    <form method="POST" action="{{ url('/admin/master-kunjungan') }}" style="display:flex; gap:8px;">
                        @csrf
                        <input type="text" name="nama" placeholder="Nama jenis kunjungan..." required style="margin-bottom:0; flex:1;">
                        <button type="submit" style="width:auto; padding:12px 20px; margin-bottom:0;">Tambah</button>
                    </form>
                </div>

                <div class="card">
                    <table>
                        <tr>
                            <th>Nama Jenis Kunjungan</th>
                            <th style="width:160px;">Aksi</th>
                        </tr>
                        @forelse ($daftarJenis as $jenis)
                            <tr>
                                <td>
                                    <form method="POST" action="{{ url('/admin/master-kunjungan/' . $jenis->id) }}" style="display:flex; gap:8px;">
                                        @csrf
                                        <input type="text" name="nama" value="{{ $jenis->nama }}" style="margin-bottom:0; flex:1;">
                                        <button type="submit" class="btn-mini btn-panggil" style="width:auto;">Simpan</button>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ url('/admin/master-kunjungan-hapus/' . $jenis->id) }}" class="btn-mini btn-hapus" onclick="return confirm('Yakin hapus jenis kunjungan ini?');">Hapus</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="2">Belum ada jenis kunjungan.</td></tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>