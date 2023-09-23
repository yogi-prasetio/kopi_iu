<?php if ($this->session->flashdata('flashdata')) : ?>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flashdata'); ?>"></div>
<?php endif;
if ($this->session->flashdata('flashgagal')) : ?>
    <div class="flash-gagal" data-flashgagal="<?= $this->session->flashdata('flashgagal'); ?>"></div>
<?php endif; ?>
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-2">
                <div class="card-header py-3">
                    <span class="h6">Tabel BOM</span>
                    <?php if($this->session->userdata('role')=='Admin'){ ?>
                        <a class="btn btn-sm btn-primary" style="float: right;" href="<?= base_url('BOMController/AddBOM') ?>"><i class="fa fa-plus"></i></a>
                    <?php } ?>
                    <a class="btn btn-sm btn-secondary mx-2" style="float: right;" href="<?= base_url('BOMController/CetakBOM') ?>"><i class="fa fa-print"></i></a>
                </div>
                <div class="card-body px-4 pb-3 pt-0">
                    <table class="table align-items-center mb-0 pt-0" id="data-table-bom">
                        <thead>
                            <tr class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                <th>No</th>
                                <th>Nama BOM</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <?php
                                if($this->session->userdata('role')=='Admin'){
                                    echo "<th width='15%' align='center'>Aksi</th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=1;

                            foreach ($BOM as $row) {
                                ?>
                                <tr class="text-sm">
                                    <td><?= $i++; ?></td>
                                    <td><?= $row->nama_bom ?></td>
                                    <td><?= "Rp. ".number_format($row->harga,0,',','.') ?></td>
                                    <td><?= $row->deskripsi ?></td>
                                    <?php
                                    if($this->session->userdata('role')=='Admin'){
                                        ?>
                                        <td>
                                            <a href="<?= base_url("BOMController/DetailBOM/$row->id_bom"); ?>" class="badge badge-sm bg-info" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i></a>
                                            <a href="<?= base_url("BOMController/UpdateBOM/$row->id_bom"); ?>" class="badge badge-sm bg-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                                            <a href="<?= base_url("BOMController/DeleteBOM/$row->id_bom"); ?>" class="badge badge-sm bg-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>
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
        $('#data-table-bom').DataTable({
            responsive: true,
            fixedColumns: true,
            fixedRows: true,
            columnDefs: [
                {
                    render: function(data, type, full, meta){
                        return "<div class='text-wrap'>" + data + "</div>";
                    },
                    targets: 3
                }
            ]
        });
    });
</script>