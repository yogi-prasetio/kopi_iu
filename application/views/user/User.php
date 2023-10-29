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
                <div class="card-header pb-2">
                    <span class="h6">Tabel User</span>
                    <?php if($this->session->userdata('role')=='Admin'){ ?>
                        <a class="btn btn-sm btn-primary text-end" style="float: right;" href="<?= base_url('UserController/AddUser') ?>"><i class="fa fa-plus"></i></a>
                    <?php } ?>
                    <a class="btn btn-sm btn-secondary mx-2 <?= $User == null ? 'disabled' : ''?>" style="float: right;" href="<?= base_url('UserController/CetakUser') ?>"><i class="fa fa-print"></i></a>
                </div>
                <div class="card-body px-4 pb-3 pt-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="data-table-user">
                            <thead>
                                <tr class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                    <th>No</th>
                                    <th>Nama User</th>
                                    <th>No Handphone</th>
                                    <th>Alamat</th>
                                    <th>Role</th>
                                    <?php
                                    if($this->session->userdata('role')=='Admin'){
                                        echo "<th>Aksi</th>";
                                    } 
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($User as $item) {
                                    ?>
                                    <tr class="text-sm">
                                        <td><?= $no++ ?></td>
                                        <td><?= $item->nama_user ?></td>
                                        <td><?= $item->no_hp ?></td>
                                        <td><?= $item->alamat ?></td>
                                        <td><?= $item->role ?></td>
                                        <?php
                                        if($this->session->userdata("role") == "Gudang"){
                                            ?>
                                            <td class=" text-center">
                                                <a href="<?= base_url("UserController/UpdateUser/$item->id_user"); ?>" class="badge badge-sm bg-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                                            </td>
                                            <?php
                                        } else if($this->session->userdata("role") == "Admin"){
                                            ?>
                                            <td class=" text-center">
                                                <a href="<?= base_url("UserController/UpdateUser/$item->id_user"); ?>" class="badge badge-sm bg-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                                                <a href="<?= base_url("UserController/DeleteUser/$item->id_user"); ?>" class="badge badge-sm bg-danger" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-trash"></i></a>
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
            var table = $('#data-table-user').DataTable({
                responsive: true,
                fixedColumns: true,
                fixedRows: true,
                order: [[1, 'asc']],
                columnDefs: [
                {
                    targets: [0, -1],
                    searchable: false,
                    orderable: false,
                },
                {
                    render: function(data, type, full, meta){
                        return "<div class='text-wrap'>" + data + "</div>";
                    },
                    targets: 3
                }
                ]
            });
            table.on('draw.dt', function () {
                var PageInfo = $('#data-table-user').DataTable().page.info();
                table.column(0, { page: 'current' }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1 + PageInfo.start;
                });
            });
        });
    </script>