<?php
require_once '../config/config.php';
include_once '../config/auth-cek.php';

$count_dokter = $koneksi->query("SELECT COUNT(*) as jml FROM dokter")->fetch_array();
$count_pasien = $koneksi->query("SELECT COUNT(*) as jml FROM pasien")->fetch_array();
?>

<!DOCTYPE html>
<html>

<?php include_once '../templates/admin/head.php'; ?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <?php include_once '../templates/admin/navbar.php'; ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include_once '../templates/admin/sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#"><?= $_SESSION['username'] ?></a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <div class="row">

            <div class="col-lg-6 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?= $count_pasien['jml']; ?></h3>
                  <p>Data Pasien</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?= base_url('admin/pasien'); ?>" class="small-box-footer">Lihat Selengkapnya...<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-6 col-6">
              <div class="small-box bg-pink">
                <div class="inner">
                  <h3><?= $count_dokter['jml']; ?></h3>
                  <p>Data Dokter</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?= base_url('admin/dokter'); ?>" class="small-box-footer">Lihat Selengkapnya...<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

          </div>

        </div>
      </section>

    </div>


    <!-- Footer -->
    <?php include_once '../templates/admin/footer.php'; ?>


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- Script -->
  <?php include_once '../templates/admin/script.php'; ?>

</body>

</html>