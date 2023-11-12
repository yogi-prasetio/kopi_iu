<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card mb-2">
                <div class="card-header pb-2 mb-2">
                    <span class="h6">Edit Bahan</span>
                </div>
                <div class="card-body px-4 pb-3 pt-0">
                    <form role="form" action="<?= base_url('BahanController/Update') ?>" method="POST">
                        <?php foreach($bahan as $row) { ?>
                            <input type="hidden" class="form-control" name="id" value="<?= $row->id_bahan ?>" required>
                            <div class="mb-3">
                                <label for="name_supplier" class="text-sm">
                                    Nama Supplier
                                </label>
                                <?php if($_SESSION['role']=='Admin'){ ?>
                                    <select name="supplier" class="form-select">
                                        <option selected disabled>-- Pilih Supplier --</option>
                                        <?php foreach($supplier as $item){ ?>
                                            <option value="<?= $item->id_user ?>" <?= $row->id_supplier==$item->id_user ? "selected" : ""?>><?= $item->nama_user ?></option>";
                                        <?php } ?>
                                    </select>
                                <?php } else if($_SESSION['role']=='Gudang'){ 
                                    echo "<input type='hidden' value='$row->id_supplier' name='supplier' class='form-control' readonly>";
                                    echo "<input type='text' value='$row->nama_user' name='nama_supplier' class='form-control' readonly>";
                                }
                                ?>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="text-sm">
                                    Nama Bahan
                                </label>
                                <input type="text" class="form-control" placeholder="Nama Bahan" aria-label="Nama Bahan" name="name" value="<?= $row->nama_bahan ?>" <?= $_SESSION['role']=='Gudang' ? 'readonly' : '' ?> required>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah" class="text-sm">
                                    Jumlah Stok
                                </label>
                                <input type="number" step="any" class="form-control" placeholder="Jumlah" aria-label="Stok Awal" name="jumlah" id="jumlah" value="<?= $row->stok ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="satuan" class="text-sm">
                                    Satuan                                
                                </label>
                                <select name="satuan" class="form-select" <?= $_SESSION['role']=='Gudang' ? 'readonly' : '' ?>>
                                    <option disabled>-- Pilih Satuan --</option>
                                    <option <?php if($row->satuan == 'gram') echo 'selected'; ?> value="gram">gram</option>
                                    <option <?php if($row->satuan == 'ml') echo 'selected'; ?> value="ml">ml</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="text-sm">
                                    Harga
                                </label>
                                <input type="number" step="any" class="form-control" placeholder="Harga" aria-label="Harga" name="harga" value="<?= $row->harga ?>" <?= $_SESSION['role']=='Gudang' ? 'readonly' : '' ?> required>
                            </div>
                            <div class="mb-3">
                                <label for="lead_time" class="text-sm">
                                    Lead Time
                                </label>
                                <input type="number" class="form-control" placeholder="Lead Time" aria-label="Lead Time" name="lead_time" value="<?= $row->LT ?>" <?= $_SESSION['role']=='Gudang' ? 'readonly' : '' ?> required>
                            </div>
                            <div class="text-end">
                                <a href="<?= base_url('BahanController') ?>"><button type="button" class="btn btn-secondary mt-4 mb-0">Batal</button></a>
                                <button type="submit" class="btn btn-primary mt-4 mb-0">Update</button>
                            </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function updateStock(){
            var stok_awal = parseInt(document.getElementById('stok_awal').value);
            document.getElementById('stok_ready').value = stok_awal;
        }
    </script>