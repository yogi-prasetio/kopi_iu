<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card mb-2">
                <div class="card-header pb-2 mb-2">
                    <span class="h6">Tambah Produksi</span>
                </div>
                <div class="card-body px-4 pb-3 pt-0">
                    <form role="form" action="<?= base_url('ProduksiController/Insert') ?>" method="POST">
                        <div class="mb-3">
                            <label for="name" class="text-sm">
                                Nama Produk
                            </label>
                            <select name="produk_name" class="form-select">
                                <option selected disabled>-- Pilih Produk</option>
                                <?php
                                    foreach ($BOM as $produk) {
                                        echo "<option value='$produk->id_bom'>$produk->nama_bom</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="text-sm">
                                Jumlah
                            </label>
                            <input type="number" class="form-control" placeholder="Jumlah" aria-label="Jumlah" name="jumlah" id="jumlah" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="text-sm">
                                Tanggal
                            </label>
                            <input type="datetime-local" class="form-control" placeholder="Tanggal" aria-label="Tanggal" name="tanggal" required>
                            <!-- <input type="datetime" class="form-control" placeholder="Tanggal" aria-label="Tanggal" name="tanggal" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d H:i:s') ?>" readonly required> -->
                        </div>
                        <div class="text-end">
                            <a href="<?= base_url('BahanController') ?>"><button type="button" class="btn btn-secondary mt-4 mb-0">Batal</button></a>
                            <button type="submit" class="btn btn-primary mt-4 mb-0">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>