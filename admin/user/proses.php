<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

// Simpan
if (isset($_POST['tambah'])) {
    $username = strip_tags($_POST['user']);
    $password = strip_tags($_POST['password']);
    $role     = strip_tags($_POST['role']);
    $pass     = md5($password);

    $cek_user = $koneksi->query("SELECT * FROM user WHERE username = '$username'")->fetch_array();
    if ($cek_user) {
        $_SESSION['alert'] = 'Username Sudah Ada!';
        header("location: tambah", true, 301);
    } else {

        $submit = $koneksi->query("INSERT INTO user VALUES(NULL, '$username', '$pass', '$role')");

        if ($submit) {
            $_SESSION['alert'] = "Data Berhasil Disimpan";
            header("location: ../user", true, 301);
        }
    }
} else

    // Edit
    if (isset($_POST['edit'])) {
        $id_user = $_POST['id_user'];
        $username = strip_tags($_POST['user']);
        $role     = strip_tags($_POST['role']);

        $cek_user_lain = $koneksi->query("SELECT * FROM user WHERE id_user != '$id_user'");
        foreach ($cek_user_lain as $item) {
            if ($username == $item['username']) {
                $_SESSION['alert'] = 'Username Sudah Ada!';
                header("location: edit?id=$id_user", true, 301);
                exit;
            } else {
                if ($role == 'superadmin') {
                    $pass_lama = md5(strip_tags($_POST['pass_lama']));
                    $pass_baru = md5(strip_tags($_POST['pass_baru']));

                    $cek_pw = $koneksi->query("SELECT * FROM user WHERE password = '$pass_lama'")->fetch_array();
                    if ($cek_pw) {
                        $submit = $koneksi->query("UPDATE user SET 
                        username = '$username', 
                        password = '$pass_baru', 
                        role     = '$role'
                        WHERE id_user = '$id_user'
                    ");
                    } else {
                        $_SESSION['alert'] = 'Password Lama Yang Anda Masukkan Salah!';
                        header("location: edit?id=$id_user", true, 301);
                        exit;
                    }
                } else {
                    $submit = $koneksi->query("UPDATE user SET 
                            username = '$username',  
                            role     = '$role'
                            WHERE id_user = '$id_user'
                        ");
                }

                if ($submit) {
                    $_SESSION['alert'] = "Data Berhasil Diubah";
                    header("location: ../user", true, 301);
                }
            }
        }
    } else

        // Hapus
        if (isset($_GET['id'])) {
            $hapus = $koneksi->query("DELETE FROM user WHERE id_user = '$_GET[id]'");

            if ($hapus) {
                $_SESSION['alert'] = "Data Berhasil Dihapus";
                header("location: ../user", true, 301);
            }
        }
