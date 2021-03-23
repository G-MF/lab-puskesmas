<?php
session_start();

unset($_SESSION['id_user']);
unset($_SESSION['username']);
unset($_SESSION['role']);

if (isset($_SESSION['nama_pasien'])) {
    unset($_SESSION['nama_pasien']);
}

session_unset();
session_destroy();

header("location: http://lab-puskesmas.test", true, 301);
