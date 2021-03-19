<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

$id   = isset($_GET['id']) ? $_GET['id'] : header("location: ../user", true, 301);
$data = $koneksi->query("SELECT * FROM user WHERE id_user = '$id'")->fetch_array();
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
                            <h1 class="m-0 text-dark">Edit Data User</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <a href="<?= base_url('admin/user') ?>" class="btn bg-gradient-secondary"><i class="fa fa-arrow-left"> Kembali</i></a>
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

                                    <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">

                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="user" class="col-sm-2 col-form-label">Username</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="user" id="user" autocomplete="off" maxlength="10" required value="<?= $data['username'] ?>">
                                            </div>
                                        </div>


                                        <?php if ($data['role'] == 'superadmin') : ?>
                                            <div class="form-group row">
                                                <label for="pass_lama" class="col-sm-2 col-form-label">Password Lama</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" name="pass_lama" id="pass_lama" minlength="5" maxlength="10" required>
                                                        <div class="input-group-append" id="btn_lama">
                                                            <button type="button" class="btn bg-gradient-dark" onclick="lihatpass('pass_lama');" title="Tampilkan Password"><i class="fas fa-eye-slash"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="pass_baru" class="col-sm-2 col-form-label">Password Baru</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" name="pass_baru" id="pass_baru" minlength="5" maxlength="10" required>
                                                        <div class="input-group-append" id="btn_baru">
                                                            <button type="button" class="btn bg-gradient-dark" onclick="lihatpass('pass_baru');" title="Tampilkan Password"><i class="fas fa-eye-slash"></i></button>
                                                        </div>
                                                    </div>
                                                    <small class="text-muted font-italic">*Password Minimal 5 Karakter | Maksimal 10 Karakter</small>
                                                </div>
                                            </div>
                                        <?php endif ?>

                                        <div class="form-group row">
                                            <label for="role" class="col-sm-2 col-form-label">Role User</label>
                                            <div class="col-sm-10">
                                                <?php if ($data['role'] == 'superadmin') : ?>
                                                    <input type="text" class="form-control" name="role" id="role" required readonly value="<?= $data['role'] ?>">
                                                <?php else : ?>
                                                    <select class="form-control" name="role" id="role" required>
                                                        <option value="adminlab" <?= $data['role'] == 'adminlab' ? 'selected' : '' ?>>Admin Lab</option>
                                                        <option value="pasien" <?= $data['role'] == 'pasien' ? 'selected' : '' ?>>pasien</option>
                                                    <?php endif ?>
                                                    </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-footer justify-content-center text-center">
                                        <button type="submit" name="edit" class="btn bg-gradient-primary">
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