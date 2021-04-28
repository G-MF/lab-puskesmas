<?php
require_once '../config/config.php';
include_once '../config/auth-cek.php';

$id   = isset($_GET['id']) ? $_GET['id'] : header('Location: ' . $_SERVER['HTTP_REFERER']);
$data = $koneksi->query("SELECT * FROM hasil_pemeriksaan h INNER JOIN pemeriksaan pm ON h.id_pemeriksaan = pm.id_pemeriksaan INNER JOIN penerimaan p ON pm.id_penerimaan = p.id_penerimaan INNER JOIN nomor_antri n ON p.id_antri = n.id_antri WHERE id_hasil = '$id'")->fetch_array();

$data_pasien = $koneksi->query("SELECT * FROM pasien WHERE id_pasien = '$data[id_pasien]'")->fetch_array();
$data_dokter = $koneksi->query("SELECT * FROM dokter WHERE id_dokter = '$data[id_dokter]'")->fetch_array();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pemeriksaan</title>
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
            margin-top: 8vh;
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
        HASIL PEMERIKSAAN LABORATORIUM <br>
        PUSKESMAS MENGKATIP
    </div>

    <table>
        <tr>
            <td style="width: 20vh;">Nama</td>
            <td align="center" width="2px">:</td>
            <td><?= $data_pasien['nama'] ?></td>
        </tr>
        <tr valign="top">
            <td style="width: 20vh;">Alamat</td>
            <td align="center" width="2px">:</td>
            <td><?= $data_pasien['alamat'] ?></td>
        </tr>
        <tr>
            <td style="width: 20vh;">Tanggal</td>
            <td align="center" width="2px">:</td>
            <td><?= date('d-m-Y', strtotime($data['tgl_hasil'])); ?></td>
        </tr>
        <tr>
            <td style="width: 20vh;">Biaya Pemeriksaan</td>
            <td align="center" width="2px">:</td>
            <td><?= 'Rp. ' . number_format($data['biaya'], 0, ',', '.'); ?></td>
        </tr>
    </table>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Pemeriksaan</th>
                <th>Hasil</th>
                <th>Normal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td align="center" style="width: 3vh;"><?= $no++; ?></td>
                <td>Leucosit</td>
                <td></td>
                <td><?= $data['leucosit']; ?></td>
            </tr>
            <tr>
                <td align="center" style="width: 3vh;"><?= $no++; ?></td>
                <td>Trombosit</td>
                <td></td>
                <td><?= $data['trombosit']; ?></td>
            </tr>
            <tr>
                <td align="center" style="width: 3vh;"><?= $no++; ?></td>
                <td>Malaria</td>
                <td></td>
                <td><?= $data['malaria']; ?></td>
            </tr>
            <tr>
                <td align="center" style="width: 3vh;"><?= $no++; ?></td>
                <td>Rapid Covid 19</td>
                <td></td>
                <td><?= $data['rapid_covid']; ?></td>
            </tr>
            <tr>
                <td align="center" style="width: 3vh;"><?= $no++; ?></td>
                <td>GDS</td>
                <td></td>
                <td><?= $data['gds']; ?></td>
            </tr>
            <tr>
                <td align="center" style="width: 3vh;"><?= $no++; ?></td>
                <td>GDP</td>
                <td></td>
                <td><?= $data['gdp']; ?></td>
            </tr>
            <tr>
                <td align="center" style="width: 3vh;"><?= $no++; ?></td>
                <td>Cholesterol</td>
                <td></td>
                <td><?= $data['cholesterol']; ?></td>
            </tr>
            <tr>
                <td align="center" style="width: 3vh;"><?= $no++; ?></td>
                <td>Trigliserida</td>
                <td></td>
                <td><?= $data['trigliserida']; ?></td>
            </tr>
            <tr>
                <td align="center" style="width: 3vh;"><?= $no++; ?></td>
                <td>Protein</td>
                <td></td>
                <td><?= $data['protein']; ?></td>
            </tr>
            <tr>
                <td align="center" style="width: 3vh;"><?= $no++; ?></td>
                <td>Golongan Darah</td>
                <td></td>
                <td><?= $data['golongan_darah']; ?></td>
            </tr>
        </tbody>
    </table>

    <div style="margin-top: 10px;">
        Kesimpulan Pemeriksaan :
        <span style="text-align: justify;"><?= $data['kesimpulan']; ?></span>
    </div>

    <div class="ttd">
        Mengkatip, <?= date('d-m-Y', strtotime($data['tgl_hasil'])); ?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <?= $data_dokter['nama']; ?> <br>
        <?= 'Poli ' . $data_dokter['poli']; ?> <br>
        <?= 'NIP' . $data_dokter['nip']; ?>
    </div>

</body>


<script type="text/javascript">
    window.print();
</script>

</html>