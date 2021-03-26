 <?php require_once 'config/config.php'; ?>

 <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/all.min.css">
 <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
 <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
 <script src="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
 <script>
     const Toast = Swal.mixin({
         toast: true,
         position: 'top',
         showConfirmButton: false,
         timer: 3000
     });
 </script>

 <?php
    if (isset($_POST['no-antri'])) {
        $no_antri   = strip_tags($_POST['no_antri']);
        $id_pasien  = $_SESSION['id_pasien'];
        $tanggal    = $_POST['tanggal'];
        $status     = 'Belum Selesai';
        $keterangan = strip_tags($_POST['keterangan']);

        $submit = $koneksi->query("INSERT INTO nomor_antri VALUES(NULL, '$no_antri', '$id_pasien', '$tanggal', '$status', '$keterangan')");

        if ($submit) {
            echo "
            <script type='text/javascript'>
            Toast.fire({
                type: 'success',
                title: 'Anda Telah Mengambil Nomor Antrian Dengan Nomor $no_antri'
            })
            </script>";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            echo "
        <script type='text/javascript'>
        Toast.fire({
            type: 'error',
            title: 'Nomor Antrian Gagal Diambil'
        })
        </script>";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
