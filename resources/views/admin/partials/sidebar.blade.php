<div class="sidebar">
    <div class="sidebar-brand">📘 BUKU TAMU DIGITAL</div>

    <div class="sidebar-menu">
        <a href="{{ url('/admin/dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
            📊 Dashboard
        </a>
        <a href="{{ url('/admin/daftar-tamu') }}" class="{{ request()->is('admin/daftar-tamu') ? 'active' : '' }}">
            👥 Data Kunjungan
        </a>
        <a href="{{ url('/admin/master-kunjungan') }}" class="{{ request()->is('admin/master-kunjungan') ? 'active' : '' }}">
            🗂️ Master Kunjungan
        </a>
        <span class="disabled">📈 Laporan <em>Segera</em></span>
        <span class="disabled">⚙️ Pengaturan <em>Segera</em></span>
    </div>

    <div class="sidebar-footer">
        <div class="role-badge">Admin Sekretariat</div>
        <div style="display:flex; align-items:center; gap:10px; margin-top:8px;">
            <div class="avatar-circle" style="background:#1e293b; color:#fff;">
                {{ strtoupper(substr(session('admin_username'), 0, 1)) }}
            </div>
            <div>
                <div style="font-size:13px; font-weight:600; color:#fff;">{{ session('admin_username') }}</div>
                <a href="{{ url('/admin/logout') }}" style="font-size:12px; color:#93c5fd; text-decoration:none;">Keluar</a>
            </div>
        </div>
    </div>
</div>