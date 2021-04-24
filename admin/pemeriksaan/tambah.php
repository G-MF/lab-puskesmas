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
                            <h1 class="m-0 text-dark">Tambah Data Pemeriksaan Pasien</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <a href="<?= base_url('admin/pemeriksaan') ?>" class="btn bg-gradient-secondary"><i class="fa fa-arrow-left"> Kembali</i></a>
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
                                            <label for="id_penerimaan" class="col-sm-2 col-form-label">ID Penerimaan</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" name="id_penerimaan" id="id_penerimaan" data-placeholder="Pilih" style="width: 100%;" required>
                                                    <option value=""></option>
                                                    <?php
                                                    $tgl        = date('Y-m-d');
                                                    $penerimaan = $koneksi->query("SELECT * FROM penerimaan p INNER JOIN nomor_antri n ON p.id_antri = n.id_antri INNER JOIN pasien pn ON n.id_pasien = pn.id_pasien WHERE p.tgl_penerimaan = '$tgl'");
                                                    foreach ($penerimaan as $item) :
                                                    ?>
                                                        <option value="<?= $item['id_penerimaan'] ?>" <?php
                                                                                                        if (isset($_SESSION['valid'])) {
                                                                                                            if ($_SESSION['valid']['id_penerimaan'] == $item['id_penerimaan']) {
                                                                                                                echo 'selected';
                                                                                                            }
                                                                                                        }
                                                                                                        ?>><?= $item['id_penerimaan'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="no_antri" class="col-sm-2 col-form-label">Nomor Antri Pasien</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="no_antri" name="no_antri" autocomplete="off" required readonly value="<?= isset($_SESSION['valid']) ? $_SESSION['valid']['no_antri'] : '' ?>">
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
                                            <label for="id_dokter" class="col-sm-2 col-form-label">Nama Dokter</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" name="id_dokter" id="id_dokter" data-placeholder="Pilih" style="width: 100%;" required>
                                                    <option value=""></option>
                                                    <?php
                                                    $tgl    = date('Y-m-d');
                                                    $dokter = $koneksi->query("SELECT * FROM dokter ORDER BY nama ASC");
                                                    foreach ($dokter as $item) :
                                                    ?>
                                                        <option value="<?= $item['id_dokter'] ?>" <?php
                                                                                                    if (isset($_SESSION['valid'])) {
                                                                                                        if ($_SESSION['valid']['id_dokter'] == $item['id_dokter']) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                    }
                                                                                                    ?>><?= $item['nama'] ?> (Poli : <?= $item['poli'] ?>)</option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tgl_periksa" class="col-sm-2 col-form-label">Tanggal Periksa</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="tgl_periksa" id="tgl_periksa" autocomplete="off" required readonly value="<?= date('Y-m-d') ?>">
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
        $(document).on('change', '#id_penerimaan', function(e) {
            e.preventDefault();
            $.post('proses.php', {
                    id_penerimaan: $(this).val()
                },
                function(data) {
                    let item = JSON.parse(data);
                    let no_antri = item['no_antri'];
                    let nama = item['nama'];
                    let keterangan = item['keterangan'];

                    $("#no_antri").val(no_antri);
                    $("#nama").val(nama);
                    $("#keterangan").val(keterangan);
                }
            );
        });
    </script>

</body>

</html>