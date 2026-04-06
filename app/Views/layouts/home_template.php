<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>nolimits <?= $title ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>tema/tema-satu/img/favicon.png">
    <!-- Place f avicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="<?= base_url() ?>tema/tema-satu/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>tema/tema-satu/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>tema/tema-satu/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url() ?>tema/tema-satu/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>tema/tema-satu/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>tema/tema-satu/css/gijgo.css">
    <link rel="stylesheet" href="<?= base_url() ?>tema/tema-satu/css/nice-select.css">
    <link rel="stylesheet" href="<?= base_url() ?>tema/tema-satu/css/flaticon.css">
    <link rel="stylesheet" href="<?= base_url() ?>tema/tema-satu/css/slicknav.css">

    <link rel="stylesheet" href="<?= base_url() ?>tema/tema-satu/css/style.css">
    <!-- <link rel="stylesheet" href="tema/tema-satu/css/responsive.css"> -->
    <style>
        th {
            background-color: #FF1414;
            color: #fff;
            text-align: center;
        }

        td,
        td>h4 {
            /* background-color: #FF1414; */
            color: #fff;
            font-weight: lighter;
        }

        #about-content span {
            color: #FF1414;
            font-size: 20px;
            text-transform: capitalize;
        }

        .carousel-control-prev-icon {
            width: 48px !important;
            height: 48px !important;
        }

        .carousel-control-next-icon {
            width: 48px !important;
            height: 48px !important;
        }

        .team_thumb img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .carousel-inner .row {
            display: flex;
            flex-wrap: wrap;
        }

        .carousel-item {
            transition: transform 0.5s ease-in-out;
        }
    </style>

    <!-- SlickCSS -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    <script src="<?= base_url(); ?>tema/tema-satu/js/vendor/jquery-1.12.4.min.js"></script>
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <?= $this->include('layouts/home_header') ?>

    <?= $this->renderSection('contenthome'); ?>

    <?= $this->include('layouts/home_footer') ?>

</body>

</html>