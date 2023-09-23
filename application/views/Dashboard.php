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
                        <i class="fas fa-users text-lg opacity-10" aria-hidden="true"></i>
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
                        <i class="fas fa-fw fa-flask text-lg opacity-10" aria-hidden="true"></i>
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
                        <i class="fas fa-users text-lg opacity-10" aria-hidden="true"></i>
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
                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Produksi</p>
                        <h5 class="font-weight-bolder">
                            <?= $produksi ?>
                        </h5>
                        <!-- <p class="mb-0">
                            <span class="text-success text-sm font-weight-bolder">+3%</span>
                            since last week
                        </p> -->
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                        <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
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
                        <i class="fas fa-fw fa-sitemap text-lg opacity-10" aria-hidden="true"></i>
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
                        <i class="fas fa-fw fa-flask text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>