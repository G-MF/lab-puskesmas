<footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.2
    </div>
</footer>

<!-- Delete Modal-->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="<?= base_url('assets/img/trash1.png') ?>" class="mb-3" style="width: 120px; height: 150px;">
                <h5><b>Data "<span id="name" style="text-decoration: underline;"></span>" Akan Dihapus, Lanjutkan?</b></h5>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="#" class="btn bg-gradient-danger text-white tombol-delete">
                    <i class="fa fa-check"> Ya</i>
                </a>
                <button class="btn bg-gradient-secondary text-white" type="button" data-dismiss="modal">
                    <i class="fa fa-times"> Batal</i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ModalLaporan -->
<div class="modal fade" id="modal-laporan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-bold" id="exampleModalLabel">Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div id="accordion">

                    <!-- DOKTER -->
                    <div class="card">
                        <a href="<?= base_url('admin/laporan/dokter') ?>" class="btn bg-gradient-navy btn-lg btn-block" target="_blank">
                            Dokter
                        </a>
                    </div>


                    <!-- PASIEN -->
                    <div class="card">
                        <a class="btn bg-gradient-navy btn-lg btn-block" data-toggle="collapse" data-parent="#accordion" href="#pasien">
                            Pasien
                        </a>
                        <div id="pasien" class="panel-collapse collapse">
                            <form role="form" method="POST" target="_blank" action="<?= base_url('admin/laporan/pasien') ?>">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Cetak Berdasarkan Jenis Kelamin</label>
                                        <select name="jk" class="form-control custom-select">
                                            <option selected disabled>-Pilih-</option>
                                            <option value="1">Laki-laki</option>
                                            <option value="2">Perempuan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" name="cetak" class="btn bg-gradient-primary">
                                        <i class="fa fa-print"> Cetak</i>
                                    </button>
                                    <button type="submit" name="cetak_semua" class="btn bg-gradient-info">
                                        <i class="fa fa-print"> Cetak Semua Data</i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>



                    <!-- PEMERIMAAN -->
                    <div class="card">
                        <a class="btn bg-gradient-navy btn-lg btn-block" data-toggle="collapse" data-parent="#accordion" href="#penerimaan">
                            Penerimaan Pasien
                        </a>
                        <div id="penerimaan" class="panel-collapse collapse">
                            <form role="form" method="POST" target="_blank" action="<?= base_url('admin/laporan/penerimaan-pasien') ?>">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Cetak Dari Tanggal</label>
                                                <input type="date" class="form-control" name="tgl1" id="tgl1_penerimaan">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Sampai Tanggal</label>
                                                <input type="date" class="form-control" name="tgl2" id="tgl2_penerimaan">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <div class="my-auto">
                                                    <button type="button" id="cek_cetak_pertanggal_penerimaan" class="btn bg-gradient-primary">
                                                        <i class="fa fa-print"> Cetak</i>
                                                    </button>
                                                    <button type="submit" class="d-none" name="cetak_pertanggal" id="cetak_pertanggal_penerimaan"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Cetak Per Bulan</label>
                                                <select class="form-control select2" name="bulan" data-placeholder="Pilih Bulan">
                                                    <option value=""></option>
                                                    <option value="01">Januari</option>
                                                    <option value="02">Februari</option>
                                                    <option value="03">Maret</option>
                                                    <option value="04">April</option>
                                                    <option value="05">Mei</option>
                                                    <option value="06">Juni</option>
                                                    <option value="07">Juli</option>
                                                    <option value="08">Agustus</option>
                                                    <option value="09">September</option>
                                                    <option value="10">Oktober</option>
                                                    <option value="11">November</option>
                                                    <option value="12">Desember</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Tahun</label>
                                                <input type="number" class="form-control" name="tahun" maxlength="4" value="<?= date('Y') ?>" id="tahun_penerimaan">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <div class="my-auto">
                                                    <button type="button" id="cek_cetak_perbulan_penerimaan" class="btn bg-gradient-primary">
                                                        <i class="fa fa-print"> Cetak</i>
                                                    </button>
                                                    <button type="submit" class="d-none" name="cetak_perbulan" id="cetak_perbulan_penerimaan"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <button type="submit" name="cetak_semua" class="btn bg-gradient-info">
                                        <i class="fa fa-print"> Cetak Semua Data</i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>



                    <!-- PEMERIKSAAN -->
                    <div class="card">
                        <a class="btn bg-gradient-navy btn-lg btn-block" data-toggle="collapse" data-parent="#accordion" href="#pemeriksaan">
                            Pemeriksaan Pasien
                        </a>
                        <div id="pemeriksaan" class="panel-collapse collapse">
                            <form role="form" method="POST" target="_blank" action="<?= base_url('admin/laporan/pemeriksaan-pasien') ?>">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Cetak Dari Tanggal</label>
                                                <input type="date" class="form-control" name="tgl1" id="tgl1_pemeriksaan">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Sampai Tanggal</label>
                                                <input type="date" class="form-control" name="tgl2" id="tgl2_pemeriksaan">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <div class="my-auto">
                                                    <button type="button" id="cek_cetak_pertanggal_pemeriksaan" class="btn bg-gradient-primary">
                                                        <i class="fa fa-print"> Cetak</i>
                                                    </button>
                                                    <button type="submit" class="d-none" name="cetak_pertanggal" id="cetak_pertanggal_pemeriksaan"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Cetak Per Bulan</label>
                                                <select class="form-control select2" name="bulan" data-placeholder="Pilih Bulan">
                                                    <option value=""></option>
                                                    <option value="01">Januari</option>
                                                    <option value="02">Februari</option>
                                                    <option value="03">Maret</option>
                                                    <option value="04">April</option>
                                                    <option value="05">Mei</option>
                                                    <option value="06">Juni</option>
                                                    <option value="07">Juli</option>
                                                    <option value="08">Agustus</option>
                                                    <option value="09">September</option>
                                                    <option value="10">Oktober</option>
                                                    <option value="11">November</option>
                                                    <option value="12">Desember</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Tahun</label>
                                                <input type="number" class="form-control" name="tahun" maxlength="4" value="<?= date('Y') ?>" id="tahun_pemeriksaan">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <div class="my-auto">
                                                    <button type="button" id="cek_cetak_perbulan_pemeriksaan" class="btn bg-gradient-primary">
                                                        <i class="fa fa-print"> Cetak</i>
                                                    </button>
                                                    <button type="submit" class="d-none" name="cetak_perbulan" id="cetak_perbulan_pemeriksaan"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <button type="submit" name="cetak_semua" class="btn bg-gradient-info">
                                        <i class="fa fa-print"> Cetak Semua Data</i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>


                    <!-- HASIL PEMERIKSAAN -->
                    <div class="card">
                        <a href="<?= base_url('admin/laporan/hasil-pemeriksaan') ?>" class="btn bg-gradient-navy btn-lg btn-block" target="_blank">
                            Hasil Pemeriksaan
                        </a>
                    </div>



                <!-- PENDAPATAN DOKTER -->
                <div class="card">
                        <a class="btn bg-gradient-navy btn-lg btn-block" data-toggle="collapse" data-parent="#accordion" href="#pendapatan-dokter">
                            Pendapatan Dokter
                        </a>
                        <div id="pendapatan-dokter" class="panel-collapse collapse">
                            <form role="form" method="POST" target="_blank" action="<?= base_url('admin/laporan/pendapatan-dokter') ?>">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nama Dokter</label>
                                                <select class="form-control select2" name="id_dokter" data-placeholder="Pilih" required>
                                                    <option value=""></option>
                                                    <?php
                                                        $dokter = $koneksi->query("SELECT * FROM dokter ORDER BY nama ASC");
                                                        foreach($dokter as $row){
                                                    ?>
                                                    `<option value="<?= $row['id_dokter'] ?>"><?= $row['nama'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Bulan</label>
                                                <select class="form-control select2" name="bulan" data-placeholder="Pilih Bulan" required>
                                                    <option value=""></option>
                                                    <option value="01">Januari</option>
                                                    <option value="02">Februari</option>
                                                    <option value="03">Maret</option>
                                                    <option value="04">April</option>
                                                    <option value="05">Mei</option>
                                                    <option value="06">Juni</option>
                                                    <option value="07">Juli</option>
                                                    <option value="08">Agustus</option>
                                                    <option value="09">September</option>
                                                    <option value="10">Oktober</option>
                                                    <option value="11">November</option>
                                                    <option value="12">Desember</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tahun</label>
                                                <input type="number" class="form-control" name="tahun" required maxlength="4" value="<?= date('Y') ?>" id="tahun_pemeriksaan">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <div class="my-auto">
                                                    <button type="submit" name="cetak" class="btn bg-gradient-primary">
                                                        <i class="fa fa-print"> Cetak</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <button type="submit" name="cetak_semua" class="btn bg-gradient-info">
                                        <i class="fa fa-print"> Cetak Semua Data</i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<script>
    // CEK VALIDASI PENERIMAAN
    $('#cek_cetak_pertanggal_penerimaan').click(function() {
        let tgl1 = $('#tgl1_penerimaan').val();
        let tgl2 = $('#tgl2_penerimaan').val();
        if (tgl1 == '' || tgl2 == '') {
            toastr.error('Pilih Kedua Tanggal Untuk Cetak Laporan!');
        } else {
            $('#cetak_pertanggal_penerimaan').click();
        }
    });
    $('#cek_cetak_perbulan_penerimaan').click(function() {
        let tahun = $('#tahun_penerimaan').val();
        if (tahun == '') {
            toastr.error('Tahun Tidak Boleh Kosong');
        } else {
            $('#cetak_perbulan_penerimaan').click();
        }
    });

    // CEK VALIDASI PEMERIKSAAN
    $('#cek_cetak_pertanggal_pemeriksaan').click(function() {
        let tgl1 = $('#tgl1_pemeriksaan').val();
        let tgl2 = $('#tgl2_pemeriksaan').val();
        if (tgl1 == '' || tgl2 == '') {
            toastr.error('Pilih Kedua Tanggal Untuk Cetak Laporan!');
        } else {
            $('#cetak_pertanggal_pemeriksaan').click();
        }
    });

    $('#cek_cetak_perbulan_pemeriksaan').click(function() {
        let tahun = $('#tahun_pemeriksaan').val();
        if (tahun == '') {
            toastr.error('Tahun Tidak Boleh Kosong');
        } else {
            $('#cetak_perbulan_pemeriksaan').click();
        }
    });
</script>

<?php
// if (isset($_SESSION['alert_ubah_pw'])) {
//     echo "<script>toastr.$_SESSION[sts]('$_SESSION[alert_ubah_pw]')</script>";
//     unset($_SESSION['sts']);
//     unset($_SESSION['alert_ubah_pw']);
// }
?>
<!-- Change Passowrd Modal-->
<!-- <div class="modal fade" id="modal-edit-pw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Ubah Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/edit-password') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" value="<?= $_SESSION['username'] ?>" maxlength="10" required>
                    </div>
                    <div class="form-group">
                        <label for="pass_lama">Password Lama</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="pass_lama" id="pass_lama" minlength="5" maxlength="10" required>
                            <div class="input-group-append" id="btn_lama">
                                <button type="button" class="btn bg-gradient-dark" onclick="lihatpass('pass_lama');" title="Tampilkan Password"><i class="fas fa-eye-slash"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pass_lama">Password Baru</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="pass_baru" id="pass_baru" minlength="5" maxlength="10" required>
                            <div class="input-group-append" id="btn_baru">
                                <button type="button" class="btn bg-gradient-dark" onclick="lihatpass('pass_baru');" title="Tampilkan Password"><i class="fas fa-eye-slash"></i></button>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted font-italic">*Password Minimal 5 Karakter | Maksimal 10 Karakter</small>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn bg-gradient-primary text-white" type="submit" name="edit-pw">
                        <i class="fa fa-save"> Simpan</i>
                    </button>
                    <button class="btn bg-gradient-dark text-white" type="button" data-dismiss="modal">
                        <i class="fa fa-times"> Batal</i>
                    </button>
                </div>
            </form>
        </div>

    </div>
</div> -->


<!-- Logout Modal-->
<div class="modal fade" id="modal-logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="<?= base_url('assets/img/logout-icon.png') ?>" class="mb-3" style="width: 120px; height: 150px;">
                <h5>Anda Akan Keluar Dari Aplikasi, Lanjutkan?</h5>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="<?= base_url('logout') ?>" class="btn bg-gradient-danger text-white tombol-delete">
                    <i class="fa fa-check"> Ya</i>
                </a>
                <button class="btn bg-gradient-secondary text-white" type="button" data-dismiss="modal">
                    <i class="fa fa-times"> Batal</i>
                </button>
            </div>
        </div>
    </div>
</div>