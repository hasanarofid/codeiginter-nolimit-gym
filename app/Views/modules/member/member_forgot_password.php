<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Nolimits - Forgot Password</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- custom style -->
    <link href="css/styles.css" rel="stylesheet">

</head>

<body>
    <header id="header">
        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-md-6">
                    <a href="<?= base_url() ?>" class="boxed-btn3">Back</a>
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <?php
                            if (!empty(session()->getFlashdata('pesan'))) :
                            ?>
                                <?= session()->getFlashdata('pesan') ?>
                            <?php
                            endif;
                            ?>

                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <img src="../img/logo-transparent.png" class="img-fluid" />
                                            <h1 class="h4 text-gray-900 mb-4">Forgot Password</h1>
                                        </div>
                                        <form class="user" name="forgotpass" method="post" action="<?= $action ?>">
                                            <?= csrf_field() ?>
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user <?= session('errors.email') ? 'is-invalid' : '' ?>" name="email" id="email" value="<?= $email ?>" placeholder="Email Address">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.email'); ?>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-google btn-user btn-block">Reset Password</button>

                                        </form>
                                        <hr>
                                        <p class="lead"></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </header>



    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>