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
                setTimeout(function () { 
                    Toast.fire({
                        type: 'success',
                        title: 'Anda Telah Mengambil Nomor Antrian Dengan Nomor $no_antri'
                    })
                },10);  
                window.setTimeout(function(){ 
                    window.location.replace('/');
                } ,3000); 
                </script>";
        } else {
            echo "
                <script type='text/javascript'>
                setTimeout(function () { 
                    Toast.fire({
                        type: 'error',
                        title: 'Nomor Antrian Gagal Diambil'
                    })
                },10);  
                window.setTimeout(function(){ 
                    window.location.replace('/');
                } ,3000); 
                </script>";
        }
    }
