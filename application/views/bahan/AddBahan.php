<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card mb-2">
                <div class="card-header pb-2 mb-2">
                    <span class="h6">Tambah Bahan</span>
                </div>
                <div class="card-body px-4 pb-3 pt-0">
                    <form role="form" action="<?= base_url('BahanController/Insert') ?>" method="POST">
                        <div class="mb-3">
                            <label for="name_supplier" class="text-sm">
                                Nama Supplier
                            </label>
                            <select name="supplier" class="form-select">
                                <option selected disabled>-- Pilih Supplier --</option>
                                <?php 
                                foreach($supplier as $item){
                                    echo "<option value='".$item->id_user."'>$item->nama_user</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="text-sm">
                                Nama Bahan
                            </label>
                            <input type="text" class="form-control" placeholder="Nama Bahan" aria-label="Nama Bahan" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="text-sm">
                                Jumlah Stok
                            </label>
                            <input type="number" step="any" class="form-control"placeholder="Jumlah" aria-label="Jumlah" name="jumlah" id="jumlah" required>
                        </div>
                        <div class="mb-3">
                            <label for="satuan" class="text-sm">
                                Satuan
                            </label>
                            <select name="satuan" class="form-select">
                                <option selected disabled>-- Pilih Satuan --</option>
                                <option value="gram">gram</option>
                                <option value="ml">ml</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="text-sm">
                                Harga
                            </label>
                            <input type="number" step="any" class="form-control" placeholder="Harga" aria-label="Harga" name="harga" id="harga-beli" required>
                        </div>
                        <div class="mb-3">
                            <label for="lead_time" class="text-sm">
                                Lead Time
                            </label>
                            <input type="number" class="form-control" placeholder="Lead Time" aria-label="Lead Time" name="lead_time" required>
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

    <script type="text/javascript">
        var harga = document.getElementById('harga');
        harga.addEventListener('keyup', function(e)
        {
            harga.value = formatRupiah(this.value, 'Rp. ');
        });
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>