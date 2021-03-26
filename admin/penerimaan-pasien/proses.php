<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

// Simpan
if (isset($_POST['tambah'])) {
    $id_antri       = strip_tags($_POST['id_antri']);
    $nama           = strip_tags($_POST['nama']);
    $keterangan     = strip_tags($_POST['keterangan']);
    $tgl_penerimaan = $_POST['tgl_penerimaan'];
    $jam_periksa    = $_POST['jam_periksa'];

    $cek  = $koneksi->query("SELECT * FROM penerimaan p INNER JOIN nomor_antri n ON p.id_antri = n.id_antri INNER JOIN pasien pn ON n.id_pasien = pn.id_pasien WHERE n.id_antri = '$id_antri' AND tgl_penerimaan = '$tgl_penerimaan'")->fetch_array();
    if ($cek) {
        $_SESSION['alert'] = 'Nomor Antrian Sudah Ada!';
        $_SESSION['valid'] = [
            'id_antri'   => $id_antri,
            'nama'       => $nama,
            'keterangan' => $keterangan
        ];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {

        $submit = $koneksi->query("INSERT INTO penerimaan VALUES(NULL, '$id_antri', '$tgl_penerimaan', '$jam_periksa')");

        if ($submit) {
            $_SESSION['alert'] = "Data Berhasil Disimpan";
            unset($_SESSION['valid']);
            header("location: ../penerimaan-pasien", true, 301);
        } else {
            $_SESSION['alert'] = 'Data Gagal Disimpan!';
            header("location: tambah", true, 301);
        }
    }
} else

    // Edit
    if (isset($_POST['edit'])) {
        $id_penerimaan  = $_POST['id_penerimaan'];
        $id_antri       = strip_tags($_POST['id_antri']);
        $tgl_penerimaan = $_POST['tgl_penerimaan'];
        $jam_periksa    = $_POST['jam_periksa'];

        $submit = $koneksi->query("UPDATE penerimaan SET
            id_antri       = '$id_antri', 
            tgl_penerimaan = '$tgl_penerimaan',
            jam_periksa    = '$jam_periksa'
            WHERE id_penerimaan = '$id_penerimaan'
        ");

        if ($submit) {
            $_SESSION['alert'] = "Data Berhasil Diubah";
            header("location: ../penerimaan-pasien", true, 301);
        } else {
            $_SESSION['alert'] = 'Data Gagal Diubah!';
            header("location: edit?id=$id_penerimaan", true, 301);
        }
    } else

        // Hapus
        if (isset($_GET['id'])) {
            $hapus = $koneksi->query("DELETE FROM penerimaan WHERE id_penerimaan = '$_GET[id]'");

            if ($hapus) {
                $_SESSION['alert'] = "Data Berhasil Dihapus";
                header("location: ../penerimaan-pasien", true, 301);
            }
        }

// Ambil Data Nomor Antrian
if (isset($_POST['id_antri'])) {
    $id_antri = $_POST['id_antri'];
    $data     = $koneksi->query("SELECT * FROM nomor_antri n INNER JOIN pasien p ON n.id_pasien = p.id_pasien WHERE n.id_antri = '$id_antri'")->fetch_array();

    echo json_encode($data);
}
