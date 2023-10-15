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
                <form name="mrp" method="POST" action="<?= base_url("MRPController/Proses") ?>">
                    <div class="card-header pb-2">
                        <span class="h6">Material Requirement Planning</span>
                        <button type="submit" class="btn btn-sm btn-success mx-2" style="float: right;" >PROSES</i></button>
                        <a class="btn btn-sm btn-secondary mx-2" style="float: right;" href="<?= base_url('ProduksiController/CetakPengeluaran') ?>"><i class="fa fa-print"></i></a>
                    </div>
                    <div class="card-body px-4 pb-3 pt-0">
                        <div class="row col-12 mb-3 mx-2 mr-2">
                            <select name="bahan" class="form-select mr-2" id="bahan-mrp" required="true">
                                <option selected disabled>-- Pilih Bahan --</option>
                                <?php 
                                foreach($bahan as $item){
                                    echo "<option value='".$item->nama_bahan."'>".$item->nama_bahan."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="row col-12 mb-3 mx-2 mr-2">
                            <input type="hidden" name="id_bahan" class="form-control mr-2" id="id_bahan" required>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="data-pengeluaran">
                                <thead>
                                    <tr class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                        <th>Id Bahan</th>
                                        <th>Nama Bahan</th>
                                        <th>Bahan Keluar</th>
                                        <th>Bulan</th>                                    
                                        <th>Lead Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($pengeluaran as $item) {
                                        // var_dump($pengeluaran);
                                        ?>
                                        <tr class="text-sm">
                                            <td id="id">
                                                <input type="hidden" name="id" value="<?= $item->id_bahan ?>" required>
                                                <?= $item->id_bahan ?>                                                
                                            </td>
                                            <td id="name">
                                                <input type="hidden" name="nama_bahan" value="<?= $item->nama_bahan ?>" required>
                                                <?= $item->nama_bahan ?>
                                            </td>
                                            <td id="jumlah">
                                                <input type="hidden" name="jumlah" value="<?= $item->jumlah ?>" required>
                                                <?= $item->jumlah." ".$item->satuan ?>
                                            </td>
                                            <td id="tanggal">
                                                <input type="hidden" name="tanggal" value="<?= $item->tgl_pengeluaran ?>" required>
                                                <?= $item->tgl_pengeluaran ?>
                                            </td>
                                            <td id="lead_time">
                                                <input type="hidden" name="lead_time" value="<?= $item->LT ?>" required>
                                                <?= $item->LT ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-2">
                <div class="card-header pb-2">
                    <span class="h6">Data MRP</span>
                    <a class="btn btn-sm btn-secondary mx-2" style="float: right;" href="<?= base_url('ProduksiController/CetakPengeluaran') ?>"><i class="fa fa-print"></i></a>
                </div>
                <div class="card-body px-4 pb-3 pt-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="data-table-mrp">
                            <thead>
                                <tr class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                    <th>No</th>
                                    <th>Nama Bahan</th>
                                    <th>Bulan</th>
                                    <th>POQ</th>                                    
                                    <th>Frequensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($mrp as $item) {
                                    ?>
                                    <tr class="text-sm">
                                        <td><?= $no++ ?></td>
                                        <td><?= $item->nama_bahan ?></td>
                                        <td><?= $item->poq ?></td>
                                        <td>
                                            <?php echo round($item->frequensi/1000)." "; 
                                                if($item->satuan == "ml") { echo 'Liter'; } 
                                                elseif ($item->satuan == "gram") { echo 'Kg'; }
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#data-table-mrp').DataTable({
                responsive: true,
                fixedColumns: true,
                fixedRows: true,
            });
            var bahan_inp = document.getElementById("id_bahan");
            var table_keluar = $('#data-pengeluaran').DataTable({
                columnDefs: [
                {
                    target: 0,
                    visible: false,
                    searchable: true
                },
                ],
                responsive: true,
                fixedColumns: true,
                fixedRows: true,
                info: false,
            })

            // var table_keluar = $('#data-pengeluaran').DataTable();
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var select = $('#bahan-mrp').val();
                    var bahan = data[1];

                    if (bahan.includes(select)) {
                    // alert(bahan[0]);
                        // console.log('ada');
                        var id_bahan = data[0];
                        document.getElementById("id_bahan").value = id_bahan.toString();
                        return true;
                    } else {
                        // console.log('tidak ada');
                        return false;
                    }
                }
            );

            $("#bahan-mrp").change(function (e) {
                table_keluar.draw();
            });

            table_keluar.draw();
        })
    </script>