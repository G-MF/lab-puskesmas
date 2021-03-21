<?php require_once 'config/config.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UPTD Puskesmas | Mengkatip</title>
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/img/logo-puskes.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition register-page" style="height: 100% !important;">

    <div class="register-box">
        <div class="register-logo mt-4">
            <a href="/">
                <img src="<?= base_url('assets/img/logo-puskes.png') ?>" style="width: 80px; height: 90px;"> <br>
                <label style="font-size: 25px;"><b>UPTD PUSKESMAS MENGKATIP</b></label>
            </a>
        </div>
    </div>

    <div class="container mb-4">
        <div class="col-lg-8 justify-content-center m-auto">
            <div class="card">
                <div class="card-body register-card-body">
                    <p class="login-box-msg font-weight-bold" style="font-size: 22px;">Pendaftaran Pasien</p>

                    <form class="form-horizontal">
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="no_ktp" class="col-sm-3 col-form-label">No. KTP</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="no_ktp" id="no_ktp" autocomplete="off" required onkeypress="return Angkasaja(event)" maxlength="20" value="<?= isset($_SESSION['valid']) ? $_SESSION['valid']['no_ktp'] : '' ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Nama Pasien</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" required value="<?= isset($_SESSION['valid']) ? $_SESSION['valid']['nama'] : '' ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jk" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="jk" id="jk" required>
                                        <option value="" disabled selected>--Pilih--</option>
                                        <option value="Laki-laki" <?php if (isset($_SESSION['valid'])) {
                                                                        if ($_SESSION['valid']['jk'] == 'Laki-laki') {
                                                                            echo 'selected';
                                                                        }
                                                                    } ?>>Laki-laki</option>
                                        <option value="Perempuan" <?php if (isset($_SESSION['valid'])) {
                                                                        if ($_SESSION['valid']['jk'] == 'Perempuan') {
                                                                            echo 'selected';
                                                                        }
                                                                    } ?>>Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" autocomplete="off" required value="<?= isset($_SESSION['valid']) ? $_SESSION['valid']['tempat_lahir'] : '' ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" autocomplete="off" required value="<?= isset($_SESSION['valid']) ? $_SESSION['valid']['tgl_lahir'] : '' ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="alamat" id="alamat" rows="2" required><?= isset($_SESSION['valid']) ? $_SESSION['valid']['alamat'] : '' ?></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telpon" class="col-sm-3 col-form-label">Telpon</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="telpon" id="telpon" autocomplete="off" required onkeypress="return Angkasaja(event)" maxlength="15" value="<?= isset($_SESSION['valid']) ? $_SESSION['valid']['telpon'] : '' ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="username" id="username" autocomplete="off" maxlength="10" required value="<?= isset($_SESSION['valid']) ? $_SESSION['valid']['username'] : '' ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password" id="password" autocomplete="off" minlength="5" maxlength="10" required>
                                        <div class="input-group-append" id="btn_pass">
                                            <button type="button" class="btn bg-gradient-dark" onclick="lihatpass();" title="Tampilkan Password"><i class="fas fa-eye-slash"></i></button>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted font-italic">*Password Minimal 5 Karakter dan Maksimal 10 Karakter</small>
                                </div>
                            </div>


                            <button type="submit" class="btn bg-gradient-success btn-block font-weight-bold">
                                Daftar
                            </button>

                        </div>
                        <!-- /.card-body -->

                    </form>


                    <div class="text-center">
                        <p>Sudah Punya Akun? <a href="login">Login</a></p>
                    </div>

                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
        </div>
    </div>


    <!-- jQuery -->
    <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/assets/dist/js/adminlte.min.js"></script>

    <script>
        // FORMAT ANGKA SAJA
        function Angkasaja(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        function lihatpass() {
            let tipe = document.getElementById('password').type;
            if (tipe == 'password') {
                document.getElementById('password').type = 'text';
                document.getElementById('btn_pass').innerHTML =
                    '<button type="button" class="btn bg-gradient-success" onclick=lihatpass() title="Sembunyikan Password"><i class="fas fa-eye"></i></button>';
            } else {
                document.getElementById('password').type = 'password';
                document.getElementById('btn_pass').innerHTML =
                    '<button type="button" class="btn bg-gradient-dark" onclick=lihatpass(); title="Tampilkan Password"><i class="fas fa-eye-slash"></i></button>';
            }
        }
    </script>

</body>

</html>