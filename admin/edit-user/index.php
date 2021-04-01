<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

if ($_SESSION['role'] != 'adminlab') {
    header("location:javascript://history.go(-1)");
}

$id   = $_SESSION['id_user'];
$data = $koneksi->query("SELECT * FROM user WHERE id_user = '$id'")->fetch_array();
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
                            <h1 class="m-0 text-dark">Edit Data User</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card card-outline card-olive">

                                <form class="form-horizontal" action="index" method="POST">

                                    <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">

                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="user" class="col-sm-2 col-form-label">Username</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="user" id="user" autocomplete="off" maxlength="10" required value="<?= $data['username'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="pass_lama" class="col-sm-2 col-form-label">Password Lama</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="pass_lama" id="pass_lama" minlength="5" maxlength="10" required>
                                                    <div class="input-group-append" id="btn_lama">
                                                        <button type="button" class="btn bg-gradient-dark" onclick="lihatpass('pass_lama');" title="Tampilkan Password"><i class="fas fa-eye-slash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="pass_baru" class="col-sm-2 col-form-label">Password Baru</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="pass_baru" id="pass_baru" minlength="5" maxlength="10" required>
                                                    <div class="input-group-append" id="btn_baru">
                                                        <button type="button" class="btn bg-gradient-dark" onclick="lihatpass('pass_baru');" title="Tampilkan Password"><i class="fas fa-eye-slash"></i></button>
                                                    </div>
                                                </div>
                                                <small class="text-muted font-italic">*Password Minimal 5 Karakter | Maksimal 10 Karakter</small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="role" class="col-sm-2 col-form-label">Role User</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="role" value="<?= $data['role'] ?>" required readonly>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-footer justify-content-center text-center">
                                        <button type="submit" name="submit" class="btn bg-gradient-primary">
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

</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $id_user   = $_POST['id_user'];
    $username  = strip_tags($_POST['user']);
    $pass_lama = md5(strip_tags($_POST['pass_lama']));
    $pass_baru = md5(strip_tags($_POST['pass_baru']));
    $role      = strip_tags($_POST['role']);

    $cek_user_lain = $koneksi->query("SELECT * FROM user WHERE id_user != '$id_user'");
    foreach ($cek_user_lain as $item) {
        if ($username == $item['username']) {
            echo "
                <script>
                    setTimeout(function () { 
                        toastr.error('Username Sudah Ada!')
                    }, 10);  
                    window.setTimeout(function(){ 
                        window.history.back();
                        } ,2000); 
                </script>";
            exit;
        }
    }

    $cek_pw = $koneksi->query("SELECT * FROM user WHERE password = '$pass_lama'")->fetch_array();
    if ($cek_pw) {
        $submit = $koneksi->query("UPDATE user SET 
                    username = '$username', 
                    password = '$pass_baru', 
                    role     = '$role'
                    WHERE id_user = '$id_user'
                ");
        echo "
            <script type='text/javascript'>
                setTimeout(function () { 
                    toastr.success('Data Berhasil Diubah')
                },10);  
                window.setTimeout(function(){ 
                    window.location.replace('../');
                } ,2000);   
            </script>";
    } else {
        echo "
            <script>
                setTimeout(function () { 
                    toastr.error('Password Lama Yang Anda Masukkan Salah!')
                }, 10);  
                window.setTimeout(function(){ 
                    window.history.back();
                    } ,2000); 
            </script>";
        exit;
    }
}
?>