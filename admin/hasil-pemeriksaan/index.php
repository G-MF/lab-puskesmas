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
                            <h1 class="m-0 text-dark">Data Hasil Pemeriksaan Pasien</h1>
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
                                                    <th>Data Pasien</th>
                                                    <th>Data Dokter</th>
                                                    <th>Data Pemeriksaan</th>
                                                    <th>Tanggal</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $data = $koneksi->query("SELECT * FROM hasil_pemeriksaan h INNER JOIN pemeriksaan pm ON h.id_pemeriksaan = pm.id_pemeriksaan INNER JOIN penerimaan p ON pm.id_penerimaan = p.id_penerimaan INNER JOIN nomor_antri n ON p.id_antri = n.id_antri ORDER BY id_hasil DESC");
                                                foreach ($data as $row) :
                                                    $data_pasien = $koneksi->query("SELECT * FROM pasien WHERE id_pasien = '$row[id_pasien]'")->fetch_array();
                                                    $data_dokter = $koneksi->query("SELECT * FROM dokter WHERE id_dokter = '$row[id_dokter]'")->fetch_array();
                                                ?>
                                                    <tr>
                                                        <td align="center"><?= $no++; ?></td>
                                                        <td>
                                                            No. Antri : <b><?= $row['no_antri']; ?></b> <br>
                                                            Nama : <b><?= $data_pasien['nama']; ?></b> <br>
                                                            Keterangan : <b><?= $row['keterangan']; ?></b>
                                                        </td>
                                                        <td>
                                                            Nama : <b><?= $data_dokter['nama']; ?></b> <br>
                                                            Poli : <b><?= $data_dokter['poli']; ?></b>
                                                        </td>
                                                        <td>
                                                            ID Pemeriksaan : <b><?= $row['id_pemeriksaan']; ?></b> <br>
                                                            Tanggal Periksa : <b><?= date('d-m-Y', strtotime($row['tgl_periksa'])); ?></b> <br>
                                                            Jam Periksa : <b><?= date('H:i', strtotime($row['jam_periksa'])) . ' WITA'; ?></b>
                                                        </td>
                                                        <td align="center"><?= date('d-m-Y', strtotime($row['tgl_hasil'])); ?></td>
                                                        <td align="center">
                                                            <a href="detail?id=<?= $row['id_hasil'] ?>" class="btn bg-gradient-navy btn-sm">
                                                                <i class="fa fa-info-circle"> Detail</i>
                                                            </a>
                                                            <a href="edit?id=<?= $row['id_hasil'] ?>" class="btn bg-gradient-purple btn-sm">
                                                                <i class="fa fa-edit"> Edit</i>
                                                            </a>
                                                            <button type="button" class="btn bg-gradient-maroon btn-sm delete" data-link="proses?id=<?= $row['id_hasil'] ?>" data-name="<?= $data_pasien['nama'] ?>">
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