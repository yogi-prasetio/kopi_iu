<?php if ($this->session->flashdata('flashdata')) : ?>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flashdata'); ?>"></div>
<?php endif;
if ($this->session->flashdata('flashgagal')) : ?>
    <div class="flash-gagal" data-flashgagal="<?= $this->session->flashdata('flashgagal'); ?>"></div>
<?php endif; ?>
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card mb-2">
                <div class="card-header pb-2">
                    <span class="h6">Tabel Produksi</span>
                    <?php if($this->session->userdata('role')=='Admin'){ ?>
                        <a class="btn btn-sm btn-primary" style="float: right;" href="<?= base_url('ProduksiController/AddProduksi') ?>"><i class="fa fa-plus"></i></a>
                    <?php } ?>
                    <a class="btn btn-sm btn-secondary mx-2" style="float: right;" href="<?= base_url('ProduksiController/CetakProduksi') ?>"><i class="fa fa-print"></i></a>
                </div>
                <div class="card-body px-4 pb-3 pt-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="data-table">
                            <thead>
                                <tr class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                    <th>No</th>
                                    <th>Nama BOM</th>
                                    <th>Jumlah Produksi</th>
                                    <th>Tanggal Produksi</th>
                                    <?php
                                    if($this->session->userdata('role')=='Admin'){
                                        echo "<th>Aksi</th>";
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($Produksi as $item) {
                                    ?>
                                    <tr class="text-sm">
                                        <td><?= $no++ ?></td>
                                        <td><?= $item->nama_bom ?></td>
                                        <td><?= $item->jumlah_produksi ?></td>
                                        <td><?= $item->tgl_produksi ?></td>
                                        <?php
                                        if($this->session->userdata('role')=='Admin'){
                                            ?>
                                            <td class=" text-center">
                                                <a href="<?= base_url("ProduksiController/DetailProduksi/$item->id_produksi"); ?>" class="badge badge-sm bg-info" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i></a>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>