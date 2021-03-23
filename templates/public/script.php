<!-- jQuery -->
<script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.min.js"></script>

<script src="<?= base_url() ?>/assets/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>/assets/dist/js/adminlte.min.js"></script>

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000
    });

    // FORMAT ANGKA SAJA
    function Angkasaja(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    // LIHAT PASSWORD
    function lihatpass(id) {
        var getid = document.getElementById(id).id;
        let tipe = document.getElementById(id).type;

        if (getid == 'pass_lama') {
            if (tipe == 'password') {
                document.getElementById(id).type = 'text';
                document.getElementById('btn_lama').innerHTML =
                    '<button type="button" class="btn bg-gradient-success" onclick=lihatpass("pass_lama") title="Sembunyikan Password"><i class="fas fa-eye"></i></button>';
            } else {
                document.getElementById(id).type = 'password';
                document.getElementById('btn_lama').innerHTML =
                    '<button type="button" class="btn bg-gradient-dark" onclick=lihatpass("pass_lama"); title="Tampilkan Password"><i class="fas fa-eye-slash"></i></button>';
            }
        }

        if (getid == 'pass_baru') {
            if (tipe == 'password') {
                document.getElementById(id).type = 'text';
                document.getElementById('btn_baru').innerHTML =
                    '<button type="button" class="btn bg-gradient-success" onclick=lihatpass("pass_baru") title="Sembunyikan Password"><i class="fas fa-eye"></i></button>';
            } else {
                document.getElementById(id).type = 'password';
                document.getElementById('btn_baru').innerHTML =
                    '<button type="button" class="btn bg-gradient-dark" onclick=lihatpass("pass_baru"); title="Tampilkan Password"><i class="fas fa-eye-slash"></i></button>';
            }
        }

        if (getid == 'pass') {
            if (tipe == 'password') {
                document.getElementById(id).type = 'text';
                document.getElementById('btn_pass').innerHTML =
                    '<button type="button" class="btn bg-gradient-success" onclick=lihatpass("pass") title="Sembunyikan Password"><i class="fas fa-eye"></i></button>';
            } else {
                document.getElementById(id).type = 'password';
                document.getElementById('btn_pass').innerHTML =
                    '<button type="button" class="btn bg-gradient-dark" onclick=lihatpass("pass"); title="Tampilkan Password"><i class="fas fa-eye-slash"></i></button>';
            }
        }
    }
</script>