<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Nolimits - <?= $title ?></title>

    <style>
        .bg-gradient-dark {
            background-color: #000000;
            background-image: -webkit-gradient(linear, left top, left bottom, color-stop(10%, #000000), to(#080808));
            background-image: linear-gradient(180deg, #080808 10%, #222222 100%);
            background-size: cover;
        }

        /** Style for Quagga JS */
        #interactive.viewport {
            position: relative;
            width: 100%;
            height: auto;
            overflow: hidden;
            text-align: center;
        }

        #interactive.viewport>canvas,
        #interactive.viewport>video {
            max-width: 100%;
            width: 100%;
        }

        canvas.drawing,
        canvas.drawingBuffer {
            position: absolute;
            left: 0;
            top: 0;
        }

        .profile-pic-wrapper {
            left: 50%;
            margin-left: -37px;
            top: 3.5rem;
        }
    </style>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Datatables css -->
    <link href="<?= base_url() ?>vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">

    <!-- Select2-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- JQuery UI -->
    <link href="<?= base_url() ?>vendor/jquery-ui/jquery-ui.css" rel="stylesheet" />

    <!-- JQuery -->
    <script src="<?= base_url(); ?>vendor/jquery/jquery.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->

    <!-- JQuery UI CSS -->
    <script src="<?= base_url() ?>vendor/jquery-ui/jquery-ui.js"></script>

    <!-- Select2-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?= $this->include('layouts/sidebar') ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?= $this->include('layouts/topbar'); ?>

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
                        <span>Copyright &copy; No Limits 2024</span>
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
    <script src="<?= base_url(); ?>vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>js/sb-admin-2.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Bootstrap Datatables-->
    <script src="<?= base_url() ?>vendor/datatables/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>vendor/datatables/dataTables.bootstrap4.js"></script>

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
            //$('.data-tables').DataTable();
            var t = $('.data-tabless').DataTable({
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
            $('#table-member').on('click', '.select-member', function() {

                var currentRow = $(this).closest('tr');
                var col1 = currentRow.find("td:eq(1)").text();
                var col2 = currentRow.find("td:eq(2)").text();

                $('#scanner_input').val(col1);
                $('#nama').val(col2);
            });
        });
    </script>


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
    </script>

    <script>
        $(document).ready(function() {
            $('#bayar').keyup(function() {
                var ttlnom = $('#totalnominal').val();
                var nombyr = $('#nominalbayar').val();
                var sisa = $('#sisa').val();
                var setor = $(this).val();
                // var pembayaran = $('#pembayaran').val();
                var kembali = 0;

                // if ($('#pembayaran').val() == '3') {
                //     $('#kembalian').val(kembali);
                // } else {
                // }
                kembali = parseInt(ttlnom) - (parseInt(nombyr) + parseInt(setor));
                $('#sisa').val(kembali);
                // $('#sisa').number(true, 0);
            });
        });
    </script>

    <!-- preview image -->
    <script>
        function previewImg() {
            const foto = document.querySelector('#foto');
            const fotoLabel = document.querySelector('.custom-file-label');
            const imgPreview = document.querySelector('.img-preview');

            fotoLabel.textContent = foto.files[0].name;

            const fileFoto = new FileReader();
            fileFoto.readAsDataURL(foto.files[0]);

            fileFoto.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>

    <!-- Quagga JS for barcode scan -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
    <script>
        $(function() {
            // Create the QuaggaJS config object for the live stream
            var liveStreamConfig = {
                inputStream: {
                    type: "LiveStream",
                    constraints: {
                        width: {
                            min: 640
                        },
                        height: {
                            min: 480
                        },
                        aspectRatio: {
                            min: 1,
                            max: 100
                        },
                        facingMode: "environment" // or "user" for the front camera
                    }
                },
                locator: {
                    patchSize: "medium",
                    halfSample: true
                },
                numOfWorkers: (navigator.hardwareConcurrency ? navigator.hardwareConcurrency : 4),
                decoder: {
                    "readers": [{
                        "format": "code_128_reader",
                        "config": {}
                    }]
                },
                locate: true
            };
            // The fallback to the file API requires a different inputStream option. 
            // The rest is the same 
            var fileConfig = $.extend({},
                liveStreamConfig, {
                    inputStream: {
                        size: 800
                    }
                }
            );
            // Start the live stream scanner when the modal opens
            $('#livestream_scanner').on('shown.bs.modal', function(e) {
                Quagga.init(
                    liveStreamConfig,
                    function(err) {
                        if (err) {
                            $('#livestream_scanner .modal-body .error').html('<div class="alert alert-danger"><strong><i class="fa fa-exclamation-triangle"></i> ' + err.name + '</strong>: ' + err.message + '</div>');
                            Quagga.stop();
                            return;
                        }
                        Quagga.start();
                    }
                );
            });

            // Make sure, QuaggaJS draws frames an lines around possible 
            // barcodes on the live stream
            Quagga.onProcessed(function(result) {
                var drawingCtx = Quagga.canvas.ctx.overlay,
                    drawingCanvas = Quagga.canvas.dom.overlay;

                if (result) {
                    if (result.boxes) {
                        drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                        result.boxes.filter(function(box) {
                            return box !== result.box;
                        }).forEach(function(box) {
                            Quagga.ImageDebug.drawPath(box, {
                                x: 0,
                                y: 1
                            }, drawingCtx, {
                                color: "green",
                                lineWidth: 2
                            });
                        });
                    }

                    if (result.box) {
                        Quagga.ImageDebug.drawPath(result.box, {
                            x: 0,
                            y: 1
                        }, drawingCtx, {
                            color: "#00F",
                            lineWidth: 2
                        });
                    }

                    if (result.codeResult && result.codeResult.code) {
                        Quagga.ImageDebug.drawPath(result.line, {
                            x: 'x',
                            y: 'y'
                        }, drawingCtx, {
                            color: 'red',
                            lineWidth: 3
                        });
                    }
                }
            });

            // Once a barcode had been read successfully, stop quagga and 
            // close the modal after a second to let the user notice where 
            // the barcode had actually been found.
            Quagga.onDetected(function(result) {
                if (result.codeResult.code) {
                    $('#scanner_input').val(result.codeResult.code);
                    Quagga.stop();
                    setTimeout(function() {
                        $('#livestream_scanner').modal('hide');
                    }, 1000);
                }
            });

            // Stop quagga in any case, when the modal is closed
            $('#livestream_scanner').on('hide.bs.modal', function() {
                if (Quagga) {
                    Quagga.stop();
                }
            });

            // Call Quagga.decodeSingle() for every file selected in the 
            // file input
            $("#livestream_scanner input:file").on("change", function(e) {
                if (e.target.files && e.target.files.length) {
                    Quagga.decodeSingle($.extend({}, fileConfig, {
                        src: URL.createObjectURL(e.target.files[0])
                    }), function(result) {
                        alert(result.codeResult.code);
                    });
                }
            });
        });
    </script>

    <!-- Pusher -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('56dbcda0648861a7ea6c', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            // alert(JSON.stringify(data));

            // Set konten notifikasi di modal
            document.getElementById('notificationMessage').innerText = data.message;

            // Tampilkan modal
            $('#notificationModal').modal('show');
        });

        $('#notificationModal').on('hidden.bs.modal', function() {
            setTimeout(() => {
                location.reload(); // Refresh halaman
            }, 500); // Delay 500ms
        });
    </script>

    <!-- Menampilkan AJAX data customer -->
    <script>
        $(document).ready(function() {
            $('#locker').on('change', function() {
                let memberId = $('#scanner_input').val();
                let csrfName = '<?= csrf_token() ?>';
                let csrfHash = '<?= csrf_hash() ?>';

                if (memberId.trim() === '') {
                    alert('Please enter Member ID');
                    return;
                }

                $.ajax({
                    url: '<?= base_url('visitors/get-member-data') ?>',
                    type: 'POST',
                    // headers: {
                    //     'X-CSRF-TOKEN': $('input[name="<?= csrf_token() ?>"]').val()
                    // },
                    data: {
                        member_id: memberId,
                        // [csrfName]: csrfHash
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#memberDetails').show();
                            $('#memberID').text(response.data.id);
                            $('#memberName').text(response.data.nama);
                            $('#memberExpiry').text(response.data.expiry_date);
                            $('#memberPhoto').attr('src', response.data.fp_image);
                        } else {
                            alert(response.message);
                            $('#memberDetails').hide();
                        }
                    },
                    error: function() {
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ajaxComplete(function(event, xhr) {
            let csrfName = '<?= csrf_token() ?>';
            let csrfHash = xhr.getResponseHeader('X-CSRF-TOKEN');
            if (csrfHash) {
                $('input[name="' + csrfName + '"]').val(csrfHash);
            }
        });
    </script>

    <!-- Reports membership trx-->
    <script>
        $(document).ready(function() {
            // Initialize DataTables
            var table = $('#transactionTable').DataTable({
                columnDefs: [{
                    targets: 0, // Kolom pertama (No)
                    orderable: false
                }]
            });

            $('#searchBtn').on('click', function() {
                var branch = $('#branch_location').val();
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();

                $.ajax({
                    url: "<?= base_url('report/fetch_transactions') ?>",
                    method: "GET",
                    data: {
                        branch_location: branch,
                        start_date: start_date,
                        end_date: end_date
                    },
                    dataType: "json",
                    success: function(response) {
                        // Clear existing rows
                        table.clear();

                        // Add new data rows
                        var nomor = 1; // Nomor urut dimulai dari 1
                        response.data.forEach(function(item) {
                            table.row.add([
                                nomor++, // Menambahkan nomor urut
                                item[0], // pkgname
                                item[1], // Nama cust
                                item[2], // cabang
                                item[3], // payment date
                                item[4], // payment type
                                item[5] // Nominal
                            ]).draw();
                        });

                        // Update total amount
                        $('#totalAmount').html(response.total_amount);
                    }
                });
            });
        });
    </script>

    <!-- Reports non member visit trx-->
    <script>
        $(document).ready(function() {
            // Initialize DataTables
            var table = $('#trxumum').DataTable({
                columnDefs: [{
                    targets: 0, // Kolom pertama (No)
                    orderable: false
                }]
            });

            $('#srcTrx').on('click', function() {
                var branch = $('#cabang').val();
                var start_date = $('#date_satu').val();
                var end_date = $('#date_dua').val();

                $.ajax({
                    url: "<?= base_url('report/fetch_nonmember_trx') ?>",
                    method: "GET",
                    data: {
                        cabang: branch,
                        date_satu: start_date,
                        date_dua: end_date
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response); // Debug response data
                        // Clear existing rows
                        table.clear();

                        // Add new data rows
                        var nomor = 1; // Nomor urut dimulai dari 1
                        response.data.forEach(function(item) {
                            table.row.add([
                                nomor++, // Menambahkan nomor urut
                                item[0], // pkgname
                                item[1], // Nama cust
                                item[2], // cabang
                                item[3], // payment date
                                item[4], // payment type
                                item[5] // Nominal
                            ]).draw();
                        });

                        // Update total amount
                        $('#total').html(response.total_amount);
                    }
                });
            });
        });
    </script>
</body>

</html>