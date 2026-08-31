<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kunjungan</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>
<body>
    <div class="admin-layout">
        @include('admin.partials.sidebar')

        <div class="main-content">
            <div class="admin-topbar">
                <h1>Data Kunjungan</h1>
                <div class="topbar-right">
                    <div class="avatar-circle">{{ strtoupper(substr(session('admin_username'), 0, 1)) }}</div>
                </div>
            </div>

            <div class="content-area">
                @if (session('pesan'))
                    <div class="msg-success">{{ session('pesan') }}</div>
                @endif

                <div class="card">
                    <form method="GET" style="display:flex; gap:8px; margin-bottom:0;">
                        <input type="text" name="keyword" placeholder="Cari nama, asal, atau keperluan..."
                               value="{{ $keyword }}" style="margin-bottom:0; flex:1;">
                        <button type="submit" style="width:auto; padding:12px 20px; margin-bottom:0;">Cari</button>
                        @if ($keyword !== '')
                            <a href="{{ url('/admin/daftar-tamu') }}" class="btn btn-secondary" style="width:auto; padding:12px 20px; margin-bottom:0;">Reset</a>
                        @endif
                    </form>
                </div>

                <div class="card">
                    <table>
                        <tr>
                            <th>Nama</th>
                            <th>No HP</th>
                            <th>Asal</th>
                            <th>Jenis</th>
                            <th>Keperluan</th>
                            <th>Foto</th>
                            <th>Hari</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>

                        @forelse ($daftarTamu as $data)
                            @php
                                $warna = match($data->status) {
                                    'Menunggu' => 'background:#fef3c7; color:#92400e;',
                                    'Dilayani' => 'background:#dcfce7; color:#166534;',
                                    'Dibatalkan' => 'background:#fee2e2; color:#991b1b;',
                                    default => ''
                                };
                                $tgl = \Carbon\Carbon::parse($data->tanggal);
                            @endphp
                            <tr>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->no_hp }}</td>
                                <td>{{ $data->asal }}</td>
                                <td>{{ $data->jenis_kunjungan }}</td>
                                <td>{{ $data->keperluan }}</td>
                                <td><img src="{{ asset('uploads/' . $data->foto) }}" width="50" height="50"></td>
                                <td>{{ $tgl->translatedFormat('l') }}</td>
                                <td>{{ $tgl->format('d-m-Y') }}</td>
                                <td>
                                    <span style="{{ $warna }} padding:3px 10px; border-radius:12px; font-size:12px; font-weight:600;">{{ $data->status }}</span>
                                    @if ($data->status === 'Dibatalkan' && $data->alasan_batal)
                                        <div class="alasan-batal-card">
                                            <strong>Alasan:</strong> {{ $data->alasan_batal }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status === 'Menunggu')
                                        <div style="display:flex; gap:6px; flex-wrap:wrap;">
                                            <a href="{{ url('/admin/dilayani/' . $data->id) }}" class="btn-mini btn-selesai">Dilayani</a>
                                            <button type="button" class="btn-mini btn-batal" onclick="tampilkanFormBatal({{ $data->id }})">Batalkan</button>
                                        </div>

                                        <form id="formBatal{{ $data->id }}" method="POST" action="{{ url('/admin/batalkan/' . $data->id) }}" style="display:none; margin-top:8px;">
                                            @csrf
                                            <textarea name="alasan" placeholder="Tuliskan alasan pembatalan..." required style="min-height:60px; margin-bottom:8px;"></textarea>
                                            <button type="submit" class="btn-mini btn-batal" style="width:auto;">Kirim</button>
                                            <button type="button" class="btn-mini btn-secondary" style="width:auto;" onclick="tutupFormBatal({{ $data->id }})">Batal</button>
                                        </form>
                                    @else
                                        <span style="color:#999; font-size:12px;">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="10">Belum ada data tamu.</td></tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function tampilkanFormBatal(id) {
            document.getElementById('formBatal' + id).style.display = 'block';
        }
        function tutupFormBatal(id) {
            document.getElementById('formBatal' + id).style.display = 'none';
        }
    </script>
</body>
</html>