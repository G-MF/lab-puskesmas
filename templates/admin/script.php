<!-- jQuery -->
<!-- <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/jquery-ui/jquery-ui.min.js"></script> -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url() ?>/assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url() ?>/assets/plugins/sparklines/sparkline.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url() ?>/assets/plugins/moment/moment.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url() ?>/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url() ?>/assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url() ?>/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- Select2 -->
<script src="<?= base_url() ?>/assets/plugins/select2/js/select2.full.min.js"></script>

<!-- DataTables -->
<script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<!-- AdminLTE App -->
<script src="<?= base_url() ?>/assets/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?= base_url() ?>/assets/dist/js/pages/dashboard.js"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>/assets/dist/js/demo.js"></script>

<script>
    $(function() {
        $('.select2').select2({
            allowClear: true
        });

        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });

    $(".delete").click(function() {
        let data = $(this).data("link");
        let name = $(this).data("name");
        $('.tombol-delete').attr("href", data);
        $('#name').empty();
        $('#name').append(name);
        $('#modal-delete').modal('show');
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