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
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="/">
                <img src="<?= base_url('assets/img/logo-puskes.png') ?>" style="width: 80px; height: 90px;"> <br>
                <label style="font-size: 25px;"><b>UPTD PUSKESMAS MENGKATIP</b></label>
            </a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg font-weight-bold" style="font-size: 22px;">Login</p>

                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" name="login" class="btn bg-gradient-success btn-block font-weight-bold mb-3">
                        Login
                    </button>

                </form>

                <div class="text-center">
                    <p>Belum Punya Akun? <a href="daftar">Daftar Sekarang!</a></p>
                </div>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/assets/dist/js/adminlte.min.js"></script>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000
        });
    </script>

</body>

</html>

<?php
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $pass     = md5($password);

    $query = $koneksi->query("SELECT * FROM user WHERE username = '$username'");

    // CEK USERNAME
    if (mysqli_num_rows($query) === 1) {

        // CEK PASSWORD
        $data = mysqli_fetch_array($query);
        if ($pass == $data['password']) {
            $_SESSION['id_user']  = $data['id_user'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['role']     = $data['role'];

            if ($data['role'] == 'superadmin') {
                echo "
                <script type='text/javascript'>
                Toast.fire({
                    type: 'success',
                    title: 'Anda Login Sebagai Super Admin'
                })
                </script>";
                echo '<meta http-equiv="refresh" content="2; url=admin">';
            } else
            if ($data['role'] == 'adminlab') {
                echo "
                <script type='text/javascript'>
                Toast.fire({
                    type: 'success',
                    title: 'Anda Login Sebagai Admin Lab'
                })
                </script>";
                echo '<meta http-equiv="refresh" content="2; url=admin">';
            } else
            if ($data['role'] == 'pasien') {
                $pasien = $koneksi->query("SELECT * FROM pasien WHERE id_user = '$data[id_user]'")->fetch_array();
                $_SESSION['id_pasien']   = $pasien['id_pasien'];
                $_SESSION['nama_pasien'] = $pasien['nama'];
                echo "
                <script type='text/javascript'>
                Toast.fire({
                    type: 'success',
                    title: 'Anda Login Sebagai Pasien'
                })
                </script>";
                echo '<meta http-equiv="refresh" content="2; url=' . base_url() . '">';
            }
        } else {
            echo "
            <script type='text/javascript'>
            Toast.fire({
                type: 'error',
                title: 'Username atau Password Tidak Ditemukan'
            })
            </script>";
        }
    } else {
        echo "
            <script type='text/javascript'>
            Toast.fire({
                type: 'error',
                title: 'Username atau Password Tidak Ditemukan'
            }) 
            </script>";
    }
}
?>