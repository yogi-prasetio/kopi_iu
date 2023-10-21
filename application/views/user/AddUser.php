
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
                    <span class="h6">Tambah User</span>
                </div>
                <div class="card-body px-4 pb-3 pt-0">
                    <form role="form" action="<?= base_url('UserController/Insert') ?>" method="POST">
                        <div class="mb-3">
                            <label for="name" class="text-sm">
                                Nama User
                            </label>
                            <input type="text" class="form-control" placeholder="Nama User" aria-label="Nama User" name="nama_user" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="text-sm">
                                Nomor Handphone
                            </label>
                            <input type="number" class="form-control" placeholder="Nomor Handphone" aria-label="no_hp" name="no_hp" id="no_hp" minlength="11" maxlength="13" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="text-sm">
                                Alamat
                            </label>
                            <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="text-sm">
                                Username
                            </label>
                            <input type="text" class="form-control" placeholder="Username" aria-label="username" name="username" id="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="text-sm">
                                Password
                            </label>
                            <input type="password" class="form-control" placeholder="Password" aria-label="password" name="password" id="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="text-sm">
                                Role
                            </label>
                            <select name="role" class="form-select">
                                <option selected disabled>-- Pilih Role --</option>
                                <option value="Admin">Admin</option>
                                <option value="Customer">Customer</option>
                                <option value="Gudang">Gudang</option>
                                <option value="Supplier">Supplier</option>
                            </select>
                        </div>
                        <div class="text-end">
                            <a href="<?= base_url('UserController') ?>"><button type="button" class="btn btn-secondary mt-4 mb-0">Batal</button></a>
                            <button type="submit" class="btn btn-primary mt-4 mb-0">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>