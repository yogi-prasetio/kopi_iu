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
                    <?php if($this->session->userdata('role')=='Admin'){ ?>
                        <a class="btn btn-sm btn-primary" style="float: right;" href="<?= base_url('PesananController/AddPesanan') ?>"><i class="fa fa-plus"></i></a>
                    <?php } ?>
                    <a class="btn btn-sm btn-secondary mx-2" style="float: right;" href="<?= base_url('PesananController/CetakPesanan') ?>"><i class="fa fa-print"></i></a>
                </div>
                <div class="card-body px-4 pb-3 pt-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="data-table">
                            <thead>
                                <tr class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                    <th>No</th>
                                    <th>Supplier</th>
                                    <th>Tanggal Pesanan</th>
                                    <th>Tanggal Penerimaan</th>
                                    <th>Total Biaya</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <?php
                                    if($this->session->userdata('role')=='Admin'){
                                        echo "<th>Aksi</th>";
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($Pesanan as $item) {
                                    ?>
                                    <tr class="text-sm">
                                        <td><?= $no++ ?></td>
                                        <td><?= $item->nama_user ?></td>
                                        <td><?= $item->tgl_pesanan ?></td>
                                        <td><?= $item->tgl_penerimaan ?></td>
                                        <td><?= "Rp.".number_format($item->total_biaya,0,',','.') ?></td>
                                        <td><?= $item->keterangan ?></td>
                                        <td><?php 
                                        if($item->keterangan=='Pemesanan'){ 
                                            echo "<span class='badge badge-sm bg-gradient-secondary'>submitted</span>";
                                        } else if($item->keterangan=='Disetujui Supplier'){ 
                                            echo "<span class='badge badge-sm bg-gradient-warning'>approved</span>";
                                        } else if($item->keterangan=='Ditolak Supplier'){ 
                                            echo "<span class='badge badge-sm bg-gradient-danger'>rejected</span>";
                                        } else if($item->keterangan=='Diterima'){ 
                                            echo "<span class='badge badge-sm bg-gradient-success'>accepted</span>";
                                        }
                                        if($this->session->userdata('role')=='Admin'){
                                            ?>
                                            <td class=" text-center">
                                                <a href="<?= base_url("PesananController/DetailPesanan/$item->id_pesanan"); ?>" class="badge badge-sm bg-info" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i></a>
                                                <?php if($item->status==1 || $item->keterangan=='Disetujui Supplier'){ ?>
                                                    <a href="<?= base_url("PesananController/CetakFaktur/$item->id_pesanan"); ?>" class="badge badge-sm bg-secondary" data-toggle="tooltip" data-placement="top" title="Cetak Faktur"><i class="fa fa-print"></i></a>
                                                <?php } ?>
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
            $('#data-table').DataTable({
                responsive: true,
                fixedColumns: true,
                fixedRows: true,
                info: false,
            });
        });
    </script>