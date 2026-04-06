<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<div class="row justify-content-md-center">
    <div class="col-md-6">
        <?php
        if (!empty(session()->getFlashdata('pesan'))) :
        ?>
            <?= session()->getFlashdata('pesan') ?>
        <?php
        endif;
        ?>
        <div class="card shadow mb-4">
            <div class="card-header">
                <?= $title ?>
            </div>
            <div class="card-body">
                <form name="passadm" method="post" action="<?= $action ?>">
                    <?= csrf_field() ?>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" id="username" class="form-control <?= session('errors.username') ? 'is-invalid' : '' ?>" value="<?= $username ?>" readonly="true">
                            <div class="invalid-feedback">
                                <?= session('errors.username') ?>
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="nama">Nama Pengguna <span class="text-danger">*</span></label>
                            <input type="text" name="nama" maxlength="50" id="nama" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>" value="<?= $nama ?>">
                            <div class="invalid-feedback">
                                <?= session('errors.nama') ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="newpass">Password Baru <span class="text-danger">*</span></label>
                        <input type="password" name="newpass" id="newpass" class="form-control <?= session('errors.newpass') ? 'is-invalid' : '' ?>" placeholder="********">
                        <div class="invalid-feedback">
                            <?= session('errors.newpass') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="retype">Ulangi Password <span class="text-danger">*</span></label>
                        <input type="password" name="retype" id="retype" class="form-control <?= session('errors.retype') ? 'is-invalid' : '' ?>" placeholder="********">
                        <div class="invalid-feedback">
                            <?= session('errors.retype') ?>
                        </div>
                    </div>

                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary float-right">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>