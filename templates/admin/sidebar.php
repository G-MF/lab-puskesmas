<aside class="main-sidebar sidebar-light-olive elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('admin') ?>" class="brand-link navbar-olive">
        <img src="<?= base_url('assets/img/logo-puskes.png') ?>" class="brand-image" alt="Logo Puskes">
        <span class="brand-text font-weight-bold text-white">UPTD Puskesmas Mengkatip</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/img/user.png') ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="" #" class="d-block"><?= isset($_SESSION['username']) ? $_SESSION['username'] : '' ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="<?= base_url('admin') ?>" class="nav-link <?= page_active('admin') ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview <?= page_active('pasien') || page_active('dokter') || page_active('user') ? 'menu-open' : '' ?>">
                    <a href="" #" class="nav-link <?= page_active('pasien') || page_active('dokter') || page_active('user') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Data Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/pasien') ?>" class="nav-link <?= page_active('pasien') ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pasien</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/dokter') ?>" class="nav-link <?= page_active('dokter') ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dokter</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/user') ?>" class="nav-link <?= page_active('user') ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('admin/nomor-antri') ?>" class="nav-link <?= page_active('nomor-antri') ?>">
                        <i class="nav-icon fas fa-list-ol"></i>
                        <p>
                            Nomor Antrian
                        </p>
                        <span class="right badge badge-danger">New</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('admin/penerimaan-pasien') ?>" class="nav-link <?= page_active('penerimaan-pasien') ?>">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                            Penerimaan Pasien
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('admin/pemeriksaan') ?>" class="nav-link <?= page_active('pemeriksaan') ?>">
                        <i class="nav-icon fas fa-user-check"></i>
                        <p>
                            Pemeriksaan Pasien
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('admin/hasil-pemeriksaan') ?>" class="nav-link <?= page_active('hasil-pemeriksaan') ?>">
                        <i class="nav-icon fas fa-clipboard-check"></i>
                        <p>
                            Hasil Pemeriksaan
                        </p>
                    </a>
                </li>

                <!-- Divider -->
                <div class="dropdown-divider font-weight-bold text-bold"></div>

                <li class="nav-item">
                    <a href="logout" data-toggle="modal" data-target="#modal-logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>