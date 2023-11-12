<?php if ($this->session->flashdata('flashdata')) : ?>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flashdata'); ?>"></div>
<?php endif;
if ($this->session->flashdata('flashgagal')) : ?>
    <div class="flash-gagal" data-flashgagal="<?= $this->session->flashdata('flashgagal'); ?>"></div>
<?php endif; ?>

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <?php
                if($bahan_warning != '.') {
                    echo '<div class="alert alert-warning text-white text-sm" role="alert">
                            Beberapa bahan baku akan segera habis, diantaranya: <br><b>'.$bahan_warning.'
                          </b><br><br>
                          Segera pesan ulang sebelum benar-benar habis!</div>';
                }
            ?>
            <div class="card shadow mb-2">
                <div class="card-header pb-2">
                    <span class="h6">Tabel Bahan Baku</span>
                    <?php if($this->session->userdata('role')=='Admin'){ ?>
                        <a class="btn btn-sm btn-primary text-end" style="float: right;" href="<?= base_url('BahanController/AddBahan') ?>"><i class="fa fa-plus"></i></a>
                    <?php } ?>
                    <a class="btn btn-sm btn-secondary mx-2 <?= $bahan == null ? 'disabled' : ''?>" style="float: right;" href="<?= base_url('BahanController/CetakBahan') ?>">
                        <i class="fa fa-print"></i></a>
                </div>
                <div class="card-body px-4 pb-3 pt-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="data-table-bahan">
                            <thead>
                                <tr class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                    <th>No</th>
                                    <th>Nama Bahan</th>
                                    <th>Nama Supplier</th>
                                    <th>Stok</th>
                                    <th>Satuan</th>
                                    <th>Harga </th>
                                    <th>Lead Time</th>
                                    <?php
                                    if($this->session->userdata('role')=='Admin' || $_SESSION['role']=='Gudang'){
                                        echo "<th>Aksi</th>";
                                    } 
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($bahan as $item) {
                                    ?>
                                    <tr class="text-sm">
                                        <td><?= $no++ ?></td>
                                        <td><?= $item->nama_bahan ?></td>
                                        <td><?= $item->nama_user ?></td>
                                        <td><?= number_format($item->stok,0,',','.') ?></td>
                                        <td><?= $item->satuan ?></td>
                                        <td><?= "Rp. ".number_format($item->harga,0,',','.') ?></td>
                                        <td><?= $item->LT ?> hari</td>
                                        <?php
                                        if($this->session->userdata("role") == "Gudang"){
                                            ?>
                                            <td class=" text-center">
                                                <a href="<?= base_url("BahanController/UpdateBahan/$item->id_bahan"); ?>" class="badge badge-sm bg-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                                            </td>
                                            <?php
                                        } else if($this->session->userdata("role") == "Admin"){
                                            ?>
                                            <td class=" text-center">
                                                <a href="<?= base_url("BahanController/UpdateBahan/$item->id_bahan"); ?>" class="badge badge-sm bg-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                                                <a href="<?= base_url("BahanController/DeleteBahan/$item->id_bahan"); ?>" class="badge badge-sm bg-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>
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
    <script>
        $(document).ready(function() {
            var table = $('#data-table-bahan').DataTable({
                responsive: true,
                fixedColumns: true,
                fixedRows: true,
                info: false,
                columnDefs: [
                {
                    targets: [0, -1],
                    searchable: false,
                    orderable: false,
                },
                ],
            });
            table.on('draw.dt', function () {
                var PageInfo = $('#data-table-bahan').DataTable().page.info();
                table.column(0, { page: 'current' }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1 + PageInfo.start;
                });
            });
        });
    </script>