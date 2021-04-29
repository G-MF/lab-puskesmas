<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

if (isset($_POST['cetak'])) {
    $jk   = $_POST['jk'];
    if ($jk == 1) {
        $jk = 'Laki-laki';
    } else {
        $jk = 'Perempuan';
    }
    $data = $koneksi->query("SELECT * FROM pasien p INNER JOIN user u ON p.id_user = u.id_user WHERE p.jk = '$jk' ORDER BY p.id_pasien ASC");
} else {
    $data = $koneksi->query("SELECT * FROM pasien p INNER JOIN user u ON p.id_user = u.id_user ORDER BY p.id_pasien ASC");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Pasien</title>
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/img/logo-puskes.png">

    <style>
        .kop {
            justify-content: space-between;
            font-size: 25px;
            font-weight: bold;
            line-height: 25px;
            text-align: center;
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        .judul {
            justify-content: center;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-top: 10px;
            line-height: 20px;
        }

        .alamat {
            font-size: 15px;
            /* text-decoration: underline; */
            font-style: italic;
            font-weight: bold;
            justify-content: center;
            line-height: 10px;
            text-align: center;
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            margin-top: -4px;
        }

        .gambar-kab {
            width: 53px;
            height: 60px;
        }

        .gambar-puskes {
            width: 55px;
            height: 60px;
        }

        .ttd {
            justify-content: right;
            text-align: center;
            float: right;
            margin-top: 10vh;
        }

        table {
            width: 100%;
            margin-top: 15px;
        }

        th {
            vertical-align: middle;
        }
    </style>
</head>

<body>

    <div class="kop">
        <img src="<?= base_url('assets/img/barito-selatan.png') ?>" class="gambar-kab">
        PEMERINTAH KABUPATEN BARITO SELATAN <br> UPTD PUSKESMAS MENGKATIP
        <img src="<?= base_url('assets/img/logo-puskes.png') ?>" class="gambar-puskes">
    </div>
    <div class="alamat">
        Jalan Kelurahan Mengkatip RT. 02 Rw. 01 Kode Pos 73762
    </div>

    <hr size="1.5" style="margin-bottom: 5px; color: black; font-weight: bold;">

    <div class="judul">
        LAPORAN DATA PASIEN
        <?php
        if (isset($_POST['cetak'])) :
            echo strtoupper($jk);
        endif;
        ?>
    </div>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Pasien</th>
                <th>No. KTP</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>TTL</th>
                <th>Alamat</th>
                <th>Telpon</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data as $row) :
            ?>
                <tr>
                    <td align="center"><?= $no++; ?></td>
                    <td align="center"><?= $row['kode_pasien']; ?></td>
                    <td align="center"><?= $row['no_ktp']; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td align="center"><?= $row['jk']; ?></td>
                    <td>
                        <?= $row['tempat_lahir'] . ' ' . date('d-m-Y', strtotime($row['tgl_lahir'])); ?>
                    </td>
                    <td><?= $row['alamat']; ?></td>
                    <td align="center"><?= $row['telpon']; ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <div class="ttd">
        Mengkatip, <?= date('d-m-Y'); ?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <u>Nama Kepala Puskesmas</u> <br>
        Kepala Puskesmas
    </div>

</body>


<script type="text/javascript">
    window.print();
</script>

</html>