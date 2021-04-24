<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

$query1 = mysqli_query($koneksi, "SELECT max(kode_pasien) AS no FROM pasien");
$data   = mysqli_fetch_array($query1);
$no     = $data['no'];

$nourut = (int) substr($no, 2, 3);
$nourut++;

$kodeotomatis = "P" . sprintf('%03s', $nourut);
?>

<!DOCTYPE html>
<html>

<?php include_once '../../templates/admin/head.php'; ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include_once '../../templates/admin/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include_once '../../templates/admin/sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Tambah Data Pasien</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <a href="<?= base_url('admin/pasien') ?>" class="btn bg-gradient-secondary"><i class="fa fa-arrow-left"> Kembali</i></a>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content-header -->

            <?php
            if (isset($_SESSION['alert'])) {
                echo "<script>toastr.error('$_SESSION[alert]')</script>";
                unset($_SESSION['alert']);
            }
            ?>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card card-outline card-olive">

                                <form class="form-horizontal" action="proses" method="POST">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="kode_pasien" class="col-sm-2 col-form-label">ID Pasien</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="kode_pasien" id="kode_pasien" autocomplete="off" required readonly value="<?= $kodeotomatis ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="no_ktp" class="col-sm-2 col-form-label">No. KTP</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="no_ktp" id="no_ktp" autocomplete="off" required onkeypress="return Angkasaja(event)" maxlength="20" value="<?= isset($_SESSION['valid']) ? $_SESSION['valid']['no_ktp'] : '' ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama" class="col-sm-2 col-form-label">Nama Pasien</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" required value="<?= isset($_SESSION['valid']) ? $_SESSION['valid']['nama'] : '' ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="jk" id="jk" required>
                                                    <option value="" disabled selected>--Pilih--</option>
                                                    <option value="Laki-laki" <?php if (isset($_SESSION['valid'])) {
                                                                                    if ($_SESSION['valid']['jk'] == 'Laki-laki') {
                                                                                        echo 'selected';
                                                                                    }
                                                                                } ?>>Laki-laki</option>
                                                    <option value="Perempuan" <?php if (isset($_SESSION['valid'])) {
                                                                                    if ($_SESSION['valid']['jk'] == 'Perempuan') {
                                                                                        echo 'selected';
                                                                                    }
                                                                                } ?>>Perempuan</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" autocomplete="off" required value="<?= isset($_SESSION['valid']) ? $_SESSION['valid']['tempat_lahir'] : '' ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" autocomplete="off" required value="<?= isset($_SESSION['valid']) ? $_SESSION['valid']['tgl_lahir'] : '' ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="alamat" id="alamat" rows="2" required><?= isset($_SESSION['valid']) ? $_SESSION['valid']['alamat'] : '' ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="telpon" class="col-sm-2 col-form-label">Telpon</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="telpon" id="telpon" autocomplete="off" required onkeypress="return Angkasaja(event)" maxlength="15" value="<?= isset($_SESSION['valid']) ? $_SESSION['valid']['telpon'] : '' ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="username" id="username" autocomplete="off" maxlength="10" required value="<?= isset($_SESSION['valid']) ? $_SESSION['valid']['username'] : '' ?>">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-footer justify-content-center text-center">
                                        <button type="submit" name="tambah" class="btn bg-gradient-primary">
                                            <i class="fa fa-save"> Simpan</i>
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </section>
            <!-- /Main content -->


        </div>


        <!-- Footer -->
        <?php include_once '../../templates/admin/footer.php'; ?>


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- Script -->
    <?php include_once '../../templates/admin/script.php'; ?>

</body>

</html>