<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

if ($_SESSION['role'] != 'superadmin') {
    header("location:javascript://history.go(-1)");
}
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
                            <h1 class="m-0 text-dark">Data User</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <a href="tambah" class="btn bg-gradient-primary"><i class="fa fa-plus-square"> Tambah Data</i></a>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content-header -->

            <?php
            if (isset($_SESSION['alert'])) {
                echo "<script>toastr.info('$_SESSION[alert]')</script>";
                unset($_SESSION['alert']);
            }
            ?>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card card-outline card-olive">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Username</th>
                                                    <th>Role</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $data = $koneksi->query("SELECT * FROM user ORDER BY role = 'superadmin' DESC");
                                                foreach ($data as $row) :
                                                ?>
                                                    <tr>
                                                        <td align="center"><?= $no++; ?></td>
                                                        <td><?= $row['username']; ?></td>
                                                        <td align="center"><?= $row['role']; ?></td>
                                                        <td align="center">
                                                            <a href="edit?id=<?= $row['id_user'] ?>" class="btn bg-gradient-purple btn-sm">
                                                                <i class="fa fa-edit"> Edit</i>
                                                            </a>
                                                            <?php if ($row['role'] != 'superadmin') : ?>
                                                                <button type="button" class="btn bg-gradient-maroon btn-sm delete" data-link="proses?id=<?= $row['id_user'] ?>" data-name="<?= $row['username'] ?>">
                                                                    <i class="fa fa-trash"> Hapus</i>
                                                                </button>
                                                                <a href="proses?resetid=<?= $row['id_user'] ?>" class="btn bg-gradient-dark btn-sm">
                                                                    <i class="fa fa-sync-alt"> Reset Password</i>
                                                                </a>
                                                            <?php endif ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
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