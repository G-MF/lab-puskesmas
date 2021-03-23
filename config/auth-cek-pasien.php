<?php

if (!isset($_SESSION['nama_pasien'])) {
    header("location: http://lab-puskesmas.test", true, 301);
}