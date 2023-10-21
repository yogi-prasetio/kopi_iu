<?php if($_SESSION['role'] == "Supplier") { ?>
    <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Pesanan</p>
                            <h5 class="font-weight-bolder">
                                <?= $pesanan_supplier ?>
                            </h5>
                        <!-- <p class="mb-0">
                            <span class="text-success text-sm font-weight-bolder">+55%</span>
                            since yesterday
                        </p> -->
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                        <i class="fas fa-users text-lg opacity-10 text-white pt-3" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-6 col-sm-6">
    <div class="card">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-8">
                    <div class="numbers">
                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Bahan</p>
                        <h5 class="font-weight-bolder">
                            <?= $jml_bahan ?>
                        </h5>
                        <!-- <p class="mb-0">
                            <span class="text-success text-sm font-weight-bolder">+5%</span> than last month
                        </p> -->
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                        <i class="fas fa-fw fa-flask text-lg opacity-10 text-white pt-3" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } else if($_SESSION['role'] == "Customer") { ?>
    <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Transaksi</p>
                            <h5 class="font-weight-bolder">
                                <?= $transaksi_user ?>
                            </h5>
                        <!-- <p class="mb-0">
                            <span class="text-success text-sm font-weight-bolder">+55%</span>
                            since yesterday
                        </p> -->
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                        <i class="fas fa-dollar-sign text-lg opacity-10 text-white pt-3" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-6 col-sm-6">
    <div class="card">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-8">
                    <div class="numbers">
                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Billing</p>
                        <h5 class="font-weight-bolder text-success">
                            <?= $billing != NULL ? 'Rp. '.number_format($billing,0,',','.') : 'Rp. 0'?>
                        </h5>
                        <!-- <p class="mb-0">
                            <span class="text-success text-sm font-weight-bolder">+5%</span> than last month
                        </p> -->
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                        <i class="fas fa-money-bill text-lg opacity-10 text-white pt-3" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } else { ?>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Users</p>
                            <h5 class="font-weight-bolder">
                                <?= $users ?>
                            </h5>
                        <!-- <p class="mb-0">
                            <span class="text-success text-sm font-weight-bolder">+55%</span>
                            since yesterday
                        </p> -->
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                        <i class="fas fa-users text-lg opacity-10 text-white pt-3" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-8">
                    <div class="numbers">
                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Transaksi</p>
                        <h5 class="font-weight-bolder">
                            <?= $transaksi ?>
                        </h5>
                        <!-- <p class="mb-0">
                            <span class="text-success text-sm font-weight-bolder">+3%</span>
                            since last week
                        </p> -->
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                        <i class="fas fa-dollar-sign text-bold text-lg opacity-10 text-white pt-3" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-8">
                    <div class="numbers">
                        <p class="text-sm mb-0 text-uppercase font-weight-bold">BOM</p>
                        <h5 class="font-weight-bolder">
                            <?= $bom ?>
                        </h5>
                        <!-- <p class="mb-0">
                            <span class="text-danger text-sm font-weight-bolder">-2%</span>
                            since last quarter
                        </p> -->
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                        <i class="fas fa-sitemap text-lg opacity-10 text-white pt-3" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-sm-6">
    <div class="card">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-8">
                    <div class="numbers">
                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Bahan Baku</p>
                        <h5 class="font-weight-bolder">
                            <?= $bahan ?>
                        </h5>
                        <!-- <p class="mb-0">
                            <span class="text-success text-sm font-weight-bolder">+5%</span> than last month
                        </p> -->
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                        <i class="fas fa-fw fa-flask text-lg opacity-10 text-white pt-3" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 
<div class="row mt-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
            <h6 class="text-capitalize">Product overview</h6>
            <p class="text-sm mb-0">
                <i class="fa fa-arrow-up text-success"></i>
                <span class="font-weight-bold">4% more</span> in 2023
            </p>
        </div>
        <div class="card-body p-3">
            <div class="chart">
                <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
            </div>
        </div>
      </div>
    </div>
</div>
 -->
<?php } ?>

<!-- <script>
    $.ajax({
        type: 'GET',
        url: "https://localhost/Kopi_IU/BOMController",
        dataType: 'json',
        dataSrc: 'data',
    }).then(function (result) {
        // create the option and append to Select2
        for (let i = 0; i < result.data.length; i++) {
            var option = new Option(result.data[i].name, result.data[i].dept_Id, true, false);
            departmentSelect.add(option);
        }
    });
</script> -->