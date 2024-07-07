<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    @if (Auth()->user()->role->nama_role == 'Karyawan')
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('karyawan.index') }}">
    @elseif (Auth()->user()->role->nama_role == 'Admin')
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
    @elseif (Auth()->user()->role->nama_role == 'Direktur')
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('direktur.index') }}">
    @endif
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="img/icon.png" alt="" style="width: 80px;">
        </div>
        <div class="sidebar-brand-text">TitanWorks</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        @if (Auth()->user()->role->nama_role == 'Karyawan')
            <a class="nav-link" href="{{ route('karyawan.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
            <a class="nav-link" href="{{ route('karyawan.request') }}">
                <i class="bi bi-envelope-arrow-up-fill "></i>
                <span>Pengajuan Surat</span></a>
        @elseif (Auth()->user()->role->nama_role == 'Admin')
            <a class="nav-link" href="{{ route('admin.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        @elseif (Auth()->user()->role->nama_role == 'Direktur')
            <a class="nav-link" href="{{ route('direktur.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        @endif
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item active">
        <a class="btn nav-link" data-toggle="modal" data-target="#logoutModal">
            <i class="bi bi-box-arrow-left"></i>
            <span>Keluar</span>
        </a>
    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
