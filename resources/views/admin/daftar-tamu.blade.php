<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kunjungan</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <style>
        /* Perbaikan ukuran & rapi kolom Aksi */
        .kolom-aksi {
            min-width: 190px;
        }
        .aksi-wrap {
            display: flex;
            flex-direction: column;
            gap: 6px;
            align-items: flex-start;
        }
        .aksi-baris {
            display: flex;
            gap: 6px;
            flex-wrap: nowrap;
        }
        .btn-mini {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            height: 32px;
            padding: 0 12px;
            font-size: 12.5px;
            font-weight: 600;
            line-height: 1;
            border-radius: 6px;
            border: 1px solid transparent;
            cursor: pointer;
            white-space: nowrap;
            text-decoration: none;
            transition: filter .15s ease, transform .05s ease;
        }
        .btn-mini:hover { filter: brightness(0.95); }
        .btn-mini:active { transform: translateY(1px); }
        .btn-selesai {
            background: #16a34a;
            color: #fff;
        }
        .btn-batal {
            background: #fff;
            color: #dc2626;
            border-color: #dc2626;
        }
        .btn-batal:hover { background: #fef2f2; }
        .btn-mini.btn-secondary {
            background: #f1f5f9;
            color: #334155;
            border-color: #e2e8f0;
        }
        #formBatal_wrap textarea { font-size: 13px; }
        .form-batal-mini {
            width: 220px;
            padding: 10px;
            border: 1px solid #fecaca;
            border-radius: 8px;
            background: #fff7f7;
        }
        .form-batal-mini textarea {
            width: 100%;
            min-height: 54px;
            font-size: 12.5px;
            margin-bottom: 6px;
            resize: vertical;
        }
        .form-batal-mini .aksi-baris { margin-top: 0; }
        .status-kosong {
            color: #94a3b8;
            font-size: 12.5px;
        }

        /* Pagination */
        .pagination-wrap {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 18px;
        }
        .pagination-wrap .btn-mini {
            height: 34px;
            min-width: 34px;
            padding: 0 10px;
        }
        .pagination-wrap .btn-mini.disabled {
            opacity: .45;
            pointer-events: none;
        }
        .pagination-info {
            text-align: center;
            font-size: 12.5px;
            color: #94a3b8;
            margin-top: 8px;
        }
    </style>
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
                                <td class="kolom-aksi">
                                    @if ($data->status === 'Menunggu')
                                        <div class="aksi-wrap">
                                            <div class="aksi-baris" id="aksiUtama{{ $data->id }}">
                                                <a href="{{ url('/admin/dilayani/' . $data->id) }}" class="btn-mini btn-selesai" title="Tandai tamu ini sedang dilayani">✔ Dilayani</a>
                                                <button type="button" class="btn-mini btn-batal" onclick="tampilkanFormBatal({{ $data->id }})">✕ Batalkan</button>
                                            </div>

                                            <form id="formBatal{{ $data->id }}" class="form-batal-mini" method="POST" action="{{ url('/admin/batalkan/' . $data->id) }}" style="display:none;">
                                                @csrf
                                                <textarea name="alasan" placeholder="Tuliskan alasan pembatalan..." required></textarea>
                                                <div class="aksi-baris">
                                                    <button type="submit" class="btn-mini btn-batal">Kirim</button>
                                                    <button type="button" class="btn-mini btn-secondary" onclick="tutupFormBatal({{ $data->id }})">Batal</button>
                                                </div>
                                            </form>
                                        </div>
                                    @else
                                        <span class="status-kosong">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="10">Belum ada data tamu.</td></tr>
                        @endforelse
                    </table>

                    @if ($daftarTamu->hasPages())
                        <div class="pagination-wrap">
                            @if ($daftarTamu->onFirstPage())
                                <span class="btn-mini btn-secondary disabled">‹ Sebelumnya</span>
                            @else
                                <a href="{{ $daftarTamu->previousPageUrl() }}" class="btn-mini btn-secondary">‹ Sebelumnya</a>
                            @endif

                            @for ($i = 1; $i <= $daftarTamu->lastPage(); $i++)
                                <a href="{{ $daftarTamu->url($i) }}"
                                   class="btn-mini {{ $i == $daftarTamu->currentPage() ? 'btn-selesai' : 'btn-secondary' }}">{{ $i }}</a>
                            @endfor

                            @if ($daftarTamu->hasMorePages())
                                <a href="{{ $daftarTamu->nextPageUrl() }}" class="btn-mini btn-secondary">Selanjutnya ›</a>
                            @else
                                <span class="btn-mini btn-secondary disabled">Selanjutnya ›</span>
                            @endif
                        </div>
                    @endif

                    <p class="pagination-info">
                        Menampilkan {{ $daftarTamu->firstItem() ?? 0 }}–{{ $daftarTamu->lastItem() ?? 0 }} dari {{ $daftarTamu->total() }} data
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function tampilkanFormBatal(id) {
            document.getElementById('formBatal' + id).style.display = 'block';
            document.getElementById('aksiUtama' + id).style.display = 'none';
        }
        function tutupFormBatal(id) {
            document.getElementById('formBatal' + id).style.display = 'none';
            document.getElementById('aksiUtama' + id).style.display = 'flex';
        }
    </script>
</body>
</html>