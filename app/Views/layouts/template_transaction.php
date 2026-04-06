<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="<?= csrf_hash() ?>">

    <title>Java Glass - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Datatables css -->
    <link href="<?= base_url() ?>/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">

    <!-- Select2-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- JQuery UI -->
    <link href="<?= base_url() ?>/vendor/jquery-ui/jquery-ui.css" rel="stylesheet" />

    <!-- Add fonts -->
    <style>
        @font-face {
            font-family: FFFFORWA;
            src: url(<?= base_url('/fonts/FFFFORWA.TTF') ?>);
        }

        .font-digital {
            font-family: 'FFFFORWA', Arial, Helvetica, sans-serif;
        }
    </style>

    <!-- JQuery -->
    <script src="<?= base_url(); ?>/vendor/jquery/jquery.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <a class="navbar-brand" href="#">Toko Javaglass</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown mr-4">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Menu
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/">Beranda</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">&nbsp;</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">&nbsp;</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">&nbsp;</a>
                            </li>

                        </ul>
                    </div>
                </nav>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?= $this->renderSection('content'); ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; JavaGlass 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('logout') ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>/js/sb-admin-2.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Datatables-->
    <script src="<?= base_url() ?>/vendor/datatables/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>/vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            //$('.data-tables').DataTable();
            var t = $('.data-tables').DataTable({
                columnDefs: [{
                    searchable: false,
                    orderable: false,
                    targets: 0,
                }, ],
                order: [
                    [1, 'asc']
                ],
            });

            t.on('order.dt search.dt', function() {
                let i = 1;

                t.cells(null, 0, {
                    search: 'applied',
                    order: 'applied'
                }).every(function(cell) {
                    this.data(i++);
                });
            }).draw();
        });
    </script>
    <script>
        $(document).ready(function() {
            var tb = $('.datatables-button').DataTable({
                dom: 'Bfrtip',
                buttons: ['excel', 'pdf', 'print'],
                columnDefs: [{
                    searchable: false,
                    orderable: false,
                    targets: 0,
                }, ],
                order: [
                    [1, 'asc']
                ],
            });

            tb.on('order.dt search.dt', function() {
                let i = 1;

                tb.cells(null, 0, {
                    search: 'applied',
                    order: 'applied'
                }).every(function(cell) {
                    this.data(i++);
                });
            }).draw();
        });
    </script>

    <!-- Get data from table row-->
    <script>
        $(document).ready(function() {
            $('#table-barang').on('click', '.select-barang', function() {

                var currentRow = $(this).closest('tr');
                var col1 = currentRow.find("td:eq(1)").text();
                var col2 = currentRow.find("td:eq(2)").text();

                $('#kdbrg').val(col1);
                $('#nama').val(col2);
            });
        });

        $(document).ready(function() {
            $('#table-brg').on('click', '.select-brg', function() {

                var currentRow = $(this).closest('tr');
                var col0 = currentRow.find("td:eq(0)").text();
                var col1 = currentRow.find("td:eq(1)").text();

                $('#kdbrg').val(col0);
                $('#nama_barang').val(col1);
            });
        });

        $(document).ready(function() {
            $('#table-spl').on('click', '.select-spl', function() {

                var currentRow = $(this).closest('tr');
                var col1 = currentRow.find("td:eq(1)").text();
                var col2 = currentRow.find("td:eq(2)").text();

                $('#kdsupl').val(col1);
                $('#nama_supplier').val(col2);
            });
        });

        $(document).ready(function() {
            $('#table-stn').on('click', '.select-stn', function() {

                var currentRow = $(this).closest('tr');
                var col0 = currentRow.find("td:eq(0)").text();

                $('#satuan').val(col0);
            });
        });

        $(document).ready(function() {
            $('#table-hrgjual').on('click', '.select-hrgjual', function() {

                var currentRow = $(this).closest('tr');
                var col1 = currentRow.find("td:eq(1)").text();
                var col2 = currentRow.find("td:eq(2)").text();

                $('#kdbrg').val(col1);
                $('#nama_barang').val(col2);
            });
        });

        $(document).ready(function() {
            $('#tbcust').on('click', '.select-cust', function() {

                var currentRow = $(this).closest('tr');
                var col1 = currentRow.find("td:eq(1)").text();
                var col2 = currentRow.find("td:eq(2)").text();

                $('#idcustomer').val(col1);
                $('#customer').val(col2);
            });
        });
    </script>

    <script src="<?= base_url() ?>/vendor/jquery-ui/jquery-ui.js"></script>
    <script>
        $(function() {
            $(".datepicker").datepicker({
                dateFormat: "yy-mm-dd",
                changeMonth: true,
                changeYear: true,
                yearRange: "c-80:c+0"
            });
        });
    </script>

    <!-- Select2-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select-two').select2();
        });
    </script>

    <!-- Number Js -->
    <script src="<?= base_url('/vendor/jquery-number/jquery.number.js') ?>"></script>
    <script type="text/javascript">
        $(function() {
            // Set up the number formatting.
            $('.uang').number(true, 0);
        });

        // $(document).ready(function() {
        //     $('#pembayaran').change(function() {
        //         if ($('#pembayaran').val() == '3') {
        //             $('#jmlcash').val(0);
        //         }
        //     });
        // });

        $(document).ready(function() {
            $('#jmlcash').keyup(function() {
                var total = $('#totalbyr').val();
                var cash = $(this).val();
                var pembayaran = $('#pembayaran').val();
                var kembali = 0;

                // if ($('#pembayaran').val() == '3') {
                //     $('#kembalian').val(kembali);
                // } else {
                // }
                kembali = parseInt(cash) - parseInt(total);
                $('#kembalian').val(kembali);
            });
        });
    </script>
</body>

</html>