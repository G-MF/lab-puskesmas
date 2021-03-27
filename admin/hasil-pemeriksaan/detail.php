<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

$id   = isset($_GET['id']) ? $_GET['id'] : header('Location: ' . $_SERVER['HTTP_REFERER']);
$data = $koneksi->query("SELECT * FROM hasil_pemeriksaan h INNER JOIN pemeriksaan pm ON h.id_pemeriksaan = pm.id_pemeriksaan INNER JOIN penerimaan p ON pm.id_penerimaan = p.id_penerimaan INNER JOIN nomor_antri n ON p.id_antri = n.id_antri WHERE id_hasil = '$id'")->fetch_array();

$data_pasien = $koneksi->query("SELECT * FROM pasien WHERE id_pasien = '$data[id_pasien]'")->fetch_array();
$data_dokter = $koneksi->query("SELECT * FROM dokter WHERE id_dokter = '$data[id_dokter]'")->fetch_array();
?>

<!DOCTYPE html>
<html>

<?php include_once '../../templates/admin/head.php'; ?>
<style>
    th {
        text-align: left !important;
        width: 10rem;
    }

    .titik-dua {
        text-align: center !important;
        width: 1px;
    }

    td {
        text-align: left !important;
    }
</style>

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
                            <h1 class="m-0 text-dark">Detail Hasil Pemeriksaan Pasien</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <a href="<?= base_url('admin/hasil-pemeriksaan') ?>" class="btn bg-gradient-secondary"><i class="fa fa-arrow-left"> Kembali</i></a>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="card card-outline card-olive">
                                <div class="card-header">
                                    <h3 class="card-title font-weight-bold">Data Pasien</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" width="100%">
                                            <tr>
                                                <th>No. Antri</th>
                                                <td class="titik-dua">:</td>
                                                <td><?= $data['no_antri']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Nama</th>
                                                <td class="titik-dua">:</td>
                                                <td><?= $data_pasien['nama']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Keterangan</th>
                                                <td class="titik-dua">:</td>
                                                <td><?= $data['keterangan']; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-outline card-olive">
                                <div class="card-header">
                                    <h3 class="card-title font-weight-bold">Data Dokter</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" width="100%">
                                            <tr>
                                                <th>Nama</th>
                                                <td class="titik-dua">:</td>
                                                <td><?= $data_dokter['nama']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Poli</th>
                                                <td class="titik-dua">:</td>
                                                <td><?= $data_dokter['poli']; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-outline card-olive">
                                <div class="card-header">
                                    <h3 class="card-title font-weight-bold">Data Pemeriksaan</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" width="100%">
                                            <tr>
                                                <th>ID Pemeriksaan</th>
                                                <td class="titik-dua">:</td>
                                                <td><?= $data['id_pemeriksaan']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Periksa</th>
                                                <td class="titik-dua">:</td>
                                                <td><?= date('d-m-Y', strtotime($data['tgl_periksa'])); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Jam Periksa</th>
                                                <td class="titik-dua">:</td>
                                                <td><?= date('H:i', strtotime($data['jam_periksa'])) . ' WITA'; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="card card-outline card-olive">
                                <div class="card-header">
                                    <h3 class="card-title font-weight-bold">Data Hasil Pemeriksaan</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" width="100%">
                                            <tr>
                                                <th>Leucosit</th>
                                                <td class="titik-dua">:</td>
                                                <td><?= $data['leucosit']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Trombosit</th>
                                                <td class="titik-dua">:</td>
                                                <td><?= $data['trombosit']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Malaria</th>
                                                <td class="titik-dua">:</td>
                                                <td><?= $data['malaria']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Rapid Covid 19</th>
                                                <td class="titik-dua">:</td>
                                                <td><?= $data['rapid_covid']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>GDS</th>
                                                <td class="titik-dua">:</td>
                                                <td><?= $data['gds']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Cholesterol</th>
                                                <td class="titik-dua">:</td>
                                                <td><?= $data['cholesterol']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Trigliserida</th>
                                                <td class="titik-dua">:</td>
                                                <td><?= $data['trigliserida']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Protein</th>
                                                <td class="titik-dua">:</td>
                                                <td><?= $data['protein']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Golongan Darah</th>
                                                <td class="titik-dua">:</td>
                                                <td><?= $data['golongan_darah']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Kesimpulan</th>
                                                <td class="titik-dua">:</td>
                                                <td><?= $data['kesimpulan']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Hasil</th>
                                                <td class="titik-dua">:</td>
                                                <td><?= date('d-m-Y', strtotime($data['tgl_hasil'])); ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

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