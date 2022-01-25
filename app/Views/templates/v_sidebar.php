<!-- Sidebar -->
<?php $session = session() ?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Toko Besi <sup>100</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('chart') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        User
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-user"></i>
            <span>Halaman User</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User :</h6>
                <?php if ($session->get('role') == 1) { ?>
                    <a class="collapse-item" href="<?= base_url('auth/login'); ?>">Login</a>
                    <a class="collapse-item" href="<?= base_url('auth/register'); ?>">Register</a>
                    <a class="collapse-item" href="<?= base_url('auth/logout'); ?>">Logout</a>
                <?php } else { ?>
                    <a class="collapse-item" href="<?= base_url('auth/login'); ?>">Login</a>
                    <a class="collapse-item" href="<?= base_url('auth/logout'); ?>">Logout</a>
                <?php } ?>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Barang
    </div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('barang'); ?>">
            <i class="fas fa-fw fa-table"></i>
            <span>Tabel Barang</span></a>
    </li>


    <div class="sidebar-heading">
        Penjualan
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-expanded="true" aria-controls="collapsePages2">
            <i class="fas fa-fw fa-folder"></i>
            <span>Halaman Penjualan</span>
        </a>
        <div id="collapsePages2" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Penjualan :</h6>
                <a class="collapse-item" href="<?= base_url('pemesanan') ?>">Tabel Penjualan</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Rekap Penjualan:</h6>
                <a class="collapse-item" href="<?= base_url('pemesanan/rekap'); ?>">Tabel Rekap Penjualan</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Peramalan
    </div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('peramalan') ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Peramalan</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->