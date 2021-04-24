<?php
require_once 'config/config.php';

$id   = isset($_GET['id']) ? $_GET['id'] : header("location: /", true, 301);
$data = $koneksi->query("SELECT * FROM pasien WHERE id_user = '$id'")->fetch_array();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Pasien</title>

    <style>
        @page {
            size: 86mm 46mm;
            margin: 0.5mm 0.5mm 0.5mm 0.5mm;
        }

        .kop {
            justify-content: space-between;
            font-size: 11px;
            line-height: 11px;
            font-weight: bold;
            text-align: center;
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        .alamat {
            font-size: 6px;
            /* text-decoration: underline; */
            font-style: italic;
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
            width: 23px;
            height: 30px;
        }

        .gambar-puskes {
            width: 25px;
            height: 30px;
        }

        .judul {
            text-align: center;
            font-size: 9px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 3px;
        }

        .kotak {
            font-size: 5px;
            width: 100%;
            height: 100%;
            border: 1px solid black;
        }

        table {
            height: 70px;
            font-size: 8px;
        }

        th {
            text-align: left;
            width: 78px;
        }

        .titik-tabel {
            width: 3px;
            text-align: center;
        }

        .foot-tabel {
            text-align: center;
            font-size: 7px;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 3px;
        }

        .notif-bawah {
            font-style: italic;
            font-size: 6px;
            margin-bottom: 2px;
        }
    </style>
</head>

<body>

    <div class="kop">
        <img src="<?= base_url('assets/img/barito-selatan.png') ?>" class="gambar-kab">
        PEMERINTAH KABUPATEN BARITO SELATAN <br> DINAS KESEHATAN
        <img src="<?= base_url('assets/img/logo-puskes.png') ?>" class="gambar-puskes">
    </div>
    <div class="alamat">
        Jalan Kelurahan Mengkatip RT. 02 Rw. 01 Kode Pos 73762
    </div>

    <hr size="1.5" style="margin-top: -1.5px; margin-bottom: 5px; color: black; font-weight: bold;">

    <div class="judul">
        KARTU BEROBAT
    </div>

    <div class="kotak">
        <table width="100%" border="0">
            <tr>
                <th>ID Pasien</th>
                <td class="titik-tabel">:</td>
                <td><?= $data['kode_pasien'] ?></td>
            </tr>
            <tr>
                <th>Nama</th>
                <td class="titik-tabel">:</td>
                <td><?= $data['nama'] ?></td>
            </tr>
            <tr>
                <th>Tempat Tanggal Lahir</th>
                <td class="titik-tabel">:</td>
                <td><?= $data['tempat_lahir'] . ', ' . date('d-m-Y', strtotime($data['tgl_lahir'])); ?></td>
            </tr>
            <tr valign="top">
                <th>Alamat</th>
                <td class="titik-tabel">:</td>
                <td><?= $data['alamat'] ?></td>
            </tr>
        </table>

        <div class="foot-tabel">
            TERIMAKASIH ATAS KEPERCAYAAN ANDA
        </div>

        <div class="notif-bawah">
            *Setiap kali berobat kartu ini harus dibawa
        </div>
    </div>


    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>