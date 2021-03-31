<?php
require_once '../config/config.php';
require_once '../config/auth-cek-pasien.php';
?>

<!DOCTYPE html>
<html lang="en">

<?php include_once '../templates/public/head.php'; ?>
<style>
    table {
        height: 300px !important;
    }

    th {
        width: 180px !important;
    }

    .titik-dua-tabel {
        text-align: center;
        width: 1px;
    }
</style>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include_once '../templates/public/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4 class="m-0 text-bold">
                                Data Hasil Pemeriksaan <u><i><?= $_SESSION['nama_pasien'] ?></i></u>
                            </h4>
                        </div>
                        <!-- <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <button type="button" data-toggle="modal" data-target="#edit-profil" class="btn btn-sm bg-gradient-purple mr-2">
                                    <i class="fa fa-edit"> Edit Profil</i>
                                </button>
                                <button type="button" data-toggle="modal" data-target="#edit-pw" class="btn btn-sm bg-gradient-dark">
                                    <i class="fa fa-edit"> Edit Password</i>
                                </button>
                            </ol>
                        </div> -->

                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">

                            <?php
                            $data_pasien = $koneksi->query("SELECT * FROM pasien WHERE id_user = '$_SESSION[id_user]'")->fetch_array();
                            $data = $koneksi->query("SELECT * FROM hasil_pemeriksaan h INNER JOIN pemeriksaan pm ON h.id_pemeriksaan = pm.id_pemeriksaan INNER JOIN penerimaan p ON pm.id_penerimaan = p.id_penerimaan INNER JOIN nomor_antri n ON p.id_antri = n.id_antri WHERE n.id_pasien = '$data_pasien[id_pasien]' ORDER BY h.id_hasil DESC");

                            if ($data->num_rows) :

                                foreach ($data as $item) :
                                    $data_dokter = $koneksi->query("SELECT * FROM dokter WHERE id_dokter = '$item[id_dokter]'")->fetch_array();
                            ?>

                                    <div class="callout callout-success">
                                        <span style="float: right;">
                                            <a href="<?= base_url() ?>/page/print?id=<?= $item['id_hasil'] ?>" target="blank" class="btn bg-gradient-navy btn-sm">
                                                <i class="fa fa-print" style="color: white;"> Cetak</i>
                                            </a>
                                        </span>
                                        <h5><b>No. Antri : <?= $item['no_antri'] ?></b></h5>
                                        <p>
                                            Dokter : <b><?= $data_dokter['nama'] ?> (Poli : <?= $data_dokter['poli'] ?>)</b> <br>
                                            Keterangan : <b><?= $item['keterangan'] ?></b> <br>
                                            Tanggal Pemeriksaan : <b><?= date('d-m-Y', strtotime($item['tgl_periksa'])); ?></b> <br>
                                            Tanggal Hasil Pemeriksaan : <b><?= date('d-m-Y', strtotime($item['tgl_hasil'])); ?></b>
                                        </p>
                                    </div>


                                <?php
                                endforeach;
                            else : ?>
                                <div class="callout callout-danger">
                                    <h5>Tidak Ada Data</h5>
                                </div>
                            <?php endif; ?>

                        </div>

                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <?php include_once '../templates/public/footer.php'; ?>

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <?php include_once '../templates/public/script.php'; ?>

</body>

</html>