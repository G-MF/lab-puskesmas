<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

$bln = [
    "01" => "Januari",
    "02" => "Februari",
    "03" => "Maret",
    "04" => "April",
    "05" => "Mei",
    "06" => "Juni",
    "07" => "Juli",
    "08" => "Agustus",
    "09" => "September",
    "10" => "Oktober",
    "11" => "November",
    "12" => "Desember"
];

if (isset($_POST['cetak'])){
    $id_dokter = $_POST['id_dokter'];
    $bulan     = $_POST['bulan'];
    $tahun     = $_POST['tahun'];

    $data      = $koneksi->query("SELECT * FROM hasil_pemeriksaan h INNER JOIN pemeriksaan pm ON h.id_pemeriksaan = pm.id_pemeriksaan INNER JOIN penerimaan p ON pm.id_penerimaan = p.id_penerimaan INNER JOIN dokter d ON pm.id_dokter = d.id_dokter INNER JOIN nomor_antri n ON p.id_antri = n.id_antri WHERE pm.id_dokter = '$id_dokter' AND MONTH(h.tgl_hasil) = '$bulan' AND YEAR(h.tgl_hasil) = '$tahun' ORDER BY h.id_hasil DESC");

    $sum_data  = $koneksi->query("SELECT SUM(h.biaya) as total_biaya FROM hasil_pemeriksaan h INNER JOIN pemeriksaan pm ON h.id_pemeriksaan = pm.id_pemeriksaan INNER JOIN penerimaan p ON pm.id_penerimaan = p.id_penerimaan INNER JOIN dokter d ON pm.id_dokter = d.id_dokter INNER JOIN nomor_antri n ON p.id_antri = n.id_antri WHERE pm.id_dokter = '$id_dokter' AND MONTH(h.tgl_hasil) = '$bulan' AND YEAR(h.tgl_hasil) = '$tahun'")->fetch_array();

    $nama_dokter = $koneksi->query("SELECT * FROM dokter WHERE id_dokter = '$id_dokter'")->fetch_array();
}else{
    $id_dokter = '';
    $bulan     = '';
    $tahun     = '';

    $data      = $koneksi->query("SELECT * FROM hasil_pemeriksaan h INNER JOIN pemeriksaan pm ON h.id_pemeriksaan = pm.id_pemeriksaan INNER JOIN penerimaan p ON pm.id_penerimaan = p.id_penerimaan INNER JOIN dokter d ON pm.id_dokter = d.id_dokter INNER JOIN nomor_antri n ON p.id_antri = n.id_antri ORDER BY h.id_hasil DESC");

    $sum_data  = $koneksi->query("SELECT SUM(h.biaya) as total_biaya FROM hasil_pemeriksaan h INNER JOIN pemeriksaan pm ON h.id_pemeriksaan = pm.id_pemeriksaan INNER JOIN penerimaan p ON pm.id_penerimaan = p.id_penerimaan INNER JOIN nomor_antri n ON p.id_antri = n.id_antri")->fetch_array();
}


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
        LAPORAN PENDAPATAN DOKTER 
        <?php if(isset($_POST['cetak'])): ?>
            <br>
            <?= strtoupper($nama_dokter['nama']); ?> <br>
            <span style="font-size: 15px;"><?= "Bulan ". $bln[$bulan]. " Tahun ". $tahun  ?></span>
        <?php endif; ?>
    </div>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Dokter</th>
                <th>Nama Pasien</th>
                <th>Keterangan</th>
                <th>Biaya</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $data->fetch_array()) :
                $data_pasien = $koneksi->query("SELECT * FROM pasien WHERE id_pasien = '$row[id_pasien]'")->fetch_array();
            ?>
                <tr>
                    <td align="center"><?= $no++; ?></td>
                    <td align="center"><?= date('d-m-Y', strtotime($row['tgl_hasil'])); ?></td>
                    <td><?= $row[24]; ?></td>
                    <td><?= $data_pasien['nama']; ?></td>
                    <td><?= $row['keterangan']; ?></td>
                    <td align="right"><?= number_format($row['biaya'], 0, ',', '.'); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
        <tfoot>
            <tr align="right">
                <th colspan="5">Total Pendapatan</th>
                <th><?= number_format($sum_data['total_biaya'], 0, ',', '.') ?></th>
            </tr>
        </tfoot>
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