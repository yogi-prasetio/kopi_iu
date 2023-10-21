<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card mb-2">
                <div class="card-header pb-2">
                    <span class="h6">Detail Pesanan</span>
                    <a class="btn btn-sm btn-secondary" style="float: right;" href="<?= base_url()?>TransaksiController/Order/<?= $_SESSION['id_user']?>"><i class="fa fa-arrow-left"></i></a>
                </div>
                <div class="card-body px-4 pb-3 pt-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="data-table">
                            <thead>
                                <tr class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Quantity</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($Transaksi as $item) {
                                ?>
                                    <tr class="text-sm">
                                        <td><?= $no++ ?></td>
                                        <td><?= $item->nama_bom ?></td>
                                        <td><?= $item->quantity?></td>
                                        <td><?= "Rp.".number_format($item->jumlah_harga,0,',','.') ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>