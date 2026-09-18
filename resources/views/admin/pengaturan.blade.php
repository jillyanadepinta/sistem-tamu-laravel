<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengaturan</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>
<body>
    <div class="admin-layout">
        @include('admin.partials.sidebar')

        <div class="main-content">
            <div class="admin-topbar">
                <h1>Pengaturan</h1>
                <div class="topbar-right">
                    <div class="avatar-circle">{{ strtoupper(substr(session('admin_username'), 0, 1)) }}</div>
                </div>
            </div>

            <div class="content-area">
                @if (session('pesan'))
                    <div class="msg-success">{{ session('pesan') }}</div>
                @endif
                @if (session('error'))
                    <div class="msg-error">{{ session('error') }}</div>
                @endif
                @if ($errors->any())
                    <div class="msg-error">{{ $errors->first() }}</div>
                @endif

                <div class="card">
                    <h3 style="margin-top:0;">Tambah Admin Baru</h3>
                    <form method="POST" action="{{ url('/admin/pengaturan') }}" style="display:flex; gap:8px; flex-wrap:wrap;">
                        @csrf
                        <input type="text" name="username" placeholder="Username..." required style="margin-bottom:0; flex:1; min-width:160px;">
                        <input type="password" name="password" placeholder="Password..." required style="margin-bottom:0; flex:1; min-width:160px;">
                        <button type="submit" style="width:auto; padding:12px 20px; margin-bottom:0;">Tambah</button>
                    </form>
                </div>

                <div class="card">
                    <h3 style="margin-top:0;">Daftar Admin</h3>
                    <table>
                        <tr>
                            <th>Username</th>
                            <th>Password</th>
                            <th style="width:160px;">Aksi</th>
                        </tr>
                        @foreach ($daftarAdmin as $admin)
                            <tr>
                                <td>{{ $admin->username }}</td>
                                <td>••••••••</td>
                                <td>
                                    <div class="aksi-wrap">
                                        <button type="button" class="btn-mini btn-panggil" onclick="toggleEdit({{ $admin->id }})">Edit</button>
                                        @if ($admin->id != session('admin_id'))
                                            <a href="{{ url('/admin/pengaturan-hapus/' . $admin->id) }}"
                                               class="btn-mini btn-hapus"
                                               onclick="return confirm('Yakin hapus admin ini?');">Hapus</a>
                                        @else
                                            <span style="font-size:11px; color:#999;">(Akun Anda)</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr id="formEdit{{ $admin->id }}" style="display:none;">
                                <td colspan="3" style="background:#f8fafc;">
                                    <form method="POST" action="{{ url('/admin/pengaturan/' . $admin->id) }}"
                                          style="display:flex; gap:8px; align-items:flex-end; flex-wrap:wrap; padding:8px 0;">
                                        @csrf
                                        <div style="flex:1; min-width:160px;">
                                            <label style="margin-bottom:4px;">Username</label>
                                            <input type="text" name="username" value="{{ $admin->username }}" required style="margin-bottom:0;">
                                        </div>
                                        <div style="flex:1; min-width:180px;">
                                            <label style="margin-bottom:4px;">Password Baru</label>
                                            <input type="password" name="password" placeholder="Kosongkan jika tidak diubah" style="margin-bottom:0;">
                                        </div>
                                        <div style="display:flex; gap:8px;">
                                            <button type="submit" class="btn-mini btn-selesai" style="width:auto;">Simpan</button>
                                            <button type="button" class="btn-mini btn-secondary" style="width:auto;" onclick="toggleEdit({{ $admin->id }})">Batal</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleEdit(id) {
            const baris = document.getElementById('formEdit' + id);
            baris.style.display = baris.style.display === 'none' ? 'table-row' : 'none';
        }
    </script>
</body>
</html>