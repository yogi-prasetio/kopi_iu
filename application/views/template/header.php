<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/logo_iu.png">
    <title>
        <?= $title; ?> • Kopi.IU
    </title>
    <!--     Fonts and icons     -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" /> -->
    <!-- Nucleo Icons -->
    <link href="<?= base_url() ?>assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <!-- <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> -->
    <link href="<?= base_url() ?>assets/plugins/fontawesome/css/all.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/plugins/fontawesome/css/all.min.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url() ?>assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <!-- Data Table -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/DataTables/jquery.dataTables.css">
     <!-- JQuery -->
    <script src="<?= base_url() ?>assets/plugins/jquery/jquery.js"></script>
    <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
    <script async src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
</head>

<body class="g-sidenav-show bg-gray-100">
    <?php 
        if($this->session->userdata('status') == FALSE){
            redirect("Auth");
        }
    ?>