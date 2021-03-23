<?php
require_once '../config/config.php';
require_once '../config/auth-cek-pasien.php';

$data = $koneksi->query("SELECT * FROM pasien p INNER JOIN user u ON p.id_user = u.id_user WHERE p.id_user = '$_SESSION[id_user]'")->fetch_array();
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
                                Data Profil <u><i><?= $_SESSION['nama_pasien'] ?></i></u>
                            </h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <button type="button" data-toggle="modal" data-target="#edit-profil" class="btn btn-sm bg-gradient-purple mr-2">
                                    <i class="fa fa-edit"> Edit Profil</i>
                                </button>
                                <button type="button" data-toggle="modal" data-target="#edit-pw" class="btn btn-sm bg-gradient-dark">
                                    <i class="fa fa-edit"> Edit Password</i>
                                </button>
                            </ol>


                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="card card-olive card-outline">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" width="100%">
                                            <tr>
                                                <th>ID</th>
                                                <td class="titik-dua-tabel">:</td>
                                                <td><?= $data['id_user'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>No. KTP</th>
                                                <td class="titik-dua-tabel">:</td>
                                                <td><?= $data['no_ktp'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Nama</th>
                                                <td class="titik-dua-tabel">:</td>
                                                <td><?= $data['nama'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Jenis Kelamin</th>
                                                <td class="titik-dua-tabel">:</td>
                                                <td><?= $data['jk'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tempat Tanggal Lahir</th>
                                                <td class="titik-dua-tabel">:</td>
                                                <td><?= $data['tempat_lahir'] . ', ' . date('d-m-Y', strtotime($data['tgl_lahir'])); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Telpon</th>
                                                <td class="titik-dua-tabel">:</td>
                                                <td><?= $data['telpon'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Alamat</th>
                                                <td class="titik-dua-tabel">:</td>
                                                <td><?= $data['alamat'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Username</th>
                                                <td class="titik-dua-tabel">:</td>
                                                <td><?= $data['username'] ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->



        <!-- MODAL EDIT PROFIL -->
        <div class="modal fade" id="edit-profil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title font-weight-bold">Edit Profil</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="POST">
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="no_ktp" class="col-sm-2 col-form-label">No. KTP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="no_ktp" id="no_ktp" autocomplete="off" required onkeypress="return Angkasaja(event)" maxlength="20" value="<?= $data['no_ktp'] ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama Pasien</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" required value="<?= $data['nama'] ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="jk" id="jk" required>
                                        <option value="" disabled selected>--Pilih--</option>
                                        <option value="Laki-laki" <?= $data['jk'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                        <option value="Perempuan" <?= $data['jk'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" autocomplete="off" required value="<?= $data['tempat_lahir'] ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" autocomplete="off" required value="<?= date('Y-m-d', strtotime($data['tgl_lahir'])) ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="alamat" id="alamat" rows="2" required><?= $data['alamat'] ?></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telpon" class="col-sm-2 col-form-label">Telpon</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="telpon" id="telpon" autocomplete="off" required onkeypress="return Angkasaja(event)" maxlength="15" value="<?= $data['telpon'] ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="username" id="username" autocomplete="off" maxlength="10" required value="<?= $data['username'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer justify-content-center">
                            <button class="btn bg-gradient-primary text-white" type="submit" name="edit-profil">
                                <i class="fa fa-save"> Simpan</i>
                            </button>
                            <button class="btn bg-gradient-dark text-white" type="button" data-dismiss="modal">
                                <i class="fa fa-times"> Batal</i>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!-- // MODAL EDIT PROFIL -->


        <!-- MODAL EDIT PASSWORD -->
        <div class="modal fade" id="edit-pw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold">Ubah Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="pass_lama">Password Lama</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="pass_lama" id="pass_lama" minlength="5" maxlength="10" required>
                                    <div class="input-group-append" id="btn_lama">
                                        <button type="button" class="btn bg-gradient-dark" onclick="lihatpass('pass_lama');" title="Tampilkan Password"><i class="fas fa-eye-slash"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pass_lama">Password Baru</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="pass_baru" id="pass_baru" minlength="5" maxlength="10" required>
                                    <div class="input-group-append" id="btn_baru">
                                        <button type="button" class="btn bg-gradient-dark" onclick="lihatpass('pass_baru');" title="Tampilkan Password"><i class="fas fa-eye-slash"></i></button>
                                    </div>
                                </div>
                                <small class="text-muted font-italic">*Password Minimal 5 Karakter | Maksimal 10 Karakter</small>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button class="btn bg-gradient-primary text-white" type="submit" name="edit-pw">
                                <i class="fa fa-save"> Simpan</i>
                            </button>
                            <button class="btn bg-gradient-dark text-white" type="button" data-dismiss="modal">
                                <i class="fa fa-times"> Batal</i>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!-- // MODAL EDIT PASSWORD -->


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

<?php
if (isset($_POST['edit-profil'])) {
    $id_pasien    = $data['id_pasien'];
    $id_user      = $data['id_user'];
    $no_ktp       = strip_tags($_POST['no_ktp']);
    $nama         = strip_tags($_POST['nama']);
    $jk           = strip_tags($_POST['jk']);
    $tempat_lahir = strip_tags($_POST['tempat_lahir']);
    $tgl_lahir    = strip_tags($_POST['tgl_lahir']);
    $alamat       = preg_replace("/(\r|\n)/", " ", strip_tags($_POST['alamat']));
    $telpon       = strip_tags($_POST['telpon']);
    $username     = strip_tags($_POST['username']);


    $data_ktp  = $koneksi->query("SELECT * FROM pasien WHERE id_pasien = '$id_pasien'")->fetch_array();
    $data_user = $koneksi->query("SELECT * FROM user WHERE id_user = '$id_user'")->fetch_array();

    $sts = '';

    $cek_ktp  = $koneksi->query("SELECT * FROM pasien WHERE no_ktp != '$data_ktp[no_ktp]'");
    $cek_user = $koneksi->query("SELECT * FROM user WHERE username != '$data_user[username]'");

    foreach ($cek_ktp as $item) {
        if ($no_ktp == $item['no_ktp']) {
            echo "
            <script type='text/javascript'>
            Toast.fire({
                type: 'error',
                title: 'Nomor KTP Sudah Ada!'
            });

            $('#edit-profil').modal('show');
            </script>";
            exit;
        } else {
            $sts .= 'next';
        }
    }
    foreach ($cek_user as $item) {
        if ($username == $item['username']) {
            echo "
            <script type='text/javascript'>
            Toast.fire({
                type: 'error',
                title: 'Username Sudah Ada!'
            });

            $('#edit-profil').modal('show');
            </script>";
            exit;
        } else {
            $sts .= 'next';
        }
    }

    if (!empty($sts)) {
        $submit = $koneksi->query("UPDATE user SET username = '$username' WHERE id_user = '$id_user'");
        if ($submit) {
            $simpan = $koneksi->query("UPDATE pasien SET
                    no_ktp          = '$no_ktp',
                    nama            = '$nama',
                    jk              = '$jk',
                    tempat_lahir    = '$tempat_lahir',
                    tgl_lahir       = '$tgl_lahir', 
                    alamat          = '$alamat', 
                    telpon          = '$telpon', 
                    id_user         = '$id_user'
                    WHERE id_pasien = '$id_pasien'
                ");
            if ($simpan) {
                echo "
                <script type='text/javascript'>
                Toast.fire({
                    type: 'success',
                    title: 'Data Profil Berhasil Diubah'
                })
                </script>";
                echo '<meta http-equiv="refresh" content="1; url="' . base_url('page/profil') . '">';
            } else {
                echo "
                <script type='text/javascript'>
                Toast.fire({
                    type: 'error',
                    title: 'Data Profil Gagal Diubah!'
                })
                </script>";
                echo '<meta http-equiv="refresh" content="2; url="' . base_url('page/profil') . '">';
            }
        } else {
            echo "
                <script type='text/javascript'>
                Toast.fire({
                    type: 'error',
                    title: 'Data Profil Gagal Diubah!'
                })
                </script>";
            echo '<meta http-equiv="refresh" content="2; url="' . base_url('page/profil') . '">';
        }
    }
} else

if (isset($_POST['edit-pw'])) {
    $id_user   = $data['id_user'];
    $pass_lama = md5(strip_tags($_POST['pass_lama']));
    $pass_baru = md5(strip_tags($_POST['pass_baru']));

    $cek_pass_lama = $koneksi->query("SELECT * FROM user WHERE id_user = '$id_user' AND password = '$pass_lama'")->fetch_array();

    if ($cek_pass_lama) {
        $ubah = $koneksi->query("UPDATE user SET password = '$pass_baru' WHERE id_user = '$id_user'");
        if ($ubah) {
            echo "
                <script type='text/javascript'>
                Toast.fire({
                    type: 'success',
                    title: 'Password Berhasil Diubah'
                });
                </script>";
            echo '<meta http-equiv="refresh" content="2; url="' . base_url('page/profil') . '">';
        }
    } else {
        echo "
            <script type='text/javascript'>
            Toast.fire({
                type: 'error',
                title: 'Password Lama Yang Anda Masukkan Salah!'
            });

            $('#edit-pw').modal('show');
            </script>";
    }
}


?>