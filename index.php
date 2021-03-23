<?php require_once 'config/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<?php include_once 'templates/public/head.php'; ?>
<style>
    .kop {
        justify-content: space-between;
        font-size: 25px;
        font-weight: bold;
        line-height: 30px;
        text-align: center;
        position: relative;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        margin-bottom: 15px;
    }

    .gambar-kab {
        width: 70px;
        height: 90px;
    }

    .gambar-puskes {
        width: 80px;
        height: 90px;
    }

    .judul {
        line-height: 25px;
    }

    .nama-puskes {
        font-size: 50px;
    }

    .nama-kec {
        font-size: 25px;
    }

    .alamat {
        font-size: 15px;
    }

    .gambar-kantor {
        width: 50%;
        height: 50%;
    }

    @media only screen and (max-width: 768px) {
        .kop {
            justify-content: space-between;
            font-size: 12px;
            font-weight: bold;
            line-height: 15px;
            text-align: center;
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            margin-bottom: 15px;
        }

        .gambar-kab {
            width: 30px;
            height: 40px;
        }

        .gambar-puskes {
            width: 35px;
            height: 40px;
        }

        .judul {
            line-height: 10px;
        }

        .nama-puskes {
            font-size: 20px;
        }

        .nama-kec {
            font-size: 12px;
        }

        .alamat {
            font-size: 9px;
        }

        .gambar-kantor {
            width: 300px;
            height: 150px;
        }
    }
</style>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include_once 'templates/public/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h4 class="m-0 text-bold">
                                <?php if (isset($_SESSION['role']) == 'pasien') : ?>
                                    Selamat Datang <u><i><?= $_SESSION['nama_pasien'] ?></i></u> ! <br>
                                    Di Pelayanan UPTD Puskesmas Mengkatip
                                <?php else : ?>
                                    Selamat Datang Di Pelayanan UPTD Puskesmas Mengkatip
                                <?php endif; ?>
                            </h4>
                        </div>
                        <!-- <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Layout</a></li>
                                <li class="breadcrumb-item active">Top Navigation</li>
                            </ol>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="card card-olive card-outline">
                                <div class="card-body">
                                    <!-- <h5 class="card-title">Card title</h5> -->
                                    <div class="kop">
                                        <img src="<?= base_url('assets/img/barito-selatan.png') ?>" class="gambar-kab">
                                        PEMERINTAH KABUPATEN BARITO SELATAN <br> DINAS KESEHATAN
                                        <img src="<?= base_url('assets/img/logo-puskes.png') ?>" class="gambar-puskes">
                                    </div>

                                    <div style="text-align: center;" class="judul">
                                        <label class="nama-puskes">UPTD PUSKESMAS MENGKATIP</label> <br>
                                        <label class="nama-kec">KECAMATAN DUSUN HILIR</label>
                                    </div>

                                    <div style="text-align: center;">
                                        <label class="alamat">
                                            Alamat : Jalan Kelurahan Mengkatip, Kec. Dusun Hilir, Kabupaten Barito Selatan, Kalimantan Tengah 73762 <br>
                                            Telpon : 0815-8495-5500
                                        </label>
                                        <img src="<?= base_url('assets/img/puskes.jpeg') ?>" class="gambar-kantor">
                                        <!-- <iframe class="text-center" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.8354549413702!2d114.84666601475533!3d-2.215669398385028!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dfb2b4000000001%3A0x9f86f09efaede4f!2sUPTD%20Puskesmas%20Mengkatip!5e0!3m2!1sid!2sid!4v1616342184824!5m2!1sid!2sid" width="250" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <?php include_once 'templates/public/footer.php'; ?>

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <?php include_once 'templates/public/script.php'; ?>

</body>

</html>