            <div class="card mt-4">
                <footer class="footer pt-4 pb-4">
                    <div class="container-fluid">
                        <div class="row align-items-center justify-content-lg-between">
                            <div class="col-lg-6 mb-lg-0 mb-4">
                                <div class="copyright text-center text-sm text-muted text-lg-start">
                                    © <script>
                                        document.write(new Date().getFullYear())
                                    </script>,
                                    made with <i class="fa fa-heart"></i> by
                                    <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Anonymous Programmer</a>
                                    for a better web.
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
</main>
<div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
        <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg">
        <div class="card-header pb-0 pt-3 ">
            <div class="float-start">
                <h5 class="mt-3 mb-0">App Configurator</h5>
                <p>See our dashboard options.</p>
            </div>
            <div class="float-end mt-4">
                <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <!-- End Toggle Button -->
        </div>
        <hr class="horizontal dark my-1">
        <div class="card-body pt-sm-3 pt-0 overflow-auto">
            <!-- Sidebar Backgrounds -->
            <div>
                <h6 class="mb-0">Sidebar Colors</h6>
            </div>
            <a href="javascript:void(0)" class="switch-trigger background-color">
                <div class="badge-colors my-2 text-start">
                    <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
                </div>
            </a>
            <!-- Sidenav Type -->
            <div class="mt-3">
                <h6 class="mb-0">Sidenav Type</h6>
                <p class="text-sm">Choose between 2 different sidenav types.</p>
            </div>
            <div class="d-flex">
                <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
                <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Dark</button>
            </div>
            <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
            <!-- Navbar Fixed -->
            <div class="d-flex my-3">
                <h6 class="mb-0">Navbar Fixed</h6>
                <div class="form-check form-switch ps-0 ms-auto my-auto">
                    <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
                </div>
            </div>
            <hr class="horizontal dark my-sm-4">
            <div class="mt-2 mb-5 d-flex">
                <h6 class="mb-0">Light / Dark</h6>
                <div class="form-check form-switch ps-0 ms-auto my-auto">
                    <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
                </div>
            </div>

        </div>
    </div>
</div>

<!--   Core JS Files   -->
<script src="<?= base_url() ?>assets/js/core/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/core/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/chartjs.min.js"></script>

<!-- Plugins Additional -->
<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/DataTables/datatables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<!-- Bootstrap -->
<script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?= base_url(); ?>assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?= base_url() ?>assets/js/argon-dashboard.min.js?v=2.0.4"></script>

<script>
    $(document).ready(function() {
        $('#data-table').DataTable({
            responsive: true,
            fixedColumns: true,
            fixedRows: true,
        });

        

        
    });
</script>
<script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
        type: "line",
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Mobile apps",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#5e72e4",
                backgroundColor: gradientStroke1,
                borderWidth: 3,
                fill: true,
                data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                maxBarThickness: 6

            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#fbfbfb',
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#ccc',
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });
</script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>

<script type="text/javascript">
  function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
  return true;
}
</script>

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


$('.btn-delete').on('click', function(e) {
    const href = $(this).attr('href');
    e.preventDefault()

    Swal.fire({
      title: 'Hapus Data',
      text: "Apakah Anda yakin akan menghapus data?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Hapus',
      cancelButtonText: 'Batal'
  }).then((result) => {
      if (result.isConfirmed) {
        document.location.href = href;
    }
})
})
$('#btn-confirm').on('click', function(e) {
    // const href = $(this).attr('href');
    e.preventDefault()

    Swal.fire({
      title: 'Konfirmasi Pesanan',
      text: "Apakah Anda yakin akan melakukan pesanan?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Konnfirmasi',
      cancelButtonText: 'Batal'
  }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById("add-pesanan").submit();
        // document.location.href = href;
    }
})
})
</script>

</body>

</html>