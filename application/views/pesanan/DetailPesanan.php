<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card mb-2">
                <div class="card-header pb-2">
                    <?php 
                    if($_SESSION['role']=="Supplier") {
                        $id_user = $_SESSION['id_user'];
                        echo "<span class=h6'>Detail Pesanan</span>
                        <a class='btn btn-sm btn-secondary' style='float: right;'' href='".base_url('PesananController/Pesanan/')."".$id_user."'><i class='fa fa-arrow-left'></i></a>";
                    } elseif ($_SESSION['role']=="Gudang") {
                        echo "<span class=h6'>Detail Pesanan</span>
                        <a class='btn btn-sm btn-secondary' style='float: right;'' href='".base_url('PesananController/DaftarTindakan')."''><i class='fa fa-arrow-left'></i></a>";
                    } elseif ($_SESSION['role']=="Admin") {
                        echo "<span class=h6'>Detail Pesanan ke ".$pesanan[0]->nama_user." pada ".$pesanan[0]->tgl_pesanan."</span>
                        <a class='btn btn-sm btn-secondary' style='float: right;'' href='".base_url('PesananController')."''><i class='fa fa-arrow-left'></i></a>";
                    }
                    ?>
                </div>
                <div class="card-body px-4 pb-3 pt-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="data-table">
                            <thead>
                                <tr class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                    <th>No</th>
                                    <th>Nama Bahan</th>
                                    <th>Jumlah Bahan</th>
                                    <th>Jumlah Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($pesanan as $item) {
                                    ?>
                                    <tr class="text-sm">
                                        <td><?= $no++ ?></td>
                                        <td><?= $item->nama_bahan ?></td>
                                        <td><?= $item->jml_bahan." ".$item->satuan ?></td>
                                        <td><?= $item->jml_harga ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>