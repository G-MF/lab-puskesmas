<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

$bln = array(
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember'
);

if (isset($_POST['cetak_pertanggal'])) :
    $tgl1 = $_POST['tgl1'];
    $tgl2 = $_POST['tgl2'];

    $data = $koneksi->query("SELECT * FROM penerimaan p INNER JOIN nomor_antri n ON p.id_antri = n.id_antri INNER JOIN pasien pn ON n.id_pasien = pn.id_pasien WHERE tgl_penerimaan BETWEEN '$tgl1' AND '$tgl2' ORDER BY id_penerimaan ASC");
    $label = tgl_indo($tgl1) . ' s/d ' . tgl_indo($tgl2);

elseif (isset($_POST['cetak_perbulan'])) :
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

    if ($bulan == '') :
        $data = $koneksi->query("SELECT * FROM penerimaan p INNER JOIN nomor_antri n ON p.id_antri = n.id_antri INNER JOIN pasien pn ON n.id_pasien = pn.id_pasien WHERE YEAR(tgl_penerimaan) = '$tahun' ORDER BY id_penerimaan ASC");
        $label = 'Tahun ' . $tahun;
    else :
        $data = $koneksi->query("SELECT * FROM penerimaan p INNER JOIN nomor_antri n ON p.id_antri = n.id_antri INNER JOIN pasien pn ON n.id_pasien = pn.id_pasien WHERE MONTH(tgl_penerimaan) = '$bulan' AND YEAR(tgl_penerimaan) = '$tahun' ORDER BY id_penerimaan ASC");
        $label = 'Bulan ' . $bln[$bulan] . ' Tahun ' . $tahun;
    endif;

else :
    $data = $koneksi->query("SELECT * FROM penerimaan p INNER JOIN nomor_antri n ON p.id_antri = n.id_antri INNER JOIN pasien pn ON n.id_pasien = pn.id_pasien ORDER BY id_penerimaan ASC");
    $label = '';
endif;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Penerimaan Pasien</title>
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
        LAPORAN DATA PENERIMAAN PASIEN <br>
        <small><?= $label; ?></small>
    </div>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Antri</th>
                <th>Nama Pasien</th>
                <th>Keterangan</th>
                <th>Tanggal Penerimaan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data as $row) :
            ?>
                <tr>
                    <td align="center"><?= $no++; ?></td>
                    <td align="center"><?= $row['no_antri']; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['keterangan']; ?></td>
                    <td align="center"><?= date('d-m-Y', strtotime($row['tgl_penerimaan'])); ?></td>
                    <td align="center"><?= $row['status']; ?></td>
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