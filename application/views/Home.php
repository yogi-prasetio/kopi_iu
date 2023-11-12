<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url() ?>/assets/img/logo_iu.png">
    <title>
        Home • Kopi.IU
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="<?= base_url() ?>/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= base_url() ?>/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?= base_url() ?>/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url() ?>/assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body>
    <div class="row col-12 m-3 pb-2">
        <div class="col-4">
            <img src="<?= base_url() ?>assets/img/logo_iu.png" class="navbar-brand-img" style="height: 35px" alt="main_logo">
            <span class="ms-1 font-weight-bold pt-1 h5">kopi.iu</span>
        </div>
        <div class="col-4 text-center">
            <span class="ms-1 font-weight-bold pt-1 h3" style="
            text-align: center; font-family: Brush Script MT,garamond,serif; font-style:italic;">Kisah Baru Imah Uing Coffe</span>
        </div>
        <div class="col-4">
            <a href="<?= base_url('Auth') ?>" class="btn btn-warning mx-3" style="float: right">Login</a>
            <a href="<?= base_url('Auth/SignUp') ?>" class="btn btn-outline-secondary" style="float: right">Daftar</a>
        </div>
    </div>
    <!-- <hr size="5px" color="black" class="m-3"> -->
    <div class="row col-12">
        <img src="<?= base_url() ?>/assets/img/Kopi-IU.png" style="height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;">
    </div>

    <hr class="m-3 font-weight-bold" style="border: none; height: 3px; color: #000000; background-color: #000000;">
    <div class="row col-12 m-3 pb-2 font-weight-bold">
        <div class="col-4">            
            <a href="mailto:imahuingcoffe@gmail.com" target="__blank"><i class="fa fa-envelope"></i> imahuingcoffe@gmail.com</a>
        </div>
        <div class="col-4 text-center">
            <a href="https://instagram.com/kopi.i.u" target="__blank"><i class="fa fa-instagram"></i> kopi.i.u</a>
        </div>
        <div class="col-4">
            <a href="https://wa.me/+6288214602307" target="__blank">
                <span style="float: right; margin-right: 30px"><i class="fa fa-whatsapp"></i>  0882-1460-2307</span>
            </a>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="<?= base_url() ?>/assets/js/core/popper.min.js"></script>
<script src="<?= base_url() ?>/assets/js/core/bootstrap.min.js"></script>
<script src="<?= base_url() ?>/assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?= base_url() ?>/assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

</html>