<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card mb-2">
                <div class="card-header pb-2">
                    <span class="h6">Detail Produksi</span>
                    <a class="btn btn-sm btn-secondary" style="float: right;" href="<?= base_url('ProduksiController') ?>"><i class="fa fa-arrow-left"></i></a>
                </div>
                <div class="card-body px-4 pb-3 pt-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="data-table">
                            <thead>
                                <tr class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                    <th>No</th>
                                    <th>Nama Bahan</th>
                                    <th>Bahan Digunakan</th>
                                    <th>Tanggal Produksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($Pengeluaran as $item) {
                                ?>
                                    <tr class="text-sm">
                                        <td><?= $no++ ?></td>
                                        <td><?= $item->nama_bahan ?></td>
                                        <td><?= $item->jumlah_bahan." ".$item->satuan ?></td>
                                        <td><?= $item->tgl_pengeluaran ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>