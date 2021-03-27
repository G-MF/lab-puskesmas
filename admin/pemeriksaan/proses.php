<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

// Simpan
if (isset($_POST['tambah'])) {
    $id_penerimaan  = strip_tags($_POST['id_penerimaan']);
    $no_antri       = strip_tags($_POST['no_antri']);
    $nama           = strip_tags($_POST['nama']);
    $keterangan     = strip_tags($_POST['keterangan']);
    $id_dokter      = strip_tags($_POST['id_dokter']);
    $tgl_periksa    = $_POST['tgl_periksa'];
    $jam_periksa    = $_POST['jam_periksa'];

    $cek  = $koneksi->query("SELECT * FROM pemeriksaan WHERE id_penerimaan = '$id_penerimaan' AND tgl_periksa = '$tgl_periksa'")->fetch_array();
    if ($cek) {
        $_SESSION['alert'] = 'ID Penerimaan Sudah Ada!';
        $_SESSION['valid'] = [
            'id_penerimaan' => $id_penerimaan,
            'no_antri'      => $no_antri,
            'nama'          => $nama,
            'keterangan'    => $keterangan,
            'id_dokter'     => $id_dokter
        ];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {

        $submit = $koneksi->query("INSERT INTO pemeriksaan VALUES(NULL, '$id_penerimaan', '$id_dokter', '$tgl_periksa', '$jam_periksa')");

        if ($submit) {
            $_SESSION['alert'] = "Data Berhasil Disimpan";
            unset($_SESSION['valid']);
            header("location: ../pemeriksaan", true, 301);
        } else {
            $_SESSION['alert'] = 'Data Gagal Disimpan!';
            $_SESSION['valid'] = [
                'id_penerimaan' => $id_penerimaan,
                'no_antri'      => $no_antri,
                'nama'          => $nama,
                'keterangan'    => $keterangan,
                'id_dokter'     => $id_dokter
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
} else

    // Edit
    if (isset($_POST['edit'])) {
        $id_pemeriksaan = strip_tags($_POST['id_pemeriksaan']);
        $id_penerimaan  = strip_tags($_POST['id_penerimaan']);
        $no_antri       = strip_tags($_POST['no_antri']);
        $nama           = strip_tags($_POST['nama']);
        $keterangan     = strip_tags($_POST['keterangan']);
        $id_dokter      = strip_tags($_POST['id_dokter']);
        $tgl_periksa    = $_POST['tgl_periksa'];
        $jam_periksa    = $_POST['jam_periksa'];

        $cek  = $koneksi->query("SELECT * FROM pemeriksaan WHERE id_pemeriksaan != '$id_pemeriksaan' AND tgl_periksa = '$tgl_periksa'")->fetch_array();
        if ($cek['id_penerimaan'] == $id_penerimaan) {
            $_SESSION['alert'] = 'ID Penerimaan Sudah Ada!';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {

            $submit = $koneksi->query("UPDATE pemeriksaan SET
               id_penerimaan = '$id_penerimaan', 
               id_dokter     = '$id_dokter', 
               tgl_periksa   = '$tgl_periksa', 
               jam_periksa   = '$jam_periksa'
               WHERE id_pemeriksaan = '$id_pemeriksaan'
            ");

            if ($submit) {
                $_SESSION['alert'] = "Data Berhasil Disimpan";
                header("location: ../pemeriksaan", true, 301);
            } else {
                $_SESSION['alert'] = 'Data Gagal Disimpan!';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    } else

        // Hapus
        if (isset($_GET['id'])) {
            $hapus = $koneksi->query("DELETE FROM pemeriksaan WHERE id_pemeriksaan = '$_GET[id]'");

            if ($hapus) {
                $_SESSION['alert'] = "Data Berhasil Dihapus";
                header("location: ../pemeriksaan", true, 301);
            }
        }

// Ambil Data Nomor Antrian
if (isset($_POST['id_penerimaan'])) {
    $id_penerimaan = $_POST['id_penerimaan'];
    $data          = $koneksi->query("SELECT * FROM penerimaan p INNER JOIN nomor_antri n ON p.id_antri = n.id_antri INNER JOIN pasien pn ON n.id_pasien = pn.id_pasien WHERE p.id_penerimaan = '$id_penerimaan'")->fetch_array();

    echo json_encode($data);
}
