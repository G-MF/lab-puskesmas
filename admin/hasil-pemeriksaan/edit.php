<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

$id   = isset($_GET['id']) ? $_GET['id'] : header('Location: ' . $_SERVER['HTTP_REFERER']);
$data = $koneksi->query("SELECT * FROM hasil_pemeriksaan h INNER JOIN pemeriksaan pm ON h.id_pemeriksaan = pm.id_pemeriksaan INNER JOIN penerimaan p ON pm.id_penerimaan = p.id_penerimaan INNER JOIN nomor_antri n ON p.id_antri = n.id_antri WHERE h.id_hasil = '$id'")->fetch_array();
$data_pasien = $koneksi->query("SELECT * FROM pasien WHERE id_pasien = '$data[id_pasien]'")->fetch_array();
$data_dokter = $koneksi->query("SELECT * FROM dokter WHERE id_dokter = '$data[id_dokter]'")->fetch_array();
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
                            <h1 class="m-0 text-dark">Edit Data Hasil Pemeriksaan Pasien</h1>
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

                                        <input type="hidden" name="id_hasil" value="<?= $data['id_hasil'] ?>">

                                        <div class="form-group row">
                                            <label for="id_pemeriksaan" class="col-sm-2 col-form-label">ID Pemeriksaan</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" name="id_pemeriksaan" id="id_pemeriksaan" data-placeholder="Pilih" style="width: 100%;" required>
                                                    <option value=""></option>
                                                    <?php
                                                    $tgl         = date('Y-m-d');
                                                    $pemeriksaan = $koneksi->query("SELECT * FROM pemeriksaan pm INNER JOIN penerimaan p ON pm.id_penerimaan = p.id_penerimaan INNER JOIN nomor_antri n ON p.id_antri = n.id_antri INNER JOIN pasien pn ON n.id_pasien = pn.id_pasien");
                                                    foreach ($pemeriksaan as $item) :
                                                    ?>
                                                        <option value="<?= $item['id_pemeriksaan'] ?>" <?= $data['id_pemeriksaan'] == $item['id_pemeriksaan'] ? 'selected' : '' ?>><?= $item['id_pemeriksaan'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="no_antri" class="col-sm-2 col-form-label">Nomor Antri Pasien</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="no_antri" name="no_antri" autocomplete="off" required readonly value="<?= $data['no_antri'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama" class="col-sm-2 col-form-label">Nama Pasien</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" required readonly value="<?= $data_pasien['nama'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="keterangan" id="keterangan" autocomplete="off" required readonly value="<?= $data['keterangan'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_dokter" class="col-sm-2 col-form-label">Nama Dokter</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" autocomplete="off" required readonly value="<?= $data_dokter['nama'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tgl_periksa" class="col-sm-2 col-form-label">Tanggal Periksa</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="tgl_periksa" id="tgl_periksa" autocomplete="off" required readonly value="<?= $data['tgl_periksa'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="biaya" class="col-sm-2 col-form-label">Biaya Periksa</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-olive">Rp</span>
                                                    </div>
                                                    <input type="text" class="form-control rupiah" name="biaya" id="biaya" autocomplete="off" required value="<?= $data['biaya']; ?>">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <hr>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="leucosit">Leucosit</label>
                                                    <input type="text" class="form-control" name="leucosit" id="leucosit" autocomplete="off" required value="<?= $data['leucosit'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="trombosit">Trombosit</label>
                                                    <input type="text" class="form-control" name="trombosit" id="trombosit" autocomplete="off" required value="<?= $data['trombosit'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="malaria">Malaria</label>
                                                    <input type="text" class="form-control" name="malaria" id="malaria" autocomplete="off" required value="<?= $data['malaria'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="rapid_covid">Rapid Covid 19</label>
                                                    <input type="text" class="form-control" name="rapid_covid" id="rapid_covid" autocomplete="off" required value="<?= $data['rapid_covid'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="gds">GDS</label>
                                                    <input type="text" class="form-control" name="gds" id="gds" autocomplete="off" required value="<?= $data['gds'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="gdp">GDP</label>
                                                    <input type="text" class="form-control" name="gdp" id="gdp" autocomplete="off" required value="<?= $data['gdp'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="cholesterol">Cholesterol</label>
                                                    <input type="text" class="form-control" name="cholesterol" id="cholesterol" autocomplete="off" required value="<?= $data['cholesterol'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="trigliserida">Trigliserida</label>
                                                    <input type="text" class="form-control" name="trigliserida" id="trigliserida" autocomplete="off" required value="<?= $data['trigliserida'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="protein">Protein</label>
                                                    <input type="text" class="form-control" name="protein" id="protein" autocomplete="off" required value="<?= $data['protein'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="golongan_darah">Golongan Darah</label>
                                                    <input type="text" class="form-control" name="golongan_darah" id="golongan_darah" autocomplete="off" required value="<?= $data['golongan_darah'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="kesimpulan">Kesimpulan</label>
                                                    <input type="text" class="form-control" name="kesimpulan" id="kesimpulan" autocomplete="off" required value="<?= $data['kesimpulan'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="tgl_hasil">Tanggal Hasil</label>
                                                    <input type="date" class="form-control" name="tgl_hasil" id="tgl_hasil" autocomplete="off" required value="<?= $tgl ?>">
                                                </div>
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

    <script>
        $(document).on('change', '#id_pemeriksaan', function(e) {
            e.preventDefault();
            $.post('proses.php', {
                    id_pemeriksaan: $(this).val()
                },
                function(data) {
                    let item = JSON.parse(data);
                    let no_antri = item['no_antri'];
                    let nama = item['nama'];
                    let keterangan = item['keterangan'];
                    let tgl_periksa = item['tgl_periksa'];

                    $("#no_antri").val(no_antri);
                    $("#nama").val(nama);
                    $("#keterangan").val(keterangan);
                    $("#tgl_periksa").val(tgl_periksa);
                }
            );
        });
    </script>

</body>

</html>