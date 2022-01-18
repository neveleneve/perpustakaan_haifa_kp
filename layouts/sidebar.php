<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
        <div class="sidebar-brand-text mx-2">Perpustakaan SDN 001 Toapaya</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item <?php echo $current_page == 'dashboard.php' ? 'active' : NULL ?>">
        <a class="nav-link" href="dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item <?php echo $current_page == 'buku.php' || $current_page == 'view-buku.php'  ? 'active' : NULL ?>">
        <a class="nav-link" href="buku">
            <i class="fas fa-fw fa-book"></i>
            <span>Buku</span>
        </a>
    </li>
    <li class="nav-item <?php echo $current_page == 'peminjaman.php' || $current_page == 'tambah-peminjaman.php' || $current_page == 'view-peminjaman.php' ? 'active' : NULL ?>">
        <a class="nav-link" href="peminjaman">
            <i class="fas fa-fw fa-upload"></i>
            <span>Peminjaman</span>
        </a>
    </li>
    <li class="nav-item <?php echo $current_page == 'report.php' ? 'active' : NULL ?>">
        <a class="nav-link" href="report">
            <i class="fas fa-fw fa-book-open"></i>
            <span>Report</span>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>