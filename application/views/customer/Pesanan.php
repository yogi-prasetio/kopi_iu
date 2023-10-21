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
                    <span class="h6">Tabel Pesanan</span>
                    <a class="btn btn-sm btn-primary" style="float: right;" href="<?= base_url('TransaksiController/Add') ?>"><i class="fa fa-plus"></i></a>
                    <a class="btn btn-sm btn-secondary mx-2" style="float: right;" href="<?= base_url('TransaksiController/Cetak') ?>"><i class="fa fa-print"></i></a>
                </div>
                <div class="card-body px-4 pb-3 pt-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="data-table">
                            <thead>
                                <tr class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                    <th>No</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Jumlah Produk</th>
                                    <th>Total Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($pesanan as $item) {
                                    ?>
                                    <tr class="text-sm">
                                        <td><?= $no++ ?></td>
                                        <td><?= $item->tgl_transaksi ?></td>
                                        <td><?= $item->jumlah_produk ?></td>
                                        <td><?= "Rp.".number_format($item->total_harga,0,',','.') ?></td>                                        
                                        <td class=" text-center">
                                            <a href="<?= base_url("TransaksiController/Detail/$item->id_transaksi"); ?>" class="badge badge-sm bg-info" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#data-table').DataTable({
                responsive: true,
                fixedColumns: true,
                fixedRows: true,
                info: false,
            });
        });
    </script>