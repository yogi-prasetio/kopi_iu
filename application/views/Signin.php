<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url() ?>/assets/img/logo_iu.png">
    <title>
        Sign In • Kopi.IU
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

<?php if ($this->session->flashdata('flashdata')) : ?>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flashdata'); ?>"></div>
<?php endif;
if ($this->session->flashdata('flashgagal')) : ?>
    <div class="flash-gagal" data-flashgagal="<?= $this->session->flashdata('flashgagal'); ?>"></div>
<?php endif; ?>

<body class="">
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Sign In</h4>
                                    <p class="mb-0">Enter your username and password to sign in</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" action="<?= base_url('Auth/SignIn') ?>" method="POST">
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-lg" placeholder="Username" aria-label="Username" name="username" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" name="password" required>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                                        </div>
                                        <div class="text-center mt-3">
                                            <span>Belum punya akun? <a href="<?= base_url('Auth/SignUp') ?>" class="text-bold">Daftar</a></span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('<?=base_url('assets/img/kopi.png')?>');
                            background-size: cover;">                            
                            <span class="mask bg-gradient-secondary opacity-6"></span>
                            <center> <img src="<?= base_url() ?>/assets/img/logo_iu.png" class="position-relative" height="200" width="200"></center>
                            <h4 class="mt-2 text-white font-weight-bolder position-relative">"Kisah Baru Imah Uing Coffee"</h4>
                            <p class="text-white position-relative">Jl. Ir. H. Juanda No.201, Purwawinangun, Kecamatan Kuningan, Kabupaten Kuningan - Jawa Barat</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
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
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<!-- <script src="<?= base_url() ?>/assets/js/argon-dashboard.min.js?v=2.0.4"></script> -->


<script type="text/javascript">

  var flashdata = $('.flash-data').data('flashdata');
  //console.log(flashdata);
  if (flashdata) {
    Swal.fire({
      icon: 'success',
      type: 'success',
      title: 'Sukses',
      text: '' + flashdata
  })
}

var flashgagal = $('.flash-gagal').data('flashgagal');
  //console.log(flashdata);
  if (flashgagal) {
    Swal.fire({
      icon: 'error',
      type: 'error',
      title: 'Gagal',
      text: '' + flashgagal
  })
}
</script>
</body>

</html>