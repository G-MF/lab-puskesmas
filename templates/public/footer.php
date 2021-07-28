<footer class="main-footer" style="background-color: #3d9970; color: white;">
    <div class="container justify-content-center text-center">
        <strong>Copyright &copy; UPTD PUSKESMAS MENGKATIP 2021
    </div>
</footer>



<!-- MODAL NOMOR ANTRI -->
<div class="modal fade" id="modal-no-antri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Ambil Nomor Antri Pelayanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php
            function set_nomor_antri($angka)
            {
                if ($angka < 100 && $angka > 9) {
                    return '0' . $angka;
                } elseif ($angka > 99) {
                    return $angka;
                } else {
                    return '00' . $angka;
                }
            }
            $tgl      = date('Y-m-d');
            $ceknomor = $koneksi->query("SELECT MAX(no_antri) AS nomor FROM nomor_antri WHERE tanggal = '$tgl'")->fetch_array();

            if ($ceknomor['nomor'] <= 99) {
                $cek_no_pasien = $koneksi->query("SELECT * FROM nomor_antri WHERE id_pasien = '$_SESSION[id_pasien]' AND tanggal = '$tgl' ORDER BY no_antri DESC")->fetch_array();
                if ($cek_no_pasien && $cek_no_pasien['status'] == 'Belum Selesai') { ?>
                    <div class="modal-body">
                        <h5>Mohon Maaf Anda Sudah Mengambil Nomor Antrian, Silahkan Selesaikan Layanan Yang Anda Ambil Pada Nomor Antrian Sebelumnya!</h5>
                        <div class="dropdown-divider"></div>
                        <h4 class="text-center font-weight-bold">
                            Nomor Antrian Anda Saat Ini : <br>
                            <u><?= $cek_no_pasien['no_antri']; ?></u>
                        </h4>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button class="btn bg-gradient-dark text-white" type="button" data-dismiss="modal">
                            <i class="fa fa-times"> Tutup</i>
                        </button>
                    </div>
                <?php } elseif (($cek_no_pasien && $cek_no_pasien['status'] == 'Selesai') or (!$cek_no_pasien)) {
                    $no_antri = set_nomor_antri($ceknomor['nomor'] + 1)
                ?>
                    <form action="" method="POST">
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="no_antri">Nomor Antri</label>
                                <input type="text" class="form-control" name="no_antri" id="no_antri" value="<?= $no_antri ?>" readonly required>
                            </div>

                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?= $tgl ?>" readonly required>
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <!-- <textarea class="form-control" name="keterangan" id="keterangan" rows="3" placeholder="Isi Keperluan Anda" required></textarea> -->
                                <select name="keterangan" id="keterangan" class="form-control" required>
                                    <option value="" selected disabled>--Pilih Keperluan Anda--</option>
                                    <option value="Leucosit">Leucosit</option>
                                    <option value="Trombosit">Trombosit</option>
                                    <option value="Malaria">Malaria</option>
                                    <option value="Rapid Covid 19">Rapid Covid 19</option>
                                    <option value="GDS">GDS</option>
                                    <option value="GDP">GDP</option>
                                    <option value="Cholesterol">Cholesterol</option>
                                    <option value="Trigliserida">Trigliserida</option>
                                    <option value="Protein">Protein</option>
                                    <option value="Golongan Darah">Golongan Darah</option>
                                </select>
                            </div>

                        </div>

                        <div class="modal-footer justify-content-center">
                            <button class="btn bg-gradient-primary text-white" type="submit" name="no-antri">
                                <i class="fa fa-save"> Simpan</i>
                            </button>
                            <button class="btn bg-gradient-dark text-white" type="button" data-dismiss="modal">
                                <i class="fa fa-times"> Batal</i>
                            </button>
                        </div>
                    </form>
                <?php }
            } elseif ($ceknomor['nomor'] == 100) { ?>
                <div class="modal-body text-justify">
                    <h5>Mohon Maaf Nomor Antrian Pelayanan Sudah Habis, Silahkan Mengambil Nomor Antrian Pada Besok Hari.</h5>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn bg-gradient-dark text-white" type="button" data-dismiss="modal">
                        <i class="fa fa-times"> Tutup</i>
                    </button>
                </div>
            <?php } ?>

        </div>

    </div>
</div>
<!-- // MODAL NOMOR ANTRI -->

<?php
if (isset($_POST['no-antri'])) {
    $no_antri   = strip_tags($_POST['no_antri']);
    $id_pasien  = $_SESSION['id_pasien'];
    $tanggal    = $_POST['tanggal'];
    $status     = 'Belum Selesai';
    $keterangan = strip_tags($_POST['keterangan']);

    $submit = $koneksi->query("INSERT INTO nomor_antri VALUES(NULL, '$no_antri', '$id_pasien', '$tanggal', '$status', '$keterangan')");

    if ($submit) {
        echo "
            <script type='text/javascript'>
            setTimeout(function () { 
                Toast.fire({
                    type: 'success',
                    title: 'Anda Telah Mengambil Nomor Antrian Dengan Nomor $no_antri'
                })
            },10);  
            window.setTimeout(function(){ 
                window.location.replace('" . base_url() . "');
            } ,2500); 
            </script>";
    } else {
        echo "
            <script type='text/javascript'>
            setTimeout(function () { 
                Toast.fire({
                    type: 'error',
                    title: 'Nomor Antrian Gagal Diambil'
                })
            },10);  
            window.setTimeout(function(){ 
                window.location.replace('" . base_url() . "');
            } ,2500); 
            </script>";
    }
}
?>