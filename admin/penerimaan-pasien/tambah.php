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
                            <h1 class="m-0 text-dark">Tambah Data Penerimaan Pasien</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <a href="<?= base_url('admin/penerimaan-pasien') ?>" class="btn bg-gradient-secondary"><i class="fa fa-arrow-left"> Kembali</i></a>
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
                                            <label for="id_antri" class="col-sm-2 col-form-label">Nomor Antri</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" name="id_antri" id="id_antri" data-placeholder="Pilih" style="width: 100%;" required>
                                                    <option value=""></option>
                                                    <?php
                                                    $tgl        = date('Y-m-d');
                                                    $data_antri = $koneksi->query("SELECT * FROM nomor_antri n INNER JOIN pasien p ON n.id_pasien = p.id_pasien WHERE n.tanggal = '$tgl' AND n.status = 'Belum Selesai'");
                                                    foreach ($data_antri as $item) :
                                                    ?>
                                                        <option value="<?= $item['id_antri'] ?>" <?php if (isset($_SESSION['valid'])) {
                                                                                                        if ($_SESSION['valid']['id_antri'] == $item['id_antri']) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                    } ?>><?= $item['no_antri'] ?> (<?= $item['nama'] ?>)</option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama" class="col-sm-2 col-form-label">Nama Pasien</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" required readonly value="<?= isset($_SESSION['valid']) ? $_SESSION['valid']['nama'] : '' ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="keterangan" id="keterangan" autocomplete="off" required readonly value="<?= isset($_SESSION['valid']) ? $_SESSION['valid']['keterangan'] : '' ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tgl_penerimaan" class="col-sm-2 col-form-label">Tanggal Penerimaan</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="tgl_penerimaan" id="tgl_penerimaan" autocomplete="off" required readonly value="<?= date('Y-m-d') ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="jam_periksa" class="col-sm-2 col-form-label">Jam Periksa</label>
                                            <div class="col-sm-10">
                                                <input type="time" class="form-control" name="jam_periksa" id="jam_periksa" autocomplete="off" required value="<?= date('H:i') ?>">
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

    <script>
        $(document).on('change', '#id_antri', function(e) {
            e.preventDefault();
            $.post('proses.php', {
                    id_antri: $(this).val()
                },
                function(data) {
                    let item = JSON.parse(data);
                    let nama = item['nama'];
                    let keterangan = item['keterangan'];

                    $("#nama").val(nama);
                    $("#keterangan").val(keterangan);
                }
            );
        });
    </script>

</body>

</html>