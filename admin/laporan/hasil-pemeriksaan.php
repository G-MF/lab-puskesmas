<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

$data = $koneksi->query("SELECT * FROM hasil_pemeriksaan h INNER JOIN pemeriksaan pm ON h.id_pemeriksaan = pm.id_pemeriksaan INNER JOIN penerimaan p ON pm.id_penerimaan = p.id_penerimaan INNER JOIN nomor_antri n ON p.id_antri = n.id_antri ORDER BY id_hasil DESC");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Hasil Pemeriksaan</title>
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
        LAPORAN DATA HASIL PEMERIKSAAN
    </div>

    <table border="1">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">Nama</th>
                <th rowspan="2">Alamat</th>
                <th colspan="10">Hasil Pemeriksaan</th>
            </tr>
            <tr>
                <th>Leucosit</th>
                <th>Trombosit</th>
                <th>Malaria</th>
                <th>Rapid Covid 19</th>
                <th>GDS</th>
                <th>GDP</th>
                <th>Cholesterol</th>
                <th>Trigliserida</th>
                <th>Protein</th>
                <th>Golongan Darah</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data as $row) :
                $data_pasien = $koneksi->query("SELECT * FROM pasien WHERE id_pasien = '$row[id_pasien]'")->fetch_array();
            ?>
                <tr>
                    <td align="center"><?= $no++; ?></td>
                    <td align="center"><?= date('d-m-Y', strtotime($row['tgl_hasil'])); ?></td>
                    <td><?= $data_pasien['nama']; ?></td>
                    <td><?= $data_pasien['alamat']; ?></td>
                    <td align="center"><?= $row['leucosit']; ?></td>
                    <td align="center"><?= $row['trombosit']; ?></td>
                    <td align="center"><?= $row['malaria']; ?></td>
                    <td align="center"><?= $row['rapid_covid']; ?></td>
                    <td align="center"><?= $row['gds']; ?></td>
                    <td align="center"><?= $row['gdp']; ?></td>
                    <td align="center"><?= $row['cholesterol']; ?></td>
                    <td align="center"><?= $row['trigliserida']; ?></td>
                    <td align="center"><?= $row['protein']; ?></td>
                    <td align="center"><?= $row['golongan_darah']; ?></td>
                </tr>
            <?php endforeach; ?>
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