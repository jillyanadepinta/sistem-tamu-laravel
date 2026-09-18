<div class="sidebar">
    <div class="sidebar-brand">
        <img src="{{ asset('assets/logo-malang.png') }}" alt="Logo Kota Malang" class="sidebar-logo-img">
        TANPAMU
    </div>
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
        <a href="{{ url('/admin/laporan') }}" class="{{ request()->is('admin/laporan') ? 'active' : '' }}">
            📈 Laporan</a>
        <a href="{{ url('/admin/pengaturan') }}" class="{{ request()->is('admin/pengaturan') ? 'active' : '' }}">
            ⚙️ Pengaturan
        </a>
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