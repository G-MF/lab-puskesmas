<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

// Simpan
if (isset($_POST['tambah'])) {
    $nama   = strip_tags($_POST['nama']);
    $nip    = strip_tags($_POST['nip']);
    $jk     = strip_tags($_POST['jk']);
    $telpon = strip_tags($_POST['telpon']);
    $alamat = preg_replace("/(\r|\n)/", " ", strip_tags($_POST['alamat']));
    $poli   = strip_tags($_POST['poli']);

    $cek_nip  = $koneksi->query("SELECT * FROM dokter WHERE nip = '$nip'")->fetch_array();
    if ($cek_nip && !empty($nip)) {
        $_SESSION['alert'] = 'NIP Sudah Ada!';
        $_SESSION['valid'] = [
            'nama'   => $nama,
            'jk'     => $jk,
            'telpon' => $telpon,
            'alamat' => $alamat,
            'poli'   => $poli
        ];
        header("location: tambah", true, 301);
    } else {

        $submit = $koneksi->query("INSERT INTO dokter VALUES(
            NULL, '$nama', '$nip', '$jk', '$telpon', '$alamat', '$poli'
            )");

        if ($submit) {
            $_SESSION['alert'] = "Data Berhasil Disimpan";
            unset($_SESSION['valid']);
            header("location: ../dokter", true, 301);
        } else {
            $_SESSION['alert'] = 'Data Gagal Disimpan!';
            header("location: tambah", true, 301);
        }
    }
} else

    // Edit
    if (isset($_POST['edit'])) {
        $id_dokter = $_POST['id_dokter'];
        $nama      = strip_tags($_POST['nama']);
        $nip       = strip_tags($_POST['nip']);
        $jk        = strip_tags($_POST['jk']);
        $telpon    = strip_tags($_POST['telpon']);
        $alamat    = preg_replace("/(\r|\n)/", " ", strip_tags($_POST['alamat']));
        $poli      = strip_tags($_POST['poli']);

        $sts      = '';
        $cek_nip  = $koneksi->query("SELECT * FROM dokter WHERE id_dokter != '$id_dokter'");

        foreach ($cek_nip as $item) {
            if ($nip == $item['nip'] && !empty($nip)) {
                $_SESSION['alert'] = 'NIP Sudah Ada!';
                header("location: edit?id=$id_dokter", true, 301);
            } else {
                $sts .= 'next';
            }
        }

        if (!empty($sts)) {
            $submit = $koneksi->query("UPDATE dokter SET
                nama   = '$nama',
                nip    = '$nip',
                jk     = '$jk',
                telpon = '$telpon', 
                alamat = '$alamat', 
                poli   = '$poli'
                WHERE id_dokter = '$id_dokter'
            ");

            if ($submit) {
                $_SESSION['alert'] = "Data Berhasil Diubah";
                header("location: ../dokter", true, 301);
            } else {
                $_SESSION['alert'] = 'Data Gagal Diubah!';
                header("location: edit?id=$id_dokter", true, 301);
            }
        }
    } else

        // Hapus
        if (isset($_GET['id'])) {
            $hapus = $koneksi->query("DELETE FROM dokter WHERE id_dokter = '$_GET[id]'");

            if ($hapus) {
                $_SESSION['alert'] = "Data Berhasil Dihapus";
                header("location: ../dokter", true, 301);
            }
        }
