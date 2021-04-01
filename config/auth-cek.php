<?php

if (!isset($_SESSION['id_user'])) {
    header("location: http://lab-puskesmas.test", true, 301);
}
