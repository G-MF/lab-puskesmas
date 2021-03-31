<nav class="main-header navbar navbar-expand-md navbar-dark navbar-olive">
    <div class="container">
        <a href="/" class="navbar-brand">
            <img src="<?= base_url('assets/img/logo-puskes.png') ?>" alt="Logo" class="brand-image">
            <span class="font-weight-bold">UPTD Puskesmas Mengkatip</span>
        </a>

        <!-- <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->

        <!-- <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Contact</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="#" class="dropdown-item">Some action </a></li>
                        <li><a href="#" class="dropdown-item">Some other action</a></li>

                        <li class="dropdown-divider"></li>

                        <li class="dropdown-submenu dropdown-hover">
                            <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
                            <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                <li>
                                    <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                                </li>

                                <li class="dropdown-submenu">
                                    <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                                    <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                                        <li><a href="#" class="dropdown-item">3rd level</a></li>
                                        <li><a href="#" class="dropdown-item">3rd level</a></li>
                                    </ul>
                                </li>

                                <li><a href="#" class="dropdown-item">level 2</a></li>
                                <li><a href="#" class="dropdown-item">level 2</a></li>
                            </ul>
                        </li>

                    </ul>
                </li>
            </ul>
        </div> -->

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <?php if (isset($_SESSION['role']) == 'pasien') : ?>
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                        Pelayanan
                    </a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li>
                            <a href="<?= base_url() ?>/print-kartu-pasien?id=<?= $_SESSION['id_user'] ?>" class="dropdown-item" target="blank">
                                <i class="fas fa-print"> Cetak Kartu Pasien</i>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#modal-no-antri" class="dropdown-item">
                                <i class="fas fa-list-ol"> Ambil Nomor Antrian</i>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('page/hasil-pemeriksaan') ?>" class="nav-link"> Hasil Tes</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"> <?= $_SESSION['nama_pasien'] ?></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="<?= base_url('page/profil') ?>" class="dropdown-item">
                            <i class="fas fa-id-card"> Profil</i>
                        </a>
                        <a href="<?= base_url('logout') ?>" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"> Logout</i>
                        </a>
                    </div>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="login">Login</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>