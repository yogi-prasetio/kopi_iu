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
                    <span class="h6">Edit User</span>
                </div>
                <div class="card-body px-4 pb-3 pt-0">
                    <form role="form" action="<?= base_url('UserController/Update') ?>" method="POST">
                        <?php foreach($User as $row) { ?>
                            <input type="hidden" class="form-control" name="id" value="<?= $row->id_user ?>" required>
                            <div class="mb-3">
                                <label for="name" class="text-sm">
                                    Nama User
                                </label>
                                <input type="text" class="form-control" placeholder="Nama User" aria-label="Nama User" name="nama_user" value="<?= $row->nama_user ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="text-sm">
                                    Username
                                </label>
                                <input type="text" class="form-control" placeholder="Username" aria-label="username" name="username" id="username" value="<?= $row->username ?>" required>
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
                                    <option value="Admin" <?= $row->role=='Admin'? 'selected' : ''?>>Admin</option>
                                    <option value="Gudang" <?= $row->role=='Gudang'? 'selected' : ''?>>Gudang</option>
                                    <option value="Supplier" <?= $row->role=='Supplier'? 'selected' : ''?>>Supplier</option>
                                </select>
                            </div>
                            <div class="text-end">
                                <a href="<?= base_url('UserController') ?>"><button type="button" class="btn btn-secondary mt-4 mb-0">Batal</button></a>
                                <button type="submit" class="btn btn-primary mt-4 mb-0">Update</button>
                            </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>