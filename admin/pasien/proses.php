<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

// Simpan
if (isset($_POST['tambah'])) {
    $kode_pasien  = $_POST['kode_pasien'];
    $no_ktp       = strip_tags($_POST['no_ktp']);
    $nama         = strip_tags($_POST['nama']);
    $jk           = strip_tags($_POST['jk']);
    $tempat_lahir = strip_tags($_POST['tempat_lahir']);
    $tgl_lahir    = strip_tags($_POST['tgl_lahir']);
    $alamat       = preg_replace("/(\r|\n)/", " ", strip_tags($_POST['alamat']));
    $telpon       = strip_tags($_POST['telpon']);
    $username     = strip_tags($_POST['username']);
    $pass         = md5('12345');

    $cek_ktp  = $koneksi->query("SELECT * FROM pasien WHERE no_ktp = '$no_ktp'")->fetch_array();
    $cek_user = $koneksi->query("SELECT * FROM user WHERE username = '$username'")->fetch_array();

    if ($cek_ktp) {
        $_SESSION['alert'] = 'Nomor KTP Sudah Ada!';
        $_SESSION['valid'] = [
            'no_ktp'       => '',
            'nama'         => $nama,
            'jk'           => $jk,
            'tempat_lahir' => $tempat_lahir,
            'tgl_lahir'    => $tgl_lahir,
            'alamat'       => $alamat,
            'telpon'       => $telpon,
            'username'     => $username
        ];
        header("location: tambah", true, 301);
    } else
    if ($cek_user) {
        $_SESSION['alert'] = 'Username Sudah Ada!';
        $_SESSION['valid'] = [
            'no_ktp'       => $no_ktp,
            'nama'         => $nama,
            'jk'           => $jk,
            'tempat_lahir' => $tempat_lahir,
            'tgl_lahir'    => $tgl_lahir,
            'alamat'       => $alamat,
            'telpon'       => $telpon,
            'username'     => ''
        ];
        header("location: tambah", true, 301);
    } else {

        $submit   = $koneksi->query("INSERT INTO user VALUES(NULL, '$username', '$pass', 'pasien')");

        if ($submit) {
            $ambil_id = $koneksi->query("SELECT * FROM user ORDER BY id_user DESC LIMIT 1")->fetch_array();
            $simpan   = $koneksi->query("INSERT INTO pasien VALUES(
            NULL, '$kode_pasien', '$no_ktp', '$nama', '$jk', '$tempat_lahir', '$tgl_lahir', '$alamat', '$telpon', '$ambil_id[id_user]'
            )");
            if ($simpan) {
                $_SESSION['alert'] = "Data Berhasil Disimpan";
                header("location: ../pasien", true, 301);
                unset($_SESSION['valid']);
            } else {
                $_SESSION['alert'] = 'Data Gagal Disimpan!';
                header("location: tambah", true, 301);
            }
        } else {
            $_SESSION['alert'] = 'Data Gagal Disimpan!';
            header("location: tambah", true, 301);
        }
    }
} else

    // Edit
    if (isset($_POST['edit'])) {
        $id_pasien    = $_POST['id_pasien'];
        $id_user      = $_POST['id_user'];
        $no_ktp       = strip_tags($_POST['no_ktp']);
        $nama         = strip_tags($_POST['nama']);
        $jk           = strip_tags($_POST['jk']);
        $tempat_lahir = strip_tags($_POST['tempat_lahir']);
        $tgl_lahir    = strip_tags($_POST['tgl_lahir']);
        $alamat       = preg_replace("/(\r|\n)/", " ", strip_tags($_POST['alamat']));
        $telpon       = strip_tags($_POST['telpon']);
        $username     = strip_tags($_POST['username']);


        $data_ktp  = $koneksi->query("SELECT * FROM pasien WHERE id_pasien = '$id_pasien'")->fetch_array();
        $data_user = $koneksi->query("SELECT * FROM user WHERE id_user = '$id_user'")->fetch_array();

        $sts = '';

        $cek_ktp  = $koneksi->query("SELECT * FROM pasien WHERE no_ktp != '$data_ktp[no_ktp]'");
        $cek_user = $koneksi->query("SELECT * FROM user WHERE username != '$data_user[username]'");

        foreach ($cek_ktp as $item) {
            if ($no_ktp == $item['no_ktp']) {
                $_SESSION['alert'] = 'Nomor KTP Sudah Ada!';
                header("location: edit?id=$id_pasien", true, 301);
                exit;
            } else {
                $sts .= 'next';
            }
        }
        foreach ($cek_user as $item) {
            if ($username == $item['username']) {
                $_SESSION['alert'] = 'Username Sudah Ada!';
                header("location: edit?id=$id_pasien", true, 301);
                exit;
            } else {
                $sts .= 'next';
            }
        }

        if (!empty($sts)) {
            $submit = $koneksi->query("UPDATE user SET username = '$username' WHERE id_user = '$id_user'");
            if ($submit) {
                $simpan = $koneksi->query("UPDATE pasien SET
                    no_ktp          = '$no_ktp',
                    nama            = '$nama',
                    jk              = '$jk',
                    tempat_lahir    = '$tempat_lahir',
                    tgl_lahir       = '$tgl_lahir', 
                    alamat          = '$alamat', 
                    telpon          = '$telpon', 
                    id_user         = '$id_user'
                    WHERE id_pasien = '$id_pasien'
                ");
                if ($simpan) {
                    $_SESSION['alert'] = "Data Berhasil Diubah";
                    header("location: ../pasien", true, 301);
                } else {
                    $_SESSION['alert'] = 'Data Gagal Diubah!';
                    header("location: edit?id=$id_pasien", true, 301);
                }
            } else {
                $_SESSION['alert'] = 'Data Gagal Diubah!';
                header("location: edit?id=$id_pasien", true, 301);
            }
        }
    } else

        // Hapus
        if (isset($_GET['id'])) {
            $data  = $koneksi->query("SELECT * FROM pasien WHERE id_pasien = '$_GET[id]'")->fetch_array();

            $hapus = $koneksi->query("DELETE FROM pasien WHERE id_pasien = '$_GET[id]'");

            if ($hapus) {
                $koneksi->query("DELETE FROM user WHERE id_user = '$data[id_user]'");
                $_SESSION['alert'] = "Data Berhasil Dihapus";
                header("location: ../pasien", true, 301);
            }
        }
