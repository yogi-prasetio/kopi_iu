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
                <div class="card-header pb-2 mb-2">
                    <span class="h6">Tabel Pesanan</span>
                    <a href="<?= base_url('PesananController/RejectAll')?>" class="btn btn-danger btn-sm mr-2 mx-2 float-end" title='Tolak Semua'>
                        <i class="fas fa-times text-bold mx-2"></i> Tolak Semua
                    </a>
                    &nbsp
                    <a href="<?= base_url('PesananController/AcceptAll')?>" class="btn btn-success btn-sm float-end" title='Setujui Semua'>
                        <i class="fas fa-check text-bold mx-2"></i> Setujui Semua
                    </a>                    
                </div>
                <div class="card-body px-4 pb-3 pt-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="data-table">
                            <thead>
                                <tr class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                    <th>No</th>
                                    <th>Tanggal Pesanan</th>
                                    <th>Total Biaya</th>
                                    <th>Detail</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($Pesanan as $item) {
                                    ?>
                                    <tr class="text-sm">
                                        <td><?= $no++ ?></td>
                                        <td><?= $item->tgl_pesanan ?></td>
                                        <td><?= "Rp.".number_format($item->total_biaya,0,',','.') ?></td>
                                        <td>
                                            <a href="<?= base_url("PesananController/DetailPesanan/$item->id_pesanan"); ?>" class="badge badge-sm bg-gradient-success" data-toggle="tooltip" data-placement="top" title="Detail">Lihat Detail</a>
                                        </td>
                                        <td>
                                            <?php
                                            if($item->keterangan == "Pemesanan"){
                                                ?>
                                                <a href="<?= base_url("PesananController/Accept/$item->id_pesanan"); ?>" class="badge badge-sm bg-success" data-toggle="tooltip" data-placement="top" title="Terima"><i class="fa fa-check"></i></a>
                                                <a href="<?= base_url("PesananController/Reject/$item->id_pesanan"); ?>" class="badge badge-sm bg-danger" data-toggle="tooltip" data-placement="top" title="Tolak"><i class="fa fa-times"></i></a>
                                                <?php 
                                            } else {
                                                if($item->keterangan == "Ditolak Supplier") { 
                                                    echo "<span class='badge badge-sm bg-gradient-danger'>Ditolak</apan>";
                                                } else if($item->keterangan == "Disetujui Supplier" || $item->status == 1){
                                                    echo "<span class='badge badge-sm bg-gradient-success'>Disetujui</apan>";
                                                }
                                            } 
                                            ?>
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