<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card mb-2">
                <div class="card-header pb-2">
                    <span class="h6">Data Pengeluaran Bahan</span>
                    <a class="btn btn-sm btn-secondary mx-2 <?= $Pengeluaran == null ? 'disabled' : ''?>" style="float: right;" href="<?= base_url('PengeluaranController/CetakPengeluaran') ?>"><i class="fa fa-print"></i></a>
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
    <script>
        $(document).ready(function() {
            var table = $('#data-table').DataTable({
                responsive: true,
                fixedColumns: true,
                fixedRows: true,
                info: false,
                columnDefs: [
                {
                    targets: [0],
                    searchable: false,
                    orderable: false,
                },
                ],
            });
            table.on('draw.dt', function () {
                var PageInfo = $('#data-table').DataTable().page.info();
                table.column(0, { page: 'current' }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1 + PageInfo.start;
                });
            });
        });
    </script>