<div class="min-height-250 bg-secondary position-absolute w-100"></div>
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main" style="z-index: 1">
    <div class="sidenav-header">
        <center>
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="#">
                <img src="<?= base_url() ?>assets/img/logo_iu.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold pt-1 h5">kopi.iu</span>
            </a>
        </center>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" style="height: 100%;" id="sidenav-collapse-main">
        <ul class="navbar-nav" style="height: 100%;">
            <li class="nav-item">
                <a class="nav-link <?php if($title == 'Dashboard') echo 'active'?>" href="<?= base_url('Dashboard') ?>">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-fw fa-tachometer-alt text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <?php
            if($this->session->userdata('role') == "Gudang"){
                ?>
                <li class="nav-item">
                    <a class="nav-link <?php if($title == 'Data Bahan') echo 'active'?>" href="<?= base_url('BahanController') ?>">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-fw fa-flask text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Bahan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($title == 'Daftar Tindakan') echo 'active'?>" href="<?= base_url('PesananController/DaftarTindakan') ?>">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-fw fa-bell text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Daftar Tindakan</span>
                        <?= $jml_tindakan>0 ? 
                        "<span class='badge badge-pill bg-primary' style='margin-left: 25px;'>".$jml_tindakan."</span>" : ""?>
                    </a>
                </li>
                <?php
            } else if($this->session->userdata('role') == "Supplier"){
                ?>
                <li class="nav-item ">
                    <a class="nav-link <?php if($title == 'Data Pesanan') echo 'active'?> " href="<?= base_url() ?>/PesananController/Pesanan/<?=$_SESSION['id_user']?>">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pesanan</span>
                        <?= $tindakan>0 ? 
                        "<span class='badge badge-pill bg-primary' style='margin-left: 45px;'>".$tindakan."</span>" : ""?>
                    </a>
                </li>
                <?php
            } else if($this->session->userdata('role') == "Customer"){
                ?>
                <li class="nav-item ">
                    <a class="nav-link <?php if($title == 'Data Pesanan' || $title == 'Pesan' || $title == 'Detail Pesanan') echo 'active'?> " href="<?= base_url() ?>/TransaksiController/Order/<?=$_SESSION['id_user']?>">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pesanan</span>
                    </a>
                </li>
                <?php
            } else {
                ?>
                <li class="nav-item">
                    <a class="nav-link <?php if($title == 'Data User') echo 'active'?>" href="<?= base_url('UserController') ?>">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-fw fa-users text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">User</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($title == 'Data Bahan') echo 'active'?>" href="<?= base_url('BahanController') ?>">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-fw fa-flask text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Bahan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($title == 'Data BOM') echo 'active'?>" href="<?= base_url('BOMController') ?>">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-fw fa-sitemap text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">BOM</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($title == 'Data Transaksi') echo 'active'?>" href="<?= base_url('TransaksiController') ?>">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-dollar-sign text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Transaksi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($title == 'Data Pengeluaran') echo 'active'?>" href="<?= base_url('PengeluaranController') ?>">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-fw fa-cart-arrow-down text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pengeluaran</span>
                    </a>
                </li>                
                <li class="nav-item">
                    <a class="nav-link <?php if($title == 'MRP') echo 'active'?>" href="<?= base_url('MRPController') ?>">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">MRP</span>
                    </a>
                </li>                
                <li class="nav-item">
                    <a class="nav-link <?php if($title == 'Data Pesanan') echo 'active'?>" href="<?= base_url('PesananController') ?>">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-cart text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pesanan</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</aside>
<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page"><?= $title; ?></li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0"><?= $title; ?></h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 me-md-0 me-sm-4" id="navbar">
                <ul class="navbar-nav ms-md-auto pe-md-3 d-flex justify-content-end">
                    <li class="nav-item dropdown pe-2 d-flex align-items-center">
                        <a href="javascript;" class="nav-link text-white font-weight-bold px-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none"><?= $this->session->userdata('nama_user'); ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end px-2" aria-labelledby="dropdownMenuButton">
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="<?= base_url('Auth/SignOut') ?>">
                                    <div class="d-flex py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal">
                                                <i class="fa fa-sign-out"></i> 
                                                <span class="font-weight-bold text-black">Logout</span>
                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line bg-white"></i>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item px-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0">
                            <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                        </a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">