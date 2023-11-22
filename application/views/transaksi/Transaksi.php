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
                    <span class="h6">Tabel Transaksi</span>
                    <?php if($this->session->userdata('role')=='Admin'){ ?>
                        <a class="btn btn-sm btn-primary <?= $stok === false ? 'disabled' : '' ?>" style="float: right;" href="<?= base_url('TransaksiController/AddTransaksi') ?>">
                            <i class="fa fa-plus"></i>
                        </a>
                    <?php } ?>
                    <a class="btn btn-sm btn-secondary mx-2 <?= $Transaksi == null ? 'disabled' : ''?>" style="float: right;" href="<?= base_url('TransaksiController/CetakTransaksi') ?>"><i class="fa fa-print"></i></a>
                </div>
                <div class="card-body px-4 pb-3 pt-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="data-table">
                            <thead>
                                <tr class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                    <th>No</th>
                                    <th>Nama User</th>
                                    <th>Keterangan</th>
                                    <th>Jumlah Produk</th>
                                    <th>Total Harga</th>
                                    <th>Tanggal Transaksi</th>
                                    <?php
                                    if($this->session->userdata('role')=='Admin'){
                                        echo "<th>Aksi</th>";
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($Transaksi as $item) {
                                    ?>
                                    <tr class="text-sm">
                                        <td><?= $no++ ?></td>
                                        <td><?= $item->nama_user ?></td>
                                        <td><?= $item->role ?></td>
                                        <td><?= $item->jumlah_produk ?></td>
                                        <td><?= "Rp.".number_format($item->total_harga,0,',','.') ?></td>
                                        <td><?= $item->tgl_transaksi ?></td>
                                        <?php
                                        if($this->session->userdata('role')=='Admin'){
                                            ?>
                                            <td class=" text-center">
                                                <a href="<?= base_url("TransaksiController/DetailTransaksi/$item->id_transaksi"); ?>" class="badge badge-sm bg-info" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i></a>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                        if($stok == false) {
                            echo '<div class="alert alert-warning text-white mt-3 text-lg" role="alert">
                                Mohon maaf Anda tidak bisa melakukan transaksi dikarenakan beberapa bahan yang digunakan akan habis!
                                </div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var table = $('#data-table').DataTable({
                responsive: true,
                fixedColumns: true,
                fixedRows: true,
                info: false,
                order: [[1, 'asc']],
                columnDefs: [
                {
                    targets: [0, -1],
                    searchable: false,
                    orderable: false,
                },
                ]
            });
            table.on('draw.dt', function () {
                var PageInfo = $('#data-table').DataTable().page.info();
                table.column(0, { page: 'current' }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1 + PageInfo.start;
                });
            });
        });
    </script>