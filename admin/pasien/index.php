<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';
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
                            <h1 class="m-0 text-dark">Data Pasien</h1>
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
                                                    <th>ID Pasien</th>
                                                    <th>No. KTP</th>
                                                    <th>Nama</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>TTL</th>
                                                    <th>Alamat</th>
                                                    <th>Telpon</th>
                                                    <th>Username</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $data = $koneksi->query("SELECT * FROM pasien p INNER JOIN user u ON p.id_user = u.id_user ORDER BY p.id_pasien DESC");
                                                foreach ($data as $row) :
                                                ?>
                                                    <tr>
                                                        <td align="center"><?= $no++; ?></td>
                                                        <td align="center"><?= $row['kode_pasien']; ?></td>
                                                        <td align="center"><?= $row['no_ktp']; ?></td>
                                                        <td><?= $row['nama']; ?></td>
                                                        <td align="center"><?= $row['jk']; ?></td>
                                                        <td>
                                                            <?= $row['tempat_lahir'] . ' ' . date('d-m-Y', strtotime($row['tgl_lahir'])); ?>
                                                        </td>
                                                        <td><?= $row['alamat']; ?></td>
                                                        <td align="center"><?= $row['telpon']; ?></td>
                                                        <td align="center"><?= $row['username']; ?></td>
                                                        <td align="center">
                                                            <a href="edit?id=<?= $row['id_pasien'] ?>" class="btn bg-gradient-purple btn-sm">
                                                                <i class="fa fa-edit"> Edit</i>
                                                            </a>
                                                            <button type="button" class="btn bg-gradient-maroon btn-sm delete" data-link="proses?id=<?= $row['id_pasien'] ?>" data-name="<?= $row['nama'] ?>">
                                                                <i class="fa fa-trash"> Hapus</i>
                                                            </button>
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